<?php
class Advanced_Widgets_For_Elementor {
  // Activate
  function activate(){
      flush_rewrite_rules();
  }

  // Deactivate
  function deactivate(){
      flush_rewrite_rules();
  }

  /**
   * Creates an Action Menu
   */

  function awe_for_elementor_pro_settings_link($links, $file) {
      static $this_plugin;

      if (!$this_plugin) {
          $this_plugin = plugin_basename(__FILE__);
      }
      $settings_links = sprintf( '<a href="admin.php?page=awe-settings">' . __( 'Settings', ' aw_elementor' ) . '</a>' );

        if(! class_exists( 'awe_Pro' ) ) {
            // check to make sure we are on the correct plugin
            if ($file == $this_plugin) {
                // link to what ever you want
                $plugin_links['awe_Pro'] = sprintf('<a href="https://advanceaddons.com/product/aae/" target="_blank" style="color:#39a700eb; font-weight: bold;">' . __( 'Get Pro', ' aw_elementor' ) . '</a>');

                // add the links to the list of links already there
                foreach($plugin_links as $link) {
                    array_unshift($links,$settings_links, $link);
                }
            }
        }

      return $links;
  }

  // Widget register
  function __construct() {
      add_action( 'elementor/widgets/widgets_registered', array( $this, 'awe_for_elementor_widget_bundle') );
      // Register custom controls
     // add_action( 'elementor/controls/controls_registered', array( $this, 'register_controls'));
  }

 function awe_for_elementor_widget_register() {
      $this->awe_for_elementor_widget_bundle();
      $this->awe_for_elementor_script();
  }

  // aae widget bundle
  function awe_for_elementor_widget_bundle(){
    $awe_elements_keys = [
          'widget-notifications',
          'widget-glow-text-effects',
          'widget-cards',
          'widget-text-animation',
          'widget-quote',
          'widget-caldera-forms',
          'widget-cf7',
          'widget-gravity-forms',
          'widget-mailchimp-wp',
          'widget-ninjaform',
          'widget-weform',
          'widget-buttons',
          'widget-badge',
          'widget-wpform',
          'widget-flipbox',
          'widget-gallery',
          'widget-post-cards',
          'widget-post-grid',

      ];

      $awe_default_settings = array_fill_keys( $awe_elements_keys, true );

      $check_component_active = get_option( 'awe_save_settings', $awe_default_settings );

        // notifications Elements
        if( $check_component_active['widget-notifications'] ) {
            require_once AWE_PATH . '/modules/notifications/widget.php';
        }

         // glow-text-effects Elements
         if( $check_component_active['widget-glow-text-effects'] ) {
          require_once AWE_PATH . '/modules/glow-text-effects/widget.php';
        }

        // cards Elements
        if( $check_component_active['widget-cards'] ) {
          require_once AWE_PATH . '/modules/cards/widget.php';
        }

        // Text animation Elements
        if( $check_component_active['widget-text-animation'] ) {
          require_once AWE_PATH . '/modules/text-animation/widget.php';
        }

        // quote Elements
        if( $check_component_active['widget-quote'] ) {
          require_once AWE_PATH . '/modules/quote/widget.php';
        }

        // caldera-forms Elements
        if( $check_component_active['widget-caldera-forms'] ) {
          require_once AWE_PATH . '/modules/caldera-forms/widget.php';
        }
        // cf7 Elements
        if( $check_component_active['widget-cf7'] ) {
          require_once AWE_PATH . '/modules/cf7/widget.php';
        }
        // gravity-forms Elements
        if( $check_component_active['widget-gravity-forms'] ) {
          require_once AWE_PATH . '/modules/gravity-forms/widget.php';
        }
        // mailchimp-wp Elements
        if( $check_component_active['widget-mailchimp-wp'] ) {
          require_once AWE_PATH . '/modules/mailchimp-wp/widget.php';
        }
        // ninjaform Elements
        if( $check_component_active['widget-ninjaform'] ) {
          require_once AWE_PATH . '/modules/ninjaform/widget.php';
        }


        // weform Elements
        if( $check_component_active['widget-weform'] ) {
          require_once AWE_PATH . '/modules/weform/widget.php';
        }
        // wpform Elements
        if( $check_component_active['widget-wpform'] ) {
          require_once AWE_PATH . '/modules/wpform/widget.php';
        }

         // badge Elements
         if( $check_component_active['widget-badge'] ) {
          require_once AWE_PATH . '/modules/badge/widget.php';
        }


        // buttons Elements
        if( $check_component_active['widget-buttons'] ) {
          require_once AWE_PATH . '/modules/buttons/widget.php';
        }

         // flipbox Elements
         if( $check_component_active['widget-flipbox'] ) {
          require_once AWE_PATH . '/modules/flipbox/widget.php';
        }

      // gallery Elements
      if( $check_component_active['widget-gallery'] ) {
        require_once AWE_PATH . '/modules/gallery/widget.php';
      }

      // post cards Elements
      if( $check_component_active['widget-post-cards'] ) {
        require_once AWE_PATH . '/modules/post-card/widget.php';
      }

       // post grid Elements
       if( $check_component_active['widget-post-grid'] ) {
        require_once AWE_PATH . '/modules/post-grid/widget.php';
      }


      // helper functions
      require_once AWE_PATH . '/modules/helper-functions.php';
      require_once AWE_PATH . '/includes/helper.php';
      require_once AWE_PATH . '/includes/custom-icons.php';
      require_once AWE_PATH . '/includes/twitteroauth.php';

       //Admin init
       require_once AWE_PATH . '/admin/admin-init.php';

       //Admin init
      require_once AWE_PATH . '/admin/notices/admin-notices.php';

      // System Info
      require_once AWE_PATH . '/admin/includes/system-info.php';

      
  }

