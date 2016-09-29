/*jshint node:true */
'use strict';

module.exports = function(grunt) {
    grunt.config.merge({
        hologram: {
            generate: {
                options: {
                    config: './hologram_config.yml'
                }
            }
        }
    });

    grunt.registerTask('buildStyleguide', [
        'hologram:generate'
    ]);
};