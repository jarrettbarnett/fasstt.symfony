/*jshint node:true */
'use strict';

module.exports = function(grunt) {
    grunt.config.merge({
        grunticon: {
            generate: {
                files: [{
                    expand: true,
                    cwd: '<%= env.DIR_SRC %>/assets/media/images/icons/',
                    src: ['*.svg', '*.png'],
                    dest: '<%= env.DIR_SRC %>/assets/media/images/icons/icon-output/'
                }],
                options: {
                    enhanceSVG: true,
                    cssprefix: '.icon_',
                    datasvgcss: 'icons-svg.css',
                    datapngcss: 'icons-png.css'
                }
            }
        },
    });

    grunt.registerTask('generateIcons', [
        'grunticon:generate'
    ]);
};
