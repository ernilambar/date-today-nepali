<?php
/**
 * Welcome
 *
 * @package Date_Today_Nepali
 */

namespace DateTodayNepali\Admin;

use DateTodayNepali\Common\Utils;

/**
 * Welcome class.
 *
 * @since 1.0.0
 */
class Welcome {
	/**
	 * Register.
	 *
	 * @since 2.3.8
	 */
	public function register() {
		add_action( 'admin_menu', array( $this, 'add_welcome_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'add_welcome_assets' ) );

		add_action( 'wp_ajax_nopriv_nsbl_get_posts', array( $this, 'get_posts_ajax_callback' ) );
		add_action( 'wp_ajax_nsbl_get_posts', array( $this, 'get_posts_ajax_callback' ) );
	}

	/**
	 * Add welcome menu.
	 *
	 * @since 2.3.8
	 */
	public function add_welcome_menu() {
		add_options_page( esc_html__( 'Date Today Nepali', 'date-today-nepali' ), esc_html__( 'Date Today Nepali', 'date-today-nepali' ), 'manage_options', 'date-today-nepali-welcome', array( $this, 'render_welcome' ) );
	}

	/**
	 * Render welcome page content.
	 *
	 * @since 2.3.8
	 */
	public function render_welcome() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( ! function_exists( 'get_plugin_data' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$plugin_data = get_plugin_data( DATE_TODAY_NEPALI_BASE_FILEPATH );

		$version     = $plugin_data['Version'];
		$description = preg_replace( '~<cite(.*?)</cite>~Usi', '', $plugin_data['Description'] );
		?>

		<div class="wrap about-wrap ns-wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

			<?php // translators: %s Version. ?>
			<p class="about-text"><?php echo sprintf( esc_html__( 'Version: %s', 'date-today-nepali' ), esc_html( $version ) ); ?></p>

			<div class="about-text">
				<?php echo wp_kses_post( wpautop( $description ) ); ?>
			</div>

			<p>
				<a href="https://wordpress.org/support/plugin/date-today-nepali/#new-post" class="button button-primary" target="_blank"><?php echo esc_html__( 'Get Support', 'date-today-nepali' ); ?></a>
				<a href="https://wordpress.org/support/plugin/date-today-nepali/reviews/#new-post" class="button" target="_blank"><?php echo esc_html__( 'Leave a Review', 'date-today-nepali' ); ?></a>
			</p>

			<div class="ns-page">
				<div class="ns-content">
					<div class="ns-section cols-2">
						<div class="card">
							<h3>Using Widget</h3>
							<ol>
								<li>Go to Appearance -> Widgets</li>
								<li>Find 'Date Display Widget'</li>
								<li>Add the widget to the sidebar you want to use.</li>
								<li>Customize the widget options and we are good to go.</li>
							</ol>
						</div><!-- .card -->
						<div class="card">
							<h3>Get Support</h3>
							<p>Please visit dedicated support forum in the WordPress.org directory.</p>
							<a href="https://wordpress.org/support/plugin/date-today-nepali/" class="button button-primary" target="_blank">Visit Support</a>
						</div><!-- .card -->
						<div class="card">
							<h3>Recommended Plugins</h3>
							<ul>
								<li><a href="https://wordpress.org/plugins/woocommerce-product-tabs/" target="_blank">WooCommerce Product Tabs</a></li>
								<li><a href="https://wordpress.org/plugins/post-grid-elementor-addon/" target="_blank">Post Grid Elementor Addon</a></li>
								<li><a href="https://wordpress.org/plugins/admin-customizer/" target="_blank">Admin Customizer</a></li>
								<li><a href="https://wordpress.org/plugins/advanced-google-recaptcha/" target="_blank">Advanced Google reCAPTCHA</a></li>
								<li><a href="https://wordpress.org/plugins/nifty-coming-soon-and-under-construction-page/" target="_blank">Coming Soon & Maintenance Mode Page</a></li>
							</ul>
						</div><!-- .card -->
						<div class="card">
							<h3>Recommended Themes</h3>
							<ol>
								<li><a href="https://wordpress.org/themes/simple-life/" target="_blank">Simple Life</a></li>
								<li><a href="https://wordpress.org/themes/obulma/" target="_blank">Obulma</a></li>
								<li><a href="https://wordpress.org/themes/blue-planet/" target="_blank">Blue Planet</a></li>
							</ol>
						</div><!-- .card -->

					</div><!-- .ns-section -->
				</div><!-- .ns-content -->
				<div class="ns-sidebar">
					<div class="ns-box">
						<h3><span>Recent Blog Posts</span></h3>
						<div class="ns-box-content">

							<div class="ns-blog-list"></div>

						</div> <!-- .ns-box-content -->

					</div><!-- .postbox -->
				</div><!-- .ns-sidebar -->
			</div><!-- .ns-page -->

		</div>
		<?php
	}

	/**
	 * Load assets for welcome page.
	 *
	 * @since 1.0.0
	 *
	 * @param string $hook Hook name.
	 */
	public function add_welcome_assets( $hook ) {
		if ( 'settings_page_date-today-nepali-welcome' !== $hook ) {
			return;
		}

		wp_enqueue_style( 'date-today-nepali-welcome', DATE_TODAY_NEPALI_URL . '/assets/css/welcome.css', array(), DATE_TODAY_NEPALI_VERSION );

		wp_enqueue_script( 'date-today-nepali-blog-posts', DATE_TODAY_NEPALI_URL . '/assets/js/blog-posts.js', array(), DATE_TODAY_NEPALI_VERSION, true );

		$data = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		);

		wp_localize_script( 'date-today-nepali-blog-posts', 'NSBL', $data );
	}

	/**
	 * AJAX callback for blog posts.
	 *
	 * @since 1.0.0
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
