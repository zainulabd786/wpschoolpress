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
						<div class="col-md-12 col-lg-12 col-sm-12 row" style="padding:0;display: inline-block; margin-bottom:10px">
							
							<div class="col-md-6">
								<div class="Filters-container">
									<form style="display: flex;">
										<div class="form-group">
											<label for="mode">Mode</label>
											<select name="mode" class="form-control">
												<option value="0">All</option>
												<option value="1">Cash</option>
												<option value="2">Bank</option>
											</select>
										</div>
										<div class="form-group">
											<label for="group">Group</label>
											<select name="group" class="form-control">
												<option value="">Select Group</option><?php
												$groups = json_decode(apply_filters("ac_get_group_names", "all"));
												foreach ($groups as $group) { ?>
												 	<option value="<?php echo $group->group_id; ?>"><?php echo $group->group_name; ?></option> <?php
												 } ?>
											</select>
										</div>
										<div class="form-group">
											<label for="from">From</label>
											<input type="date" name="from_date" class="form-control">
										</div>
										<div class="form-group">
											<label for="to">To</label>
											<input type="date" name="to_date" class="form-control">
										</div>
									</form>
								</div>
								
										
							</div>

							<div class="col-md-6">
								<div class="button-group btn-pro">

									<a href="?tab=record-transaction" class="btn btn-primary"> Record Transaction </a>
									<a href="?tab=manage-groups" class="btn btn-primary"> Manage Groups </a>
									
								</div>
							</div>
						</div>
						
						<div class="col-md-12 table-responsive">
							
							<table id="transactions_table" class="table table-bordered table-striped table-responsive" style="margin-top:10px">
								<thead>
									<tr>
										<th class="nosort">
										<?php if ( in_array( 'administrator', $role ) || in_array( 'editor', $role )  ) { ?><input type="checkbox" id="selectall" name="selectall" class="ccheckbox"><?php } else echo 'Sr. No.'; ?>
										</th>
										<th>Date & Time</th>
										<th>Remarks</th>
										<th>Group</th>
										<th>Reference Number</th>
										<th>Debit</th>
										<th>Credit</th>
										<th>Cash Balance</th>
										<th>Bank Balance</th>
									</tr>
								</thead>
								<tbody> 
									<?php 
										$args = array("mode"=>0);
										$transactions = json_decode(apply_filters("ac_get_transactions", $args));
										$srn = 1;
										foreach ($transactions as $transaction) {
											(!empty($transaction->group_id)) ? $group_name = json_decode(apply_filters("ac_get_group_names", $transaction->group_id))[0]->group_name : "";
											$debit = ($transaction->type == 0) ? $transaction->amount : "-";
											$credit = ($transaction->type == 1) ? $transaction->amount : "-";
											$cash_balance = ($transaction->mop == "cash") ? $transaction->balance : "-";
											$bank_balance = ($transaction->mop == "bank") ? $transaction->balance : "-";
											$row_color = ($debit == "-") ? "style='color:green'" : "style='color:red'"; ?>
											<tr <?php echo $row_color; ?>>
												<td><?php echo $srn; ?></td>
												<td><?php echo (!empty($transaction->date_time)) ? date("d/m/Y H:i:s", strtotime($transaction->date_time)) : "";  ?></td>
												<td><?php echo (!empty($transaction->remarks)) ? $transaction->remarks : ""; ?></td>
												<td><?php echo (!empty($group_name)) ? $group_name : ""; ?></td>
												<td><?php echo (!empty($transaction->reference)) ? $transaction->reference : ""; ?></td>
												<td><?php echo (!empty($debit)) ? $debit : ""; ?></td>
												<td><?php echo (!empty($credit)) ? $credit : ""; ?></td>
												<td><?php echo (!empty($cash_balance)) ? $cash_balance : ""; ?></td>
												<td><?php echo (!empty($bank_balance)) ? $bank_balance : ""; ?></td>
											</tr><?php
											$srn++;
										}

									?>
								</tbody>
								<tfoot>
								  <tr>
									<th><?php if ( in_array( 'administrator', $role ) || in_array( 'editor', $role )  ) { } 
										else echo 'Sr. No'; ?></th>
									<th>Date & Time</th>	
									<th>Remarks</th>
									<th>Group</th>
									<th>Reference Number</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Cash Balance</th>
									<th>Bank Balance</th>
								  </tr>
								</tfoot>
							  </table>
						</div>					  
					</div><!-- /.box-body -->
				</div><!-- /.box -->				
			</div>
		</div>
	</section>
	