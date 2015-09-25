app = angular.module('ppma', ['ngResource', 'ngRoute'])

app.config([

  '$routeProvider',
  ($routeProvider) ->

    $routeProvider.when('/categories',
      templateUrl: 'views/category/index.html',
      controller: 'CategoryController'
      resolve:
        page: (ppmaCategory) ->
          ppmaCategory.query().$promise
    ).when('/categories/create',
      templateUrl: 'views/category/create.html',
      controller: 'CategoryCreateController'
      resolve:
        page: (ppmaCategory) ->
          ppmaCategory.query().$promise
    )
])

app.factory('ppmaCategory', [

  '$resource',
  ($resource) ->

    $resource('/api/categories/:id', id: '@id',
      query:
        isArray: false
      update:
        method: 'PUT'
    )

])

app.controller('CategoryController', [

  '$scope', 'page',
  ($scope,   page) ->

    $scope.models = page.data

])

app.controller('CategoryCreateController', [

  '$scope', '$location', 'ppmaCategory', 'page',
  ($scope,   $location,   ppmaCategory,   page) ->

    $scope.model      = new ppmaCategory()
    $scope.categories = page.data

    $scope.save = ->
      $scope.model.$save(->
        $location.url('/categories')
      )

])