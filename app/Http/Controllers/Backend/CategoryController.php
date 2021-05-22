<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class CategoryController extends Controller
{
    public function CategoryView(){

        $category = Category::latest()->get();
        return view ('backend.category.category_view',compact('category'));

    }

    public function CategoryStore(Request $request){

        $request->validate([
             'category_name_en' => 'required',
             'category_name_ind' => 'required',
             'category_icon' => 'required',
         ],[
             'category_name_en.required' => 'Input Category English Name',
             'category_name_ind.required' => 'Input Category Indonesia Name',
         ]);
 
          
 
    Category::insert([
        'category_name_en' => $request->category_name_en,
        'category_name_ind' => $request->category_name_ind,
        'category_slug_en' => strtolower(str_replace(' ', '-',$request->category_name_en)),
        'category_slug_ind' => strtolower(str_replace(' ', '-',$request->category_name_ind)),
        'category_icon' => $request->category_icon,

        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } 


    public function CategoryEdit($id){
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit',compact('category'));

    }


    public function CategoryUpdate(Request $request ,$id){

    Category::findOrFail($id)->update([
        'category_name_en' => $request->category_name_en,
        'category_name_ind' => $request->category_name_ind,
        'category_slug_en' => strtolower(str_replace(' ', '-',$request->category_name_en)),
        'category_slug_ind' => strtolower(str_replace(' ', '-',$request->category_name_ind)),
        'category_icon' => $request->category_icon,

        ]);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);

    } 


    public function CategoryDelete($id){

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } 

    public function SubCategoryView(){

    $categories = Category::orderBy('category_name_en','ASC')->get();
    $subcategory = SubCategory::latest()->get();
    return view ('backend.category.subcategory_view',compact('subcategory','categories'));

    }

    public function SubCategoryStore(Request $request){

    $request->validate([
            'category_id' => 'required', 
            'subcategory_name_en' => 'required',
            'subcategory_name_ind' => 'required',
        ],[
            'category_id.required' => 'Please Select Category',
            'subcategory_name_en.required' => 'Input SubCategory English Name',
            'subcategory_name_ind.required' => 'Input SubCategory Indonesia Name',
        ]);

        

    SubCategory::insert([
        'category_id' => $request->category_id,
        'subcategory_name_en' => $request->subcategory_name_en,
        'subcategory_name_ind' => $request->subcategory_name_ind,
        'subcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subcategory_name_en)),
        'subcategory_slug_ind' => strtolower(str_replace(' ', '-',$request->subcategory_name_ind)),

        ]);

        $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
    
    public function SubCategoryEdit($id){

        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view ('backend.category.subcategory_edit',compact('subcategory','categories'));

    }

    public function SubCategoryUpdate(Request $request){

        $subcat_id = $request->id;
        SubCategory::findOrFail($subcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_ind' => $request->subcategory_name_ind,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subcategory_name_en)),
            'subcategory_slug_ind' => strtolower(str_replace(' ', '-',$request->subcategory_name_ind)),
    
            ]);
    
            $notification = array(
                'message' => 'SubCategory Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.subcategory')->with($notification);
    
        }
    
    
        public function SubCategoryDelete($id){
    
            SubCategory::findOrFail($id)->delete();
    
            $notification = array(
                'message' => 'SubCategory Deleted Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        } 
}
