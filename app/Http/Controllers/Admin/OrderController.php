<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view order')->only('index');
        $this->middleware('permission:create order')->only(['create', 'store']);
        $this->middleware('permission:edit order')->only(['edit', 'update']);
        $this->middleware('permission:delete order')->only('destroy');

        $this->middleware('permission:view pending-order')->only('index');
        $this->middleware('permission:create pending-order')->only(['create', 'store']);
        $this->middleware('permission:edit pending-order')->only(['edit', 'update']);
        $this->middleware('permission:delete pending-order')->only('destroy');

        $this->middleware('permission:view processing-order')->only('index');
        $this->middleware('permission:create processing-order')->only(['create', 'store']);
        $this->middleware('permission:edit processing-order')->only(['edit', 'update']);
        $this->middleware('permission:delete processing-order')->only('destroy');

        $this->middleware('permission:view on-the-way')->only('index');
        $this->middleware('permission:create on-the-way')->only(['create', 'store']);
        $this->middleware('permission:edit on-the-way')->only(['edit', 'update']);
        $this->middleware('permission:delete on-the-way')->only('destroy');

        $this->middleware('permission:view hold')->only('index');
        $this->middleware('permission:create hold')->only(['create', 'store']);
        $this->middleware('permission:edit hold')->only(['edit', 'update']);
        $this->middleware('permission:delete hold')->only('destroy');

        $this->middleware('permission:view couriers')->only('index');
        $this->middleware('permission:create couriers')->only(['create', 'store']);
        $this->middleware('permission:edit couriers')->only(['edit', 'update']);
        $this->middleware('permission:delete couriers')->only('destroy');

        $this->middleware('permission:view complete')->only('index');
        $this->middleware('permission:create complete')->only(['create', 'store']);
        $this->middleware('permission:edit complete')->only(['edit', 'update']);
        $this->middleware('permission:delete complete')->only('destroy');

        $this->middleware('permission:view cancelled')->only('index');
        $this->middleware('permission:create cancelled')->only(['create', 'store']);
        $this->middleware('permission:edit cancelled')->only(['edit', 'update']);
        $this->middleware('permission:delete cancelled')->only('destroy');
    }


    public function allOrders()
    {
        $orders = Order::latest()->get();
        return view('admin.orders.all', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('orderItems.product', 'user')->findOrFail($id);
        $setting = Setting::first();
        return view('admin.orders.show', compact('order', 'setting'));
    }
    public function updateStatus(Request $request, Order $order)
    {
        $field = $request->field;
        $value = $request->value;

        if (in_array($field, ['status', 'payment_status'])) {

            // যদি payment_status paid হয়
            if ($field === 'payment_status' && $value === 'paid') {
                $order->paid = $order->total; // total amount automatically paid হবে
            }

            $order->$field = $value;
            $order->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }



    public function pendingOrders()
    {
        $orders = Order::where('status', 'pending')->latest()->get();
        return view('admin.orders.pending', compact('orders'));
    }

    public function processingOrders()
    {
        $orders = Order::where('status', 'processing')->latest()->get();
        return view('admin.orders.processing', compact('orders'));
    }

    public function onTheWayOrders()
    {
        $orders = Order::where('status', 'on the way')->latest()->get();
        return view('admin.orders.on-the-way', compact('orders'));
    }

    public function holdOrders()
    {
        $orders = Order::where('status', 'on hold')->latest()->get();
        return view('admin.orders.hold', compact('orders'));
    }

    public function courierOrders()
    {
        $orders = Order::where('status', 'courier')->latest()->get();
        return view('admin.orders.courier', compact('orders'));
    }

    public function completeOrders()
    {
        $orders = Order::where('status', 'completed')->latest()->get();
        return view('admin.orders.complete', compact('orders'));
    }

    public function cancelledOrders()
    {
        $orders = Order::where('status', 'cancelled')->latest()->get();
        return view('admin.orders.cancelled', compact('orders'));
    }
}
