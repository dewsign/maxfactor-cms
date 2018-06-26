export default {
    methods: {
        /**
         * Update flash message text in Vuex store.
         *
         * @param {String} message Flash message text
         */
        flashMessage(message) {
            this.$store.commit('flashMessage/updateText', message)
        },
    },
}
