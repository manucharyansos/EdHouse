<template>
    <div class="px-4 sm:px-6 mt-8 sm:mt-12 py-8 sm:py-12 max-w-7xl mx-auto bg-white relative">
        <div class="absolute top-2 right-3 sm:right-5">
            <Link :href="route('home')">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" sm:width="30" sm:height="30" fill="red" viewBox="0 0 50 50">
                    <path d="M 25 2 C 12.309534 2 2 12.309534 2 25 C 2 37.690466 12.309534 48 25 48 C 37.690466 48 48 37.690466 48 25 C 48 12.309534 37.690466 2 25 2 z M 25 4 C 36.609534 4 46 13.390466 46 25 C 46 36.609534 36.609534 46 25 46 C 13.390466 46 4 36.609534 4 25 C 4 13.390466 13.390466 4 25 4 z M 32.990234 15.986328 A 1.0001 1.0001 0 0 0 32.292969 16.292969 L 25 23.585938 L 17.707031 16.292969 A 1.0001 1.0001 0 0 0 16.990234 15.990234 A 1.0001 1.0001 0 0 0 16.292969 17.707031 L 23.585938 25 L 16.292969 32.292969 A 1.0001 1.0001 0 1 0 17.707031 33.707031 L 25 26.414062 L 32.292969 33.707031 A 1.0001 1.0001 0 1 0 33.707031 32.292969 L 26.414062 25 L 33.707031 17.707031 A 1.0001 1.0001 0 0 0 32.990234 15.986328 z"></path>
                </svg>
            </Link>
        </div>
        <div class="grid lg:grid-cols-2 gap-6 sm:gap-8 md:gap-10 lg:gap-12">
            <!-- Text Block -->
            <div class="text-gray-500 font-sans italic order-2 lg:order-1">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3 sm:mb-4 text-gray-700">
                    {{ project.name }}
                </h1>
                <p class="text-sm sm:text-base text-gray-600 mb-3 sm:mb-4">{{ project.description }}</p>
                <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6">{{ project.location }}</p>
                <p class="text-sm sm:text-base text-gray-600 mb-6 sm:mb-8">{{ project.architect }}</p>
            </div>

            <!-- Images Block -->
            <div class="order-1 lg:order-2">
                <img :src="selectedImage" class="w-full h-[200px] sm:h-[300px] md:h-[350px] lg:h-[400px] object-cover rounded mb-3 sm:mb-4"  alt=""/>
                <div class="relative">
                    <div ref="carousel" class="flex items-center justify-center gap-2 sm:gap-3 md:gap-4 overflow-x-auto no-scrollbar px-8 sm:px-10">
                        <div
                            v-for="image in project.images"
                            :key="image.id"
                            class="w-16 h-10 sm:w-24 sm:h-12 md:w-24 md:h-16 border-2 rounded overflow-hidden cursor-pointer flex-shrink-0"
                            :class="selectedImage === image.image_url ? 'border-yellow-400' : 'border-transparent'"
                            @click="selectedImage = image.image_url"
                        >
                            <img :src="image.image_url" class="w-full h-full object-cover" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="flex justify-center gap-4 mt-6 sm:mt-8 md:mt-10">
            <button class="text-sm sm:text-base text-black px-3 py-1 sm:px-4 sm:py-2"
                    @click="goToPrevious"
                    :disabled="!project.previousProject"
                    :class="{'opacity-50 cursor-not-allowed': !project.previousProject}">
                Previous
            </button>
            <button class="text-sm sm:text-base text-black px-3 py-1 sm:px-4 sm:py-2"
                    @click="goToNext"
                    :disabled="!project.nextProject"
                    :class="{'opacity-50 cursor-not-allowed': !project.nextProject}">
                Next
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
    mounted() {
        console.log('Project Data:', this.project);
    },
    methods: {
        scrollLeft() {
            this.$refs.carousel.scrollBy({ left: -150, behavior: 'smooth' });
        },
        scrollRight() {
            this.$refs.carousel.scrollBy({ left: 150, behavior: 'smooth' });
        },
        goToPrevious() {
            console.log('Previous Project:', this.project.previousProject);
            if (this.project.previousProject) {
                router.visit(route('projects.show', this.project.previousProject.id));
            } else {
                console.log('No previous project available');
            }
        },
        goToNext() {
            console.log('Next Project:', this.project.nextProject);
            if (this.project.nextProject) {
                router.visit(route('projects.show', this.project.nextProject.id));
            } else {
                console.log('No next project available');
            }
        },
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
