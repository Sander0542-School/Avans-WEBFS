<template>
    <app-layout>
        <template #header>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Kortingen</li>
                </ol>
            </nav>
            <inertia-link class="btn btn-primary float-right" :href="route('manager.discounts.create')">Nieuwe korting</inertia-link>
        </template>

        <div class="card">
            <table class="table table-card">
                <thead>
                <tr>
                    <th>Naam</th>
                    <th>Korting</th>
                    <th>Geldig tot</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="discount in discounts">
                    <td class="text-nowrap">{{ discount.name }}</td>
                    <td>{{ discount.discount }}%</td>
                    <td>{{ moment(discount.valid_until).format('D-M-Y HH:mm') }}</td>
                    <td class="text-right text-nowrap">
                        <inertia-link class="btn btn-primary" :href="route('manager.discounts.edit', discount.id)">
                            <i class="fas fa-pen"></i>
                        </inertia-link>
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
        discounts: Array
    }
}
</script>
