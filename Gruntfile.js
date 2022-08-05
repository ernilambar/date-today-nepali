require('dotenv').config();
var browserSync = require("browser-sync");

module.exports = function(grunt) {
	'use strict';

	grunt.initConfig({
		pkg: grunt.file.readJSON( 'package.json' ),

		watch: {
			options: {
				spawn: false
			},
			files: '*.php',
			tasks: ['bs-inject']
		},

		wp_deploy: {
			deploy: {
				options: {
					plugin_slug: '<%= pkg.name %>',
					plugin_main_file: '<%= pkg.main_file %>',
					svn_user: 'rabmalin',
					build_dir: 'deploy/<%= pkg.name %>',
					assets_dir: '.wordpress-org',
					deploy_trunk: true,
					deploy_tag: true
				},
			}
		},
		replace : {
			readme: {
				options: {
					patterns: [
						{
							match: /Stable tag:\s?(.+)/gm,
							replacement: 'Stable tag: <%= pkg.version %>'
						}
					]
				},
				files: [
					{
						expand: true, flatten: true, src: ['readme.txt'], dest: './'
					}
				]
			},
			main: {
				options: {
					patterns: [
						{
							match: /Version:\s?(.+)/gm,
							replacement: 'Version: <%= pkg.version %>'
						}
					]
				},
				files: [
					{
						expand: true, flatten: true, src: ['<%= pkg.main_file %>'], dest: './'
					}
				]
			},
			define: {
				options: {
					patterns: [
						{
							match: /define\( \'DATE_TODAY_NEPALI_VERSION\'\, \'(.+)\'/gm,
							replacement: "define( 'DATE_TODAY_NEPALI_VERSION', '<%= pkg.version %>'"
						}
					]
				},
				files: [
					{
						expand: true, flatten: true, src: ['<%= pkg.main_file %>'], dest: './'
					}
				]
			}
		}
	});

	grunt.loadNpmTasks( 'grunt-wp-deploy' );
	grunt.loadNpmTasks( 'grunt-replace' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );

	// Init BrowserSync manually
	grunt.registerTask("bs-init", function () {
		var done = this.async();
		browserSync({
			open: true,
			proxy: process.env.DEV_SERVER_URL,
		}, function (err, bs) {
				done();
		});
	});

	// Inject CSS files to the browser
	grunt.registerTask("bs-inject", function () {
			browserSync.reload();
	});

	grunt.registerTask('dev', ['bs-init', 'watch']);

	grunt.registerTask( 'wpdeploy', [ 'wp_deploy' ] );
	grunt.registerTask( 'version', [ 'replace:readme', 'replace:main', 'replace:define' ] );
};
