<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Admin Class
 *
 * Handles generic Admin functionality.
 *
 * @package SchoolWeb
 * @since 2.0.0
 */
class Wpsp_Admin{
	
	
	public function __construct() {
		
	}	
	/*
	* Add menu for manage license code
	* @package SchoolWeb
	* @since 2.0.0
	*/
	function wpsp_admin_menu(){
		add_menu_page( __( 'SchoolWeb', 'SchoolWeb'), __( 'School Web', 'SchoolWeb' ), 'manage_options', 'SchoolWeb' , array( $this, 'wpsp_admin_details'), WPSP_PLUGIN_URL. 'img/favicon.png');
	}

	
	/*
	* Call html of purchase code validation and contact
	* @package SchoolWeb
	* @since 2.0.0
	*/
	function wpsp_admin_details() {
		global $wpdb;
		$settings_table = $wpdb->prefix."wpsp_settings";

		$get_res = $wpdb->get_results("SELECT option_value FROM $settings_table WHERE option_name='sch_num_sms'");
		if($wpdb->num_rows>0) $num_sms = $get_res[0]->option_value;
		else{
			$num_sms = 0;
			$sms_qty_arr = array(
				'option_name' => 'sch_num_sms',
				'option_value' => '0'
			);
			$wpdb->insert($settings_table, $sms_qty_arr);
		}

		$gateway_res = $wpdb->get_results("SELECT option_value FROM $settings_table WHERE option_name='sch_enable_payment_gateway'");
		if($wpdb->num_rows>0) $gateway_status = $gateway_res[0]->option_value;
		else{
			$gateway_status = 0;
			$set_gateway_status = array(
				'option_name' => 'sch_enable_payment_gateway',
				'option_value' => '0'
			);
			$wpdb->insert($settings_table, $set_gateway_status);
		}
		require_once( WPSP_PLUGIN_PATH. 'lib/wpsp-admin-options.php' );		//require_once( WPSP_PLUGIN_PATH. 'lib/wpsp-admin.php' );
	}

	/*
	* Add required css and js for purchase code validation page
	* @package SchoolWeb
	* @since 2.0.0
	*/
	function wpsp_add_admin_scripts( $hook ) {
		if(	$hook == 'toplevel_page_SchoolWeb'	) {
			wp_register_style( 'wpsp_wp_admin_bootstrap', WPSP_PLUGIN_URL. 'css/bootstrap.min.css', false, '1.0.0' );
			wp_register_style( 'wpsp_wp_admin_css', WPSP_PLUGIN_URL . 'css/wpadmin.css', false, '1.0.0' );
		   
			wp_enqueue_style( 'wpsp_wp_admin_css' );
			wp_enqueue_script( 'wpsp_wp_admin_script', WPSP_PLUGIN_URL. 'plugins/jQuery/jQuery-2.1.4.min.js');
			wp_enqueue_script( 'wpsp_wp_admin_jquery', WPSP_PLUGIN_URL. 'js/wpsp-wp-admin.js');
		}
	}
	
	/*
	* Add pages in menu default
	* @package SchoolWeb
	* @since 2.0.0
	*/
	function wpsp_add_adminbar() {
		global $wp_admin_bar;

		$wpsp_wpschooldashboard_url = site_url().'/sch-dashboard/';
		$wpsp_wpschoolstudent_url 	= site_url().'/sch-student/';
		$wpsp_wpschoolteacher_url 	= site_url().'/sch-teacher/';
		$wpsp_wpschoolclass_url 	= site_url().'/sch-class/';
		$wpsp_wpschoolparent_url 	= site_url().'/sch-parent/';
		$wp_admin_bar->add_menu( array( 
			'parent' => false,
			'id' => 'dashboard',
			'title' => _('School Web Dashboard'),
			'href' => $wpsp_wpschooldashboard_url
		));
		$wp_admin_bar->add_menu( array(
			'parent' => 'dashboard',
			'id' => 'teacher',
			'title' => _('Teacher'),
			'href' => $wpsp_wpschoolteacher_url
		));
		$wp_admin_bar->add_menu( array(
			'parent' => 'dashboard',
			'id' => 'student',
			'title' => _('Student'),
			'href' => $wpsp_wpschoolstudent_url
		));
		
		$wp_admin_bar->add_menu( array(
			'parent' => 'dashboard',
			'id' => 'class',
			'title' => _('Class'),
			'href' => $wpsp_wpschoolclass_url
		));
		
		$wp_admin_bar->add_menu( array(
			'parent' => 'dashboard',
			'id' => 'parent',
			'title' => _('Parent'),
			'href' => $wpsp_wpschoolparent_url
		));
	}
	
	
	function add_hooks() {
		
		//Add menu page for purchase code validation
		add_action( 'admin_menu', array( $this, 'wpsp_admin_menu' ) );
		
		//Add css and js
		add_action( 'admin_enqueue_scripts', array( $this, 'wpsp_add_admin_scripts' ) );
		
		//Add pages into admin menu
		add_action( 'wp_before_admin_bar_render', array( $this, 'wpsp_add_adminbar' ) );
	}
}