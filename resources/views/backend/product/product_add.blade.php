@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="container-full">

    <!-- Main content -->
    <section class="content">

    <!-- Basic Forms -->
    <div class="box bt-3 border-secondary">
        <div class="box-header with-border">
        <h4 class="box-title">Add Product</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <div class="row">
            <div class="col">
                <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                    @csrf
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
                                                    <option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
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
                                            <input type="text" name="product_name_en" class="form-control" required="" > 
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
                                            <input type="text" name="product_name_ind" class="form-control" required=""> 
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
                                            <input type="text" name="product_code" class="form-control" required=""> 
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
                                            <input type="text" name="product_qty" class="form-control" required=""> 
                                            @error('product_qty') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                            </div> {{-- End Row 3  --}}
                            {{-- <div class="row"> Row 4  --}}
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Tags English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_tags_en" class="form-control" value="Wood,Paint" data-role="tagsinput" required="">
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
                                            <input type="text" name="product_tags_ind" class="form-control" value="Kayu,Cat" data-role="tagsinput" required="">
                                            @error('product_tags_ind') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>
                                </div> --}}
                            {{-- </div> End Row 4  --}}
                            <div class="row"> {{-- Row 5  --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Size English</h5>
                                        <div class="controls">
                                            <input type="text" name="product_size_en" class="form-control" value="Small,Medium,Large" data-role="tagsinput" >
                                            @error('product_size_en') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Size Indonesia </h5>
                                        <div class="controls">
                                            <input type="text" name="product_size_ind" class="form-control" value="Kecil,Sedang,Besar" data-role="tagsinput" >
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
                                        <h5>Product Color English</h5>
                                        <div class="controls">
                                            <input type="text" name="product_color_en" class="form-control" value="Black,White,Red" data-role="tagsinput">
                                            @error('product_color_en') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Color Indonesia</h5>
                                        <div class="controls">
                                            <input type="text" name="product_color_ind" class="form-control" value="Hitam,Putih,Merah" data-role="tagsinput" >
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
                                            <input type="text" name="selling_price" class="form-control" required=""> 
                                            @error('selling_price') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Product Discount</h5>
                                        <div class="controls">
                                            <input type="text" name="discount_price" class="form-control"> 
                                            @error('discount_price') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                            </div> {{-- End Row 7  --}}
                            <div class="row"> {{-- Row 8  --}}
                                <div class="col-md-6">
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
                                </div>
                            </div> {{-- End Row 8  --}}
                            <div class="row"> {{-- Row 9  --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Short Description English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="short_descp_en" id="textarea" class="form-control" required=""></textarea>     
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Short Description Indonesia<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="short_descp_ind" id="textarea" class="form-control" required=""></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div> {{-- End Row 9  --}}
                            <div class="row"> {{-- Row 10  --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Long Description English<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="long_descp_en" id="textarea" class="form-control" required=""></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Long Description Indonesia<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="long_descp_ind" id="textarea" class="form-control" required=""></textarea>
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
                                            <input type="checkbox" id="checkbox_2" name="hot_deals" value="1">
                                            <label for="checkbox_2">Hot Deals</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_3" name="featured" value="1">
                                            <label for="checkbox_3">Featured Product</label>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Product">					 
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
				$('#mainThmb').attr('src',e.target.result).width(80).height(80);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}	
</script>

{{-- JS Function to Show Multi Image --}}
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
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                    .height(80); //create image element 
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