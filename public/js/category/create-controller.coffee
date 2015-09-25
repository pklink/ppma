angular.module('ppma').controller('CategoryCreateController', [

  '$scope', '$location', 'DaoService',
  ($scope,   $location,   DaoService) ->

    $scope.model = new DaoService.Category()

    $scope.save = ->
      $scope.model.$save(->
        $location.url('/categories')
      )

])