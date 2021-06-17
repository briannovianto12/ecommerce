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
            <i data-feather="pie-chart"></i>
			<span>Dashboard</span>
          </a>
        </li>  	
		  
        <li class="treeview {{ ($prefix == '/category')? 'active':'' }}">
          <a href="#">
            <i data-feather="mail"></i> <span>Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'all.category')? 'active':'' }}"><a href="{{ route('all.category') }}"><i class="ti-more"></i>All Category</a></li>
            <li class="{{ ($route == 'all.subcategory')? 'active':'' }}"><a href="{{ route('all.subcategory') }}"><i class="ti-more"></i>Sub Category</a></li>
          </ul>
        </li>
		
        <li class="treeview {{ ($prefix == '/product')? 'active':'' }}">
          <a href="#">
            <i data-feather="file"></i>
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
        
        <li class="treeview {{ ($prefix == '/slider')? 'active':'' }}">
          <a href="#">
            <i data-feather="file"></i>
            <span>Slider</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'slider.view')? 'active':'' }}"><a href="{{ route('slider.view') }}"><i class="ti-more"></i>Manage Slider</a></li>
          </ul>
        </li> 
		 
        <li class="header nav-small-cap">User Interface</li>

        <li class="treeview {{ ($prefix == '/orders')? 'active':'' }}">
          <a href="#">
            <i data-feather="file"></i>
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
		
        <li class="treeview {{ ($prefix == '/alluser')?'active':'' }}  ">
          <a href="#">
            <i data-feather="file"></i>
            <span>User </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        <li class="{{ ($route == 'all.users')? 'active':'' }}"><a href="{{ route('all.users') }}"><i class="ti-more"></i>All Users</a></li>


          </ul>
        </li> 
	  
		  
      </ul>
    </section>
	
	<div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div>
  </aside>