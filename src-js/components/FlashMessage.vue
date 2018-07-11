<template>

    <v-snackbar
        :timeout="timeout"
        :bottom="true"
        v-model="status"
    >
        {{ text }}
        <v-btn flat color="white" @click.native="toggleFlashMessage">Close</v-btn>
    </v-snackbar>

</template>

<script>
import { mapState } from 'vuex'

export default {
    name: 'FlashMessage',

    data() {
        return {
            timeout: 3000,
        }
    },

    computed: {
        status: {
            get() {
                return this.$store.getters['flashMessage/status']
            },
            set(value) {
                this.$store.commit('flashMessage/updateStatus', value)
            },
        },

        ...mapState('flashMessage', [
            'text',
        ]),
    },

    methods: {
        toggleFlashMessage() {
            this.status = !this.status
        },
    },
}
</script>
