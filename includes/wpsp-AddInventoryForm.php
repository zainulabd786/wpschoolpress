<?php  if (!defined('ABSPATH')) exit('No Such File'); ?>
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-blue" style="position: relative; left: 0px; top: 0px;">
                <div class="box-header" style="cursor: move;">
                    <i class="fa fa-graph"></i>
                    <h3 class="box-title"><i class="fa fa-inr" aria-hidden="true"></i> Add Item </h3>
               
                    <!-- tools box -->
                  
                    <!-- /. tools -->
                </div>
                 
                <!-- /.box-header -->
                
                <form name="FeesDepositForm" id="FeesDepositForm" method="post" novalidate="novalidate" class="add-inv-from"> 
                    <div class="box-body text-black">
                     

						<div class="form-group items-dropdown">
							<label>Item</label>
							<a style="float: right;" href="#" class="add-item-popup">Add item</a>
							<select class="form-control"> <?php
								$master_table = $wpdb->prefix."wpsp_inventory_master";
								$result = $wpdb->get_results("SELECT * FROM $master_table"); ?>
								<option value="">Select Item</option><?php
								foreach ($result as $value) { ?>
									<option value="<?php echo $value->master_id; ?>"><?php echo $value->item_name; ?></option> <?php
								} ?>
							</select>
							<div class="inv-avail"></div>
						</div>

						<div class="form-group">
							<label>Make Model:</label>
							<input type="text" class="form-control it-model">
						</div>

						<div class="form-group">
							<label>Manufacturer</label>
							<input type="text" class="form-control it-manufacturer">
						</div>

						<div class="form-group">
							<label>Quantity</label>
							<input type="number" class="form-control it-qty">
						</div>

						<div class="form-group">
							<label>Price</label>
							<input type="text" class="form-control it-price">
						</div>

						<div class="form-group">
							<div>Description:</div>
							<textarea class="form-control it-desc"></textarea>
						</div>

						<div class="form-group">
							<label>Session</label>
							<?php
							$settings_table = $wpdb->prefix."wpsp_settings";
							$result = $wpdb->get_results("SELECT option_value FROM $settings_table WHERE option_name='session'"); ?>
							<input type="text" value="<?php echo $result[0]->option_value; ?>" class="form-control it-session" disabled>
						</div>

						<button type="button" class="btn btn-primary submit-btn">Submit</button>
								

                    </div>
                </form>
                
            </div>
        </div>

        <div class="col-md-9">
            <div class="box box-blue" style="position: relative; left: 0px; top: 0px;">
                <div class="box-header" style="cursor: move;">
                    <i class="fa fa-graph"></i>
                    <h3 class="box-title"><i class="fa fa-inr" aria-hidden="true"></i> Items Summary </h3>
               
                    <!-- tools box -->
                  
                    <!-- /. tools -->
                </div>
                 
                <!-- /.box-header -->
                
                <table id="summary_table" class="table table-bordered table-striped table-responsive" style="margin-top:10px">
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
								<td><?php echo "<i class='fa fa-inr'></i>".number_format($summary->price)."/-"; ?></td>
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
        </div>
    </div>
</section>
<div class="ajax-script-exec"></div>
