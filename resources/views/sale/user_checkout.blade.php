@extends('layouts.app')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{url('/')}}">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div>	

			<div class="step-one">
				<h2 class="heading">Step 1</h2>
			</div>
			
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div id = "shopper-info" class="shopper-info">

							
							<p>Shopper Information| Delivery Address</p>
							<table class = 'table table-striped'><tr><th>Name</th><td>{{Auth::user()->name}}</td></tr>
							<tr><th>Email</th><td>{{Auth::user()->email}}</td></tr>
							<tr><th>Phone</th><td>{{Auth::user()->phone}}</td></tr>
							<tr><th>Address</th><td>{{$address->address}} , {{$address->landmark}} , {{$address->LGA}} </br> {{$address->state}} </td></tr>
							</table>
							<a href="/profile" class="btn btn-primary">Edit</a>
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
								
								<form action="/edit_cart/{{$cartcontent->rowId}}" method="post" class="form-inline">
								{{csrf_field()}}
									<div class="form-group"><input class="form-control" type="text" name="quantity" value="{{$cartcontent->qty}}" autocomplete="off" size="2"></div>
									<div class="form-group"><button type = "submit" class="form-control btn btn-primary" > Change </button></div>
									
								</form>
									
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$cartcontent->qty * $cartcontent->price}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('/remove_cart_item', $cartcontent->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endif
						@endforeach
						@endforeach
							<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>N{{ Cart::subtotal()}}</td>
									</tr>
									<tr>
										<td>Service Charge</td>
										<td>N{{ Cart::tax()}}</td>
									</tr>
									<tr class="shipping-cost">
										<td>Delivery Cost</td>
										<td id = "del_cost">N{{$delivery_cost}}</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span id = "total_box">N{{Cart::total()}}</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		<div class="payment-options">
					<span>
						<form >
							  <script src="https://js.paystack.co/v1/inline.js"></script>
							  <button type="button"  class="btn btn-primary" onclick="payWithPaystack()"> Pay </button> 
							</form>
			         		
					</span>
					
				</div>
		</div>
	</section>
	<script type="text/javascript">
	//paystack function
								function payWithPaystack(){
									$.ajax({
										url: '/user/store_price',
										type: 'post',
										dataType: 'json',
										data : { 'total' : localStorage.total, '_token' : '{{csrf_token()}}'}, success: function(data){
											console.log(data);
											localStorage.transaction_id = data.id;
											alert(localStorage.total);
										}
									});
								    var handler = PaystackPop.setup({
									      key: 'pk_test_5ca73203906ff3af038640b1b10ad423240d7caf',
									      email: "{{Auth::user()->email}}",
									      amount: localStorage.total * 100,
									      ref: localStorage.transaction_id,

									      metadata: {
								         custom_fields: [
								            {
								                display_name: "Mobile Number",
								                variable_name: "mobile_number",
								                value: "{{Auth::user()->phone}}",
								            }
								         ]
								      },
								      callback: function(response){
								          //alert('success. transaction ref is ' + response.reference);
								          var url = '{{ route("record_sale", ":id") }}';
											url = url.replace(':id', response.reference);
								           window.location= url;
								      },
								      onClose: function(){
								          alert('window closed');
								      }
								    });
								    handler.openIframe();
								  }
	$(document).ready(function(){
		
		var cart_total = "{{Cart::total()}}";
		var carttotal = cart_total.replace(',', '');
		var delivery_cost = "{{$delivery_cost}}";
		var total = parseInt(delivery_cost)  + parseFloat(carttotal) ;
		$('#total_box').html("N"+parseFloat(total));
		localStorage.total = parseInt(total);
		


		
});
	</script>
	
@endsection