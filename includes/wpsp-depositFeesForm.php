<?php 
	if (!defined('ABSPATH')) exit('No Such File');
	$adm_f = $ttn_f = $trans_f = $ann_f = $rec_f = $sfname_f = $smname_f = $slname_f = $pfname_f = $pmname_f = $plname_f = $sphone_f = $sregno = $class = $cid = $to_f = $from = $to = "";
	$months_array = array("January", "February", "March", "April", "May", "June", "july", "August", "September", "October", "November", "December");
 	if(isset( $_GET['uidff'] )){
		$uidff = $_GET['uidff'];
		$fees_status_table = $wpdb->prefix."wpsp_fees_status";
		$student_table = $wpdb->prefix."wpsp_student";
		$fees_rec_table = $wpdb->prefix."wpsp_fees_payment_record";
		$class_table = $wpdb->prefix."wpsp_class";
		$uidff_sql = $wpdb->get_results("SELECT * FROM $fees_status_table a, $student_table b, $class_table c WHERE a.uid = '$uidff' AND b.wp_usr_id = a.uid AND c.cid = b.class_id");
		foreach ($uidff_sql as $fee) {
			$adm_f = $fee->admission_fees;
			$ttn_f = $fee->tution_fees;
			$trans_f = $fee->transport_chg;
			$ann_f = $fee->annual_chg;
			$rec_f = $fee->recreation_chg;
			$sfname_f = $fee->s_fname;
			$smname_f = $fee->s_mname;
			$slname_f = $fee->s_lname;
			$pfname_f = $fee->p_fname;
			$pmname_f = $fee->p_mname;
			$plname_f = $fee->p_lname;
			$sphone_f = $fee->s_phone;
			$regno = $fee->s_regno;
			$class = $fee->c_name;
			$cid = $fee->cid;
		}
		$sql_month = $wpdb->get_results("SELECT `to` FROM $fees_rec_table WHERE uid = '$uidff' ORDER BY date_time DESC LIMIT 1");
		foreach ($sql_month as $mo) {
			$to_f = $mo->to;
		}
		if(!empty($to_f)){
			$paid_mo_index = array_search($to_f, $months_array) + 1 ;
			if($paid_mo_index > 11) $paid_mo_index = 0;
			$from = $months_array[$paid_mo_index];
			$to = date("F");
		}
		else{
			$from = date("F");
			$to = date("F");
		}
		$total_amount_f = $adm_f+$ttn_f+$trans_f+$ann_f+$rec_f;
		$student_full_name = $sfname_f." ".$smname_f." ".$slname_f;
		$father_full_name = $pfname_f." ".$pmname_f." ".$plname_f;
	}  
