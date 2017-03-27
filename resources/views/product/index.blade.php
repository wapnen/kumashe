@extends('admin.layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-offset-sm-1">
				<div class="step-one">
                    <h2 class="heading">All Products</h2>
                </div>

                <table class="table">
                	<thead>
                		<tr>
                			<th>Product id</th>
                			<th>Name</th>
                			<th>Brand</th>
                			<th>Category</th>
                			<th>Unit price</th>
                			<th>Quantity</th>
                			<th>Description</th>
                			<th>Edit</th>
                			<th>Delete</th>
                			<th>Details</th>
                		</tr>
                	</thead>
                	<tbody>
                		@foreach($products as $product)
                			<tr>
                				<td>{{$product->id}}</td>
                				<td>{{$product->name}}</td>
                				<td>{{$product->brand}}</td>
                				<td>{{$product->category}}</td>
                				<td>{{$product->price}}</td>
                				<td>{{$product->total}}</td>
                				<td>{{$product->description}}</td>
                				<td><a href="{{route('product.edit', $product->id)}}" class="btn btn-default"><i class = "fa fa-pencil"></i></a></td>
                				<td><form method="post" action="/product/{{$product->id}}">
                						{{ csrf_field()}}
                						{{ method_field('DELETE') }}
                						<button class="btn btn-default"><i class =  "fa fa-trash"></i></button>
                				</form></td>
                				<td><a href="{{route('product.show', $product->id)}}" class="btn btn-default"><i class = "fa fa-eye"></i></a></td>
                			</tr>
                		@endforeach
                	</tbody>
                </table>
			</div>
		</div>
	</div>
@endsection