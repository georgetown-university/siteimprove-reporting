// Gulp libraries
var gulp   = require('gulp'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    babel  = require('gulp-babel'),
    watch  = require('gulp-watch');

// Array of JS files, in order by dependency.
var vendorFiles = [
  'node_modules/jquery/dist/jquery.min.js',
  'node_modules/d3/build/d3.min.js',
  'node_modules/randomcolor/randomcolor.js'
];

var jsFiles = [
  'assets/js/src/functions.js'
 ];

// Task to concatinate required vendor JS files.
gulp.task('vendor', function() {
  return gulp.src(vendorFiles)
    .pipe(concat('siteimprove-vendor.min.js'))
    .pipe(gulp.dest('assets/js'));
});

// Task to concatinate and minify custom JS files.
gulp.task('js', function() {
  return gulp.src(jsFiles)
    .pipe(babel({presets: ['es2015']}))
    .pipe(concat('siteimprove.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('assets/js'));
});

// Watcher task for JS files.
gulp.task('watch', function() {
  gulp.watch('assets/js/*/*.js', ['js']);
});

// Default task
gulp.task('default', ['vendor', 'js', 'watch']);
