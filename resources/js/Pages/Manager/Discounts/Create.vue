<template>
    <app-layout>
        <template #header>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <inertia-link :href="route('manager.discounts.index')">Kortingen</inertia-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Aanmaken</li>
                </ol>
            </nav>
        </template>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nieuwe korting</h5>
                <form @submit.prevent="store">
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
                discount: 1,
                valid_until: null,
            })
        }
    },
    methods: {
        store() {
            this.form.post(this.route('manager.discounts.store'))
        }
    }
}
</script>
