var myApp = angular.module('myApp', []);

myApp.controller("myCtrl", function ($scope) {

	$scope.sum = function (x, y) {
		$scope.addition = parseInt(x) + parseInt(y);
	}

	$scope.sub = function (x, y) {
		$scope.addition = parseInt(x) - parseInt(y);
	}

	$scope.mul = function (x, y) {
		$scope.addition = parseInt(x) * parseInt(y);
	}

	$scope.div = function (x, y) {
		$scope.addition = parseInt(x) / parseInt(y);
	}

});

