$(document).ready(function(){
	$("#dep-amount-exp, #dep-amount-paid").keyup(function(){
		expectedAmt = $("#dep-amount-exp").val();
		paidAmt = $("#dep-amount-paid").val();
		dueAmt = parseInt(expectedAmt) - parseInt(paidAmt);
		$("#dep-amount-due").val(dueAmt);
		$(".inv-entries table tr .inv-entries-total").html("<i class='fa fa-inr'></i>"+expectedAmt+"/-");
		$(".inv-entries table tr .inv-entries-paid").html("<i class='fa fa-inr'></i>"+paidAmt+"/-");
		$(".inv-entries table tr .inv-entries-due").html("<i class='fa fa-inr'></i>"+dueAmt+"/-");
		$(".inv-entries table tr .inv-entries-amt").html("<i class='fa fa-inr'></i>"+paidAmt+"/-");
	});
	$("#dep-fees-btn").click(function(){
		$.alert("<div class='alert alert-danger'>Sorry! This Module is still Incomplete</div>");
	});
	$(".dep-class-select select").change(function(){
		$.post(ajax_url, { action: "fetch_all_stydents_of_a_class", value: $(this).val() }, function(data){ $(".dep-student-select select").html(data); });
	});
	$(".dep-adm-inp").hide();
	$(".dep-tf-inp").hide();
	$(".dep-tc-inp").hide();
	$(".dep-ac-inp").hide();
	$(".dep-rf-inp").hide();
	$(".dep-fee-type select").change(function(){
		feesType = $(this).val()
		switch(feesType){
			case "AdmissionFees":
				$(".dep-adm-inp").show();
			break;

			case "TuitionFees":
				$(".dep-tf-inp").show();
			break;

			case "TransportFees":
				$(".dep-tc-inp").show();
			break;

			case "AnnualCharge":
				$(".dep-ac-inp").show();
			break;

			case "RecreationCharge":
				$(".dep-rf-inp").show();
			break;
		}
	});
	$(".dep-adm-inp .remove-inp").click(function(){
		$(".dep-adm-inp").hide();
	});
	$(".dep-tf-inp .remove-inp").click(function(){
		$(".dep-tf-inp").hide();
	});
	$(".dep-tc-inp .remove-inp").click(function(){
		$(".dep-tc-inp").hide();
	});
	$(".dep-ac-inp .remove-inp").click(function(){
		$(".dep-ac-inp").hide();
	});
	$(".dep-rf-inp .remove-inp").click(function(){
		$(".dep-rf-inp").hide();
	});
});