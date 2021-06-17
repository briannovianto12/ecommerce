@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->
<div class="container-full">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Order Details</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Order Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
	<!-- Main content -->
	<section class="content">
		<div class="row">
            <div class="col-md-6 col-12">
				<div class="box box-bordered border-primary">
				  <div class="box-header with-border">
					<h4 class="box-title"><strong>Shipping Details</strong></h4>
				  </div>
                    <table class="table" >
                        <tr>
                        <th> Shipping Name : </th>
                        <th> {{ $order->name }} </th>
                        </tr>
            
                        <tr>
                        <th> Shipping Email : </th>
                        <th> {{ $order->email }} </th>
                        </tr>

                        <tr>
                            <th> Shipping Phone : </th>
                            <th> {{ $order->phone }} </th>
                        </tr>
            
                        <tr>
                        <th> Shipping Address : </th>
                        <th> {{ $order->address }} </th>
                        </tr>
            
                        <tr>
                        <th> City : </th>
                        <th> {{ $order->city }} </th>
                        </tr>
            
                        <tr>
                        <th> Province : </th>
                        <th>{{ $order->province }} </th>
                        </tr>
            
                        <tr>
                        <th> Post Code : </th>
                        <th> {{ $order->post_code }} </th>
                        </tr>
            
                        <tr>
                        <th> Order Date : </th>
                        <th> {{ $order->order_date }} </th>
                        </tr>
				    </table>
				</div>
			</div>
            
            <div class="col-md-6 col-12">
				<div class="box box-bordered border-primary">
				  <div class="box-header with-border">
					<h4 class="box-title"><strong>Order Details</strong></h4>
				  </div>
                    <table class="table" >
                        <tr>
                        <th>  Name : </th>
                        <th> {{ $order->user->name }} </th>
                        </tr>
                        
                        <tr>
                            <th>  Email : </th>
                            <th> {{ $order->user->email }} </th>
                        </tr>

                        <tr>
                        <th>  Phone : </th>
                        <th> {{ $order->user->phone }} </th>
                        </tr>
            
                        <tr>
                        <th> Payment Type : </th>
                        <th> {{ $order->payment_method }} </th>
                        </tr>
            
                        <tr>
                        <th> Transaction ID : </th>
                        <th> {{ $order->transaction_id }} </th>
                        </tr>
            
                        <tr>
                        <th> Invoice No : </th>
                        <th class="text-danger"> {{ $order->invoice_no }} </th>
                        </tr>
            
                        <tr>
                        <th> Order Total : </th>
                        <th> @currency($order->amount) </th>
                        </tr>
            
                        <tr>
                        <th> Order Status : </th>
                        <th>   
                            <span class="badge badge-pill badge-warning" style="background: #418DB9;">{{ $order->status }} </span> </th>
                        </tr>
                        <tr>
                            <th> </th>
                            <th>
                                @if($order->status == 'Pending')
                                    <a href="{{ route('pending.confirm',$order->id) }}" class="btn btn-block btn-success" id="confirm">Confrim Order</a>

                                @elseif($order->status == 'confirmed')
                                    <a href="{{ route('confirm.processing',$order->id) }}" class="btn btn-block btn-success" id="processing">Processing Order</a>
                 
                                @elseif($order->status == 'processing')
                                    <a href="{{ route('processing.picked',$order->id) }}" class="btn btn-block btn-success" id="picked">Picked Order</a>
                 
                                @elseif($order->status == 'picked')
                                    <a href="{{ route('picked.shipped',$order->id) }}" class="btn btn-block btn-success" id="shipped">Shipped Order</a>
                 
                                @elseif($order->status == 'shipped')
                                 <a href="{{ route('shipped.delivered',$order->id) }}" class="btn btn-block btn-success" id="delivered">Delivered Order</a>
                                @endif   
                            </th>
                            </tr>

				     </table>
				</div>
			</div>

            <div class="col-md-12 col-12">
				<div class="box box-bordered border-primary">

                  <table class="table" >
					<tbody>
		
					  <tr>
						<td class="col-md-2" style="text-align:center;">
						  <label for=""><strong>Image</strong> </label>
						</td>
		
						<td class="col-md-3">
						  <label for=""><strong> Product Name </strong></label>
						</td>
		
		
						<td class="col-md-1">
						  <label for=""><strong> Color</strong> </label>
						</td>
		
						 <td class="col-md-1">
						  <label for=""><strong> Size </strong></label>
						</td>
		
						 <td class="col-md-1" style="text-align:center;">
						  <label for=""><strong> Quantity </strong></label>
						</td>
		
						<td class="col-md-4">
						  <label for=""><strong> Price </strong></label>
						</td>
		
					  </tr>
		
		
					  @foreach($orderItem as $item)
			   <tr>
						<td class="col-md-2" style="text-align:center;">
						  <label for=""><img src="{{ asset($item->product->product_thumbnail) }}" height="100px;" width="100px;"> </label>
						</td>
		
						<td class="col-md-3">
						  <label for=""> {{ $item->product->product_name_en }}</label>
						</td>
		
						<td class="col-md-1">
						  <label for=""> {{ $item->color }}</label>
						</td>
		
						<td class="col-md-1">
						  <label for=""> {{ $item->size }}</label>
						</td>
		
						 <td class="col-md-1" style="text-align:center;">
						  <label for=""> {{ $item->qty }}</label>
						</td>
		
				  		<td class="col-md-4">
						  <label for=""> @currency($item->price) ( @currency($item->price * $item->qty) ) </label>
						</td>
		
					  </tr>
					  @endforeach
		
		
		
		
		
					</tbody>
		
				  </table>
		
				</div>
			</div>



		</div>
		  <!-- /.row -->
	</section>
		<!-- /.content -->  
</div>
  
@endsection