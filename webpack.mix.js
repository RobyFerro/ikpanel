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

// Todo: Fix JS Debug

mix.ts('src/Modules/blog/resources/assets/js/components/articles/edit.ts', 'src/Modules/blog/public/js/articles')
	.ts('src/Modules/blog/resources/assets/js/components/articles/new.ts', 'src/Modules/blog/public/js/articles')
	.copy('src/Modules/blog/public/js/articles/*.js', '../../../public/ikpanel/modules/blog/js/articles')
	.copy('src/Modules/blog/public/js/articles/!*.js.map', '../../../public/ikpanel/modules/blog/js/articles');

if(!mix.inProduction()) {
	mix.sourceMaps();
	mix.webpackConfig({
		resolve: {
			extensions: ['.ts'],
			alias: {
				"@ikpanel": path.resolve(__dirname, 'src/resources/assets/js/modules')
			}
		},
		devtool: "source-map"
	});
} // if
