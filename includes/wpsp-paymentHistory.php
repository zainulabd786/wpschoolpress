<?php 
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
	                    <h3 class="box-title"><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp; Recent Transactions </h3>
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
						</div>

						<div class="col-md-12 table-responsive">
							<table id="history_table" class="table table-bordered table-striped table-responsive" style="margin-top:10px">
								<thead>
									<tr>
										<th class="nosort">
										<?php if ( in_array( 'administrator', $role ) ) { ?><input type="checkbox" id="selectall" name="selectall" class="ccheckbox"><?php } else echo 'Sr. No.'; ?>
										</th>
										<th>Slip Number</th>
										<th>Date & Time</th>
										<th>Registration No.</th>
										<th>Full Name</th>
										<th>Parent</th>
										<th>Class</th>
										<th>Amount</th>
										<th>View Details</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$student_table	=	$wpdb->prefix."wpsp_student";							
									$users_table	=	$wpdb->prefix."users";
									$fee_rec_table	=	$wpdb->prefix."wpsp_fees_receipts";
									$fee_record_table	=	$wpdb->prefix."wpsp_fees_payment_record";
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
									$students	=	$wpdb->get_results("select * from $student_table s, $fee_rec_table f, $class_table c where s.wp_usr_id = f.uid AND c.cid = s.class_id $classquery order by f.slip_no desc");
									
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
											<td><?php echo $stinfo->slip_no;?></td>
											<td>
												<?php 
												$sql_slip_date = $wpdb->get_results("SELECT date_time FROM $fee_record_table WHERE slip_no='$stinfo->slip_no' LIMIT 1");
												foreach ($sql_slip_date as $date_time) {
													echo date("d/m/Y h:i:s", strtotime($date_time->date_time));
												}
												?>
											</td>
											<td>
												<?php 
													echo $stinfo->s_regno;
												?>
													
											</td>
											<td>
												<?php  
													$mname = $stinfo->s_mname;
										            $lname = $stinfo->s_lname;
													echo $stinfo->s_fname .' '. $mname .' '.  $lname; 
												?>
											</td>
											<td><?php 
												echo $stinfo->p_fname." ".$stinfo->p_lname;
											?></td>
											<td><?php echo $stinfo->c_name; ?></td>
											<td>
												<?php echo "<i class='fa fa-inr'></i>".number_format($amount)."/-"; ?>
											</td>
											<td>
												<a class="view-transaction" id="<?php echo $stinfo->slip_no; ?>" title="View"><i class="fa fa-eye btn btn-success"></i></a> 	
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
									<th>Slip No.</th>	
									<th>Date & Time</th>							
									<th>Registration Number</th>
									<th>Full Name</th>
									<th>Parent</th>
									<th> Class</th>
									<th>Amount</th>
									<th>View Details</th>
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