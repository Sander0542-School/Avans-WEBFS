<template>
    <home-layout>
        <form class="form-inline">
            <div v-if="$page.props.flash.message" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $page.props.flash.message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <input type="number" class="form-control" v-model="tableNumber" placeholder="Tafel nummer">
            </div>
            <button :disabled="tableNumber === ''" @click="askHelp()" type="button" class="btn gd-navigation">Vraag om hulp</button>
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
        }
    }
}
</script>
