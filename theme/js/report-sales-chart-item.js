$("#momo").click(function(){
	

    var from_date=document.getElementById("from_date").value.trim(); 
    var to_date=document.getElementById("to_date").value.trim();
    var item_id=document.getElementById("item_id").value.trim();
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
        $.post("show_item_chart_of_acc_sales_report",{item_id:item_id,momo:momo,from_date:from_date,to_date:to_date},function(result){
          //alert(result);
            setTimeout(function() {
             $("#tbodypayment").empty().append(result);     
             $(".overlay").remove();
            }, 0);
           }); 
     
	
});

