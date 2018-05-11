<?php  if (!defined('ABSPATH')) exit('No Such File'); ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-blue" style="position: relative; left: 0px; top: 0px;">
                <div class="box-header" style="cursor: move;">
                    <i class="fa fa-graph"></i>
                    <h3 class="box-title"><i class="fa fa-inr" aria-hidden="true"></i> Add Item </h3>
               
                    <!-- tools box -->
                  
                    <!-- /. tools -->
                </div>
                 
                <!-- /.box-header -->
                <form name="FeesDepositForm" id="FeesDepositForm" method="post" novalidate="novalidate"> 
                    <div class="box-body text-black">
                     
                        <div class="add-inv-from col-md-4">

							<div class="form-group as-items-dropdown">
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

                    </div>
                </form>
                
            </div>
        </div>
    </div>
</section>
<div class="ajax-script-exec"></div>
