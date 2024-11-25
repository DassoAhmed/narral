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
            <small>Add/Update Category</small>
         </h1>
         <ol class="breadcrumb">
            <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo $base_url; ?>categories"><?= $this->lang->line('add_category'); ?></a></li>
            <li><a href="<?php echo $base_url; ?>categories/add">Ceate Category</a></li>
            <li class="active"><?=$page_title;?></li>
         </ol>
      </section>
      <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">Please Enter Valid Data</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" class="form-control" id="cat_name"name="category" placeholder="Enter Category here...">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <textarea cols="4" type="text" name="description" class="form-control" rows="3"></textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Save</button>
                  <button type="submit" class="btn btn-warning">Close</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

        
      

          </div>
        
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  
  <!-- /.content-wrapper -->
  </div>
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

      <script src="<?php echo $theme_link; ?>js/booking.js"></script>  
      <script>
         
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
