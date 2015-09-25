angular.module('ppma').controller('CategoryIndexController', [

  '$scope', '$location', '$routeParams', '$route', 'DaoService', 'page',
  ($scope,   $location,   $routeParams,   $route,   DaoService,   page) ->

    # pass models to scope
    $scope.models = page.data

    # sort table
    $scope.sort = (param) ->
      direction = if $routeParams.s == param and $routeParams.d != 'desc' then 'desc' else 'asc'
      $location.search(s: param, d: direction)

    $scope.delete = (id) ->
      DaoService.Category.delete(id: id, ->
        $route.reload()
      )

])