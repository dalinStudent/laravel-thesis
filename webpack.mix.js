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
module.exports = {
    module: {
        rules: [
            {
                test: /\.s(c|a)ss$/,
                use: [
                    "vue-style-loader",
                    "css-loader",
                    {
                        loader: "sass-loader",
                        // Requires sass-loader@^7.0.0
                        options: {
                            implementation: require("sass"),
                            indentedSyntax: true // optional
                        },
                        // Requires sass-loader@^8.0.0
                        options: {
                            implementation: require("sass"),
                            sassOptions: {
                                indentedSyntax: true // optional
                            }
                        }
                    }
                ]
            }
        ]
    }
};

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            '@components': path.resolve(__dirname, 'resources/js/components/'),
            '@Common': path.resolve(__dirname, 'resources/js/views/Common/'),
            '@Admin': path.resolve(__dirname, 'resources/js/views/Admin/'),
            '@SideManager': path.resolve(__dirname, 'resources/js/views/SideManager/'),
            '@Assistant': path.resolve(__dirname, 'resources/js/views/Assistant/'),
        }
    }
});

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
    
mix.copyDirectory("resources/images", "public/images");
mix.copyDirectory("resources/fonts", "public/fonts");