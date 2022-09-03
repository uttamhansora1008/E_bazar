@include('frontend.header')
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Checkout Page</li>
        </ol>
    </div>
</div>


<p style="text-align:center "><img style="height: 360px;"src="{{asset('frontend/images/order-placed.gif')}}" alt="" class="center-block"></p> 
@include('frontend.footer')