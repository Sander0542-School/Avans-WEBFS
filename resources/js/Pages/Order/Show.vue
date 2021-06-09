<template>
    <order-layout>
        <div class="row">
            <div v-for="dish in category.dishes" :key="dish.id" class="col-6 col-md-4 col-lg-3 col-xl-2 my-3">
                <div class="card order-card c-pointer" @click="selectDish(dish)">
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
        addToCart(dish) {
            alert(dish.name);
        }
    }
}
</script>
