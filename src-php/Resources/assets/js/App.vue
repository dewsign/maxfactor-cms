<template>

    <v-app id="app">

        <v-navigation-drawer
            v-model="drawer"
            fixed
            app
        >
            <v-list expand>
                <li
                    v-for="item in items"
                    :key="item.title"
                >
                    <v-list-tile
                        v-if="!item.items"
                        :to="{ name: item.route }"
                        router
                    >
                        <v-list-tile-action>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title class="subheading">
                                {{ item.title }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>

                    <v-list-group
                        v-if="item.items"
                        :prepend-icon="item.icon"
                        no-action
                    >
                        <v-list-tile slot="activator">
                            <v-list-tile-content>
                                <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile
                            v-for="subItem in item.items"
                            :key="subItem.title"
                            :to="{ name: subItem.route }"
                            router
                        >
                            <v-list-tile-content>
                                <v-list-tile-title>{{ subItem.title }}</v-list-tile-title>
                            </v-list-tile-content>
                            <v-list-tile-action>
                                <v-icon>{{ subItem.icon }}</v-icon>
                            </v-list-tile-action>
                        </v-list-tile>
                    </v-list-group>
                </li>
            </v-list>
        </v-navigation-drawer>

        <v-toolbar
            color="primary"
            dark
            fixed
            app
            tabs
        >
            <v-toolbar-side-icon @click.stop="drawer = !drawer" />
            <v-toolbar-title class="ml-0 pl-3">{{ toolbarTitle }}</v-toolbar-title>
            <v-spacer />
            <template v-for="toolbarItem in toolbarItems">
                <v-btn
                    v-if="toolbarItem.route"
                    :key="toolbarItem.title"
                    :to="{ name: toolbarItem.route }"
                    flat
                    router
                >
                    <v-icon left>{{ toolbarItem.icon }}</v-icon>{{ toolbarItem.title }}
                </v-btn>
                <v-btn
                    v-if="toolbarItem.action"
                    :key="toolbarItem.title"
                    flat
                    @click="toolbarItem.action"
                >
                    <v-icon left>{{ toolbarItem.icon }}</v-icon>{{ toolbarItem.title }}
                </v-btn>
            </template>
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
                <v-list>
                    <v-list-tile
                        :href="logoutRoute"
                        router
                    >
                        <v-list-tile-title>Logout</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
            <v-tabs
                v-if="routeIsLocalised"
                slot="extension"
                :value="activeLocaleTabIndex"
                color="primary"
                slider-color="pink"
                align-with-title
            >
                <v-tab
                    v-for="language in translations"
                    :key="language"
                    :to="routeParams({ language })"
                    router
                >
                    {{ language }}
                </v-tab>
                <v-menu
                    v-if="hasMissingTranslations"
                    left
                    bottom
                    class="tabs__div"
                >
                    <a
                        slot="activator"
                        class="tabs__item"
                    >
                        <v-icon small>add</v-icon>
                    </a>
                    <v-list class="grey lighten-3">
                        <v-list-tile
                            v-for="language in missingTranslations"
                            :key="language"
                            :to="routeParams({ language })"
                            router
                        >
                            {{ language }}
                        </v-list-tile>
                    </v-list>
                </v-menu>
            </v-tabs>
        </v-toolbar>

        <v-content>
            <v-container
                fluid
                class="px-5 py-5"
            >
                <router-view />
            </v-container>
        </v-content>

        <flash-message />

    </v-app>

</template>

<script>
/* eslint-disable import/no-unresolved */
import { FlashMessage } from 'maxfactor-cms'
import { mapGetters } from 'vuex'
import MenuItems from './menu'

export default {

    components: {
        FlashMessage,
    },

    data() {
        return {
            logoutRoute: window.route('logout').toString(),
            drawer: true,
            items: MenuItems,
        }
    },

    computed: {
        ...mapGetters([
            'locale',
            'languages',
            'translations',
            'toolbarTitle',
            'toolbarItems',
            'activeLocaleTabIndex',
        ]),

        routeIsLocalised() {
            return this.$route.meta.localised
        },

        missingTranslations() {
            return this.languages.filter(language => !this.translations.includes(language))
        },

        hasMissingTranslations() {
            return this.missingTranslations.length > 0
        },

        language() {
            return this.$route.params.language || 'en'
        },

    },

    methods: {

        routeParams(params) {
            return {
                name: this.$route.name,
                params: {
                    id: this.$route.params.id,
                    ...params,
                },
            }
        },

    },

}
</script>
