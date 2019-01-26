let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.ts('src/Modules/blog/resources/assets/js/components/articles/edit.ts', 'src/Modules/blog/public/js/articles')
	.copy('src/Modules/blog/public/js/articles/*.js', '../../../public/ikpanel/modules/blog/js/articles')
	.copy('src/Modules/blog/public/js/articles/*.js.map', '../../../public/ikpanel/modules/blog/js/articles');

if(!mix.inProduction()) {
	mix.webpackConfig({
		devtool: 'source-map'
	});
}
