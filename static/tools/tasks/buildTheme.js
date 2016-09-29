/*jshint node:true */
'use strict';

module.exports = function(grunt) {
    grunt.config.merge({
        uglify: {
            minRequire: {
                files: {
                    '<%= env.DIR_DEST %>/assets/vendor/requirejs/require.js': ['<%= env.DIR_DEST %>/assets/vendor/requirejs/require.js']
                }
            }
        }
    });

    grunt.registerTask('buildTheme', [
        'uglify:minRequire'
    ]);
};
