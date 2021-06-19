@extends('frontend.main_master')
@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ url('/') }}">Home</a></li>
				<li class='active'>Request Seller</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->			
<div class="sign-in">
	<h4 class="text-center ">Request Seller</h4>
    <p class="text-center "> Fill the Form to Request Become a Seller</p>
    <br>
    <form method="POST" action="{{ route('become.seller') }}">
        @csrf
        <div class="col-md-6 col-md-6"style="float:none;margin:auto;">
            <div class="form-group">
                <label class="info-title" for="exampleInputPassword1">Username <span>*</span></label>
                <input type="text" id="name" name="name" class="form-control unicase-form-control text-input"  >
            </div>
            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                <input type="email" id="email" name="email" class="form-control unicase-form-control text-input"  >
            </div>
            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Phone Number <span>*</span></label>
                <input type="text" id="phone" name="phone" class="form-control unicase-form-control text-input"  >
            </div>
            <br>
            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Submit Request</button>
        </div>
	</form>					
</div>
<!-- Sign-in -->
	

		</div><!-- /.row -->
		</div><!-- /.sigin-in-->
	</div><!-- /.container -->
</div><!-- /.body-content -->
<br><br>





@endsection