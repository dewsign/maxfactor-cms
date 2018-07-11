import { set } from 'vue'
import { union } from 'lodash'

const ContextStore = {

    state: {
        loading: false,
        locale: {
            current: 'en',
            available: [],
            translations: [],
        },
        toolbar: {
            title: 'Admin',
            items: [],
        },
        menu: {
            items: [],
        },
    },

    getters: {
        /**
         * The Languages available globally to translate content into. This should be set by each
         * store module to determine if content can be translated.
         */
        languages: ({ locale }) => locale.available,

        /**
         * Sets the translations the current content exists in. Should be set when viewing a
         * specific entry in the system.
         */
        translations: ({ locale }) => locale.translations,

        /**
         * The currently selected locale in order to return the correct data from other getters etc.
         */
        locale: ({ locale }) => locale.current,

        activeLocaleTabIndex: ({ locale: { translations, current } }) => {
            const index = translations.indexOf(current)

            // Vuetify Tabs require the index to be a string for some reason so we need to cast it
            return index.toString()
        },
        loading: ({ loading }) => loading,
        toolbarTitle: ({ toolbar }) => toolbar.title,
        toolbarItems: ({ toolbar }) => toolbar.items,
        menuItems: ({ menu }) => menu.items,
    },

    mutations: {
        setLanguages: ({ locale }, languages) => {
            set(locale, 'available', languages)
        },

        setTranslations: ({ locale }, translations) => {
            set(locale, 'translations', translations)
        },

        setLoading: (state, loading) => {
            set(state, 'loading', loading)
        },

        setLocale: ({ locale }, newLocale) => {
            set(locale, 'current', newLocale)
        },

        setToolbarTitle: ({ toolbar }, title) => {
            set(toolbar, 'title', title)
        },

        setToolbarItems: ({ toolbar }, items) => {
            set(toolbar, 'items', items)
        },

        setMenuItems: ({ menu }, items) => {
            set(menu, 'items', items)
        },
    },

    actions: {
        setLanguages: ({ commit }, languages = []) => {
            commit('setLanguages', languages)
        },

        setTranslations: ({ commit }, languages = []) => {
            commit('setTranslations', languages)
        },

        setLoading: ({ commit }, loading = false) => {
            commit('setLoading', loading)
        },

        setLocale: ({ commit, getters: { translations } }, locale = 'en') => {
            commit('setTranslations', union(translations, [locale]))
            commit('setLocale', locale)
        },

        setToolbarTitle: ({ commit }, title) => {
            commit('setToolbarTitle', title)
        },

        setToolbarItems: ({ commit }, items) => {
            commit('setToolbarItems', items)
        },

        setMenuItems: ({ commit }, items) => {
            commit('setMenuItems', items)
        },
    },

}

export default ContextStore
