@extends('layouts.app')
@section('title','Contact')
@section('content')
<!-- Main -->
<section class="contact-section py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title">Get in Touch</h2>
                <p class="text-muted">We would love to hear from you! Send us a message or find us at our office.
                </p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Contact Form -->
            <div class="col-lg-6">
                <div class="contact-card p-4 shadow-sm rounded-4 bg-white">
                    <h4 class="mb-4">Send Us a Message</h4>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('contact.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="John Doe" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input name="phone" type="number" class="form-control" id="phone" placeholder=""
                                required>
                        </div>

                        <!-- <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input name="email" type="email" class="form-control" id="email" placeholder="john@example.com"
                                required>
                        </div> -->

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject" required>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" class="form-control" id="message" rows="5" placeholder="Your message..."
                                required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">
                            <i class="fas fa-paper-plane me-2"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-6">
                <div class="contact-info p-4 shadow-sm rounded-4 bg-white h-100">
                    <h4 class="mb-4">Contact Information</h4>
                    <p><i class="fas fa-map-marker-alt me-2 text-primary"></i> {{ $setting->address }}
                    </p>
                    <p><i class="fas fa-phone-alt me-2 text-primary"></i> {{ $setting->phone_one }}</p>
                    <p><i class="fas fa-envelope me-2 text-primary"></i> {{ $setting->email_one }}</p>
                    <p><i class="fas fa-clock me-2 text-primary"></i> Mon – Fri: 9:00 AM – 6:00 PM</p>

                    <div class="mt-4">
                        <h5>Find Us on Map</h5>
                        <div class="map-placeholder mt-2 rounded-4 overflow-hidden">
                            <!-- Replace with actual Google Maps iframe -->
                            <iframe src="{{ $setting->google_maps }}"
                                width="100%" height="250" style="border:0;" allowfullscreen=""
                                loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main -->
@endsection