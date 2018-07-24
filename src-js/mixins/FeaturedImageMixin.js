import DropzoneUpload from '../components/DropzoneUpload.vue'

export default {

    components: {
        DropzoneUpload,
    },

    computed: {
        imageAlt: {
            get() {
                if (!this.item.featured_image) return ''

                return this.item.featured_image.image_alt
            },
            set(value) {
                if (!this.item.featured_image) return

                this.$set(this.item.featured_image, 'image_alt', value)
            },
        },

        /**
         * Get the featured image block.
         *
         * @return {Object} Featured image block
         */
        imageBlock() {
            if (this.hasFeaturedImage) return this.item.featured_image

            const imageBlock = {
                type: 'image',
                label: 'Image',
                name: 'image',
                content: {},
            }

            return imageBlock
        },

        /**
         * Check if response has a featured image.
         *
         * @return {Boolean} Whether response has a featured image
         */
        hasFeaturedImage() {
            if (
                !this.item.featured_image
                || Object.keys(this.item.featured_image).length === 0
            ) return false

            return true
        },
    },

}
