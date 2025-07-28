<template>
    <Head title="Պռոեկտներ" />
    <AppLayout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Նախագծեր</h1>

        <Link :href="route('projects.create')" class="bg-blue-500 text-white px-4 py-2 rounded">
        Ավելացնել նոր նախագիծ
    </Link>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
        <div v-for="project in projects" :key="project.id" class="border rounded p-4 shadow">
        <img :src="project.image_url" alt="Նախագծի նկարը" class="w-full h-48 object-cover mb-4">
        <h2 class="text-xl font-semibold">{{ project.name }}</h2>
        <p class="text-gray-600">{{ project.location }}</p>
        <p class="text-gray-500 text-sm">Ճարտարապետ․ {{ project.architect }}</p>

        <div class="mt-4 flex justify-between">
            <Link :href="route('projects.edit', project.id)" class="text-blue-500">Փոփոխել</Link>
        <button @click="deleteProject(project.id)" class="text-red-500">Ջնջել</button>
</div>
</div>
</div>
</div>
    </AppLayout>
</template>

<script setup>
import { Head, router } from '@inertiajs/vue3';
    import { Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue';

    defineProps({
    projects: Array,
    categories: Array
})

    function deleteProject(id) {
    if (confirm('Վստա՞հ եք, որ ուզում եք ջնջել այս նախագիծը։')) {
    router.delete(route('projects.destroy', id))
}
}
</script>
