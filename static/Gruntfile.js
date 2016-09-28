/*jshint node:true, laxbreak:true */
'use strict';

module.exports = function(grunt) {

    // All builds are considered to be development builds, unless they're not.
    grunt.option('dev', !grunt.option('stage') && !grunt.option('prod'));

    grunt.initConfig({
        // Load `package.json`so we have access to the project metadata such as name and version number.
        pkg: require('./package.json'),

        // Load `build-env.js`so we have access to the project environment configuration and constants.
        env: require('./env'),

        // Removes generated files and directories. Useful for rebuilding with fresh copies of everything.
        clean: {
            options: {
                force: '<%= env.UNSAFE_MODE %>'
            },
            dest: ['<%= env.DIR_DEST %>'],
            theme: ['<%= env.DIR_THEME %>'],
            docs: ['<%= env.DIR_DOCS %>'],
            tmp: ['<%= env.DIR_TMP %>'],
            installed: [
                'tools/node-*',
                '<%= env.DIR_BOWER %>',
                '<%= env.DIR_NPM %>'
            ]
        },

        // Watches files and directories changes and runs associated tasks automatically.
        // For LiveReload, download browser extension at http://go.livereload.com/extensions
        watch: {
            options: {
                livereload: {
                    // Default port for LiveReload
                    // *Will not work if multiple users run using the same port on a shared server*
                    port: 35729
                }
            },
            watchVendor: {
                files: ['<%= env.DIR_BOWER %>/**/*'],
                tasks: [
                    'buildScripts',
                    'buildStyles'
                ]
            },
            watchMarkup: {
                files: [
                    '<%= env.DIR_SRC %>/**/*.html'
                ],
                tasks: ['buildMarkup', 'buildStyleguide']
            },
            watchStatic: {
                files: [
                    '<%= env.DIR_SRC %>/**/.htaccess',
                    '<%= env.DIR_SRC %>/**/*.{php,rb,py,jsp,asp,aspx,cshtml,txt}',
                    '<%= env.DIR_SRC %>/assets/media/**',
                ],
                tasks: ['buildStatic']
            },
            watchStyles: {
                files: [
                    '<%= env.DIR_SRC %>/assets/scss/**/*',
                    '<%= env.DIR_SRC %>/styleguide-assets/**/*.css'
                ],
                tasks: ['buildStyles', 'buildStyleguide', 'disperseAssets']
            },
            watchScripts: {
                files: ['<%= env.DIR_SRC %>/assets/scripts/**/*'],
                tasks: ['buildScripts', 'buildStyleguide', 'disperseAssets']
            }
        }
    });


    // -- Tasks ----------------------------------------------------------------

    grunt.registerTask('default', 'Run default tasks for the target environment.',
        // Ran `grunt`
        grunt.option('dev')   ? ['build'] :

        // Ran `grunt --stage`
        grunt.option('stage') ? ['lint', 'build'] :

        // Ran `grunt --prod`
        grunt.option('prod')  ? ['lint', 'build', 'docs'] : []
    );
    grunt.registerTask(
        'build',
        'Compile source code and outputs to destination.',
        ['clean:dest', 'clean:theme', 'generateIcons', 'buildStatic', 'buildMarkup', 'buildStyles', 'buildScripts', 'buildTheme', 'buildStyleguide', 'disperseAssets', 'clean:tmp']
    );
    grunt.registerTask(
        'docs',
        'Generate documentation.',
        ['clean:docs', 'docsScripts', 'clean:tmp']
    );
    grunt.registerTask(
        'lint',
        'Validate code syntax.',
        ['lintScripts']
    );
    grunt.registerTask(
        'inject',
        'Inject 3rd-party library references from bower.json into source code.',
        ['injectStyles', 'injectScripts']
    );

    grunt.registerTask(
        'optimize',
        'Optimize static assets.',
        ['optimizeStatic']
    );

    grunt.registerTask(
        'import_db',
        'Import current fixture database dump',
        ['importDatabase']
    );

    grunt.loadNpmTasks('grunt-contrib-watch');

}