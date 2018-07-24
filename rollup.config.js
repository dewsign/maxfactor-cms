import RollupPluginVue from 'rollup-plugin-vue'
import RollupPluginBabel from 'rollup-plugin-babel'

export default {
    input: 'src-js/index.js',
    output: {
        file: 'dist-js/index.js',
        format: 'cjs',
    },
    external: [
        'vue',
        'vuex',
        'lodash',
        'slugify',
        'dropzone',
        'collect.js',
        'maxfactor-vue-support',
    ],
    plugins: [
        RollupPluginVue(),
        RollupPluginBabel(),
    ],
}
