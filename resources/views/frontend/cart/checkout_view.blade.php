@extends('frontend.main_master')
@section('content')

@section('title')
My Checkout Page 
@endsection


<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
<div class="panel panel-default checkout-step-01">

	<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">		

                <h4 class=""><strong>SHIPPING DETAILS</strong></h4>	<hr>
				<div class="col-md-6 col-sm-6 already-registered-login">
					<form class="register-form" action="{{ route('checkout.store') }}" method="POST">
                        @csrf
						<div class="form-group">
                            <label class="info-title" for="exampleInputEmail1"><b>Name</b> <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Full Name"  required="">
					    </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1"><b>Email</b> <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Email"  required="">
					    </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1"><b>Phone Number</b> <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Phone Number"  required="">
					    </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1"><b>Address</b> <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Address" cols="30" rows="5" required=""></textarea>
					    </div>
				</div>	
				

				<!-- already-registered-login -->
				<div class="col-md-6 col-sm-6 already-registered-login">

                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1"><b>City</b><span class="text-danger">*</span></label>
                            <input type="text" name="city" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="City"  required="">
					    </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1"><b>Province</b><span class="text-danger">*</span></label>
                            <input type="text" name="province" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Province" required="">
					    </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1"><b>Post Code</b><span class="text-danger">*</span></label>
                            <input type="text" name="post_code" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Post Code" required="">
					    </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1"><b>Notes</b> </label>
                            <textarea name="notes" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Notes" cols="30" rows="5" ></textarea>
					    </div>
					
				</div>	
				<!-- already-registered-login -->		

			</div>			
		</div>
		<!-- panel-body  -->
    
	</div><!-- row -->
</div>
<!-- End checkout-step-01  -->
<div class="panel panel-default checkout-step-01">

	<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">		
                <h4 class=""><strong>YOUR CHECKOUT PROGRESS</strong></h4>
                
				@foreach($carts as $item)
                <div class="panel panel-default">
                    <div class="row">	
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <h5><strong>{{ $item->name }} </strong></h5>
                            </div>
                            <div class="form-group">
                                <img src="{{ asset($item->options->image) }}" style="height:120px; width:120px;">
                            </div>
                        </div>	
                        <div class="col-md-6 " style="margin-top:30px">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1"><b>Color :</b></label>
                                {{ $item->options->color }}
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1"><b>Size : </b></label>
                                {{ $item->options->size }}
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1"><b>Quantity : </b></label>
                                ({{ $item->qty }})
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1"><b>Subtotal :</b></label>
                                @currency($item->price * $item->qty )
                            </div>
                        </div>	
                    </div>	
                </div>
                @endforeach
			</div>			
		</div>
		<!-- panel-body  -->
    
	</div><!-- row -->
</div>
					  	
					</div><!-- /.checkout-steps -->
				</div>
				<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
<div class="checkout-progress-sidebar ">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	<h4 class="unicase-checkout-title">Shopping Summary</h4>
		    </div>
		    <div class="">
				<ul class="nav nav-checkout-progress list-unstyled">
                        <li>
                            <h5><strong>Total: </strong> <span style="text-align: right;">@currency($cartTotal)</span> </h5> 
                        </li>
                        <li>
                            <h5><strong>Shipping Charge: </strong>  <span style="text-align: right;">@currency(10000)</span> </h5>  <hr>
                        </li>
                        <li>
                            <h4><strong>Grand Total: </strong> <span style="text-align: right;">@currency($cartTotal + 10000)</span> </h4>  <hr>
                        </li>
                </ul>		
			</div>
		</div>
	</div>
</div> 

<div class="checkout-progress-sidebar ">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	<h4 class="unicase-checkout-title">Select Payment Method</h4>
		    </div>


		    <div class="row">

		    	<div class="col-md-6">
                    <label for="">Stripe</label> 		
                    <input type="radio" name="payment_method" value="stripe">	<br>
                    <img src="{{ asset('frontend/assets/images/payments/4.png') }}">    		
                </div> <!-- end col md 4 -->

		    	<div class="col-md-6">
		    		<label for="">Cash</label> 		
                    <input type="radio" name="payment_method" value="cash">	<br>
		            <img src="{{ asset('frontend/assets/images/payments/7.png') }}">  		
		    	</div> <!-- end col md 4 -->


			</div> <!-- // end row  -->
<hr>
  <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Continue Payment</button>


		</div>
	</div>
</div> 
<!-- checkout-progress-sidebar -->				</div>
</form>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
	</div><!-- /.container -->
</div><!-- /.body-content -->


@endsection