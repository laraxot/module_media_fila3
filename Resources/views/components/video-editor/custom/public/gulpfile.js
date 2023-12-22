
var gulp = require('gulp');
var uglify = require('gulp-uglify');
var pump = require('pump');
var rename = require("gulp-rename");
var cleanCSS = require('gulp-clean-css');
var copy = require('gulp-contrib-copy');
var concat = require('gulp-concat');

gulp.task('js', function (cb) {
    gulp.src([
            'lib/jquery/dist/jquery.js',
            'lib/jquery-ui/jquery-ui.js',
            'lib/popper.js/dist/umd/popper.min.js',
            'lib/bootstrap/dist/js/bootstrap.js',
            'lib/underscore/underscore.js',
            'lib/jquery-mask-plugin/dist/jquery.mask.min.js',
            'lib/nouislider/distribute/nouislider.min.js',
            'assets/js/webvideoedit.js'
        ])
        .pipe(concat('js_app.js'))
        .pipe(uglify())
        .pipe(rename('app.min.js'))
        .pipe(gulp.dest('assets/js'))
        .on('end', cb);
});

gulp.task('watch', function (cb) {

    gulp.watch('assets/js/webvideoedit.js', ['js']);

});

gulp.task('default', gulp.parallel('js'));
