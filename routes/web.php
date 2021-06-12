<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Models\User;


Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

// Admin Routes

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');


Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');

Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');

Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');

Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');

Route::post('/admin/password/update', [AdminProfileController::class, 'AdminPasswordUpdate'])->name('admin.password.update');



// User Routes

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard',compact('user'));
})->name('dashboard');

Route::get('/', [IndexController::class, 'index']);
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
Route::get('/user/change/password', [IndexController::class, 'UserChangePassword'])->name('user.change.password');
Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');

// Admin Category Routes

Route::prefix('category')->group(function(){

// All Category
Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');

Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');

Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');

Route::post('/update/{id}', [CategoryController::class, 'CategoryUpdate'])->name('category.update');

Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');

// Sub Category
Route::get('/sub/view', [CategoryController::class, 'SubCategoryView'])->name('all.subcategory');

Route::post('/sub/store', [CategoryController::class, 'SubCategoryStore'])->name('subcategory.store');

Route::get('/sub/edit/{id}', [CategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');

Route::post('/sub/update', [CategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');

Route::get('/sub/delete/{id}', [CategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');

Route::get('/subcategory/ajax/{category_id}', [CategoryController::class, 'GetSubCategory']);

});

// Admin Products Routes
Route::prefix('product')->group(function(){

    Route::get('/add', [ProductController::class, 'AddProduct'])->name('add.product');
    Route::post('/store', [ProductController::class, 'ProductStore'])->name('product.store');
    Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage.product');
    Route::get('/edit/{id}', [ProductController::class, 'ProductEdit'])->name('product.edit');
    Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
    Route::post('/update', [ProductController::class, 'ProductUpdate'])->name('product.update');
    Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update.product.image');
    Route::post('/thumbnail/update', [ProductController::class, 'ThumbnailImageUpdate'])->name('update.product.thumbnail');
    Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');
    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');
    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');
    Route::post('/new/image', [ProductController::class, 'ProductNewImage'])->name('new.product.image');
    
});

// Admin Slider Route
Route::prefix('slider')->group(function(){

    Route::get('/view', [SliderController::class, 'SliderView'])->name('slider.view');
    Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');
    Route::get('/edit/{id}', [SliderController::class, 'SliderEdit'])->name('slider.edit');
    Route::post('/update', [SliderController::class, 'SliderUpdate'])->name('slider.update');
    Route::get('/delete/{id}', [SliderController::class, 'SliderDelete'])->name('slider.delete');
    Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');
    Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');
});


// Frontend All Routes //

// Multi Language Route

Route::get('/language/english', [IndexController::class, 'EnglishLanguage'])->name('english.language');
Route::get('/language/indonesia', [IndexController::class, 'IndonesiaLanguage'])->name('indonesia.language');

// Frontend Product Details
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);

// Subcategory sidebar
Route::get('/subcategory/product/{subcat_id}/{slug}', [IndexController::class, 'SubCategorySidebar']);

// Product view Modal Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);


// Add to Cart Store Data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']); 

// Get Data from mini cart
Route::get('/product/mini/cart/', [CartController::class, 'AddMiniCart']);

// Remove mini cart
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);


Route::group(['prefix'=>'user','middleware' => ['user','auth'],'namespace'=>'User'],
function(){

    Route::get('/mycart', [CartController::class, 'MyCart'])->name('mycart');
    Route::get('/get-cart-product', [CartController::class, 'GetCartProduct']);
    Route::get('/cart-remove/{rowId}', [CartController::class, 'RemoveCart']);
    Route::get('/cart-increment/{rowId}', [CartController::class, 'CartIncrement']);
    Route::get('/cart-decrement/{rowId}', [CartController::class, 'CartDecrement']);
    Route::get('/total-calculation', [CartController::class, 'TotalCalculation']);

});
