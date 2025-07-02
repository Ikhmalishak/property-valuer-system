<x-app-layout>
    <main class="container mx-auto px-4 py-8">

        <!-- Search Section (Unchanged) -->
        <section class="bg-white rounded-lg shadow-lg overflow-hidden mb-10">
            <div class="text-center rounded-lg p-6">
                <h1 class="text-3xl font-bold mb-6">Muat Turun Dokumen Rasmi</h1>
                <p class="mb-6">Sila cari dan muat turun dokumen berkaitan perkhidmatan Jabatan Penilaian Perkhidmatan Harta (JPPH). Semua dokumen tersedia dalam format PDF atau Excel untuk kemudahan anda. Gunakan penapis di sebelah kiri atau fungsi carian untuk mendapatkan dokumen yang anda perlukan.</p>
            </div>
        </section>

        <!-- Filter and Document List Section -->
        <section class="flex gap-6">
            <!-- Left Sidebar - Filters -->
            <aside class="w-1/4 bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Penapis Dokumen</h3>

                <!-- Document Type Filter -->
                <div class="mb-6">
                    <h4 class="font-semibold mb-3 text-gray-700">Jenis Dokumen</h4>
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" id="pdf" value="pdf" class="filter-checkbox mr-2">
                            <label for="pdf" class="cursor-pointer text-sm">
                                PDF
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="excel" value="png" class="filter-checkbox mr-2">
                            <label for="excel" class="cursor-pointer text-sm">
                                Excel
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="word" value="word" class="filter-checkbox mr-2">
                            <label for="word" class="cursor-pointer text-sm">
                                Word
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="mb-6">
                    <h4 class="font-semibold mb-3 text-gray-700">Kategori</h4>
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" id="borang" value="borang" class="filter-checkbox mr-2">
                            <label for="borang" class="cursor-pointer text-sm">
                                Borang
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="garis-panduan" value="garis panduan" class="filter-checkbox mr-2">
                            <label for="garis-panduan" class="cursor-pointer text-sm">
                                Garis Panduan
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="laporan" value="laporan" class="filter-checkbox mr-2">
                            <label for="laporan" class="cursor-pointer text-sm">
                                Laporan
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="akta" value="akta" class="filter-checkbox mr-2">
                            <label for="akta" class="cursor-pointer text-sm">
                                Akta & Peraturan
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Date Range Filter -->
                <div class="mb-6">
                    <h4 class="font-semibold mb-3 text-gray-700">Tarikh</h4>
                    <div class="space-y-2">
                        <input type="date" id="dateFrom" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                        <input type="date" id="dateTo" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                    </div>
                </div>

                <button id="applyFilters" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">
                    Terapkan Penapis
                </button>
                <button id="clearFilters" class="w-full bg-gray-300 text-gray-800 py-2 px-4 rounded-md hover:bg-gray-400 transition mt-2">
                    Kosongkan Penapis
                </button>
            </aside>

            <!-- Right Content - Document List -->
            <main class="w-3/4">
                <!-- Sort and View Options -->
                <div class="bg-white rounded-lg shadow-lg mb-6 p-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <input type="text" placeholder="Cari dokumen..." id="searchInput" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm w-2 focus:outline-none focus:ring-2 focus:ring-blue-600" />
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-gray-700 font-medium">Susun mengikut:</span>
                            <select id="sortBy" class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600">
                                <option value="date-desc">Tarikh (Terbaru)</option>
                                <option value="date-asc">Tarikh (Terlama)</option>
                                <option value="name-asc">Nama (A-Z)</option>
                                <option value="name-desc">Nama (Z-A)</option>
                                <option value="size-desc">Saiz (Besar ke Kecil)</option>
                                <option value="size-asc">Saiz (Kecil ke Besar)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Document Results -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Hasil Carian</h3>
                        <span id="resultCount" class="text-gray-600">Menunjukkan 0 dokumen</span>
                    </div>

                    <!-- Loading Spinner -->
                    <div id="loadingSpinner" class="hidden flex justify-center items-center py-4">
                        <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                        </svg>
                    </div>

                    <!-- Document List -->
                    <div id="documentList" class="space-y-4"></div>

                    <!-- Pagination -->
                    <div id="pagination" class="flex justify-center mt-8">
                        <nav class="flex space-x-2">
                            <button id="prevPage" class="px-3 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded disabled:opacity-50" disabled>Sebelumnya</button>
                            <div id="pageNumbers" class="flex space-x-2"></div>
                            <button id="nextPage" class="px-3 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded disabled:opacity-50" disabled>Seterusnya</button>
                        </nav>
                    </div>
                </div>
            </main>
        </section>

        <!-- Toast Notification Container -->
        <div id="toast" class="fixed bottom-4 right-4 bg-gray-800 text-white px-4 py-2 rounded-md shadow-lg hidden">
            <span id="toastMessage"></span>
        </div>

        <!-- Preview Modal -->
        <div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg p-6 w-3/4 max-w-2xl">
                <h3 id="modalTitle" class="text-xl font-bold mb-4"></h3>
                <p id="modalDescription" class="text-gray-600 mb-4"></p>
                <a id="modalDownloadLink" href="#" class="text-blue-600 hover:underline mb-4 block">Muat Turun</a>
                <button id="closeModal" class="bg-gray-300 text-gray-800 py-2 px-4 rounded-md hover:bg-gray-400 transition">Tutup</button>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // State management
            let currentPage = 1;
            const itemsPerPage = 10;
            let allDocuments = [];
            let filteredDocuments = [];
            let debounceTimeout;

            // DOM elements
            const searchInput = document.getElementById('searchInput');
            const sortBy = document.getElementById('sortBy');
            const applyFiltersBtn = document.getElementById('applyFilters');
            const clearFiltersBtn = document.getElementById('clearFilters');
            const documentList = document.getElementById('documentList');
            const resultCount = document.getElementById('resultCount');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const prevPageBtn = document.getElementById('prevPage');
            const nextPageBtn = document.getElementById('nextPage');
            const pageNumbers = document.getElementById('pageNumbers');
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toastMessage');
            const previewModal = document.getElementById('previewModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalDescription = document.getElementById('modalDescription');
            const modalDownloadLink = document.getElementById('modalDownloadLink');
            const closeModal = document.getElementById('closeModal');

            // Debounce function to limit API calls
            function debounce(func, wait) {
                return function(...args) {
                    clearTimeout(debounceTimeout);
                    debounceTimeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            // Fetch documents from API
            function fetchDocuments() {
                const {
                    types,
                    categories,
                    dateFrom,
                    dateTo
                } = getFilters();
                const searchQuery = searchInput.value;

                loadingSpinner.classList.remove('hidden');

                // Build URL parameters, only include non-empty values
                const params = new URLSearchParams();
                types.forEach(type => params.append('types[]', type));
                categories.forEach(cat => params.append('categories[]', cat));

                if (dateFrom) params.append('dateFrom', dateFrom);
                if (dateTo) params.append('dateTo', dateTo);
                if (searchQuery) params.append('search', searchQuery);


                console.log('Fetching documents with params:', Object.fromEntries(params));
                //console log full URL
                console.log('Full URL:', '/documents/get?' + params.toString());
                fetch('/documents/get?' + params.toString(), {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        console.log('Response status:', response.status);
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('✅ Received data:', data);
                        allDocuments = data.documents || data || [];
                        filteredDocuments = allDocuments; // Server already filtered
                        applySorting(); // Apply sorting after getting filtered data
                        showToast('Dokumen dimuat semula.');
                    })
                    .catch(error => {
                        console.error('❌ Error fetching documents:', error);
                        showToast('Gagal memuat dokumen: ' + error.message, 'error');
                        // Set empty array if API fails
                        allDocuments = [];
                        filteredDocuments = [];
                        renderDocuments();
                        updatePagination();
                    })
                    .finally(() => {
                        loadingSpinner.classList.add('hidden');
                    });
            }

            // Show toast notification
            function showToast(message, type = 'success') {
                toastMessage.textContent = message;
                toast.classList.remove('hidden', 'bg-gray-800', 'bg-red-600');
                toast.classList.add(type === 'error' ? 'bg-red-600' : 'bg-gray-800');
                setTimeout(() => toast.classList.add('hidden'), 3000);
            }

            // Get selected filters
            function getFilters() {
                const typeCheckboxes = document.querySelectorAll('#pdf, #excel, #word');
                const categoryCheckboxes = document.querySelectorAll('#borang, #garis-panduan, #laporan, #akta');

                const types = Array.from(typeCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                const categories = Array.from(categoryCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                const dateFrom = document.getElementById('dateFrom').value;
                const dateTo = document.getElementById('dateTo').value;

                console.log('Filters:', {
                    types,
                    categories,
                    dateFrom,
                    dateTo
                });
                return {
                    types,
                    categories,
                    dateFrom,
                    dateTo
                };
            }

            // Apply filters and sort (now calls API for fresh data)
            function applyFiltersAndRender() {
                console.log('🔄 applyFiltersAndRender called - fetching from API');
                fetchDocuments(); // Always get fresh data from server
            }

            // Apply client-side sorting only (after data is fetched)
            function applySorting() {
                console.log('🔄 applySorting called');
                const [sortField, sortOrder] = sortBy.value.split('-');

                filteredDocuments.sort((a, b) => {
                    if (sortField === 'date') {
                        return sortOrder === 'asc' ?
                            new Date(a.date) - new Date(b.date) :
                            new Date(b.date) - new Date(a.date);
                    } else if (sortField === 'name') {
                        return sortOrder === 'asc' ?
                            a.file_name.localeCompare(b.file_name) :
                            b.file_name.localeCompare(a.file_name);
                    } else if (sortField === 'size') {
                        return sortOrder === 'asc' ?
                            (a.file_size || 0) - (b.file_size || 0) :
                            (b.file_size || 0) - (a.file_size || 0);
                    }
                    return 0;
                });

                currentPage = 1; // Reset to first page when sorting
                renderDocuments();
                updatePagination();
            }

            // Render documents for current page
            function renderDocuments() {
                documentList.innerHTML = '';
                const start = (currentPage - 1) * itemsPerPage;
                const end = start + itemsPerPage;
                const paginatedDocuments = filteredDocuments.slice(start, end);

                if (paginatedDocuments.length === 0) {
                    documentList.innerHTML = '<p class="text-gray-600">Tiada dokumen dijumpai.</p>';
                    resultCount.textContent = 'Menunjukkan 0 dokumen';
                    return;
                }

                console.log(paginatedDocuments);
                paginatedDocuments.forEach(doc => {
                    console.log('Rendering document:', doc);
                    const item = document.createElement('div');
                    item.className = 'p-4 border border-gray-200 rounded-md hover:shadow-lg transition-shadow cursor-pointer flex justify-between items-center';
                    item.innerHTML = `
                        <div>
                            <h4 class="font-bold text-lg text-gray-800">${doc.file_name}</h4>
                            <p class="text-sm text-gray-600">${doc.description || 'Tiada keterangan'}</p>
                            <p class="text-xs text-gray-500">Tarikh: ${doc.date || 'N/A'} | Saiz: ${doc.file_size ? (doc.file_size / 1024).toFixed(2) + ' KB' : 'N/A'}</p>
                        </div>
                        <a href="${doc.file_download_url}" class="text-blue-600 hover:underline" onclick="event.stopPropagation()">Muat Turun</a>
                    `;
                    item.addEventListener('click', (e) => {
                        if (e.target.tagName !== 'A') {
                            showPreviewModal(doc);
                        }
                    });
                    documentList.appendChild(item);
                });

                resultCount.textContent = `Menunjukkan ${paginatedDocuments.length} daripada ${filteredDocuments.length} dokumen`;
            }

            // Update pagination
            function updatePagination() {
                const totalPages = Math.ceil(filteredDocuments.length / itemsPerPage);
                pageNumbers.innerHTML = '';

                for (let i = 1; i <= totalPages; i++) {
                    const btn = document.createElement('button');
                    btn.textContent = i;
                    btn.className = `px-3 py-2 rounded ${i === currentPage ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100'}`;
                    btn.addEventListener('click', () => {
                        currentPage = i;
                        renderDocuments();
                        updatePagination();
                    });
                    pageNumbers.appendChild(btn);
                }

                prevPageBtn.disabled = currentPage === 1;
                nextPageBtn.disabled = currentPage === totalPages || totalPages === 0;
            }

            // Show preview modal
            function showPreviewModal(doc) {
                modalTitle.textContent = doc.file_name;
                modalDescription.textContent = doc.description || 'Tiada keterangan';
                modalDownloadLink.href = doc.file_path;
                previewModal.classList.remove('hidden');
            }

            // Event listeners
            searchInput.addEventListener('input', debounce(applyFiltersAndRender, 300));
            sortBy.addEventListener('change', applySorting); // Only sort, don't re-fetch

            // Add event listeners to all filter elements
            document.querySelectorAll('.filter-checkbox, #dateFrom, #dateTo').forEach(el => {
                el.addEventListener('change', debounce(applyFiltersAndRender, 300)); // Debounced API calls
            });

            applyFiltersBtn.addEventListener('click', () => {
                applyFiltersAndRender(); // This will call fetchDocuments()
                showToast('Penapis diterapkan.');
            });

            clearFiltersBtn.addEventListener('click', () => {
                document.querySelectorAll('.filter-checkbox').forEach(cb => cb.checked = false);
                document.getElementById('dateFrom').value = '';
                document.getElementById('dateTo').value = '';
                searchInput.value = '';
                currentPage = 1;
                applyFiltersAndRender(); // This will fetch all documents
                showToast('Penapis dikosongkan.');
            });

            prevPageBtn.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    renderDocuments();
                    updatePagination();
                }
            });

            nextPageBtn.addEventListener('click', () => {
                if (currentPage < Math.ceil(filteredDocuments.length / itemsPerPage)) {
                    currentPage++;
                    renderDocuments();
                    updatePagination();
                }
            });

            closeModal.addEventListener('click', () => {
                previewModal.classList.add('hidden');
            });

            previewModal.addEventListener('click', (e) => {
                if (e.target === previewModal) {
                    previewModal.classList.add('hidden');
                }
            });

            // Keyboard accessibility for modal
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !previewModal.classList.contains('hidden')) {
                    previewModal.classList.add('hidden');
                }
            });

            // Initial fetch
            fetchDocuments();
        });
    </script>

    <style>
        /* Custom styles for enhanced interactivity */
        .animate-pulse {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }

        /* Smooth modal transition */
        #previewModal {
            transition: opacity 0.3s ease;
        }

        #previewModal.hidden {
            opacity: 0;
            pointer-events: none;
        }

        #previewModal>div {
            transition: transform 0.3s ease;
            transform: scale(0.95);
        }

        #previewModal:not(.hidden)>div {
            transform: scale(1);
        }

        /* Enhanced checkbox styling */
        .filter-checkbox {
            accent-color: #2563eb;
        }

        .filter-checkbox:checked+label {
            font-weight: 600;
            color: #2563eb;
        }
    </style>
</x-app-layout>