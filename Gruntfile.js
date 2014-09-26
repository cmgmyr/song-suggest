module.exports = function (grunt) {

    //Initializing the configuration object
    grunt.initConfig({

        // Task configuration
        copy: {
            main: {
                files: [
                    {
                        expand: true,
                        cwd: 'bower_components/bootstrap/fonts/',
                        src: '**',
                        dest: 'public/assets/fonts/',
                        flatten: true,
                        filter: 'isFile'
                    },
                    {
                        expand: true,
                        cwd: 'bower_components/fontawesome/fonts/',
                        src: '**',
                        dest: 'public/assets/fonts/',
                        flatten: true,
                        filter: 'isFile'
                    }
                ]
            }
        },
        less: {
            development: {
                options: {
                    compress: true  //minifying the result
                },
                files: {
                    //compiling frontend.less into frontend.css
                    "./public/assets/css/frontend.css": "./src/assets/less/frontend.less"
                }
            }
        },
        concat: {
            options: {
                separator: ';'
            },
            js_frontend: {
                src: [
                    './bower_components/jquery/dist/jquery.js',
                    './bower_components/bootstrap/dist/js/bootstrap.js',
                    './src/assets/js/base.js',
                    './src/assets/js/frontend.js'
                ],
                dest: './public/assets/js/frontend.js'
            }
        },
        uglify: {
            options: {
                mangle: false  // Use if you want the names of your functions and variables unchanged
            },
            frontend: {
                files: {
                    './public/assets/js/frontend.js': './public/assets/js/frontend.js'
                }
            }
        },
        phpunit: {
            classes: {
                'dir': 'tests/phpunit'
            },
            options: {
                bin: 'vendor/bin/phpunit',
                configuration: 'phpunit.xml'
            }
        },
        watch: {
            js_frontend: {
                files: [
                    //watched files
                    './bower_components/jquery/dist/jquery.js',
                    './bower_components/bootstrap/dist/js/bootstrap.js',
                    './src/assets/js/base.js',
                    './src/assets/js/frontend.js'
                ],
                tasks: ['concat:js_frontend', 'uglify:frontend'], //tasks to run
                options: {
                    livereload: true //reloads the browser
                }
            },
            less: {
                files: ['./src/assets/less/*.less'], //watched files
                tasks: ['less'], //tasks to run
                options: {
                    livereload: true //reloads the browser
                }
            }
            /*,tests: {
             files: ['src/Controllers/*.php', 'src/Controllers/Admin/*.php', 'src/Models/*.php'], //the task will run only when you save files in this location
             tasks: ['phpunit']
             }*/
        }
    });

    // Plugin loading
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-phpunit');
    grunt.loadNpmTasks('grunt-contrib-copy');

    // Task definition
    grunt.registerTask('init', ['copy', 'less', 'concat', 'uglify']);
    grunt.registerTask('default', ['watch']);

};
