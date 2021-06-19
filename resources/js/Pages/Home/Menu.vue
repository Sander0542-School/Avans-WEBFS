<template>
    <home-layout>
        <div class="card-columns">
            <div v-for="category in menu" :key="category.id" class="menu">
                <div v-if="category.dishes.length > 0">
                    <h5>
                        <span class="text-uppercase">{{ category.name }}</span>
                        <span v-if="category.extra_option"> (met witte rijst)</span>
                    </h5>
                    <div v-for="dish in category.dishes" :key="dish.id">
                        <div class="menu-item">
                            <span>{{ dish.number }}</span>
                            <span v-if="dish.addition">{{ dish.addition }}</span>
                            <span>. {{ dish.name }}</span>
                            <span v-if="dish.spiciness !== 0">
                                <i v-for="i in dish.spiciness" class="fas fa-pepper-hot fa-sm"></i>
                            </span>
                            <span v-if="dish.allergies.length !== 0">
                                <i v-for="allergy in dish.allergies" :key="allergy.name" class="fas fa-sm" :class="allergy.icon"></i>
                            </span>
                            <span class="dotted"></span>
                            <span>&euro; {{ dish.price.toFixed(2) }}</span>
                        </div>
                        <span v-if="dish.description" class="font-italic small">({{ dish.description }})</span>
                    </div>
                    <br/>
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
    }
}
</script>
