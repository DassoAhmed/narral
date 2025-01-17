
//On Enter Move the cursor to desigtation Id
function shift_cursor(kevent,target){

    if(kevent.keyCode==13){
		$("#"+target).focus();
    }
	
}
/*Email validation code*/
function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false; 
    }
}

function save(print=false){
	
	var base_url=$("#base_url").val().trim();
    
    if($(".items_table tr").length==1){
    	toastr["warning"]("Empty Sales List!!");
		return;
    }
	if($("#delivered_date").val()==''){
		toastr["warning"]("Please Select Delivery Date!!");
		return;
	  }
	
	// check_field("delivered_date");

	//RETRIVE ALL DYNAMIC HTML VALUES
    var tot_qty=$(".tot_qty").text();
    var due_qty=$(".due_qty").text();
    var tot_disc=$(".tot_disc").text();
    var tot_grand=$(".tot_grand").text();
    var paid_amt=$(".sales_div_tot_paid").text();
    var balance=parseFloat($(".sales_div_tot_balance").text());

   
    if(document.getElementById("sales_id")){
    	var command = 'update';
    }
    else{ 
    	var command = 'save';
    }
    var this_btn='make_sale';


		
		$("#"+this_btn).attr('disabled',true);  //Enable Save or Update button
		//e.preventDefault();
		var data = new Array(2);
		data= new FormData($('#pos-form')[0]);//form name
		/*Check XSS Code*/
		if(!xss_validation(data)){ return false; }
		
		$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
		$.ajax({
			type: 'POST',
			url: base_url+'booking/pos_save_update?command='+command+'&tot_qty='+tot_qty+'&due_qty='+due_qty+'&tot_disc='+tot_disc+'&tot_grand='+tot_grand+"&paid_amt="+paid_amt+'&balance='+balance,
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			success: function(result){
				//console.log(result);return;
				result=result.trim().split("<<<###>>>");
				console.log("result[0]"+result[0]);
				//return;
				if(result[0]){
					
					if(result[0]=="success")
					{
						var print_done=true;
						if(print){
							var print_done =window.open(base_url+"pos/print_invoice_pos/"+result[1], "_blank", "scrollbars=1,resizable=1,height=300,width=450");
						}
						if(print_done){
						
							if(command=='update'){
								console.log("inside update");
								window.location=base_url+"sales";		
							}
							else{
								console.log("inside else");
								success.currentTime = 0;
								success.play();
								toastr['success']("List Saved Successfully!");
								
								//window.location=base_url+"pos";		
								$(".items_table > tbody").empty();
								$(".discount_input").val(0);
								
								$('#multiple-payments-modal').modal('hide');
								var rc=$("#payment_row_count").val();
								while(rc>1){
									remove_row(rc);
									rc--;
								}
								console.log('inside form');
								$("#pos-form")[0].reset();

								$("#customer_id").val(1).select2();

								final_total();
								//get_details();
								//hold_invoice_list();
								//window.location=base_url+"pos";

							}
							
						}
						
					}
					else if(result[0]=="failed")
					{
					   toastr['error']("Sorry! Failed to save Record.Try again");
					}
					else
					{
						alert(result);
					}
				} // data.result end
				
				if(result[2]){
					$(".search_div").html('');
   					$(".search_div").html(result[2]);	
				}
				if(result[3]){
    				$("#hold_invoice_list").html('').html(result[3]);
    				$(".hold_invoice_list_count").html('').html(result[4]);
				}
				

				$("."+this_btn).attr('disabled',false);  //Enable Save or Update button
				$(".overlay").remove();
		   }
	   });
	//} //confirmation sure
	//	}); //confirmation end

//e.preventDefault


//});
}//Save End

