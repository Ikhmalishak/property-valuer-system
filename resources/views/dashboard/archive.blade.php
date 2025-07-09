<x-app-layout>
    <div class="flex min-h-screen bg-gray-50">
        <!-- Main Content -->
        <main class="flex-1 overflow-auto">
            <div class="px-8 py-6">

                <!-- Add New Invoice Button + Search -->
                <section class="bg-white rounded-xl shadow-sm border border-gray-100 mb-6">
                    <div class="p-4 border-b border-gray-200">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Archives</h2>
                                <p class="text-gray-600 text-sm">Your list of archives</p>
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
                                @if ($paid_invoices->count())
                                        @foreach ($paid_invoices as $invoice)
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
                                                        {{ $invoice->file_name }}
                                                    </a>
                                                @else
                                                    No file
                                                @endif
                                            </td>
                                            <td class="px-4 py-2">
                                                @if ($invoice->property && $invoice->property->file_path)
                                                    <a href="{{ asset('storage/' . $invoice->property->file_path) }}"
                                                       target="_blank">
                                                        {{ $invoice->property->file_name }}
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
                                                      d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h2a2 2 0 002-2z"/>
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
</x-app-layout>