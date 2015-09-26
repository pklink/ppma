angular.module('ppma').controller('CategoryIndexController', [

  '$scope', '$location', '$routeParams', '$route', 'page',
  ($scope,   $location,   $routeParams,   $route,   page) ->

    # pass models to scope
    $scope.models = page.data

    # sort table
    $scope.sort = (param) ->
      direction = if $routeParams.s == param and $routeParams.d != 'desc' then 'desc' else 'asc'
      $location.search(s: param, d: direction)

    # reload on if categories are updated
    $scope.$on('CategoriesUpdated', -> $route.reload())

])