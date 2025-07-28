<template>
    <Head title="Պատմություն" />
    <AppLayout>
        <div class="container mx-auto px-4 py-8 text-gray-700">
            <div class="flex justify-between items-center mb-8 text-gray-200">
                <h1 class="text-3xl font-bold">Պատմության կառավարում</h1>
                <Link
                    :href="route('admin.history.create')"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                >
                    Ավելացնել Նոր
                </Link>
            </div>

            <div class="overflow-auto bg-white shadow rounded-lg">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-100 text-xs uppercase">
                    <tr>
                        <th class="px-6 py-3">Տարի</th>
                        <th class="px-6 py-3">Վերնագիր</th>
                        <th class="px-6 py-3">Բովանդակություն</th>
                        <th class="px-6 py-3">Գործողություններ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in histories" :key="item.id" class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4">{{ item.year }}</td>
                        <td class="px-6 py-4 font-semibold">{{ item.title }}</td>
                        <td class="px-6 py-4 max-w-xs truncate">{{ item.content }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <Link :href="route('admin.history.edit', item.id)" class="text-blue-600 hover:underline">
                                Խմբագրել
                            </Link>
                            <button @click="confirmDelete(item.id)" class="text-red-600 hover:underline">
                                Ջնջել
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
    histories: Array
});

const confirmDelete = (id) => {
    if (confirm('Վստա՞հ եք, որ ցանկանում եք ջնջել այս տարրը։')) {
        router.delete(route('admin.history.destroy', id));
    }
};
</script>

<style scoped>
table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 8px 12px;
}
</style>
