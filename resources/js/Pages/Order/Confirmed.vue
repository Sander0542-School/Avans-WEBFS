<template>
    <home-layout>
        <div v-if="order != null" class="text-center">
            <h3>Bestelling #{{ order.id }}</h3>
            <h5>Naam: {{ order.customer }}</h5>
            <h5>Prijs: &euro; {{ order.price_inc.toFixed(2) }}</h5>
            <img :src="order.qr_code_url" alt="Bestelling #{{ order.id }}"/>

            <br/>
            <button class="btn gd-navigation d-print-none my-4" onclick="window.print()">Print bestelling</button>
        </div>
        <div v-else class="text-center">
            <h3>404</h3>
            <h4>Bestelling niet gevonden</h4>
        </div>
    </home-layout>
</template>

<script>
import HomeLayout from '@/Layouts/HomeLayout';

export default {
    components: {
        HomeLayout
    },
    props: {
        order: Object
    }
}
</script>
