<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Available Services</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($services as $service)
                <div class="bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $service->name }}</h2>
                    <p class="text-gray-600 mb-3">{{ $service->description }}</p>
                    <p class="text-lg font-bold text-green-600 mb-4">RM {{ number_format($service->price, 2) }}</p>
                    <a href="{{ route('services.showForm', $service) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Pay Now
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
