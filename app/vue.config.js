module.exports = {
  pluginOptions: {
    i18n: {
      locale: 'en',
      fallbackLocale: 'en',
      localeDir: 'locales',
      enableInSFC: false,
    },
  },
  // configureWebpack: {
  //   rules: {
  //     test: /\.css$/,
  //     use: [
  //       'vue-style-loader',
  //       {
  //         loader: 'css-loader',
  //         options: { importLoaders: 1 },
  //       },
  //       'postcss-loader',
  //     ],
  //   },
  // },
};
