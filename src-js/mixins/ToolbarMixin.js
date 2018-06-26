export default {

    watch: {
        toolbar: {
            /**
             * Re-render the toolbar if the items are updated
             */
            handler() {
                this.setToolbarItems()
            },
            deep: true,
        },
    },

    methods: {
        /**
         * Set the toolbar in the context store for the app to render it in the global toolbar
         */
        setToolbarItems() {
            this.$store.dispatch('setToolbarItems', this.toolbar || [])
        },
    },

    mounted() {
        this.setToolbarItems()
    },

}
