<x-layouts.app>
    <main class="container mx-auto px-4 py-8">
        <!-- First Section -->
        <section class="bg-white rounded-lg shadow-lg overflow-hidden mb-10">
            <div class="text-center rounded-lg p-6">
                <h1 class="text-3xl font-bold mb-6">Muat Turun Dokumen Rasmi</h1>
                <p class="mb-6">Sila cari dan muat turun dokumen berkaitan
                    perkhidmatan Jabatan Penilaian Perkhidmatan Harta (JPPH).
                    Semua dokumen tersedia dalam format PDF atau Excel untuk
                    kemudahan anda. Gunakan penapis di sebelah kiri
                    atau fungsi carian untuk mendapatkan dokumen yang anda perlukan.
                </p>
                <form method="GET" action="" class="text-center">
                    <div class="flex justify-center mb-6">
                        <input type="text"
                            name="query"
                            placeholder="Cari nama dokumen.."
                            class="block w-1/2 p-2 text-gray-900 border border-black rounded-lg bg-white text-xs" />
                    </div>
                    <div class="flex justify-center gap-x-4 mb-6">
                        <button type="reset"
                            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                            Reset
                        </button>
                        <button type="submit"
                            class="px-6 py-3 rounded-lg text-lg font-bold text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                            Cari
                        </button>
                        <button class="px-6 py-3 text-lg font-semibold bg-blue-600 text-white rounded-lg hover:bg-black focus:ring-4">
  Submit
</button>

                    </div>
                </form>
            </div>
        </section>
    </main>
</x-layouts.app>