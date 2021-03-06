var Encore = require('@symfony/webpack-encore');

Encore
  .setOutputPath('public/build/')
  .setPublicPath('/build')
  .setManifestKeyPrefix('build/')
  .addStyleEntry('style', './assets/css/app.scss')
  .addStyleEntry('login-page', './assets/css/login-page.scss')
  .splitEntryChunks()
  .disableSingleRuntimeChunk()
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())
  .configureBabel(() => {
  }, {
    useBuiltIns: 'usage',
    corejs: 3
  })
  .enableSassLoader()
  .autoProvidejQuery()
  .copyFiles({
    from: './assets/images',
    to: 'images/[path][name].[ext]',
    pattern: /\.(png|jpg|jpeg|ico|svg)$/
  })
  .copyFiles({
    from: './assets/fonts',
    to: 'fonts/[path][name].[ext]'
  })
  .copyFiles({
    from: './assets/js',
    to: 'js/[path][name].[ext]'
  })
;

module.exports = Encore.getWebpackConfig();
