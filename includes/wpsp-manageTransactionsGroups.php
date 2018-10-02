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
	                    <h3 class="box-title"><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp; All Transactions </h3>
	                    <!-- tools box -->

	                    <!-- /. tools -->
	                </div>

		            <div class="box-footer text-black">
						<div class="col-md-12 col-lg-12 col-sm-12" style="padding:0;display: inline-block; margin-bottom:10px">
							
							<div class="col-md-6 col-sm-12 col-lg-12 ">
									
								<div class="button-group btn-pro">

									<a href="?tab=record-transaction" class="btn btn-primary"> Record Transaction </a>
									<a href="?tab=manage-groups" class="btn btn-primary"> Manage Groups </a>
									
								</div>
										
							</div>

							<div class="col-md-6">
								
							</div>
						</div>

						<div class="col-md-3">
							
						</div>

						<div class="col-md-9">
							<table id="groups_table" class="table table-bordered table-striped table-responsive" style="margin-top:10px">
								<thead>
									<tr>
										<th class="nosort">
										<?php if ( in_array( 'administrator', $role ) || in_array( 'editor', $role )  ) { ?><input type="checkbox" id="selectall" name="selectall" class="ccheckbox"><?php } else echo 'Sr. No.'; ?>
										</th>
										<th>Group Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody> 
									<?php
										$srn = 1;
										$groups = json_decode(apply_filters("ac_get_group_names", "all"));
										foreach ($groups as $group) { ?>
											<td><?php echo (!empty($srn)) ? $srn : ""; ?></td>
											<td><?php echo (!empty($group->group_name)) ? $group->group_name : ""; ?></td>
											<td>
												<button class="btn-primary btn btn-sm edit-group-btn" data-id="<?php echo $group->group_id; ?>">Edit</button>
												<button class="btn-danger btn btn-sm delete-group-btn" data-id="<?php echo $group->group_id; ?>">Delete</button>
											</td><?php
										}
									?>
								</tbody>
								<tfoot>
								  <tr>
									<th><?php if ( in_array( 'administrator', $role ) || in_array( 'editor', $role )  ) { } 
										else echo 'Sr. No'; ?></th>
									<th>Group Name</th>	
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
	