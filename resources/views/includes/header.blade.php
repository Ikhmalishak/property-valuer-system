
<nav class="bg-white border-gray-200 shadow-md">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <!-- Logo (left) -->
    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="{{asset("/images/logo.png")}}" class="h-8" alt="Flowbite Logo" />
      <span class="self-center text-2xl font-semibold whitespace-nowrap">Property Valuer</span>
    </a>

    <!-- Nav Links + Login Button (right) -->
    <div class="flex items-center md:order-2 space-x-4 rtl:space-x-reverse">
      <!-- Navigation Links (now on the right) -->
      <div class="hidden md:flex">
        <ul class="flex space-x-8 rtl:space-x-reverse">
          <li><a href="{{ url('/') }}" class="text-gray-900 hover:text-blue-700">Home</a></li>
          <li><a href="{{ route('about') }}" class="text-gray-900 hover:text-blue-700">About</a></li>
          <li><a href="{{ route('documents') }}" class="text-gray-900 hover:text-blue-700">Muat Turun</a></li>
          <li><a href="{{ route('about') }}" class="text-gray-900 hover:text-blue-700">Services</a></li>
          <li><a href="#" class="text-gray-900 hover:text-blue-700">Contact</a></li>
        </ul>
      </div>

      <!-- Login Button -->
      <a href="{{ route('login') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">
        Login
      </a>

      <!-- Mobile Menu Toggle -->
      <button data-collapse-toggle="navbar-cta" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
      </button>
    </div>

    <!-- Mobile Menu (hidden on desktop) -->
    <div class="hidden w-full md:hidden md:w-auto" id="navbar-cta">
      <ul class="flex flex-col font-medium p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50">
        <li><a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded-sm">Perkhidmatan Online</a></li>
        <li><a href="#" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100">Carian Cawangan Pejabat JPPH</a></li>
        <li><a href="#" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100">Berita Terkini</a></li>
        <li><a href="#" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100">Hubungi Kami</a></li>
      </ul>
    </div>
  </div>
</nav>