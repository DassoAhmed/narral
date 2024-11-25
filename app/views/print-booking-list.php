<!DOCTYPE html>
<html>
<title><?= $page_title;?>- Default Format</title>
<head>
<link rel='shortcut icon' href='<?php echo $theme_link; ?>images/favicon.ico' />

<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    font-family: 'Open Sans', 'Martel Sans', sans-serif;
}
th, td {
    padding: 5px;
    text-align: left;   
    vertical-align:top 
}
body{
  word-wrap: break-word;
}
</style>
</head>
<body onload="window.print();"><!--  -->
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

<table align="center" width="100%" height='100%'>
    <thead>
      
      <tr>
          <th colspan="5" rowspan="2" style="padding-left: 15px;">
            <b><?php echo $company_name; ?></b><br/>
            <?php echo $this->lang->line('address')." : ".$company_address; ?><br/>
            <?php echo $company_country; ?><br/>
            <?php echo $this->lang->line('mobile').":".$company_mobile; ?><br/>
            <?php echo (!empty(trim($company_email))) ? $this->lang->line('email').": ".$company_email."<br>" : '';?>
            <?php echo (!empty(trim($company_gst_no))) ? $this->lang->line('gst_number').": ".$company_gst_no."<br>" : '';?>
            <?php echo (!empty(trim($company_vat_no))) ? $this->lang->line('vat_number').": ".$company_vat_no."<br>" : '';?>
          </th>
          <th colspan="5" rowspan="1"><b style="text-transform: capitalize;"><?= $this->lang->line('booling_list'); ?></th>
            
      </tr>
      <tr>
          
      </tr>
    

      <tr >
          <th>S/N</th>
      <th><?= $this->lang->line('booking_date'); ?></th>
                  <th><?= $this->lang->line('delivery_date'); ?></th>
                  <th><?= $this->lang->line('booking_code'); ?></th>
                  <th><?= $this->lang->line('customer_name'); ?></th>
                  <th><?= $this->lang->line('qty_booked'); ?></th>

                  <th><?= $this->lang->line('total'); ?></th> 
                  <th><?= $this->lang->line('paid_amount'); ?></th>
                  <th><?= $this->lang->line('due'); ?></th>
                  <th><?= $this->lang->line('created_by'); ?></th>
  </tr>
  
    
  
  </thead>
<tbody>
    <?php
   $qbk = $this->db->query("SELECT a.`reference_no`, a.`booking_code`, a.`booked_date`, a.`delivery_date`,
    a.`booking_status`, a.`delivery_status`, b.`customer_name`,b.`sales_due`, a.`qty_booked`, a.`other_charges_input`,
     a.`other_charges_tax_id`, a.`other_charges_amt`, a.`discount_to_all_input`, a.`discount_to_all_type`,
    a.`tot_discount_to_all_amt`, a.`subtotal`,a.`grand_total`, a.`payment_status`,
    a.`paid_amount`, a.`new_amt_paid`, a.`payment_code`, a.`created_time`, a.`created_by`
    FROM `db_booking` as a, `db_customers` as b
    where b.id=a.customer_id AND a.qty_booked !=0");

foreach ($qbk->result() as $booking) {
    echo "<tr>";  
    echo "<td >".++$i."</td>";
    echo "<td >".$booking->booked_date."</td>";
    echo "<td >".$booking->delivery_date."</td>";
    echo "<td >".$booking->reference_no."</td>";
    echo "<td >".$booking->customer_name."</td>";
    echo "<td >".$booking->qty_booked."</td>";
    echo "<td >".$booking->grand_total."</td>";
    echo "<td >".$booking->paid_amount."</td>";
    echo "<td >".$booking->sales_due."</td>";
    echo "<td >".$booking->created_by."</td>";

    echo "</tr>"; 
}
    ?>

 </tbody>
</tfoot>
</table>



</body>
</html>
