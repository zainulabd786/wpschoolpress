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
	$(".dep-class-select select").change(function(){
		$.post(ajax_url, { action: "fetch_all_stydents_of_a_class", value: $(this).val() }, function(data){ $(".dep-student-select select").html(data); });
		$(".b5 .sb2 div").text($(".dep-class-select select option:selected").text());
	});
	$(".dep-student-select select").change(function(){
		var sid = $(this).val();
		var curUrl = window.location.href;
		var baseUrl = curUrl.substring(0, curUrl.indexOf('?'));
		var newUrl = baseUrl+"?sidff="+sid;
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

	$(".dep-from-select select").change(function(){
		$(".b4 .sb1 div").text($(this).val());
	});

	$(".dep-to-select select").change(function(){
		$(".b4 .sb2 div").text($(this).val());
	});
	$(".btn-print").click(function(){
		$.print(".invoice-prev");
	});
	$("#dep-fees-btn").click(function(){
		var action = "submit_deposit_form";
		var slip = $(".invoice-header-slip-no div").text();
		var sid = $(".dep-student-select select").val();
		var cid = $(".dep-class-select select").val();
		var from = $(".dep-from-select select").val();
		var to = $(".dep-to-select select").val();
		var adm = $(".dep-adm-inp .paid").val();
		var ttn = $(".dep-tf-inp .paid").val();
		var trans = $(".dep-tc-inp .paid").val();
		var ann = $(".dep-ac-inp .paid").val();
		var rec = $(".dep-rf-inp .paid").val();
		var data=new Array();
		data.push(
			{name: 'action', value: action},
			{name: 'slip', value: slip},
			{name: 'studentId', value: sid},
			{name: 'classId', value: cid},
			{name: 'fromDate', value: from},
			{name: 'toDate', value: to},
			{name: 'admissionFees', value: adm},
			{name: 'tutionFees', value: ttn},
			{name: 'transportChg', value: trans},
			{name: 'annualChg', value: ann},
			{name: 'recreationChg', value: rec}
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
});
