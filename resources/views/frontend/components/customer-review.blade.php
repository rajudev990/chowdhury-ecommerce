@php
    $reviews =  \App\Models\CustomerReview::where('status',1)->get();
@endphp

<!-- Customer Reviews -->
<section id="reviews" class="bg-light py-5">
    <div class="container">
        <h2 class="section-title">Customer Reviews</h2>
        <div class="row justify-content-center g-4">
            @foreach ($reviews as $item)
            <div class="col-md-4">
                <div class="review-card p-4 text-center bg-white rounded shadow-sm">
                    <img src="{{ $item->image ? Storage::url($item->image) : asset('/assets/img/customer.jpg') }}" alt="{{ $item->name}}" class="review-avatar mb-3">
                    <p>{{ $item->review_text }}</p>
                    <h5 class="mt-2">- {{ $item->name}}</h5>
                </div>
            </div>
             @endforeach


        </div>
    </div>
</section>