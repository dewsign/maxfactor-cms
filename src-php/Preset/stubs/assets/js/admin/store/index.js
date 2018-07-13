import Vue from 'vue'
import Vuex from 'vuex'

import RoleStore from './modules/RoleStore'
import UserStore from './modules/UserStore'
import ContextStore from './modules/ContextStore'
import LanguageStore from './modules/LanguageStore'
import PermissionStore from './modules/PermissionStore'
import CurrentUserStore from './modules/CurrentUserStore'
import FlashMessageStore from './modules/FlashMessageStore'

Vue.use(Vuex)

const VuexStore = new Vuex.Store({
    modules: {
        role: new RoleStore(),
        user: new UserStore(),
        context: ContextStore,
        language: new LanguageStore(),
        permission: new PermissionStore(),
        flashMessage: FlashMessageStore,
        currentUser: new CurrentUserStore(),
    },
})

export default VuexStore
