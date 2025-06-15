<template>
    <div class="flex flex-col bg-amber-50 min-h-screen">
        <!-- Header -->
        <HeaderComponent class="w-full" />

        <!-- Hero Section with Background Image -->
        <section class="relative flex items-center justify-center w-full h-96 bg-gray-900">
            <div class="absolute inset-0 bg-image bg-cover bg-center bg-no-repeat opacity-70"></div>
            <div class="relative z-10 text-center px-4">
                <h1 class="text-4xl md:text-5xl text-amber-50 font-extrabold font-sans italic drop-shadow-lg">
                    Կոնտակտներ
                </h1>
                <p class="mt-2 text-lg md:text-xl text-amber-100 font-sans">
                    Կապվեք մեզ հետ
                </p>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="container mx-auto py-12 flex flex-col md:flex-row justify-between items-start gap-8">
            <div class="min-h-screen bg-white mx-auto text-gray-800">
                <div class="max-w-7xl mx-auto px-4 py-12 grid md:grid-cols-3 gap-12">

                    <!-- Left side form -->
                    <div class="md:col-span-2">
                        <h2 class="text-4xl font-bold mb-2">
                            Կապվեք</h2>
                        <p class="text-gray-500 mb-8">
                            Մենք հասանելի ենք 24/7 ռեժիմով՝ էլեկտրոնային փոստով կամ հեռախոսով: Կարող եք նաև օգտագործել մեր արագ կապի ձևաթուղթը՝ մեր ծառայությունների և իրականացվող նախագծերի վերաբերյալ հարց տալու համար:
                        </p>

                        <form @submit.prevent="submitForm" class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-4">
                                <input v-model="form.name" type="text" placeholder="Ձեր անունը"
                                       class="w-full bg-gray-100 px-4 py-3 placeholder-gray-500" />
                                <input v-model="form.phone" type="text" placeholder="Հեռախոս"
                                       class="w-full bg-gray-100 px-4 py-3 placeholder-gray-500" />
                            </div>
                            <textarea v-model="form.message" placeholder="Ձեր հաղորդագրությունը"
                                      class="w-full bg-gray-100 px-4 py-3 placeholder-gray-500 h-36"></textarea>
                            <div class="grid md:grid-cols-2 gap-4">
                                <input v-model="form.email" type="email" placeholder="Էլ փոստ"
                                       class="w-full bg-gray-100 px-4 py-3 placeholder-gray-500" />
                                <button type="submit"
                                        class="bg-yellow-300 hover:bg-yellow-400 font-bold text-black py-3 transition-all duration-200">
                                    Ողարկել հաղորդագրություն
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Right side contact info -->
                    <div>
                        <h3 class="text-lg font-bold uppercase tracking-wide mb-4">ՄԻԱՑԵՔ ՍՈՑԻԱԼԱԿԱՆ ՀԱՂՈՐԴԱԿՑՈՒԹՅՈՒՆՆԵՐԻՆ</h3>
                        <div class="flex space-x-4 mb-8 text-gray-600">
                            <a href="#" aria-label="Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M22 12a10 10 0 10-11.5 9.9v-7h-2v-2.9h2v-2.2c0-2 1.2-3.1 3-3.1.9 0 1.9.1 1.9.1v2.1h-1.1c-1 0-1.3.6-1.3 1.3v1.8h2.5l-.4 2.9H14v7A10 10 0 0022 12z"/>
                                </svg>
                            </a>
                            <a href="#" aria-label="Instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600 hover:text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.206.056 2.003.24 2.47.403a4.92 4.92 0 011.675 1.093 4.918 4.918 0 011.092 1.675c.163.467.347 1.264.403 2.47.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.056 1.206-.24 2.003-.403 2.47a4.918 4.918 0 01-1.093 1.675 4.92 4.92 0 01-1.675 1.092c-.467.163-1.264.347-2.47.403-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.206-.056-2.003-.24-2.47-.403a4.92 4.92 0 01-1.675-1.093 4.918 4.918 0 01-1.092-1.675c-.163-.467-.347-1.264-.403-2.47C2.175 15.747 2.163 15.367 2.163 12s.012-3.584.07-4.85c.056-1.206.24-2.003.403-2.47a4.918 4.918 0 011.093-1.675A4.92 4.92 0 015.404 2.636c.467-.163 1.264-.347 2.47-.403C8.416 2.175 8.796 2.163 12 2.163zm0-2.163C8.741 0 8.332.012 7.052.07 5.772.127 4.828.308 4.042.633a7.07 7.07 0 00-2.539 1.662A7.072 7.072 0 00.633 4.042c-.325.786-.506 1.73-.563 3.01C.012 8.332 0 8.741 0 12c0 3.259.012 3.668.07 4.948.057 1.28.238 2.224.563 3.01a7.072 7.072 0 001.662 2.539 7.07 7.07 0 002.539 1.662c.786.325 1.73.506 3.01.563 1.28.058 1.689.07 4.948.07s3.668-.012 4.948-.07c1.28-.057 2.224-.238 3.01-.563a7.07 7.07 0 002.539-1.662 7.072 7.072 0 001.662-2.539c.325-.786.506-1.73.563-3.01.058-1.28.07-1.689.07-4.948s-.012-3.668-.07-4.948c-.057-1.28-.238-2.224-.563-3.01a7.072 7.072 0 00-1.662-2.539A7.07 7.07 0 0019.958.633c-.786-.325-1.73-.506-3.01-.563C15.668.012 15.259 0 12 0zM12 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a3.999 3.999 0 110-7.998 3.999 3.999 0 010 7.998zm6.406-11.845a1.44 1.44 0 11-2.88 0 1.44 1.44 0 012.88 0z"/>
                                </svg>
                            </a>
                            <a href="#" aria-label="YouTube">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600 hover:text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a2.998 2.998 0 00-2.112-2.121C19.653 3.5 12 3.5 12 3.5s-7.653 0-9.386.565a2.998 2.998 0 00-2.112 2.121C0 8.014 0 12 0 12s0 3.986.502 5.814a2.998 2.998 0 002.112 2.121c1.733.565 9.386.565 9.386.565s7.653 0 9.386-.565a2.998 2.998 0 002.112-2.121C24 15.986 24 12 24 12s0-3.986-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </a>
                        </div>

                        <div class="mb-6">
                            <h4 class="font-bold text-sm mb-1">ՀԵՌԱԽՈՍ</h4>
                            <p class="text-gray-700"><i class="fas fa-phone-alt text-orange-500 mr-2"></i>1-800-1234-567</p>
                        </div>

                        <div class="mb-6">
                            <h4 class="font-bold text-sm mb-1">ԷԼ ՓՈՍՏ</h4>
                            <p class="text-gray-700"><i class="fas fa-envelope text-orange-500 mr-2"></i>info@demolink.org</p>
                        </div>

                        <div>
                            <h4 class="font-bold text-sm mb-1">ՀԱՍՑԵ</h4>
                            <p class="text-gray-700">
                                <i class="fas fa-map-marker-alt text-orange-500 mr-2"></i>
                                6036 Richmond hwy,<br /> Alexandria, VA, 2230
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Footer -->
        <FooterComponent class="w-full mt-auto" />
    </div>
</template>

<script setup lang="ts">
import HeaderComponent from '@/components/HeaderComponent.vue';
import FooterComponent from '@/components/FooterComponent.vue';

import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const form = reactive({
    name: '',
    phone: '',
    message: '',
    email: ''
})

const submitForm = () => {
    router.post('/contact', form)
}
</script>

<style scoped>
.bg-image {
    background-image: url('/img/bg-image-07-1920x696.jpg');
}

@media (max-width: 768px) {
    .bg-image {
        background-image: url('/img/bg-image-07-1920x696.jpg');
    }
    .container {
        padding: 0 1rem;
    }
    section.flex {
        flex-direction: column;
    }
    section div.w-full {
        width: 100%;
    }
}

</style>
