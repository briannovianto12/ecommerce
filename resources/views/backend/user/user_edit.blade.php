@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">
    <section class="content">

        <!-- Basic Forms -->
         <div class="box">
           <div class="box-header with-border">
             <h4 class="box-title">Edit User</h4>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col">
                   <form method="post" action="{{ route('user.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $users->id }}">	
	                    <input type="hidden" name="old_image" value="{{ $users->profile_photo_path }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col md-6">
                                        <div class="form-group">
                                            <h5>User Name</h5>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control" value="{{ $users->name }}"> </div>
                                        </div>
                                    </div> 

                                    <div class="col md-6">
                                        <div class="form-group">
                                            <h5>User Email</h5>
                                            <div class="controls">
                                                <input type="email" name="email" class="form-control" value="{{ $users->email }}" > </div>
                                        </div>
                                    </div> 
                                </div> 
                                <div class="row">
                                    <div class="col md-6">
                                        <div class="form-group">
                                            <h5>User Phone</h5>
                                            <div class="controls">
                                                <input type="text" name="phone" class="form-control" value="{{ $users->phone }}"> </div>
                                        </div>
                                    </div> 

                                    <div class="col md-6">

                                    </div> 
                                </div> 
                                <div class="row">
                                    <div class="col md-6">
                                        <div class="form-group">
                                            <h5>User Image</h5>
                                            <div class="controls">
                                                <input type="file" name="profile_photo_path" class="form-control" id="image"> </div>
                                        </div>
                                    </div>

                                    <div class="col md-6">
                                        <img id="showImage" src="{{  url('upload/no_image.jpg') }}" style="width: 100px; height: 100px;">
                                    </div>
                                </div>
                                <hr>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update User">
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