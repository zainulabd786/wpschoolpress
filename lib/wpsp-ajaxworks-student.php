<?php
// Add Student login with admin/teacher
function wpsp_AddStudent() {
	//echo "hello";
    wpsp_Authenticate();	
	if (! isset( $_POST['sregister_nonce'] ) || ! wp_verify_nonce( $_POST['sregister_nonce'], 'StudentRegister' )) {
			echo "Unauthorized Submission";
			exit; 
	}
	
	$username	=	esc_attr($_POST['Username']);
	$studentEmail = esc_attr($_POST['email']);
	$studentPassword = esc_attr($_POST['Password']);
	$sendEmailFlag = true;
	//if Username is empty assign current time stamp as username
	$currentTimeStamp = time();
	if(empty($username)){
		$username = 'student_'.$currentTimeStamp;
	}
	
	// Also Dont sent email in that case, so set SendEmailFlag = false;
	if(empty($studentEmail)){
		$sendEmailFlag = false;
	}
	
	
	if( wpsp_CheckUsername($username,true)===true ) {
		echo "Given Student User Name Already Exists!";
		exit;
	}
	
	if( email_exists( $studentEmail ) ) {
		echo "Student Email ID Already Exists!";
		exit;
	}
	
	//if( strtolower( $username ) ==  strtolower( $_POST['pUsername'] ) ) {
		//echo "Both USer Name Should Not Be same";
		//exit;
	//}
	
	//if( strtolower( $_POST['pEmail'] ) ==  strtolower( $studentEmail ) ) {
		//echo "Both Email Address Should Not Be same";
		//exit;
	//}
	
	global $wpdb;
	$wpsp_student_table	=	$wpdb->prefix."wpsp_student";
	$wpsp_class_table	=	$wpdb->prefix."wpsp_class";
	$wpsp_fees_status_table	=	$wpdb->prefix."wpsp_fees_status";
	$wpsp_fees_settings_table	=	$wpdb->prefix."wpsp_fees_settings";
	if( isset( $_POST['Class'] ) && !empty( $_POST['Class'] ) ) {
		$classID	=	$_POST['Class'];
		$capacity	=	$wpdb->get_var("SELECT c_capacity FROM $wpsp_class_table where cid=$classID"); 		
		if( !empty( $capacity ) ) {
			$totalstudent	=	$wpdb->get_var("SELECT count(*) FROM $wpsp_student_table where class_id=$classID");
			if( $totalstudent > $capacity  ) {
				echo 'This Class reached to it\'s capacity, Please select another class';
				exit;
			}
		}
	}
	global $wpdb;
	$parentMsg	=	'';
	$parentSendmail	=	false;
	$wpsp_student_table	=	$wpdb->prefix."wpsp_student";	
	$firstname			=	esc_attr($_POST['s_fname']);					
	$parent_id			=	isset( $_POST['Parent'] ) ? esc_attr($_POST['Parent']) : '0';
	$email				=	esc_attr($studentEmail);	
    $pfirstname			=	esc_attr($_POST['p_fname']);
	$pmiddlename		=	esc_attr($_POST['p_mname']);
	$plastname			=	esc_attr($_POST['p_lname']);
	$pgender			=	esc_attr($_POST['p_gender']);
	$pedu 				=	esc_attr($_POST['p_edu']);
	$pprofession		=	esc_attr($_POST['p_profession']);      
	$pbloodgroup	      =  esc_attr($_POST['p_bloodgrp']);  
	
	$email	=	empty( $email ) ? wpsp_EmailGen($username) : $email;
		
	$userInfo = array(	'user_login'	=>	$username,
						'user_pass'		=>	esc_attr($studentPassword),
						'user_nicename'	=>	esc_attr($_POST['Name']),
						'first_name'	=>	$firstname,
						'user_email'	=>	$email,
						'role'			=>	'student' );
	$user_id = wp_insert_user( $userInfo );
	
	if( !empty( $_POST['pEmail'] ) ) {
		$response		=	getparentInfo( $_POST['pEmail'] ); //check for parent email id	
		
		if( isset( $response['parentID'] ) && !empty( $response['parentID'] ) ) { //Use data of existing user
			$parent_id 		= 	$response['parentID'];
			$pfirstname		=	$response['data']->p_fname;
			$pmiddlename	=	$response['data']->p_mname;
			$plastname		=	$response['data']->p_lname;
			$pgender		=	$response['data']->p_gender;
			$pedu			=	$response['data']->p_edu;
			$pprofession	=	$response['data']->p_profession;
			$pbloodgroup	=	$response['data']->p_bloodgrp;		
		} else {		
			if( wpsp_CheckUsername( $_POST['pUsername'] ,true)===true ){
				$parentMsg	=	'Parent UserName Already Exists';
			} else {
				$parentInfo = array( 'user_login'	=>	$_POST['pUsername'],
								'user_pass'		=>	esc_attr($_POST['pPassword']),
								'user_nicename'	=>	esc_attr($_POST['pUsername']),
								'first_name'	=>	esc_attr($_POST['pfirstname']),
								'user_email'	=>	esc_attr($_POST['pEmail']),
								'role'			=>	'parent' );
				$parent_id = wp_insert_user( $parentInfo );	//Creating parent

				
				$msg = 'Hello '.$_POST['pfirstname'];
				$msg .= '<br>Your are registered as parent at <a href="'.site_url().'">School</a><br><br>';
				$msg .= 'Your Login details are below.<br>';
				$msg .= 'Your User Name is : ' .$_POST['pUsername'].'<br>';
				$msg .= 'Your Password is : '.$_POST['pPassword'].'<br><br>'; 
				$msg .= 'Please Login by clicking <a href="'.site_url().'/sch-dashboard">Here </a><br><br>';
				$msg .= 'Thanks,<br>'.get_bloginfo('name');
				wpsp_send_mail( $_POST['pEmail'], 'User Registered',$msg) ;
				
				if( !is_wp_error($parent_id) && !empty( $_FILES['pdisplaypicture']['name'] ) ) {
					$parentSendmail	=	true;
					$avatar	=	uploadImage('pdisplaypicture');					
					if( isset( $avatar[ 'url' ] ) ) { //Update parent's profile image
						update_user_meta( $parent_id, 'displaypicture', array ( 'full'=>$avatar[ 'url' ] ) ); 
						update_user_meta( $parent_id, 'simple_local_avatar', array ( 'full'=>$avatar[ 'url' ] ) ); 
					}				
				} else if( is_wp_error($parent_id) ) {
					$parentMsg		=	$parent_id->get_error_message();
					$parent_id 		= 	'';
					$pfirstname		=	$pmiddlename	= $plastname	= $pgender = $pedu = $pprofession =	$pbloodgroup = '';
				}
			}
		}	
	}	
	
	if(!is_wp_error($user_id)) {
		$studenttable	=	array(
						'wp_usr_id' 		=>	$user_id,
						'parent_wp_usr_id'	=>	$parent_id,						
						'class_id'			=>	isset( $_POST['Class'] ) ? esc_attr( $_POST['Class'] ) : '',						
						's_rollno' 			=>	isset( $_POST['s_rollno'] ) ? esc_attr($_POST['s_rollno']):'',
						's_regno' 			=>	isset( $_POST['s_regno'] ) ? esc_attr($_POST['s_regno']):'', // Bharatdan Gadhavi - 13th Feb 2018 
						's_fname' 			=>  $firstname,
						's_mname' 			=>  isset( $_POST['s_mname'] ) ? esc_attr( $_POST['s_mname'] ) : '',
						's_lname' 			=>  isset( $_POST['s_lname'] ) ? esc_attr( $_POST['s_lname'] ) : '',
						's_zipcode'			=> 	isset( $_POST['s_zipcode'] ) ?	esc_attr( $_POST['s_zipcode'] ) : '',
						's_country'			=> 	isset( $_POST['s_country'] ) ? esc_attr( $_POST['s_country'] ) : '',
						's_gender'			=> 	isset( $_POST['s_gender'] ) ? esc_attr($_POST['s_gender']) : '',
						's_address'			=>	isset( $_POST['s_address'] ) ? esc_attr( $_POST['s_address'] ) : '',						
						's_bloodgrp' 		=> 	isset( $_POST['s_bloodgrp'] ) ? esc_attr($_POST['s_bloodgrp']) : '',						
						's_dob'				=>	isset( $_POST['s_dob'] ) && !empty( $_POST['s_dob'] ) ? wpsp_StoreDate( $_POST['s_dob'] ) :'',
						's_doj'				=>	isset( $_POST['s_doj'] ) && !empty( $_POST['s_doj'] ) ? wpsp_StoreDate( $_POST['s_doj'] ) :'',
						's_phone'			=> 	isset( $_POST['s_phone'] ) ? esc_attr( $_POST['s_phone'] ) : '',
						'p_fname' 			=>  $pfirstname,
						'p_mname'			=>  $pmiddlename,
						'p_lname' 			=>  $plastname,
						'p_gender' 			=> 	$pgender,
						'p_edu' 			=>	$pedu,
						'p_profession' 		=>  $pprofession,
						's_paddress'		=>	isset( $_POST['s_paddress'] ) ? esc_attr($_POST['s_paddress']) : '',
						'p_bloodgrp' 		=> $pbloodgroup,
						's_city' 			=> isset( $_POST['s_city'] ) ? esc_attr( $_POST['s_city'] ) :'',
						's_pcountry'		=> isset( $_POST['s_pcountry'] ) ? esc_attr( $_POST['s_pcountry'] ) : '',
						's_pcity' 			=> isset( $_POST['s_pcity'] ) ? esc_attr( $_POST['s_pcity'] ) :'',						
						's_pzipcode'		=> isset( $_POST['s_pzipcode'] ) ? $_POST['s_pzipcode'] :''
						 );
		$cid_for_fee = $_POST['Class'];
		$fees_settings_sql = $wpdb->get_results("SELECT * FROM $wpsp_fees_settings_table WHERE cid='$cid_for_fee'");
		$adm_f = $ttn_f = $trans_f = $ann_f = $rec_f = 0;
		foreach ($fees_settings_sql as $fee) {
			$adm_f = $fee->admission_fees;
			$ttn_f = $fee->tution_fees;
			$trans_f = $fee->transport_chg;
			$ann_f = $fee->annual_chg;
			//$rec_f = $fee->recreation_chg;
		}
		if($sendEmailFlag){
			$msg = 'Hello '.$first_name;
			$msg .= '<br>Your are registered as student at <a href="'.site_url().'">School</a><br><br>';
			$msg .= 'Your Login details are below.<br>';
			$msg .= 'Your User Name is : ' .$username.'<br>';
			$msg .= 'Your Password is : '.$studentPassword.'<br><br>'; 
			$msg .= 'Please Login by clicking <a href="'.site_url().'/sch-dashboard">Here </a><br><br>';
			$msg .= 'Thanks,<br>'.get_bloginfo('name');
			
			wpsp_send_mail( $email, 'User Registered',$msg) ;
		}

		$sp_stu_ins = $wpdb->insert( $wpsp_student_table , $studenttable );
				//send registration mail
			wpsp_send_user_register_mail( $userInfo, $user_id );
			if (!empty( $_FILES['displaypicture']['name'])) {
				$avatar	=	uploadImage('displaypicture');				
				if( isset( $avatar[ 'url' ] ) ) {
					update_user_meta( $user_id, 'displaypicture', array ( 'full'=>$avatar[ 'url' ] ) ); 
					update_user_meta( $user_id, 'simple_local_avatar', array ( 'full'=>$avatar[ 'url' ] ) ); 
				}	
			}
			$msg	=	$sp_stu_ins ? "success" : "Oops! Something went wrong try again.";
	} else if(is_wp_error($user_id)) {
        $msg	=	$user_id->get_error_message();
	}
	echo $msg;
	wp_die();
}

