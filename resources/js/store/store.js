import { createStore } from 'vuex'

export const store = createStore({
    state () {
        return {
            categories: null,
            tables: null,
            menu: [],
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
    },
    mutations: {

        setUpProducts: (state, productsPayload) => {
            //sets the state's  products property to the products array recieved as payload
            state.products = productsPayload;
        },

        setUpMenu: (state, menuPayload) => {
            //sets the state's  products property to the products array recieved as payload
            state.menu = menuPayload;
        },

        addToCart: (state, {categoryId, dishNumber}) => {
            //find the product in the products list
            let category = state.menu.find((category) => category.id === categoryId);
            // console.log(category);
            let product = category.dishes.find((dish) => dish.number === dishNumber)
            //find the product in the cart list
            let cartProduct = state.cart.find((product) => product.number === dishNumber);

            if (cartProduct) {
                //product already present in the cart. so increase the quantity
                cartProduct.quantity++;
            } else {
                state.cart.push({
                    // product newly added to cart
                    ...product,
                    stock: product.quantity,
                    quantity: 1,
                });
            }
            //reduce the quantity in products list by 1
            product.quantity--;
        },
        removeFromCart: (state, productId) => {
            //find the product in the products list
            let product = state.products.find((product) => product.id === productId);
            //find the product in the cart list
            let cartProduct = state.cart.find((product) => product.id === productId);

            cartProduct.quantity--;
            //Add back the quantity in products list by 1
            product.quantity++;
        },
        removeAllFromCart: (state) => {
            //Remove all from cart state
            state.cart= [];
        },
        deleteFromCart: (state, productId) => {
            //find the product in the products list
            let product = state.products.find((product) => product.id === productId);
            //find the product index in the cart list
            let cartProductIndex = state.cart.findIndex((product) => product.id === productId);
            //srt back the quantity of the product to intial quantity
            // product.quantity = state.cart[cartProductIndex].stock;
            // remove the product from the cart
            state.cart.splice(cartProductIndex, 1);
        },

    },
    actions: {
        fetchMenu: ( commit, menu) => {
            store.commit("setUpMenu", menu);
        },

        addToCart: ({ commit }, {categoryId, dishNumber}) => {
            store.commit("addToCart", {categoryId, dishNumber});
        },

        removeFromCart: ({ commit }, productId) => {
            store.commit("removeFromCart", productId);
        },
        removeAllFromCart: ({ commit }, productId) => {
            store.commit("removeAllFromCart");
        },
        deleteFromCart: ({ commit }, productId) => {
            store.commit("deleteFromCart", productId);
        }
    }
});
