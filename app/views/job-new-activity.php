<!DOCTYPE html>
<html>

<head>
<!-- TABLES CSS CODE -->
<?php include"comman/code_css_form.php"; ?>
<?php include"comman/code_css_datatable.php"; ?>
<style>
    #expense_cartitems{
        display:none;
    }
</style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
        <?php include"sidebar.php"; ?>
<?php 
if(!isset($q_id)){
  $activity_name  = $activity_date = $purchase_status = $other_charges_input =$total_input_mat_plus_exp = $short_name =
  $reference_no  =  $sales_unite_id = $input_total = $unit = $total_quantity =
  $other_charges_input          = $input_total = $total_cost=$category_id=$payment_type=
  $input_items_total = $total_quantity  = $description='';
  $activity_date=show_date(date("d-m-Y"));
}
else{
  $q2 = $this->db->query("select * from db_jobs where id=$q_id");
  $job_name=$q2->row()->job_name;
  $reference_no=$q2->row()->reference_no;
  // $activity_date=$q2->row()->job_date;

  // $items_count = $this->db->query("select count(*) as items_count from db_purchaseitems where purchase_id=$purchase_id")->row()->items_count;
}
$activity_date = show_date(date("d-m-Y"));
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"style="padding:2px;height:auto;background-color: #fff;">
      <section class="content-header" style="padding: 15px;">
        <h1>
            <?= $this->lang->line('new_activity'); ?>
            <small>View/Create Activity</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?= $this->lang->line('manufacturing_list'); ?></li>
        </ol>
    </section>
    
   

  <!-- Main content -->
  <section class="content">
               <div class="row">
                <!-- ********** ALERT MESSAGE START******* -->
               <?php include"comman/code_flashdata.php"; ?>
               <!-- ********** ALERT MESSAGE END******* -->
                  <!-- right column -->
                  <div class="col-md-12">
                     <!-- Horizontal Form -->
        <div class="col-md-11" style="padding: 15px;box-shadow: 3px 1px 9px 3px black;margin-left: 30px;">
            <div class="">
              <!-- form start -->
              <?= form_open('#', array('class' => 'form-horizontal', 'id' => 'activities-form', 'enctype'=>'multipart/form-data', 'method'=>'POST'));?>
              <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
                <input type="hidden" value='1' id="hidden_rowcount" name="hidden_rowcount">
                <input type="hidden" value='0' id="hidden_update_rowid" name="hidden_update_rowid">
                <input type="hidden" value='<?php echo $q_id?>' id="job_id" name="job_id" >

                <div class="col-md-12">
                <div class="row form-group">
                  <div class=" col-sm-4">
                    <label for="activity name"><?= $this->lang->line('activity_name'); ?></label>
                    <input type="text" class="form-control" id="activity_name" name="activity_name" placeholder="Enter Activity name"readonly value="<?php echo $job_name?>">
                  </div>
                  <div class=" col-sm-4">
                    <label for="reference number"><?= $this->lang->line('reference_no'); ?></label>
                    <input type="text" class="form-control" id="reference_no" name="reference_no" placeholder="Enter Activity name"readonly value="<?php echo $reference_no?>">
                  </div>
                  <div class="col-sm-4 ">
                    <label for="exampleInputPassword1">Date</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right datepicker"  id="activity_date" name="activity_date" readonly value="<?php echo $activity_date?>">
                      <span id="activity_date_msg" style="display:none" class="text-danger"></span>
                    </div>
                </div>
                  </div>
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
                  <div class="col-md-8 col-md-offset-2 d-flex justify-content" >
                        <div class="input-group">
                        <span class="input-group-addon" title="Select Items"><i class="fa fa-barcode"></i></span>
                            <input type="text" class="form-control " placeholder="Raw Material (Input Items Search)" id="item_search">
                        </div>
                    </div>
                    <br> 
                     <br>
                    <table class="table table-hover " style="width:100%" id="manufacturing_table">
                      <thead class="custom_thead">
                        <tr class="bg-primary" >
                            <th rowspan='2' style="width:15%"><?= $this->lang->line('item_name'); ?></th>
                            <!-- <th rowspan='2' style="width:10%"><?= $this->lang->line('measurment_unit'); ?></th> -->
                            <th rowspan='2' style="width:15%"><?= $this->lang->line('quantity'); ?></th>
                            <th rowspan='2' style="width:10%"><?= $this->lang->line('stock'); ?></th>
                            <th rowspan='2' style="width:7.5%"><?= $this->lang->line('unit_cost'); ?>(<?=$CURRENCY;?>)</th>
                            <th rowspan='2' style="width:7.5%"><?= $this->lang->line('total_amount'); ?>(<?=$CURRENCY;?>)</th>
                            <th rowspan='2' style="width:5%"><?= $this->lang->line('action'); ?></th>
                        </tr>
                      </thead>
                      <tbody> 
                        
                      </tbody>
                  </table>

               </div>
                
               <div class="col-sm-12">
                <div class="row">
                <div class="col-sm-4">
                    <h4>Raw Material Total cost</h4>
                </div>
                <div class="col-sm-6">
                    <input type="number" class="form-control" id="input_items_total" readonly name="input_items_total">
                </div>
                </div>
                </div>

                    <div class="col-sm-12">
                    <table style="width:100%" class="table table-bordered full-color-table hover-table" id="expense_cartitems">
                        <thead>
                        <tr>
                        <th rowspan='2' style="width:15%">Expense Category</th>
                        <th rowspan='2' style="width:7.5%"> Expense Amount</th>
                        <th rowspan='2' style="width:15%">Description</th>
                        <th rowspan='2' style="width:15%"><?= $this->lang->line('payment_type'); ?></th>
                        <th rowspan='2' style="width:5%">Action</th>
                        </tr>
                    </thead>
                    <tbody class="expens_on_activity">
                      <td rowspan='3'>
                      <div class="form-group">
                 
                  <div class="col-sm-12">
                      <select class="form-control select2" id="category_id" name="category_id"  style="width: 100%;" onkeyup="shift_cursor(event,'expense_for')" value="<?php print $category_id; ?>">
                        <?php
                        $query1="select * from db_expense_category where status=1";
                        $q1=$this->db->query($query1);
                        if($q1->num_rows($q1)>0)
                         {  echo '<option value="">-Select-</option>'; 
                             foreach($q1->result() as $res1)
                           { 
                             $selected = ($category_id==$res1->id)? 'selected' : '';
                             echo "<option $selected value='".$res1->id."'>".$res1->category_name."</option>";
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
                      <span id="category_id_msg" style="display:none" class="text-danger"></span>
                              </div>
                              </div>
                      </td>
                     
                      <td><input type="text" class="form-control text-right only_currency" id="other_charges_input" name="other_charges_input" onkeyup="final_total();" value="<?php //echo  $other_charges_input; ?>"></td>
                        
                        <td><input type="text" class="form-control" name="description"></td>
                        <td >
                       <div class="form-group">
                      <div class="col-sm-12">
                      <select class="form-control select2" id='payment_type' name="payment_type" style="width: 100%;" >
                        <?php
                          $q1=$this->db->query("select * from db_paymenttypes where status=1");
                            if($q1->num_rows()>0){
                              echo "<option value=''>-Select-</option>";
                                foreach($q1->result() as $res1){
                                echo "<option value='".$res1->payment_type."'>".$res1->payment_type ."</option>";
                              }
                            }
                            else{
                              echo "<option>None</option>";
                            }
                          ?>
                      </select>
                      <span id="payment_type_msg" style="display:none" class="text-danger"></span>
                    </div>
                </div>
                       </td>
                        <td><a style="color:#fff;" class="btn btn-sm btn-danger remove_item pull-right" title="" data-item-id="101846" data-toggle="tooltip" ><i class="fa fa-solid fa-trash"></i></a></td>
                       
                    </tbody>
                    </table>
                    <button type="button" onclick="show_hide()" class="expense_modal_btn btn btn-sm btn-warning" id="add">Add other Expense to List</a>
                    </div>
                <!-- </div> -->

                <div class="row">
                    <div class="col-sm-4">
                    <h4>Expense Total cost</h4>
                    </div>
                    <div class="col-sm-6">
                    <h4>
                    <?= $CI->currency('<b id="other_charges_amt" name="other_charges_amt">0.00</b>'); ?>
                  </h4>
                    <!-- <input type="number" class="form-control" readonly="" id="other_charges_amt" name="expense_total"> -->
                    </div>
                <!-- </div> -->

                <br />
            <div class="row">
                <div class="col-sm-4">
                <h4 style="margin-top:-4px;">Total Value (Raw Material + Expense)</h4>
                </div>
                <div class="col-sm-6">
                <input type="number" class="form-control" readonly="" name="total_input_mat_plus_exp" id="total_input_mat_plus_exp" >
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 block12">
                <h4 style="color:green;">Finished Goods (Output Item)</h4>
                    <table class="table table-bordered full-color-table hover-table" id="">
                    <thead>
                    <tr>
                        <th class="sr hide">#</th>
                        <th class="unit">Select Job Product</th>
                        <th class="unit">Measuring Unit</th>
                        <th class="qty">Qty</th>
                        <th class="status"></th>
                    </tr>
                    </thead>
                    <tbody >
                    <td>
                    <select class="form-control select2" id='fin_item_id' name="fin_item_id">
                        <?php
                          $q1=$this->db->query("select * from db_items where status=1");
                            if($q1->num_rows()>0){
                              echo "<option value=''>-Select-</option>";
                                foreach($q1->result() as $res1){
                                echo "<option value='".$res1->id."'>".$res1->item_name ."</option>";
                              }
                            }
                            else{
                              echo "<option>None</option>";
                            }
                          ?>
                      </select>
                    </td>
                    <td><input type="text" class="form-control" readonly name="unit"value="KG"></td>
                        <td><input type="number" readonly class="form-control total_quantity " name="total_quantity"></td>
                        
                    </tbody>
                    </table>
               
           
            </div>
            </div>

            <div class="card-footer">

            
                <?php
                if(isset($qa_id)){
                  $btn_id='update';
                  $btn_name="Update";
                  echo '<input type="text" name="purchase_id" id="purchase_id" value="'.$q_id.'"/>';
                }
                else{
                  $btn_id='save';
                  $btn_name="Save";
                }

                ?>
                  <div class="col-md-3 col-md-offset-3">
                    <button type="button" id="<?php echo $btn_id;?>" class="btn bg-maroon btn-block btn-flat btn-lg payments_modal" title="Save Data"><?php echo $btn_name;?></button>
                  </div>
                  <div class="col-sm-3"><a href="<?= base_url()?>dashboard">
                    <button type="button" class="btn bg-gray btn-block btn-flat btn-lg" title="Go Dashboard">Close</button>
                  </a>
                </div>
            </div>
            <?= form_close(); ?>
    </div>
    </div>
    <!-- /.card -->
    



</div>


    <?php include"footer2.php"; ?>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- SOUND CODE -->
<?php include"comman/code_js_sound.php"; ?>
<!-- TABLES CODE -->
<?php include"comman/code_js_form.php"; ?>

<script src="<?php echo $theme_link; ?>js/activities.js"></script>
<!-- <script src="<?php echo $theme_link; ?>js/jobs.js"></script> -->
<script type="text/javascript">

    //Initialize Select2 Elements
    $(".select2").select2();
    
    $(document).on('click', "#add", function(){
        var elem = $('#expense_cartitems tbody').find('tr:first');
        var input_elem = $('.expens_on_activity').find('tr:last-child');
        var val = input_elem.find('input').val();
        $('.expens_on_activity').append(elem);
    });

    $(document).on('click', ".remove_item", function(){
        if($('#expense_cartitems .expens_on_activity').find('tr').length > 0){
            $(this).parents('tr').remove();
        }
    });
    $(document).on('click', ".add_items_btn", function(){
        var mat = $(".row_materials tbody").find('tr:first');
        var input_mat = $(".input_raw_material").find("tr:last");
        var data = input_mat.find('input').val();
        $(".input_raw_material").append(mat);
    });
     
  
</script>
<script>
         $(".close_btn").click(function(){
           if(confirm('Are you sure you want to navigate away from this page?')){
               window.location='<?php echo $base_url; ?>dashboard';
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
           var tax_amount = $("#td_data_"+i+"_5").val();
           console.log("tax_amount=="+tax_amount);

           var qty=$("#td_data_"+i+"_3").val().trim();
           var purchase_price=parseFloat($("#td_data_"+i+"_4").val().trim());
           var discount=$("#td_data_"+i+"_8").val().trim();
           var tax=$("#tr_tax_value_"+i).val().trim();

           //Discount on All
           var discount_input = (isNaN(parseFloat($("#discount_to_all_input").val()))) ? 0 : parseFloat($("#discount_to_all_input").val());
           if(discount_input>0){
              discount=0;
           }

           //var tax=$('option:selected', "#td_data_"+i+"_15").attr('data-tax');
           //var tax=$("#tr_tax_value_"+i).val().trim();

           //tax        =(isNaN(parseFloat(tax)))         ? 0 : parseFloat(tax);
           discount   =(isNaN(parseFloat(discount)))    ? 0 : parseFloat(discount);

           var amt=parseFloat(qty) * purchase_price;//Taxable
           //var tax_amt=parseFloat((amt * tax)/100);
           var discount_amt=((amt) * discount)/100;

           var total_amt=amt-discount_amt;
           total_amt = (tax_type=='Inclusive') ? total_amt : parseFloat(total_amt) + parseFloat(tax_amount);
           console.log("total_amt=="+total_amt);
           //Set Unit cost
           
           //CAlculate Item wise price and tax and discount
           var tax_each = (tax_type=='Inclusive') ? 0 : calculate_exclusive(purchase_price,tax);
           
           var per_unit_total    = parseFloat(purchase_price)+parseFloat(tax_each);

           $("#td_data_"+i+"_10").val('').val(per_unit_total.toFixed(2));

          // $("#td_data_"+i+"_5").val('').val(tax_amount.toFixed(2));
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
             $("#other_charges_amt").val('0.00');
           }
           
         
           var tax_amt=0;
           var actual_taxable=0;
           var total_quantity=0;
         
           for(i=1;i<=rowcount;i++){
         
             if(document.getElementById("td_data_"+i+"_3")){
               //supplier_id must exist
               if($("#td_data_"+i+"_3").val()!=null && $("#td_data_"+i+"_3").val()!=''){
                    actual_taxable=actual_taxable+ + +(parseFloat($("#td_data_"+i+"_13").val()).toFixed(2) * parseFloat($("#td_data_"+i+"_3").val()));
                    subtotal=subtotal+ + +parseFloat($("#td_data_"+i+"_9").val()).toFixed(2);
                    if($("#td_data_"+i+"_7").val()>=0){
                      tax_amt=tax_amt+ + +$("#td_data_"+i+"_7").val();
                    }   
                    total_quantity +=parseFloat($("#td_data_"+i+"_3").val().trim());
                }
                   
             }//if end
           }//for end
           
          
          //Show total Purchase Quantitys
           $(".total_quantity").html(total_quantity);
           $(".total_quantity").val(total_quantity);

           //Apply Output on screen
           //subtotal
           if((subtotal!=null || subtotal!='') && (subtotal!=0)){
             
             //subtotal
             $("#input_items_total").val(subtotal.toFixed(2));
             
             //other charges total amount
             $("#other_charges_amt").html(parseFloat(other_charges_total_amt).toFixed(2));
             $("#other_charges_amt").val(parseFloat(other_charges_total_amt).toFixed(2));
             
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
             var total_input_mat_plus_exp =0;
             //subtotal_round=Math.round(taxable);
             subtotal_round=round_off(taxable);//round_off() method custom defined
             subtotal_diff=subtotal_round-taxable;

             total_input_mat_plus_exp = (subtotal_round);
         console.log(total_input_mat_plus_exp);
             $("#round_off_amt").html(parseFloat(subtotal_diff).toFixed(2)); 
             $("#total_amt").html(parseFloat(subtotal_round).toFixed(2)); 
            //  $("#input_items_total").val(parseFloat(subtotal_round).toFixed(2)); 
             $("#hidden_total_amt").val(parseFloat(subtotal_diff).toFixed(2)); 
             $("#total_input_mat_plus_exp").val(parseFloat(total_input_mat_plus_exp).toFixed(2)); 
             calculate()
            }
           else{
             $("#subtotal_amt").html('0.00'); 
             
             $("#tax_amt").html('0.00'); 
           }
           
          // adjust_payments();
          //alert("final_total() end");
         }
 // calculate  expense
      function calculate(amt){
        // final_total();
        var item_cost = amt;
        var amount_paid = item_cost;
        var tot_ex = item_cost;
        $(".item_total_cost").val(amount_paid);
        $(".total_expense").val(amount_paid)
        // $("#total_input_mat_plus_exp").val(amount_paid) + parseFloat(total_input_mat_plus_exp).toFixed(2) *1;
        
      }
    $(".item_cost").keyup(function(){
    var item_cost = $(this).val();
    
    calculate(item_cost);
    })
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
         console.log("Hello="+k);
         calculate_tax(k);
       }//if end
     }//for end

      //final_total();
    }


    //Purchase Items Modal Operations Start
    function show_purchase_item_modal(row_id){
      $('#purchase_item').modal('toggle');
      $("#popup_tax_id").select2();

      //Find the item details
      var item_name = $("#td_data_"+row_id+"_3").html();
      var tax_type = $("#tr_tax_type_"+row_id).val();
      var tax_id = $("#tr_tax_id_"+row_id).val();

      //Set to Popup
      $("#popup_item_name").html(item_name);
      $("#popup_tax_type").val(tax_type).select2();
      $("#popup_tax_id").val(tax_id).select2();
      $("#popup_row_id").val(row_id); 
    }

    function set_info(){
      var row_id = $("#popup_row_id").val();
      var tax_type = $("#popup_tax_type").val();
      var tax_id = $("#popup_tax_id").val();
      var tax_name = ($('option:selected', "#popup_tax_id").attr('data-tax-value'));
      var tax = parseFloat($('option:selected', "#popup_tax_id").attr('data-tax'));

      //Set it into row 
      $("#tr_tax_type_"+row_id).val(tax_type);
      $("#tr_tax_id_"+row_id).val(tax_id);
      $("#tr_tax_value_"+row_id).val(tax);//%
      $("#td_data_"+row_id+"_15").html(tax_name);
      
      calculate_tax(row_id);
      $('#purchase_item').modal('toggle');
    }
    function set_tax_value(row_id){
      //get the purchase price of the item
      var tax_type = $("#tr_tax_type_"+row_id).val();
      var tax = $("#tr_tax_value_"+row_id).val(); //%
      var qty=$("#td_data_"+row_id+"_3").val().trim();
          qty = (isNaN(qty)) ? 0 :qty;
      var purchase_price = parseFloat($("#td_data_"+row_id+"_4").val());
          purchase_price = (isNaN(purchase_price)) ? 0 :purchase_price;
          purchase_price = purchase_price * qty;

      var tax_amount = (tax_type=='Inclusive') ? calculate_inclusive(purchase_price,tax) : calculate_exclusive(purchase_price,tax);
      console.log("tax_amount="+tax_amount);
      $("#td_data_"+row_id+"_5").val(tax_amount);
    }

  
    //Purchase Items Modal Operations End  
</script>
      <!-- UPDATE OPERATIONS -->
      <script type="text/javascript">
         <?php if(isset($purchase_id)){ ?> 
             $(document).ready(function(){
                var base_url='<?= base_url();?>';
                var purchase_id='<?= $purchase_id;?>';
                $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
                $.post(base_url+"purchase/return_purchase_list/"+purchase_id,{},function(result){
                  //alert(result);
                  $('#purchase_table tbody').append(result);
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
