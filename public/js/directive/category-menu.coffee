angular.module('ppma').directive('ppmaCategoryMenu', [

  '$interval', 'DaoService'
  ($interval,   DaoService) ->

    templateUrl: 'views/_category-menu.html'

    scope:
      limit: '@'

    link: (scope, el) ->
      # dimming control
      dimmer =
        enable: ->
          el.find('.dimmer').dimmer('show')
        disable: ->
          el.find('.dimmer').dimmer('hide')

      # load function
      load = (showDimmer = true) ->
        # enable dimmer
        if showDimmer then dimmer.enable()

        # load categories
        DaoService.Category.query(s: 'name', d: 'asc', (page) ->
          scope.models = page.data
          dimmer.disable();
        )

      # listen for update events
      scope.$on('CategoriesUpdated', load)

      # inital load
      load()

      # reload every 5 secons
      $interval((-> load(false)), 5000)

])