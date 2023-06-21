<?php
/**
 * Admin
 *
 * @package Date_Today_Nepali
 */

namespace DateTodayNepali\Admin;

use DateTodayNepali\Common\Utils;
use Nilambar\AdminNotice\Notice;
use Nilambar\Welcome\Welcome;

/**
 * Admin class.
 *
 * @since 1.0.0
 */
class Admin {
	/**
	 * Register.
	 *
	 * @since 2.3.8
	 */
	public function register() {
		add_action( 'admin_init', array( $this, 'add_admin_notice' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_assets' ) );
		add_action( 'wp_welcome_init', array( $this, 'add_welcome_page' ) );
		add_filter( 'plugin_action_links_' . DATE_TODAY_NEPALI_BASE_FILENAME, array( $this, 'plugin_links' ) );

		add_action( 'wp_ajax_nopriv_dtn_nsbl_get_posts', array( $this, 'get_posts_ajax_callback' ) );
		add_action( 'wp_ajax_dtn_nsbl_get_posts', array( $this, 'get_posts_ajax_callback' ) );
	}

	/**
	 * Add welcome page.
	 *
	 * @since 2.4.3
	 */
	public function add_welcome_page() {
		$obj = new Welcome( 'plugin', 'date-today-nepali' );

		$obj->set_page(
			array(
				'page_title'    => esc_html__( 'Date Today Nepali', 'date-today-nepali' ),
				/* translators: %s: Version */
				'page_subtitle' => sprintf( esc_html__( 'Version: %s', 'date-today-nepali' ), DATE_TODAY_NEPALI_VERSION ),
				'menu_title'    => esc_html__( 'Date Today Nepali', 'date-today-nepali' ),
				'menu_slug'     => 'date-today-nepali-welcome',
			)
		);

		$obj->set_quick_links(
			array(
				array(
					'text' => 'Get Support',
					'url'  => 'https://wordpress.org/support/plugin/date-today-nepali/#new-post',
					'type' => 'primary',
				),
				array(
					'text' => 'Leave a Review',
					'url'  => 'https://wordpress.org/support/plugin/date-today-nepali/reviews/#new-post',
					'type' => 'secondary',
				),
			)
		);

		$obj->add_tab(
			array(
				'id'    => 'getting-started',
				'title' => 'Getting Started',
				'type'  => 'grid',
				'items' => array(
					array(
						'title'       => 'Using Widget',
						'icon'        => 'dashicons dashicons-megaphone',
						'description' => "<ol>
															<li>Go to Appearance -> Widgets</li>
															<li>Find 'Date Display Widget'</li>
															<li>Add the widget to the sidebar you want to use.</li>
															<li>Customize the widget options and we are good to go.</li>
														</ol>",
					),
					array(
						'title'       => 'Get Support',
						'icon'        => 'dashicons dashicons-sos',
						'description' => 'Got some question or found bug or got some feedbacks? Please visit support forum in the WordPress.org directory.',
						'button_text' => 'Visit Support',
						'button_url'  => 'https://wordpress.org/support/plugin/date-today-nepali/#new-post',
						'button_type' => 'secondary',
						'is_new_tab'  => true,
					),
					array(
						'title'       => 'Our Plugins',
						'icon'        => 'dashicons dashicons-admin-plugins',
						'description' => '<ul>
															<li><a href="https://wpconcern.com/plugins/woocommerce-product-tabs/" target="_blank">WooCommerce Product Tabs</a></li>
															<li><a href="https://wpconcern.com/plugins/nifty-coming-soon-and-under-construction-page/" target="_blank">Coming Soon &amp; Maintenance Mode Page</a></li>
															<li><a href="https://wpconcern.com/plugins/post-grid-elementor-addon/" target="_blank">Post Grid Elementor Addon</a></li>
															<li><a href="https://wpconcern.com/plugins/advanced-google-recaptcha/" target="_blank">Advanced Google reCAPTCHA</a></li>
															<li><a href="https://wpconcern.com/plugins/majestic-before-after-image/" target="_blank">Majestic Before After Image</a></li>
															<li><a href="https://wpconcern.com/plugins/admin-customizer/" target="_blank">Admin Customizer</a></li>
															<li><a href="https://wordpress.org/plugins/prime-addons-for-elementor/" target="_blank">Prime Addons for Elementor</a></li>
															</ul>',
					),
					array(
						'title'       => 'Our Themes',
						'icon'        => 'dashicons dashicons-desktop',
						'description' => '<ul>
															<li><a href="https://wordpress.org/themes/simple-life/" target="_blank">Simple Life</a></li>
															<li><a href="https://wordpress.org/themes/obulma/" target="_blank">Obulma</a></li>
															<li><a href="https://wordpress.org/themes/blue-planet/" target="_blank">Blue Planet</a></li>
														</ul>',
					),

				),
			)
		);

		$obj->set_sidebar(
			array(
				'render_callback' => array( $this, 'render_sidebar' ),
			)
		);

		$obj->run();
	}

	/**
	 * Render welcome sidebar.
	 *
	 * @since 2.4.3
	 *
	 * @param Welcome $welcome_object Instance of Welcome.
	 */
	public function render_sidebar( $welcome_object ) {
		$welcome_object->render_sidebar_box(
			array(
				'title'        => 'Leave a Review',
				'content'      => $welcome_object->get_stars() . sprintf( 'Are you enjoying %s? We would appreciate a review.', $welcome_object->get_name() ),
				'button_text'  => 'Submit Review',
				'button_url'   => 'https://wordpress.org/support/plugin/date-today-nepali/reviews/#new-post',
				'button_class' => 'button',
			),
			$welcome_object
		);

		$welcome_object->render_sidebar_box(
			array(
				'title'   => 'Recent Blog Posts',
				'content' => '<div id="dtn-posts-app"></div>',
			),
			$welcome_object
		);
	}

	/**
	 * Add admin notice.
	 *
	 * @since 2.3.8
	 */
	public function add_admin_notice() {
		Notice::init(
			array(
				'slug' => 'date-today-nepali',
				'name' => esc_html__( 'Date Today Nepali', 'date-today-nepali' ),
			)
		);
	}

	/**
	 * Customize plugin action links.
	 *
	 * @since 2.3.8
	 *
	 * @param array $actions Action links.
	 * @return array Modified action links.
	 */
	public function plugin_links( $actions ) {
		$url = add_query_arg(
			array(
				'page' => 'date-today-nepali-welcome',
			),
			admin_url( 'options-general.php' )
		);

		$actions = array_merge(
			array(
				'welcome' => '<a href="' . esc_url( $url ) . '">' . esc_html__( 'Welcome', 'date-today-nepali' ) . '</a>',
			),
			$actions
		);

		return $actions;
	}

	/**
	 * Load assets.
	 *
	 * @since 2.4.3
	 *
	 * @param string $hook Hook name.
	 */
	public function load_assets( $hook ) {
		if ( 'settings_page_date-today-nepali-welcome' !== $hook ) {
			return;
		}

		// Posts.
		$script_asset_path = NS_NEPALI_DATE_DIR . '/build/posts.asset.php';
		$script_asset      = file_exists( $script_asset_path ) ? require $script_asset_path : array(
			'dependencies' => array(),
			'version'      => filemtime( __FILE__ ),
		);

		$data = array(
			'ajax_url'     => admin_url( 'admin-ajax.php' ),
			'posts_action' => 'dtn_nsbl_get_posts',
		);

		wp_enqueue_script( 'date-today-nepali-posts', DATE_TODAY_NEPALI_URL . '/build/posts.js', $script_asset['dependencies'], $script_asset['version'], true );
		wp_localize_script( 'date-today-nepali-posts', 'DTN_POSTS', $data );
	}

	/**
	 * AJAX callback for blog posts.
	 *
	 * @since 2.4.3
	 */
	public function get_posts_ajax_callback() {
		$output = array();

		$posts = Utils::get_blog_feed_items();

		if ( ! empty( $posts ) ) {
			$output = $posts;
		}

		if ( ! empty( $output ) ) {
			wp_send_json_success( $output, 200 );
		} else {
			wp_send_json_error( $output, 404 );
		}
	}

}
