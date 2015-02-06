module.exports = function (grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        uglify: {
            ppma: {
                files: {
                    'js/ppma.min.js': [
                        'js/pagenav.js',
                        'js/import.js',
                        'js/login.js',
                        'js/sidebar.js',
                        'js/toggle-password.js',
                        'js/toggle-search.js',
                        'js/typeahead.js',
                        'js/update-entry.js',
                        'js/upload.js',
                        'js/copy-to-clipboard.js'
                    ]
                }
            }
        },
        clean: {
            release: [
                '<%= pkg.name %>-<%= pkg.version %>/vendor/yiisoft/yii/build',
                '<%= pkg.name %>-<%= pkg.version %>/vendor/yiisoft/yii/demos',
                '<%= pkg.name %>-<%= pkg.version %>/vendor/yiisoft/yii/docs',
                '<%= pkg.name %>-<%= pkg.version %>/vendor/yiisoft/yii/requirements',
                '<%= pkg.name %>-<%= pkg.version %>/vendor/yiisoft/yii/tests',
                '<%= pkg.name %>-<%= pkg.version %>/vendor/yiisoft/yii/.gitignore',
                '<%= pkg.name %>-<%= pkg.version %>/vendor/yiisoft/yii/.mailmap',
                '<%= pkg.name %>-<%= pkg.version %>/vendor/yiisoft/yii/.travis.yml',
                '<%= pkg.name %>-<%= pkg.version %>/vendor/yiisoft/yii/CHANGELOG',
                '<%= pkg.name %>-<%= pkg.version %>/vendor/yiisoft/yii/composer.json',
                '<%= pkg.name %>-<%= pkg.version %>/vendor/yiisoft/yii/CONTRIBUTING.md',
                '<%= pkg.name %>-<%= pkg.version %>/vendor/yiisoft/yii/README',
                '<%= pkg.name %>-<%= pkg.version %>/vendor/yiisoft/yii/README.md',
                '<%= pkg.name %>-<%= pkg.version %>/vendor/yiisoft/yii/UPGRADE',
                '<%= pkg.name %>-<%= pkg.version %>/vendor/composer',
                '<%= pkg.name %>-<%= pkg.version %>/vendor/bin',
                '<%= pkg.name %>-<%= pkg.version %>/vendor/autoload.php',
                '<%= pkg.name %>-<%= pkg.version %>/assets/*',
                '<%= pkg.name %>-<%= pkg.version %>/protected/yiic',
                '<%= pkg.name %>-<%= pkg.version %>/protected/yiic.bat',
                '<%= pkg.name %>-<%= pkg.version %>/protected/yiic.php',
                '<%= pkg.name %>-<%= pkg.version %>/protected/commands/',
                '<%= pkg.name %>-<%= pkg.version %>/protected/messages/',
                '<%= pkg.name %>-<%= pkg.version %>/protected/migrations/',
                '<%= pkg.name %>-<%= pkg.version %>/protected/runtime/*',
                '<%= pkg.name %>-<%= pkg.version %>/protected/tests/'
            ],
            cleanup: [
                '<%= pkg.name %>-<%= pkg.version %>/'
            ]
        },
        compress: {
            zip: {
                options: {
                    archive: '<%= pkg.name %>-<%= pkg.version %>.zip'
                },
                expand: true,
                src: ['<%= pkg.name %>-<%= pkg.version %>/**'],
                dest: '/'
            },
            tar: {
                options: {
                    archive: '<%= pkg.name %>-<%= pkg.version %>.tar.gz'
                },
                expand: true,
                src: ['<%= pkg.name %>-<%= pkg.version %>/**'],
                dest: '/'
            }
        },
        copy: {
            bower: {
                files: [
                    {
                        expand: true,
                        cwd: 'bower_components/',
                        src: [
                            'zeroclipboard/dist/ZeroClipboard.min.map',
                            'zeroclipboard/dist/ZeroClipboard.min.js',
                            'zeroclipboard/dist/ZeroClipboard.swf'
                        ],
                        dest: './js/'
                    }
                ]
            },
            release: {
                files: [
                    {
                        expand: true,
                        src: [
                            'assets/**',
                            'css/**',
                            'js/zeroclipboard/dist/ZeroClipboard.min.map',
                            'js/zeroclipboard/dist/ZeroClipboard.min.js',
                            'js/zeroclipboard/dist/ZeroClipboard.swf',
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
                        dest: '<%= pkg.name %>-<%= pkg.version %>/'
                    }
                ]
            }
        },
        touch: {
            options: {
                force: true,
                mtime: true
            },
            release: {
                src: [
                    '<%= pkg.name %>-<%= pkg.version %>/assets/ignore',
                    '<%= pkg.name %>-<%= pkg.version %>/protected/runtime/ignore'
                ]
            }
        }
    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-touch');

    // Default task(s).
    grunt.registerTask('default', ['copy:bower', 'uglify']);
    grunt.registerTask('release', ['uglify', 'copy:bower', 'copy:release', 'clean:release', 'touch:release', 'compress:zip', 'compress:tar', 'clean:cleanup']);
};