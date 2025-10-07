@if($documents->isEmpty())
    <div class="bg-white rounded-lg shadow-sm p-8 text-center">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">Tiada dokumen dijumpai</h3>
        <p class="mt-1 text-sm text-gray-500">Cuba gunakan kata kunci yang berbeza atau reset penapis.</p>
    </div>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($documents as $document)
            <div class="border border-gray-200 rounded-lg shadow-sm bg-white hover:shadow-md transition-shadow duration-200">
                <div class="p-5">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 line-clamp-2">
                        {{ $document->file_name }}
                    </h3>
                    <div class="mt-3 space-y-1 text-sm text-gray-600">
                        <p>Kategori: <span class="font-medium">{{ $document->category ?? 'Tidak Dinyatakan' }}</span></p>
                        <p>Tahun: <span class="font-medium">{{ $document->year ?? 'Tidak Dinyatakan' }}</span></p>
                        <p>Jenis Fail: <span class="font-medium">{{ $document->file_type }}</span></p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('documents.download', $document) }}" 
                           class="inline-flex items-center px-3 py-1.5 border border-red-500 text-red-500 rounded-full text-xs sm:text-sm font-medium hover:bg-red-50 transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Muat Turun
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $documents->links() }}
    </div>
@endif