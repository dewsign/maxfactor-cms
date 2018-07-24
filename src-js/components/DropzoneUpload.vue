<template>

    <div
        :id="id"
        :ref="id"
    />

</template>

<script>
import Dropzone from 'dropzone'
import { FormMixin } from 'maxfactor-vue-support'
import FlashMessageMixin from '../mixins/FlashMessageMixin'

export default {
    name: 'DropzoneUpload',

    mixins: [
        FormMixin,
        FlashMessageMixin,
    ],

    props: {
        block: {
            type: Object,
            required: false,
            default: () => ({
                type: 'image',
                label: 'Image',
                name: 'image',
                content: {},
            }),
        },
        id: {
            type: String,
            required: true,
        },
    },

    data() {
        return {
            dropzone: {},
            blockData: this.block,
            config: {
                paramName: 'image',
                url: window.route('admin.image.create').toString(),
                maxFiles: 1,
                thumbnailWidth: 300,
                thumbnailHeight: 300,
                addRemoveLinks: true,
                headers: {
                    'X-CSRF-TOKEN': window.axios.defaults.headers.common['X-CSRF-TOKEN'],
                },
            },
        }
    },

    computed: {
        /**
            * Check if there is an initial image.
            *
            * @return {Boolean}
            */
        hasInitialImage() {
            const imageId = this.blockData.content.image_id

            return imageId && imageId.length !== 0
        },
    },

    watch: {
        block: {
            handler(value) {
                this.$set(this, 'blockData', value)
            },
            deep: true,
        },
        blockData: {
            handler() {
                this.updateImage()
            },
        },
    },

    mounted() {
        if (this.$refs[this.id]) this.instantiate()
    },

    methods: {
        /**
            * Instantiate Dropzone.
            */
        instantiate() {
            const dropzone = new Dropzone(this.$refs[this.id], this.config)

            this.$set(this, 'dropzone', dropzone)

            // Stop Dropzone trying to attach twice
            Dropzone.autoDiscover = false

            this.success()
            this.maxFilesExceeded()
            this.removedFile()
            this.error()
        },

        /**
            * Update image whenever block data changes.
            */
        updateImage() {
            if (!this.hasInitialImage) this.dropzone.removeAllFiles(true)
            if (this.hasInitialImage) this.setImage()
        },

        /**
            * Set the current image.
            */
        setImage() {
            const imageId = this.blockData.content.image_id
            const imageExt = this.blockData.content.image_ext
            const imageSize = this.blockData.content.image_size

            // Create the initial image meta
            const file = {
                name: `${imageId}.${imageExt}`,
                size: imageSize,
            }

            // Mimic a file being uploaded
            this.dropzone.files.push(file)
            this.dropzone.emit('addedfile', file)
            this.dropzone.emit('complete', file)

            // Set image thumbnail
            this.setImageThumbnail(file, this.blockData.content)
        },

        /**
            * Image successfully uploaded.
            */
        success() {
            this.dropzone.on('success', (file, response) => {
                // Swap the uploaded image thumbnail for actual thumbnail
                this.setImageThumbnail(file, response)

                // Set block content to the server response
                this.setBlockContent(response)

                this.flashMessage('Successfully uploaded image')
            })
        },

        /**
            * Stop more than the maximum number of images being uploaded.
            */
        maxFilesExceeded() {
            this.dropzone.on('maxfilesexceeded', (file) => {
                this.dropzone.removeFile(file)

                this.flashMessage(`Sorry, you can only upload ${this.config.maxFiles} image per block`)
            })
        },

        /**
            * Output Dropzone errors.
            */
        error() {
            this.dropzone.on('error', (file, response) => {
                this.flashMessage(`Error: ${response.message}`)
            })
        },

        /**
            * Image removed from Dropzone.
            */
        removedFile() {
            // TODO: Ensure file isn't removed from Dropzone until removed from Cloudinary
            // TODO: Ensure file is delete on Cloudinary when image block is deleted
            this.dropzone.on('removedfile', () => {
                const imageId = this.blockData.content.image_id

                if (imageId) {
                    this.deleteForm(window.route('admin.image.delete', imageId).toString())
                        .then((event) => {
                            // Clear block content
                            this.setBlockContent({
                                image_id: null,
                                image_ext: null,
                                image_size: null,
                            })

                            this.flashMessage(event.data.message)

                            return event
                        }).catch((error) => {
                            this.flashMessage(`Error: ${error}`)

                            return error
                        })
                }
            })
        },

        /**
            * Get full image URL.
            *
            * @param  {Object} data Image data
            * @return {String}      Full image URL
            */
        getImageUrl(data) {
            const imageId = data.image_id
            const imageExt = data.image_ext

            if (imageId && imageExt) {
                const imageUrlParams = {
                    options: 'h300',
                    image_id: imageId,
                    image_ext: imageExt,
                }

                return window.route('admin.image.show', imageUrlParams).toString()
            }

            return null
        },

        /**
            * Set the image thumbnail.
            *
            * @param {Object} file Image meta
            * @param {Object} data Image data
            */
        setImageThumbnail(file, data) {
            const imageUrl = this.getImageUrl(data)

            if (imageUrl) {
                this.dropzone.emit('thumbnail', file, imageUrl)
            }
        },

        /**
            * Set block content.
            *
            * @param {Object} data Block content
            */
        setBlockContent(data) {
            this.$set(this.blockData.content, 'image_id', data.image_id)
            this.$set(this.blockData.content, 'image_ext', data.image_ext)
            this.$set(this.blockData.content, 'image_size', data.image_size)
        },
    },
}
</script>
