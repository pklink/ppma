angular.module('ppma').directive('ppmaDeleteModal', [

  '$sce'
  ($sce) ->

    templateUrl: 'views/_delete-modal.html'

    scope:
      header:    '@'
      message:   '@'
      onDeny:    '&'
      onApprove: '&'
      isVisible: '='

    link: (scope, el) ->
      # pass message to scope
      scope.trustedMessage = $sce.trustAsHtml(scope.message)

      # configure modal
      modalEl = el.find('.ui.modal')
      modalEl.modal('setting', 'closable', false)

      # deny
      scope.deny = ->
        scope.onDeny()

      # approve
      scope.approve = ->
        scope.onApprove()

      # watcher for visibility
      scope.$watch('isVisible', (v) ->
        if v then modalEl.modal('show')
        else modalEl.modal('hide')
      )

])