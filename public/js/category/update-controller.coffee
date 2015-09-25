angular.module('ppma').controller('CategoryUpdateController', [

  '$scope', '$location', 'model',
  ($scope,   $location,   model) ->

    $scope.model = model

    $scope.save = ->
      $scope.model.$update(->
        $location.url('/categories')
      )

])