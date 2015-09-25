angular.module('ppma').controller('CategoryIndexController', [

  '$scope', 'page',
  ($scope,   page) ->

    $scope.models = page.data

])