<template>
    <app-layout>
        <template #header>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <inertia-link :href="route('manager.menus.index')">Menu</inertia-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Aanmaken</li>
                </ol>
            </nav>
        </template>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nieuwe categorie</h5>
                <form @submit.prevent="store">
                    <div class="form-group">
                        <jet-label for="name" value="Naam"/>
                        <jet-input id="name" type="text" :class="{ 'is-invalid': form.errors.name }" v-model="form.name" ref="name" autocomplete="menu_category_name"/>
                        <jet-input-error :message="form.errors.name" class="mt-2"/>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <jet-checkbox id="extra_option" name="extra_option" v-model:checked="form.extra_option" />

                            <label class="custom-control-label" for="extra_option">
                                Extra Rijst
                            </label>
                        </div>
                        <jet-input-error :message="form.errors.extra_option" class="mt-2"/>
                    </div>
                    <jet-button :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
                        Aanmaken
                    </jet-button>
                </form>
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
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                extra_option: false,
            })
        }
    },
    methods: {
        store() {
            this.form.post(this.route('manager.menus.store'))
        }
    }
}
</script>
