<template>
    <div class="max-w-2xl mx-auto p-6 mt-20 bg-white shadow-md rounded-lg">
        <div class="absolute top-2 right-5">
            <Link :href="route('admin')">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" fill="red" viewBox="0 0 50 50">
                    <path d="M 25 2 C 12.309534 2 2 12.309534 2 25 C 2 37.690466 12.309534 48 25 48 C 37.690466 48 48 37.690466 48 25 C 48 12.309534 37.690466 2 25 2 z M 25 4 C 36.609534 4 46 13.390466 46 25 C 46 36.609534 36.609534 46 25 46 C 13.390466 46 4 36.609534 4 25 C 4 13.390466 13.390466 4 25 4 z M 32.990234 15.986328 A 1.0001 1.0001 0 0 0 32.292969 16.292969 L 25 23.585938 L 17.707031 16.292969 A 1.0001 1.0001 0 0 0 16.990234 15.990234 A 1.0001 1.0001 0 0 0 16.292969 17.707031 L 23.585938 25 L 16.292969 32.292969 A 1.0001 1.0001 0 1 0 17.707031 33.707031 L 25 26.414062 L 32.292969 33.707031 A 1.0001 1.0001 0 1 0 33.707031 32.292969 L 26.414062 25 L 33.707031 17.707031 A 1.0001 1.0001 0 0 0 32.990234 15.986328 z"></path>
                </svg>
            </Link>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Խմբագրել ծառայություն</h1>
        <form @submit.prevent="submitForm" class="space-y-6" enctype="multipart/form-data">
            <!-- SVG File Input -->
            <div>
                <img v-if="currentSvg" :src="'/storage/' + currentSvg" alt="Current SVG" class="mt-2 h-16 w-16 object-contain" />
                <label for="svg" class="block text-sm font-medium text-gray-700 mb-1">Պատկեր</label>
                <input
                    id="svg"
                    type="file"
                    accept="image/jpeg,image/png,image/jpg,image/svg+xml"
                    @change="handleFileChange"
                    class="w-full px-4 py-2 bg-neutral-700 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    :class="{ 'border-red-500': form.errors.svg }"
                />
                <p v-if="form.svg" class="text-sm text-gray-500 mt-1">Ընթացիկ SVG: {{ form.svg }}</p>
                <p v-if="form.errors.svg" class="text-red-500 text-sm mt-1">{{ form.errors.svg }}</p>
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
</template>

<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

interface Service {
    id: number;
    svg: string;
    name: string;
    description: string;
}

const props = defineProps<{
    service: Service;
}>();

const currentSvg = ref(props.service.svg);

const form = useForm({
    svg: null as File | null,
    name: props.service.name,
    description: props.service.description,
    _method: 'PUT' // Laravel's method spoofing for PUT requests
});

const submitForm = () => {
    form.post(`/admin/services/${props.service.id}`, {
        onSuccess: () => {
            form.reset();
            if (form.svg) {
                currentSvg.value = form.svg;
            }
        },
        forceFormData: true,
        preserveScroll: true,
    });
};

const handleFileChange = (event: Event) => {
    const input = event.target as HTMLInputElement;
    if (input.files && input.files.length > 0) {
        form.svg = input.files[0];
    }
};

const cancel = () => {
    form.reset();
    form.get('/admin/services');
};
</script>
