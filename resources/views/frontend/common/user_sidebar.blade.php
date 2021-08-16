@php
    $id = Auth::user()->id;
    $user = App\Models\User::find($id);
@endphp

<div class="col-md-2"><br>
    <img class="card-img-top" style="border-radius: 50%" src="{{ (!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg') }}" height="100%" width="100%"><br><br>
    <ul class="list-group list-group flush">
        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">
            @if(session()->get('language') == 'indonesia' ) Profile Saya @else My Profile @endif </a>
        <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">
            @if(session()->get('language') == 'indonesia' ) Update Profile @else Update Profile @endif </a>
        <a href="{{ route('my.orders') }}" class="btn btn-primary btn-sm btn-block">
            @if(session()->get('language') == 'indonesia' ) Order Saya @else  My Order @endif</a>
        <a href="{{ route('user.change.password') }}" class="btn btn-primary btn-sm btn-block">
            @if(session()->get('language') == 'indonesia' ) Ganti Password @else  Change Password @endif </a>
        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">
            @if(session()->get('language') == 'indonesia' ) Keluar @else Logout @endif </a>
    </ul>                
</div>