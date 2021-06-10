<template>
    <app-layout>
        <template #header>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><inertia-link :href="route('manager.menus.index')">Menu</inertia-link></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ category.name }}</li>
                </ol>
            </nav>
            <inertia-link class="btn btn-primary float-right" :href="route('manager.menus.dishes.create', category.id)">Nieuw gerecht</inertia-link>
        </template>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-8">
                <div class="card">
                    <table class="table table-card">
                        <thead>
                        <tr>
                            <th>Nummer</th>
                            <th>Gerecht</th>
                            <th>Prijs</th>
                            <th>BTW</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="category.dishes.length <= 0">
                            <td class="text-center" colspan="5">Deze categorie bevat geen gerechten</td>
                        </tr>
                        <tr v-else v-for="dish in category.dishes" :class="{ 'text-danger': dish.deleted }">
                            <td>{{ dish.number }}{{ dish.addition }}</td>
                            <td>{{ dish.name }}</td>
                            <td>&euro; {{ dish.price }}</td>
                            <td>{{ dish.btw }}%</td>
                            <td class="text-right text-nowrap">
                                <inertia-link class="btn btn-primary" :href="route('manager.menus.dishes.edit', [category.id, dish.id])">
                                    <i class="fas fa-pen"></i>
                                </inertia-link>
                                <button v-if="dish.deleted" class="btn btn-success" @click="restoreDish(dish)">
                                    <i class="fas fa-trash-restore"></i>
                                </button>
                                <button v-else class="btn btn-danger" @click="deleteDish(dish)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5">
                                <span>&#9724; Op menu</span>
                                <br/>
                                <span class="text-danger">&#9724; Verwijderd</span>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Categorie bewerken</h5>
                        <form @submit.prevent="updateCategory">
                            <div class="form-group">
                                <jet-label for="name" value="Naam"/>
                                <jet-input id="name" type="text" :class="{ 'is-invalid': form.errors.name }" v-model="form.name" ref="name" autocomplete="menu_category_name"/>
                                <jet-input-error :message="form.errors.name" class="mt-2"/>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <jet-checkbox id="extra_option" name="extra_option" v-model:checked="form.extra_option"/>

                                    <label class="custom-control-label" for="extra_option">
                                        Extra Rijst
                                    </label>
                                </div>
                                <jet-input-error :message="form.errors.extra_option" class="mt-2"/>
                            </div>
                            <jet-button :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
                                Opslaan
                            </jet-button>
                        </form>
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
        category: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.category.name,
                extra_option: this.category.extra_option,
            })
        }
    },
    methods: {
        updateCategory() {
            this.form.put(this.route('manager.menus.update', this.category.id), {
                preserveScroll: true,
                only: ['category']
            })
        },
        deleteDish(dish) {
            if (confirm(`Weet je zeker dat je "${dish.name}" wil verwijderen?`)) {
                this.$inertia.delete(this.route('manager.menus.dishes.destroy', [this.category.id, dish.id]), {
                    preserveScroll: true,
                    only: ['category']
                });
            }
        },
        restoreDish(dish) {
            if (confirm(`Weet je zeker dat je "${dish.name}" terug wil zetten?`)) {
                this.$inertia.put(this.route('manager.menus.dishes.restore', [this.category.id, dish.id]), {}, {
                    preserveScroll: true,
                    only: ['category']
                });
            }
        }
    }
}
</script>
