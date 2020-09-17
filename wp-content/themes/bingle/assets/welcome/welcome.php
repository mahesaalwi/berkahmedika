<?php
if(!class_exists('Bingle_Demo_Welcome')) :

	class Bingle_Demo_Welcome {

			public $tab_sections = array(); // Welcome Page Tab Sections
			public $theme_name = null; // For storing Theme Name
			public $theme_slug = null; // For storing Theme Slug
			public $theme_version = null; // For Storing Theme Current Version Information
			public $free_plugins = array(); // Displayed Under Recommended Tabs
			public $pro_plugins = array(); // Will be displayed under Recommended Plugins
			public $req_plugins = array(); // Will be displayed under Required Plugins Tab
			public $companion_plugins = array(); // Will be displayed under Demo Import Tab
			public $strings = array(); // Common Display Strings

			
			public function __construct( $plugins, $strings ) {
				/** Useful Variables **/
				$theme = wp_get_theme();
				$this->theme_name = $theme->Name;
				$this->theme_slug = $theme->TextDomain;
				$this->theme_version = $theme->Version;

				/** Plugins **/
				$this->req_plugins = $plugins['required_plugins'];
				$this->actions_req = $plugins['req_plugins'];
				$this->companion_plugins = $plugins['companion_plugins'];

				/** Tabs **/
				$this->tab_sections = array(
					'getting_started' => esc_html__('Getting Started', 'bingle'),
					'actions_required' => esc_html__('Recommended Plugins', 'bingle'),
					'demo_import' => esc_html__('Import Demo', 'bingle'),
					'changelog' => esc_html__('ChangeLog', 'bingle'),
					'support' => esc_html__('Support', 'bingle'),
				);

				/** Strings **/
				$this->strings = $strings;

				/* Theme Activation Notice */
				add_action( 'load-themes.php', array( $this, 'activation_admin_notice' ) );

				/* Create a Welcome Page */
				add_action( 'admin_menu', array( $this, 'welcome_register_menu' ) );

				/* Enqueue Styles & Scripts for Welcome Page */
				add_action( 'admin_enqueue_scripts', array( $this, 'welcome_styles_and_scripts' ) );

				/** WordPress Plugin Installation Ajax **/
				add_action( 'wp_ajax_plugin_installer', array( $this, 'plugin_installer_callback' ) );

				/** Bundled & Remote Plugin Installation Ajax **/
				add_action( 'wp_ajax_plugin_offline_installer', array( $this, 'plugin_offline_installer_callback' ) );

				/** Plugin Activation Ajax **/
				add_action( 'wp_ajax_plugin_activation', array( $this, 'plugin_activation_callback' ) );

				/** Plugin Deactivation Ajax **/
				add_action( 'wp_ajax_plugin_deactivation', array( $this, 'plugin_deactivation_callback' ) );

				add_action( 'init', array( $this, 'get_required_plugin_notification' ));

			}

			public function get_required_plugin_notification() {

				$req_plugins = $this->actions_req;
				$notif_counter = 0;
				if(isset($req_plugins['free_plug'])){
					$notif_counter = count($req_plugins['free_plug']);	
				}
				if(isset($req_plugins['pro_plug'])){
					$notif_counter += count($req_plugins['pro_plug']);	
				}

				foreach($req_plugins as $plugin) {
					foreach($plugin as $pl) {

						if( isset( $pl['class'] ) ) {
							if( class_exists( $pl['class'] ) ) {
								$notif_counter--;
							}
						}elseif( isset( $pl['function'] ) ) {
							if( function_exists( $pl['function'] ) ) {
								$notif_counter--;
							}
						}
					}
				}
				return $notif_counter;
			}

			/** Welcome Message Notification on Theme Activation **/
			public function activation_admin_notice() {
				
				global $pagenow;

			if( is_admin() && ('themes.php' == $pagenow) && (isset($_GET['activated'])) ) {
				add_action( 'admin_notices', array( $this,'welcome_admin_notice_display') );
			}
			
		}

		/** Welcome Message Notification on Theme Activation **/
		public function welcome_admin_notice_display() {
			global $pagenow;

		if( is_admin() && ('themes.php' == $pagenow) && (isset($_GET['activated'])) ) {
			?>
			<div class="updated apdemowelcome-an notice notice-success is-dismissible">
				<h2><?php printf(__( 'Welcome!', 'bingle' )) ?></h2>
				<p class="about-desc"><?php printf(esc_html__( 'Thank you for installing %1$s. It is now installed and ready to use. Here are some useful links to get started: ', 'bingle' ),$this->theme_name);  ?></p>
				<hr/>
				<div class="apdemowelcome-column-wrap">
					<div class="apdemowelcome-column col-img">
						<picture>
							<img src="<?php echo esc_url( get_template_directory_uri() . '/screenshot.png' ); ?>">
						</picture>
					</div>
					<div class="apdemowelcome-column col-demos">
						<div>
							<h3>
								<span class="dashicons dashicons-feedback"></span>
								<?php printf(__( 'Starter site demos!', 'bingle' )) ?>
							</h3>
							<p><?php printf( wp_kses_post( 'You\'ve  got 11+ choices of great starter sites (Demos) to start with. By using one of these starter sites you\'ll get a great guidance on how to use the theme to its fullest and also save time to make your website. ', 'bingle' ), $this->theme_name, admin_url( 'themes.php?page=welcome-page#demo_import' )  ); ?></p>
						</div>
						<div>
							<div class="notice-btn-wrapper"><a class="nav-tab demo_import button button-primary" href="<?php echo admin_url( 'themes.php?page=welcome-page#demo_import' ) ?>"><?php esc_html_e( '11 ready to use starter sites.', 'bingle' ); ?></a></div>

							<?php printf( wp_kses_post( '<a class="options-page-btn notice-info-btn" href="%2$s">Or start setting up your theme now (without demo)!</a>', 'bingle' ), $this->theme_name, admin_url( 'themes.php?page=welcome-page' )  ); ?>

						</div>
					</div>
					<div class="apdemowelcome-column col-doc">
						<div>
							<h3>
								<span class="dashicons dashicons-category"></span>
								<?php printf(__( 'Documentation', 'bingle' )) ?>
							</h3>
							<p><?php printf( wp_kses_post( 'How to use %1$s! Here we\'ve a full and detailed documentation that explains how to use %1$s in its best. ', 'bingle' ), $this->theme_name ); 
							esc_html_e( 'You can also reach-out to us for any support during the theme setup and use.', 'bingle' ); ?></p>
							<a href="<?php echo esc_url('https://doc.accesspressthemes.com/bingle/');?>" class=" button" ><span><?php esc_html_e( 'Full Documentation', 'bingle' ); ?></span></a>
							<a href="<?php echo esc_url('https://accesspressthemes.com/support/');?>" class=" ti-return-dashboard  button button-secondary  install-now" ><span><?php esc_html_e( 'Contact Support', 'bingle' ); ?></span></a>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}

	/** Register Menu for Welcome Page **/
	public function welcome_register_menu() {
		$action_count = $this->get_required_plugin_notification();
		$welcome_menu_text = $this->theme_name.' '.esc_html__("Setup",'bingle' );
		$title        = $action_count > 0 ? esc_html($welcome_menu_text) . '<span class="badge pending-tasks">' . esc_html( $action_count ) . '</span>' : esc_html($welcome_menu_text);
		add_theme_page( esc_html($welcome_menu_text), $title , 'edit_theme_options', 'welcome-page', array( $this, 'welcome_screen' ));
	}


	/** Welcome Page **/
	public function welcome_screen() {
		$tabs = $this->tab_sections;

		$current_section = isset($_GET['section']) ? $_GET['section'] : 'getting_started';
		$section_inline_style = '';
		?>
		<div class="wrap about-wrap access-wrap">
			<div class="top-block-wrap">
				<div class="about-text">
					<h1><?php printf( esc_html__( 'Welcome to %1$s - Version %2$s', 'bingle' ), $this->theme_name, $this->theme_version ); ?></h1>
					<?php echo esc_html($this->strings['theme_short_description']); ?>
				</div>
				<div class="badge-wrap">
					<a target="_blank" href="<?php echo esc_url('https://www.accesspressthemes.com');?>" class="accesspress-badge wp-badge"><span><?php echo esc_html('AccessPressThemes'); ?></span></a>
				</div>
			</div>
			<div class="bottom-block-wrap">
				<div class="notice-main-pagewrapper">
					<div class="nav-tab-wrapper clearfix">
						<?php foreach($tabs as $id => $label) : ?>
							<a href="<?php echo esc_url(admin_url('themes.php?page=welcome-page#'.$id)); ?>" class="nav-tab <?php echo esc_attr($id);?> nav-tab-inactive" >
								<?php echo esc_html( $label ); ?>
								<?php if($id == 'actions_required') : $not = $this->get_required_plugin_notification(); ?>
									<?php if($not) : ?>
										<span class="pending-tasks">
											<?php echo esc_html($not); ?>
										</span>
									<?php endif; ?>
								<?php endif; ?>
							</a>
						<?php endforeach; ?>
					</div>
					<div class="notice-content-wrapper">
						<div class="welcome-section-wrapper-loader import-php">
							<div class="updating-message"></div>
						</div>
						<div class="welcome-section-wrapper is_loading">
							<?php foreach($tabs as $id => $label) : ?>
								<div class="welcome-section <?php echo esc_attr($id);?> nav-tab-inactive clearfix">
									<?php require_once get_template_directory() . '/assets/welcome/sections/'.esc_html($id).'.php'; ?>
								</div>
							<?php endforeach; ?>
							<div class="notice-sidebar is_loading">
								<div class= "notice-sidebar-item">
									<h4><?php echo esc_html('Join in our social networks!','bingle') ?></h4>
									<p><?php echo esc_html__('Get connected, share your opinions and more via our social community: ', 'bingle'); ?></p>

									<p><a href="<?php echo esc_url('https://www.facebook.com/AccessPressThemes');?>"><?php echo esc_html('Join our Facebook Group','bingle') ?></a><?php echo esc_html__(' -to receive updates, offers and more.', 'bingle'); ?></p>

									<p><a href="<?php echo esc_url('https://www.youtube.com/channel/UCzD8I1moKISXDjAVr8dIf-w');?>"><?php echo esc_html('Subscribe our YouTube Channel','bingle') ?></a><?php echo esc_html__(' -for tutorials, videos and more.', 'bingle'); ?></p>

									<p><a href="<?php echo esc_url('https://twitter.com/apthemes');?>"><?php echo esc_html('Follow us on Twitter','bingle') ?></a><?php echo esc_html__(' -to stay updated. ', 'bingle'); ?></p>
								</div>
								<div class= "notice-sidebar-item">
									<h4><?php echo esc_html('Rate us!','bingle') ?></h4>
									<p><?php echo esc_html__('Are you enjoying bingle? We would love to hear your feedback!', 'bingle'); ?></p>
									<a href="<?php echo esc_url('https://wordpress.org/support/theme/bingle/reviews/');?>"><?php echo esc_html('Write a review','bingle') ?></a>

								</div>
							</div>
						</div>
					</div>

				</div>
				<?php
			}

			/** Enqueue Necessary Styles and Scripts for the Welcome Page **/
			public function welcome_styles_and_scripts() {
				wp_enqueue_style( $this->theme_slug . '-welcome-screen', get_template_directory_uri() . '/assets/welcome/css/welcome.css' );
				wp_enqueue_script( $this->theme_slug . '-welcome-screen', get_template_directory_uri() . '/assets/welcome/js/welcome.js', array( 'jquery' ) );

				wp_localize_script( $this->theme_slug . '-welcome-screen', 'SmWelcomeObject', array(
					'admin_nonce'	=> wp_create_nonce( 'plugin_installer_nonce'),
					'activate_nonce'	=> wp_create_nonce( 'plugin_activate_nonce'),
					'deactivate_nonce'	=> wp_create_nonce( 'plugin_deactivate_nonce'),
					'ajaxurl'		=> esc_url( admin_url( 'admin-ajax.php' ) ),
					'activate_btn' => $this->strings['activate_btn'],
					'installed_btn' => $this->strings['installed_btn'],
					'demo_installing' => $this->strings['demo_installing'],
					'demo_installed' => $this->strings['demo_installed'],
					'demo_confirm' => $this->strings['demo_confirm'],
				) );
			}

			/** Plugin API **/
			public function call_plugin_api( $plugin ) {
				include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

				$call_api = plugins_api( 'plugin_information', array(
					'slug'   => $plugin,
					'fields' => array(
						'downloaded'        => false,
						'rating'            => false,
						'description'       => false,
						'short_description' => true,
						'donate_link'       => false,
						'tags'              => false,
						'sections'          => true,
						'homepage'          => true,
						'added'             => false,
						'last_updated'      => false,
						'compatibility'     => false,
						'tested'            => false,
						'requires'          => false,
						'downloadlink'      => false,
						'icons'             => true
					)
				) );

				return $call_api;
			}

			/** Check For Icon **/
			public function check_for_icon( $arr ) {
				if ( ! empty( $arr['svg'] ) ) {
					$plugin_icon_url = $arr['svg'];
				} elseif ( ! empty( $arr['2x'] ) ) {
					$plugin_icon_url = $arr['2x'];
				} elseif ( ! empty( $arr['1x'] ) ) {
					$plugin_icon_url = $arr['1x'];
				} else {
					$plugin_icon_url = $arr['default'];
				}

				return $plugin_icon_url;
			}

			/** Check if Plugin is active or not **/
			public function get_plugin_active($plugin) {
				$folder_name = $plugin['slug'];
				$file_name = $plugin['filename'];

				$class = '';
				if( isset($plugin['class']) ){
					$class = $plugin['class'];	
				}

				$function = '';
				if( isset($plugin['function']) ){
					$function = $plugin['function'];
				}

				$status = 'install';

				$path = WP_PLUGIN_DIR.'/'.esc_attr($folder_name).'/'.esc_attr($file_name);
				if( file_exists( $path ) ) {
					if($class){
						$status = class_exists( $class ) ? 'inactive' : 'active';	
					}elseif($function){
						$status = function_exists( $function ) ? 'inactive' : 'active';	
					}

				}
				return $status;
			}

			/** Generate Url for the Plugin Button **/
			public function generate_plugin_url($status, $plugin) {
				$folder_name = $plugin['slug'];
				$file_name = $plugin['filename'];

				switch ( $status ) {
					case 'install':
					return wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'install-plugin',
								'plugin' => esc_attr($folder_name)
							),
							network_admin_url( 'update.php' )
						),
						'install-plugin_' . esc_attr($folder_name)
					);
					break;

					case 'inactive':
					return '#';
					break;

					case 'active':
					return '#';
					break;
				}
			}

			/* ========== Plugin Installation Ajax =========== */
			public function plugin_installer_callback(){

				if ( ! current_user_can('install_plugins') ) {
					wp_die( esc_html__( 'Sorry, you are not allowed to install plugins on this site.', 'bingle' ) );
				}

				$nonce = isset( $_POST["nonce"] ) ? sanitize_text_field( wp_unslash( $_POST["nonce"] ) ) : '';
				$plugin = isset( $_POST["plugin"] ) ? sanitize_text_field( wp_unslash( $_POST["plugin"] ) ) : '';
				$plugin_file = isset( $_POST["plugin_file"] ) ? sanitize_text_field( wp_unslash( $_POST["plugin_file"] ) ) : '';
				$download_link = isset( $_POST["download_link"] ) ? sanitize_text_field( wp_unslash( $_POST["download_link"] ) ) : '';

				// Check our nonce, if they don't match then bounce!
				if (! wp_verify_nonce( $nonce, 'plugin_installer_nonce' )) {
					wp_die( esc_html__( 'Error - unable to verify nonce, please try again.', 'bingle') );
				}


         		// Include required libs for installation
				require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
				require_once ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php';
				require_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';

				// Get Plugin Info
				$api = $this->call_plugin_api($plugin);

				$skin     = new WP_Ajax_Upgrader_Skin();
				$upgrader = new Plugin_Upgrader( $skin );
				$upgrader->install($api->download_link);

				$plugin_file = esc_html($plugin).'/'.esc_html($plugin_file);

				if($api->name) {
					if($plugin_file) {
						activate_plugin($plugin_file);
						echo 'success';
						die();
					}
				}else{
					$upgrader->install($download_link);

					$plugin_file = ABSPATH . 'wp-content/plugins/'.esc_html($plugin).'/'.esc_html($plugin_file);

					if(file_exists($plugin_file)) {

						activate_plugin($plugin_file);
						echo "success";
						die();
					}
				}
				echo 'fail';

				die();
			}

			/** Plugin Offline Installation Ajax **/
			public function plugin_offline_installer_callback() {
				$plugin = array();

				$file_location = $plugin['location'] = isset( $_POST['file_location'] ) ? sanitize_text_field( wp_unslash( $_POST['file_location'] ) ) : '';
				$file = isset( $_POST['file'] ) ? sanitize_text_field( wp_unslash( $_POST['file'] ) ) : '';
				$host_type = isset( $_POST['host_type'] ) ? sanitize_text_field( wp_unslash( $_POST['host_type'] ) ) : '';
				$plugin_class = $plugin['class'] = isset( $_POST['class_name'] ) ? sanitize_text_field( wp_unslash( $_POST['class_name'] ) ) : '';
				$plugin_slug = $plugin['slug'] = isset( $_POST['slug'] ) ? sanitize_text_field( wp_unslash( $_POST['slug'] ) ) : '';
				$plugin_directory = ABSPATH . 'wp-content/plugins/';

				$plugin_file = $plugin_slug . '/' . $file;

				if( $host_type == 'remote' ) {
					$file_location = $this->get_local_dir_path($plugin);
				}

				$zip = new ZipArchive();
				if ($zip->open($file_location) === TRUE) {
					$zip->extractTo($plugin_directory);
					$zip->close();

					activate_plugin($plugin_file);

					if( $host_type == 'remote' ) {
						unlink($file_location);
					}

					echo 'success';

					die();
				} else {
					echo 'failed';
				}

				die();
			}

			/** Plugin Offline Activation Ajax **/
			public function plugin_activation_callback() {

				$plugin = isset( $_POST['plugin'] ) ? sanitize_text_field( wp_unslash( $_POST['plugin'] ) ) : '';
				$plugin_file = isset( $_POST['plugin_file'] ) ? sanitize_text_field( wp_unslash( $_POST['plugin_file'] ) ) : '';
				$plugin_file = ABSPATH . 'wp-content/plugins/'.esc_html($plugin).'/'.esc_html($plugin_file);

				if(file_exists($plugin_file)) {

					activate_plugin($plugin_file);
					echo "success";

				} else {
					echo esc_html__('Plugin Does not Exists' , 'bingle');
				}

				die();

			}

			/** Plugin Offline Activation Ajax **/
			public function plugin_deactivation_callback() {

				$plugin = isset( $_POST['plugin'] ) ? sanitize_text_field( wp_unslash( $_POST['plugin'] ) ) : '';
				$plugin_file = isset( $_POST['plugin_file'] ) ? sanitize_text_field( wp_unslash( $_POST['plugin_file'] ) ) : '';
				$plugin_file = ABSPATH . 'wp-content/plugins/'.esc_html($plugin).'/'.esc_html($plugin_file);

				if(file_exists($plugin_file)) {

					deactivate_plugins($plugin_file);
					echo "success";

				} else {
					echo esc_html__('Plugin Does not Exists' , 'bingle');
				}

				die();

			}

			public function all_required_plugins_installed() {

				$companion_plugins = $this->companion_plugins;
				$show_success_notice = false;

				foreach($companion_plugins as $plugin) {

					$path = WP_PLUGIN_DIR.'/'.esc_attr($plugin['slug']).'/'.esc_attr($plugin['filename']);

					if(file_exists($path)) {
						if(class_exists($plugin['class'])) {
							$show_success_notice = true;
						} else {
							$show_success_notice = false;
							break;
						}
					} else {
						$show_success_notice = false;
						break;
					}
				}

				return $show_success_notice;
			}

			public function get_local_dir_path($plugin) {

				$upload_dir = wp_upload_dir();

				$file_location = $file_location = $upload_dir['path'] . '/' . $plugin['slug'].'.zip';

				if( file_exists( $file_location ) || class_exists( $plugin['class'] ) ) {
					return $file_location;
				}

				$url = wp_nonce_url(admin_url('themes.php?page=' . $this->theme_slug . '-welcome&section=actions_required'),'remote-file-installation');
				if (false === ($creds = request_filesystem_credentials($url, '', false, false, null) ) ) {
					return; // stop processing here
				}

				if ( ! WP_Filesystem($creds) ) {
					request_filesystem_credentials($url, '', true, false, null);
					return;
				}

				global $wp_filesystem;
				$file = $wp_filesystem->get_contents( $plugin['location'] );

				$wp_filesystem->put_contents( $file_location, $file, FS_CHMOD_FILE );

				return $file_location;
			}

		}

	endif;