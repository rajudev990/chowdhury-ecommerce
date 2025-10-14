@extends('vendor.layouts.app')

@section('title', 'Request Withdrawal')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto max-w-7xl bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">Request Withdrawal</h2>
        </div>

        <!-- Withdrawal Form -->
        <div class="p-6 bg-white rounded-2xl shadow-lg border border-gray-100">
            <form action="{{ route('vendor.withdrawal.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Current Balance -->
                    <div>
                        <label for="balance" class="block text-sm font-semibold text-gray-700 mb-1">Current Balance ({{ currency() }})</label>
                        <input type="number" step="0.01" value="{{ $balance }}" name="balance" id="balance"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:outline-none" readonly>
                    </div>

                    <div>
                        <label for="request_amount" class="block text-sm font-semibold text-gray-700 mb-1">Requested Amount ({{ currency() }})</label>
                        <input type="number" step="0.01" name="request_amount" id="request_amount"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:outline-none"
                            placeholder="Enter amount" required>
                    </div>

                    <div>
                        <label for="commission" class="block text-sm font-semibold text-gray-700 mb-1">Commissions (%)</label>
                        <input type="number" step="0.01" name="commission" id="commission"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:outline-none"
                            value="{{$commissions->vendor_commission }}" readonly>
                    </div>

                    <div>
                        <label for="payable_amount" class="block text-sm font-semibold text-gray-700 mb-1">Payable Amount ({{ currency() }})</label>
                        <input type="number" step="0.01" name="payable_amount" id="payable_amount"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:outline-none"
                            readonly>
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <label for="payment_method" class="block text-sm font-semibold text-gray-700 mb-1">Payment Method</label>
                        <select name="payment_method" id="payment_method"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:outline-none">
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

                    <!-- Payment Information -->
                    <div class="md:col-span-2">
                        <label for="payment_info" class="block text-sm font-semibold text-gray-700 mb-1">Payment Information</label>
                        <textarea name="payment_info" id="payment_info" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:outline-none"
                            placeholder="Enter payment details" required></textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit"
                        class="w-full md:w-auto bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition duration-300">
                        Request Withdrawal
                    </button>
                </div>
            </form>
        </div>


    </div>
</section>
@endsection


@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const balanceInput = document.getElementById('balance');
        const requestInput = document.getElementById('request_amount');
        const commissionInput = document.getElementById('commission');
        const payableInput = document.getElementById('payable_amount');

        function calculatePayable() {
            let balance = parseFloat(balanceInput.value) || 0;
            let requestAmount = parseFloat(requestInput.value) || 0;
            let commissionPercent = parseFloat(commissionInput.value) || 0;

            // Requested amount cannot exceed balance
            if (requestAmount > balance) {
                requestAmount = balance;
                requestInput.value = requestAmount.toFixed(2);
            }

            // Commission calculation
            let commissionAmount = (commissionPercent / 100) * requestAmount;

            // Payable amount
            let payable = requestAmount - commissionAmount;
            payableInput.value = payable.toFixed(2);
        }

        // Only calculate on blur (focusout)
        requestInput.addEventListener('blur', calculatePayable);

        // Optional: initialize on page load
        calculatePayable();
    });
</script>
@endsection