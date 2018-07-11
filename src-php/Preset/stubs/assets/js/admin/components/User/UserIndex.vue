<template>

    <list-view
        :show-route-name="showRouteName"
        :headers="listHeaders"
        :items="items"
        :loading="loading"
        heading="All Users"
    >
        <template
            slot="row"
            slot-scope="{ item }"
        >
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.email }}</td>
        </template>
    </list-view>

</template>

<script>
import { AjaxStoreMapper } from 'ajax-store'
import { ListView } from 'maxfactor-cms'

export default {
    mixins: [
        ListView,
        AjaxStoreMapper('user'),
    ],

    data() {
        return {
            showRouteName: 'user.show', // Vuex
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
                    text: 'Email',
                    value: 'email',
                },
            ],
            toolbar: [
                {
                    title: 'New',
                    icon: 'library_add',
                    route: 'user.create',
                },
            ],
        }
    },

}
</script>
