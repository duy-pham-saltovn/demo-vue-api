const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// JS HOME
mix.js('resources/js/app.js', 'js')
    .js('resources/js/trend.js', 'js')
    .js('resources/js/home/common.js', 'js')
    .js('resources/js/home/post.js', 'js')
    .js('resources/js/home/collection.js', 'js')
    .js('resources/js/home/subpage.js', 'js')
    .js('resources/js/home/video.js', 'js')
    .js('resources/js/login.js', 'js')
    .js('resources/js/ts/index.tsx', 'js/components/images.js');

// JS ADMIN
mix.js('resources/js/admin/common.js', 'assets/js')
    .js('resources/admin/ts/index.tsx', 'assets/ts');

// CSS Front-End
mix.sass('resources/sass/login.scss', 'css')
    .sass('resources/sass/app.scss', 'css')
    .sass('resources/sass/24h.scss', 'css')
    .sass('resources/sass/profile.scss', 'css')
    .sass('resources/sass/post.scss', 'css')
    .sass('resources/sass/video.scss', 'css');

// CSS Back-End
mix.sass('resources/admin/css/custom.scss', 'assets/css')
    .sass('resources/admin/css/access-denied.scss', 'assets/css')
    .options({
        autoprefixer: {
            options: {
                browsers: [
                    'last 6 versions',
                ]
            }
        }
    });

mix.options({
        postCss: [
            require('postcss-css-variables')()
        ],
        processCssUrls: false
    })
    .webpackConfig({
        module: {
            rules: [
                {
                    test: /\.tsx?$/,
                    loader: 'ts-loader',
                    exclude: /node_modules/,
                }
            ],
        },
        resolve: {
            extensions: ['*', '.js', '.jsx', '.ts', '.tsx'],
        },
    });
//
if (mix.inProduction()) {
    mix.version();
}
mix.browserSync('https://localhost:8888/')
    .disableNotifications();

