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
	                    <h3 class="box-title"><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp; Assigned Items </h3>
	                    <!-- tools box -->

	                    <!-- /. tools -->
	                </div>

		            <div class="box-footer text-black">
						<div class="col-md-12 col-lg-12 col-sm-12" style="padding:0;display: inline-block; margin-bottom:10px">
							
							<div class="col-md-6 col-sm-12 col-lg-12 ">
									
								<div class="button-group btn-pro">

									<a class="btn btn-primary" href="?tab=AddNew"><i class="fa fa-plus"></i> Add New </a>
									<a class="btn btn-primary" href="?tab=Assign"><i class="fa fa-history"></i> Assign Item </a>
									
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
										<th>Date</th>
										<th>Item</th>
										<th>Quantity</th>
										<th>Assigned To</th>
										<th>Session</th>
									</tr>
								</thead>
								<tbody> <?php
									$assigned_table = $wpdb->prefix."wpsp_assigned_inventory";
									$master_table = $wpdb->prefix."wpsp_inventory_master";
									$teacher_table = $wpdb->prefix."wpsp_teacher";
									$get_data = $wpdb->get_results("SELECT a.date, a.quantity, a.session, b.item_name, c.first_name, c.middle_name, c.last_name, c.empcode FROM $assigned_table a, $master_table b, $teacher_table c WHERE c.wp_usr_id=a.staff_uid AND b.master_id=a.master_id");
									foreach ($get_data as $assigned) { ?>
									 	<tr>
									 		<td>
												<?php if ( in_array( 'administrator', $role ) || in_array( 'editor', $role )  ) { ?>
													<input type="checkbox" class="ccheckbox strowselect" name="UID[]" value="<?php echo $stinfo->wp_usr_id;?>">
												<?php }else echo $key; ?>
											</td>
									 		<td><?php echo date('d/m/Y', strtotime($assigned->date)); ?></td>
									 		<td><?php echo $assigned->item_name; ?></td>
									 		<td><?php echo $assigned->quantity; ?></td>
									 		<td><?php echo $assigned->first_name." ".$assigned->middle_name." ".$assigned->last_name."-".$assigned->empcode; ?></td>
									 		<td><?php echo $assigned->session; ?></td>
									 	</tr> <?php
									 } ?>
								</tbody>
								<tfoot>
								  <tr>
									<th><?php if ( in_array( 'administrator', $role ) || in_array( 'editor', $role )  ) { } 
										else echo 'Sr. No'; ?></th>
									<th>Date</th>	
									<th>Item</th>						
									<th>Quantity</th>
									<th>Assigned To</th>
									<th>Session</th>
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