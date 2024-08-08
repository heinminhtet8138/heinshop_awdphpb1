@extends('layouts.admin')
@section('content')

    <div class="container-fluid px-4">
        <div class="my-5">
            <h3 class="my-4 d-inline">Order Pending</h3>
            <a href="{{route('backend.orders.complete')}}" class="btn btn-sm btn-success float-end">Order Complete List</a>
            <a href="{{route('backend.orders.accept')}}" class="btn btn-sm btn-primary float-end mx-3">Order Accept List</a>
            <a href="{{route('backend.orders.index')}}" class="btn btn-sm btn-danger float-end">Order Pending List</a>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Orders List
            </div>
            <div class="card-body">
                <table id="" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>voucherNo</th>
                            <th>User Name</th>
                            <th>Status</th>
                            <th>Payment Tupe</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>voucherNo</th>
                            <th>User Name</th>
                            <th>Status</th>
                            <th>Payment Tupe</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($orderWithUser as $order)
                            @if($order != null) 
                                <tr>
                                    <td>{{$order->voucherNo}}</td>
                                    <td>{{$order->user->name}}</td>
                                    <td><span class="badge {{$order->status == 'Pending' ? 'text-bg-danger' : ($order->status == 'Accept' ? 'text-bg-primary': 'text-bg-success')}}">{{$order->status}}</span></td>
                                    <td>{{$order->payment->name}}</td>
                                    <td><a href="{{route('backend.orders.detail',$order->voucherNo)}}" class="btn btn-sm btn-primary">Details</a></td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection   
    