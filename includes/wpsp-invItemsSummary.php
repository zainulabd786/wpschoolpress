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
										<th>Date</th>
										<th>Item</th>
										<th>Model</th>
										<th>Manufacturer</th>
										<th>Description</th>
										<th>Amount</th>
										<th>Quantity</th>
										<th>Session</th>
									</tr>
								</thead>
								<tbody> <?php
									$items_table = $wpdb->prefix."wpsp_inventory_items";
									$master_table = $wpdb->prefix."wpsp_inventory_master";
									$results = $wpdb->get_results("SELECT a.*, b.item_name FROM $items_table a, $master_table b WHERE a.master_id=b.master_id");
									foreach ($results as $summary) { ?>
										<tr>
											<td><?php echo date('d/m/Y', strtotime($summary->date)); ?></td>
											<td><?php echo $summary->item_name; ?></td>
											<td><?php echo $summary->model; ?></td>
											<td><?php echo $summary->manufacturer; ?></td>
											<td><?php echo $summary->description; ?></td>
											<td><?php echo $summary->price; ?></td>
											<td><?php echo $summary->quantity; ?></td>
											<td><?php echo $summary->session; ?></td>
										</tr> <?php
									} ?>
								</tbody>
								<tfoot>
								  <tr>
										<th>Date</th>
										<th>Item</th>
										<th>Model</th>
										<th>Manufacturer</th>
										<th>Description</th>
										<th>Amount</th>
										<th>Quantity</th>
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