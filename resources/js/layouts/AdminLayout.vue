<template>
    <div class="min-h-screen bg-gray-100">
        <AdminNavbar />

        <div class="flex">
            <AdminSidebar />

            <main class="flex-1 p-4">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import AdminNavbar from '@/Components/Admin/Navbar.vue';
import AdminSidebar from '@/Components/Admin/Sidebar.vue';
</script>
