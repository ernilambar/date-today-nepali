const path = require( 'path' );

const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );

module.exports = {
	...defaultConfig,
	entry: {
		index: path.resolve( __dirname, 'src', 'index.js' ),
		posts: path.resolve( __dirname, 'src', 'posts.js' ),
	},
};
