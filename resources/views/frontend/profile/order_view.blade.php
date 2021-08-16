@extends('frontend.main_master')
@section('content')
@section('title')
My Order Page 
@endsection


<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.user_sidebar')
            <div class="col-md-1">

            </div>
     
            <div class="col-md-9">
     
             <div class="table-responsive" style="margin-top:30px; margin-bottom:20px;  ">
               <table class="table">
                 <tbody>
     
                   <tr style="background: #e2e2e2; border: 1px solid black;">
                     <td class="col-md-2">
                       <label for=""> Date</label>
                     </td>
     
                     <td class="col-md-3">
                       <label for=""> Total</label>
                     </td>
     
                     <td class="col-md-2">
                       <label for=""> Payment Method</label>
                     </td>
     
     
                     <td class="col-md-2">
                       <label for=""> Invoice</label>
                     </td>
     
                      <td class="col-md-3">
                       <label for=""> Status</label>
                     </td>
     
                      <td class="col-md-1">
                       <label for=""> Action </label>
                     </td>
     
                   </tr>
     
     
                   @foreach($orders as $order)
                <tr style="border: 1px solid black;">
                     <td class="col-md-1">
                       <label for=""> {{ $order->order_date }}</label>
                     </td>
     
                     <td class="col-md-3">
                       <label for="">  @currency($order->amount) </label>
                     </td>
     
     
                      <td class="col-md-3">
                       <label for=""> {{ $order->payment_method }}</label>
                     </td>
     
                     <td class="col-md-2">
                       <label for=""> {{ $order->invoice_no }}</label>
                     </td>
     
                      <td class="col-md-2">
                       <label for=""> 
                         <span class="badge badge-pill badge-warning" style="background: #418DB9;">{{ $order->status }} </span>
     
                         </label>
                     </td>
     
                    <td class="col-md-1">
                        <a href="{{ url('user/order_details/'.$order->id ) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a>
                        {{-- <a href="" class="btn btn-sm btn-danger"><i class="fa fa-download" style="color: white;"></i> Invoice </a> --}}
                    </td>
     
                </tr>
                   @endforeach
    
                 </tbody>
     
               </table>
     
             </div>
     
            </div> <!-- / end col md 8 -->
        </div> {{-- // end row --}}
    </div>
</div>

<br><br><br><br><br><br><br>
@endsection