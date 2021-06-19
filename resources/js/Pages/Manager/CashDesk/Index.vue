<template>
    <app-layout>
        <template #header>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Kassa</li>
                </ol>
            </nav>
        </template>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Verkopen</h5>
                        <p class="card-text">Het systeem om bestellingen te maken voor klanten</p>
                        <inertia-link class="btn btn-primary" :href="route('manager.cashdesk.dishes')">Openen</inertia-link>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Bestellingen</h5>
                        <p class="card-text">Het systeem om bestellingen die gemaakt zijn in te zien</p>
                        <inertia-link class="btn btn-primary" :href="route('manager.cashdesk.orders.index')">Openen</inertia-link>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    components: {
        AppLayout
    }
}
</script>
