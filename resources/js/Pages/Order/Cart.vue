<template>
    <div class="card order-card my-3">
        <div class="card-body">
            <h4>Winkelwagen</h4>
            <div v-if="cartSize > 0">
                <table class="table table-sm table-borderless table-yellow">
                    <thead>
                    <tr>
                        <th>Gerecht</th>
                        <th>Aantal</th>
                        <th>Stukprijs</th>
                        <th/>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="product in cart" :key="product.id">
                        <td>{{ product.number }}{{ product.addition }}. {{ product.name }}</td>
                        <td>{{ product.quantity }}x</td>
                        <td>&euro; {{ product.price_inc.toFixed(2) }}</td>
                        <td>
                            <button @click="removeFromCart(product.id)"><i class="fas fa-minus-circle"></i></button>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="2">Totaal</th>
                        <th>&euro; {{ cartTotalAmountInc.toFixed(2) }}</th>
                    </tr>
                    </tfoot>
                </table>

                <button @click="orderCart" class="btn gd-navigation float-right">Bestellen</button>
                <button @click="removeAllFromCart" class="btn gd-navigation">Leeg maken</button>
            </div>
            <span v-else>De winkelwagen is nog leeg. Voeg gerechten toe om iets te bestellen.</span>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapState} from 'vuex';

export default {
    computed: {
        ...mapState([
            "cart"
        ]),
        ...mapGetters([
            "cartSize",
            "cartTotalAmount",
            "cartTotalAmountInc",
        ]),
    },
    data() {
        return {
            form: this.$inertia.form({
                dishes: this.cart,
                // table:
            }),
        }
    },
    methods: {
        addToCart(dishId) {
            this.$store.dispatch("addToCart", dishId);
        },
        removeFromCart(dishId) {
            this.$store.dispatch("removeFromCart", dishId);
        },
        removeAllFromCart() {
            this.$store.dispatch("removeAllFromCart");
        },
        orderCart() {
            alert('yolo');
        },
    }
}
</script>
