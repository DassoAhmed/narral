<!DOCTYPE html>
<html>

<head>
<!-- FORM CSS CODE -->
<?php include"comman/code_css_form.php"; ?>
<!-- </copy> -->  
</head> 


<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
 
 
 <?php include"sidebar.php"; ?> 
 
 <?php      
    if(!isset($sales_id)){ 
      $customer_id  = $booked_date = $booking_status  = $qty_booked= $other_charges_tax_id = $other_charges_input=
      $discount_type =$delivery_date  = $sales_note = '';
      $booked_date=show_date(date("d-m-Y"));
      $discount_input = $this->db->select("sales_discount")->get('db_sitesettings')->row()->sales_discount;
      $discount_input = ($discount_input==0) ? '' : $discount_input;
    }
    else{
      $q2 = $this->db->query("select * from db_booking where id=$sales_id");
      $customer_id=$q2->row()->customer_id;
      $booked_date=show_date($q2->row()->booked_date);
      $booking_status=$q2->row()->booking_status;
      // $warehouse_id=$q2->row()->warehouse_id;
      $delivery_date=$q2->row()->delivery_date;
      $qty_booked=$q2->row()->qty_booked;
      $reference_no=$q2->row()->reference_no;
      $discount_input=$q2->row()->discount_to_all_input;
      $discount_type=$q2->row()->discount_to_all_type;
      // $qty_taken=$q2->row()->qty_taken;
      $other_charges_input=$q2->row()->other_charges_input;
      $other_charges_tax_id=$q2->row()->other_charges_tax_id;
      $sales_note=$q2->row()->sales_note;

      $items_count = $this->db->query("select count(*) as items_count from db_bookeditems where sales_id=$sales_id")->row()->items_count;
    }
    
    ?>

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- **********************MODALS***************** -->
    <?php include"modals/modal_booking.php"; ?>
    <?php include"modals/modal_sales_item.php"; ?>
    <!-- **********************MODALS END***************** -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
         <h1>
            <?=$page_title;?>
            <small>Add/Update Supply</small>
         </h1>
         <ol class="breadcrumb">
            <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo $base_url; ?>booking"><?= $this->lang->line('booking_list'); ?></a></li>
            <li><a href="<?php echo $base_url; ?>booking/add">New Supply</a></li>
            <li class="active"><?=$page_title;?></li>
         </ol>
      </section>

    <!-- Main content -->
     <section class="content">
               <div class="row">
                <!-- ********** ALERT MESSAGE START******* -->
               <!-- ********** ALERT MESSAGE END******* -->
                  <!-- right column -->
                  <div class="col-md-12">
                     <!-- Horizontal Form -->
                     <div class="box box-info " >
                        <!-- style="background: #68deac;" -->
                        
                        <!-- form start -->
                         <!-- OK START -->
                        <?= form_open('#', array('class' => 'form-horizontal', 'id' => 'new-supply-form', 'enctype'=>'multipart/form-data', 'method'=>'POST'));?>
                           <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
                           <input type="hidden" value='1' id="hidden_rowcount" name="hidden_rowcount">
                           <input type="hidden" value='0' id="hidden_update_rowid" name="hidden_update_rowid">

                          

                              <div class="form-group">
                              <div class="col-sm-3">
                                 <label for="customer_id" class=" control-label"><?= $this->lang->line('supplier'); ?><label class="text-danger">*</label></label>
                               
                                    <div class="input-group">
                                       <select class="form-control select2 customer_id" id="customer_id" name="customer_id"  value="<?= $customer_id;?>" style="width: 100%;" onkeyup="shift_cursor(event,'mobile')">
                                          <?php
                                              
                                             $query1="select * from db_customers where status=1";
                                             $q1=$this->db->query($query1);
                                             if($q1->num_rows($q1)>0)
                                                { 
                                                 // echo "<option value=''>-Select-</option>";
                                                  foreach($q1->result() as $res1)
                                                {
                                                  $selected=($customer_id==$res1->id) ? 'selected' : '';
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
                                       <span class="input-group-addon pointer" data-toggle="modal" data-target="#booking-modal" title="New Customer?"><i class="fa fa-user-plus text-primary fa-lg"></i></span>
                                    </div>
                                    <span id="customer_id_msg" style="display:none" class="text-danger"></span>
                                 </div>
                                 <div class="col-sm-3">
                                 <label for="booked_date" class="control-label"><?= $this->lang->line('booked_date'); ?> <label class="text-danger">*</label></label>
                                
                                    <div class="input-group date">
                                       <div class="input-group-addon"> 
                                          <i class="fa fa-calendar"></i>
                                       </div>
                                       <input type="text" class="form-control pull-right datepicker"  id="booked_date" name="booked_date" readonly onkeyup="shift_cursor(event,'booking_status')" value="<?= $booked_date;?>">
                                    </div>
                                    <span id="booked_date_msg" style="display:none" class="text-danger"></span>
                                 </div>
                             
                                 <div class="col-sm-3">
                                 <label for="delivery_date" class="control-label"><?= $this->lang->line('delivery_date'); ?> <label class="text-danger">*</label></label>
                                
                                    <div class="input-group date">
                                       <div class="input-group-addon"> 
                                          <i class="fa fa-calendar"></i>
                                       </div>
                                       <input type="text" class="form-control pull-right datepicker"  id="delivery_date" name="delivery_date" onkeyup="shift_cursor(event,'delivery_date')" value="<?= $delivery_date;?>">
                                    </div>
                                    <span id="delivery_date_msg" style="display:none" class="text-danger"></span>
                                 </div>
                                
                                 </div>
                                 </div>
                           <!-- /.box-body -->
                           <div class="row">
                              <div class="col-xs-12 ">
                                 <div class="col-sm-12">
                                    <div class="box box-info">
                                       <!-- /.box-header -->
                                       <div class="box-body ">

                                          <style type="text/css">
                                             table.table-bordered > thead > tr > th {
                                             /* border:1px solid black;*/
                                             text-align: center;
                                             }
                                             .table > tbody > tr > td, 
                                             .table > tbody > tr > th, 
                                             .table > tfoot > tr > td, 
                                             .table > tfoot > tr > th, 
                                             .table > thead > tr > td, 
                                             .table > thead > tr > th 
                                             {
                                             padding-left: 2px;
                                             padding-right: 2px;  
                                              
                                             }
                                          </style>
                                         
                                          <table class="table table-bordered new_booking_supply_table" style="width:100%" id="new_booking_supply_table">
                                             <thead class="custom_thead">
                                                <tr class="bg-aqua" >
                                                <th rowspan='2' style="width:2%;justify-itmes:center;">#</th>
                                                <th rowspan='2' style="width:15%"><?= $this->lang->line('customer_name'); ?></th>

                                                   <th rowspan='2' style="width:15%"><?= $this->lang->line('bird_name'); ?></th>
                                                 
                                                   <th rowspan='2' style="width:10%"><?= $this->lang->line('quantity'); ?></th>
                                                   <th rowspan='2' style="width:10%"><?= $this->lang->line('qty_left'); ?></th> 
                                                  
                                                </tr>
                                             </thead>
                                             <tbody class="row_content" id="new_supply">
                                               
                              
                                <td>
                                <button style="justify-itmes:center;font-size:15px;"  type="button" id="remove_item" class="btn btn-sm btn-info remove_item"><i class="fa fa-close"></i></button>
                                </td>
                                <td>
                                  <div class="input-group col-sm-12 form-material floating " data-plugin="formMaterial">
                                       <select class="form-control select2 customer_id[]" id="customer_id" name="customer_id"  value="<?= $customer_id;?>" style="width: 100%;" onkeyup="shift_cursor(event,'mobile')">
                                        <option value="">---Select Customer---</option>
                                       </select>
                                    </div>
                                    <span id="customer_id_msg" style="display:none" class="text-danger"></span>
                                 </td>
                                 <td>
                                 <div class="input-group col-sm-12">
                                       <input type="text" class="form-control pull-right "   name="item_id[]"  >
                                    </div>
                                    <span id="booked_date_msg" style="display:none" class="text-danger"></span>
                                 </td>
                                 <td>
                                <input type="text" class="form-control pull-right " id="qty"  name="qty[]"  >
                                       
                                    <span id="qty_msg" style="display:none" class="text-danger"></span>
                                 </td>
                                 <td>
                                
                                    <div class="input-group col-sm-12">
                                       <input type="text" class="form-control pull-right"  id="qty_left" name="qty_left[]" >
                                       <input type="hidden" class="form-control pull-right"  id="reference_no" name="reference_no[]" >
                                    </div>
                                    <span id="delivery_date_msg" style="display:none" class="text-danger"></span>
                                
                                
                                 </td>
                                   </tbody>
                                    <tfoot class="foot">
                                      <tr>
                                      <td>
                                      <button style="justify-itmes:center;font-size:15px;"  type="button" id="add_item" class="btn btn-sm btn-info add_item"><i class="fa fa-plus"></i></button>
                                      </td>
                                    </tr>
                                    </tfoot>
                                </table>
                              </div>
                                       <!-- /.box-body -->
                                    </div>
                                 </div>
                                 <!-- /.box -->
                              </div>
                              
                            
                               
                              

          
                           </div>
                           
                           <!-- /.box-body -->
                           <div class="box-footer col-sm-12">
                              <center>
                                <?php
                                if(isset($sales_id)){
                                  $btn_id='update';
                                  $btn_name="Update";
                                  echo '<input type="hidden" name="sales_id" id="sales_id" value="'.$sales_id.'"/>';
                                }
                                else{
                                  $btn_id='save';
                                  $btn_name="Save";
                                }

                                ?>
                                 <div class="col-md-3 col-md-offset-3">
                                    <button type="button" id="<?php echo $btn_id;?>" class="btn bg-orange btn-block btn-flat btn-lg payments_modal" title="Save Data"><?php echo $btn_name;?></button>
                                 </div>
                                 <div class="col-sm-3"><a href="<?= base_url()?>dashboard">
                                    <button type="button" class="btn bg-red btn-block btn-flat btn-lg" title="Go Dashboard">Close</button>
                                  </a>
                                </div>
                              </center>
                           </div>

                           

                           <?= form_close(); ?>
                           <!-- OK END -->
                     </div>
                  </div>
                  <!-- /.box-footer -->
                 
               </div>
               <!-- /.box -->
             </section>
            <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
 <?php include"footer.php"; ?>
<!-- SOUND CODE -->
<?php include"comman/code_js_sound.php"; ?>
<!-- GENERAL CODE -->
<?php include"comman/code_js_form.php"; ?>

<script src="<?php echo $theme_link; ?>js/modals.js"></script>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

      <script src="<?php echo $theme_link; ?>js/booking_list.js"></script>  
      <script>
         
$(document).on('click', '.add_item', function(){
var elem = $('.new_booking_supply_table tbody').find('tr:first').clone();
var input_elem = $('.row_content').find('tr:last');
var val = input_elem.find('input').val();
      $('.row_content').append(elem);
});

$(document).on('click', '.remove_item', function(){
  
  if($('.new_booking_supply_table .row_content').find('tr').length > 1){
    $(this).parents('tr').remove();
  }

});
         //Initialize Select2 Elements
             $(".select2").select2();
         //Date picker
             $('.datepicker').datepicker({
               autoclose: true,
            format: 'dd-mm-yyyy',
              todayHighlight: true
             });
          
    

         /* ---------- CALCULATE TAX -------------*/
         function calculate_tax(i){ //i=Row
            set_tax_value(i);

           //Find the Tax type and Tax amount
           var tax_type = $("#tr_tax_type_"+i).val();
           var tax_amount = $("#td_data_"+i+"_11").val();

           var qty=$("#td_data_"+i+"_3").val().trim();
           var sales_price=parseFloat($("#td_data_"+i+"_10").val().trim());
           $("#td_data_"+i+"_4").val(sales_price);
           var discount=$("#td_data_"+i+"_8").val().trim();

           //Discount on All
           var discount_input = (isNaN(parseFloat($("#discount_to_all_input").val()))) ? 0 : parseFloat($("#discount_to_all_input").val());
           if(discount_input>0){
              discount=0;
           }

           discount   =(isNaN(parseFloat(discount)))    ? 0 : parseFloat(discount);

           var amt=parseFloat(qty) * sales_price;//Taxable
           var discount_amt=((amt) * discount)/100;

           var total_amt=amt-discount_amt;
           total_amt = (tax_type=='Inclusive') ? total_amt : parseFloat(total_amt) ;
           
           //Set Unit cost
           var per_unit_discount = (sales_price)*discount/100;
           var per_unit_total    = sales_price - per_unit_discount;
           $("#td_data_"+i+"_9").val('').val(total_amt.toFixed(2));
           //alert("calculate_tax() end");
           final_total();
           
         }
      
        
         /* ---------- CALCULATE GST END -------------*/

        
         /* ---------- Final Description of amount ------------*/
         function final_total(){
           
            
           var rowcount=$("#hidden_rowcount").val();
           var subtotal=parseFloat(0);
           
           var other_charges_per_amt=parseFloat(0);
           var other_charges_total_amt=0;
           var taxable=0;
          if($("#other_charges_input").val()!=null && $("#other_charges_input").val()!=''){
             
              other_charges_tax_id =$('option:selected', '#other_charges_tax_id').attr('data-tax');
             other_charges_input=$("#other_charges_input").val();
             if(other_charges_tax_id>0){

               other_charges_per_amt=(other_charges_tax_id * other_charges_input)/100;
             }
             
             taxable=parseFloat(other_charges_per_amt)+parseFloat(other_charges_input);//Other charges input
             other_charges_total_amt=parseFloat(other_charges_per_amt)+parseFloat(other_charges_input);
           }
           else{
             //$("#other_charges_amt").html('0.00');
           }
           
           var qty_taken =0;
          if($("#qty_taken").val()!=null && $("#qty_taken").val()!=''){
             
            //   other_charges_tax_id =$('option:selected', '#other_charges_tax_id').attr('data-tax');
              qty_taken=$("#qty_taken").val();
            //  if(other_charges_tax_id>0){

            //    other_charges_per_amt=(other_charges_tax_id * qty_taken)/100;
            //  }
             
            //  taxable=parseFloat(other_charges_per_amt);//Other charges input
            //  other_charges_total_amt=parseFloat(other_charges_per_amt);

            //  qty_taken=parseFloat(other_charges_per_amt)+parseFloat(qty_taken);
           }
           else{
             //$("#other_charges_amt").html('0.00');
           }
           
         
           var tax_amt=0;
           var actual_taxable=0;
           var total_quantity=0;
           var total_quantity_left = 0;
           var chicks_bookes = 0;
         


           for(i=1;i<=rowcount;i++){
         
             if(document.getElementById("td_data_"+i+"_3")){
               //customer_id must exist
               if($("#td_data_"+i+"_3").val()!=null && $("#td_data_"+i+"_3").val()!=''){
                    actual_taxable=actual_taxable+ + +(parseFloat($("#td_data_"+i+"_13").val()).toFixed(2) * parseFloat($("#td_data_"+i+"_3").val()));
                    subtotal=subtotal+ + +parseFloat($("#td_data_"+i+"_9").val()).toFixed(2);
                    if($("#td_data_"+i+"_7").val()>=0){
                      tax_amt=tax_amt+ + +$("#td_data_"+i+"_7").val();
                    }   
                    total_quantity +=parseFloat($("#td_data_"+i+"_3").val().trim());
                    total_quantity_left +=parseFloat($("#td_data_"+i+"_3").val().trim());
                    chicks_bookes +=parseFloat($("#td_data_"+i+"_3").val().trim());
                }
                   
             }//if end
           }//for end
              //  Due on chicks

            //   total_chicks_left=chicks_left - qty_taken;
              
               $(".qty_booked").val(total_quantity); 
          
         //Show total Sales Quantitys
         $(".total_quantity").html(total_quantity);

//Apply Output on screen
//subtotal
if((subtotal!=null || subtotal!='') && (subtotal!=0)){
  
  //subtotal
  $("#subtotal_amt").html(subtotal.toFixed(2));
  
  //other charges total amount
  $("#other_charges_amt").html(parseFloat(other_charges_total_amt).toFixed(2));
  
  //other charges total amount
 

  taxable=taxable+subtotal;
  
  //discount_to_all_amt
 // if($("#discount_to_all_input").val()!=null && $("#discount_to_all_input").val()!=''){
      var discount_input=parseFloat($("#discount_to_all_input").val());
      discount_input = isNaN(discount_input) ? 0 : discount_input;
      var discount=0;
      if(discount_input>0){
          var discount_type=$("#discount_to_all_type").val();
          if(discount_type=='in_fixed'){
            taxable-=discount_input;
            discount=discount_input;
            //Minus
          }
          else if(discount_type=='in_percentage'){
              discount=(taxable*discount_input)/100;
             taxable-=discount;
  
          }
      }
      else{
         //discount += $("#")
      }
        discount=parseFloat(discount).toFixed(2);
        
         $("#discount_to_all_amt").html(discount);  
         $("#hidden_discount_to_all_amt").val(discount);  
  //}
  //subtotal_round=Math.round(taxable);
  subtotal_round=round_off(taxable);//round_off() method custom defined
  subtotal_diff=subtotal_round-taxable;

  $("#round_off_amt").html(parseFloat(subtotal_diff).toFixed(2)); 
  $("#total_amt").html(parseFloat(subtotal_round).toFixed(2)); 
  $("#hidden_total_amt").val(parseFloat(subtotal_round).toFixed(2)); 
}
else{
  $("#subtotal_amt").html('0.00'); 
  $("#tax_amt").html('0.00'); 
  $("#round_off_amt").html('0.00'); 
  $("#total_amt").html('0.00'); 
  $("#amount").val('0.00');
  $("#hidden_total_amt").html('0.00'); 
  $("#discount_to_all_amt").html('0.00'); 
  $("#hidden_discount_to_all_amt").html('0.00'); 
  $("#subtotal_amt").html('0.00'); 
  $("#other_charges_amt").html('0.00');  
}

// adjust_payments();
//alert("final_total() end");
}
/* ---------- Final Description of amount end ------------*/

function removerow(id){//id=Rowid

$("#row_"+id).remove();
final_total();
failed.currentTime = 0;
failed.play();
}
    


function enable_or_disable_item_discount(){
var discount_input=parseFloat($("#discount_to_all_input").val());
discount_input = isNaN(discount_input) ? 0 : discount_input;
if(discount_input>0){
$(".item_discount").attr({
'readonly': true,
'style': 'border-color:red;cursor:no-drop',
});
}
else{
$(".item_discount").attr({
'readonly': false,
'style': '',
});
}

var rowcount=$("#hidden_rowcount").val();
for(k=1;k<=rowcount;k++){
if(document.getElementById("tr_item_id_"+k)){
calculate_tax(k);
}//if end
}//for end

//final_total();
}

//Sale Items Modal Operations Start
function show_sales_item_modal(row_id){
$('#sales_item').modal('toggle');
$("#popup_tax_id").select2();

//Find the item details
var item_name = $("#td_data_"+row_id+"_1").html();
var tax_type = $("#tr_tax_type_"+row_id).val();
var tax_id = $("#tr_tax_id_"+row_id).val();
var description = $("#description_"+row_id).val();

//Set to Popup
$("#popup_item_name").html(item_name);
$("#popup_tax_type").val(tax_type).select2();
$("#popup_tax_id").val(tax_id).select2();
$("#popup_description").val(description);
$("#popup_row_id").val(row_id);
}

function set_info(){
var row_id = $("#popup_row_id").val();
var tax_type = $("#popup_tax_type").val();
var tax_id = $("#popup_tax_id").val();
var description = $("#popup_description").val();
var tax_name = ($('option:selected', "#popup_tax_id").attr('data-tax-value'));
var tax = parseFloat($('option:selected', "#popup_tax_id").attr('data-tax'));

//Set it into row 
$("#tr_tax_type_"+row_id).val(tax_type);
$("#tr_tax_id_"+row_id).val(tax_id);
$("#tr_tax_value_"+row_id).val(tax);//%
$("#description_"+row_id).val(description);
$("#td_data_"+row_id+"_12").html(tax_name);

calculate_tax(row_id);
$('#sales_item').modal('toggle');
}
function set_tax_value(row_id){
//get the sales price of the item
var tax_type = $("#tr_tax_type_"+row_id).val();
var tax = $("#tr_tax_value_"+row_id).val(); //%
var qty=$("#td_data_"+row_id+"_3").val().trim();
qty = (isNaN(qty)) ? 0 :qty;
var sales_price = parseFloat($("#td_data_"+row_id+"_10").val());
sales_price = (isNaN(sales_price)) ? 0 :sales_price;
sales_price = sales_price * qty;

var tax_amount = (tax_type=='Inclusive') ? calculate_inclusive(sales_price,tax) : calculate_exclusive(sales_price,tax);
console.log("tax_amount="+tax_amount);
$("#td_data_"+row_id+"_11").val(tax_amount);
}
//Sale Items Modal Operations End

</script>


<!-- UPDATE OPERATIONS -->
<script type="text/javascript">
<?php if(isset($sales_id)){ ?> 
  $(document).ready(function(){
     var base_url='<?= base_url();?>';
     var sales_id='<?= $sales_id;?>';
     $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
     $.post(base_url+"booking/return_sales_list/"+sales_id,{},function(result){
       //alert(result);
       $('#booking_table tbody').append(result);
       $("#hidden_rowcount").val(parseFloat(<?=$items_count;?>)+1);
       success.currentTime = 0;
       success.play();
       enable_or_disable_item_discount();
       $(".overlay").remove();
   }); 
  });
<?php }?>
</script>
<!-- UPDATE OPERATIONS end-->

<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
</body>
</html>
