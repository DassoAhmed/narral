<!DOCTYPE html>
<html>
<head>
<!-- TABLES CSS CODE -->
<title><?= $page_title;?></title>
<link rel='shortcut icon' href='<?php echo $theme_link; ?>images/favicon.ico' />

<!-- Web Fonts
======================= -->
<link rel='stylesheet' href="<?php echo $theme_link; ?>css/popins.css" type='text/css'>

<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" href="<?php echo $theme_link; ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $theme_link; ?>css/all.css">
<link rel="stylesheet" href="<?php echo $theme_link; ?>css/style.css">
<style type="text/css">
	body{
    font-family: 'Open Sans', 'Martel Sans', sans-serif;
		font-size: 12px;
		font-weight: bold;
    color:#000;
		padding-top:15px;
	}
	.customer_name .customer_name_td{

	}
 
	@media print {
        .no-print { display: none; }
    }
   
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    font-family: 'Open Sans', 'Martel Sans', sans-serif;
}
    
</style>
</head>
<body  >
<?php
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
    $bank_details=$res1->bank_details;
    $terms_and_conditions=$res1->sales_terms_and_conditions;
    $company_logo=$res1->company_logo;
    $upi_code=$res1->upi_code;
    $upi_id=$res1->upi_id;
	$company_gst_no		=$res1->gst_no;//Goods and Service Tax Number (issued by govt.)
    $company_vat_number		=$res1->vat_no;//Goods and Service Tax Number (issued by govt.)
    $company_postcode	=$res1->postcode;
    if(!empty($upi_code)){
      //if(file_exists(base_url('uploads/upi/'.$upi_code))){
        $upi_code = base_url('uploads/upi/'.$upi_code);
     // }
    }
    else{
      $upi_code='';
    }

    $q4=$this->db->query("select sales_invoice_footer_text,currency_id from db_sitesettings where id=1");
    $res4=$q4->row();
    $sales_invoice_footer_text=$res4->sales_invoice_footer_text;
    $currency_id=$res4->currency_id;
    
    $q3=$this->db->query("SELECT a.id,a.customer_name,a.mobile,a.phone,a.gstin,a.tax_number,a.email,
                           a.opening_balance,a.country_id,a.state_id,a.city,
                           a.postcode,a.address,b.sales_date,b.created_time,b.reference_no,
                           b.sales_code,b.sales_note,b.sales_status,
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
                           b.payment_status

                           FROM db_customers a,
                           db_sales b 
                           WHERE 
                           a.`id`=b.`customer_id` AND 
                           b.`id`='$sales_id' 
                           ");
                           /*GROUP BY 
                           b.`customer_code`*/
    
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
    $sales_date=$res3->sales_date;
    //$due_date=$res3->due_date;
    $created_time=$res3->created_time;
    $reference_no=$res3->reference_no;
    $sales_code=$res3->sales_code;
    $sales_note=$res3->sales_note;
    $sales_status=$res3->sales_status;
    $customer_id=$res3->id;

    
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
    
    if(!empty($customer_country)){
      $customer_country = $this->db->query("select country from db_country where id='$customer_country'")->row()->country;  
    }
    if(!empty($customer_state)){
      $customer_state = $this->db->query("select state from db_states where id='$customer_state'")->row()->state;  
    }
    

    ?>
<!-- Container -->
<div class="container-fluid invoice-container" style=" font-weight:900;">
  <!-- Header -->
  <header>
  <div class="row align-items-center">
    
    <div class="col-sm-5 text-center text-sm-end">
      <h4 class="text-7 mb-0">---------Invoice---------</h4>
    </div>
  </div>
  <hr style="height:3px">
  </header>
  
  <!-- Main Content -->
  <main>
  <div class="row">
  <center>
   <div class="col-sm-6 text-sm-end"> <strong>Invoice No:</strong> <?= $sales_code; ?></div>
    <div class="col-sm-6"><strong><?= $this->lang->line('date').":"; ?></strong> <?= $sales_date; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><?= $this->lang->line('time').":"; ?></span> <?= $created_time; ?></div>
    
    <?php  $sales_code = $this->db->query("SELECT sales_code from db_sales where id='$sales_id'")->row()->sales_code; ?>
    <?php  $currency = $this->db->query("SELECT currency_name from db_currency where id='$currency_id'")->row()->currency_name; ?>
	  </center>
  </div>
  <hr style="height:3px">
  <div class="row">
    <div class="col-sm-6 text-sm-end order-sm-1"> <strong>Pay To:</strong>
      <address>
      <?= $company_name; ?><br />
	  <?php echo (!empty(trim($company_address))) ? $this->lang->line('company_address')."".$company_address."<br>" : '';?> 
	 
	  <?php echo (!empty(trim($company_gst_no))) ? $this->lang->line('gst_number').": ".$company_gst_no."<br>" : '';?>
		<?php echo (!empty(trim($company_vat_number))) ? $this->lang->line('vat_number').": ".$company_vat_number."<br>" : '';?>
		
		<?php if(!empty(trim($company_mobile))) 
			{ 
				echo $this->lang->line('phone').": ".$company_mobile;
				if(!empty($company_phone)){
					echo ",".$company_phone;
				}
				// echo "<br>";
			}

		?> 
      </address>
    </div>
    <div class="col-sm-6 order-sm-0"> <strong>Invoiced To:</strong>
    <?= $customer_name; ?>
  
	<address>
	<br />
	<?php echo (!empty(trim($customer_mobile))) ? $this->lang->line('customer_mobile')."".$customer_mobile."<br>" : '';?>
	
      </address>
    </div>
  </div>
	
  <div class="card">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table width="100%" class="tabl table-bordered" style="border: 1px solid black;font-weight:900;">
		<thead class="card-header">
          <tr>
            <td class="col-1"><strong><?= $this->lang->line('designation'); ?></strong></td>
            <td class="col-3 text-center"><strong><?= $this->lang->line('quantity'); ?></strong></td>
			<td class="col-3 text-center"><strong><?= $this->lang->line('unit_price'); ?></strong></td>
            <td class="col-3 text-end"><strong><?= $this->lang->line('total'); ?></strong></td>
          </tr>
        </thead>
          <tbody>
		  <?php
			              $i=0; 
			              $tot_qty=0;
			              $subtotal=0;
			              $tax_amt=0;
			              $q2=$this->db->query("SELECT b.item_name,a.sales_qty,a.unit_total_cost,a.retail_price_per_unit,a.price_per_unit,a.tax_amt,c.tax,a.total_cost,a.bag_qty,a.kg_qty,d.short_name,d.base_unit, d.operator_value from db_salesitems a,db_items b,db_tax c, db_units d where c.id=a.tax_id and b.id=a.item_id and d.id=a.unit_id and a.sales_id='$sales_id'");
			              foreach ($q2->result() as $res2) {
                      $short_name1 = $this->db->query("SELECT short_name from db_units where id ='$res2->base_unit'")->row()->short_name;
			                  echo "<tr>";  
                        echo "<td class='col-3 text-1'>".$res2->item_name."</td>";
                        if($res2->bag_qty>0 && $res2->kg_qty >0){
                          echo "<td class='col-3 text-center'style='width: 100%;display: flex;padding: 3px;'> <span style='width: 100%;'>".$res2->bag_qty/$res2->operator_value." ".$short_name1."<br>".$res2->kg_qty." ".$res2->short_name."</span> </td>";
                          echo "<td style='text-align: right;padding-left: 2px; padding-right: 2px;'>".number_format(($res2->unit_total_cost),2,'.','')." ".$currency."</td>";
                          echo "<td style='text-align: right;padding-left: 1px; padding-right: 3px;' >  ".number_format(($res2->total_cost),2,'.','')." ".$currency."</td>";
                        }else if($res2->bag_qty>0 && $res2->kg_qty ==null){
                          echo "<td class='col-3 text-center'style='width: 100%;display: flex;padding: 3px;'> <span style='width: 100%;'>".$res2->bag_qty/$res2->operator_value." ".$short_name1."</span> </td>";
                          echo "<td style='text-align: right;padding-left: 2px; padding-right: 2px;'>".number_format(($res2->unit_total_cost),2,'.','') * $res2->operator_value." ".$currency."</td>";
                          echo "<td style='text-align: right;padding-left: 1px; padding-right: 3px;' >  ".number_format(($res2->total_cost),2,'.','')." ".$currency."</td>";
                          
                        }else{
                          echo "<td class='col-3 text-center'style='width: 100%;display: flex;padding: 3px;'> <span style='width: 100%;'>".$res2->kg_qty." ".$res2->short_name."</span> </td>";

                          echo "<td style='text-align: right;padding-left: 2px; padding-right: 2px;'>".number_format(($res2->retail_price_per_unit),2,'.','')." ".$currency."</td>";
                          echo "<td style='text-align: right;padding-left: 1px; padding-right: 3px;' >  ".number_format(($res2->total_cost),2,'.','')." ".$currency."</td>";
                        }
			                  
			                  // echo "<td style='text-align: right;padding-left: 2px; padding-right: 2px;'>".number_format(($res2->unit_total_cost),2,'.','')." ".$currency."</td>";
			                  echo "</tr>";  
			                  //$tot_qty+=$res2->sales_qty;
			                  $subtotal+=($res2->total_cost);
			                  $tax_amt+=$res2->tax_amt;
			              }
			              $before_tax = $subtotal-$tax_amt;
			              ?>
           
          </tbody>
		  <tfoot class="card-footer">
			<tr>
              <td colspan="3" class="text-end"><strong><?= $this->lang->line('total'); ?></strong></td>
              <td class="text-end"><?=($grand_total + $discount_to_all_input) . " " .$currency ; ?></td>
            </tr>
			<tr>
              <td colspan="3" class="text-end"><strong><?= $this->lang->line('discount'); ?></strong></td>
              <td class="text-end"><?=$discount_to_all_input . " " .$currency ; ?></td>
            </tr>
			<tr>
              <td colspan="3" class="text-end border-bottom-0"><strong><?= $this->lang->line('amount_paid'); ?></strong></td>
              <td class="text-end border-bottom-0"><?=  number_format($paid_amount,2,'.','') ." ".$currency; ?></td>
            </tr>
			<tr>
              <td colspan="3" class="text-end border-bottom-0"><strong><?= $this->lang->line('due_amount'); ?></strong></td>
              <td class="text-end border-bottom-0"><?= number_format($grand_total-$paid_amount,2,'.','') ." ".$currency; ?></td>
            </tr>
		  </tfoot>
        </table>
      </div>
    </div>
  </div>
  </main>
  <!-- Footer -->
  <footer class="text-center mt-4">
  <p class="text-1">----------<?= $this->lang->line('thanks_you_visit_again'); ?>----------</p>
  <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a> <a href="" class="btn btn-light border text-black-50 shadow-none"></a> </div>
  </footer>
</div>
</body>
</html>