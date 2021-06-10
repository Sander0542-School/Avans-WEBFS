<template>
    <app-layout>
        <template #header>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Menu</li>
                </ol>
            </nav>
            <inertia-link class="btn btn-primary float-right" :href="route('manager.menus.create')">Nieuwe categorie</inertia-link>
        </template>

        <div class="card">
            <table class="table table-card">
                <thead>
                <tr>
                    <th>Categorie</th>
                    <th colspan="2">Gerechten</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="category in categories">
                    <td class="text-nowrap">{{ category.name }}</td>
                    <td>{{ category.dishes_count }}</td>
                    <td>{{ category.dishes_preview.join(', ') }}{{ category.dishes_count > 3 ? ', ...' : '' }}</td>
                    <td class="text-right text-nowrap">
                        <inertia-link class="btn btn-primary" :href="route('manager.menus.show', category.id)">
                            <i class="fas fa-pen"></i>
                        </inertia-link>
                        <button v-if="category.dishes_count <= 0" class="btn btn-danger" @click="deleteCategory(category)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';

export default {
    components: {
        AppLayout,
    },
    props: {
        categories: Array
    },
    methods: {
        deleteCategory(category) {
            if (confirm(`Weet je zeker dat je "${category.name}" wil verwijderen?`)) {
                this.$inertia.delete(this.route('manager.menus.destroy', category.id), {
                    preserveScroll: true,
                    only: ['categories']
                })
            }
        }
    }
}
</script>
