@extends('frontend.main_master')
@section('content')

@section('title')
{{ $product->product_name_en }} Product Details
@endsection

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li><a href="#">Clothing</a></li>
				<li class='active'>Floral Print Buttoned</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product'>
			
			<div class='col-md-12'>
            <div class="detail-block">
				<div class="row  wow fadeInUp">
                
					     <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
    <div class="product-item-holder size-big single-product-gallery small-gallery">

        <div id="owl-single-product">
            @foreach($multiImage as $img)
                <div class="single-product-gallery-item" id="slide{{ $img->id }}">
                    <a data-lightbox="image-1" data-title="Gallery" href="{{ asset( $img->photo_name ) }}">
                        <img class="img-responsive" alt="" src="{{ asset( $img->photo_name ) }}" data-echo="{{ asset( $img->photo_name ) }}" />
                    </a>
                </div><!-- /.single-product-gallery-item -->
            @endforeach
        </div><!-- /.single-product-slider -->


        <div class="single-product-gallery-thumbs gallery-thumbs">

            <div id="owl-single-product-thumbnails">
                @foreach($multiImage as $img)
                    <div class="item">
                        <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide{{ $img->id }}">
                            <img class="img-responsive" width="85" alt="" src="{{ asset( $img->photo_name ) }}" data-echo="{{ asset( $img->photo_name ) }}" />
                        </a>
                    </div>
                @endforeach
            </div><!-- /#owl-single-product-thumbnails -->

        </div><!-- /.gallery-thumbs -->

    </div><!-- /.single-product-gallery -->
