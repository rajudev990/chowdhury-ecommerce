@php
$setting = \App\Models\Setting::first();
$categories = \App\Models\Category::all();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ $setting->favicon ? Storage::url($setting->favicon) : asset('/assets/img/null.png') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/style.css">
</head>

<body>

    @include('layouts.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')


    <a href="https://wa.me/{{ $setting->phone_one }}" target="_blank" class="whatsapp-float text-decoration-none">
        <i class="fab fa-whatsapp"></i>
    </a>


    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
    </script>
    <script>
        function toggleCart() {
            document.getElementById("cartSidebar").classList.toggle("active");
        }
    </script>
    <script>
        function removeCartItem(icon) {
            icon.closest(".cart-item").remove();
        }
    </script>
    <script>
        // Thumbnail click করলে main image update হবে
        const mainImage = document.getElementById('currentImage');
        const thumbnails = document.querySelectorAll('.image-thumbnails .thumb');

        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                // main image change
                mainImage.src = this.src;

                // active class update
                thumbnails.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
    <script>
        function updateVariantInfo(variantId) {
            let variantOption = document.querySelector(`option[value='${variantId}']`);
            if (variantOption) {
                let price = variantOption.dataset.price;
                let stock = variantOption.dataset.stock;
                document.getElementById('variant-price').innerText = price;
                document.getElementById('variant-stock').innerText = stock;
            }
        }

        const colorSelect = document.getElementById('variant-color');
        const sizeSelect = document.getElementById('variant-size');

        if (colorSelect) {
            colorSelect.addEventListener('change', function() {
                updateVariantInfo(this.value);
            });
        }

        if (sizeSelect) {
            sizeSelect.addEventListener('change', function() {
                updateVariantInfo(this.value);
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            var $qty = $('#qty');
            var stock = parseInt($('#variant-stock').text()) || 100;

            function updateVariant() {
                var colorOpt = $('#variant-color option:selected');
                var sizeOpt = $('#variant-size option:selected');

                // Determine if variant exists
                var price = (sizeOpt.data('price') || colorOpt.data('price')) || parseFloat($('#variant-price').text());
                var stockVal = (sizeOpt.data('stock') || colorOpt.data('stock')) || stock;
                var colorName = colorOpt.data('color') || '';
                var sizeName = sizeOpt.data('size') || '';

                $('#variant-price').text(price);
                $('#variant-stock').text(stockVal);
                stock = stockVal;
                if (parseInt($qty.val()) > stock) $qty.val(stock);
            }

            $('#increment').click(function() {
                var val = parseInt($qty.val()) || 1;
                if (val < stock) $qty.val(val + 1);
            });
            $('#decrement').click(function() {
                var val = parseInt($qty.val()) || 1;
                if (val > 1) $qty.val(val - 1);
            });
            $qty.on('input', function() {
                var val = parseInt($qty.val()) || 1;
                if (val < 1) $qty.val(1);
                if (val > stock) $qty.val(stock);
            });

            $('#variant-color, #variant-size').change(updateVariant);

            $('#add-to-cart').click(function() {
                var productId = $(this).data('product-id');
                var productName = $(this).data('name'); // Blade থেকে pass
                var productSlug = $(this).data('slug'); // Blade থেকে pass
                var image = $(this).data('image'); // fallback image
                var quantity = parseInt($('#qty').val()) || 1;

                // Variant info
                var colorOpt = $('#variant-color option:selected');
                var sizeOpt = $('#variant-size option:selected');
                var price = 0,
                    color = '',
                    size = '',
                    stock = parseInt($('#variant-stock').text()) || 100;

                if (colorOpt.length || sizeOpt.length) {
                    // Variant exists
                    price = parseFloat(sizeOpt.data('price') || colorOpt.data('price') || $('#variant-price').text()) || 0;
                    stock = parseInt(sizeOpt.data('stock') || colorOpt.data('stock') || stock);
                    color = colorOpt.text() || '';
                    size = sizeOpt.text() || '';
                } else {
                    // No variant → fallback price
                    price = parseFloat($(this).data('price')) || 0;
                }

                if (quantity > stock) {
                    alert('Quantity exceeds stock!');
                    return;
                }

                var cart = JSON.parse(localStorage.getItem('cart')) || [];
                var existing = cart.find(item => item.productId == productId && item.color == color && item.size == size);

                if (existing) {
                    existing.quantity += quantity;
                    if (existing.quantity > stock) existing.quantity = stock;
                } else {
                    cart.push({
                        productId: productId,
                        name: productName,
                        slug: productSlug,
                        image: image,
                        color: color,
                        size: size,
                        price: price,
                        quantity: quantity
                    });
                }

                localStorage.setItem('cart', JSON.stringify(cart));
                window.location.href = "{{ route('checkout') }}";
            });

        });
    </script>

    <script>
        function toggleCart() {
            $('#cartSidebar').toggle();
        }

        function renderSidebarCart() {
            var cart = JSON.parse(localStorage.getItem('cart')) || [];
            var $cartBody = $('#cartSidebar .cart-body');
            var $cartTotal = $('#cartSidebar .cart-footer .price');
            var $badge = $('.position-relative .badge');
            var $fcart = $('.fcart');
           
            $cartBody.empty();
            var total = 0;

            if (cart.length === 0) {
                $cartBody.html('<p class="text-light">Your cart is empty.</p>');
            } else {
                cart.forEach(function(item, index) {
                    var subtotal = item.price * item.quantity;
                    total += subtotal;

                    var html = `
            <div class="cart-item d-flex align-items-center mb-3">
                <img src="${item.image}" class="rounded me-2" alt="${item.name}" style="width:50px;height:50px;">
                <div class="flex-grow-1">
                    <h6 class="mb-1 text-white">${item.name}${item.color ? ' - '+item.color : ''}${item.size ? ' - '+item.size : ''}</h6>
                    <small class="text-light">Qty: ${item.quantity}</small>
                </div>
                <span class="price fw-bold me-2">৳ ${subtotal}</span>
                <i class="bi bi-trash text-danger" style="cursor:pointer; font-size:18px;" data-index="${index}"></i>
            </div>
            `;
                    $cartBody.append(html);
                });
            }

            $cartTotal.text('৳ ' + total);
            $badge.text(cart.length);
            $fcart.text('Cart (' + cart.length + ')');
        }

        // Remove from sidebar
        $(document).on('click', '.cart-item .bi-trash', function() {
            var index = $(this).data('index');
            var cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            renderSidebarCart();
        });

        // Initial render
        $(document).ready(function() {
            renderSidebarCart();
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.order-now', function(e) {
                e.preventDefault();

                var productId = $(this).data('id');
                var name = $(this).data('name');
                var image = $(this).data('image');
                var price = parseFloat($(this).data('price'));
                var slug = $(this).data('slug');
                var hasVariant = $(this).data('has-variant');

                // যদি variation থাকে -> single product page-এ redirect করো
                if (hasVariant == 1) {
                    window.location.href = "{{ url('product') }}/" + slug;
                    return;
                }

                // Variation না থাকলে সরাসরি checkout-এ
                var cart = JSON.parse(localStorage.getItem('cart')) || [];

                // আগে থেকে product আছে কিনা চেক করো
                var existing = cart.find(item => item.productId == productId);

                if (existing) {
                    existing.quantity += 1;
                } else {
                    cart.push({
                        productId: productId,
                        name: name,
                        image: image,
                        price: price,
                        quantity: 1,
                        slug: slug
                    });
                }

                localStorage.setItem('cart', JSON.stringify(cart));

                // Checkout এ নিয়ে যাও
                window.location.href = "{{ url('checkout') }}";
            });
        });
    </script>

