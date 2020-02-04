module.exports = function( grunt ) {
	'use strict';

	/**
	 * Deploy files list.
	 */
	var deploy_files_list = [
		'core/**',
		'languages/**',
		'lib/**',
		'readme.txt',
		'<%= pkg.main_file %>'
	];

	grunt.initConfig({

		pkg: grunt.file.readJSON( 'package.json' ),

		// Setting folder templates.
		dirs: {
			js: 'js',
			css: 'css',
			images: 'images'
		},

		// Other options.
		options: {
			text_domain: '<%= pkg.name %>'
		},

		// Copy folders.
		clean: {
			deploy: ['deploy']
		},

		// Copy files.
		copy: {
			deploy: {
				src: deploy_files_list,
				dest: 'deploy/<%= pkg.name %>',
				expand: true,
				dot: true
			}
		},

		// Update text domain.
		addtextdomain: {
			options: {
				textdomain: '<%= options.text_domain %>',
				updateDomains: true
			},
			target: {
				files: {
					src: [
					'*.php',
					'**/*.php',
					'!node_modules/**',
					'!vendor/**',
					'!deploy/**',
					'!build/**',
					'!tests/**'
					]
				}
			}
		}

	});

	// Load NPM tasks to be used here.
	grunt.loadNpmTasks( 'grunt-contrib-clean' );
	grunt.loadNpmTasks( 'grunt-contrib-copy' );
	grunt.loadNpmTasks( 'grunt-wp-i18n' );

	// Register tasks.
	grunt.registerTask( 'default', [] );

	grunt.registerTask( 'build', [
		'textdomain'
	]);

	grunt.registerTask( 'textdomain', [
		'addtextdomain'
	]);

	grunt.registerTask( 'deploy', [
		'clean:deploy',
		'copy:deploy'
	]);
};
