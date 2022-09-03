<!DOCTYPE html>
<html>
@include('frontend.header')

<!-- breadcrumbs -->
<div class="breadcrumbs">
	<div class="container">
		<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
			<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
			<li class="active">Checkout Page</li>
		</ol>
	</div>
</div>
<!-- //breadcrumbs -->
<!-- checkout -->
<div class="checkout">
	<div class="container">
		<h3 class="animated wow slideInLeft" data-wow-delay=".5s">Your shopping cart contains:</h3>
		<div class="checkout-right animated wow slideInUp" data-wow-delay=".5s">
			<table class="timetable_sub">
				<thead>
					<tr>
						<th>Product</th>
						<th>Product Name</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>total price</th>
						<th>Remove</th>
					</tr>
				</thead>
				@php $total=0; @endphp
				
				@foreach ( $cart_list as $id => $details)
				
				<tr data-id="{{ $id }}">
					<td data-th="Product">
						<div class="row">
						<?php
							$product=\App\Models\Product::where('id',$details->product_id)->first();
							?>
							<div class="col-sm-3 hidden-xs"><img src="{{URL::asset('/storage/image/'.$product->image[0]->image)}}" width="200" height="200" class="img-responsive" /></div>
						</div>
					</td>
					<td>
						<div class="col-sm-9">	
							<h4 class="nomargin">{{ $product->name }}</h4>
						</div>
					</td>
					<td data-th="Price">{{$p = $product->price - (($product->price * $product->discount) / 100)}}</td>
					<td class="invert">
                            <div class="quantity"> 
                                <div class="quantity-select">   
                                    <a href="{{url('/cart-updateminus/'.$details->id)}}">
                                        <div class="entry value-minus">&nbsp;</div>
                                    </a>

                                    <div class="entry value"><span><?= $details->quantity ?></span></div>
                                    <a href="{{url('/cart-updateplus/'.$details->id)}}">
                                        <div class="entry value-plus">&nbsp;</div>
                                    </a>
                                </div>
                            </div>
                        </td>
					<td data-th="Subtotal" class="text-center">
						{{$p * $details->quantity }}</td>
					
					<td class="invert">
                            <div class="rem">
                                
                                <a href="{{url('/cart-delete/'.$details->id)}}"><div class="close1"> </div></a>
                            </div>
                        </td>
				</tr>
				@php $total +=$p * $product->quantity ; @endphp		
				@endforeach
			</table>
		</div>
		 <div class="checkout-left">
<!-- 		 
			<div class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
				<h4>Total Price:{{$total}}</h4>
			</div>  -->
			<div class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
                <h4>Continue to basket</h4>
                <ul>
                    <?php
                    $t = 0;
                    foreach ($cart_list as $key => $cart) {
                        $p1 = ($cart->price * $cart->quantity);
                        $p2 = $p1 - (($p * $cart->discount) / 100);

                        $t += $p2;
                    }
                    ?>
                    <li>Total <span><?= $t ?></span></li>
                </ul>
            </div>
			<div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
				<a href="{{url('place-order')}}">Place Order</a>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div> 
@include('frontend.footer')

</body>

</html>
<script type="text/javascript">
  
    $(".update-cart").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: "{{ route('update.cart') }}",
            method: "get",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
 </script> 
 <script type="text/javascript">
	$(".cart_remove").click(function(e) {
		e.preventDefault();

		var ele = $(this);

		if (confirm("Do you really want to remove?")) {
			$.ajax({
				url: "{{ route('remove_from_cart') }}",
				method: "DELETE",
				data: {
					_token: '{{ csrf_token() }}',
					id: ele.parents("tr").attr("data-id")
				},
				success: function(response) {
					window.location.reload();
				}
			});
		}
	});
</script>
