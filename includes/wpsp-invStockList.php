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
									
								
										
							</div>
						</div>

						<div class="col-md-12 table-responsive">
							<table id="student_table" class="table table-bordered table-striped table-responsive" style="margin-top:10px">
								<thead>
									<tr>
										<th>Master Id</th>
										<th>Item Name</th>
										<th>Stock</th>
									</tr>
								</thead>
								<tbody> <?php
									$items_table = $wpdb->prefix."wpsp_inventory_items";
									$assigned_table = $wpdb->prefix."wpsp_assigned_inventory";
									$master_table = $wpdb->prefix."wpsp_inventory_master";
									
									$results = $wpdb->get_results("SELECT * FROM $master_table"); 
									foreach ($results as $item) { ?>
										<tr>
											<td><?php echo $item->master_id; ?></td>
											<td><?php echo $item->item_name; ?></td>
											<td> <?php
												echo get_stock($item->master_id); ?>
											</td>
										</tr> <?php 
									} ?>
								</tbody>
								<tfoot>
								  <tr>
										<th>Master Id</th>
										<th>Item Name</th>
										<th>Stock</th>
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