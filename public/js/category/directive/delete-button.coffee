angular.module('ppma').directive('ppmaCategoryDeleteButton', [

  '$rootScope',  'DaoService'
  ($rootScope,   DaoService) ->

    templateUrl: 'views/category/_delete-button.html'

    scope:
      model: '=ngModel'

    link: (scope) ->
      # hide modal
      scope.showModal = false

      # delete category
      scope.delete = (id) ->

        DaoService.Category.delete(id: id, ->
          # send update event
          $rootScope.$broadcast('CategoriesUpdated')

          # close modal
          scope.showModal = false
        )


])
