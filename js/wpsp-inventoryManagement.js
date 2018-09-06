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
    });

    /*------------------Reassign Item---------------------------*/

    $(".reassign-btn").click(function(){
      let id = $(this).attr('id');
      let data = new Array();
      data.push(
        {name:"action", value:"details_to_reassign_item"},
        {name:"id",value:id}
      );
      $.ajax({
        method: "POST",
        url: ajax_url,
        data: data,
        success: function(resp){
          resp = JSON.parse(resp);
          let dispData = '<form>'+
          '<div class="form-group">'+
            '<label>Item</label>'+
            '<input type="text" class="form-control reas-item" id="'+resp["item_details"].master_id+'" value="'+resp["item_details"].item_name+'" disabled>'+
          '</div>'+

          '<div class="form-group">'+
            '<label>Date</label>'+
            '<input type="date" class="form-control reas-date">'+
          '</div>'+

          '<div class="form-group">'+
            '<label>Quantity</label>'+
            '<input type="number" class="form-control reas-quantity" min="1" max="'+resp["item_details"].quantity+'" value="'+resp["item_details"].quantity+'" >'+
          '</div>'+

          '<div class="form-group">'+
            '<label>Reassign To:</label>'+
            '<select class="form-control reas-staff">';

            for (var i = 0; i < resp['trachers_list'].length; i++) {
              var staffName = resp['trachers_list'][i].first_name+" "+resp['trachers_list'][i].middle_name+" "+resp['trachers_list'][i].last_name
              dispData += '<option value="'+resp['trachers_list'][i].wp_usr_id+'">'+staffName+'</option>';
            }
            dispData += '</select>'+

            '</div>'+

            '<div class="form-group">'+
              '<label>Session</label>'+
              '<input type="text" class="form-control reas-session" id="'+resp["current_session"].option_value+'" value="'+resp["current_session"].option_value+'">'+
            '</div>'+
            '<span style="display:none" class="reas-data" >'+JSON.stringify(resp)+'</span>'
            '</form>';
          $.confirm({
            title: 'Reassign Item',
            content: dispData,
            theme: "supervan",
            buttons: {
              cancel: function () {          
              },
              done: {
                text: 'Done',
                btnClass: 'btn-blue',
                keys: ['enter'],
                action: function(){
                  var item = $(".reas-item").attr('id');
                  var date = $(".reas-date").val();
                  var qty = $(".reas-quantity").val();
                  var assignedTo = $(".reas-staff").val();
                  var session = $(".reas-session").val();
                  var action = "assign_inventory_item";
                  let data=new Array();
                  var reasData = JSON.parse($(".reas-data").text());
                  let reassignedFrom = reasData['item_details'].wp_usr_id;
                  console.log(reasData);
                  data.push(
                    { name: 'action', value: action },
                    { name: 'item', value: item },
                    { name: 'date', value: date },
                    { name: 'qty', value: qty },
                    { name: 'assignedTo', value: assignedTo },
                    { name: 'session', value: session },
                    { name: 'reassignedFrom', value: reassignedFrom }
                  );
                  $.ajax({
                    method: "POST",
                    url: ajax_url,
                    data: data,
                    success: function(resp){
                      if (resp == 'success') {
                        var qtyLeft = parseInt(reasData['item_details'].quantity) - parseInt(qty);
                        let data=new Array();
                        data.push(
                          {name: 'action', value:"deduct_quantity_after_reassign_item"},
                          {name: 'id', value: reasData['item_details'].sno},
                          {name: 'qtyLeft', value: qtyLeft}
                        );
                        $.ajax({
                          method: "POST",
                          url: ajax_url,
                          data: data,
                          success: function(resp){
                           if (resp == 'success') {
                              $.fn.notify('success',{'desc':'Item Successfully Deleted!'});
                              setTimeout(function() {
                                  location.reload();
                              }, 3000);
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
                }
              }
            }
          });
          },
          beforeSend: function(){
            $.fn.notify('loader',{'desc':'Fetching details...'});
          },
          complete: function(){
            $('.pnloader').remove();
          }
        });
      });

      /*------------------Reassign Item---------------------------*/


      /*---------------------- Consue Item-----------------------*/

      var checkedItems = [];
      $(".ccheckbox").change(function(){
        var id = $(this).attr('data-id');
        if($(this).prop('checked')){
          checkedItems.push(id);
        }
        else{
          checkedItems.splice( checkedItems.indexOf(id), 1 );
        }
      });

      $(".consume-btn").click(function(){
        if(checkedItems.length > 0){
          let data = [];
          data.push(
            {name:"action", value:"mark_inv_item_as_consumed"},
            {name:"itemsArr", value: checkedItems.toString()}
          );
          $.ajax({
            method: "POST",
            url: ajax_url,
            data: data,
            success: function(resp){
              if (resp == 'success') {
                $.fn.notify('success',{'desc':'Item Successfully Marked as Consumed!'});
                setTimeout(function() {
                  location.reload();
                }, 3000);
              } else{
                $.fn.notify('error',{'desc':resp});
              }
            },
            beforeSend: function(){
              $.fn.notify('loader',{'desc':'Marking item as consumed...'});
            },
            complete: function(){
              $('.pnloader').remove();
             // location.reload();
            }
          });
        } else{
          alert("No Record is Selected!");
        }
      });

      /*---------------------- Consue Item-----------------------*/
});