module.exports = function(grunt) {

	require('load-grunt-tasks')(grunt);

	// Project configuration.
	grunt.initConfig({

		banner: '/* Author: Feel, http://conexionsofia.com, <%= grunt.template.today("isoDateTime") %> */\n',
		// Stylus
		stylus: {
			options: {
				banner: '<%= banner %>',
				use: [
					function() {
						return require('autoprefixer-stylus')('last 2 versions', 'ie 9');

					},
					function(){
						return require('csso-stylus');
					}
				]
			},
			compile: {
				files: {
					'../../deploy/main.css': '../stylus/main.styl'
				}
			}
		},
		// Concat Javascript
		concat: {
			js: {
				src: ['lib/js/*.js'],
				dest: 'final/all.js',
			}
		},
		watch: {
			files: [
				'../stylus/*.styl',
				'../stylus/*/*.styl',
				'../js/*.js',
				'../js/*/*.js'
			],
			tasks: ['stylus', 'concat' ]
		}
	});

	// Default task(s).
	grunt.registerTask('default', ['stylus', 'concat', 'watch']);
};
