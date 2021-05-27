<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImage;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function index(){

        $categories = Category::orderBy('category_name_en','ASC')->get();    
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $products = Product::where('status',1)->orderBy('id','DESC')->limit(10)->get();
        $featured = Product::where('featured',1)->orderBy('id','DESC')->limit(10)->get();
        $hot_deals = Product::where('hot_deals',1)->orderBy('id','DESC')->limit(10)->get();

        return view('frontend.index',compact('categories','sliders','products','featured','hot_deals'));
    }

    public function UserLogout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function UserProfile(){
        
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile',compact('user'));
    }

    // Function Edit User Profile
    public function UserProfileStore(Request $request){

        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/user_images/'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName(); //generate uniqe name
            $file->move(public_path('upload/user_images'),$filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Succesfully',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);

    }

    public function UserChangePassword(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_change_password',compact('user'));
    }

    public function UserPasswordUpdate(Request $request){

        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword,$hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        }else{
            return redirect()->back();
        }
    }

    public function EnglishLanguage(){

        session()->get('language');
        session()->forget('language');
        Session::put('language','english');
        return redirect()->back();
    }

    public function IndonesiaLanguage(){

        session()->get('language');
        session()->forget('language');
        Session::put('language','indonesia');
        return redirect()->back();
    }

    public function ProductDetails($id,$slug){

        $product = Product::findOrFail($id);
        $multiImage = MultiImage::where('product_id',$id)->get();
        return view('frontend.product.product_details',compact('product','multiImage'));
    }

}
