@extends('frontend.main_master')
@section('content')
@section('title')
Order Detail Page 
@endsection


<div class="body-content">
	<div class="container">
		<div class="row">
			 @include('frontend.common.user_sidebar')
			 <div class="col-md-5">
				<div class="card">
				  <div class="card-header" style="margin-top:30px; "><h4><strong>Shipping Details</strong></h4></div>
				 <hr>
				 <div class="card-body" style="background: #E9EBEC;">
				   <table class="table" style="border: 1px solid black;">
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
		
			</div> <!-- // end col md -5 -->

			<div class="col-md-5">
				<div class="card">
				  <div class="card-header" style="margin-top:30px;"><h4><strong>Order Details</strong> </h4>
					{{-- <span class="text-danger"> (Invoice No : {{ $order->invoice_no }})</span></h4> --}}
				  </div>
				 <hr>
				 <div class="card-body" style="background: #E9EBEC;">
				   <table class="table" style="border: 1px solid black;">
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
					  <th> Invoice No  : </th>
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
		
		
		
				   </table>
		
		
				 </div> 
		
				</div>
		
			  </div> <!-- // 2ND end col md -5 -->
		
		
			  <div class="row">
		
		
		
		<div class="col-md-12">
		
				<div class="table-responsive" style="margin-top:30px; margin-bottom:50px;">
				  <table class="table" style="border: 1px solid black;">
					<tbody>
		
					  <tr style="background: #e2e2e2; border: 1px solid black;">
						<td class="col-md-2" style="text-align:center;">
						  <label for=""> Image</label>
						</td>
		
						<td class="col-md-3">
						  <label for=""> Product Name </label>
						</td>
		
		
						<td class="col-md-1">
						  <label for=""> Color </label>
						</td>
		
						 <td class="col-md-1">
						  <label for=""> Size </label>
						</td>
		
						 <td class="col-md-1" style="text-align:center;">
						  <label for=""> Quantity </label>
						</td>
		
						<td class="col-md-4">
						  <label for=""> Price </label>
						</td>
		
					  </tr>
		
		
					  @foreach($orderItem as $item)
			   <tr style="border: 1px solid black;">
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
		
		
		
		
		
			   </div> <!-- / end col md 8 -->
		
		
		
		
		
		
		
		
		
		
		
		
			  </div> <!-- // END ORDER ITEM ROW -->



		</div> <!-- // end row -->

	</div>

</div>


@endsection