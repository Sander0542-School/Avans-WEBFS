<template>
    <home-layout>
        <form class="form-inline">
            <div class="form-group mx-sm-3 mb-2">
                <input type="number" class="form-control" v-model="tableNumber" :placeholder="$t('input.tableNumber') ">
            </div>
            <button :disabled="tableNumber === ''" @click="askHelp()" type="button" class="btn gd-navigation">{{ $t('input.assistance') }}</button>
        </form>

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
            alert(this.$t('input.question'));
        }
    }
}
</script>
