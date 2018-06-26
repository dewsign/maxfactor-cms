export default {
    methods: {
        /**
         * Redirect to given route.
         *
         * @param {String} name Route name
         */
        redirectTo(name) {
            this.$set(this, 'ignoreDirty', true)
            this.$router.push({ name })
        },
    },
}
