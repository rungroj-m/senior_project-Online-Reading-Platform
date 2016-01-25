var gulp = require('gulp');
var cast = require('gulp-phoenixdown');

var build = ['browserify', 'template'];
var postBuild = ['version'];

gulp.task('default', build.concat(postBuild));

//Build
gulp.task('browserify', cast.browserify('./resources/assets/js/app.js').to('public/js/'));
gulp.task('template', cast.angularTemplateCache('./resources/assets/templates/**/*.html').to('public/js'));

//Post-Build
gulp.task('version', build, cast.version([
  './public/js/app.js',
  './public/js/templates.js',
]).to('public/build'));