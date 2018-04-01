<?php $proversion	=	wpsp_check_pro_version();
	  $proclass		=	!$proversion['status'] && isset( $proversion['class'] )? $proversion['class'] : '';
	  $protitle		=	!$proversion['status'] && isset( $proversion['message'] )? $proversion['message']	: '';
	  $prodisable	=	!$proversion['status'] ? 'disabled="disabled"'	: '';
	  $studentFieldList =  array(	's_rollno'			=>	__('Roll Number', 'WPSchoolPress'),
									's_regno'			=>	__('Registration Number', 'WPSchoolPress'),	// Bharatdan Gadhavi - 13th Feb 2018
									's_fname'			=>	__('Student First Name', 'WPSchoolPress'),	
									's_mname'			=>	__('Student Middle Name', 'WPSchoolPress'),	
									's_lname'			=>	__('Student Last Name', 'WPSchoolPress'),	
									's_zipcode'			=>	__('Zip Code', 'WPSchoolPress'),	
									's_country'			=>	__('Country', 'WPSchoolPress'),	
									's_gender'			=>	__('Gender', 'WPSchoolPress'),	
									's_address'			=>	__('Current Address', 'WPSchoolPress'),	
									's_paddress'		=>	__('Permanent Address', 'WPSchoolPress'),	
									'p_fname '			=>	__('Parent First Name', 'WPSchoolPress'),	
									's_bloodgrp'		=>	__('Blood Group', 'WPSchoolPress'),	
									's_dob'				=>	__('Date Of Birth', 'WPSchoolPress'),	
									's_doj'				=>	__('Date Of Join', 'WPSchoolPress'),										
									's_phone'			=>	__('Phone Number', 'WPSchoolPress'),	
							);
	$teacherId	=	0;
	global $current_user;	
	$role		=	 $current_user->roles;
	$cuserId	=	 $current_user->ID;