add_action( 'wp_ajax_check_parent_info', 'wpsp_check_parent_info' );
function wpsp_check_parent_info(){
	$response = array();	
	$response['status']	=	0; //Fail status
	if( isset( $_POST['parentEmail'] ) && !empty( $_POST['parentEmail'] ) ) {
		$parentEmail	=	$_POST['parentEmail'];
		$response		=	getparentInfo( $parentEmail );		
	}
	echo json_encode( $response);
	exit();
}

function getparentInfo( $parentEmail ) {
	$parentInfo		=	get_user_by( 'email', $parentEmail);
	$response['status']	=	0;
	if( !empty( $parentInfo ) ) {
		global $wpdb;
		$student_table 	=	$wpdb->prefix . "wpsp_student";
		$roles			=	$parentInfo->roles;
		$parentID		=	$parentInfo->ID;
		$chck_parent	=	$wpdb->get_row("SELECT p_fname,p_mname,p_lname, p_gender, p_edu,  p_profession, p_bloodgrp from $student_table where parent_wp_usr_id=$parentID");
		$response['parentID']	=	$parentID;
		if( !empty( $chck_parent ) ) {
			$response['data']		=	$chck_parent;
			$response['status']		=	1;
			$response['username']	=	$parentInfo->data->user_login;
		}
	}
	return $response;
}

