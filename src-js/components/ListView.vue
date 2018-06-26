<template>

    <v-card>

        <v-card-title>
            <h3 class="headline">{{ heading }}</h3>
            <v-spacer></v-spacer>
            <v-text-field
                append-icon="search"
                label="Search"
                single-line
                hide-details
                v-model="search"
            ></v-text-field>
        </v-card-title>

        <v-card-title v-if="hasHeaderSlot">
            <slot name="header"></slot>
        </v-card-title>

        <v-data-table
            :headers="headers"
            :items="items"
            :search="search"
            disable-initial-sort
            :rows-per-page-items="rowsPerPageItems"
            :loading="loading"
        >
            <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>

            <template slot="items" slot-scope="props">

                <tr @click="redirectToShowRoute(props.item.id)">
                    <slot
                        name="row"
                        :item="props.item"
                    ></slot>
                </tr>

            </template>

            <v-alert slot="no-results" :value="true" color="error" icon="warning">
                Your search for "{{ search }}" found no results.
            </v-alert>
        </v-data-table>

    </v-card>

</template>

<script>
export default {
    name: 'ListView',

    data() {
        return {
            search: '',
            rowsPerPageItems: [
                25,
                50,
            ],
        }
    },

    props: {
        heading: {
            type: String,
            required: true,
        },
        showRouteName: {
            type: String,
            required: true,
        },
        headers: {
            type: Array,
            required: true,
        },
        items: {
            type: Array,
            required: true,
        },
        loading: {
            type: Boolean,
            required: false,
            default: false,
        },
    },

    computed: {
        hasHeaderSlot() {
            if (this.$slots.header) return true

            return false
        },
    },

    methods: {
        /**
        * Redirect to show view.
        *
        * @param {integer} id Item ID
        */
        redirectToShowRoute(id) {
            this.$router.push({
                name: this.showRouteName,
                params: {
                    id,
                    language: 'en',
                },
            })
        },
    },
}
</script>
