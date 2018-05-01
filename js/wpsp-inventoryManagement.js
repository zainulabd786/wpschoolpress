$(document).ready(function() {
	$(".add-item-popup").click(function() {
    	var form = "<input type='text' class='form-control add-item-inp' placeholder='Enter Item Name' />";
    	$.alert(form);
 	 });

  	$("body").on('change', ".add-item-inp", function() {
    	$.post(ajax_url, { action: "add_item_to_inv_master_table", item: $(this).val() }, function(data){ $(".items-dropdown select").html(data); });
  	});
});