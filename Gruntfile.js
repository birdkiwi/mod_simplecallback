module.exports = function(grunt) {

// Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON( 'package.json' ),

// Clean the build folder
        clean: {
            build: {
                src: ['build/**', 'build-zip']
            }
        },
// Copy to build folder
        copy: {
            module: {
                expand: true,
                cwd: 'modules/mod_simplecallback/',
                src: ['**'],
                dest: 'build/'
            },
            media: {
                expand: true,
                src: ['media/mod_simplecallback/**'],
                dest: 'build/'
            },
            languageEn: {
                expand: true,
                src: ['language/en-GB/en-GB.mod_simplecallback.ini', 'language/en-GB/en-GB.mod_simplecallback.sys.ini'],
                dest: 'build/'
            },
            languageRu: {
                expand: true,
                src: ['language/ru-RU/ru-RU.mod_simplecallback.ini', 'language/ru-RU/ru-RU.mod_simplecallback.sys.ini'],
                dest: 'build/'
            }
        },
// Compress the build folder into an upload-ready zip file
        compress: {
            module: {
                options: {
                    archive: 'build-zip/<%= pkg.name %>-<%= pkg.version %>.zip'
                },
                files: [
                    {expand: true, cwd: 'build/', src: ['**']}
                ]
            }
        }
    });

// Load all grunt plugins here
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-compress');

// Build task
    grunt.registerTask( 'build', [
        'clean:build',
        'copy:module',
        'copy:media',
        'copy:languageEn',
        'copy:languageRu',
        'compress:module'
    ]);

};