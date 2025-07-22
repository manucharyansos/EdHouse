<template>
    <Head title="EdHous">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <HeaderComponent />
    <!-- Hero Section -->
    <div class="home_page flex min-h-screen flex-col items-center bg-gray-50" :style="{ backgroundImage: `url(${backgroundImage})` }">
        <div class="container mx-auto px-4 flex-grow flex items-center">
            <main class="w-full">
                <div class="grid grid-cols-1 lg:grid-cols-2 items-center">
                    <div class="flex flex-col items-start justify-center gap-4 px-4 lg:px-24 mt-20 lg:mt-40">
                        <h1 class="text-black text-3xl md:text-5xl italic font-bold font-sans">Վերանորոգում</h1>
                        <h2 class="text-black text-xl md:text-2xl italic font-normal font-sans">Ինտերիերի և արտաքին ձևավորում</h2>
                        <p class="border-l-orange-600 border-l-4 md:border-l-6 pl-4 md:pl-6 text-black text-sm md:text-base italic font-normal font-sans">
                            Մենք տրամադրում ենք ծրագրի ընդհանուր պլանավորում, համակարգում և վերահսկում, այնպես որ դուք կարիք չունեք անհանգստանալու որևէ բանի համար:
                        </p>
                        <Link
                            class="px-8 md:px-12 py-2 md:py-3 bg-orange-600 hover:bg-amber-300 text-white hover:text-black font-sans italic text-sm md:text-base"
                            :href="route('about')"
                        >
                            Կարդալ ավելին
                        </Link>
                    </div>
                    <div class="hidden lg:block"></div> <!-- Spacer for larger screens -->
                </div>
            </main>
        </div>
        <div class="h-14 hidden lg:block"></div>
    </div>

    <!-- Services Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 w-full gap-4">
        <div v-for="service in services" :key="service.id">
            <ServicesCard
                :paragraph="service.name"
                :img-url="service.image_url"
                :text="service.description"
                classes="bg-zinc-800 h-full"
                @readMore="toRemodeling(service)"
            />
        </div>
    </div>

    <!-- About Us Section -->
    <div class="about_us_section py-12 md:py-24 w-full flex flex-col items-center justify-start bg-white px-4">
        <h1 class="mx-auto text-2xl md:text-5xl font-black font-mono italic text-black text-center">Մեր մասին</h1>
        <div class="w-full md:w-1/2 text-gray-600 font-mono italic mt-6 md:mt-12 text-center">
            Մեր հիմնադրումից ի վեր մենք տարածաշրջանային կազմակերպությունից վերածվել ենք ոլորտում բազմակողմանի, ազգային ներկայության
        </div>
        <div class="container mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 mt-10 md:mt-20">
            <!-- Video Section -->
            <div class="video_section w-full h-64 md:h-96 lg:w-[526px] lg:h-[426px] lg:ml-auto mx-auto">
            </div>

            <!-- Info Section -->
            <div class="w-full lg:w-[526px] info_section flex flex-col items-start justify-start gap-4 md:gap-6 text-black">
                <div class="flex flex-col sm:flex-row h-auto sm:h-32 w-full bg-yellow-300 px-4">
                    <div class="w-full sm:w-3/4 flex flex-col items-start justify-center py-4 sm:py-0">
                        <h2 class="font-black text-lg md:text-xl font-sans italic py-1 md:py-2">Մասնագիտական անձնակազմ</h2>
                        <p class="font-normal text-sm md:text-base font-sans italic pb-2 md:pb-6">Մենք աշխատանքի ենք վերցնում լրիվ դրույքով աշխատող փորձառու մասնագետների, ովքեր սերտորեն համագործակցում են մեզ հետ։</p>
                    </div>
                    <div class="flex items-center justify-center text-3xl md:text-5xl opacity-25 py-2 sm:py-0">
                        01
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row h-auto sm:h-32 w-full bg-yellow-300 px-4">
                    <div class="w-full sm:w-3/4 flex flex-col items-start justify-center py-4 sm:py-0">
                        <h2 class="font-black text-lg md:text-xl font-sans italic py-1 md:py-2">Կանոնավոր հաշվետվություն</h2>
                        <p class="font-normal text-sm md:text-base font-sans italic pb-2 md:pb-6">Մեր հաճախորդները ստանում են ակնթարթային հաշվետվություններ մեր շինարարական նախագծերի յուրաքանչյուր փուլի վերաբերյալ։</p>
                    </div>
                    <div class="flex items-center justify-center text-3xl md:text-5xl opacity-25 py-2 sm:py-0">
                        02
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row h-auto sm:h-32 w-full bg-yellow-300 px-4">
                    <div class="w-full sm:w-3/4 flex flex-col items-start justify-center py-4 sm:py-0">
                        <h2 class="font-black text-lg md:text-xl font-sans italic py-1 md:py-2">Որակյալ նյութեր</h2>
                        <p class="font-normal text-sm md:text-base font-sans italic pb-2 md:pb-6">Մենք օգտագործում ենք հնարավորինս բարձր որակի շինանյութեր։</p>
                    </div>
                    <div class="flex items-center justify-center text-3xl md:text-5xl opacity-25 py-2 sm:py-0">
                        03
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Projects Section -->
    <div class="projects_section w-full py-16 bg-gray-50 px-4">
        <div class="container mx-auto">
            <h2 class="text-2xl md:text-5xl font-black font-mono italic text-black text-center mb-8">Մեր նախագծերը</h2>

            <!-- Filter Buttons -->
            <div class="flex flex-wrap justify-center gap-2 md:gap-4 mb-12">
                <button
                    v-for="category in categories"
                    :key="category.id"
                    @click="activeCategory = category.id"
                    :class="[
                    'px-4 py-2 text-sm md:text-base font-sans italic',
                    activeCategory === category.id
                        ? 'bg-orange-600 text-white'
                        : 'bg-white text-black hover:bg-gray-100'
                ]"
                >
                    {{ category.name.toUpperCase() }}
                </button>
            </div>

            <!-- Carousel -->
            <div class="relative">
                <Carousel
                    ref="carousel"
                    :items-to-show="4"
                    aria-multiline="true"
                    :wrap-around="true"
                    :breakpoints="breakpoints"
                    :autoplay="3000"
                    class="w-full"
                >
                    <Slide v-for="project in filteredProjects" :key="project.id">
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
        </div>
    </div>

    <!-- Get Our Brochure Section with Fixed Background -->
    <div class="static_bgi w-full">
        <div class="w-full h-72"></div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 bg-white p-4 md:p-24">
            <div class="w-full h-auto flex items-center justify-center">
                <img class="max-w-full h-auto" src="/img/download-01-433x634.webp" alt="Brochure">
            </div>
            <div class="w-full h-auto md:h-[530px] flex flex-col items-center justify-center border-10 border-gray-200">
                <h2 class="text-2xl md:text-5xl font-black font-mono italic text-black text-center mb-8">Ստացեք մեր գրքույկը</h2>
                <div class="w-22 h-2 bg-yellow-400 my-5"></div>
                <p class="font-normal text-center text-sm md:text-base text-gray-500 mt-12 font-sans italic pb-2 md:pb-6 px-4 md:px-12">Եթե փնտրում եք բարձրորակ շինարարական ծառայություններ մատուցող, մենք ուրախ կլինենք օգնել ձեզ: </p>
            </div>
        </div>
    </div>

    <!-- Company News Section -->
    <div class="company_news min-h-screen bg-gray-100 py-12 px-4">
        <h2 class="text-2xl md:text-5xl font-bold text-black text-center mb-12">
            Ընկերության նորություններ
        </h2>
        <div class="flex justify-center mb-8">
        </div>
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <NewsCard
                    :news-data="news"
                />
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <FooterComponent class="z-50" />
</template>