  // Register style & script
  function awe_for_elementor_register(){
      add_action('wp_enqueue_scripts', array($this, 'awe_for_elementor_css'), 99);
      add_action('wp_enqueue_scripts', array($this, 'awe_for_elementor_script'), 99);
      add_action('elementor/editor/before_enqueue_scripts', array($this, 'awe_preview_script'), 0);
      // add_action('plugins_loaded', array($this, 'awe_pro_plugin_init'));
      add_filter('plugin_action_links', array($this, 'awe_for_elementor_pro_settings_link'),10, 2);
  }

  function awe_preview_script(){
        wp_enqueue_style(
          'advance-icon',
          AWE_DIR_ASSETS . 'fonts/style.min.css',
          null,
          AWE_VERSION
        );

        // font-awesome
        wp_enqueue_style(
          'font-awesome2',
          AWE_DIR_ASSETS . 'vendor/css/font-awesome.min.css',
          null,
          AWE_VERSION
      );

        // admin css
        wp_enqueue_style(
          'admin-main',
          AWE_DIR_Admin . 'assets/css/main.css',
          null,
          AWE_VERSION
      );


  }
  // Css include
  function awe_for_elementor_css(){
    $awe_elements_keys = [
      'widget-team',
  ];
    $awe_default_settings = array_fill_keys( $awe_elements_keys, true );
    $check_component_active = get_option( 'awe_save_settings', $awe_default_settings );
          wp_enqueue_style(
            'advance-icon',
            AWE_DIR_ASSETS . 'fonts/style.min.css',
            null,
            AWE_VERSION
        );
        // font-awesome
        wp_enqueue_style(
          'font-awesome',
          AWE_DIR_ASSETS . 'vendor/css/font-awesome.min.css',
          null,
          AWE_VERSION
      );

          // awe
          wp_enqueue_style(
            'awe',
            AWE_DIR_ASSETS . 'css/awe.min.css',
            null,
            AWE_VERSION
        );

        // common
        wp_enqueue_style(
          'common',
          AWE_DIR_ASSETS . 'css/common.css',
          null,
          AWE_VERSION
      );

          // alert
          wp_enqueue_style(
            'notifications',
            AWE_DIR_ASSETS . 'css/alert.css',
            null,
            AWE_VERSION
        );




  }

  // Script include
  function awe_for_elementor_script(){
      $awe_elements_keys = [
          'widget-team',
      ];
      $awe_default_settings = array_fill_keys( $awe_elements_keys, true );
      $check_component_active = get_option( 'awe_save_settings', $awe_default_settings );

      //slick
        wp_enqueue_script(
          'aae.js',
          AWE_DIR_ASSETS . 'js/aae.js',
          ['jquery'],
          AWE_VERSION,
          true
      );




  }



}
