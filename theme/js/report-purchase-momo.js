$("#momo").click(function(){
	
	
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
	  
	   if(this.id=="momo"){
          var momo='yes';
        }
        else{
          var momo='no';
        }
	  
        $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
        $.post("show_item_momo_purches_report",{supplier_id:supplier_id,momo:momo,from_date:from_date,to_date:to_date},function(result){
          //alert(result);
            setTimeout(function() {
             $("#tbodypayment").empty().append(result);     
             $(".overlay").remove();
            }, 0);
           }); 
      
	
});

