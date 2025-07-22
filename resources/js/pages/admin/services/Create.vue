<template>
    <HeaderComponent />
    <div class="min-h-screen py-32 px-4 sm:px-6 lg:px-8 relative">
        <Link :href="route('admin')" class="absolute top-32 right-10 z-50">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" fill="red" viewBox="0 0 50 50">
                <path d="M 25 2 C 12.309534 2 2 12.309534 2 25 C 2 37.690466 12.309534 48 25 48 C 37.690466 48 48 37.690466 48 25 C 48 12.309534 37.690466 2 25 2 z M 25 4 C 36.609534 4 46 13.390466 46 25 C 46 36.609534 36.609534 46 25 46 C 13.390466 46 4 36.609534 4 25 C 4 13.390466 13.390466 4 25 4 z M 32.990234 15.986328 A 1.0001 1.0001 0 0 0 32.292969 16.292969 L 25 23.585938 L 17.707031 16.292969 A 1.0001 1.0001 0 0 0 16.990234 15.990234 A 1.0001 1.0001 0 0 0 16.292969 17.707031 L 23.585938 25 L 16.292969 32.292969 A 1.0001 1.0001 0 1 0 17.707031 33.707031 L 25 26.414062 L 32.292969 33.707031 A 1.0001 1.0001 0 1 0 33.707031 32.292969 L 26.414062 25 L 33.707031 17.707031 A 1.0001 1.0001 0 0 0 32.990234 15.986328 z"></path>
            </svg>
        </Link>
        <div class="max-w-md mx-auto pt-12 bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
            <div class="p-8">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-800">Ավելացնել ծառայություն</h1>
                </div>

                <form @submit.prevent="submitForm" class="space-y-6" enctype="multipart/form-data">
                    <div>
                        <label for="svg" class="block text-sm font-medium text-gray-700">SVG</label>
                        <input
                            id="svg"
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
                            class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
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
    <FooterComponent />
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import HeaderComponent from '@/components/HeaderComponent.vue';
import FooterComponent from '@/components/FooterComponent.vue';

const form = useForm({
    svg: null,
    name: '',
    description: '',
});

const onFileChange = (event) => {
    form.svg = event.target.files[0];
    console.log('Selected file:', form.svg);
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
    window.location.href = '/admin/services';
};
</script>
