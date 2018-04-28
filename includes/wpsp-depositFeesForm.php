<?php 
	if (!defined('ABSPATH')) exit('No Such File');
	$months_array = array("Select Month","January", "February", "March", "April", "May", "June", "july", "August", "September", "October", "November", "December"); 
	$adm_f = $ttn_f = $trans_f = $ann_f = $rec_f = $sfname_f = $smname_f = $slname_f = $pfname_f = $pmname_f = $plname_f = $sphone_f = $sregno = $class = $cid = $to_f = $from = $to = $session = $from_ttn_month_due = $to_ttn_month_due = $from_trn_month_due = $to_trn_month_due = $school_name = $school_logo = $school_add = $school_city = $school_state = $school_country = $school_number = $school_email = $school_site = $session_start = "";
	$settings_table	=	$wpdb->prefix."wpsp_settings";
	$sql_session = $wpdb->get_results("SELECT option_name, option_value FROM $settings_table WHERE option_name='session' || option_name='sch_session_start'");
	foreach ($sql_session as $sess) {
		if($sess->option_name == "session") $session =  $sess->option_value;
		if($sess->option_name == "sch_session_start") $session_start = $sess->option_value; 
	}
	if(isset( $_GET['uidff'] )){
		$uidff = $_GET['uidff'];
		$student_table = $wpdb->prefix."wpsp_student";
		$fees_rec_table = $wpdb->prefix."wpsp_fees_payment_record";
		$class_table = $wpdb->prefix."wpsp_class";
		$dues_table = $wpdb->prefix."wpsp_fees_dues";
		$uidff_sql = $wpdb->get_results("SELECT * FROM $student_table b, $class_table c WHERE b.wp_usr_id = $uidff AND c.cid = b.class_id");
		foreach ($uidff_sql as $fee) {
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
		$student_full_name = $sfname_f." ".$smname_f." ".$slname_f;
		$father_full_name = $pfname_f." ".$pmname_f." ".$plname_f;
		$dues_sql = $wpdb->get_results("SELECT SUM(CASE WHEN fees_type='adm' THEN amount ELSE 0 END) AS due_adm, SUM(CASE WHEN fees_type='ttn' THEN amount ELSE 0 END) AS due_ttn, SUM(CASE WHEN fees_type='trn' THEN amount ELSE 0 END) AS due_trn, SUM(CASE WHEN fees_type='ann' THEN amount ELSE 0 END) AS due_ann, SUM(CASE WHEN fees_type='rec' THEN amount ELSE 0 END) AS due_rec FROM $dues_table WHERE uid='$uidff'");
		foreach ($dues_sql as $due_amt) {
			$adm_f = $due_amt->due_adm;
			$ttn_f = $due_amt->due_ttn;
			$trn_f = $due_amt->due_trn;
			$ann_f = $due_amt->due_ann;
			$rec_f = $due_amt->due_rec;
		}

		$total_amount_f = $adm_f+$ttn_f+$trn_f+$ann_f+$rec_f;

		$get_due_months_sql = $wpdb->get_results("SELECT MIN(CASE WHEN fees_type='ttn' THEN month ELSE NULL END) AS from_ttn, MAX(CASE WHEN fees_type='ttn' THEN month ELSE 0 END) AS to_ttn, MIN(CASE WHEN fees_type='trn' THEN month ELSE NULL END) AS from_trn, MAX(CASE WHEN fees_type='trn' THEN month ELSE 0 END) AS to_trn FROM $dues_table WHERE uid='$uidff'");
		foreach ($get_due_months_sql as $due_month) {
			$from_ttn_month_due = $due_month->from_ttn;
			$to_ttn_month_due = $due_month->to_ttn;
			$from_trn_month_due = $due_month->from_trn;
			$to_trn_month_due = $due_month->to_trn;
		}
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
															<td>Tution Fees(<?php echo $months_array[($due->month>12)?$due->month-12:$due->month]." ".$due->session; ?>):</td>
															<td><i class="fa fa-inr"></i><?php echo number_format($due->amount); ?>/-</td>
														</tr>
														<?php }
														if($due->fees_type == "trans" || $due->fees_type == "trn"){ ?>
														<tr>
															<td>Transaportation Charges(<?php echo $months_array[($due->month>12)?$due->month-12:$due->month]." ".$due->session; ?>):</td>
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
													 <?php if ( in_array( 'administrator', $role ) || in_array( 'editor', $role )  ) { ?>
														<option value="all" <?php if($sel_classid=='all') echo "selected"; ?>><?php _e( 'All', 'SchoolWeb' ); ?></option>
													 <?php } ?>
												</select>
											</div>
											<div class="form-group dep-student-select">
												<label for="dep-student">Student<sup>*</sup></label>
												<select id="dep-student" class="form-control">
													<option value="">Select Student</option>
													<?php 
														//if(!empty($student_full_name))
															//echo "<option selected value='".$uidff."'>".$student_full_name." S/O ".$father_full_name."</option>";
														if(isset( $_GET['uidff'] )){
															$get_students = $wpdb->get_results("SELECT s_fname, s_mname, s_lname, p_fname, p_mname, p_lname, wp_usr_id FROM $student_table WHERE class_id=(SELECT class_id FROM wp_wpsp_student WHERE wp_usr_id='$uidff')");
															foreach ($get_students as $std) { ?>
																<option <?php if($std->wp_usr_id == $uidff) echo "selected"; ?> value="<?php echo $std->wp_usr_id; ?>"><?php echo $std->s_fname." ".$std->s_mname." ".$std->s_lname." S/D/O " .$std->p_fname." ".$std->p_mname." ".$std->p_lname; ?></option><?php
															}
														}
													 ?>
												</select>
											</div>
											<div class="form-group">
												<label>Session<sup>*</sup></label>
												<input type="text" value="<?php if(!empty($session)) echo $session; ?>" class="dep-session form-control" placeholder="Session">
											</div>
											<div class="form-group mop">
												<label>Mode Of Payment<sup>*</sup></label>
												<select class="form-control">
													<option value="">Select one</option>
													<option value="Cash">Cash</option>
													<option value="Cheque">Cheque</option>
													<option value="NEFT">NEFT</option>
												</select>
											</div>
											<div class="form-group pno-group">
												<label for="pno">Cheque/NEFT Number<sup>*</sup></label>
												<input type="text" value="0" class="form-control" id="pno">
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
											<div <?php if(!empty($adm_f)) echo "style='display:block'"; ?> class="dep-adm-inp" id="fees-inp">
												<label>Admission Fees(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control expected" <?php if(!empty($adm_f)) echo "value='".$adm_f."'"; else echo "value='0'"; ?> placeholder="Amount Expected" disabled>
													<input type="text" class="form-control paid" <?php if(!empty($adm_f)) echo "value='".$adm_f."'"; else echo "value='0'"; ?> placeholder="Paid Amount">
												</div>
											</div>
											<div <?php if(!empty($ttn_f)) echo "style='display:block'"; ?> class="dep-tf-inp" id="fees-inp">
												<label>Tution Fees(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<div class="form-inline">
														<div class="form-group dep-from-select">
															<select class="form-control"><?php
																for ($m=0; $m<=12; $m++) {
																	if($m == 0) $months_array[0] = "From";	 ?>
																	<option <?php if(!empty($from_ttn_month_due) && (($from_ttn_month_due>12)?$from_ttn_month_due-12:$from_ttn_month_due) == $m) echo "selected"; ?> value="<?php if($m<$session_start && !empty($m)) echo $m+12; else echo $m; ?>">
																		<?php echo $months_array[$m]; ?>
																	</option>;
																<?php } ?>
															</select>
														</div>
														<div class="form-group dep-to-select">
															<select class="form-control"><?php
																for ($m=0; $m<=12; $m++) { 
																	if($m == 0) $months_array[0] = "To"; ?>
																	<option <?php if(!empty($to_ttn_month_due) && (($to_ttn_month_due>12)?$to_ttn_month_due-12:$to_ttn_month_due) == $m) echo "selected"; ?> value="<?php if($m<$session_start && !empty($m)) echo $m+12; else echo $m; ?>"><?php echo $months_array[$m]; ?></option>;
																<?php } ?>
															</select>
														</div>
													</div>
													<input type="text" class="form-control expected" <?php if(!empty($ttn_f)) echo "value='".$ttn_f."'"; else echo "value='0'"; ?> placeholder="Amount Expected"  disabled>
													<input type="text" class="form-control paid" <?php if(!empty($ttn_f)) echo "value='".$ttn_f."'"; else echo "value='0'"; ?> placeholder="Paid Amount">
													<input type="hidden" id="original-amount">
													<label for="dep-concession">Concession(<i class="fa fa-inr"></i>)</label>
													<input type="text" id="dep-concession" value="0" class="form-control">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
												</div>
											</div>
											<div <?php if(!empty($trn_f)) echo "style='display:block'"; ?> class="dep-tc-inp" id="fees-inp">
												<label>Transportation Charges(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<div class="form-inline">
														<div class="form-group dep-trans-from-select">
															<select class="form-control"><?php
																for ($m=0; $m<=12; $m++) {
																	if($m == 0) $months_array[0] = "From";	 ?>
																	<option <?php if(!empty($from_trn_month_due) && (($from_trn_month_due>12)?$from_trn_month_due-12:$from_trn_month_due) == $m) echo "selected"; ?> value="<?php if($m<$session_start && !empty($m)) echo $m+12; else echo $m; ?>"><?php echo $months_array[$m]; ?></option>;
																<?php } ?>
															</select>
														</div>
														<div class="form-group dep-trans-to-select">
															<select class="form-control"><?php
																for ($m=0; $m<=12; $m++) { 
																	if($m == 0) $months_array[0] = "To"; ?>
																	<option <?php if(!empty($to_trn_month_due) && (($to_trn_month_due>12)?$to_trn_month_due-12:$to_trn_month_due) == $m) echo "selected"; ?> value="<?php if($m<$session_start && !empty($m)) echo $m+12; else echo $m; ?>"><?php echo $months_array[$m]; ?></option>;
																<?php } ?>
															</select>
														</div>
													</div>
													<input type="text" class="form-control expected" <?php if(!empty($trn_f)) echo "value='".$trn_f."'"; else echo "value='0'"; ?> placeholder="Amount Expected" disabled>
													<input type="text" class="form-control paid" <?php if(!empty($trn_f)) echo "value='".$trn_f."'"; else echo "value='0'"; ?> placeholder="Paid Amount">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
												</div>
											</div>
											<div <?php if(!empty($ann_f)) echo "style='display:block'"; ?> class="dep-ac-inp" id="fees-inp">
												<label>Annual Charges(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control expected" <?php if(!empty($ann_f)) echo "value='".$ann_f."'"; else echo "value='0'"; ?> placeholder="Amount Expected" disabled>
													<input type="text" class="form-control paid" <?php if(!empty($ann_f)) echo "value='".$ann_f."'"; else echo "value='0'"; ?> placeholder="Paid Amount">
												</div>
											</div>
											<div <?php if(!empty($rec_f)) echo "style='display:block'"; ?> class="dep-rf-inp" id="fees-inp">
												<label>Recreation Fees(<i class="fa fa-inr"></i>)</label>
												<div class="input-group">
													<span class="input-group-addon remove-inp"><i class="fa fa-close"></i></span>
													<input type="text" class="form-control expected" <?php if(!empty($rec_f)) echo "value='".$rec_f."'"; else echo "value='0'"; ?> placeholder="Amount Expected" disabled>
													<input type="text" class="form-control paid" <?php if(!empty($rec_f)) echo "value='".$rec_f."'"; else echo "value='0'"; ?> placeholder="Paid Amount">
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
												<?php 
													//fetch School Details From Database										
													
													$sel_setting	=	$wpdb->get_results("select * from $settings_table");
													
													foreach( $sel_setting as $setting ) :
														switch ($setting->option_name) {
															case ("sch_name"): $school_name = $setting->option_value; break;
															case ("sch_logo"): $school_logo = $setting->option_value; break;
															case ("sch_addr"): $school_add = $setting->option_value; break;
															case ("sch_city"): $school_city = $setting->option_value; break;
															case ("sch_state"): $school_state = $setting->option_value; break;
															case ("sch_counter"): $school_country = $setting->option_value; break;
															case ("sch_pno"): $school_number = $setting->option_value; break;
															case ("sch_email"): $school_email = $setting->option_value; break;
															case ("sch_website"): $school_site = $setting->option_value; break;
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
															<div><?php if(!empty($from_ttn_month_due)){ if($from_ttn_month_due>12)  echo $months_array[$from_ttn_month_due-12]; else  echo $months_array[$from_ttn_month_due]; } ?></div>
														</div>
														<div class="sb2">
															<strong>To Month</strong>
															<div><?php if(!empty($to_ttn_month_due)){ if($to_ttn_month_due>12) echo $months_array[$to_ttn_month_due-12]; else echo $months_array[$to_ttn_month_due]; } ?></div>
														</div>
													</div>
													<div class="blank b5">
														<div class="sb1">
															<strong>Session</strong>
															<div><?php if(!empty($session)) echo $session; ?></div>
														</div>
														<div class="sb2">
															<strong>Class/Section</strong>
															<div><?php if(!empty($class)) echo $class; ?></div>
														</div>
													</div>

													<div class="blank b6">
														<div class="sb1">
															<strong>Mode Of Payment</strong>
															<div></div>
														</div>
														<div class="sb2">
															<strong>Cheque/NEFT Number</strong>
															<div>N/A</div>
														</div>
													</div>
													<div class="blank b7">
														<strong>Concession</strong>
														<div class="d1"></div>
														<div class="d2"></div>
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
														<tr <?php if(!empty($adm_f)) echo "style='display:table-row'"; ?> class="adm-fees-tr-inv" >
															<td>1</td>
															<td>Admission Fees</td>
															<td class="inv-expected-amt"><?php if(!empty($adm_f)) echo "<i class='fa fa-inr'></i>".$adm_f."/-"; else echo "0"; ?></td>
															<td class="inv-paid-amt"><?php if(!empty($adm_f)) echo "<i class='fa fa-inr'></i>".$adm_f."/-"; else echo "0"; ?></td>
															<td class="inv-bal-amt">0</td>
														</tr>
														<tr <?php if(!empty($ttn_f)) echo "style='display:table-row'"; ?> class="tution-fees-te-inv" >
															<td>2</td>
															<td>
																Tution Fees
																(<div style="display: inline;" class="months"><?php 
																	if(!empty($from_ttn_month_due) && !empty($to_ttn_month_due)){
																		if($from_ttn_month_due>12){
																			echo $months_array[$from_ttn_month_due-12]."-";
																		} else{
																			echo $months_array[$from_ttn_month_due]."-";
																		}

																		if($to_ttn_month_due > 12){
																			echo $months_array[$to_ttn_month_due-12];
																		} else{
																			echo $months_array[$to_ttn_month_due];
																		}
																	} else "Monthly"; ?>
																</div>)
															</td>
															<td class="inv-expected-amt"><?php if(!empty($ttn_f)) echo "<i class='fa fa-inr'></i>".$ttn_f."/-"; else echo "0"; ?></td>
															<td class="inv-paid-amt"><?php if(!empty($ttn_f)) echo "<i class='fa fa-inr'></i>".$ttn_f."/-"; else echo "0"; ?></td>
															<td class="inv-bal-amt">0</td>
														</tr>
														<tr <?php if(!empty($trn_f)) echo "style='display:table-row'"; ?> class="trans-chg-tr-inv" >
															<td>3</td>
															<td>
																Transportation charges
																(<div style="display: inline;" class="months"><?php 
																	if(!empty($from_trn_month_due) && !empty($to_trn_month_due)){
																		if($from_trn_month_due>12){
																			echo $months_array[$from_trn_month_due-12]."-";
																		} else{
																			echo $months_array[$from_trn_month_due]."-";
																		}

																		if($to_trn_month_due > 12){
																			echo $months_array[$to_trn_month_due-12];
																		} else{
																			echo $months_array[$to_trn_month_due];
																		}
																	} else "Monthly"; ?>
																</div>)
															</td>
															<td class="inv-expected-amt"><?php if(!empty($trn_f)) echo "<i class='fa fa-inr'></i>".$trn_f."/-"; else echo "0"; ?></td>
															<td class="inv-paid-amt"><?php if(!empty($trn_f)) echo "<i class='fa fa-inr'></i>".$trn_f."/-"; else echo "0"; ?></td>
															<td class="inv-bal-amt">0</td>
														</tr>
														<tr <?php if(!empty($ann_f)) echo "style='display:table-row'"; ?> class="annual-chg-tr-inv" >
															<td>4</td>
															<td>Annual Charges<br>(Dress+Books+Copies+Stationary)</td>
															<td class="inv-expected-amt"><?php if(!empty($ann_f)) echo "<i class='fa fa-inr'></i>".$ann_f."/-"; else echo "0"; ?></td>
															<td class="inv-paid-amt"><?php if(!empty($ann_f)) echo "<i class='fa fa-inr'></i>".$ann_f."/-"; else echo "0"; ?></td>
															<td class="inv-bal-amt">0</td>
														</tr>
														<tr <?php if(!empty($rec_f)) echo "style='display:table-row'"; ?> class="rec-chg-tr-inv" >
															<td>5</td>
															<td>Recreation Charge</td>
															<td class="inv-expected-amt"><?php if(!empty($rec_f)) echo "<i class='fa fa-inr'></i>".$rec_f."/-"; else echo "0"; ?></td>
															<td class="inv-paid-amt"><?php if(!empty($rec_f)) echo "<i class='fa fa-inr'></i>".$rec_f."/-"; else echo "0"; ?></td>
															<td class="inv-bal-amt">0</td>
														</tr>
														<tr <?php if(!empty($adm_f) || !empty($ttn_f) || !empty($trn_f) || !empty($ann_f) || !empty($rec_f)) echo "style='display:table-row'"; ?> class="inv-tab-bottom" >
															<td></td>
															<td>Total</td>
															<td colspan="4" class="inv-tot-amt"><?php if(!empty($total_amount_f)) echo "<i class='fa fa-inr'></i>".$total_amount_f."/-"; else echo "0"; ?></td>
														</tr>
														<tr <?php if(!empty($adm_f) || !empty($ttn_f) || !empty($trn_f) || !empty($ann_f) || !empty($rec_f)) echo "style='display:table-row'"; ?> class="inv-tab-bottom" >
															<td></td>
															<td>Paid Amount</td>
															<td colspan="4" class="inv-paid-amt"><?php if(!empty($total_amount_f)) echo "<i class='fa fa-inr'></i>".$total_amount_f."/-"; else echo "0"; ?></td>
														</tr>
														<tr <?php if(!empty($adm_f) || !empty($ttn_f) || !empty($trn_f) || !empty($ann_f) || !empty($rec_f)) echo "style='display:table-row'"; ?> class="inv-tab-bottom" >
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