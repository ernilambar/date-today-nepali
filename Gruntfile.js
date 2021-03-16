module.exports = function(grunt) {

	grunt.initConfig({
		wp_deploy: {
			deploy: {
				options: {
					plugin_slug: 'date-today-nepali',
					svn_user: 'rabmalin',
					build_dir: 'deploy/date-today-nepali',
					assets_dir: 'plugin-assets'
				},
			}
		},
	});

	grunt.loadNpmTasks('grunt-wp-deploy');
};


