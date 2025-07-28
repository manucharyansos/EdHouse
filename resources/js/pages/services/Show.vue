<template>
    <div class="bg-amber-50 min-h-screen flex flex-col">
        <HeaderComponent />
        <div class="bg-image flex items-center justify-center w-full h-48 sm:h-64 md:h-80">
            <h1 class="text-2xl sm:text-3xl md:text-4xl text-amber-50 font-extrabold font-sans italic">Ծառայություններ</h1>
        </div>

        <main class="flex-grow">
            <div class="container mx-auto py-8 sm:py-12 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col items-center py-8 sm:py-12 justify-center md:flex-row bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Image -->
                    <div class="w-full md:w-1/2 h-64 md:h-96 object-cover">
                        <img :src="'data:image/jpeg;base64,' + service.image_data" :alt="service.name" class="w-full h-full object-cover">
                    </div>

                    <!-- Text content -->
                    <div class="w-full md:w-1/2 p-4 sm:p-6 md:p-8 flex flex-col justify-center">
                        <p class="font-extrabold text-xl sm:text-2xl font-sans italic text-gray-700 mb-3 sm:mb-4">
                            {{ service.name }}
                        </p>
                        <p class="text-gray-700 mb-3 sm:mb-4 font-sans italic text-sm sm:text-base">
                            {{ service.description }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Carousel -->
            <div class="relative my-12 sm:my-16 md:my-24 px-4 sm:px-6">
                <Carousel
                    ref="carousel"
                    :items-to-show="1.5"
                    :wrap-around="true"
                    :breakpoints="breakpoints"
                    :autoplay="3000"
                    class="w-full"
                >
                    <Slide v-for="project in projects" :key="project.id">
                        <Link :href="route('projects.show', { project: project.id })">
                            <div class="carousel__item px-2">
                                <div class="project-card relative bg-white shadow-lg overflow-hidden cursor-pointer h-64 sm:h-72 md:h-80">
                                    <img
                                        :src="project.image_url || '/img/default-project.jpg'"
                                        :alt="project.name"
                                        class="project-image w-full h-full object-cover"
                                    />
                                    <div class="project-content absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center items-center p-4 sm:p-5">
                                        <h3 class="text-base sm:text-lg md:text-xl font-bold italic font-sans text-white">{{ project.name }}</h3>
                                        <p class="mt-2 text-xs sm:text-sm md:text-base line-clamp-2 text-gray-200 text-center">{{ project.description }}</p>
                                    </div>
                                </div>
                            </div>
                        </Link>
                    </Slide>
                </Carousel>

                <button
                    @click="carouselPrev"
                    class="hidden sm:block p-2 bg-white rounded-full shadow hover:bg-gray-100 text-black absolute top-1/2 z-10 left-2 sm:left-5 cursor-pointer transform -translate-y-1/2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button
                    @click="carouselNext"
                    class="hidden sm:block p-2 bg-white rounded-full shadow hover:bg-gray-100 text-black absolute top-1/2 z-10 right-2 sm:right-5 cursor-pointer transform -translate-y-1/2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </main>

        <FooterComponent />
    </div>
</template>

<script setup>
import { ref } from 'vue';
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

const carousel = ref(null);

const carouselPrev = () => {
    carousel.value.prev();
};

const carouselNext = () => {
    carousel.value.next();
};

const breakpoints = {
    400: {
        itemsToShow: 1.5,
        snapAlign: 'start',
    },
    640: {
        itemsToShow: 2,
        snapAlign: 'center',
    },
    768: {
        itemsToShow: 3,
        snapAlign: 'center',
    },
    1024: {
        itemsToShow: 4,
        snapAlign: 'start',
    },
    1280: {
        itemsToShow: 4,
        snapAlign: 'start',
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
    padding: 0 4px;
}

.carousel__viewport {
    overflow: visible;
}

.project-content {
    transition: all 0.3s ease;
}

.project-card:hover .project-content {
    background-color: rgba(0, 0, 0, 0.6);
}

@media (max-width: 640px) {
    .carousel__item {
        padding: 0 8px;
    }
}
</style>
