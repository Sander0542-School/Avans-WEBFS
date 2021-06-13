import {createStore} from 'vuex'

export const cart = createStore({
    state() {
        return {
            dishes: [],
            cart: [],
        }
    },
    getters: {
        cartSize: (state) => {
            return state.cart.length;
        },
        selectedTable: (state) => {
            return state.selectedTable;
        },
        cartTotalAmount: (state) => {
            return state.cart.reduce((total, product) => {
                return total + (product.price * product.quantity);
            }, 0);
        },
        cartTotalAmountInc: (state) => {
            return state.cart.reduce((total, product) => {
                return total + (product.price_inc * product.quantity);
            }, 0);
        },
    },
    mutations: {
        setUpProducts: (state, productsPayload) => {
            //sets the state's  products property to the products array recieved as payload
            state.products = productsPayload;
        },
        setUpMenu: (state, dishesPayload) => {
            //sets the state's  products property to the products array recieved as payload
            state.dishes = dishesPayload;
        },
        addToCart: (state, dishId) => {
            //find the product in the cart list
            const cartProduct = state.cart.find((product) => product.id === dishId);

            if (cartProduct) {
                cartProduct.quantity++;
            } else {
                const product = state.dishes.find((dish) => dish.id === dishId);

                state.cart.push({
                    ...product,
                    quantity: 1,
                    remark: '',
                });
            }
        },
        removeFromCart: (state, dishId) => {
            const cartProduct = state.cart.find((product) => product.id === dishId);

            cartProduct.quantity--;
        },
        removeAllFromCart: (state) => {
            state.cart = [];
        },
        deleteFromCart: (state, dishId) => {
            let cartProductIndex = state.cart.findIndex((product) => product.id === dishId);

            state.cart.splice(cartProductIndex, 1);
        },
    },
    actions: {
        fetchDishes: (commit, dishes) => {
            cart.commit("setUpMenu", dishes);
        },
        addToCart: ({commit}, dishId) => {
            cart.commit("addToCart", dishId);
        },
        removeFromCart: ({commit}, dishId) => {
            cart.commit("removeFromCart", dishId);
        },
        removeAllFromCart: ({commit}) => {
            cart.commit("removeAllFromCart");
        },
        deleteFromCart: ({commit}, dishId) => {
            cart.commit("deleteFromCart", dishId);
        }
    }
});
