var gulp = require('gulp'),
	$ = require('gulp-load-plugins')();

gulp.task('scss', function() {
	gulp.src([
		'./styles/**/*.scss',
		'./styles/*.scss'
	])
	.pipe($.sass())
	.pipe($.autoprefixer())
	.pipe($.minifyCss())
	.pipe(gulp.dest('./'))
});

gulp.task('watch', function() {
	gulp.watch([
		'./styles/**/*.scss',
		'./styles/*.scss'
	], ['scss'])
});

gulp.task('default', ['scss'], function() {

});
