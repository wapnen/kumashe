@extends('admin.layouts.app')
@section('content')
	<section id="cart_items">
		<div class="container">
				

			<div class="step-one">
				<h2 class="heading">Transaction #ref: {{$transaction->id}}</h2>
			</div>
			
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div id = "shopper-info" class="shopper-info">

							
							<p>Shopper Information| Delivery Address</p>
							<table class = 'table table-striped'><tr><th>Name</th><td>{{$user->name}}</td></tr>
							<tr><th>Email</th><td>{{$user->email}}</td></tr>
							<tr><th>Phone</th><td>{{$user->phone}}</td></tr>
							<tr><th>Address</th><td>{{$address->address}} , {{$address->landmark}} , {{$address->LGA}} </br> {{$address->state}} </td></tr>
							</table>
						</div>
					</div>
					
					<div class="col-sm-4">
						<div class="order-message">
							<p>Shipping Order</p>
							<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
							
						</div>	
					</div>					
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							
						</tr>
					</thead>
					<tbody>
						@foreach( $sales as $sale)
						@foreach($products as $product)
						@if($sale->product_id = $product->id)	
						<tr>
							<td class="cart_product">
								<a href="{{route('product.show', $product->id)}}"><img src="{{$product->image_url}}" alt="{{$product->name}}"></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$product->name}}</a></h4>
								<p>Web ID: {{$product->id}}</p>
							</td>
							<td class="cart_price">
								<p>N {{$product->price}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
								<p>Quantity bought: {{$sale->quantity}}</p>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$sale->total}}</p>
							</td>
							
						</tr>
						@endif
						@endforeach
						@endforeach
							<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									
										<td>Total</td>
										<td><span id = "total_box">N{{$transaction->total}}</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
	
		</div>
	</section>
@endsection
