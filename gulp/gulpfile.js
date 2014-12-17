var gulp = require ('gulp'),
    notify = require('gulp-notify'),
    livereload = require('gulp-livereload');

gulp.task ('default', function () {
  livereload.listen ();

  ['./root/*.html', './root/css/**/*.css', './root/res/**/*.js', './root/*.php', './root/js/**/*.js'].forEach (function (t) {
    gulp.watch (t).on ('change', function () {
      gulp.run ('reload');
    });
  });
});

gulp.task ('reload', function () {
  livereload.changed ();
  console.info ('\nReLoad Browser!\n');
});