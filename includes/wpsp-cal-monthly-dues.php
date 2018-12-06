<?php

	include "../../../../wp-config.php";
	global $wpdb;
	
	$wpdb->show_errors();
	$months_array = array("Select Month","January", "February", "March", "April", "May", "June", "july", "August", "September", "October", "November", "December"); 
	$settings_table		=	$wpdb->prefix."wpsp_settings";
	$script_status = $session_start = 0;
	$sql_exec_script = $wpdb->get_results("SELECT * FROM $settings_table WHERE option_name='due_php_script_status'");
	if($wpdb->num_rows==0){
		$script_status_data = array("option_name"=>"due_php_script_status", "option_value"=>"0");
		$wpdb->insert($settings_table, $script_status_data);
	}
	else{
		foreach ($sql_exec_script as $status) {
			$script_status = $status->option_value;
		}
	}
	$session_start_sql = $wpdb->get_results("SELECT option_value FROM $settings_table WHERE option_name='sch_session_start'");
	if(!empty($session_start_sql)) $session_start = $session_start_sql[0]->option_value;
	else $session_start = 0;
	if($script_status == 0){
		$curr_date			=	date('d');
		$curr_month			=	date('m');
		$todays_date		=	date("Y-m-d");
		$student_table		=	$wpdb->prefix."wpsp_student";
		$fees_settings_table=	$wpdb->prefix."wpsp_fees_settings";
		$dues_table			=	$wpdb->prefix."wpsp_fees_dues";
		$transport_table	=	$wpdb->prefix."wpsp_transport";
		$session 			=	0;
		$sql_session		= 	$wpdb->get_results("SELECT option_value FROM $settings_table WHERE option_name = 'session'");
		foreach ($sql_session as $session) {
			$session = $session->option_value;
		}

		$sql_due_date		= 	$wpdb->get_results("SELECT option_value FROM $settings_table WHERE option_name = 'due_date' AND option_value = '$curr_date' ");
		if($wpdb->num_rows>0){
			try{
				$student_sql = $wpdb->get_results("SELECT wp_usr_id, class_id, transport, s_phone FROM $student_table");
				foreach ($student_sql as $student) {
					$tf = 0;
					$tc = 0;
					$student_fees = json_decode(apply_filters("get_student_fees", $student->wp_usr_id));
					if(!empty($session_start)){
						if($curr_month < $session_start){
							$curr_month += 12;
						}
					}
					$tf = $student_fees->tution_fees;
					/*$sql_fees = $wpdb->get_results("SELECT tution_fees FROM $fees_settings_table WHERE cid='$student->class_id' ");
					foreach ($sql_fees as $f) {
						$tf = $f->tution_fees;
					}*/
					/*$sql_trans_fees = $wpdb->get_results("SELECT a.route_fees FROM $transport_table a, $student_table b WHERE a.id=b.route_id AND b.transport = 1 ");
					foreach ($sql_trans_fees as $trf) {
						$tc = $trf->route_fees;
					}*/
					$sql_tf_data = array('date'=>$todays_date, 'uid'=>$student->wp_usr_id, 'month'=>$curr_month, 'amount'=>$tf, 'fees_type'=>'ttn', 'session'=>$session);
					if($student->transport == 1){
						$tc = json_decode(apply_filters("wpsp_get_transport_route", array('id' => $student->route_id)))->route_fees;
						$sql_tc_data = array('date'=>$todays_date, 'uid'=>$student->wp_usr_id, 'month'=>$curr_month, 'amount'=>$tc, 'fees_type'=>'trn', 'session'=>$session);
					}
				
					$wpdb->query("BEGIN;");

					if($wpdb->insert($dues_table, $sql_tf_data) == false) throw new Exception($wpdb->print_error());
					
					if($student->transport == 1){
						if($wpdb->insert($dues_table, $sql_tc_data) == false) throw new Exception($wpdb->print_error());
					}
					
					if(!empty($student->s_phone)){
						$c_month = date('m');
						$c_month = (int)$c_month;
						$curr_month_name = $months_array[$c_month];
						$mobile = $student->s_phone;
						$sql_SchoolName		= 	$wpdb->get_results("SELECT option_value FROM $settings_table WHERE option_name = 'sch_name'");
						$msg = "Dear Parent, you are requested to submit the fees for the month of ".$curr_month_name." Please ignore if you have already submitted. *Regards ".$sql_SchoolName[0]->option_value;
						$check_sms = $wpdb->get_results("SELECT option_value FROM $settings_table WHERE option_name='sch_num_sms'");
						$sms_left = $check_sms[0]->option_value;
						if($sms_left > 0){
							$reminder_msg_response	= apply_filters( 'wpsp_send_notification_msg', false, $mobile, $msg );
							if( $reminder_msg_response ){
								$status = 1;
								$num_msg = ceil(strlen($msg)/150);
								if($wpdb->query("UPDATE $settings_table SET option_value=option_value-'$num_msg' WHERE option_name='sch_num_sms'") == false){
									throw new Exception($wpdb->print_error());
								}
							}
						}
					}

				}

				//echo "<div  style='float:right;' class='alert alert-success'>Success</div>";
				if($wpdb->query("UPDATE $settings_table SET option_value='1' WHERE option_name='due_php_script_status'")==false) throw new Exception($wpdb->print_error());
				$wpdb->query("COMMIT;");
			}
			catch(Exception $e){
				$wpdb->query("ROLLBACK;");
				echo "<div  style='float:right;' class='alert alert-danger'>ERROR!".$e->getMessage()."</div>";
			}
		}
	}
	$due_date_scr = 0;
	$sql_due_date_scr	= 	$wpdb->get_results("SELECT option_value FROM $settings_table WHERE option_name = 'due_php_script_status'");
	foreach ($sql_due_date_scr as $due_date_scr) {
		$due_date_scr = $due_date_scr->option_value;
	} ?>
	<script type="text/javascript">
		//alert('<?php echo $due_date_scr; ?>');
	</script><?php
	if(!empty($due_date_scr)){
		$next_day_res = $wpdb->get_results("SELECT * FROM $settings_table WHERE option_name='due_date'");
		$next_day = $next_day_res[0]->option_value + 1;
		if(date("d") == $next_day){
			$wpdb->query("UPDATE $settings_table SET option_value = '0' WHERE option_name = 'due_php_script_status' ");
		}
	}

?>