var gulp = require('gulp');
var rename = require('gulp-rename');
var minifycss = require('gulp-minify-css');
var sass = require('gulp-sass');

gulp.task('css', function(){
	return gulp.src('Assets/Admin/stile.scss')
	.pipe(sass())
	.pipe(minifycss())
	.pipe(rename('admin.css'))
	.pipe(gulp.dest('Assets/'));
});

gulp.task('watch', function() {
    gulp.watch('Assets/Admin/*.scss', ['css'])
});

gulp.task('default', ['css', 'watch']);