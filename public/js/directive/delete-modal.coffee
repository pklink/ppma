angular.module('ppma').directive('ppmaDeleteModal', [

  '$sce'
  ($sce) ->

    templateUrl: 'views/_modal.html'

    scope:
      header:  '@'
      message: '@'
      delete:  '&'

    link: (scope, el) ->
      # set default values
      scope.showModal = false

      # pass message to scope
      scope.trustedMessage = $sce.trustAsHtml(scope.message)

      # configure modal
      modalEl = el.find('.ui.modal')
      modalEl.modal('setting', 'closable', false)

      # show modal
      scope.show = ->
        scope.showModal = true

      # hide modal
      scope.hide = ->
        scope.showModal = false

      # delete model
      scope.approve = ->
        scope.delete()
        scope.hide()

      # watcher for visibility
      scope.$watch('showModal', (v) ->
        if v then modalEl.modal('show')
        else modalEl.modal('hide')
      )

])