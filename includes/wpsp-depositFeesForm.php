<?php if (!defined('ABSPATH')) exit('No Such File'); ?>
<?php if(isset( $_GET['sidff'] )){
	$sidff = $_GET['sidff'];
	$fees_status_table = $wpdb->prefix."wpsp_fees_status";
	$student_table = $wpdb->prefix."wpsp_student";
	
	$sidff_sql = $wpdb->get_results("SELECT * FROM $fees_status_table a, $student_table b WHERE a.sid = '$sidff' AND b.sid = a.sid ");
	$adm_f = $ttn_f = $trans_f = $ann_f = $rec_f = $sfname_f = $smname_f = $slname_f = $pfname_f = $pmname_f = $plname_f = $sphone_f = $sregno = $class = "";
	foreach ($sidff_sql as $fee) {
		$adm_f = $fee->admission_fees;
		$ttn_f = $fee->tution_fees;
		$trans_f = $fee->transport_chg;
		$ann_f = $fee->annual_chg;
		$rec_f = $fee->recreation_chg;

	}
}  ?>
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
													<input type="text" class="form-control expected" value="0" placeholder="Amount Expected">
													<input type="text" class="form-control paid" value="0" placeholder="Paid Amount">
												</div>
											</div>
											<div class="dep-tf-inp" id="fees-inp">
												<label>Tution Fees(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control expected" value="0" placeholder="Amount Expected">
													<input type="text" class="form-control paid" value="0" placeholder="Paid Amount">
												</div>
											</div>
											<div class="dep-tc-inp" id="fees-inp">
												<label>Transportation Chares(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control expected" value="0" placeholder="Amount Expected">
													<input type="text" class="form-control paid" value="0" placeholder="Paid Amount">
												</div>
											</div>
											<div class="dep-ac-inp" id="fees-inp">
												<label>Annual Charges(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control expected" value="0" placeholder="Amount Expected">
													<input type="text" class="form-control paid" value="0" placeholder="Paid Amount">
												</div>
											</div>
											<div class="dep-rf-inp" id="fees-inp">
												<label>Recreation Fees(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control expected" value="0" placeholder="Amount Expected">
													<input type="text" class="form-control paid" value="0" placeholder="Paid Amount">
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
												<!--Old Invoice Format By Zainul Abideen -->
												<!--<div class="inv-header row">
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
												</div>-->
												<!--Old Invoice Format By Zainul Abideen ends -->

												<?php 
													//fetch School Details From Database										
													$settings_table	=	$wpdb->prefix."wpsp_settings";
													$sel_setting		=	$wpdb->get_results("select * from $settings_table");
													$school_name = "";
													$school_logo = "";
													$school_add = "";
													$school_city = "";
													$school_state = "";
													$school_country = "";
													$school_number = "";
													$school_email = "";
													$school_site = "";
													foreach( $sel_setting as $setting ) :
														switch ($setting->id) {
															case (1): $school_name = $setting->option_value; break;
															case (2): $school_logo = $setting->option_value; break;
															case (6): $school_add = $setting->option_value; break;
															case (7): $school_city = $setting->option_value; break;
															case (8): $school_state = $setting->option_value; break;
															case (9): $school_country = $setting->option_value; break;
															case (10): $school_number = $setting->option_value; break;
															case (12): $school_email = $setting->option_value; break;
															case (13): $school_site = $setting->option_value; break;
															
														}
													endforeach; ?>
												<div class="invoice-header">
													<div class="invoice-header-logo-name row">

														<div class="invoice-header-logo col-md-3">
															<img src="<?php if(!empty($school_logo)) echo $school_logo; ?>" height=90 width=90>
														</div>
														<div class="invoice-header-name col-md-9">
															<h2><?php if(!empty($school_name)) echo $school_name; ?></h2>
														</div>

													</div>

													<div class="invoice-header-school-details">
														<b><?php echo $school_add.", ".$school_city; ?></b>
														<p><?php echo "Web: ".$school_site." | Email: ".$school_email; ?></p>
													</div>

													<div class="invoice-header-doc-details row">
														<div class="invoice-header-slip-no col-xs-4">
															<strong>Slip No.</strong>
															<div></div>
														</div>
														<div class="invoice-header-heading col-xs-4">
															<div>FEE BILL CUM RECEIPT</div>
														</div>
														<div class="invoice-header-date col-xs-4">
															<strong>Date:</strong>
															<div><?php echo $current_date; ?></div>
														</div>
													</div>
												</div>
												<br>
												<div class="invoice-details">

													<div class="blank b1">
														<strong>Name</strong>
														<div></div>
													</div>
													<div class="blank b2">
														<strong>Father Name</strong>
														<div></div>
													</div>
													<div class="blank b3">
														<div class="sb1">
															<strong>Mob No.</strong>
															<div></div>
														</div>
														<div class="sb2">
															<strong>Reg. No.</strong>
															<div></div>
														</div>
													</div>
													<div class="blank b4">
														<div class="sb1">
															<strong>From Month</strong>
															<div></div>
														</div>
														<div class="sb2">
															<strong>To Month</strong>
															<div></div>
														</div>
													</div>
													<div class="blank b5">
														<div class="sb1">
															<strong>Session</strong>
															<div></div>
														</div>
														<div class="sb2">
															<strong>Class/Section</strong>
															<div></div>
														</div>
													</div>

												</div>

												<div class="script-to-fill-invoice">
													
												</div>

												<div class="invoice-body">
													<table>
														<tr class="tab-head">
															<td>S NO.</td>
															<td>Type Of Charges</td>
															<td>Amount <i class="fa fa-inr"></i></td>
															<td>Paid Amount <i class="fa fa-inr"></i></td>
															<td>Balance <i class="fa fa-inr"></i></td>
														</tr>
														<tr class="adm-fees-tr-inv">
															<td>1</td>
															<td>Admission Fees</td>
															<td class="inv-expected-amt">0</td>
															<td class="inv-paid-amt">0</td>
															<td class="inv-bal-amt"></td>
														</tr>
														<tr class="tution-fees-te-inv">
															<td>2</td>
															<td>Tution Fees(Mothly)</td>
															<td class="inv-expected-amt">0</td>
															<td class="inv-paid-amt">0</td>
															<td class="inv-bal-amt"></td>
														</tr>
														<tr class="trans-chg-tr-inv">
															<td>3</td>
															<td>Transportation charges(Monthly)</td>
															<td class="inv-expected-amt">0</td>
															<td class="inv-paid-amt">0</td>
															<td class="inv-bal-amt"></td>
														</tr>
														<tr class="annual-chg-tr-inv">
															<td>4</td>
															<td>Annual Charges<br>(Dress+Books+Copies+Stationary)</td>
															<td class="inv-expected-amt">0</td>
															<td class="inv-paid-amt">0</td>
															<td class="inv-bal-amt"></td>
														</tr>
														<tr class="rec-chg-tr-inv">
															<td>5</td>
															<td>Recreation Charge</td>
															<td class="inv-expected-amt">0</td>
															<td class="inv-paid-amt">0</td>
															<td class="inv-bal-amt"></td>
														</tr>
														<tr class="inv-tab-bottom">
															<td></td>
															<td>Total</td>
															<td colspan="4" class="inv-tot-amt">0</td>
														</tr>
														<tr class="inv-tab-bottom">
															<td></td>
															<td>Paid Amount</td>
															<td colspan="4" class="inv-paid-amt">2</td>
														</tr>
														<tr class="inv-tab-bottom">
															<td></td>
															<td>Balance</td>
															<td colspan="4" class="inv-bal-amt">0</td>
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