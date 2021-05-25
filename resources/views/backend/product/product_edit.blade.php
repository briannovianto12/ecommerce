@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<div class="container-full">

    <!-- Main content -->
    <section class="content">

    <!-- Basic Forms -->
    <div class="box bt-3 border-secondary">
        <div class="box-header with-border">
        <h4 class="box-title">Edit Product</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <div class="row">
            <div class="col">
                <form method="post" action="{{ route('product.update') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $products->id }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="row"> {{-- Row 1  --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" class="form-control" required="">
                                                <option value="" selected="" disabled="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == $products->category_id ? 'selected':''}}>{{ $category->category_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subcategory_id" class="form-control" required="" >
                                                <option value="" selected="" disabled="">Select SubCategory</option>
                                                @foreach($subcategory as $sub)
                                                    <option value="{{ $sub->id }}" {{ $sub->id == $products->subcategory_id ? 'selected':''}}>{{ $sub->subcategory_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('subcategory_id') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>  
                                </div>
                            </div> {{-- End Row 1  --}}
                            <div class="row"> {{-- Row 2  --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Name English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_name_en" class="form-control" required="" value="{{ $products->product_name_en }}" > 
                                            @error('product_name_en') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Name Indonesia <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_name_ind" class="form-control" required="" value="{{ $products->product_name_ind }}"> 
                                            @error('product_name_ind') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                            </div> {{-- End Row 2  --}}
                            <div class="row"> {{-- Row 3  --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Code <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_code" class="form-control" required="" value="{{ $products->product_code }}"> 
                                            @error('product_code') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Quantity <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_qty" class="form-control" required="" value="{{ $products->product_qty }}"> 
                                            @error('product_qty') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                            </div> {{-- End Row 3  --}}
                            <div class="row"> {{-- Row 4  --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Tags English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_tags_en" class="form-control" value="{{ $products->product_tags_en }}" data-role="tagsinput" required="" >
                                            @error('product_tags_en') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Tags Indonesia <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_tags_ind" class="form-control" value="{{ $products->product_tags_ind }}" data-role="tagsinput" required="" >
                                            @error('product_tags_ind') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                            </div> {{-- End Row 4  --}}
                            <div class="row"> {{-- Row 5  --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Size English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_size_en" class="form-control" value="{{ $products->product_size_en }}" data-role="tagsinput" required="">
                                            @error('product_size_en') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Size Indonesia <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_size_ind" class="form-control" value="{{ $products->product_size_ind }}" data-role="tagsinput" required="">
                                            @error('product_size_ind') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                            </div> {{-- End Row 5  --}}
                            <div class="row"> {{-- Row 6  --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Color English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_color_en" class="form-control" value="{{ $products->product_color_en }}" data-role="tagsinput" required="">
                                            @error('product_color_en') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Color Indonesia <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_color_ind" class="form-control" value="{{ $products->product_color_ind }}" data-role="tagsinput" required="">
                                            @error('product_color_ind') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                            </div> {{-- End Row 6  --}}
                            <div class="row"> {{-- Row 7  --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="selling_price" class="form-control" required="" value="{{ $products->selling_price }}"> 
                                            @error('selling_price') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Discount <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="discount_price" class="form-control" required="" value="{{ $products->discount_price }}"> 
                                            @error('discount_price') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                            </div> {{-- End Row 7  --}}
                            {{-- <div class="row"> Row 8  --}}
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Main Thumbnail<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="product_thumbnail" class="form-control" onChange="mainThumbUrl(this)" required=""> 
                                            @error('product_thumbnail') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <img src="" id="mainThmb">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Multiple Images<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="multi_images[]" class="form-control" multiple="" id="multiImg" required=""> 
                                            @error('multi_images') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div class="row" id="preview_img"></div> 
                                        </div>
                                    </div>
                                </div> --}}
                            {{-- </div> End Row 8  --}}
                            <div class="row"> {{-- Row 9  --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Short Description English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="short_descp_en" id="textarea" class="form-control" required="" > {!! $products->short_descp_en !!} </textarea>     
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Short Description Indonesia<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="short_descp_ind" id="textarea" class="form-control" required="" > {!! $products->short_descp_ind !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div> {{-- End Row 9  --}}
                            <div class="row"> {{-- Row 10  --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Long Description English<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="long_descp_en" id="textarea" class="form-control" required="" > {!! $products->long_descp_en !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Long Description Indonesia<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="long_descp_ind" id="textarea" class="form-control" required="" > {!! $products->long_descp_ind !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div> {{-- End Row 10  --}}
                        </div>
                    </div>
                    <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_2" name="hot_deals" value="1" {{ $products->hot_deals == 1 ? 'checked': '' }}>
                                            <label for="checkbox_2">Hot Deals</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_3" name="featured" value="1" {{ $products->featured == 1 ? 'checked': '' }}>
                                            <label for="checkbox_3">Featured Product</label>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_4" name="special_offer" value="1" {{ $products->special_offer == 1 ? 'checked': '' }}>
                                            <label for="checkbox_4">Special Offer</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_5" name="special_deals" value="1" {{ $products->special_deals == 1 ? 'checked': '' }}>
                                            <label for="checkbox_5">Special Deals</label>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Product">					 
                        </div>
                    </form>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    </section>
    <!-- /.content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
				<div class="box bt-3 border-secondary">
				  <div class="box-header">
					<h4 class="box-title">Product Thumbnail Image<strong> Update</strong></h4>
				  </div>
                  <form method="post" action="{{ route('update.product.thumbnail') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $products->id }}">
                        <input type="hidden" name="old_img" value="{{ $products->product_thumbnail }}">
                        <div class="row row-sm" style="margin-left:10px; margin-top : 20px;">
                            <div class="col-md-3" >
                                <div class="card text-dark bg-light mb-3">
                                    <img src="{{ asset($products->product_thumbnail) }}" class="card-img-top" style="width: 300px; height: 200px;" id="mainThmb">
                                    <div class="card-body">
                                      <p class="card-text">
                                          <div class="form-group">
                                            <h6>Change Image</h6>
                                            <input class="form-control" type="file" name="product_thumbnail" onChange="mainThumbUrl(this)">
                                            <img src="" id="mainThmb">
                                          </div>
                                      </p>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image" style="margin-left:20px; ">
                        </div>
                        <br><br>
                  </form>
				</div>
			 </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
				<div class="box bt-3 border-secondary">
				  <div class="box-header">
					<h4 class="box-title">Product Multiple Image<strong> Update</strong></h4>
				  </div>
                  <form method="post" action="{{ route('update.product.image') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm" style="margin-left:10px; margin-top : 20px; margin-right:10px;">
                            @foreach($multiImgs as $img)
                            <div class="col-md-3" >
                                <div class="card text-dark bg-light mb-3">
                                    <img src="{{ asset($img->photo_name) }}" class="card-img-top" style="width: 300px; height: 200px;">
                                    <div class="card-body">
                                      <p class="card-text">
                                          <div class="form-group">
                                            <h6>Change Image</h6>
                                            <input class="form-control" type="file" name="multi_images[ {{ $img->id }} ]">
                                          </div>
                                          <a href="{{ route('product.multiimg.delete',$img->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>
                                      </p>
                                      {{-- <div id="myImg"></div> --}}
                                    </div>
                                </div> 
                            </div>
                            @endforeach
                        </div>
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image" style="margin-left:25px; ">
                        </div>
                        <br>
                  </form>
                    <form method="post" action="{{ route('new.product.image') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $products->id }}">
                        <div class="col-md-6" style="margin-left: 10px;">
                            <div class="form-group">
                                <h4>Add New Multiple Images</h4>
                                <div class="controls">
                                    <input type="file" name="multi_images[]" class="form-control" multiple="" id="multiImg"> 
                                    <div class="row" id="preview_img" style="margin-left: 10px; margin-top:5px;"></div> 
                                </div>
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New Image">
                            </div>
                        </div>
                    </form>
                    <br><br>
				</div>
			 </div>
        </div>
    </section>
</div>

{{-- JS Function SubCategory Select --}}
<script type="text/javascript">
    $(document).ready(function() {
    $('select[name="category_id"]').on('change', function(){
        var category_id = $(this).val();
        if(category_id) {
            $.ajax({
                url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                    var d =$('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                        });
                },
            });
        } else {
            alert('danger');
        }
    });
});
</script>

{{-- JS Function to Show Main Thumbnail --}}
<script type="text/javascript">
	function mainThumbUrl(input){
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e){
				$('#mainThmb').attr('src',e.target.result).width(300).height(200);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}	
</script>
{{-- JS Function to Show Multi Image --}}
<script type="text/javascript">
	function multiImgUrl(input){
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e){
				$('#multiImage').attr('src',e.target.result).width(300).height(200);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}	
</script>

<script type="text/javascript">
$(function() {
    $(":file").change(function() {
      if (this.files && this.files[0]) {
        for (var i = 0; i < this.files.length; i++) {
          var reader = new FileReader();
          reader.onload = imageIsLoaded;
          reader.readAsDataURL(this.files[i]);
        }
      }
    });
  });
  
  function imageIsLoaded(e) {
    $('#myImg').append('<img src=' + e.target.result + '>');
  };
</script>

<script>
    $(document).ready(function(){
     $('#multiImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
             
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                    .height(100); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
             
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });  
</script>


@endsection