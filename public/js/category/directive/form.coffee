angular.module('ppma').directive('ppmaCategoryForm', [

  ->

    templateUrl: 'views/category/_form.html'

    scope:
      model: '=ngModel'
      submit: '&'

    link: (scope, el) ->

      console.log(scope.form)

      # autofocus first input
      el.find(':input:first').focus()

      scope.validate = ->
        if scope.form.$valid then scope.submit()


])
