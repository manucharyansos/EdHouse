<template>
    <div class="px-4 sm:px-6 mt-8 sm:mt-12 py-8 sm:py-12 max-w-7xl mx-auto bg-white relative">
        <!-- Close button -->
        <div class="absolute top-2 right-3 sm:right-5">
            <Link :href="route('home')">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="red" viewBox="0 0 50 50">
                    <path d="M25 2C12.3 2 2 12.3 2 25s10.3 23 23 23 23-10.3 23-23S37.7 2 25 2zm0 2c11.6 0 21 9.4 21 21s-9.4 21-21 21S4 36.6 4 25 13.4 4 25 4zm7.99 11.99a1 1 0 0 0-.7.3L25 23.59l-7.29-7.3a1 1 0 0 0-1.42 1.42L23.59 25l-7.3 7.29a1 1 0 1 0 1.42 1.42L25 26.41l7.29 7.3a1 1 0 1 0 1.42-1.42L26.41 25l7.3-7.29a1 1 0 0 0-.72-1.72z"/>
                </svg>
            </Link>
        </div>

        <!-- Content -->
        <div class="grid lg:grid-cols-2 gap-6 sm:gap-8 md:gap-10 lg:gap-12">
            <!-- Text -->
            <div class="text-gray-500 font-sans italic order-2 lg:order-1">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3 sm:mb-4 text-gray-700">
                    {{ project.name }}
                </h1>
                <p class="text-sm sm:text-base text-gray-600 mb-3 sm:mb-4">{{ project.description }}</p>
                <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6">{{ project.location }}</p>
                <p class="text-sm sm:text-base text-gray-600 mb-6 sm:mb-8">{{ project.architect }}</p>
            </div>

            <!-- Image Gallery -->
            <div class="order-1 lg:order-2">
                <img
                    :src="selectedImage"
                    @error="onImageError"
                    class="w-full h-[200px] sm:h-[300px] md:h-[350px] lg:h-[400px] object-cover rounded mb-3 sm:mb-4"
                    alt="Main Image"
                />

                <div v-if="project.images && project.images.length" class="relative">
                    <div ref="carousel" class="flex items-center justify-center gap-2 sm:gap-3 md:gap-4 overflow-x-auto no-scrollbar px-8 sm:px-10">
                        <div
                            v-for="image in project.images"
                            :key="image.id"
                            class="w-16 h-10 sm:w-24 sm:h-12 md:w-24 md:h-16 border-2 rounded overflow-hidden cursor-pointer flex-shrink-0"
                            :class="selectedImage === image.url ? 'border-yellow-400 ring-2 ring-yellow-300' : 'border-gray-200'"
                            @click="selectedImage = image.url"
                        >
                            <img :src="image.url" class="w-full h-full object-cover" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-center gap-4 mt-6 sm:mt-8 md:mt-10">
            <button
                class="text-sm sm:text-base text-black px-3 py-1 sm:px-4 sm:py-2"
                @click="goToPrevious"
                :disabled="!project.previousProject"
                :class="{ 'opacity-50 cursor-not-allowed': !project.previousProject }"
            >
                Նախորդ
            </button>
            <button
                class="text-sm sm:text-base text-black px-3 py-1 sm:px-4 sm:py-2"
                @click="goToNext"
                :disabled="!project.nextProject"
                :class="{ 'opacity-50 cursor-not-allowed': !project.nextProject }"
            >
                Հաջորդը
            </button>
        </div>
    </div>
</template>

<script>
import { Link, router } from '@inertiajs/vue3';

export default {
    components: { Link },
    props: {
        project: Object
    },
    data() {
        return {
            selectedImage: this.project.image_url
        };
    },
    watch: {
        project() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            this.selectedImage = this.project.image_url;
        }
    },
    methods: {
        onImageError() {
            this.selectedImage = '/images/default-project.jpg';
        },
        goToPrevious() {
            if (this.project.previousProject) {
                router.visit(route('projects.show', this.project.previousProject.id));
            }
        },
        goToNext() {
            if (this.project.nextProject) {
                router.visit(route('projects.show', this.project.nextProject.id));
            }
        }
    }
};
</script>

<style scoped>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
