@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">
    <section class="content">

        <!-- Basic Forms -->
         <div class="box">
           <div class="box-header with-border">
             <h4 class="box-title">Create Seller</h4>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col">
                   <form method="post" action="{{ route('seller.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col md-6">
                                        <div class="form-group">
                                            <h5>Seller Name</h5>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control" > </div>
                                        </div>
                                    </div> 

                                    <div class="col md-6">
                                        <div class="form-group">
                                            <h5>Seller Email</h5>
                                            <div class="controls">
                                                <input type="email" name="email" class="form-control" > </div>
                                        </div>
                                    </div> 
                                </div> 
                                <div class="row">
                                    <div class="col md-6">
                                        <div class="form-group">
                                            <h5>Seller Phone</h5>
                                            <div class="controls">
                                                <input type="text" name="phone" class="form-control" > </div>
                                        </div>
                                    </div> 

                                    <div class="col md-6">
                                        <div class="form-group">
                                            <h5>Seller Password</h5>
                                            <div class="controls">
                                                <input type="password" name="password" class="form-control" > </div>
                                        </div>
                                    </div> 
                                </div> 
                                <div class="row">
                                    <div class="col md-6">
                                        <div class="form-group">
                                            <h5>Seller Image</h5>
                                            <div class="controls">
                                                <input type="file" name="profile_photo_path" class="form-control" id="image"> </div>
                                        </div>
                                    </div>

                                    <div class="col md-6">
                                        <img id="showImage" src="{{  url('upload/no_image.jpg') }}" style="width: 100px; height: 100px;">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <fieldset>
                                                    <input type="checkbox" id="checkbox_2" name="product" value="1">
                                                    <label for="checkbox_2">Product</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" id="checkbox_3" name="orders" value="1">
                                                    <label for="checkbox_3">Order</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" id="checkbox_8" name="review" value="1">
                                                    <label for="checkbox_8">Review</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" id="checkbox_4" name="adminrole" value="1">
                                                    <label for="checkbox_4">Admin Role</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <fieldset>
                                                    <input type="checkbox" id="checkbox_5" name="category" value="1">
                                                    <label for="checkbox_5">Category</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" id="checkbox_6" name="slider" value="1">
                                                    <label for="checkbox_6">Slider</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" id="checkbox_7" name="alluser" value="1">
                                                    <label for="checkbox_7">User</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Seller">
                                    </div>
                            </div>
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

</div>
    {{--JS Function Show Image at Edit Profile --}}
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

@endsection