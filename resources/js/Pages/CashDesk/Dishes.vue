<template>
    <app-layout>
        <div class="row p-3">
            <div class="col-sm-7 ">
                <div class="card p-3 pb-2 overflow-auto vh-100">
                    <select class="form-control mb-1" v-model="filterCategory">
                        <option selected value="all">All</option>
                        <option v-for="category in categories" v-bind:value="category">
                            {{ category }}
                        </option>
                    </select>
                    <input type="text" class="form-control mb-1" v-model="filterName" placeholder="Filter By Name"/>
                    <div v-for="category in filterProducts" class="menu">
                        <div v-if="category.dishes.length > 0">
                            <h5>{{ category.name }}</h5>
                            <div v-for="dish in category.dishes">
                                <div class="menu-item mb-2">
                                    <span>{{ dish.number }}</span>
                                    <span v-if="dish.addition">{{ dish.addition }}</span>
                                    <span>. {{ dish.name }}</span>
                                    <span class="dotted dotted-black text-black-50"></span>
                                    <span>&euro; {{ dish.price.toFixed(2) }}</span>
                                    <button type="button" class="btn btn-primary ml-1 btn-sm" @click="addToCart(dish.id)">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 ">
                <cart :dish_rice_options="dish_rice_options"></cart>
            </div>
        </div>
    </app-layout>
</template>

<script>
import Cart from './/Cart';
import AppLayout from '@/Layouts/AppLayout'

export default {
    name: "Dishes",
    components: {
        Cart,
        AppLayout
    },
    data: function () {
        return {
            categories: [],
            filterCategory: 'all',
        }
    },
    props: {
        filteredMenu: Array,
        filterName: '',
        menu: Array,
        dishes: Array,
        dish_rice_options: Array,
    },
    created() {
        this.$store.dispatch("fetchDishes", this.dishes);
    },
    mounted() {
        this.categories = this.menu.map(function (el) {
            return el.name;
        });
    },
    computed: {
        filterProducts: function () {
            let result = JSON.parse(JSON.stringify(this.menu));

            if (!this.filterName || this.filterName === '') {
                if (this.filterCategory !== "all" && this.filterCategory !== '') {
                    result = result.filter((p) => {
                        return p.name === this.filterCategory;
                    })
                }
                return result;
            } else {
                result = result
                    .map((category) => {
                        category.dishes = category.dishes.filter((dish) => dish.number === this.filterName || dish.name.match(this.filterName));
                        return category;
                    })

                return result;
            }
        }
    },
    methods: {
        addToCart(dishId) {
            this.$store.dispatch("addToCart", dishId);
        }
    },
}
</script>
