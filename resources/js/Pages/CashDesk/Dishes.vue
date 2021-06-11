<template>


    <div class="row p-3">
        <div class="col-sm-8 ">

            <div class="card p-3 pb-2">
                <select v-model="filterCategory">
                    <option value="all">All</option>
                    <option value="SOEP">SOEP</option>
                </select>
                <input type="text" class="form-control pb-1" v-model="filterName" placeholder="Filter By Name"/>
                <div class="">
                    <div v-for="category in filterProducts" class="menu">
                        <div v-if="category.dishes.length > 0">
                            <h5>{{ category.name }}</h5>
                            <div v-for="dish in category.dishes">
                                <div class="menu-item mb-2">
                                    <span>{{ dish.number }}</span>
                                    <span v-if="dish.addition">{{ dish.addition }}</span>
                                    <span>. {{ dish.name }}</span>
                                    <span class="dotted"></span>
                                    <span>&euro; {{ dish.price }}</span>
                                    <button type="button" class="btn btn-primary ml-1 btn-sm"
                                            @click="addToCart(category.id, dish.number)">Toevoegen
                                    </button>
                                </div>
                                <span v-if="dish.description" class="font-italic small">({{ dish.description }})</span>
                            </div>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 ">
            <cart></cart>
        </div>
    </div>


</template>

<script>
import Cart from './/Cart';

export default {
    name: "Dishes",
    components: {
        Cart
    },
    props: {
        filteredMenu: Array,
        filterCategory: '',
        filterName: '',
        menu: Array
    },
    created() {
        this.$store.dispatch("fetchMenu", this.menu);

    },
    computed: {
        filterProducts: function () {
        //     // let result = this.menu
        //     // // if (!this.filterCategory)
        //     // //     return result
        //     //
        //     // if (this.filterCategory && this.filterName !== 'all') {
        //     //     result = result.filter((p) => {
        //     //         return p.name.indexOf(this.filterCategory) !== -1
        //     //     })
        //     // }
        //     //
        //     // if(this.filterName) {
        //     //     result = result.filter((p) => {
        //     //
        //     //         let foundproducts = p.dishes.findIndex((c) => {
        //     //             // debugger;
        //     //             return c.name.indexOf(this.filterName)
        //     //         })
        //     //         return foundproducts
        //     //     })
        //     // }
        //     //
        //     // return result
        //     //
        //     // // const filterValue = this.category.toLowerCase()
        //     // //
        //     // // const filter = category =>
        //     // //     category.name.toLowerCase().includes(filterValue)
        //     // //
        //     // // const filterProduct = category =>
        //     // //     category.dishes.some(dish => dish.name.toLowerCase() === filterValue)
        //     // //
        //     // // return result.filter(filter)
            let result = this.menu
            if (!this.filterName || this.filterName === ''){
                // console.log(this.menu);
                return result
            }
            else{

                result = result
                    // Return a modified copy of engagements..
                    .map((category) => {
                        // ..with all answered questions filtered out..
                        category.dishes = category.dishes.filter((dish) => !dish.name.indexOf(this.filterName));
                        console.log(category)
                        return category;
                    })
                    // // ..and only return engagements that have (unanswered) questions left
                    // .filter((category) => category.dishes.length !== 0);
// debugger;
                return result;
            }

        }



    },
    methods: {
        addToCart(categoryId, dishNumber) {
            this.$store.dispatch("addToCart", {categoryId, dishNumber});
        }
    }
}
</script>
