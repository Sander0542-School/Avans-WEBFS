<template>
    <inertia-head :title="$t('pages.order')"/>

    <home-layout>
        <div class="row">
            <div v-for="category in menu" :key="category.id" class="col-6 col-md-4 col-lg-3 col-xl-2 my-3">
                <div class="card order-card c-pointer" @click="selectCategory(category.id)">
                    <div class="card-body row justify-content-center">
                        <h5 class="card-title">{{ category.name }}</h5>
                    </div>
                </div>
            </div>
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
        menu: Array
    },
    methods: {
        selectCategory(categoryId) {
            this.$inertia.visit(this.route('order.show', categoryId))
        }
    }
}
</script>
