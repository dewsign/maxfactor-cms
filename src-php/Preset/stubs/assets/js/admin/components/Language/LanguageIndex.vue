<template>

    <list-view
        :show-route-name="showRouteName"
        :headers="listHeaders"
        :items="items"
        :loading="loading"
        heading="All Languages"
    >
        <template
            slot="row"
            slot-scope="{ item }"
        >
            <td>{{ item.id }}</td>
            <td>{{ item.locale }}</td>
            <td>{{ item.name }}</td>
        </template>
    </list-view>

</template>

<script>
import { AjaxStoreMapper } from 'ajax-store'
import { ListView } from 'maxfactor-cms'

export default {
    mixins: [
        ListView,
        AjaxStoreMapper('language'),
    ],

    data() {
        return {
            showRouteName: 'language.show', // Vuex
            listHeaders: [
                {
                    text: 'ID',
                    value: 'id',
                },
                {
                    text: 'Locale',
                    value: 'locale',
                },
                {
                    text: 'Name',
                    value: 'name',
                },
            ],
            toolbar: [
                {
                    title: 'Add Language',
                    icon: 'library_add',
                    route: 'language.create',
                },
            ],
        }
    },

}
</script>
