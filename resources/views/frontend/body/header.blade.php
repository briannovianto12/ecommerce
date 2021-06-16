<header class="header-style-1"> 
  
    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
      <div class="container">
        <div class="header-top-inner">
          <div class="cnt-account">
            <ul class="list-unstyled">
              <li><a href="{{ route('mycart') }}"><i class="icon fa fa-shopping-cart"></i>
                @if(session()->get('language') == 'indonesia' ) Keranjang Saya @else My Cart @endif 
                </a></li>
              <li>
                @auth
                <a href="{{ route('dashboard') }}"><i class="icon fa fa-user"></i>
                  @if(session()->get('language') == 'indonesia' ) Akun Saya @else My Account @endif 
                </a>
                @else  
                <a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>
                  @if(session()->get('language') == 'indonesia' ) Masuk @else Login @endif 
                  </a>
                @endauth
              </li>
            </ul>
          </div>
          <!-- /.cnt-account -->
          
          <div class="cnt-block">
            <ul class="list-unstyled list-inline">
              <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">
                @if(session()->get('language') == 'indonesia' ) Bahasa @else Language @endif 
              </span><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  @if(session()->get('language') == 'indonesia')
                  <li><a href="{{ route('english.language') }}">English</a></li>
                  @else
                  <li><a href="{{ route('indonesia.language') }}">Indonesia</a></li>
                  @endif
                </ul>
              </li>
            </ul>
            <!-- /.list-unstyled --> 
          </div>
          <!-- /.cnt-cart -->
          <div class="clearfix"></div>
        </div>
        <!-- /.header-top-inner --> 
      </div>
      <!-- /.container --> 
    </div>
    <!-- /.header-top --> 
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-2 logo-holder"> 
            <!-- ============================================================= LOGO ============================================================= -->
            <div class="logo" style="margin-bottom: 25px;"> <a href="{{ url('/') }}"> <img src="{{ asset('frontend/assets/images/bmart.png') }}" alt="logo" style="width: 4cm; height:1cm;"> </a> </div>
            <!-- /.logo --> 
            <!-- ============================================================= LOGO : END ============================================================= --> </div>
          <!-- /.logo-holder -->
          
          <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder"> 
            <!-- /.contact-row --> 
            <!-- ============================================================= SEARCH AREA ============================================================= -->
            <div class="search-area">
                  <input class="search-field" placeholder="Search here..." />
                  <a class="search-button" href="#" ></a> 
            </div>
            <!-- /.search-area --> 
            <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
          <!-- /.top-search-holder -->
          
          <div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row"> 
            <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
            <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
              <div class="items-cart-inner">
                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                <div class="basket-item-count"><span class="count" id="cartQty"> </span></div>
                <div class="total-price-basket"> <span class="lbl">cart -</span> 
                  <span class="total-price"> <span class="sign">Rp.</span>
                  <span class="value" id="cartTotal"></span> </span> </div>
              </div>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <div id="miniCart">

                  </div>
    

                  <div class="clearfix cart-total">
                    <div class="pull-right"> <span class="text">Sub Total : Rp.</span>
                    <span class="value"  id="cartSubTotal"> </span> </div>
                    <div class="clearfix"></div>
                    <a href="{{ route('checkout') }}" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> </div>
                  <!-- /.cart-total--> 
                  
                </li>
              </ul>
              <!-- /.dropdown-menu--> 
            </div>
            <!-- /.dropdown-cart --> 
            
            <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> </div>
          <!-- /.top-cart-row --> 
        </div>
        <!-- /.row --> 
        
      </div>
      <!-- /.container --> 
      
    </div>
    <!-- /.main-header --> 
    
  </header>