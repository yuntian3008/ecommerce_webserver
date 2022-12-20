import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate';
import cart from './modules/cart'
// import products from './modules/products'


export default createStore({
    modules: {
        cart,
        // products
    },
    plugins: [createPersistedState({
        storage: window.sessionStorage
        // getState: (key) => Cookies.getJSON(key),
        // setState: (key, state) => Cookies.set(key, state, { expires: 14, secure: true })
    })]
})
