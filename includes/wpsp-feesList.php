<?php $proversion	=	wpsp_check_pro_version();
	  $proclass		=	!$proversion['status'] && isset( $proversion['class'] )? $proversion['class'] : '';
	  $protitle		=	!$proversion['status'] && isset( $proversion['message'] )? $proversion['message']	: '';
	  $prodisable	=	!$proversion['status'] ? 'disabled="disabled"'	: '';
	  $studentFieldList =  array(	's_rollno'			=>	__('Roll Number', 'SchoolWeb'),
									's_regno'			=>	__('Registration Number', 'SchoolWeb'),	// Bharatdan Gadhavi - 13th Feb 2018
									's_fname'			=>	__('Student First Name', 'SchoolWeb'),	
									's_mname'			=>	__('Student Middle Name', 'SchoolWeb'),	
									's_lname'			=>	__('Student Last Name', 'SchoolWeb'),	
									's_zipcode'			=>	__('Zip Code', 'SchoolWeb'),	
									's_country'			=>	__('Country', 'SchoolWeb'),	
									's_gender'			=>	__('Gender', 'SchoolWeb'),	
									's_address'			=>	__('Current Address', 'SchoolWeb'),	
									's_paddress'		=>	__('Permanent Address', 'SchoolWeb'),	
									'p_fname '			=>	__('Parent First Name', 'SchoolWeb'),	
									's_bloodgrp'		=>	__('Blood Group', 'SchoolWeb'),	
									's_dob'				=>	__('Date Of Birth', 'SchoolWeb'),	
									's_doj'				=>	__('Date Of Join', 'SchoolWeb'),										
									's_phone'			=>	__('Phone Number', 'SchoolWeb'),	
							);
	$teacherId	=	0;
	global $current_user;	
	$role		=	 $current_user->roles;
	$cuserId	=	 $current_user->ID;
	$months_array = array("N/A","January", "February", "March", "April", "May", "June", "july", "August", "September", "October", "November", "December");
