import { set } from 'vue'

const FlashMessageStore = {
    namespaced: true,

    state: {
        status: false,
        text: '',
    },

    getters: {
        status: state => state.status,
        text: state => state.text,
    },

    mutations: {
        updateStatus: (state, status) => {
            set(state, 'status', status)
        },

        updateText: (state, text) => {
            set(state, 'text', text)
            set(state, 'status', true)
        },
    },
}

export default FlashMessageStore
