require('bootstrap');
require('angular');

var app = angular.module('app', [
	'ngRoute',
	'ngResource',
])

.controller('BooksController', require('./controllers/BooksController'))

.config(function($routeProvider){
	$routeProvider.when('/booktest',{
		templateUrl: 'books/index.html',
		controller: 'BooksController'
	});
});