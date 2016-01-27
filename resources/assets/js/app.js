global.$ = global.jQuery = require('jquery');

require('bootstrap');
require('angular');
require('angular-route');

var app = angular.module('app', [
	'ngRoute',
])

.controller('BooksController', require('./controllers/BooksController'))

.config(['routeProvider', function($routeProvider){
	$routeProvider

	.when('/test',{
		templateUrl: 'books/index.html',
		controller: 'BooksController',
	});
    
	$locationProvider.html5Mode(true);
}]);