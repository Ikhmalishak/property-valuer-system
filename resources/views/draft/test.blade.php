<x-layouts.app>
    <main class="container mx-auto px-4 py-8">
        <!-- Hero Section -->
        <section class="bg-white rounded-lg shadow-lg overflow-hidden mb-10">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 p-8 flex flex-col justify-center">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">Perkhidmatan Penilaian Hartanah Profesional</h1>
                    <p class="text-gray-600 mb-6">Dapatkan nilai sebenar hartanah anda dengan perkhidmatan penilaian yang diiktiraf di seluruh Malaysia.</p>
                    <div class="flex flex-wrap gap-3">
                        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Mulakan Penilaian</button>
                        <button type="button" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Hubungi Kami</button>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <img src="{{ asset('images/image1.jpg') }}" alt="Gambar Hartanah" class="w-full h-full object-cover" />
                </div>
            </div>
        </section>

        <!-- Second Section -->
        <section class="bg-white rounded-lg shadow-lg overflow-hidden mb-10">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2">
                    <img src="{{ asset('images/image1.jpg') }}" alt="Gambar Hartanah" class="w-full h-full object-cover" />
                </div>
                <div class="md:w-1/2 p-8 flex flex-col justify-center">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">Perkhidmatan Penilaian Hartanah Profesional</h1>
                    <p class="text-gray-600 mb-6">Dapatkan nilai sebenar hartanah anda dengan perkhidmatan penilaian yang diiktiraf di seluruh Malaysia.</p>
                    <div class="flex flex-wrap gap-3">
                        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Mulakan Penilaian</button>
                        <button type="button" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Hubungi Kami</button>
                    </div>
                </div>

            </div>
        </section>

                <!-- Transaction Data Section -->
        <section class="bg-white rounded-lg shadow-lg overflow-hidden mb-10">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 p-8 flex flex-col justify-center">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Dapatkan Data Transaksi Hartanah Terkini di Seluruh Malaysia</h2>
                    <p class="text-gray-600 mb-6">Akses ke pangkalan data transaksi hartanah terbesar di Malaysia. Maklumat terperinci mengenai harga jual beli, lokasi, jenis hartanah dan banyak lagi.</p>
                    <button id="dataBtn" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 w-fit">Semak Sekarang</button>
                </div>
                <div class="md:w-1/2">
                    <img src="{{ asset('images/image1.jpg') }}" alt="Data Transaksi" class="w-full h-full object-cover" />
                </div>
            </div>
        </section>

        <!-- Home Loan Assessment Section -->
        <section class="bg-white rounded-lg shadow-lg overflow-hidden mb-10">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2">
                    <img src="{{ asset('images/image1.jpg') }}" alt="Penilaian Pinjaman" class="w-full h-full object-cover" />
                </div>
                <div class="md:w-1/2 p-8 flex flex-col justify-center">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Semak Status Penilaian Pinjaman Perumahan Anda Dengan Mudah</h2>
                    <p class="text-gray-600 mb-6">Ketahui status permohonan pinjaman perumahan anda dan dapatkan panduan untuk meningkatkan peluang kelulusan.</p>
                    <button id="loanBtn" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 w-fit">Semak Status</button>
                </div>
            </div>
        </section>

        <!-- Service Cards Section -->
        <section class="mb-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Perkhidmatan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Service Card 1 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="/api/placeholder/400/200" alt="Penilaian Rumah" class="w-full h-48 object-cover" />
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Penilaian Rumah</h3>
                        <p class="text-gray-600 mb-4">Penilaian profesional untuk rumah kediaman, kondominium, dan hartanah persendirian.</p>
                        <button type="button" class="text-blue-700 hover:text-blue-800 font-medium text-sm inline-flex items-center">
                            Ketahui Lebih Lanjut
                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Service Card 2 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="/api/placeholder/400/200" alt="Penilaian Komersial" class="w-full h-48 object-cover" />
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Penilaian Komersial</h3>
                        <p class="text-gray-600 mb-4">Penilaian terperinci untuk bangunan pejabat, kedai, kilang, dan hartanah perindustrian.</p>
                        <button type="button" class="text-blue-700 hover:text-blue-800 font-medium text-sm inline-flex items-center">
                            Ketahui Lebih Lanjut
                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Service Card 3 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="/api/placeholder/400/200" alt="Laporan Penilaian" class="w-full h-48 object-cover" />
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Laporan Penilaian</h3>
                        <p class="text-gray-600 mb-4">Laporan penilaian yang diiktiraf oleh bank dan institusi kewangan untuk tujuan pinjaman.</p>
                        <button type="button" class="text-blue-700 hover:text-blue-800 font-medium text-sm inline-flex items-center">
                            Ketahui Lebih Lanjut
                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

    <!-- Testimonials Section -->
        <section class="mb-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Testimoni Pelanggan</h2>
            
            <!-- Flowbite Carousel Component -->
            <div id="testimonial-carousel" class="relative w-full" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-72 overflow-hidden rounded-lg md:h-64">
                    <!-- Testimonial 1 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <div class="absolute block w-full h-full bg-white p-8 rounded-lg shadow-lg">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 rounded-full bg-gray-200 mr-4"></div>
                                <div>
                                    <h4 class="font-semibold">Ahmad Ismail</h4>
                                    <p class="text-sm text-gray-500">Kuala Lumpur</p>
                                </div>
                            </div>
                            <p class="text-gray-600 italic">"Perkhidmatan penilaian yang sangat profesional. Laporan terperinci dan teliti membantu permohonan pinjaman saya diluluskan dengan cepat!"</p>
                            <div class="flex mt-4">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonial 2 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <div class="absolute block w-full h-full bg-white p-8 rounded-lg shadow-lg">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 rounded-full bg-gray-200 mr-4"></div>
                                <div>
                                    <h4 class="font-semibold">Siti Nuraini</h4>
                                    <p class="text-sm text-gray-500">Johor Bahru</p>
                                </div>
                            </div>
                            <p class="text-gray-600 italic">"Data transaksi yang tepat membantu saya membuat keputusan pembelian hartanah dengan yakin. Terima kasih atas khidmat nasihat yang diberikan!"</p>
                            <div class="flex mt-4">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-layouts.app>