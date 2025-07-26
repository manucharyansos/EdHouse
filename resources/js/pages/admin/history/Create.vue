<!-- Create.vue -->
<template>
    <div class="container flex items-center justify-center flex-col font-sans italic mx-auto my-8 max-w-2xl bg-neutral-300 rounded-lg">
        <h1 class="text-3xl font-bold mb-8 text-center text-gray-800 py-4">Ավելացնել պատմության կետ</h1>

        <form @submit.prevent="submit" enctype="multipart/form-data" class="bg-neutral-300 p-6 rounded-lg shadow-md mx-8">
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Տարի</label>
                <input v-model="form.year" type="number" class="bg-neutral-800 w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Վերնագիր</label>
                <input v-model="form.title" type="text" class="bg-neutral-800 w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Բովանդակություն</label>
                <textarea v-model="form.content" class="bg-neutral-800 w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="5" required></textarea>
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Պատկեր</label>
                <input type="file" name="image" class="w-full p-2 border bg-neutral-800 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" @change="onFileChange">
            </div>

            <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Ավելացնել</button>
        </form>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    year: '',
    title: '',
    content: '',
    image: null
});

const onFileChange = (event) => {
    form.image = event.target.files[0];
    console.log('Selected file:', form.image);
};

const submit = () => {
    form.post(route('admin.history.store'), {
        forceFormData: true,
        onSuccess: () => console.log('Success!'),
        onError: (errors) => console.error(errors),
    });

};
</script>
