@extends('frontend.main_master')
@section('content')
@section('title')
Product Search Page 
@endsection


<style>
  .checked {
    color: orange;
  }
  </style>

{{-- 
<div class="breadcrumb">
  <div class="container">
    <div class="breadcrumb-inner">
      <ul class="list-inline list-unstyled">
        <li><a href="{{ url('/') }}">Home</a></li>
      </ul>
    </div>
    <!-- /.breadcrumb-inner --> 
  </div>
  <!-- /.container --> 
</div> --}}
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
  <div class='container'>
    <div class='row'>
      <div class='col-md-3 sidebar'> 




        <div class="sidebar-module-container">
          <div class="sidebar-filter"> 
            <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
            <div class="sidebar-widget wow fadeInUp">
              <h3 class="section-title">shop by</h3>
              <div class="widget-header">
                <h4 class="widget-title">Category</h4>
              </div>
              <div class="sidebar-widget-body">
                <div class="accordion">


 @foreach($categories as $category)
	<div class="accordion-group">
	<div class="accordion-heading"> <a href="#collapse{{ $category->id }}" data-toggle="collapse" class="accordion-toggle collapsed"> 
		@if(session()->get('language') == 'indonesia') {{ $category->category_name_ind }} @else {{ $category->category_name_en }} @endif </a> </div>
	<!-- /.accordion-heading -->
	<div class="accordion-body collapse" id="collapse{{ $category->id }}" style="height: 0px;">
	  <div class="accordion-inner">

 @php
  $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name_en','ASC')->get();
  @endphp 

   @foreach($subcategories as $subcategory)
	    <ul>
	      <li><a href="{{ url('subcategory/product/'.$subcategory->id.'/'.$subcategory->subcategory_slug_en ) }}">
	      	@if(session()->get('language') == 'indonesia') {{ $subcategory->subcategory_name_ind }} @else {{ $subcategory->subcategory_name_en }} @endif</a></li>

	    </ul>
	@endforeach 


	  </div>
	  <!-- /.accordion-inner --> 
	</div>
	<!-- /.accordion-body --> 
	</div>
	<!-- /.accordion-group -->
    @endforeach              











                </div>
                <!-- /.accordion --> 
              </div>
              <!-- /.sidebar-widget-body --> 
            </div>
            <!-- /.sidebar-widget --> 
            <!-- ============================================== SIDEBAR CATEGORY : END ============================================== --> 

            <!-- ============================================== PRICE SILDER============================================== -->
            {{-- <div class="sidebar-widget wow fadeInUp">
              <div class="widget-header">
                <h4 class="widget-title">Price Slider</h4>
              </div>
              <div class="sidebar-widget-body m-t-10">
                <div class="price-range-holder"> <span class="min-max"> <span class="pull-left">$200.00</span> <span class="pull-right">$800.00</span> </span>
                  <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">
                  <input type="text" class="price-slider" value="" >
                </div>
                <!-- /.price-range-holder --> 
                <a href="#" class="lnk btn btn-primary">Show Now</a> </div>
              <!-- /.sidebar-widget-body --> 
            </div>
            <!-- /.sidebar-widget --> 
            <!-- ============================================== PRICE SILDER : END ============================================== --> 
            <!-- ============================================== MANUFACTURES============================================== -->
            <div class="sidebar-widget wow fadeInUp">
              <div class="widget-header">
                <h4 class="widget-title">Manufactures</h4>
              </div>
              <div class="sidebar-widget-body">
                <ul class="list">
                  <li><a href="#">Forever 18</a></li>
                  <li><a href="#">Nike</a></li>
                  <li><a href="#">Dolce & Gabbana</a></li>
                  <li><a href="#">Alluare</a></li>
                  <li><a href="#">Chanel</a></li>
                  <li><a href="#">Other Brand</a></li>
                </ul>
                <!--<a href="#" class="lnk btn btn-primary">Show Now</a>--> 
              </div>
              <!-- /.sidebar-widget-body --> 
            </div>
            <!-- /.sidebar-widget --> 
            <!-- ============================================== MANUFACTURES: END ============================================== --> 
            <!-- ============================================== COLOR============================================== -->
            <div class="sidebar-widget wow fadeInUp">
              <div class="widget-header">
                <h4 class="widget-title">Colors</h4>
              </div>
              <div class="sidebar-widget-body">
                <ul class="list">
                  <li><a href="#">Red</a></li>
                  <li><a href="#">Blue</a></li>
                  <li><a href="#">Yellow</a></li>
                  <li><a href="#">Pink</a></li>
                  <li><a href="#">Brown</a></li>
                  <li><a href="#">Teal</a></li>
                </ul>
              </div>
              <!-- /.sidebar-widget-body --> 
            </div> --}}
            <!-- /.sidebar-widget --> 
            <br><br>








          </div>
          <!-- /.sidebar-filter --> 
        </div>
        <!-- /.sidebar-module-container --> 
      </div>
      <!-- /.sidebar -->
      <div class='col-md-9'> 



        <!-- == ==== SECTION – HERO === ====== -->


        <h4><b>Total Search </b><span class="badge badge-danger" style="background: #FF0000;"> {{ count($products) }} </span>  Products  </h4>

        <div class="clearfix filters-container m-t-12">
          <div class="row">
            <div class="col col-sm-6 col-md-2">
              <div class="filter-tabs">
                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                  <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a> </li>
                  <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
                </ul>
              </div>
              <!-- /.filter-tabs --> 
            </div>
            <!-- /.col -->
            {{-- <div class="col col-sm-12 col-md-6">
              <div class="col col-sm-3 col-md-6 no-padding">
                <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                  <div class="fld inline">
                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                      <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> Position <span class="caret"></span> </button>
                      <ul role="menu" class="dropdown-menu">
                        <li role="presentation"><a href="#">position</a></li>
                        <li role="presentation"><a href="#">Price:Lowest first</a></li>
                        <li role="presentation"><a href="#">Price:HIghest first</a></li>
                        <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.fld --> 
                </div>
                <!-- /.lbl-cnt --> 
              </div>
              <!-- /.col -->
              <div class="col col-sm-3 col-md-6 no-padding">
                <div class="lbl-cnt"> <span class="lbl">Show</span>
                  <div class="fld inline">
                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                      <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1 <span class="caret"></span> </button>
                      <ul role="menu" class="dropdown-menu">
                        <li role="presentation"><a href="#">1</a></li>
                        <li role="presentation"><a href="#">2</a></li>
                        <li role="presentation"><a href="#">3</a></li>
                        <li role="presentation"><a href="#">4</a></li>
                        <li role="presentation"><a href="#">5</a></li>
                        <li role="presentation"><a href="#">6</a></li>
                        <li role="presentation"><a href="#">7</a></li>
                        <li role="presentation"><a href="#">8</a></li>
                        <li role="presentation"><a href="#">9</a></li>
                        <li role="presentation"><a href="#">10</a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.fld --> 
                </div>
                <!-- /.lbl-cnt --> 
              </div>
              <!-- /.col --> 
            </div> --}}
            <!-- /.col -->
            <div class="col col-sm-6 col-md-4 text-right">

              <!-- /.pagination-container --> </div>
            <!-- /.col --> 
          </div>
          <!-- /.row --> 
        </div>


