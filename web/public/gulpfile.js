var paths = {
		stylesheets: {
			sass: {
				authenticated: 'views/kn/authenticated/styles/sass/**/*.scss',
				unauthenticated: 'views/kn/unauthenticated/styles/sass/**/*.scss'
			},

			css: {
				authenticated: 'views/kn/authenticated/styles/css/',
				unauthenticated: 'views/kn/unauthenticated/styles/css/'
			}
		},

		scripts: {
			uncompressed: {
				authenticated: {
					script: 'views/kn/authenticated/scripts/uncompressed/**/*.js',
					libs: 'views/kn/authenticated/scripts/uncompressed/lib'
				},

				unauthenticated: {
					script: 'views/kn/unauthenticated/scripts/uncompressed/**/*.js',
					libs: 'views/kn/unauthenticated/scripts/uncompressed/lib'
				}
			},

			compressed: {
				authenticated: {
					script: 'views/kn/authenticated/scripts/compressed'
				},

				unauthenticated: {
					script: 'views/kn/unauthenticated/scripts/compressed'
				}
			}
		},

		lib_files: {
			authenticated: [ 
								'views/kn/authenticated/scripts/uncompressed/lib/jquery-3.0.0.min.js',
								'views/kn/authenticated/scripts/uncompressed/lib/mustache.min.js',
						 	],

			unauthenticated: [ 
								'views/kn/unauthenticated/scripts/uncompressed/lib/jquery-3.0.0.min.js',
								'views/kn/unauthenticated/scripts/uncompressed/lib/mustache.min.js',
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
	// minifying my javascript
	gulp.src( paths.scripts.uncompressed.authenticated.script )
		.pipe( uglify() )
		.on( 'error', errorLog )
		.pipe( gulp.dest( paths.scripts.compressed.authenticated.script ) );

	gulp.src( paths.scripts.uncompressed.unauthenticated.script )
		.pipe( uglify() )
		.on( 'error', errorLog )
		.pipe( gulp.dest( paths.scripts.compressed.unauthenticated.script ) );
});

gulp.task( 'concat', function () {
	gulp.src( paths.authenticated.lib_files )
		.pipe( concat( 'libs.js' ) )
		.on( 'error', errorLog )
		.pipe( gulp.dest( paths.scripts.uncompressed.authenticated.libs ) );

	gulp.src( paths.unauthenticated.lib_files )
		.pipe( concat( 'libs.js' ) )
		.on( 'error', errorLog )
		.pipe( gulp.dest( paths.scripts.uncompressed.unauthenticated.libs ) );
} );

// Styles Task
gulp.task( 'styles', function () {
	gulp.src( paths.stylesheets.sass.authenticated )
		.pipe( sass({outputStyle: 'compressed'})
		.on('error', sass.logError) )
		.on( 'error', errorLog )
		.pipe( prefix( 'last 2 versions' ) )
		.pipe( gulp.dest( paths.stylesheets.css.authenticated ) )
		.pipe( livereload() );

	gulp.src( paths.stylesheets.sass.unauthenticated )
		.pipe( sass({outputStyle: 'compressed'})
		.on('error', sass.logError) )
		.on( 'error', errorLog )
		.pipe( prefix( 'last 2 versions' ) )
		.pipe( gulp.dest( paths.stylesheets.css.unauthenticated ) )
		.pipe( livereload() );
});

// Watch Task
gulp.task( 'watch', function () {
	var server = livereload();

	// gulp.watch( lib_files, [ 'concat' ] );
	gulp.watch( paths.scripts.uncompressed.authenticated.script, [ 'scripts' ] );
	gulp.watch( paths.scripts.uncompressed.unauthenticated.script, [ 'scripts' ] );
	gulp.watch( paths.stylesheets.sass.authenticated, [ 'styles' ] );
	gulp.watch( paths.stylesheets.sass.unauthenticated, [ 'styles' ] );
	// gulp.watch( 'img/*', [ 'image' ] );
});

// gulp.task( 'default', [ 'scripts', 'styles', 'image', 'watch' ]);
gulp.task( 'default', [ 'scripts', 'styles', 'watch' ]);