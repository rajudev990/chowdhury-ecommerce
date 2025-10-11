@extends('layouts.app')
@section('title','Checkout')
@section('content')
<section class="checkout-section py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Billing & Shipping Form -->
            <div class="col-lg-7 col-md-12">
                <div class="checkout-form p-4 shadow-sm rounded-3 bg-white">
                    <h2 class="checkout-title mb-4">Checkout</h2>

                    <!-- Billing Information -->
                    <h4 class="mb-3">Billing Information</h4>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="John" required>
                        </div>
                        <div class="col-12">
                            <label for="phone" class="form-label">Phone</label>
                            <input name="phone" type="text" class="form-control" id="phone" placeholder="+8801XXXXXXXXX" required>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="123 Street Name" required>
                        </div>
                        <div class="col-12">
                            <label for="notes" class="form-label">Order Notes (Optional)</label>
                            <textarea class="form-control" id="notes" rows="3" placeholder="Any special requests?"></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <label for="delivery_area" class="form-label">Delivery Area</label>
                            <select name="delivery_area" id="delivery_area" class="form-control form-select" required>
                                <option value="">Select Area</option>
                                <option value="Inside Dhaka" data-value="80">Inside Dhaka-(80Tk)</option>
                                <option value="Outside Dhaka" data-value="120">Outside Dhaka-(120Tk)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <h4 class="mt-5 mb-3">Payment Method</h4>
                    <div class="payment-method mb-4">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                            <label class="form-check-label" for="cod">Cash on Delivery</label>
                        </div>
                        @if(empty($ssl->sslcz_store_id))
                        @else
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="sslcommerz" value="sslcommerz">
                            <label class="form-check-label" for="sslcommerz">SSLCOMMERZ</label>
                        </div>
                        @endif

                    </div>

                    <button id="place-order" class="btn btn-primary w-100 py-2">
                        <i class="fas fa-credit-card me-2"></i> Place Order
                    </button>

            


                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-5 col-md-12">
                <div class="order-summary p-4 shadow-sm rounded-3 bg-white">
                    <h4 class="mb-4">Order Summary</h4>
                    <div id="order-items"></div>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Delivery Charge</span>
                        <span id="delivery-charge">$0.00</span>
                    </div>
                    <div class="order-total d-flex justify-content-between fw-bold fs-5">
                        <span>Total</span>
                        <span id="order-total">$0.00</span>
                    </div>
                    <p class="text-muted mt-2">Shipping & taxes calculated at checkout.</p>
                </div>

                 <!-- Coupon Code Section -->
                <div class="mb-3 mt-3">
                    <label for="coupon-code" class="form-label">Have a coupon?</label>
                    <div class="input-group">
                        <input type="text" id="coupon-code" class="form-control" placeholder="Enter coupon code">
                        <button class="btn btn-primary" type="button" id="apply-coupon">Apply</button>
                    </div>
                    <div id="coupon-message" class="form-text text-success mt-1"></div>
                </div>


            </div>

        </div>
    </div>
</section>
@endsection

@section('script')

<script>
    // Apply discount as percentage
