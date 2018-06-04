const gulp = require('gulp');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');

var files_to_watch = './assets/scss/**/*.scss';
var input = './assets/scss/main.scss';
var output = './assets/css';
var sourcemaps_output = './assets/css/maps';
var sassOptions = {
  errLogToConsole: true,
  outputStyle: 'compressed'
};

gulp.task('sass', function () {
  return gulp
    .src(input)
    .pipe(sourcemaps.init())
    .pipe(sass(sassOptions).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(sourcemaps.write(sourcemaps_output))
    .pipe(gulp.dest(output));
});

gulp.task('watch', function() {
  return gulp
    .watch(files_to_watch, ['sass'])
    .on('change', function(event) {
      console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
    });
});

gulp.task('default', ['sass']);

