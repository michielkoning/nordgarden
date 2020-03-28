import { siteUrl } from '~/config/siteDetails'

export default (title, description, path) => {
  return {
    title,
    meta: [
      {
        name: 'description',
        hid: 'description',
        content: description,
      },
      // Open Graph
      {
        hid: 'og:title',
        name: 'og:title',
        content: title,
      },
      {
        hid: 'og:description',
        name: 'og:description',
        content: description,
      },
      {
        name: 'og:url',
        content: `${siteUrl}${path}`,
      },
      {
        name: 'twitter:title',
        content: title,
      },
      {
        name: 'twitter:description',
        content: description,
      },
    ],
  }
}
