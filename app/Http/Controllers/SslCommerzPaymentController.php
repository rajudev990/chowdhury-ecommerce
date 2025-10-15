<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'delivery_area' => 'required|string',
            'payment_method' => 'required|string',
            'items' => 'required|string',
            'total' => 'required|numeric',
        ]);

        $items = json_decode($request->items, true);
        $tran_id = uniqid('TRX_');

        if (Auth::check()) {
            $userId = Auth::id();
            $email = Auth::user()->email;
        } else {
            $unique = time() . Str::random(4);
            $email = 'guest_' . $unique . '@example.com';
            $guest = User::create([
                'name' => $request->customer_name,
                'email' => $email,
                'phone' => $request->phone,
                'address' => $request->address,
                'username' => 'guest_' . $unique,
                'password' => bcrypt(Str::random(8)),
            ]);
            $userId = $guest->id;
        }

        $order = Order::create([
            'user_id' => $userId,
            'total' => $request->total,
            'delivery_charge' => $request->delivery_charge ?? 0,
            'coupon' => $request->coupon_amount ?? 0,
            'coupon_code' => $request->coupon_code ?? null,
            'status' => 'pending',
            'payment_status' => 'unpaid', // ❗️Start as unpaid
            'payment_method' => 'sslcommerz',
            'transaction_id' => $tran_id,
            'delivery_area' => $request->delivery_area,
            'currency' => 'BDT',
            'notes' => $request->notes ?? null,
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['productId'],
                'product_variant_id' => $item['variantId'] ?? null,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }


        $post_data = [
            'total_amount' => $order->total,
            'currency' => 'BDT',
            'tran_id' => $tran_id,
            'cus_name' => $request->customer_name,
            'cus_email' => $email,
            'cus_add1' => $request->address,
            'cus_country' => 'Bangladesh',
            'cus_phone' => $request->phone,
            'shipping_method' => 'NO',
            'ship_name' => $request->customer_name,
            'ship_add1' => $request->address,
            'ship_country' => 'Bangladesh',
            'product_name' => 'Order #' . $order->id,
            'product_category' => 'Goods',
            'product_profile' => 'physical-goods',
            'value_a' => $order->id,
            'order_id' => $order->order_id,
            'value_b' => $request->coupon_code ?? null,


        ];


        $sslc = new SslCommerzNotification();
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            \Log::error('SSLCommerz Payment Error', ['response' => $payment_options]);
            return back()->with('error', 'SSLCommerz payment initiation failed.');
        }

        // hosted payment auto redirect করবে
    }


   public function success(Request $request)
{
    dd(12);
    $order_id = $request->input('value_a'); // SSLCommerz sends order id here

    if (!$order_id) {
        return redirect('/')->with('error', 'Order ID not found!');
    }

    $tran_id = $request->input('tran_id');
    $amount = $request->input('amount');
    $currency = $request->input('currency');

    $sslc = new SslCommerzNotification();
    $order = Order::find($order_id);

    if ($order && $order->status == 'pending') {
        $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);
        if ($validation) {
            $order->update([
                'status' => 'processing',
                'payment_status' => 'paid'
            ]);
        }
    }

    return redirect()->route('order.success', ['order_id' => $order_id]);
}




    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    // public function success()
    // {

    //     // SSLCommerz থেকে order_id pathanor jonno value_a use koro
    //     $order_id = $request->input('order_id'); // value_a contains order id

    //     if (!$order_id) {
    //         return redirect('/')->with('error', 'Order ID not found!');
    //     }

    //     session()->flash('success', 'Order Created Successfully');



    //     // এখন /success/{order_id} route এ redirect করো
    //     return redirect()->route('order.success', ['order_id' => $order_id]);


    //     return "Transaction is Successful";

    //     $tran_id = $request->input('tran_id');
    //     $amount = $request->input('amount');
    //     $currency = $request->input('currency');

    //     $sslc = new SslCommerzNotification();

    //     #Check order status in order tabel against the transaction id or order id.
    //     $order_details = DB::table('orders')
    //         ->where('transaction_id', $tran_id)
    //         ->select('transaction_id', 'status', 'currency', 'amount')->first();

    //     if ($order_details->status == 'Pending') {
    //         $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

    //         if ($validation) {
    //             /*
    //             That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
    //             in order table as Processing or Complete.
    //             Here you can also sent sms or email for successfull transaction to customer
    //             */
    //             $update_product = DB::table('orders')
    //                 ->where('transaction_id', $tran_id)
    //                 ->update(['status' => 'Processing']);

    //             echo "<br >Transaction is successfully Completed";
    //         }
    //     } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
    //         /*
    //          That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
    //          */
    //         echo "Transaction is successfully Completed";
    //     } else {
    //         #That means something wrong happened. You can redirect customer to your product page.
    //         echo "Invalid Transaction";
    //     }
    // }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}