/*Upload Image*/
function uploadImage( $file ){
	
	if (!empty( $_FILES[$file]['name'])) {
		$mimes=array (
			'jpg|jpeg|jpe'=>'image/jpeg',
			'gif'=>'image/gif',
			'png'=>'image/png',
			'bmp'=>'image/bmp',
			'tif|tiff'=>'image/tiff'
		);
		
		if (!function_exists('wp_handle_upload'))
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		
		$avatar=wp_handle_upload( $_FILES[$file], array ('mimes'=>$mimes, 'test_form'=>false, 'unique_filename_callback'=>array ( $this, 'unique_filename_callback' ) ) );
		
		if ( empty( $avatar[ 'file' ] ) ) {
			switch ( $avatar[ 'error' ] ) {
				case 'File type does not meet security guidelines. Try another.' :
					add_action( 'user_profile_update_errors', create_function( '$a', '$a->add("avatar_error",__("Please upload a valid image file for the avatar.","kv_student_photo_edit"));' ) );
					break;
				default :
				add_action( 'user_profile_update_errors', create_function( '$a', '$a->add("avatar_error","<strong>".__("There was an error uploading the avatar:","kv_student_photo_edit")."</strong> ' . esc_attr( $avatar[ 'error' ] ) . '");' ) );
			}
			return;
		}
		return $avatar;
	}
}
/*Update Student*/
function wpsp_UpdateStudent(){
    wpsp_Authenticate();	
	$user_id=esc_attr($_POST['wp_usr_id']);
	global $wpdb;
	$wpsp_student_table	=	$wpdb->prefix."wpsp_student";
	$errors				=	validation(array($_POST['s_fname']=>'required',$_POST['s_lname']=>'required') );
    if( is_array($errors) ) {
        echo "<div class='col-md-12'><div class='alert alert-danger'>";
        foreach($errors as $error){
            echo "<li>".$error."</li>";
        }
        echo "</div></div>";
        return false;
    }	
	
	$wpsp_class_table	=	$wpdb->prefix."wpsp_class";
	if( isset( $_POST['Class'] ) && !empty( $_POST['Class'] ) && $_POST['Class'] != $_POST['prev_select_class'] ) {
		$classID	=	$_POST['Class'];
		$capacity	=	$wpdb->get_var("SELECT c_capacity FROM $wpsp_class_table where cid=$classID"); 		
		if( !empty( $capacity ) ) {
			$totalstudent	=	$wpdb->get_var("SELECT count(*) FROM $wpsp_student_table where class_id=$classID");			
			if( $totalstudent > $capacity  ) {
				echo '<div class="col-md-12"><div class="alert alert-danger">This Class reached to it\'s capacity, Please select another class</div></div>';
				return false;
			}
		}
	}
	$pfirstname			=	esc_attr($_POST['p_fname']);
	$pmiddlename		=	esc_attr($_POST['p_mname']);
	$plastname			=	esc_attr($_POST['p_lname']);
	$pgender			=	esc_attr($_POST['p_gender']);
	$pedu 				=	esc_attr($_POST['p_edu']);
	$pprofession		=	esc_attr($_POST['p_profession']);      
	$pbloodgroup	      =  esc_attr($_POST['p_bloodgrp']);
	
	$studenttable	=	array(
						'class_id'			=>	isset( $_POST['Class'] ) ? esc_attr( $_POST['Class'] ) : '',						
						's_rollno' 			=>	isset( $_POST['s_rollno'] ) ? esc_attr($_POST['s_rollno']):'',
						's_regno' 			=>	isset( $_POST['s_regno'] ) ? esc_attr($_POST['s_regno']):'',// Bharatdan Gadhavi - 13th Feb 2018 
						's_fname' 			=>  isset( $_POST['s_fname'] ) ? esc_attr( $_POST['s_fname'] ) : '',
						's_mname' 			=>  isset( $_POST['s_mname'] ) ? esc_attr( $_POST['s_mname'] ) : '',
						's_lname' 			=>  isset( $_POST['s_lname'] ) ? esc_attr( $_POST['s_lname'] ) : '',
						's_zipcode'			=> 	isset( $_POST['s_zipcode'] ) ?	esc_attr( $_POST['s_zipcode'] ) : '',
						's_country'			=> 	isset( $_POST['s_country'] ) ? esc_attr( $_POST['s_country'] ) : '',
						's_gender'			=> 	isset( $_POST['s_gender'] ) ? esc_attr($_POST['s_gender']) : '',
						's_address'			=>	isset( $_POST['s_address'] ) ? esc_attr( $_POST['s_address'] ) : '',						
						's_bloodgrp' 		=> 	isset( $_POST['s_bloodgrp'] ) ? esc_attr($_POST['s_bloodgrp']) : '',						
						's_dob'				=>	isset( $_POST['s_dob'] ) && !empty( $_POST['s_dob'] ) ? wpsp_StoreDate( $_POST['s_dob'] ) :'',
						's_doj'				=>	isset( $_POST['s_doj'] ) && !empty( $_POST['s_doj'] ) ? wpsp_StoreDate( $_POST['s_doj'] ) :'',
						's_phone'			=> 	isset( $_POST['s_phone'] ) ? esc_attr( $_POST['s_phone'] ) : '',
						'p_fname' 			=>  $pfirstname,
						'p_mname'			=>  $pmiddlename,
						'p_lname' 			=>  $plastname,
						'p_gender' 			=> 	$pgender,
						'p_edu' 			=>	$pedu,
						'p_profession' 		=>  $pprofession,
						's_paddress'		=>	isset( $_POST['s_paddress'] ) ? esc_attr($_POST['s_paddress']) : '',
						'p_bloodgrp' 		=> $pbloodgroup,
						's_city' 			=> isset( $_POST['s_city'] ) ? esc_attr( $_POST['s_city'] ) :'',
						's_pcountry'		=> isset( $_POST['s_pcountry'] ) ? esc_attr( $_POST['s_pcountry'] ) : '',
						's_pcity' 			=> isset( $_POST['s_pcity'] ) ? esc_attr( $_POST['s_pcity'] ) :'',						
						's_pzipcode'		=> isset( $_POST['s_pzipcode'] ) ? $_POST['s_pzipcode'] :''
						 );						 
	$stu_upd 		=	$wpdb->update( $wpsp_student_table , $studenttable, array('wp_usr_id'=>$user_id) );    	
	if (!empty( $_FILES['displaypicture']['name'])) {
		$avatar	=	uploadImage('displaypicture');		
		if( isset( $avatar[ 'url' ] ) ) {
			update_user_meta( $user_id, 'displaypicture', array ( 'full'=>$avatar[ 'url' ] ) ); 
			update_user_meta( $user_id, 'simple_local_avatar', array ( 'full'=>$avatar[ 'url' ] ) ); 
		}	
	}
    if( is_wp_error( $stu_upd ) ) {
        $msg= "<div class='col-md-12 col-lg-12'><div class='alert alert-warning'>".$stu_upd->get_error_message()."</div></div>";
    }else {
        $msg = "<div class='col-md-12 col-lg-12'><div class='alert alert-success'>Student profile updated successfully</div></div>" ;
    }
	echo $msg;
}

