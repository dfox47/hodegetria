// npm install -g gulp-cli
// npm install gulp gulp-csso gulp-concat vinyl-ftp gulp-util gulp-rename gulp-sass gulp-uglify --save-dev

'use strict'

const fs            = require('fs')
const config        = JSON.parse(fs.readFileSync('../config.json'))
const ftp           = require('vinyl-ftp')
const gulp          = require('gulp')
const gutil         = require('gulp-util')
const concat        = require('gulp-concat')
const cssMinify     = require('gulp-csso')
const rename        = require('gulp-rename')
const sass          = require('gulp-sass')(require('sass'))
const uglify        = require('gulp-uglify')

// FTP config
const host              = config.host
const password          = config.password
const port              = config.port
const user              = config.user

// remote theme
const remoteTheme       = '/wp-content/themes/aro/'
const remoteCss         = remoteTheme + 'assets/css/'
const remoteJs          = remoteTheme + 'assets/js/'
const remoteParts       = remoteTheme + 'template-parts/'

// local theme
const localTheme        = 'wp-content/themes/aro/'
const localCss          = localTheme + 'assets/css/'
const localJs           = localTheme + 'assets/js/'
const localParts        = localTheme + 'template-parts/'



function getFtpConnection() {
	return ftp.create({
		host:           host,
		log:            gutil.log,
		password:       password,
		parallel:       3,
		port:           port,
		timeout:        99999999,
		user:           user
	});
}

const conn = getFtpConnection()



gulp.task('css', function () {
	return gulp.src(localCss + 'styles.scss')
		.pipe(sass())
		.pipe(cssMinify())
		.pipe(rename({
			basename: 'style'
		}))
		.pipe(conn.dest(remoteTheme))
})

gulp.task('cssCopy', function () {
	return gulp.src(localCss + '**/*')
		.pipe(conn.dest(remoteCss))
})

gulp.task('phpCopy', function () {
	return gulp.src(localTheme + '*.php')
		.pipe(conn.dest(remoteTheme))
})

gulp.task('partsCopy', function () {
	return gulp.src(localParts + '**/*.php')
		.pipe(conn.dest(remoteParts))
})

gulp.task('js', function () {
	return gulp.src([
		gostLocalJs + 'jquery-3.6.0.min.js',
		gostLocalJs + '**/*.js'
	])
		.pipe(concat('all.js'))
		// .pipe(uglify())
		.pipe(rename({
			suffix: ".min"
		}))
		.pipe(conn.dest(gostRemote))
})

gulp.task('jsCopy', function () {
	return gulp.src(localJs + '**/*')
		.pipe(conn.dest(remoteJs))
})

gulp.task('watch', function() {
	gulp.watch(localTheme + '*.php',            gulp.series('phpCopy'))
	gulp.watch(localParts + '**/*.php',         gulp.series('partsCopy'))
	gulp.watch(localCss + '**/*',               gulp.series('css', 'cssCopy'))
	gulp.watch(localJs + '**/*',                gulp.series('jsCopy'))
})

gulp.task('default', gulp.series('watch'))