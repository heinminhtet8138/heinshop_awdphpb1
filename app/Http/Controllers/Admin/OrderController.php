<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    //
    public function index() {
        $orders = Order::all();
        // dd($orders);
        
        $voucherNoGroups = $orders->groupBy('voucherNo')->toArray();
        // dd($voucherNoGroups);
        $orderWithUser = [];
        foreach($voucherNoGroups as $voucher) {
            $orderIDs = array_column($voucher, 'id');
            // var_dump($orderIDs);
            $orderWithUser[] = Order::with('user')->whereIn('id',$orderIDs)->where('status','Pending')->first();
        }
        // dd($orderWithUser);
        // die();
        return view('admin.orders.index',compact('orderWithUser','voucherNoGroups'));
    }

    public function orderAccept() {
        $orders = Order::all();
        // dd($orders);
        $voucherNoGroups = $orders->groupBy('voucherNo')->toArray();
        // dd($voucherNoGroups);
        foreach($voucherNoGroups as $voucher) {
            $orderIDs = array_column($voucher, 'id');
            // var_dump($orderIDs);
            $orderWithUser[] = Order::with('user')->whereIn('id',$orderIDs)->where('status','Accept')->first();
        }
        // dd($orderWithUser);
        // die();
        return view('admin.orders.index',compact('orderWithUser','voucherNoGroups'));
    }

    public function orderComplete() {
        $orders = Order::all();
        // dd($orders);
        $voucherNoGroups = $orders->groupBy('voucherNo')->toArray();
        // dd($voucherNoGroups);
        foreach($voucherNoGroups as $voucher) {
            $orderIDs = array_column($voucher, 'id');
            // var_dump($orderIDs);
            $orderWithUser[] = Order::with('user')->whereIn('id',$orderIDs)->where('status','Complete')->first();
        }
        // dd($orderWithUser);
        // die();
        return view('admin.orders.index',compact('orderWithUser','voucherNoGroups'));
    }

    public function detail($voucherNo){
        // echo $voucherNo;
        $orderFirst = Order::where('voucherNo',$voucherNo)->first();
        // dd($orderFirst);
        $orders = Order::where('voucherNo',$voucherNo)->get();
        return view('admin.orders.detail', compact('orderFirst','orders'));
    }

    public function status(Request $request, $voucherNo) {
        // dd($voucherNo);
        Order::where('voucherNo', $voucherNo)->update(['status' => $request->status]);
        return redirect()->route('backend.orders.index');
    }
}
