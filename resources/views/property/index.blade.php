<x-app-layout>
    <div class="flex min-h-screen bg-gray-50">
        <!-- Main Content -->
        <main class="flex-1 overflow-auto">
            <div class="px-8 py-6">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back {{ $user->name }}</h1>
                    <p class="text-gray-600">Here's what's happening with your projects today.</p>
                </div>
                <!-- Quick Stats Section -->
                <section class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Quick Stats</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Card 1 - Total Properties Paid -->
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-2 bg-green-100 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-green-600 font-medium">+12.5%</span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Total properties Paid</h3>
                            <p class="text-3xl font-bold text-gray-900">$45,231</p>
                        </div>
                        <!-- Other cards can be added here -->
                    </div>
                </section>
                <!-- Properties Table Section -->
                <section class="bg-white rounded-xl shadow-sm border border-gray-100">
                 <!-- Compact Header with Button and Search -->
<div class="p-4 border-b border-gray-200">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">Properties</h2>
            <p class="text-gray-600 text-sm">Your latest transactions and updates</p>
        </div>
        <div class="flex items-center space-x-3">
            <div class="relative">
                <input type="text" id="searchInput" placeholder="Search..." 
                       class="pl-10 pr-4 py-2 w-48 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <button id="openFormButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Property
            </button>
        </div>
    </div>
</div>
                    
                    <!-- Show Success Message -->
                    @if(session('success'))
                        <div class="p-4 bg-green-100 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- Show Validation Errors -->
                    @if($errors->any())
                        <div class="p-4 bg-red-100 text-red-700 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <!-- Properties Table -->
                    @if ($properties->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombor Kait</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombor Lot</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombor Geran</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Daerah</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mukim</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($properties as $property)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $property->client->name ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $property->nombor_kait ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $property->nombor_lot }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $property->nombor_geran ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $property->daerah ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $property->mukim ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @if ($property->file_path)
                                                    <a href="{{ asset('storage/' . $property->file_path) }}" target="_blank" class="text-blue-600 underline">
                                                        {{ $property->file_name }}
                                                    </a>
                                                @else
                                                    No file uploaded
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 17V7a2 2 0 012-2h2a2 2 0 012 2v10a2 2 0 002 2h2a2 2 0 00-2-2H5a2 2 0 01-2-2z"/>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">No properties Found</h3>
                            <p class="text-gray-500">You don't have any properties yet.</p>
                        </div>
                    @endif
                </section>

                <!-- Add New Property Form -->
                <div id="addPropertyForm" class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200 p-6 hidden">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Add a New Property</h3>
                    <form action="{{ route('property.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="nombor_kait" class="block text-sm font-medium text-gray-700">Nombor Kait *</label>
                                <input type="text" name="nombor_kait" id="nombor_kait" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                            <div>
                                <label for="nombor_lot" class="block text-sm font-medium text-gray-700">Nombor Lot *</label>
                                <input type="text" name="nombor_lot" id="nombor_lot" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                            <div>
                                <label for="nombor_geran" class="block text-sm font-medium text-gray-700">Nombor Geran</label>
                                <input type="text" name="nombor_geran" id="nombor_geran"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                            <div>
                                <label for="daerah" class="block text-sm font-medium text-gray-700">Daerah</label>
                                <input type="text" name="daerah" id="daerah"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                            <div>
                                <label for="mukim" class="block text-sm font-medium text-gray-700">Mukim</label>
                                <input type="text" name="mukim" id="mukim"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                            <div>
                                <label for="file_path" class="block text-sm font-medium text-gray-700">Property File</label>
                                <input type="file" name="file_path" id="file_path"
                                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                                              file:rounded-md file:border-0 file:text-sm file:font-semibold
                                              file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>
                        </div>
                        <button type="submit"
                                class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <!-- JavaScript to toggle form visibility -->
  <script>
    document.getElementById('openFormButton').addEventListener('click', function () {
        const form = document.getElementById('addPropertyForm');
        form.classList.toggle('hidden');
    });

    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll("tbody tr");

        rows.forEach(row => {
            const cells = row.getElementsByTagName("td");
            let match = false;

            for (let i = 0; i < cells.length - 1; i++) { // skip last cell if needed
                const cellText = cells[i].textContent.toLowerCase();
                if (cellText.includes(searchTerm)) {
                    match = true;
                    break;
                }
            }

            row.style.display = match ? "" : "none";
        });
    });
</script>
</x-app-layout>