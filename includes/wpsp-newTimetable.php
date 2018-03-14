<?php$skip_hours=False;if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['noh']) && $_POST['noh'] != '') {	$tt_table=$wpdb->prefix . "wpsp_timetable";	$wh_table = $wpdb->prefix . "wpsp_workinghours";	$wpsp_class_id = esc_attr($_POST['wpsp_class_name']);	$noh = esc_attr($_POST['noh']);	$sess_template = $_POST['sessions_template'];	$check_tt = $wpdb->get_row("Select heading from $tt_table where class_id=$wpsp_class_id and heading!=''");	if (count($check_tt) > 0) {		$_POST['sessions_template']='available';		$skip_hours=TRUE;	}else{	$sessions = $wpdb->get_results("SELECT * from $wh_table");		if(empty($sessions)){			echo "<div class='alert alert-danger'>No Working Hours added. Please add at <a href='sch-settings/?sc=WrkHours'>Settings</a></div>";			return false;		}	?>	
<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">Select time for Sessions </h3>
    </div>
    <div class="box-body">
        <form name="gen_table" method="post" class="form-horizontal">
            <input type="hidden" name="wpsp_class_name" value="<?php echo $wpsp_class_id; ?>">				<input type="hidden" name="sessions_template" value="<?php echo $sess_template; ?>">				<?php				for($i = 1; $i <= $noh; $i++) {					?>					
            <div class="form-group">
                <label class="col-md-4 control-label">Session<?php echo $i; ?></label>						
                <div class="col-md-4">
                    <select name="session[]" class="form-control">
                        <?php								foreach ($sessions as $ses) {									?>									
                        <option value="<?php echo $ses->id; ?>"><?php echo $ses->begintime; ?>-<?php echo $ses->endtime; ?></option>
                        <?php								}								?>							
                    </select>
                </div>
            </div>
            <?php				}				?>				
            <div class="form-group">
                <div class="col-md-offset-4">						<input type="submit" name="last-step" value="submit" class="btn btn-primary">					</div>
            </div>
        </form>
    </div>
</div>
<?php} }if (($skip_hours===TRUE)||('POST' == $_SERVER['REQUEST_METHOD'] && $_POST['sessions_template'] == 'available' && $_POST['template_class'] != '') || ('POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['last-step']) && $_POST['last-step'] == 'submit')) {	$tt_table = $wpdb->prefix . "wpsp_timetable";	$subject_table = $wpdb->prefix . "wpsp_subject";	$h_table = $wpdb->prefix . "wpsp_workinghours";	$class_id = $_POST['wpsp_class_name'];	$sess_template = $_POST['sessions_template'];	?>	
<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">Drag and Drop Subjects </h3>
    </div>
    <div class="box-body">
        <?php			if ($sess_template == 'new') {					$session = $_POST['session'];			} else if ($sess_template == 'available' || $skip_hours===TRUE) {				if($skip_hours==TRUE){					$template_class_id=$class_id;				}else{					$template_class_id = $_POST['template_class'];				}				$check_tt = $wpdb->get_row("Select heading from $tt_table where class_id=$template_class_id and heading!=''");				if (count($check_tt) > 0) {					$get_sessions = unserialize($check_tt->heading);					foreach ($get_sessions as $sesio) {						$session[] = $sesio;					}				} else {					$error = 1;					echo "<div class='alert alert-danger'>Can't fetch template from the selected class</div>";				}			}			if (count($session) > 0) {				$chck_hd = $wpdb->get_row("SELECT * from $tt_table where class_id=$class_id and time_id='0' and day='0' and heading!=''");				if(count($chck_hd) == null) {					$ins = $wpdb->insert($tt_table, array('class_id' => $class_id,'heading' => serialize($session)));				} else {					echo "<span class='red'>*Sessions already available in order to edit session delete and regenerate timetable.</span>";				}			} else {				$error = 1;				echo "<div class='alert alert-danger'>No Sessions Retrieved</div>";			}			$wpsp_hours_table = $wpdb->prefix . "wpsp_workinghours";			$wpsp_subjects_table = $wpdb->prefix . "wpsp_subject";			$clt = $wpdb->get_results("SELECT * FROM $wpsp_subjects_table WHERE class_id=$class_id or class_id=0 order by class_id desc");			if(count($clt)==0) {				$error = 1;				echo "<div class='alert alert-danger'>No Subjects retrieved, Check you have subject for this class at <a href='".site_url()."/sch-subject'>Subjects</a></div>";			}			if ($error == 0) {				$timetable=array();				$tt_days=$wpdb->get_results("select * from $tt_table where class_id='$class_id' and time_id !='0' ",ARRAY_A);				foreach($tt_days as $ttd){					$timetable[$ttd['day']][$ttd['time_id']]=$ttd['subject_id'];				}				?>				
        <div class="col-md-6 text-blue">Class :<span class="text-black"> <?php echo wpsp_GetClassName($_POST['wpsp_class_name']); ?></span></div>
        <div style="width: 100%;">
            <table align="center" class="table">
                <tbody>
                    <tr>								<?php									foreach ($clt as $id) {										echo '<td class="removesubject"><div class="item" id="' . $id->id . '" style="width:80px">' . $id->sub_name . '</div>	</td>';									}								?>							</tr>
                </tbody>
            </table>
        </div>
        <div class="bg-yellow text-right" id="ajax_response_exist" style="background-color: #f39c12 !important;width: auto;float: right;text-align: center;"></div>
        <div class="right table-responsive" id="TimetableContainer">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            <select class="daytype">
                                <option value="0">Days</option>
                                <option value="1">Week</option>
                            </select>
                        </th>
                        <?php							foreach ($session as $sess) {								?>								
                        <th><?php $ses_info = $wpdb->get_row("Select * from $wpsp_hours_table where id='$sess'");									echo $ses_info->begintime . " to " . $ses_info->endtime ?></th>
                        <?php							}							?>						
                    </tr>
                </thead>
                <tbody>
                    <?php						$dayname = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");						for ($j = 1; $j <= 7; $j++) {							?>							
                    <tr id="<?php echo $j; ?>">
                        <td><span class="dayval">Day <?php echo $j; ?></span><span class="daynam" style="display:none"><?php echo $dayname[$j - 1]; ?></span> </td>
                        <?php								foreach ($session as $ses) {									$hour_det = $wpdb->get_row("Select * from $wpsp_hours_table where id='$ses'");										if ($hour_det->type == "1") {											$td_class = "drop";										}										else {											$td_class = "break";										}									$sub_id='';									$sub_name='';									if(isset($timetable[$j][$ses]))										$sub_id=$timetable[$j][$ses];									if($sub_id >0){										$sub_name_f = $wpdb->get_row("SELECT sub_name from $subject_table where id=$sub_id");										$sub_name = $sub_name_f->sub_name;									}									if($sub_name!=''){										$sub_name='<div class="item assigned">'. $sub_name.'</div>';									}else{										$sub_name='';									}									?>									
                        <td class="<?php echo $td_class; ?>" tid="<?php echo $ses; ?>"><?php echo $sub_name; ?> </td>
                        <?php								} ?>							
                    </tr>
                    <?php						}						?>						
                </tbody>
            </table>
            <div class="form-group">
                <div class="col-md-offset-10">
                    <input type="hidden" name="class_id" id="class_id" value="<?php echo $class_id; ?>">							
                    <div class="bg-green" id="ajax_response"></div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12"><span class="pull-right"><a href="javascript:;" id="deleteTimetable" data-id="<?php echo $class_id; ?>">Delete</a></span></div>
        </div>
        <?php  } ?>		
    </div>
</div>
<?php 	}	if( 'POST' != $_SERVER['REQUEST_METHOD'] ) {		$tt_table = $wpdb->prefix . "wpsp_timetable";		$class_table = $wpdb->prefix . "wpsp_class";		//$classes=$wpdb->get_results("select cid,c_name from $class_table");		$classQuery			=	"select cid,c_name from $class_table Order By cid ASC";		$msg				=	'Please Add Class Before Adding Subjects';		if( $current_usr_rle=='teacher' ) {			$cuserId		=	$current_user->ID;			$classQuery		=	"select cid,c_name from $class_table where teacher_id=$cuserId";					}		$classes		=	$wpdb->get_results( $classQuery );		$class_names=array();		foreach($classes as $cnames){			$class_names[$cnames->cid]=$cnames->c_name;		}			?>	
<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">New Timetable</h3>
    </div>
    <div class="box-body">
        <form class="form-horizontal" id="timetable_form" action="" method="post">
            <div class="form-group">
                <label class="col-sm-4 control-label">Select Class<span class="red">*</span> </label>					
                <div class="col-md-4">
                    <select name="wpsp_class_name"  id="wpsp_class_name" class="form-control">
                        <option value="">Select Class</option>
                        <?php									foreach ($class_names as $cl_id=>$cl_name) {								?>									
                        <option value="<?php echo $cl_id; ?>"><?php echo $cl_name; ?></option>
                        <?php									}								?>						
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label ">Choose Session Template<span class="red">*</span></label>					
                <div class="col-md-4">
                    <select name="sessions_template" id="sessions_template"class="form-control">
                        <option value="available">Available Templates</option>
                        <option value="new" selected>New Template</option>
                    </select>
                </div>
            </div>
            <?php				$avail_sess = $wpdb->get_results("SELECT t.class_id from $tt_table t, $class_table c where heading!='' and day=0 and c.cid=t.class_id");				?>				
            <div class="form-group" id="select_template" style="display:none">
                <label class="col-md-4 control-label ">Select Sesssion<span class="red">*</span></label>					
                <div class="col-md-3" >						<select name="template_class" id="template_class" class="form-control">							<?php							if (count($avail_sess) > 0) {								foreach ($avail_sess as $avail_clid) {									$class_id = $avail_clid->class_id;									echo "<option value='" . $class_id . "'>" . $class_names[$class_id] . "</option>";								}							} else {								echo "<option value=''>No Template Available</option>";							}							?>						</select>					</div>
            </div>
            <div class="form-group" id="enter_sessions">
                <label class="col-md-4 control-label">Enter No.of Sessions<span class="red">*</span> </label>					
                <div class="col-md-3" >						<input type="text" name="noh" class="form-control">					</div>
                <div class="col-md-3" >						<span class="text-muted">Include breaks and lunch <br> E.g 8 + 3 = 11 Sessions</span>					</div>
            </div>
            <div class="col-md-4 col-md-offset-4">					<input type="submit" Value="Generate" name="stepone" class="btn btn-primary">				</div>
        </form>
    </div>
</div>
<?php }?>