<script>
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'
import { Head, Link } from '@inertiajs/vue3';
import ServicesCard from '@/components/ServicesCard.vue';
import HeaderComponent from '@/components/HeaderComponent.vue';
import NewsCard from '@/components/NewsCard.vue';
import FooterComponent from '@/components/FooterComponent.vue';

export default {
    components: {
        FooterComponent,
        NewsCard,
        Link,
        ServicesCard,
        HeaderComponent,
        Head,
        Carousel,
        Slide,
        Pagination,
        Navigation
    },
    props: {
        backgroundImage: {
            type: String,
            default: '/img/default-bg.jpg',
        },
        backgroundVideo: {
            type: String,
            default: '/img/about-01-569x488.jpg'
        },
        categories: {
            type: Array,
            default: () => []
        },
        projects: {
            type: Array,
            default: () => []
        },
        news: {
            type: Array,
            default: () => []
        },
        services: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            activeCategory: null,
            breakpoints: {
                320: { itemsToShow: 1, snapAlign: 'center' },
                640: { itemsToShow: 2, snapAlign: 'center' },
                768: { itemsToShow: 3, snapAlign: 'start' },
                1024: { itemsToShow: 4, snapAlign: 'start' }
            }
        }
    },
    computed: {
        filteredProjects() {
            if (!this.activeCategory) return this.projects;
            return this.projects.filter(project =>
                project.categories.some(cat => cat.id === this.activeCategory))
        }
    },
    mounted() {
        if (this.categories.length > 0) {
            this.activeCategory = this.categories[0].id;
        }
        console.log(this.services, 'hfghf');
    },
    methods: {
        toRemodeling(serviceId) {
            this.$inertia.get(route('services.show', { service: serviceId }));
        },
        carouselPrev() {
            this.$refs.carousel.prev();
        },
        carouselNext() {
            this.$refs.carousel.next();
        },
    }
};
</script>

<style scoped>
.home_page {
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
    min-height: 100vh;
}

@media (max-width: 768px) {
    .home_page {
        background-attachment: scroll;
    }
}

.video_section {
    background-image: url('/img/about-01-569x488.jpg');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    border-radius: 0.5rem;
    overflow: hidden;
}

.projects_section {
    background: #f2f3f8;
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

.project-card {
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.project-card:hover .project-content {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    height: 90%;
    margin: 15px;
}

.project-image {
    height: 280px;
    object-fit: cover;
}

.project-content {
    background: #000;
    opacity: 50%;
    flex-grow: 1;
    height: 90%;
    display: none;
}

.static_bgi {
    background-image: url('/img/bg-image-01-1920x1100.jpg');
    background-position: center;
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
    z-index: 0;
}

.static_bgi > * {
    position: relative;
    z-index: 1;
}

.company_news {
    background: #f2f3f8;
    position: relative;
    z-index: 0;
}

/* Ensure footer is visible */
footer {
    position: relative;
    z-index: 50;
    width: 100%;
    background: #1a202c;
    color: white;
}
</style>