/*View Student*/
/* Student Functions */
function wpsp_StudentPublicProfile(){
	global $wpdb;
	$months_array = array("N/A","January", "February", "March", "April", "May", "June", "july", "August", "September", "October", "November", "December"); 
	$due_amount = 0;
	$student_table	=	$wpdb->prefix."wpsp_student";
	$class_table	=	$wpdb->prefix."wpsp_class";
	$users_table	=	$wpdb->prefix."users";
	$fees_table 	=	$wpdb->prefix."wpsp_fees_receipts";
	$sid			=	$_POST['id'];
	$stinfo			=	$wpdb->get_row("select a.*,b.c_name,d.user_email from $student_table a LEFT JOIN $class_table b ON a.class_id=b.cid LEFT JOIN $users_table d ON d.ID=a.wp_usr_id where a.wp_usr_id='$sid'");
	$sql_fees = $wpdb->get_results("SELECT * FROM $fees_table WHERE uid = '$sid' ORDER BY slip_no DESC");
	if(!empty($stinfo) ) {
		$loc_avatar		=	get_user_meta($stinfo->wp_usr_id,'simple_local_avatar',true);
		$img_url		=	isset( $loc_avatar['full'] ) && !empty( $loc_avatar['full'] ) ? $loc_avatar['full'] : WPSP_PLUGIN_URL.'img/avatar.png';
		$stinfo->imgurl	=	$img_url;
		$parentID		=	$stinfo->parent_wp_usr_id;
		$parentEmail	=	'';
		$dues_table = $wpdb->prefix."wpsp_fees_dues";
		if( !empty( $parentID )	) {
			$parentInfo	=	get_userdata( $parentID );
			$parentEmail	=	isset( $parentInfo->data->user_email ) ? $parentInfo->data->user_email :'';			
		} ?>
			<section class='content'>
				<div class='row'>
					<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
					  <div class='panel panel-info'>
						<div class='panel-heading'>
						  <h3 class='panel-title'><?php echo $stinfo->s_fname." ".$stinfo->s_mname." ".$stinfo->s_lname; ?></h3>
						</div>
						<div class='panel-body'>
						<div class='row'>
							<div class='col-md-3 col-lg-3'>
								<img src='<?php echo $img_url; ?>' height='150px' width='150px' class='img img-circle'/>							
							</div>
							<div class=' col-md-9 col-lg-9 '> 
								<table class='table table-user-information'>
									<tbody>
										<tr>
											<td class='bold'>Roll No.</td>
											<td><?php echo $stinfo->s_rollno; ?></td>
										</tr
										<tr>
											<td class='bold'>Registration No.</td>
											<td><?php echo $stinfo->s_regno; ?></td>
										</tr>
										<tr>
											<td class='bold'>Class </td>
											<td>
												<?php echo $stinfo->c_name; ?>
											</td>
										</tr>
										<tr>
											<td class='bold'>Gender</td>
											<td>
												<?php echo $stinfo->s_gender; ?>
											</td>
										</tr>
										<tr>
											<td class='bold'>Date of Birth</td>
											<td>
											<?php echo wpsp_ViewDate($stinfo->s_dob); ?>
											</td>
										</tr>
										<tr>
											<td class='bold'>Date of Join</td>
											<td>
												<?php echo wpsp_ViewDate($stinfo->s_doj); ?>
											</td>
										</tr>
										<tr>
											<td class='bold'>Address</td>
											<td><?php echo $stinfo->s_address; ?></td>
										</tr>
										<tr>
											<td class='bold'>City</td>
											<td><?php echo $stinfo->s_pcity; ?></td>
										</tr>
										<tr>
											<td class='bold'>Country</td>
											<td><?php echo $stinfo->s_country; ?></td>
										</tr>
										<tr>
											<td class='bold'>ZipCode</td>
											<td><?php echo $stinfo->s_zipcode; ?></td>
										</tr>
										<tr>
											<td class='bold'>Email</td>
											<td><?php echo $stinfo->user_email; ?></td>
										</tr>
										<tr>
											<td class='bold'>Blood Group</td>
											<td><?php echo $stinfo->s_bloodgrp; ?></td>
										</tr>
										<tr>
											<td class='bold'>Phone Number</td>
											<td>
												<?php echo $stinfo->s_phone; ?>
											</td>
										</tr>
										<tr>
											<td class='bold'>Parent Name</td>
											<td>
												<?php echo	$stinfo->p_fname." ".$stinfo->p_mname." ".$stinfo->p_lname; ?>
											</td>
										</tr>
										<tr>
											<td class='bold'>Parent Gender</td>
											<td><?php echo $stinfo->p_gender; ?></td>
										</tr>
										<tr>
											<td class='bold'>Parent Email</td>
											<td><?php echo $parentEmail; ?></td>
										</tr>
										<tr>
											<td class='bold'>Parent Profession</td>
											<td><?php echo $stinfo->p_profession; ?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<?php 
							$due = "";
							$sql_dues = $wpdb->get_results("SELECT SUM(amount) AS amount FROM $dues_table WHERE uid='$stinfo->wp_usr_id'");
							foreach ($sql_dues as $due) {
								$due = $due->amount;
							}
							if(!empty($due)){ ?>
								<div class='due-container'>
									<div class='panel-group' id='accordion'>
										<div class='panel panel-primary'>
											<h4 class='panel-title'>
												<button type='button' class='btn btn-danger btn-block' id='collapse-button' data-parent='#accordion' data-toggle='collapse' href='#due-fees-details'><?php echo "<i class='fa fa-inr'></i>".number_format($due)." is due to this student"; ?></button>
											</h4>
											<div id='due-fees-details' class='panel-collapse collapse'>
												<div id='panel-body' class='panel-body'>
													<table>
														<tr class='tab-head'>
															<td>Fees Type</td>
															<td>Amount</td>
															<td>Month</td>
															<td>Session</td>
														</tr> <?php
														$sql_dues_det = $wpdb->get_results("SELECT * FROM $dues_table WHERE uid='$stinfo->wp_usr_id'");
														foreach ($sql_dues_det as $due_fee) {
															if(!empty($due_fee->amount)){
																switch ($due_fee->fees_type) {
																 	case 'adm':
																 		$fees_type = "Admission Fees";
																 	break;
																 	
																 	case "ttn":
																 		$fees_type = "Tution Fees";
																 	break;

																 	case 'trn':
																 		$fees_type = "Transport Charges";
																 	break;
																 	
																 	case "ann":
																 		$fees_type = "Annual Charges";
																 	break;

																 	case "rec":
																 		$fees_type = "Recreation Charges";
																 	break;
																 } ?>
																<tr id='<?php echo $due_fee->id; ?>'>
																	<td><?php echo $fees_type ?></td>
																	<td><?php echo "<i class='fa fa-inr'></i>".number_format($due_fee->amount)."/-"; ?></td>
																	<td><?php echo $months_array[$due_fee->month]; ?></td>
																	<td><?php echo $due_fee->session; ?></td>
																</tr>
															<?php } 
														} ?>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div> <?php
							}
						?>
						<div class='fee-records-container'>
							<div class='panel-group' id='accordion'>
								<div class='panel panel-primary'>
									<h4 class='panel-title'>
										<button type='button' class='btn btn-primary btn-block' id='collapse-button' data-parent='#accordion' data-toggle='collapse' href='#fees-details'><i class='fa fa-inr' aria-hidden='true'></i> View Fees Details</button>
									</h4>
									<div id='fees-details' class='panel-collapse collapse'>
										<div id='panel-body' class='panel-body'>
											<table>
												<tr class='tab-head'>
													<td>Date And Time</td>
													<td>From</td>
													<td>To</td>
													<td>Session</td>
													<td>Amount</td>
												</tr> <?php
												foreach ($sql_fees as $fee) {
													$total_amt = $fee->adm+$fee->ttn+$fee->trans+$fee->ann+$fee->rec; ?>
													<tr class="fees-single-row" id='<?php echo $fee->slip_no; ?>'>
														<td><?php echo date('d/m/y h:i:s', strtotime($fee->date_time)); ?></td>
														<td><?php echo $months_array[$fee->from]; ?></td>
														<td><?php echo $months_array[$fee->to]; ?></td>
														<td><?php echo $fee->session; ?></td>
														<td><i class="fa fa-inr"></i><?php echo number_format($total_amt); ?>/-</td>
													</tr>
												<?php } ?>
											</table>
											<script type="text/javascript">
												$(".fees-single-row").click(function(){
													var slid = $(this).attr('id');
													$.post(ajax_url,{action: "load_detailed_transaction", slid: slid},function(data){ $.alert(data); });
												});
											</script>
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>
						<div class='panel-footer text-right'>							
							<a data-original-title='Remove this user' type='button' data-dismiss='modal' class='btn btn-sm btn-default'>Close</a>
						</div>
					  </div>
					</div>
				</div>
			</section>
			<?php
	}

	else{
		$profile ="No date retrived";
	}
	echo $profile;


	wp_die();
}

