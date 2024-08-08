@extends('layouts.admin')
@section('content')

    <div class="container-fluid px-4">
        <div class="my-5">
            <h3 class="my-4 d-inline">Order Detail</h3>
            <a href="{{route('backend.orders.index')}}" class="btn btn-sm btn-success float-end">Back</a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h3 class="text-center my-3">Hein Shopping</h3>

                <div class="row">
                    <div class="col-md-6">
                        <p>Name - {{$orderFirst->user->name}}</p>
                        <p>Phone - {{$orderFirst->user->phone}}</p>
                        <p>voucherNo - {{$orderFirst->voucherNo}}</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <p>Date - {{$orderFirst->created_at->format('M d, Y')}}</p>
                        <p>Address - {{$orderFirst->user->address}}</p>
                        <p>Payment Method - {{$orderFirst->payment->name}} </p>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Qty</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $i = 1;
                            $total = 0;
                        @endphp
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$order->item->name}}</td>
                                <td>{{$order->item->price}} Ks</td>
                                <td>{{$order->item->discount}}%</td>
                                <td>{{$order->qty}}</td>
                                <td>{{($order->item->price - ($order->item->discount/100 * $order->item->price))*$order->qty}} Ks</td>
                            </tr>
                            @php 
                                $total += ($order->item->price - ($order->item->discount/100 * $order->item->price))*$order->qty;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-end">Total</td>
                            <td>{{$total}} Ks</td>
                        </tr>
                    </tfoot>
                </table>

                <div class="row">
                    <div class="offset-md-4 col-md-4">
                        <img src="{{$orderFirst->paymentSlip}}" class="img-fluid" alt="">
                    </div>

                    <form class="d-grid gap-2 my-5" action="{{route('backend.orders.status',$orderFirst->voucherNo)}}" method="post">
                        @csrf
                        {{method_field('put')}}
                        @if($orderFirst->status == 'Pending')
                            <input type="hidden" name="status" id="" value="Accept">
                            <button class="btn btn-primary">Order Accept</button>
                        @elseif($orderFirst->status == 'Accept')
                            <input type="hidden" name="status" id="" value="Complete">
                            <button class="btn btn-success">Order Complete</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection   
    