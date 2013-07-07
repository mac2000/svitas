module.exports = function (grunt) {
    grunt.initConfig({
        less: {
            production: {
                files: {
                    'style.css': 'style.less'
                }
            }
        },
        watch: {
            options: {
                //livereload: true
            },
            less: {
                files: ['*.less', '**/*.less'],
                tasks: ['default']
            }
        }
    });
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.registerTask('default', ['less']);
};
