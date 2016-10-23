var gulp = require( 'gulp' ),
	uglify = require( 'gulp-uglify' ),
	sass = require( 'gulp-sass' ),
	livereload = require( 'gulp-livereload' ),
	imagemin = require( 'gulp-imagemin' ),
	prefix = require( 'gulp-autoprefixer' ),
	concat = require( 'gulp-concat' ),
	lib_files = [ 
					'javascript/uncompressed/lib/jquery-1.8.3.js',
					'javascript/uncompressed/lib/bootstrap.js',
					'javascript/uncompressed/lib/bootstrap-modalmanager.js',
					'javascript/uncompressed/lib/bootstrap-modal.js',
					'javascript/uncompressed/lib/bootstrap-datepicker.js',
					'javascript/uncompressed/lib/dropit.js',
					'javascript/uncompressed/lib/jquery.maskedinput.js',
					'javascript/uncompressed/lib/slick.js',
					'javascript/uncompressed/lib/jquery.hashchange.js',
					'javascript/uncompressed/lib/jquery.easytabs.js',
					'javascript/uncompressed/lib/loadingoverlay.js',
					'javascript/uncompressed/lib/spin.min.js'
			 	];

function errorLog ( error ) {
	console.error.bind( error );
	this.emit( 'end' );
}

// Scripts Task
// Uglifies
gulp.task( 'scripts', function () {
	// minifying my javascript
	gulp.src( 'javascript/uncompressed/**/*.js' )
		.pipe( uglify() )
		.on( 'error', errorLog )
		.pipe( gulp.dest( 'javascript/compressed' ) );
});

gulp.task( 'concat', function () {
	gulp.src( lib_files )
		.pipe( concat( 'libs.js' ) )
		.on( 'error', errorLog )
		.pipe( gulp.dest( 'javascript/uncompressed/lib' ) );
} );

// Styles Task
gulp.task( 'styles', function () {
	gulp.src( 'views/kn/authenticated/styles/sass/**/*.scss' )
		.pipe( sass({outputStyle: 'compressed'})
		.on('error', sass.logError) )
		.on( 'error', errorLog )
		.pipe( prefix( 'last 2 versions' ) )
		.pipe( gulp.dest( 'views/kn/authenticated/styles/css/' ) )
		.pipe( livereload() );

	gulp.src( 'views/kn/unauthenticated/styles/sass/**/*.scss' )
		.pipe( sass({outputStyle: 'compressed'})
		.on('error', sass.logError) )
		.on( 'error', errorLog )
		.pipe( prefix( 'last 2 versions' ) )
		.pipe( gulp.dest( 'views/kn/unauthenticated/styles/css/' ) )
		.pipe( livereload() );
});

// Watch Task
gulp.task( 'watch', function () {
	var server = livereload();

	// gulp.watch( lib_files, [ 'concat' ] );
	gulp.watch( 'javascript/uncompressed/**/*.js', [ 'scripts' ] );
	gulp.watch( 'views/kn/authenticated/styles/sass/**/*.scss', [ 'styles' ] );
	gulp.watch( 'views/kn/unauthenticated/styles/sass/**/*.scss', [ 'styles' ] );
	// gulp.watch( 'img/*', [ 'image' ] );
});

// gulp.task( 'default', [ 'scripts', 'styles', 'image', 'watch' ]);
gulp.task( 'default', [ 'styles', 'watch' ]);