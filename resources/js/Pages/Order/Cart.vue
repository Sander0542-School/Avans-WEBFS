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
                            <i class="fas fa-minus-circle c-pointer" @click="removeFromCart(product.id)"></i>
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

                <div class="form-group">
                    <jet-label for="customer" value="Naam"/>
                    <jet-input id="customer" type="text" :class="{ 'is-invalid': form.errors.customer }" v-model="form.customer" ref="customer" autocomplete="name"/>
                    <jet-input-error :message="form.errors.customer" class="mt-2 text-yellow"/>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <jet-checkbox id="table_order" name="table_order" v-model:checked="form.table_order" />

                        <label class="custom-control-label" for="table_order">
                            Bestelling voor tafel
                        </label>
                    </div>
                    <jet-input-error :message="form.errors.table_order" class="mt-2"/>
                </div>
                <div v-if="form.table_order" class="form-group">
                    <jet-label for="table_number" value="Tafel nummer"/>
                    <jet-input id="table_number" type="number" :class="{ 'is-invalid': form.errors.table_number }" v-model="form.table_number" ref="table_number" autocomplete="table_number"/>
                    <jet-input-error :message="form.errors.table_number" class="mt-2 text-yellow"/>
                </div>

                <button @click="orderCart" class="btn gd-navigation float-right">Bestellen</button>
                <button @click="removeAllFromCart" class="btn gd-navigation">Leeg maken</button>
            </div>
            <span v-else>De winkelwagen is nog leeg. Voeg gerechten toe om iets te bestellen.</span>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapState} from 'vuex';
import JetButton from '@/Jetstream/Button';
import JetCheckbox from '@/Jetstream/Checkbox';
import JetInput from '@/Jetstream/Input';
import JetInputError from '@/Jetstream/InputError';
import JetLabel from '@/Jetstream/Label';

export default {
    components: {
        JetButton,
        JetCheckbox,
        JetInput,
        JetInputError,
        JetLabel,
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
    },
    data() {
        return {
            form: this.$inertia.form({
                customer: null,
                table_order: true,
                table_number: null,
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
            this.form.transform((data) => ({
                ...data,
                cart: this.cart.map((dish) => ({
                    id: dish.id,
                    amount: dish.quantity,
                    remark: dish.remark,
                }))
            })).post(this.route('order.store'), {
                preserveScroll: true
            });
        },
    }
}
</script>
