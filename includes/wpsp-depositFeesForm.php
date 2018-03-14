<?php if (!defined('ABSPATH')) exit('No Such File'); ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-blue" style="position: relative; left: 0px; top: 0px;">
                <div class="box-header" style="cursor: move;">
                    <i class="fa fa-graph"></i>
                    <h3 class="box-title"><i class="fa fa-inr" aria-hidden="true"></i> Deposit Fees </h3>
               
                    <!-- tools box -->
                  
                    <!-- /. tools -->
                </div>
                 
                <!-- /.box-header -->
                <form name="FeesDepositForm" id="FeesDepositForm" method="post" novalidate="novalidate"> 
                    <div class="box-body text-black">
                     
                        <div class="col-md-4">
                            <div class="panel-group">
								<header class="panel panel-primary">
									<div class="panel-heading"> Record Transaction </div>
						                <div class="panel-body">
						                	<?php $current_date = date("d-m-Y"); ?>
						                	<div class="form-group">
												<label for="dep-issue-date">Issue Date</label>
												<input type="text" class="form-control" id="dep-issue-date" value="<?php echo $current_date; ?>" disabled>
											</div>
											<div class="form-group dep-class-select">
												<label for="dep-class">Class<sup>*</sup></label>
												<select name="ClassID" id="ClassID dep-class" class="form-control">
													<option value="">Select Class</option>
													<?php 
													$sel_classid	=	isset( $_POST['ClassID'] ) ? $_POST['ClassID'] : '';										
													$class_table	=	$wpdb->prefix."wpsp_class";
													$sel_class		=	$wpdb->get_results("select cid,c_name from $class_table Order By cid ASC");
													foreach( $sel_class as $classes ) {
													?> 
														<option value="<?php echo $classes->cid;?>" <?php if($sel_classid==$classes->cid) echo "selected"; ?>><?php echo $classes->c_name;?></option>
													<?php } ?>
													 <?php if ( in_array( 'administrator', $role ) ) { ?>
														<option value="all" <?php if($sel_classid=='all') echo "selected"; ?>><?php _e( 'All', 'WPSchoolPress' ); ?></option>
													 <?php } ?>
												</select>
											</div>
											<div class="form-group dep-student-select">
												<label for="dep-student">Student<sup>*</sup></label>
												<select id="dep-student" class="form-control">
													<option value="">Select Student</option>
												</select>
											</div>
											<label for="dep-amount">Select Month<sup>*</sup></label>
											<div class="form-inline">
												<div class="form-group dep-from-select">
													<select class="form-control">
														<option>Select From Month</option><?php
														$months_array = array("January", "February", "March", "April", "May", "June", "july", "August", "September", "October", "November", "December");
														for ($m=0; $m<12; $m++) { ?>
															<option value="<?php echo $months_array[$m]; ?>"><?php echo $months_array[$m]; ?></option>;
														<?php } ?>
													</select>
													<label>From</label>
												</div>
												<div class="form-group dep-to-select">
													<select class="form-control">
														<option>Select To Month</option><?php
														$months_array = array("January", "February", "March", "April", "May", "June", "july", "August", "September", "October", "November", "December");
														for ($m=0; $m<12; $m++) { ?>
															<option value="<?php echo $months_array[$m]; ?>"><?php echo $months_array[$m]; ?></option>;
														<?php } ?>
													</select>
													<label>To</label>
												</div>
											</div>
											<div class="form-group dep-fee-type">
												<label>Fees Type</label>
												<select class="form-control">
													<option value="">Select Fee Type</option>
													<option value="AdmissionFees">Admission Fees</option>
													<option value="TuitionFees">Tution Fees(Monthly)</option>
													<option value="TransportFees">Transportaion Charges(Mothly)</option>
													<option value="AnnualCharge">Annual Charge</option>
													<option value="RecreationCharge">Recreation Charges</option>
												</select>
											</div>
											<div class="dep-adm-inp" id="fees-inp">
												<label>Admission Fees(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control">
												</div>
											</div>
											<div class="dep-tf-inp" id="fees-inp">
												<label>Tution Fees(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control">
												</div>
											</div>
											<div class="dep-tc-inp" id="fees-inp">
												<label>Transportation Chares(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control">
												</div>
											</div>
											<div class="dep-ac-inp" id="fees-inp">
												<label>Annual Charges(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control">
												</div>
											</div>
											<div class="dep-rf-inp" id="fees-inp">
												<label>Recreation Fees(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control">
												</div>
											</div>
											<input type="button" class="btn btn-success btn-block" value="Submit" id="dep-fees-btn">
						                </div>
								</header>
							</div>
                        </div>
                        <div class="col-md-8">
                            <div class="panel-group">
								<header class="panel panel-primary">
									<div class="panel-heading"> Invoice Preview </div>
						                <div class="panel-body">
											<div class="invoice-prev">

												<div class="inv-header row">
													<div class="inv-header-left col-sm-6">
														<h3><b>School Management System</b></h3>
														<i style="font-size:100px" class="fa fa-graduation-cap"></i>
													</div>
													<div class="inv-header-right col-sm-6">
														<b>Issue Date: <?php echo $current_date; ?></b><br>
														<b style="display: inline-flex;">Status: &nbsp; <div class="inv-status"></div></b>
													</div>
												</div>
												<hr>
												<div class="inv-description row">
													<div class="inv-des-left col-sm-6">
														<strong>Payment To</strong>
														<p>School Management System</p>
														<p>588 6th, Delhi, India</p>
														<p>96986877452</p>
													</div>
													<div class="inv-des-right col-sm-6">
														<strong>Bill To</strong>
														<p>Zainul Abideen</p>
														<p>9/727 A, Deenanath Bazar</p>
													</div>
												</div>
												<hr>
												<div class="inv-entries">
													<table>
														<tr>
															<td><strong>#</strong></td>
															<td><strong>Date</strong></td>
															<td><strong>Entry</strong></td>
															<td><strong>Amount</strong></td>
															<td><strong>Username</strong></td>
														</tr>
														<tr>
															<td>1</td>
															<td><?php echo $current_date; ?></td>
															<td class="inv-entries-entry"></td>
															<td class="inv-entries-amt"></td>
															<td></td>
														</tr>
														<tr>
															<td colspan="3">Grand Total:</td>
															<td class="inv-entries-total" colspan="2"></td>
														</tr>
														<tr>
															<td colspan="3">Paid:</td>
															<td class="inv-entries-paid" colspan="2"></td>
														</tr>
														<tr>
															<td colspan="3">Due:</td>
															<td class="inv-entries-due" colspan="2"></td>
														</tr>
													</table>
												</div>
											</div>
						                </div>
								</header>
							</div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</section>