$('#save1,#update1').click(function (e) {
	
	var base_url=$("#base_url").val().trim();
    
    if($(".items_table tr").length==1){
    	toastr["warning"]("Empty Supply List!!");
		return;
    }
	if($('#delivered_date').val()==''){
		toastr["error"]("Delivery date required");
		return; 
	  }
	
	//RETRIVE ALL DYNAMIC HTML VALUES
    var tot_qty=$(".tot_qty").text();
    var tot_amt=$(".tot_amt").text();
    var tot_disc=$(".tot_disc").text();
    var tot_grand=$(".tot_grand").text();
    var paid_amt=$(".sales_div_tot_paid").text();
    var balance=$(".sales_div_tot_balance").text();
    

    
    if(document.getElementById("sales_id")){
    	var command = 'update';
    }else if($('#delivered_date').val()==''){
		toastr["error"]("Delivery date required");
		return; 
	  }else{
    	var command = 'save';
    }
    var this_btn='place_order';

	swal({ title: "Are you sure?",icon: "warning",buttons: true,dangerMode: true,}).then((sure) => {
			  if(sure) {//confirmation start

		e.preventDefault();
		var data = new Array(2);
		data= new FormData($('#pos-form')[0]);//form name
		/*Check XSS Code*/
		if(!xss_validation(data)){ return false; }

		$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
		$("#"+this_btn).attr('disabled',true);  //Enable Save or Update button
		$.ajax({
			type: 'POST',
			url: base_url+'booking/pos_save_update?command='+command+'&tot_qty='+tot_qty+'&due_qty='+due_qty+'&tot_disc='+tot_disc+'&tot_grand='+tot_grand+"&paid_amt="+paid_amt+'&balance='+balance+"&by_cash="+true,
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			success: function(result){
				//alert(result);//return;

				result=result.trim().split("<<<###>>>");
				
					if(result[0]=="success")
					{
						//window.location=base_url+"pos/print_invoice_pos/"+result[1]+"?redirect=pos", "_blank";
						//window.location=base_url+"sales/print_invoice/"+result[1];
						//window.open(base_url+"pos/print_invoice_pos/"+result[1], "_blank");
						if(window.open(base_url+"booking/print_invoice_pos/"+result[1], "_blank", "scrollbars=1,resizable=1,height=300,width=450")){
							if(command=='update'){
								window.location=base_url+"booking";		
							}
							else{
								window.location=base_url+"pos";		
							}
						}
						
					}
					else if(result[0]=="failed")
					{
					   toastr['error']("Sorry! Failed to save Record.Try again");
					}
					else
					{
						alert(result);
					}
				
				$("#"+this_btn).attr('disabled',false);  //Enable Save or Update button
				$(".overlay").remove();
		   }
	   });
	} //confirmation sure
		}); //confirmation end

//e.preventDefault


});


/* *********************** HOLD INVOICE START****************************/
$('#hold_invoice').click(function (e) {

	//table should not be empty
	if($(".items_table tr").length==1){
    	toastr["error"]("Please Select Items from List!!");
    	failed.currentTime = 0;
		failed.play();
		return;
    }
	if($('#delivered_date').val()==''){
		toastr["error"]("Delivery date id required");
		$("#delivered_date").val('');
		return;
	  }
	swal({
		title: "Hold Invoice ?",icon: "warning",buttons: true,dangerMode: true,
		content: {
			element: "input",attributes: 
			{
				placeholder: "Please Enter Reference Number!",
				type: "text",
				
				inputAttributes: {
				    maxlength: '5'
				  }
			},},
		}).then(name => {
			//If input box blank Throw Error
			if (!name.trim()){ throw null; return false; }
			var reference_id = name;
			/* ********************************************************** */
			var base_url=$("#base_url").val().trim();
    
			//RETRIVE ALL DYNAMIC HTML VALUES
		    var tot_qty=$(".tot_qty").text();
		    var tot_amt=$(".tot_amt").text();
		    var tot_disc=$(".tot_disc").text();
		    var tot_grand=$(".tot_grand").text();
		    var hidden_rowcount=$("#hidden_rowcount").val();

		    var this_id=this.id;//id=save or id=update

				e.preventDefault();
				data = new FormData($('#pos-form')[0]);//form name
				/*Check XSS Code*/
				if(!xss_validation(data)){ return false; }
				
				$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
				$("#"+this_id).attr('disabled',true);  //Enable Save or Update button				
				$.ajax({
					type: 'POST',
					url: base_url+'booking/hold_invoice?command='+this_id+'&tot_qty='+tot_qty+'&tot_amt='+tot_amt+'&tot_disc='+tot_disc+'&tot_grand='+tot_grand+"&reference_id="+reference_id,
					data: data,
					cache: false,
					contentType: false,
					processData: false,
					success: function(result){
						//alert(result);return;
						$("#hidden_invoice_id").val('');
						result=result.trim().split("<<<###>>>");
						
							if(result[0]=="success")
							{
								$('#pos-form-tbody').html('');
								//CALCULATE FINAL TOTAL AND OTHER OPERATIONS
		    					final_total();

								hold_invoice_list();
								success.currentTime = 0;
								success.play();
							}
							else if(result[0]=="failed")
							{
							   toastr['error']("Sorry! Failed to save Record.Try again");
							}
							else
							{
								alert(result);
							}
						
						$("#"+this_id).attr('disabled',false);  //Enable Save or Update button
						$(".overlay").remove();
				   }
			   });
			/* ********************************************************** */

		}) //name end
	.catch(err => {
	    toastr['error']("Failed!! List Not Saved! <br/>Please Enter Reference Number");
	    failed.currentTime = 0;
		failed.play();
	});//swal end

}); //hold_invoice end

function hold_invoice_list(){
	var base_url=$("#base_url").val().trim();
  $.post(base_url+"booking/hold_invoice_list",{},function(result){
  	//alert(result);
  	var data = jQuery.parseJSON(result)
    $("#hold_invoice_list").html('').html(data['result']);
    $(".hold_invoice_list_count").html('').html(data['tot_count']);
  });
}
function hold_invoice_delete(invoice_id){
	swal({ title: "Are you sure?",icon: "warning",buttons: true,dangerMode: true,}).then((sure) => {
			  if(sure) {//confirmation start
	var base_url=$("#base_url").val().trim();
  $.post(base_url+"booking/hold_invoice_delete/"+invoice_id,{},function(result){
  	result=result.trim();
    if(result=='success'){
    	toastr["success"]("Success! List Deleted!!");
	    success.currentTime = 0;
		success.play();
	    hold_invoice_list();
    }
    else{
    	toastr['error']("Failed to Delete List! Try again!!");
    	failed.currentTime = 0;
		failed.play();
    }
  });
  } //confirmation sure
		}); //confirmation end
}

