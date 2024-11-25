<!DOCTYPE html>
<html>

<head>
<!-- TABLES CSS CODE -->
<?php include"comman/code_css_form.php"; ?>
<!-- </copy> -->  
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
 
 <?php include"sidebar.php"; ?>
 
  <?php

	if(!isset($customer_name)){
    $customer_name=$mobile=$phone=$email=$country_id=$state_id=$city=
    $postcode=$address=$supplier_code=$gstin=$tax_number=
    $state_code=$customer_code=$company_name=$company_mobile=$opening_balance='';
	}
 ?> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?=$page_title;?>
        <small>Add/Update Employee</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $base_url; ?>customers"><?= $this->lang->line('customers_list'); ?></a></li>
        <li class="active"><?=$page_title;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- ********** ALERT MESSAGE START******* -->
        <!-- ********** ALERT MESSAGE END******* -->
        <!-- ***********ADD EMOPLOYEE*********** -->
        <?php include"modals/modal_positions.php"; ?>
        <!-- ***********ADD EMOPLOYEE END******* -->

        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info "style="padding: 27px; border-radius:24px;margin-top: 30px;">
           
            <!-- form start -->
            <form class="form-horizontal" id="employees-form" style="border-radius:15px;">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
              <input type="hidden" id="base_url" value="<?php echo $base_url; ?>">
              <div class="box-body">
                <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                      <label for="full_name" class="col-sm-4 control-label"><?= $this->lang->line('full_name'); ?><label class="text-danger">*</label></label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder=""  value="<?php print $customer_name; ?>" >
          <span id="employee_name_msg" style="display:none" class="text-danger"></span>
                  </div>
                  </div>
                 
                  <div class="form-group">
                      <label for="id card" class="col-sm-4 control-label"><?= $this->lang->line('id_num'); ?><label class="text-danger">*</label></label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="id_num" name="id_num" placeholder="Enter ID Card Employee Num..."  value="<?php print $customer_name; ?>" >
          <span id="id_card_msg" style="display:none" class="text-danger"></span>
                  </div>
                  </div>
                  <div class="form-group">
                  <label for="phone" class="col-sm-4 control-label"><?= $this->lang->line('phone'); ?><label class="text-danger"> *</label></label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control no_special_char_no_space" id="phone" name="phone" placeholder="" value="<?php print $phone; ?>"  >
          <span id="phone_msg" style="display:none" class="text-danger"></span>
                  </div>
                  </div>
                  
                  
                   <div class="form-group">
                  <label for="email" class="col-sm-4 control-label"><?= $this->lang->line('email'); ?></label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="email" name="email" placeholder="" value="<?php print $email; ?>" >
          <span id="email_msg" style="display:none" class="text-danger"></span>
                  </div>
                  </div>
        
                  <div class="form-group">
                              
                                 <label for="position" class="col-sm-4 control-label"><?= $this->lang->line('position'); ?><label class="text-danger">*</label></label>
                                 <div class="col-sm-8">
                                    <div class="input-group">
                                       <select class="form-control select2" id="position" name="position"  style="width: 100%;" onkeyup="shift_cursor(event,'mobile')">
                                          <?php
                                             
                                             $query1="select * from db_customers where status=1";
                                             $q1=$this->db->query($query1);
                                             if($q1->num_rows($q1)>0)
                                                { 
                                                 // echo "<option value=''>-Select-</option>";
                                                  foreach($q1->result() as $res1)
                                                {
                                                  $selected=($position==$res1->id) ? 'selected' : '';
                                                  echo "<option $selected  value='".$res1->id."'>".$res1->customer_name ."</option>";
                                                }
                                              }
                                              else
                                              {
                                                 ?>
                                          <option value="">No Records Found</option>
                                          <?php
                                             }
                                             ?>
                                       </select>
                                       <span class="input-group-addon pointer" data-toggle="modal" data-target="#add_employee_position" title="New Customer?"><i class="fa fa-plus-circle text-danger fa-lg"></i></span>
                                    </div>
                                    <span id="position_msg" style="display:none" class="text-danger"></span>
                                 </div>
                                 </div>
                  <!-- ########### -->
               </div>


               <div class="col-md-5"> 

                  <div class="form-group">
                  <label for="country" class="col-sm-4 control-label"><?= $this->lang->line('country'); ?></label>

                  <div class="col-sm-8">
          <select class="form-control select2" id="country" name="country"  style="width: 100%;"  >
            <?php
            $query1="select * from db_country where status=1";
            $q1=$this->db->query($query1);
            if($q1->num_rows($q1)>0)
             {
                 foreach($q1->result() as $res1)
               {
                $selected = ($country_id==$res1->id)? 'selected' : '';
                 echo "<option $selected value='".$res1->id."'>".$res1->country."</option>";
               }
             }
             else
             {
                ?>
                <option value="">No Records Found</option>
                <?php
             }
            ?>
                  </select>
          <span id="country_msg" style="display:none" class="text-danger"></span>
                  </div>
                  </div>

                  <div class="form-group">
                  <label for="city" class="col-sm-4 control-label"><?= $this->lang->line('city'); ?></label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="city" name="city" placeholder="" value="<?php print $city; ?>" >
          <span id="city_msg" style="display:none" class="text-danger"></span>
                  </div>
                  </div>

                   <div class="form-group">
                   <label for="state" class="col-sm-4 control-label"><?= $this->lang->line('state'); ?></label>
                  
          <div class="col-sm-8">
                    <select class="form-control select2" id="state" name="state"  style="width: 100%;" >
            <?php
            $query2="select * from db_states where status=1";
            $q2=$this->db->query($query2);
            if($q2->num_rows()>0)
             {
              echo '<option value="">-Select-</option>'; 
              foreach($q2->result() as $res1)
               {
                $selected = ($state_id==$res1->id)? 'selected' : '';
                 echo "<option $selected value='".$res1->id."'>".$res1->state."</option>";
               }
             }
             else
             {
                ?>
                <option value="">No Records Found</option>
                <?php
             }
            ?>
                  </select>
          <span id="state_msg" style="display:none" class="text-danger"></span>
                  </div>
                  </div>
                
                 
                   <div class="form-group">
                  <label for="address" class="col-sm-4 control-label"><?= $this->lang->line('address'); ?></label>
                  <div class="col-sm-8">
                    <textarea type="text" class="form-control" id="address" name="address" placeholder="" ><?php print $address; ?></textarea>
          <span id="address_msg" style="display:none" class="text-danger"></span>
                  </div>
                  </div>
                   
                </div>
                  <!-- ########### -->
