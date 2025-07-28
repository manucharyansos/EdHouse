<template>
    <Head title="Ծառայություններ" />
    <AppLayout>
    <div class="min-h-screen py-32 px-4 sm:px-6 lg:px-8 relative">
        <div class="max-w-md mx-auto pt-12 bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
            <div class="p-8">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-800">Ավելացնել ծառայություն</h1>
                </div>

                <form @submit.prevent="submitForm" class="space-y-6" enctype="multipart/form-data">
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Նկար</label>
                        <input
                            id="image"
                            name="image"
                            @change="onFileChange"
                            required
                            type="file"
                            class="mt-1 block w-full px-3 py-2 border bg-neutral-700 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                        />
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Անուն</label>
                        <input
                            id="name"
                            v-model="form.name"
                            placeholder="Անուն"
                            required
                            class="mt-1 block w-full px-3 py-2 border bg-neutral-700 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        />
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Նկարագրություն</label>
                        <textarea
                            id="description"
                            v-model="form.description"
                            placeholder="Նկարագրություն"
                            required
                            rows="4"
                            class="mt-1 block w-full px-3 py-2 border bg-neutral-700 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        ></textarea>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <button
                            type="button"
                            @click="cancel"
                            class="px-4 py-2 border cursor-pointer border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Չեղարկել
                        </button>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span v-if="form.processing">Մշակվում է...</span>
                            <span v-else>Հաստատել</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </AppLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const form = useForm({
    image: null,
    name: '',
    description: '',
});

const onFileChange = (event) => {
    form.image = event.target.files[0];
};

const submitForm = () => {
    form.post('/admin/services', {
        forceFormData: true,
        onSuccess: () => form.reset(),
        onError: (errors) => console.error(errors),
    });
};

const cancel = () => {
    form.reset();
    form.get('/services/admin');
};
</script>
