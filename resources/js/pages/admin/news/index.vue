<template>
    <Head title="Պատմություն" />
    <AppLayout>
        <div class="min-h-screen bg-black text-white">

            <!-- News List -->
            <div class="container mx-auto px-4 py-10">
                <!-- Header -->
                <div class="bg-transparent py-6 text-3xl font-bold text-left">Նորություններ</div>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Բոլոր նորությունները</h2>
                    <Link :href="route('admin.news.create')" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white">
                        Ավելացնել նորություն
                    </Link>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead>
                        <tr class="bg-gray-800 text-left text-sm">
                            <th class="px-4 py-3">Վերնագիր</th>
                            <th class="px-4 py-3">Բովանդակություն</th>
                            <th class="px-4 py-3">Ամսաթիվ</th>
                            <th class="px-4 py-3">Նկար</th>
                            <th class="px-4 py-3">Գործողություններ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in news" :key="item.id" class="border-b border-gray-700">
                            <td class="px-4 py-3">{{ item.title }}</td>
                            <td class="px-4 py-3 truncate max-w-xs">{{ item.content }}</td>
                            <td class="px-4 py-3">{{ new Date(item.published_at).toLocaleDateString() }}</td>
                            <td class="px-4 py-3">
                                <img v-if="item.image" :src="`/storage/${item.image}`" class="h-12 w-12 object-cover rounded"  alt=""/>
                            </td>
                            <td class="px-4 py-3 space-x-2">
                                <Link :href="route('admin.news.edit', item.id)" class="text-blue-400 hover:underline">Խմբագրել</Link>
                                <button @click="destroy(item.id)" class="text-red-500 hover:underline">Ջնջել</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
    news: Array
});

const destroy = (id) => {
    if (confirm('Վստահ եք որ ցանկանում եք ջնջել')) {
        router.delete(route('admin.news.destroy', id));
    }
};
</script>

<style scoped>
.container {
    max-width: 1000px;
}
</style>
