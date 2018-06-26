<template>

    <confirmation-dialog
        title="Unsaved Changes"
        message="
            You have changes which have not been saved.
            If you continue these will be lost.
            Are you sure you wish to continue?
        "
        confirm-label="Discard changes"
        confirm-colour="error"
        confirm-icon="delete"
        cancel-label="Keep editing"
        :open="open"
        @confirm="$emit('confirm')"
        @close="$emit('close')"
    ></confirmation-dialog>

</template>

<script>
import ConfirmationDialog from './ConfirmationDialog.vue'

export default {

    name: 'DirtyDialog',

    components: {
        ConfirmationDialog,
    },

    props: {
        open: {
            type: Boolean,
            required: false,
            default: false,
        },
    },

}
</script>
