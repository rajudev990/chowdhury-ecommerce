@extends('layouts.app')
@section('title', 'Order Success')
@section('content')

<div id="content">
    <section class="customer-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="success-img">
                        <img src="https://www.bag.nexabyteit.com/public/frontEnd/images/order-success.png" alt="" class="img-fluid">
                    </div>
                    <div class="success-title">
                        <h2>আপনার অর্ডারটি আমাদের কাছে সফলভাবে পৌঁছেছে, কিছুক্ষনের মধ্যে আমাদের একজন প্রতিনিধি আপনার নাম্বারে কল করবেন </h2>
                    </div>

                    <h5 class="my-3">Your Order Details</h5>
                    <div class="success-table">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>
                                        <p>Invoice ID</p>
                                        <p><strong>{{ $data->order_id }}</strong></p>
                                    </td>
                                    <td>
                                        <p>Date</p>
                                        <p><strong>{{ $data->payment_date }}</strong></p>
                                    </td>
                                    <td>
                                        <p>Phone</p>
                                        <p><strong>{{ $data->user->phone }}</strong></p>
                                    </td>
                                    <td>
                                        <p>Total</p>
                                        <p><strong>{{ currency() }}{{ number_format($data->total,2) }}</strong></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <p>Payment Method</p>
                                        <p><strong>{{ $data->payment_method }}</strong></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- success table -->
                    <h5 class="my-4">Pay with cash upon delivery</h5>
                    <div class="success-table">
                        <h6 class="mb-3">Order Delivery</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>

                            @php 
                            $net_total = 0;
                            @endphp

                                @foreach($data->orderItems as $item)
                                <tr>
                                    <td>
                                        <p>{{ $item->product->name }} –  x {{ $item->quantity }}</p>

                                    </td>
                                    <td>
                                        <p><strong>{{ currency() }}{{ number_format($item->price,2) }}</strong></p>
                                    </td>
                                </tr>

                                 @php 
                                    $net_total += $item->quantity * $item->price;
                                @endphp

                                
                                @endforeach

                                <tr>
                                    <th class="text-end px-4">Net Total</th>
                                    <td><strong id="net_total">{{ currency() }}{{ number_format($net_total,2) }}</strong></td>
                                </tr>

                                <tr>
                                    <th class="text-end px-4">Shipping Cost</th>
                                    <td>
                                        <strong id="cart_shipping_cost">{{ currency() }}{{ number_format($data->delivery_charge,2) }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-end px-4">Grand Total</th>
                                    <td>
                                        <strong id="grand_total">{{ currency() }}{{ number_format($data->total,2) }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 class="my-4">Billing Address</h5>
                                        <p>{{ $data->user->name }}</p>
                                        <p>{{ $data->user->phone }}</p>
                                        <p>{{ $data->user->address }}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- success table -->
                    <a href="/" class=" my-5 btn btn-primary">Go To Home</a>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- content end -->

@endsection