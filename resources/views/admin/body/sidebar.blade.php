@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
			<div class="ulogo">
				 <a href="{{ url('admin/dashboard') }}">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">					 	
						  <img src="{{ asset('backend/images/B1.png') }}">
						  <h3><b>B-Mart</b> Admin</h3>
					 </div>
				</a>
			</div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
		  
		<li class=" {{ ($route == 'dashboard')? 'active':'' }} ">
          <a href="{{ url('admin/dashboard') }}">
            <i></i>
			<span>Dashboard</span>
          </a>
        </li>  	

        @php
        $category = (auth()->guard('admin')->user()->category == 1);
        $product = (auth()->guard('admin')->user()->product == 1);
        $slider = (auth()->guard('admin')->user()->slider == 1);
        $review = (auth()->guard('admin')->user()->review == 1);
        $orders = (auth()->guard('admin')->user()->orders == 1);
        $alluser = (auth()->guard('admin')->user()->alluser == 1);
        $adminrole = (auth()->guard('admin')->user()->adminrole == 1);
        @endphp

        @if($category == true)
        <li class="treeview {{ ($prefix == '/category')? 'active':'' }}">
          <a href="#">
            <i></i> <span>Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'all.category')? 'active':'' }}"><a href="{{ route('all.category') }}"><i class="ti-more"></i>All Category</a></li>
            <li class="{{ ($route == 'all.subcategory')? 'active':'' }}"><a href="{{ route('all.subcategory') }}"><i class="ti-more"></i>Sub Category</a></li>
          </ul>
        </li>
        @else
        @endif
        
        @if($product == true)
        <li class="treeview {{ ($prefix == '/product')? 'active':'' }}">
          <a href="#">
            <i></i>
            <span>Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'add.product')? 'active':'' }}"><a href="{{ route('add.product') }}"><i class="ti-more"></i>Add Products</a></li>
            <li class="{{ ($route == 'manage.product')? 'active':'' }}"><a href="{{ route('manage.product') }}"><i class="ti-more"></i>Manage Products</a></li>
          </ul>
        </li> 
        @else
        @endif

        @if($slider == true)
        <li class="treeview {{ ($prefix == '/slider')? 'active':'' }}">
          <a href="#">
            <i></i>
            <span>Slider</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'slider.view')? 'active':'' }}"><a href="{{ route('slider.view') }}"><i class="ti-more"></i>Manage Slider</a></li>
          </ul>
        </li> 
        @else
        @endif
{{-- 		 
        <li class="header nav-small-cap">User Interface</li> --}}

        @if($orders == true)
        <li class="treeview {{ ($prefix == '/orders')? 'active':'' }}">
          <a href="#">
            <i></i>
            <span>Order</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'pending.orders')? 'active':'' }}"><a href="{{ route('pending.orders') }}"><i class="ti-more"></i>Pending Orders</a></li>
            <li class="{{ ($route == 'confirmed.orders')? 'active':'' }}"><a href="{{ route('confirmed.orders') }}"><i class="ti-more"></i>Confirmed Orders</a></li>
            <li class="{{ ($route == 'processing.orders')? 'active':'' }}"><a href="{{ route('processing.orders') }}"><i class="ti-more"></i>Processing Orders</a></li>
            <li class="{{ ($route == 'picked.orders')? 'active':'' }}"><a href="{{ route('picked.orders') }}"><i class="ti-more"></i> Picked Orders</a></li>
            <li class="{{ ($route == 'shipped.orders')? 'active':'' }}"><a href="{{ route('shipped.orders') }}"><i class="ti-more"></i> Shipped Orders</a></li>
            <li class="{{ ($route == 'delivered.orders')? 'active':'' }}"><a href="{{ route('delivered.orders') }}"><i class="ti-more"></i> Delivered Orders</a></li>
            <li class="{{ ($route == 'cancel.orders')? 'active':'' }}"><a href="{{ route('cancel.orders') }}"><i class="ti-more"></i> Cancel Orders</a></li>
          </ul>
        </li> 
        @else
        @endif

        @if($review == true)
        <li class="treeview {{ ($prefix == '/review')?'active':'' }}  ">
          <a href="#">
            <i></i>
            <span>Review </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li class="{{ ($route == 'all.review')? 'active':'' }}"><a href="{{ route('all.review') }}"><i class="ti-more"></i>All Review</a></li>
          </ul>
        </li> 
        @else
        @endif

        @if($alluser == true)
        <li class="treeview {{ ($prefix == '/alluser')?'active':'' }}  ">
          <a href="#">
            <i></i>
            <span>User </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li class="{{ ($route == 'all.users')? 'active':'' }}"><a href="{{ route('all.users') }}"><i class="ti-more"></i>All Users</a></li>
          </ul>
        </li> 
        @else
        @endif

        @if($adminrole == true)
        <li class="treeview {{ ($prefix == '/adminrole')?'active':'' }}  ">
          <a href="#">
            <i></i>
            <span>Seller </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li class="{{ ($route == 'all.seller')? 'active':'' }}"><a href="{{ route('all.seller') }}"><i class="ti-more"></i>All Seller List</a></li>
          </ul>
        </li> 
        @else
        @endif
        
		  
      </ul>
    </section>
	

  </aside>