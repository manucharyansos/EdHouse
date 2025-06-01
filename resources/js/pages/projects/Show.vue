<template>
    <div class="px-6 mt-12 py-12 max-w-7xl mx-auto bg-white relative">
        <div class="absolute top-2 right-5">
            <Link :href="route('home')">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" fill="red" viewBox="0 0 50 50">
                    <path d="M 25 2 C 12.309534 2 2 12.309534 2 25 C 2 37.690466 12.309534 48 25 48 C 37.690466 48 48 37.690466 48 25 C 48 12.309534 37.690466 2 25 2 z M 25 4 C 36.609534 4 46 13.390466 46 25 C 46 36.609534 36.609534 46 25 46 C 13.390466 46 4 36.609534 4 25 C 4 13.390466 13.390466 4 25 4 z M 32.990234 15.986328 A 1.0001 1.0001 0 0 0 32.292969 16.292969 L 25 23.585938 L 17.707031 16.292969 A 1.0001 1.0001 0 0 0 16.990234 15.990234 A 1.0001 1.0001 0 0 0 16.292969 17.707031 L 23.585938 25 L 16.292969 32.292969 A 1.0001 1.0001 0 1 0 17.707031 33.707031 L 25 26.414062 L 32.292969 33.707031 A 1.0001 1.0001 0 1 0 33.707031 32.292969 L 26.414062 25 L 33.707031 17.707031 A 1.0001 1.0001 0 0 0 32.990234 15.986328 z"></path>
                </svg>
            </Link>
        </div>
        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Տեքստային բլոկ -->
            <div class="text-gray-500 font-sans italic">
                <h1 class="text-4xl font-bold mb-4 text-gray-700">
                    {{ project.name }}
                </h1>
                <p class="text-gray-600 mb-4">{{ project.description }}</p>
                <p class="text-gray-600 mb-8">{{ project.location }}</p>
                <p class="text-gray-600 mb-8">{{ project.architect }}</p>
            </div>

            <!-- Նկարների բլոկ -->
            <div>
                <img :src="selectedImage" class="w-full h-[400px] object-cover rounded mb-4" />
                <div class="relative">
                    <button @click="scrollLeft"
                            class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white p-2 shadow rounded z-10">
                        ‹
                    </button>
                    <div ref="carousel" class="flex gap-4 overflow-x-auto no-scrollbar px-10">
                        <div
                            v-for="image in project.images"
                            :key="image.id"
                            class="w-28 h-20 border-2 rounded overflow-hidden cursor-pointer flex-shrink-0"
                            :class="selectedImage === image.image_url ? 'border-yellow-400' : 'border-transparent'"
                            @click="selectedImage = image.image_url"
                        >
                            <img :src="image.image_url" class="w-full h-full object-cover" alt="" />
                        </div>
                    </div>
                    <button @click="scrollRight"
                            class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white p-2 shadow rounded z-10">
                        ›
                    </button>
                </div>
            </div>
        </div>

        <!-- Նավիգացիա -->
        <div class="flex justify-center gap-4 mt-10">
            <button class="text-black" @click="goToPrevious" :disabled="!project.previousProject">Previous</button>
            <button class="text-black" @click="goToNext" :disabled="!project.nextProject">Next</button>
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
