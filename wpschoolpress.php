<?php
/*
Plugin Name: 	SchoolWeb
Plugin URI: 	http://SchoolWeb.com
Description:    SchoolWeb is a school management system plugin that makes school activities transparent to parents. For more information please visit our website.
Version: 		1.0
Author: 		SchoolWeb Team
Author URI: 	SchoolWeb.com
Text Domain:	SchoolWeb
Domain Path:    languages

@package SchoolWeb 
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Basic plugin definitions
 * 
 * @package SchoolWeb
 * @since 1.0.0
*/
if( !defined( 'WPSP_PLUGIN_URL' ) ) {
	define('WPSP_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}

if( !defined( 'WPSP_PLUGIN_PATH' ) ) {
	define( 'WPSP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

if( !defined( 'WPSP_PLUGIN_VERSION' ) ) {
	define( 'WPSP_PLUGIN_VERSION', '1.0' ); //Plugin version number
}

define( 'PERMISSION_MSG', 'You don\'t have enough permission to access this page');

//Call the  required files when plugin activate
register_activation_hook( __FILE__, 'wpsp_activation' );
function wpsp_activation() {
	include_once( WPSP_PLUGIN_PATH.'lib/wpsp-activation.php' );

	do_action("ac_default_fees_group");

	if (! wp_next_scheduled ( 'make_monthly_dues' )) {
 		wp_schedule_event(time(), 'daily', 'make_monthly_dues');
    }
}

register_deactivation_hook(__FILE__, 'wpsp_deactivation');

function wpsp_deactivation() {
	wp_clear_scheduled_hook('make_monthly_dues');
}

//Monthly dues
add_action('make_monthly_dues', 'cal_monthly_dues');

function cal_monthly_dues() {
	include_once( WPSP_PLUGIN_PATH.'includes/wpsp-cal-monthly-dues.php' );
}


//add action to load plugin
add_action( 'plugins_loaded', 'wpsp_plugins_loaded' );
function wpsp_plugins_loaded() {
	
 	$wpsp_lang_dir	= dirname( plugin_basename( __FILE__ ) ) . '/languages/';
 	load_plugin_textdomain( 'SchoolWeb', false, $wpsp_lang_dir );

	//initialize settings of plugin

	
 	//Open required files for initialization 	
	require_once( WPSP_PLUGIN_PATH. 'lib/wpsp-ajaxworks.php' );		
	require_once( WPSP_PLUGIN_PATH. 'lib/wpsp-ajaxworks-student.php' );
	require_once( WPSP_PLUGIN_PATH. 'lib/wpsp-ajaxworks-teacher.php' );
	require_once( WPSP_PLUGIN_PATH. 'wpsp-layout.php' );
	require_once( WPSP_PLUGIN_PATH. 'includes/wpsp-misc.php' );
		
	wpsp_get_setting();
	global $wpsp_settings_data;	
	
	global $wpsp_admin, $wpsp_public, $paytmClass, $paypalClass;	
	//admin class handles most of functionalities of plugin
	include_once( WPSP_PLUGIN_PATH . 'wpsp-class-admin.php' );
	$wpsp_admin = new Wpsp_Admin();
	$wpsp_admin->add_hooks();
	
	//public class handles most of functionalities of plugin
	include_once( WPSP_PLUGIN_PATH . 'wpsp-class-public.php' );
	$wpsp_public = new Wpsp_Public();
	$wpsp_public->add_hooks();
	
}

add_action('admin_init','ajax_actions');

function ajax_actions(){
		
		add_action( 'wp_ajax_listdashboardschedule', 'wpsp_listdashboardschedule' );
		
		add_action( 'wp_ajax_StudentProfile', 'wpsp_StudentProfile' );
		add_action( 'wp_ajax_AddStudent', 'wpsp_AddStudent' );
		
		add_action( 'wp_ajax_StudentPublicProfile', 'wpsp_StudentPublicProfile' );
		add_action( 'wp_ajax_ParentPublicProfile', 'wpsp_ParentPublicProfile' );
		add_action( 'wp_ajax_TeacherPublicProfile', 'wpsp_TeacherPublicProfile' );
		

		add_action( 'wp_ajax_bulkDelete', 'wpsp_BulkDelete' );		
		add_action( 'wp_ajax_undoImport', 'wpsp_UndoImport' );
		
		add_action( 'wp_ajax_AddTeacher', 'wpsp_AddTeacher' );
		add_action( 'wp_ajax_AddParent', 'wpsp_AddParent' );		
		
		add_action( 'wp_ajax_AddClass', 'wpsp_AddClass');
		add_action( 'wp_ajax_UpdateClass', 'wpsp_UpdateClass');
		add_action( 'wp_ajax_GetClass', 'wpsp_GetClass');
		add_action( 'wp_ajax_DeleteClass', 'wpsp_DeleteClass');

		add_action( 'wp_ajax_AddExam', 'wpsp_AddExam');
		add_action( 'wp_ajax_UpdateExam', 'wpsp_UpdateExam');
		add_action( 'wp_ajax_ExamInfo', 'wpsp_ExamInfo');
		add_action( 'wp_ajax_DeleteExam', 'wpsp_DeleteExam');
		
		add_action( 'wp_ajax_getStudentsList', 'wpsp_getStudentsList' );
		add_action( 'wp_ajax_AttendanceEntry', 'wpsp_AttendanceEntry' );
        add_action( 'wp_ajax_deleteAttendance', 'wpsp_DeleteAttendance');
        add_action( 'wp_ajax_getStudentsAttendanceList', 'wpsp_getStudentsAttendanceList');
		
        add_action( 'wp_ajax_getAbsentees', 'wpsp_GetAbsentees' );
        add_action( 'wp_ajax_getAbsentDates', 'wpsp_GetAbsentDates' );
        add_action( 'wp_ajax_getAttReport', 'wpsp_GetAttReport' );

		add_action( 'wp_ajax_AddSubject', 'wpsp_AddSubject' );
		add_action( 'wp_ajax_SubjectInfo', 'wpsp_SubjectInfo' );
		add_action( 'wp_ajax_UpdateSubject', 'wpsp_UpdateSubject' );
		add_action( 'wp_ajax_DeleteSubject', 'wpsp_DeleteSubject' );
		add_action( 'wp_ajax_subjectList', 'wpsp_SubjectList' );

		add_action( 'wp_ajax_save_timetable', 'wpsp_SaveTimetable' );
		add_action( 'wp_ajax_deletTimetable', 'wpsp_DeleteTimetable' );
		
		add_action('wp_ajax_addMark','wpsp_AddMark');
		add_action('wp_ajax_getMarksubject','wpsp_getMarksubject');
		
		add_action('wp_ajax_genSetting','wpsp_GenSetting');
		add_action('wp_ajax_addSubField','wpsp_AddSubField');
		add_action('wp_ajax_updateSubField','wpsp_UpdateSubField');
		add_action('wp_ajax_deleteSubField','wpsp_DeleteSubField');
		add_action('wp_ajax_manageGrade','wpsp_ManageGrade');
		
		add_action('wp_ajax_addEvent','wpsp_AddEvent');
		add_action('wp_ajax_updateEvent','wpsp_UpdateEvent');
		add_action('wp_ajax_deleteEvent','wpsp_DeleteEvent');
		add_action('wp_ajax_listEvent','wpsp_ListEvent');

        add_action('wp_ajax_deleteAllLeaves','wpsp_DeleteLeave');
        add_action('wp_ajax_addLeaveDay','wpsp_AddLeaveDay');
        add_action('wp_ajax_getLeaveDays','wpsp_GetLeaveDays');
        add_action('wp_ajax_getClassYear','wpsp_GetClassYear');

        add_action('wp_ajax_addTransport','wpsp_AddTransport');
        add_action('wp_ajax_updateTransport','wpsp_UpdateTransport');
        add_action('wp_ajax_viewTransport','wpsp_ViewTransport');
        add_action('wp_ajax_deleteTransport','wpsp_DeleteTransport');

        add_action('wp_ajax_sendMessage','wpsp_SendMessage');
        add_action('wp_ajax_viewMessage','wpsp_ViewMessage');
        add_action('wp_ajax_deleteMessage','wpsp_DeleteMessage');

        add_action('wp_ajax_photoUpload','wpsp_UploadPhoto');
        add_action('wp_ajax_deletePhoto','wpsp_DeletePhoto');
		
		//Teacher modules
		add_action( 'wp_ajax_getTeachersList', 'wpsp_getTeachersList' );
		add_action( 'wp_ajax_TeacherAttendanceEntry', 'wpsp_TeacherAttendanceEntry' );
		add_action( 'wp_ajax_TeacherAttendanceDelete', 'wpsp_TeacherAttendanceDelete' );		
		add_action( 'wp_ajax_TeacherAttendanceView', 'wpsp_TeacherAttendanceView' );		
		
		//Notification modules
		add_action( 'wp_ajax_deleteNotify', 'wpsp_deleteNotify' );
		add_action( 'wp_ajax_getNotify', 'wpsp_getNotifyInfo' );
		
		//Change Password
		add_action( 'wp_ajax_changepassword', 'wpsp_changepassword' );		

		//Import Dummy data
		add_action( 'wp_ajax_ImportContents', 'wpsp_Import_Dummy_contents' );

		//add_action( 'wp_ajax_nopriv_action_public', 'action_public_callback' );

		add_action( 'wp_ajax_save_fees_settings', 'save_fees_settings' );
		
		add_action( 'wp_ajax_fetch_class_fees_settings', 'class_fees_settings' );

		add_action( 'wp_ajax_submit_deposit_form', 'submit_deposit_form' );

		add_action( 'wp_ajax_load_detailed_transaction', 'load_detailed_transaction' );

		add_action( 'wp_ajax_calculate_expected_amount', 'cal_expected_amount' );

		add_action( 'wp_ajax_calculate_expected_amount_transport', 'cal_trans_expected_amount' );

		add_action( 'wp_ajax_view_invoice_to_print', 'view_invoice' );

		add_action( 'wp_ajax_get_transport_routes', 'get_transport_routes' );

		add_action( 'wp_ajax_get_expected_admission_fees', 'cal_admission_fees' );

		add_action( 'wp_ajax_get_expected_annual_charge', 'cal_annual_charge' );

		add_action( 'wp_ajax_get_expected_recreation_charge', 'cal_recreation_charge' );

		add_action( 'wp_ajax_send_reminder_message', 'send_reminder_message' );

		add_action( 'wp_ajax_fetch_session_start_month', 'get_session_start' );

		add_action( 'wp_ajax_duplicate_month_fees_chk', 'duplicate_month_fees_chk' );

		add_action( 'wp_ajax_add_item_to_inv_master_table', 'add_invm_item' );

		add_action( 'wp_ajax_add_new_inventory_item_details', 'add_inventory_items' );

		add_action( 'wp_ajax_assign_inventory_item', 'assign_item' );
		
		add_action( 'wp_ajax_get_stock_status', 'get_stock_status' );

		add_action( 'wp_ajax_update_item_input', 'update_item_input' );

		add_action( 'wp_ajax_update_inv_item', 'update_inv_item' );

		add_action( 'wp_ajax_delete_master_item', 'delete_master_item' );

		add_action( 'wp_ajax_save_visitor_data', 'save_visitor_data' );

		add_action( 'wp_ajax_follow_up', 'follow_up' );

		add_action( 'wp_ajax_save_followup_comment', 'save_followup_comment' );

		add_action( 'wp_ajax_follow_up_history', 'follow_up_history' );

		add_action( 'wp_ajax_search_visitors', 'search_visitors' );

		add_action( 'wp_ajax_fill_visitors_info_into_students_form', 'fill_visitors_info' );

		add_action( 'wp_ajax_view_visitor_details', 'visitor_details' );

		add_action( 'wp_ajax_edit_visitor_data', 'edit_visitor_data' );

		add_action( 'wp_ajax_delete_visitor_record', 'delete_visitor_record' );

		add_action( 'wp_ajax_check_slip_number_availibility', 'check_slip_num_availibility' );

		add_action( 'wp_ajax_cancel_payment', 'cancel_payment' );
		
		add_action( 'wp_ajax_details_to_reassign_item', 'details_to_reassign_item' );
		
		add_action( 'wp_ajax_deduct_quantity_after_reassign_item', 'deduct_quantity_after_reassign_item' );

		add_action( 'wp_ajax_mark_inv_item_as_consumed', 'mark_item_consumed' );

		add_action( 'wp_ajax_ac_record_transaction_form', 'ac_record_transaction_form' );

		add_action( 'wp_ajax_ac_update_group_form', 'ac_update_group_form' );

		add_action( 'wp_ajax_ac_delete_group_form', 'ac_delete_group_form' );

		add_action( 'wp_ajax_ac_create_group_form', 'ac_create_group_form' );

		add_action( 'wp_ajax_ac_filter_transactions', 'ac_filter_transactions' );

		add_action( 'wp_ajax_make_custom_fees_dues', 'make_custom_fees_dues' );
}

function tl_save_error() {
    update_option( 'plugin_error',  ob_get_contents() );
}
add_action( 'activated_plugin', 'tl_save_error' );

add_action( 'init', 'wpsp_start_session', 1 );
function wpsp_start_session() {
	if(session_id() == '')
		session_start();
}
function wpsp_add_plugin_links( $links ) {
	$plugin_links = array(
		'<a href="admin.php?page=SchoolWeb"><strong style="color: #11967A; display: inline;">' . __( 'Settings', 'SchoolWeb' ) . '</strong></a>'
	);
	return array_merge( $plugin_links, $links );
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'wpsp_add_plugin_links', 20 );


//Student Fees

function single_student_fees($uid){
	global $wpdb;

	$single_student_fees_table = $wpdb->prefix."wpsp_single_student_fees";
	$fees_settings_table = $wpdb->prefix."wpsp_fees_settings";
	$student_table = $wpdb->prefix."wpsp_student";
	
	$single_sf_res = $wpdb->get_results("SELECT * FROM $single_student_fees_table WHERE uid = '$uid'");

	if($wpdb->num_rows > 0){
		$student_fees = $single_sf_res[0];
	} else{
		$regular_fees_res = $wpdb->get_results("SELECT a.* FROM $fees_settings_table a, $student_table b WHERE a.cid = b.class_id AND b.wp_usr_id='$uid'");
		$student_fees = $regular_fees_res[0];
	}

	return json_encode($student_fees);
}
add_filter("get_student_fees","single_student_fees");

function wpsp_get_class($id = 0){
	//returns all classes if id is 0
	global $wpdb;
	$table	=	$wpdb->prefix."wpsp_class";
	$sql = (!empty($id)) ? "SELECT * FROM $table WHERE cid = '$id' " : "SELECT * FROM $table";
	$results = $wpdb->get_results($sql);

	$return = ($wpdb->num_rows > 0) ? json_encode($results) : false;

	return $return;
}
add_filter("wpsp_get_class","wpsp_get_class");

function wpsp_session_info($session_info){
	//function to return current session and session start month in json
	global $wpdb;
	$settings_table	=	$wpdb->prefix."wpsp_settings";
	$result = $wpdb->get_results("SELECT option_name, option_value FROM $settings_table WHERE option_name='session' || option_name='sch_session_start'");
	
	$session_info = ($wpdb->num_rows > 0) ? json_encode($result) : "";

	return $session_info;
}
add_filter("wpsp_session_info","wpsp_session_info");

function wpsp_get_student($args){
	//returns all Students if nothing is passed or empty values are passed
	//accepts associative array for filtering students in the following format
	/*array(
		'id' => , <Pass wp_usr_id here to filter Students by class>
		'class' => , <Pass class_id here to filter Students by class>
	);*/
	global $wpdb;

	$id = (!empty($args['id'])) ? $args['id'] : 0;
	$class = (!empty($args['class'])) ? $args['class'] : 0;

	$table	=	$wpdb->prefix."wpsp_student";

	$sql = "SELECT * FROM $table WHERE 1=1";
	if(!empty($id)) $sql .= " AND wp_usr_id = '$id' ";
	if(!empty($class)) $sql .= " AND class_id = '$class' ";

	$results = $wpdb->get_results($sql);
	
	$return = ($wpdb->num_rows > 0) ? json_encode($results) : false;

	return $return;
}
add_filter("wpsp_get_student","wpsp_get_student");

/**************************************************Accounting Module Functions************************************************/
//fucnction to record a Transactions
function ac_record_transaction($args){
	$reference = (!empty($args['reference'])) ? $args['reference'] : "";
	$type = (!empty($args['type'])) ? $args['type'] : 0;
	$group = (!empty($args['group'])) ? $args['group'] : "";
	$remarks = (!empty($args['remarks'])) ? $args['remarks'] : "";
	$amount = (!empty($args['amount'])) ? $args['amount'] : "";
	$mop = (!empty($args['mop'])) ? $args['mop'] : "";
	global $wpdb;
	$date_time = date("Y-m-d H:i:s");
	$tid = apply_filters("ac_get_tid", $mop);
	$table = ($mop == 1) ? $wpdb->prefix."wpsp_cash_transactions" : $wpdb->prefix."wpsp_bank_transactions";
	$balance = ($type == 1) ? apply_filters("ac_get_balance", $mop) + $amount : apply_filters("ac_get_balance", $mop) - $amount;

	$trans_data = array(
		"tid" => $tid,
		"date_time" => $date_time,
		"reference" => $reference,
		"type" => $type,
		"group_id" => $group,
		"remarks" => $remarks,
		"amount" => $amount,
		"balance" => $balance
	);

	//echo "<pre>"; print_r($trans_data); echo "</pre>";

	return ($wpdb->insert($table, $trans_data)) ? true : false;
}
add_filter("ac_record_transaction", "ac_record_transaction");

//function to return Current Balance
function ac_balance($mode){  //mode accepts either cash or bank
	global $wpdb;
	$error = false;
	switch($mode){
		case 1:
			$cash_table = $wpdb->prefix."wpsp_cash_transactions";
			$sql = "SELECT balance FROM $cash_table ORDER BY date_time DESC LIMIT 1";
		break;
		case 2:
			$bank_table = $wpdb->prefix."wpsp_bank_transactions";
			$sql = "SELECT balance FROM $bank_table ORDER BY date_time DESC LIMIT 1";
		break;
		default: $error = true;
	}

	return (!$error) ? $wpdb->get_results($sql)[0]->balance : "Invalid Mode";
}
add_filter("ac_get_balance", "ac_balance");

//function to generate transaction id
function ac_tid($mop){
	global $wpdb;
	$error = false;
	$sql = "";
	switch($mop){
		case 1:
			$cash_table = $wpdb->prefix."wpsp_cash_transactions";
			$sql = "SELECT tid FROM $cash_table ORDER BY date_time DESC LIMIT 1";
		break;

		case 2:
			$bank_table = $wpdb->prefix."wpsp_bank_transactions";
			$sql = "SELECT tid FROM $bank_table ORDER BY date_time DESC LIMIT 1";
		break;

		default: $error = true;
	}
	$result = $wpdb->get_results($sql);

	return (!$error) ? ($wpdb->num_rows>0) ? $tid = (substr($result[0]->tid, 0, 6) != date("ymd")) ? date('ymd').'0' : $result[0]->tid+1 : $tid = date('ymd').'0' : "invalid mode of payment";
	
}
add_filter("ac_get_tid", "ac_tid");

//functions to return Transactions
function ac_transactions($args){
	//pass arguments in this Seqquence 	// 1. "mode"
										// 2. "from_date"
										// 3. "to_date" 
										// 4. "group_id"
	global $wpdb;
	$mode = (!empty($args['mode'])) ? $args['mode'] : 0;
	$from_date = (!empty($args['from_date'])) ? $args['from_date'] : "";
	$to_date = (!empty($args['to_date'])) ? $args['to_date'] : "";
	$group_id = (!empty($args['group_id'])) ? $args['group_id'] : "";

	$group_table = $wpdb->prefix."wpsp_transactions_group";
	$cash_table = $wpdb->prefix."wpsp_cash_transactions";
	$bank_table = $wpdb->prefix."wpsp_bank_transactions";
	$error = false;

	$query_param = "";

	foreach ($args as $key => $value) {
		switch ($key){
			case "mode":
				switch($mode){
					case 0:
						$sql = "SELECT *, 'cash' AS mop FROM $cash_table WHERE 1=1 [query_param] UNION ALL SELECT *, 'bank' AS mop FROM $bank_table WHERE 1=1 [query_param] ORDER BY date_time DESC";
					break;

					case 1:
						$sql = "SELECT *, 'cash' AS mop FROM $cash_table a WHERE 1=1 [query_param] ORDER BY date_time DESC";
					break;

					case 2:
						$sql = "SELECT *, 'bank' AS mop FROM $bank_table b WHERE 1=1 [query_param] ORDER BY date_time DESC";
					break;
				}
			break;

			case "from_date":
				if(!empty($from_date) && !empty($to_date)){
					$query_param = "AND DATE(date_time) BETWEEN '$from_date' AND '$to_date'";
				} else{
					$query_param = "AND DATE(date_time) > '$from_date' AND";
				}	
			break;

			case 'to_date':
				if(!empty($from_date) && !empty($to_date)){
					$query_param = "AND DATE(date_time) BETWEEN '$from_date' AND '$to_date'";
				} else{
					$query_param = "AND DATE(date_time) < '$to_date'";
				}	
			break;

			case 'group_id':
				$query_param .= " AND group_id=$group_id AND";
			break;
		}
	}

	$query_param = rtrim($query_param, "AND");

	(strpos($sql, "[query_param]")) ? $sql = str_replace("[query_param]", $query_param, $sql): "";

	//echo $sql."<br/>";

	if(!$error){
		return json_encode($wpdb->get_results($sql));
	}
}
add_filter("ac_get_transactions", "ac_transactions");

//function to get Group Name by ID
function ac_get_group_names($id){ // returns all groups if id is set to all
	if(empty($id)) return "";
	global $wpdb;
	$table = $wpdb->prefix."wpsp_transactions_group";
	$sql = ($id == "all") ? "SELECT * FROM $table" : "SELECT * FROM $table WHERE group_id='$id'";
	$results = $wpdb->get_results($sql);
	$results = json_encode($results);
	return $results;
}
add_filter("ac_get_group_names", "ac_get_group_names");

//Making Groups Accessible from accounting.js


//function to create group
function ac_create_group($group_name){
	global $wpdb;
	$table = $wpdb->prefix."wpsp_transactions_group";
	$data = array("group_name"=>$group_name);
	return ($wpdb->insert($table, $data)) ? true : false;
}
add_filter("ac_create_group", "ac_create_group");

//function to Delete Group
function ac_delete_group($id){
global $wpdb;
$table = $wpdb->prefix."wpsp_transactions_group";
return ($wpdb->query("DELETE FROM $table WHERE group_id='$id'")) ? true : false;
}
add_filter("ac_delete_group", "ac_delete_group");

//function to update Group
function ac_update_group($args){
	global $wpdb;
	$id = (!empty($args['id'])) ? $args['id'] : 0;
	$group_name = (!empty($args['group_name'])) ? $args['group_name'] : "";
	$table = $wpdb->prefix."wpsp_transactions_group";
	return ($wpdb->query("UPDATE $table SET group_name='$group_name' WHERE group_id='$id'")) ? true : $wpdb->print_error();
}
add_filter("ac_update_group", "ac_update_group");

//create default fee group
function ac_default_fees_group(){
	global $wpdb;

	$table = $wpdb->prefix."wpsp_transactions_group";

	$results = $wpdb->get_results("SELECT * FROM $table WHERE group_id = '1'");

	($wpdb->num_rows == 0) ? $wpdb->insert($table, array("group_id"=>1, "group_name"=>"Fees Submission")) : "";

}
add_action("ac_default_fees_group", "ac_default_fees_group");


/**************************************************Accounting Module Functions end************************************************/








