<template>
    <home-layout>
        <input v-model="tableNumber" placeholder="Table Number">
        <button @click="askHelp()" type="button" class="btn btn-primary">Ask for help</button>
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
    data() {
        return {
            tableNumber: ''
        }
    },
    props: {
        menu: Array,
        dishes: Array,
    },
    created() {
        this.$store.dispatch("fetchDishes", this.dishes);
    },
    methods: {
        askHelp(){
            let data = {'table_number': this.tableNumber};
            this.$inertia.post('/help', data)
        }
    }
}
</script>
