import { createApolloFetch } from 'apollo-fetch'
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
      {
        name: 'apple-mobile-web-app-capable',
        content: 'yes'
      },
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
    '@nuxtjs/apollo',
    '@nuxtjs/pwa',
    '@nuxtjs/sitemap',
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
      const uri = `${apiUrl}graphql`

      const query = `
        query GET_SITEMAP {
          posts(first: 20, where: {status: PUBLISH}) {
            edges {
              node {
                uri
              }
            }
          }
        }
      `

      const apolloFetch = createApolloFetch({ uri })
      const result = await apolloFetch({ query }) // all apolloFetch arguments are optional
      const { posts } = result.data
      return posts.edges.map(item => {
        return item.node.uri
      })
    }
  },
  apollo,
  sitemap
}
