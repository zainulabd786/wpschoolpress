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
    /***************************************************Create Group end**************************************************/


    /**************************************************Transactions Filtering***************************************/
    $(".change-event").change(function(){
    	let formData = $("form[name='transaction-filter-form']").serializeArray();
    	formData.push({name:"action", value: "ac_filter_transactions"});
    	formData = formData.filter(o => (o.value));
    	$.ajax({
    		method: "POST",
    		url: ajax_url,
    		data: formData,
    		success: function(data){
				displayFilteredData(formData, data);
			},
			error:function(){
				$.fn.notify('error',{'desc':'Something went wrong'});
			},
			beforeSend:function(){
				$.fn.notify('loader',{'desc':'Fetching...'});
			},
			complete:function(){
				$('.pnloader').remove();
				$(".btn-print").show();
			}

    	});
    });

    function displayFilteredData(formData, data){
    	let bankCol = $("#transactions_table .bank-balance-col");
    	let cashCol = $("#transactions_table .cash-balance-col");
    	let table = $("#transactions_table");
    	data = JSON.parse(data);
    	if(data.length > 0){
			if(formData[0].value == 1){
				bankCol.remove(".bank-balance-col")
				if(!table.find("thead tr th").hasClass("cash-balance-col")) table.find("thead tr, tfoot tr").append('<th class="cash-balance-col">Cash Balance</th>')
			}
			if(formData[0].value == 2){
				cashCol.remove(".cash-balance-col"); 
				if(!table.find("thead tr th").hasClass("bank-balance-col")) table.find("thead tr, tfoot tr").append('<th class="bank-balance-col">Bank Balance</th>')
			}
			if(formData[0].value == 0){
				if(!table.find("thead tr th").hasClass("bank-balance-col")){
					table.find("thead tr .cash-balance-col, tfoot tr .cash-balance-col").after('<th class="bank-balance-col">Bank Balance</th>');
				} 
				if(!table.find("thead tr th").hasClass("cash-balance-col")){
					table.find("thead tr .bank-balance-col, tfoot tr .bank-balance-col").before('<th class="cash-balance-col">Cash Balance</th>')	
				} 
			}
			let tableData = '';
			data.map((v, k)=>{
				let groupName = credit = debit = rowColor = "";
				groups.map((g) => (g.group_id == v.group_id) ? groupName = g.group_name : "-"); // Fetching Group Name using its ID
				(v.type == "0") ? (debit = v.amount, credit = "-", rowColor = "style='color:red'") : (credit = v.amount, debit = "-", rowColor = "style='color:green'")
				let cashBalance = (v.mop == "cash") ? v.balance : "-";
				let bankBalance = (v.mop == "bank") ? v.balance : "-";
				switch(formData[0].value){
					case "0":
						tableData += ''+
							'<tr '+rowColor+'>'+
								'<td>'+k+'</td>'+
								'<td>'+v.date_time+'</td>'+
								'<td>'+v.remarks+'</td>'+
								'<td>'+groupName+'</td>'+
								'<td>'+v.reference+'</td>'+
								'<td>'+v.mop+'</td>'+
								'<td>'+debit+'</td>'+
								'<td>'+credit+'</td>'+
								'<td>'+cashBalance+'</td>'+
								'<td>'+bankBalance+'</td>'+
							'</tr>';

					break;

					case "1":
						tableData += ''+
							'<tr '+rowColor+'>'+
								'<td>'+k+'</td>'+
								'<td>'+v.date_time+'</td>'+
								'<td>'+v.remarks+'</td>'+
								'<td>'+groupName+'</td>'+
								'<td>'+v.reference+'</td>'+
								'<td>'+v.mop+'</td>'+
								'<td>'+debit+'</td>'+
								'<td>'+credit+'</td>'+
								'<td>'+cashBalance+'</td>'+
							'</tr>';
					break;

					case "2":
						tableData += ''+
							'<tr '+rowColor+'>'+
								'<td>'+k+'</td>'+
								'<td>'+v.date_time+'</td>'+
								'<td>'+v.remarks+'</td>'+
								'<td>'+groupName+'</td>'+
								'<td>'+v.reference+'</td>'+
								'<td>'+v.mop+'</td>'+
								'<td>'+debit+'</td>'+
								'<td>'+credit+'</td>'+
								'<td>'+bankBalance+'</td>'+
							'</tr>';
					break;
				}
				table.find("tbody").html(tableData);

			});
    	} else{
    		table.find("tbody").html("<tr><td colspan='9' style='color:red'>Nothing Found!</td></tr>");
    	}
    	

    }
    /**************************************************Transactions Filtering end***************************************/
});

