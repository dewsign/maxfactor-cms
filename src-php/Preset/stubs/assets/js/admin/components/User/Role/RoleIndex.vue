<template>

    <list-view
        :show-route-name="showRouteName"
        :headers="listHeaders"
        :items="items"
        :loading="loading"
        heading="All Roles"
    >
        <template
            slot="row"
            slot-scope="{ item }"
        >
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.slug }}</td>
        </template>
    </list-view>

</template>

<script>
import { AjaxStoreMapper } from 'ajax-store'
import { ListView } from 'maxfactor-cms'

export default {

    mixins: [
        ListView,
        AjaxStoreMapper('role'),
    ],

    data() {
        return {
            showRouteName: 'role.show', // Vuex
            listHeaders: [
                {
                    text: 'ID',
                    value: 'id',
                },
                {
                    text: 'Name',
                    value: 'name',
                },
                {
                    text: 'Slug',
                    value: 'slug',
                },
            ],
            toolbar: [
                {
                    title: 'New',
                    icon: 'library_add',
                    route: 'role.create',
                },
            ],
        }
    },

}
</script>
