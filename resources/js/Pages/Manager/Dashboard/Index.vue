<template>
    <app-layout>
        <template #header>
            <h2 class="h4 font-weight-bold">
                Dashboard
            </h2>
        </template>

        <h4>Statistieken</h4>
        <div class="row">
            <div v-for="stat in stats" class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ stat.name }}</h5>
                        <p class="card-text">{{ stat.value }}</p>
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
            AppLayout,
        },
        props: {
            stats: Array
        }
    }
</script>
