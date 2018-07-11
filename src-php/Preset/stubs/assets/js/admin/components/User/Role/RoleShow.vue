<template>

    <div>
        <x-model
            :value="selected"
            @input="updateCurrentItem"
        >
            <v-form
                ref="form"
                slot-scope="{ value }"
                v-model="valid"
                lazy-validation
            >

                <content-card heading="Role Details">
                    <v-text-field
                        v-model="value.name"
                        label="Name"
                        required
                    />

                    <v-text-field
                        v-model="value.slug"
                        label="Slug"
                        required
                    />
                </content-card>

                <content-card
                    v-if="canViewPermissions"
                    heading="Permissions"
                >
                    <v-select
                        :items="permissions"
                        v-model="value.permissions"
                        item-text="name"
                        item-value="id"
                        label="Permissions"
                        chips
                        multiple
                        autocomplete
                        deletable-chips
                    />
                </content-card>

                <delete-dialog
                    :open="showDelete"
                    @confirm="destroy"
                    @close="showDelete = false"
                />

                <dirty-dialog
                    :open="isDirty && showDirty"
                    @confirm="gotoNext"
                    @close="abortNext"
                />

            </v-form>
        </x-model>

    </div>

</template>

<script>
import { AjaxStoreMapper } from 'ajax-store'
import { mapGetters } from 'vuex'
import { DetailView } from 'maxfactor-cms'

export default {

    mixins: [
        DetailView,
        AjaxStoreMapper('role', ['permission']),
    ],

    data() {
        return {
            routeNamespace: 'admin.role', // Laravel
            indexRouteName: 'role.index', // Vuex
            toolbar: [
                {
                    title: 'Save',
                    icon: 'save',
                    action: this.submit,
                },
            ],
        }
    },

    computed: {

        /**
         * Action route parameters.
         *
         * @return {Object} Route parameters
         */
        routeParams() {
            return {
                role: this.itemId,
                locale: this.locale,
            }
        },

        /**
         * Check whether user can view the related Permission model.
         *
         * @return {Boolean}
         */
        canViewPermissions() {
            return this.canCurrentUser('access_admin_permissions')
        },

        ...mapGetters('permission', {
            permissions: 'items',
        }),
    },

}
</script>
