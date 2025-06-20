<x-layouts.app>
    <main class="container mx-auto px-4 py-8">
        <!-- Hero Section -->
        <section class="bg-white rounded-lg shadow-lg overflow-hidden mb-10">
            <div class="flex flex-col md:flex-row">
                <div class="animate-slide-in-left md:w-1/2 p-8 flex flex-col justify-center">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">Perkhidmatan Penilaian Hartanah Profesional</h1>
                    <p class="text-gray-600 mb-6">Dapatkan nilai sebenar hartanah anda dengan perkhidmatan penilaian yang diiktiraf di seluruh Malaysia.</p>
                    <div class="flex flex-wrap gap-3">
                        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Mulakan Penilaian</button>
                        <button type="button" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Hubungi Kami</button>
                    </div>
                </div>
                <div class="animate-slide-in-right md:w-1/2 h-[300]">
                    <img src="{{ asset('images/image1.jpg') }}" alt="Gambar Hartanah" class="w-full h-[500px] object-cover" />
                </div>
            </div>
        </section>

        <!-- Service Cards Section -->
        <section class="mb-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Perkhidmatan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Service Card 1 -->
                <div data-aos="fade-out" class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/image1.jpg') }}" alt="Penilaian Komersial" class="w-full h-48 object-cover" />
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Penilaian dan Perkhidmatan Harta</h3>
                        <p class="text-gray-600 mb-4">JPPH memberi nasihat kepada Kerajaan mengenai perkara berkaitan dengan penilaian dan perkhidmatan harta.</p>
                        <button type="button" class="text-blue-700 hover:text-blue-800 font-medium text-sm inline-flex items-center">
                            Ketahui Lebih Lanjut
                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Service Card 2 -->
                <div data-aos="zoom-out" class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/image1.jpg') }}" alt="Laporan Penilaian" class="w-full h-48 object-cover" />
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Informasi Harta Tanah</h3>
                        <p class="text-gray-600 mb-4">NAPIC adalah akronim kepada Pusat Maklumat Harta Tanah Negara. NAPIC adalah salah satu dari 3 aktiviti di bawah JPPH.</p>
                        <button type="button" class="text-blue-700 hover:text-blue-800 font-medium text-sm inline-flex items-center">
                            Ketahui Lebih Lanjut
                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Service Card 3 -->
                <div data-aos="fade-down" class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/image1.jpg') }}" alt="Penilaian Rumah" class="w-full h-48 object-cover" />
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Latihan, Penyelidikan Dan Pendidikan.</h3>
                        <p class="text-gray-600 mb-4">INSPEN menjadi penggerak utama dalam membangun pengetahuan dan kemahiran modal insan melalui latihan,  
                            penyelidikan dan pendidikan dalam bidang harta tanah di rantau Asian.</p>
                        <button type="button" class="text-blue-700 hover:text-blue-800 font-medium text-sm inline-flex items-center">
                            Ketahui Lebih Lanjut
                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>
                <!-- Service Cards Section -->
        <section class="mb-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Perkhidmatan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Service Card 1 -->
                <div data-aos="fade-down" class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/image1.jpg') }}" alt="Penilaian Komersial" class="w-full h-48 object-cover" />
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Penilaian dan Perkhidmatan Harta</h3>
                        <p class="text-gray-600 mb-4">JPPH memberi nasihat kepada Kerajaan mengenai perkara berkaitan dengan penilaian dan perkhidmatan harta.</p>
                        <button type="button" class="text-blue-700 hover:text-blue-800 font-medium text-sm inline-flex items-center">
                            Ketahui Lebih Lanjut
                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Service Card 2 -->
                <div data-aos="fade-down" class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/image1.jpg') }}" alt="Laporan Penilaian" class="w-full h-48 object-cover" />
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Informasi Harta Tanah</h3>
                        <p class="text-gray-600 mb-4">NAPIC adalah akronim kepada Pusat Maklumat Harta Tanah Negara. NAPIC adalah salah satu dari 3 aktiviti di bawah JPPH.</p>
                        <button type="button" class="text-blue-700 hover:text-blue-800 font-medium text-sm inline-flex items-center">
                            Ketahui Lebih Lanjut
                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Service Card 3 -->
                <div data-aos="fade-down" class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/image1.jpg') }}" alt="Penilaian Rumah" class="w-full h-48 object-cover" />
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Latihan, Penyelidikan Dan Pendidikan.</h3>
                        <p class="text-gray-600 mb-4">INSPEN menjadi penggerak utama dalam membangun pengetahuan dan kemahiran modal insan melalui latihan,  
                            penyelidikan dan pendidikan dalam bidang harta tanah di rantau Asian.</p>
                        <button type="button" class="text-blue-700 hover:text-blue-800 font-medium text-sm inline-flex items-center">
                            Ketahui Lebih Lanjut
                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-layouts.app>