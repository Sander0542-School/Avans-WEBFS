<template>
    <div class="">
        <div class="card p-3 ">
            <div v-for="product in cart" :key="product.id">
                <div class="d-flex justify-content-between">
                    <h5 class="mb-6">{{ product.number }}</h5>
                    <h5 class="mb-6">{{ product.name }}</h5>
                    <h5>&euro;{{ (product.quantity * product.price_inc).toFixed(2) }}</h5>
                    <h5 class="mb-6">{{ product.quantity }}</h5>

                    <div>
                        <button @click="removeFromCart(product.id)" class="btn btn-danger btn-sm" style="width: 25px;">
                            -
                        </button>
                        <button @click="addToCart(product.id)" class="btn btn-success btn-sm ml-1" style="width: 25px;">
                            +
                        </button>
                    </div>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" :data-target="'#collapseCartItem' + product.id" aria-expanded="false" :aria-controls="'collapseCartItem' + product.id">
                        <i class="fa fa-arrow-down" aria-hidden="true"></i> {{product.id}}
                    </button>

                </div>
                <div class="collapse" v-bind:id="'collapseCartItem' + product.id" >
                    <div class="card card-body">
                        <textarea class="form-control" v-model="product.remark" placeholder="Beschrijving toevoegen"></textarea>
                    </div>
                </div>



                <hr/>
            </div>
            <div class="box">
                <dl class="dlist-align">
                    <dt>Totaal:</dt>
                    <dd class="text-right h4 b">&euro; {{ cartTotalAmountInc.toFixed(2) }}</dd>
                </dl>
                <div class="row">
                    <div class="col-md-6">
                        <a @click="removeAllFromCart()" href="#" class="btn btn-light btn-block"><i class="fa fa-times-circle "></i> Verwijderen</a>
                    </div>
                    <div class="col-md-6">
                        <a @click="submit()" href="#" class="btn btn-primary btn-block"><i class="fa fa-shopping-bag"></i> Afrekenen</a>
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
            "cartTotalAmountInc",
        ]),
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
        submit() {
            let data = {'cart': this.cart};
            this.$inertia.post('/cashdesk/store', data)
        },
    }
}
</script>
