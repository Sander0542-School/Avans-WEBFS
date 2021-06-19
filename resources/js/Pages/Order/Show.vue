<template>
    <order-layout>
        <h3>{{ category.name }}</h3>
        <h6 v-if="category.extra_option"> (met witte rijst)</h6>

        <div class="row">
            <div class="col-6 col-md-4 col-lg-3 col-xl-2 my-3">
                <div class="card card-square order-card c-pointer" @click="backToIndex">
                    <div class="card-body row justify-content-center">
                        <h5 class="card-title"><i class="fas fa-3x fa-chevron-circle-left"></i></h5>
                    </div>
                </div>
            </div>
            <div v-for="dish in category.dishes" :key="dish.id" class="col-6 col-md-4 col-lg-3 col-xl-2 my-3">
                <div class="card card-square order-card c-pointer" @click="addToCart(dish.id)">
                    <div class="card-body row justify-content-center">
                        <h5 class="card-title">{{ dish.name }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </order-layout>
</template>

<script>
import OrderLayout from '@/Layouts/OrderLayout';

export default {
    components: {
        OrderLayout
    },
    props: {
        category: Object
    },
    methods: {
        addToCart(dishId) {
            this.$store.dispatch("addToCart", dishId);
        },
        backToIndex() {
            this.$inertia.visit(this.route('order.index'))
        }
    }
}
</script>
