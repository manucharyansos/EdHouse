<template>
    <AppLayout>
    <div class="max-w-3xl mx-auto p-6">
        <Head title="Ստեղծել Նորություն" />
        <h1 class="text-2xl font-bold mb-4">Ստեղծել Նորություն</h1>

        <form @submit.prevent="submit" class="space-y-6">
            <!-- Վերնագիր -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Վերնագիր</label>
                <input
                    type="text"
                    id="title"
                    v-model="form.title"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                />
                <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</div>
            </div>

            <!-- Նկարագրություն -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Բովանդակություն</label>
                <textarea
                    id="content"
                    v-model="form.content"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                    rows="5"
                ></textarea>
                <div v-if="form.errors.content" class="text-red-500 text-sm mt-1">{{ form.errors.content }}</div>
            </div>

            <!-- Հրապարակման ամսաթիվ -->
            <div>
                <label for="published_at" class="block text-sm font-medium text-gray-700">Հրապարակման ամսաթիվ</label>
                <input
                    type="date"
                    id="published_at"
                    v-model="form.published_at"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                />
                <div v-if="form.errors.published_at" class="text-red-500 text-sm mt-1">{{ form.errors.published_at }}</div>
            </div>

            <!-- Նկար -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Նկար</label>
                <input
                    type="file"
                    id="image"
                    @change="(e) => form.image = e.target.files[0]"
                    accept="image/jpeg,image/png,image/jpg,image/gif"
                    class="mt-1 block w-full"
                />
                <div v-if="form.errors.image" class="text-red-500 text-sm mt-1">{{ form.errors.image }}</div>

                <img v-if="form.image" :src="form.image_url" class="mt-2 h-32 rounded shadow"  :alt="form.title"/>
            </div>

            <!-- Կոճակներ -->
            <div class="flex justify-end gap-2">
                <Link
                    :href="route('admin.news.index')"
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded text-sm text-gray-800"
                >
                    Չեղարկել
                </Link>
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded text-sm"
                >
                    Պահպանել
                </button>
            </div>
        </form>
    </div>
    </AppLayout>
</template>

<script setup>
import { useForm, Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue';

const form = useForm({
    title: '',
    content: '',
    published_at: '',
    image: null,
})

const submit = () => {
    form.post(route('admin.news.store'))
}
</script>
