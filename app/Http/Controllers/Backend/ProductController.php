<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MultiImage;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    
    public function AddProduct(){

        $categories = Category::latest()->get();
        return view('backend.product.product_add',compact('categories'));


    }
    
    public function ProductStore(Request $request){

        $image = $request->file('product_thumbnail');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(917,1000)->save('upload/products/thumbnail/'.$name_gen);
    	$save_url = 'upload/products/thumbnail/'.$name_gen;

        $product_id = Product::insertGetId([
      	'category_id' => $request->category_id,
      	'subcategory_id' => $request->subcategory_id,
      	'product_name_en' => $request->product_name_en,
      	'product_name_ind' => $request->product_name_ind,
      	'product_slug_en' =>  strtolower(str_replace(' ', '-', $request->product_name_en)),
      	'product_slug_ind' => strtolower(str_replace(' ', '-', $request->product_name_ind)),
      	'product_code' => $request->product_code,

      	'product_qty' => $request->product_qty,
      	'product_tags_en' => $request->product_tags_en,
      	'product_tags_ind' => $request->product_tags_ind,
      	'product_size_en' => $request->product_size_en,
      	'product_size_ind' => $request->product_size_ind,
      	'product_color_en' => $request->product_color_en,
      	'product_color_ind' => $request->product_color_ind,

      	'selling_price' => $request->selling_price,
      	'discount_price' => $request->discount_price,
      	'short_descp_en' => $request->short_descp_en,
      	'short_descp_ind' => $request->short_descp_ind,
      	'long_descp_en' => $request->long_descp_en,
      	'long_descp_ind' => $request->long_descp_ind,

      	'hot_deals' => $request->hot_deals,
      	'featured' => $request->featured,
      	'special_offer' => $request->special_offer,
      	'special_deals' => $request->special_deals,

      	'product_thumbnail' => $save_url,
      	'status' => 1,
      	'created_at' => Carbon::now(),   	 

      ]);

        //   Multiple Image
        $images = $request->file('multi_images');
        foreach ($images as $img){
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
    	    Image::make($img)->resize(917,1000)->save('upload/products/multi_image/'.$make_name);
    	    $uploadPath = 'upload/products/multi_image/'.$make_name;

            MultiImage::insert([
                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(), 
            ]);
        }
        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('manage.product')->with($notification);
    }
   
    public function ManageProduct(){

       $products = Product::latest()->get();
       return view('backend.product.product_view',compact('products'));
    }

	public function ProductEdit($id){

		$multiImgs = MultiImage::where('product_id',$id)->get();
		$categories = Category::latest()->get();
		$subcategory = SubCategory::latest()->get();
		$products = Product::findOrFail($id);
		return view('backend.product.product_edit',compact('categories','subcategory','products','multiImgs'));

	}

	public function ProductUpdate(Request $request){

		$product_id = $request->id;

		Product::findOrFail($product_id)->update([
			'category_id' => $request->category_id,
			'subcategory_id' => $request->subcategory_id,
			'product_name_en' => $request->product_name_en,
			'product_name_ind' => $request->product_name_ind,
			'product_slug_en' =>  strtolower(str_replace(' ', '-', $request->product_name_en)),
			'product_slug_ind' => strtolower(str_replace(' ', '-', $request->product_name_ind)),
			'product_code' => $request->product_code,
  
			'product_qty' => $request->product_qty,
			'product_tags_en' => $request->product_tags_en,
			'product_tags_ind' => $request->product_tags_ind,
			'product_size_en' => $request->product_size_en,
			'product_size_ind' => $request->product_size_ind,
			'product_color_en' => $request->product_color_en,
			'product_color_ind' => $request->product_color_ind,
  
			'selling_price' => $request->selling_price,
			'discount_price' => $request->discount_price,
			'short_descp_en' => $request->short_descp_en,
			'short_descp_ind' => $request->short_descp_ind,
			'long_descp_en' => $request->long_descp_en,
			'long_descp_ind' => $request->long_descp_ind,
  
			'hot_deals' => $request->hot_deals,
			'featured' => $request->featured,
			'special_offer' => $request->special_offer,
			'special_deals' => $request->special_deals,
			'status' => 1,
			'created_at' => Carbon::now(),   	 
  
		]);

		$notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('manage.product')->with($notification);
	}

	public function MultiImageUpdate(Request $request){

		$imgs = $request->multi_images;
		foreach ($imgs as $id => $img) {
			$imgDel = MultiImage::findOrFail($id);
			unlink($imgDel->photo_name);
    		$make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
    		Image::make($img)->resize(917,1000)->save('upload/products/multi_image/'.$make_name);
    		$uploadPath = 'upload/products/multi_image/'.$make_name;

			MultiImage::where('id',$id)->update([
				'photo_name' => $uploadPath,
				'updated_at' => Carbon::now(),
			]);
		}
		$notification = array(
            'message' => 'Product Image Updated Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);

	}

	public function MultiImageDelete($id){
		
		$oldimg = MultiImage::findOrFail($id);
		unlink($oldimg->photo_name);
		MultiImage::findOrFail($id)->delete();

		$notification = array(
            'message' => 'Product Image Deleted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);
	}

	public function ThumbnailImageUpdate(Request $request){
		
		$pro_id = $request->id;
		$oldImage = $request->old_img;
		unlink($oldImage);
		$image = $request->file('product_thumbnail');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(917,1000)->save('upload/products/thumbnail/'.$name_gen);
    	$save_url = 'upload/products/thumbnail/'.$name_gen;

		Product::findOrFail($pro_id)->update([
			'product_thumbnail' => $save_url,
			'updated_at' => Carbon::now(),
		]);

		$notification = array(
            'message' => 'Product Thumbnail Updated Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);

	}

	public function ProductInactive($id){
		
		Product::findOrFail($id)->update(['status' => 0]);

		$notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);

	}

	public function ProductActive($id){

		Product::findOrFail($id)->update(['status' => 1]);

		$notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);

	}

	public function ProductDelete($id){

		$product = Product::findOrFail($id);
		unlink($product->product_thumbnail);
		Product::findOrFail($id)->delete();

		$images = MultiImage::where('product_id',$id)->get();
		foreach ($images as $img) {
			unlink($img->photo_name);
			MultiImage::where('product_id',$id)->delete();
		}

		$notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);

	}

}
