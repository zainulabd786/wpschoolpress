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
	                    <h3 class="box-title"><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp; Assigned Items </h3>
	                    <!-- tools box -->

	                    <!-- /. tools -->
	                </div>

		            <div class="box-footer text-black">
						<div class="col-md-12 col-lg-12 col-sm-12" style="padding:0;display: inline-block; margin-bottom:10px">
							
							<div class="col-md-6 col-sm-12 col-lg-12 ">
									
								<div class="button-group btn-pro">

									<button class="btn btn-danger consume-btn"> Mark Consumed </button>
									<a class="btn btn-primary" href="?tab=AddNew"><i class="fa fa-plus"></i> Add New </a>
									<a class="btn btn-primary" href="?tab=Assign"><i class="fa fa-history"></i> Assign Item </a>
									<!--<a class="btn btn-primary" href="?tab=Summary"><i class="fa fa-history"></i> Items Summary </a>-->
									<a class="btn btn-primary" href="?tab=stock"><i class="fa fa-table"></i> In Stock Items </a>
									
								</div>
										
							</div>

							<div class="col-md-6">
								
							</div>
						</div>

						<div class="col-md-12 table-responsive">
							<table id="assigned_table" class="table table-bordered table-striped table-responsive" style="margin-top:10px">
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
										<th>Action</th>
									</tr>
								</thead>
								<tbody> <?php
									$assigned_table = $wpdb->prefix."wpsp_assigned_inventory";
									$master_table = $wpdb->prefix."wpsp_inventory_master";
									$teacher_table = $wpdb->prefix."wpsp_teacher";
									$get_data = $wpdb->get_results("SELECT a.sno, a.date, a.quantity, a.session, a.consumed, a.reassigned_from, b.item_name, c.first_name, c.middle_name, c.last_name, c.empcode, c.wp_usr_id FROM $assigned_table a, $master_table b, $teacher_table c WHERE c.wp_usr_id=a.staff_uid AND b.master_id=a.master_id");
									foreach ($get_data as $assigned) { ?>
									 	<tr>
									 		<td>
												<?php if ( in_array( 'administrator', $role ) || in_array( 'editor', $role )  ) { ?>
													<input type="checkbox" class="ccheckbox strowselect" name="UID[]" data-id="<?php echo $assigned->sno; ?>" value="<?php echo $assigned->wp_usr_id;?>">
												<?php }else echo $key; ?>
											</td>
									 		<td><?php echo date('d/m/Y', strtotime($assigned->date)); ?></td>
									 		<td><?php echo $assigned->item_name; ?></td>
									 		<td><?php echo $assigned->quantity; ?></td>
									 		<td><?php echo $assigned->first_name." ".$assigned->middle_name." ".$assigned->last_name."-".$assigned->empcode; ?></td>
									 		<td><?php echo $assigned->session; ?></td>
									 		<td>
									 			<span type="button" class="btn btn-primary reassign-btn" id="<?php echo $assigned->sno; ?>" <?php if(!empty($assigned->consumed)) echo "disabled"; ?>><?php echo (empty($assigned->consumed))?"Reassign":"consumed"; ?></span>
									 			<?php if(!empty($assigned->reassigned_from)){ ?><br/><span class="inv-reas-info">Reassigned From: <b><?php 
									 				$t_name = $wpdb->get_results("SELECT first_name, middle_name, last_name FROM $teacher_table WHERE wp_usr_id='$assigned->reassigned_from' ");
									 				$t_fullname = $t_name[0]->first_name." ".$t_name[0]->middle_name." ".$t_name[0]->last_name;
									 				echo $t_fullname;
									 			 } ?></b></span>
									 		</td>
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