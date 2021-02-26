const _themename = 'academy';

const gulp = require('gulp'),

	// prepare and optimize code
 
	browserSync = require('browser-sync').create(),	
  reload  = browserSync.reload,	
	sass = require('gulp-sass'),	
  sourcemaps=require('gulp-sourcemaps'),	
  autoprefixer=require('gulp-autoprefixer'),	
  lineec  = require( 'gulp-line-ending-corrector' ),	
  rtlcss  = require('gulp-rtlcss'),	
  rename  = require('gulp-rename');	

	// Name of working theme folder
	var root = '../' + _themename + '/',
	scss = root + 'sass/',
	js = root + 'js/';

  // php files
  var PHPWatchFiles  = root + '**/**/*.php';	


function ltr_css() {
  return gulp.src([scss + 'style.scss'])
  .pipe(sourcemaps.init({loadMaps: true}))
  .pipe(sass({
    outputStyle: 'expanded'
  }).on('error', sass.logError))
  .pipe(autoprefixer('last 2 versions'))
  .pipe(lineec())
  .pipe(sourcemaps.write('./maps/')) // generate sourcemaps 
  .pipe(gulp.dest(root));              // Output LTR (style.css)
                
}

function rtl_css() {
  return gulp.src([scss + 'style.scss'])
  .pipe(sourcemaps.init({loadMaps: true}))
  .pipe(sass({
    outputStyle: 'expanded'
  }).on('error', sass.logError))
  .pipe(autoprefixer('last 2 versions'))
  .pipe(lineec())          
  .pipe(rtlcss())                     // Convert to RTL
  .pipe(rename({ basename: 'rtl' }))  // Rename to rtl.css
  .pipe(sourcemaps.write('./maps/')) // generate sourcemaps 
  .pipe(gulp.dest(root));              // Output RTL (rtl.css)
            
              
} 


function browser() {
    browserSync.init({
        proxy: "http://127.0.0.1/wordpress/",
        files: [
           root + '*.php', root + '**/*.scss', js+'**/*.js'
        ],
        notify: true, 
        injectChanges: true,
        reloadDelay: 2000 ,
        reloadDebounce: 2000
       });
    

    gulp.watch([ root + '**/*.scss',root + '**/**/*.scss'],{ delay: 500 }, ltr_css);	
    gulp.watch([ root + '**/*.scss',root + '**/**/*.scss'],{ delay: 500 }, rtl_css);	
    gulp.watch(PHPWatchFiles).on('change', browserSync.reload);	
}

exports.ltr_css = ltr_css;
exports.rtl_css = rtl_css;	
exports.default = browser;