import { siteUrl, siteTitle, twitter } from '~/config/siteDetails'

const getMetaTitle = (page, key) => {
  if (page.seo[key]) {
    return page.seo[key]
  } else if (page.seo.title) {
    return page.seo.title
  }

  return page.title
}

const getMetaDescripion = (page, key) => {
  if (page.seo[key]) {
    return page.seo[key]
  } else if (page.seo.metaDesc) {
    return page.seo.metaDesc
  }
  return null
}

export default (page, path) => {
  return {
    title: page.seo.title,
    meta: [
      {
        name: 'description',
        hid: 'description',
        content: page.seo.metaDesc
      },
      // Open Graph
      {
        hid: 'og:title',
        name: 'og:title',
        content: page.seo.title
      },
      {
        hid: 'og:locale',
        name: 'og:locale',
        content: 'en_US'
      },
      {
        hid: 'og:description',
        name: 'og:description',
        content: getMetaDescripion(page, 'opengraphDescription')
      },
      {
        hid: 'og:site_name',
        name: 'og:site_name',
        content: siteTitle
      },
      {
        name: 'og:url',
        content: `${siteUrl}${path}`
      },
      // Twitter Card
      { name: 'twitter:card', content: 'summary' },
      { name: 'twitter:site', content: `@${twitter}` },
      { name: 'twitter:creator', content: `@${twitter}` },
      {
        name: 'twitter:title',
        content: getMetaTitle(page, 'twitterTitle')
      },
      {
        name: 'twitter:description',
        content: page.seo.metaDesc
      }
    ]
  }
}
