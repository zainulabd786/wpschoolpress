<?php 
	if (!defined('ABSPATH')) exit('No Such File');
	$months_array = array("N/A","January", "February", "March", "April", "May", "June", "july", "August", "September", "October", "November", "December"); 
	$adm_f = $ttn_f = $trans_f = $ann_f = $rec_f = $sfname_f = $smname_f = $slname_f = $pfname_f = $pmname_f = $plname_f = $sphone_f = $sregno = $class = $cid = $to_f = $from = $to = $session = $from_ttn_month_due = $to_ttn_month_due = $from_trn_month_due = $to_trn_month_due = $school_name = $school_logo = $school_add = $school_city = $school_state = $school_country = $school_number = $school_email = $school_site = "";
	if(isset($_GET['tab']) && $_GET['tab'] == "DepositFees" && isset($_GET['uidf'])){
		$uidf = $_GET['uidf'];
		$student_table = $wpdb->prefix."wpsp_student";
		$fees_rec_table = $wpdb->prefix."wpsp_fees_payment_record";
		$class_table = $wpdb->prefix."wpsp_class";
		$dues_table = $wpdb->prefix."wpsp_fees_dues";
		$settings_table = $wpdb->prefix."wpsp_settings";
		$receipts_table = $wpdb->prefix."wpsp_fees_receipts";
		$uidff_sql = $wpdb->get_results("SELECT * FROM $student_table b, $class_table c WHERE b.wp_usr_id = $uidf AND c.cid = b.class_id");
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
		$dues_sql = $wpdb->get_results("SELECT SUM(CASE WHEN fees_type='adm' THEN amount ELSE 0 END) AS due_adm, SUM(CASE WHEN fees_type='ttn' THEN amount ELSE 0 END) AS due_ttn, SUM(CASE WHEN fees_type='trn' THEN amount ELSE 0 END) AS due_trn, SUM(CASE WHEN fees_type='ann' THEN amount ELSE 0 END) AS due_ann, SUM(CASE WHEN fees_type='rec' THEN amount ELSE 0 END) AS due_rec FROM $dues_table WHERE uid='$uidf'");
		foreach ($dues_sql as $due_amt) {
			$adm_f = $due_amt->due_adm;
			$ttn_f = $due_amt->due_ttn;
			$trn_f = $due_amt->due_trn;
			$ann_f = $due_amt->due_ann;
			$rec_f = $due_amt->due_rec;
		}

		$total_amount_f = $adm_f+$ttn_f+$trn_f+$ann_f+$rec_f;

		$get_due_months_sql = $wpdb->get_results("SELECT MIN(CASE WHEN fees_type='ttn' THEN month ELSE NULL END) AS from_ttn, MAX(CASE WHEN fees_type='ttn' THEN month ELSE 0 END) AS to_ttn, MIN(CASE WHEN fees_type='trn' THEN month ELSE NULL END) AS from_trn, MAX(CASE WHEN fees_type='trn' THEN month ELSE 0 END) AS to_trn FROM $dues_table WHERE uid='$uidf'");
		foreach ($get_due_months_sql as $due_month) {
			$from_ttn_month_due = $due_month->from_ttn;
			$to_ttn_month_due = $due_month->to_ttn;
			$from_trn_month_due = $due_month->from_trn;
			$to_trn_month_due = $due_month->to_trn;
		}
		$sql_session = $wpdb->get_results("SELECT option_value FROM $settings_table WHERE option_name = 'session'");
		foreach ($sql_session as $session) {
			$session = $session->option_value;
		} 
		$sql_slip_no = $wpdb->get_results("SELECT slip_no FROM $receipts_table ORDER BY slip_no DESC LIMIT 1");
		$slip_no = 0;
		if($wpdb->num_rows>0){
			foreach ($sql_slip_no as $slip) {
				$slip_no = $slip->slip_no + 1;
			}
		}
		else{
			$slip_no = 1;
		} ?>
		<div class="pg">

			<table class="details">

				<tr>
					<td>Slip No.:</td>
					<td><?php echo $slip_no; ?></td>
					<td>Date:</td>
					<td><?php echo date("d/m/Y"); ?></td>
				</tr>
				<tr>
					<td>Student Name:</td>
					<td><?php echo $student_full_name; ?></td>
					<td>Parent Name:</td>
					<td><?php echo $father_full_name; ?></td>
				</tr>
				<tr>
					<td>Registration Number:</td>
					<td><?php echo $regno; ?></td>
					<td>Mobile Number:</td>
					<td><?php echo $sphone_f; ?></td>
				</tr>
				<tr>
					<td>Session:</td>
					<td><?php echo $session; ?></td>
					<td>Class:</td>
					<td><?php echo $class; ?></td>
				</tr>
				
			</table>
				
			<h3 class="due-chart-head">Dues Chart</h3>

			<form method="post"> <button name="pay-btn" type="submit" class="btn btn-primary pay-btn">Pay Rs. <?php echo number_format($total_amount_f); ?> Now</button> </form>
			
			<table class="dues-chart">
				<tr>
					<td>Fees Type</td>
					<td>From Month</td>
					<td>To Month</td>
					<td>Amount</td>
				</tr>
				<?php 
				if(!empty($adm_f)){ ?>
				<tr>
					<td>Admission Fees</td>
					<td><?php echo $months_array[0]; ?></td>
					<td><?php echo $months_array[0]; ?></td>
					<td><?php echo "<i class='fa fa-inr'></i>".number_format($adm_f)."/-"; ?></td>
				</tr>
				<?php } 
				if(!empty($ttn_f)){ ?>
				<tr>
					<td>Tution Fees</td>
					<td><?php echo $months_array[$from_ttn_month_due]; ?></td>
					<td><?php echo $months_array[$to_ttn_month_due]; ?></td>
					<td><?php echo "<i class='fa fa-inr'></i>".number_format($ttn_f)."/-"; ?></td>
				</tr>
				<?php } 
				if(!empty($trn_f)){ ?>
				<tr>
					<td>Transportaion Charges</td>
					<td><?php echo $months_array[$from_trn_month_due]; ?></td>
					<td><?php echo $months_array[$to_trn_month_due]; ?></td>
					<td><?php echo "<i class='fa fa-inr'></i>".number_format($trn_f)."/-"; ?></td>
				</tr>
				<?php } 
				if(!empty($ann_f)){ ?>
				<tr>
					<td>Annual Charges</td>
					<td><?php echo $months_array[0]; ?></td>
					<td><?php echo $months_array[0]; ?></td>
					<td><?php echo "<i class='fa fa-inr'></i>".number_format($ann_f)."/-"; ?></td>
				</tr>
				<?php } 
				if(!empty($rec_f)){ ?>
				<tr>
					<td>Recreation Charges</td>
					<td><?php echo $months_array[0]; ?></td>
					<td><?php echo $months_array[0]; ?></td>
					<td><?php echo "<i class='fa fa-inr'></i>".number_format($rec_f)."/-"; ?></td>
				</tr>
				<?php } 
				if(!empty($total_amount_f)){ ?>
				<tr>
					<td colspan="2">Total Payable Amount</td>
					<td colspan="2"><?php echo "<i class='fa fa-inr'></i>".number_format($total_amount_f)."/-"; ?></td>
				</tr>
				<?php } ?>
			</table>
			
		</div> <?php
		function payment($key, $auth, $purpose, $amount, $phone, $url){
			include("instamojo/instamojo.php");
		   	$api = new Instamojo\Instamojo($key, $auth, 'https://test.instamojo.com/api/1.1/');
		   try {
			    $response = $api->paymentRequestCreate(array(
			        "purpose" => $purpose,
			        "amount" => $amount,
       				"phone" => $phone,
       				"send_sms" => true,
			        "redirect_url" => $url
			    ));
			   // print_r($response);
			    $redirect = $response['longurl'];
			    echo "<script> location = '".$redirect."' </script>";
			    exit();
			}
			catch (Exception $e) {
			    print('Error: ' . $e->getMessage());
			}
		}

		if(array_key_exists('pay-btn',$_POST)){
			$api_key = "test_ea87442294656deeb00d38764f4";
			$auth_token = "test_4d9cb6f667a20e243cfe20e8c39";
			$purpose = "Fees Deposit";
			$redirect_url = get_site_url()."/sch-student/?tab=DepositFees&uidf=".$uidf."&payment_status=payment_status";
			payment($api_key, $auth_token, $purpose, $total_amount_f, $sphone_f, $redirect_url);
		}

		if(isset($_GET['payment_status']) && $_GET['payment_status'] == "payment_status"){
			echo "successful";
			include("instamojo/instamojo.php");
			$key = "test_ea87442294656deeb00d38764f4";
			$auth = "test_4d9cb6f667a20e243cfe20e8c39";
			$api = new Instamojo\Instamojo($key, $auth, 'https://test.instamojo.com/api/1.1/');
			$pay_id = $_GET['payment_request_id'];
			try{
				$response = $api->paymentRequestStatus($pay_id);
				 //echo "<script> console.log('".$response[0]."') </script>";
				print "<pre>";
				print_r($response);
				print "</pre>";
			}
			catch (Exception $e) {
				print('Error: ' . $e->getMessage());
			}
		}
	}  	
?>