<x-layouts.app>
    <x-slot name="header">
        @include('includes.header')
    </x-slot>

    <body class="bg-gray-50">

        <!-- Who We Are Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-800 mb-6">Who We Are</h2>
                            <p class="text-gray-600 leading-relaxed mb-4">
                               We are JPPH Teluk Intan, a dedicated branch under the Department of Valuation and Property Services (Jabatan Penilaian dan Perkhidmatan Harta), committed to delivering accurate property valuation and real estate advisory services within the Hilir Perak district.

</p>
                            <p class="text-gray-600 leading-relaxed">
                               Our role is vital in supporting government decisions through professional valuation work that promotes fair compensation, transparent taxation, and responsible development.

   </p>
                        </div>
                        <div class="bg-gray-200 rounded-lg h-64 flex items-center justify-center">
                            <img src="{{ asset('images/images12.jpeg') }}" alt="Office" class="max-w-full h-auto">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quote Section -->
        <section class="py-12 bg-gray-100">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <blockquote class="text-xl text-gray-700 italic">
                        "Excellence is not a destination; it is a continuous journey that never ends."
                    </blockquote>
                    <div class="mt-4 flex justify-center">
                        <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                            Learn More
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Us Section -->
        <section id="about" class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="grid md:grid-cols-2 gap-12">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-800 mb-6">About Us</h2>
                            <p class="text-gray-600 leading-relaxed mb-4">
                           JPPH Teluk Intan operates as the trusted valuation arm for government and public sector needs in the region. We handle land and property valuations for acquisition, taxation, sale, rental, and financial reporting purposes.

Our branch also provides property data analysis and market insights to support policymaking and development planning at the local level.

 </p>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Our Impact</h3>
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-blue-600 rounded-full mr-3"></div>
                                    <span class="text-gray-600">500+ Government Valuation Reports Annually</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-blue-600 rounded-full mr-3"></div>
                                    <span class="text-gray-600">50+ Public Sector Agencies Served</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-blue-600 rounded-full mr-3"></div>
                                    <span class="text-gray-600">Trusted by State and Federal Departments</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision, Mission & Objectives Section -->
        <section id="vision" class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Vision, Mission & Objectives</h2>
                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <div class="bg-blue-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-3">Vision</h3>
                            <p class="text-gray-600">To be the trusted leader in property valuation and asset services in Hilir Perak that support national and local development.</p>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <div class="bg-green-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-3">Mission</h3>
                            <p class="text-gray-600">To provide accurate, independent, and professional valuation services that enhance government efficiency and public confidence.</p>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <div class="bg-purple-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-3">Objectives</h3>
                            <p class="text-gray-600">To ensure consistent, high-quality property valuation and advisory services while promoting transparency, legal compliance, and stakeholder trust.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Role / Functions Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Our Role / Functions</h2>
                    <div class="grid md:grid-cols-2 gap-12">
                        <div class="text-center">
                            <div class="bg-gray-200 w-24 h-24 rounded-lg mx-auto mb-4 overflow-hidden">
                                <img src="{{ asset('images/career1.png') }}" class="w-full h-full object-cover" alt="Buletin Icon">
                            </div>

                            <h3 class="text-xl font-semibold text-gray-800 mb-3">Valuation Assessment</h3>
                            <p class="text-gray-600">We determine fair market values for land and property used in acquisition, disposal, compensation, rental, and government financing purposes.</p>
                        </div>
                        <div class="text-center">
                            <div class="bg-gray-200 w-24 h-24 rounded-lg mx-auto mb-4 overflow-hidden">
                                <img src="{{ asset('images/career2.jpg') }}" class="w-full h-full object-cover" alt="Buletin Icon">
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-3">Market Analysis</h3>
                            <p class="text-gray-600">We study property market trends in the Teluk Intan area to provide data-driven insights for public infrastructure planning and investment.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Core Values Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Core Values</h2>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                        <div class="text-center">
                            <div class="bg-red-100 w-16 h-16 rounded-lg mx-auto mb-3 flex items-center justify-center">
                                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-800">Integrity</h4>
                        </div>
                        <div class="text-center">
                            <div class="bg-blue-100 w-16 h-16 rounded-lg mx-auto mb-3 flex items-center justify-center">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-800">Professional</h4>
                        </div>
                        <div class="text-center">
                            <div class="bg-green-100 w-16 h-16 rounded-lg mx-auto mb-3 flex items-center justify-center">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-800">Accountability</h4>
                        </div>
                        <div class="text-center">
                            <div class="bg-yellow-100 w-16 h-16 rounded-lg mx-auto mb-3 flex items-center justify-center">
                                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-800">Innovation</h4>
                        </div>
                        <div class="text-center">
                            <div class="bg-purple-100 w-16 h-16 rounded-lg mx-auto mb-3 flex items-center justify-center">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-800">Passion</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Organizational Overview Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-800 mb-6">Organizational Overview</h2>
                            <p class="text-gray-600 leading-relaxed mb-4">
                             JPPH Teluk Intan is led by a qualified District Valuer supported by technical and administrative staff who ensure accurate, timely, and transparent service delivery. Our structure enables efficient coordination with the State Valuation Director and other branches.</p>
                            <p class="text-gray-600 leading-relaxed">
                                Leadership roles are filled by experienced professionals who bring diverse expertise and commitment to advancing our mission and objectives.
                            </p>
                        </div>
                        <div class="bg-gray-200 rounded-lg h-64 flex items-center justify-center">
                            <img src="{{ asset('images/org.png') }}" alt="Organization chart" class="max-w-full h-auto">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Additional Content Sections -->
        <section class="py-12 bg-gray-100">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Upcoming Events & Announcements</h2>
                    <div class="bg-white rounded-lg p-6 mb-8">
                        <img src="{{ asset('images/buletin1.png') }}" alt="Success Story" class="max-w-full h-auto rounded-lg shadow-md">
                        <img src="{{ asset('images/buletin2.png') }}" alt="Success Story" class="max-w-full h-auto rounded-lg shadow-md">
                        <img src="{{ asset('images/buletin3.png') }}" alt="Success Story" class="max-w-full h-auto rounded-lg shadow-md">
                        <img src="{{ asset('images/buletin4.png') }}" alt="Success Story" class="max-w-full h-auto rounded-lg shadow-md">
                        <p class="mt-4 text-gray-700"> "Thanks to JPPH Teluk Intan’s timely valuations and professional guidance, I managed to settle my government housing loan application smoothly."
– Hafiz, Government Servant (Teacher, Teluk Intan)</p>
                    </div>

                    <h2 class="text-3xl font-bold text-gray-800 mb-6">About the Government Housing Loan Scheme</h2>
                    <div class="bg-white rounded-lg p-6">
                        <img src="{{ asset('images/images5.png') }}" alt="Event Poster" class="max-w-full h-auto rounded-lg shadow-md">
                        <p class="mt-4 text-gray-700">This federal initiative supports public servants in owning homes. JPPH Teluk Intan plays a key role by offering official property valuations that ensure fair pricing and loan approval efficiency.</p>
                    </div>
                </div>
            </div>
        </section>


</x-layout.app>