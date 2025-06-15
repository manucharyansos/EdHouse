<template>
    <div class="container">
        <h1>Մուտքն արգելված է</h1>
        <p>{{ message }}</p>
        <button @click="goHome">Հաշվի էջ</button>
    </div>
</template>

<script>
export default {
    props: {
        message: {
            type: String,
            required: true,
        },
    },
    methods: {
        goHome() {
            this.$inertia.visit('/home');
        },
    },
};
</script>

<style scoped>
.container {
    text-align: center;
    padding: 50px;
}
</style>
