import { siteTitle, themeColor } from './siteDetails'

export default {
  name: siteTitle,
  background_color: themeColor,
  theme_color: 'transparent',
  short_name: siteTitle,
  orientation: 'any',
  categories: ['music'],
  screenshots: [
    {
      src: '/screenshots/desktop-home.png',
      sizes: '1280x800',
      type: 'image/png',
    },
    {
      src: '/screenshots/desktop-albums.png',
      sizes: '1280x800',
      type: 'image/png',
    },
    {
      src: '/screenshots/mobile-home.png',
      sizes: '375x667',
      type: 'image/png',
    },
    {
      src: '/screenshots/mobile-albums.png',
      sizes: '375x667',
      type: 'image/png',
    },
  ],
}
