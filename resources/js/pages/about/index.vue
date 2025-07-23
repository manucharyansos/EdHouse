<template>
    <div class="about_page px-4">
        <div class="h-[100px] bg-transparent">
            <HeaderComponent />
        </div>

        <main class="flex flex-col items-center bg-white">
            <div class="about_bg_img w-full h-80 flex items-center justify-center">
                <h1 class="text-5xl font-extrabold italic text-white">Մեր մասին</h1>
            </div>

            <div class="container max-w-5xl px-4 py-12">
                <h2 class="text-3xl font-bold mb-8">Մեր Պատմությունը</h2>

                <div class="relative border-l-4 border-orange-400 pl-8">
                    <div
                        v-for="(items, title) in sections"
                        :key="title"
                        class="mb-16 relative"
                    >
                        <div v-for="item in items" :key="item.id" class="group flex flex-col md:flex-row mb-12">
                            <!-- Year -->
                            <div class="absolute -left-14 top-0 text-lg font-bold bg-white text-gray-700 w-12">
                                {{ item.year }}
                            </div>

                            <!-- Image -->
                            <img
                                :src="item.image_url"
                                alt="history"
                                class="w-full md:w-1/2 rounded-bl-lg rounded-tl-lg shadow-md object-cover max-h-64"
                            />

                            <!-- Content -->
                            <div class="flex flex-col justify-center md:w-1/2 bg-gray-100 p-6 rounded-br-lg rounded-tr-lg shadow-sm">
                                <h3 class="text-xl font-bold text-orange-600 mb-2">{{ title }}</h3>
                                <p class="text-gray-700 leading-relaxed">{{ item.content }}</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div v-if="$page.props.auth.user" class="mt-8 text-right">
                    <Link :href="route('admin.history.create')" class="btn btn-primary">
                        Add New History Item
                    </Link>
                </div>
            </div>
        </main>

        <FooterComponent />
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import HeaderComponent from '@/components/HeaderComponent.vue';
import FooterComponent from '@/components/FooterComponent.vue';
import { onMounted } from 'vue';
export default {
    components: { Link, HeaderComponent, FooterComponent },
    props: {
        timeline: {
            type: Array,
            default: []
        },
        sections: Object,
    },
    mounted() {
        console.log('Component mounted');
        console.log('Timeline:', this.timeline);
        console.log('Sections:', this.sections);
    },
}

</script>
<style scoped>
.about_bg_img {
    background-image: url('/img/bg-image-02-1920x674.jpg');
    background-position: center;
    background-repeat: no-repeat;
}
</style>
