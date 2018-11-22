var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];
var stArr = [];
$(document).ready(function(){
	var months_array = ["N/A","January", "February", "March", "April", "May", "June", "july", "August", "September", "October", "November", "December"];
	function getSum(total, num) {
		return +total + +Math.round(num); 
	}

	function inWords (num) {
	    if ((num = num.toString()).length > 9) return 'overflow';
	    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
		if (!n) return; var str = '';
	    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
	    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
	    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
	    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
	    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + ' ' : '';
	    return str;
	}

	function cleanArray(actual) {
	  	var newArray = new Array();
	  	for (var i = 0; i < actual.length; i++) {
	    	if (actual[i]) {
	     	 newArray.push(actual[i]);
	    	}
	  	}
	  	return newArray;
	}

	function capitalLetter(str) {
	    str = cleanArray(str.split(" "));
	    for (var i = 0, x = str.length; i < x; i++) {
	        str[i] = str[i][0].toUpperCase() + str[i].substr(1);
	    }
	    return str.join(" ");
	}

	function convertDate(inputFormat) {
		function pad(s) { return (s < 10) ? '0' + s : s; }
	 	var d = new Date(inputFormat);
	  	return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('-');
	}

	$("#dep-slip-num").keyup(function(){
		$(".invoice-header-slip-no div").text($(this).val());
		$.post(ajax_url, {
			slipNo: $(this).val(),
			action: "check_slip_number_availibility"
		}, function(response){
			if(response){
				$(".slip-num-availability").html("<div style='margin:5px;color:red;font-size:12px'>Slip Number Already Exist!</div>");
				$("#dep-fees-btn").attr("disabled", true);
			}
			else{
				$(".slip-num-availability").html("");
				$("#dep-fees-btn").attr("disabled", false);
			}
			
		});
	});

	$("#dep-issue-date").change(function(){
		$(".invoice-header-date div").text(convertDate($(this).val()));
	});

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
		$(".dep-student-select select").html("<option value=''>Select Students</option>");
		$.post(ajax_url, { action: "fetch_all_students", class: $(this).val() }, function(data){
			data = JSON.parse(JSON.parse(data));
			data.forEach( i => {
				let sName = i.s_fname+" "+i.s_mname+" "+i.s_lname;
				let pName = i.p_fname+" "+i.p_mname+" "+i.p_lname;
				let id = i.wp_usr_id;
				$(".dep-student-select select").append("<option value='"+id+"'>"+sName+" S/D/O "+pName+"</option>");
			})
		});
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
				$.post(ajax_url, {action: "get_expected_admission_fees", uid: $(".dep-student-select select").val()}, function(data){
					$(".dep-adm-inp .expected").val(data); 
					$(".dep-adm-inp .paid").val(data); 
					$(".adm-fees-tr-inv .inv-expected-amt").html("<i class='fa fa-inr'></i>"+data+"/-");
					$(".adm-fees-tr-inv .inv-paid-amt").html("<i class='fa fa-inr'></i>"+data+"/-");
					$(".dep-adm-inp .expected, .dep-adm-inp .paid").trigger("keyup");
					$(".dep-adm-inp .expected, .dep-adm-inp .paid").trigger("change");
				});
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
				$.post(ajax_url, {action: "get_expected_annual_charge", uid: $(".dep-student-select select").val()}, function(data){
					$(".dep-ac-inp .expected").val(data); 
					$(".dep-ac-inp .paid").val(data); 
					$(".annual-chg-tr-inv .inv-expected-amt").html("<i class='fa fa-inr'></i>"+data+"/-");
					$(".annual-chg-tr-inv .inv-paid-amt").html("<i class='fa fa-inr'></i>"+data+"/-");
					$(".dep-ac-inp .expected, .dep-ac-inp .paid").trigger("keyup");
					$(".dep-ac-inp .expected, .dep-ac-inp .paid").trigger("change");
				});
			break;

			case "RecreationCharge":
				$(".dep-rf-inp").css("display","table-row");
				$(".rec-chg-tr-inv").css("display","table-row");
				$(".inv-tab-bottom").css("display","table-row");
				$.post(ajax_url, {action: "get_expected_recreation_charge", uid: $(".dep-student-select select").val()}, function(data){
					$(".dep-rf-inp .expected").val(data); 
					$(".dep-rf-inp .paid").val(data); 
					$(".rec-chg-tr-inv .inv-expected-amt").html("<i class='fa fa-inr'></i>"+data+"/-");
					$(".rec-chg-tr-inv .inv-paid-amt").html("<i class='fa fa-inr'></i>"+data+"/-");
					$(".dep-rf-inp .expected, .dep-rf-inp .paid").trigger("keyup");
					$(".dep-rf-inp .expected, .dep-rf-inp .paid").trigger("change");
				});
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
		if($(this).val() != $(".dep-tf-inp .expected").val()){
			$("#dep-concession").attr("disabled", true);
		}
		else{
			$("#dep-concession").attr("disabled", false);
		}
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
		var from = parseInt($(".dep-from-select select").val());
		var session = $(".dep-session").val();
		var uid = $(".dep-student-select select").val();
		$(".b4 .sb1 div").text(months_array[($(this).val()>12)?$(this).val()-12:$(this).val()]);
		$.post(ajax_url, {action: "duplicate_month_fees_chk", chk_type: 'tutionFees', from: from, session: session, uid: uid}, function(data){
			if(data != ""){
				alert(data);
				$(".dep-from-select select").val("0");
			} 
		});
	});

	$(".dep-trans-from-select select").change(function(){
		var from = parseInt($(".dep-trans-from-select select").val());
		var session = $(".dep-session").val();
		var uid = $(".dep-student-select select").val();
		$(".b4 .sb1 div").text(months_array[($(this).val()>12)?$(this).val()-12:$(this).val()]);
		$.post(ajax_url, {action: "duplicate_month_fees_chk", chk_type: 'TransportFees', from: from, session: session, uid: uid}, function(data){
			if(data != ""){
				alert(data);
				$(".dep-trans-from-select select").val("0");
			} 
		});
	});

	$(".dep-to-select select").change(function(){
		$(".b4 .sb2 div").text(months_array[($(this).val()>12)?$(this).val()-12:$(this).val()]);
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
		$(".tution-fees-te-inv .months").html(months_array[(from>12)?from-12:from]+"-"+months_array[(to>12)?to-12:to]);
	});
	$(".dep-to-select select").change(function(){
		var from = parseInt($(".dep-from-select select").val());
		var to = parseInt($(".dep-to-select select").val());
		if(from > to){
			$.post(ajax_url,{action:'fetch_session_start_month'}, function(data){
				alert(`Your Session starts in ${months_array[data]} and ends in ${months_array[(data-1)]}. So, Please Select Months Between ${months_array[data]} and ${months_array[(data-1)]} `) 
			});
			$(".dep-to-select select").val("0");
		}
	});
	$(".dep-trans-from-select select, .dep-trans-to-select select").change(function(){
		var from = $(".dep-trans-from-select select").val();
		var to = $(".dep-trans-to-select select").val();
		var classId = $(".dep-class-select select").val();
		var uid = $(".dep-student-select select").val();
		$.post(ajax_url, {action: "calculate_expected_amount_transport", from: from, to: to, classId: classId, uid: uid}, function(data){ $(".ajax-script-exec").html(data); });
		$(".trans-chg-tr-inv .months").html(months_array[(from>12)?from-12:from]+"-"+months_array[(to>12)?to-12:to]);
	});
	$(".dep-trans-to-select select").change(function(){
		var from = parseInt($(".dep-trans-from-select select").val());
		var to = parseInt($(".dep-trans-to-select select").val());
		if(from > to){
			alert("Session already ended");
			$(".dep-trans-to-select select").val("0");
		}
	});
	$("#dep-concession").change(function(){
		if($(this).val() == ""){
			$(this).val("0");
		}
		const ORIG_AMT = $(".dep-tf-inp #original-amount").val();
		var discountedAmt = parseInt($(".dep-tf-inp .expected").val())-parseInt($(this).val());
		$(".dep-tf-inp .expected, .dep-tf-inp .paid").val(discountedAmt);
		$(".tution-fees-te-inv .inv-expected-amt, .tution-fees-te-inv .inv-paid-amt").html("<i class='fa fa-inr'></i>"+discountedAmt+"/-");
		$(".expected, .paid").trigger("change");
		
	});
	$("#dep-concession").keyup(function(){
		const ORIG_AMT = $(".dep-tf-inp #original-amount").val();
		$(".b7 .d2").html("<i class='fa fa-inr'></i>"+$(this).val()+"/-");
		$(".b7 .d1").html(capitalLetter(inWords($(this).val()))+" Rupees Only");
		if($(this).val() == ""){
			$(".dep-tf-inp .expected, .dep-tf-inp .paid").val(ORIG_AMT);
			$(".tution-fees-te-inv .inv-expected-amt, .tution-fees-te-inv .inv-paid-amt").html("<i class='fa fa-inr'></i>"+ORIG_AMT+"/-");
			$(".expected, .paid").trigger("change");
			$(".b7 .d2").text("0");
			$(".b7 .d1").text(" ");
		}
	});
	$(".pno-group").hide();
	$(".mop select").change(function(){
		$(".b6 .sb1 div").text($(this).val());
		if($(this).val() != "Cash"){
			$(".pno-group").show("slide");
			$(".b6 .sb2 div").text("N/A");
		}
		else{
			$(".pno-group").hide("slide");
		}
	});

	$("#pno").keyup(function(){
		$(".b6 .sb2 div").text($(this).val());
	});
	$("#dep-fees-btn").click(function(){
		var action = "submit_deposit_form";
		var issueDate = $("#dep-issue-date").val();
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
		var mop = $(".mop select").val();
		var pno = $("#pno").val();
		var data=new Array();
		if(mop == ""){
			alert("Mode of payment can not be empty");
			return;
		}
		data.push(
			{name: 'action', value: action},
			{name: 'slip', value: slip},
			{name: 'issueDate', value: issueDate},
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
			{name: 'concession', value: concession},
			{name: 'mop', value: mop},
			{name: 'pno', value: pno}
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

	$(".view-invoice").click(function(){
		var slipId = $(this).attr("id");
		$.post(ajax_url, {
			action: "view_invoice_to_print", 
			sId: slipId
		}, function(resp){
		 	$.confirm({
				title: "Receipt Details", 
				type: 'green',
				typeAnimated: true,
				columnClass: 'col-md-12 col-md-offset-0',
				buttons: {
					close: function () {text: 'Close'}
				},
				content: resp,
				contentLoaded: function(data, status, xhr){
					// data is already set in content
					this.setContentAppend('<br>Status: ' + status);
				}
			});
		});
	});

	$("#to-concession").on("change",function(){
		if($("#from-concession").val() != ""){
			$("#date-filter-form").submit();
		}
		else{
			$.alert("Please Select From date");
		}
	});

	$(".strowselect").click(function(){
		if($(this).prop("checked") == true){
			stArr.push($(this).val());
		}
		else{
			stArr.splice( stArr.indexOf($(this).val()), 1 );
		}
	});

	$("#selectall").click(function(){
		if($(this).prop("checked") == true){
			var count = $("#student_table tbody .z-checkbox-row").length;
			for(var i=1;i<=count;i++){
				stArr.push($("#student_table tbody .z-checkbox-row:nth-child("+i+") td .ccheckbox").val());
			}
		}
		else{
			var count = $("#student_table tbody .z-checkbox-row").length;
			for(var i=1;i<=count;i++){
				stArr.splice( stArr.indexOf($("#student_table tbody .z-checkbox-row:nth-child("+i+") td .ccheckbox").val()), 1 );
			}
		}
	});

	$(".reminder-btn").click(function(){
		var filterArr = [];
		if(stArr.length > 0){
			$.each(stArr, function(i, el){
		    	if($.inArray(el, filterArr) === -1) filterArr.push(el);
			});
			$.post(ajax_url, {action: "send_reminder_message", to: filterArr}, function(data){ $.alert(data); });
		}
		else{
			alert("Please Select Students to send message");
		}
	});


	/*--------------------------------CANCEL Payment--------------------------------*/

	$(".cancel-payment").click(function(){
		var sid = $(this).attr('id');
		$.confirm({
		    title: 'Confirm!',
		    content: 'Are you sure you want to cancel this Payment?',
		    theme: 'material',
		    buttons: {
		        confirm: {
		            text: 'Cancel Payment',
		            btnClass: 'btn-red',
		            keys: ['enter'],
		            action: function(){
		                
						let data = new Array();
						data.push(
							{name:'action', value:'cancel_payment'},
							{name:'id', value: sid},
						);
						console.log(sid);
						$.ajax({
							method: 'POST',
							url: ajax_url,
							data: data,
							success: function(res){
								if(res=='success'){
									$.fn.notify('success',{'desc':'Payment Cancelled!'});
									//window.location.reload();
								}
								else $.fn.notify('error',{'desc':res});
								console.log(res);
							},
							error:function(){
								$.fn.notify('error',{'desc':'Something went wrong'});
							},
							beforeSend:function(){
								$.fn.notify('loader',{'desc':'Cancelling...'});
							},
							complete:function(){
								$('.pnloader').remove();
								$(".btn-print").show();
							}

						});
		            }
		        },
		        cancel: {
		        	text: "Don't Cancel",
		        	btnClass: 'btn-green'
		        }
		    }
		});
		
	});

	/*--------------------------------CANCEL Payment--------------------------------*/

	/*----------------------------------Custom Due Payment-------------------------*/
	$("form[name='custom-due-form']").submit(function(e){
		e.preventDefault();
		let formData = $(this).serializeArray();
		formData.push({name: "action", value: "make_custom_fees_dues"})
		$.ajax({
			method:"POST",
			url:ajax_url, 
			data:formData, 
			success:function(sfres) {
				if(sfres=='success'){
					$.fn.notify('success',{'desc':'Fees Due succesful!'});
					//window.location.reload();
				}
				else
					$.fn.notify('error',{'desc':sfres});				
			},
			error:function(){
				$.fn.notify('error',{'desc':'Something went wrong'});
			},
			beforeSend:function(){
				$.fn.notify('loader',{'desc':'Processing Data...'});
			},
			complete:function(){
				$('.pnloader').remove();
			}
		});
	});

	$("#cd-class").change(function(){
		$("#cd-students").html("<option value='0'>All Students</option>");
		$.post(ajax_url, {
			action: "fetch_all_students",
			class: $(this).val()
		}, data => {
			data = JSON.parse(JSON.parse(data));
			data.forEach( i => {
				let sName = i.s_fname+" "+i.s_mname+" "+i.s_lname;
				let pName = i.p_fname+" "+i.p_mname+" "+i.p_lname;
				let id = i.wp_usr_id;
				$("#cd-students").append("<option value='"+id+"'>"+sName+" S/D/O "+pName+"</option>");
			})
		});
	});

	$("#cd-students").change(function(){
		let req = $.post( ajax_url, { action: "fetch_all_students", id:$(this).val()} );
		req.done(data => {
			data = JSON.parse(JSON.parse(data));
			(data[0].transport > 0) ? $("#cd-trn-chk").attr("disabled", false) : $("#cd-trn-chk").attr("disabled", true) ;
		});
	});

	$("#from, #to").change(function(){
		let from = $("#from").val();
		let to = $("#to").val();
		let session = $("#cd-session").val();
		let uid = $("#cd-students").val();
		let feesType = "ttn";
		//code to check if fees already submitted or due
		

		if(from !== "" && to !== ""){
			if(from > to){
				$.post(ajax_url,{action:'fetch_session_start_month'}, function(data){
					alert(`Your Session starts in ${months_array[data]} and ends in ${months_array[(data-1)]}. So, Please Select Months Between ${months_array[data]} and ${months_array[(data-1)]} `) 
				});
				$("#to").val("0");
			}
			$.post( ajax_url, {
				action: "chk_fees_status",
				from: from,
				to: to,
				session: session,
				uid: uid,
				fees_type: feesType
			}, resp => (!resp) ? alert("Fees of this month is either due or already desposited!") : "" );
		}

	});

	$("#from_trn, #to_trn").change(() => {
		let from = $("#from_trn").val();
		let to = $("#to_trn").val();
		let session = $("#cd-session").val();
		let uid = $("#cd-students").val();
		let feesType = "trn";

		if(from !== "" && to !== ""){
			if(from > to){
				$.post(ajax_url,{action:'fetch_session_start_month'}, function(data){
					alert(`Your Session starts in ${months_array[data]} and ends in ${months_array[(data-1)]}. So, Please Select Months Between ${months_array[data]} and ${months_array[(data-1)]} `) 
				});
				$("#to").val("0");
			}
			$.post( ajax_url, {
				action: "chk_fees_status",
				from: from,
				to: to,
				session: session,
				uid: uid,
				fees_type: feesType
			}, resp => (!resp) ? alert("Fees of this month is either due or already desposited!") : "" );
		}
	})

	$(".cd-ttn-due").hide();
	$("#cd-ttn-chk").click(() => {
		let thisEl = $("#cd-ttn-chk"); 
		(thisEl.prop('checked')) ? $(".cd-ttn-due").find('select').attr('required', true) : $(".cd-ttn-due").find('select').attr('required', false);
		$(".cd-ttn-due").slideToggle()
	});

	$(".cd-trn-due").hide();
	$("#cd-trn-chk").click(() => {
		let thisEl = $("#cd-trn-chk"); 
		(thisEl.prop('checked')) ? $(".cd-trn-due").find('select').attr('required', true) : $(".cd-trn-due").find('select').attr('required', false);
		$(".cd-trn-due").slideToggle()
	});
	/*----------------------------------Custom Due Payment-------------------------*/
	
});

