var elixir = require('laravel-elixir');
var gulp = require('gulp');

elixir(function(mix) {
    mix.less('app.less');
});