
<x-layouts.app>
        <x-slot name="header">
        @include('includes.usernav')
    </x-slot>
{{-- ===== 2. DOCUMENTS INDEX PAGE ===== --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex gap-8">
        <!-- Sidebar -->
        <div class="w-64 bg-white rounded-lg shadow-sm p-4">
            <div class="space-y-2">
                <div class="sidebar-item">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 102 0V3h2v2a1 1 0 102 0V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"></path>
                        </svg>
                        <span class="text-gray-700">Kategori Dokumen</span>
                    </div>
                </div>
                <div class="sidebar-item active">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"></path>
                        </svg>
                        <span>Tahun Terkini</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Hero Section -->
            <div class="bg-white rounded-lg shadow-sm p-8 mb-8 text-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Muat Turun Dokumen Rasmi</h2>
                <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                    Sila cari dan muat turun dokumen berkaitan perkhidmatan Jabatan 
                    Penilaian Perkhidmatan Harta (JPPH). Semua dokumen tersedia dalam 
                    format PDF atau Excel untuk kemudahan anda. Gunakan carian di 
                    sebelah kiri atau fungsi carian untuk membatasi dokumen yang anda 
                    cari secara tepat.
                </p>
                
                <!-- Search Bar -->
                <form action="{{ route('documents.search') }}" method="GET" class="max-w-md mx-auto mb-6">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari nama dokumen..." 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg text-center focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('year'))
                        <input type="hidden" name="year" value="{{ request('year') }}">
                    @endif
                </form>
                
                <!-- Action Buttons -->
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('documents') }}" 
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Reset
                    </a>
                    <button type="submit" form="search-form" 
                            class="px-6 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors">
                        Cari
                    </button>
                </div>
            </div>

            <!-- Filters and Results -->
            <div class="flex gap-8">
                <!-- Search Document Section -->
                <div class="w-80">
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Carian Dokumen</h3>
                        
                        <form id="search-form" action="{{ route('documents.search') }}" method="GET" class="space-y-4">
                            <!-- Document Name Search -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Masukkan Nama Dokumen</label>
                                <input type="text" name="search" value="{{ request('search') }}" 
                                       placeholder="Cari nama dokumen" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500">
                            </div>

                            <!-- Category Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <div class="flex flex-wrap gap-2">
                                    <button type="button" onclick="setCategory('')" 
                                            class="category-btn px-3 py-1 text-xs border border-gray-300 rounded-full hover:bg-gray-50 {{ !request('category') ? 'bg-red-500 text-white' : '' }}">
                                        Semua
                                    </button>
                                    @foreach($categories as $cat)
                                        <button type="button" onclick="setCategory('{{ $cat }}')" 
                                                class="category-btn px-3 py-1 text-xs border border-gray-300 rounded-full hover:bg-gray-50 {{ request('category') == $cat ? 'bg-red-500 text-white' : '' }}">
                                            {{ $cat }}
                                        </button>
                                    @endforeach
                                </div>
                                <input type="hidden" name="category" id="category-input" value="{{ request('category') }}">
                                <p class="text-xs text-gray-500 mt-1">Klik untuk memilih kategori</p>
                            </div>

                            <!-- Year Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                                <div class="flex gap-2">
                                    @foreach($years as $year)
                                        <button type="button" onclick="setYear('{{ $year }}')" 
                                                class="year-btn px-3 py-1 text-xs border border-gray-300 rounded-full hover:bg-gray-50 {{ request('year') == $year ? 'bg-red-500 text-white' : '' }}">
                                            {{ $year }}
                                        </button>
                                    @endforeach
                                </div>
                                <input type="hidden" name="year" id="year-input" value="{{ request('year') }}">
                                <p class="text-xs text-gray-500 mt-1">Klik untuk memilih tahun</p>
                            </div>

                            <button type="submit" class="w-full bg-black text-white py-2 rounded-md hover:bg-gray-800 transition-colors">
                                Tapis
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Document Results -->
                <div class="flex-1">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($documents->count() > 0)
                        <div class="space-y-4" id="document-results">
                            @include('document_list', ['documents' => $documents])
                        </div>
                        <div class="mt-8">
                            {{ $documents->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Tiada dokumen dijumpai</h3>
                            <p class="mt-1 text-sm text-gray-500">Cuba gunakan kata kunci yang berbeza atau reset penapis.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function setCategory(category) {
    document.getElementById('category-input').value = category;
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.classList.remove('bg-red-500', 'text-white');
    });
    const selectedBtn = [...document.querySelectorAll('.category-btn')].find(btn => 
        btn.getAttribute('onclick') === `setCategory('${category}')`
    );
    if (selectedBtn) selectedBtn.classList.add('bg-red-500', 'text-white');
}

function setYear(year) {
    document.getElementById('year-input').value = year;
    document.querySelectorAll('.year-btn').forEach(btn => {
        btn.classList.remove('bg-red-500', 'text-white');
    });
    const selectedBtn = [...document.querySelectorAll('.year-btn')].find(btn => 
        btn.getAttribute('onclick') === `setYear('${year}')`
    );
    if (selectedBtn) selectedBtn.classList.add('bg-red-500', 'text-white');
}
</script>
@endpush
</x-layouts.app>