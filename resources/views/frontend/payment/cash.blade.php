@extends('frontend.main_master')
@section('content')

@section('title')
Cash on Delivery Payment Page 
@endsection


<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Cash on Delivery</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-6">
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
                </div>
                <div class="col-md-6">
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Payment Method</h4>
                                </div>
                                <form action="{{ route('cash.order') }}" method="post" id="payment-form">
                                    @csrf
                                <div class="form-row">
                                    <img src="{{ asset('frontend/assets/images/payments/cash.png') }}">
                                    <label for="card-element">
                                    <input type="hidden" name="name" value="{{ $data['name'] }}">
                                    <input type="hidden" name="email" value="{{ $data['email'] }}">
                                    <input type="hidden" name="phone" value="{{ $data['phone'] }}">
                                    <input type="hidden" name="address" value="{{ $data['address'] }}">
                                    <input type="hidden" name="city" value="{{ $data['city'] }}">
                                    <input type="hidden" name="province" value="{{ $data['province'] }}">
                                    <input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
                                    <input type="hidden" name="notes" value="{{ $data['notes'] }}">
                                    </label>
                                </div>
                                <br>
                                <button class="btn btn-primary">Submit Payment</button>
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
	</div><!-- /.container -->
</div><!-- /.body-content -->

@endsection