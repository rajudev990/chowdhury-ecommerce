<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Setting;
use App\Models\VendorWithdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // Revenue
    public function revenue()
    {
       $vendorId = Auth::guard('vendor')->id();

        // Fetch orders with vendor-specific order items
        $orders = Order::whereHas('orderItems.product', function($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId);
        })->with(['orderItems' => function($q) use ($vendorId) {
            $q->whereHas('product', fn($p) => $p->where('vendor_id', $vendorId))
            ->with('product:id,name,vendor_id');
        }])->get();

        // Calculate balance (only paid orders)
        $balance = 0;
        foreach($orders as $order) {
            if($order->payment_status === 'paid'){
                foreach($order->orderItems as $item){
                    $balance += $item->quantity * $item->price;
                }
            }
        }

        $withdraw = VendorWithdraw::where('vendor_id', Auth::guard('vendor')->user()->id)->sum('payable_amount');

        $balance = $balance - $withdraw;

        return view('vendor.orders.revenue', compact('orders','balance'));

    }

    // withdraw
    public function withdraw()
    {
        $data = VendorWithdraw::where('vendor_id', Auth::guard('vendor')->user()->id)->get();
        return view('vendor.withdraw', compact('data'));
    }
    public function showWithdrawPage()
    {
        
        $vendorId = Auth::guard('vendor')->id();

        // Fetch orders with vendor-specific order items
        $orders = Order::whereHas('orderItems.product', function($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId);
        })->with(['orderItems' => function($q) use ($vendorId) {
            $q->whereHas('product', fn($p) => $p->where('vendor_id', $vendorId))
            ->with('product:id,name,vendor_id');
        }])->get();

        // Calculate balance (only paid orders)
        $balance = 0;
        foreach($orders as $order) {
            if($order->payment_status === 'paid'){
                foreach($order->orderItems as $item){
                    $balance += $item->quantity * $item->price;
                }
            }
        }

        $withdraw = VendorWithdraw::where('vendor_id', Auth::guard('vendor')->user()->id)->sum('payable_amount');

        $balance = $balance - $withdraw;
        $commissions = Setting::first();
        return view('vendor.withdraw-request',compact('balance','commissions'));
    }

    public function storeWithdraw(Request $request)
    {
        $request->validate([
            'request_amount' => 'required|numeric|min:1',
            'payable_amount' => 'required|numeric|min:1',
            'commission' => 'required|numeric|min:1',
            'payment_method' => 'required|string',
            'payment_info' => 'required|string',
        ]);

        // Store the withdrawal request
        VendorWithdraw::create([
            'vendor_id' => Auth::guard('vendor')->user()->id,
            'request_amount' => $request->request_amount,
            'payable_amount' => $request->payable_amount,
            'commission' => $request->commission,
            'payment_method' => $request->payment_method,
            'payment_info' => $request->payment_info,
            'status' => 'pending', // Default status is 'pending'
        ]);

        return redirect()->route('vendor.withdrawal')->with('success', 'Withdrawal request submitted successfully.');
    }
}
