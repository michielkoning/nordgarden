import { siteTitle } from './siteDetails'

export default {
  name: siteTitle,
  background_color: '#464545',
  theme_color: '#dcac4c',
  short_name: siteTitle,
  orientation: 'any',
  shortcuts: [
    {
      name: 'Tour',
      short_name: 'Tour',
      url: '/tour',
    },
    {
      name: 'Albums',
      short_name: 'Albums',
      url: '/albums',
    },
    {
      name: 'Videos',
      short_name: 'Videos',
      url: '/videos',
    },
    {
      name: 'Biography',
      short_name: 'Biography',
      url: '/biography',
    },
  ],
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
