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
        <?= $this->lang->line('invoice'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $base_url; ?>booking"><?= $this->lang->line('booking_list'); ?></a></li>
        <li><a href="<?php echo $base_url; ?>booking/add"><?= $this->lang->line('new_booking'); ?></a></li>
        <li class="active"><?= $this->lang->line('invoice'); ?></li>
      </ol>
    </section>
    <div class="row">
      <div class="col-md-12">
      <!-- ********** ALERT MESSAGE START******* -->
      <?php include"comman/code_flashdata.php"; ?>
      <!-- ********** ALERT MESSAGE END******* -->
      </div>
    </div>
    <?php
    $CI =& get_instance();
    $q1=$this->db->query("select * from db_company where id=1 and status=1");
    $res1=$q1->row();
    $company_name=$res1->company_name;
    $company_mobile=$res1->mobile;
    $company_phone=$res1->phone;
    $company_email=$res1->email;
    $company_country=$res1->country;
    $company_state=$res1->state;
    $company_city=$res1->city;
    $company_address=$res1->address;
    $company_gst_no=$res1->gst_no;
    $company_vat_no=$res1->vat_no;
    $company_pan_no=$res1->pan_no;

    
    $q3=$this->db->query("SELECT a.customer_name,a.mobile,a.phone,a.gstin,a.tax_number,a.email,
                           a.opening_balance,a.country_id,a.state_id,a.city,
                           a.postcode,a.address,b.booked_date,b.created_time,b.reference_no,
                           b.booking_code,b.booking_status,b.qty_booked,b.sales_note,
                           coalesce(b.grand_total,0) as grand_total,
                           coalesce(b.subtotal,0) as subtotal,
                           coalesce(b.paid_amount,0) as paid_amount,
                           coalesce(b.other_charges_input,0) as other_charges_input,
                           other_charges_tax_id,
                           coalesce(b.other_charges_amt,0) as other_charges_amt,
                           discount_to_all_input,
                           b.discount_to_all_type,
                           coalesce(b.tot_discount_to_all_amt,0) as tot_discount_to_all_amt,
                           coalesce(b.round_off,0) as round_off,
                           b.payment_status,b.pos

                           FROM db_customers a,
                           db_booking b 
                           WHERE 
                           a.`id`=b.`customer_id` AND 
                           b.`reference_no`='$reference_no' 
                           ");
                        
    
    $res3=$q3->row();
    $customer_name=$res3->customer_name;
    $customer_mobile=$res3->mobile;
    $customer_phone=$res3->phone;
    $customer_email=$res3->email;
    $customer_country=$res3->country_id;
    $customer_state=$res3->state_id;
    $customer_city=$res3->city;
    $customer_address=$res3->address;
    $customer_postcode=$res3->postcode;
    $customer_gst_no=$res3->gstin;
    $customer_tax_number=$res3->tax_number;
    $customer_opening_balance=$res3->opening_balance;
    $sales_date=$res3->booked_date;
    $created_time=$res3->created_time;
    $sales_code=$res3->booking_code;
    $sales_status=$res3->booking_status;
    $sales_note=$res3->sales_note;
    $reference_no=$res3->reference_no;

    
    $qty_taken= $res3->qty_booked;
    $subtotal=$res3->subtotal;
    $grand_total=$res3->grand_total;
    $other_charges_input=$res3->other_charges_input;
    $other_charges_tax_id=$res3->other_charges_tax_id;
    $other_charges_amt=$res3->other_charges_amt;
    $paid_amount=$res3->paid_amount;
    $discount_to_all_input=$res3->discount_to_all_input;
    $discount_to_all_type=$res3->discount_to_all_type;
    $discount_to_all_type = ($discount_to_all_type=='in_percentage') ? '%' : 'Fixed';
    $tot_discount_to_all_amt=$res3->tot_discount_to_all_amt;
    $round_off=$res3->round_off;
    $payment_status=$res3->payment_status;
    $pos=$res3->pos;
    
    if(!empty($customer_country)){
      $customer_country = $this->db->query("select country from db_country where id='$customer_country'")->row()->country;  
    }
    if(!empty($customer_state)){
      $customer_state = $this->db->query("select state from db_states where id='$customer_state'")->row()->state;  
    }
    
    ?>


    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="printableArea">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> <?= $this->lang->line('booking_invoice'); ?>
            <small class="pull-right">Date: <?php echo  show_date($sales_date)." ".$created_time; ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <i><?= $this->lang->line('from'); ?></i>
          <address>
            <strong><?php echo  $company_name; ?></strong><br>
            <?php echo  $company_address; ?>,
            <?= $this->lang->line('city'); ?>:<?php echo  $company_city; ?><br>
            <?= $this->lang->line('phone'); ?>: <?php echo  $company_phone; ?>,
            <?= $this->lang->line('mobile'); ?>: <?php echo  $company_mobile; ?><br>
            <?php echo (!empty(trim($company_email))) ? $this->lang->line('email').": ".$company_email."<br>" : '';?>
            <?php echo (!empty(trim($company_gst_no))) ? $this->lang->line('gst_number').": ".$company_gst_no."<br>" : '';?>
            <?php echo (!empty(trim($company_vat_no))) ? $this->lang->line('vat_number').": ".$company_vat_no."<br>" : '';?>
            <?php echo (!empty(trim($company_pan_no))) ? $this->lang->line('vat_number').": ".$company_pan_no."<br>" : '';?>
           
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
         
          <address>
            <strong style="color:#00c0ef;text-decoration:underline;"><?php echo  $customer_name; ?> 's Transaction Details</strong><br>
            <?php 
              if(!empty($customer_address)){
                echo $customer_address;
              }
              if(!empty($customer_country)){
                echo $customer_country;
              }
              if(!empty($customer_state)){
                echo ",".$customer_state;
              }
              if(!empty($customer_city)){
                echo ",".$customer_city;
              }
              if(!empty($customer_postcode)){
                echo "-".$customer_postcode;
              }
            ?>
            <br>
            <?php echo (!empty(trim($customer_mobile))) ? $this->lang->line('mobile').": ".$customer_mobile."<br>" : '';?>
            <?php echo (!empty(trim($customer_phone))) ? $this->lang->line('phone').": ".$customer_phone."<br>" : '';?>
            <?php echo (!empty(trim($customer_email))) ? $this->lang->line('email').": ".$customer_email."<br>" : '';?>
            <?php echo (!empty(trim($customer_gst_no))) ? $this->lang->line('gst_number').": ".$customer_gst_no."<br>" : '';?>
            <?php echo (!empty(trim($customer_tax_number))) ? $this->lang->line('tax_number').": ".$customer_tax_number."<br>" : '';?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b><?= $this->lang->line('invoice'); ?> #<?php echo  $sales_code; ?></b><br>
          <b><?= $this->lang->line('booking_status'); ?> :<?php echo  $sales_status; ?></b><br>

              <br><br> 

          <b style="color:magenta;font-size:18px; text-decoration:underline" ><?= $this->lang->line('booking_status'); ?> :<?php echo  $reference_no; ?></b><br>
         
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped records_table table-bordered">
            <thead class="bg-gray-active">
            <tr>
              <th>#</th>
              <th><?= $this->lang->line('transaction_date'); ?></th>
              <th><?= $this->lang->line('item_name'); ?></th>
              <th><?= $this->lang->line('quantity'); ?></th>
              <th><?= $this->lang->line('unit_price'); ?></th>
              <th><?= $this->lang->line('net_cost'); ?></th>
            </tr>
            </thead>
            <tbody>

              <?php
              $i=0;
              $tot_qty=0;
              $tot_sales_price=0;
              $tot_tax_amt=0;
              $tot_discount_amt=0;
              $tot_total_cost=0;

              $q2=$this->db->query("SELECT a.description, c.item_name, a.sales_qty,
                                  a.price_per_unit, 
                                  a.unit_discount_per,a.discount_amt, a.unit_total_cost,
                                  a.total_cost ,a.tax_amt, a.created_date, a.created_time, a.tax_type, b.tax_name
                                  FROM 
                                  db_bookeditems AS a,db_tax AS b,db_items AS c
                                  WHERE 
                                  c.id=a.item_id AND a.reference_no='$reference_no'");
              foreach ($q2->result() as $res2) {
                  $str = ($res2->tax_type=='Inclusive')? 'Inc.' : 'Exc.';
                  $discount = (empty($res2->unit_discount_per)||$res2->unit_discount_per==0)? '0':$res2->unit_discount_per."%";
                  $discount_amt = (empty($res2->discount_amt)||$res2->unit_discount_per==0)? '0':$res2->discount_amt."";
                  echo "<tr>";  
                  echo "<td>".++$i."</td>";
                  echo "<td>".$res2->created_date. ' / ' .$res2->created_time."</td>";
                  echo "<td>";
                 
                    echo $res2->item_name;
                    echo (!empty($res2->description)) ? "<br><i>[".nl2br($res2->description)."]</i>" : '';
                  echo "</td>";
                  echo "<td>".$res2->sales_qty."</td>";
                  echo "<td class='text-right'>".$CI->currency(number_format($res2->price_per_unit,2,'.',''))."</td>";
                  echo "<td class='text-right'>".$CI->currency(number_format($res2->total_cost,2,'.',''))."</td>";
                  echo "</tr>";  
                  $tot_qty +=$res2->sales_qty;
                  $tot_sales_price +=$res2->price_per_unit;
                  // $tot_tax_amt +=$res2->tax_amt;
                  $tot_discount_amt +=$res2->discount_amt;
                  $tot_total_cost +=$res2->total_cost;
              }
              ?>
         
      
            </tbody>
            <tfoot class="text-right text-bold bg-gray">
              <tr>
                <td colspan="2" class="text-center">Total</td>
                <td>*</td>
                <td><?= $tot_qty ;?></td>
                <td>*</td>
                <td><?= $CI->currency(number_format($tot_total_cost,2,'.','')) ;?></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

<hr>

     <!-- Table row -->
     <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped records_table table-bordered">
            <thead class="bg-gray-active">
            <tr>
              <th>#</th>
              <th><?= $this->lang->line('transaction_date'); ?></th>
              <th><?= $this->lang->line('reference_no'); ?></th>
              <th><?= $this->lang->line('qty_booked'); ?></th>
              <th><?= $this->lang->line('sub_total'); ?></th>
              <th><?= $this->lang->line('other_charges_amt'); ?></th>
              <th><?= $this->lang->line('discount_to_all_input'); ?></th>
              <th><?= $this->lang->line('tot_discount_to_all_amt'); ?></th>
              <th><?= $this->lang->line('grand_total'); ?></th>
              <th><?= $this->lang->line('amount_paid'); ?></th>
            </tr>
            </thead>
            <tbody>

              <?php
              $i=0;
              $tot_subtotal=0;
              $tot_other_charges_amt=0;
              $tot_tot_discount_to_all_amt=0;
              $tot_grand_total=0;
              $tot_paid_amount=0;
              $g_total_booked =0;
              $total_qty_taken =0;
              $total_qty_left =0;

              $q3=$this->db->query("SELECT *  FROM db_booking WHERE reference_no='$reference_no'");
              foreach ($q3->result() as $res3) {
                  echo "<tr>";  
                  echo "<td>".++$i."</td>";
                  echo "<td>".$res3->created_date. ' / ' .$res3->created_time."</td>";
                  echo "<td>";
                    echo $res3->reference_no;
                  echo "</td>";
                  echo "<td class='text-right'>".$res3->qty_booked."</td>";
                  echo "<td class='text-right'>".$CI->currency(number_format($res3->subtotal,2,'.',''))."</td>";
                 
                  echo "<td class='text-right'>".$CI->currency(number_format($res3->other_charges_amt,2,'.',''))."</td>";
                  echo "<td class='text-right'>".$CI->currency(number_format($res3->discount_to_all_input,2,'.',''))."</td>";
                  echo "<td class='text-right'>".$CI->currency(number_format($res3->tot_discount_to_all_amt,2,'.',''))."</td>";
                  echo "<td class='text-right'>".$CI->currency(number_format($res3->grand_total,2,'.',''))."</td>";
                  echo "<td class='text-right'>".$CI->currency(number_format($res3->paid_amount,2,'.',''))."</td>";
                  echo "</tr>";  
                  $g_total_booked +=$res3->qty_booked;
                  $tot_subtotal +=$res3->subtotal;
                  $total_qty_taken +=$res3->qty_booked;
                  $tot_other_charges_amt +=$res3->other_charges_amt;
                  $tot_tot_discount_to_all_amt +=$res3->tot_discount_to_all_amt;
                  $tot_grand_total +=$res3->grand_total;
                  $tot_paid_amount +=$res3->paid_amount;
              }
              ?>
         
      
            </tbody>
            <tfoot class="text-right text-bold bg-gray">
              <tr>
                <td colspan="2" class="text-center">Total</td>
                <td>*</td>
                <td><?= $g_total_booked ?></td>
                <td><?= $CI->currency(number_format($tot_subtotal,2,'.','')) ;?></td>
                <td><?= $CI->currency(number_format($tot_other_charges_amt,2,'.','')) ;?></td>
                <td>*</td>
                <td><?= $CI->currency(number_format($tot_tot_discount_to_all_amt,2,'.','')) ;?></td>
                <td><?= $CI->currency(number_format($tot_grand_total,2,'.','')) ;?></td>
                <td><?= $CI->currency(number_format($tot_paid_amount,2,'.','')) ;?></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->



    
      <div class="row">
       <div class="col-md-6">
     
       <hr style="color:green; border:1px solid green" />
       

           <div class="row">
              <div class="col-md-12">
                 <div class="form-group">
                    <table class="table table-hover table-bordered" style="width:100%" id=""><h4 class="box-title text-info"><?= $this->lang->line('payments_information'); ?> : </h4>
                       <thead>
                          <tr class="bg-green " >
                             <th>#</th>
                             <th><?= $this->lang->line('date'); ?></th>
                             <th><?= $this->lang->line('payment_type'); ?></th>
                             <th><?= $this->lang->line('payment_note'); ?></th>
                             <th><?= $this->lang->line('payment'); ?></th>
                          </tr>
                       </thead>
                       <tbody> 
                          <?php 
                            if(isset($reference_no)){
                              $q5 = $this->db->query("SELECT * from db_bookingpayments WHERE reference_no ='$reference_no'");
                              if($q5->num_rows()>0){
                                $i=1;
                                $total_paid = 0;
                                foreach ($q5->result() as $res5) {
                                  echo "<tr class='text-center text-bold' id='payment_row_".$res5->id."'>";
                                  echo "<td>".$i++."</td>";
                                  echo "<td>".show_date($res5->payment_date)."</td>";
                                  echo "<td>".$res5->payment_type."</td>";
                                  echo "<td>".$res5->payment_note."</td>";
                                  echo "<td class='text-right'>".$res5->payment."</td>";
                                  echo "</tr>";
                                  $total_paid +=$res5->payment;
                                }
                                echo "<tr class='text-right text-bold'><td colspan='4' >Total</td><td>".number_format($total_paid,2,'.','')."</td></tr>";
                              }
                              else{
                                echo "<tr><td colspan='5' class='text-center text-bold'>No Previous Payments Found!!</td></tr>";
                              }

                            }
                            else{
                              echo "<tr><td colspan='5' class='text-center text-bold'>Payments Pending!!</td></tr>";
                            }
                          ?>
                       </tbody>
                    </table>
                 </div>
              </div>
           </div>           
        </div> 


    </div><!-- printableArea -->
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
       


          <a href="<?php echo $base_url; ?>bookingS/print_invoice/<?php echo  $reference_no ?>" target="_blank" class="btn btn-warning">
            <i class="fa fa-print"></i> 
          Print
        </a>

        <a target="_blank" class="btn btn-info pointer" onclick="print_invoice(<?=$reference_no?>)">
            <i class="fa fa-file-text"></i> 
          POS Invoice
        </a>


        <a href="<?php echo $base_url; ?>booking/pdf/<?php echo  $reference_no ?>" target="_blank" class="btn btn-primary">
            <i class="fa fa-file-pdf-o"></i> 
          PDF
        </a>
        
        
       
          
          
        </div>
      </div>

    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
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
<script type="text/javascript">
  function print_invoice(id){
  window.open("<?= base_url();?>pos/print_invoice_pos/"+id, "_blank", "scrollbars=1,resizable=1,height=500,width=500");
}
</script>
<!-- Make sidebar menu hughlighter/selector -->
<script>$(".sales-list-active-li").addClass("active");</script>
</body>
</html>
