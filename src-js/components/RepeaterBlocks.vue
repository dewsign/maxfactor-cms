<template>

    <div>
        <content-card
            v-if="hasBlocks"
            heading="Repeater Block"
        >
            <template v-for="block in blocks">
                <div
                    v-if="block.type === 'text'"
                    :key="block.type"
                    style="display: flex;"
                >
                    <v-text-field
                        :label="block.label"
                        v-model="block.content"
                    />

                    <v-menu
                        bottom
                        left
                    >
                        <v-btn
                            slot="activator"
                            icon
                        >
                            <v-icon>more_vert</v-icon>
                        </v-btn>

                        <repeater-block-options
                            :block="block"
                            @delete="deleteBlock"
                        />
                    </v-menu>
                </div>

                <div
                    v-if="block.type === 'textarea'"
                    :key="block.type"
                    style="display: flex;"
                >
                    <v-text-field
                        :label="block.label"
                        v-model="block.content"
                        multi-line
                    />

                    <v-menu
                        bottom
                        left
                    >
                        <v-btn
                            slot="activator"
                            icon
                        >
                            <v-icon>more_vert</v-icon>
                        </v-btn>

                        <repeater-block-options
                            :block="block"
                            @delete="deleteBlock"
                        />
                    </v-menu>
                </div>

                <div
                    v-if="block.type === 'image'"
                    :key="block.type"
                >
                    <span class="d-block subheading grey--text text--darken-1 my-2">
                        {{ block.label }}
                    </span>

                    <div style="display: flex;">
                        <div style="flex-grow: 1;">
                            <dropzone-upload
                                :id="getImageBlockId(block.id)"
                                :block="block"
                                class="dropzone mb-2"
                                @input="value => block = value"
                            />

                            <v-text-field
                                v-model="block.content.image_alt"
                                :rules="imageAltTextRules"
                                :counter="50"
                                label="Alt Text"
                            />
                        </div>

                        <v-menu
                            bottom
                            left
                        >
                            <v-btn
                                slot="activator"
                                icon
                            >
                                <v-icon>more_vert</v-icon>
                            </v-btn>

                            <repeater-block-options
                                :block="block"
                                @delete="deleteBlock"
                            />
                        </v-menu>
                    </div>

                </div>

                <div
                    v-if="block.type === 'video'"
                    :key="block.type"
                    style="display: flex;"
                >
                    <v-text-field
                        :label="block.label"
                        v-model="block.content"
                    />

                    <v-menu
                        bottom
                        left
                    >
                        <v-btn
                            slot="activator"
                            icon
                        >
                            <v-icon>more_vert</v-icon>
                        </v-btn>

                        <repeater-block-options
                            :block="block"
                            @delete="deleteBlock"
                        />
                    </v-menu>
                </div>

            </template>
        </content-card>

        <repeater-choices
            :available-blocks="repeaters"
            :blocks="blocks"
        />

    </div>

</template>

<script>
import DropzoneUpload from './DropzoneUpload.vue'
import RepeaterChoices from './RepeaterChoices.vue'
import RepeaterBlockOptions from './RepeaterBlockOptions.vue'

export default {
    name: 'RepeaterBlocks',

    components: {
        DropzoneUpload,
        RepeaterChoices,
        RepeaterBlockOptions,
    },

    props: {
        config: {
            type: Object,
            required: true,
        },
        repeaters: {
            type: Array,
            required: false,
            default: () => [],
        },
        content: {
            type: Array,
            required: false,
            default: () => [],
        },
    },

    data() {
        return {
            blocks: this.content || [],
            imageAltTextRules: [
                v => (!v || v.length <= 50) || 'Image alt text must be less than 50 characters',
            ],
        }
    },

    computed: {
        hasBlocks() {
            return this.blocks && this.blocks.length > 0
        },
    },

    watch: {
        content: {
            handler(value) {
                this.$set(this, 'blocks', value)
            },
            deep: true,
        },
        blocks: {
            handler(value) {
                this.$emit('input', value)
            },
            deep: true,
        },
    },

    methods: {
        /**
            * Get full image block ID (for attribute).
            *
            * @param {Integer} blockId Image block ID
            * @return {String} Full image block ID
            */
        getImageBlockId(blockId) {
            return `imageBlock${blockId}`
        },

        /**
            * Delete block from repeater block.
            *
            * @param {Object} block Block data
            */
        deleteBlock(block) {
            const filteredArray = this.blocks.filter(item => item.id !== block.id)

            this.$set(this, 'blocks', filteredArray)
        },
    },
}
</script>
