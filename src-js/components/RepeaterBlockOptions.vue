<template>

    <v-list>
        <v-list-tile
            v-for="option in options"
            :key="option.label"
            @click="$emit(option.name, block)"
        >
            <v-list-tile-title>{{ option.label }}</v-list-tile-title>
        </v-list-tile>
    </v-list>

</template>

<script>

export default {

    name: 'RepeaterBlockOptions',

    props: {

        block: {
            type: Object,
            required: true,
        },

        options: {
            type: Array,
            required: false,
            default: () => [
                {
                    label: 'Delete',
                    name: 'delete',
                },
            ],
        },

    },

}

</script>
