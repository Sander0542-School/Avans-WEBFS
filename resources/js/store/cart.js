import {createStore} from 'vuex'

export const cart = createStore({
    state() {
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
                    notes: '',
                });
            }
        },
        removeFromCart: (state, {categoryId, dishNumber}) => {
            //find the product in the products list
            let category = state.menu.find((category) => category.id === categoryId);
            // console.log(category);
            let product = category.dishes.find((dish) => dish.number === dishNumber)
            //find the product in the cart list
            let cartProduct = state.cart.find((product) => product.number === dishNumber);

            cartProduct.quantity--;
        },
        removeAllFromCart: (state) => {
            //Remove all from cart state
            state.cart = [];
        },
        deleteFromCart: (state, {categoryId, dishNumber}) => {
            //find the product in the products list
            let category = state.menu.find((category) => category.id === categoryId);
            // console.log(category);
            let product = category.dishes.find((dish) => dish.number === dishNumber)
            //find the product in the cart list
            let cartProductIndex = state.cart.findIndex((product) => product.number === dishNumber);

            state.cart.splice(cartProductIndex, 1);
        },
    },
    actions: {
        fetchMenu: (commit, menu) => {
            cart.commit("setUpMenu", menu);
        },
        addToCart: ({commit}, {categoryId, dishNumber}) => {
            cart.commit("addToCart", {categoryId, dishNumber});
        },
        increaseCartQuantity: ({commit}, productId) => {
            cart.commit("increaseCartQuantity", productId);
        },
        decreaseCartQuantity: ({commit}, productId) => {
            cart.commit("decreaseCartQuantity", productId);
        },
        removeFromCart: ({commit}, {categoryId, dishNumber}) => {
            cart.commit("removeFromCart", {categoryId, dishNumber});
        },
        removeAllFromCart: ({commit}) => {
            cart.commit("removeAllFromCart");
        },
        deleteFromCart: ({commit}, {categoryId, dishNumber}) => {
            cart.commit("deleteFromCart", {categoryId, dishNumber});
        }
    }
});
