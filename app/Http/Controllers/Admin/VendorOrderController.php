<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;

class VendorOrderController extends Controller
{
   public function allOrders()
    {
        $vendorId = auth()->guard('vendor')->user()->id;

        $orders = Order::whereHas('orderItems.product', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId); // Filter products by vendor_id
        })
        ->with(['orderItems.product' => function ($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId); // Filter the product within the 'orderItems'
        }])
        ->latest() // Order by the most recent first
        ->get();

       


        return view('vendor.orders.all', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('orderItems.product', 'user')->findOrFail($id);
        $setting = Setting::first();
        return view('vendor.orders.show', compact('order','setting'));
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
        $vendorId = auth()->guard('vendor')->user()->id;
        
        $orders = Order::whereHas('orderItems.product', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId); // Filter products by vendor_id
        })
        ->with(['orderItems.product' => function ($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId); // Filter the product within the 'orderItems'
        }])
        ->where('status', 'pending')
        ->latest() // Order by the most recent first
        ->get();
        
    
       
        return view('vendor.orders.pending', compact('orders'));
    }

    public function processingOrders()
    {
        $vendorId = auth()->guard('vendor')->user()->id;

        $orders = Order::whereHas('orderItems.product', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId); // Filter products by vendor_id
        })
        ->with(['orderItems.product' => function ($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId); // Filter the product within the 'orderItems'
        }])
        ->where('status', 'processing')
        ->latest() // Order by the most recent first
        ->get();
    
      
        
        return view('vendor.orders.processing', compact('orders'));
    }

    public function onTheWayOrders()
    {
        $vendorId = auth()->guard('vendor')->user()->id;

        $orders = Order::whereHas('orderItems.product', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId); // Filter products by vendor_id
        })
        ->with(['orderItems.product' => function ($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId); // Filter the product within the 'orderItems'
        }])
        ->where('status', 'on the way')
        ->latest() // Order by the most recent first
        ->get();
           
        return view('vendor.orders.on-the-way', compact('orders'));
    }

    public function holdOrders()
    {

        $vendorId = auth()->guard('vendor')->user()->id;

        $orders = Order::whereHas('orderItems.product', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId); // Filter products by vendor_id
        })
        ->with(['orderItems.product' => function ($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId); // Filter the product within the 'orderItems'
        }])
        ->where('status', 'on hold')
        ->latest() // Order by the most recent first
        ->get();
        

        
        return view('vendor.orders.hold', compact('orders'));
    }

    public function courierOrders()
    {

        
        $vendorId = auth()->guard('vendor')->user()->id;

        $orders = Order::whereHas('orderItems.product', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId); // Filter products by vendor_id
        })
        ->with(['orderItems.product' => function ($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId); // Filter the product within the 'orderItems'
        }])
        ->where('status', 'courier')
        ->latest() // Order by the most recent first
        ->get();

        
        return view('vendor.orders.courier', compact('orders'));
    }

    public function completeOrders()
    {
        
        $vendorId = auth()->guard('vendor')->user()->id;

        $orders = Order::whereHas('orderItems.product', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId); // Filter products by vendor_id
        })
        ->with(['orderItems.product' => function ($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId); // Filter the product within the 'orderItems'
        }])
        ->where('status', 'completed')
        ->latest() // Order by the most recent first
        ->get();

        
        return view('vendor.orders.complete', compact('orders'));
    }

    public function cancelledOrders()
    {
         
        $vendorId = auth()->guard('vendor')->user()->id;

        $orders = Order::whereHas('orderItems.product', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId); // Filter products by vendor_id
        })
        ->with(['orderItems.product' => function ($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId); // Filter the product within the 'orderItems'
        }])
        ->where('status', 'cancelled')
        ->latest() // Order by the most recent first
        ->get();
        return view('vendor.orders.cancelled', compact('orders'));
    }
}
