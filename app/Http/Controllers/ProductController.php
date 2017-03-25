<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use AWS;
use DB;
use Input;
use Alert;
use Cart;

class ProductController extends Controller
{   
   
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

        $product = new Product($request->all());


        store image in amazon bucket
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
        $product->update();
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

    public function add_to_cart($id){
        if(Request::ajax()) {
         $data = Input::all();
         
         $product = Product::find($id);
         Cart::add($product);
         print_r($data);die;
         }
        
    }

    public function edit_cart($id){

        Cart::update($rowId, $request->qty);
    }

    public function remove_cart_item($id){

         Cart::remove($rowId);
    }

    public function new_product(){
        return view('product.new');
    }
}
