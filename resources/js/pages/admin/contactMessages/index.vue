<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps(['messages'])
</script>

<template>
    <Head title="Հաղորդագրություններ" />
    <AppLayout>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 text-gray-700">
            <h1 class="text-2xl font-bold mb-4 text-gray-200">Հաղորդագրություններ</h1>

            <table class="w-full text-sm text-left border overflow-x-auto">
                <thead class="bg-gray-100 text-xs uppercase">
                <tr>
                    <th class="px-4 py-2 border">Անուն</th>
                    <th class="px-4 py-2 border">Հեռախոս</th>
                    <th class="px-4 py-2 border">Էլ․փոստ</th>
                    <th class="px-4 py-2 border">Հաղորդագրություն</th>
                    <th class="px-4 py-2 border">Ժամանակ</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="msg in messages" :key="msg.id" class="border-b hover:bg-yellow-50 transition">
                    <td class="px-4 py-2">{{ msg.name }}</td>
                    <td class="px-4 py-2">{{ msg.phone ?? '—' }}</td>
                    <td class="px-4 py-2">{{ msg.email }}</td>
                    <td class="px-4 py-2">{{ msg.message }}</td>
                    <td class="px-4 py-2">{{ new Date(msg.created_at).toLocaleString() }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
