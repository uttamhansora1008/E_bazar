<!DOCTYPE html>
<html>
@include('frontend.header')
<style>
	.checked {
		color: orange;
	}
</style>
<!-- Button to Open the Modal -->
<!-- The Modal -->
<div class="modal" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{url('/add-rating')}}" method="POST">
				@csrf
				<input type="hidden" name="product_id" value="{{$product->id}}">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Rate {{$product->name}}</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<div class="rating1">
						<span class="starRating">
						@if($user_rating)
						@for($i=1; $i<= $user_rating->stars_rated; $i++)
							<input id="rating{{$i}}" type="radio" name="product_rating" checked value="{{$i}}">
							<label for="rating{{$i}}">5</label>
							@endfor
							@for($j = $user_rating->stars_rated+1; $j <=5; $j++)
							<input id="rating{{$j}}" type="radio" name="product_rating" value="{{$j}}">
							<label for="rating{{$j}}">4</label>
							@endfor
							@else
							<input id="rating3" type="radio" name="product_rating" value="3" >
							<label for="rating3">3</label>
							<input id="rating2" type="radio" name="product_rating" value="2">
							<label for="rating2">2</label>
							<input id="rating1" type="radio" name="product_rating" value="1">
							<label for="rating1">1</label>
							@endif
						</span>
					</div>
				</div>
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- breadcrumbs -->
<div class="breadcrumbs">
	<div class="container">
		<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
			<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
			<li class="active">Product detail</li>
		</ol>
	</div>
