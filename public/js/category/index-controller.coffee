angular.module('ppma').controller('CategoryIndexController', [

  '$scope', '$location', '$routeParams', 'DaoService', 'page',
  ($scope,   $location,   $routeParams,   DaoService,   page) ->

    $scope.sort = (param) ->
      direction = if $routeParams.s == param and $routeParams.d != 'desc' then 'desc' else 'asc'
      $location.search(s: param, d: direction)

    $scope.models = page.data

])