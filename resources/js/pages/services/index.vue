<template>
    <HeaderComponent/>
    <div class="bg-image flex items-center justify-center w-full h-80">
        <h1 class="text-4xl text-amber-50 font-extrabold font-sans italic">Ծառայություններ</h1>
    </div>
    <div class="services-container bg-amber-50 flex items-center justify-center flex-row mx-2 px-4">
        <div class="services-grid flex flex-row items-center justify-center flex-wrap gap-4 w-full">
            <div
                v-for="service in services"
                :key="service.id"
                class="service-card w-80 h-96"
            >
                <div class="service-header ">
                    <Link :href="route('services.show', { service: service.id })">
                        <h2 class="text-neutral-800 hover:text-red-900">{{ service.name.toUpperCase() }}</h2>
                    </Link>

                    <div class="divider"></div>
                </div>

                <div class="service-content">
                    <img class="icon-wrapper size-28 object-cover" :src="service.image_url" alt="">
                    <p class="overflow-x-auto h-32">{{ service.description }}</p>
                </div>

            </div>
        </div>
    </div>
    <FooterComponent/>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import FooterComponent from '@/components/FooterComponent.vue';
import HeaderComponent from '@/components/HeaderComponent.vue';

const props = defineProps({
    services: {
        type: Array,
        required: true,
        default: () => []
    }
});

</script>

<style scoped>
body {
    background: white;
}
.bg-image {
    background-image: url('/img/bg-image-07-1920x696.jpg');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
.services-container {
    margin: 0 auto;
    padding: 2rem;
    font-family: Arial, sans-serif;
    min-height: 70vh;
}

.service-card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    background: white;
}

.service-header {
    margin-bottom: 1.5rem;
}

.service-header h2 {
    font-size: 1.5rem;
    color: #444;
    margin: 0 0 0.5rem 0;
    text-align: center;
}
.service-header h2:hover {
    color: #f53003;
}

.divider {
    height: 2px;
    background-color: #e0e0e0;
    width: 100%;
}

.service-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.icon-wrapper svg {
    width: 100%;
    height: 100%;
}

.service-content p {
    color: #666;
    line-height: 1.5;
    margin: 0;
    text-align: center;
}

.service-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

button, .edit-btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-block;
    text-align: center;
}

.edit-btn {
    background-color: #2196F3;
    color: white;
}

.edit-btn:hover {
    background-color: #0b7dda;
}

.delete-btn {
    background-color: #f44336;
    color: white;
}

.delete-btn:hover {
    background-color: #da190b;
}

.add-btn {
    display: block;
    width: 100%;
    max-width: 200px;
    margin: 2rem auto 0;
    background-color: #4CAF50;
    color: white;
    padding: 0.8rem;
    font-size: 1rem;
    text-align: center;
    text-decoration: none;
}

.add-btn:hover {
    background-color: #45a049;
}
</style>
