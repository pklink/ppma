angular.module('ppma').directive('ppmaCategoryForm', [

  ->

    templateUrl: 'views/category/_form.html'

    scope:
      model: '=ngModel'
      submit: '&'

    link: (scope) ->

      scope.validate = ->
        if scope.form.$valid then scope.submit()


])
