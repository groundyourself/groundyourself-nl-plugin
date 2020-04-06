<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    DeMDev-GroundYourself-Features
 * @subpackage DeMDev-GroundYourself-Features/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    DeMDev-GroundYourself-Features
 * @subpackage DeMDev-GroundYourself-Features/admin
 * @author     Your Name <email@example.com>
 */
class DeMDev_GroundYourself_Features_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $demdev_groundyourself_features    The ID of this plugin.
	 */
	private $demdev_groundyourself_features;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $demdev_groundyourself_features       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $demdev_groundyourself_features, $version ) {

		$this->demdev_groundyourself_features = $demdev_groundyourself_features;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in DeMDev-GroundYourself-Features_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The DeMDev-GroundYourself-Features_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->demdev_groundyourself_features, plugin_dir_url( __FILE__ ) . 'css/demdev-groundyourself-features-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in DeMDev-GroundYourself-Features_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The DeMDev-GroundYourself-Features_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->demdev_groundyourself_features, plugin_dir_url( __FILE__ ) . 'js/demdev-groundyourself-features-admin.js', array( 'jquery' ), $this->version, false );

	}

}
