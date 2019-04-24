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

// Errors
mix.ts('src/resources/assets/js/components/exceptions/edit.ts', 'src/public/assets/js/exceptions')
	.ts('src/resources/assets/js/components/exceptions/show.ts', 'src/public/assets/js/exceptions')
	.ts('src/resources/assets/js/components/errors/404.ts', 'src/public/assets/js/errors')
	.copy('src/public/assets/js/exceptions/*.js', '../../../public/ikpanel/assets/js/exceptions')
	.copy('src/public/assets/js/exceptions/*.js.map', '../../../public/ikpanel/assets/js/exceptions')
	.copy('src/public/assets/js/errors/*.js', '../../../public/ikpanel/assets/js/errors')
	.copy('src/public/assets/js/errors/*.js.map', '../../../public/ikpanel/assets/js/errors');

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

// Calendar
mix.react('src/Modules/calendar/resources/assets/js/index.js', 'src/Modules/calendar/public/js')
	.copy('src/Modules/calendar/public/js/*.js', '../../../public/ikpanel/modules/calendar/js')
	.copy('src/Modules/calendar/public/js/*.js.map', '../../../public/ikpanel/modules/calendar/js');

// Gallery images
mix.ts('src/Modules/gallery/resources/assets/js/components/images/edit.ts', 'src/Modules/gallery/public/js/images')
	.ts('src/Modules/gallery/resources/assets/js/components/images/new.ts', 'src/Modules/gallery/public/js/images')
	.ts('src/Modules/gallery/resources/assets/js/components/images/show.ts', 'src/Modules/gallery/public/js/images')
	.copy('src/Modules/gallery/public/js/images/*.js', '../../../public/ikpanel/modules/gallery/js/images')
	.copy('src/Modules/gallery/public/js/images/*.js.map', '../../../public/ikpanel/modules/gallery/js/images');

// Widgets
mix.ts('src/resources/assets/js/components/widgets/widgets.ts', 'src/public/assets/js/widgets')
	.ts('src/resources/assets/js/components/widgets/widgets-edit.ts', 'src/public/assets/js/widgets')
	.copy('src/public/assets/js/widgets/*.js', '../../../public/ikpanel/plugins/js/widgets')
	.copy('src/public/assets/js/widgets/*.js.map', '../../../public/ikpanel/plugins/js/widgets');

// Error tracker
mix.ts('src/resources/assets/js/components/guard.ts', 'src/public/assets/js')
	.copy('src/public/assets/js/guard.js', '../../../public/ikpanel/assets/js')
	.copy('src/public/assets/js/guard.js.map', '../../../public/ikpanel/assets/js');

// Sass
mix.sass('src/resources/assets/sass/ikpanel.scss', 'src/public/assets/css')
	.sass('src/resources/assets/sass/404.scss', 'src/public/assets/css')
	.copy('src/public/assets/css/ikpanel.css*', '../../../public/ikpanel/assets/css')
	.copy('src/public/assets/css/404.css*', '../../../public/ikpanel/assets/css');

if(!mix.inProduction()) {
	mix.sourceMaps();
	mix.webpackConfig({
		resolve: {
			extensions: ['.ts'],
			alias: {
				"@ikpanel": path.resolve(__dirname, 'src/resources/assets/js/modules')
			}
		},
		devtool: "source-map",
		module: {
			rules: [
				{
					test: /\.hbs/,
					loader: 'handlebars-loader',
					options: {
						precompileOptions: {
							knownHelpersOnly: false,
						},
						helperDirs: path.join(__dirname, 'src/resources/assets/js/helpers'),
						debug: true
					},
				}
			]
		}
	});
} // if
