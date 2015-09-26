angular.module('ppma').directive('ppmaCategoryUpdateButton', [

  '$rootScope', 'DaoService'
  ($rootScope, DaoService) ->

    templateUrl: 'views/category/_update-button.html'

    scope:
      model: '=ngModel'

    link: (scope) ->
      # hide modal
      scope.showModal = false

      # save model
      scope.save = ->
        DaoService.Category.update(scope.model, ->
          # fire event
          $rootScope.$broadcast('CategoriesUpdated')

          # hide modal
          scope.showModal = false
        )

])
