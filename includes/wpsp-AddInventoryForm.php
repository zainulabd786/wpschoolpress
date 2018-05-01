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
                     
                        <div class="add-inv-from col-md-6">
							<table>
								<tr>
									<td>Item:</td>
									<td class="items-dropdown">
										<a href="#" class="add-item-popup">Add item</a>
										<select class="form-control"> <?php
											$master_table = $wpdb->prefix."wpsp_inventory_master";
											$result = $wpdb->get_results("SELECT * FROM $master_table"); ?>
											<option value="">Select Item</option><?php
											foreach ($result as $value) { ?>
												<option value="<?php echo $value->master_id; ?>"><?php echo $value->item_name; ?></option> <?php
											} ?>
										</select>
									</td>
								</tr>

								<tr>
									<td>Make Model:</td>
									<td><input type="text" class="form-control"></td>
								</tr>

								<tr>
									<td>Manufacturer</td>
									<td><input type="text" class="form-control"></td>
								</tr>

								<tr>
									<td>Quantity</td>
									<td><input type="number" class="form-control"></td>
								</tr>

								<tr>
									<td>Price</td>
									<td><input type="text" class="form-control"></td>
								</tr>

								<tr>
									<td>Description:</td>
									<td><textarea class="form-control"></textarea></td>
								</tr>

								<tr>
									<td>Session</td>
									<td><input type="text" class="form-control"></td>
								</tr>

								<tr>
									<td colspan="2"><button type="button" class="btn btn-primary">Submit</button></td>
								</tr>
								
							</table>
						</div>

                    </div>
                </form>
                
            </div>
        </div>
    </div>
</section>
<div class="ajax-script-exec"></div>