$('#apply-coupon').click(function(){
    var code = $('#coupon-code').val().trim();
    var message = $('#coupon-message');

    if(!code){
        message.text('Please enter a coupon code.');
        message.removeClass('text-success').addClass('text-danger');
        return;
    }

    $.ajax({
        url: "{{ route('coupon.validate') }}",
        method: "POST",
        data: { coupon_code: code },
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        success: function(res){
            if(res.valid){
                // total before discount
                var total = parseFloat($('#order-total').text().replace('$','')) || 0;

                // calculate discount percentage
                var discountPercent = parseFloat(res.amount);
                var discountAmount = (total * discountPercent) / 100;

                message.text('Coupon applied! ' + discountPercent + '% discount ($' + discountAmount.toFixed(2) + ') added.');
                message.removeClass('text-danger').addClass('text-success');

                // show discount below total
                if(!$('#discount-line').length){
                    $('<div class="d-flex justify-content-between mb-2" id="discount-line"><span>Discount ('+discountPercent+'%)</span><span id="discount-amount">-$'+discountAmount.toFixed(2)+'</span></div>').insertBefore('.order-total');
                } else {
                    $('#discount-line span:first').text('Discount ('+discountPercent+'%)');
                    $('#discount-amount').text('-$'+discountAmount.toFixed(2));
                }

                // update total with discount
                var finalTotal = total - discountAmount;
                if(finalTotal < 0) finalTotal = 0;
                $('#order-total').text('$' + finalTotal.toFixed(2));

                // store coupon info in hidden fields
                if(!$('#applied-coupon').length){
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'applied-coupon',
                        name: 'coupon_code',
                        value: code
                    }).appendTo('.order-summary');
                } else {
                    $('#applied-coupon').val(code);
                }

                if(!$('#coupon-amount').length){
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'coupon-amount',
                        name: 'coupon_amount',
                        value: discountAmount.toFixed(2)
                    }).appendTo('.order-summary');
                } else {
                    $('#coupon-amount').val(discountAmount.toFixed(2));
                }

            } else {
                message.text('Invalid or expired coupon.');
                message.removeClass('text-success').addClass('text-danger');
                $('#discount-line').remove();
            }
        },
        error: function(){
            message.text('Something went wrong.');
            message.removeClass('text-success').addClass('text-danger');
        }
    });
});

</script>

<script>
$(document).ready(function(){
    var cart = JSON.parse(localStorage.getItem('cart')) || [];
    var $orderItems = $('#order-items');
    var total = 0;
    var deliveryCharge = 0;

    function renderCart() {
        $orderItems.empty();
        total = 0;
        if(cart.length === 0){
            $orderItems.html('<p class="text-muted">Your cart is empty.</p>');
        } else {
            cart.forEach(function(item, index){
                var subtotal = item.price * item.quantity;
                total += subtotal;
                var html = `<div class="order-item d-flex justify-content-between mb-2">
                    <span>${item.name} (x${item.quantity})</span>
                    <span>$${subtotal.toFixed(2)}</span>
                </div>`;
                $orderItems.append(html);
            });
        }
        updateTotal();
    }

    function updateTotal() {
        $('#delivery-charge').text('$' + deliveryCharge.toFixed(2));
        $('#order-total').text('$' + (total + deliveryCharge).toFixed(2));
    }

    $('#delivery_area').change(function(){
        deliveryCharge = parseFloat($(this).find('option:selected').data('value')) || 0;
        updateTotal();
    });

    renderCart();

    // Place Order
    $('#place-order').click(function(e){
    e.preventDefault(); // prevent default button action

    var payment_method = $('input[name="payment_method"]:checked').val();
    var orderData = {
        customer_name: $('#name').val(),
        phone: $('#phone').val(),
        address: $('#address').val(),
        notes: $('#notes').val(),
        delivery_area: $('#delivery_area').val(),
        delivery_charge: deliveryCharge,
        payment_method: payment_method,
        items: cart,
        total: total + deliveryCharge,
        _token: '{{ csrf_token() }}'
    };

    if(payment_method === 'cod'){
        // Normal AJAX order for COD
        $.post("{{ route('order.store') }}", orderData, function(res){
            localStorage.removeItem('cart');
            alert('Order placed successfully with COD!');
            window.location.href = "{{ url('/') }}";
        });
    } else if(payment_method === 'sslcommerz'){
        // Redirect to /pay with form submission (no AJAX)
        // Dynamically create a form
        var form = $('<form>', {
            'method': 'POST',
            'action': '{{ route("pay") }}'
        });

        // Add CSRF token
        form.append($('<input>', {
            'type': 'hidden',
            'name': '_token',
            'value': '{{ csrf_token() }}'
        }));

        // Add all order data
        $.each(orderData, function(key, value){
            // Convert items array to JSON string
            if(key === 'items'){
                value = JSON.stringify(value);
            }
            form.append($('<input>', {
                'type': 'hidden',
                'name': key,
                'value': value
            }));
        });

        // Append form to body and submit
        form.appendTo('body').submit();
    }
});

});
</script>

@endsection
