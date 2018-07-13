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

                <content-card heading="Language Details">
                    <v-text-field
                        v-model="value.locale"
                        :rules="requiredRules"
                        :error-messages="form.errors.locale"
                        label="Locale"
                        required
                        @change="clearFieldErrors('locale')"
                    />

                    <v-text-field
                        v-model="value.name"
                        :rules="requiredRules"
                        :error-messages="form.errors.name"
                        label="Name"
                        required
                        @change="clearFieldErrors('name')"
                    />
                </content-card>

                <v-btn
                    :disabled="!valid || form.loading"
                    color="primary"
                    @click="submit"
                >Save</v-btn>

                <delete-dialog
                    v-if="isShowView"
                    @confirm="destroy"
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
import { DetailView } from 'maxfactor-cms'

export default {
    mixins: [
        DetailView,
        AjaxStoreMapper('language'),
    ],

    data() {
        return {
            routeNamespace: 'admin.language', // Laravel
            indexRouteName: 'language.index', // Vuex
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
                locale: this.locale,
                language: this.itemId,
            }
        },
    },

}
</script>
