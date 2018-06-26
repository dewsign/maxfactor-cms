import collect from 'collect.js'
import { mapGetters } from 'vuex'

export default {
    computed: {
        ...mapGetters('currentUser', {
            currentUser: 'items',
        }),
    },

    methods: {
        /**
         * Check whether current user has given permission.
         *
         * @param  {String}  permission Permission to check
         * @return {Boolean}
         */
        canCurrentUser(permission) {
            const { roles } = this.currentUser

            return collect(roles)
                .pluck('permissions')
                .flatten()
                .contains(permission)
        },

    },

    mounted() {
        this.$store.dispatch('currentUser/fillItems')
    },
}
