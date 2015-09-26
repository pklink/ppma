angular.module('ppma').directive('ppmaCategoryCreateModal', [

  '$rootScope', 'DaoService'
  ($rootScope, DaoService) ->

    templateUrl: 'views/category/_create-modal.html'

    scope:
      isVisible: '='

    link: (scope, el) ->
      # create model
      scope.model = new DaoService.Category()

      # configure modal
      modalEl = el.find('.ui.modal')
      modalEl.modal('setting', 'closable', false)

      # cancel
      scope.cancel = ->
        # hide modal
        scope.isVisible = false

      # save model
      scope.save = ->
        if scope.form.$valid then scope.model.$save(->
          # fire event
          $rootScope.$broadcast('CategoriesUpdated')

          # hide modal
          scope.isVisible = false
        )

      # watcher for visibility
      scope.$watch('isVisible', (v) ->
        if v then modalEl.modal('show')
        else modalEl.modal('hide')
      )


])
