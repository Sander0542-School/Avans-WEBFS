<template>
    <div class="">
        <div class="card p-3 ">

            <div v-if="$page.props.flash.message" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $page.props.flash.message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div v-if="$page.props.errors.createOrder ">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul class="p-0 m-0 list-unstyled">
                        <div v-for="error in $page.props.errors.createOrder">
                            <li> {{ error }}</li>
                        </div>
                    </ul>
                </div>
            </div>

            <div v-for="(product, index) in cart" :key="product.id">

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
                    <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" :data-target="'#collapseCartItem' + product.id" aria-expanded="false" :aria-controls="'collapseCartItem' + product.id">
                        <i class="fa fa-arrow-down" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="collapse" v-bind:id="'collapseCartItem' + product.id">
                    <div class="card card-body">
                        <textarea class="form-control" maxlength="150" v-model="product.remark" placeholder="Beschrijving toevoegen"></textarea>
                        <select class="form-control mt-2" v-model="product.dish_rice_option">
                            <option value="">Geen bijgerecht</option>
                            <option v-for="option in $page.props.dish_rice_options" v-bind:value="option.id">
                                {{ option.name }}
                            </option>
                        </select>
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
                        <button :disabled="isDisabled" @click.prevent="submit()" type="button" class="btn btn-primary btn-block">
                            <i class="fa fa-shopping-bag"></i> Afrekenen
                        </button>
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
    props: {
        errors: {},
        dish_rice_option: Array,
    },

    computed: {
        ...mapState([
            "cart"
        ]),
        ...mapGetters([
            "cartSize",
            "cartTotalAmount",
            "cartTotalAmountInc",
        ]),
        isDisabled: function () {
            console.log(this.cart);
            return this.cart.length === 0;
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
        submit() {
            let data = {'cart': this.cart};
            this.$inertia.post('/cashdesk/store', data, {
                errorBag: 'createOrder',
                onSuccess: () => this.removeAllFromCart()
            })
        },
    }
}
</script>
