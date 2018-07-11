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

                <content-card heading="User Details">
                    <v-text-field
                        v-model="value.name"
                        label="Name"
                        required
                    />

                    <v-text-field
                        v-model="value.email"
                        label="Email"
                        required
                    />
                </content-card>

                <content-card
                    v-if="canViewRoles"
                    heading="Roles"
                >
                    <v-select
                        v-model="value.roles"
                        :items="roles"
                        label="Roles"
                        item-text="name"
                        item-value="id"
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
import { FilterItemProperties, DetailView } from 'maxfactor-cms'

export default {
    mixins: [
        DetailView,
        FilterItemProperties,
        AjaxStoreMapper('user', ['role']),
    ],

    data() {
        return {
            routeNamespace: 'admin.user', // Laravel
            indexRouteName: 'user.index', // Vuex
            filterItemProperties: [
                'roles',
            ],
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
                user: this.itemId,
                locale: this.locale,
            }
        },

        /**
         * Check whether user can view the related Role model.
         *
         * @return {Boolean}
         */
        canViewRoles() {
            return this.canCurrentUser('access_admin_roles')
        },

        /**
         * Map relationship items for the Role model to make them accessible
         */
        ...mapGetters('role', {
            roles: 'items',
        }),
    },

}
</script>
