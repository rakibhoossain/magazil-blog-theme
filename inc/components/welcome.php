<?php
	// Welcome screen
	if ( is_admin() ) {
		global $magazil_required_actions, $magazil_recommended_plugins;
		require_once get_template_directory() . '/inc/libraries/notify/class-magazil-notify-system.php';

		$magazil_recommended_plugins = array(
			'enlighter'        => array( 'file' => 'Enlighter', 'recommended' => false ),
			'multilanguage'        => array( 'file' => '', 'recommended' => false ),
			'gmap-embed' => array( 'file' => 'srm_gmap_embed', 'recommended' => true ),
			'contact-form-7' => array( 'file' => 'wp-contact-form-7', 'recommended' => true ),
		);

		/*
		 * id - unique id; required
		 * title
		 * description
		 * check - check for plugins (if installed)
		 * plugin_slug - the plugin's slug (used for installing the plugin)
		 *
		 */
		$magazil_required_actions = array(
			array(
				"id"          => 'magazil-wp-import-plugin',
				"title"       => Magazil_Notify_System::wordpress_importer_title(),
				"description" => Magazil_Notify_System::wordpress_importer_description(),
				"check"       => Magazil_Notify_System::has_import_plugin( 'wordpress-importer' ),
				"plugin_slug" => 'wordpress-importer'
			),
			array(
				"id"          => 'magazil-wp-import-widget-plugin',
				"title"       => Magazil_Notify_System::widget_importer_exporter_title(),
				'description' => Magazil_Notify_System::widget_importer_exporter_description(),
				"check"       => Magazil_Notify_System::has_import_plugin( 'widget-importer-exporter' ),
				"plugin_slug" => 'widget-importer-exporter'
			),
			array(
				"id"          => 'magazil-req-ac-download-data',
				"title"       => esc_html__( 'Download theme sample data', 'magazil' ),
				"description" => esc_html__( 'Head over to our website and download the sample content data.', 'magazil' ),
				"help"        => '<a target="_blank"  href="https://raw.githubusercontent.com/WPTRT/theme-unit-test/master/themeunittestdata.wordpress.xml">' . __( 'Posts', 'magazil' ) . '</a>, 
					<a target="_blank"  href="https://raw.githubusercontent.com/serakib/magazil-blog-theme/master/magazil-widgets.wie">' . __( 'Widgets', 'magazil' ) . '</a>',
				"check"       => Magazil_Notify_System::has_content(),
			),
			array(
				"id"    => 'magazil-req-ac-install-data',
				"title" => esc_html__( 'Import Sample Data', 'magazil' ),
				"help"  => '<a class="button button-primary" target="_blank"  href="' . self_admin_url( 'admin.php?import=wordpress' ) . '">' . __( 'Import Posts', 'magazil' ) . '</a> 
					<a class="button button-primary" target="_blank"  href="' . self_admin_url( 'tools.php?page=widget-importer-exporter' ) . '">' . __( 'Import Widgets', 'magazil' ) . '</a>',
				"check" => Magazil_Notify_System::has_import_plugins(),
			),
			array(
				"id"          => 'magazil-req-ac-static-latest-news',
				"title"       => esc_html__( 'Set front page to static', 'magazil' ),
				"description" => esc_html__( 'If you just installed Magazil, and are not able to see the front-page demo, you need to go to Settings -> Reading , Front page displays and select "Static Page".', 'magazil' ),
				"help"        => 'If you need more help understanding how this works, check out the following <a target="_blank"  href="https://codex.wordpress.org/Creating_a_Static_Front_Page#WordPress_Static_Front_Page_Process">link</a>. <br/><br/> <a class="button button-secondary" target="_blank"  href="' . self_admin_url( 'options-reading.php' ) . '">' . __( 'Set manually', 'magazil' ) . '</a> <a class="button button-primary"  href="' . wp_nonce_url( self_admin_url( 'themes.php?page=magazil-welcome&tab=recommended_actions&action=set_page_automatic' ), 'set_page_automatic' ) . '">' . __( 'Set automatically', 'magazil' ) . '</a>',
				"check"       => Magazil_Notify_System::is_not_static_page()
			)
		);

		require_once get_template_directory() . '/inc/libraries/welcome-screen/class-magazil-welcome-screen.php';
		new Magazil_Welcome_Screen();
	}
?>