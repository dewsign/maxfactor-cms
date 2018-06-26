<template>
    <div class="confirmation-dialog">
        <div @click="requestConfirmation">
            <slot name="activator"></slot>
        </div>
        <v-dialog v-model="dialogIsOpen" :max-width="maxWidth">
            <v-card>
                <v-card-title class="headline">{{ title }}</v-card-title>
                <v-card-text>{{ message }}</v-card-text>
                <v-card-actions>
                    <v-btn :color="confirmColour" @click.prevent="confirmDialog">
                        <v-icon left>{{ confirmIcon }}</v-icon>
                        {{ confirmLabel }}
                    </v-btn>
                    <v-btn flat @click.stop="closeDialog">{{ cancelLabel }}</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
    name: 'confirmation-dialog',

    data() {
        return {
            dialog: {
                open: this.open,
            },
        }
    },

    props: {
        title: {
            type: String,
            required: false,
            default: 'Please confirm this action',
        },

        message: {
            type: String,
            required: false,
            default: 'Are you sure you want to continue?',
        },

        open: {
            type: Boolean,
            required: false,
            default: false,
        },

        confirmLabel: {
            type: String,
            required: false,
            default: 'Yes',
        },

        confirmColour: {
            type: String,
            required: false,
            default: 'primary',
        },

        confirmIcon: {
            type: String,
            required: false,
            default: 'done',
        },

        cancelLabel: {
            type: String,
            required: false,
            default: 'No',
        },

        maxWidth: {
            type: String,
            required: false,
            default: '350px',
        },
    },

    watch: {
        open: {
            handler(newValue) {
                this.dialog.open = newValue
            },
            deep: true,
        },
    },

    computed: {
        dialogIsOpen: {
            get() {
                return this.dialog.open
            },
            set(value) {
                this.$set(this.dialog, 'open', value)
            },
        },
    },

    methods: {
        closeDialog() {
            this.$set(this.dialog, 'open', false)
            this.$emit('close')
        },

        confirmDialog() {
            this.$set(this.dialog, 'open', false)
            this.$emit('confirm')
        },

        requestConfirmation() {
            this.$set(this.dialog, 'open', true)
        },
    },
}
</script>
