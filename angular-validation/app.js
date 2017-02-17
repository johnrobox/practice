    // create angular app
    var validationApp = angular.module('validationApp', []);

    // create angular controller
    validationApp.controller('mainController', function($scope, $http) {

        // function to submit the form after all validation has occurred            
        $scope.submitForm = function() {

            if ($scope.userForm.$valid) {
                $http.post('http://practice.com/angular-validation/insert.php', $scope.user)
                .success(function(data){
                    alert(data);
                });
                // $http({
                //       method  : 'POST',
                //       url     : 'http://practice.com/angular-validation/insert.php',
                //       data    : $scope.user, //forms user object
                //       headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
                // })
                // .success(function(data) {
                //     alert(data);
                // });
            }

        };

    });