?>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-solid bg-blue-gradient">
					<div class="box-header ui-sortable-handle" style="cursor: move;">
	                    <i class="fa fa-graph"></i>
	                    <h3 class="box-title"><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp; Payments Due list </h3>
	                    <!-- tools box -->

	                    <!-- /. tools -->
	                </div>

		            <div class="box-footer text-black">
						<div class="col-md-12 col-lg-12 col-sm-12" style="padding:0;display: inline-block; margin-bottom:10px">
							<div class="col-md-6 col-sm-12 col-lg-6 float-left">
								<form name="StudentClass" id="StudentClass" method="post" action="" class="class-filter">
									<label><?php _e( 'Select Class Name', 'SchoolWeb' ); ?></label>
									<select name="ClassID" id="ClassID" class="form-control">
										<?php 
										$sel_classid	=	isset( $_POST['ClassID'] ) ? $_POST['ClassID'] : '';										
										$class_table	=	$wpdb->prefix."wpsp_class";
										$sel_class		=	$wpdb->get_results("select cid,c_name from $class_table Order By cid ASC");
										foreach( $sel_class as $classes ) {
										?> 
											<option value="<?php echo $classes->cid;?>" <?php if($sel_classid==$classes->cid) echo "selected"; ?>><?php echo $classes->c_name;?></option>
										<?php } ?>
										 <?php if ( in_array( 'administrator', $role ) || in_array( 'editor', $role )  ) { ?>
											<option value="all" <?php if($sel_classid=='all') echo "selected"; ?>><?php _e( 'All', 'SchoolWeb' ); ?></option>
										 <?php } ?>
									</select>	
								</form>							
								<button style="float: right;" type="button" class="btn btn-success reminder-btn"><i class="fa fa-envelope-o"></i> Send Fee Reminder</button>
							</div>
							<div class="col-md-6 col-sm-12 col-lg-6 ">
									
								<div class="button-group btn-pro" <?php echo $prodisable;?> title="<?php echo $protitle;?>">

									<a class="btn btn-primary" href="?tab=DueFees"><i class="fa fa-plus"></i> Due Fees</a>
									<a class="btn btn-primary" href="?tab=DepositFees"><i class="fa fa-plus"></i> Deposit Fees</a>
									<a class="btn btn-primary" href="?tab=PaymentHistory"><i class="fa fa-history"></i> Payment History</a>
									<a class="btn btn-primary" href="?tab=concession"><i class="fa fa-tag"></i> Concessions</a>
									<!--<div class="dropdown"> 
										<a class="btn btn-primary st-btn add-student-btn" href="?tab=addstudent"><i class="fa fa-plus"></i> Add student</a>
										<button type="button" class="btn btn-primary dropdown-toggle print" id="PrintStudent" data-toggle="dropdown" <?php echo $prodisable;?> title="<?php echo $protitle;?>">
											<i class="fa fa-print" ></i> <?php _e( 'Print', 'SchoolWeb'); ?> 
										</button>
										<button type="button" class="btn btn-primary dropdown-toggle toggle-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" <?php echo $prodisable;?> title="<?php echo $protitle;?>">
											<span class="caret"></span>
											<span class="sr-only"><?php _e( 'Toggle Dropdown', 'SchoolWeb' );?></span>
										</button>
										<ul class="dropdown-menu">
											<li class="dropdown-header"><?php _e( 'Select Columns to Print', 'SchoolWeb' );?> </li>
											<form id="StudentColumnForm" name="StudentColumnForm" method="POST">
												<?php foreach( $studentFieldList as $key=>$value ) { ?>
													<li class="checkbox checkbox-info" >
														<input type="checkbox" name="StudentColumn[]" value="<?php echo $key; ?>" id="<?php echo $key; ?>" checked="checked">
														<label for="<?php echo $key; ?>"><?php echo $value; ?></label>
													</li>
												<?php } ?>
												<?php $currentSelectClass =	isset($_POST['ClassID']) ? $_POST['ClassID'] : $sel_class[0]->cid; ?>
												<input type="hidden" name="ClassID" value="<?php  echo $currentSelectClass; ?>">
												<input type="hidden" name="exportstudent" value="exportstudent">
											</form>
										</ul> 
									</div>
									<div class="btn-group dropdown">
										<button id="ImportStudent" class="btn btn-primary dropdown-toggle impt" <?php echo $prodisable;?> title="<?php echo $protitle;?>"><i class="fa fa-upload"></i> Import </button>									
										<button type="button" class="btn btn-primary print" id="ExportStudents" <?php echo $prodisable;?> title="<?php echo $protitle;?>"><i class="fa fa-download"></i> <?php _e( 'Export', 'SchoolWeb'); ?> </button>
										<button type="button" class="btn btn-primary dropdown-toggle export-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" <?php echo $prodisable;?> title="<?php echo $protitle;?>">
											<span class="caret"></span>
											<span class="sr-only"><?php _e( 'Toggle Dropdown', 'SchoolWeb' );?></span>
										</button>
										<ul class="dropdown-menu">
											<li class="dropdown-header"><?php _e( 'Select Columns to Export', 'SchoolWeb' );?> </li>
											<form id="ExportColumnForm" name="ExportStudentColumn" method="POST">
												<?php foreach( $studentFieldList as $key=>$value ) { ?>
												<li class="checkbox checkbox-info">
													<input type="checkbox" name="StudentColumn[]" value="<?php echo $key; ?>" id="<?php echo $key; ?>" checked="checked">
													<label for="<?php echo $key; ?>"><?php echo $value; ?></label>
												</li>
												<?php } ?>											
												<input type="hidden" name="ClassID" value="<?php  echo $currentSelectClass; ?>">
												<input type="hidden" name="exportstudent" value="exportstudent">
											</form>
										</ul>
									</div>-->
								</div>
										
							</div>
						</div>

						<div class="col-md-12 table-responsive">
							<table id="student_table" class="table table-bordered table-striped table-responsive" style="margin-top:10px">
								<thead>
									<tr>
										<th class="nosort">
										<?php if ( in_array( 'administrator', $role ) || in_array( 'editor', $role )  ) { ?><input type="checkbox" id="selectall" name="selectall" class="ccheckbox"><?php } else echo 'Sr. No.'; ?>
										</th>
										<th>Roll No.</th>
										<th>Registration No.</th>
										<th>Full Name</th>
										<th>Parent</th>
										<th>Class</th>
										<th>Amount Due</th>
										<th>Month</th>
										<th class="nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$student_table	=	$wpdb->prefix."wpsp_student";							
									$users_table	=	$wpdb->prefix."users";
									$fee_rec_table	=	$wpdb->prefix."wpsp_fees_receipts";
									$class_table = $wpdb->prefix."wpsp_class";
									$dues_table = $wpdb->prefix."wpsp_fees_dues";
									$class_id='';						
									if( isset($_POST['ClassID'] ) ) {
										$class_id=$_POST['ClassID'];
									}else if( !empty( $sel_class ) ) {
										$class_id = $sel_class[0]->cid;
									}
									$classquery	=	" AND s.class_id='$class_id' ";
									if($class_id=='NULL'){
										$classquery	=	" AND isNULL(s.class_id) ";
									}elseif($class_id=='all'){
										$classquery="";
									}
									
									//$students	=	$wpdb->get_results("select * from $student_table s, $users_table u, $fee_status_table f where u.ID=s.wp_usr_id $classquery AND s.sid = f.sid AND (f.admission_fees != 0 OR f.tution_fees != 0 OR f.transport_chg != 0 OR annual_chg != 0 OR recreation_chg != 0) order by sid desc");
									$students	=	$wpdb->get_results("SELECT s.s_fname, s.s_mname, s.s_lname, s.p_fname, s.p_mname, s.p_lname, s.s_rollno, s.s_regno, s.wp_usr_id, d.amount AS due_amount, d.fees_type, d.month, c.c_name FROM $student_table s, $dues_table d, $class_table c WHERE s.wp_usr_id=d.uid AND c.cid=s.class_id $classquery");
									$plugins_url=plugins_url();
									$teacherId = '';
									if( $currentSelectClass != 'all' )
										$teacherId	=	$wpdb->get_var("select teacher_id from $class_table WHERE cid=$currentSelectClass");
									$key =0;
									foreach($students as $stinfo)
									{	
										$key++;	
										if(!empty($stinfo->due_amount)){				
									?>
											<tr class="z-checkbox-row">
											<td>
											<?php if ( in_array( 'administrator', $role ) || in_array( 'editor', $role )  ) { ?>
												<input type="checkbox" class="ccheckbox strowselect" name="UID[]" value="<?php echo $stinfo->wp_usr_id;?>">
											<?php }else echo $key; ?>
											</td>
											<td><?php echo $stinfo->s_rollno;?></td>
											<td><?php echo $stinfo->s_regno;?></td>
											<td><?php 
												$mname = $stinfo->s_mname;
									            $lname = $stinfo->s_lname;
											echo $stinfo->s_fname .' '. $mname .' '.  $lname;?></td>
											<td><?php  echo $stinfo->p_fname; ?>
											</td>
											<td><?php /*
												$country = !empty( $stinfo->s_country ) ? ", ".$stinfo->s_country : '';
												$city    = !empty( $stinfo->s_city ) ? ", ".$stinfo->s_city : '';
												$zipcode    = !empty( $stinfo->s_zipcode ) ? ", ".$stinfo->s_zipcode : '';
												echo $stinfo->s_address.' '.$city. ' ' . $country.' '.$zipcode;
												*/
												echo $stinfo->c_name;
											?></td>
											<td>
												<?php
													if($stinfo->fees_type == "adm") $fees_type = "Admission Fees";
													if($stinfo->fees_type == "ttn") $fees_type = "Tution Fees";
													if($stinfo->fees_type == "trn") $fees_type = "Transportation Charges";
													if($stinfo->fees_type == "ann") $fees_type = "Annual Charges";
													if($stinfo->fees_type == "rec") $fees_type = "Recreation Charges";
													echo "<i class='fa fa-inr'></i>".number_format($stinfo->due_amount)."(".$fees_type.")";
													
												?>
											</td>
											<td><?php if($stinfo->month > 12) echo $months_array[$stinfo->month-12]; else echo $months_array[$stinfo->month]; ?></td>
											<td>
												<a href="<?php echo "?id=".$stinfo->wp_usr_id;?>" class="ViewStudent" data-id="<?php echo $stinfo->wp_usr_id;?>" title="View"><i class="fa fa-eye btn btn-success"></i></a> 										
																					
												<?php if ( in_array( 'administrator', $role ) || in_array( 'editor', $role )  || ( !empty( $teacherId ) && $teacherId==$cuserId ) ) { ?>
													<a href="?uidff=<?php echo $stinfo->wp_usr_id; ?>" title="Deposit Fees"><i class="fa fa-plus btn btn-danger"></i></a> 
												<?php } ?>
											</td>
										</tr>
									<?php }
									}
									?>
								</tbody>
								<tfoot>
								  <tr>
									<th><?php if ( in_array( 'administrator', $role ) || in_array( 'editor', $role )  ) { } 
										else echo 'Sr. No'; ?></th>
									<th>Roll No.</th>	
									<th>Registration No.</th>				
									<th>Name</th>
									<th>Parent</th>
									<th>Class</th>
									<th>Amount Due</th>
									<th>Month</th>
									<th>Action</th>
								  </tr>
								</tfoot>
							  </table>
						</div>					  
					</div><!-- /.box-body -->
				</div><!-- /.box -->				
			</div>
		</div>
	</section>
	</div>