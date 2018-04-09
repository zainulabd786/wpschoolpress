<?php 
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
	                    <h3 class="box-title"><i class="fa fa-tag" aria-hidden="true"></i>&nbsp; Concession Alloted </h3>
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
									
								<form style="float: left" action="" method="post" name="date-filter-form" id="date-filter-form" class="form-inline">

									<div class="form-group">
										<label for="from-concession">From: </label>
										<input name="from-date" type="date" class="form-control" id="from-concession">
									</div>
									<div class="form-group">
										<label for="to-concession"> To: </label>
										<input name="to-date" type="date" class="form-control" id="to-concession">
									</div>

								</form>

								<div style="float: right;" id="total-concession" class="well"></div>
										
							</div>
						</div>

						<div class="col-md-12 table-responsive">
							<table id="student_table" class="table table-bordered table-striped table-responsive" style="margin-top:10px">
								<thead>
									<tr>
										<th class="nosort">
										<?php if ( in_array( 'administrator', $role ) ) { ?><input type="checkbox" id="selectall" name="selectall" class="ccheckbox"><?php } else echo 'Sr. No.'; ?>
										</th>
										<th>Date</th>
										<th>Slip No.</th>
										<th>Registration No.</th>
										<th>Full Name</th>
										<th>Parent</th>
										<th>Class</th>
										<th>Amount</th>
										<th class="nosort">View</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$total_concession = 0;
									$student_table	=	$wpdb->prefix."wpsp_student";							
									$users_table	=	$wpdb->prefix."users";
									$fee_rec_table	=	$wpdb->prefix."wpsp_fees_receipts";
									$class_table = $wpdb->prefix."wpsp_class";
									$dues_table = $wpdb->prefix."wpsp_fees_dues";
									$records_table = $wpdb->prefix."wpsp_fees_payment_record";
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

									if(isset($_POST["from-date"]) && isset($_POST["to-date"])){
										$from_date = date("Y-m-d", strtotime($_POST["from-date"]));
										$to_date = date("Y-m-d", strtotime($_POST["to-date"]));
										$date_query = "AND d.date BETWEEN '$from_date' AND '$to_date' GROUP BY d.slip_no";
									}
									else{
										$date_query = "";	
									}
									$students	=	$wpdb->get_results("SELECT s.s_fname, s.s_mname, s.s_lname, s.p_fname, s.p_mname, s.p_lname, s.s_rollno, s.s_regno, s.wp_usr_id, c.c_name, d.concession, d.slip_no, d.date FROM $student_table s, $class_table c, $fee_rec_table d WHERE s.wp_usr_id=d.uid AND c.cid=s.class_id AND d.concession > 0 $classquery $date_query");
									//echo "SELECT s.s_fname, s.s_mname, s.s_lname, s.p_fname, s.p_mname, s.p_lname, s.s_rollno, s.s_regno, s.wp_usr_id, c.c_name, d.concession, d.slip_no FROM $student_table s, $class_table c, $fee_rec_table d WHERE s.wp_usr_id=d.uid AND c.cid=s.class_id AND d.concession > 0 $classquery $date_query";
									$total_concession_sql = $wpdb->get_results("SELECT SUM(d.concession) AS sum_concession FROM $fee_rec_table d, $student_table s WHERE d.concession>0 $classquery $date_query");
								//	echo "SELECT SUM(d.concession) AS sum_concession FROM $fee_rec_table d, $student_table s WHERE d.concession>0 AND s.wp_usr_id=d.uid $classquery $date_query";
									foreach ($total_concession_sql as $concession) {
										$total_concession = $concession->sum_concession; ?>
										
										<script type="text/javascript">
											document.getElementById("total-concession").innerHTML = "Total Concessions Alloted: <?php echo "<i class='fa fa-inr'></i>".$total_concession."/-"; ?>";
										</script> <?php
									}
									$plugins_url=plugins_url();
									$teacherId = '';
									$currentSelectClass =	isset($_POST['ClassID']) ? $_POST['ClassID'] : $sel_class[0]->cid;
									if( $currentSelectClass != 'all' )
										$teacherId	=	$wpdb->get_var("select teacher_id from $class_table WHERE cid=$currentSelectClass");
									$key =0;
									foreach($students as $stinfo)
									{	
										$key++;	
										if(!empty($stinfo->concession)){				
									?>
											<tr>
											<td>
											<?php if ( in_array( 'administrator', $role ) ) { ?>
												<input type="checkbox" class="ccheckbox strowselect" name="UID[]" value="<?php echo $stinfo->wp_usr_id;?>">
											<?php }else echo $key; ?>
											</td>
											<td><?php echo date("d/m/Y", strtotime($stinfo->date)); ?></td>
											<td><?php echo $stinfo->slip_no;?></td>
											<td><?php echo $stinfo->s_regno;?></td>
											<td><?php 
												$mname = $stinfo->s_mname;
									            $lname = $stinfo->s_lname;
											echo $stinfo->s_fname .' '. $mname .' '.  $lname;?></td>
											<td><?php  echo $stinfo->p_fname; ?>
											</td>
											<td><?php 
												echo $stinfo->c_name;
											?>
											</td>
											<td><?php echo "<i class='fa fa-inr'></i>".number_format($stinfo->concession)."/-"; ?></td>
											<td>
												<a href="<?php echo "?id=".$stinfo->wp_usr_id;?>" class="ViewStudent" data-id="<?php echo $stinfo->wp_usr_id;?>" title="View"><i class="fa fa-eye btn btn-success"></i></a> 										
																					
												<?php if ( in_array( 'administrator', $role ) || ( !empty( $teacherId ) && $teacherId==$cuserId ) ) { ?>
													<button class="btn btn-basic view-invoice" id="<?php echo $stinfo->slip_no; ?>" type="button">Invoice</button>
												<?php } ?>
											</td>
										</tr>
									<?php }
									}
									?>
								</tbody>
								<tfoot>
								  <tr>
									<th><?php if ( in_array( 'administrator', $role ) ) { } 
										else echo 'Sr. No'; ?></th>
									<th>Date</th>
									<th>Slip No.</th>	
									<th>Registration No.</th><?php // Bharatdan Gadhavi - 16th Feb 2018 ?>							
									<th>Name</th>
									<th>Parent</th>
									<th>Class</th>
									<th>Amount</th>
									<th>View</th>
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