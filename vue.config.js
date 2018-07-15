module.exports = {
    baseUrl: process.env.NODE_ENV === 'production'
      ? '/production-sub-path/'
      : '/',
    outputDir: './source/assets',
    chainWebpack: (config) => {
        config.module
            .rule('images')
            .use('url-loader')
            .tap(options => Object.assign({}, options, { name: 'img/[name].[ext]' }));
        config.plugins.delete('html');
        config.plugins.delete('preload');
        config.plugins.delete('prefetch');
    },
    css: {
    extract: {
        filename: '/css/[name].css',
        chunkFilename: '/css/[name].css',
    },
    },
    configureWebpack: {
    output: {
        filename: 'js/[name].js',
        chunkFilename: 'js/[name].js',
    },
    },
}