<!--    //////////////////// START Product Grid View  ////////////// -->

        <div class="search-result-container ">
          <div id="myTabContent" class="tab-content category-list">
            <div class="tab-pane active " id="grid-container">
              <div class="category-product">
                <div class="row">



@foreach($products as $product)
@php 
$avarage = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
@endphp
  <div class="col-sm-6 col-md-4 wow fadeInUp">
    <div class="products">
      <div class="product">
        <div class="product-image">
          <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img  src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
          <!-- /.image -->

          @php
          $total_rupiah = "Rp " . number_format($product->selling_price,2,',','.');
          $amount = $product->selling_price - $product->discount_price;
          $total_amount = "Rp " . number_format($amount,2,',','.');
          $discount = (($product->selling_price - $amount)/$product->selling_price) * 100;
            @endphp    

          <div>
            @if ($product->discount_price == NULL)
            <div class=""><span></span></div>
            @else
            <div class="tag hot"><span>{{ round($discount) }}%</span></div>
            @endif
          </div>


        </div>
        <!-- /.product-image -->
        <div class="product-info text-left">
          <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
          	@if(session()->get('language') == 'indonesia') {{ $product->product_name_ind }} @else {{ $product->product_name_en }} @endif</a></h3>
            <div class="">
              {{-- <div class="rating-reviews m-t-20"> --}}
                {{-- <div class="row">  --}}
                  {{-- <div class="col-sm-3"> --}}
                    @if($avarage == 0)
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    @elseif($avarage == 1 || $avarage < 2)
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    @elseif($avarage == 2 || $avarage < 3)
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    @elseif($avarage == 3 || $avarage < 4)
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    
                    @elseif($avarage == 4 || $avarage < 5)
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    @elseif($avarage == 5 || $avarage < 5)
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    @endif
                  {{-- </div> --}}
                {{-- </div><!-- /.row -->		 --}}
              {{-- </div><!-- /.rating-reviews --> --}}
            </div>
          <div class="description"></div>


            @if ($product->discount_price == NULL)
            <div class="product-price"> <span class="price"> {{ $total_rupiah }} </span>   </div>

            @else

            <div class="product-price"> <span class="price"> {{ $total_amount }} </span> <span class="price-before-discount"> {{ $total_rupiah }}</span> </div>
            @endif




          <!-- /.product-price --> 

        </div>
        <!-- /.product-info -->
        <div class="cart clearfix animate-effect">
          <div class="action">
            <ul class="list-unstyled">
              <li class="add-cart-button btn-group">
                <button class="btn btn-primary icon" type="button" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)" ><i class="fa fa-shopping-cart"></i> Add to Cart </button>
                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
              </li>
            </ul>
          </div>
          <!-- /.action --> 
        </div>
        <!-- /.cart --> 
      </div>
      <!-- /.product --> 

    </div>
    <!-- /.products --> 
  </div>
  <!-- /.item -->
  @endforeach











                </div>
                <!-- /.row --> 
              </div>
              <!-- /.category-product --> 

            </div>
            <!-- /.tab-pane -->

 <!--            //////////////////// END Product Grid View  ////////////// -->




 <!--            //////////////////// Product List View Start ////////////// -->



            <div class="tab-pane "  id="list-container">
              <div class="category-product">



 @foreach($products as $product)
