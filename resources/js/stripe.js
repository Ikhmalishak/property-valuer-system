// resources/js/stripe.js
document.addEventListener("DOMContentLoaded", function() {
    // Show/hide card section based on payment method
    const stripeRadio = document.getElementById('stripe');
    const fpxRadio = document.getElementById('fpx');
    const cardSection = document.getElementById('stripe-card-section');
    function toggleCardSection() {
        if (stripeRadio && cardSection) {
            if (stripeRadio.checked) {
                cardSection.style.display = 'none'; // Hide for checkout sessions
            } else {
                cardSection.style.display = 'none';
            }
        }
    }
    if (stripeRadio && fpxRadio) {
        stripeRadio.addEventListener('change', toggleCardSection);
        fpxRadio.addEventListener('change', toggleCardSection);
        
        // Initial state
        toggleCardSection();
    }
});