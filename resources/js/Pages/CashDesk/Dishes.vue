<template>
    <div class="row">
        <div class="col-sm-8">
            <div class="">
                <div v-for="category in menu" class="menu">
                    <div v-if="category.dishes.length > 0">
                        <h5>{{category.name }}</h5>
                        <div v-for="dish in category.dishes">
                            <div class="menu-item">
                                <span>{{ dish.number }}</span>
                                <span v-if="dish.addition">{{ dish.addition }}</span>
                                <span>. {{ dish.name }}</span>
                                <span class="dotted"></span>
                                <span>&euro; {{ dish.price }}</span>
                                <button class="button is-success"
                                        @click="addToCart(category.id, dish.number)">Toevoegen</button>
                            </div>
                            <span v-if="dish.description" class="font-italic small">({{ dish.description }})</span>
                        </div>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <cart></cart>
        </div>
    </div>



</template>

<script>
import Cart from './/Cart';

export default {
    name: "Dishes",
    components: {
        Cart
    },
    props: {
        menu: Array
    },
    created() {
        this.$store.dispatch("fetchMenu", this.menu);
    },
    methods: {
        addToCart(categoryId, dishNumber){
            this.$store.dispatch("addToCart", {categoryId, dishNumber});
        }
    }
}
</script>

<style scoped>

</style>
