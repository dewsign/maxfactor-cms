const mix = require('laravel-mix')

mix.js('resources/assets/js/admin.js', 'public/js')
    .js('resources/assets/js/web.js', 'public/js')
    .sass('resources/assets/scss/web.scss', 'public/css')
    .extract(['vue', 'axios'])
    .sourceMaps()
    .browserSync({
        proxy: process.env.PROXY_URL || process.env.APP_URL,
        files: [
            'public/css/*.css',
            'public/js/*.js',
        ],
    })
    .disableSuccessNotifications()
    .webpackConfig({
        resolve: {
            symlinks: false,
        },
        node: {
            fs: 'empty',
        },
    })

/**
 * Version production files only if running in production mode
 */
if (mix.inProduction()) mix.version()
