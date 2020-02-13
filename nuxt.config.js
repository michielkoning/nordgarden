import axios from 'axios'
import pkg from './package'
import splashscreens from './config/splashscreens'
import googleAnalytics from './config/googleAnalytics'
import manifest from './config/manifest'
import i18n from './config/i18n'
import apollo from './config/apollo'
import sitemap from './config/sitemap'
import { apiUrl, siteUrl, twitter, siteTitle } from './config/siteDetails'

export default {
  mode: 'universal',
  env: {
    siteUrl
  },
  /*
   ** Headers of the page
   */
  head: {
    htmlAttrs: {
      lang: 'en'
    },
    titleTemplate: '%s | Nordgarden',
    meta: [
      { charset: 'utf-8' },
      {
        name: 'viewport',
        content: 'width=device-width, initial-scale=1, viewport-fit=cover'
      },
      { hid: 'description', name: 'description', content: pkg.description },
      {
        name: 'apple-mobile-web-app-status-bar-style',
        content: 'black-translucent'
      },
      {
        hid: 'og:locale',
        name: 'og:locale',
        content: 'en_US'
      },
      {
        hid: 'og:site_name',
        name: 'og:site_name',
        content: siteTitle
      },
      // Twitter Card
      { name: 'twitter:card', content: 'summary' },
      { name: 'twitter:site', content: `@${twitter}` },
      { name: 'twitter:creator', content: `@${twitter}` }
    ],
    link: [
      ...splashscreens,
      {
        rel: 'dns-prefetch',
        href: apiUrl
      },
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  /*
   ** Customize the progress-bar color
   */
  loading: { color: '#fff' },
  /*
   ** Global CSS
   */
  css: ['~/styles/base.css'],
  /*
   ** Plugins to load before mounting the App
   */
  plugins: ['~/plugins/vue-youtube', '~/plugins/announcer'],

  /*
   ** Nuxt.js modules
   */
  modules: [
    // Doc: https://axios.nuxtjs.org/usage
    '@nuxtjs/pwa',
    '@nuxtjs/sitemap',
    '@nuxtjs/apollo',
    'nuxt-svg-loader',
    'nuxt-i18n'
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
          exclude: /(node_modules)/
        })
      }
    },
    postcss: {
      plugins: {
        'postcss-mixins': {
          mixinsDir: './styles/mixins/'
        },
        'postcss-preset-env': {
          importFrom: ['./styles/media-queries/media-queries.css'],

          features: {
            'nesting-rules': true,
            'custom-media-queries': true,
            'media-query-ranges': true
          }
        }
      }
    }
  },
  generate: {
    fallback: true,
    async routes() {
      const response = await axios.get(
        `${apiUrl}wp-json/wp/v2/posts/?per_page=100`
      )
      const posts = response.data.map(post => post.slug)
      const urls = ['biography', ...posts]

      return urls
    }
  },
  apollo,
  sitemap
}
