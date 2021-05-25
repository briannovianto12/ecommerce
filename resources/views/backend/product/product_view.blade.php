@extends('admin.admin_master')
@section('admin')


  <!-- Content Wrapper. Contains page content -->
  
<div class="container-full">
		<!-- Content Header (Page header) -->
		 	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Product List <span class="badge badge-pill badge-danger"> {{ count($products) }} </span></h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Product Code</th>
										<th>Product Image </th>
										<th>Product Name English</th>
										<th>Product Name Indonesia </th>
										<th>Product Price </th>
										<th>Quantity</th>
										<th>Status</th>
										<th>Action</th>
										
									</tr>
								</thead>
								<tbody>
									@foreach($products as $item)
										<tr>
											<td>{{ $item->product_code }}</td>
											<td> <img src="{{ asset($item->product_thumbnail) }}" style="width: 60px; height:50px;"> </td>
											<td>{{ $item->product_name_en }}</td>
											<td>{{ $item->product_name_ind }}</td>
											<td>Rp. {{ $item->selling_price }}</td>
											<td>{{ $item->product_qty }}</td>
											<td>
												@if($item->status == 1)
													<span class="badge badge-pill badge-success">Active</span>
												@else
													<span class="badge badge-pill badge-danger">InActive</span>
												@endif
											</td>
											<td width=25%>
												<a href="{{ route('product.edit',$item->id) }}" class="btn btn-info" title="Edit Data"><i class="fas fa-pencil-alt"></i> </a>
												<a href="{{ route('product.delete',$item->id) }}" class="btn btn-danger" title="Delete Data" id="delete">
												<i class="fa fa-trash"></i></a>

												@if($item->status == 1)
													<a href="{{ route('product.inactive',$item->id) }}" class="btn btn-danger" title="Inactive Now"><i class="fas fa-arrow-down" ></i> </a>
												@else
													<a href="{{ route('product.active',$item->id) }}" class="btn btn-success" title="Active Now"><i class="fas fa-arrow-up" ></i> </a>
												@endif
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