</div>
              
				
				
              </div>
              <!-- /.box-body -->

              <div class="box-footer" style="padding: 17px">
                              <div class="col-sm-8 col-sm-offset-2 text-center">
                                 <!-- <div class="col-sm-4"></div> -->
                                 <?php
                                    if($customer_name!=""){
                                         $btn_name="Update";
                                         $btn_id="update";
                                         ?>
                                 <input type="hidden" name="q_id" id="q_id" value="<?php echo $q_id;?>"/>
                                 <?php
                                    }
                                              else{
                                                  $btn_name="Save";
                                                  $btn_id="save";
                                                  $btnP_name="saveP";
                                              }
                                    
                                              ?>
                                 <div class="col-md-3 col-md-offset-3">
                                    <button type="button" id="<?php echo $btn_id;?>" class=" btn btn-block" style="background-color: #8a30c5c7; border-color: #8d0086;padding: 16px;width: 193px; font-size: 18px;" title="Save Data"><?php echo $btn_name;?></button>
                                 </div>
                                 <div class="col-sm-3">
                                    <button type="button" 
                                    style="background-color: #c1106c;border-color: #c1106c;padding:16px;width:187px;font-size: 18px;" 
                                    class="col-sm-3 btn btn-block close_btn" title="Go Dashboard">Close</button>
                                 </div>
                              </div>
                           </div>
                           <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          
        </div>
        <!--/.col (right) -->
        
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --> 


 <?php include"footer.php"; ?>

 
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- SOUND CODE -->
<?php include"comman/code_js_sound.php"; ?>
<!-- TABLES CODE -->
<?php include"comman/code_js_form.php"; ?>

