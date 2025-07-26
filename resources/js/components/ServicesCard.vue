<template>
    <div class="relative w-80 h-84 flex flex-col items-center justify-center group overflow-hidden bg-white" :class="classes">
        <div class="flex flex-col items-center justify-center bg-neutral-600 w-full transition-all duration-500 ease-out group-hover:-translate-y-8">
            <div class="transition-all duration-500 ease-out group-hover:translate-y-8 h-40 w-full flex items-center justify-center">
                <img :src="imgUrl" class="size-20 object-cover mask-radial-at-center" alt="">
            </div>
            <h2 class="text-3xl h-12 text-center italic font-meno font-bold text-white">
                {{ paragraph }}
            </h2>
            <p class="text-base text-gray-400 h-32 text-center overflow-y-auto p-2">
                {{ text }}
            </p>
        </div>
        <button
            class="absolute bottom-0 px-12 py-3 w-full h-16 text-center text-xl bg-amber-300 hover:bg-orange-600 text-black hover:text-white font-sans italic transform translate-y-full group-hover:translate-y-0 transition-all duration-500 ease-out cursor-pointer"
            @click="$emit('readMore')">
            {{ buttonText }}
        </button>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    name: "ServicesCard",
    components: { Link },
    props: {
        paragraph: {
            type: String,
            default: ''
        },
        imgUrl: {
            type: String,
            default: ''
        },
        text: {
            type: String,
            default: ''
        },
        buttonText: {
            type: String,
            default: 'Կարդալ ավելին'
        },
        classes: {
            type: String,
            default: ''
        }
    }
}
</script>
