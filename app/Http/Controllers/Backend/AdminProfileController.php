<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use Carbon\Carbon;


class AdminProfileController extends Controller
{
    
    public function AdminProfile(){

        $id = Auth::user()->id;
		$adminData = Admin::find($id);
        return view('admin.admin_profile_view',compact('adminData'));

    }

    public function AdminProfileEdit(){

        $id = Auth::user()->id;
		$editData = Admin::find($id);
        return view('admin.admin_profile_edit',compact('editData'));
    }

    public function AdminProfileStore(Request $request){

        $admin_id = $request->id;
    	$old_img = $request->old_image;

        if($request->file('profile_photo_path')){
            unlink($old_img);
            $image = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(225,225)->save('upload/admin_images/'.$name_gen);
            $save_url = 'upload/admin_images/'.$name_gen;
        
            Admin::findOrFail($admin_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'profile_photo_path' => $save_url,
                'updated_at' => Carbon::now(),
        
            ]);
            
            $notification = array(
                'message' => 'Admin Profile Updated Succesfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('admin.profile')->with($notification);

        }else{
            Admin::findOrFail($admin_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'updated_at' => Carbon::now(),
        
            ]);
            $notification = array(
                'message' => 'Admin Profile Updated Succesfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('admin.profile')->with($notification);
        }

    } 

    public function AdminChangePassword(){

        return view('admin.admin_change_password');
    }

    public function AdminPasswordUpdate(Request $request){

        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);
        
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword,$hashedPassword)) {
            $admin = Admin::find(Auth::id());
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        }else{
            return redirect()->back();
        }

    }
}
