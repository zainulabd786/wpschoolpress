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
		$(".b5 .sb2 div").text($(this).val());
	});
	$(".dep-student-select select").change(function(){
		$.post(ajax_url, { action: "fetch_all_details_of_a_student_for_fee", studentId: $(this).val() }, function(data){
		 	$(".script-to-fill-invoice").html(data); 
		});
	});
	$(".dep-adm-inp").hide();
	$(".dep-tf-inp").hide();
	$(".dep-tc-inp").hide();
	$(".dep-ac-inp").hide();
	$(".dep-rf-inp").hide();
	$(".adm-fees-tr-inv").hide();
	$(".tution-fees-te-inv").hide();
	$(".trans-chg-tr-inv").hide();
	$(".annual-chg-tr-inv").hide();
	$(".rec-chg-tr-inv").hide();
	$(".inv-tab-bottom").hide();
	$(".dep-fee-type select").change(function(){
		feesType = $(this).val()
		switch(feesType){
			case "AdmissionFees":
				$(".dep-adm-inp").show();
				$(".adm-fees-tr-inv").show();
				$(".inv-tab-bottom").show();
			break;

			case "TuitionFees":
				$(".dep-tf-inp").show();
				$(".tution-fees-te-inv").show();
				$(".inv-tab-bottom").show();
			break;

			case "TransportFees":
				$(".dep-tc-inp").show();
				$(".trans-chg-tr-inv").show();
				$(".inv-tab-bottom").show();
			break;

			case "AnnualCharge":
				$(".dep-ac-inp").show();
				$(".annual-chg-tr-inv").show();
				$(".inv-tab-bottom").show();
			break;

			case "RecreationCharge":
				$(".dep-rf-inp").show();
				$(".rec-chg-tr-inv").show();
				$(".inv-tab-bottom").show();
			break;
		}
	});
	$(".dep-adm-inp .remove-inp").click(function(){
		$(".dep-adm-inp").hide();
		$(".adm-fees-tr-inv").hide();
	});
	$(".dep-tf-inp .remove-inp").click(function(){
		$(".dep-tf-inp").hide();
		$(".tution-fees-te-inv").hide();
	});
	$(".dep-tc-inp .remove-inp").click(function(){
		$(".dep-tc-inp").hide();
		$(".trans-chg-tr-inv").hide();
	});
	$(".dep-ac-inp .remove-inp").click(function(){
		$(".dep-ac-inp").hide();
		$(".annual-chg-tr-inv").hide();
	});
	$(".dep-rf-inp .remove-inp").click(function(){
		$(".dep-rf-inp").hide();
		$(".rec-chg-tr-inv").hide();
	});
});