<template>
    <app-layout>
        <template #header>
            <h2 class="h4 font-weight-bold">
                Verkoop
            </h2>
        </template>

        <div class="card">
            <table class="table table-card">
                <thead>
                <tr>
                    <th>Datum</th>
                    <th>Bestellingen</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="sale in sales" :key="sale.date_key">
                    <td class="text-nowrap">{{ moment(sale.date).format('D-M-Y') }}</td>
                    <td class="text-nowrap">{{ sale.orders }}</td>
                    <td class="text-right text-nowrap">
                        <a target="_blank" class="btn btn-primary" :href="route('manager.sales.download', sale.date_key)">
                            <i class="fas fa-download"></i>
                        </a>
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
        sales: Array
    },
}
</script>
