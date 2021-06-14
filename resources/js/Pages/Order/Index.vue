<template>
    <inertia-head :title="$t('pages.order')"/>

    <order-layout>
        <div class="row">
            <div v-for="category in menu" :key="category.id" class="col-6 col-md-4 col-lg-3 col-xl-2 my-3">
                <div class="card card-square order-card c-pointer" @click="selectCategory(category.id)">
                    <div class="card-body row justify-content-center">
                        <h5 class="card-title">{{ category.name }}</h5>
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
        menu: Array
    },
    methods: {
        selectCategory(categoryId) {
            this.$inertia.visit(this.route('order.show', categoryId))
        }
    }
}
</script>
