// import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import AOS from 'aos';
import 'aos/dist/aos.css'; // Import AOS CSS

// Initialize AOS
AOS.init({
  duration: 800,
  easing: 'ease-in-out-quad',
  once: false,
  offset: 100,
  disable: false,
  startEvent: 'load' // Trigger on page load
});

// Optional: Refresh AOS when content changes (for SPAs/Livewire)
window.AOS = AOS; // Make available globally if needed