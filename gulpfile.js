var gulp = require('gulp');
var jshint = require('gulp-jshint');
var clean = require('gulp-clean');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var es = require('event-stream');
var cleanCSS = require('gulp-clean-css');
var runSequence = require('run-sequence');

gulp.task('clean', function () {
    return gulp.src('dist/')
            .pipe(clean());
});

gulp.task('jshint', function () {
    return gulp.src(['js/**/*.js', 'include/*/js/**/*.js', 'themes/intranet/'])
            .pipe(jshint())
            .pipe(jshint.reporter('default'));
});

gulp.task('uglify', ['clean'], function () {
    return es.merge([
        gulp.src(['_lib/jquery/jquery.min.js', '_lib/jquery/jmask.min.js', '_lib/angular/*.js', '_lib/bootstrap/js/*.js', '_lib/google-chart/*.js']).pipe(concat('lib.min.js')),
        gulp.src(['js/**/*.js', 'include/*/js/**/*.js']).pipe(uglify()).pipe(concat('all.min.js'))
    ])
            .pipe(gulp.dest('dist/js'));
});

//htmlmin pode ser implementado.


gulp.task('cssmin', function () {
    return gulp.src('_lib/bootstrap/css/*.css')
            .pipe(cleanCSS())
            .pipe(concat('bootstrap-all.min.css'))
            .pipe(gulp.dest('dist/css'));
});

gulp.task('copy', function () {
    return es.merge([
        gulp.src('_app/**').pipe(gulp.dest('dist/_app')),
        gulp.src('_lib/cdn/**').pipe(gulp.dest('dist/cdn')),
        gulp.src('admin/**').pipe(gulp.dest('dist/admin')),
        gulp.src('api/**').pipe(gulp.dest('dist/api')),
        gulp.src('ftp/images/**').pipe(gulp.dest('dist/ftp/images')),
        gulp.src('include/**').pipe(gulp.dest('dist/include')),
        gulp.src('themes/**').pipe(gulp.dest('dist/themes')),
        gulp.src('uploads/**').pipe(gulp.dest('dist/uploads')),
        gulp.src('css/**').pipe(gulp.dest('dist/css')),
        gulp.src('.htaccess').pipe(gulp.dest('dist/')),
        gulp.src('*.php*').pipe(gulp.dest('dist/'))
    ]);
});

gulp.task('default', function (cb) {
    return runSequence('clean', ['jshint', 'uglify', 'cssmin', 'copy'], cb);
});
    