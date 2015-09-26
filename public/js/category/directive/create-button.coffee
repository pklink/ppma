angular.module('ppma').directive('ppmaCategoryCreateButton', [

  '$rootScope', 'DaoService'
  ($rootScope,   DaoService) ->

    templateUrl: 'views/category/_create-button.html'

    scope: {}

    link: (scope) ->
      # hide modal
      scope.showModal = false

      # create model
      scope.model = new DaoService.Category()

      # save model
      scope.save = ->
        scope.model.$save(->
          # fire event
          $rootScope.$broadcast('CategoriesUpdated')

          # hide modal
          scope.showModal = false
        )

])
