@extends('affiliate.layouts.app')

@section('title', 'Request Withdrawal')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto max-w-7xl bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">Request Withdrawal</h2>
        </div>

        <!-- Withdrawal Form -->
        <div class="p-6">
            <form action="{{ route('affiliate.withdraw.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="amount" class="block text-sm font-semibold text-gray-700">Current Balance ({{ currency() }})</label>
                    <input type="text" value="{{ number_format($balance,2) }}" name="balance"  class="w-full px-4 py-2 border border-gray-300 rounded-lg" readonly>
                </div>

                <div class="mb-4">
                    <label for="amount" class="block text-sm font-semibold text-gray-700">Amount</label>
                    <input type="number" name="amount" id="amount" class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="Enter amount" required>
                </div>
                <div class="mb-4">
                    <label for="payment_method" class="block text-sm font-semibold text-gray-700">Payment Method</label>
                    <select name="payment_method" id="payment_method" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="bank">Bank Transfer</option>
                        <option value="paypal">PayPal</option>
                        <option value="stripe">Stripe</option>
                        <option value="bkash">Bkash</option>
                        <option value="rocket">Rocket</option>
                        <option value="nagad">Nagad</option>
                        <option value="ssl">SSL</option>
                        <option value="upay">Upay</option>
                        <option value="brac_bank">BRAC Bank</option>
                        <option value="dbbl">Dutch-Bangla Bank (DBBL)</option>
                        <option value="scb">Standard Chartered Bank (SCB)</option>
                        <option value="commercial_bank">Commercial Bank</option>
                        <option value="city_bank">City Bank</option>
                        <option value="exim_bank">EXIM Bank</option>
                        <option value="islami_bank">Islami Bank Bangladesh</option>
                        <option value="mutual_trust_bank">Mutual Trust Bank (MTB)</option>
                        <option value="prime_bank">Prime Bank</option>
                        <option value="southeast_bank">Southeast Bank</option>
                    </select>

                </div>
                <div class="mb-4">
                    <label for="payment_info" class="block text-sm font-semibold text-gray-700">Payment Information</label>
                    <textarea name="payment_info" id="payment_info" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="Enter payment details" required></textarea>
                </div>
                <div class="mb-4">
                    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition duration-300">
                        Request Withdrawal
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>
@endsection