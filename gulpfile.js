var fs = require('fs'),
	themes = fs.readdirSync('web/public/views/'),
	theme = '*theme*',
	paths = {
		stylesheets: {
			sass: {
				authenticated: 'web/public/views/' + theme + '/authenticated/styles/sass/**/*.scss',
				unauthenticated: 'web/public/views/' + theme + '/unauthenticated/styles/sass/**/*.scss'
			},

			css: {
				authenticated: 'web/public/views/' + theme + '/authenticated/styles/css/',
				unauthenticated: 'web/public/views/' + theme + '/unauthenticated/styles/css/'
			}
		},

		scripts: {
			uncompressed: {
				authenticated: {
					script: 'web/public/views/' + theme + '/authenticated/scripts/uncompressed/**/*.js',
					libs: 'web/public/views/' + theme + '/authenticated/scripts/uncompressed/lib'
				},

				unauthenticated: {
					script: 'web/public/views/' + theme + '/unauthenticated/scripts/uncompressed/**/*.js',
					libs: 'web/public/views/' + theme + '/unauthenticated/scripts/uncompressed/lib'
				}
			},

			compressed: {
				authenticated: {
					script: 'web/public/views/' + theme + '/authenticated/scripts/compressed'
				},

				unauthenticated: {
					script: 'web/public/views/' + theme + '/unauthenticated/scripts/compressed'
				}
			}
		},

		lib_files: {
			authenticated: [ 
								'web/public/views/' + theme + '/authenticated/scripts/uncompressed/lib/jquery-3.0.0.min.js',
								'web/public/views/' + theme + '/authenticated/scripts/uncompressed/lib/mustache.min.js',
						 	],

			unauthenticated: [ 
								'web/public/views/' + theme + '/unauthenticated/scripts/uncompressed/lib/jquery-3.0.0.min.js',
								'web/public/views/' + theme + '/unauthenticated/scripts/uncompressed/lib/mustache.min.js',
						 	]
		}
	},

	gulp = require( 'gulp' ),
	uglify = require( 'gulp-uglify' ),
	sass = require( 'gulp-sass' ),
	livereload = require( 'gulp-livereload' ),
	imagemin = require( 'gulp-imagemin' ),
	prefix = require( 'gulp-autoprefixer' ),
	concat = require( 'gulp-concat' );

function errorLog ( error ) {
	console.error.bind( error );
	this.emit( 'end' );
}

// Scripts Task
// Uglifies
gulp.task( 'scripts', function () {
	for ( var i in themes ) {
		theme = themes[ i ];

		// minifying my javascript
		gulp.src( paths.scripts.uncompressed.authenticated.script.replace('*theme*', theme) )
			.pipe( uglify() )
			.on( 'error', errorLog )
			.pipe( gulp.dest( paths.scripts.compressed.authenticated.script.replace('*theme*', theme) ) );

		gulp.src( paths.scripts.uncompressed.unauthenticated.script.replace('*theme*', theme) )
			.pipe( uglify() )
			.on( 'error', errorLog )
			.pipe( gulp.dest( paths.scripts.compressed.unauthenticated.script.replace('*theme*', theme) ) );
	}
});

gulp.task( 'concat', function () {
	for ( var i in themes ) {
		theme = themes[ i ];

		gulp.src( paths.authenticated.lib_files.replace('*theme*', theme) )
			.pipe( concat( 'libs.js' ) )
			.on( 'error', errorLog )
			.pipe( gulp.dest( paths.scripts.uncompressed.authenticated.libs.replace('*theme*', theme) ) );

		gulp.src( paths.unauthenticated.lib_files.replace('*theme*', theme) )
			.pipe( concat( 'libs.js' ) )
			.on( 'error', errorLog )
			.pipe( gulp.dest( paths.scripts.uncompressed.unauthenticated.libs.replace('*theme*', theme) ) );
	}
} );

// Styles Task
gulp.task( 'styles', function () {
	for ( var i in themes ) {
		theme = themes[ i ];

		gulp.src( paths.stylesheets.sass.authenticated.replace('*theme*', theme) )
			.pipe( sass({outputStyle: 'compressed'})
			.on('error', sass.logError) )
			.on( 'error', errorLog )
			.pipe( prefix( 'last 2 versions' ) )
			.pipe( gulp.dest( paths.stylesheets.css.authenticated.replace('*theme*', theme) ) )
			.pipe( livereload() );

		gulp.src( paths.stylesheets.sass.unauthenticated.replace('*theme*', theme) )
			.pipe( sass({outputStyle: 'compressed'})
			.on('error', sass.logError) )
			.on( 'error', errorLog )
			.pipe( prefix( 'last 2 versions' ) )
			.pipe( gulp.dest( paths.stylesheets.css.unauthenticated.replace('*theme*', theme) ) )
			.pipe( livereload() );
	}
});

// Watch Task
gulp.task( 'watch', function () {
	var server = livereload();

	for ( var i in themes ) {
		theme = themes[ i ];

		// gulp.watch( lib_files, [ 'concat' ] );
		gulp.watch( paths.scripts.uncompressed.authenticated.script.replace('*theme*', theme), [ 'scripts' ] );
		gulp.watch( paths.scripts.uncompressed.unauthenticated.script.replace('*theme*', theme), [ 'scripts' ] );
		gulp.watch( paths.stylesheets.sass.authenticated.replace('*theme*', theme), [ 'styles' ] );
		gulp.watch( paths.stylesheets.sass.unauthenticated.replace('*theme*', theme), [ 'styles' ] );
		// gulp.watch( 'img/*', [ 'image' ] );
	}
});

// gulp.task( 'default', [ 'scripts', 'styles', 'image', 'watch' ]);
gulp.task( 'default', [ 'scripts', 'styles' ]);