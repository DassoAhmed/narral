<!DOCTYPE html>
<html>

<head>
<!-- TABLES CSS CODE -->
<?php include"comman/code_css_form.php"; ?>
<!-- iCheck -->
  <link rel="stylesheet" href="<?php echo $theme_link; ?>plugins/iCheck/square/blue.css">

  <style type="text/css">
    .select2-container--default .select2-selection--single{
      border-radius: 0px;
    } 
    /*LEFT SIDE: ITEMS TABLE*/
    .table-striped > tbody > tr:nth-of-type(2n+1) {
      background-color: #ede3e3;
    }
    .table-striped > tbody > tr {
      background-color: #ddc8c8;
    }
 
    /*SET TOTAL FONT*/
    .tot_qty, .tot_amt, .tot_disc, .tot_grand, .tot_layers, .total_briolers, .total_eggs {
      font-size: 19px;
      color: #023763 ;
    }
    /*CURSOR POINTER CLASS*/
    .pointer{
      cursor:pointer;
    }
    .navbar-nav > .user-menu > .dropdown-width-lg{
      width: 350px;
    }
    .header-custom{
      background-image: -webkit-gradient(linear, left top, right top, from(#20b9ae), to(#006fd6)); color: white;
    }
    .border-custom-bottom{
      border-bottom: 1px solid;
      padding-top: 10px;
      padding-bottom: 5px;
    }
    .custom-font-size{
      font-size: 22px;
    }
    .search_item{
      text-transform: uppercase;
      font-size: 10px;
      color: #000000;
      text-align: center;
      text-overflow: hidden;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
    }
    .item_image{
      min-width: 70px;
      min-height:  70px;
      max-width: 70px;
      max-height:  70px;
    }
    .item_box{
      border-top:none;
    }
  </style>
</head>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
  <script type="text/javascript">
    if(theme_skin!='skin-blue'){
      $("body").addClass(theme_skin);
      $("body").removeClass('skin-blue');
    }
    if(sidebar_collapse=='true'){
      $("body").addClass('sidebar-collapse');
    }
  </script> 
  <?php $CI =& get_instance(); ?>
<div class="wrapper">
  
  
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo $base_url; ?>dashboard" class="navbar-brand" title="Go to Dashboard!"><b class="hidden-xs"><?php  echo $SITE_TITLE;?></b><b class="hidden-lg">POS</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse"> 
          <ul class="nav navbar-nav">
            <?php if($CI->permissions('sales_view')) { ?>
            <li class=""><a href="<?php echo $base_url; ?>booking" title="View Sales List!"><i class="fa fa-list text-yellow" ></i> <span><?= $this->lang->line('booking_list'); ?></span></a></li>
            <?php } ?>
            <?php if($CI->permissions('sales_add')) { ?>
            <li class=""><a href="<?php echo $base_url; ?>booking/new_supply" title="Create New POS Invoice"><i class="fa fa-calculator text-yellow " ></i> <span><?= $this->lang->line('new_invoice'); ?></span></a></li>
            <?php } ?>
            <?php if($CI->permissions('items_view')) { ?>
            <li class=""><a href="<?php echo $base_url; ?>booking/supply_list" title="View Items List"><i class="fa  fa-cubes text-yellow " ></i> <span><?= $this->lang->line('supply_list'); ?></span></a></li>
            <?php } ?>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Click To View Hold Invoices">
             
            
            </a>

            <ul class="dropdown-menu dropdown-width-lg">
   
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-12 text-center " style="max-height:300px;overflow-y: scroll;">
                    <table class="table table-bordered" width="100%">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Ref.ID</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody id="hold_invoice_list" >
                       <?=$result?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.row -->
              <!--</li>-->
            </ul>
          </li>

            <!-- Messages: style can be found in dropdown.less-->
            <li class="hidden-xs" id="fullscreen"><a title="Fullscreen On/Off"><i class="fa fa-tv text-white" ></i> </a></li>
            <li class="text-center" id="">
            <a title="Dashboard" href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard text-yellow" ></i><b class="hidden-xs"><?= $this->lang->line('dashboard'); ?></b></a>
          </li>

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo get_profile_picture(); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php print ucfirst($this->session->userdata('inv_username')); ?></span>
            </a>

            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo get_profile_picture(); ?>" class="img-circle" alt="User Image">

                <p>
                 <?php print ucfirst($this->session->userdata('inv_username')); ?>
                  <small>Year <?=date("Y");?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo $base_url; ?>users/edit/<?= $this->session->userdata('inv_userid'); ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo $base_url; ?>logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>

  <?php $css = ($this->session->userdata('language')=='Arabic' || $this->session->userdata('language')=='Urdu') ? 'margin-right: 0 !important;': '';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="<?=$css;?>">
    <!-- Content Header (Page header) -->
   <!--  <section class="content-header">
      <h1>
        General Form Elements
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol>
    </section> -->

    <!-- **********************MODALS***************** -->
    <?php include"modals/modal_customer.php"; ?>
    <?php include"modals/modal_sales_item.php"; ?>
    <!-- **********************MODALS END***************** -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-7">
         
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
            <form class="form-horizontal" id="pos-form" >
            <div class="box-header with-border" style="padding-bottom: 0px;">
              <div class="row" >
                <div class="col-md-12" >
                <div class="col-md-4">
                  <h3 class="box-title text-primary"><i class="fa fa-shopping-cart text-aqua"></i> New Supply</h3>
                </div>
                  <!-- <div class="col-md-4 pull-right" >
                  <div class="form-group">
                     <select class="form-control select2" id="warehouse_id" name="warehouse_id"  style="width: 100%;" onkeyup="shift_cursor(event,'mobile')">
                          <?php
                             
                             $query1="select * from db_warehouse where status=1";
                             $q1=$this->db->query($query1);
                             if($q1->num_rows($q1)>0)
                                {  
                                  
                                  foreach($q1->result() as $res1)
                                {
                                  $selected=($warehouse_id==$res1->id) ? 'selected' : '';
                                  echo "<option $selected  value='".$res1->id."'>".$res1->warehouse_name ."</option>";
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
                    <span id="warehouse_id_msg" style="display:none" class="text-danger"></span>
                  </div>
                </div> -->
                <?php if(isset($sales_id)): ?>
                  <?php if($CI->permissions('sales_add')) { ?>
                  <div class="col-md-4 pull-right">
                    <a href='<?= $base_url;?>pos' class="btn btn-primary pull-right">New Invoice</a>
                  </div>
                  <?php } ?>
                <?php endif; ?>
                
              </div>
              </div>
               
            
            
            
          </div>
            <!-- /.box-header -->
            
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
              <input type="hidden" value='0' id="hidden_rowcount" name="hidden_rowcount">
              <input type="hidden" value='' id="hidden_invoice_id" name="hidden_invoice_id">
              <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">

              <input type="hidden" value='' id="temp_customer_id" name="temp_customer_id">
              
              <!-- **********************MODALS***************** -->
             <?php include"modals_pos_payment/modal_payments_multi_booking.php"; ?>
              <!-- **********************MODALS END***************** -->
              <!-- **********************MODALS***************** -->
              <div class="modal fade" id="discount-modal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Set Discount</h4>
                    </div>
                    <div class="modal-body">
                      
                        <div class="row">
                          <div class="col-md-6">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="discount_input">Discount</label>
                                <input type="text" class="form-control" id="discount_input" name="discount_input" placeholder="" value="0">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="discount_type">Discount Type</label>
                                <select class="form-control" id='discount_type' name="discount_type">
                                  <option value='in_percentage'>Per%</option>
                                  <option value='in_fixed'>Fixed</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                     
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary discount_update">Update</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
              <!-- **********************MODALS END***************** -->
              <div class="box-body">                
              <div class="row">
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-addon" title="Customer"><i class="fa fa-user"></i></span>
                     <select class="form-control select2" id="supplier_id" name="supplier_id"  style="width: 100%;" onkeyup="shift_cursor(event,'expense_for')" >
                        <?php
                        $query1="select * from db_suppliers where status=1";
                        $q1=$this->db->query($query1);
                        
                        if($q1->num_rows($q1)>0)
                         {   
                             foreach($q1->result() as $res1)
                           {
                             echo "<option  value='".$res1->id."'>".$res1->supplier_name."</option>";
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
                    <span class="input-group-addon pointer" data-toggle="modal" data-target="#customer-modal" title="New Customer?"><i class="fa fa-user-plus text-primary fa-lg"></i></span>
                  </div>
                    <span class="customer_points text-success" style="display: none;"></span>
                  
                  
                </div>
                <div class="col-md-6">
                  <div class="input-group">
                  <label for="delivery_date" class="control-label input-group-addon"><?= $this->lang->line('delivery_date'); ?> <label class="text-danger">*</label></label>
                     <input type="text" class="form-control datepicker"id="delivered_date" required="" name="delivered_date">
                  </div>
                </div>          
              </div><!-- row end -->
              <br>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="col-sm-12" style="overflow-y:auto;border:1px solid #337ab7;" >
                      <table class="table table-condensed table-bordered table-striped table-responsive items_table" style="">
                        <thead class="bg-primary">
                          <th width="10%"><?= $this->lang->line('customer_name'); ?></th>
                          <th width="20%"><?= $this->lang->line('item_name'); ?></th>
                          <th width="5%"><?= $this->lang->line('qty_booked'); ?></th>
                          <th width="10%"><?= $this->lang->line('quantity'); ?></th>
                          <th width="8%"><?= $this->lang->line('qty_left'); ?></th>
                          <th width="5%"><i class="fa fa-close"></i></th>
                        </thead>
                        <tbody id="pos-form-tbody" style="font-size: 16px;font-weight: bold;overflow: scroll;">
                          <!-- body code -->
                        </tbody>        
                        <tfoot>
                          <!-- footer code -->
                        </tfoot>              
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                 <!-- SMS Sender while saving -->
                      <?php 
                         //Change Return
                          // $send_sms_checkbox='disabled';
                          // if($CI->is_sms_enabled()){
                          //   if(!isset($sales_id)){
                          //     $send_sms_checkbox='checked';  
                          //   }else{
                          //     $send_sms_checkbox='';
                          //   }
                          // }

                    ?>
                   
                    <div class="col-xs-12 ">
                           <div class="checkbox icheck">
                            <!-- <label>
                              <input type="checkbox" <?=$send_sms_checkbox;?> class="form-control" id="send_sms" name="send_sms" > <label for="sales_discount" class=" control-label"><?= $this->lang->line('send_sms_to_customer'); ?>
                                <i class="hover-q " data-container="body" data-toggle="popover" data-placement="top" data-content="If checkbox is Disabled! You need to enable it from SMS -> SMS API <br><b>Note:<i>Walk-in Customer will not receive SMS!</i></b>" data-html="true" data-trigger="hover" data-original-title="" title="Do you wants to send SMS ?">
                                  <i class="fa fa-info-circle text-maroon text-black hover-q"></i>
                                </i>
                              </label> -->
                            </label>
                          </div>
                            
                             <!-- /.box-body -->
                         
                       <!-- /.box -->
                    </div> 
                </div>
           
              </div>
              <!-- /.box-body -->

              <div class="box-footer bg-gray">
                <div class="row">
                <div class="col-md-3 text-right">
                          <label> <?= $this->lang->line('quantity'); ?>:</label><br>
                          <span class="text-bold tot_qty"></span>
                          
                  </div> 
                  <div class="col-md-3 text-right">
                          <label> <?= $this->lang->line('stock'); ?>:</label><br>
                          <span class="text-bold get_order_qtys() tot_layers"></span><br />
                          <label> <?= $this->lang->line('available'); ?>:</label>
                          <input type="hidden" class="form-control" id="tot_layers_left" name="tot_layers_left">
                          <span class="text-bold tot_layers_left"></span>
                           
                  </div>
                 
                </div>
                
                <div class="row"> 
                
                  <?php if(isset($sales_id)){ $btn_id='update';$btn_name="Save"; ?>
                    <input type="hidden" name="sales_id" id="sales_id" value="<?php echo $sales_id;?>"/>
                  <?php } else{ $btn_id='save';$btn_name="Save";} ?>

                  <div class="col-md-12 text-right">
                  
                  <div class="col-sm-4">
                      <button type="button" id="<?php echo "show_cash_modal";?>" name="" class="btn btn-success btn-block btn-flat btn-lg ctrl_c" title="By Cash & Save [Ctrl+C]">
                            <i class="fa fa-money" aria-hidden="true"></i>
                             <?php echo $btn_name;?>
                          </button>
                    </div>
                    

                          
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-5">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <!-- form start -->
            
              <div class="box-body">
                
              <div class="row">
                <div class="col-md-6">
                  <div class="input-group col-md-12">
                    
                     <select class="form-control select2" id="category_id" name="category_id"  style="width: 100%;"  >
                        <?php
                        $query1="select * from db_category where status=1";
                        $q1=$this->db->query($query1);
                        echo '<option value="">All Categories</option>';
                        if($q1->num_rows($q1)>0)
                         {   
                             foreach($q1->result() as $res1)
                           {
                             echo "<option value='".$res1->id."'>".$res1->category_name."</option>";
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
                    
                  </div>
                </div> 
                <div class="col-md-6">
                  <div class="input-group input-group-md">
                      <input type="text" id="search_it" class="form-control" placeholder="Filter Items" autocomplete="off">
                          <span class="input-group-btn">
                            <button type="button" class="btn btn-info btn-flat show_all">All</button>
                          </span>
                    </div>
                </div>                
              </div><!-- row end -->
             
              <div class="row">
                <div class="col-md-12">
                  <!-- <div class="form-group"> -->
                   <!--  <div class="col-sm-12"> -->
                      <!-- <style type="text/css">
                        
                      </style> -->
                     
                            <section class="content" >
                              <div class="row search_div" style="overflow-y: scroll;min-height: 100px;height: 500px;">
                              <?php 
                                echo $CI->get_new_supply_list_details();
                                ?>
                              </div>
                              <h3 class='text-danger text-center error_div' style="display: none;">Sorry! No Records Found</h3>
                            </section>
                      
                         
                    <!-- </div> -->
                  <!-- </div> -->
                </div>
              </div>
           
              </div>
              <!-- /.box-body -->

              
           
          </div>
          <!-- /.box -->
          
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include"footer.php";?>
</div>
<!-- ./wrapper -->

<!-- SOUND CODE -->
<?php include"comman/code_js_sound.php"; ?>
<!-- GENERAL CODE -->
<?php include"comman/code_js_form.php"; ?>

<!-- iCheck -->
<script src="<?php echo $theme_link; ?>plugins/iCheck/icheck.min.js"></script>

<script src="<?php echo $theme_link; ?>js/fullscreen.js"></script>
<script src="<?php echo $theme_link; ?>js/modals.js"></script>
<script src="<?php echo $theme_link; ?>js/booking_list.js"></script>
<script src="<?php echo $theme_link; ?>js/mousetrap.min.js"></script>
<!-- DROP DOWN -->
<script src="<?php echo $theme_link; ?>dist/js/bootstrap3-typeahead.min.js"></script>  
<!-- DROP DOWN END-->


<script>

  //RIGHT SIT DIV:-> FILTER ITEM INTO THE ITEMS LIST
  function search_it(){
  
  var input = $("#search_it").val().trim();
  var item_count=$(".search_div .search_item").length;
  var error_count=item_count;
  for(i=0; i<item_count; i++){
    
    if($("#item_"+i).html().toUpperCase().indexOf(input.toUpperCase())>-1){
    
      $("#item_"+i).show();
      $("#item_parent_"+i).show();
    }
    else{
    
     $("#item_"+i).hide();
     $("#item_parent_"+i).hide();
     error_count--;
    }
    if(error_count==0){
      $(".error_div").show();
    }
    else{
      $(".error_div").hide();
    }
    
  }
  }


//REMOTELY FETCH THE ALL ITEMS OR CATEGORY WISE ITEMS.
function get_new_supply_list_details(){
  $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
  $.post("<?php echo $base_url; ?>booking/get_new_supply_list_details",{id:$("#category_id").val()},function(result){
    $(".search_div").html('');
    $(".search_div").html(result);
    $(".overlay").remove();
  });
}

//LEFT SIDE: ON CLICK ITEM ADD TO INVOICE LIST
function addrow(id){

    //CHECK SAME ITEM ALREADY EXIST IN ITEMS TABLE 
    var item_check=check_same_item($('#div_'+id).attr('data-item-id'));
    if(!item_check){return false;}
    var rowcount        =$("#hidden_rowcount").val();//0,1,2...
    var item_id         =$('#div_'+id).attr('data-item-id');
    var reference_no         =$('#div_'+id).attr('data-item-reference_no');
    var customer_id         =$('#div_'+id).attr('data-item-customer_id');
    var order_id         =$('#div_'+id).attr('data-item-order_id');
    var booking_id         =$('#div_'+id).attr('data-item-booking_id');
    var sales_id         =$('#div_'+id).attr('data-item-sales_id');
    var customer_name         =$('#div_'+id).attr('data-customer-name');
    var item_name       =$('#div_'+id).attr('data-item-name');
    var stock   =$('#div_'+id).attr('data-item-available-qty');
    var sales_qty   =$('#div_'+id).attr('data-sales-qty');
    var tax_type   =$('#div_'+id).attr('data-item-tax-type');
    var tax_id   =$('#div_'+id).attr('data-item-tax-id');
    var tax_value   =$('#div_'+id).attr('data-item-tax-value');
    var tax_name   =$('#div_'+id).attr('data-item-tax-name');
    var tax_amt   =$('#div_'+id).attr('data-item-tax-amt');
    // var tot_layers         =$('#div_'+id).attr('data-item-available-layers');
    // var tot_browler         =$('#div_'+id).attr('data-item-available-brol');
    // var tot_eggs         =$('#div_'+id).attr('data-item-available-eggs');
    //var gst_amt         =$('#div_'+id).attr('data-item-gst-amt');
    var item_cost     =$('#div_'+id).attr('data-item-cost');
    // var qty_left     =$('#div_'+id).attr('data-item-sales-price');
    var sales_price_temp=stock; 
      var  stock     =(parseFloat(stock)).toFixed(2);

    var quantity        ='<div class="input-group input-group-sm"><span class="input-group-btn"><button onclick="decrement_qty('+item_id+','+rowcount+')" type="button" class="btn btn-default btn-flat"><i class="fa fa-minus text-danger"></i></button></span>';
        quantity       +='<input typ="text" value="1" class="form-control no-padding text-center" onkeyup="item_qty_input('+item_id+','+rowcount+')" id="item_qty_'+item_id+'" name="item_qty_'+item_id+'">';
        quantity       +='<span class="input-group-btn"><button onclick="increment_qty('+item_id+','+rowcount+')" type="button" class="btn btn-default btn-flat"><i class="fa fa-plus text-success"></i></button></span></div>';
       
    var remove_btn      ='<a class="fa fa-fw fa-trash-o text-red" style="cursor: pointer;font-size: 20px;" onclick="removerow('+rowcount+')" title="Delete Item?"></a>';
   
    var str=' <tr id="row_'+rowcount+'" data-row="0" data-item-id='+item_id+'>';/*item id*/
    str+='<td id="td_'+rowcount+'_0"><a data-toggle="tooltip" class="pointer" id="td_data_'+rowcount+'_1" >'+ customer_name     +'</a> </td>';/* td_0_0 item name*/ 
        str+='<td id="td_'+rowcount+'_1"><a data-toggle="tooltip" class="pointer" id="td_data_'+rowcount+'_0" >'+ item_name     +'</a></td>';/* td_0_0 item name*/ 
        str+='<input reaonly type="hidden" name="td_data_'+rowcount+'_0" class="pointer" id="td_data_'+rowcount+'_0" value="'+item_name+'">'
        str+='<td id="td_'+rowcount+'_1">'+ stock +'</td>';
        str+='<td id="td_'+rowcount+'_2">'+ quantity +'</td>';
        str +='<input type="hidden" id="sales_qty_'+rowcount+'" name="sales_qty_'+rowcount+'" value="'+sales_qty+'">';
        qty_left       =(parseFloat(1)*parseFloat(sales_qty)).toFixed(2)//Initial
        // tot_layers       =(parseFloat(1)*parseFloat(tot_layers)).toFixed(2)//Initial
        str+='<td id="td_'+rowcount+'_4" class="text-right"><input data-toggle="tooltip" title="Qty Left" id="td_data_'+rowcount+'_4" name="td_data_'+rowcount+'_4" type="text" class="form-control no-padding pointer" readonly value="'+qty_left+'"></td>';/* td_0_4 item sub_total */
        str+='<td id="td_'+rowcount+'_5">'+ remove_btn    +'</td>';/* td_0_5 item gst_amt */
        str+='<input type="hidden" name="tr_item_id_'+rowcount+'" id="tr_item_id_'+rowcount+'" value="'+item_id+'">';
        str+='<input type="hidden" id="tr_sales_price_'+rowcount+'" name="tr_sales_price_'+rowcount+'" value="'+sales_price_temp+'">';
        str+='<input type="hidden" id="tr_tax_type_'+rowcount+'" name="tr_tax_type_'+rowcount+'" value="'+tax_type+'">';
       
        str+='<input type="hidden" id="tr_tax_id_'+rowcount+'" name="tr_tax_id_'+rowcount+'" value="'+tax_id+'">';
        str+='<input type="hidden" id="tr_tax_value_'+rowcount+'" name="tr_tax_value_'+rowcount+'" value="'+tax_value+'">';
        str+='<input type="hidden" id="description_'+rowcount+'" name="description_'+rowcount+'" value="">';
        str+='<input type="hidden" id="tot_ord_qty_left_'+rowcount+'" name="tot_ord_qty_left_'+rowcount+'" value="">';
        str+='<input type="hidden" id="reference_no_'+rowcount+'" name="reference_no_'+rowcount+'" value="'+reference_no+'">';
        str+='<input type="hidden" id="customer_id_'+rowcount+'" name="customer_id_'+rowcount+'" value="'+customer_id+'">';
        str+='<input type="hidden" id="order_id_'+rowcount+'" name="order_id_'+rowcount+'" value="'+order_id+'">';
        str+='<input type="hidden" id="sales_id_'+rowcount+'" name="sales_id_'+rowcount+'" value="'+sales_id+'">';
        str+='<input type="hidden" id="booking_id_'+rowcount+'" name="booking_id_'+rowcount+'" value="'+booking_id+'">';
        // str+='<input type="hidden" id="total_lay_'+rowcount+'" name="total_lay_'+rowcount+'" value="'+tot_layers+'">';
        // str+='<input type="hidden" id="total_brol_'+rowcount+'" name="total_brol_'+rowcount+'" value="'+tot_browler+'">';
        // str+='<input type="hidden" id="total_eggs_'+rowcount+'" name="total_eggs_'+rowcount+'" value="'+tot_eggs+'">';
        str+='<input type="hidden" id="total_qty_pending'+rowcount+'" name="total_qty_pending'+rowcount+'" value="">';

        str+='</tr>';   
       
     //LEFT SIDE: ADD OR APPEND TO SALES INVOICE TERMINAL
     $('#pos-form-tbody').append(str);
 
//LEFT SIDE: INCREMANT ROW COUNT
// $(".tot_layers").val(tot_layers);
$("#hidden_rowcount").val(parseFloat($("#hidden_rowcount").val())+1);
failed.currentTime = 0;
failed.play();
//CALCULATE FINAL TOTAL AND OTHER OPERATIONS
//final_total();
// get_order_qtys(item_id,rowcount);
get_brol_qty(item_id,rowcount)
make_subtotal(item_id,rowcount);

}

function update_price(row_id,item_cost){


make_subtotal($("#tr_item_id_"+row_id).val(),row_id);
}



//INCREMENT ITEM
function increment_qty(item_id,rowcount){
var item_qty=$("#item_qty_"+item_id).val();
var stock=$("#td_"+rowcount+"_1").html();
if(parseFloat(item_qty)<parseFloat(stock)){
item_qty=parseFloat(item_qty)+1;
$("#item_qty_"+item_id).val(item_qty);
}
make_subtotal(item_id,rowcount);
}
//DECREMENT ITEM
function decrement_qty(item_id,rowcount){
var item_qty=$("#item_qty_"+item_id).val();
if(item_qty<=1){
$("#item_qty_"+item_id).val(1);
return;
}
$("#item_qty_"+item_id).val(parseFloat(item_qty)-1);
make_subtotal(item_id,rowcount);
}
//LEFT SIDE: IF ITEM QTY CHANGED MANUALLY
function item_qty_input(item_id,rowcount){
var item_qty=$("#item_qty_"+item_id).val();
var stock=$("#td_"+rowcount+"_1").html();
if(item_qty==0){
$("#item_qty_"+item_id).val(1);
toastr["warning"]("You must Deliver atlease one Item");
//return; 
}


make_subtotal(item_id,rowcount);
}

function zero_stock(){
toastr["error"]("Out of Stock!");
return;
}
//LEFT SIDE: REMOVE ROW 
function removerow(id){//id=Rowid  
$("#row_"+id).remove();
failed.currentTime = 0;
failed.play();
final_total();
}
function get_brol_qty(item_id, rowcount){
  var tot_brol = $("#total_brol_"+rowcount).val();
  var item_qty =$("#item_qty_"+item_id).val();
  var tot_bro =(parseFloat(tot_brol) - parseFloat(item_qty));
  final_total();
  $(".total_briolers").html(tot_bro);
}
function get_order_qty(item_id,rowcount){
  var tot_layers = $("#total_lay_"+rowcount).val();
  var tot_eggs = $("#total_eggs_"+rowcount).val();
  var item_qty =$("#item_qty_"+item_id).val();
  var tot_lay =(parseFloat(tot_layers)-parseFloat(item_qty));
  // $(".tot_layers").html(tot_lay) ;
  $(".total_eggs").html(tot_eggs);
  final_total();
  console.log("tot_layers="+tot_lay);
  console.log("item_qtyxyz="+item_qty);
  var logi = $(".tot_qty").html();
  console.log("logi="+logi);
}
//MAKE SUBTOTAL
function make_subtotal(item_id,rowcount){
set_tax_value(rowcount);

//Find the Tax type and Tax amount
var tax_type = $("#tr_tax_type_"+rowcount).val();
var tax_amount = $("#td_data_"+rowcount+"_11").val();
var sales_qty = $("#tr_sales_price_"+rowcount).val();
var tot_layers = $("#total_lay_"+rowcount).val();
var qty_left   =$("#item_qty_"+rowcount).val();
var gst_per    =$("#tr_item_per_"+rowcount).val();
var item_qty   =$("#item_qty_"+item_id).val();
// var tot_layers = $("#total_lay_"+rowcount).val();
var pending_qty =parseFloat(sales_qty)-parseFloat(item_qty)
var tot_sales_price =parseFloat(item_qty)*parseFloat(qty_left);
var tot_lays =parseFloat(tot_layers);

// var item_qty   =$("#total_qty_pending"+item_id).val();

var due_qty        =parseFloat(pending_qty)
var subtotal        =parseFloat(tot_sales_price);

if(due_qty < 0){
  $("#item_qty_"+item_id).val(1);
  
toastr["warning"]("Your input is higher then requested quantity");
}

$(".tot_layers").html(tot_lays) ;
console.log("due_qty="+due_qty);
console.log("tot_lays="+tot_lays);
console.log("item_qty="+item_qty);
console.log("tax_type="+tax_type);
console.log("subtotal="+subtotal);
console.log("tax_amount="+tax_amount);
subtotal = (tax_type=='Inclusive') ? subtotal : parseFloat(subtotal) + parseFloat(tax_amount);
$("#tot_ord_qty_left_").val(tot_ord_qty_left) ;
$("#td_data_"+rowcount+"_4").val(parseFloat(due_qty).toFixed(2));
final_total();
}
function calulate_discount(discount_input,discount_type,total){
if(discount_type=='in_percentage'){
return parseFloat((total*discount_input)/100);
}
else{//in_fixed
return parseFloat(discount_input);
}
}
//LEFT SIDE: FINAL TOTAL
function final_total(){
var total=0;
var item_qty=0;
var rowcount=$("#hidden_rowcount").val();
var discount_input=$("#discount_input").val();
var discount_type=$("#discount_type").val();
var tot_layers = $(".tot_layers").html();
// var tot_layers = $("#total_lay_"+rowcount).val();
if($(".items_table tr").length>1){
for(i=0;i<rowcount;i++){
  if(document.getElementById('tr_item_id_'+i)){
   // set_tax_value(i);
  //var tax_amt = parseFloat($("#td_data_"+i+"_11").val());
  item_id=$("#tr_item_id_"+i).val();
  
  total=parseFloat(total)+ + +parseFloat($("#td_data_"+i+"_4").val()).toFixed(2);
  //console.log("==>total="+total);
  item_qty=parseFloat(item_qty)+ + +parseFloat($("#item_qty_"+item_id).val()).toFixed(2);
  new_order_qty=parseFloat(tot_layers)-parseFloat(item_qty).toFixed(2);
  tot_ord_qty_left=parseFloat(tot_layers)-parseFloat(item_qty).toFixed(2);
  }
}//for end
}//items_table
if(parseFloat(tot_layers) < item_qty){
  $("#item_qty_"+item_id).val(0);
  toastr["warning"]("Stock is less then requested quantity");
}
console.log(new_order_qty);
console.log(item_qty);
total =round_off(total);
$(".tot_layers_left").html(new_order_qty) ;
$("#tot_layers_left").val(tot_ord_qty_left) ;
console.log("tot_ord_qty_left_ ="+new_order_qty);
var discount_amt=0;
if(total>0){
var discount_amt=calulate_discount(discount_input,discount_type,total);//return value 
}
set_total(item_qty,total,discount_amt,total-discount_amt);
}
function set_total(tot_qty=0, tot_lay=0, tot_amt=0, tot_disc=0, tot_grand=0){
$(".tot_qty").html(tot_qty);
}


//LEFT SIDE: FINAL TOTAL
function adjust_payments(){
var total=0;
var item_qty=0;
var rowcount=$("#hidden_rowcount").val();
var discount_input=$("#discount_input").val();

var discount_type=$("#discount_type").val();
//var discount_amt = parseFloat($(".tot_disc").html());

if($(".items_table tr").length>1){
for(i=0;i<rowcount;i++){
  if(document.getElementById('tr_item_id_'+i)){
  total=parseFloat(total)+ + +parseFloat($("#td_data_"+i+"_4").val()).toFixed(2);
  item_id=$("#tr_item_id_"+i).val();
  item_qty=parseFloat(item_qty)+ + +parseFloat($("#item_qty_"+item_id).val()).toFixed(2);
  }
}//for end
}//items_table
total =round_off(total);
//Find customers payment

var payments_row =get_id_value("payment_row_count");
console.log("payments_row="+payments_row);
var paid_amount =parseFloat(0);
for (var i = 1; i <=payments_row; i++) {
if(document.getElementById("amount_"+i)){
  var amount = parseFloat(get_id_value("amount_"+i));
      amount = isNaN(amount) ? 0 : amount;
      console.log("amount_"+i+"="+amount);
  paid_amount += amount;
}
}

//RIGHT SIDE DIV
var discount_amt=calulate_discount(discount_input,discount_type,total);//return value


var change_return = 0;
var balance = total-discount_amt-paid_amount;
if(balance < 0){
//console.log("Negative");
change_return = Math.abs(parseFloat(balance));
balance = 0;
}

balance =round_off(balance);
$(".sales_div_tot_qty  ").html(item_qty);
$(".sales_div_tot_amt  ").html((round_off(total)).toFixed(2));
$(".sales_div_tot_discount ").html((parseFloat(round_off(discount_amt))).toFixed(2)); 
$(".sales_div_tot_payble ").html((parseFloat(round_off(total-discount_amt))).toFixed(2)); 
$(".sales_div_tot_paid ").html((round_off(paid_amount)).toFixed(2));
$(".sales_div_tot_balance ").html((parseFloat(round_off(balance))).toFixed(2)); 

/**/
$(".sales_div_change_return ").html((change_return).toFixed(2)); 

}

function check_same_item(item_id){

if($(".items_table tr").length>1){
var rowcount=$("#hidden_rowcount").val();
for(i=0;i<=rowcount;i++){
        if($("#tr_item_id_"+i).val()==item_id){
          increment_qty(item_id,i);
          failed.currentTime = 0;
          failed.play();
          return false;
        }
  }//end for
}
return true;
}

$(document).ready(function(){
//FIRST TIME: LOAD

var first_div= parseFloat($(".content-wrapper").height());
var second_div= parseFloat($("section").height());
var items_table= parseFloat($(".items_table").height());
$(".items_table").parent().css("height",(first_div-second_div)+items_table+250);/**/
$(".search_div").parent().css("height",(second_div-items_table));/**/


//FIRST TIME: SET TOTAL ZERO
set_total();

//RIGHT DIV: FILTER INPUT BOX
$("#search_it").on("keyup",function(){
search_it();
});

//CATEGORY WISE ITEM FETCH FROM SERVER
$("#category_id").change(function () {
  get_details();
});

//DISCOUNT UPDATE
$(".discount_update").click(function () {
  final_total();
  $('#discount-modal').modal('toggle');    
});

//RIGHT SIDE: CLEAR SEARCH BOX
$(".show_all").click(function(){
$("#search_it").val('').trigger("keyup");
$("#category_id").val('').trigger("change");
});
//UPDATE PROCESS START
<?php if(isset($sales_id) && !empty($sales_id)){ ?>

$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
$.get("<?php echo $base_url ?>booking/fetch_sales/<?php echo $sales_id ?>",{},function(result){
  //console.log(result);
  result=result.split("<<<###>>>");
  $('#pos-form-tbody').append(result[0]);
  $('#discount_input').val(result[1]);
  $('#discount_type').val(result[2]);
  $('#supplier_id').val(result[3]).select2();
  $('#delivered_date').val(result[3]);
  $("#hidden_rowcount").val(parseFloat($(".items_table tr").length)-1);
  adjust_payments();
  final_total();
  $(".overlay").remove();
  $("#customer_id").trigger("change"); 
  if(result[5]==1){
    $( "#binvoice" ).prop( "checked", true );
    $('#binvoice').parent('div').addClass('checked');
  }
});
  //DISABLE THE HOLD BUTTON
  $("#hold_invoice,#show_cash_modal").attr('disabled',true).removeAttr('id');

<?php } ?>
//UPDATE PROCESS END

// hold_invoice_list();
});//ready() end



$("#item_search").bind("paste", function(e){
$("#item_search").autocomplete('search');
} );

$("#item_search").autocomplete({

source: function(data, cb){
    $.ajax({
      autoFocus:true,
        url: $("#base_url").val()+'items/get_json_items_details',
        method: 'GET',
        dataType: 'json',

        showHintOnFocus: true,
        autoSelect: true, 
        selectInitial :true,
  
        data: {
            name: data.term,
            /*warehouse_id:$("#warehouse_id").val().trim(),*/
        },
        success: function(res){
          //console.log(res);
            var result;
            result = [
                {
                    //label: 'No Records Found '+data.term,
                    label: 'No Records Found ',
                    value: ''
                }
            ];

            if (res.length) {
              
                result = $.map(res, function(el){
                    return {
                        label: el.item_code +'--[Qty:'+el.stock+'] --'+ el.label,
                        value: '',
                        id: el.id,
                        item_name: el.value,
                        stock: el.stock,
                       // mobile: el.mobile,
                        //customer_dob: el.customer_dob,
                        //address: el.address,

                    };

                });
            }
            cb(result);
        }
    });
},

    response:function(e,ui){
      if(ui.content.length==1){
        $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
        $(this).autocomplete("close");
      }
      //console.log(ui.content[0].id);
    },
    //loader start
    search: function (e, ui) {
      
    },
    select: function (e, ui) { 

        if(typeof ui.content!='undefined'){
          console.log("Autoselected first");
          if(isNaN(ui.content[0].id)){
            return;
          }
          var stock=ui.content[0].stock;
          var item_id=ui.content[0].id;

        }
        else{
          console.log("manual Selected");
          var stock=ui.item.stock;
          var item_id=ui.item.id;
        }
        
        if(parseFloat(stock)==0){
          toastr["error"]("Out of Stock!");
          $("#item_search").val('');
          return;
        }
        addrow(item_id);
        $("#item_search").val('');
        
        
    },   
    //loader end
});


//DATEPICKER INITIALIZATION
$('#order_date,#delivery_date,#cheque_date').datepicker({
  autoclose: true,
  format: 'dd-mm-yyyy',
  todayHighlight: true
});
$('#customer_dob,#birthday_person_dob').datepicker({
  calendarWeeks: true,
  todayHighlight: true,
  autoclose: true,
  format: 'dd-mm-yyyy',
  startView: 2
});

//Datemask dd-mm-yyyy
//$("#customer_dob,#birthday_person_dob").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

//Timepicker
/*$('.timepicker').timepicker({
  showInputs: false,
});*/

//Sale Items Modal Operations Start
function show_sales_item_modal(row_id){
  $('#sales_item').modal('toggle');
  //$("#popup_tax_id").select2();

  //Find the item details
  var item_name = $("#td_data_"+row_id+"_0").html();
  var tax_type = $("#tr_tax_type_"+row_id).val();
  var tax_id = $("#tr_tax_id_"+row_id).val();
  var description = $("#description_"+row_id).val();
  // var tot_layers = $("#tot_layers_"+row_id).val();
  var sales_qty = $("#tr_sales_qty_"+row_id).val();
  var total_lay = $("#tr_total_lay_"+row_id).val();
  var item_qty = $("#item_qty_"+row_id).val();

  //Set to Popup
  $("#popup_item_name").html(item_name);
  $("#popup_tax_type").val(tax_type).select2();
  $("#popup_tax_id").val(tax_id).select2();
  $("#popup_row_id").val(row_id);
  $("#popup_description").val(description);
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
  $("#customer_id_"+row_id).val(customer_id);
  $("#tot_ord_qty_left_").val(tot_ord_qty_left) ;
  $("#item_qty_"+row_id).val(item_qty);
  $("#tr_sales_qty_"+row_id).val(sales_qty);
  $("#tr_tot_lay_"+row_id).val(total_lay);
  $("#description_"+row_id).val(description);
  // $("#tot_layers"+row_id).val(tot_layers_);
  // $(".tot_layers").val(tot_layers_);
  $("#tr_tax_value_"+row_id).val(tax);//%
  //$("#td_data_"+row_id+"_12").html(tax_type+" "+tax_name);
  
  var item_id=$("#tr_item_id_"+row_id).val();
  make_subtotal(item_id,row_id);
  //calculate_tax(row_id);
  $('#sales_item').modal('toggle');
}
function set_tax_value(row_id){
  //get the sales price of the item
  var tax_type = $("#tr_tax_type_"+row_id).val();
  var tax = $("#tr_tax_value_"+row_id).val(); //%
  var item_id=$("#tr_item_id_"+row_id).val();
  var qty=($("#item_qty_"+item_id).val());
      qty = (isNaN(qty)) ? 0 :qty;

  var qty_left = parseFloat($("#item_qty_"+row_id).val());
      qty_left = (isNaN(qty_left)) ? 0 :qty_left;
      qty_left = qty_left * qty;
      
  var tax_amount = (tax_type=='Inclusive') ? calculate_inclusive(qty_left,tax) : calculate_exclusive(qty_left,tax);
  console.log("tax_amount="+tax_amount);
  $("#td_data_"+row_id+"_11").val(tax_amount);
}
//Sale Items Modal Operations End


</script>
<script>
$(function () {
$('input').iCheck({
  checkboxClass: 'icheckbox_square-blue',
  radioClass: 'iradio_square-blue',
  increaseArea: '20%' // optional
});
});
</script>
<script type="text/javascript">
Mousetrap.bind('ctrl+m', function(e) {
e.preventDefault();
$(".show_payments_modal").trigger('click');
});
Mousetrap.bind('ctrl+h', function(e) {
e.preventDefault();
$("#hold_invoice").trigger('click');
});
Mousetrap.bind('ctrl+c', function(e) {
e.preventDefault();
$(".ctrl_c").trigger('click');
});
</script>
<script type="text/javascript">

</script>
</body>
</html>