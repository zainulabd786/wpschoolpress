$(document).ready(function() {	$('#notify_table').dataTable({				"order": [],				"columnDefs": [ {					  "targets"  : 'nosort',					  "orderable": false,				}],				responsive: true,	});
    /*Delete Attendance*/  	
    $(document).on('click','.notify-Delete',function(){
       if(confirm("Are you want to delete this entry?")){
            var aid=$(this).attr('data-id');
            if( aid == '' ) {
                $.fn.notify('error',{'desc':'Notification information Missing!'});
            }else{
                var data=[];
                data.push({name: 'action', value: 'deleteNotify'},{name: 'notifyid', value: aid});
                $.ajax({
                    type: "POST",
                    url: ajax_url,
                    data: data,
                    beforeSend:function () {
                        $.fn.notify('loader',{'desc':'Deleting entry..'});
                    },
                    success: function(res) {
                        $.fn.notify('success',{'desc':'Notification entry deleted successfully..'});
						$( this ).closest( 'tr' ).remove();
                    },
                    error:function(){
                        $.fn.notify('error',{'desc':'Something went wrong. Try after refreshing page..'});
                    },
                    complete:function () {
                        $('.pnloader').remove();
                    }
                });
            }
       }
    });
	/* View Notification */
	$(document).on('click','.notify-view',function() {
		var cid=$(this).attr('data-id');
		if($.isNumeric(cid)){
			var data=[];
			data.push({name: 'action', value: 'getNotify'},{name: 'notifyid', value: cid});
			$.ajax({
				type: "POST",
				url: ajax_url,
				data: data,
				beforeSend:function () {
					$.fn.notify('loader',{'desc':'Loading Notification..'});
				},
				success: function(res) {
					$('#ViewModalContent').html(res);
				},
				error:function(){
					$.fn.notify('error',{'desc':'Something went wrong. Try after refreshing page..'});
				},
				complete:function () {
					$('.pnloader').remove();
				}
			});
			$('#ViewModal').modal('show');
		}else{
			$.fn.notify('error',{'desc':"Notification ID Missing.."});
		}
	});
	
	$(document).on('click','#notifySubmit',function() {		
		$("#NotifyEntryForm").validate({
			rules: {				
				subject: {
					required: true,
					minlength: 10
				},
				receiver: "required",
				type: "required"
			},			errorPlacement: function(error, element) { // Bharatdan Gadhavi - 1st march 2018 -  added this section  to show error element at proper place for checkboxes				if (element.attr("name") == "classList[]" )					error.insertAfter(".class-selection");				else					error.insertAfter(element);			},				
			submitHandler: function(form){
				$('#notifySubmit').submit();				
			}
		});
	});
	// Bharatdan Gadhavi - 28th Feb 2018 - Start - code to select all class with one checkbox		$(document).on('change','#allClassSelector',function() {		if($(this).is(":checked")){			$('.classList').prop("checked",true);		}else{			$('.classList').prop("checked",false);		}	});		$(document).on('change','.classList',function() {		var checkedCount = 0;		var totalBoxes = $('.classList').length;		$('.classList').each(function(){			if($(this).is(":checked")){				checkedCount++;			}		});				if(totalBoxes==checkedCount){			$('#allClassSelector').prop("checked",true);		}else{			$('#allClassSelector').prop("checked",false);		}	});			// Bharatdan Gadhavi - 28th Feb 2018 - End - code to select all class with one checkbox		$(document).ready(function() {    var text_max = 0;    $('#textarea_feedback').html(text_max + ' characters count');    $('#textarea').keyup(function() {        var text_length = $('#textarea').val().length;       // var text_remaining = text_max - text_length;        $('#textarea_feedback').html(text_length + ' characters count');    });});
});