export default {
  defaultLocale: 'en',
  lazy: true,
  langDir: 'locales/',
  locales: [
    {
      name: 'English',
      code: 'en',
      iso: 'en-US',
      file: 'en.json',
    },
  ],
  vueI18nLoader: true,
  vueI18n: {
    dateTimeFormats: {
      en: {
        short: {
          year: 'numeric',
          month: 'long',
          day: 'numeric',
        },
        long: {
          year: 'numeric',
          month: 'short',
          day: 'numeric',
          weekday: 'short',
          hour: 'numeric',
          minute: 'numeric',
        },
      },
    },
  },
}
