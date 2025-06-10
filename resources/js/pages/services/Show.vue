<template>
    <div class="bg-amber-50">
        <HeaderComponent/>
        <div class="bg-image flex items-center justify-center w-full h-80">
            <h1 class="text-4xl text-amber-50 font-extrabold font-sans italic">Ծառայություններ</h1>
        </div>
        <div class="container mx-auto py-12 px-4">
            <div class="flex flex-col items-center justify-center md:flex-row bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Image -->
                <div class="size-96 object-cover ">
                    <img :src="service.image_url" :alt="service.name" class="w-full h-full object-cover">
                </div>

                <!-- Text content -->
                <div class="md:w-1/2 p-8 flex flex-col justify-center">
                    <p class="font-extrabold text-2xl font-sans italic text-gray-700 mb-4">
                        {{ service.name }}
                    </p>
                    <p class="text-gray-700 mb-4 font-sans italic">
                        {{ service.description }}
                    </p>
                </div>
            </div>
        </div>
        <FooterComponent/>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import HeaderComponent from '@/Components/HeaderComponent.vue';
import FooterComponent from '@/Components/FooterComponent.vue';

defineProps({
    service: Object
});
</script>
<style scoped>
.bg-image {
    background-image: url('/img/bg-image-07-1920x696.jpg');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>
