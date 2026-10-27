<template>
    <Head title="Նորություններ" />
    <AppLayout>
    <div class="p-4 max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Նորության խմբագրում</h1>
        <form @submit.prevent="submitForm" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="block mb-1 font-semibold" for="title">Վերնագիր</label>
                <input
                    v-model="form.title"
                    id="title"
                    type="text"
                    class="w-full p-2 border border-gray-300 rounded"
                />
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold" for="content">Բովանդակություն</label>
                <textarea
                    v-model="form.content"
                    id="content"
                    rows="5"
                    class="w-full p-2 border border-gray-300 rounded"
                ></textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold" for="published_at">Հրապարակման ամսաթիվ</label>
                <input
                    v-model="form.published_at"
                    id="published_at"
                    type="date"
                    class="w-full p-2 border border-gray-300 rounded"
                />
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Ներկա նկարը</label>
                <img
                    v-if="news.image_data"
                    :src="'data:image/' + news.image_type + ';base64,' + news.image_data"
                    :alt="news.title"
                    class="w-full h-48 object-cover rounded-t-lg mb-4"
                />
                <input
                    type="file"
                    @change="handleImageUpload"
                    accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                    class="w-full"
                />
            </div>

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
            >
                Թարմացնել
            </button>
        </form>
    </div>
    </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
    news: Object,
});

const form = useForm({
    title: props.news.title,
    content: props.news.content,
    published_at: props.news.published_at,
    image: null,
});

function handleImageUpload(e) {
    form.image = e.target.files[0];
}

function submitForm() {
    form.post(route('admin.news.update', props.news.id), {
        method: 'post',
        _method: 'put',
        preserveScroll: true,
        onSuccess: () => {
            router.visit(route('admin.news.index'));
        },
    });
}
</script>
