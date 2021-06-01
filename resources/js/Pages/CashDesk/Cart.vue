<template>
    <div  v-for="(product, index) in cart" :key="product.id" >
        <div class="d-flex justify-content-between">
            <h4 class="font-bold mb-6">{{product.name}}</h4>
            <h4 class="font-bold mb-6">{{product.quantity}}</h4>
            <h4>€{{(product.quantity * Math.round(product.price * 100) / 100).toFixed(2) }}</h4>
            <div>
                <button
                    @click="  product.quantity == 1 ?  deleteFromCart(product.id) : removeFromCart(product.id)"
                    class="btn btn-danger btn-sm" style="width: 25px;">
                    -
                </button>
                <button
                    @click="addToCart(product.id)"
                    class="btn btn-success btn-sm" style="width: 25px;">
                    +
                </button>
            </div>
        </div>
        <hr/>
    </div>
</template>

<script>
import {mapState, mapGetters} from 'vuex';
export default {

    name: "Cart",
    computed: {
        ...mapState([
            "cart"
        ]),
        ...mapGetters([
            "cartSize",
            "cartTotalAmount",
            "selectedTable",
        ]),
    },
}
</script>

<style scoped>

</style>
