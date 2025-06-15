<template>
    <div id="map" class="w-full"></div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

delete (L.Icon.Default.prototype as any)._getIconUrl;
L.Icon.Default.mergeOptions({
    iconRetinaUrl: '/storage/images/marker-icon-2x.png',
    iconUrl: '/storage/images/marker-icon.png',
    shadowUrl: '/storage/images/marker-shadow.png',
});

onMounted(() => {
    try {
        const map = L.map('map').setView([40.17161, 44.429071], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap',
        }).addTo(map);

        L.marker([40.17161, 44.429071])
            .addTo(map)
            .bindPopup('Րաֆֆու 111')
            .openPopup();
    } catch (error) {
        console.error('Failed to initialize Leaflet map:', error);
    }
});
</script>

<style scoped>
#map {
    height: 400px;
    z-index: 0;
}
@media screen and (max-width: 1280px) {
    #map {
        width: 400px;
    }
}
@media screen and (max-width: 1024px) {
    #map {
        width: 300px;
    }
}
@media screen and (max-width: 768px) {
    #map {
        margin: auto;
        width: 400px;
    }
}
@media screen and (max-width: 450px) {
    #map {
        margin: auto;
        width: 300px;
    }
}
</style>
