<template>
    <footer class="footer-section py-8" :class="{ 'scrolled': isScrolled }">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Contact Us -->
                <div class="text-center md:text-left">
                    <h3 class="text-lg font-semibold mb-4 text-white">Կապ մեզ հետ</h3>
                    <p class="mb-2 text-white">
                        <a href="tel:+37493031050" class="mb-2"
                        ><strong>Հեռախոս:</strong> +37493031050</a>
                    </p>
                    <p class="mb-2 text-white">info@edhous.am</p>
                    <p class="text-white">Զովունի</p>
                </div>

                <!-- Subscribe -->
                <div class="text-center">
                    <h3 class="text-lg font-semibold mb-4 text-white">Բաժանորդագրվել</h3>
                    <p class="mb-2 text-white">Մուտքագրեք ձեր էլ. փոստը՝ մեզանից վերջին նորությունները ստանալու համար:</p>
                    <form class="flex justify-center" @submit.prevent="handleSubmit">
                        <input
                            type="email"
                            v-model="email"
                            placeholder="Your E-mail"
                            class="p-2 rounded-l-md text-white border-amber-100 w-full md:w-auto"
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
                    <h3 class="text-lg font-semibold mb-4 text-white">Սոցիալական հղումներ</h3>
                    <p class="mb-2 text-white">Հետևեք մեզ այս սոցիալական ցանցերում։</p>
                    <div class="flex justify-center md:justify-end space-x-4">
                        <a href="https://www.facebook.com/share/19SSpBGSDf/" class="text-white hover:text-blue-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.732 0 1.325-.593 1.325-1.325V1.325C24 .593 23.407 0 22.675 0z"/>
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/edhouse.armenia?igsh=MW85eDg3dmdzbzc0bg==" class="text-white hover:text-blue-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.618 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.919-.058-1.265-.07-1.644-.07-4.849 0-3.204.012-3.583.07-4.849.149-3.252 1.66-4.771 4.919-4.919 1.266-.058 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.791-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.209-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-blue-400">
                            <svg class="w-7 h-7" fill="currentColor" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="120" height="120" viewBox="0 0 50 50">
                                <path d="M25,2c12.703,0,23,10.297,23,23S37.703,48,25,48S2,37.703,2,25S12.297,2,25,2z M32.934,34.375	c0.423-1.298,2.405-14.234,2.65-16.783c0.074-0.772-0.17-1.285-0.648-1.514c-0.578-0.278-1.434-0.139-2.427,0.219	c-1.362,0.491-18.774,7.884-19.78,8.312c-0.954,0.405-1.856,0.847-1.856,1.487c0,0.45,0.267,0.703,1.003,0.966	c0.766,0.273,2.695,0.858,3.834,1.172c1.097,0.303,2.346,0.04,3.046-0.395c0.742-0.461,9.305-6.191,9.92-6.693	c0.614-0.502,1.104,0.141,0.602,0.644c-0.502,0.502-6.38,6.207-7.155,6.997c-0.941,0.959-0.273,1.953,0.358,2.351	c0.721,0.454,5.906,3.932,6.687,4.49c0.781,0.558,1.573,0.811,2.298,0.811C32.191,36.439,32.573,35.484,32.934,34.375z"></path>
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
