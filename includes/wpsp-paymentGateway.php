<?php 
	if (!defined('ABSPATH')) exit('No Such File');
	$wpdb->show_errors();
	$months_array = array("N/A","January", "February", "March", "April", "May", "June", "july", "August", "September", "October", "November", "December"); 
	$adm_f = $ttn_f = $trans_f = $ann_f = $rec_f = $sfname_f = $smname_f = $slname_f = $pfname_f = $pmname_f = $plname_f = $sphone_f = $sregno = $class = $cid = $to_f = $from = $to = $session = $from_ttn_month_due = $to_ttn_month_due = $from_trn_month_due = $to_trn_month_due = $school_name = $school_logo = $school_add = $school_city = $school_state = $school_country = $school_number = $school_email = $school_site = $email = "";
	if(isset($_GET['tab']) && $_GET['tab'] == "DepositFees" && isset($_GET['uidf'])){
		$uidf = $_GET['uidf'];
		$student_table = $wpdb->prefix."wpsp_student";
		$fees_rec_table = $wpdb->prefix."wpsp_fees_payment_record";
		$class_table = $wpdb->prefix."wpsp_class";
		$dues_table = $wpdb->prefix."wpsp_fees_dues";
		$settings_table = $wpdb->prefix."wpsp_settings";
		$receipts_table = $wpdb->prefix."wpsp_fees_receipts";
		$users_table = $wpdb->prefix."users";
		$uidff_sql = $wpdb->get_results("SELECT b.s_fname, b.s_mname, b.s_lname, b.p_fname, b.p_mname, b.p_lname, b.s_regno, b.s_phone, c.cid, c.c_name, a.user_email FROM $student_table b, $class_table c, $users_table a WHERE b.wp_usr_id = '$uidf' AND c.cid = b.class_id AND b.parent_wp_usr_id=a.ID");
		//echo "SELECT b.s_fname, b.s_mname, b.s_lname, b.p_fname, b.p_mname, b.p_lname, b.s_regno, b.s_phone, c.cid, c.c_name, a.user_email FROM $student_table b, $class_table c, $users_table a WHERE b.wp_usr_id = 43 AND c.cid = b.class_id AND b.parent_wp_usr_id=a.ID";
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
			$semail_f = $fee->user_email;
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
		<?php if(!empty($total_amount_f)){
			if(!isset($_GET['payment_status'])){ ?>
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
						<td><?php echo $months_array[($from_ttn_month_due>12)?$from_ttn_month_due-12:$from_ttn_month_due]; ?></td>
						<td><?php echo $months_array[($to_ttn_month_due>12)?$to_ttn_month_due-12:$to_ttn_month_due]; ?></td>
						<td><?php echo "<i class='fa fa-inr'></i>".number_format($ttn_f)."/-"; ?></td>
					</tr>
					<?php } 
					if(!empty($trn_f)){ ?>
					<tr>
						<td>Transportaion Charges</td>
						<td><?php echo $months_array[($from_trn_month_due>12)?$from_trn_month_due-12:$from_trn_month_due]; ?></td>
						<td><?php echo $months_array[($to_trn_month_due>12)?$to_trn_month_due-12:$to_trn_month_due]; ?></td>
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
				</table> <?php
			} 
		}	else{ ?>
				<div style="text-align: center;" class="alert alert-success">
					<h3>No Dues 😊</h3>
				</div> <?php
			} ?>
			
		</div> <?php
		function payment($key, $auth, $purpose, $amount, $name, $email, $phone, $url){
			include("instamojo/instamojo.php");
		   	$api = new Instamojo\Instamojo($key, $auth, 'https://test.instamojo.com/api/1.1/');
		   try {
			    $response = $api->paymentRequestCreate(array(
			        "purpose" => $purpose,
			        "amount" => $amount,
			        "buyer_name" => $name,
			        "send_email" => true,
			        "email" => $email,
			        "phone" => $phone,
			        "allow_repeated_payments" => false,
			        "redirect_url" => $url
			    ));
			   // print_r($response);
			    $redirect = $response['longurl'];
			    echo "<script> location = '".$redirect."' </script>";
			    exit();
			}
			catch (Exception $e) {
			    //print('Error: ' . $e->getMessage());
			    echo "<div class='alert alert-danger'>Payment Failed! " . $e->getMessage()."</div>";
			}
		}

		if(array_key_exists('pay-btn',$_POST)){
			$api_key = "test_ea87442294656deeb00d38764f4";
			$auth_token = "test_4d9cb6f667a20e243cfe20e8c39";
			$purpose = "Fees Deposit";
			$redirect_url = get_site_url()."/sch-student/?tab=DepositFees&uidf=".$uidf."&payment_status=payment_thankyou_page";
			payment($api_key, $auth_token, $purpose, $total_amount_f, $father_full_name, $semail_f, $sphone_f, $redirect_url);
		}

		if(isset($_GET['payment_status']) && $_GET['payment_status'] == "payment_thankyou_page"){
			$due_adm = $due_ttn = $due_trn = $due_ann = $due_rec = 0;
			include("instamojo/instamojo.php");
			$key = "test_ea87442294656deeb00d38764f4";
			$auth = "test_4d9cb6f667a20e243cfe20e8c39";
			$api = new Instamojo\Instamojo($key, $auth, 'https://test.instamojo.com/api/1.1/');
			$pay_id = $_GET['payment_request_id'];
			try{
				$response = $api->paymentRequestStatus($pay_id);
				$payment_status = $response['payments'][0]['status'];
				$payment_id =  $response['payments'][0]['payment_id'];
				$name =  $response['payments'][0]['buyer_name'];
				$paid_amount =  $response['payments'][0]['amount'];
				$mop =  $response['payments'][0]['instrument_type'];
				$uid = $_GET['uidf'];
				$todays_date = date('Y-m-d');
				$date_time = date('Y-m-d H:i:s');
				$rec_table = $wpdb->prefix."wpsp_fees_receipts";
				$record_table = $wpdb->prefix."wpsp_fees_payment_record";
				/*echo "<pre>"; 
				print_r($response); 
				echo "</pre>"; */
				if($payment_status == "Credit"){
					$wpdb->query("BEGIN;");

					$sql_slip_data = array(
						'slip_no' => $slip_no,
						'date' => $todays_date,
						'uid' => $uid,
						'cid' => $cid,
						'from_ttn' => $from_ttn_month_due,
						'to_ttn' => $to_ttn_month_due,
						'from_trn' => $from_trn_month_due,
						'to_trn' => $to_trn_month_due,
						'session' => $session,
						'adm' => $adm_f,
						'ttn' => $ttn_f,
						'trans' => $trn_f,
						'ann' => $ann_f,
						'rec' => $rec_f,
						'concession' => 0,
						'mop' => $mop,
						'pno' => $payment_id,
						'due_adm' => $due_adm,
						'due_ttn' => $due_ttn,
						'due_trn' => $due_trn,
						'due_ann' => $due_ann,
						'due_rec' => $due_rec
					);

					$fees_type_arr = "";
					if(!empty($adm_f)){
						$fees_type_arr .= "adm/";
						if($wpdb->query("DELETE FROM $dues_table WHERE fees_type='adm' AND amount='$adm_f' AND uid='$uid' AND session='$session' AND month='0'")==false) throw new Exception($wpdb->print_error());
						$record_data = array(
							'tid' => $payment_id."AD",
							'slip_no' => $slip_no,
							'date_time' => $date_time,
							'uid' => $uid,
							'month' => 0,
							'amount' => $adm_f,
							'session' => $session,
							'fees_type' => 'adm'
						);
						if($wpdb->insert($record_table, $record_data)==false) throw new Exception($wpdb->print_error());
					}
					if(!empty($ttn_f)){
						$fees_type_arr .= "ttn/";
						for($i=$from_ttn_month_due;$i<=$to_ttn_month_due;$i++){
							$amt = $wpdb->get_results("SELECT amount FROM $dues_table WHERE uid='$uid' AND fees_type='ttn' AND month='$i' AND session='$session'");
							$amount = $amt[0]->amount;
							if($wpdb->query("DELETE FROM $dues_table WHERE fees_type='ttn' AND amount='$amount' AND uid='$uid' AND session='$session' AND month='$i' ")==false) throw new Exception($wpdb->print_error());
							$record_data = array(
								'tid' => $payment_id."TN".$i,
								'slip_no' => $slip_no,
								'date_time' => $date_time,
								'uid' => $uid,
								'month' => $i,
								'amount' => $amount,
								'session' => $session,
								'fees_type' => 'ttn'
							);
							if($wpdb->insert($record_table, $record_data)==false) throw new Exception($wpdb->print_error());
						}
					}
					if(!empty($trn_f)){
						$fees_type_arr .= "trn/";
						for($i=$from_trn_month_due;$i<=$to_trn_month_due;$i++){
							$amt = $wpdb->get_results("SELECT amount FROM $dues_table WHERE uid='$uid' AND fees_type='trn' AND month='$i' AND session='$session'");
							$amount = $amt[0]->amount;
							if($wpdb->query("DELETE FROM $dues_table WHERE fees_type='trn' AND amount='$amount' AND uid='$uid' AND session='$session' AND month='$i'")==false) throw new Exception($wpdb->print_error());
							$record_data = array(
								'tid' => $payment_id."TR".$i,
								'slip_no' => $slip_no,
								'date_time' => $date_time,
								'uid' => $uid,
								'month' => $i,
								'amount' => $amount,
								'session' => $session,
								'fees_type' => 'trn'
							);
							if($wpdb->insert($record_table, $record_data)==false) throw new Exception($wpdb->print_error());
						}
					}
					if(!empty($ann_f)){
						$fees_type_arr .= "ann/";
						if($wpdb->query("DELETE FROM $dues_table WHERE fees_type='ann' AND amount='$ann_f' AND uid='$uid' AND session='$session' AND month='0'")==false) throw new Exception($wpdb->print_error());
						$record_data = array(
							'tid' => $payment_id."AN",
							'slip_no' => $slip_no,
							'date_time' => $date_time,
							'uid' => $uid,
							'month' => 0,
							'amount' => $ann_f,
							'session' => $session,
							'fees_type' => 'ann'
						);
						if($wpdb->insert($record_table, $record_data)==false) throw new Exception($wpdb->print_error());
					}
					if(!empty($rec_f)){
						$fees_type_arr .= "rec";
						if($wpdb->query("DELETE FROM $dues_table WHERE fees_type='rec' AND amount='$rec_f' AND uid='$uid' AND session='$session' AND month='0'")==false) throw new Exception($wpdb->print_error());
						$record_data = array(
							'tid' => $payment_id."RC",
							'slip_no' => $slip_no,
							'date_time' => $date_time,
							'uid' => $uid,
							'month' => 0,
							'amount' => $rec_f,
							'session' => $session,
							'fees_type' => 'rec'
						);
						if($wpdb->insert($record_table, $record_data)==false) throw new Exception($wpdb->print_error());
					}  
					if(!empty($adm_f) OR !empty($ttn_f) OR !empty($trn_f) OR !empty($ann_f) OR !empty($rec_f)){
						if($wpdb->insert($rec_table, $sql_slip_data)){

							echo "<div class='alert alert-success op-thankyou'>Thank you ".$father_full_name.". Your payment of <i class='fa fa-inr'><b>".$paid_amount."</b></i> is successfully submitted. Your Transaction ID is <b>".$payment_id."</b>. Please keep this ID for future Reference. <a id='".$slip_no."' href='#' class='p-print-slip'>Click Here To Print receipt.</a></div>";


						} 
						else throw new Exception($wpdb->print_error());

						$args = array(
							"reference" => $slip_no,
							"type" => 1,
							"group" => 1,
							"remarks" => 'Onlin Fees Payment by '.$father_full_name,
							"amount" => $total_amount_f,
							"mop" => 2
						);
						if(!apply_filters("ac_record_transaction", $args)) throw new Exception($wpdb->print_error());
					}
					

					$wpdb->query("COMMIT;");
				}
				else{
					throw new Exception("Something went Wrong. Please try again. if amount is debited from your account. It will be refunded within 2-3 working days");
				}
			}
			catch (Exception $e) {
				$wpdb->query("ROLLBACK;");
				echo "<div class='alert alert-danger'>Payment Failed! " . $e->getMessage()."</div>";
			} 
		}
	}  	

?>