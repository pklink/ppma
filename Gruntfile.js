module.exports = function (grunt) {

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
        clean: {
            release: [
                'release/vendor/yiisoft/yii/build',
                'release/vendor/yiisoft/yii/demos',
                'release/vendor/yiisoft/yii/docs',
                'release/vendor/yiisoft/yii/requirements',
                'release/vendor/yiisoft/yii/tests',
                'release/vendor/yiisoft/yii/.gitignore',
                'release/vendor/yiisoft/yii/.mailmap',
                'release/vendor/yiisoft/yii/.travis.yml',
                'release/vendor/yiisoft/yii/CHANGELOG',
                'release/vendor/yiisoft/yii/composer.json',
                'release/vendor/yiisoft/yii/CONTRIBUTING.md',
                'release/vendor/yiisoft/yii/README',
                'release/vendor/yiisoft/yii/README.md',
                'release/vendor/yiisoft/yii/UPGRADE',
                'release/vendor/composer',
                'release/vendor/bin',
                'release/vendor/autoload.php',
                'release/assets/*',
                'release/protected/yiic',
                'release/protected/yiic.bat',
                'release/protected/yiic.php',
                'release/protected/commands/',
                'release/protected/migrations/',
                'release/protected/runtime/*',
                'release/protected/tests/',
            ]
        },
        compress: {
            zip: {
                options: {
                    archive: '<%= pkg.name %>-<%= pkg.version %>.zip'
                },
                expand: true,
                src: ['release/**'],
                dest: '/'
            },
            tar: {
                options: {
                    archive: '<%= pkg.name %>-<%= pkg.version %>.tar.gz'
                },
                expand: true,
                src: ['release/**'],
                dest: '/'
            }
        },
        copy: {
            release: {
                files: [{
                    expand: true,
                    src: [
                        'assets/**',
                        'css/**',
                        'js/foundation.min.js',
                        'js/jquery-ui-1.9.2.custom.min.js',
                        'js/modernizr.foundation.js',
                        'js/ppma.min.js',
                        'protected/**',
                        'vendor/**',
                        'CHANGELOG',
                        'favicon.ico',
                        'index.php',
                        'LICENSE',
                        'README.md',
                        'robots.txt',
                        'UPGRADE'
                    ],
                    dest: 'release/'
                }]
            }
        }
    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-copy');

    // Default task(s).
    grunt.registerTask('default', ['uglify']);
    grunt.registerTask('release', ['copy:release', 'uglify', 'clean:release', 'compress:zip', 'compress:tar']);
};