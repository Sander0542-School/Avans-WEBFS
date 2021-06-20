<template>
    <app-layout>
        <template #header>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <inertia-link :href="route('manager.cashdesk.index')">Kassa</inertia-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Vragen</li>
                </ol>
            </nav>
        </template>

        <div class="row">
            <div v-for="assistiance in assistances" class="col-12 col-md-6 col-lg-4 col-xl-3 pt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tafel - {{ assistiance.table_number }}</h5>
                        <button @click="confirm(assistiance.id)" class="btn btn-primary" type="button">Geholpen</button>
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
    },
    data: function () {
        return {}
    },
    props: {
        assistances: Array,
    },
    created() {
        Echo.private('request.created')
            .listen('CustomerRequestCreated', (e) => {
                this.assistances.push(e.request)
            });
    },
    methods: {
        confirm(id) {
            this.$inertia.post(this.route('manager.assistances.confirm'), {'id': id}, {
                onSuccess: () => this.removeAssistance(id)
            })
        },

        removeAssistance(id) {
            let lists = this.assistances.filter(x => {
                return x.id !== id;
            })
        },
    }


}
</script>
