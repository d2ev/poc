const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));

gulp.task('default', function () {
  return gulp.src('style.scss') // Source folder
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('.')); // Destination folder
});

gulp.task('watch', function () {
  gulp.watch('style.scss', gulp.series('sass'));
  gulp.watch('scss/*.scss', gulp.series('sass'));
});
