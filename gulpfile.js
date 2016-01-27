var gulp = require('gulp');
var cast = require('gulp-phoenixdown');

var build = ['browserify', 'template', 'less'];
var postBuild = ['version'];

gulp.task('default', build.concat(postBuild));

//Build
gulp.task('browserify', cast.browserify('./resources/assets/js/app.js').to('./public/js/'));
gulp.task('template', cast.angularTemplateCache('./resources/assets/templates/**/*.html').to('./public/js'));
gulp.task('less', cast.all([
  cast.less('./resources/assets/less/app.less').to('public/css'),
  cast.less('./resources/assets/less/front/custom.less').to('public/app/front/css'),
]));

//Post-Build
gulp.task('version', build, cast.version([
  './public/js/app.js',
  './public/js/templates.js',
  './public/css/app.css',
]).to('public/build'));