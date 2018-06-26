import collect from 'collect.js'

export default {
    watch: {
        item: {
            handler: 'filter',
        },
    },

    methods: {
        filter() {
            if (this.isShowView && this.filterItemProperties) this.filterItem()
        },

        /**
         * Filter `this.item` properties to remove all object properties
         * expect `id`. Otherwise Vuetify select components would return
         * entire selected item object, rather than just the `id`.
         */
        filterItem() {
            this.filterItemProperties
                .forEach((property) => {
                    if (!this.item[property]) return

                    const filteredProperty = collect(this.item[property])
                        .pluck('id')
                        .toArray()

                    this.$set(this.item, property, filteredProperty)
                })
        },
    },
}
