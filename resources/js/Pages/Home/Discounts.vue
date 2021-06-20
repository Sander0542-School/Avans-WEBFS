<template>
    <home-layout>
        <div class="row">
            <div v-for="discount in discounts" class="col-12 col-lg-6">
                <div class="card order-card">
                    <div class="card-body">
                        <h4>{{ discount.name }}</h4>
                        <h6>Geldig tot {{ moment(discount.valid_until).format('D-M-Y HH:mm') }}</h6>

                        <ul>
                            <li v-for="dish in discount.dishes">{{ dish.number }}{{ dish.addition }}. {{ dish.name }}
                                <span class="text-strikethrough">&euro; {{ dish.base_price.toFixed(2) }}</span>
                                <span> &euro; {{ dish.price.toFixed(2) }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </home-layout>
</template>

<script>
import HomeLayout from '@/Layouts/HomeLayout';

export default {
    components: {
        HomeLayout
    },
    props: {
        discounts: Array
    }
}
</script>
