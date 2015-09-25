angular.module('ppma').config([

  '$routeProvider',
  ($routeProvider) ->

    $routeProvider.when('/categories',
      templateUrl: 'views/category/index.html'
      controller: 'CategoryIndexController'
      resolve:
        page: (DaoService, $route) ->
          DaoService.Category.query($route.current.params).$promise
    )

    $routeProvider.when('/categories/create',
      templateUrl: 'views/category/create.html'
      controller: 'CategoryCreateController'
    )

    $routeProvider.when('/categories/:id',
      templateUrl: 'views/category/update.html'
      controller: 'CategoryUpdateController'
      resolve:
        model: (DaoService, $route) ->
          DaoService.Category.get(id: $route.current.params.id).$promise
    )

])