<template>
    <Head title="Ծառայություններ" />
    <AppLayout>
    <div class="max-w-2xl mx-auto p-6 mt-20 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Խմբագրել ծառայություն</h1>
        <form @submit.prevent="submitForm" class="space-y-6" enctype="multipart/form-data">
            <!-- SVG File Input -->
            <div>
                <img v-if="imagePreview || service.image_url"
                     :src="imagePreview || service.image_url"
                     class="h-48 w-full object-cover rounded-lg mb-2"
                     alt="Service Image">

                <label class="block text-sm font-medium text-gray-700 mb-1">Պատկեր</label>
                <input
                    type="file"
                    accept="image/*"
                    @change="handleFileChange"
                    class="w-full px-4 py-2 border rounded-md"
                />
                <p v-if="form.errors.image" class="text-red-500 text-sm mt-1">{{ form.errors.image }}</p>
            </div>

            <!-- Name Input -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Անուն</label>
                <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    placeholder="Անուն"
                    required
                    class="w-full px-4 py-2 bg-neutral-700 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    :class="{ 'border-red-500': form.errors.name }"
                />
                <p v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
            </div>

            <!-- Description Textarea -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Նկարագրություն</label>
                <textarea
                    id="description"
                    v-model="form.description"
                    placeholder="Նկարագրություն"
                    required
                    rows="5"
                    class="w-full px-4 py-2 bg-neutral-700 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 resize-y"
                    :class="{ 'border-red-500': form.errors.description }"
                ></textarea>
                <p v-if="form.errors.description" class="text-red-500 text-sm mt-1">{{ form.errors.description }}</p>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-4">
                <button
                    type="button"
                    @click="cancel"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500"
                >
                    Չեղարկել
                </button>
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50"
                >
                    Հաստատել
                </button>
            </div>
        </form>
    </div>
    </AppLayout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
    service: Object
});

const imagePreview = ref(null);

const form = useForm({
    image: null,
    name: props.service.name,
    description: props.service.description,
    _method: 'PUT'
});

const handleFileChange = (e) => {
    const file = e.target.files[0];
    form.image = file;

    if (file) {
        const reader = new FileReader();
        reader.onload = (event) => {
            imagePreview.value = event.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        imagePreview.value = null;
    }
};

const submitForm = () => {
    form.post(`/admin/services/${props.service.id}`, {
        forceFormData: true,
        preserveScroll: true,
    });
};

const cancel = () => {
    window.history.back();
};
</script>
