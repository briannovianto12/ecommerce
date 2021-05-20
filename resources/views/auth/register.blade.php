@extends('frontend.main_master')
@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
				<li class='active'>Register</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->			

<!-- create a new account -->

<div class=" create-new-account">
	<h4 class="checkout-subtitle text-center ">Create a new account</h4>
    <p class="text-center ">Already have an B-Mart Account ?<a href="{{ route('login') }}"> Sign in</a></p>
    <br>
	<form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="col-md-6 col-md-6"style="float:none;margin:auto;">
            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                <input type="text" id="name" name="name" class="form-control unicase-form-control text-input" >
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
                <input type="email" id="email" name="email" class="form-control unicase-form-control text-input" >
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Phone Number <span>*</span></label>
                <input type="text" id="phone" name="phone" class="form-control unicase-form-control text-input"  >
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
                <input type="password" id="password" name="password" class="form-control unicase-form-control text-input"  >
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control unicase-form-control text-input" >
                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
        </div>
	</form>
</div>

<!-- create a new account -->			</div><!-- /.row -->
		</div><!-- /.sigin-in-->
	</div><!-- /.container -->
</div><!-- /.body-content -->
<br><br>





@endsection