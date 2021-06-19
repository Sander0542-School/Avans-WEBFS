<template>
    <app-layout>
        <template #header>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <inertia-link :href="route('manager.cashdesk.index')">Kassa</inertia-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Bestellingen</li>
                </ol>
            </nav>
        </template>

        <div class="card">
            <table class="table table-card">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Verkoper</th>
                    <th>Prijs</th>
                    <th>Gerechten</th>
                    <th>Datum</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="order in orders.data" :key="order.id">
                    <td>{{ order.id }}</td>
                    <td>{{ order.status }}</td>
                    <td>{{ order.seller }}</td>
                    <td>&euro; {{ order.price.toFixed(2) }}</td>
                    <td>{{ order.dishes_count }}</td>
                    <td>{{ moment(order.created_at).format('D-M-Y HH:mm') }}</td>
                    <td class="text-right">
                        <button v-if="order.status === 'OPEN'" class="btn btn-success" @click="updateOrderStatus(order, 'CLOSED')">
                            <i class="fas fa-check"></i>
                        </button>
                        <inertia-link class="btn btn-primary" :href="route('manager.cashdesk.orders.show', order.id)">
                            <i class="fas fa-eye"></i>
                        </inertia-link>
                    </td>
                </tr>
                </tbody>
            </table>

            <pagination :links="orders.links"/>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import Pagination from '@/Shared/Pagination';

export default {
    name: "Dishes",
    components: {
        AppLayout,
        Pagination
    },
    props: {
        orders: Object,
    },
    methods: {
        updateOrderStatus(order, status) {
            if (confirm(`Weet je zeker dat je de status van order #${order.id} wil wijzigen?`)) {
                this.$inertia.patch(this.route('manager.cashdesk.orders.status', order.id), {
                    status: status
                }, {
                    preserveScroll: true,
                });
            }
        }
    }
}
</script>
