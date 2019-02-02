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

// Blog articles
mix.ts('src/Modules/blog/resources/assets/js/components/articles/edit.ts', 'src/Modules/blog/public/js/articles')
	.ts('src/Modules/blog/resources/assets/js/components/articles/new.ts', 'src/Modules/blog/public/js/articles')
	.ts('src/Modules/blog/resources/assets/js/components/articles/show.ts', 'src/Modules/blog/public/js/articles')
	.copy('src/Modules/blog/public/js/articles/*.js', '../../../public/ikpanel/modules/blog/js/articles')
	.copy('src/Modules/blog/public/js/articles/*.js.map', '../../../public/ikpanel/modules/blog/js/articles');

// Blog categories
mix.ts('src/Modules/blog/resources/assets/js/components/categories/edit.ts', 'src/Modules/blog/public/js/category')
	.ts('src/Modules/blog/resources/assets/js/components/categories/new.ts', 'src/Modules/blog/public/js/category')
	.ts('src/Modules/blog/resources/assets/js/components/categories/show.ts', 'src/Modules/blog/public/js/category')
	.copy('src/Modules/blog/public/js/category/*.js', '../../../public/ikpanel/modules/blog/js/category')
	.copy('src/Modules/blog/public/js/category/*.js.map', '../../../public/ikpanel/modules/blog/js/category');

// Gallery categories
mix.ts('src/Modules/gallery/resources/assets/js/components/categories/edit.ts', 'src/Modules/gallery/public/js/category')
	.ts('src/Modules/gallery/resources/assets/js/components/categories/new.ts', 'src/Modules/gallery/public/js/category')
	.ts('src/Modules/gallery/resources/assets/js/components/categories/show.ts', 'src/Modules/gallery/public/js/category')
	.copy('src/Modules/gallery/public/js/category/*.js', '../../../public/ikpanel/modules/gallery/js/category')
	.copy('src/Modules/gallery/public/js/category/*.js.map', '../../../public/ikpanel/modules/gallery/js/category');

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
