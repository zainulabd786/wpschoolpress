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
									<form name="transaction-filter-form" style="display: flex;">
										<div class="form-group">
											<select name="mode" class="form-control change-event">
												<option value="0">All</option>
												<option value="1">Cash</option>
												<option value="2">Bank</option>
											</select>
											<label for="mode">Mode</label>
										</div>
										<div class="form-group">
											<select name="group_id" class="form-control change-event">
												<option value="">All</option><?php
												$groups = json_decode(apply_filters("ac_get_group_names", "all"));
												foreach ($groups as $group) { ?>
												 	<option value="<?php echo $group->group_id; ?>"><?php echo $group->group_name; ?></option> <?php
												 } ?>
											</select>
											<label for="group">Group</label>
										</div>
										<div class="form-group">
											<input type="date" name="from_date" class="form-control change-event">
											<label for="from">From</label>
										</div>
										<div class="form-group">
											<input type="date" name="to_date" class="form-control change-event">
											<label for="to">To</label>
										</div>
									</form>
								</div>
							</div>
							<?php //echo "<pre>"; print_r($wpdb->get_results("SELECT *, 'cash' AS mop FROM wp_wpsp_cash_transactions WHERE 1=1 AND DATE(date_time) > 2018-10-07 UNION ALL SELECT *, 'bank' AS mop FROM wp_wpsp_bank_transactions WHERE 1=1 AND DATE(date_time) > 2018-10-07 ORDER BY date_time DESC")); echo "</pre>"; ?>
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
										<th>Mode</th>
										<th>Debit</th>
										<th>Credit</th>
										<th class="cash-balance-col">Cash Balance</th>
										<th class="bank-balance-col">Bank Balance</th>
									</tr>
								</thead>
								<tbody> 
									<?php 
										$args = array("mode"=>0);
										$transactions = json_decode(apply_filters("ac_get_transactions", $args));
										$srn = 1;
										foreach ($transactions as $transaction) {
											$group_name = "-";
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
												<td><?php echo (!empty($transaction->mop)) ? $transaction->mop : ""; ?></td>
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
									<th>Mode</th>
									<th>Debit</th>
									<th>Credit</th>
									<th class="cash-balance-col">Cash Balance</th>
									<th class="bank-balance-col">Bank Balance</th>
								  </tr>
								</tfoot>
							  </table>
						</div>					  
					</div><!-- /.box-body -->
				</div><!-- /.box -->				
			</div>
		</div>
	</section>
	