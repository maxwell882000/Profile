module.exports = {
    pluginOptions: {
        i18n: {
            locale: 'ru',
            fallbackLocale: 'en',
            localeDir: './locales',
            enableInSFC: true
        }
    },
    configureWebpack: {
        output: {
            libraryExport: 'default'
        }
    }
}