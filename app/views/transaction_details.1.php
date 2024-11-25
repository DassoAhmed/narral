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
        <li><a href="<?php echo $base_url; ?>booking"><?= $this->lang->line('supply_list'); ?></a></li>
        <li><a href="<?php echo $base_url; ?>booking/add"><?= $this->lang->line('new_booking'); ?></a></li>
        <li class="active"><?= $this->lang->line('invoice'); ?></li>
      </ol>
    </section>
    <?= form_open('#', array('class' => '', 'id' => 'table_form')); ?>
    <input type="hidden" id='base_url' value="<?=$base_url;?>">
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



    $q3=$this->db->query("SELECT a.supplier_name,a.mobile,a.phone,
                           b.tran_code,a.email, a.address,a.postcode, b.delivered_date

                           FROM db_suppliers a,
                           db_bookingsupply b 
                           WHERE 
                           a.`id`=b.`supplier_id` AND 
                           b.`delivered_date`='$delivered_date' 
                           ");
                        
    
    $res3=$q3->row();
    $customer_name=$res3->supplier_name;
    $customer_mobile=$res3->mobile;
    $customer_phone=$res3->phone;
    $customer_email=$res3->email;
    $customer_address=$res3->address;
    $customer_postcode=$res3->postcode;
    $delivered_date=$res3->delivered_date;
    $tran_code=$res3->tran_code;
  

    
    
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
            <i class="fa fa-globe"></i> <?= $this->lang->line('supply_list'); ?>
            <small class="pull-right" style="color:magenta;text-decoration:underline; font-family:poppins;font-weight:600;">Delivery Date: <?php echo  show_date($delivered_date) ?></small>
          </h2>
        </div>
       
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
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
        <div class="col-sm-6 invoice-col" >
          <i><?= $this->lang->line('supplier_details'); ?><br></i>
          <address>
            <strong><?php echo  $customer_name; ?></strong><br>
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
              if(!empty($customer_postcode)){
                echo "-".$customer_postcode;
              }
            ?>
            <?php echo (!empty(trim($customer_phone))) ? $this->lang->line('phone').": ".$customer_phone."<br>" : '';?>
            <?php echo (!empty(trim($customer_mobile))) ? $this->lang->line('mobile').": ".$customer_mobile."<br>" : '';?>
            <?php echo (!empty(trim($customer_email))) ? $this->lang->line('email').": ".$customer_email."" : '';?>
          </address>
        </div>
        <!-- /.col -->
      

<div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
          <?php  $reference_no = $this->db->query("select reference_no from db_bookingtransactions where delivered_date='$delivered_date'")->row()->reference_no;   ?>
          <em style="color:magenta;text-decoration:underline; font-family:poppins;font-weight:600;align:cnter"><?= $this->lang->line('reference_no'); ?> :<?php echo  $reference_no; ?></em><br> </small>
          </h2>
        </div>
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table id="transaction_datatable" class="table table-striped records_table table-bordered" width="100%">
            <thead class="bg-gray-active">
            <tr>
              <th>#</th>
              <th><?= $this->lang->line('item_name'); ?></th>
              <th><?= $this->lang->line('customer_name'); ?></th>
              <th><?= $this->lang->line('quantity'); ?></th>
            </tr>
            </thead>
            <tbody>

              <?php
              // $i=0;
              // $tot_qty=0;
              // $tot_sales_price=0;
              // $tot_tax_amt=0;
              // $tot_discount_amt=0;
              // $tot_total_cost=0;

              // $q2=$this->db->query("SELECT d.tran_code, a.delivered_date,b.supplier_name, c.customer_name, a.qty_taken,a.reference_no,
              //   a.item_name
              //   FROM 
              //   db_bookingtransactions AS a,db_suppliers AS b,db_customers AS c,db_bookingsupply AS d
              //   WHERE b.id=a.supplier_id AND c.id=a.customer_id AND d.id=a.sales_item_id AND
              //   a.delivered_date='$delivered_date'");
              // foreach ($q2->result() as $res2) {
              //     echo "<tr>";  
              //     echo "<td>".++$i."</td>";
              //     echo "<td>";
              //       echo $res2->item_name;
              //     echo "</td>";
              //     echo "<td>".$res2->customer_name."</td>";
                 
                  
              //     echo "<td>".$res2->qty_taken."</td>";
              //     echo "</tr>";  
              //     $tot_qty +=$res2->qty_taken;
              // }
              ?>
         
      
            </tbody>
            <tfoot class="text-right text-bold bg-gray">
            <!-- <tr>
                <td colspan="3" class="text-center"><?= $this->lang->line('total'); ?></td>
                <td class="text-left"><?=$tot_qty;?></td>
               
              </tr> -->
          </table>
        </div>
        <!-- /.col -->
      </div> 
      <!-- /.row -->
    
     

    </div><!-- printableArea -->
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">

          <a href="<?php echo $base_url; ?>booking/pdf/<?php echo  $tran_code ?>" target="_blank" class="btn btn-info">
              <i class="fa fa-file-pdf-o"></i> 
            PDF
          </a>
       
          
          
        </div>
      </div>
      <?form_close(); ?>
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
<script type="text/javascript">
$(document).ready(function() {
    //datatables
   var table = $('#transaction_datatable').DataTable({ 
 
      /* FOR EXPORT BUTTONS START*/
  dom:'<"row margin-bottom-12"<"col-sm-12"<"pull-left"l><"pull-right"fr><"pull-right margin-left-10 "B>>>tip',
 /* dom:'<"row"<"col-sm-12"<"pull-left"B><"pull-right">>> <"row margin-bottom-12"<"col-sm-12"<"pull-left"l><"pull-right"fr>>>tip',*/
      buttons: {
        buttons: [
            {
                className: 'btn bg-red color-palette btn-flat hidden delete_btn pull-left',
                text: 'Delete',
                action: function ( e, dt, node, config ) {
                    multi_delete();
                }
            },
            { extend: 'copy', className: 'btn bg-teal color-palette btn-flat',exportOptions: { columns: [0,1,2]} },
            { extend: 'excel', className: 'btn bg-teal color-palette btn-flat',exportOptions: { columns: [0,1,2]} },
            { extend: 'pdf', className: 'btn bg-teal color-palette btn-flat',exportOptions: { columns: [0,1,2]} },
            { extend: 'print', className: 'btn bg-teal color-palette btn-flat',exportOptions: { columns: [0,1,2]} },
            { extend: 'csv', className: 'btn bg-teal color-palette btn-flat',exportOptions: { columns: [0,1,2]} },
            { extend: 'colvis', className: 'btn bg-teal color-palette btn-flat',text:'Columns' },  

            ]
        },
        /* FOR EXPORT BUTTONS END */

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "responsive": true,
        language: {
            processing: '<div class="text-primary bg-primary" style="position: relative;z-index:100;overflow: visible;">Processing...</div>'
        },
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('booking/new_ajax_transactions_lists')?>",
            "type": "POST",
            
            complete: function (data) {
             },

        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 3 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        {
            "targets" :[],
            "className": "text-center",
        },
        
        ],
    });
    new $.fn.dataTable.FixedHeader( table );
});
</script>
<!-- Make sidebar menu hughlighter/selector -->
<script>$(".transactions-list-active-li").addClass("active");</script>
</body>
</html>
