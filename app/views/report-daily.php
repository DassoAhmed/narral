<!DOCTYPE html>
<html>
<head>
<!-- TABLES CSS CODE -->
<?php include"comman/code_css_form.php"; ?>
<!-- </copy> -->  
<style>
  .box-body {
  color: black;
  background:#000;
}
</style>
</head>
<body class="hold-transition skin-blu sidebar-mini">

 
<div class="wrapper">
 
 <?php include"sidebar.php"; ?>
 <?php 
      // 
      $date = new DateTime();
      $previous_day = $date->modify("-1 days")->format('Y-m-d');
      $to_date=date("Y-m-d");
      //total purchase amt
      $q9=$this->db->query("SELECT COALESCE(SUM(b.qty*a.purchase_price),0) AS  opening_stock_price   FROM db_items AS a , db_stockentry AS b WHERE a.id=b.item_id ");
      $opening_stock_price=$q9->row()->opening_stock_price;

      //total purchase amt
      $q4=$this->db->query("SELECT COALESCE(SUM(a.tax_amt),0) AS tax_amt FROM db_purchaseitems as a,db_purchase as b where a.purchase_id=b.id and b.purchase_status='Received' and b.created_date = '$to_date'");
      $today_purchase_tax_amt=$q4->row()->tax_amt;

     
      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_payment FROM db_bookingpayments where  created_date = '$previous_day'");
      $total_booking_paments=$q1->row()->total_payment;
      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_sales_payment FROM db_salespayments where  created_date = '$previous_day'");
      $total_sales_paments=$q1->row()->total_sales_payment;
      
      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_purchase_payment FROM db_purchasepayments where  created_date = '$previous_day'");
      $total_purchase_payment=$q1->row()->total_purchase_payment;

      $q3=$this->db->query("SELECT COALESCE(SUM(expense_amt),0) AS exp_total FROM db_expense where  created_date = '$previous_day'");
      $exp_total=$q3->row()->exp_total;

      $qor3=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_payments FROM db_booking_orderpayments where  created_date = '$previous_day'");
        $total_booking_order_payments=$qor3->row()->total_payments;

        //Other Charge of Purchase entry
      $q10=$this->db->query("SELECT COALESCE(SUM(other_charges_amt),0) AS other_charges_amt FROM db_purchase where purchase_status='Received' and  created_date = '$previous_day'");
      $pur_other_charges_amt=$q10->row()->other_charges_amt;

      //Disount purchase entry
      $q13=$this->db->query("SELECT COALESCE(SUM(a.discount_amt),0) AS discount_amt FROM db_purchaseitems as a,db_purchase as b where a.purchase_id=b.id and b.purchase_status='Received' and  created_date = '$previous_day'");
      $purchase_discount_amt=$q13->row()->discount_amt;


        // other booking charges
        $qor2=$this->db->query("SELECT COALESCE(SUM(other_charges_amt),0) AS other_charges_amt FROM db_booking_orders where  created_date = '$previous_day'");
        $booking_order_other_charges_amt=$qor2->row()->other_charges_amt;
        // total discount amt
        $qds=$this->db->query("SELECT COALESCE(SUM(tot_discount_to_all_amt),0) AS tot_discount_to_all_amt FROM db_booking_orders where  created_date = '$previous_day'");
        $booking_order_discount_to_all_amt=$qds->row()->tot_discount_to_all_amt;
       
        $qpre=$this->db->query("SELECT COALESCE(SUM(amount),0) AS previous_day_balance FROM db_reportdaily where  created_date = '$previous_day'");
        $previous_day_balance=$qpre->row()->previous_day_balance;
       

        $other_charges = $pur_other_charges_amt+ $purchase_discount_amt + $booking_order_discount_to_all_amt +  $booking_order_other_charges_amt;
      $total_income = ($total_sales_paments + $total_booking_paments) - ($exp_total + $other_charges + $total_booking_order_payments+$total_purchase_payment);
    









      //total purchase amt
      $q4=$this->db->query("SELECT COALESCE(SUM(a.tax_amt),0) AS tax_amt FROM db_purchaseitems as a,db_purchase as b where a.purchase_id=b.id and b.purchase_status='Received' and b.created_date = '$to_date'");
      $today_purchase_tax_amt=$q4->row()->tax_amt;

     
      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_payment FROM db_bookingpayments where  created_date = '$to_date'");
      $today_total_booking_paments=$q1->row()->total_payment;
      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_sales_payment FROM db_salespayments where  created_date = '$to_date'");
      $today_total_sales_paments=$q1->row()->total_sales_payment;
      
      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_purchase_payment FROM db_purchasepayments where  created_date = '$to_date'");
      $today_total_purchase_payment=$q1->row()->total_purchase_payment;

      $q3=$this->db->query("SELECT COALESCE(SUM(expense_amt),0) AS exp_total FROM db_expense where  created_date = '$to_date'");
      $today_exp_total=$q3->row()->exp_total;

      $qor3=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_payments FROM db_booking_orderpayments where  created_date = '$to_date'");
        $today_total_booking_order_payments=$qor3->row()->total_payments;

        //Other Charge of Purchase entry
      $q10=$this->db->query("SELECT COALESCE(SUM(other_charges_amt),0) AS other_charges_amt FROM db_purchase where purchase_status='Received' and  created_date = '$to_date'");
      $today_pur_other_charges_amt=$q10->row()->other_charges_amt;

      //Disount purchase entry
      $q13=$this->db->query("SELECT COALESCE(SUM(a.discount_amt),0) AS discount_amt FROM db_purchaseitems as a,db_purchase as b where a.purchase_id=b.id and b.purchase_status='Received' and  created_date = '$to_date'");
      $today_purchase_discount_amt=$q13->row()->discount_amt;


        // other booking charges
        $qor2=$this->db->query("SELECT COALESCE(SUM(other_charges_amt),0) AS other_charges_amt FROM db_booking_orders where  created_date = '$to_date'");
        $today_booking_order_other_charges_amt=$qor2->row()->other_charges_amt;
        // total discount amt
        $qds=$this->db->query("SELECT COALESCE(SUM(tot_discount_to_all_amt),0) AS tot_discount_to_all_amt FROM db_booking_orders where  created_date = '$to_date'");
        $today_booking_order_discount_to_all_amt=$qds->row()->tot_discount_to_all_amt;
       

        $today_other_charges = $today_pur_other_charges_amt+ $today_purchase_discount_amt + $today_booking_order_discount_to_all_amt +  $today_booking_order_other_charges_amt;
      $today_total_income = ($today_total_sales_paments + $today_total_booking_paments) - ($today_exp_total + $today_other_charges + $today_total_booking_order_payments+$today_total_purchase_payment);
    




     
      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_payment FROM db_bookingpayments where  created_date = '$to_date' and payment_type='Cash'");
      $today_cash_total_booking_paments=$q1->row()->total_payment;
      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_sales_payment FROM db_salespayments where  created_date = '$to_date' and payment_type='Cash'");
      $today_cash_total_sales_paments=$q1->row()->total_sales_payment;
      
      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_purchase_payment FROM db_purchasepayments where  created_date = '$to_date' and payment_type='Cash'");
      $today_cash_total_purchase_payment=$q1->row()->total_purchase_payment;

      $q3=$this->db->query("SELECT COALESCE(SUM(expense_amt),0) AS exp_total FROM db_expense where  created_date = '$to_date' and payment_type='Cash'");
      $today_cash_exp_total=$q3->row()->exp_total;

      $qor3=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_payments FROM db_booking_orderpayments where  created_date = '$to_date' and payment_type='Cash'");
        $today_cash_total_booking_order_payments=$qor3->row()->total_payments;

       

    
    
     
    
    
    $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_payment FROM db_bookingpayments where  created_date = '$to_date' and payment_type='Momo'");
      $today_momo_total_booking_paments=$q1->row()->total_payment;
      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_sales_payment FROM db_salespayments where  created_date = '$to_date' and payment_type='Momo'");
      $today_momo_total_sales_paments=$q1->row()->total_sales_payment;
      
      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_purchase_payment FROM db_purchasepayments where  created_date = '$to_date' and payment_type='Momo'");
      $today_momo_total_purchase_payment=$q1->row()->total_purchase_payment;

      $q3=$this->db->query("SELECT COALESCE(SUM(expense_amt),0) AS exp_total FROM db_expense where  created_date = '$to_date' and payment_type='Momo'");
      $today_momo_exp_total=$q3->row()->exp_total;

      $qor3=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_payments FROM db_booking_orderpayments where  created_date = '$to_date' and payment_type='Momo'");
    $today_momo_total_booking_order_payments=$qor3->row()->total_payments;

       

    
    
    
    
    $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_payment FROM db_bookingpayments where  created_date = '$to_date' and payment_type='Bank/Cheque'");
      $today_bank_total_booking_paments=$q1->row()->total_payment;
      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_sales_payment FROM db_salespayments where  created_date = '$to_date' and payment_type='Bank/Cheque'");
      $today_bank_total_sales_paments=$q1->row()->total_sales_payment;
      
      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_purchase_payment FROM db_purchasepayments where  created_date = '$to_date' and payment_type='Bank/Cheque'");
      $today_bank_total_purchase_payment=$q1->row()->total_purchase_payment;

      $q3=$this->db->query("SELECT COALESCE(SUM(expense_amt),0) AS exp_total FROM db_expense where  created_date = '$to_date' and payment_type='Bank/Cheque'");
      $today_bank_exp_total=$q3->row()->exp_total;

      $qor3=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_payments FROM db_booking_orderpayments where  created_date = '$to_date' and payment_type='Bank/Cheque'");
    $today_bank_total_booking_order_payments=$qor3->row()->total_payments;

       

   
    

    $q3=$this->db->query("SELECT COALESCE(SUM(expense_amt),0) AS exp_total FROM db_expense where  created_date = '$to_date'and payment_type='Cash'");
      $today_cash_exp_total=$q3->row()->exp_total;
    $q3=$this->db->query("SELECT COALESCE(SUM(expense_amt),0) AS exp_total FROM db_expense where  created_date = '$to_date'and payment_type='Momo'");
      $today_momo_exp_total=$q3->row()->exp_total;
    $q3=$this->db->query("SELECT COALESCE(SUM(expense_amt),0) AS exp_total FROM db_expense where  created_date = '$to_date'and payment_type='Bank/Cheque'");
      $today_bank_exp_total=$q3->row()->exp_total;


      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_purchase_payment FROM db_purchasepayments where  created_date = '$to_date' and payment_type='Cash'");
      $today_cash_total_purchase_payment=$q1->row()->total_purchase_payment;
      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_purchase_payment FROM db_purchasepayments where  created_date = '$to_date' and payment_type='Momo'");
      $today_momo_total_purchase_payment=$q1->row()->total_purchase_payment;
      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_purchase_payment FROM db_purchasepayments where  created_date = '$to_date' and payment_type='Bank/Cheque'");
      $today_bank_total_purchase_payment=$q1->row()->total_purchase_payment;
      

      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_payment FROM db_booking_orderpayments where  created_date = '$to_date' and payment_type='Cash'");
      $total_cash_booking_paments=$q1->row()->total_payment;
      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_payment FROM db_booking_orderpayments where  created_date = '$to_date' and payment_type='Momo'");
      $total_momo_booking_paments=$q1->row()->total_payment;
      $q1=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_payment FROM db_booking_orderpayments where  created_date = '$to_date' and payment_type='Bank/Cheque'");
      $total_bank_booking_paments=$q1->row()->total_payment;
 
      $today_cash_total_income = ($today_cash_total_sales_paments + $today_cash_total_booking_paments) -($today_cash_exp_total - $today_cash_total_purchase_payment-$total_cash_booking_paments);
 
      $today_momo_total_income = ($today_momo_total_sales_paments + $today_momo_total_booking_paments)-($today_momo_exp_total - $today_momo_total_purchase_payment - $total_momo_booking_paments);

      $today_bank_total_income = ($today_bank_total_sales_paments + $today_bank_total_booking_paments) - ($today_bank_exp_total - $today_bank_total_purchase_payment - $total_bank_booking_paments);
 
 ?>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$page_title;?>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active"><?=$page_title;?></li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <div class="box">
            <div class="box-header">
              <button type="button" class="btn btn-info pull-right btnExport_2" title="Download Data in Excel Format">Excel</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" >
                <table class="table table-bordered table-hover " id="report-data-2" >

                  <!-- Total Gross Profit -->
                
                <!-- Total Net Profit -->
                <tr>
                  <td><?= $this->lang->line('sales_payments'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($total_sales_paments,2); ?></td>
                </tr>   
                <tr>
                  <td><?= $this->lang->line('booking_payments'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($total_booking_paments,2); ?></td>
                </tr>   
                <tr>
                  <td><?= $this->lang->line('total_expense'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($exp_total,2); ?></td>
                </tr>   
                <tr>
                  <td><?= $this->lang->line('total_purchase_payments'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($total_purchase_payment,2); ?></td>
                </tr>   
                <tr>
                  <td><?= $this->lang->line('total_booking_order_payments'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($total_booking_order_payments,2); ?></td>
                </tr>   
               
                  <td style="color:green"><?= $this->lang->line('balance'); ?></td>
                  <td class="text-right text-bold text-green"><?php echo number_format($previous_day_balance,2); ?></td>
                </form>
                </tr>   
                </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- right column -->
        <div class="col-md-6">
          <div class="box">
            <div class="box-header">
              <button type="button" class="btn btn-info pull-right btnExport" title="Download Data in Excel Format">Excel</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" >
                <table class="table table-bordered table-hover " id="report-data" >
                <!-- Total Opening Stock -->
                   <!-- Total Gross Profit -->
                   <tr>
                  <td><?= $this->lang->line('sales_payments'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($today_total_sales_paments,2); ?></td>
                </tr>   
                <tr>
                  <td><?= $this->lang->line('booking_payments'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($today_total_booking_paments,2); ?></td>
                </tr>   
                <tr>
                  <td><?= $this->lang->line('total_expense'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($today_exp_total,2); ?></td>
                </tr>   
                <tr>
                  <td><?= $this->lang->line('total_purchase_payments'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($today_total_purchase_payment,2); ?></td>
                </tr>   
                <tr>
                  <td><?= $this->lang->line('total_booking_order_payments'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($today_total_booking_order_payments,2); ?></td>
                </tr>   
                  <td style="color:green"><?= $this->lang->line('income'); ?></td>
                  <td class="text-right text-bold text-green"><?php echo number_format($today_total_income,2); ?></td>
                </tr> 
                <?php 
                if(!isset($net_balance)){
                    $net_balance =$date='';
                    $date=show_date(date("Y-m-d"));
                    $date_fin =date("Y-m-d");
                  }
                ?>
                  <td style="color:green">
                  <form class="form-horizontal" id="balance-form">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                  <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
                  <div class="input-group">
                    <?php $new_net_balance = ($today_total_income + $previous_day_balance); ?>
                  <label for="net_balance" class="control-label "><?= $this->lang->line('net_balance'); ?> <label class="text-danger">*</label></label>
                     <input type="text" readonly value="<?php echo $new_net_balance; ?>" class="form-control"id="net_balance" required="" name="net_balance">
                     <input type="hidden" readonly value="<?php echo $date_fin; ?>" class="form-control"id="date" required="" name="date">
                     
                    </div>
                    <td>
                    <button type="button" style="padding: 6px 12px;font-size: 17px;color:#fff;margin-top: 30px;" id="save" class=" btn btn-block btn-success" title="Save Data">Save</button>
                    </td>
                  </form>
                </td>
                <td class="text-right text-bold text-green">
                  
                </td>
                </tr>  
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        
      </div>
      <div class="row">
      <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <button type="button" class="btn btn-info pull-right btnExport" title="Download Data in Excel Format">Excel</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" >
                <table class="table table-bordered table-hover " id="report-data" >
                <!-- Total Opening Stock -->
                   <!-- Total Gross Profit -->
                   <tr>
                   <td style="text-align:center;color:green"><?= $this->lang->line('cash_flow'); ?></td>
                   </tr>
                   <tr>

                 
                  <td><?= $this->lang->line('cash'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($today_cash_total_income,2); ?></td>
                </tr>   
                <tr>
                  <td><?= $this->lang->line('mobile_money'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($today_momo_total_income,2); ?></td>
                </tr>   
                <tr>
                  <td><?= $this->lang->line('bank'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($today_bank_total_income,2); ?></td>
                
                </tr>   
                <tr>
                    <td><hr></td>
                </tr>

                <tr>
                <td style="text-align:center;color:blue"><?= $this->lang->line('expense'); ?></td>
                </tr>
                <tr>
                  <td><?= $this->lang->line('cash'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($today_cash_exp_total,2); ?></td>
                </tr>   
                <tr>
                  <td><?= $this->lang->line('mobile_money'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($today_momo_exp_total,2); ?></td>
                </tr>   
                <tr>
                  <td><?= $this->lang->line('bank'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($today_bank_exp_total,2); ?></td>
                </tr>  
                <tr>
                <td style="text-align:center;color:blue"><?= $this->lang->line('purchase'); ?></td>
                </tr>
                <tr>
                  <td><?= $this->lang->line('cash'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($today_cash_total_purchase_payment,2); ?></td>
                </tr>   
                <tr>
                  <td><?= $this->lang->line('mobile_money'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($today_momo_total_purchase_payment,2); ?></td>
                </tr>   
                <tr>
                  <td><?= $this->lang->line('bank'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($today_bank_total_purchase_payment,2); ?></td>
                </tr>  


                <td style="text-align:center;color:blue"><?= $this->lang->line('order'); ?></td>
                </tr>
                <tr>
                  <td><?= $this->lang->line('cash'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($total_cash_booking_paments,2); ?></td>
                </tr>   
                <tr>
                  <td><?= $this->lang->line('mobile_money'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($total_momo_booking_paments,2); ?></td>
                </tr>   
                <tr>
                  <td><?= $this->lang->line('bank'); ?></td>
                  <td class="text-right text-bold"><?php echo number_format($total_bank_booking_paments,2); ?></td>
                </tr>  
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
        <?= form_open('#', array('class' => 'form-horizontal', 'id' => 'profit-loss-report', 'enctype'=>'multipart/form-data', 'method'=>'POST'));?>
                           <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">      
        <div class="form-group">
                <label for="to_date" class="col-sm-2 control-label">Select Date</label>
                <div class="col-sm-3">
                <div class="input-group">
                  <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                    <span>
                      <i class="fa fa-calendar"></i> Select Date Range
                    </span>
                    <i class="fa fa-caret-down"></i>
                  </button>
                </div>
              </div>
           
        <!-- Your Code -->
                </div> 
          <?= form_close(); ?>
            </div>
           
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
function convert_excel(type,file_name,table_name) {
    var fn; var dl;
    var elt = document.getElementById(table_name);
    var wb = XLSX.utils.table_to_book(elt, {sheet:"Sheet JS"});
    return dl ?
        XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
        XLSX.writeFile(wb, fn || (file_name+'.' + (type || 'xlsx')));
}
$(".btnExport").click(function(event) {
 convert_excel('xlsx','Porfit-Report-1','report-data');
});
$(".btnExport_2").click(function(event) {
 convert_excel('xlsx','Profit-Report-2','report-data-2');
});
$(".btnExport_3").click(function(event) {
 convert_excel('xlsx','Profit-by-items-Report','profit_by_item_table');
});
$(".btnExport_4").click(function(event) {
 convert_excel('xlsx','Profit-by-invoice-Report','profit_by_invoice_table');
});
$(".btnExport_5").click(function(event) {
 convert_excel('xlsx','Profit-Report-4','report-data-3');
});
$(".btnExport_6").click(function(event) {
 convert_excel('xlsx','Profit-Report-3','report-data-4');
});

function get_reports(report_type,table_name){
  $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
  var base_url=$("#base_url").val();
  return $.post(base_url+'reports/'+report_type, {from_date: get_start_date(), to_date: get_end_date()}, function(result) {
    //console.log(result);
    $("#"+table_name+" tbody").html(result);
    $(".overlay").remove();
  });
}
function get_all_reports(){
  get_reports('get_profit_by_item','profit_by_item_table');
  get_reports('get_profit_by_invoice','profit_by_invoice_table');
}
jQuery(document).ready(function($) {
   get_all_reports();
});

/*Date Range picker event*/
$('#daterange-btn').on('apply.daterangepicker', function(ev, picker) {
  get_all_reports();
});
/*end*/

</script>

<script src="<?php echo $theme_link; ?>js/balance.js"></script>
<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
    
    
</body>
</html>
