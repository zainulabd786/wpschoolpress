$(document).ready(function() {
	$("#transactions_table, #groups_table").dataTable( {
      "searching": true
    } );

    $("form[name='record-transaction-form']").submit(function(e){
    	e.preventDefault();
    	let formData = $(this).serializeArray();
    	formData.push(
    		{name: "action", value: "ac_record_transaction_form"}
    	);
    	$.ajax({
    		method: "POST",
    		url: ajax_url,
    		data: formData,
    		success: function(res){
				(res) ? $.fn.notify('success',{'desc':'Record Saved Successfully'}) : $.fn.notify('error',{'desc':res});
				setTimeout(() => location.reload(), 3000);
			},
			error:function(){
				$.fn.notify('error',{'desc':'Something went wrong'});
			},
			beforeSend:function(){
				$.fn.notify('loader',{'desc':'Saving...'});
			},
			complete:function(){
				$('.pnloader').remove();
				$(".btn-print").show();
			}

    	});
    });

    /****************************************************Edit Group******************************************************/
    $(".edit-group-btn").click(function(){
    	let name = $(this).attr('data-value');
    	let id = $(this).attr('data-id');
    	let formData = ''+
    	'<form name="edit-group-form">'+
    		'<div class="form-group">'+
    			'<input type="text" class="form-control" value="'+name+'">'+
    		'</div>'+
    	'<form>';
    	$.confirm({
		    title: 'Edit Group Name!',
		    content: formData,
		    buttons: {
		        cancel: () => console.log("cancelled"),
		        done: {
		            text: 'Done',
		            btnClass: 'btn-green',
		            keys: ['enter'],
		            action: ()=>{
		            	let data = [];
		            	data.push(
		            		{name:"action", value: "ac_update_group_form"},
		            		{name:"id", value: id},
		            		{name: "value", value: $("form[name='edit-group-form'] input").val() }
		            	);
		            	$.ajax({
		            		method: "POST",
		            		url: ajax_url,
		            		data: data,
		            		success: function(resp){
				  				(resp) ? $.fn.notify('success',{'desc':'Information Updated succesfully!'}) : $.fn.notify('error',{'desc':resp});
				  				setTimeout(() => location.reload(), 3000);
				  			},
				  			error: function(){
				  				$.fn.notify('error',{'desc':'Something went wrong'});
				  			},
				  			beforeSend: function(){
				  				$.fn.notify('loader',{'desc':'Saving Data...'});
				  			},
				  			complete: function(){
				  				$('.pnloader').remove();
				  			}

		            	});
		            }
		        }
		    }
		});
    });
    /****************************************************Edit Group******************************************************/



    /****************************************************Delete Group*************************************************/
    $(".delete-group-btn").click(function(){
    	let id = $(this).attr('data-id');
    	$.confirm({
		    title: 'Confirm!',
		    content: "Are You Sure You Want to Delete this Group?",
		    buttons: {
		        cancel: () => console.log("cancelled"),
		        confirm: {
		            text: 'confirm',
		            btnClass: 'btn-green',
		            keys: ['enter'],
		            action: ()=>{
		            	let data = [];
		            	data.push(
		            		{name:"action", value: "ac_delete_group_form"},
		            		{name:"id", value: id}
		            	);
		            	$.ajax({
		            		method: "POST",
		            		url: ajax_url,
		            		data: data,
		            		success: function(resp){
				  				(resp) ? $.fn.notify('success',{'desc':'Group Deleted succesfully!'}) : $.fn.notify('error',{'desc':resp});
				  				setTimeout(() => location.reload(), 3000);
				  			},
				  			error: function(){
				  				$.fn.notify('error',{'desc':'Something went wrong'});
				  			},
				  			beforeSend: function(){
				  				$.fn.notify('loader',{'desc':'Deleting Group...'});
				  			},
				  			complete: function(){
				  				$('.pnloader').remove();
				  			}

		            	});
		            }
		        }
		    }
		});
    });
    /****************************************************Delete Group*************************************************/

    /***************************************************Create Group**************************************************/
    $("form[name='add-group-name']").submit(function(e){
    	e.preventDefault();
    	let formData = $(this).serializeArray();
    	formData.push(
    		{name: "action", value: "ac_create_group_form"}
    	);
    	$.ajax({
    		method: "POST",
    		url: ajax_url,
    		data: formData,
    		success: function(res){
				(res) ? $.fn.notify('success',{'desc':'Group Created Successfully'}) : $.fn.notify('error',{'desc':res});
				setTimeout(() => location.reload(), 3000);
			},
			error:function(){
				$.fn.notify('error',{'desc':'Something went wrong'});
			},
			beforeSend:function(){
				$.fn.notify('loader',{'desc':'Saving...'});
			},
			complete:function(){
				$('.pnloader').remove();
				$(".btn-print").show();
			}

    	});
    });
    /***************************************************Create Group**************************************************/

});