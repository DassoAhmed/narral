
/*Email validation code end*/
// 


//On Enter Move the cursor to desigtation Id
function shift_cursor(kevent,target){

    if(kevent.keyCode==13){
		$("#"+target).focus();
    }
	
}




//Delete Record start
function delete_job(q_id)
{
	
   if(confirm("Do You Wants to Delete Record!!!! ?")){
   	$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
   $.post("delete_job",{q_id:q_id},function(result){
   //alert(result);return;
   result=result.trim();
	   if(result=="success")
				{
				  toastr["success"]("Record Deleted Successfully!");
				  success.currentTime = 0; 
				  success.play();
				  $('#example2').DataTable().ajax.reload();
				}
				else if(result=="failed"){
				  toastr["error"]("Failed to Delete .Try again!");
				  failed.currentTime = 0; 
				  failed.play();
				}
				else{
				  toastr["error"](result);
				  failed.currentTime = 0; 
				  failed.play();
				}
				$(".overlay").remove();
				return false;
   });
   }//end confirmation
}
//Delete Record end
function multi_delete(){
	//var base_url=$("#base_url").val().trim();
    var this_id=this.id;
    
		if(confirm("Are you sure ?")){
			$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
			$("#"+this_id).attr('disabled',true);  //Enable Save or Update button
			
			data = new FormData($('#table_form')[0]);//form name
			$.ajax({
			type: 'POST',
			url: 'multi_delete_jobs',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			success: function(result){
				result=result.trim();
  //alert(result);return;
				if(result=="success")
				{
					toastr["success"]("Record Deleted Successfully!");
					success.currentTime = 0; 
				  	success.play();
					$('#example2').DataTable().ajax.reload();
					$(".delete_btn").hide();
					$(".group_check").prop("checked",false).iCheck('update');
				}
				else if(result=="failed")
				{
				   toastr["error"]("Sorry! Failed to save Record.Try again!");
				   failed.currentTime = 0; 
				   failed.play();
				}
				else 
				{
					toastr["error"](result);
					failed.currentTime = 0; 
				  	failed.play();
				}
				$("#"+this_id).attr('disabled',false);  //Enable Save or Update button
				$(".overlay").remove();
		   }
		   });
	}
	//e.preventDefault
}
const tableContainer = document.querySelector("#expense_cartitems")
    function show_hide(){
        tableContainer.style.display="block";
    }
