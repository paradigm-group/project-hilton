/*global require*/

var gulp = require('gulp');

// Include Our Plugins
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var minifyCSS = require('gulp-minify-css');


gulp.task('css', function () {
    "use strict";
    return gulp.src('style.css')
        .pipe(gulp.dest('./'))
        .pipe(minifyCSS())
        .pipe(rename('style.min.css'))
        .pipe(gulp.dest('./'));
});

// Concatenate & Minify JS
gulp.task('scripts', function () {
    "use strict";
    return gulp.src('/js/*.js')
        .pipe(uglify())
        .pipe(concat('scripts.js'))
        .pipe(rename('scripts.min.js'))
        .pipe(gulp.dest('/js/min'));
});

gulp.task('watch', function () {
    "use strict";
    gulp.watch('./js/*.js', ['scripts']);
    gulp.watch('./js/**/*.js', ['scripts']);
    gulp.watch('style.css', ['css']);
});

// Default Task
gulp.task('default', [ 'css', 'scripts', 'watch']);
