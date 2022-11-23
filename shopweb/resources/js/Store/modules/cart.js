import axios from 'axios';

const state = {
    items: [],
}
const getters = {
    getItem: (state) => (id) => {
        return state.items.find(item => item.id === id)
    },
    getIndex: (state) => (id) => {
        return state.items.findIndex(item => item.id === id)
    },
    cartLength: (state) => {
        return state.items.length
    },
    cartTotalQuantity: (state) => {
        let total = 0;
        state.items.forEach((item) => {
            total += item.quantity
        })
        return total
    },
    cartTotalAmount: (state) => {
        let total = 0;
        state.items.forEach((item) => {
            total += item.quantity * item.data.unit_price
        })
        return total
    }
}
const mutations = {
    ADD_CART_ITEMS(state, payload) {
        state.items.push({
            id: payload.id,
            data: payload,
            quantity: 1,
        })
    },
    INCREASE_QUANTITY(state, index) {
        state.items[index].quantity++
    },
    DECREASE_QUANTITY(state, index) {
        if (state.items[index].quantity > 1)
            state.items[index].quantity--
    },
    CHANGE_QUANTITY(state, { index, quantity }) {
        if (quantity < 1)
            state.items[index].quantity = 1
        else state.items[index].quantity = quantity
    },
    REMOVE_CART_ITEMS(state, index) {
        state.items.splice(index, 1)
    },
    REMOVE_ALL_CART_ITEMS(state) {
        state.items = []
    }
}
const actions = {
    async increaseQuantity({ commit, getters }, id) {
        let i = getters.getIndex(id);
        if (i >= 0)
            commit('INCREASE_QUANTITY', i)
    },
    async decreaseQuantity({ commit, getters }, id) {
        let i = getters.getIndex(id);
        if (i >= 0)
            commit('DECREASE_QUANTITY', i)
    },
    async changeQuantity({ commit, state, getters }, { id, quantity }) {
        let i = getters.getIndex(id);
        if (i >= 0)
            commit('CHANGE_QUANTITY', {
                index: i,
                quantity: quantity,
            })
    },
    async removeCartItem({ commit, getters }, id) {
        let i = getters.getIndex(id);
        if (i >= 0)
            commit('REMOVE_CART_ITEMS',i )
    },
    async addToCart({ commit, getters }, { id, callback }) {
        let i = getters.getIndex(id)
        if (i >= 0) {
            commit('INCREASE_QUANTITY', i)
        }
        try {
            const result = await axios.get(`/api/content/products/${id}`)
            commit('ADD_CART_ITEMS', result.data)
            callback('success')
        }
        catch (e) {
            callback('error')
        }
    },
    async fetchCart({ commit, state }) {
        for (let index = 0; index < state.items.length; index++) {
            try {
                const result = await axios.get(`/api/content/products/${state.items[index].id}`)
                state.items[index].data = result.data
            }
            catch (e) {
                if (e.response && e.response.status == 404)
                    state.items.splice(index, 1)
            }
        }

    }
}

export default {
namespaced: true,
state,
getters,
actions,
mutations
}
