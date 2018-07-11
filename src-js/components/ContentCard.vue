<template>

    <v-card class="mb-4">

        <v-toolbar
            flat
            dense
        >
            <v-toolbar-title class="body-2 grey--text text--darken-2">
                {{ heading }}
            </v-toolbar-title>
            <v-spacer/>
            <v-btn
                icon
                @click.prevent="toggledContent"
            >
                <v-icon>{{ iconLabel }}</v-icon>
            </v-btn>
        </v-toolbar>

        <transition name="fade">
            <v-card-text v-if="isContentVisible">
                <slot/>
            </v-card-text>
        </transition>

    </v-card>

</template>

<script>
export default {

    name: 'ContentCard',

    props: {
        heading: {
            type: String,
            required: false,
            default: 'Section',
        },
    },

    data() {
        return {
            isContentVisible: true,
        }
    },

    computed: {
        iconLabel() {
            if (!this.isContentVisible) return 'keyboard_arrow_down'

            return 'keyboard_arrow_up'
        },
    },

    methods: {
        toggledContent() {
            this.isContentVisible = !this.isContentVisible
        },
    },
}
</script>
