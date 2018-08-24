<?php if (!defined( 'ABSPATH' ) ) exit('No Such File');
$student_table	=	$wpdb->prefix."wpsp_student";
$class_table	=	$wpdb->prefix."wpsp_class";
$users_table	=	$wpdb->prefix."users";
$transport_table=	$wpdb->prefix."wpsp_transport";
$sid			=	$_GET['id'];
$edit			=	true;
$msg			=	'';
if( isset($_GET['edit']) && $_GET['edit']=='true' && ($current_user_role=='administrator' || $current_user_role=='editor'  || $current_user_role=='teacher' ) && (isset( $_POST['sedit_nonce'] ) && wp_verify_nonce( $_POST['sedit_nonce'], 'StudentEdit' ) ) )  {
	ob_start();
	wpsp_UpdateStudent();
	$msg = ob_get_clean();
}
$stinfo	 =	$wpdb->get_row("select * from $student_table where wp_usr_id='$sid'");
if( !empty( $stinfo ) ) {
	$loc_avatar=get_user_meta($sid,'simple_local_avatar',true);
	$img_url= $loc_avatar ? $loc_avatar['full'] : WPSP_PLUGIN_URL.'img/default_avtar.jpg';
	$parentid	=	$stinfo->parent_wp_usr_id;
	if( !empty( $parentid ) ) {
		$parentInfo	=	get_user_by( 'id', $parentid );
		$parentEmail =	isset( $parentInfo->data->user_email ) ? $parentInfo->data->user_email : '';
	}
?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-solid bg-blue-gradient" style="position: relative; left: 0px; top: 0px;">
				<div class="box-header ui-sortable-handle" style="cursor: move;">
                    <i class="fa fa-graph"></i>
					<h3 class="box-title"><i class="fa fa-child" aria-hidden="true"></i> <?php echo $stinfo->s_fname.' '.$stinfo->s_mname.' '.$stinfo->s_lname; ?></h3>
				</div>
                <div class="col-md-12 gap-top-bottom">
					<div id="formresponse">
						<?php  echo $msg; ?>
					</div>
                </div>
				<form name="StudentEditForm" id="StudentEditForm" method="POST" enctype="multipart/form-data" > 
					<div class="box-footer text-black">
						<div class="col-md-6">
							<h3 class="box-title"> <i class="fa fa-info" aria-hidden="true"></i>&nbsp;Personal Details</h3>
                            <div class="line_box">            
								<div class="row">
	                                
                                            <div class="col-md-12 text-center">
												<img src="<?php echo $img_url;?>" height="150px" width="150px" class="img img-circle"/>
												
											</div>

											 <div class="col-md-12">

											<label class="customUpload btnUpload btnM btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> Upload Photo
													<input type="file" name="displaypicture" class="upload" id="displaypicture" >
													
												</label>
												<p id="test" style="color:red" class="validation-error-displaypicture"></p>
												</div>
									
	                                <?php wp_nonce_field( 'StudentRegister', 'sregister_nonce', '', true ) ?>
									<input type="hidden" id="studID" name="wp_usr_id" value="<?php echo $sid;?>">

                                    <div class="col-md-4 col-xs-12 form-group">
                                        <label for="firstname">First Name</label><span class="red">*</span>
                                        <input type="text" class="form-control" id="firstname" value="<?php echo !empty( $stinfo->s_fname ) ? $stinfo->s_fname : $stinfo->s_fname; ?>" name="s_fname" placeholder="First Name" required="required">
                                        <?php wp_nonce_field( 'StudentEdit', 'sedit_nonce', '', true ) ?>
										<input type="hidden" id="studID" name="wp_usr_id" value="<?php echo $sid;?>">
                                    </div>

                                    <div class="col-md-4 col-xs-12 form-group">
                                        <label for="middlename">Middle Name</label>
                                        <input type="text" class="form-control" value="<?php echo !empty( $stinfo->s_mname ) ? $stinfo->s_mname : $stinfo->s_mname; ?>" id="middlename" name="s_mname" placeholder="Middle Name">
                                    </div>
									
                                    <div class="col-md-4 col-xs-12 form-group">
                                        <label for="lastname">Last Name</label><span class="red">*</span>
                                        <input type="text" class="form-control" id="lastname" value="<?php echo !empty( $stinfo->s_lname ) ? $stinfo->s_lname : $stinfo->s_lname; ?>" name="s_lname" placeholder="Last Name" required="required">
                                    </div>                                                    
                                </div>
                                              
                                <div class="row form-group">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="dateofbirth">Date of Birth (mm/dd/yy)</label>
										<input type="text" class="form-control select_date" value="<?php echo !empty( $stinfo->s_dob ) ? wpsp_ViewDate($stinfo->s_dob) : ''; ?>" id="Dob" name="s_dob" placeholder="Date of Birth">
                                    </div>
									
                                    <div class="col-md-6 col-sm-12 form-group wpsp-gender-field">
                                        <label for="Class">Gender</label> <br>
										<div class="radio-inline">
												<input type="radio" name="s_gender" <?php if(strtolower($stinfo->s_gender)=='male') echo "checked"?> value="Male" checked="checked">
                                                <label for="Male">Male</label>
										</div>
										<div class="radio-inline">
                                            <input type="radio" name="s_gender" <?php if(strtolower($stinfo->s_gender)=='female') echo "checked"; ?> value="Female">
                                            <label for="Female">Female</label>
                                        </div>
										<div class="radio-inline">
                                            <input type="radio" name="s_gender" <?php if(strtolower($stinfo->s_gender)=='other') echo "checked"; ?> value="other">
                                            <label for="other">Other</label>
                                        </div>
									</div>
                                </div>                                                 
                                <div class="form-group">
									<label for="Address">Current Address</label>
									<input type="text" class="form-control" rows="4" id="current_address" value="<?php echo $stinfo->s_address; ?>" name="s_address">
								</div>                 
                                <div class="row form-group">
									<div class="col-md-4 form-group">
										<input type="text" class="form-control" id="current_city" value="<?php echo $stinfo->s_city; ?>" name="s_city" placeholder="City Name">
									</div>
									<div class="col-md-4 form-group">
										<?php $countrylist = wpsp_county_list(); ?>
										<select class="form-control" id="current_country" name="s_country">
											<option value="">Select Country</option>
											<?php foreach ($countrylist as $key => $value) { ?>
												<option value="<?php echo $value; ?>" <?php echo selected($stinfo->s_country, $value); ?>><?php echo $value; ?></option>
												<?php
											}
											?>
										</select>
									</div>
									<div class="col-md-4 form-group">
										<input type="text" class="form-control" id="current_pincode" value="<?php echo $stinfo->s_zipcode; ?>" name="s_zipcode" placeholder="Pin Code">
									</div>
								</div>
								
								<div class="form-group">
                                    <input type="checkbox" id="sameas" value="1" onclick="sameAsAbove()"> <label for="same"> Same as Above </label>
                                </div>

								<div class="form-group">
                                    <label for="Address">Permanent Address</label>                                                    
                                    <input type="text" class="form-control" rows="5" id="permanent_address" value="<?php echo $stinfo->s_paddress;?>" name="s_paddress" > 
								</div>
								
								<div class="row">
									<div class="col-md-4 form-group">
										<input type="text" class="form-control" id="permanent_city" value="<?php echo $stinfo ->s_pcity; ?>" name="s_pcity" placeholder="City Name">
									</div>
									<div class="col-md-4 form-group">                                                   
										<?php $countrylist = wpsp_county_list(); ?>
										<select class="form-control" id="permanent_country" name="s_pcountry">
											<option value="">Select Country</option>
											<?php foreach ($countrylist as $key => $value) { ?>
												<option value="<?php echo $value; ?>" <?php echo selected($stinfo->s_pcountry, $value); ?>><?php echo $value; ?></option>
												<?php
											}
											?>
										</select>
									</div>
									<div class="col-md-4 form-group">
										<input type="text" class="form-control" id="permanent_pincode" value="<?php echo $stinfo->s_pzipcode;?>" name="s_pzipcode" placeholder="Pin Code">
									</div>
								</div>
								
								<div class="form-group">
										<label for="bloodgroup">Blood Group (Optional)</label>
										<select class="form-control" id="Bloodgroup" name="s_bloodgrp">
											<option value="">Select Blood Group</option>
											<option <?php if ($stinfo->s_bloodgrp == 'O+') echo "selected"; ?> value="O+">O +</option>
											<option <?php if ($stinfo->s_bloodgrp == 'O-') echo "selected"; ?> value="O-">O -</option>
											<option <?php if ($stinfo->s_bloodgrp == 'A+') echo "selected"; ?> value="A+">A +</option>
											<option <?php if ($stinfo->s_bloodgrp == 'A-') echo "selected"; ?> value="A-">A -</option>
											<option <?php if ($stinfo->s_bloodgrp == 'B+') echo "selected"; ?> value="B+">B +</option>
											<option <?php if ($stinfo->s_bloodgrp == 'B-') echo "selected"; ?> value="B-">B -</option>
											<option <?php if ($stinfo->s_bloodgrp == 'AB+') echo "selected"; ?> value="AB+">AB +</option>
											<option <?php if ($stinfo->s_bloodgrp == 'AB-') echo "selected"; ?> value="AB-">AB -</option>
										</select>
									
								</div>
								<div class="form-group opt-transport">
                                    <label for="transport">Transport</label><br/>
                                    <div class="form-inline">
                                        <input type="checkbox" name="opt_transport" id="transport" data-toggle="toggle" data-on="Required" data-off="Not Required"<?php if(!empty($stinfo->transport)) echo "checked"; ?>>
                                        <select name="transport_route" class="form-control transport-route" <?php if(empty($stinfo->transport)) echo "disabled" ?>>
                                            <?php 
                                            	$get_routes_sql = $wpdb->get_results("SELECT id, bus_route FROM $transport_table");
                                            	foreach ($get_routes_sql as $route) { ?>
                                            		<option <?php if($stinfo->route_id == $route->id) echo "selected"; ?> value="<?php echo $route->id; ?>"><?php echo $route->bus_route; ?></option> <?php
                                            	}
                                             ?>
                                        </select>
                                    </div>
                                </div>
							</div>
						</div>
                        
						<div class="col-md-6">
							<h3 class="box-title"><i class="fa fa-building" aria-hidden="true"></i>&nbsp;School Details</h3>
							<div class="line_box">
								<div class="form-group">
									<label for="dateofbirth">Joining Date (mm/dd/yy)</label>
									<input type="text" class="form-control select_date" id="Doj" value="<?php echo !empty( $stinfo->s_doj ) ? wpsp_ViewDate($stinfo->s_doj) : '' ; ?>" name="s_doj"  placeholder="Date of Join">
								</div>
								<div class="row">
									<div class="form-group col-md-6 col-xs-12">
										<label for="Class">Class</label> <span class="red">*</span>
										<?php
										$class_table = $wpdb->prefix . "wpsp_class";
										$classes = $wpdb->get_results("select cid,c_name from $class_table");
										?>
										<select class="required form-control" name="Class" id="stdClass">
											<option value="">Select Class</option>
											<?php
											foreach ($classes as $class) {
												?>
												<option  value="<?php echo $class->cid; ?>" <?php if ($stinfo->class_id == $class->cid) echo 'selected'; ?>><?php echo $class->c_name; ?></option>
												<?php
											}
											?>
										</select>
									<input type="hidden" name="prev_select_class" value="<?php echo $stinfo->class_id;?>">	
									</div>
									<div class="form-group col-md-6 col-xs-12">
										<label for="Rollno">Roll Number</label><span class="red">*</span>
										<input type="text" class="required form-control" id="Rollno" onblur="checkRollNo();" value="<?php echo $stinfo->s_rollno; ?>" name="s_rollno" placeholder="Roll Number">										
									</div>
								</div>
								
								<div class="form-group">
									<input type="hidden" name="studentFormName" id="studentFormName" value="editForm" />
									<label for="RegistrationNo">Registration Number</label>
									<input type="text" class="form-control" id="RegistrationNo" value="<?php echo $stinfo->s_regno; ?>" name="s_regno" placeholder="Registration Number" readonly />
								</div>
						
							</div>
						</div>
						
						<div class="col-md-6" id="parent-field-lists">
							<h3 class="box-title"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Parent Detail</h3>
							<div class="line_box">
								<div class="form-group">
                                    <label for="pEmail">Email Address</label><span class="red">*</span>
                                    <input class="form-control chk-email" id="pEmail" name="pEmail" placeholder="Parent Email" type="email" value="<?php if(!empty($parentEmail)) echo $parentEmail; ?>">
									<!-- <br><label class="error user-email-error">Both Email Address Should Not Be same </label> -->
                                </div>
								<div class="row">
									<div class="col-md-4 col-xs-12 form-group">
										<label for="firstname">First Name</label><span class="red">*</span>
										<input type="text" class="form-control" id="firstname" value="<?php echo!empty($stinfo->p_fname) ? $stinfo->p_fname : ''; ?>" name="p_fname" placeholder="Parent First Name" required="required">
									</div>
									<div class="col-md-4 col-xs-12 form-group">
										<label for="middlename">Middle Name</label>
										<input type="text" class="form-control" id="middlename"  value="<?php echo!empty($stinfo->p_mname) ? $stinfo->p_mname : ''; ?>" name="p_mname" placeholder="Parent Middle Name">
									</div>
									<div class="col-md-4 col-xs-12 form-group">
										<label for="lastname">Last Name</label><span class="red">*</span>
										<input type="text" class="form-control" id="lastname" value="<?php echo!empty($stinfo->p_lname) ? $stinfo->p_lname : ''; ?>" name="p_lname" placeholder="Parent Last Name" required="required">
									</div>
								</div>

								<div class="form-group wpsp-gender-field">
                                        <label for="Class">Gender</label> <br>                                        
                                        <div class="radio-inline">
                                            <input type="radio" name="p_gender" <?php if (strtolower($stinfo->p_gender) == 'male') echo "checked" ?> value="Male" checked="checked">
                                            <label for="Male">Male</label>
                                        </div>
                                        <div class="radio-inline">
                                            <input type="radio" name="p_gender" <?php if (strtolower($stinfo->p_gender) == 'female') echo "checked"; ?> value="Female">
                                            <label for="Female">Female</label>
                                        </div>
                                        <div class="radio-inline">
                                            <input type="radio" name="p_gender" <?php if (strtolower($stinfo->p_gender) == 'other') echo "checked"; ?> value="other">
                                            <label for="other">Other</label>
                                        </div>
                                        <?php
                                        ?> 
								</div>   

                                <div class="row">
                                        <div class="form-group col-md-6 col-xs-12">
                                            <label for="dateofbirth">Education</label>
                                            <input type="text" class="form-control" value="<?php echo $stinfo->p_edu; ?>" name="p_edu"  placeholder="Parent Education">
                                        </div>
                                        <div class="form-group col-md-6 col-xs-12">
                                            <label for="dateofbirth">Profession</label>
                                            <input type="text" class="form-control" name="p_profession" value="<?php echo $stinfo->p_profession; ?>"  placeholder="Parent Profession"> 
                                        </div>
                                </div>
								<div class="form-group">
									<label for="phone">Phone</label>
									<input type="text" class="form-control" id="phone" value="<?php echo $stinfo->s_phone; ?>" name="s_phone" placeholder="Phone Number" required>
								<div class="form-group">
                                        <label for="bloodgroup">Blood Group (Optional)</label>
                                        <select class="form-control" id="Bloodgroup" name="p_bloodgrp">
                                            <option value="">Select Blood Group</option>
                                            <option <?php if ($stinfo->p_bloodgrp == 'O+') echo "selected"; ?> value="O+">O +</option>
                                            <option <?php if ($stinfo->p_bloodgrp == 'O-') echo "selected"; ?> value="O-">O -</option>
                                            <option <?php if ($stinfo->p_bloodgrp == 'A+') echo "selected"; ?> value="A+">A +</option>
                                            <option <?php if ($stinfo->p_bloodgrp == 'A-') echo "selected"; ?> value="A-">A -</option>
                                            <option <?php if ($stinfo->p_bloodgrp == 'B+') echo "selected"; ?> value="B+">B +</option>
                                            <option <?php if ($stinfo->p_bloodgrp == 'B-') echo "selected"; ?> value="B-">B -</option>
                                            <option <?php if ($stinfo->p_bloodgrp == 'AB+') echo "selected"; ?> value="AB+">AB +</option>
                                            <option <?php if ($stinfo->p_bloodgrp == 'AB-') echo "selected"; ?> value="AB-">AB -</option>
                                        </select>
                                </div>
                            </div>
						</div>
						<h3 class="box-title"><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;Fees Details</h3>
						<div class="line_box">
                            <?php 
                               	$student_fees_table = $wpdb->prefix."wpsp_single_student_fees";
                                $student_fees_res = $wpdb->get_results("SELECT * FROM $student_fees_table WHERE uid = '$stinfo->wp_usr_id'");      
                                if($wpdb->num_rows > 0){ ?>
                                	<input type="checkbox" name="se_fees_set" id="se_fees_set" data-toggle="toggle" data-on="Set" data-off="Don't Set" checked>
                                	<div class="se_fees_inp_cont">
			                            <div class="form-group">
			                                <label>Admission Fees</label>
			                               	<input type="text" name="se_adm_fees" class="form-control" value="<?php echo $student_fees_res[0]->admission_fees; ?>">
			                            </div>
			                            <div class="form-group">
			                                <label>Tuition Fees</label>
			                                <input type="text" name="se_ttn_fees" class="form-control" value="<?php echo $student_fees_res[0]->tution_fees; ?>">
			                            </div>
			                            <div class="form-group">
			                                <label>Annual Charges</label>
			                                <input type="text" name="se_ann_chg" class="form-control" value="<?php echo $student_fees_res[0]->annual_chg; ?>">
			                            </div>
			                            <div class="form-group">
			                            	<label>Recreation Charges</label>
			                            	<input type="text" name="se_rec_chg" class="form-control" value="<?php echo $student_fees_res[0]->recreation_chg; ?>">
			                            </div>
			                        </div><?php
                                }  else{ ?>
                                	<input type="checkbox" name="se_fees_set" id="se_fees_set" data-toggle="toggle" data-on="Set" data-off="Don't Set">
                                	<div style="display: none;" class="se_fees_inp_cont">
			                            <div class="form-group">
			                                <label>Admission Fees</label>
			                               	<input type="text" name="se_adm_fees" class="form-control">
			                            </div>
			                            <div class="form-group">
			                                <label>Tuition Fees</label>
			                                <input type="text" name="se_ttn_fees" class="form-control">
			                            </div>
			                            <div class="form-group">
			                                <label>Annual Charges</label>
			                                <input type="text" name="se_ann_chg" class="form-control">
			                            </div>
			                            <div class="form-group">
			                            	<label>Recreation Charges</label>
			                            	<input type="text" name="se_rec_chg" class="form-control">
			                            </div>
			                        </div><?php
                               	}
                            ?>
                                    
						</div>
					</div>
					
					
					<div class="box-footer text-right">
						<button type='submit' class='btn btn-primary'>Update</button>
						<a href="<?php echo isset( $_GET['view'] ) && $_GET['view'] ==1  ? 'sch-parent' : 'sch-student';?>" class="btn btn-info" >Back</a>
		            </div>                                 
                </form>
                 
			</div>
		</div>
	</div>
</section>	
<?php } else {
	echo "Sorry! No data retrieved";
}
	?>
    