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
            </div>

        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
    // Get cart from localStorage
    var cart = JSON.parse(localStorage.getItem('cart')) || [];
    var $orderItems = $('#order-items');
    var total = 0;
    var deliveryCharge = 0;

    // Render cart items
    function renderCart() {
        $orderItems.empty();
        total = 0;

        if(cart.length === 0){
            $orderItems.html('<p class="text-muted">Your cart is empty.</p>');
        } else {
            cart.forEach(function(item, index){
                var price = item.price || 0;
                var subtotal = price * item.quantity;
                total += subtotal;

                var productUrl = "{{ url('product') }}/" + item.slug;

                var html = `
                    <div class="order-item d-flex justify-content-between align-items-center mb-2">
                        <span class="d-flex align-items-center">
                            <i class="fas fa-trash text-danger me-2 remove-item" data-index="${index}"></i>
                            <a href="${productUrl}" class="text-decoration-none text-dark">
                                ${item.name}${item.color ? ' - ' + item.color : ''}${item.size ? ' - ' + item.size : ''}
                            </a> (x${item.quantity})
                        </span>
                        <span>
                            $${subtotal.toFixed(2)}
                        </span>
                    </div>
                `;
                $orderItems.append(html);
            });
        }

        updateTotal();
    }

    // Update delivery charge & total
    function updateTotal() {
        $('#delivery-charge').text('$' + deliveryCharge.toFixed(2));
        $('#order-total').text('$' + (total + deliveryCharge).toFixed(2));
    }

    // Remove item from cart
    $(document).on('click', '.remove-item', function(){
        var index = $(this).data('index');
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCart();
    });

    // Delivery area change
    $('#delivery_area').change(function(){
        var selected = $(this).find('option:selected');
        deliveryCharge = parseFloat(selected.data('value')) || 0;
        updateTotal();
    });

    // Initial render
    renderCart();

    // Place Order
    $('#place-order').click(function(){
        var name = $('#name').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var notes = $('#notes').val();
        var delivery_area = $('#delivery_area').val();
        var payment_method = $('input[name="payment_method"]:checked').val();

        if(cart.length === 0){
            alert('Cart is empty!');
            return;
        }

        if(!name || !phone || !address || !delivery_area){
            alert('Please fill all required fields!');
            return;
        }

        var orderItems = cart.map(function(item){
            // Create variant array/object
            var variant = {};
            if(item.color) variant.color = item.color;
            if(item.size) variant.size = item.size;

            return {
                productId: item.productId,
                variantId: Object.keys(variant).length > 0 ? variant : null, // Only send if exists
                quantity: item.quantity,
                price: item.price
            };
        });

        var orderData = {
            customer_name: name,
            phone: phone,
            address: address,
            notes: notes,
            delivery_area: delivery_area,
            delivery_charge: deliveryCharge,
            payment_method: payment_method,
            items: orderItems,
            total: total + deliveryCharge
        };

        $.ajax({
            url: "{{ route('order.store') }}",
            method: "POST",
            data: orderData,
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            success: function(res){
                localStorage.removeItem('cart'); // Clear cart
                alert('Order placed successfully!');
                window.location.href = "{{ url('/') }}";
            },
            error: function(err){
                alert('Something went wrong. Please try again.');
            }
        });
    });


});

</script>
@endsection
