import splashscreens from './config/splashscreens'
import googleAnalytics from './config/googleAnalytics'
import manifest from './config/manifest'
import i18n from './config/i18n'
import apollo from './config/apollo'
import { apiUrl, siteUrl, twitter, siteTitle } from './config/siteDetails'

export default {
  modern: true,
  target: 'static',
  env: {
    siteUrl,
  },
  server: {
    port: 3333,
    host: '0.0.0.0',
  },
  /*
   ** Headers of the page
   */
  head: {
    htmlAttrs: {
      lang: 'en',
    },
    titleTemplate: '%s | Nordgarden',
    meta: [
      { charset: 'utf-8' },
      {
        name: 'viewport',
        content: 'width=device-width, initial-scale=1, viewport-fit=cover',
      },
      {
        name: 'apple-mobile-web-app-capable',
        content: 'yes',
      },
      {
        name: 'apple-mobile-web-app-status-bar-style',
        content: 'black-translucent',
      },
      {
        hid: 'og:locale',
        name: 'og:locale',
        content: 'en_US',
      },
      {
        hid: 'og:site_name',
        name: 'og:site_name',
        content: siteTitle,
      },
      // Twitter Card
      { name: 'twitter:card', content: 'summary' },
      { name: 'twitter:site', content: `@${twitter}` },
      { name: 'twitter:creator', content: `@${twitter}` },
    ],
    link: [
      ...splashscreens,
      {
        rel: 'dns-prefetch',
        href: apiUrl,
      },
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
    ],
  },

  /*
   ** Customize the progress-bar color
   */
  loading: { color: 'var(--color-primary)', height: '2px' },
  /*
   ** Global CSS
   */
  css: ['~/styles/base.css'],
  /*
   ** Plugins to load before mounting the App
   */
  plugins: ['~/plugins/axios', '~/plugins/vue-youtube'],

  /*
   ** Nuxt.js modules
   */
  modules: [
    // Doc: https://axios.nuxtjs.org/usage
    '@nuxtjs/axios',
    '@nuxtjs/apollo',
    '@nuxtjs/pwa',
    'nuxt-svg-loader',
    'nuxt-i18n',
  ],

  buildModules: ['@nuxtjs/google-analytics'],
  manifest,
  i18n,

  googleAnalytics,

  /*
   ** Build configuration
   */
  build: {
    /*
     ** You can extend webpack config here
     */
    extend(config, ctx) {
      // Run ESLint on save
      if (ctx.isDev && ctx.isClient) {
        config.module.rules.push({
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /(node_modules)/,
        })
      }
    },
    babel: {
      plugins: ['@babel/plugin-proposal-optional-chaining'],
    },
    loaders: {
      cssModules: {
        modules: {
          // this is where you can alter the generated class names:
          localIdentName: '[local]-[hash:base64:4]',
        },
      },
    },
    postcss: {
      plugins: {
        'postcss-mixins': {
          mixinsDir: './styles/mixins/',
        },
        'postcss-preset-env': {
          importFrom: ['./styles/media-queries/media-queries.css'],

          features: {
            'nesting-rules': true,
            'custom-media-queries': true,
            'media-query-ranges': true,
          },
        },
      },
    },
  },
  generate: {
    fallback: true,
    interval: 2000,
    concurrency: 5,
  },
  apollo,
}
