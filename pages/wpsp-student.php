<?php
wpsp_header();
	if( is_user_logged_in() ) {
		global $current_user, $wp_roles, $wpdb;

		//get_currentuserinfo();
		foreach ( $wp_roles->role_names as $role => $name ) :
		if ( current_user_can( $role ) )
			$current_user_role =  $role;
		endforeach;
		if($current_user_role=='administrator' || $current_user_role=='teacher') {
			wpsp_topbar();
			wpsp_sidebar();
			wpsp_body_start();
			$filename	=	WPSP_PLUGIN_PATH .'includes/wpsp-studentList.php';
			if( isset( $_GET['tab'] ) && $_GET['tab'] == 'addstudent' ) {
				$label	=	__( 'Add New Student', 'WPSchoolPress');
				$filename	=	WPSP_PLUGIN_PATH .'includes/wpsp-studentForm.php';
			} else if( isset($_GET['id']) && is_numeric($_GET['id']) ) {
				$label	=	__( 'Update Student', 'WPSchoolPress');
				$filename	=	WPSP_PLUGIN_PATH .'includes/wpsp-studentProfile.php';
			} else if( isset( $_POST['ClassID'] ) && empty( $_POST['ClassID'] ) ) {
				 $label	=	'List Of Unassigned Students';
			} else if( isset( $_POST['ClassID']  ) && $_POST['ClassID']=='all' ) {
				 $label	=	'List Of All Students';
			}
			else {				
				$where	=	'';
				if( isset( $_POST['ClassID'] ) && !empty( $_POST['ClassID'] ) ) {
					$where =	' where  cid='.$_POST['ClassID'];
				}
				$class_table	=	$wpdb->prefix."wpsp_class";
				$sel_class		=	$wpdb->get_var("select c_name from $class_table $where Order By cid ASC");
				$label	=	'List of class ' .$sel_class. ' Students';
			}			
			?>
			<section class="content-header">
				<h1><?php echo $label; ?></h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo site_url('sch-dashboard'); ?> "><i class="fa fa-dashboard"></i><?php _e( 'Dashboard', 'WPSchoolPress'); ?> </a></li>
					<li><a href="<?php echo site_url('sch-student'); ?>"><?php _e( 'Students', 'WPSchoolPress'); ?></a></li>
					<?php if(isset($_GET['ac']) && $_GET['ac']=='add') { ?>
					<li class="active"><?php _e( 'Add New', 'WPSchoolPress'); ?></li>
					<?php } ?>
					<?php if(isset($_GET['id']) && is_numeric($_GET['id'])) { ?>
					<li class="active"><?php _e( 'Edit Student', 'WPSchoolPress'); ?></li>
					<?php } ?>
				</ol>
			</section>
			<?php
			include_once ( $filename );			
			do_action('wpsp_student_import_html');
			wpsp_body_end();
			wpsp_footer();
	}else if($current_user_role=='parent') {
		
		/* Parents can View their children's class students */
		wpsp_topbar();
		wpsp_sidebar();
		wpsp_body_start();
		global $wpdb;
		$parent_id		=	$current_user->ID;
		$student_table	=	$wpdb->prefix."wpsp_student";
		$class_table	=	$wpdb->prefix."wpsp_class";		
		$users_table 	= 	$wpdb->prefix."users";			
		$fees_table 	=	$wpdb->prefix."wpsp_fees_receipts";
		$record_table 	=	$wpdb->prefix."wpsp_fees_payment_record";
		$dues_table = $wpdb->prefix."wpsp_fees_dues";
		$students		=	$wpdb->get_results("select st.wp_usr_id, st.class_id, st.s_fname AS full_name,cl.c_name from $student_table st LEFT JOIN $class_table cl ON cl.cid=st.class_id where st.parent_wp_usr_id='$parent_id'");
		$child=array();		
		foreach($students as $childinfo){
			//$studentName = !empty( $childinfo->first_name ) ? $childinfo->first_name : ;;
			$child[]=array('student_id'=>$childinfo->wp_usr_id,'name'=>$childinfo->full_name,'class_id'=>$childinfo->class_id,'class_name'=>$childinfo->c_name);
		}
		?>
		<section class="content-header">
			<h1>Your Child(s) Information</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('sch-dashboard'); ?> "><i class="fa fa-dashboard"></i><?php _e( 'Dashboard', 'WPSchoolPress'); ?></a></li>
				<li><a href="<?php echo site_url('sch-student'); ?>"><?php _e( 'Child(s)', 'WPSchoolPress'); ?></a></li>
			</ol>
		</section>
		<section class="content">
			<?php if( count( $child ) > 0 ) { ?>
			<div class="tabbable-line">
				<div class="nav-tabs-custom">
				<ul class="nav nav-tabs ">
					<?php $i=0; foreach($child as $ch) { ?>
						<li class="<?php echo ($i==0)?'active':''?>"><a href="#<?php echo str_replace(' ', '', $ch['name'].$i );?>"  data-toggle="tab"><?php echo $ch['name'];?></a></li>
					<?php $i++; } ?>
				</ul>

				<div class="tab-content">
					<?php
					$i=0;
					foreach($child as $ch) {
						$ch_class=$ch['class_id'];
						?>
					<div class="tab-pane <?php echo ($i==0)?'active':''?>" id="<?php echo str_replace(' ', '', $ch['name'].$i );?>">
						<!--<caption><?php echo $ch['class_name'];?></caption> -->
						<div class="studentProfile">
						<?php
						$sid=$ch['student_id'];						
						$stinfo=$wpdb->get_row("select a.*,b.c_name,CONCAT_WS(' ', a.s_fname, a.s_mname, a.s_lname ) AS full_name,d.user_email from $student_table a LEFT JOIN $class_table b ON a.class_id=b.cid LEFT JOIN $users_table d ON d.ID=a.wp_usr_id where a.wp_usr_id='$sid'");
						if(!empty($stinfo)) {							
						?>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="panel panel-info">
										<div class="panel-heading">
											<h3 class="panel-title"><?php echo $stinfo->full_name; ?></h3>
										</div>
											<div class="panel-body">
												<div class='fee-records-container'>
													<div class='panel-group' id='accordion'>
														<div class='panel panel-primary'>
															<h4 class='panel-title'>
																<button type='button' class='btn btn-primary btn-block' id='collapse-button' data-toggle='collapse' href='#fees-details'><i class='fa fa-inr' aria-hidden='true'></i> View Fees Details</button>
															</h4>
															<div id='fees-details' class='panel-collapse collapse in'>
																<div id='panel-body' class='panel-body'>
																	<table>
																		<tr class='tab-head'>
																			<td>Date And Time</td>
																			<td>Slip Number</td>
																			<td>Session</td>
																			<td>Amount</td>
																		</tr> <?php
																		$sql_fees = $wpdb->get_results("SELECT * FROM $fees_table WHERE uid = '$sid' ORDER BY slip_no DESC");
																		foreach ($sql_fees as $fee) {
																			$total_amt = $fee->adm+$fee->ttn+$fee->trans+$fee->ann+$fee->rec; ?>
																			<tr class="fees-single-row" id='<?php echo $fee->slip_no; ?>'>
																				<td>
																					<?php
																					$sql_slip_date = $wpdb->get_results("SELECT date_time FROM $record_table WHERE slip_no='$fee->slip_no' LIMIT 1");
																					foreach ($sql_slip_date as $date_time) {
																						echo date('d/m/Y h:i:s', strtotime($date_time->date_time));
																					} ?>
																						
																				</td>
																				<td><?php echo $fee->slip_no; ?></td>
																				<td><?php echo $fee->session; ?></td>
																				<td><i class="fa fa-inr"></i><?php echo number_format($total_amt); ?>/-</td>
																			</tr>
																		<?php } ?>
																	</table>
																</div>
															</div>
														</div>
													</div>
												</div>
												<?php 
													$due = "";
													$sql_dues = $wpdb->get_results("SELECT SUM(amount) AS amount FROM $dues_table WHERE uid='$stinfo->wp_usr_id'");
													foreach ($sql_dues as $due) {
														$due = $due->amount;
													}
													if(!empty($due)){ ?>
														<div class='due-container'>
															<div class='panel-group' id='accordion'>
																<div class='panel panel-primary'>
																	<h4 class='panel-title'>
																		<button type='button' class='btn btn-danger btn-block' id='collapse-button' data-toggle='collapse' href='#due-fees-details'><?php echo "<i class='fa fa-inr'></i>".number_format($due)." is due to this student"; ?></button>
																	</h4>
																	<div id='due-fees-details' class='panel-collapse collapse'>
																		<div id='panel-body' class='panel-body'>
																			<table>
																				<tr class='tab-head'>
																					<td>Fees Type</td>
																					<td>Amount</td>
																					<td>Month</td>
																					<td>Session</td>
																				</tr> <?php
																				$sql_dues_det = $wpdb->get_results("SELECT * FROM $dues_table WHERE uid='$stinfo->wp_usr_id'");
																				foreach ($sql_dues_det as $due_fee) {
																					if(!empty($due_fee->amount)){
																						switch ($due_fee->fees_type) {
																						 	case 'adm':
																						 		$fees_type = "Admission Fees";
																						 	break;
																						 	
																						 	case "ttn":
																						 		$fees_type = "Tution Fees";
																						 	break;

																						 	case 'trn':
																						 		$fees_type = "Transport Charges";
																						 	break;
																						 	
																						 	case "ann":
																						 		$fees_type = "Annual Charges";
																						 	break;

																						 	case "rec":
																						 		$fees_type = "Recreation Charges";
																						 	break;
																						 } ?>
																						<tr id='<?php echo $due_fee->id; ?>'>
																							<td><?php echo $fees_type ?></td>
																							<td><?php echo "<i class='fa fa-inr'></i>".number_format($due_fee->amount)."/-"; ?></td>
																							<td><?php echo $months_array[$due_fee->month]; ?></td>
																							<td><?php echo $due_fee->session; ?></td>
																						</tr>
																					<?php } 
																				} ?>
																			</table>
																		</div>
																	</div>
																</div>
															</div>
														</div> <?php
													}
												?>
												<div class="row">
													<div class="col-md-3 col-lg-3">
														<?php
														$loc_avatar=get_user_meta($sid,'simple_local_avatar',true);													
														$img_url= $loc_avatar ? $loc_avatar['full'] : WPSP_PLUGIN_URL.'img/avatar.png';
														?>
														<img src="<?php echo $img_url;?>" height="150px" width="150px" class="img img-circle"/>
													</div>
													<div class=" col-md-9 col-lg-9 table-responsive">
														<table class="table table-user-information">
															<tbody>
															<tr>
																<td class="bold"><?php _e( 'Roll No.', 'WPSchoolPress'); ?></td>
																<td><?php echo $stinfo->s_rollno;	?></td>
															</tr>
															<?php // Bharatdan Gadhavi - 13th Feb 2018 - Start ?>
															<tr>
																<td class="bold"><?php _e( 'Registration Number', 'WPSchoolPress'); ?></td>
																<td><?php echo $stinfo->s_regno;	?></td>
															</tr>
															<?php // Bharatdan Gadhavi - 13th Feb 2018 - End ?>
															<tr>
																<td class="bold"><?php _e( 'Class', 'WPSchoolPress'); ?> </td>
																<td><?php echo $stinfo->c_name;	?></td>
															</tr>
															<tr>
																<td class="bold"><?php _e( 'Gender', 'WPSchoolPress'); ?></td>
																<td><?php echo $stinfo->s_gender;	?></td>
															</tr>
															<tr>
																<td class="bold"><?php _e( 'Date of Birth', 'WPSchoolPress' );?></td>
																<td><?php echo wpsp_ViewDate($stinfo->s_dob);	?></td>
															</tr>
															<tr>
																<td class="bold"><?php _e( 'Date of Join', 'WPSchoolPress'); ?></td>
																<td><?php echo wpsp_ViewDate($stinfo->s_doj);	?></td>
															</tr>
															<tr>
																<td class="bold"><?php _e( 'Permanent Address', 'WPSchoolPress'); ?></td>
																<td><?php echo $stinfo->s_paddress; ?></td>
															</tr>
															<tr>
																<td class="bold"><?php _e( 'Permanent Country', 'WPSchoolPress'); ?></td>
																<td><?php echo $stinfo->s_pcountry; ?></td>
															</tr><tr>
																<td class="bold"><?php _e( 'Permanent Zipcode', 'WPSchoolPress'); ?></td>
																<td><?php echo $stinfo->s_pzipcode; ?></td>
															</tr>
															<tr>
																<td class="bold"><?php _e( 'Email', 'WPSchoolPress'); ?></td>
																<td><?php echo $stinfo->user_email; ?></td>
															</tr>
															<tr>
																<td class="bold"><?php _e( 'Phone Number', 'WPSchoolPress'); ?></td>
																<td><?php echo $stinfo->s_phone; ?></td>
															</tr>
															<tr>
																<td class="bold"><?php _e( 'Blood Group', 'WPSchoolPress'); ?></td>
																<td><?php echo $stinfo->s_bloodgrp; ?></td>
															</tr>																														
															</tbody>
														</table>
													</div>
												</div>
											</div>
											</div>
									</div>
								</div>
							</div>
					<?php } else {
				_e( 'Sorry! No data retrieved', 'WPSchoolPress');
			}
			?>
					</div>
					<?php $i++; } ?>
				</div>
			</div>
			</div>
			<?php
			} else {
				echo 'No Child Added, Please contact teacher/admin to add your child';
			} ?>
		</section>
		<?php
		wpsp_body_end();
		wpsp_footer();
	} else if($current_user_role=='student') {		
			wpsp_topbar();
			wpsp_sidebar();
			wpsp_body_start();
			global $wpdb;
			$student_id=$current_user->ID;
			$student_table=$wpdb->prefix."wpsp_student";
			$class_table=$wpdb->prefix."wpsp_class";
			$student=$wpdb->get_row("select st.class_id,  CONCAT_WS(' ', st.s_fname, st.s_mname, st.s_lname ) AS full_name,cl.c_name from $student_table st LEFT JOIN $class_table cl ON cl.cid=st.class_id where st.wp_usr_id='$student_id'");			
			?>
			<section class="content-header">
				<h1><?php _e( 'Students', 'WPSchoolPress'); ?></h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo site_url('sch-dashboard'); ?> "><i class="fa fa-dashboard"></i><?php _e( 'Dashboard', 'WPSchoolPress'); ?></a></li>
					<li><a href="<?php echo site_url('sch-student'); ?>"><?php _e( 'Students', 'WPSchoolPress'); ?></a></li>
				</ol>
			</section>
			
			<section class="content">
				
				<div class="box box-info">
					 <div class="box-header ui-sortable-handle" style="cursor: move;">
                                    <i class="fa fa-graph"></i>
                                    <h3 class="box-title"><i class="fa fa-building-o" aria-hidden="true"></i>&nbsp; <?php
							$st_class=$student->class_id;
							if( isset( $student->c_name ) && !empty( $student->c_name ) ) 
								_e( 'Your Current Class is '.$student->c_name, 'WPSchoolPress' );
							?> </h3>
                                    <!-- tools box -->
                                  
                                    <!-- /. tools -->
                                </div>
						<div class="box-body table-responsive">
								<table class="table table-bordered table-striped ">
									<thead>
									<tr>
										<th>#</th>
										<th><?php _e( 'Roll No.', 'WPSchoolPress' ); ?></th>										
										<th><?php _e( 'Student Name', 'WPSchoolPress' );?></th>
										<th><?php _e( 'Parent Name', 'WPSchoolPress' ); ?></th>
										<th><?php _e( 'Permanent Address', 'WPSchoolPress' );?></th>
									</tr>
									</thead>
									<tbody>
									<?php
									$cl_students=$wpdb->get_results("select wp_usr_id, class_id, CONCAT_WS(' ', s_fname, s_mname, s_lname ) AS full_name,parent_wp_usr_id, CONCAT_WS(' ', p_fname, p_mname, p_lname ) AS p_full_name, CONCAT_WS(' ', s_paddress, s_pcity, s_pcountry ) AS peraddress, s_rollno from $student_table where class_id=$st_class");									
									$sno=1;
									foreach($cl_students as $cl_st) {										
										?>
										<tr>
											<td><?php echo $sno;?></td>
											<td><?php echo $cl_st->s_rollno;?></td>											
											<td><?php echo $cl_st->full_name;?></td>
											<td><?php echo $cl_st->p_full_name;?></a>
											<!--<td><a href="javascript:;" class="ViewParent" data-id="<?php echo $cl_st->parent_wp_usr_id;?>"><?php echo $cl_st->p_full_name;?></a></td>-->
											<td><?php echo $cl_st->peraddress;?>&nbsp;</td>
										</tr>
										<?php
										$sno++;
									}
									?>
									</tbody>
								</table>
							</div>
			</div>
			</section>
			
			<?php
			wpsp_body_end();
			wpsp_footer();
	}
	?>
		<!-- Modal for View-->
		<div class="modal modal-wide" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="AVEModal" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div id="ViewModalContent">
				</div>
			</div>
		</div><!-- /.modal -->
	<?php
	}
	else {
		//Include login
		include_once( WPSP_PLUGIN_PATH.'/includes/wpsp-login.php');
	}
	?>