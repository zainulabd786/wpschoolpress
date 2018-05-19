<?php if (!defined('ABSPATH')) exit('No Such File'); ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-blue" style="position: relative; left: 0px; top: 0px;">
                <div class="box-header" style="cursor: move;">
                    <i class="fa fa-graph"></i>
                    <h3 class="box-title"><i class="fa fa-child" aria-hidden="true"></i> Student Registration </h3>
               
                    <!-- tools box -->
                  
                    <!-- /. tools -->
                </div>
                  <div class="col-md-12 gap-top-bottom">
                    <div id="formresponse"></div>
                </div>

                <div class="form-group visitor-search-container">
                    <input type="search" class="form-control search-visitor-inp" placeholder="Search Record From Enquiries And Visitors">
                    <div class="visitor-suggestions">
                        <table>
                            
                        </table>
                    </div>
                </div>
               
                 
                <!-- /.box-header -->
                <form name="StudentEntryForm" id="StudentEntryForm" method="post" enctype="multipart/form-data" novalidate="novalidate"> 
                    <input type="hidden" class="vid" name="vid" value="0">
                    <div class="box-body text-black">
                        <div class="col-md-6">
                            <h3 class="box-title"> <i class="fa fa-info" aria-hidden="true"></i>&nbsp;Personal Details</h3>
                            <div class="line_box">
                                <div class="row">
                                    <?php wp_nonce_field('StudentRegister', 'sregister_nonce', '', true) ?>
                                    <div class="col-md-4 col-xs-12 form-group">
                                        <label for="firstname">First Name</label><span class="red">*</span>
                                        <input type="text" class="form-control" id="firstname" name="s_fname" placeholder="First Name">
                                    </div>
                                    <div class="col-md-4 col-xs-12 form-group">
                                        <label for="middlename">Middle Name</label>
                                        <input type="text" class="form-control" id="middlename" name="s_mname" placeholder="Middle Name">
                                    </div>
                                    <div class="col-md-4 col-xs-12 form-group">
                                        <label for="lastname">Last Name</label><span class="red">*</span>
                                        <input type="text" class="form-control" id="lastname" name="s_lname" placeholder="Last Name">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label for="dateofbirth">Date of Birth (mm/dd/yy)</label><span class="red">*</span>
                                        <input type="text" class="form-control select_date" id="Dob" name="s_dob" placeholder="Date of Birth"  required>
										<!--age calculator start !-->
										<div class="resp"></div>
										<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
										<script>
									
											$(".select_date").mouseleave(function(){
												var birthYear = $(".select_date").val().split("/");
												var now = new Date();
												var currentYear = (now.getFullYear());
												$(".resp").html(currentYear - birthYear[birthYear.length-1]+" Years");
											});
										
										</script>
										<!--age calculator end!!-->
									</div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group wpsp-gender-field">
                                        <label for="Class">Gender</label> <br>
                                        <div class="radio">
                                            <input type="radio" name="s_gender" value="Male" checked="checked">
                                            <label for="Male">Male</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" name="s_gender" value="Female">
                                            <label for="Female">Female</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" name="s_gender" value="other">
                                            <label for="other">Other</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Email">Email Address</label>
                                    <input type="email" class="form-control chk-email" id="Email" name="Email" placeholder="Student Email">  
									<!-- <br><label class="error user-email-error">Both Email Address Should Not Be same </label>-->
                                </div>
                                <div class="form-group">
                                    <label for="Address">Current Address</label><span class="red">*</span>
                                    <input type="text" class="form-control" rows="4" id="current_address" name="s_address">                                      
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <input type="text" class="form-control" id="current_city" name="s_city" placeholder="City Name">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <?php $countrylist = wpsp_county_list(); ?>
                                        <select class="form-control" id="current_country" name="s_country" >
                                            <option value="">Select Country</option>
                                            <?php foreach ($countrylist as $key => $value) { ?>
                                                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <input type="text" class="form-control" id="current_pincode" name="s_zipcode" placeholder="Pin Code">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="sameas" value="1"> <label for="sameas"> Same as Above </label>
                                </div>
                                <div class="form-group">
                                    <label for="Address">Permanent Address</label>
                                    <input type="text" class="form-control" rows="5" id="permanent_address" name="s_paddress" > 
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <input type="text " class="form-control" id="permanent_city" name="s_pcity" placeholder="City Name">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <select class="form-control" id="permanent_country"  name="s_pcountry">
                                            <option value="">Select Country</option>
                                            <?php foreach ($countrylist as $key => $value) { ?>
                                                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <input type="text" class="form-control" id="permanent_pincode" name="s_pzipcode" placeholder="Pin Code">
                                    </div>
                                </div>
                                
                                    
                                    <div class="form-group">
                                        <label for="bloodgroup">Blood Group (Optional)</label>
                                        <select class="form-control" id="Bloodgroup" name="s_bloodgrp">
                                            <option value="">Select Blood Group</option>
                                            <option value="O+">O +</option>
                                            <option value="O-">O -</option>
                                            <option value="A+">A +</option>
                                            <option value="A-">A -</option>
                                            <option value="B+">B +</option>
                                            <option value="B-">B -</option>
                                            <option value="AB+">AB +</option>
                                            <option value="AB-">AB -</option>
                                        </select>
                                    </div>
                                
                                <div class="form-group">
                                    <label for="Username">Username</label>
                                    <input type="text" class="form-control chk-username" id="Username" name="Username" placeholder="Student Username"><br>
									<!-- <label class="error user-same-error">Both UserName Should Not Be same </label> -->
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-xs-12">
                                        <label for="Password">Password</label>
                                        <input type="password" class="form-control" id="Password" name="Password" placeholder="Password">
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12">
                                        <label for="ConfirmPassword">Confirm Password</label>
                                        <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" placeholder="Confirm Password">
                                    </div>
                                </div>

                                <div class="form-group opt-transport">
                                    <label for="transport">Transport</label><br/>
                                    <div class="form-inline">
                                        <input type="checkbox" name="opt_transport" id="transport" data-toggle="toggle" data-on="Required" data-off="Not Required">
                                        <select name="transport_route" class="form-control transport-route" disabled>
                                            <option value="">Select Route</option>
                                        </select>
                                    </div>	
                                </div>
							<!-- Add/Edit Route link should come here -->
                               <div class="form-group">
                                     <label for="displaypicture">
                                      Profile Image
                                  </label> </br>
                                    <label class="customUpload btnUpload  btn btn-success"  style="color: #ffffff;  margin-right: 10px;">
                                        <span class="logo-label"><i class="fa fa-upload" aria-hidden="true"></i>  Choose File </span>
                                        <input name="displaypicture" class="upload" type="file" id="displaypicture">
                                      </label>
                                     <p id="test" style="color:red" class="validation-error-displaypicture"></p>
                                    <p class="help-block">* Only JPEG and JPG supported </p>
                                    <p class="help-block">* Max 3 MB Upload </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3 class="box-title"><i class="fa fa-building" aria-hidden="true"></i>&nbsp;School Details</h3>
                            <div class="line_box">
                                <div class="form-group">
                                    <label for="dateofbirth">Joining Date (mm/dd/yy)</label>
                                    <input type="text" class="form-control select_date" id="Doj" name="s_doj" value="<?php echo date('m/d/Y'); ?>" placeholder="Date of Join">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-xs-12">
                                        <label for="Class">Class</label><span class="red">*</span><?php // Bharatdan Gadhavi - 16th Feb 2018 ?>
                                        <?php
                                        $class_table = $wpdb->prefix . "wpsp_class";
                                        $classes = $wpdb->get_results("select cid,c_name from $class_table");
                                        ?>
                                        <select class="required form-control" name="Class" id="stdClass"> <?php // Bharatdan Gadhavi - 16th Feb 2018  ?>
                                            <option value="">Select Class</option>
                                            <?php
                                            foreach ($classes as $class) {
                                                ?>
                                                <option value="<?php echo $class->cid; ?>"><?php echo $class->c_name; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12">
                                        <label for="Rollno">Roll Number</label><span class="red">*</span><?php // Bharatdan Gadhavi - 16th Feb 2018  ?>
                                        <input type="text" class=" required form-control" id="Rollno" onblur="checkRollNo();" name="s_rollno" placeholder="Roll Number">
                                    </div>
                                </div>
								<?php // Bharatdan Gadhavi - 13th Feb 2018 - Start ?>
								<div class="form-group">
									<input type="hidden" name="studentFormName" id="studentFormName" value="addForm" />
									<label for="RegistrationNo">Registration Number</label>
									<input type="text" class="form-control" id="RegistrationNo" name="s_regno" placeholder="Registration Number" readonly>
								</div>
								<?php // Bharatdan Gadhavi - 13th Feb 2018 - End ?>
                            </div>
                        </div>
                        <div class="col-md-6" id="parent-field-lists">
                            <h3 class="box-title"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Parent Detail</h3>
                            <div class="line_box">
								<div class="form-group">
                                    <label for="pEmail">Email Address</label><span class="red">*</span>
                                    <input class="form-control chk-email" id="pEmail" name="pEmail" placeholder="Parent Email" type="email">
									<!-- <br><label class="error user-email-error">Both Email Address Should Not Be same </label> -->
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-xs-12 form-group">
                                        <label for="p_firstname">First Name</label><span class="red">*</span>
                                        <input type="text" class="form-control" id="p_firstname" name="p_fname" placeholder="Parent First Name">
                                    </div>
                                    <div class="col-md-4 col-xs-12 form-group">
                                        <label for="p_middlename">Middle Name</label>
                                        <input type="text" class="form-control" id="p_middlename" name="p_mname" placeholder="Parent Middle Name">
                                    </div>
                                    <div class="col-md-4 col-xs-12 form-group">
                                        <label for="p_lastname">Last Name</label><span class="red">*</span>
                                        <input type="text" class="form-control" id="p_lastname" name="p_lname" placeholder="Parent Last Name">
                                    </div>
                                </div>								
                                <div class="form-group wpsp-gender-field">
                                    <label for="Class">Gender</label> <br>
                                    <div class="radio-inline">
                                        <input type="radio" name="p_gender" value="Male">
                                        <label for="Male">Male</label>
                                    </div>
                                    <div class="radio-inline">
                                        <input type="radio" name="p_gender" value="Female">
                                        <label for="Female">Female</label>
                                    </div>
                                    <div class="radio-inline">
                                        <input type="radio" name="p_gender" value="other">
                                        <label for="other">Other</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-xs-12">
                                        <label for="p_edu">Education</label>
                                        <input type="text" class="form-control" name="p_edu"  placeholder="Parent Education" id="p_edu">
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12">
                                        <label for="p_profession">Profession</label>
                                        <input type="text" class="form-control" name="p_profession"  placeholder="Parent Profession" id="p_profession">
                                    </div>
                                </div>
                                
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="s_phone" placeholder="Phone Number" required>
                                    </div>
                                
                                <div class="form-group">
                                    <label for="p_username">Username</label><span class="red">*</span>
                                    <input type="text" class="form-control chk-username" id="p_username" name="pUsername" placeholder="Parent Username"><br>
									<!-- <label class="error user-same-error">Both UserName Should Not Be same </label> -->
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-xs-12">
                                        <label for="p_password">Password</label><span class="red">*</span>
                                        <input type="password" class="form-control" id="p_password" name="pPassword" placeholder="Parent Password">
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12">
                                        <label for="p_confirmpassword">Confirm Password</label><span class="red">*</span>
                                        <input type="password" class="form-control" id="p_confirmpassword" name="pConfirmPassword" placeholder="Confirm Parent Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="p_bloodgroup">Blood Group (Optional)</label>
                                    <select class="form-control" id="p_bloodgroup" name="p_bloodgrp">
                                        <option value="">Select Blood Group</option>
                                        <option value="O+">O +</option>
                                        <option value="O-">O -</option>
                                        <option value="A+">A +</option>
                                        <option value="A-">A -</option>
                                        <option value="B+">B +</option>
                                        <option value="B-">B -</option>
                                        <option value="AB+">AB +</option>
                                        <option value="AB-">AB -</option>
                                    </select>
                                </div>

                                 <div class="form-group">
                                     <label for="p_displaypicture">
                                      Profile Image
                                    </label> </br>
                                    <label class="customUpload btnUpload  btn btn-success"  style="color: #ffffff;  margin-right: 10px;">
                                        <span class="logo-label"><i class="fa fa-upload" aria-hidden="true"></i>  Choose File </span>
                                        <input name="p_displaypicture" class="upload" type="file" id="p_displaypicture">
                                      </label>
                                    <p id="test" style="color:red" class="validation-error-p_displaypicture"></p>
                                    <p class="help-block">* Only JPEG and JPG supported </p>
                                    <p class="help-block">* Max 3 MB Upload </p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="box-footer text-right">
                        <button type="submit" class="btn btn-primary " id="studentform">Submit</button>
                        <a href="sch-student" class="btn btn-info" >Back</a> 
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="AddModalClass" tabindex="-1" role="dialog" aria-labelledby="AddModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">New Class Entry</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div><!-- /.box-header -->
                    <form name="ClassAddForm" id="ClassAddForm" method="post">
                        <?php include( WPSP_PLUGIN_PATH . '/includes/wpsp-classForm.php'); ?>
                    </form>
                </div>
            </div>					
        </div>
    </div>
</div>