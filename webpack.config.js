const path = require('path');
module.exports = {
    entry: './src/scss/styles.scss', // entry scss file
    output: {
        filename: 'js/bundle.js', // generate bundle
        path: path.resolve(__dirname, 'public'), // into public folder
    },
    module: {
        rules: [
            {
                test: /\.scss/, // all scss files
                use: [
                    'style-loader', // include styles to DOM
                    'css-loader', // css
                    'sass-loader', // compiles scss to css,
                ],
            },
        ],
    },
    mode: 'production', // dev mode or prod mode
    devServer: {
        static: './public', // server dir
        devMiddleware: {
            writeToDisk: true, // write to disk so docker sees changes
        },
    },
};