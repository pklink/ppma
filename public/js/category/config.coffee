angular.module('ppma').config([

  '$routeProvider',
  ($routeProvider) ->

    $routeProvider
      .when('/categories',
        templateUrl: 'views/category/index.html'
        controller: 'CategoryIndexController'
        resolve:
          page: (DaoService) ->
            DaoService.Category.query().$promise
    )

    $routeProvider
      .when('/categories/create',
        templateUrl: 'views/category/create.html'
        controller: 'CategoryCreateController'
    )

])