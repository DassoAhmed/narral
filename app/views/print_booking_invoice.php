<!DOCTYPE html>
<html>
<title><?= $page_title;?>- Default Format</title>
<head>
<link rel='shortcut icon' href='<?php echo $theme_link; ?>images/favicon.ico' />

<style>
table, th, td {
    border-collapse: collapse;
    font-family: 'Open Sans', 'Martel Sans', sans-serif;
}
th, td {
    padding: 5px;
    /* border-right: 1px solid black; */

body {
    word-wrap: break-word; 
    margin: 67px;
    padding: 42px;
} 
</style>
</head>
<body onload="window.print();"><!--  -->
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

    $q4=$this->db->query("select sales_invoice_footer_text from db_sitesettings where id=1");
    $res4=$q4->row();
    $sales_invoice_footer_text=$res4->sales_invoice_footer_text;
    
    $q3=$this->db->query("SELECT a.customer_name,a.mobile,a.phone,a.gstin,a.email,
                           a.opening_balance,a.country_id,a.state_id,a.city,
                           a.postcode,a.address,b.booked_date,b.created_time,b.delivery_date,
                           b.booking_code,b.sales_note,b.booking_status, b.reference_no, 
                           coalesce(b.grand_total,0) as grand_total,
                           coalesce(b.subtotal,0) as subtotal,
                           coalesce(b.paid_amount,0) as paid_amount,
                           coalesce(b.other_charges_amt ,0) as other_charges_amt ,
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
    $customer_city=$res3->city;
    $customer_address=$res3->address;
    $customer_postcode=$res3->postcode;
    $customer_gst_no=$res3->gstin;
    $customer_opening_balance=$res3->opening_balance;
    $sales_date=$res3->booked_date;
    $created_time=$res3->created_time;
    $sales_code=$res3->booking_code;
    $sales_note=$res3->sales_note;
    $sales_status=$res3->booking_status;
    $reference_no =$res3->reference_no ;
    $delivery_date =$res3->delivery_date ;

    
    $subtotal=$res3->subtotal;
    $grand_total=$res3->grand_total;
    $paid_amount=$res3->paid_amount;
    $discount_to_all_input=$res3->discount_to_all_input;
    $discount_to_all_type=$res3->discount_to_all_type;
    $other_charges_amt=$res3->other_charges_amt;
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
         
<table align="center" height="400px">
    <thead >
      
      <tr>
          <th colspan="2"  style="padding-left: 15px; color:#000;">
            <b><?php echo $company_name; ?></b><br/>
            <?php echo $this->lang->line('address')." : ".$company_address; ?><br/>
            <?php echo $company_country; ?><br/>
            <?php echo $this->lang->line('mobile').":".$company_mobile; ?><br/>
            <?php echo (!empty(trim($company_email))) ? $this->lang->line('email').": ".$company_email."" : '';?>
            <?php echo (!empty(trim($company_gst_no))) ? $this->lang->line('gst_number').": ".$company_gst_no."" : '';?>
            <?php echo (!empty(trim($company_vat_no))) ? $this->lang->line('vat_number').": ".$company_vat_no."" : '';?>
          </th>
          <td>
          <?php 
  //Find Logo Path
    $logo=$this->db->query("select logo from db_sitesettings")->row()->logo;
  ?>
      <img src="<?php echo $base_url; ?>uploads/<?= $logo;?>" style="vertical-align: middle;
        border-radius: 100px;
        height: 65px;
        padding: 15px;
        border: 3px solid #024f48;">

          </td>
          <td colspan="2" style="padding-left: 15px;padding-top: 25px; color:#000;">
          <b style=""><?= $this->lang->line('reciepient'); ?></b><br/>
           <?php echo $this->lang->line('name').": ".$customer_name; ?><br>
          <?php echo (!empty(trim($customer_mobile))) ? $this->lang->line('mobile').": ".$customer_mobile."<br>" : '';?>
        
          <?php echo (!empty(trim($customer_email))) ? $this->lang->line('email').": ".$customer_email."<br>" : '';?>
          </td>
        
      </tr>
<tr>
<td colspan="4">
<strong style="text-align:center;text-decoration:underline;color:#000;"> 
              <?= $this->lang->line('invoice_no'); ?> : <?php echo "$sales_code"; ?><br>
          </strong></td>
</tr>
      <tr >
           
          <th colspan="2" rowspan="1">Issued <?= $this->lang->line('date'); ?> : <?php echo show_date($sales_date)." ".$created_time; ?></th>
          <th colspan="1" rowspan="1"><?= $this->lang->line('delivery_date'); ?> : <?php echo show_date($delivery_date); ?></th>
          <th style="text-align:right" colspan="2" rowspan="1"><b style="text-transform: capitalize;"><?= $this->lang->line('reference_no'); ?> </b>(<?=$reference_no ;?>) </th>
          
        </tr>

     
  
    
  <tr style="border:1px solid black">
    <th rowspan="2" style='text-align: left;border-right: 1px solid;border-top: 1px solid;width: 50px;'>S/N</th>
    <th rowspan='3'style='text-align: right;border-right: 1px solid;border-top: 1px solid;'><?= $this->lang->line('designation'); ?></th>
    <th rowspan='2'style='text-align: right;border-right: 1px solid;border-top: 1px solid;'><?= $this->lang->line('quantity'); ?></th>
    <!-- <th rowspan='2'><?= $this->lang->line('discount'); ?></th> -->
    <!-- <th rowspan='2'><?= $this->lang->line('discount_amount'); ?></th> -->
    <th rowspan='2'style='text-align: right;border-right: 1px solid;border-top: 1px solid;'><?= $this->lang->line('unit_cost'); ?></th>
    <th rowspan='2'style='text-align: right;border-right: 1px solid;border-top: 1px solid;'><?= $this->lang->line('total_amount'); ?></th>
  </tr>
  </thead>
<tbody>
  <tr style="border: 1px solid black;">
 <?php
              $i=0;
              $tot_qty=0;
              $tot_sales_price=0;
              $tot_tax_amt=0;
              $tot_discount_amt=0;
              $tot_unit_total_cost=0;
              $tot_total_cost=0;
              $q2=$this->db->query("SELECT c.item_name, a.sales_qty,
                                  a.price_per_unit, 
                                  a.unit_discount_per,a.discount_amt, a.unit_total_cost,
                                  a.total_cost ,a.reference_no
                                  FROM  
                                  db_bookeditems AS a,db_items AS c 
                                  WHERE 
                                  c.id=a.item_id  AND a.sales_id='$sales_id'");
              foreach ($q2->result() as $res2) {
                  $discount = (empty($res2->unit_discount_per)||$res2->unit_discount_per==0)? '0':$res2->unit_discount_per."%";
                  $discount_amt = (empty($res2->discount_amt)||$res2->unit_discount_per==0)? '0':$res2->discount_amt."";
                  echo "<tr>";  
                  echo "<td colspan='1' style='border-right: 1px solid;border:1px solid black;'>".++$i."</td>";
                  echo "<td style='border-right: 1px solid;border:1px solid black;'>".$res2->item_name."</td>";
                  // echo "<td style='border-right: 1px solid;border-top: 1px solid;'>".$res2->price_per_unit."</td>";
                  echo "<td style='border-right: 1px solid;border:1px solid black;'>".$res2->sales_qty."</td>";
                  // echo "<td style='text-align: right;border-right: 1px solid;border-top: 1px solid;'>".$discount."</td>";
                  // echo "<td style='text-align: right;border-right: 1px solid;border-top: 1px solid;'>".$discount_amt."</td>";
                  echo "<td style='text-align: right;border-right: 1px solid;border:1px solid black;'>".$res2->unit_total_cost."</td>";
                  echo "<td style='text-align: right;border-right: 1px solid;border:1px solid black;'>".$res2->total_cost."</td>";
                  echo "</tr>";  
                  $tot_qty +=$res2->sales_qty;
                  $tot_sales_price +=$res2->price_per_unit;
                  $tot_discount_amt +=$res2->discount_amt;
                  $tot_unit_total_cost +=$res2->unit_total_cost;
                  $tot_total_cost +=$res2->total_cost;
              }
              ?>
  </tr>
 
  </tbody>
<tfoot>
  <tr style="border: 1px solid black;">
    <td colspan="1" style="text-align: center;font-weight: bold; border:1px solid black;"><?= $this->lang->line('total'); ?></td>
    <td colspan="1" style="font-weight: bold;border:1px solid black;"><?=$tot_qty; ?></td>
    <!-- <td colspan="1" style="">-</td> -->
    <!-- <td colspan="1" style="text-align: right;border-right: 1px solid;border-top: 1px solid; border-bottom: 1px solid;" ><b><?php echo number_format(($tot_tax_amt),2,'.',''); ?></b></td> -->
    <!-- <td colspan="1" style="">-</td> -->
    <!-- <td colspan="1" style="text-align: right;border-right: 1px solid;border-top: 1px solid; border-bottom: 1px solid;" ><b><?php echo number_format(($tot_discount_amt),2,'.',''); ?></b></td> -->
    <td colspan="2" style="text-align: right;border:1px solid black;" ><b><?php echo number_format(($tot_unit_total_cost),2,'.',''); ?></b></td>
    <td colspan="1" style="text-align: right;border:1px solid black;" ><b><?php echo number_format(($tot_total_cost),2,'.',''); ?></b></td>
  </tr>

  <tr>
    <td colspan="4" style="text-align: right;border:1px solid black;"><b><?= $this->lang->line('grand_total'); ?></b></td>
    <td colspan="1" style="text-align: right;border:1px solid black;" ><b><?php echo number_format(round($grand_total),2,'.',''); ?></b></td>
  </tr>
  <tr>
  <tr class="bg-purple " >
    
  </tr>
  <?php 
                            if(isset($sales_id)){
                              $q3 = $this->db->query("select * from db_bookingpayments where booking_id=$sales_id");
                              if($q3->num_rows()>0){
                                $i=1;
                                $total_paid = 0;
                                foreach ($q3->result() as $res3) {
                                 
                                  $total_paid +=$res3->payment;
                                }
                                echo "<tr class=' text-bold'><td colspan='4' style='text-align: right;border:1px solid black;'>Paid Amount
                                <td colspan='1' style='text-align: right;border:1px solid black;' >".number_format($total_paid,2,'.','')."</td></tr>";
                                echo "<tr class=' text-bold'><td colspan='4' style='text-align: right;border:1px solid black;'>Due Amount</td>
                                <td colspan='1' style='text-align: right;border:1px solid black;'>".number_format($grand_total-$total_paid,2,'.','')."</td></tr>";
                              }
                              else{
                                echo "<tr><td colspan='4' class='text-center text-bold'>No Previous Payments Found!!</td></tr>";
                              }

                            }
                            else{
                              echo "<tr><td colspan='4' class='text-center text-bold'> Pending Payments!!</td></tr>";
                            }
                          ?>
    <td colspan="4">
<?php
      function no_to_words($no)
      {   
       $words = array('0'=> '' ,'1'=> 'One' ,'2'=> 'Two' ,'3' => 'Three','4' => 'Four','5' => 'Five','6' => 'Six','7' => 'Seven','8' => 'Eight','9' => 'Nine','10' => 'Ten','11' => 'Eleven','12' => 'Twelve','13' => 'Thirteen','14' => 'Fouteen','15' => 'Fifteen','16' => 'Sixteen','17' => 'Seventeen','18' => 'Eighteen','19' => 'Nineteen','20' => 'Twenty','30' => 'Thirty','40' => 'Fourty','50' => 'Fifty','60' => 'Sixty','70' => 'Seventy','80' => 'Eighty','90' => 'Ninty','100' => 'Hundred &','1000' => 'Thousand','100000' => 'Hundred and','1000000' => 'Million');
        if($no == 0)
          return ' ';
        else {
        $novalue='';
        $highno=$no;
        $remainno=0;
        $value=100;
        $value1=1000;       
            while($no>=100)    {
              if(($value <= $no) &&($no  < $value1))    {
              $novalue=$words["$value"];
              $highno = (int)($no/$value);
              $remainno = $no % $value;
              break;
              }
              $value= $value1;
              $value1 = $value * 100;
            }       
            if(array_key_exists("$highno",$words))
              return $words["$highno"]." ".$novalue." ".no_to_words($remainno);
            else {
             $unit=$highno%10;
             $ten =(int)($highno/10)*10;            
             return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".no_to_words($remainno);
             }
        }
      }
      // echo "<span class='amt-in-word'>Amount in words: <i style='font-weight:bold;'>".no_to_words(round($grand_total))."</i></span>";

      ?>
  
</td>
  </tr>

  <tr>
    <td colspan="2" style="height:2px;">
      <b><?= $this->lang->line('customer_signature'); ?> :.........................</b>
    </td>
    <td colspan="3">
      <b><?= $this->lang->line('authorised_signature'); ?> :........................</b>
    </td>
  </tr>
  <?php if(!empty($sales_invoice_footer_text)) {?>
  <tr style="border-top: 1px solid;">
    <td colspan="5" style="text-align: center;">
      <b><?= $sales_invoice_footer_text; ?></b>
    </td>
  </tr>
  <?php } ?>
</tfoot>
</table>



</body>
</html>
