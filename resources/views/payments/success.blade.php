<x-app-layout>
    <div class="max-w-xl mx-auto py-12 px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-8 rounded-lg">
            <h2 class="text-3xl font-bold mb-4">Payment Successful!</h2>
            <p class="mb-6">Thank you for your payment. Your transaction has been completed successfully.</p>
            <a href="{{ route('services') }}" class="inline-block px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-md font-semibold transition">
                Back to Services
            </a>
        </div>
    </div>
</x-app-layout>
