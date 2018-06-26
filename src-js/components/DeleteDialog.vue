<template>

    <confirmation-dialog
        title="Please confirm deletion"
        message="Are you sure you want to delete this item?"
        confirm-label="Delete"
        confirm-colour="error"
        confirm-icon="delete"
        cancel-label="No"
        :open="open"
        @confirm="$emit('confirm')"
        @close="$emit('close')"
    ></confirmation-dialog>

</template>

<script>
import ConfirmationDialog from './ConfirmationDialog.vue'

export default {

    name: 'DeleteDialog',

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
