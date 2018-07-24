<template>

    <content-card heading="Meta Attributes">

        <template slot="header">
            <div class="subheading">Meta attributes</div>
        </template>

        <v-text-field
            v-model="item.h1"
            :counter="50"
            label="H1"
            hint="Falls back to name (or title, if no name)"
            class="mb-3"
            persistent-hint
        />

        <v-text-field
            v-model="item.browser_title"
            :counter="60"
            label="Browser Title"
            hint="Falls back to name (or title, if no name)"
            class="mb-3"
            persistent-hint
        />

        <v-text-field
            v-model="item.meta_description"
            :counter="300"
            label="Meta Description"
            hint="Falls back to default site meta description"
            persistent-hint
        />

    </content-card>

</template>

<script>
export default {
    name: 'MetaAttributes',

    props: {
        item: {
            type: Object,
            required: true,
        },
    },
}
</script>
