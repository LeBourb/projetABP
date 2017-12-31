<?php 
class DC_Checkout_Terms_Conditions_Popup {

	public $plugin_url;

	public $plugin_path;

	public $version;

	public $token;
	
	public $text_domain;
	
	public $library;

	public $shortcode;

	public $admin;

	public $frontend;

	public $template;

	public $ajax;

	private $file;
	
	public $settings;
	
	public $options;
	
	public $dc_wp_fields;

	public function __construct($file) {

		$this->file = $file;
		$this->options = get_option('dc_dc_checkout_terms_conditions_popup_general_settings_name');
		add_action('init', array(&$this, 'init'), 0);
		
	}
	
	/**
	 * initilize plugin on WP init
	 */
	function init() {
		
		// Init Text Domain
		
		
		// Init library
		$this->load_class();
		$this->library = new DC_Checkout_Terms_Conditions_Popup_Library();

	

		if (is_admin()) {
			//$this->load_class('admin');
			$this->admin = new DC_Checkout_Terms_Conditions_Popup_Admin();
		}

		if (!is_admin() || defined('DOING_AJAX')) {
			//$this->load_class('frontend');
			$this->frontend = new DC_Checkout_Terms_Conditions_Popup_Frontend();
			
		
		}

		// DC Wp Fields
		$this->dc_wp_fields = $this->library->load_wp_fields();
	}
	
	
        public function load_class($class_name = '') {
            require_once ('class-dc-checkout-terms-conditions-popup-library.php');
            require_once ('class-dc-checkout-terms-conditions-popup-admin.php');
            require_once ('class-dc-checkout-terms-conditions-popup-frontend.php');            
		 // End If Statement
	}// End load_class()
	 
	
	/**
   * Load Localisation files.
   *
   * Note: the first-loaded translation file overrides any following ones if the same translation is present
   *
   * @access public
   * @return void
   */
  /*public function load_plugin_textdomain() {
    $locale = apply_filters( 'plugin_locale', get_locale(), $this->token );

    load_textdomain( $this->text_domain, WP_LANG_DIR . "/dc-checkout-terms-conditions-popup/dc-checkout-terms-conditions-popup-$locale.mo" );
    load_textdomain( $this->text_domain, $this->plugin_path . "/languages/dc-checkout-terms-conditions-popup-$locale.mo" );
  }

	
	
	/** Cache Helpers *********************************************************/

	/**
	 * Sets a constant preventing some caching plugins from caching a page. Used on dynamic pages
	 *
	 * @access public
	 * @return void
	 */
	function nocache() {
		if (!defined('DONOTCACHEPAGE'))
			define("DONOTCACHEPAGE", "true");
		// WP Super Cache constant
	}

}
