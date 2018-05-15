$(document).ready(function(){
	$(".submit-btn").click(function(){
		let date = $(".date").val();
		let session = $(".session").val()
		let purpose = $(".purpose select").val();
		let vDetails = $(".v-details").val();
		let approach = $(".approach select").val();
		let phone = $(".phone").val();
		let pName = $(".p-name").val();
		let email = $(".email").val();
		let address = $(".address").val();
		let city = $(".city").val();
		let state = $(".state").val();
		let zip = $(".zip").val();
		let cName = $(".c-name").val();
		let dob = $(".dob").val();
		let sClass = $(".class select").val();
		let gender = $("input:radio[name='gender']:checked").val();
		let action = "save_visitor_data";

		let data=new Array();

		data.push(
			{ name: 'action', value: action },
			{ name: 'date', value: date },
			{ name: 'session', value: session },
			{ name: 'purpose', value: purpose },
			{ name: 'vDetails', value: vDetails },
			{ name: 'approach', value: approach },
			{ name: 'pName', value: pName },
			{ name: 'phone', value: phone },
			{ name: 'email', value: email },
			{ name: 'address', value: address },
			{ name: 'city', value: city },
			{ name: 'state', value: state },
			{ name: 'zip', value: zip },
			{ name: 'cName', value: cName },
			{ name: 'dob', value: dob },
			{ name: 'class', value: sClass },
			{ name: 'gender', value: gender }
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

	$(".follow-up-btn").click(function(){
		let id = $(this).attr('id');
		let action = "follow_up";
		$.post(ajax_url, {action: action, id, id}, function(data){ $.alert(data) })
	});

	$("body").on('change', ".follow-up-comment", function() {
		$.post(ajax_url, {action: "save_followup_comment", comment: $(this).val(), id: $(this).attr('id')}, function(data){ alert(data); location.reload(); })
	} );

	$(".follow-up-history").click(function(){
		id = $(this).attr('id');

		$.post(ajax_url, { action: "follow_up_history", id: id }, function(data){ $.alert(data); });
	});
});