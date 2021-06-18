<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Pipeline;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\AttemptToAuthenticate;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;
use App\Http\Responses\LoginResponse;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\Admin;
use Carbon\Carbon;
use Image;
use Auth;

class AdminController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function loginForm(){
        return view('auth.admin_login', ['guard' => 'admin']);
    }

    /**
     * Show the login view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LoginViewResponse
     */
    public function create(Request $request): LoginViewResponse
    {
        return app(LoginViewResponse::class);
    }

    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        return $this->loginPipeline($request)->then(function ($request) {
            return app(LoginResponse::class);
        });
    }

    /**
     * Get the authentication pipeline instance.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Pipeline\Pipeline
     */
    protected function loginPipeline(LoginRequest $request)
    {
        if (Fortify::$authenticateThroughCallback) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                call_user_func(Fortify::$authenticateThroughCallback, $request)
            ));
        }

        if (is_array(config('fortify.pipelines.login'))) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                config('fortify.pipelines.login')
            ));
        }

        return (new Pipeline(app()))->send($request)->through(array_filter([
            config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
            Features::enabled(Features::twoFactorAuthentication()) ? RedirectIfTwoFactorAuthenticatable::class : null,
            AttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LogoutResponse
     */
    public function destroy(Request $request): LogoutResponse
    {
        $this->guard->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return app(LogoutResponse::class);
    }


    public function UserView(){
		$users = User::latest()->get();
		return view('backend.user.all_user',compact('users'));
	}

    public function UserEdit($id){

    	$users = User::findOrFail($id);
    	return view('backend.user.user_edit',compact('users'));

    }

    public function UserUpdate(Request $request){

    	$users_id = $request->id;
    	$old_img = $request->old_image;

    	if ($request->file('profile_photo_path')) {
        $file = $request->file('profile_photo_path');
        @unlink(public_path('upload/user_images/'.$data->profile_photo_path));
        $filename = date('YmdHi').$file->getClientOriginalName(); //generate uniqe name
        $file->move(public_path('upload/user_images'),$filename);


	User::findOrFail($users_id)->update([
		'name' => $request->name,
		'email' => $request->email,
		'phone' => $request->phone,
		'profile_photo_path' => $filename,
		'updated_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'User Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('all.users')->with($notification);

    	}else{

        User::findOrFail($users_id)->update([
		'name' => $request->name,
		'email' => $request->email,
		'phone' => $request->phone,
		'updated_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'User Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('all.users')->with($notification);

    	} // end else 

    } // end method 


    public function UserDelete($id){

		$users = User::findOrFail($id);
		User::findOrFail($id)->delete();

		$notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);

	}

    public function SellerView(){

        $seller = Admin::where('type',2)->latest()->get();
        return view('backend.seller.seller_view',compact('seller'));

    }

    public function AddSellerRole(){
        return view('backend.seller.seller_role_create');

    }

    public function SellerStore(Request $request){

        $image = $request->file('profile_photo_path');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(225,225)->save('upload/admin_images/'.$name_gen);
    	$save_url = 'upload/admin_images/'.$name_gen;

	Admin::insert([
		'name' => $request->name,
		'email' => $request->email,
		'password' => Hash::make($request->password),
		'phone' => $request->phone,
		'category' => $request->category,
		'product' => $request->product,
		'slider' => $request->slider,
		'review' => $request->review,
		'orders' => $request->orders,
		'alluser' => $request->alluser,
		'adminrole' => $request->adminrole,
		'type' => 2,
		'profile_photo_path' => $save_url,
		'created_at' => Carbon::now(),
		 

    	]);

	    $notification = array(
			'message' => 'Seller Created Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('all.seller')->with($notification);
    }

    public function SellerEdit($id){

    	$seller = Admin::findOrFail($id);
    	return view('backend.seller.seller_edit',compact('seller'));

    }

    public function SellerUpdate(Request $request){

    	$admin_id = $request->id;
    	$old_img = $request->old_image;

    	if ($request->file('profile_photo_path')) {

    	unlink($old_img);
    	$image = $request->file('profile_photo_path');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(225,225)->save('upload/admin_images/'.$name_gen);
    	$save_url = 'upload/admin_images/'.$name_gen;

	Admin::findOrFail($admin_id)->update([
		'name' => $request->name,
		'email' => $request->email,

		'phone' => $request->phone,
		'category' => $request->category,
		'product' => $request->product,
		'slider' => $request->slider,
		'review' => $request->review,
		'orders' => $request->orders,
		'alluser' => $request->alluser,
		'adminrole' => $request->adminrole,
		'type' => 2,
		'profile_photo_path' => $save_url,
		'updated_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'Seller Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('all.seller')->with($notification);

    	}else{

    Admin::findOrFail($admin_id)->update([
		'name' => $request->name,
		'email' => $request->email,
		'phone' => $request->phone,
		'category' => $request->category,
		'product' => $request->product,
		'slider' => $request->slider,
		'review' => $request->review,
		'orders' => $request->orders,
		'alluser' => $request->alluser,
		'adminrole' => $request->adminrole,
		'type' => 2,
		'updated_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'Seller Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('all.seller')->with($notification);

    	} // end else 

    } // end method 

    public function SellerDelete($id){

        $adminimg = Admin::findOrFail($id);
        $img = $adminimg->profile_photo_path;
        // unlink($img);

        Admin::findOrFail($id)->delete();

        $notification = array(
			'message' => 'Seller Deleted Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);
    }

}
