const path = require('path');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const HtmlWebpackPlugin = require('html-webpack-plugin'); //installed via npm
const webpack = require('webpack'); //to access built-in plugins
const autoprefixer = require("autoprefixer");
const extractSass = new ExtractTextPlugin({
    filename: "[name].[contenthash].css",
    disable: process.env.NODE_ENV === "development"
});
module.exports = {
    entry: "./src/entry.js",
    output: {
        path: path.resolve(__dirname, 'dist'),
        filename: "app.js",
        publicPath: "/",
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                use: {
                    loader: 'babel-loader',
                },
            },
            {
                test: /\.css$/,
                use: [ 'style-loader', 'css-loader', 'postcss-loader' ]
            },
            {
                test: /\.scss$/,
                use: extractSass.extract({
                    use: [{
                        loader: "css-loader"
                    }, {
                        loader: "postcss-loader"
                    }, {
                        loader: "sass-loader"
                    }],
                    // use style-loader in development
                    fallback: "style-loader"
                })
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader',
                options: {
                    extractSass: true,
                }
            },
            {
                test: /\.(png|jpg|gif|eot|svg|ttf|woff|woff2)$/,
                use: [
                    {
                        loader: 'url-loader',
                        options: {
                            limit: 8192
                        }
                    }
                ]
            }
        ]
    },
    plugins: [
        new HtmlWebpackPlugin({
            template: './src/index.html',
            inject:  'body',          // 插入文件的位置
            hash: true,  }),
        extractSass,
        new webpack.LoaderOptionsPlugin({
            options: {
                postcss: [autoprefixer({browsers:['last 2 versions']})]
            }
        })
    ]
}