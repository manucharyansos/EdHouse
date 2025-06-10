<template>
    <div>
        <h1>Խմբագրել ծառայություն</h1>
        <form @submit.prevent="submitForm">
            <input v-model="form.scg" placeholder="SCG" required />
            <input v-model="form.name" placeholder="Անուն" required />
            <textarea v-model="form.description" placeholder="Նկարագրություն" required></textarea>
            <button type="submit">Հաստատել</button>
            <button @click="cancel">Չեղարկել</button>
        </form>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';

export default {
    props: {
        service: Object,
    },
    data() {
        return {
            form: useForm({
                scg: this.service.scg,
                name: this.service.name,
                description: this.service.description,
            }),
        };
    },
    methods: {
        submitForm() {
            this.form.put(`/admin/services/${this.service.id}`, {
                onSuccess: () => this.$inertia.visit('/admin/services'),
            });
        },
        cancel() {
            this.$inertia.visit('/admin/services');
        },
    },
};
</script>
