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
const host          = config.host
const password      = config.password
const port          = config.port
const user          = config.user

const remoteFolder      = '/wp-content/themes/supermag/'
const remoteHooks       = remoteFolder + 'acmethemes/hooks/'
const remoteAssets      = remoteFolder + 'assets/'
const remoteCss         = remoteAssets + 'css/'
const remoteJs          = remoteAssets + 'js/'
const remoteParts       = remoteFolder + 'template-parts/'

const localFolder       = 'wp-content/themes/supermag/'
const localHooks        = localFolder + 'acmethemes/hooks/'
const localAssets       = localFolder + 'assets/'
const localCss          = localAssets + 'css/'
const localJs           = localAssets + 'js/'
const localParts        = localFolder + 'template-parts/'



// GOST club template
const gostRemote            = '/wp-content/themes/gostclub2022/'
const gostRemoteCss         = gostRemote + 'css/'
const gostRemoteJs          = gostRemote + 'js/'
const gostRemoteParts       = gostRemote + 'template-parts/'
const gostRemoteIncludes    = '/wp-includes/css/dist/block-library/'
const gostRemoteWCBlocks    = '/wp-content/plugins/woocommerce/packages/woocommerce-blocks/build/'
const gostRemoteWCLayout    = '/wp-content/plugins/woocommerce/assets/css/'
const gostRemoteWCVendors   = '/wp-content/plugins/woocommerce/packages/woocommerce-blocks/build/'
const gostRemoteWC          = '/wp-content/plugins/woocommerce/assets/css/'

const gostLocal             = 'wp-content/themes/gostclub2022/'
const gostLocalCss          = gostLocal + 'css/'
const gostLocalJs           = gostLocal + 'js/'
const gostLocalParts        = gostLocal + 'template-parts/'
const gostLocalIncludes     = 'wp-includes/css/dist/block-library/'
const gostLocalWC           = 'wp-content/plugins/woocommerce/assets/css/'
const gostLocalWCBlocks     = 'wp-content/plugins/woocommerce/packages/woocommerce-blocks/build/'
const gostLocalWCLayout     = 'wp-content/plugins/woocommerce/assets/css/'
const gostLocalWCVendors    = 'wp-content/plugins/woocommerce/packages/woocommerce-blocks/build/'



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

gulp.task('gostCssCopy', function () {
	return gulp.src(gostLocalCss + '**/*')
		.pipe(conn.dest(gostRemoteCss))
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
// gost club tasks [END]



gulp.task('watch', function() {
	gulp.watch(gostLocal + '*.php',             gulp.series('gostPhp'))
	gulp.watch(gostLocalCss + '**/*',           gulp.series('gostCss', 'gostCssCopy'))
	gulp.watch(gostLocalIncludes + '**/*',      gulp.series('gostWCIncludesCopy'))
	gulp.watch(gostLocalJs + '**/*',            gulp.series('gostJs', 'gostJsCopy'))
	gulp.watch(gostLocalParts + '**/*',         gulp.series('gostTemplateParts'))
	gulp.watch(gostLocalWC + '**/*',            gulp.series('gostWCCopy'))
	gulp.watch(gostLocalWCBlocks + '**/*',      gulp.series('gostWCBlocksCopy'))
	gulp.watch(gostLocalWCLayout + '**/*',      gulp.series('gostWCLayoutCopy'))
	gulp.watch(gostLocalWCVendors + '**/*',     gulp.series('gostWCVendorsCopy'))
})

gulp.task('default', gulp.series('watch'))