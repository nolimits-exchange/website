var browserify = require('browserify');
var gulp       = require('gulp');
var source     = require('vinyl-source-stream');
var sass       = require('gulp-sass');
var minifyCss  = require('gulp-minify-css');

gulp.task('sass', function () {
    return gulp.src('./scss/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(minifyCss({keepSpecialComments:0}))
        .pipe(gulp.dest('./html/css'));
});

gulp.task('fonts', function() {
    return gulp.src('./node_modules/bootstrap-sass/assets/fonts/bootstrap/*')
        .pipe(gulp.dest('./html/fonts/bootstrap'));
});

gulp.task('browserify', function() {
    return browserify('./js/main.js')
        .bundle()
        .pipe(source('main.js'))
        .pipe(gulp.dest('./html/js/'));
});