// Bharatdan Gadhavi - 14th Feb - Start - Get latest Registration Number from Student Database and update it on StudentAdd Form
add_action( 'wp_ajax_get_latest_registration_no', 'wpsp_get_latest_registration_no' );
function wpsp_get_latest_registration_no(){
	$response = array();
	global $wpdb;
	$student_table 	=	$wpdb->prefix . "wpsp_student";
	$studentData	=	$wpdb->get_row("SELECT max(s_regno) as latestRegNo from $student_table");
	
	
	$latestRegNo = $studentData->latestRegNo;
	if(empty($latestRegNo)  ||  is_null($latestRegNo)){
		$latestRegNo = date('y').'001';
	} else {
		$yearOfReg = substr($latestRegNo,0,2);
		if($yearOfReg==date('y')){
			$latestRegNo = (int)$latestRegNo;
			$latestRegNo++;
		}else{
			$latestRegNo = date('y').'001';
		}
	}
	$response['status']	=	1;
	$response['latest_reg_no']	=	$latestRegNo;
	echo json_encode( $response);
	exit();
}
// Bharatdan Gadhavi - 14th Feb - End

// Bharatdan Gadhavi - 16th Feb - Start - Check if Roll Number exists for the selected class
add_action( 'wp_ajax_checkRollNo', 'wpsp_checkRollNo' );
function wpsp_checkRollNo(){
	$response = array();
	$response['status']	=	0; //Fail status


	$studID  =  $_POST['studID'];
	$rollNo  =  $_POST['rollNo'];
	$stdClass  =  $_POST['stdClass'];
	
	global $wpdb;
	$student_table 	=	$wpdb->prefix . "wpsp_student";
	if(!empty($studID)){
		$studentData	=	$wpdb->get_row("SELECT * FROM $student_table WHERE s_rollno = '$rollNo' AND class_id = '$stdClass' AND wp_usr_id != '$studID'");
	} else{
		$studentData	=	$wpdb->get_row("SELECT * FROM $student_table WHERE s_rollno = '$rollNo' AND class_id = '$stdClass'");
	}
	
	if(!empty($studentData)){
		$response['status']	=	0;
		$response['message']	=	"Roll Number already exist for selected class!";
	}else{
		$response['status']	=	1;
	}
	echo json_encode( $response);
	exit();
}
// Bharatdan Gadhavi - 16th Feb - End

	add_action( 'wp_ajax_fetch_all_stydents_of_a_class', 'wpsp_fetch_all_stydents_of_a_class' );
	function wpsp_fetch_all_stydents_of_a_class(){
		global $wpdb;
		$standard = $_POST['value'];
		$student_table	=	$wpdb->prefix."wpsp_student";
		$students	=	$wpdb->get_results("select s_fname, s_mname, s_lname, p_fname, p_mname, p_lname, wp_usr_id from $student_table where class_id='$standard' order by sid desc");
		echo "<option value=''>Select Student</option>";
		foreach ($students as $std) {
			$student_name = $std->s_fname." ".$std->s_mname." ".$std->s_lname;
			$fathers_name = $std->p_fname." ".$std->p_mname." ".$std->p_lname;
			echo "<option value='".$std->wp_usr_id."'>".$student_name." S/O ".$fathers_name."</option>";
		}
		exit();
	}

	add_action( 'wp_ajax_fetch_all_details_of_a_student_for_fee', 'wpsp_fetch_all_student_details' );
	function wpsp_fetch_all_student_details(){
		global $wpdb;
		$stid = $_POST['studentId'];
		$student_table	=	$wpdb->prefix."wpsp_student";
		$sql_student_detail = $wpdb->get_results("select * from $student_table where sid='$stid' order by sid desc");
		foreach ($sql_student_detail as $student) {
			$student_name = $student->s_fname." ".$student->s_mname." ".$student->s_lname;
			$fathers_name = $student->p_fname." ".$student->p_mname." ".$student->p_lname;
			$mobile = $student->s_phone;
			$reg_no = $student->s_regno; ?>
			<script type="text/javascript">
				var name = '<?php echo $student_name; ?>';
				var fatherName = '<?php echo $fathers_name; ?>';
				var mob = '<?php echo $mobile; ?>';
				var reg = '<?php echo $reg_no; ?>';
				$(".b1 div").text(name);
				$(".b2 div").text(fatherName);
				$(".b3 .sb1 div").text(mob);
				$(".b3 .sb2 div").text(reg);
			</script><?php
		}
		exit();
	}
?>