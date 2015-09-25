angular.module('ppma').controller('CategoryUpdateController', [

  '$scope', '$rootScope', '$location', 'model',
  ($scope,   $rootScope,   $location,   model) ->

    $scope.model = model

    $scope.save = ->
      $scope.model.$update(->
        # send update event
        $rootScope.$broadcast('CategoriesUpdated')

        # redirect
        $location.url('/categories')
      )

])