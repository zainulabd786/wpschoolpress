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
                  <pre>
                <?php /*$arr = json_decode(apply_filters("wpsp_submitted_fees", array('uid' => 60, 'session' => '2018-19')));
                $fees_type = 'ttn';
                print_r($arr->$fees_type);*/
                /*$tc = json_decode(apply_filters("wpsp_get_transport_route", array('id' => 2)))[0]->route_fees;
                print_r($tc);*/
                ?>
                </pre> 
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
                        <input type="text" name="session" value="<?= $session; ?>" class="form-control" id="cd-session" />
                    </div>
                	

                	
					<div class="well">
                        <label><input type="checkbox" value="ttn" name="ttn" id="cd-ttn-chk"> Tuition Fees</label>
                        <div class="cd-ttn-due">
                            <div class="form-group">
                                <label> From: </label>
                                <select name="from" class="form-control" id="from"><?php
                                        for ($m=0; $m<=12; $m++) {
                                            if($m == 0){ ?>
                                                <option value="">From</option><?php
                                            } else{  ?>
                                            <option value="<?= ($m<$session_start && !empty($m)) ? $m+12 : $m; ?>">
                                                <?php echo $months_array[$m]; ?>
                                            </option>
                                        <?php } 
                                        } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label> To: </label>
                                <select name="to" class="form-control" id="to"><?php
                                        for ($m=0; $m<=12; $m++) {
                                            if($m == 0){ ?>
                                                <option value="">To</option><?php
                                            } else{  ?>
                                            <option value="<?= ($m<$session_start && !empty($m)) ? $m+12 : $m; ?>">
                                                <?php echo $months_array[$m]; ?>
                                            </option>
                                        <?php } 
                                        } ?>
                                </select>
                            </div>
                        </div>
                    </div>
					
					
					<div class="well">
                        <label><input type="checkbox" value="trn" name="trn" id="cd-trn-chk"> Transport Charges</label>
                        <div class="cd-trn-due">
                            <div class="form-group">
                                <label> From: </label>
                                <select name="from_trn" class="form-control" id="from_trn"><?php
                                        for ($m=0; $m<=12; $m++) {
                                            if($m == 0){ ?>
                                                <option value="">From</option><?php
                                            } else{  ?>
                                            <option value="<?= ($m<$session_start && !empty($m)) ? $m+12 : $m; ?>">
                                                <?php echo $months_array[$m]; ?>
                                            </option>
                                        <?php } 
                                        } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label> To: </label>
                                <select name="to_trn" class="form-control" id="to_trn"><?php
                                        for ($m=0; $m<=12; $m++) {
                                            if($m == 0){ ?>
                                                <option value="">To</option><?php
                                            } else{  ?>
                                            <option value="<?= ($m<$session_start && !empty($m)) ? $m+12 : $m; ?>">
                                                <?php echo $months_array[$m]; ?>
                                            </option>
                                        <?php } 
                                        } ?>
                                </select>
                            </div>
                        </div>
                    </div>
					
					
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
