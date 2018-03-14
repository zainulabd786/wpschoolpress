<?php 
$subjectclassid =	$_GET['classid'];
//echo 'classid='.$subjectclassid;
$class_table	=	$wpdb->prefix."wpsp_class";
$classQuery		=	$wpdb->get_results("select * from $class_table where cid='$subjectclassid'");
	foreach($classQuery as $classdata){
		$cid= $classdata->cid;
	}
?>
<section class="content-header">
					<h1>Add New Subjects</h1>
			  <ol class="breadcrumb">
				<li><a href="sch-dashboard "><i class="fa fa-dashboard"></i>Dashboard</a></li>
				<li><a href="sch-subject">Add Subject</a></li>
											  </ol>
			</section>
			<section class="content">
    			<div class="row">
        			<div class="col-md-12 ">
						<div class="box box-solid bg-blue-gradient">
							<div class="box-header ui-sortable-handle">
								<h3 class="box-title">New Subject Entry</h3>
								
							</div><!-- /.box-header -->
							<div class="box-footer text-black" id="SEFormContainer">
								<form name="SubjectEntryForm" action="#" id="SubjectEntryForm" method="post">
									<div class="box-body">
										<div class="col-md-12 line_box">
												<div class="formresponse"></div>
											<?php wp_nonce_field( 'SubjectRegister', 'subregister_nonce', '', true ) ?>
											<div class="form-group">
												<?php foreach($classQuery as $classdata){
													$cid= $classdata->cid; ?>
													<label for="Name">Class Name : <?php if($cid == $subjectclassid) echo $classdata->c_name;?>
														<input type="hidden" class="form-control" id="SCID" name="SCID" value="<?php if($cid == $subjectclassid) echo $classdata->cid;?>">
													<?php } ?>
											</div>
											<?php for($i=1;$i<=5;$i++){?>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group col-md-3">
														<label for="Name">Subject <?php echo $i;?></label><?php if($i=='1') { ?>
														<span class="red">*</span> 
														<!-- <span class="pull-right"><a href="#" id="ShowExtraFields">Show Extra Fields</a></span> -->
														<?php } ?>
														<input type="text" class="form-control" name="SNames[]" placeholder="Subject Name">
													</div>
													<!-- <div class="SubjectExtraDetails col-md-8"> -->
														<div class="form-group col-md-3">
															<label for="Name">Subject Code</label><span class="text-gray"> (Optional)</span>
															<input type="text" class="form-control" name="SCodes[]" placeholder="Subject Code">
														</div>
														<div class="form-group col-md-3">
															<label for="Name">Subject Teacher</label><span> (Incharge)</span>
															<select name="STeacherID[]" class="form-control">
																<option value="">Select Teacher </option>
																<?php
																	$k_filter = array('role' => 'teacher');
																	$kv_teacher_list=get_users($k_filter);
																	foreach ($kv_teacher_list as $kv_single_teacher) 
																	{
																		?>
																		<option value="<?php echo $kv_single_teacher->ID;?>"><?php echo $kv_single_teacher->user_nicename;?></option>
																		<?php
																	}
																	?>
															</select>
														</div>
														<div class="form-group col-md-3">
															<label for="BName">Book Name</label><span class="text-gray"> (Optional)</span>
															<input type="text" class="form-control" name="BNames[]" placeholder="Book Name">
														</div>
														<?php if($i!='5') { ?>
														<hr style="border-top:1px solid #5C779E"/>
														<?php }?>
													<!-- </div> -->
												</div>
											</div>		
											<?php } ?>											
										</div>
										<div id="SEFResponse"></div>
									</div>
									<div class="box-footer">
										<span class="pull-right">
											<button type="submit" class="btn btn-primary">Submit</button>
											<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> -->
											 <a href="sch-subject" class="btn btn-info" >Back</a>
										</span>
									</div>
								</form>
						
							</div>
						</div></div></div></section>