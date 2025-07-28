<template>
    <Head title="Պատմություն" />
    <AppLayout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">Ավելացնել նոր նախագիծ</h1>

        <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block font-medium">Անուն</label>
                <input v-model="form.name" type="text" class="input" />
                <div v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</div>
            </div>

            <div>
                <label class="block font-medium">Նկարագրություն</label>
                <textarea v-model="form.description" class="input"></textarea>
                <div v-if="form.errors.description" class="text-red-500">{{ form.errors.description }}</div>
            </div>

            <div>
                <label class="block font-medium">Տեղադրություն</label>
                <input v-model="form.location" type="text" class="input" />
                <div v-if="form.errors.location" class="text-red-500">{{ form.errors.location }}</div>
            </div>

            <div>
                <label class="block font-medium">Ճարտարապետ</label>
                <input v-model="form.architect" type="text" class="input" />
                <div v-if="form.errors.architect" class="text-red-500">{{ form.errors.architect }}</div>
            </div>

            <div>
                <label class="block font-medium">Գլխավոր Նկար</label>
                <input type="file" @change="e => form.image = e.target.files[0]" />
                <div v-if="form.errors.image" class="text-red-500">{{ form.errors.image }}</div>
            </div>

            <div>
                <label class="block font-medium">Լրացուցիչ Նկարներ</label>
                <input type="file" multiple @change="handleMultipleImages" />
                <div v-if="form.errors['images.*']" class="text-red-500">{{ form.errors['images.*'] }}</div>
            </div>

            <div>
                <label class="block font-medium">Կատեգորիաներ</label>
                <div class="grid grid-cols-2 gap-2">
                    <label v-for="category in categories" :key="category.id" class="flex items-center space-x-2">
                        <input
                            type="checkbox"
                            :value="category.id"
                            v-model="form.category_ids"
                        />
                        <span>{{ category.name }}</span>
                    </label>
                </div>
                <div v-if="form.errors.category_ids" class="text-red-500">{{ form.errors.category_ids }}</div>
            </div>

            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded">
                Պահպանել
            </button>
        </form>
    </div>
    </AppLayout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

defineProps({
    categories: Array
})

const form = useForm({
    name: '',
    description: '',
    location: '',
    architect: '',
    image: null,
    category_ids: [],
    images: [],
})

function handleMultipleImages(event) {
    form.images = Array.from(event.target.files)
}

function submit() {
    form.post(route('projects.store'), {
        forceFormData: true,
        onSuccess: () => {
            form.reset()
        }
    })
}
</script>

<style scoped>
.input {
    width: 100%;
    padding: 8px;
    border: 1px solid #d1d5db;
    border-radius: 4px;
}
</style>
