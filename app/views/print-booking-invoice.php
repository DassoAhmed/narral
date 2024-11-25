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

<table align="center" style="border: 1px solid black;" width="100%" height='100%'>
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
          <th colspan="5" rowspan="1"><b style="text-transform: capitalize;"><?= $this->lang->line('supply_list'); ?></th>
            
      </tr>
      <tr>
          <th colspan="3" rowspan="1">
            <?php  $reference_no = $this->db->query("select reference_no from db_bookingtransactions where delivered_date='$delivered_date'")->row()->reference_no;   ?>
              <?= $this->lang->line('reference_no'); ?> : <?php echo "$reference_no"; ?>
          </th>  
          <th colspan="3" rowspan="1"><?= $this->lang->line('date'); ?> : <?php echo $delivered_date; ?></th>
      </tr>
     

      <tr >
    <th colspan="2" rowspan='2'>#</th>
    <th colspan="2" rowspan='9'><?= $this->lang->line('customer_name'); ?></th>
    <th colspan="2" rowspan='9'><?= $this->lang->line('designation'); ?></th>
    <th colspan="2" rowspan='9'><?= $this->lang->line('tot_quantity_rec'); ?></th>
    <th colspan="2" rowspan='9'><?= $this->lang->line('signature'); ?></th>
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

              $q2=$this->db->query("SELECT d.tran_code, a.delivered_date,b.supplier_name, c.customer_name, a.qty_taken,a.reference_no,
                a.item_name
                FROM 
                db_bookingtransactions AS a,db_suppliers AS b,db_customers AS c,db_bookingsupply AS d
                WHERE b.id=a.supplier_id AND c.id=a.customer_id AND d.id=a.sales_item_id AND
                a.delivered_date='$delivered_date'");
              foreach ($q2->result() as $res2) {
                  echo "<tr>";  
                  echo "<td colspan='2'>".++$i."</td>";
                  echo "<td colspan='2'>".$res2->customer_name."</td>";
                  echo "<td colspan='2'>";
                    echo $res2->item_name;
                  echo "</td>";
                 
                  
                  echo "<td colspan='2'>".$res2->qty_taken."</td>";
                  echo "<td colspan='2'></td>";

                  echo "</tr>";  
                  $tot_qty +=$res2->qty_taken;
              }
              ?>
 </tbody>
</tfoot>
</table>



</body>
</html>
