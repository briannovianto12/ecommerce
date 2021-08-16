@extends('frontend.main_master')
@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ url('/') }}">Home</a></li>
				<li class='active'>Forgot Password</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content" style="margin-top: 100px;">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->			
<div class="sign-in">
	<h4 class="text-center ">Forgot Password</h4>
    <br>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="col-md-6 col-md-6"style="float:none;margin:auto;">
            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                <input type="email" id="email" name="email" class="form-control unicase-form-control text-input"  >
            </div>
            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Email Password Reset Link</button>
        </div>
	</form>					
</div>
<!-- Sign-in -->
	

		</div><!-- /.row -->
		</div><!-- /.sigin-in-->
	</div><!-- /.container -->
</div><!-- /.body-content -->
<br><br><br><br><br><br><br><br><br>





@endsection