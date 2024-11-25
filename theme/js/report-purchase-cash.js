$("#cash").click(function(){
	
	
    var from_date=document.getElementById("from_date").value.trim();
    var to_date=document.getElementById("to_date").value.trim();
    var supplier_id=document.getElementById("supplier_id").value.trim();
  
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
          var cash='yes';
        }
        else{
          var cash='no';
        }
	  
        $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
        $.post("show_item_cash_purches_report",{supplier_id:supplier_id,cash:cash,from_date:from_date,to_date:to_date},function(result){
          //alert(result);
            setTimeout(function() {
             $("#tbodypayment").empty().append(result);     
             $(".overlay").remove();
            }, 0);
           }); 
      
	
});

