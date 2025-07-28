<template>
    <Head title="Նորություն ավելացնել" />
    <AppLayout>
        <div class="min-h-screen bg-black text-white py-10 px-4 sm:px-8">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-3xl font-bold mb-6">Ավելացնել նորություն</h1>

                <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-6">
                    <div>
                        <label class="block mb-1">Վերնագիր</label>
                        <input v-model="form.title" type="text" class="w-full bg-neutral-900 border border-gray-600 rounded px-4 py-2" required />
                    </div>

                    <div>
                        <label class="block mb-1">Բովանդակություն</label>
                        <textarea v-model="form.content" rows="5" class="w-full bg-neutral-900 border border-gray-600 rounded px-4 py-2" required></textarea>
                    </div>

                    <div>
                        <label class="block mb-1">Հրապարակման օր</label>
                        <input v-model="form.published_at" type="date" class="w-full bg-neutral-900 border border-gray-600 rounded px-4 py-2" required />
                    </div>

                    <div>
                        <label class="block mb-1">Նկար</label>
                        <input type="file" accept="image/*" @change="onFileChange" class="w-full bg-neutral-900 border border-gray-600 rounded px-4 py-2" />
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                        Ավելացնել
                    </button>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'

const form = useForm({
    title: '',
    content: '',
    published_at: '',
    image: null
})

const onFileChange = (e) => {
    form.image = e.target.files[0]
}

const submit = () => {
    form.post(route('admin.news.store'), {
        forceFormData: true,
        onSuccess: () => form.reset(),
    })
}
</script>
