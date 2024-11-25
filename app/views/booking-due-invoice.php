<!DOCTYPE html>
<html>
<head>
<!-- TABLES CSS CODE -->
<title><?= $page_title;?></title>
<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" href="<?php echo $theme_link; ?>bootstrap/css/bootstrap.min.css">
<style type="text/css">
	body{
		font-family: arial;
		font-size: 12px;
		/*font-weight: bold;*/
		padding-top:15px;
	} 

	@media print {
        .no-print { display: none; }
    }
</style>
</head>
<body onload="window.print();"><!--   -->
	<?php
	$CI =& get_instance();
	
    $q1=$this->db->query("select * from db_company where id=1 and status=1");
    $res1=$q1->row();
    $company_name		=$res1->company_name;
    $company_mobile		=$res1->mobile;
    $company_phone		=$res1->phone;
    $company_email		=$res1->email;
    $company_country	=$res1->country;
    $company_state		=$res1->state;
    $company_city		=$res1->city;
    $company_address	=$res1->address;
    $company_postcode	=$res1->postcode;
    $company_gst_no		=$res1->gst_no;//Goods and Service Tax Number (issued by govt.)
    $company_vat_number		=$res1->vat_no;//Goods and Service Tax Number (issued by govt.)

  	$q3=$this->db->query("SELECT a.customer_name,a.mobile,a.phone,a.gstin,a.tax_number,a.email,
                           a.opening_balance,a.country_id,a.state_id,
                           a.postcode,a.address,b.booked_date,b.created_time,b.reference_no,
                           b.booking_code,b.sales_note,b.delivery_date,
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
                           db_booking b 
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
    $customer_address=$res3->address;
    $customer_postcode=$res3->postcode;
    $customer_gst_no=$res3->gstin;
    $customer_tax_number=$res3->tax_number;
    $customer_opening_balance=$res3->opening_balance;
    $sales_date=show_date($res3->booked_date);
    $reference_no=$res3->reference_no;
    $created_time=show_time($res3->created_time);
    $sales_code=$res3->booking_code;
    $sales_note=$res3->sales_note;
    $delivery_date=$res3->delivery_date;

    
    $subtotal=$res3->subtotal;
    $grand_total=$res3->grand_total;
    $other_charges_input=$res3->other_charges_input;
    $other_charges_tax_id=$res3->other_charges_tax_id;
    $other_charges_amt=$res3->other_charges_amt;
    $paid_amount=$res3->paid_amount;
    $discount_to_all_input=$res3->discount_to_all_input;
    $discount_to_all_type=$res3->discount_to_all_type;
    //$discount_to_all_type = ($discount_to_all_type=='in_percentage') ? '%' : 'Fixed';
    $tot_discount_to_all_amt=$res3->tot_discount_to_all_amt;
    $round_off=$res3->round_off;
    $payment_status=$res3->payment_status;
    
    if($discount_to_all_input>0){
    	$str="($discount_to_all_input%)";
    }else{
    	$str="(Fixed)";
    }

    if(!empty($customer_country)){
      $customer_country = $this->db->query("select country from db_country where id='$customer_country'")->row()->country;  
    }
    if(!empty($customer_state)){
      $customer_state = $this->db->query("select state from db_states where id='$customer_state'")->row()->state;  
    }

    $reference_no = $this->db->query("SELECT reference_no from db_booking where id='$sales_id'")->row()->reference_no;
    $payment_code = $this->db->query("SELECT payment_code from db_booking where id='$sales_id'")->row()->payment_code;

    ?>
	<table width="70%" align="center" >
		<tr>
			<td align="center">
				<span>													 
                <strong><?= $company_name; ?></strong><br>
                	<?php echo (!empty(trim($company_address))) ? $this->lang->line('company_address')."".$company_address."<br>" : '';?> 
		            <?= $company_city; ?>
		            <?php echo (!empty(trim($company_postcode))) ? "-".$company_postcode : '';?>
		            <br>
		            <?php echo (!empty(trim($company_gst_no))) ? $this->lang->line('gst_number').": ".$company_gst_no."<br>" : '';?>
		            <?php echo (!empty(trim($company_vat_number))) ? $this->lang->line('vat_number').": ".$company_vat_number."<br>" : '';?>
		            <?php if(!empty(trim($company_mobile))) 
		            		{ 
		            			echo $this->lang->line('phone').": ".$company_mobile;
		            			if(!empty($company_phone)){
		            				echo ",".$company_phone;
		            			}
		            			echo "<br>";
		            		}

		            ?> 
			</span>
			</td>
		</tr>
		<tr><td align="center"><strong>-----------------<?= $this->lang->line('invoice'); ?>-----------------</strong></td></tr>
		<tr>
			<td>
				<table width="100%">
					<tr>
						<td width="40%"><b><?= $this->lang->line('invoice_number'); ?> :#<?= $payment_code; ?></b></td>
						<td> <span style= "float:right;font-weight:600"><em>Reference No: </em><?php echo $reference_no?> </span></td>
					</tr>
					<tr>
						<td><?= $this->lang->line('name'); ?> : <b><?= $customer_name; ?></b></td>
					</tr>
					
				</table>
				
			</td>
		</tr>
		<tr>
			<td>

				<table width="100%" cellpadding="0" cellspacing="0"  >
					<thead>
					<tr style="border-top-style: dashed;border-bottom-style: dashed;border-width: 0.1px;">
						<th style="font-size: 11px; text-align: left;padding-left: 2px; padding-right: 2px;"><?= $this->lang->line('booking_due_payment'); ?></th>
					</tr>
					</thead>
					<tbody style="border-bottom-style: dashed;border-width: 0.1px;">
						<?php
			              $i=0;
			              $tot_qty=0;
			              $subtotal=0;
			              $tax_amt=0;
			              $q2=$this->db->query("select b.item_name,a.sales_qty,a.unit_total_cost,a.price_per_unit,a.tax_amt,c.tax,a.total_cost from db_bookeditems a,db_items b,db_tax c where c.id=a.tax_id and b.id=a.item_id and a.sales_id='$sales_id'");
			              foreach ($q2->result() as $res2) {
			                //   echo "<tr>";  
			                //   echo "<td style='padding-left: 2px; padding-right: 2px;' valign='top'>".++$i."</td>";
			                //   echo "<td style='padding-left: 2px; padding-right: 2px;'>".$res2->item_name."</td>";
			                //   echo "<td style='text-align: center;padding-left: 2px; padding-right: 2px;'>".$res2->sales_qty."</td>";
			                //   echo "<td style='text-align: right;padding-left: 2px; padding-right: 2px;'>".number_format(($res2->unit_total_cost),2,'.','')."</td>";
			                //   echo "<td style='text-align: right;padding-left: 2px; padding-right: 2px;' >".number_format(($res2->total_cost),2,'.','')."</td>";
			                //   echo "</tr>";  
			                  //$tot_qty+=$res2->sales_qty;
			                  $subtotal+=($res2->total_cost);
			                  $tax_amt+=$res2->tax_amt;
			              }
			              $before_tax = $subtotal-$tax_amt;
			              ?>
					
				   </tbody>
					<tfoot>
					
	               
	                <?php if(!empty($tot_discount_to_all_amt) && $tot_discount_to_all_amt!=0) {?>
					<tr>
						<td style=" padding-left: 2px; padding-right: 2px;" colspan="4" align="right"><?= $this->lang->line('discount'); ?> <?= ($discount_to_all_type=='in_percentage') ? $discount_to_all_input .'%' : $discount_to_all_input.'[Fixed]' ;?></td>
						<td style=" padding-left: 2px; padding-right: 2px;" align="right"><?= number_format(($tot_discount_to_all_amt),2,'.',''); ?></td>
					</tr>
					<?php } ?>
					

					<tr>
						<td style=" padding-left: 2px; padding-right: 2px;" colspan="4" align="right"><?= $this->lang->line('total'); ?></td>
						<td style=" padding-left: 2px; padding-right: 2px;" align="right"><?= $grand_total; ?></td>
					</tr>
					
					<!-- change_return_status -->
					<?php if(change_return_status()) {
						$change_return_amount = get_change_return_amount($sales_id); ?>
						<tr >
						<td style=" padding-left: 2px; padding-right: 2px; color:green" colspan="4" align="right"><?= $this->lang->line('amount_paid'); ?></td>
						<?php 
						 $date = date('Y-m-d');
						//  echo "$date";
						$payment=$this->db->query("SELECT new_amt_paid from db_booking where id = '$sales_id'")->row()->new_amt_paid;?>
						<td style=" padding-left: 2px; padding-right: 2px; color:green" align="right"><?= number_format(($payment),2,'.','');?></td>
					</tr>
						<tr>
							<td style=" padding-left: 2px; padding-right: 2px;" colspan="4" align="right"><?= $this->lang->line('total_amt_paid'); ?></td>
							<td style=" padding-left: 2px; padding-right: 2px;" align="right"><?= number_format($paid_amount+$change_return_amount,2,'.',''); ?></td>
						</tr>
				
					<?php }
					else{ ?>
					
						<tr>
						<td style=" padding-left: 2px; padding-right: 2px;" colspan="4" align="right"> <?= $this->lang->line('amount_paid'); ?></td>
						<td style=" padding-left: 2px; padding-right: 2px;" align="right"><?= number_format($paid_amount,2,'.',''); ?></td>
					</tr>
					
					<?php } ?>
					<tr>
						<td style=" padding-left: 2px; padding-right: 2px;" colspan="4" align="right"><?= $this->lang->line('due_amount'); ?></td>
						<td style=" padding-left: 2px; padding-right: 2px;" align="right"><?php if(($grand_total-$paid_amount) > 0){echo number_format($grand_total-$paid_amount,2,'.',''); 
						}else{
							echo "<em style='font-weight:600'>Payment(s) Complete</em>";
						}
						 ?></td>
					</tr>
					
					<tr>
						<td colspan="5" align="center">----------<?= $this->lang->line('thanks_you_visit_again'); ?>----------</td>
					</tr>

					<tr>
						<td colspan="5" align="center">
						
							<div style="display:inline-block;vertical-align:middle;line-height:16px !important;">	
								<img class="center-block" style=" width: 100%; opacity: 1.0" src="<?php echo base_url();?>barcode/<?php echo $sales_code;?>">
							</div>
						
						</td>
					</tr>

					</tfoot>
				</table>
			</td>
		</tr>
	</table>
	<center >
  <div class="row no-print">
  <div class="col-md-12">
  <div class="col-md-2 col-md-offset-5 col-xs-4 col-xs-offset-4 form-group">
    <button type="button" id="" class="btn btn-block btn-success btn-xs" onclick="window.print();" title="Print">Print</button>
    <?php if(isset($_GET['redirect'])){ ?>
		<a href="<?= base_url().$_GET['redirect'];?>"><button type="button" class="btn btn-block btn-danger btn-xs" title="Back">Back</button></a>
	<?php } ?>
   </div>
   </div>
   </div>

</center>
</body>
</html>