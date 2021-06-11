<template>
    <app-layout>
        <template #header>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <inertia-link :href="route('manager.menus.index')">Menu</inertia-link>
                    </li>
                    <li class="breadcrumb-item">
                        <inertia-link :href="route('manager.menus.show', category.id)">{{ category.name }}</inertia-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ dish.number }}{{ dish.addition }}. {{ dish.name }}</li>
                </ol>
            </nav>
        </template>

        <div v-if="dish.deleted" class="alert alert-warning" role="alert">
            Dit gerecht is verwijderd en staat niet op het menu.
        </div>

        <form @submit.prevent="update">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card my-2">
                        <div class="card-body">
                            <h5 class="card-title">Gerecht</h5>

                            <div class="form-group">
                                <jet-label for="name" value="Naam"/>
                                <jet-input id="name" type="text" :class="{ 'is-invalid': form.errors.name }" v-model="form.name" ref="name" autocomplete="dish_name"/>
                                <jet-input-error :message="form.errors.name" class="mt-2"/>
                            </div>
                            <div class="form-group">
                                <jet-label for="number" value="Nummer + Toevoeging"/>
                                <div class="input-group" :class="{ 'is-invalid': form.errors.number || form.errors.addition }">
                                    <jet-input id="number" type="text" :class="{ 'is-invalid': form.errors.number || form.errors.addition }" v-model="form.number" ref="number" autocomplete="off"/>
                                    <jet-input id="addition" type="text" :class="{ 'is-invalid': form.errors.number || form.errors.addition }" v-model="form.addition" ref="addition" autocomplete="off"/>
                                </div>
                                <jet-input-error :message="form.errors.number" class="mt-2"/>
                                <jet-input-error :message="form.errors.addition" class="mt-2"/>
                            </div>
                            <div class="form-group">
                                <jet-label for="description" value="Beschrijving"/>
                                <jet-textarea id="description" :class="{ 'is-invalid': form.errors.description }" v-model="form.description" ref="description"/>
                                <jet-input-error :message="form.errors.description" class="mt-2"/>
                            </div>
                        </div>
                    </div>

                    <div class="card my-2">
                        <div class="card-body">
                            <h5 class="card-title">Prijzen</h5>

                            <div class="form-group">
                                <jet-label for="price" value="Prijs"/>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">&euro;</span>
                                    </div>
                                    <jet-input id="price" type="number" :class="{ 'is-invalid': form.errors.price }" v-model="form.price" ref="price" step="any"/>
                                </div>
                                <jet-input-error :message="form.errors.price" class="mt-2"/>
                            </div>
                            <div class="form-group">
                                <jet-label for="number" value="BTW"/>
                                <div class="input-group">
                                    <jet-input id="btw" type="number" :class="{ 'is-invalid': form.errors.btw }" v-model="form.btw" ref="btw" min="0" max="100" step="1"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <jet-input-error :message="form.errors.btw" class="mt-2"/>
                            </div>
                            <div class="form-group">
                                <jet-label for="number" value="Prijs (inc)"/>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">&euro;</span>
                                    </div>
                                    <jet-input disabled type="number" :value="dishPriceInc.toFixed(2)" step="any"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card my-2">
                        <div class="card-body">
                            <h5 class="card-title">Voedingswaarden</h5>

                            <div class="form-group">
                                <jet-label for="spiciness_level" value="Pittigheid"/>
                                <jet-select id="spiciness_level" :class="{ 'is-invalid': form.errors.spiciness_level }" v-model="form.spiciness_level" ref="spiciness_level">
                                    <option value="">Niet pittig</option>
                                    <option value="1">Beetje piggit</option>
                                    <option value="2">Pittig</option>
                                    <option value="3">Heel pittig</option>
                                </jet-select>
                                <jet-input-error :message="form.errors.spiciness_level" class="mt-2"/>
                            </div>

                            <div class="form-group">
                                <jet-label for="allergies" value="Allergieen"/>
                                <select multiple id="allergies" class="form-control overflow-auto" :size="allergies.length" :class="{ 'is-invalid': form.errors.allergies }" v-model="form.allergies" ref="allergies">
                                    <option v-for="allergy in allergies" :value="allergy.id">{{ allergy.name }}</option>
                                </select>
                                <jet-input-error :message="form.errors.allergies" class="mt-2"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 my-2">
                    <jet-button :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
                        Opslaan
                    </jet-button>
                </div>
            </div>
        </form>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import JetButton from '@/Jetstream/Button';
import JetCheckbox from '@/Jetstream/Checkbox';
import JetInput from '@/Jetstream/Input';
import JetInputError from '@/Jetstream/InputError';
import JetLabel from '@/Jetstream/Label';
import JetSelect from '@/Jetstream/Select';
import JetTextarea from '@/Jetstream/Textarea';

export default {
    components: {
        AppLayout,
        JetButton,
        JetCheckbox,
        JetInput,
        JetInputError,
        JetLabel,
        JetSelect,
        JetTextarea,
    },
    props: {
        category: Object,
        dish: Object,
        allergies: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.dish.name,
                number: this.dish.number,
                addition: this.dish.addition,
                description: this.dish.description,

                price: this.dish.price,
                btw: this.dish.btw,

                spiciness_level: this.dish.spiciness_level,
                allergies: this.dish.allergies,
            })
        }
    },
    computed: {
        dishPriceInc() {
            return ((parseInt(this.form.btw) + 100) / 100) * parseFloat(this.form.price);
        }
    },
    methods: {
        update() {
            this.form.put(this.route('manager.menus.dishes.update', [this.category.id, this.dish.id]), {
                preserveScroll: true
            })
        }
    }
}
</script>
