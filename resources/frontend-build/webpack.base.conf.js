var path = require('path')
var webpack = require("webpack");
var autoprefixer = require('autoprefixer');

module.exports = {
  entry: {
    app: './resources/app/main.js',
    vendor: ['vue', 'vue-resource', 'bulma']
  },
  output: {
    path: path.resolve(__dirname, '../../public/dist'),
    publicPath: 'dist',
    filename: '[name].js'
  },
  resolve: {
    extensions: ['', '.css', '.js', '.scss', '.vue'],
    alias: {
      src: path.resolve(__dirname, 'resources/app/')
    }
  },
  resolveLoader: {
    root: path.join(__dirname, 'node_modules')
  },
  module: {
    loaders: [
      {
        test: /\.js$/,
        loader: 'babel!eslint',
        exclude: /node_modules/
      },
      { test: /\.(sass|scss)$/, loader: 'style-loader!css-loader!postcss-loader!sass-loader' },
      { test: /\.css$/, loader: 'style-loader!css-loader!postcss-loader' },
      {
        test: /\.(woff|woff2)$/,
        loader: 'url-loader?limit=10000&mimetype=application/font-woff'
      },
      { test: /\.ttf$/, loader: 'file-loader' },
      { test: /\.eot$/, loader: 'file-loader' },
      { test: /\.svg$/, loader: 'file-loader' },
      {
        test: /\.vue$/,
        loader: 'vue'
      },
      {
        test: /\.json$/,
        loader: 'json'
      },
      {
        test: /\.(png|jpg|gif|svg)$/,
        loader: 'url',
        query: {
          limit: 10000,
          name: '[name].[ext]?[hash:7]'
        }
      },
      {
        test: /moment/,
        loader: 'expose?moment'
      },
      {
        test: /[\/\\]node_modules[\/\\]moment-duration-format[\/\\]lib[\/\\]moment-duration-format\.js$/,
        loader: "imports?moment=moment,this=>window"
      }
    ]
  },
  postcss: function () {
      return [autoprefixer({ browsers: ['last 2 versions'] })];
  },
  vue: {
    loaders: {
      scss: 'vue-style!css!sass',
      js: 'babel!eslint'
    }
  },
  eslint: {
    formatter: require('eslint-friendly-formatter')
  }
}