</div><!-- /.gallery-holder -->        			
					<div class='col-sm-6 col-md-7 product-info-block'>
						<div class="product-info">
							<h1 class="name">
                                @if(session()->get('language') == 'indonesia' ) {{ $product->product_name_ind }} @else {{ $product->product_name_en }} @endif
                            </h1>
							
							<div class="rating-reviews m-t-20">
								<div class="row">
									<div class="col-sm-3">
										<div class="rating rateit-small"></div>
									</div>
									<div class="col-sm-8">
										<div class="reviews">
											<a href="#" class="lnk">(13 Reviews)</a>
										</div>
									</div>
								</div><!-- /.row -->		
							</div><!-- /.rating-reviews -->

							<div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-2">
										<div class="stock-box">
											<span class="label">Availability :</span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value">In Stock</span>
										</div>	
									</div>
								</div><!-- /.row -->	
							</div><!-- /.stock-container -->

							<div class="description-container m-t-20">
                                @if(session()->get('language') == 'indonesia' ) {{ $product->short_descp_ind }} @else {{ $product->short_descp_en }} @endif	</div><!-- /.description-container -->
							<div class="price-container info-container m-t-20">
								<div class="row">
									@php
                                        $total_rupiah = "Rp " . number_format($product->selling_price,2,',','.');
                                        $amount = $product->selling_price - $product->discount_price;
                                        $total_amount = "Rp " . number_format($amount,2,',','.');
                                        $discount = (($product->selling_price - $amount)/$product->selling_price) * 100;
                                    @endphp

									<div class="col-sm-6">
										<div class="price-box">
                                            @if ($product->discount_price == NULL)
											    <span class="price">{{ $total_rupiah }}</span>
                                            @else
                                                <span class="price">{{ $total_amount }}</span>
                                                <span class="price-strike">{{ $total_rupiah }}</span>
                                            @endif
										</div>
									</div>
								</div><!-- /.row -->
							</div><!-- /.price-container -->
							@if ($product->product_color_en == NULL && $product->product_size_en == NULL )
							@else
							<div class="price-container  ">
								<div class="row">
									@if ($product->product_color_en == NULL)
									@else
									<div class="col-sm-6">
										<div class="form-group">
											<label class="info-title control-label">Color </label>
											<select class="form-control btn dropdown-toggle btn-rounded btn-primary" style="">
												<option selected="" disabled="">--Choose Color--</option>
												@foreach($product_color_en as $color)
												<option value="{{ $color }}">{{ ucwords($color)  }}</option>
												@endforeach
											</select>
										</div>
									</div>
									@endif
									@if ($product->product_size_en == NULL )
									@else
									<div class="col-sm-6">
										<div class="form-group">
											<label class="info-title control-label">Size</label>
											<select class="form-control btn dropdown-toggle btn-rounded btn-primary" style="">
												<option selected="" disabled="">--Choose Size--</option>
												@foreach($product_size_en as $size)
												<option value="{{ $size }}">{{ ucwords($size) }}</option>
												@endforeach
											</select>
										</div>
									</div>
									@endif
								</div>
							</div>
							@endif
							
							<div class="quantity-container info-container">
								<div class="row">
									
									<div class="col-sm-2">
										<span class="label">Qty :</span>
									</div>
									
									<div class="col-sm-2">
										<div class="cart-quantity">
											<div class="quant-input">
								                <div class="arrows">
								                  <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
								                  <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
								                </div>
								                <input type="text" value="1">
							              </div>
							            </div>
									</div>

									<div class="col-sm-7">
										<a href="#" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>
									</div>

									
								</div><!-- /.row -->
							</div><!-- /.quantity-container -->

							

							

							
						</div><!-- /.product-info -->
					</div><!-- /.col-sm-7 -->
				</div><!-- /.row -->
                </div>
				
				<div class="product-tabs inner-bottom-xs  wow fadeInUp">
					<div class="row">
						<div class="col-sm-3">
							<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
								<li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
								<li><a data-toggle="tab" href="#review">REVIEW</a></li>
							</ul><!-- /.nav-tabs #product-tabs -->
						</div>
						<div class="col-sm-9">

							<div class="tab-content">
								
								<div id="description" class="tab-pane in active">
									<div class="product-tab">
										<p class="text">@if(session()->get('language') == 'indonesia' ) {!! $product->long_descp_ind !!} @else {!! $product->long_descp_en !!} @endif </p>
									</div>	
								</div><!-- /.tab-pane -->

								<div id="review" class="tab-pane">
									<div class="product-tab">
																				
										<div class="product-reviews">
											<h4 class="title">Customer Reviews</h4>

											<div class="reviews">
												<div class="review">
													<div class="review-title"><span class="summary">We love this product</span><span class="date"><i class="fa fa-calendar"></i><span>1 days ago</span></span></div>
													<div class="text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit.Aliquam suscipit."</div>
																										</div>
											
											</div><!-- /.reviews -->
										</div><!-- /.product-reviews -->
										

										
										<div class="product-add-review">
											<h4 class="title">Write your own review</h4>
											<div class="review-table">
												<div class="table-responsive">
													<table class="table">	
														<thead>
															<tr>
																<th class="cell-label">&nbsp;</th>
																<th>1 star</th>
																<th>2 stars</th>
																<th>3 stars</th>
																<th>4 stars</th>
																<th>5 stars</th>
															</tr>
														</thead>	
														<tbody>
															<tr>
																<td class="cell-label">Quality</td>
																<td><input type="radio" name="quality" class="radio" value="1"></td>
																<td><input type="radio" name="quality" class="radio" value="2"></td>
																<td><input type="radio" name="quality" class="radio" value="3"></td>
																<td><input type="radio" name="quality" class="radio" value="4"></td>
																<td><input type="radio" name="quality" class="radio" value="5"></td>
															</tr>
															<tr>
																<td class="cell-label">Price</td>
																<td><input type="radio" name="quality" class="radio" value="1"></td>
																<td><input type="radio" name="quality" class="radio" value="2"></td>
																<td><input type="radio" name="quality" class="radio" value="3"></td>
																<td><input type="radio" name="quality" class="radio" value="4"></td>
																<td><input type="radio" name="quality" class="radio" value="5"></td>
															</tr>
															<tr>
																<td class="cell-label">Value</td>
																<td><input type="radio" name="quality" class="radio" value="1"></td>
																<td><input type="radio" name="quality" class="radio" value="2"></td>
																<td><input type="radio" name="quality" class="radio" value="3"></td>
																<td><input type="radio" name="quality" class="radio" value="4"></td>
																<td><input type="radio" name="quality" class="radio" value="5"></td>
															</tr>
														</tbody>
													</table><!-- /.table .table-bordered -->
												</div><!-- /.table-responsive -->
											</div><!-- /.review-table -->
											
											<div class="review-form">
												<div class="form-container">
													<form role="form" class="cnt-form">
														
														<div class="row">
															<div class="col-sm-6">
																<div class="form-group">
																	<label for="exampleInputName">Your Name <span class="astk">*</span></label>
																	<input type="text" class="form-control txt" id="exampleInputName" placeholder="">
																</div><!-- /.form-group -->
																<div class="form-group">
																	<label for="exampleInputSummary">Summary <span class="astk">*</span></label>
																	<input type="text" class="form-control txt" id="exampleInputSummary" placeholder="">
																</div><!-- /.form-group -->
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputReview">Review <span class="astk">*</span></label>
																	<textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder=""></textarea>
																</div><!-- /.form-group -->
															</div>
														</div><!-- /.row -->
														
														<div class="action text-right">
															<button class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
														</div><!-- /.action -->

													</form><!-- /.cnt-form -->
												</div><!-- /.form-container -->
											</div><!-- /.review-form -->

										</div><!-- /.product-add-review -->										
										
							        </div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->

							</div><!-- /.tab-content -->
						</div><!-- /.col -->

					</div><!-- /.row -->
				</div><!-- /.product-tabs -->
				<br><br><br><br>
			</div><!-- /.col -->
			<div class="clearfix"></div>
		</div><!-- /.row -->
    </div>

@endsection