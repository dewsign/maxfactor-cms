import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import XModel from '@thesold/x-model'
import { PusherAgent } from 'ajax-store'
import { App, CanCurrentUser, ContentCard } from 'maxfactor-cms'

import './bootstrap'
import './admin/bootstrap'

import Menu from './admin/menu'
import VuexStore from './admin/store'
import VueRouter from './admin/router'


/**
 * Vue Components
 */

Vue.component(XModel.name, XModel)
Vue.component(ContentCard.name, ContentCard)

/**
 * Vue Plugins
 */

Vue.use(Vuetify)
Vue.use(PusherAgent.plugin, {
    key: process.env.MIX_PUSHER_APP_KEY,
})

/* eslint-disable no-new */
new Vue({
    el: '#app',

    components: {
        App,
    },

    mixins: [
        PusherAgent.mixin,
        CanCurrentUser,
    ],

    devtool: 'source-map',

    router: VueRouter,

    store: VuexStore,

    watch: {
        $route: {
            handler(view) {
                this.$store.dispatch('setToolbarTitle', view.meta.title)
            },
        },
    },

    mounted() {
        this.$store.dispatch('setToolbarTitle', this.$route.meta.title)
        this.$store.dispatch('setMenuItems', Menu)
    },

    template: '<App/>',
})
