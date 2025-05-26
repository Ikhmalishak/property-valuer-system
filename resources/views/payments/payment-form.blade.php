<x-app-layout>
    <div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-blue-600 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">Confirm Your Payment</h2>
            </div>

            <!-- Service Details -->
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $service->name }}</h3>
                <p class="text-gray-600 mb-4">{{ $service->description }}</p>

                <div class="flex justify-between items-center bg-gray-50 px-4 py-3 rounded-lg">
                    <span class="text-gray-700 font-medium">Total Amount</span>
                    <span class="text-2xl font-bold text-blue-600">RM {{ number_format($service->price, 2) }}</span>
                </div>
            </div>

            <!-- User Details (Auto-filled for logged in users) -->
            <div class="p-6">
                @auth
                <div class="mb-6">
                    <h4 class="text-md font-medium text-gray-700 mb-3">Your Information</h4>
                    <div class="space-y-2">
                        <div class="flex">
                            <span class="w-1/3 text-gray-600">Name:</span>
                            <span class="w-2/3 font-medium">{{ auth()->user()->name }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-1/3 text-gray-600">Email:</span>
                            <span class="w-2/3 font-medium">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                </div>
                @endauth

                <!-- Payment Form -->
                <form id="payment-form" action="{{ route('payments.pay', $service) }}" method="POST">
                    @csrf

                    <!-- Payment Method Selection -->
                    <div class="mb-6">
                        <h4 class="text-md font-medium text-gray-700 mb-3">Payment Method</h4>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <input id="stripe" name="payment_method" type="radio" value="stripe" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                <label for="stripe" class="ml-3 block text-gray-700">
                                    <span class="font-medium">Credit/Debit Card</span>
                                    <span class="text-sm text-gray-500">(Powered by Stripe)</span>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input id="fpx" name="payment_method" type="radio" value="fpx" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                <label for="fpx" class="ml-3 block text-gray-700">
                                    <span class="font-medium">Online Banking (FPX)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Stripe Card Element (only show when Stripe is selected) -->
                    <div id="stripe-card-section" class="mb-6">
                        <h4 class="text-md font-medium text-gray-700 mb-3">Card Details</h4>
                        <div id="card-element" class="p-3 border border-gray-300 rounded-md">
                            <!-- Stripe Elements will create form elements here -->
                        </div>
                        <div id="card-errors" role="alert" class="text-red-600 text-sm mt-2"></div>
                    </div>

                    <!-- Terms Agreement -->
                    <div class="flex items-start mb-6">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" value="1" required class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                        </div>
                        <label for="terms" class="ml-3 block text-sm text-gray-700">
                            I agree to the <a href="#" class="text-blue-600 hover:underline">terms and conditions</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-lg font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        Pay Now
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Show/hide card section based on payment method
        document.addEventListener('DOMContentLoaded', function() {
            const stripeRadio = document.getElementById('stripe');
            const fpxRadio = document.getElementById('fpx');
            const cardSection = document.getElementById('stripe-card-section');

            function toggleCardSection() {
                if (stripeRadio.checked) {
                    cardSection.style.display = 'block';
                } else {
                    cardSection.style.display = 'none';
                }
            }

            stripeRadio.addEventListener('change', toggleCardSection);
            fpxRadio.addEventListener('change', toggleCardSection);
            
            // Initial state
            toggleCardSection();
        });
    </script>

    @vite(['resources/js/stripe.js'])

</x-app-layout>