<?php
/**
 * Welcome
 *
 * @package Date_Today_Nepali
 */

/**
 * Register welcome page.
 *
 * @since 1.0.0
 */
function date_today_nepali_add_welcome_menu() {
	add_options_page( esc_html__( 'Date Today Nepali', 'date-today-nepali' ), esc_html__( 'Date Today Nepali', 'date-today-nepali' ), 'manage_options', 'date-today-nepali-welcome', 'date_today_nepali_render_welcome_page' );
}

add_action( 'admin_menu', 'date_today_nepali_add_welcome_menu' );


function date_today_nepali_render_welcome_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( ! function_exists( 'get_plugin_data' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	$plugin_data = get_plugin_data( DATE_TODAY_NEPALI_BASEFILE );

	$version     = $plugin_data['Version'];
	$description = preg_replace( '~<cite(.*?)</cite>~Usi', '', $plugin_data['Description'] );
	?>

	<div class="wrap about-wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<p><?php echo sprintf( esc_html__( 'Version: %s', 'date-today-nepali' ), $version ); ?></p>

		<div class="about-text">
			<?php echo wp_kses_post( wpautop( $description ) ); ?>
		</div>

		<p>
			<a href="https://wordpress.org/support/plugin/date-today-nepali/" class="button button-primary" target="_blank"><?php echo esc_html__( 'Support', 'date-today-nepali' ); ?></a>
			<a href="https://wordpress.org/support/plugin/date-today-nepali/reviews/#new-post" class="button" target="_blank"><?php echo esc_html__( 'Leave a Review', 'date-today-nepali' ); ?></a>
		</p>

		<div class="about__section has-2-columns">
			<div class="column card">first</div><!-- .column -->
			<div class="column card">second</div><!-- .column -->
			<div class="column card">third</div><!-- .column -->
			<div class="column card">fourth</div><!-- .column -->

		</div><!-- .about__section -->


		<div class="feature-section has-2-columns alignleft">
			<div class="card">
				<h3><?php echo esc_html__( 'How to Use (Using Widget)', 'date-today-nepali' ); ?></h3>
				<ol>
					<li><?php echo esc_html__( 'Go to Appearance >> Widgets', 'date-today-nepali' ); ?></li>
					<li><?php echo esc_html__( 'Find MT: Posts From Category widget', 'date-today-nepali' ); ?></li>
					<li><?php echo esc_html__( 'Add the widget to the sidebar you want to use', 'date-today-nepali' ); ?></li>
					<li><?php echo esc_html__( 'Fill in the desired fields and we are good to go', 'date-today-nepali' ); ?></li>
				</ol>
			</div>

			<div class="card">
				<h3><?php echo esc_html__( 'How to Use (Using Shortcode)', 'date-today-nepali' ); ?></h3>
				<code>[pfc layout="layout-one" cat="0" order_by="date" order="DESC" post_number="5" length="10" readmore="Read More" show_date="true" show_image="true" image_size="full"]</code>
				<p><a href="https://wordpress.org/plugins/posts-from-category/" target="_blank"><?php echo esc_html__( 'Click here to see shortcode parameters', 'date-today-nepali' ); ?></a></p>
			</div>

			<div class="card">
				<h3><?php echo esc_html__( 'Recommended Plugins', 'date-today-nepali' ); ?></h3>
				<ol>
					<li><a href="https://wordpress.org/plugins/advanced-google-recaptcha/" target="_blank"><?php echo esc_html__( 'Advanced Google reCAPTCHA', 'date-today-nepali' ); ?></a></li>
					<li><a href="https://wordpress.org/plugins/admin-customizer/" target="_blank"><?php echo esc_html__( 'Admin Customizer', 'date-today-nepali' ); ?></a></li>
					<li><a href="https://wordpress.org/plugins/woocommerce-product-tabs/" target="_blank"><?php echo esc_html__( 'WooCommerce Product Tabs', 'date-today-nepali' ); ?></a></li>
					<li><a href="https://wordpress.org/plugins/post-grid-elementor-addon/" target="_blank"><?php echo esc_html__( 'Post Grid Elementor Addon', 'date-today-nepali' ); ?></a></li>
					<li><a href="https://wordpress.org/plugins/nifty-coming-soon-and-under-construction-page/" target="_blank"><?php echo esc_html__( 'Coming Soon & Maintenance Mode Page', 'date-today-nepali' ); ?></a></li>
				</ol>
			</div>

			<div class="card">
				<h3><?php echo esc_html__( 'Recommended Themes', 'date-today-nepali' ); ?></h3>
				<ol>
					<li><a href="https://wordpress.org/themes/hait/" target="_blank"><?php echo esc_html__( 'Hait - Google Core Web Vitals Optimized', 'date-today-nepali' ); ?></a></li>
				</ol>
			</div>
		</div>

	</div>
	<?php
}
