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
				(res=='success') ? $.fn.notify('success',{'desc':'Record Saved Successfully'}) : $.fn.notify('error',{'desc':res});
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


    /*$(".edit-group-btn").click(function(){
    	let formData = ''+
    	'<form name="edit-group-form">';

    	$.confirm({
		    title: 'Edit Location Details!',
		    content: formData,
		    buttons: {
		        cancel: () => console.log("cancelled"),
		        done: {
		            text: 'Done',
		            btnClass: 'btn-green',
		            keys: ['enter'],
		            action: ()=>{
		            	
		            }
		        }
		    }
		});
    });*/

});