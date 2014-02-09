module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
            ppma: {
                files: {
                    'js/ppma.min.js': [
                        'js/import.js',
                        'js/login.js',
                        'js/sidebar.js',
                        'js/toggle-password.js',
                        'js/toggle-search.js',
                        'js/typeahead.js',
                        'js/update-entry.js',
                        'js/upload.js'
                    ]
                }
            }
        },
        clean: [
            'vendor/yiisoft/yii/build',
            'vendor/yiisoft/yii/demos',
            'vendor/yiisoft/yii/docs',
            'vendor/yiisoft/yii/requirements',
            'vendor/yiisoft/yii/tests',
            'vendor/yiisoft/yii/.gitignore',
            'vendor/yiisoft/yii/.mailmap',
            'vendor/yiisoft/yii/.travis.yml',
            'vendor/yiisoft/yii/CHANGELOG',
            'vendor/yiisoft/yii/composer.json',
            'vendor/yiisoft/yii/CONTRIBUTING.md',
            'vendor/yiisoft/yii/README',
            'vendor/yiisoft/yii/README.md',
            'vendor/yiisoft/yii/UPGRADE',
            'vendor/composer',
            'vendor/bin',
            'vendor/autoload.php',
            'assets/*'
        ]
    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-clean');

    // Default task(s).
    grunt.registerTask('default', ['clean', 'uglify']);

};