<?php
    wpsp_header();
    if( is_user_logged_in() ) {
    	global $current_user, $wp_roles, $wpdb;
    	//get_currentuserinfo();
    	foreach ($wp_roles->role_names as $role => $name) :
    	if (current_user_can($role))
    		$current_user_role = $role;
    	endforeach;
		if( $current_user_role == 'administrator' || $current_user_role == 'teacher' || $current_user_role == 'parent' || $current_user_role == 'student' ) {
			wpsp_topbar();
			wpsp_sidebar();
			wpsp_body_start(); 
			global $wpdb;
			$student_table		=	$wpdb->prefix."wpsp_student";
			$teacher_table		=	$wpdb->prefix."wpsp_teacher";
			$class_table		=	$wpdb->prefix."wpsp_class";
			$attendance_table	=	$wpdb->prefix."wpsp_attendance";
			$users_count		=	$wpdb->get_row("SELECT(SELECT COUNT(*)FROM $student_table)AS stcount,(SELECT COUNT(*)FROM $teacher_table) AS tcount,(SELECT COUNT(DISTINCT parent_wp_usr_id) FROM $student_table where `parent_wp_usr_id`!='') AS pcount,(SELECT COUNT(*) FROM $class_table) AS clcount");
		?>
		<section class="content-header">
			<h1>Dashboard</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('sch-dashboard');?>"><i class="fa fa-dashboard"></i><?php  _e( 'Home', 'WPSchoolPress'); ?></a></li>
				<li class="active"><?php _e( 'Dashboard', 'WPSchoolPress'); ?> </li>
			</ol>
		</section>
		<section class="content">
			<!-- Info boxes -->
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3><?php echo isset( $users_count->stcount ) ? $users_count->stcount : 0; ?></h3>
							<p>Students</p>
						</div>
						<div class="icon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></div>                
						<a href="sch-student" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>           
				</div>
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
							<h3><?php echo isset( $users_count->tcount ) ? $users_count->tcount : 0; ?></h3>
							<p>Teacher</p>
						</div>
						<div class="icon"><i class="fa fa-user-plus"></i></div>
						<a href="sch-teacher" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				
				<!-- fix for small devices only -->
				<div class="clearfix visible-sm-block"></div>
				<div class="col-md-3 col-sm-6 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3><?php echo isset( $users_count->pcount ) ? $users_count->pcount : 0; ?></h3>
							<p>Parents</p>
						</div>
						<div class="icon">
							<i class="fa fa-users"></i>
						</div>
						<a href="sch-parent" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-red">
						<div class="inner">
							<h3><?php echo isset( $users_count->clcount ) ? $users_count->clcount : 0; ?></h3>
							<p>Class</p>
						</div>
						<div class="icon"><i class="fa fa-bell"></i></div>
						<a href="sch-class" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>		    
			<div class="row">
				<!-- Left col -->
				<div class="col-md-8">
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Activities</h3>
						</div>
						<div class="box-body">
							<div class="dahboard-icon-content">
								<div class="dashboard-icon-event label-primary"></div>
								<label>Event</label>
							</div>
							<div class="dahboard-icon-content">
								<div class="dashboard-icon-event bg-red"></div>
								<label>Exam</label>
							</div>
							<div class="dahboard-icon-content">
								<div class="dashboard-icon-event bg-green"></div>
								<label>Holidays</label>
							</div>
							<div id="multiple-events"></div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Exams</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<?php
								$exam_table=$wpdb->prefix."wpsp_exam";
								$examinfo=$wpdb->get_results("select * from $exam_table order by e_s_date DESC");
								?>
							<table class="table table-bordered">
								<th>Date</th>
								<th>Exam</th>
								<?php foreach($examinfo as $exam) { ?>
								<tr>
									<td><?php echo wpsp_ViewDate($exam->e_s_date)." TO ".wpsp_ViewDate($exam->e_e_date);?></td>
									<td><?php echo $exam->e_name; ?></td>
								</tr>
								<?php } ?>
							</table>
						</div>
					</div>
<!--
					<div class="box box-success">
						<div class="box-header with-border">
							<?php
							//$settings_table=$wpdb->prefix."wpsp_settings";
							//$num_msg=$wpdb->get_results("SELECT option_value FROM $settings_table WHERE option_name='sch_num_sms'");
							//$num_of_msg = $num_msg[0]->option_value; ?>
							<h3 class="box-title">Number Of Messages(SMS) Left: <?php //echo $num_of_msg; ?></h3>
						</div>
					</div>
					-->
				</div>
		</div>
		</section>
	<?php 
		wpsp_body_end();
		wpsp_footer();
	} else {
		echo PERMISSION_MSG;
	}  
 } else {
    include_once( WPSP_PLUGIN_PATH .'/includes/wpsp-login.php');
	}

	//due monthly fees
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
	$session_start = $session_start_sql[0]->option_value;
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
					if(!empty($session_start)){
						if($curr_month < $session_start){
							$curr_month += 12;
						}
					}
					$sql_fees = $wpdb->get_results("SELECT tution_fees FROM $fees_settings_table WHERE cid='$student->class_id' ");
					foreach ($sql_fees as $f) {
						$tf = $f->tution_fees;
					}
					$sql_trans_fees = $wpdb->get_results("SELECT a.route_fees FROM $transport_table a, $student_table b WHERE a.id=b.route_id AND b.transport = 1 ");
					foreach ($sql_trans_fees as $trf) {
						$tc = $trf->route_fees;
					}
					$sql_tf_data = array('date'=>$todays_date, 'uid'=>$student->wp_usr_id, 'month'=>$curr_month, 'amount'=>$tf, 'fees_type'=>'ttn', 'session'=>$session);
					if($student->transport == 1){
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
						$msg = "Dear Parent, you are requested to submit the fees for the month of ".$curr_month_name.". *Regards SPI School";
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