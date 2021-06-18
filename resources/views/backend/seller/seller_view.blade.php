@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->
<div class="container-full">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">
			    <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Seller List <span class="badge badge-pill badge-danger"> {{ count($seller) }} </span></h3>
                    <a href="{{ route('add.seller') }}" class="btn btn-success" style="float: right;">Add Seller</a>
                    
                    </div>
				    <!-- /.box-header -->
				    <div class="box-body">
					    <div class="table-responsive">
					        <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role Access</th>  
                                        <th>Action</th>
                                    </tr>
                                </thead>
						        <tbody>
                                    @foreach($seller as $item)
                                        <tr>
                                            <td> <img src="{{ asset($item->profile_photo_path) }}" alt="" style="width: 50px; height:50px;" > </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>

                                                @if($item->product == 1)
                                                <span class="badge btn-success">Product</span>
                                                @else
                                                @endif                                 
                                    
                                                @if($item->orders == 1)
                                                <span class="badge btn-primary">Orders</span>
                                                @else
                                                @endif

                                                @if($item->category == 1)
                                                <span class="badge btn-secondary">Category</span>
                                                @else
                                                @endif
                                    
                                                @if($item->slider == 1)
                                                <span class="badge btn-danger">Slider</span>
                                                @else
                                                @endif
                                    
                                    
                                                @if($item->review == 1)
                                                <span class="badge btn-warning">Review</span>
                                                @else
                                                @endif
                                    
                                                @if($item->alluser == 1)
                                                <span class="badge btn-info">User</span>
                                                @else
                                                @endif
                                    
                                                @if($item->adminrole == 1)
                                                <span class="badge btn-dark">AdminRole</span>
                                                @else
                                                @endif
                                              </td>

                                            <td width="20%">
                                                <a href="{{ route('seller.edit',$item->id) }}" class="btn btn-primary " title="Edit Data"><i class="fa fa-pencil-alt"></i> </a>
                                                <a href="{{ route('seller.delete',$item->id) }}" class="btn btn-danger " title="Delete Data" id="delete">
                                                    <i class="fa fa-trash"></i></a>
                                            </td>                     
                                        </tr>
                                    @endforeach
						        </tbody>
						 
					        </table>
					    </div>
				    </div>
				<!-- /.box-body -->
			    </div>
			  <!-- /.box -->     
			</div>
			<!-- /.col -->
		</div>
		  <!-- /.row -->
	</section>
		<!-- /.content -->  
</div>
  
@endsection