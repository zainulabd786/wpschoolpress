$(document).ready(function () {
    var lines = [];
    //$('.select_date').datepicker({autoclose: true,dateFormat: date_format, todayHighlight: true,  changeMonth: true,changeYear: true, yearRange: "-20:+0"});
    $("#Doj").datepicker({
        autoclose: true,
        dateFormat: date_format,
        todayHighlight: true,
        changeMonth: true,
        changeYear: true,
        yearRange: "-50:+0",        
    });
	
    $("#Dob").datepicker({
        autoclose: true,
        dateFormat: date_format,
        todayHighlight: true,
        changeMonth: true,
        changeYear: true,
		 yearRange: "-50:+0",
    });
	
    $('#student_table').dataTable({
        "order": [],
        "columnDefs": [{
                "targets": 'nosort',
                "orderable": false,
            }],
        responsive: true,
    });
	// Bharatdan Gadhavi - 14th Feb - Start - Call ajax function to get last Reg no and update the value in Student Add Form
	var studentFormName = $('#studentFormName').val();
	var RegistrationNo = $('#RegistrationNo').val();
	if(studentFormName=="addForm" || (studentFormName=="editForm"  && RegistrationNo=="")){
		var data = {
			'action': 'get_latest_registration_no'
		};
		jQuery.post(ajax_url, data, function(response) {
			var result	=	jQuery.parseJSON( response );
			if( result.status == 1 ) {
				 $('#RegistrationNo').val( result.latest_reg_no);
			}
		});
	}
	// Bharatdan Gadhavi - 14th Feb - End
	$("#displaypicture, #p_displaypicture").change(function(){	
			
			var id = $(this).attr('id');
			$('.validation-error-'+id).html('');
			var fsize = document.getElementById(id).files[0].size;
			var fileName = $(this).val();
			var maxsize = 3 * 1024 * 1024; //3145728			
			if( fsize > maxsize ) {
				$('.validation-error-'+id).html( 'File Size should be less than 3 MB, Please select another file');
				$(this).val('');
			}	
			var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
			if($.inArray(fileExtension, ['jpg','jpeg']) == -1) { 
				$('.validation-error-'+id).html( 'Please select either jpg or jpeg file');
				$(this).val('');				
			}
	});
		
    var sid = $('#studID').val();
    $('#photoUpload').fileupload({
        url: ajax_url,
        dataType: 'json',
        formData: {action: 'photoUpload', sid: sid},
        add: function (e, data) {
            data.context = $('<button/>').text('Upload')
                    .appendTo('#uploadButton')
                    .click(function () {
                        data.context = $('<p/>').text('Uploading...').replaceAll($(this));
                        data.submit();
                    });
            $('#progress .progress-bar').css(
                    'width', 0);
        },
        progress: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                    );
        }
    });
	
    $(".thumb").click(function (event) {
        vent = event || window.event;
        var target = event.target || event.srcElement,
                link = target.src ? target.parentNode : target,
                options = {index: link, event: event},
                links = this.getElementsByTagName('a');
        blueimp.Gallery(links, options);
    });
	
    $(".deleteImage").click(function () {
        var iname = $(this).attr('imglink');
        var data = [];
        data.push({name: 'action', value: 'deletePhoto'}, {name: 'iname', value: iname}, {name: 'sid', value: sid});
        var result = window.confirm('Are you sure want to delete?');
        if (result == true) {
            $.ajax({
                type: "POST",
                url: ajax_url,
                data: data,
                beforeSend: function () {
                    $.fn.notify('loader', {'desc': 'Deleting image..'});
                },
                success: function (pdata) {
                    $.fn.notify('success', {'desc': pdata});
                    location.reload();
                },
                complete: function () {
                    $('.pnloader').remove();
                }
            });
        }
    });
	
	$('#StudentEditForm').validate({		
		 rules: {
			 s_phone: {
				required: true, 
				number: true,							
			}	
		 }
	});
	
    $("#StudentEntryForm").validate({
       rules: {
            s_fname: "required", s_address: "required", s_lname: "required",s_zipcode: "required",
			pEmail:"required",p_fname:"required",p_lname:"required",pUsername:"required",
            Username: {
                minlength: 5,				
            },
            Password: {
                minlength: 4
            },
            ConfirmPassword: {
                minlength: 4,
                equalTo: "#Password"
            },			
			pUsername: {
                required: true,
                minlength: 5,				
            },
            pPassword: {
                required: true,
                minlength: 4
            },
            pConfirmPassword: {
                required: true,
                minlength: 4,
                equalTo: "#p_password"
            },
			s_phone: {
				required: false,
				number: true,
			},	
        },
        messages: {
            s_fname: "Please enter first Name",
            s_address: "Please enter current address",
            s_lname: "Please enter last Name",
            Username: {
                required: "Please enter a username",
                minlength: "Username must consist of at least 5 characters"
            },
            Password: {
                required: "Please provide a password",
                minlength: "Password must be at least 5 characters long"
            },
            Confirm_password: {
                required: "Please provide a password",
                minlength: "Password must be at least 5 characters long",
                equalTo: "Please enter the same password as above"
            },
            Email: "Please enter a valid email address",
        },
        submitHandler: function (form) {
				var data = new FormData();
				var fdata = $('#StudentEntryForm').serializeArray();
				var ufile = $('#displaypicture')[0].files[0];
				var pfile = $('#p_displaypicture')[0].files[0];
				data.append('action', 'AddStudent');
				
				data.append('displaypicture', ufile);
				data.append('pdisplaypicture', pfile); //parent file
				$.each(fdata, function (key, input) {
					data.append(input.name, input.value);
				});
				data.append('data', fdata);
				$.ajax({
					type: "POST",
					url: ajax_url,
					data: data,
					cache: false,
					processData: false,
					contentType: false,
					beforeSend: function () {
						$.fn.notify('loader', {'desc': 'Saving data..'});
						$('#studentform').attr("disabled", 'disabled');
					},
					success: function (rdata) {
						$('#studentform').removeAttr('disabled');
						if (rdata == 'success')
						{
							$('#formresponse').html("<div class='alert alert-success'>Student added successfully !</div>");
							$('#StudentEntryForm').trigger("reset");
							$(location).attr('href', 'sch-student');
						} else
						{
							$('#formresponse').html("<div class='alert alert-danger'>" + rdata + "</div>");
						}
					},
					error: function () {
						$('#formresponse').html("<div class='alert alert-danger'>Something went wrong!</div>");
						$('#studentform').removeAttr('disabled');
					},
					complete: function () {
						$('.pnloader').remove();
						$('#studentform').removeAttr('disabled');
					}
				});
		}        
    });
    $('#ClassID').change(function () {
        $('#StudentClass').submit();
    });	
    $("#transport").change(function(){
        if($(this).prop("checked") == false){
            $(".transport-route").attr("disabled", true);
        }
        else{
            $(".transport-route").attr("disabled", false);
            $.post(ajax_url, {action: "get_transport_routes"}, function(response){ $(".transport-route").html(response); });
        }
    });
	$(document).on('click','.ViewStudent',function(e) {
        e.preventDefault();
        var data = [];
        var sid = $(this).data('id');		
        data.push({name: 'action', value: 'StudentPublicProfile'}, {name: 'id', value: sid});
        $.ajax({
            type: "POST",
            url: ajax_url,
            data: data,
            beforeSend: function () {
                $.fn.notify('loader', {'desc': 'Loading student information'});
            },
            success: function (pdata) {
                $('#ViewModalContent').html(pdata);
                $('#ViewModal').modal('show');
            },
            complete: function () {
                $('.pnloader').remove();
            }
        });
    });
	
    $('.ViewParent').click(function () {
        var data = [];
        var pid = $(this).data('id');
        data.push({name: 'action', value: 'ParentPublicProfile'}, {name: 'id', value: pid});
        $.ajax({
            type: "POST",
            url: ajax_url,
            data: data,
            beforeSend: function () {
                $.fn.notify('loader', {'desc': 'Loading student information'});
            },
            success: function (pdata) {
                $('#ViewModalContent').html(pdata);
                $('#ViewModal').modal('show');
            },
            complete: function () {
                $('.pnloader').remove();
            }
        });
    });
	
    $('#StudentEntryForm').submit(function (e) {
        e.preventDefault();
    });
	
    $("#selectall").click(function () {
        if ($(this).prop("checked") == true) {
            $(".strowselect").prop('checked', true);
        } else {
            $(".strowselect").prop("checked", false);
        }
    });
	
    $('#bulkaction').change(function () {
        var op = $(this).val();
        if (op == 'bulkUsersDelete') {
			var uids = $('input[name^="UID"]').map(function () {
                if ($(this).prop('checked') == true)
                     return this.value;
                }).get();
                if (uids.length == 0) {
                    $.fn.notify('error', {'desc': 'No user selected!'});
                    return false;
                } else {
            new PNotify({
                title: 'Confirmation Needed',
                text: 'Are you sure want to delete?',
                icon: 'glyphicon glyphicon-question-sign',
                hide: false,
                confirm: {
                    confirm: true
                },
                buttons: {
                    closer: false,
                    sticker: false
                },
                history: {
                    history: false
                },
            }).get().on('pnotify.confirm', function () {                
                var data = [];
                data.push({name: 'action', value: 'bulkDelete'});
                data.push({name: 'UID', value: uids});
                data.push({name: 'type', value: 'student'});
                $.ajax({
                    type: "POST",
                    url: ajax_url,
                    data: data,
                    beforeSend: function () {
                        $.fn.notify('loader', {'desc': 'Deleting Students!'});
                    },
                    success: function (data) {
                        if (data == 'success') {
                            $.fn.notify('success', {'desc': 'Deleted successfully!'});
                        } else {
                            $.fn.notify('error', {'desc': 'Operation failed.Something went wrong!'});
                        }
						$(location).attr('href', 'sch-student');
                    },
                    complete: function () {
                        $('.pnloader').remove();
                    }
                });
            });
		}
        }
    });
	
	$(document).on('click','.viewAttendance',function(e) {    
        var stid = $(this).attr('data-id');
        var data = [];
        data.push({name: 'action', value: 'getAttReport'});
        data.push({name: 'student_id', value: stid});
        $.ajax({
            type: "POST",
            url: ajax_url,
            data: data,
            beforeSend: function () {
                $.fn.notify('loader', {'desc': 'Loading attendance report'});
            },
            success: function (data) {
                $('#ViewModalContent').html(data);
                $('#ViewModal').modal('show');
            },
            complete: function () {
                $('.pnloader').remove();
            }
        });
    });
	
    //Add class when student add
    $(document).on('change', '#selectstudclass', function () {
        if ($(this).val() == 'other') {
            $('#AddModalClass').show();
            $('#AddModalClass').addClass('in');
        }
    });
	
    $(document).on('click', '#ClassAddClose,.close', function (e) {
        $('#AddModalClass').hide();
        $('#AddModalClass').removeClass('in');
        $('#selectstudclass').prop('selectedIndex', 0);
    });
    $("#ClassAddForm").validate({
        rules: {
            Name: {
                required: true,
                minlength: 2,
            },
            ClassTeacherID: {
                number: true
            },
            Sdate: {
                required: true,
            },
            Edate: {
                required: true,
            }
        },
        messages: {
            Name: {
                required: "Please enter classname",
                minlength: "Class must consist of at least 2 characters"
            }
        },
        submitHandler: function (form) {
            var data = $('#ClassAddForm').serializeArray();
            data.push({name: 'action', value: 'AddClass'});
            data.push({name: 'add_from', value: 'student'});
            $.ajax({
                type: "POST",
                url: ajax_url,
                data: data,
                beforeSend: function () {
                    $('#ClassAddForm .formresponse').html("Saving..");
                },
                success: function (rdata) {
                    var response = jQuery.parseJSON(rdata);
                    if (response.statuscode == 1)
                    {
                        $('#ClassAddForm .formresponse').html("<div class='alert alert-success'>" + response.msg + "</div>");
                        $('#ClassAddForm').trigger("reset");
                        if (response.html != "")		
                            $(response.html).insertBefore('.class-other');
                    } else if (response.statuscode == 0) {
                        $('#ClassAddForm .formresponse').html("<div class='alert alert-danger'>" + response.msg + "</div>");
                    }
                }
            });
        }
    });
 
	
	$('.user-same-error').hide();
	$('.chk-username').blur(function() {		
	
		if( $('#Username').val().toLowerCase() == $('#p_username').val().toLowerCase() ) {			
			$(this).parent().find('.user-same-error').show();
		} else {
			$('.user-same-error').hide();
		}
	});
	
	$('.user-email-error').hide();
	$('.chk-email').blur(function() {		
	
		if( $('#Email').val().toLowerCase() == $('#pEmail').val().toLowerCase() ) {			
			$(this).parent().find('.user-email-error').show();
		} else {
			$('.user-email-error').hide();
		}
	});
	
	$('#pEmail').blur(function() {
		var parentEmail	=	$(this).val();		
		$('#parent-field-lists').find('input:radio, input:text,input:password, input:file, select').each(function() {					
			$(this).prop('disabled', false);
		});		
		if(  parentEmail != '') {
			if( isEmail(parentEmail) ) {
				$('#parent-field-lists').find('input:radio, input:text,input:password, input:file, select').each(function() {					
					$(this).prop('disabled', true);					
				});
				var data = {
					'action': 'check_parent_info',
					'parentEmail': parentEmail
				};
				jQuery.post(ajax_url, data, function(response) {
					var result	=	jQuery.parseJSON( response );
					if( result.status == 1 ) {
						 $('#p_firstname').val( result.data['p_fname'] );
						 $('#p_middlename').val( result.data['p_mname'] );
						 $('#p_lastname').val( result.data['p_lname'] );
						 $('#p_edu').val( result.data['p_edu'] );
                         $('#p_profession').val( result.data['p_profession'] );
						 $('#phone').val( result.data['s_phone'] );
						 $('#p_username').val( result.username );
						 $("#p_bloodgroup").val( result.data['p_bloodgrp'] );
						 $('input[name="p_gender"]').attr('checked',false);
						 $('input[name="p_gender"][value="'+result.data['p_gender']+'"]').attr('checked',true);						
							
					} else if( result.status == 0 ) {
						$('#parent-field-lists').find('input:radio, input:text,input:password, input:file, select').each(function() {					
							$(this).prop('disabled', false);					
						});
					}
				});
			} else {
				$('#pEmail').focus();
				$('#parent-field-lists').find('input:radio, input:text,input:password, input:file, select').each(function() {					
					$(this).prop('disabled', false);					
				});
			}
		}
	});
	$('#sameas').change(function() {    
        if($('#sameas').is(":checked")) {                   
			$("#permanent_address").val($("#current_address").val());
			$("#permanent_city").val($("#current_city").val()); 
			$("#permanent_country").val($("#current_country").val()); 
			$("#permanent_pincode").val($("#current_pincode").val()); 
		}else{                   
			$("#permanent_address").val('');
            $("#permanent_city").val('');
            $("#permanent_country").val('');
            $("#permanent_pincode").val('');
		}
	});
	
	function isEmail(email) {
	  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  return regex.test(email);
	}
    $(".fees-single-row td:not(#view)").click(function(){
        var slid = $(this).attr('id');
        $.post(ajax_url,{action: "load_detailed_transaction", slid: slid},function(data){ $.alert(data); });
    });

    //parents Panel

    $(".p-print-slip").click(function(){
        var slipId = $(this).attr("id");
        $.post(ajax_url, {
            action: "view_invoice_to_print", 
            sId: slipId
        }, function(resp){
            $.confirm({
                title: "Receipt Details", 
                type: 'green',
                typeAnimated: true,
                columnClass: 'col-md-12 col-md-offset-0',
                buttons: {
                    close: function () {text: 'Close'}
                },
                content: resp,
                contentLoaded: function(data, status, xhr){
                    // data is already set in content
                    this.setContentAppend('<br>Status: ' + status);
                }
            });
        });
    });

    $(".deposit-btn").click(function(){
        var sid_f = $(".child-tabs .active a").attr('id');
        var url = "?tab=DepositFees"+"&uidf="+sid_f;
        location = url;
    });
});

function checkRollNo(){
	var rollNo = $('#Rollno').val();
	var stdClass = $('#stdClass').val();
	if($('#studID').length){
		var studID = $('#studID').val();
	}else{
		var studID = 0;
	}
	if(rollNo!="" && stdClass !=""){
		var data = new FormData();
		data.append('action', 'checkRollNo');
		data.append('studID', studID);
		data.append('rollNo', rollNo);
		data.append('stdClass', stdClass);
		$.ajax({
			type: "POST",
			url: ajax_url,
			data: data,
			cache: false,
			async:false,
			processData: false,
			contentType: false,
			success: function (rdata) {
				var result	=	jQuery.parseJSON( rdata );
				if( result.status == 1 ) {
					
				}else{
					alert(result.message);
					//$('#formresponse').html("<div class='alert alert-danger'>" + result.message + "</div>");
					$('#Rollno').val('');
					$('#Rollno').focus();
				}
			},
			error: function () {
				//$('#formresponse').html("<div class='alert alert-danger'>Something went wrong!</div>");
				alert("Something went wrong!");
				$('#Rollno').val('');
				$('#Rollno').focus();
			}
		});
	}
	
}
