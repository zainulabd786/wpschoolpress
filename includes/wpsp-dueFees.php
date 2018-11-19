<?php  if (!defined('ABSPATH')) exit('No Such File'); 
$months_array = array("none","January", "February", "March", "April", "May", "June", "july", "August", "September", "October", "November", "December");
$session_start = json_decode(apply_filters("wpsp_session_info", ""))[1]->option_value;
$session = json_decode(apply_filters("wpsp_session_info", ""))[0]->option_value; ?>
<section class="content">
    <div class="row">

        <div class="col-md-6">
            <div class="box box-blue" style="position: relative; left: 0px; top: 0px;">
                <div class="box-header" style="cursor: move;">
                    <i class="fa fa-graph"></i>
                    <h3 class="box-title"><i class="fa fa-dollar" aria-hidden="true"></i> Make Dues </h3>
               
                    <!-- tools box -->
                  
                    <!-- /. tools -->
                </div>
                 
                <!-- /.box-header -->
                
                <form name="custom-due-form" class="form-vertical">
                	<div class="form-group">
                		<label> Class: </label>
                		<select name="class" class="form-control" id="cd-class">
                			<option value="0">All</option><?php 
                			$classes = json_decode(apply_filters("wpsp_get_class", 0)); 
                			foreach ($classes as $class) { ?>
                				<option value="<?= $class->cid; ?>"><?= $class->c_name; ?></option><?php
                			} ?>
                		</select>
                	</div>

                	<div class="form-group">
                		<label>Students:</label>
                		<select name="student" class="form-control" id="cd-students">
                			<option value="0">All</option>
                		</select>
                	</div>

                     <div class="form-group">
                        <label>Session</label>
                        <input type="text" name="session" value="<?= $session; ?>" class="form-control" />
                    </div>
                	

                	
					<div class="well">
                        <label><input type="checkbox" value="ttn" name="ttn" id="cd-ttn-chk"> Tuition Fees</label>
                        <div class="cd-ttn-due">
                            <div class="form-group">
                                <label> From: </label>
                                <select name="from" class="form-control"><?php
                                        for ($m=0; $m<=12; $m++) {
                                            if($m == 0) $months_array[0] = "From";   ?>
                                            <option value="<?php if($m<$session_start && !empty($m)) echo $m+12; else echo $m; ?>">
                                                <?php echo $months_array[$m]; ?>
                                            </option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label> To: </label>
                                <select name="to" class="form-control"><?php
                                        for ($m=0; $m<=12; $m++) {
                                            if($m == 0) $months_array[0] = "To";     ?>
                                            <option value="<?php if($m<$session_start && !empty($m)) echo $m+12; else echo $m; ?>">
                                                <?php echo $months_array[$m]; ?>
                                            </option>;
                                        <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
					
					
					<!-- <div class="well">
                        <label><input type="checkbox" value="trn" name="trn" id="cd-trn-chk"> Transport Charges</label>
                        <div class="cd-trn-due">
                            <div class="form-group">
                                <label> From: </label>
                                <select name="from_trn" class="form-control"><?php
                                        for ($m=0; $m<=12; $m++) {
                                            if($m == 0) $months_array[0] = "From";   ?>
                                            <option value="<?php if($m<$session_start && !empty($m)) echo $m+12; else echo $m; ?>">
                                                <?php echo $months_array[$m]; ?>
                                            </option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label> To: </label>
                                <select name="to_trn" class="form-control"><?php
                                        for ($m=0; $m<=12; $m++) {
                                            if($m == 0) $months_array[0] = "To";     ?>
                                            <option value="<?php if($m<$session_start && !empty($m)) echo $m+12; else echo $m; ?>">
                                                <?php echo $months_array[$m]; ?>
                                            </option>;
                                        <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div> -->
					
					
					<div class="well"> <label><input type="checkbox" value="adm" name="adm"> Admission Fees</label></div>
					
					
					<div class="well"><label><input type="checkbox" value="ann" name="ann"> Annual Charges</label></div>
					
					
					<div class="well"><label><input type="checkbox" value="rec" name="rec"> Recreation Fees</label></div>
					
					<button type="submit" class="btn btn-primary btn-block">Start Processing</button>
                </form>
            
                
            </div>
        </div>
    </div>
</section>
<div class="ajax-script-exec"></div>