<script>
$(document).ready(function() {
    let $searchInput = $('#searchInput');
    let $searchResults = $('#searchResults');
    let typingTimer;
    let doneTypingInterval = 300; // typing delay (ms)

    // 🟢 Typing detection
    $searchInput.on('keyup', function() {
        clearTimeout(typingTimer);
        let query = $(this).val().trim();

        if(query.length > 1) {
            typingTimer = setTimeout(function() {
                performSearch(query);
            }, doneTypingInterval);
        } else {
            $searchResults.addClass('d-none').empty();
        }
    });

    // 🟢 AJAX Search
    function performSearch(query) {
        $.ajax({
            url: "{{ route('product.liveSearch') }}",
            method: "GET",
            data: { q: query },
            success: function(res) {
                renderResults(res);
            },
            error: function() {
                $searchResults.addClass('d-none').empty();
            }
        });
    }

    // 🟢 Render search results
    function renderResults(products) {
        $searchResults.empty();

        if(products.length === 0) {
            $searchResults.removeClass('d-none').html('<p class="p-2 mb-0 text-muted">No products found.</p>');
            return;
        }

        products.forEach(function(product) {
            let salePrice = parseFloat(product.sale_price).toFixed(2);
            let regularPrice = parseFloat(product.regular_price).toFixed(2);
            let url = "{{ url('product') }}/" + product.slug;

            let html = `
                <a href="${url}" class="d-flex justify-content-between align-items-center p-2 border-bottom text-decoration-none text-dark hover-bg-light">
                    <div>
                        <div class="fw-semibold">${product.name}</div>
                        <div class="small">
                            <span class="text-muted text-decoration-line-through me-2">$${regularPrice}</span>
                            <span class="fw-bold text-primary">$${salePrice}</span>
                        </div>
                    </div>
                </a>
            `;
            $searchResults.append(html);
        });

        $searchResults.removeClass('d-none');
    }

    // 🟢 Hide results if clicked outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#searchForm').length) {
            $searchResults.addClass('d-none');
        }
    });
});
</script>

    @yield('script')

</body>

</html>