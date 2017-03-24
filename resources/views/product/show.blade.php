@extends('layouts.app')
@section('content')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
				<div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                           Hair
                                        </a>
                                    </h4>
                                </div>
                                <div id="sportswear" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Nike </a></li>
                                            <li><a href="#">Under Armour </a></li>
                                            <li><a href="#">Adidas </a></li>
                                            <li><a href="#">Puma</a></li>
                                            <li><a href="#">ASICS </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                           Body
                                        </a>
                                    </h4>
                                </div>
                                <div id="mens" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Fendi</a></li>
                                            <li><a href="#">Guess</a></li>
                                            <li><a href="#">Valentino</a></li>
                                            <li><a href="#">Dior</a></li>
                                            <li><a href="#">Versace</a></li>
                                            <li><a href="#">Armani</a></li>
                                            <li><a href="#">Prada</a></li>
                                            <li><a href="#">Dolce and Gabbana</a></li>
                                            <li><a href="#">Chanel</a></li>
                                            <li><a href="#">Gucci</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#womens">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Face
                                        </a>
                                    </h4>
                                </div>
                                <div id="womens" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Fendi</a></li>
                                            <li><a href="#">Guess</a></li>
                                            <li><a href="#">Valentino</a></li>
                                            <li><a href="#">Dior</a></li>
                                            <li><a href="#">Versace</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="#">Nails</a></h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="#">Feet</a></h4>
                                </div>
                            </div>
                            
                        </div><!--/category-products-->
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2>Brands</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#"> <span class="pull-right">(50)</span>Tara</a></li>
                                    <li><a href="#"> <span class="pull-right">(56)</span>Sleek</a></li>
                                    <li><a href="#"> <span class="pull-right">(27)</span>Mac</a></li>
                                    <li><a href="#"> <span class="pull-right">(32)</span>Tara</a></li>
                                </ul>
                            </div>
                        </div><!--/brands_products-->
                        
                        
                        
                        <div class="shipping text-center"><!--shipping-->
                            <img src="images/home/shipping.jpg" alt="" />
                        </div><!--/shipping-->
                    
                    </div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{$product->image_url}}" alt="" />
								<h3>ZOOM</h3>
							</div>
						

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="{{URL::asset('images/product-details/new.jpg')}}" class="newarrival" alt="" />
								<h2>{{$product->name}}</h2>
								<p>Web ID: {{$product->id}}</p>
								<span>
									<span>NGN {{$product->price}}</span>
									<form class="form-vertical" method="post" action="/add_to_cart/{{$product->id}}">
										<label>Quantity:</label>
									
										{{csrf_field()}}
									<input type="text" value="1" />
									<button type="button" class="add_to_cart btn btn-default cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
									</form>
								</span>
								@if($product->quantity > 1)
								<p><b>Availability:</b> In Stock</p>
								@endif
								<p><b>Condition:</b> New</p>
								<p><b>Brand:</b> {{$product->brand}}</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" class="active" data-toggle="tab">Description</a></li>
								
								<li ><a href="#reviews" data-toggle="tab">Reviews </a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<div class="col-sm-12">
									<p>{{$product->description}}</p>
								</div>
							</div>
							
							
							
							
							
							<div class="tab-pane fade " id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									@foreach($similar1 as $similar1)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{$similar1->image_url}}" alt="" />
													<h2>NGN {{$similar1->price }}</h2>
													<p>{{$similar1->name}}</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
								<div class="item">	
									@foreach($similar2 as $similar2)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{$similar2->image_url}}" alt="" />
													<h2>NGN {{$similar2->price }}</h2>
													<p>{{$similar2->name}}</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
     //add item to cart using ajax
     $(document).ready(function(){
        $('.add_to_cart').click(function(e){
        	 e.preventDefault();
            $.ajax({
                url: '/add_to_cart/{{$product->id}}',
                type: 'post', 
                data: {'id' : '{{$product->id}}', '_token' : '{{ csrf_token() }}'}, success: function(data){
                    sweetAlert("Added to Cart!", "success");
                	$(".badge").html('{{Cart::count()}}');
                }
        });
     });
        	});
     </script>
	
@endsection