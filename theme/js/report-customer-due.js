$("#view,#view_all").click(function(){
	

	  
	      if(this.id=="view"){ 
          var view_all='yes';
        }
        else{
          var view_all='no';
        }
       
        $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
        $.post("customers-view",{view:view},function(result){
          //alert(result);
            setTimeout(function() {
             $("#tbodyid").empty().append(result);     
             $(".overlay").remove();
            }, 0);
           }); 
     
	
});

