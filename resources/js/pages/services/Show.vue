<template>
    <div class="bg-amber-50">
        <HeaderComponent />
        <div class="bg-image flex items-center justify-center w-full h-80">
            <h1 class="text-4xl text-amber-50 font-extrabold font-sans italic">Ծառայություններ</h1>
        </div>
        <div class="container mx-auto py-12 px-4">
            <div class="flex flex-col items-center py-12 justify-center md:flex-row bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Image -->
                <div class="size-96 object-cover">
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
        <!-- Carousel -->
        <div class="relative my-24">
            <Carousel
                ref="carousel"
                :items-to-show="4"
                :wrap-around="true"
                :breakpoints="breakpoints"
                :autoplay="3000"
                class="w-full"
            >
                <Slide v-for="project in projects" :key="project.id">
                    <Link :href="route('projects.show', { project: project.id })">
                        <div class="carousel__item">
                            <div class="project-card relative bg-white shadow-lg overflow-hidden cursor-pointer">
                                <img
                                    :src="project.image_url || '/img/default-project.jpg'"
                                    :alt="project.name"
                                    class="project-image w-full"
                                />
                                <div class="project-content absolute top-0 z-10 p-5">
                                    <h3 class="text-lg font-bold italic font-sans">{{ project.name }}</h3>
                                    <p class="mt-2 line-clamp-2 text-gray-200 text-center">{{ project.description }}</p>
                                    <div class="mt-4 flex flex-wrap gap-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </Link>
                </Slide>
            </Carousel>

            <button
                @click="carouselPrev"
                class="p-2 bg-white rounded-full shadow hover:bg-gray-100 text-black absolute top-1/2 z-10 left-5 cursor-pointer transform -translate-y-1/2"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button
                @click="carouselNext"
                class="p-2 bg-white rounded-full shadow hover:bg-gray-100 text-black absolute top-1/2 z-10 right-5 cursor-pointer transform -translate-y-1/2"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
        <FooterComponent />
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import HeaderComponent from '@/components/HeaderComponent.vue';
import FooterComponent from '@/components/FooterComponent.vue';
import { Link } from '@inertiajs/vue3';
import { Carousel, Slide } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';

defineProps({
    service: Object,
    projects: {
        type: Array,
        default: () => []
    },
});

// Reactive reference for the carousel
const carousel = ref(null);

const carouselPrev = () => {
    carousel.value.prev();
};

const carouselNext = () => {
    carousel.value.next();
};

// Breakpoints for responsive carousel
const breakpoints = {
    700: {
        itemsToShow: 2,
        snapAlign: 'center',
    },
    1024: {
        itemsToShow: 4,
        snapAlign: 'center',
    },
};
</script>

<style scoped>
.bg-image {
    background-image: url('/img/bg-image-07-1920x696.jpg');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
.carousel__item {
    min-height: 200px;
    width: 100%;
    padding: 0 10px;
}

.carousel {
    --vc-nav-background: rgba(0, 0, 0, 0.3);
    --vc-nav-color: white;
    --vc-nav-color-hover: #e5e5e5;
    --vc-nav-border-radius: 50%;
    --vc-nav-width: 40px;
    --vc-nav-height: 40px;
}

.carousel__next,
.carousel__prev {
    background: rgba(0, 0, 0, 0.3);
    border-radius: 50%;
    width: 40px;
    height: 40px;
    color: white;
}

.carousel__slide {
    padding: 10px;
}

.carousel__track {
    gap: 20px;
}

.carousel__prev,
.carousel__next {
    top: 50%;
    transform: translateY(-50%);
    background: #000;
}

.carousel__viewport {
    overflow: visible;
    background: #000;
}
</style>
