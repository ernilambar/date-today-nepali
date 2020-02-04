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
		}

	});

	// Load NPM tasks to be used here.
	grunt.loadNpmTasks( 'grunt-contrib-clean' );
	grunt.loadNpmTasks( 'grunt-contrib-copy' );

	// Register tasks.
	grunt.registerTask( 'default', [] );

	grunt.registerTask( 'build', [] );

	grunt.registerTask( 'deploy', [
		'clean:deploy',
		'copy:deploy'
	]);
};
