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
	                    <h3 class="box-title"><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp; Record Transactions </h3>
	                    <!-- tools box -->

	                    <!-- /. tools -->
	                </div>

		            <div class="box-footer text-black">
						<div class="col-md-6">
							<form name="record-transaction-form">
								<div class="form-group">
									<label>Transaction Amount</label>
									<input type="text" name="amount" class="form-control" >
								</div>
								<div class="form-group">
									<label>Remarks</label>
									<input type="text" name="remarks" class="form-control" >
								</div>
								<div class="form-group">
									<label>Group</label>
									<select name="group" class="form-control">
										<option value="">Select Group</option><?php 
										$groups = json_decode(apply_filters("ac_get_group_names", "all"));
										foreach ($groups as $group) { ?>
										 	<option value="<?php echo $group->group_id; ?>"><?php echo $group->group_name; ?></option> <?php
										 } ?>
									</select>
								</div>
								<div class="form-group">
									<label>Mode of Payment</label>
									<select class="form-control" name="mop">
										<option value="">Select Mode Of Payment</option>
										<option value="1">Cash</option>
										<option value="2">Bank</option>
									</select>
								</div>
								<div class="form-group">
									<label class="radio-inline">
								    	<input type="radio" name="type" value="1" checked>Credit
								    </label>
								    <label class="radio-inline">
								    	<input type="radio" name="type" value="0">Debit
								    </label>
								</div>
								<button type="submit" class="btn btn-primary record-transaction-btn">Submit</button>
							</form>
						</div>					  
					</div><!-- /.box-body -->
				</div><!-- /.box -->				
			</div>
		</div>
	</section>
	</div>