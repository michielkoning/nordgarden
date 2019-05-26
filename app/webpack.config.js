const SpriteLoaderPlugin = require('svg-sprite-loader/plugin');

// installed via npm
module.exports = {
  rules: [
    {
      test: /\.css$/,
      use: [
        'vue-style-loader',
        {
          loader: 'css-loader',
          options: { importLoaders: 1 },
        },
        'postcss-loader',
      ],
    },
  ],
  plugins: [
    new SpriteLoaderPlugin({
      spriteAttrs: {
        id: 'my-custom-sprite-id',
      },
    }),
  ],
};