function hold_invoice_edit(invoice_id){

	swal({ title: "Are you sure?",icon: "warning",buttons: true,dangerMode: true,}).then((sure) => {
	if(sure) {//confirmation start
	var base_url=$("#base_url").val().trim();

	$.post(base_url+"booking/hold_invoice_edit?invoice_id="+invoice_id,{},function(result){
    		//alert(result);
						$("#hidden_invoice_id").val(invoice_id);

						var data = jQuery.parseJSON(result)
						
						if(data.length > 0){
								//	Make empty table list
								$('#pos-form-tbody').html('');
								for(k=0;k<data.length;k++){
									var item_id=data[k]['item_id'];
									var item_qty=data[k]['item_qty'];
									for(j=1;j<=item_qty;j++){
					  					addrow(item_id);
									}
					  		}
					  		//CALCULATE FINAL TOTAL AND OTHER OPERATIONS
	    					final_total();

							hold_invoice_list();
							success.currentTime = 0;
							success.play();
						}
    	});

				
		} //confirmation sure
	}); //confirmation end
}
/* *********************** HOLD INVOICE END****************************/
/* *********************** ORDER INVOICE START****************************/
function get_id_value(id){
	return $("#"+id).val().trim();
}
$('#collect_customer_info').click(function (e) {
	
	//table should not be empty
	if($(".items_table tr").length==1){
    	toastr["error"]("Please Select Items from List!!");
    	failed.currentTime = 0;
		failed.play();
		return;
    }
    if(get_id_value('customer_id')==1){
    	//$('#customer-modal').modal('toggle');
    	toastr["error"]("Please Select Customer!!");
    	failed.currentTime = 0;
		failed.play();
    	return false;
    }
    else{
    	$('#delivery-info').modal('toggle');
    }
}); //hold_invoice end
$('.show_payments_modal').click(function (e) {
	
	//table should not be empty
	if($(".items_table tr").length==1){
    	toastr["error"]("Please Select Items from List!!");
    	failed.currentTime = 0;
		failed.play();
		return;
    }
    else{
    	adjust_payments();
    	$("#add_payment_row,#payment_type_1").parent().show();
    	$("#amount_1").parent().parent().removeClass('col-md-12').addClass('col-md-6');
    	$('#multiple-payments-modal').modal('toggle');
    }
}); //hold_invoice end
$('#show_cash_modal').click(function (e) {
	//table should not be empty
	if($(".items_table tr").length==1){
    	toastr["error"]("Please Select Items from List!!");
    	failed.currentTime = 0;
		failed.play();
		return;
    }
    else{
    	adjust_payments();
    	$("#add_payment_row,#payment_type_1").parent().hide();
    	$("#amount_1").focus();
    	$("#amount_1").parent().parent().removeClass('col-md-6').addClass('col-md-12');
    	$('#multiple-payments-modal').modal('toggle');
    }
}); //hold_invoice end

$('#add_payment_row').click(function (e) {
	
	var base_url=$("#base_url").val().trim();
	//table should not be empty
	if($(".items_table tr").length==1){
    	toastr["error"]("Please Select Items from List!!");
    	failed.currentTime = 0;
		failed.play();
		return;
    }
    /*if(get_id_value('customer_id')==1){
    	//$('#customer-modal').modal('toggle');
    	toastr["error"]("Please Select Customer!!");
    	failed.currentTime = 0;
failed.play();
    	return false;
    }*/
    else{
    	/*BUTTON LOAD AND DISABLE START*/
    	var this_id=this.id;
    	var this_val=$(this).html();
    	$("#"+this_id).html('<i class="fa fa-spinner fa-spin"></i> Please Wait..');
    	$("#"+this_id).attr('disabled',true);  
    	/*BUTTON LOAD AND DISABLE END*/

    	var payment_row_count=get_id_value("payment_row_count");
    	$.post(base_url+"booking/add_payment_row",{payment_row_count:payment_row_count},function(result){
    		$('.payments_div').parent().append(result);
    		
    		$("#payment_row_count").val(parseFloat(payment_row_count)+1);

    		/*BUTTON LOAD AND DISABLE START*/
    		$("#"+this_id).html(this_val);
    		$("#"+this_id).attr('disabled',false); 
    		/*BUTTON LOAD AND DISABLE END*/    	
    		failed.currentTime = 0;
			failed.play();
    		adjust_payments();
    	});
    }
}); //hold_invoice end
function remove_row(id){
	$(".payments_div_"+id).html('');
	failed.currentTime = 0;
	failed.play();
	adjust_payments();
}
function calculate_payments(){
	adjust_payments();
}
/* *********************** ORDER INVOICE END****************************/
