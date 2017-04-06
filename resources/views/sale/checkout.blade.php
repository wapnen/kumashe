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
			

			<div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div id = "shopper-info" class="shopper-info">

							
							<form method="post" action="/guest/store_guest" id="store_guest">
								{{ csrf_field()}}
                   				<input type="text" name="name" placeholder="Full Name" required>
								<input type="email" name = "email" placeholder="Email address" required>
								<input type="phone" name = "phone" placeholder="Phone" required>
								
                                <input id="address" type="address"  name="address" value="{{ old('address') }}" placeholder = "Address" required autofocus>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                         

                                <input id="text" type="text"  name="landmark" placeholder = "Opposite, Close to.." required>

                                @if ($errors->has('landmark'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('landmark') }}</strong>
                                    </span>
                                @endif


                        <div class="{{ $errors->has('LGA') ? ' has-error' : '' }}">
                            
                                <select name="LGA">
                                    <option disabled selected>Select Local Government Area</option>
                                    <option value="Barkin Ladi">Barkin Ladi</option>
                                    <option value="Bassa">Bassa</option>
                                    <option value="Bokkos">Bokkos</option>
                                    <option value="Jos-East">Jos-East</option>
                                    <option value="Jos-North">Jos-North</option>
                                    <option value="Jos-South">Jos-South</option>
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
                                @if ($errors->has('landmark'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('landmark') }}</strong>
                                    </span>
                                @endif

                        </div>
                        	<button  type="submit" name="submit" class="btn btn-primary">Checkout</button>
							</form>
							
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
							<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>N{{ Cart::total()}}</td>
									</tr>
									<tr>
										<td>Service Charge</td>
										<td>N{{ Cart::tax()}}</td>
									</tr>
									<tr class="shipping-cost">
										<td>Delivery Cost</td>
										<td id = "del_cost"></td>										
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
							  <button type="button"  class="btn btn-default" onclick="payWithPaystack()"> Pay </button> 
							</form>
			         		
					</span>
					
				</div>
		</div>
	</section>
	<script type="text/javascript">
	//paystack function
								function payWithPaystack(){
									$.ajax({
										url: '/guest/store_price',
										type: 'post',
										dataType: 'json',
										data : { 'total' : localStorage.total, 'transaction_id' : localStorage.transaction_id, '_token' : '{{csrf_token()}}'}, success: function(data){
										
										}
									});
								    var handler = PaystackPop.setup({
									      key: 'pk_test_5ca73203906ff3af038640b1b10ad423240d7caf',
									      email: localStorage.email,
									      amount: localStorage.total * 100,
									      ref: localStorage.transaction_id,
									      metadata: {
								         custom_fields: [
								            {
								                display_name: "Mobile Number",
								                variable_name: "mobile_number",
								                value: localStorage.phone
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
		
	

		$('#store_guest').submit(function(e){
			e.preventDefault();
			var name = $("input[name=name]").val();
			var email = $("input[name=email]").val();
			var phone = $("input[name=phone]").val();
			var address = $("input[name=address]").val();
			var landmark = $("input[name=landmark]").val();
			var LGA = $('select[name=LGA] option:selected').val();
			 $.ajax({
                url: '/guest/store_guest',
                type: 'post', 
                dataType: 'json',
                data: {'name' : name,'email' : email, 'phone' : phone ,'address' : address, 'landmark' : landmark, 'LGA' : LGA , '_token' : '{{ csrf_token()}}'}, success: function(data){
					console.log(data);
					$('#shopper-info').empty();
					$('#shopper-info').append("<p>Shopper Information| Delivery Address</p><table class = 'table table-striped'><tr><th>Name</th><td>"+data[0].name+"</td></tr><tr><th>Email</th><td>"+data[0].email+"</td></tr><tr><th>Phone</th><td>"+data[0].phone+"</td></tr><tr><th>Address</th><td>"+data[1].address+" "+data[1].landmark+" "+data[1].LGA+"</td></tr></table>");
                    if(data[1].LGA != "Jos-North" && data[1].LGA != "Jos-South" && data[1].LGA != "Jos-East" ){
                    	var deliverycost = 1000;
                    	$('#del_cost').html("N"+deliverycost);
					 	var total = parseInt(deliverycost)  + parseInt(carttotal) ;
					 	$('#total_box').html("N"+parseInt(total, 10));
                    }
                    else{
                    	var deliverycost = 500;
                    	$('#del_cost').html("N"+deliverycost);
					 	var total = parseInt(deliverycost)  + parseInt(carttotal) ;
					 	$('#total_box').html("N"+parseInt(total, 10));
                    }
                    //store ref in local storage
                    localStorage.transaction_id = data[2].id;
                    localStorage.email = data[0].email;
                    localStorage.phone = data[0].phone;
                    localStorage.total = total;
                }
                
		});

	});

		
});
	</script>
	
@endsection