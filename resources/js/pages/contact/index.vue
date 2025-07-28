<template>
    <div class="flex flex-col bg-amber-50 min-h-screen">
        <!-- Header -->
        <HeaderComponent class="w-full" />

        <!-- Hero Section -->
        <section class="relative flex items-center justify-center w-full h-96 bg-gray-900">
            <div class="absolute inset-0 bg-image bg-cover bg-center bg-no-repeat opacity-70"></div>
            <div class="relative z-10 text-center px-4">
                <h1 class="text-4xl md:text-5xl text-amber-50 font-extrabold italic drop-shadow-lg">
                    Կոնտակտներ
                </h1>
                <p class="mt-2 text-lg md:text-xl text-amber-100">Կապվեք մեզ հետ</p>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="container mx-auto py-12 px-4">
            <div class="grid md:grid-cols-3 gap-12 bg-white rounded-lg shadow-lg p-8">

                <!-- Left side form -->
                <div class="md:col-span-2">
                    <h2 class="text-4xl font-bold mb-2 text-gray-600">Կապվեք</h2>
                    <p class="text-gray-500 mb-8">
                        Մենք հասանելի ենք 24/7 ռեժիմով։ Օգտագործեք ձևը՝ հարց տալու կամ համագործակցության համար։
                    </p>

                    <form @submit.prevent="submitForm" class="space-y-6">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <input v-model="form.name" type="text" placeholder="Ձեր անունը"
                                       class="w-full bg-gray-100 px-4 py-3 placeholder-gray-500" />
                                <p v-if="errors.name" class="text-red-500 text-sm mt-1">{{ errors.name }}</p>
                            </div>
                            <div>
                                <input v-model="form.phone" type="text" placeholder="Օրինակ՝ +37477123456"
                                       class="w-full bg-gray-100 px-4 py-3 placeholder-gray-500" />
                                <p v-if="errors.phone" class="text-red-500 text-sm mt-1">{{ errors.phone }}</p>
                            </div>
                        </div>

                        <div>
              <textarea v-model="form.message" placeholder="Ձեր հաղորդագրությունը"
                        class="w-full bg-gray-100 px-4 py-3 placeholder-gray-500 h-36"></textarea>
                            <p v-if="errors.message" class="text-red-500 text-sm mt-1">{{ errors.message }}</p>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <input v-model="form.email" type="email" placeholder="Էլ փոստ"
                                       class="w-full bg-gray-100 px-4 py-3 placeholder-gray-500" />
                                <p v-if="errors.email" class="text-red-500 text-sm mt-1">{{ errors.email }}</p>
                            </div>
                            <button type="submit"
                                    class="bg-yellow-300 hover:bg-yellow-400 font-bold text-black py-3 transition-all duration-200">
                                Ողարկել հաղորդագրություն
                            </button>
                        </div>
                    </form>

                    <p v-if="successMessage" class="text-green-600 font-semibold mt-6">{{ successMessage }}</p>
                </div>

                <!-- Right side info -->
                <div class="w-full md:w-auto">
                    <h3 class="text-lg font-bold uppercase tracking-wide mb-4 text-gray-600">Միացեք սոցիալական ցանցերին</h3>
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

                    <div class="mb-6 text-gray-700">
                        <h4 class="font-bold text-sm mb-1">Հեռախոս</h4>
                        <p><a href="tel:+37477220628" class="flex items-center gap-2 hover:underline text-gray-700">
                            <i class="fas fa-phone-alt text-orange-500"></i> +374 77 22 06 28</a></p>
                        <p><a href="tel:+37455030389" class="flex items-center gap-2 hover:underline text-gray-700">
                            <i class="fas fa-phone-alt text-orange-500"></i> +374 55 03 03 89</a></p>
                    </div>

                    <div class="mb-6 text-gray-700">
                        <h4 class="font-bold text-sm mb-1">Էլ․ փոստ</h4>
                        <p><a href="mailto:info@edhouse.am" class="flex items-center gap-2 hover:underline text-gray-700">
                            <i class="fas fa-envelope text-orange-500"></i> info@edhouse.am</a></p>
                    </div>

                    <div>
                        <h4 class="font-bold text-sm mb-1 text-gray-700">Հասցե</h4>
                        <p class="flex items-start gap-2 text-gray-700">
                            <i class="fas fa-map-marker-alt text-orange-500 mt-1"></i>
                            Կոտայքի մարզ, Զովունի, 27 փ.</p>
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
import { reactive, ref } from 'vue';

const form = reactive({
    name: '',
    phone: '',
    message: '',
    email: ''
});

const errors = reactive({
    name: '',
    phone: '',
    message: '',
    email: ''
});

const successMessage = ref('');

const submitForm = () => {
    errors.name = errors.phone = errors.message = errors.email = '';
    successMessage.value = '';

    let hasError = false;

    if (!form.name || form.name.length < 2) {
        errors.name = 'Խնդրում ենք նշել անվան առնվազն 2 տառ։';
        hasError = true;
    }

    if (form.phone.startsWith('0')) {
        form.phone = form.phone.replace(/^0/, '+374');
    }

    const phoneRegex = /^\+374\d{8}$/;
    if (form.phone && !phoneRegex.test(form.phone)) {
        errors.phone = 'Մուտքագրեք ճիշտ հայաստանյան հեռախոսահամար՝ օրինակ +37477123456։';
        hasError = true;
    }

    if (!form.email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email)) {
        errors.email = 'Խնդրում ենք մուտքագրել վավեր էլ․ փոստ։';
        hasError = true;
    }

    if (!form.message || form.message.length < 5) {
        errors.message = 'Հաղորդագրությունը պետք է ունենա առնվազն 5 սիմվոլ։';
        hasError = true;
    }

    if (hasError) return;

    fetch('/contact', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(form)
    }).then(async res => {
        if (res.ok) {
            successMessage.value = 'Հաղորդագրությունը հաջողությամբ ուղարկվեց ✅';
            form.name = form.phone = form.message = form.email = '';
        } else {
            const data = await res.json();
            Object.assign(errors, data.errors || {});
        }
    });
};
</script>

<style scoped>
.bg-image {
    background-image: url('/img/bg-image-07-1920x696.jpg');
}
</style>
