import collect from 'collect.js'
import { FormMixin } from 'maxfactor-vue-support'
import { isEqual } from 'lodash'
import Toolbar from './ToolbarMixin'
import RedirectTo from './RedirectToMixin'
import FlashMessage from './FlashMessageMixin'
import CanCurrentUser from './CanCurrentUserMixin'
import DirtyDialog from '../components/DirtyDialog.vue'
import DeleteDialog from '../components/DeleteDialog.vue'

export default {
    mixins: [
        Toolbar,
        FormMixin,
        RedirectTo,
        FlashMessage,
        CanCurrentUser,
    ],

    components: {
        DirtyDialog,
        DeleteDialog,
    },

    data() {
        return {
            valid: true,
            requiredRules: [
                v => !!v || 'This field is required',
            ],
            requiredNumericRules: [
                v => !!v || 'This field is required',
                v => /^[0-9]+$/.test(v) || 'This field must be numeric',
            ],
            currentItem: {},
            showDelete: false,
            showDirty: false,
            ignoreDirty: false,
            nextAction: null,
        }
    },

    watch: {
        $route: {
            handler: 'routeHasChanged',
            immediate: true,
        },
        locale: 'switchLocale',
        language: {
            handler(value) {
                this.$store.dispatch('setLocale', value)
            },
        },
        isShowView: {
            handler() {
                this.toggleDeleteButton()
            },
        },
    },

    computed: {

        /**
         * Get the item's ID.
         *
         * @return {String|Null} Item's Id
         */
        itemId() {
            const itemId = parseInt(this.$route.params.id)

            return itemId || null
        },

        /**
         * Get the current item.
         *
         * @return {Object} Current item
         */
        item() {
            if (!this.isShowView) return {}

            const item = collect(this.items)
                .filter(({ id }) => id === this.itemId)
                .first()

            return item || {}
        },

        /**
         * Whether the current view is a create view.
         *
         * @return {Boolean}
         */
        isShowView() {
            return this.itemId !== null
        },

        /**
         * Get form action.
         *
         * @return {String} Form action
         */
        action() {
            if (this.isShowView) return this.getRoute('update')

            return this.getRoute('store')
        },

        /**
         * Determine if the current data has been modified.
         *
         * @returns boolean
         */
        isDirty() {
            if (this.ignoreDirty) return false

            return !isEqual(this.selected, this.currentItem)
        },

        /**
         * Return the language from the route parameter
         */
        language() {
            return this.$route.params.language
        },

    },

    methods: {

        routeHasChanged() {
            this.updateAllItems()
            this.setSelectedItemFromRoute()
            this.setToolbarItems()
        },

        updateAllItems() {
            if (this.isShowView && !this.hasItems) this.updateItems()
        },

        confirmDelete() {
            this.showDelete = true
        },

        toggleDeleteButton() {
            const deleteButton = {
                title: 'Delete',
                icon: 'delete_outline',
                action: this.confirmDelete,
            }

            if (this.isShowView) {
                this.toolbar.push(deleteButton)

                return
            }

            this.$set(this, 'toolbar', this.toolbar.filter(({ title }) => title !== deleteButton.title))
        },

        /**
         * Submit form.
         */
        submit() {
            this.postForm(this.action, this.currentItem)
                .then((event) => {
                    if (this.formHasErrors) return

                    this.updateSelected(this.currentItem)
                    this.flashMessage(event.data.message)

                    this.redirectTo(this.indexRouteName)
                }).catch(() => {
                    if (this.form.status === 403) this.redirectTo('logout')
                })
        },

        /**
         * Destroy item.
         */
        destroy() {
            this.deleteForm(this.getRoute('destroy'))
                .then(() => {
                    this.deleteSelected(this.currentItem)
                    this.redirectTo(this.indexRouteName)
                }).catch(() => {
                    if (this.form.status === 403) this.redirectTo('logout')
                })
        },

        /**
         * Get URL for a given CRUD route type.
         *
         * @param  {String} routeType CRUD route type
         * @return {String} Route URL
         */
        getRoute(routeType = 'show') {
            if (!this.routeNamespace) return ''

            const routeName = `${this.routeNamespace}.${routeType}`

            return window.route(routeName, this.routeParams).toString()
        },

        /**
         * Maintain changes to the x-model to later commit to the store
         *
         * @param {Mixed} value
         */
        updateCurrentItem(value) {
            this.$set(this, 'currentItem', value)
        },

        gotoNext() {
            this.showDirty = false
            this.nextAction()
        },

        abortNext() {
            this.showDirty = false
            this.nextAction(false)
        },

        promptUserIfDirty(next) {
            if (this.isDirty) {
                this.nextAction = next
                this.showDirty = true
                return
            }

            this.$store.dispatch('setLocale', 'en')
            next()
        },

        switchLocale() {
            this.fillItems()
        },

    },

    mounted() {
        this.toggleDeleteButton()
        this.$store.dispatch('setLocale', this.$route.params.language || 'en')
    },

    beforeRouteLeave(to, from, next) {
        this.promptUserIfDirty(next)
    },

    beforeRouteUpdate(to, from, next) {
        this.promptUserIfDirty(next)
    },

    beforeRouteEnter(to, from, next) {
        next(vm => vm.$store.dispatch('setLocale', vm.language))
    },

}
