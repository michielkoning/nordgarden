import { siteTitle, twitter, themeColor } from './siteDetails'

export default {
  manifest: {
    name: siteTitle,
    background_color: themeColor,
    theme_color: themeColor,
    short_name: siteTitle,
    orientation: 'portrait-primary',
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
  },
  meta: {
    appleStatusBarStyle: 'black-translucent',
    mobileApp: true,
    mobileAppIOS: true,
    theme_color: themeColor,
    twitterCard: 'summary_large_image',
    viewport: 'width=device-width, initial-scale=1, viewport-fit=cover',
    twitterCreator: twitter,
    twitterSite: twitter,
  },
}
