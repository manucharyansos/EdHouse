<template>
    <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col md:flex-row h-full max-w-3xl mx-auto"
         v-for="item in newsData"
         :key="item.id">
        <div class="relative w-full md:w-1/2 h-56 md:h-auto overflow-hidden group">
            <img
                :src="item.image"
                alt="News Image"
                class="w-full h-full z-20 object-cover transform transition-transform duration-500"
            >
            <!-- Yellow overlay with animation -->
            <div class="flex items-center justify-center absolute inset-0 bg-yellow-400 opacity-50 group-hover:bg-opacity-50 transition-all duration-500 transform -translate-x-full group-hover:translate-x-0">
<!--                <button class="w-12 h-24 cursor-pointer hover:fill-blue-900" @click="$emit('toSelectedNews', item)">-->
<!--                    <svg viewBox="0 0 640 512" xmlns="http://www.w3.org/2000/svg" fill="fill-blue">-->
<!--                        <path d="M598.6 41.41C570.1 13.8 534.8 0 498.6 0s-72.36 13.8-99.96 41.41l-43.36 43.36c15.11 8.012 29.47 17.58 41.91 30.02c3.146 3.146 5.898 6.518 8.742 9.838l37.96-37.96C458.5 72.05 477.1 64 498.6 64c20.67 0 40.1 8.047 54.71 22.66c14.61 14.61 22.66 34.04 22.66 54.71s-8.049 40.1-22.66 54.71l-133.3 133.3C405.5 343.1 386 352 365.4 352s-40.1-8.048-54.71-22.66C296 314.7 287.1 295.3 287.1 274.6s8.047-40.1 22.66-54.71L314.2 216.4C312.1 212.5 309.9 208.5 306.7 205.3C298.1 196.7 286.8 192 274.6 192c-11.93 0-23.1 4.664-31.61 12.97c-30.71 53.96-23.63 123.6 22.39 169.6C293 402.2 329.2 416 365.4 416c36.18 0 72.36-13.8 99.96-41.41L598.6 241.3c28.45-28.45 42.24-66.01 41.37-103.3C639.1 102.1 625.4 68.16 598.6 41.41zM234 387.4L196.1 425.3C181.5 439.1 162 448 141.4 448c-20.67 0-40.1-8.047-54.71-22.66c-14.61-14.61-22.66-34.04-22.66-54.71s8.049-40.1 22.66-54.71l133.3-133.3C234.5 168 253.1 160 274.6 160s40.1 8.048 54.71 22.66c14.62 14.61 22.66 34.04 22.66 54.71s-8.047 40.1-22.66 54.71L325.8 295.6c2.094 3.939 4.219 7.895 7.465 11.15C341.9 315.3 353.3 320 365.4 320c11.93 0 23.1-4.664 31.61-12.97c30.71-53.96 23.63-123.6-22.39-169.6C346.1 109.8 310.8 96 274.6 96C238.4 96 202.3 109.8 174.7 137.4L41.41 270.7c-27.6 27.6-41.41 63.78-41.41 99.96c-.0001 36.18 13.8 72.36 41.41 99.97C69.01 498.2 105.2 512 141.4 512c36.18 0 72.36-13.8 99.96-41.41l43.36-43.36c-15.11-8.012-29.47-17.58-41.91-30.02C239.6 394.1 236.9 390.7 234 387.4z"/>-->
<!--                    </svg>-->
<!--                </button>-->
            </div>
        </div>
        <div class="w-full md:w-1/2 p-4 sm:p-6 flex flex-col">
            <h3 class="text-base font-bold text-gray-800 mb-2 sm:mb-3 uppercase tracking-wide">{{ item.title }}</h3>
            <div class="text-gray-500 mb-2 sm:mb-4 text-sm flex items-center">
                <span class="w-5 h-5 mr-2 rounded-full bg-orange-500 inline-block"></span>
                {{ formatDate(item.publishet_at) }}
            </div>
            <p class="text-gray-600 text-sm flex-grow">{{ item.content }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        newsData: {
            type: Array,
            default: () => []
        },

    },
    methods: {
        formatDate(date) {
            const d = new Date(date);
            return d.toLocaleDateString('en-US', {
                month: 'long',
                day: 'numeric',
                year: 'numeric'
            }).replace(',', '').toUpperCase();
        }
    }
}
</script>