?>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-solid bg-blue-gradient">
					<div class="box-header ui-sortable-handle" style="cursor: move;">
	                    <i class="fa fa-graph"></i>
	                    <h3 class="box-title"><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp; List Of Fee Defaulters </h3>
	                    <!-- tools box -->

	                    <!-- /. tools -->
	                </div>

		            <div class="box-footer text-black">
						<div class="col-md-12 col-lg-12 col-sm-12" style="padding:0;display: inline-block; margin-bottom:10px">
							<div class="col-md-4 col-sm-12 col-lg-4 float-left">
								<form name="StudentClass" id="StudentClass" method="post" action="" class="class-filter">
									<label><?php _e( 'Select Class Name', 'WPSchoolPress' ); ?></label>
									<select name="ClassID" id="ClassID" class="form-control">
										<?php 
										$sel_classid	=	isset( $_POST['ClassID'] ) ? $_POST['ClassID'] : '';										
										$class_table	=	$wpdb->prefix."wpsp_class";
										$sel_class		=	$wpdb->get_results("select cid,c_name from $class_table Order By cid ASC");
										foreach( $sel_class as $classes ) {
										?> 
											<option value="<?php echo $classes->cid;?>" <?php if($sel_classid==$classes->cid) echo "selected"; ?>><?php echo $classes->c_name;?></option>
										<?php } ?>
										 <?php if ( in_array( 'administrator', $role ) ) { ?>
											<option value="all" <?php if($sel_classid=='all') echo "selected"; ?>><?php _e( 'All', 'WPSchoolPress' ); ?></option>
										 <?php } ?>
									</select>
								</form>								
							</div>
							<div class="col-md-8 col-sm-12 col-lg-8 ">
									
								<div class="button-group btn-pro" <?php echo $prodisable;?> title="<?php echo $protitle;?>">

									<a class="btn btn-primary" href="?tab=DepositFees"><i class="fa fa-plus"></i> Deposit Fees</a>
									<a class="btn btn-primary" href="?tab=PaymentHistory"><i class="fa fa-history"></i> Payment History</a>
									<!--<div class="dropdown"> 
										<a class="btn btn-primary st-btn add-student-btn" href="?tab=addstudent"><i class="fa fa-plus"></i> Add student</a>
										<button type="button" class="btn btn-primary dropdown-toggle print" id="PrintStudent" data-toggle="dropdown" <?php echo $prodisable;?> title="<?php echo $protitle;?>">
											<i class="fa fa-print" ></i> <?php _e( 'Print', 'WPSchoolPress'); ?> 
										</button>
										<button type="button" class="btn btn-primary dropdown-toggle toggle-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" <?php echo $prodisable;?> title="<?php echo $protitle;?>">
											<span class="caret"></span>
											<span class="sr-only"><?php _e( 'Toggle Dropdown', 'WPSchoolPress' );?></span>
										</button>
										<ul class="dropdown-menu">
											<li class="dropdown-header"><?php _e( 'Select Columns to Print', 'WPSchoolPress' );?> </li>
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
										<button type="button" class="btn btn-primary print" id="ExportStudents" <?php echo $prodisable;?> title="<?php echo $protitle;?>"><i class="fa fa-download"></i> <?php _e( 'Export', 'WPSchoolPress'); ?> </button>
										<button type="button" class="btn btn-primary dropdown-toggle export-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" <?php echo $prodisable;?> title="<?php echo $protitle;?>">
											<span class="caret"></span>
											<span class="sr-only"><?php _e( 'Toggle Dropdown', 'WPSchoolPress' );?></span>
										</button>
										<ul class="dropdown-menu">
											<li class="dropdown-header"><?php _e( 'Select Columns to Export', 'WPSchoolPress' );?> </li>
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
										<?php if ( in_array( 'administrator', $role ) ) { ?><input type="checkbox" id="selectall" name="selectall" class="ccheckbox"><?php } else echo 'Sr. No.'; ?>
										</th>
										<th>Roll No.</th>
										<th>Registration No.</th>
										<th>Full Name</th>
										<th>Parent</th>
										<th>Class</th>
										<th>Amount Due</th>
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
									$students	=	$wpdb->get_results("SELECT s.s_fname, s.s_mname, s.s_lname, s.p_fname, s.p_mname, s.p_lname, s.s_rollno, s.s_regno, s.wp_usr_id, d.amount AS due_amount, d.fees_type, c.c_name FROM $student_table s, $dues_table d, $class_table c WHERE s.wp_usr_id=d.uid AND c.cid=s.class_id $classquery");
									$plugins_url=plugins_url();
									$teacherId = '';
									if( $currentSelectClass != 'all' )
										$teacherId	=	$wpdb->get_var("select teacher_id from $class_table WHERE cid=$currentSelectClass");
									$key =0;
									foreach($students as $stinfo)
									{	
										$key++;	
										$amount = $stinfo->adm+$stinfo->ttn+$stinfo->trans+$stinfo->ann+$stinfo->rec;					
									?>
											<tr>
											<td>
											<?php if ( in_array( 'administrator', $role ) ) { ?>
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
											<td>
												<a href="<?php echo "?id=".$stinfo->wp_usr_id;?>" class="ViewStudent" data-id="<?php echo $stinfo->wp_usr_id;?>" title="View"><i class="fa fa-eye btn btn-success"></i></a> 										
																					
												<?php if ( in_array( 'administrator', $role ) || ( !empty( $teacherId ) && $teacherId==$cuserId ) ) { ?>
													<a href="?uidff=<?php echo $stinfo->wp_usr_id; ?>" title="Deposit Fees"><i class="fa fa-plus btn btn-danger"></i></a> 
												<?php } ?>
											</td>
										</tr>
									<?php
									}
									?>
								</tbody>
								<tfoot>
								  <tr>
									<th><?php if ( in_array( 'administrator', $role ) ) { } 
										else echo 'Sr. No'; ?></th>
									<th>Roll No.</th>	
									<th>Registration No.</th><?php // Bharatdan Gadhavi - 16th Feb 2018 ?>							
									<th>Name</th>
									<th>Parent</th>
									<th>Class</th>
									<th>Amount Due</th>
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