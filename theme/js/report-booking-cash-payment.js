$("#account").click(function(){
	

    var from_date=document.getElementById("from_date").value.trim(); 
    var to_date=document.getElementById("to_date").value.trim();
    var payment_type=document.getElementById("payment_type").value.trim();
  	if(from_date == "")
        {
            toastr["warning"]("Select From Date!");
            document.getElementById("from_date").focus();
            return;
        }
  	 
  	 if(to_date == "")
        {
            toastr["warning"]("Select To Date!");
            document.getElementById("to_date").focus();
            return;
        }
	   
	      if(this.id=="cash"){
          var account='yes';
        }
        else{
          var account='no';
        }
      	   
        $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
        $.post("show_item_cash_booking_report",{account:account,payment_type:payment_type,from_date:from_date,to_date:to_date},function(result){
          //alert(result);
            setTimeout(function() {
             $("#tbodypayment").empty().append(result);     
             $(".overlay").remove();
            }, 0);
           }); 
     
	
});

