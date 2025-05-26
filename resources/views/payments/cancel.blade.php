<x-app-layout>
    <div class="max-w-xl mx-auto py-12 px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-6 py-8 rounded-lg">
            <h2 class="text-3xl font-bold mb-4">Payment Cancelled</h2>
            <p class="mb-6">Your payment was not completed. You can try again or contact support if you have any issues.</p>
            <a href="{{ route('services') }}" class="inline-block px-6 py-3 bg-yellow-600 hover:bg-yellow-700 text-white rounded-md font-semibold transition">
                Back to Services
            </a>
        </div>
    </div>
</x-app-layout>
