<h2>Fees Settings</h2>
<form class="feesSettings">
	<div class="form-group fs-class">
		<label for="fs-class">Select Class</label>
		<select name="ClassID" id="ClassID" class="form-control">
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
	<div class="form-group">
		<label for="fs-adm">Admission Fees</label>
		<input type="text" class="form-control" id="fs-adm">
	</div>
	<div class="form-group">
		<label for="fs-tution">Tution Fees</label>
		<input type="text" class="form-control" id="fs-tution">
	</div>
	<div class="form-group">
		<label for="fs-trans">Transportation Charges</label>
		<input type="text" class="form-control" id="fs-trans">
	</div>
	<div class="form-group">
		<label for="fs-annaul">Annual Fees</label>
		<input type="text" class="form-control" id="fs-annual">
	</div>
	<div class="form-group">
		<label for="fs-recreation">Recreation Charges</label>
		<input type="text" class="form-control" id="fs-recreation">
	</div>
	<hr>
	<div class="form-group due-date">
		<label for="due-date">Monthly Due Date(For All Classes)</label>
		<select class="form-control" id="due-date">
			<option value="">Select Due Date</option><?php
			$settings_table = $wpdb->prefix."wpsp_settings";
			$due_date_sql = $wpdb->get_results("SELECT * FROM $settings_table WHERE option_name = 'due_date'");
			$due_date = 0;
			foreach ($due_date_sql as $due_date) {
				$due_date = $due_date->option_value;
			}
			for($i=1;$i<=28;$i++){  ?>
				<option <?php if(!empty($due_date) && $due_date == $i) echo "selected" ?> value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php
			} ?>
		</select>
	</div>
	<button type="button" class="btn btn-primary btn-block fs-save-btn">Save</button>
</form>
<div class="execute-ajax-script"></div>