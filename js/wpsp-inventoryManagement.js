$(document).ready(function() {
	$(".add-item-popup").click(function() {
    	var form = "<input type='text' class='form-control add-item-inp' placeholder='Enter Item Name' />";
    	$.alert(form);
 	 });

  	$("body").on('change', ".add-item-inp", function() {
      if ($(this).val().replace(/\s/g, '').length) {
        $.post(ajax_url, { action: "add_item_to_inv_master_table", item: $(this).val() }, function(data){ $(".items-dropdown select").html(data); });
      }
      else{
        alert("Your input must contain a proper item name");
        $(this).val("");
      }
  	});

  	$(".submit-btn").click(function(){
  		var item = $(".items-dropdown select").val();
  		var model = $(".it-model").val();
  		var manufacturer = $(".it-manufacturer").val();
  		var qty = $(".it-qty").val();
  		var price = $(".it-price").val();
  		var description = $(".it-desc").val();
  		var session = $(".it-session").val();
  		var action = "add_new_inventory_item_details";

  		var data=new Array();

  		data.push(
			{ name: 'action', value: action },
			{ name: 'item', value: item },
			{ name: 'model', value: model },
			{ name: 'manufacturer', value: manufacturer },
			{ name: 'quantity', value: qty },
			{ name: 'price', value: price },
			{ name: 'desc', value: description },
			{ name: 'session', value: session },
		);
  		$.ajax({
  			method: "POST",
  			url: ajax_url,
  			data: data,
  			success: function(resp){
  				if (resp == 'success') {
  					$.fn.notify('success',{'desc':'Information saved succesfully!'});
  				} else{
  					$.fn.notify('error',{'desc':resp});
  				}
  			},
  			error: function(){
  				$.fn.notify('error',{'desc':'Something went wrong'});
  			},
  			beforeSend: function(){
  				$.fn.notify('loader',{'desc':'Saving Data...'});
  			},
  			complete: function(){
  				$('.pnloader').remove();
          location.reload();
  			}
  		});
  	});

  	$(".as-submit-btn").click(function(){
  		var item = $(".as-items-dropdown select").val();
  		var date = $(".as-date").val();
  		var qty = $(".as-qty").val();
  		var assignedTo = $(".as-assigned-to select").val();
  		var session = $(".as-session").val();
  		var action = "assign_inventory_item";

  		var data=new Array();

  		data.push(
  			{ name: 'action', value: action },
  			{ name: 'item', value: item },
  			{ name: 'date', value: date },
  			{ name: 'qty', value: qty },
  			{ name: 'assignedTo', value: assignedTo },
  			{ name: 'session', value: session }
		  );
  		$.ajax({
  			method: "POST",
  			url: ajax_url,
  			data: data,
  			success: function(resp){
  				if (resp == 'success') {
  					$.fn.notify('success',{'desc':'Information saved succesfully!'});
  				} else{
  					$.fn.notify('error',{'desc':resp});
  				}
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
  	});

    $(".as-items-dropdown select, .items-dropdown select").change(function(){
      var data=new Array();

      data.push(
        { name: 'action', value: 'get_stock_status' },
        { name: 'item', value: $(this).val() }
      );
      $.ajax({
        method: 'POST',
        url: ajax_url,
        data: data,
        success: function(resp){
          $(".inv-avail").html(resp);
        },
        beforeSend: function(){
          $.fn.notify('loader',{'desc':'Fetching Stock Status...'});
        },
        complete: function(){
          $('.pnloader').remove();

        }
      });
    });

    $("#assigned_table").dataTable( {
      "searching": true
    } );

    $(".edit-btn").click(function(){
      let id = $(this).attr('id');
      $.post(ajax_url, {action: "update_item_input", id: id}, function(data){ $.alert(data); });
    });

    $(".delete-btn").click(function(){
      let id = $(this).attr('id');

      var data=new Array();

      data.push(
        { name: 'action', value: 'delete_master_item' },
        { name: 'id', value: id }
      );
      $.ajax({
        method: 'POST',
        url: ajax_url,
        data: data,
        success: function(resp){
          if (resp == 'success') {
            $.fn.notify('success',{'desc':'Item Successfully Deleted!'});
          } else{
            $.fn.notify('error',{'desc':resp});
          }
        },
        beforeSend: function(){
          $.fn.notify('loader',{'desc':'Fetching Stock Status...'});
        },
        complete: function(){
          $('.pnloader').remove();
         // location.reload();
        }
      });
     // $.post(ajax_url, {action: "delete_master_item", id: id}, function(data){ $.alert(data); location.reload(); });
    });
});