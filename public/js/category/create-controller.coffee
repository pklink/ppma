angular.module('ppma').controller('CategoryCreateController', [

  '$scope', '$rootScope', '$location', 'DaoService',
  ($scope,   $rootScope,   $location,   DaoService) ->

    $scope.model = new DaoService.Category()

    $scope.save = ->
      $scope.model.$save(->
        # send update event
        $rootScope.$broadcast('CategoriesUpdated')

        $location.url('/categories')
      )

])