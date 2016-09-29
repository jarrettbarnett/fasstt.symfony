/*jshint node:true, laxbreak:true */
'use strict';

module.exports = function(grunt) {
    grunt.config.merge({
        // Verifies that script files conform to set standards.
        copy: {
            disperseAssets: {
                files: [{
                    expand: true,
                    cwd: '<%= env.DIR_DEST %>/assets',
                    src: [
                        '**'
                    ],
                    dest: '<%= env.DIR_THEME %>'
                }]
            }
        }
    });

    grunt.registerTask('disperseAssets', [
        'copy:disperseAssets'
    ]);
};
