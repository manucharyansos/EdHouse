<script setup lang="ts">
defineProps(['messages'])
</script>

<template>
    <div class="p-6 w-full h-screen mx-auto bg-amber-50 text-black">
        <h1 class="text-2xl font-bold mb-4">Հաղորդագրություններ</h1>

        <table class="w-full text-sm text-left border">
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
</template>
