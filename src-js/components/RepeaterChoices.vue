<template>

    <div>
        <v-speed-dial
            v-model="addBlockCTA"
            :fixed="true"
            :bottom="true"
            :right="true"
            :direction="'left'"
            class="mb-4 mr-4"
        >
            <v-btn
                slot="activator"
                v-model="addBlockCTA"
                color="blue darken-2"
                dark
                fab
                hover
            >
                <v-icon>add</v-icon>
                <v-icon>close</v-icon>
            </v-btn>

            <v-tooltip
                v-for="availableBlock in availableBlocks"
                :key="availableBlock.type"
                top
            >
                <v-btn
                    slot="activator"
                    fab
                    dark
                    small
                    color="indigo"
                    @click="addBlock(availableBlock)"
                >
                    <v-icon>{{ availableBlock.icon }}</v-icon>
                </v-btn>

                <span>{{ availableBlock.label }} Block</span>
            </v-tooltip>
        </v-speed-dial>
    </div>

</template>

<script>
import Vue from 'vue'
import slugify from 'slugify'

export default {
    name: 'RepeaterChoices',

    props: {
        availableBlocks: {
            type: Array,
            required: true,
        },
        blocks: {
            type: Array,
            required: false,
            default: () => [],
        },
    },

    data() {
        return {
            blockConfig: {},
            addBlockCTA: false,
        }
    },

    computed: {
        /**
            * Get length of `blockData` array.
            *
            * @return {Integer} Length of `blocks` array
            */
        getNoOfBlocks() {
            return this.blocks.length + 1
        },

        /**
            * Get blocks initial ID.
            *
            * @return {Integer} Blocks initial ID
            */
        getBlockId() {
            return this.getNoOfBlocks
        },

        /**
            * Get blocks initial order within repeater block.
            *
            * @return {Integer} Blocks initial order
            */
        getBlockOrder() {
            return this.getNoOfBlocks
        },
    },

    methods: {
        /**
            * Update block configuration.
            *
            * @param  {Object} value Block configuration
            */
        updateBlockConfig(value) {
            this.blockConfig = Vue.util.extend({}, value)
        },

        addBlock(block) {
            this.updateBlockConfig(block)

            this.createBlock()
            this.setBlockContent()

            // Add block to repeater block
            this.blocks.push(this.block)
        },

        createBlock() {
            this.block = {
                id: this.getBlockId,
                order: this.getBlockOrder,
                type: this.blockConfig.type,
                label: this.blockConfig.label,
                name: slugify(this.blockConfig.label),
            }
        },

        setBlockContent() {
            // Set text block type content
            if (this.block.type === 'text'
                || this.block.type === 'textarea'
                || this.block.type === 'video') {
                this.$set(this.block, 'content', this.blockConfig.placeholder)
            }

            // Set image block type content
            if (this.block.type === 'image') {
                this.$set(this.block, 'content', {})
            }
        },
    },
}
</script>
