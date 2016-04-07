/*global require*/

var gulp = require('gulp');

// Include Our Plugins
var jshint = require('gulp-jshint');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var minifyCSS = require('gulp-minify-css');
var imagemin = require('gulp-imagemin');

// Lint Task
gulp.task('lint', function () {
    "use strict";
    return gulp.src('library/js/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});

// Compile Our Sass
gulp.task('sass', function () {
    "use strict";
    return gulp.src('library/scss/*.scss')
        .pipe(sass())
        .pipe(gulp.dest('library/css'))
        .pipe(minifyCSS())
        .pipe(rename('style.min.css'))
        .pipe(gulp.dest('library/css'));
});

// Concatenate & Minify JS
gulp.task('scripts', function () {
    "use strict";
    return gulp.src('library/js/*.js')
        .pipe(uglify())
        .pipe(concat('scripts.js'))
        .pipe(rename('scripts.min.js'))
        .pipe(gulp.dest('library/js/min'));
});

gulp.task('images', function () {
    "use strict";
    return gulp.src('library/images/*')
        .pipe(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true }))
        .pipe(gulp.dest('library/images'));
});

gulp.task('watch', function () {
    "use strict";
    gulp.watch('./library/js/*.js', ['lint', 'scripts']);
    gulp.watch('./library/js/**/*.js', ['lint', 'scripts']);
    gulp.watch('./library/scss/*.scss', ['sass']);
    gulp.watch('./library/scss/**/*.scss', ['sass']);
});

// Default Task
gulp.task('default', ['lint', 'sass', 'scripts', 'watch']);
