/*jshint node:true */
'use strict';

module.exports = function(grunt) {
    grunt.config.merge({
        exec: {
            import_database: {
                cwd: '../',
                cmd: function() {
                    return 'vagrant ssh -c \'/vagrant/bin/import_db.sh\'';
                }
            }
        }
    });

    grunt.registerTask('importDatabase', [
        'exec:import_database'
    ]);
};
