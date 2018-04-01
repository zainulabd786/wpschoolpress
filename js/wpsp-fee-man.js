$(document).ready(function(){
	var months_array = ["N/A","January", "February", "March", "April", "May", "June", "july", "August", "September", "October", "November", "December"];
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
	$(".dep-class-select select").change(function(){
		$.post(ajax_url, { action: "fetch_all_stydents_of_a_class", value: $(this).val() }, function(data){ $(".dep-student-select select").html(data); });
		$(".b5 .sb2 div").text($(".dep-class-select select option:selected").text());
	});
	$(".dep-student-select select").change(function(){
		var sid = $(this).val();
		var curUrl = window.location.href;
		var baseUrl = curUrl.substring(0, curUrl.indexOf('?'));
		var newUrl = baseUrl+"?uidff="+sid;
		window.location.href = newUrl;
	});
	$(".dep-fee-type select").change(function(){
		feesType = $(this).val()
		switch(feesType){
			case "AdmissionFees":
				$(".dep-adm-inp").css("display","table-row");
				$(".adm-fees-tr-inv").css("display","table-row");
				$(".inv-tab-bottom").css("display","table-row");
			break;

			case "TuitionFees":
				$(".dep-tf-inp").css("display","table-row");
				$(".tution-fees-te-inv").css("display","table-row");
				$(".inv-tab-bottom").css("display","table-row");
			break;

			case "TransportFees":
				$(".dep-tc-inp").css("display","table-row");
				$(".trans-chg-tr-inv").css("display","table-row");
				$(".inv-tab-bottom").css("display","table-row");
			break;

			case "AnnualCharge":
				$(".dep-ac-inp").css("display","table-row");
				$(".annual-chg-tr-inv").css("display","table-row");
				$(".inv-tab-bottom").css("display","table-row");
			break;

			case "RecreationCharge":
				$(".dep-rf-inp").css("display","table-row");
				$(".rec-chg-tr-inv").css("display","table-row");
				$(".inv-tab-bottom").css("display","table-row");
			break;
		}
	});
	$(".dep-adm-inp .remove-inp").click(function(){
		$(".dep-adm-inp").hide();
		$(".adm-fees-tr-inv").hide();
		$(".dep-adm-inp .expected, .dep-adm-inp .paid").val("0");
		$(".dep-adm-inp .expected, .dep-adm-inp .paid").trigger("keyup");
		$(".dep-adm-inp .expected, .dep-adm-inp .paid").trigger("change");
	});
	$(".dep-tf-inp .remove-inp").click(function(){
		$(".dep-tf-inp").hide();
		$(".tution-fees-te-inv").hide();
		$(".dep-tf-inp .expected, .dep-tf-inp .paid").val("0");
		$(".dep-tf-inp .expected, .dep-tf-inp .paid").trigger("keyup");
		$(".dep-tf-inp .expected, .dep-tf-inp .paid").trigger("change");
	});
	$(".dep-tc-inp .remove-inp").click(function(){
		$(".dep-tc-inp").hide();
		$(".trans-chg-tr-inv").hide();
		$(".dep-tc-inp .expected, .dep-tc-inp .paid").val("0");
		$(".dep-tc-inp .expected, .dep-tc-inp .paid").trigger("keyup");
		$(".dep-tc-inp .expected, .dep-tc-inp .paid").trigger("change");
	});
	$(".dep-ac-inp .remove-inp").click(function(){
		$(".dep-ac-inp").hide();
		$(".annual-chg-tr-inv").hide();
		$(".dep-ac-inp .expected, .dep-ac-inp .paid").val("0");
		$(".dep-ac-inp .expected, .dep-ac-inp .paid").trigger("keyup");
		$(".dep-ac-inp .expected, .dep-ac-inp .paid").trigger("change");
	});
	$(".dep-rf-inp .remove-inp").click(function(){
		$(".dep-rf-inp").hide();
		$(".rec-chg-tr-inv").hide();
		$(".dep-rf-inp .expected, .dep-rf-inp .paid").val("0");
		$(".dep-rf-inp .expected, .dep-rf-inp .paid").trigger("keyup");
		$(".dep-rf-inp .expected, .dep-rf-inp .paid").trigger("change");
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
	$(".dep-session").keyup(function(){
		$(".b5 .sb1 div").text($(this).val());
	});
	$(".dep-from-select select").change(function(){
		$(".b4 .sb1 div").text(months_array[$(this).val()]);
	});

	$(".dep-to-select select").change(function(){
		$(".b4 .sb2 div").text(months_array[$(this).val()]);
	});
	$(".btn-print").click(function(){
		$.print(".invoice-prev");
	});
	$(".dep-from-select select, .dep-to-select select").change(function(){
		var from = $(".dep-from-select select").val();
		var to = $(".dep-to-select select").val();
		var classId = $(".dep-class-select select").val();
		var uid = $(".dep-student-select select").val();
		$.post(ajax_url, {action: "calculate_expected_amount", from: from, to: to, classId: classId, uid: uid}, function(data){ $(".ajax-script-exec").html(data); });
		$(".tution-fees-te-inv .months").html(months_array[from]+"-"+months_array[to]);
	});
	$(".dep-trans-from-select select, .dep-trans-to-select select").change(function(){
		var from = $(".dep-trans-from-select select").val();
		var to = $(".dep-trans-to-select select").val();
		var classId = $(".dep-class-select select").val();
		var uid = $(".dep-student-select select").val();
		$.post(ajax_url, {action: "calculate_expected_amount_transport", from: from, to: to, classId: classId, uid: uid}, function(data){ $(".ajax-script-exec").html(data); });
		$(".trans-chg-tr-inv .months").html(months_array[from]+"-"+months_array[to]);
	});
	$("#dep-concession").change(function(){
		const ORIG_AMT = $(".dep-tf-inp #original-amount").val();
		console.log(ORIG_AMT);
		var discountedAmt = parseInt($(".dep-tf-inp .expected").val())-parseInt($(this).val());
		$(".dep-tf-inp .expected, .dep-tf-inp .paid").val(discountedAmt);
		$(".tution-fees-te-inv .inv-expected-amt, .tution-fees-te-inv .inv-paid-amt").html("<i class='fa fa-inr'></i>"+discountedAmt+"/-");
		$(".expected, .paid").trigger("change");
		if($(this).val() == ""){
			$(".dep-tf-inp .expected, .dep-tf-inp .paid").val(ORIG_AMT);
			$(".tution-fees-te-inv .inv-expected-amt, .tution-fees-te-inv .inv-paid-amt").html("<i class='fa fa-inr'></i>"+ORIG_AMT+"/-");
			$(".expected, .paid").trigger("change");
			$(this).val("0");
		}
	});
	$("#dep-fees-btn").click(function(){
		var action = "submit_deposit_form";
		var slip = $(".invoice-header-slip-no div").text();
		var uid = $(".dep-student-select select").val();
		var cid = $(".dep-class-select select").val();
		var from = $(".dep-from-select select").val();
		var to = $(".dep-to-select select").val();
		var fromTrn = $(".dep-trans-from-select select").val();
		var toTrn = $(".dep-trans-to-select select").val();
		var adm = $(".dep-adm-inp .paid").val();
		var ttn = $(".dep-tf-inp .paid").val();
		var trans = $(".dep-tc-inp .paid").val();
		var ann = $(".dep-ac-inp .paid").val();
		var rec = $(".dep-rf-inp .paid").val();
		var session = $(".dep-session").val();
		var expadm = $(".dep-adm-inp .expected").val();
		var expttn = $(".dep-tf-inp .expected").val();
		var exptrans = $(".dep-tc-inp .expected").val();
		var expann = $(".dep-ac-inp .expected").val();
		var exprec = $(".dep-rf-inp .expected").val();
		var concession = $("#dep-concession").val();
		var data=new Array();
		data.push(
			{name: 'action', value: action},
			{name: 'slip', value: slip},
			{name: 'studentId', value: uid},
			{name: 'classId', value: cid},
			{name: 'fromDate', value: from},
			{name: 'toDate', value: to},
			{name: 'fromDateTrn', value: fromTrn},
			{name: 'toDateTrn', value: toTrn},
			{name: 'admissionFees', value: adm},
			{name: 'tutionFees', value: ttn},
			{name: 'transportChg', value: trans},
			{name: 'annualChg', value: ann},
			{name: 'recreationChg', value: rec},
			{name: 'session', value: session},
			{name: 'expadmissionFees', value: expadm},
			{name: 'exptutionFees', value: expttn},
			{name: 'exptransportChg', value: exptrans},
			{name: 'expannualChg', value: expann},
			{name: 'exprecreationChg', value: exprec},
			{name: 'concession', value: concession}
		);
		$.ajax({
			method:"POST",
			url:ajax_url, 
			data:data, 
			success:function(sfres) {
				if(sfres=='success'){
					$.fn.notify('success',{'desc':'Information saved succesfully!'});
					//window.location.reload();
				}
				else
					$.fn.notify('error',{'desc':sfres});				
			},
			error:function(){
				$.fn.notify('error',{'desc':'Something went wrong'});
			},
			beforeSend:function(){
				$.fn.notify('loader',{'desc':'Saving Data...'});
			},
			complete:function(){
				$('.pnloader').remove();
				$(".btn-print").show();
			}
		});
	});
	$(".view-transaction").click(function(){
		var slid = $(this).attr('id');
		$.post(ajax_url,{action: "load_detailed_transaction", slid: slid},function(data){ $.alert(data); });
												
	});
	$(".dues-chart-btn").click(function(){
		$(".due-chart-container").slideToggle();
	});
});