<div class="category-product-inner wow fadeInUp">
  <div class="products">
    <div class="product-list product">
      <div class="row product-list-row">
        <div class="col col-sm-4 col-lg-4">
          <div class="product-image">
            <div class="image"> <img src="{{ asset($product->product_thumbnail) }}" alt=""> </div>
          </div>
          <!-- /.product-image --> 
          @php
          $total_rupiah = "Rp " . number_format($product->selling_price,2,',','.');
          $amount = $product->selling_price - $product->discount_price;
          $total_amount = "Rp " . number_format($amount,2,',','.');
          $discount = (($product->selling_price - $amount)/$product->selling_price) * 100;
        @endphp  
        </div>
        <!-- /.col -->
        <div class="col col-sm-8 col-lg-8">
          <div class="product-info">
            <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
            	@if(session()->get('language') == 'indonesia') {{ $product->product_name_ind }} @else {{ $product->product_name_en }} @endif</a></h3>
            <div class=""></div>


            @if ($product->discount_price == NULL)
            <div class="product-price"> <span class="price"> {{ $total_rupiah }} </span>   </div>

            @else

            <div class="product-price"> <span class="price"> {{ $total_amount }} </span> <span class="price-before-discount"> {{ $total_rupiah }}</span> </div>
            @endif

            

            <!-- /.product-price -->
            <div class="description m-t-10">
            	@if(session()->get('language') == 'indonesia') {{ $product->short_descp_ind }} @else {{ $product->short_descp_en }} @endif</div>
            <div class="cart clearfix animate-effect">
              <div class="action">
                <ul class="list-unstyled">
                  <li class="add-cart-button btn-group">
                    <button class="btn btn-primary icon" type="button" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)" ><i class="fa fa-shopping-cart"></i> Add to Cart </button>
                  </li>
                </ul>
              </div>
              <!-- /.action --> 
            </div>
            <!-- /.cart --> 

          </div>
          <!-- /.product-info --> 
        </div>
        <!-- /.col --> 
      </div>



      @php
      $total_rupiah = "Rp " . number_format($product->selling_price,2,',','.');
      $amount = $product->selling_price - $product->discount_price;
      $total_amount = "Rp " . number_format($amount,2,',','.');
      $discount = (($product->selling_price - $amount)/$product->selling_price) * 100;
        @endphp    

                      <!-- /.product-list-row -->
                      <div>
            @if ($product->discount_price == NULL)
            <div class=""><span></span></div>
            @else
            <div class="tag hot"><span>{{ round($discount) }}%</span></div>
            @endif
          </div>



                    </div>
                    <!-- /.product-list --> 
                  </div>
                  <!-- /.products --> 
                </div>
                <!-- /.category-product-inner -->
    @endforeach



 <!--            //////////////////// Product List View END ////////////// -->








              </div>
              <!-- /.category-product --> 
            </div>
            <!-- /.tab-pane #list-container --> 
          </div>
          <!-- /.tab-content -->
          <div class="clearfix filters-container">
            <div class="text-right">
              <div class="pagination-container">
                <ul class="list-inline list-unstyled">
                  {{-- {{ $products->links()  }} --}}
                </ul>
                <!-- /.list-inline --> 
              </div>
              <!-- /.pagination-container --> </div>
            <!-- /.text-right --> 

          </div>
          <!-- /.filters-container --> 

        </div>
        <!-- /.search-result-container --> 

      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row --> 
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->

    <!-- /.logo-slider --> 
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> </div>
  <!-- /.container --> 

</div>
<!-- /.body-content --> 

<br><br>





<br><br><br><br><br><br><br><br><br> <br><br>
@endsection