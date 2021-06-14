<template>
    <home-layout>
        <div class="row">
            <div class="col">
                <slot/>
            </div>
            <div class="col col-lg-4">
                <order-cart/>
            </div>
        </div>
    </home-layout>
</template>

<script>
import HomeLayout from '@/Layouts/HomeLayout';
import OrderCart from '@/Pages/Order/Cart';

export default {
    components: {
        HomeLayout,
        OrderCart
    },
    props: {
        menu: Array,
        dishes: Array,
    },
    created() {
        this.$store.dispatch("fetchDishes", this.dishes);
    },
}
</script>
