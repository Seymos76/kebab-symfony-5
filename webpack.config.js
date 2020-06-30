require('dotenv').config();
var Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    .copyFiles({
        from: './assets/img',
        pattern: /\.(png|jpg|jpeg)$/
    })
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')
    .addEntry('pwa', './assets/js/pwa.js')
    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()
    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())
    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })
    //.enableSassLoader()
    .enablePostCssLoader((options) => {
        options.config = {
            path: 'postcss.config.js'
        };
    })
    .enableSassLoader(function (options) {}, {
        resolveUrlLoader: false
    })
    //.enableTypeScriptLoader()
    .enableIntegrityHashes(Encore.isProduction())
    //.autoProvidejQuery()
    // uncomment if you use API Platform Admin (composer req api-admin)
    .enableReactPreset()
;
Encore.configureDefinePlugin(options => {
    options["process.env"].API_URL = process.env.API_URL;
});

module.exports = Encore.getWebpackConfig();
