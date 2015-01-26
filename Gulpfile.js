var gulp = require('gulp');
var $ = require('gulp-load-plugins')();

gulp.task('styles', function() {
	gulp.src([
		'./styles/scss/**/*.scss',
		'./styles/scss/*.scss'
	])
	.pipe($.sass())
	.pipe($.autoprefixer())
	.pipe($.minifyCss())
	.pipe($.rename({
		suffix: '.min'
	}))
	.pipe(gulp.dest('./styles'))
});

gulp.task('watch', function() {
	gulp.watch([
		'./styles/scss/**/*.scss',
		'./styles/scss/*.scss'
	], ['styles'])
});

gulp.task('default', ['styles'], function() {

});
