@extends('frontend.main_master')
@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ url('/') }}">Home</a></li>
				<li class='active'>Login</li>
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
	<h4 class="text-center ">Sign in</h4>
	<p class="text-center ">Don't Have a B-Mart Account ? <a href="{{ route('register') }}"> Register</a></p>
    <br>
    <form method="POST" action="{{ isset($guard) ? url($guard.'/login') :  route('login') }}">
        @csrf
        <div class="col-md-6 col-md-6"style="float:none;margin:auto;">
            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                <input type="email" id="email" name="email" class="form-control unicase-form-control text-input"  >
            </div>
            <div class="form-group">
                <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                <input type="password" id="password" name="password" class="form-control unicase-form-control text-input"  >
            </div>
            <div class="radio outer-xs">
                <a href="{{ route('password.request') }}" class="forgot-password pull-right">Forgot your Password?</a>
            </div>
            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
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