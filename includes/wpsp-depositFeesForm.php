<?php 
	if (!defined('ABSPATH')) exit('No Such File');
	$months_array = array("Select Month","January", "February", "March", "April", "May", "June", "july", "August", "September", "October", "November", "December"); 
	$adm_f = $ttn_f = $trans_f = $ann_f = $rec_f = $sfname_f = $smname_f = $slname_f = $pfname_f = $pmname_f = $plname_f = $sphone_f = $sregno = $class = $cid = $to_f = $from = $to = "";
	if(isset( $_GET['uidff'] )){
		$uidff = $_GET['uidff'];
		$student_table = $wpdb->prefix."wpsp_student";
		$fees_rec_table = $wpdb->prefix."wpsp_fees_payment_record";
		$class_table = $wpdb->prefix."wpsp_class";
		$dues_table = $wpdb->prefix."wpsp_fees_dues";
		$uidff_sql = $wpdb->get_results("SELECT * FROM $student_table b, $class_table c WHERE b.wp_usr_id = $uidff AND c.cid = b.class_id");
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
									<div class="panel-heading"> 
										Fees Deposit Form
										<?php if(isset( $_GET['uidff'] )){ ?>
										<button style="float: right;" type="button" class="btn btn-danger btn-xs dues-chart-btn" data-toggle="tooltip" title="Dues Chart"><i class="fa fa-table"></i>
										</button> 
										<div class="due-chart-container">
											<table>
											<tr>
												<th>Fees Type</th>
												<th>Amount</th>
											</tr>
											<?php
												$sql_dues_chart = $wpdb->get_results("SELECT * FROM $dues_table WHERE uid='$uidff' ORDER BY month DESC ");
												if(count($sql_dues_chart) > 0){
													foreach ($sql_dues_chart as $due) {
														if($due->fees_type == "adm") { ?>
														<tr>
															<td>Admission Fees:</td>
															<td><i class="fa fa-inr"></i><?php echo number_format($due->amount); ?>/-</td>
														</tr>
														<?php }
														if($due->fees_type == "ttn"){ ?>
														<tr>
															<td>Tution Fees(<?php echo $months_array[$due->month]." ".$due->session; ?>):</td>
															<td><i class="fa fa-inr"></i><?php echo number_format($due->amount); ?>/-</td>
														</tr>
														<?php }
														if($due->fees_type == "trans" || $due->fees_type == "trn"){ ?>
														<tr>
															<td>Transaportation Charges(<?php echo $months_array[$due->month]." ".$due->session; ?>):</td>
															<td><i class="fa fa-inr"></i><?php if($due->fees_type == "trans" || $due->fees_type == "trn") echo number_format($due->amount); ?>/-</td>
														</tr>
														<?php }
														if($due->fees_type == "ann"){ ?>
														<tr>
															<td>Annual Charges:</td>
															<td><i class="fa fa-inr"></i><?php if($due->fees_type == "ann") echo number_format($due->amount); ?>/-</td>
														</tr>
														<?php }
														if($due->fees_type == "rec"){ ?>
														<tr>
															<td>Recreation Charges:</td>
															<td><i class="fa fa-inr"></i><?php if($due->fees_type == "rec") echo number_format($due->amount); ?>/-</td>
														</tr>
														<?php }
													}
												}
												else{ ?>
													<tr><td class="alert alert-success" colspan="2">No Dues!</td></tr> <?php
												}
											?>
											</table>
										</div>
										<a style="float: right;" href="<?php echo "?id=".$uidff;?>" class="ViewStudent" data-id="<?php echo $uidff;?>" title="View Student Details"><i style="font-size: 17px;" class="fa fa-eye btn btn-success btn-xs"></i></a>
										<?php } ?>

									</div>
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
														<option value="<?php echo $classes->cid;?>" <?php if($classes->cid == $cid) echo "selected"; ?>><?php echo $classes->c_name;?></option>
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
											<div class="form-group">
												<label>Session</label>
												<input type="text" class="dep-session form-control" value="2018-19" placeholder="Session">
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
													<input type="text" class="form-control expected" value="0" placeholder="Amount Expected" >
													<input type="text" class="form-control paid" value="0" placeholder="Paid Amount">
												</div>
											</div>
											<div class="dep-tf-inp" id="fees-inp">
												<label>Tution Fees(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<div class="form-inline">
														<div class="form-group dep-from-select">
															<select class="form-control"><?php
																for ($m=0; $m<=12; $m++) {
																	if($m == 0) $months_array[0] = "From";	 ?>
																	<option value="<?php echo $m; ?>"><?php echo $months_array[$m]; ?></option>;
																<?php } ?>
															</select>
														</div>
														<div class="form-group dep-to-select">
															<select class="form-control"><?php
																for ($m=0; $m<=12; $m++) { 
																	if($m == 0) $months_array[0] = "To"; ?>
																	<option value="<?php echo $m; ?>"><?php echo $months_array[$m]; ?></option>;
																<?php } ?>
															</select>
														</div>
													</div>
													<input type="text" class="form-control expected" value="0" placeholder="Amount Expected"  disabled>
													<input type="text" class="form-control paid" value="0" placeholder="Paid Amount">
													<input type="hidden" id="original-amount">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
												</div>
											</div>
											<div class="dep-tc-inp" id="fees-inp">
												<label>Transportation Chares(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<div class="form-inline">
														<div class="form-group dep-trans-from-select">
															<select class="form-control"><?php
																for ($m=0; $m<=12; $m++) {
																	if($m == 0) $months_array[0] = "From";	 ?>
																	<option value="<?php echo $m; ?>"><?php echo $months_array[$m]; ?></option>;
																<?php } ?>
															</select>
														</div>
														<div class="form-group dep-trans-to-select">
															<select class="form-control"><?php
																for ($m=0; $m<=12; $m++) { 
																	if($m == 0) $months_array[0] = "To"; ?>
																	<option value="<?php echo $m; ?>"><?php echo $months_array[$m]; ?></option>;
																<?php } ?>
															</select>
														</div>
													</div>
													<input type="text" class="form-control expected" value="0" placeholder="Amount Expected" disabled>
													<input type="text" class="form-control paid" value="0" placeholder="Paid Amount">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
												</div>
											</div>
											<div class="dep-ac-inp" id="fees-inp">
												<label>Annual Charges(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control expected" value="0" placeholder="Amount Expected" >
													<input type="text" class="form-control paid" value="0" placeholder="Paid Amount">
												</div>
											</div>
											<div class="dep-rf-inp" id="fees-inp">
												<label>Recreation Fees(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control expected" value="0" placeholder="Amount Expected" >
													<input type="text" class="form-control paid" value="0" placeholder="Paid Amount">
												</div>
											</div>
											<div class="form-group">
												<label for="dep-concession">Concession(<i class="fa fa-inr"></i>)</label>
												<input type="text" id="dep-concession" class="form-control">
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
														<tr class="adm-fees-tr-inv" >
															<td>1</td>
															<td>Admission Fees</td>
															<td class="inv-expected-amt">0</td>
															<td class="inv-paid-amt">0</td>
															<td class="inv-bal-amt">0</td>
														</tr>
														<tr class="tution-fees-te-inv" >
															<td>2</td>
															<td>Tution Fees(<div style="display: inline;" class="months">Monthly</div>)</td>
															<td class="inv-expected-amt">0</td>
															<td class="inv-paid-amt">0</td>
															<td class="inv-bal-amt">0</td>
														</tr>
														<tr class="trans-chg-tr-inv" >
															<td>3</td>
															<td>Transportation charges(<div style="display: inline;" class="months">Monthly</div>)</td>
															<td class="inv-expected-amt">0</td>
															<td class="inv-paid-amt">0</td>
															<td class="inv-bal-amt">0</td>
														</tr>
														<tr class="annual-chg-tr-inv" >
															<td>4</td>
															<td>Annual Charges<br>(Dress+Books+Copies+Stationary)</td>
															<td class="inv-expected-amt">0</td>
															<td class="inv-paid-amt">0</td>
															<td class="inv-bal-amt">0</td>
														</tr>
														<tr class="rec-chg-tr-inv" >
															<td>5</td>
															<td>Recreation Charge</td>
															<td class="inv-expected-amt">0</td>
															<td class="inv-paid-amt">0</td>
															<td class="inv-bal-amt">0</td>
														</tr>
														<tr class="inv-tab-bottom" >
															<td></td>
															<td>Total</td>
															<td colspan="4" class="inv-tot-amt">0</td>
														</tr>
														<tr class="inv-tab-bottom" >
															<td></td>
															<td>Paid Amount</td>
															<td colspan="4" class="inv-paid-amt">0</td>
														</tr>
														<tr class="inv-tab-bottom" >
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
<div class="ajax-script-exec"></div>