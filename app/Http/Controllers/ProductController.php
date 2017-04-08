<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use App\Product;
//use AWS;
use DB;
use Input;
use Alert;
use Cart;
use App\Providers\GoogleCloudStorageServiceProvider;
use App\Transaction;
use App\User;
use App\Guest;

class ProductController extends Controller
{   
    
      public function __construct()
    {
       $this->middleware('admin_auth')->except('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products  = Product::all();

        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|integer',
            'total' => 'required|integer', 
            'image' => 'required|file',
            ]);

        $cred = getenv('GOOGLE_CLOUD_KEY');
        $fpath = getenv('GOOGLE_CLOUD_KEY_FILE');
        if ($cred !== false && $fpath !== false) {
            file_put_contents($fpath,json_encode($cred));
        }

        $product = new Product($request->all());


        $image = $request->file('image') ;

        $imageFileName = time() . '.' . $image->getClientOriginalExtension();
        $gcs = \Storage::disk('gcs');
        $filePath = '/inventory/' . $imageFileName;
        $gcs->put($imageFileName, file_get_contents($image));
        $gcs->setVisibility($imageFileName, 'public'); 
        $image_url = $gcs->url($imageFileName);
       // dd($gcs);
        $product->image_url = $image_url;
        $product->save();

        return redirect(route('product.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = Product::find($id);
        $recommended = DB::table('products')->where([['category' , $product->category] ,['id' ,'!=',  $product->id]])->inRandomOrder()->limit(8)->get();
        $similar1 = [];
        $similar2 = [];
        foreach ($recommended as $key ) {
                
                if(count($similar1 < 4)){
                    $similar1[] =  $key;
                }
                else{
                    $similar2[] = $key;
                }
            }    
        return view('product.show', compact('product', 'similar1', 'similar2'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::find($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::find($id);
        $product->update($request);
        if($request->hasFile('image')){
            //store image in amazon bucket
        $file = $request->file('image') ;
        $fileName =  time() . '.' . $file->getClientOriginalExtension() ;
        $filePath = $file->getPathName();

        $s3 = AWS::createClient('s3');
        $s3->putObject(array(
            'Bucket'     => 'kumashe',
            'Key'        => $fileName,
            'SourceFile' => $filePath,
            'ACL'        => 'public-read'
        ));
         $image_url = $s3->getObjectUrl('kumashe', $fileName);
        $product->image_url = $image_url;
        }

        $product->save();
        return redirect(route('product.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);
        $product->delete();
        return redirect(route('product.index'));
    }

   //show sales 
    public function transactions(){
        $transactions = Transaction::all();
        return view('sale.transactions', compact('transactions'));
    }
    
    public function transaction($id){
        $transaction = Transaction::find($id);
        if($transaction->type == 'user'){
            $user = User::find($transaction->user_id);
            $address = DB::table('addresses')->where(['user_id' => $user->id, 'type' => 'user'])->get();

            foreach ($address as $key =>$value) {
                $address = $value;
            }
        }
        else{
            $user = Guest::find($id);
            $address = DB::table('addresses')->where(['user_id' => $user_id, 'type' => 'guest'])->get();

            foreach ($address as $key =>$value) {
                $address = $value;
            }
        }

        $sales = $transaction->sale()->get();
        $products_array = [];
        foreach ($sales as $sale) {
            $products_array[] = $sale->id;
        }
        $products = DB::table('products')->whereIn('id', $products_array)->get();
        
        return view('sale.transaction', compact('transaction', 'user', 'address', 'sales', 'products'));
    }
}
