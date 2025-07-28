<template>
    <Head title="Խմբագրել Նորություն" />
    <AppLayout>
        <div class="container mx-auto px-4 py-8 text-white">
            <div class="max-w-2xl mx-auto bg-neutral-900 rounded-lg p-6 shadow-lg">
                <h1 class="text-2xl font-bold mb-6">Խմբագրել Նորություն</h1>

                <form @submit.prevent="submit" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="block mb-1">Վերնագիր</label>
                        <input v-model="form.title" type="text" class="w-full p-2 rounded bg-neutral-800 border border-neutral-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Բովանդակություն</label>
                        <textarea v-model="form.content" rows="5" class="w-full p-2 rounded bg-neutral-800 border border-neutral-700 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        <div v-if="form.errors.content" class="text-red-500 text-sm mt-1">{{ form.errors.content }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Հրապարակման ամսաթիվ</label>
                        <input v-model="form.published_at" type="date" class="w-full p-2 rounded bg-neutral-800 border border-neutral-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <div v-if="form.errors.published_at" class="text-red-500 text-sm mt-1">{{ form.errors.published_at }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Նկար</label>
                        <div class="flex items-center gap-4">
                            <img v-if="news.image" :src="`/storage/${news.image}`" class="w-24 h-24 object-cover rounded"  alt=""/>
                            <input type="file" @change="onFileChange" class="text-sm text-white">
                        </div>
                        <div v-if="form.errors.image" class="text-red-500 text-sm mt-1">{{ form.errors.image }}</div>
                    </div>

                    <div class="flex justify-end">
                        <button :disabled="form.processing" type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                            Պահպանել
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
    news: Object
});

const form = useForm({
    title: props.news.title,
    content: props.news.content,
    published_at: props.news.published_at,
    image: null,
    _method: 'PUT'
});

const onFileChange = (e) => {
    form.image = e.target.files[0];
};

const submit = () => {
    form.post(route('admin.news.update', props.news.id), {
        forceFormData: true,
        preserveScroll: true,
    });
};
</script>
