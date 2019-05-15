var Encore = require('@symfony/webpack-encore');

Encore
  .setOutputPath('public/build/')
  .setPublicPath('/build')
  .setManifestKeyPrefix('build/')
  .addEntry('app', './assets/js/app.js')
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
    pattern: /\.(png|jpg|jpeg|ico)$/
  })
;

module.exports = Encore.getWebpackConfig();
