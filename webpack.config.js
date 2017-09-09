/**
 * Encore configuration, handles creating all static assets
 *
 * @author roelofr <github@roelof.io>
 */

// webpack.config.js
const Encore = require('@symfony/webpack-encore')
const StyleLintPlugin = require('stylelint-webpack-plugin')

Encore
  // directory where all compiled assets will be stored
  .setOutputPath('dist/')

  // what's the public path to this directory (relative to your project's document root dir)
  .setPublicPath('/')

  // empty the outputPath dir before each build
  .cleanupOutputBeforeBuild()

  // will output as web/build/main.css
  .addStyleEntry('main', './scss/main.scss')

  // allow sass/scss files to be processed
  .enableSassLoader()

  // Enable source maps on production
  .enableSourceMaps(!Encore.isProduction())

  // Enable PostCSS processing
  .enablePostCssLoader()

  // Add StyleLint
  .addPlugin(new StyleLintPlugin())

// export the final configuration
module.exports = Encore.getWebpackConfig()
