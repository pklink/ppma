angular.module('ppma').directive('ppmaCategoryFormModal', [

  '$rootScope'
  ($rootScope) ->

    templateUrl: 'views/category/_form-modal.html'

    scope:
      header:    '@'
      model:     '=ngModel'
      onCancel:  '&'
      onSubmit:  '&'
      isVisible: '='

    link: (scope, el) ->

      # configure modal
      modalEl = el.find('.ui.modal')
      modalEl.modal('setting', 'closable', false)

      # cancel
      scope.cancel = -> scope.onCancel()

      # save model
      scope.submit = -> if scope.form.$valid then scope.onSubmit()

      # watcher for visibility
      scope.$watch('isVisible', (v) ->
        if v then modalEl.modal('show')
        else modalEl.modal('hide')
      )


])