?>
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
									<div class="panel-heading"> Fees Deposit Form </div>
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
														<option <?php if(!empty($cid) && $cid == $classes->cid) echo "selected"; ?> value="<?php echo $classes->cid;?>" <?php if($sel_classid==$classes->cid) echo "selected"; ?>><?php echo $classes->c_name;?></option>
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
													<?php 
														if(!empty($student_full_name))
															echo "<option selected value='".$uidff."'>".$student_full_name." S/O ".$father_full_name."</option>";
													 ?>
												</select>
											</div>
											<label for="dep-amount">Select Month<sup>*</sup></label>
											<div class="form-inline">
												<div class="form-group dep-from-select">
													<select class="form-control">
														<option>Select From Month</option><?php
														for ($m=0; $m<12; $m++) { ?>
															<option <?php  if($months_array[$m] == $from) echo "selected" ?> value="<?php echo $months_array[$m]; ?>"><?php echo $months_array[$m]; ?></option>;
														<?php } ?>
													</select>
													<label>From</label>
												</div>
												<div class="form-group dep-to-select">
													<select class="form-control">
														<option>Select To Month</option><?php
														for ($m=0; $m<12; $m++) { ?>
															<option <?php  if($months_array[$m] == $to) echo "selected" ?> value="<?php echo $months_array[$m]; ?>"><?php echo $months_array[$m]; ?></option>;
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
											<div class="dep-adm-inp" <?php if(!empty($adm_f)) echo "style='display:block'"; ?> id="fees-inp">
												<label>Admission Fees(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control expected" value="<?php if(!empty($adm_f)) echo $adm_f; ?>" placeholder="Amount Expected" disabled >
													<input type="text" class="form-control paid" value="<?php if(!empty($adm_f)) echo $adm_f; ?>" placeholder="Paid Amount">
												</div>
											</div>
											<div class="dep-tf-inp" <?php if(!empty($ttn_f)) echo "style='display:block'"; ?> id="fees-inp">
												<label>Tution Fees(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control expected" value="<?php if(!empty($ttn_f)) echo $ttn_f; ?>" placeholder="Amount Expected" disabled >
													<input type="text" class="form-control paid" value="<?php if(!empty($ttn_f)) echo $ttn_f; ?>" placeholder="Paid Amount">
												</div>
											</div>
											<div class="dep-tc-inp" <?php if(!empty($trans_f)) echo "style='display:block'"; ?> id="fees-inp">
												<label>Transportation Chares(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control expected" value="<?php if(!empty($trans_f)) echo $trans_f; ?>" placeholder="Amount Expected" disabled >
													<input type="text" class="form-control paid" value="<?php if(!empty($trans_f)) echo $trans_f; ?>" placeholder="Paid Amount">
												</div>
											</div>
											<div class="dep-ac-inp" <?php if(!empty($ann_f)) echo "style='display:block'"; ?> id="fees-inp">
												<label>Annual Charges(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control expected" value="<?php if(!empty($ann_f)) echo $ann_f; ?>" placeholder="Amount Expected" disabled >
													<input type="text" class="form-control paid" value="<?php if(!empty($ann_f)) echo $ann_f; ?>" placeholder="Paid Amount">
												</div>
											</div>
											<div class="dep-rf-inp" <?php if(!empty($rec_f)) echo "style='display:block'"; ?> id="fees-inp">
												<label>Recreation Fees(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control expected" value="<?php if(!empty($rec_f)) echo $rec_f; ?>" placeholder="Amount Expected" disabled >
													<input type="text" class="form-control paid" value="<?php if(!empty($rec_f)) echo $rec_f; ?>" placeholder="Paid Amount">
												</div>
											</div>
											<input type="button" class="btn btn-success btn-block" value="Submit" id="dep-fees-btn">
						                </div>
								</header>
							</div>
                        </div>
                        <div class="col-md-8" class="invoice-panel">
                            <div class="panel-group">
								<header class="panel panel-primary">
									<div class="panel-heading"> Invoice Preview 
										<button type="button" class="btn btn-success btn-print"><i class="fa fa-print"></i> Print Invoice</button>
									</div>
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

														<div class="invoice-header-logo col-md-3 col-print-3">
															<img src="<?php if(!empty($school_logo)) echo $school_logo; ?>" height=90 width=90>
														</div>
														<div class="invoice-header-name col-md-9 col-print-9">
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
															<div><?php
																$receipts_table = $wpdb->prefix."wpsp_fees_receipts";
																$sql_slip_no = $wpdb->get_results("SELECT slip_no FROM $receipts_table ORDER BY slip_no DESC LIMIT 1");
																$slip_no = 0;
																if($wpdb->num_rows>0){
																	foreach ($sql_slip_no as $slip) {
																		$slip_no = $slip->slip_no + 1;
																	}
																}
																else{
																	$slip_no = 1;
																}
																echo $slip_no;
															?></div>
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
														<div><?php if(!empty($student_full_name)) echo $student_full_name; ?></div>
													</div>
													<div class="blank b2">
														<strong>Father Name</strong>
														<div><?php if(!empty($father_full_name)) echo $father_full_name; ?></div>
													</div>
													<div class="blank b3">
														<div class="sb1">
															<strong>Mob No.</strong>
															<div><?php if(!empty($sphone_f)) echo $sphone_f; ?></div>
														</div>
														<div class="sb2">
															<strong>Reg. No.</strong>
															<div><?php if(!empty($regno)) echo $regno; ?></div>
														</div>
													</div>
													<div class="blank b4">
														<div class="sb1">
															<strong>From Month</strong>
															<div><?php if(!empty($from)) echo $from; ?></div>
														</div>
														<div class="sb2">
															<strong>To Month</strong>
															<div><?php if(!empty($to)) echo $to; ?></div>
														</div>
													</div>
													<div class="blank b5">
														<div class="sb1">
															<strong>Session</strong>
															<div></div>
														</div>
														<div class="sb2">
															<strong>Class/Section</strong>
															<div><?php if(!empty($class)) echo $class; ?></div>
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
														<tr class="adm-fees-tr-inv" <?php if(!empty($adm_f)) echo "style='display:table-row'"; ?> >
															<td>1</td>
															<td>Admission Fees</td>
															<td class="inv-expected-amt"><?php if(!empty($adm_f)) echo "<i class='fa fa-inr'></i>".$adm_f."/-"; else "0"; ?></td>
															<td class="inv-paid-amt"><?php if(!empty($adm_f)) echo "<i class='fa fa-inr'></i>".$adm_f."/-"; else "0"; ?></td>
															<td class="inv-bal-amt"></td>
														</tr>
														<tr class="tution-fees-te-inv" <?php if(!empty($ttn_f)) echo "style='display:table-row'"; ?>>
															<td>2</td>
															<td>Tution Fees(Mothly)</td>
															<td class="inv-expected-amt"><?php if(!empty($ttn_f)) echo "<i class='fa fa-inr'></i>".$ttn_f."/-"; else "0"; ?></td>
															<td class="inv-paid-amt"><?php if(!empty($ttn_f)) echo "<i class='fa fa-inr'></i>".$ttn_f."/-"; else "0"; ?></td>
															<td class="inv-bal-amt"></td>
														</tr>
														<tr class="trans-chg-tr-inv" <?php if(!empty($trans_f)) echo "style='display:table-row'"; ?>>
															<td>3</td>
															<td>Transportation charges(Monthly)</td>
															<td class="inv-expected-amt"><?php if(!empty($trans_f)) echo "<i class='fa fa-inr'></i>".$trans_f."/-"; else "0"; ?></td>
															<td class="inv-paid-amt"><?php if(!empty($trans_f)) echo "<i class='fa fa-inr'></i>".$trans_f."/-"; else "0"; ?></td>
															<td class="inv-bal-amt"></td>
														</tr>
														<tr class="annual-chg-tr-inv" <?php if(!empty($ann_f)) echo "style='display:table-row'"; ?>>
															<td>4</td>
															<td>Annual Charges<br>(Dress+Books+Copies+Stationary)</td>
															<td class="inv-expected-amt"><?php if(!empty($ann_f)) echo "<i class='fa fa-inr'></i>".$ann_f."/-"; else "0"; ?></td>
															<td class="inv-paid-amt"><?php if(!empty($ann_f)) echo "<i class='fa fa-inr'></i>".$ann_f."/-"; else "0"; ?></td>
															<td class="inv-bal-amt"></td>
														</tr>
														<tr class="rec-chg-tr-inv" <?php if(!empty($rec_f)) echo "style='display:table-row'"; ?>>
															<td>5</td>
															<td>Recreation Charge</td>
															<td class="inv-expected-amt"><?php if(!empty($rec_f)) echo "<i class='fa fa-inr'></i>".$rec_f."/-"; else "0"; ?></td>
															<td class="inv-paid-amt"><?php if(!empty($rec_f)) echo "<i class='fa fa-inr'></i>".$rec_f."/-"; else "0"; ?></td>
															<td class="inv-bal-amt"></td>
														</tr>
														<tr class="inv-tab-bottom" <?php if( !empty($rec_f) || !empty($ann_f) || !empty($trans_f) || !empty($ttn_f) || !empty($adm_f)) echo "style='display:table-row'"; ?>>
															<td></td>
															<td>Total</td>
															<td colspan="4" class="inv-tot-amt">
																 <?php if( !empty($rec_f) || !empty($ann_f) || !empty($trans_f) || !empty($ttn_f) || !empty($adm_f)) echo "<i class='fa fa-inr'></i>".$total_amount_f."/-"; 
																 else echo "0"; ?>
															</td>
														</tr>
														<tr class="inv-tab-bottom" <?php if( !empty($rec_f) || !empty($ann_f) || !empty($trans_f) || !empty($ttn_f) || !empty($adm_f)) echo "style='display:table-row'"; ?>>
															<td></td>
															<td>Paid Amount</td>
															<td colspan="4" class="inv-paid-amt">
																<?php if( !empty($rec_f) || !empty($ann_f) || !empty($trans_f) || !empty($ttn_f) || !empty($adm_f)) echo "<i class='fa fa-inr'></i>".$total_amount_f."/-"; 
																else echo "0"; ?>
															</td>
														</tr>
														<tr class="inv-tab-bottom" <?php if( !empty($rec_f) || !empty($ann_f) || !empty($trans_f) || !empty($ttn_f) || !empty($adm_f)) echo "style='display:table-row'"; ?>>
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