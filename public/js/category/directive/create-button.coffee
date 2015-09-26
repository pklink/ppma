angular.module('ppma').directive('ppmaCategoryCreateButton', [

  ->

    templateUrl: 'views/category/_create-button.html'

    scope: {}

    link: (scope) ->
      # hide modal
      scope.showModal = false

])
