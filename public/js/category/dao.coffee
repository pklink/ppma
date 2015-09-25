angular.module('ppma').factory('CategoryDao', [

  '$resource',
  ($resource) ->

    $resource('/api/categories/:id', id: '@id',
      query:
        isArray: false
      update:
        method: 'PUT'
    )

])