<?php  if (!defined('ABSPATH')) exit('No Such File'); ?>
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-blue" style="position: relative; left: 0px; top: 0px;">
                <div class="box-header" style="cursor: move;">
                    <i class="fa fa-graph"></i>
                    <h3 class="box-title"><i class="fa fa-plus" aria-hidden="true"></i> Add Visitor </h3>
               
                    <!-- tools box -->
                  
                    <!-- /. tools -->
                </div>
                
                <!-- /.box-header -->
                
                <form name="visitorsForm" id="visitorsForm" method="post" novalidate="novalidate" class="visitorsForm"> 
                    <div class="box-body text-black">

                    	<div class="form-group">
                    		<input type="date" class="form-control date" placeholder="Date of visit">
                    	</div>

                    	<div class="form-group"> <?php
                    		$settings_table = $wpdb->prefix."wpsp_settings";
                    		$result = $wpdb->get_results(" SELECT option_value FROM $settings_table WHERE option_name='session' "); ?>
                    		<input type="text" class="form-control session" value="<?php echo $result[0]->option_value; ?>" placeholder="Session">
                    	</div>
                     
                    	<div class="form-group purpose">
                    		<select class="form-control">
                    			<option value="">Select Purpose of visit</option>
                    			<option value="ADM">Admission</option>
                    			<option value="KAS">Know about school</option>
                    			<option value="OTH">Other</option>
                    		</select>
                    		<textarea class="form-control v-details" placeholder="Visit Details"></textarea>
                    	</div>

                    	<div class="form-group approach">
                    		<select class="form-control">
                    			<option value="">How did you hear about us?</option>
                    			<option value="SWT">School Website</option>
                    			<option value="GSR">Google Search</option>
                    			<option value="BOA">Brochure or Advertising</option>
                    			<option value="NFR">Neighbor or Friend Referral</option>
                    		</select>
                    	</div>

                    	<h4>Parents Details</h4>

                    	<div class="form-group">
                    		<input type="text" class="form-control p-name" placeholder="Parent Name">
                    	</div>
						
						<div class="form-group">
                    		<input type="text" class="form-control phone" placeholder="Phone">
                    	</div> 

                    	<div class="form-group">
                    		<input type="email" class="form-control email" placeholder="Email">
                    	</div>    

                    	<div class="form-group">
                    		<textarea class="form-control address" placeholder="Address"></textarea>
                    		<input type="text" class="form-control city" placeholder="City">
                    		<input type="text" class="form-control state" placeholder="State">
                    		<input type="text" class="form-control zip" placeholder="ZIP code">
                    	</div>    

                    	<h4>Child Details</h4>  

                    	<div class="form-group">
                    		<input type="text" class="form-control c-name" placeholder="Child Name">
                    	</div>

                    	<div class="form-group">
                    		<input type="date" class="form-control dob" placeholder="D.O.B">
                    	</div>  

                    	<div class="form-group class">
                    		<select class="form-control">
                    			<option value="">Select Class</option> <?php
                    			$class_table = $wpdb->prefix."wpsp_class";
                    			$results = $wpdb->get_results("SELECT cid, c_name FROM $class_table");
                    			foreach ($results as $class) { ?>
                    				<option value="<?php echo $class->cid; ?>"><?php echo $class->c_name; ?></option> <?php
                    			} ?>
                    		</select>
                    	</div>  

                    	<div class="form-group gender">
                    		<label class="radio-inline"><input type="radio" name="gender" value="M">Male</label>
							<label class="radio-inline"><input type="radio" name="gender" value="F">Female</label>
                    	</div>     	

						<button type="button" class="btn btn-primary submit-btn">Submit</button>
								

                    </div>
                </form>
                
            </div>
        </div>

        <div class="col-md-9 visitor-list-container">
            <div class="box box-blue" style="position: relative; left: 0px; top: 0px;">
                <div class="box-header" style="cursor: move;">
                    <i class="fa fa-graph"></i>
                    <h3 class="box-title"><i class="fa fa-list" aria-hidden="true"></i> Vsistors List </h3>
               
                    <!-- tools box -->
                  
                    <!-- /. tools -->
                </div>
                 
                <!-- /.box-header -->
                
                <table id="visitors_table" class="table table-bordered table-striped table-responsive" style="margin-top:10px">
					<thead>
						<tr>
							<th>Date</th>
							<th>Name</th>
							<th>Child</th>
							<th>Phone</th>
							<th>Address</th>
							<th>Purpose</th>
							<th>Followup</th>
							<th>Converted</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody> <?php
						$visitors_table = $wpdb->prefix."wpsp_visitors";
						//$followup_table = $wpdb->prefix."wpsp_follow_up";
						$results = $wpdb->get_results("SELECT id, date, p_name, c_name, phone, address, city, state, v_purpose, follow_up, converted FROM $visitors_table");
						foreach ($results as $visitor) { 
							$purpose = $visitor->v_purpose;
							if($purpose == "ADM") $purpose = "Admission";
							if($purpose == "KAS") $purpose = "Know About School";
							if($purpose == "OTH") $purpose = "Other"; ?>
							<tr>
								<td><?php echo date("d/m/Y", strtotime($visitor->date)); ?></td>
								<td><?php echo $visitor->p_name; ?></td>
								<td><?php echo $visitor->c_name; ?></td>
								<td><?php echo $visitor->phone; ?></td>
								<td><?php echo $visitor->address.", ".$visitor->city.", ".$visitor->state; ?></td>
								<td><?php echo $purpose; ?></td>
								<td><a id="<?php echo $visitor->id; ?>" class="follow-up-history" href="#"><?php echo $visitor->follow_up; ?></a></td>
								<td><?php echo ($visitor->converted == 0) ? "No" : "Yes"; ?></td>
								<td><button type="button" id="<?php echo $visitor->id; ?>" class="btn btn-primary follow-up-btn">Follow Up</button></td>
							</tr> <?php
						} ?>
					</tbody>
					<tfoot>
						<tr>
							<th>Date</th>
							<th>Name</th>
							<th>Child</th>
							<th>Phone</th>
							<th>Address</th>
							<th>Purpose</th>
							<th>Followup</th>
							<th>Converted</th>
							<th>Action</th>
						</tr>
					</tfoot>
				</table>
                
            </div>
        </div>
    </div>
</section>
<div class="ajax-script-exec"></div>
