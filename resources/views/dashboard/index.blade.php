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
                <section class="mb-12">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Quick Stats</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Total Invoices Paid -->
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-2 bg-green-100 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-green-600 font-medium">+12.5%</span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Total Invoices Paid</h3>
                            <p class="text-3xl font-bold text-gray-900">${{ number_format($totalPaid ?? 0, 2) }}</p>
                        </div>

                        <!-- Total Invoices Pending -->
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-2 bg-blue-100 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-blue-600 font-medium">+8.2%</span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Total Invoices Pending</h3>
                            <p class="text-3xl font-bold text-gray-900">{{ $pendingCount ?? 0 }}</p>
                        </div>

                        <!-- Total Invoices -->
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-2 bg-purple-100 rounded-lg">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-red-600 font-medium">-2.1%</span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Total Invoices</h3>
                            <p class="text-3xl font-bold text-gray-900">{{ $totalInvoices ?? 0 }}</p>
                        </div>

                        <!-- Total Properties -->
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-2 bg-orange-100 rounded-lg">
                                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-green-600 font-medium">+5.7%</span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Total Property</h3>
                            <p class="text-3xl font-bold text-gray-900">{{ $totalProperties ?? 0 }}</p>
                        </div>
                    </div>
                </section>

                <!-- Add New Invoice Button + Search -->
                <section class="bg-white rounded-xl shadow-sm border border-gray-100 mb-6">
                    <div class="p-4 border-b border-gray-200">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Invoices</h2>
                                <p class="text-gray-600 text-sm">Your latest transactions and updates</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="relative">
                                    <input type="text" id="searchInput" placeholder="Search..."
                                           class="pl-10 pr-4 py-2 w-48 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none"
                                         stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <button id="openInvoiceFormButton"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Add New Invoice
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="mb-6">
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                            <p class="font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Add New Invoice Form -->
                <div id="addInvoiceForm" class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200 p-6 hidden">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Add a New Invoice</h3>
                    <form action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="property_id"
                                       class="block text-sm font-medium text-gray-700">Select Property *</label>
                                <select name="property_id" id="property_id" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    @isset($properties)
                                        @foreach ($properties as $prop)
                                            <option value="{{ $prop->id }}">{{ $prop->nombor_kait }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            <div>
                                <label for="invoice_number"
                                       class="block text-sm font-medium text-gray-700">Invoice Number *</label>
                                <input type="text" name="invoice_number" id="invoice_number" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                            <div>
                                <label for="amount"
                                       class="block text-sm font-medium text-gray-700">Amount *</label>
                                <input type="number" step="0.01" name="amount" id="amount" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                            <div>
                                <label for="due_date"
                                       class="block text-sm font-medium text-gray-700">Due Date *</label>
                                <input type="date" name="due_date" id="due_date" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                            <div>
                                <label for="status"
                                       class="block text-sm font-medium text-gray-700">Status *</label>
                                <select name="status" id="status" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Unpaid</option>
                                </select>
                            </div>
                            <div>
                                <label for="file_path"
                                       class="block text-sm font-medium text-gray-700">Invoice File</label>
                                <input type="file" name="file_path" id="file_path"
                                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                                              file:rounded-md file:border-0 file:text-sm file:font-semibold
                                              file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>
                        </div>
                        <button type="submit"
                                class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md">
                            Save Invoice
                        </button>
                    </form>
                </div>

                <!-- Invoices Table -->
                <section class="bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombor Kait</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice Number</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice Documents</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Surat Iringan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if ($invoices->count())
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $invoice->property->nombor_kait ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $invoice->invoice_number }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($invoice->amount, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @if($invoice->status === 'paid')
                                                    <span class="text-green-600 font-medium">Paid</span>
                                                @else
                                                    <span class="text-red-600 font-medium">Unpaid</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}
                                            </td>
                                            <td class="px-4 py-2">
                                                @if ($invoice->file_path)
                                                    <a href="{{ asset('storage/' . $invoice->file_path) }}" target="_blank">
                                                        {{ $invoice->file_name ?? 'View File' }}
                                                    </a>
                                                @else
                                                    No file
                                                @endif
                                            </td>
                                            <td class="px-4 py-2">
                                                @if ($invoice->property && $invoice->property->file_path)
                                                    <a href="{{ asset('storage/' . $invoice->property->file_path) }}"
                                                       target="_blank">
                                                        {{ $invoice->property->file_name ?? 'View Surat' }}
                                                    </a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center py-12">
                                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none"
                                                 stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M9 17V7m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h2a2 2 0 002-2z"/>
                                            </svg>
                                            <h3 class="text-lg font-medium text-gray-900 mb-1">No Invoices Found</h3>
                                            <p class="text-gray-500">You don't have any invoices yet.</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <!-- JavaScript -->
    <script>
        // Toggle Add Invoice Form
        document.getElementById('openInvoiceFormButton').addEventListener('click', function () {
            const form = document.getElementById('addInvoiceForm');
            form.classList.toggle('hidden');
        });

        // Search Functionality
        document.getElementById('searchInput').addEventListener('keyup', function () {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll("tbody tr");
            rows.forEach(row => {
                const cells = row.getElementsByTagName("td");
                let match = false;
                for (let i = 0; i < cells.length - 1; i++) {
                    if (cells[i].textContent.toLowerCase().includes(searchTerm)) {
                        match = true;
                        break;
                    }
                }
                row.style.display = match ? "" : "none";
            });
        });
    </script>
</x-app-layout>