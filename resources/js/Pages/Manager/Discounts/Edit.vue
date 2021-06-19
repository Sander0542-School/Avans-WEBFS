<template>
    <app-layout>
        <template #header>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <inertia-link :href="route('manager.discounts.index')">Kortingen</inertia-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ discount.name }}</li>
                </ol>
            </nav>
        </template>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ discount.name }}</h5>
                        <form @submit.prevent="update">
                            <div class="form-group">
                                <jet-label for="name" value="Naam"/>
                                <jet-input id="name" type="text" :class="{ 'is-invalid': form.errors.name }" v-model="form.name" ref="name" autocomplete="discount_name"/>
                                <jet-input-error :message="form.errors.name" class="mt-2"/>
                            </div>
                            <div class="form-group">
                                <jet-label for="discount" value="Korting"/>
                                <div class="input-group">
                                    <jet-input id="discount" type="number" min="1" max="100" :class="{ 'is-invalid': form.errors.discount }" v-model="form.discount" ref="discount" autocomplete="discount"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <jet-input-error :message="form.errors.discount" class="mt-2"/>
                            </div>
                            <div class="form-group">
                                <jet-label for="valid_until" value="Geldig Tot"/>
                                <jet-input id="valid_until" type="datetime-local" :class="{ 'is-invalid': form.errors.valid_until }" v-model="form.valid_until" ref="valid_until" autocomplete="valid_until"/>
                                <jet-input-error :message="form.errors.valid_until" class="mt-2"/>
                            </div>
                            <jet-button :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
                                Opslaan
                            </jet-button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="nav-dishes-tab" data-toggle="tab" href="#nav-dishes" role="tab" aria-controls="nav-dishes" aria-selected="true">Gerechten</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="nav-add-tab" data-toggle="tab" href="#nav-add" role="tab" aria-controls="nav-add" aria-selected="true">Toevoegen</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="nav-dishes" role="tabpanel" aria-labelledby="nav-dishes-tab">
                            <table class="table table-card">
                                <thead>
                                <tr>
                                    <th>Nummer</th>
                                    <th>Gerecht</th>
                                    <th>Normale Prijs</th>
                                    <th>Nieuwe Prijs</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-if="discount.dishes.length <= 0">
                                    <td class="text-center" colspan="5">Deze korting bevat nog geen gerechten</td>
                                </tr>
                                <tr v-else v-for="dish in discount.dishes">
                                    <td>{{ dish.number }}{{ dish.addition }}</td>
                                    <td>{{ dish.name }}</td>
                                    <td>&euro; {{ dish.base_price.toFixed(2) }}</td>
                                    <td>&euro; {{ newPrice(dish.base_price).toFixed(2) }}</td>
                                    <td class="text-right">
                                        <button class="btn btn-danger" @click="removeDish(dish)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-add" role="tabpanel" aria-labelledby="nav-add-tav">
                            <table class="table table-card">
                                <thead>
                                <tr>
                                    <th>Nummer</th>
                                    <th>Gerecht</th>
                                    <th>Normale Prijs</th>
                                    <th>Nieuwe Prijs</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-if="discount.dishes.length <= 0">
                                    <td class="text-center" colspan="5">Deze korting bevat nog geen gerechten</td>
                                </tr>
                                <tr v-else v-for="dish in unusedDishes" :key="dish.id">
                                    <td>{{ dish.number }}{{ dish.addition }}</td>
                                    <td>{{ dish.name }}</td>
                                    <td>&euro; {{ dish.base_price.toFixed(2) }}</td>
                                    <td>&euro; {{ newPrice(dish.base_price).toFixed(2) }}</td>
                                    <td class="text-right">
                                        <button class="btn btn-primary" @click="addDish(dish)">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import JetButton from '@/Jetstream/Button'
import JetCheckbox from '@/Jetstream/Checkbox'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'

import moment from "moment";

export default {
    components: {
        AppLayout,
        JetButton,
        JetCheckbox,
        JetInput,
        JetInputError,
        JetLabel,
    },
    props: {
        discount: Object,
        dishes: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.discount.name,
                discount: this.discount.discount,
                valid_until: moment(this.discount.valid_until).format('YYYY-MM-DDTHH:mm'),
            }),
        }
    },
    computed: {
        unusedDishes: function () {
            return this.dishes.filter(dish => !this.containsDish(dish))
        }
    },
    methods: {
        update() {
            this.form.put(this.route('manager.discounts.update', this.discount.id))
        },
        removeDish(dish) {
            if (confirm(`Weet je zeker dat je "${dish.name}" wil verwijderen uit deze korting?`)) {
                this.form.post(this.route('manager.discounts.remove', {discount: this.discount.id, dishId: dish.id}), {
                    preserveScroll: true
                });
            }
        },
        addDish(dish) {
            if (confirm(`Weet je zeker dat je "${dish.name}" wil toevoegen uit deze korting?`)) {
                this.form.post(this.route('manager.discounts.add', {discount: this.discount.id, dishId: dish.id}), {
                    preserveScroll: true
                });
            }
        },
        newPrice(basePrice) {
            return (((100 - this.form.discount) / 100) * basePrice);
        },
        containsDish(dish) {
            return this.discount.dishes.filter(dish1 => dish1.id === dish.id).length > 0;
        }
    }
}
</script>
