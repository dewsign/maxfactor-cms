import { mapGetters } from 'vuex'

export default {
    computed: {
        ...mapGetters('language', ['languageIdentifiers']),
    },

    watch: {
        languageIdentifiers() {
            this.$store.dispatch('setLanguages', this.languageIdentifiers)
            this.populateAllDatasets()
        },
    },

    mounted() {
        this.$store.dispatch('language/fillItems')
        this.$store.dispatch('setLanguages', this.languageIdentifiers)
    },
}
