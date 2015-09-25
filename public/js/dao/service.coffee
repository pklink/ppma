angular.module('ppma').factory('DaoService', [

  'CategoryDao',
  (CategoryDao) ->

    Category: CategoryDao

])