<script src="<?php echo $theme_link; ?>js/employees.js"></script>
<!-- Make sidebar menu hughlighter/selector -->
<script>
$(document).ready(function(){
  $('#saveP,#updateP').click(function (e) {

var base_url=$("#base_url").val().trim();
  /*Initially flag set true*/
  var flag=true;

  function check_field(id)
  {

    if(!$("#"+id).val().trim() ) //Also check Others????
      {

          $('#'+id+'_msg').fadeIn(200).show().html('Required Field').addClass('required');
          $('#'+id).css({'background-color' : '#E8E2E9'});
          flag=false;
      }
      else
      {
           $('#'+id+'_msg').fadeOut(200).hide();
           $('#'+id).css({'background-color' : '#FFFFFF'});    //White color
      }
  }


  //Validate Input box or selection box should not be blank or empty
check_field("customer_name");
//check_field("mobile");
//check_field("state");

  var email=$("#email").val().trim();
  if (email!='' && !validateEmail(email)) {
          $("#email_msg").html("Invalid Email!").show();
           //flag=false;
           toastr["warning"]("Please Enter valid Email ID.")
    return;
      }
      else{
        $("#email_msg").html("Invalid Email!").hide();
      }

if(flag==false)
  {
  toastr["warning"]("You have Missed Something to Fillup!")
  return;
  }

  var this_id=this.id;

  if(this_id=="save")  //Save start
  {

        if(confirm("Do You Wants to Save Record ?")){
          e.preventDefault();
          data = new FormData($('#customers-form')[0]);//form name
          /*Check XSS Code*/
          if(!xss_validation(data)){ return false; }
          
          $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
          $("#"+this_id).attr('disabled',true);  //Enable Save or Update button
          $.ajax({
          type: 'POST',
          url: 'newcustomers',
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          success: function(result){
           // alert(result);return;
            if(result=="success")
            {
              //alert("Record Saved Successfully!");
              window.location=base_url+"customers";
              return;
            }
            else if(result=="failed")
            {
               toastr['error']("Sorry! Failed to save Record.Try again");
               //	return;
            }
            else
            {
              toastr['error'](result);
            }
            $("#"+this_id).attr('disabled',false);  //Enable Save or Update button
            $(".overlay").remove();
           }
           });
      }

      //e.preventDefault


  }//Save end

else if(this_id=="update")  //Update start
  {
          
        if(confirm("Do You Wants to Save Record ?")){
          e.preventDefault();
          data = new FormData($('#customers-form')[0]);//form name
          /*Check XSS Code*/
          if(!xss_validation(data)){ return false; }
          
          $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
          $("#"+this_id).attr('disabled',true);  //Enable Save or Update button
          $.ajax({
          type: 'POST',
          url: base_url+'customers/update_customers',
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          success: function(result){
            //alert(result);return;
            if(result=="success")
            {
              //toastr["success"]("Record Updated Successfully!");
              window.location=base_url+"customers";
              //return;
            }
            else if(result=="failed")
            {
               //alert("Sorry! Failed to save Record.Try again");
               toastr["error"]("Sorry! Failed to save Record.Try again!");
               //	return;
            }
            else
            {
              toastr['error'](result);
            }
            $("#"+this_id).attr('disabled',false);  //Enable Save or Update button
            $(".overlay").remove();
            //return;
           }
           });
      }

      //e.preventDefault


  }//Save end

});
});

</script>
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
</body>
</html>