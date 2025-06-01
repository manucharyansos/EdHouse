<template>
    <footer class="footer-section py-8" :class="{ 'scrolled': isScrolled }">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Contact Us -->
                <div class="text-center md:text-left">
                    <h3 class="text-lg font-semibold mb-4 text-white">Contact Us</h3>
                    <p class="mb-2 text-white">+1 (409) 987-5874</p>
                    <p class="mb-2 text-white">info@demolink.org</p>
                    <p class="text-white">6036 Richmond Hwy, Alexandria, VA, 2230</p>
                </div>

                <!-- Subscribe -->
                <div class="text-center">
                    <h3 class="text-lg font-semibold mb-4 text-white">Subscribe</h3>
                    <p class="mb-2 text-white">Enter your e-mail to receive the latest news from us.</p>
                    <form class="flex justify-center" @submit.prevent="handleSubmit">
                        <input
                            type="email"
                            v-model="email"
                            placeholder="Your E-mail"
                            class="p-2 rounded-l-md text-black w-full md:w-auto"
                        >
                        <button type="submit" class="bg-yellow-400 text-black p-2 rounded-r-md hover:bg-yellow-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Social Links -->
                <div class="text-center md:text-right">
                    <h3 class="text-lg font-semibold mb-4 text-white">Social Links</h3>
                    <p class="mb-2 text-white">Follow us on these social networks.</p>
                    <div class="flex justify-center md:justify-end space-x-4">
                        <a href="#" class="text-white hover:text-blue-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.618 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.919-.058-1.265-.07-1.644-.07-4.849 0-3.204.012-3.583.07-4.849.149-3.252 1.66-4.771 4.919-4.919 1.266-.058 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.791-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.209-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-blue-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.732 0 1.325-.593 1.325-1.325V1.325C24 .593 23.407 0 22.675 0z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-blue-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 14.01-7.496 14.01-13.986 0-.209 0-.42-.015-.63.961-.695 1.8-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-blue-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.001 2.002c-5.522 0-9.999 4.477-9.999 9.999 0 4.99 3.656 9.126 8.437 9.879v-6.988h-2.54v-2.891h2.54V9.798c0-2.508 1.493-3.891 3.776-3.891 1.094 0 2.24.195 2.24.195v2.459h-1.264c-1.24 0-1.628.771-1.628 1.563v1.875h2.771l-.443 2.891h-2.328v6.988C18.344 21.129 22 16.992 22 12.001c0-5.522-4.477-9.999-9.999-9.999z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';

// Form handling
const email = ref('');
const handleSubmit = () => {
    console.log('Subscribed with email:', email.value);
    email.value = '';
};

// Scroll handling to match header behavior
const isScrolled = ref(false);

const handleScroll = () => {
    isScrolled.value = window.scrollY > 500;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<style scoped>
.footer-section {
    background: rgba(28, 28, 26, 0.5);
    transition: background-color 0.3s ease;
}

.footer-section.scrolled {
    background: rgba(28, 28, 26, 0.9);
}

/* Additional custom styles */
.footer-section a {
    transition: color 0.3s ease;
}

.footer-section input {
    border: none;
    outline: none;
}

.footer-section .md\:grid-cols-3 {
    grid-template-columns: repeat(3, minmax(0, 1fr));
}

@media (max-width: 767px) {
    .footer-section .md\:grid-cols-3 {
        grid-template-columns: 1fr;
    }
}
</style>
