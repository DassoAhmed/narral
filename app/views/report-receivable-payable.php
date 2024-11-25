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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$page_title;?>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$page_title;?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content"> 
        <?php
        // total payable
        $q5=$this->db->query("SELECT COALESCE(SUM(purchase_due),0) AS total_payable FROM db_suppliers");
        $total_payable=$q5->row()->total_payable;
        $q7=$this->db->query("SELECT COALESCE(SUM(sales_due),0) AS total_receivable FROM db_customers");
        $total_receivable=$q7->row()->total_receivable;

        // currency code
        $q6=$this->db->query("SELECT currency_code AS currency_code FROM db_currency");
        $currency_code=$q6->row()->currency_code;
        
        ?>
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info ">
            <div class="box-header with-border">
              <h3 class="box-title">Please Enter Valid Information</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="report-form" onkeypress="return event.keyCode != 13;">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
              <div class="box-body">
        <div class="form-group">
        <label for="from_date" class="col-sm-2 control-label"><?= $this->lang->line('from_date'); ?></label>
                 
          <div class="col-sm-3">
            <div class="input-group date">
              <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right datepicker" id="from_date" name="from_date" value="<?php echo show_date(date('d-m-Y'));?>" readonly>
              
            </div>
            <span id="Sales_date_msg" style="display:none" class="text-danger"></span>
          </div>
          <label for="to_date" class="col-sm-2 control-label"><?= $this->lang->line('to_date'); ?></label>
                   <div class="col-sm-3">
            <div class="input-group date">
              <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right datepicker" id="to_date" name="to_date" value="<?php echo show_date(date('d-m-Y'))?>" readonly>
              
            </div>
            <span id="Sales_date_msg" style="display:none" class="text-danger"></span>
          </div>
        
                </div> 
                <div class="form-group">
          <label for="customer_id" class="col-sm-2 control-label"><?= $this->lang->line('customer_name'); ?></label>

                  <div class="col-sm-3">
          <select class="form-control select2 " id="customer_id" name="customer_id">
          <option value="">-All-</option>
            <?php
            $q1=$this->db->query("select * from db_customers where status=1");
             if($q1->num_rows()>0)
             {
                 foreach($q1->result() as $res1)
               {
                 echo "<option value='".$res1->id."'>".$res1->customer_name."</option>";
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
          <span id="customer_id_msg" style="display:none" class="text-danger"></span>
                  </div>
                  <div class="form-group">
          <label for="item_id" class="col-sm-2 control-label"><?= $this->lang->line('supplier_name'); ?></label>

                  <div class="col-sm-3">
                  <!-- <select class="form-control select2 " id="payment_type" name="payment_type">
          <option value="">-All-</option>
            <?php
            $q1=$this->db->query("select * from db_paymenttypes where status=1");
             if($q1->num_rows()>0)
             {
                 foreach($q1->result() as $res1)
               {
                 echo "<option value='".$res1->payment_type."'>".$res1->payment_type."</option>";
               }
             }
             else
             {
                ?>
                <option value="">No Records Found</option>
                <?php
             }
            ?>
                  </select> -->
                  <select class="form-control select2 " id="supplier_id" name="supplier_id"  style="width: 100%;" onkeyup="shift_cursor(event,'category_name')">
				  <option value="">-All-</option>
					  <?php
						$q1=$this->db->query("select * from db_suppliers where status=1");
						if($q1->num_rows()>0)
             {
                 foreach($q1->result() as $res1)
							 {
								 echo "<option value='".$res1->id."'>".$res1->supplier_name."</option>";
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
          <span id="item_id_msg" style="display:none" class="text-danger"></span>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
        
              <div class="box-footer">
                <div class="col-sm-10 col-sm-offset-2 text-center">
                   <div class="col-md-3 ">
                      <button type="button" id="view" class=" btn btn-block btn-success" title="Save Data">Show</button>
                   </div>
                   <!-- <div class="col-md-4 ">
                      <button type="button" id="account" class=" btn btn-block bg-purple" title="Cash Data"><i class="fa fa-money " aria-hidden="true"></i> View By Payment Account</button>
                   </div> -->
                   <div class="col-sm-3">
                    <a href="<?=base_url('dashboard');?>">
                      <button type="button" class="col-sm-3 btn btn-block btn-warning close_btn" title="Go Dashboard">Close</button>
                    </a>
                   </div>
                </div>
             </div>
             <!-- /.box-footer -->

             
            </form>
          </div>
          <!-- /.box -->
          
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
         
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?= $this->lang->line('records_table'); ?></h3>
              <button type="button" class="btn btn-info pull-right btnExport" title="Download Data in Excel Format">Excel</button>
            </div>
            <!-- /.box-header -->
            <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                <span style="font-size: 18px;color: #008da4;font-weight: bold;">Account Receivable(sales due): <?php echo $total_receivable .' ' .$currency_code; ?></span>
                <div class="box-body table-responsive no-padding">
               
              <table class="table table-bordered table-hover " id="report-data" >
                <thead>
                <tr> 
                  <th style="">#</th>
                  <th style=""><?= $this->lang->line('invoice_no'); ?></th>
                  <th style=""><?= $this->lang->line('sales_date'); ?></th>
                  <th style=""><?= $this->lang->line('customer_id'); ?></th>
                  <th style=""><?= $this->lang->line('customer_name'); ?></th>
                  <th style=""><?= $this->lang->line('invoice_total'); ?>(<?= $CI->currency(); ?>)</th>
                  <th style=""><?= $this->lang->line('paid_amount'); ?>(<?= $CI->currency(); ?>)</th>
                  <th style=""><?= $this->lang->line('due_amount'); ?>(<?= $CI->currency(); ?>)</th>
                </tr>
                </thead>
                <tbody id="tbodyid">
                
              </tbody>

              <table class="table table-bordered table-hover " id="report-data" >
                <thead>
                <tr>
                  <th style="">#</th>
                  <th style=""><?= $this->lang->line('invoice_no'); ?></th>
                  <th style=""><?= $this->lang->line('booking_date'); ?></th>
                  <th style=""><?= $this->lang->line('customer_name'); ?></th>
                  <th style=""><?= $this->lang->line('item_name'); ?></th>
                  <th style=""><?= $this->lang->line('item_booked_count'); ?></th>
                  <th style=""><?= $this->lang->line('sales_amount'); ?>(<?= $CI->currency(); ?>)</th>
                  <th style=""><?= $this->lang->line('due_amount'); ?>(<?= $CI->currency(); ?>)</th>
                </tr>
                </thead>
                <tbody id="tbodybooking">
                
              </tbody>
              </table>
              </table>
            </div>
            </div>
            <div class="col-md-6">
            <span style="font-size: 18px;color: crimson;font-weight: bold;">Account Payable (purchase due): <?php echo $total_payable .' ' .$currency_code; ?></span>
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover " id="report-data" >
                <thead>
                <tr>
                  <th style="">#</th>
                  <th style=""><?= $this->lang->line('invoice_no'); ?></th>
                  <th style=""><?= $this->lang->line('sales_date'); ?></th>
                  <th style=""><?= $this->lang->line('customer_id'); ?></th>
                  <th style=""><?= $this->lang->line('customer_name'); ?></th>
                  <th style=""><?= $this->lang->line('invoice_total'); ?>(<?= $CI->currency(); ?>)</th>
                  <th style=""><?= $this->lang->line('paid_amount'); ?>(<?= $CI->currency(); ?>)</th>
                  <th style=""><?= $this->lang->line('due_amount'); ?>(<?= $CI->currency(); ?>)</th>
                </tr>
                </thead>
                <tbody id="tbodypayable">
                
                
              </tbody>
              <table class="table table-bordered table-hover " id="report-data" >
              <thead>
                <tr>
                  <th style="">#</th>
                  <th style=""><?= $this->lang->line('invoice_no'); ?></th>
                  <th style=""><?= $this->lang->line('sales_date'); ?></th>
                  <th style=""><?= $this->lang->line('customer_id'); ?></th>
                  <th style=""><?= $this->lang->line('customer_name'); ?></th>
                  <th style=""><?= $this->lang->line('invoice_total'); ?>(<?= $CI->currency(); ?>)</th>
                  <th style=""><?= $this->lang->line('paid_amount'); ?>(<?= $CI->currency(); ?>)</th>
                  <th style=""><?= $this->lang->line('due_amount'); ?>(<?= $CI->currency(); ?>)</th>
                </tr>
                </thead>
                <tbody id="tbodypayablebk">
                
              </tbody>
              </table>
            </div>
            </div>
            </div>
             
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
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

<script src="<?php echo $theme_link; ?>js/sheetjs.js" type="text/javascript"></script>
<script>
function convert_excel(type, fn, dl) {
    var elt = document.getElementById('report-data');
    var wb = XLSX.utils.table_to_book(elt, {sheet:"Sheet JS"});
    return dl ?
        XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
        XLSX.writeFile(wb, fn || ('Sales-Report.' + (type || 'xlsx')));
}
$(".btnExport").click(function(event) {
 convert_excel('xlsx');
});
</script>

<script src="<?php echo $theme_link; ?>js/report-recievable.js"></script>
<script src="<?php echo $theme_link; ?>js/report-payable.js"></script>
<script src="<?php echo $theme_link; ?>js/report-payable-booking.js"></script>
<script src="<?php echo $theme_link; ?>js/report-payable-booking-order.js"></script>

<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
    
    
</body>
</html>
