<template>
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-3xl font-bold text-gray-800 mb-8">Խմբագրել պատմության կետ</h1>

                <form @submit.prevent="submitForm" class="bg-white shadow rounded-lg p-6" enctype="multipart/form-data">
                    <!-- Year Input -->
                    <div class="mb-6">
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Տարի *</label>
                        <input
                            id="year"
                            v-model="form.year"
                            type="number"
                            required
                            class="w-full bg-neutral-600 px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                            :class="{ 'border-red-500': form.errors.year }"
                        />
                        <p v-if="form.errors.year" class="mt-1 text-sm text-red-600">{{ form.errors.year }}</p>
                    </div>

                    <!-- Title Input -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Վերնագիր *</label>
                        <input
                            id="title"
                            v-model="form.title"
                            type="text"
                            required
                            class="w-full bg-neutral-600 px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                            :class="{ 'border-red-500': form.errors.title }"
                        />
                        <p v-if="form.errors.title" class="mt-1 text-sm text-red-600">{{ form.errors.title }}</p>
                    </div>

                    <!-- Content Input -->
                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Բովանդակություն *</label>
                        <textarea
                            id="content"
                            v-model="form.content"
                            rows="5"
                            required
                            class="w-full bg-neutral-600 px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                            :class="{ 'border-red-500': form.errors.content }"
                        ></textarea>
                        <p v-if="form.errors.content" class="mt-1 text-sm text-red-600">{{ form.errors.content }}</p>
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Նկար</label>
                        <div class="flex items-center space-x-4">
                            <img
                                v-if="history.image_url"
                                :src="history.image_url"
                                class="h-20 w-20 object-cover rounded-md"
                            >
                            <input
                                type="file"
                                @change="handleFileChange"
                                accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                            />
                        </div>
                        <p v-if="form.errors.image" class="mt-1 text-sm text-red-600">{{ form.errors.image }}</p>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3">
                        <Link
                            :href="route('admin.history.index')"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
                        >
                            Չեղարկել
                        </Link>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50"
                        >
                            Պահպանել
                        </button>
                    </div>
                </form>
            </div>
        </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    history: Object
});

const form = useForm({
    year: props.history.year,
    title: props.history.title,
    content: props.history.content,
    image: null,
    _method: 'PUT' // Add method spoofing for PUT request
});

const handleFileChange = (e) => {
    form.image = e.target.files[0];
};

const submitForm = () => {
    form.post(route('admin.history.update', props.history.id), {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
        onError: (errors) => {
            console.error('Update error:', errors);
        }
    });
};
</script>
