$(document).ready(function(){
	function getSum(total, num) {
		return +total + +Math.round(num); 
	}
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

	$(".expected").change(function(){
		var totAmtArr = [];
		var paidAmtArr = [];
		for(var i=2;i<7;i++){
			var tot = $(".invoice-body table tbody tr:nth-child("+i+") .inv-expected-amt").text().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
			var paid = $(".invoice-body table tbody tr:nth-child("+i+") .inv-paid-amt").text().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
			totAmtArr.push(tot);
			paidAmtArr.push(paid);
		}
		totalAmount = totAmtArr.reduce(getSum);
		paidAmount = paidAmtArr.reduce(getSum);
		var balance = totalAmount - paidAmount;
		$(".inv-tab-bottom .inv-tot-amt").html("<i class='fa fa-inr'></i>"+totalAmount+"/-");
		$(".inv-tab-bottom .inv-paid-amt").html("<i class='fa fa-inr'></i>"+paidAmount+"/-");
		$(".inv-tab-bottom .inv-bal-amt").html("<i class='fa fa-inr'></i>"+balance+"/-");
		console.log(totAmtArr);
		console.log(paidAmtArr);
	});
	$(".paid").change(function(){
		var totAmtArr = [];
		var paidAmtArr = [];
		for(var i=2;i<7;i++){
			var tot = $(".invoice-body table tbody tr:nth-child("+i+") .inv-expected-amt").text().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
			var paid = $(".invoice-body table tbody tr:nth-child("+i+") .inv-paid-amt").text().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
			totAmtArr.push(tot);
			paidAmtArr.push(paid);
		}
		totalAmount = totAmtArr.reduce(getSum);
		paidAmount = paidAmtArr.reduce(getSum);
		var balance = totalAmount - paidAmount;
		$(".inv-tab-bottom .inv-tot-amt").html("<i class='fa fa-inr'></i>"+totalAmount+"/-");
		$(".inv-tab-bottom .inv-paid-amt").html("<i class='fa fa-inr'></i>"+paidAmount+"/-");
		$(".inv-tab-bottom .inv-bal-amt").html("<i class='fa fa-inr'></i>"+balance+"/-");
		console.log(totAmtArr);
		console.log(paidAmtArr);
	});
	$('.expected, .paid').on("keyup",function(){
		var charTest = /[A-Za-z]/g;
		var specCharTest = /^[A-Za-z0-9]*$/g;
		if(charTest.test($(this).val()) || specCharTest.test($(this).val()) == false) 
			$.alert("<div class='alert alert-danger'>Error! Characters are not allowed here</div>");
	});
	$(".dep-adm-inp .expected").keyup(function(){
		$(".adm-fees-tr-inv .inv-expected-amt").html("<i class='fa fa-inr'></i>"+$(this).val()+"/-");
		var admBal = $(this).val()-$(".dep-adm-inp .paid").val();
		$(".adm-fees-tr-inv .inv-bal-amt").html("<i class='fa fa-inr'></i>"+admBal+"/-");
	});
	$(".dep-adm-inp .paid").keyup(function(){
		$(".adm-fees-tr-inv .inv-paid-amt").html("<i class='fa fa-inr'></i>"+$(this).val()+"/-");
		var admBal = $(".dep-adm-inp .expected").val()-$(this).val();
		$(".adm-fees-tr-inv .inv-bal-amt").html("<i class='fa fa-inr'></i>"+admBal+"/-");
	});

	$(".dep-tf-inp .expected").keyup(function(){
		$(".tution-fees-te-inv .inv-expected-amt").html("<i class='fa fa-inr'></i>"+$(this).val()+"/-");
		var admBal = $(this).val()-$(".dep-tf-inp .paid").val();
		$(".tution-fees-te-inv .inv-bal-amt").html("<i class='fa fa-inr'></i>"+admBal+"/-");
	});
	$(".dep-tf-inp .paid").keyup(function(){
		$(".tution-fees-te-inv .inv-paid-amt").html("<i class='fa fa-inr'></i>"+$(this).val()+"/-");
		var admBal = $(".dep-tf-inp .expected").val()-$(this).val();
		$(".tution-fees-te-inv .inv-bal-amt").html("<i class='fa fa-inr'></i>"+admBal+"/-");
	});

	$(".dep-tc-inp .expected").keyup(function(){
		$(".trans-chg-tr-inv .inv-expected-amt").html("<i class='fa fa-inr'></i>"+$(this).val()+"/-");
		var admBal = $(this).val()-$(".dep-tc-inp .paid").val();
		$(".trans-chg-tr-inv .inv-bal-amt").html("<i class='fa fa-inr'></i>"+admBal+"/-");
	});
	$(".dep-tc-inp .paid").keyup(function(){
		$(".trans-chg-tr-inv .inv-paid-amt").html("<i class='fa fa-inr'></i>"+$(this).val()+"/-");
		var admBal = $(".dep-tc-inp .expected").val()-$(this).val();
		$(".trans-chg-tr-inv .inv-bal-amt").html("<i class='fa fa-inr'></i>"+admBal+"/-");
	});	

	$(".dep-ac-inp .expected").keyup(function(){
		$(".annual-chg-tr-inv .inv-expected-amt").html("<i class='fa fa-inr'></i>"+$(this).val()+"/-");
		var admBal = $(this).val()-$(".dep-ac-inp .paid").val();
		$(".annual-chg-tr-inv .inv-bal-amt").html("<i class='fa fa-inr'></i>"+admBal+"/-");
	});
	$(".dep-ac-inp .paid").keyup(function(){
		$(".annual-chg-tr-inv .inv-paid-amt").html("<i class='fa fa-inr'></i>"+$(this).val()+"/-");
		var admBal = $(".dep-ac-inp .expected").val()-$(this).val();
		$(".annual-chg-tr-inv .inv-bal-amt").html("<i class='fa fa-inr'></i>"+admBal+"/-");
	});	
	$(".dep-rf-inp .expected").keyup(function(){
		$(".rec-chg-tr-inv .inv-expected-amt").html("<i class='fa fa-inr'></i>"+$(this).val()+"/-");
		var admBal = $(this).val()-$(".dep-rf-inp .paid").val();
		$(".rec-chg-tr-inv .inv-bal-amt").html("<i class='fa fa-inr'></i>"+admBal+"/-");
	});
	$(".dep-rf-inp .paid").keyup(function(){
		$(".rec-chg-tr-inv .inv-paid-amt").html("<i class='fa fa-inr'></i>"+$(this).val()+"/-");
		var admBal = $(".dep-rf-inp .expected").val()-$(this).val();
		$(".rec-chg-tr-inv .inv-bal-amt").html("<i class='fa fa-inr'></i>"+admBal+"/-");
	});	
});