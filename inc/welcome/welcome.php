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

	<div class="wrap about-wrap ns-wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<p class="about-text"><?php echo sprintf( esc_html__( 'Version: %s', 'date-today-nepali' ), $version ); ?></p>

		<div class="about-text">
			<?php echo wp_kses_post( wpautop( $description ) ); ?>
		</div>

		<p>
			<a href="https://wordpress.org/support/plugin/date-today-nepali/" class="button button-primary" target="_blank"><?php echo esc_html__( 'Support', 'date-today-nepali' ); ?></a>
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
						<?php $rss_items = date_today_nepali_get_blog_feed_items(); ?>

						<?php if ( ! empty( $rss_items ) ) : ?>
							<ul>
								<?php foreach ( $rss_items as $item ) : ?>
									<li><a href="<?php echo esc_url( $item['url'] ); ?>" target="_blank"><?php echo esc_html( $item['title'] ); ?></a></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
          </div> <!-- .ns-box-content -->

        </div><!-- .postbox -->
      </div><!-- .ns-sidebar -->
		</div><!-- .ns-page -->

	</div>
	<?php
}

/**
 * Register welcome page.
 *
 * @since 1.0.0
 */
function date_today_nepali_add_welcome_style() {
	$current_screen = get_current_screen();

	if ( ! $current_screen ) {
		return;
	}

	if ( 'settings_page_date-today-nepali-welcome' !== $current_screen->id ) {
		return;
	}
	?>
	<style>
		.ns-wrap .ns-page {
			display: flex;
      gap: 1rem;
		}
		.ns-wrap .ns-content {
      width: 100%;
		}
		.ns-wrap .ns-section {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
		}
		.ns-wrap .ns-sidebar {
      flex: 0 0 280px;
		}
		.ns-wrap .card {
      margin-top: 0;
			padding: 0.7em 1em 1em;
		}
		.ns-wrap h3 {
			font-size: 1.3em;
      margin: 0 0 0.6em;
		}
		.ns-wrap h3 span {
			font-size: 1em;
		}
		.ns-wrap p,
		.about-wrap .about-text {
      font-size: 15px;
		}
		.ns-wrap .ns-page ol,
		.ns-wrap .ns-page ul {
      margin-left: 1em;
			list-style-position: outside;
		}
		.ns-wrap .ns-page ul {
			list-style-type: disc;
		}
	</style>
	<?php
}

add_action( 'admin_head', 'date_today_nepali_add_welcome_style' );
