<template>
    <app-layout>
        <template #header>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <inertia-link :href="route('manager.cashdesk.index')">Kassa</inertia-link>
                    </li>
                    <li class="breadcrumb-item">
                        <inertia-link :href="route('manager.cashdesk.orders.index')">Bestellingen</inertia-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Order #{{ order.id }}</li>
                </ol>
            </nav>
        </template>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order #{{ order.id }}</h5>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <th>Verkoper</th>
                                <td>{{ order.seller }}</td>
                            </tr>
                            <tr>
                                <th>Locatie</th>
                                <td>{{ order.table_number === null ? 'Afhalen' : `Tafel ${order.table_number}` }}</td>
                            </tr>
                            <tr>
                                <th>Datum</th>
                                <td>{{ moment(order.created_at).format('D-M-Y HH:mm') }}</td>
                            </tr>
                            <tr>
                                <th>Prijs</th>
                                <td>&euro; {{ order.price.toFixed(2) }}</td>
                            </tr>
                            <tr>
                                <th>Prijs (inc)</th>
                                <td>&euro; {{ order.price_inc.toFixed(2) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-8">
                <div class="card">
                    <table class="table table-card">
                        <thead>
                        <tr>
                            <th>Nummer</th>
                            <th>Gerecht</th>
                            <th>Stukprijs</th>
                            <th>BTW</th>
                            <th>Stukprijs (inc)</th>
                            <th>Aantal</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="order.dishes.length <= 0">
                            <td class="text-center" colspan="5">Deze bestelling bevat geen gerechten</td>
                        </tr>
                        <tr v-else v-for="dish in order.dishes">
                            <td>{{ dish.number }}{{ dish.addition }}</td>
                            <td>{{ dish.name }}</td>
                            <td>&euro; {{ dish.price.toFixed(2) }}</td>
                            <td>{{ dish.btw }}%</td>
                            <td>&euro; {{ dish.price_inc.toFixed(2) }}</td>
                            <td>{{ dish.amount }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    name: "Dishes",
    components: {
        AppLayout,
    },
    props: {
        order: Object,
    },
}
</script>
