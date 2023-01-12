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
const remoteCss         = remoteTheme + 'css/'
const remoteJs          = remoteTheme + 'js/'

// local theme
const localTheme        = 'wp-content/themes/aro/'
const localCss          = localTheme + 'css/'
const localJs           = localTheme + 'js/'



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



// gost club tasks [START]
gulp.task('gostCss', function () {
	return gulp.src(gostLocalCss + 'styles.scss')
		.pipe(sass())
		.pipe(cssMinify())
		.pipe(rename({
			basename: 'style',
			// suffix: '.min'
		}))
		.pipe(conn.dest(gostRemote))
})

gulp.task('phpCopy', function () {
	return gulp.src(localTheme + '*.php')
		.pipe(conn.dest(remoteTheme))
})

gulp.task('gostJs', function () {
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

gulp.task('gostJsCopy', function () {
	return gulp.src(gostLocalJs + '**/*')
		.pipe(conn.dest(gostRemoteJs))
})

gulp.task('gostPhp', function () {
	return gulp.src(gostLocal + '*.php')
		.pipe(conn.dest(gostRemote))
})

gulp.task('gostTemplateParts', function () {
	return gulp.src(gostLocalParts + '**/*')
		.pipe(conn.dest(gostRemoteParts))
})

gulp.task('gostWCBlocksCopy', function () {
	return gulp.src(gostLocalWCBlocks + 'wc-blocks-style.css')
		.pipe(conn.dest(gostRemoteWCBlocks))
})

gulp.task('gostWCIncludesCopy', function () {
	return gulp.src(gostLocalIncludes + 'style.min.css')
		.pipe(conn.dest(gostRemoteIncludes))
})

gulp.task('gostWCLayoutCopy', function () {
	return gulp.src(gostLocalWCLayout + 'woocommerce-layout.css')
		.pipe(conn.dest(gostRemoteWCLayout))
})

gulp.task('gostWCVendorsCopy', function () {
	return gulp.src(gostLocalWCVendors + 'wc-blocks-vendors-style.css')
		.pipe(conn.dest(gostRemoteWCVendors))
})

gulp.task('gostWCCopy', function () {
	return gulp.src(gostLocalWC + 'woocommerce.css')
		.pipe(conn.dest(gostRemoteWC))
})



gulp.task('watch', function() {
	gulp.watch(localTheme + '*.php',             gulp.series('phpCopy'))
})

gulp.task('default', gulp.series('watch'))