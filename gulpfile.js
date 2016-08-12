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

gulp.task('lastClean', ['copy'], function () {
    return gulp.src('dist/include/*/js')
            .pipe(clean());
});

gulp.task('jshint', function () {
    return gulp.src(['js/**/*.js', 'include/*/js/**/*.js', 'themes/intranet/'])
            .pipe(jshint())
            .pipe(jshint.reporter('default'));
});

//'include/*/js/**/*.app.js', 'include/*/js/**/*.value.js', 'include/*/js/**/*.services.js', 'include/*/js/**/*.ctrl.js']
gulp.task('uglify', ['clean'], function () {
    return es.merge([
        gulp.src('_lib/**/*.min.js')
                .pipe(concat('lib.min.js')),
        gulp.src(['js/*.js', 'js/jquery/**/*.js', 'js/google-charts/start.js', 'js/google-charts/*.charts.js',
            'js/angular/**/*.module.js', 'js/angular/**/*.directive.js', 'js/angular/**/*.filter.js', 'js/angular/**/*.services.js'])
                .pipe(uglify({mangle: false}))
                .pipe(concat('all.min.js')),
        gulp.src('include/*/js/**/*.js')
                .pipe(uglify({mangle: false}))
                .pipe(concat('plugins.min.js'))
    ])
            .pipe(gulp.dest('dist/js'));
});

//htmlmin pode ser implementado.

gulp.task('cssmin', function () {
    return es.merge([
        gulp.src('_lib/bootstrap/css/bootstrap.css')
                .pipe(cleanCSS())
                .pipe(concat('bootstrap.min.css')),
        gulp.src('_lib/angular/css/ng-animation.css')
                .pipe(cleanCSS())
                .pipe(concat('ng-animation.min.css'))
    ])
            .pipe(gulp.dest('dist/css'));
});

gulp.task('copy', function () {
    return es.merge([
        gulp.src('_app/**').pipe(gulp.dest('dist/_app')),
        gulp.src('_lib/cdn/**').pipe(gulp.dest('dist/cdn')),
        gulp.src('_lib/bootstrap/fonts/**').pipe(gulp.dest('dist/fonts')),
        gulp.src('_lib/bootstrap/css/bootstrap-*.css').pipe(gulp.dest('dist/css')),
        gulp.src('admin/**').pipe(gulp.dest('dist/admin')),
        gulp.src('api/**').pipe(gulp.dest('dist/api')),
        gulp.src('api/.htaccess').pipe(gulp.dest('dist/api')),
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
    return runSequence('clean', ['jshint', 'uglify', 'cssmin', 'lastClean'], cb);
});
    