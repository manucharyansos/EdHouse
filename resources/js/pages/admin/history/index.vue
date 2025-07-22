<template>
<!--    <AdminLayout>-->
        <div class="container mx-auto px-4 py-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold">History Management</h1>
                <Link
                    :href="route('admin.history.create')"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                >
                    Add New Entry
                </Link>
            </div>

            <div class="bg-neutral-600 shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-neutral-700">
                    <tr>
                        <th class="px-6 py-3 text-left">Year</th>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">Content</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in histories" :key="item.id">
                        <td class="px-6 py-4">{{ item.year }}</td>
                        <td class="px-6 py-4">{{ item.title }}</td>
                        <td class="px-6 py-4 max-w-xs truncate">{{ item.content }}</td>
                        <td class="px-6 py-4">
                            <Link
                                :href="route('admin.history.edit', item.id)"
                                class="text-blue-600 hover:text-blue-900 mr-4"
                            >
                                Edit
                            </Link>
                            <button
                                @click="confirmDelete(item.id)"
                                class="text-red-600 hover:text-red-900"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
<!--    </AdminLayout>-->
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
// import AdminLayout from '@/layouts/AdminLayout.vue';

defineProps({
    histories: Array,
});
</script>
