@extends('layouts.app')
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="url('/')">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
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
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach( Cart::content() as $cartcontent)
						@foreach($cartitems as $cartitem)
						@if($cartcontent->id = $cartitem->id)	
						<tr>
							<td class="cart_product">
								<a href="{{route('product.show', $cartitem->id)}}"><img src="{{$cartitem->image_url}}" alt="{{$cartitem->name}}"></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$cartitem->name}}</a></h4>
								<p>Web ID: {{$cartitem->id}}</p>
							</td>
							<td class="cart_price">
								<p>N {{$cartitem->price}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
								<form action="post" method="/edit_cart/{{$cartcontent->rowId}}" class="form-inline">
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$cartcontent->qty}}" autocomplete="off" size="2">
									<button type = "submit" class="btn btn-default " > Change </button>
								</form>
									
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$cartcontent->qty * $cartcontent->price}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('/remove_cart_item/{$cartcontent->rowId}')}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endif
						@endforeach
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> 

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you would like to estimate your delivery cost or Check Out.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							
							
							<li>
								<input type="checkbox">
								<label>Estimate Delivery Costs</label>
							</li>
						</ul>
						<ul class="user_info">
							
							<li class="single_field">
								<label>LGA</label>
								<select class="lga">
									<option value="Barkin Ladi">Barkin Ladi</option>
                                    <option value="Bassa">Bassa</option>
                                    <option value="Bokkos">Bokkos</option>
                                    <option value="Jos-East">Jos-East</option>
                                    <option value="Jos-North">Jos-North</option>
                                    <option value="Jos-South" selected>Jos-South</option>
                                    <option value="Kanam">Kanam</option>
                                    <option value="Kanke">Kanke</option>
                                    <option value="Langtang-North">Langtang-North</option>
                                    <option value="Langtang-South">Langtang-South</option>
                                    <option value="Mangu">Mangu</option>
                                    <option value="Mikang">Mikang</option>
                                    <option value="Qua'anpan">Qua'an Pan</option>
                                    <option value="Ryom">Ryom</option>
                                    <option value="Shendam">Shendam</option>
                                    <option value="Wasse">Wasse</option>
								</select>
							
							</li>
							
						</ul>
						<a class="btn btn-default update" id = "get_quotes" href="">Get Quotes</a>
						@if(Auth::user())
							<a class="btn btn-default check_out" href="/user/checkout">Continue</a>
						@else
							<a class="btn btn-default check_out" href="/guest/checkout">Continue</a>
						@endif
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>N {{Cart::subtotal()}}</span></li>
							<li>Service Charge <span>N {{Cart::tax()}}</span></li>
							<li >Delivery Cost <span id="del_cost">N500</span></li>
							<li>Total <span id = "total_box"></span></li>
						</ul>
						@if(Auth::user())
							<a class="btn btn-default check_out" href="/user/checkout">Check Out</a>
						@else
							<a class="btn btn-default check_out" href="/guest/checkout">Check Out</a>
						@endif

					</div>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript">
	$(document).ready(function(){
		var deliverycost = 500;
		var cart_total = "{{Cart::total()}}";
		var carttotal = cart_total.replace(',', '');
		$("#get_quotes").click(function(){
		 var lga = 	$('.lga').val();
		 if(lga != "Jos-East" || lga != "Jos-South" || lga != "Jos-North"){
		 	var deliverycost = 1000;
		 	$('#del_cost').html("N"+deliverycost);
		 	var total = parseInt(deliverycost)  + parseInt(carttotal) ;
		 	$('#total_box').html("N"+parseInt(total, 10));
		 }
		});

		
		var total = parseInt(deliverycost)  + parseInt(carttotal) ;
		$('#total_box').html("N"+total);
		$('#del_cost').html("N"+deliverycost);
	});

	</script>
@endsection