<template>
    <div class="sticky-top">
        <div class="card p-3 ">
            <div v-for="(product, index) in cart" :key="product.id">
                <div class="d-flex justify-content-between">
                    <h4 class="font-bold mb-6">{{ product.number }}</h4>
                    <h4 class="font-bold mb-6">{{ product.name }}</h4>
                    <h4>€{{ (product.quantity * Math.round(product.price * 100) / 100).toFixed(2) }}</h4>
                    <h4 class="font-bold mb-6">{{ product.quantity }}</h4>

                    <div>
                        <button
                            @click="  product.quantity == 1 ?  deleteFromCart(product.id) : removeFromCart(product.category_id, product.number)"
                            class="btn btn-danger btn-sm" style="width: 25px;">
                            -
                        </button>
                        <button
                            @click="addToCart(product.category_id, product.number)"
                            class="btn btn-success btn-sm ml-1" style="width: 25px;">
                            +
                        </button>
                    </div>
                </div>
                <textarea class="form-control" v-model="product.notes" placeholder="Beschrijving toevoegen"></textarea>
                <hr/>
            </div>
            <div class="box">
                <dl class="dlist-align">
                    <dt>Totaal:</dt>
                    <dd class="text-right h4 b"> €{{ cartTotalAmount.toFixed(2) }}</dd>
                </dl>
                <div class="row">
                    <div class="col-md-6">
                        <a @click="removeAllFromCart()" href="#" class="btn  btn btn-light btn-lg btn-block"><i
                            class="fa fa-times-circle "></i> Verwijderen </a>
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="btn  btn-primary btn-lg btn-block"><i class="fa fa-shopping-bag"></i>
                            Afrekenen </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapState} from 'vuex';

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
    methods: {
        addToCart(categoryId, dishNumber) {
            this.$store.dispatch("addToCart", {categoryId, dishNumber});
        },
        removeFromCart(categoryId, dishNumber) {
            this.$store.dispatch("removeFromCart", {categoryId, dishNumber});
        },
        deleteFromCart(categoryId, dishNumber) {
            this.$store.dispatch("deleteFromCart", {categoryId, dishNumber});
        },
        removeAllFromCart() {
            this.$store.dispatch("removeAllFromCart");
        }
    }
}
</script>
