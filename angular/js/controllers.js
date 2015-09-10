'use strict';

/* Controllers */

function homeList($scope, $http) {
  $http.get('http://zisheng.org/home_data.php').success(function(data) {
    $scope.home = data;
  });
}
