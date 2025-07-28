<template>
    <Head title="Ծառայություններ" />
    <AppLayout>
    <div class="services-container flex items-center justify-center flex-col">
        <div class="services-grid flex items-center justify-center flex-row flex-wrap gap-4">
            <div
                v-for="service in services"
                :key="service.id"
                class="service-card w-80"
            >
                <div class="service-header">
                    <h2>{{ service.name.toUpperCase() }}</h2>
                    <div class="divider"></div>
                </div>

                <div class="service-content">
                    <img v-if="service.image_data"
                         :src="'data:image/jpeg;base64,' + service.image_data"
                         class="icon-wrapper object-cover"
                         alt="Service Image">
                    <p class="overflow-y-auto h-32">{{ service.description }}</p>
                </div>

                <div class="service-actions">
                    <Link :href="route('admin.services.edit', service.id)" class="edit-btn">Խմբագրել</Link>
                    <button @click="openDeleteModal(service.id)" class="delete-btn">Ջնջել</button>
                </div>
            </div>
        </div>

        <Link :href="route('admin.services.create')" class="add-btn rounded-md">Ավելացնել ծառայություն</Link>

        <!-- Delete Confirmation Modal -->
        <div v-if="showDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-neutral-600 p-6 rounded-lg shadow-lg max-w-md w-full">
                <h3 class="text-xl font-bold mb-4">Հաստատել ջնջումը</h3>
                <p class="mb-6">Դուք վստահ ե՞ք, որ ցանկանում եք ջնջել այս ծառայությունը։ Այս գործողությունը հնարավոր չէ հետ վերադարձնել։</p>
                <div class="flex justify-end gap-4">
                    <button @click="closeDeleteModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Չեղարկել
                    </button>
                    <button @click="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Հաստատել ջնջումը
                    </button>
                </div>
            </div>
        </div>
    </div>
    </AppLayout>>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
    services: {
        type: Array,
        required: true,
        default: () => []
    }
});

const showDeleteModal = ref(false);
const serviceToDelete = ref(null);

const openDeleteModal = (id) => {
    serviceToDelete.value = id;
    showDeleteModal.value = true;
};

const closeDeleteModal = () => {
    showDeleteModal.value = false;
    serviceToDelete.value = null;
};

const confirmDelete = () => {
    if (serviceToDelete.value) {
        router.delete(route('admin.services.destroy', serviceToDelete.value), {
            onSuccess: () => {
                closeDeleteModal();
            },
            onError: (errors) => {
                console.error('Error deleting service:', errors);
                closeDeleteModal();
            }
        });
    }
};
</script>

<style scoped>
body {
    background: white;
}
.bg-image {
    background-image: url('/img/bg-image-07-1920x696.jpg');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
.services-container {
    margin: 0 auto;
    padding: 2rem;
    font-family: Arial, sans-serif;
    min-height: 70vh;
    position: relative;
}


.service-card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    background: white;
}

.service-header {
    margin-bottom: 1.5rem;
}

.service-header h2 {
    font-size: 1.5rem;
    color: #444;
    margin: 0 0 0.5rem 0;
    text-align: center;
}

.divider {
    height: 2px;
    background-color: #e0e0e0;
    width: 100%;
}

.service-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.icon-wrapper {
    flex-shrink: 0;
    width: 48px;
    height: 48px;
}

.icon-wrapper svg {
    width: 100%;
    height: 100%;
}

.service-content p {
    color: #666;
    line-height: 1.5;
    margin: 0;
    text-align: center;
}

.service-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

button, .edit-btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-block;
    text-align: center;
}

.edit-btn {
    background-color: #2196F3;
    color: white;
}

.edit-btn:hover {
    background-color: #0b7dda;
}

.delete-btn {
    background-color: #f44336;
    color: white;
}

.delete-btn:hover {
    background-color: #da190b;
}

.add-btn {
    display: block;
    width: 100%;
    max-width: 200px;
    margin: 2rem auto 0;
    background-color: #4CAF50;
    color: white;
    padding: 0.8rem;
    font-size: 1rem;
    text-align: center;
    text-decoration: none;
}

.add-btn:hover {
    background-color: #45a049;
}
</style>
