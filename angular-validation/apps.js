    // create angular app
    var validationApp = angular.module('validationApp', []);

    // create angular controller
    validationApp.controller('mainController', function($scope, $http) {

        // function to submit the form after all validation has occurred            
        $scope.submitForm = function() {

                alert(JSON.stringify($scope.user));

        };

    });