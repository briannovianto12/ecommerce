<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImage;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestSeller;
use App\Mail\UserSeller;

class IndexController extends Controller
{
    public function index(){

        $categories = Category::orderBy('category_name_en','ASC')->get();    
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $products = Product::where('status',1)->orderBy('id','DESC')->limit(10)->get();
        $featured = Product::where('featured',1)->orderBy('id','DESC')->limit(10)->get();
        $hot_deals = Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(10)->get();
        
        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->limit(10)->get();

        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status',1)->where('category_id',$skip_category_1->id)->orderBy('id','DESC')->limit(10)->get();

        $skip_category_2 = Category::skip(2)->first();
        $skip_product_2 = Product::where('status',1)->where('category_id',$skip_category_2->id)->orderBy('id','DESC')->limit(10)->get();

        $skip_category_3 = Category::skip(3)->first();
        $skip_product_3 = Product::where('status',1)->where('category_id',$skip_category_3->id)->orderBy('id','DESC')->limit(10)->get();

        $skip_category_4 = Category::skip(4)->first();
        $skip_product_4 = Product::where('status',1)->where('category_id',$skip_category_4->id)->orderBy('id','DESC')->limit(10)->get();

        $skip_category_5 = Category::skip(5)->first();
        $skip_product_5 = Product::where('status',1)->where('category_id',$skip_category_5->id)->orderBy('id','DESC')->limit(10)->get();

        $skip_category_6 = Category::skip(6)->first();
        $skip_product_6 = Product::where('status',1)->where('category_id',$skip_category_6->id)->orderBy('id','DESC')->limit(10)->get();



        return view('frontend.index',compact('categories','sliders','products','featured','hot_deals','skip_category_0','skip_product_0','skip_category_1','skip_product_1','skip_category_2','skip_product_2','skip_category_3','skip_product_3','skip_category_4','skip_product_4','skip_category_5','skip_product_5','skip_category_6','skip_product_6'));
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
        
        $color_en = $product->product_color_en;
        $product_color_en = explode(',',$color_en);

        $color_ind = $product->product_color_ind;
        $product_color_ind = explode(',',$color_ind);

        $size_en = $product->product_size_en;
        $product_size_en = explode(',',$size_en);

        $size_ind = $product->product_size_ind;
        $product_size_ind = explode(',',$size_ind);
        
        $multiImage = MultiImage::where('product_id',$id)->get();
        return view('frontend.product.product_details',compact('product','multiImage','product_color_en','product_color_ind','product_size_en','product_size_ind'));
    }

    public function SubCategorySidebar($subcat_id,$slug){

        $products = Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(9);
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $breadsubcat = SubCategory::with(['category'])->where('id',$subcat_id)->get();

        return view('frontend.product.subcategory_view',compact('products','categories','breadsubcat'));
    }

    public function ProductViewAjax($id){
        $product = Product::findOrFail($id);
        $product = Product::with('category')->findOrFail($id);
        
        $color = $product->product_color_en;
        $product_color = explode(',',$color);

        $size = $product->product_size_en;
        $product_size = explode(',',$size);

        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ));
    }

    public function AddToCart(Request $request, $id){

    	$product = Product::findOrFail($id);

    	if ($product->discount_price == NULL) {
    		Cart::add([
    			'id' => $id, 
    			'name' => $request->product_name, 
    			'qty' => $request->quantity, 
    			'price' => $product->selling_price,
    			'weight' => 1, 
    			'options' => [
    				'image' => $product->product_thumbnail,
    				'color' => $request->color,
    				'size' => $request->size,
    			],
    		]);

    		return response()->json(['success' => 'Successfully Added on Your Cart']);

    	}else{

    		Cart::add([
    			'id' => $id, 
    			'name' => $request->product_name, 
    			'qty' => $request->quantity, 
    			'price' => $product->selling_price - $product->discount_price,
    			'weight' => 1, 
    			'options' => [
    				'image' => $product->product_thumbnail,
    				'color' => $request->color,
    				'size' => $request->size,
    			],
    		]);
    		return response()->json(['success' => 'Successfully Added on Your Cart']);
    	}

    } // end mehtod
    
    public function ProductSearch(Request $request){

        $item = $request->search;
        $products = Product::where('product_name_en','LIKE',"%$item%")->get();
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('frontend.product.search',compact('products','categories'));

    }

    public function RequestSeller(){
        return view('frontend.request_seller');

    }

    public function BecomeSeller(Request $request){
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];
        
        Mail::to('support@bmart.com')->send(new RequestSeller($data));
        Mail::to($request->email)->send(new UserSeller($data));

        $notification = array(
            'message' => 'Your Request Successfully Submited, Waiting Approved by Admin',
            'alert-type' => 'success'
        );

        return redirect()->to('/')->with($notification);

    }

}