</div>
<!-- //breadcrumbs -->
<!-- single -->
<div class="single">
	<div class="container">
		<div class="col-md-4 products-left">
			{{-- <div class="filter-price animated wow slideInUp" data-wow-delay=".5s">
					<h3>Filter By Price</h3>
					<ul class="dropdown-menu1">
							<li><a href="">
							<div id="slider-range"></div>
							<input type="text" id="amount" style="border: 0" />
							</a></li>
					</ul>
						<script type='text/javascript'>//<![CDATA[
						$(window).load(function(){
						 $( "#slider-range" ).slider({
								range: true,
								min: 0,
								max: 100000,
								values: [ 10000, 60000 ],
								slide: function( event, ui ) {  $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
								}
					 });
					$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );


						});//]]>
						</script>
						<script type="text/javascript" src="js/jquery-ui.min.js"></script>
					 <!---->
				</div>
				<div class="categories animated wow slideInUp" data-wow-delay=".5s">
					<h3>Categories</h3>
					<ul class="cate">
						<li><a href="products.html">Best Selling</a> <span>(15)</span></li>
						<li><a href="products.html">Home Collections</a> <span>(16)</span></li>
							<ul>
								<li><a href="products.html">Cookware</a> <span>(2)</span></li>
								<li><a href="products.html">New Arrivals</a> <span>(0)</span></li>
								<li><a href="products.html">Home Decore</a> <span>(1)</span></li>
							</ul>
						<li><a href="products.html">Decorations</a> <span>(15)</span></li>
							<ul>
								<li><a href="products.html">Wall Clock</a> <span>(2)</span></li>
								<li><a href="products.html">New Arrivals</a> <span>(0)</span></li>
								<li><a href="products.html">Lighting</a> <span>(1)</span></li>
								<li><a href="products.html">Top Brands</a> <span>(0)</span></li>
							</ul>
					</ul>
				</div> --}}
			{{-- <div class="men-position animated wow slideInUp" data-wow-delay=".5s">
					<a href="single.html"><img src="images/29.jpg" alt=" " class="img-responsive" /></a>
					<div class="men-position-pos">
						<h4>Summer collection</h4>
						<h5><span>55%</span> Flat Discount</h5>
					</div>
				</div> --}}
		</div>
		<div class="col-md-8 single-right">
			<div class="col-md-5 single-right-left animated wow slideInUp" data-wow-delay=".5s">
				<div class="flexslider">
					<ul class="slides">
                    @foreach ($product->image as $item) 
						<li data-thumb="{{ URL::asset('/storage/image/'.$item->image)}}">
						<div class="thumb-image"> <img src="{{ URL::asset('/storage/image/'.$item->image)}}" data-imagezoom="true" class="img-responsive"> </div>
						</li>
					@endforeach
					</ul>
				</div>
				<!-- flixslider -->
				<script defer src="{{ asset('frontend/js/jquery.flexslider.js') }}"></script>
				<link rel="stylesheet" href="{{ asset('frontend/css/flexslider.css') }}" type="text/css" media="screen" />
				<script>
					// Can also be used with $(document).ready()
					$(window).load(function() {
						$('.flexslider').flexslider({
							animation: "slide",
							controlNav: "thumbnails"
						});
					});
				</script>
				<!-- flixslider -->
			</div>
			<div class="col-md-7 single-right-left simpleCart_shelfItem animated wow slideInRight" data-wow-delay=".5s">
				<h3>{{$product->name}}</h3><br>
				 <span class="item_price" style="text-decoration: line-through">{{$product->price}}</span>
				<h4> {{$p = $product->price - (($product->price * $product->discount) / 100)}} </h4>
				@php $ratenum = number_format($rating_value) @endphp
				<div class="rating">
					@for($i=1; $i<= $ratenum; $i++) <i class="fa fa-star checked"></i>
						@endfor
						@for($j =$ratenum+1; $j <=5; $j++) <i class="fa fa-star"></i>
							@endfor
							<span>
								@if($ratings->count() >0)
								{{$ratings->count()}}Ratings
								@else
								No Rating
								@endif
							</span>
				</div>
				<div class="description">
					<h5><i>Description:</i></h5>
					<p>{{$product->description}}</p><br>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
						Rate this Product
					</button>
				</div>
				<div class="color-quality">
					<div class="clearfix"> </div>
				</div>
				<div class="occasion-cart">
					<a class="item_add" href="{{url('cart-Addsave/'.$product->id)}}">add to cart </a>
				</div>
				<div class="social">
					<div class="social-left">
						<p>Share On :</p>
				</div>
					<div class="social-right">
						<ul class="social-icons">
							<li><a href="#" class="facebook"></a></li>
							<li><a href="#" class="twitter"></a></li>
							<li><a href="#" class="g"></a></li>
							<li><a href="#" class="instagram"></a></li>
						</ul>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="clearfix"> </div>
			<div class="bootstrap-tab animated wow slideInUp" data-wow-delay=".5s">
				<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs" role="tablist">
						
						<li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Add Your Reviews</a></li>
						<li role="presentation" class="dropdown">
							<a href="#dropdown1" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents">Information <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
								<li><a href="#dropdown1" tabindex="-1" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1">cleanse</a></li>
								<li><a href="#dropdown2" tabindex="-1" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2">fanny</a></li>
							</ul>
						</li>
					</ul>
					<div id="myTabContent" class="tab-content">
						
						<div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="profile" aria-labelledby="profile-tab">
							<div class="bootstrap-tab-text-grids">
								
								<div class="add-review">
								
									<form action="{{route('review')}}" method="POST">
									@csrf
									<input type="hidden" name="product_id" value="{{$product->id}}">
									
										<div class="form-group mb-3">
                              <label for="">Name:</label>
                              <input type="text" name="name" class=" @error('name') is-invalid @enderror form-control">
                              @error('name')
                              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group mb-3">
                              <label for="">Email:</label>
                              <input type="text" name="email" class=" @error('email') is-invalid @enderror form-control">
                              @error('email')
                              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                              @enderror
                          </div>
						  <div class="form-group mb-3">
                              <label for="">Subject:</label>
                              <input type="text" name="subject" class=" @error('subject') is-invalid @enderror form-control">
                              @error('subject')
                              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                              @enderror
                          </div>
						  <div class="form-group mb-3">
                              <label for="">Message:</label>
                              <textarea type="text" name="message" class=" @error('message') is-invalid @enderror form-control"></textarea>
                              @error('message')
                              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group mb-3">
                              <button type="submit" class="btn btn-primary">Send</button>
							
                          </div>
									</form>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="dropdown1" aria-labelledby="dropdown1-tab">
							<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
						</div>
						<div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="dropdown2" aria-labelledby="dropdown2-tab">
							<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
<!-- //single -->
<!-- single-related-products -->

<!-- //single-related-products -->
@include('frontend.footer')
<!-- zooming-effect -->
<script src="{{asset('frontend/js/imagezoom.js')}}"></script>
<!-- //zooming-effect -->
</body>

</html>