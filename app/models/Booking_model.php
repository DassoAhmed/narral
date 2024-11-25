<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

		 
	//Datatable start
	var $table = 'db_booking as a';
	var $column_order = array('a.id','a.booking_code', 'a.booked_date','b.mobile','a.delivery_date','a.booking_status','b.customer_name','a.delivery_status','a.qty_booked','a.discount_to_all_input','a.discount_to_all_type','a.tot_discount_to_all_amt','a.subtotal','a.grand_total','a.payment_status','a.paid_amount','a.created_by','a.reference_no','a.other_charges_amt','a.pos'); //set column field database for datatable orderable
	var $column_search = array('a.id','a.booking_code', 'a.booked_date','b.mobile','a.delivery_date','a.booking_status','b.customer_name','a.delivery_status','a.qty_booked','a.discount_to_all_input','a.discount_to_all_type','a.tot_discount_to_all_amt','a.subtotal','a.grand_total','a.payment_status','a.paid_amount','a.created_by','a.reference_no','a.other_charges_amt','a.pos'); //set column field database for datatable searchable 
	var $order = array('a.id' => 'desc'); // default order  
 
	public function __construct()
	{
		parent::__construct();  
		$CI =& get_instance();  
	}  
 
	private function _get_datatables_query()
	{    
		 
		$this->db->select($this->column_order);
		$this->db->from($this->table);
		$this->db->select("coalesce(a.grand_total,0)-coalesce(a.paid_amount,0) as sales_due");
		$this->db->from('db_customers as b');
		//$this->db->from('db_warehouse as c');
		$this->db->where('b.id=a.customer_id AND a.qty_booked !=0');
		//$this->db->where('c.id=a.warehouse_id');

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				

				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.

					$this->db->like($item, $_POST['search']['value']);

				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				


				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables() 
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}





// full booking list
private function _get_datatables_query2()
	{ 
		
		$this->db->select($this->column_order);
		$this->db->from($this->table);
		$this->db->select("coalesce(a.grand_total,0)-coalesce(a.paid_amount,0) as sales_due");
		$this->db->from('db_customers AS b');
		//$this->db->from('db_warehouse as c');
		$this->db->where('b.id=a.customer_id AND a.qty_left = 0');
		//$this->db->where('c.id=a.warehouse_id');

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				

				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.

					$this->db->like($item, $_POST['search']['value']);

				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				


				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables2()
	{
		$this->_get_datatables_query2();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered2()
	{
		$this->_get_datatables_query2();
		$query = $this->db->get();
		return $query->num_rows();
	}




	// create new booking list
	private function _get_datatables_query3()
	{ 
		
		$this->db->select($this->column_order);
		$this->db->from($this->table);
		$this->db->select("coalesce(a.grand_total,0)-coalesce(a.paid_amount,0) as sales_due");
		$this->db->from('db_customers AS b');
		//$this->db->from('db_warehouse as c');
		$this->db->where('b.id=a.customer_id AND a.delivery_status = "active"');
		//$this->db->where('c.id=a.warehouse_id');

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				

				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.

					$this->db->like($item, $_POST['search']['value']);

				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				


				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables3()
	{
		$this->_get_datatables_query3();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered3()
	{
		$this->_get_datatables_query3();
		$query = $this->db->get();
		return $query->num_rows();
	}


// create supply list
private function _get_datatables_query4()
{  
	 
	$this->db->select("a.id, a.tran_code ,b.supplier_name, a.supplier_id, a.delivered_date");
	$this->db->from('db_bookingsupply AS a');
	$this->db->from('db_suppliers AS b');
	$this->db->where('b.id = a.supplier_id');
	$this->db->group_by('a.delivered_date');
	$this->db->order_by('a.created_date desc');

	$i = 0;

	foreach ($this->column_search as $item) // loop column 
	{
		if($_POST['search']['value']) // if datatable send POST for search
		{
			
			

			if($i===0) // first loop
			{
				$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.

				$this->db->like($item, $_POST['search']['value']);

			}
			else
			{
				$this->db->or_like($item, $_POST['search']['value']);
			}

			


			if(count($this->column_search) - 1 == $i) //last loop
				$this->db->group_end(); //close bracket
		}
		$i++;
	}
	
	if(isset($_POST['order'])) // here order processing
	{
		$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	} 
	else if(isset($this->order))
	{
		$order = $this->order;
		$this->db->order_by(key($order), $order[key($order)]);
	}
}

function get_datatables4()
{
	$this->_get_datatables_query4();
	if($_POST['length'] != -1)
	$this->db->limit($_POST['length'], $_POST['start']);
	$query = $this->db->get();
	return $query->result();
}

function count_filtered4()
{
	$this->_get_datatables_query4();
	$query = $this->db->get();
	return $query->num_rows();
}


// supply list details datatables
private function _get_datatables_query5()
{  
$this->db->select("d.tran_code, a.delivered_date,b.supplier_name, c.customer_name, a.qty_taken,a.reference_no,
a.item_name");
$this->db->from("db_bookingtransactions AS a ");
$this->db->from('db_suppliers AS b');
$this->db->from('db_customers AS c');
$this->db->from('db_bookingsupply AS d');
$this->db->where('b.id=a.supplier_id');
$this->db->where('b.id=a.supplier_id ');
$this->db->where('c.id=a.customer_id');
$this->db->where("d.id=a.sales_item_id AND a.delivered_date='$delivered_date'");

	$i = 0;

	foreach ($this->column_search as $item) // loop column 
	{
		if($_POST['search']['value']) // if datatable send POST for search
		{
			
			

			if($i===0) // first loop
			{
				$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.

				$this->db->like($item, $_POST['search']['value']);

			}
			else
			{
				$this->db->or_like($item, $_POST['search']['value']);
			}

			


			if(count($this->column_search) - 1 == $i) //last loop
				$this->db->group_end(); //close bracket
		}
		$i++;
	}
	
	if(isset($_POST['order'])) // here order processing
	{
		$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	} 
	else if(isset($this->order))
	{
		$order = $this->order;
		$this->db->order_by(key($order), $order[key($order)]);
	}
}

function get_datatables5()
{
	$this->_get_datatables_query5();
	if($_POST['length'] != -1)
	$this->db->limit($_POST['length'], $_POST['start']);
	$query = $this->db->get();
	return $query->result();
}

function count_filtered5()
{
	$this->_get_datatables_query5();
	$query = $this->db->get();
	return $query->num_rows();
}




	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	//Datatable end

	public function xss_html_filter($input){
		return $this->security->xss_clean(html_escape($input));
	}
	
	//Save Sales 
	public function verify_save_and_update(){
		//Filtering XSS and html escape from user inputs 
		extract($this->xss_html_filter(array_merge($this->data,$_POST,$_GET)));
		//echo "<pre>";print_r($this->xss_html_filter(array_merge($this->data,$_POST,$_GET)));exit();
		
		$this->db->trans_begin();
		$booked_date=date('Y-m-d',strtotime($booked_date));

		// if($qty_taken=='' || $qty_taken==0){$qty_taken=null;}
		if($qty_booked=='' || $qty_booked==0){$qty_booked=null;}
		if($other_charges_input=='' || $other_charges_input==0){$other_charges_input=null;}
	    if($other_charges_tax_id=='' || $other_charges_tax_id==0){$other_charges_tax_id=null;}
	    if($other_charges_amt=='' || $other_charges_amt==0){$other_charges_amt=null;}
	    if($discount_to_all_input=='' || $discount_to_all_input==0){$discount_to_all_input=null;}
	    if($tot_discount_to_all_amt=='' || $tot_discount_to_all_amt==0){$tot_discount_to_all_amt=null;}
	  

	    if($command=='save'){//Create sales code unique if first time entry
			
	

		    $qs5="select sales_init from db_company";
			$q5=$this->db->query($qs5);
			$sales_init=$q5->row()->sales_init;
			$this->db->query("ALTER TABLE db_booking AUTO_INCREMENT = 1");
			$q4=$this->db->query("select coalesce(max(id),0)+1 as maxid from db_booking");
			$maxid=$q4->row()->maxid;
			$booking_code=$sales_init.str_pad($maxid, 4, '0', STR_PAD_LEFT);

			//creating bookibg code
			$letters = 'BK';
			$numbers = 1; 
			
			for($i = 0; $i < 10; $i++){
				$numbers .= $i;
			}
		$reference_no = $letters.substr(str_shuffle($numbers), 0, 4);
			
		    $sales_entry = array(
		    				'booking_code' 				=> $booking_code,
		    				'reference_no' 				=> $reference_no, 
		    				'booked_date' 				=> $booked_date,
							'delivery_date' 			=> $delivery_date,
		    				'booking_status' 			=> $booking_status,
							'customer_id' 				=> $customer_id,
		    				// 'customer_id' 				=> $customer_update_id,							
		    				/*'warehouse_id' 				=> $warehouse_id,*/
		    				/*Other Charges*/
							'qty_booked' 		=> $qty_booked,
							'other_charges_input' 		=> $other_charges_input,
		    				'other_charges_tax_id' 		=> $other_charges_tax_id,
		    				'other_charges_amt' 		=> $other_charges_amt,
		    				/*Discount*/
		    				'discount_to_all_input' 	=> $discount_to_all_input,
		    				'discount_to_all_type' 		=> $discount_to_all_type,
		    				'tot_discount_to_all_amt' 	=> $tot_discount_to_all_amt,
		    				/*Subtotal & Total */
		    				'subtotal' 					=> $tot_subtotal_amt,
		    				'round_off' 				=> $tot_round_off_amt,
		    				'grand_total' 				=> $tot_total_amt,
							'sales_note' 				=> $sales_note,
							
		    				/*System Info*/
		    				'created_date' 				=> $CUR_DATE,
		    				'created_time' 				=> $CUR_TIME,
		    				'created_by' 				=> $CUR_USERNAME,
		    				'system_ip' 				=> $SYSTEM_IP,
		    				'system_name' 				=> $SYSTEM_NAME,
		    				'status' 					=> 1,
		    			);
			// $q11=$this->db->query("update db_customers set pending_qty='$qty_left' where id ='$customer_id'");

			$q1 = $this->db->insert('db_booking', $sales_entry);
			$sales_id = $this->db->insert_id();
		}
		else if($command=='update'){	
			$sales_entry = array(
		    				// 'reference_no' 				=> $reference_no, 
		    				'booked_date' 			=> $booked_date,
							'delivery_date' 			=> $delivery_date,
		    				'booking_status' 			=> $booking_status,
		    				'customer_id' 				=> $customer_id,
		    				/*'warehouse_id' 				=> $warehouse_id,*/
		    				/*Other Charges*/
							'qty_booked' 		=> $qty_booked,
		    				'other_charges_tax_id' 		=> $other_charges_tax_id,
		    				'other_charges_amt' 		=> $other_charges_amt,
		    				/*Discount*/
		    				'discount_to_all_input' 	=> $discount_to_all_input,
		    				'discount_to_all_type' 		=> $discount_to_all_type,
		    				'tot_discount_to_all_amt' 	=> $tot_discount_to_all_amt,
		    				/*Subtotal & Total */
		    				'subtotal' 					=> $tot_subtotal_amt,
		    				'round_off' 				=> $tot_round_off_amt,
		    				'grand_total' 				=> $tot_total_amt,
		    				'sales_note' 			=> $sales_note,
		    			);
					
			$q1 = $this->db->where('id',$sales_id)->update('db_booking', $sales_entry);

			$q11=$this->db->query("delete from db_bookeditems where sales_id='$sales_id'");
			if(!$q11){
				return "failed";
			}
		}
		//end

		//Import post data from form
		for($i=1;$i<=$rowcount;$i++){
		
			if(isset($_REQUEST['tr_item_id_'.$i]) && !empty($_REQUEST['tr_item_id_'.$i])){

				$item_id 			=$this->xss_html_filter(trim($_REQUEST['tr_item_id_'.$i]));
				$sales_qty			=$this->xss_html_filter(trim($_REQUEST['td_data_'.$i.'_3']));
				$price_per_unit 	=$this->xss_html_filter(trim($_REQUEST['td_data_'.$i.'_4']));
				$tax_id 			=$this->xss_html_filter(trim($_REQUEST['tr_tax_id_'.$i]));
				$tax_amt 			=$this->xss_html_filter(trim($_REQUEST['td_data_'.$i.'_11']));
				$unit_total_cost	=$this->xss_html_filter(trim($_REQUEST['td_data_'.$i.'_10']));
				$unit_discount_per	=$this->xss_html_filter(trim($_REQUEST['td_data_'.$i.'_8']));
				$total_cost			=$this->xss_html_filter(trim($_REQUEST['td_data_'.$i.'_9']));
				$tax_type			=$this->xss_html_filter(trim($_REQUEST['tr_tax_type_'.$i]));
				$unit_tax			=$this->xss_html_filter(trim($_REQUEST['tr_tax_value_'.$i]));
				$description		=$this->xss_html_filter(trim($_REQUEST['description_'.$i]));

                 $unit_discount_per  =(empty($unit_discount_per)) ? 0 : $unit_discount_per;
				$discount_amt 		=($sales_qty * $unit_total_cost)*$unit_discount_per/100;
				
			
				if($tax_type=='Exclusive'){
					$single_unit_total_cost = $price_per_unit;
					$single_unit_discount = ($single_unit_total_cost * $unit_discount_per)/100;
					$single_unit_total_cost -=$single_unit_discount;
				}
				else{//Inclusive
					$single_unit_discount = ($price_per_unit * $unit_discount_per)/100;
					$single_unit_total_cost =$price_per_unit-$single_unit_discount;
				}
  
				if($tax_id=='' || $tax_id==0){$tax_id=null;}
				if($tax_amt=='' || $tax_amt==0){$tax_amt=null;}
				if($unit_discount_per=='' || $unit_discount_per==0){$unit_discount_per=null;}
				if($unit_total_cost=='' || $unit_total_cost==0){$unit_total_cost=null;}
				if($total_cost=='' || $total_cost==0){$total_cost=null;}
				
				if(!empty($discount_to_all_input) && $discount_to_all_input!=0){
					$unit_discount_per =null;
					$discount_amt =null;
				}
				
				$salesitems_entry = array(
							'sales_id' 			=> $sales_id, 
							// 'reference_no' 				=> $reference_no, 
							'customer_id' 				=> $customer_id,
							'delivery_date' 			=> $delivery_date,
		    				'booking_status'		=> $booking_status, 
		    				'item_id' 			=> $item_id, 
		    				'description' 		=> $description, 
		    				'sales_qty' 		=> $sales_qty,
		    				'price_per_unit' 	=> $price_per_unit,
							'tax_type' 			=> $tax_type,
		    				'tax_id' 			=> $tax_id,
		    				'tax_amt' 			=> $tax_amt,

		    				'unit_discount_per' => $unit_discount_per,
		    				'discount_amt' 		=> $discount_amt,
		    				'unit_total_cost' 	=> $single_unit_total_cost,
							'total_cost' 		=> $total_cost,
							
							'created_date' 				=> $CUR_DATE,
		    				'created_time' 				=> $CUR_TIME,
		    				'status'	 		=> 1,

		    			);

				$q2 = $this->db->insert('db_bookeditems', $salesitems_entry);
				
				//UPDATE itemS QUANTITY IN itemS TABLE
				$this->load->model('pos_model');				
				$q6=$this->pos_model->update_items_quantity($item_id);
				if(!$q6){
					return "failed";
				}
				
			}
		
		}//for end

		if($amount=='' || $amount==0){$amount=null;}
		if($amount>0 && !empty($payment_type)){
			$salespayments_entry = array(
					'booking_id' 		=> $sales_id, 
					'reference_no' 		=> $reference_no, 
					'payment_date'		=> $booked_date,//Current Payment with booking entry
					'payment_type' 		=> $payment_type,
					'payment' 			=> $amount,
					'payment_note' 		=> $payment_note,
					'created_date' 		=> $CUR_DATE,
    				'created_time' 		=> $CUR_TIME,
    				'created_by' 		=> $CUR_USERNAME,
    				'system_ip' 		=> $SYSTEM_IP,
    				'system_name' 		=> $SYSTEM_NAME,
    				'status' 			=> 1,
				);
 
			$q3 = $this->db->insert('db_bookingpayments', $salespayments_entry);
			if($q3!=1){
				return "failed";
			}


		}
		

		
		$q10=$this->update_sales_payment_status($sales_id,$customer_id);
		if($q10!=1){
			return "failed";
		}
		  
		 
		$sms_info='';
		if(isset($send_sms) && $customer_id!=1){
			if(send_sms_using_template($sales_id,1)==true){
				$sms_info = 'SMS Has been Sent!';
			}else{
				$sms_info = 'Failed to Send SMS';
			}
		}
		$this->db->trans_commit();
		$this->session->set_flashdata('success', 'Success!! Record Saved Successfully! '.$sms_info);
		return "success<<<###>>>$sales_id";
		
	}//verify_save_and_update() function end

	function update_sales_payment_status_by_sales_id($sales_id,$customer_id){
		//if(!empty($sales_id)){
			/*$q12=$this->db->query("CALL sp_update_sales_payment_status($sales_id)");
			if(!$q12){
				return false;
			}*/
			$q8=$this->db->query("select COALESCE(SUM(payment),0) as payment from db_bookingpayments where booking_id='$sales_id'");
		$sum_of_payments=$q8->row()->payment;
		

		$payble_total=$this->db->query("select coalesce(sum(grand_total),0) as total from db_booking where id='$sales_id'")->row()->total;
		
		//$pending_amt=$payble_total-$sum_of_payments;

		$payment_status='';
		if($payble_total==$sum_of_payments){
			$payment_status="Paid";
		}
		else if($sum_of_payments!=0 && ($sum_of_payments<$payble_total)){
			$payment_status="Partial";
		}
		else if($sum_of_payments==0){
			$payment_status="Unpaid";
		}



		//$customer_id =$this->db->select("customer_id")->where("id",$sales_id)->get("db_sales")->row()->customer_id;
	
		//Condition if sales record not exist
		//Sometime called after sales redord delete

		$q7=$this->db->query("update db_booking set 
							payment_status='$payment_status',
							paid_amount=$sum_of_payments 
							where id='$sales_id'");


		$q12 = $this->db->query("update db_customers set sales_due=(select COALESCE(SUM(grand_total),0)-COALESCE(SUM(paid_amount),0) from db_booking where customer_id='$customer_id' and booking_status='Final') where id=$customer_id");
			if(!$q12){
				return false;
			}
	//	}
		if(!record_customer_payment($customer_id)){
			return false;
		}
		return true;
		
	}


	function update_sales_payment_status($sales_id,$customer_id){
		if(!$this->update_sales_payment_status_by_sales_id($sales_id,$customer_id)){
			return false;
		}
		return true;
	}


	//Get sales_details
	public function get_details($id,$data){
		//Validate This booking already exist or not
		$query=$this->db->query("select * from db_booking where upper(id)=upper('$id')");
		if($query->num_rows()==0){
			show_404();exit;
		}
		else{
			$query=$query->row();
			$data['q_id']=$query->id;
			$data['item_code']=$query->booking_code;
			$data['item_name']=$query->item_name;
			$data['category_name']=$query->category_name;
			$data['hsn']=$query->hsn;
			$data['unit_name']=$query->unit_name;
			$data['available_qty']=$query->available_qty;
			$data['alert_qty']=$query->alert_qty;
			$data['sales_price']=$query->sales_price;
			$data['gst_percentage']=$query->gst_percentage;
			
			return $data;
		}
	}

	public function update_status($id,$status){
		
        $query1="update db_booking set status='$status' where id=$id";
        if ($this->db->simple_query($query1)){
            echo "success";
        }
        else{ 
            echo "failed";
        }
	}

	public function delete_sales($ids){
      	$this->db->trans_begin();
      	//Find the customer id in one aray
      	$q11 = $this->db->select("customer_id,id")->where("id in ($ids)")->get("db_booking");

      	$q12=$this->db->select("*")->where("sales_id in ($ids)")->get("db_salesreturn");
      	if($q12->num_rows()>0){
      		foreach ($q12->result() as $res12) {
      			$booking_code = $this->db->select("booking_code")->where("id",$res12->sales_id)->get("db_booking")->row()->booking_code;
      			echo "<br>Invoice Code: ".$booking_code;
      		}
      		echo "<br>Already Raised Returns, Please Delete Before Deleting Original Invoice";
      		exit;
      	}
      
      	$q5=$this->db->query("delete from db_bookingpayments where booking_id in($ids)");
		$q7=$this->db->query("delete from db_bookeditems where sales_id in($ids)");
		$q3=$this->db->query("delete from db_booking where id in($ids)");

		$q6=$this->db->query("select id from db_items");
		if($q6->num_rows()>0){
			$this->load->model('pos_model');				
			foreach ($q6->result() as $res6) {
				$q6=$this->pos_model->update_items_quantity($res6->id);
				if(!$q6){
					return "failed";
				}
			}
		}

		foreach ($q11->result() as $res11) {
			$q2=$this->update_sales_payment_status($res11->id,$res11->customer_id);
			if(!$q2){ return "failed";}
		}
		
		$this->db->trans_commit();
		return "success";
	}




	public function deliver_booking($ids){
		$this->db->trans_begin();
		//Find the customer id in one aray
		$q11 = $this->db->select("customer_id,id")->where("id in ($ids)")->get("db_booking");

		
	//   $q3=$this->db->query("update db_booking set delivery_status = 'Delivered' where id in($ids)");


	  
	  $this->db->trans_commit();
	  return "success";
  }



	public function search_item($q){
		$json_array=array();
        $query1="select id,item_name from db_items where (upper(item_name) like upper('%$q%') or upper(item_code) like upper('%$q%'))";

        $q1=$this->db->query($query1);
        if($q1->num_rows()>0){
            foreach ($q1->result() as $value) {
            	$json_array[]=['id'=>(int)$value->id, 'text'=>$value->item_name];
            }
        }
        return json_encode($json_array);
	}

	// public function dropdownResponse($idqty){
	// 	return $this->db->get_where('db_booking',['customer_id' => $idqty])->result();
	// }
	
	public function find_item_details($id){
		$json_array=array();
        $query1="select id,hsn,alert_qty,unit_name,sales_price,sales_price,gst_percentage,available_qty from db_items where id=$id";

        $q1=$this->db->query($query1);
        if($q1->num_rows()>0){
            foreach ($q1->result() as $value) {
            	$json_array=['id'=>$value->id, 
        			 'hsn'=>$value->hsn,
        			 'alert_qty'=>$value->alert_qty,
        			 'unit_name'=>$value->unit_name,
        			 'sales_price'=>$value->sales_price,
        			 'sales_price'=>$value->sales_price,
        			 'gst_percentage'=>$value->gst_percentage,
        			 'available_qty'=>$value->available_qty,
        			];
            }
        }
        return json_encode($json_array);
	}

	



	
	/*v1.1*/
	/*public function inclusive($price='',$tax_per){
		return ($tax_per!=0) ? $price/(($tax_per/100)+1)/10 : $tax_per;
	}*/
	public function get_items_info($rowcount,$item_id){
		$q1=$this->db->select('*')->from('db_items')->where("id=$item_id")->get();
		$q3=$this->db->query("select * from db_tax where id=".$q1->row()->tax_id)->row();

		$info['item_id'] = $q1->row()->id;
		$info['item_name'] = $q1->row()->item_name;
		$info['description'] = '';//$q1->row()->description;
		$info['item_available_qty'] = $q1->row()->stock;
		$info['item_sales_price'] = $q1->row()->sales_price;
		$info['item_tax_id'] = $q1->row()->tax_id;
		$info['item_tax_name'] = $q3->tax_name;
		$info['item_price'] = $q1->row()->price;
		$info['item_sales_qty'] = 1;
		$info['item_tax_id'] = $q3->id;
		$info['item_tax'] = $q3->tax;
		$info['item_tax_type'] = $q1->row()->tax_type;
		$info['item_discount'] = '';

		$info['item_tax_amt'] = ($q1->row()->tax_type=='Inclusive') ? calculate_inclusive($q1->row()->sales_price,$q3->tax) :calculate_exclusive($q1->row()->sales_price,$q3->tax);

		$this->return_row_with_data($rowcount,$info);
	}

	// fetch and retrieve customer booking info
	public function return_row_with_customer_info($customer_id){
		$q1=$this->db->select('*')->from('db_customers')->where("id=$customer_id")->row();
	
		$info['pending_qty'] = $q1->row()->pending_qty;

	// $result=$this->return_row_with_customer_data($info);
	echo json_encode($result);
	}

	/* For Purchase Items List Retrieve*/
	public function return_sales_list($sales_id){
		$q1=$this->db->select('*')->from('db_bookeditems')->where("sales_id=$sales_id")->get();
		$rowcount =1;
		foreach ($q1->result() as $res1) {
			$q2=$this->db->query("select * from db_items where id=".$res1->item_id);
			$q3=$this->db->query("select * from db_tax where id=".$res1->tax_id)->row();
			
			$info['item_id'] = $res1->item_id;
			$info['description'] = $res1->description;
			$info['item_name'] = $q2->row()->item_name;
			//$info['description'] = $res1->description;
			$info['item_available_qty'] = $q2->row()->stock;
			$info['item_price'] = $q2->row()->price;
			//$info['item_sales_price'] = $q2->row()->sales_price;
			$info['item_sales_price'] = $res1->price_per_unit;
			//$info['item_tax_id'] = $res1->tax_id;
			$info['item_tax_name'] = $q3->tax_name;
			$info['item_sales_qty'] = $res1->sales_qty;
			$info['item_tax_id'] = $q3->id;
			$info['item_tax'] = $q3->tax;
			$info['item_tax_type'] = $res1->tax_type;
			$info['item_tax_amt'] = $res1->tax_amt;
			$info['item_discount'] = $res1->unit_discount_per;
			
			$result = $this->return_row_with_data($rowcount++,$info);
		}
		return $result;
	}
	/* For Purchase Items List Retrieve*/
	public function return_row_with_customer_data($customer_id){
		$q1=$this->db->select('pending_qty')->from('db_customer')->where("id=$customer_id")->get();
		return $result;
	}

	public function return_row_with_data($rowcount,$info){
		extract($info);
		$item_amount = ($item_sales_price * $item_sales_qty) + $item_tax_amt;
		?>
            <tr id="row_<?=$rowcount;?>" data-row='<?=$rowcount;?>'>
               <td id="td_<?=$rowcount;?>_1">
                  <label class='form-control' style='height:auto;' data-toggle="tooltip" title='Edit ?' >
                  <a id="td_data_<?=$rowcount;?>_1" href="javascript:void()" onclick="show_sales_item_modal(<?=$rowcount;?>)" title=""><?=$item_name;?></a> 
                  		<i onclick="show_sales_item_modal(<?=$rowcount;?>)" class="fa fa-edit pointer"></i>
                  	</label>
               </td>

               <!-- description  -->
               <!-- <td id="td_<?=$rowcount;?>_17">
                  
                  <textarea rows="1" type="text" style="font-weight: bold; height=34px;" id="td_data_<?=$rowcount;?>_17" name="td_data_<?=$rowcount;?>_17" class="form-control no-padding"><?=$description;?></textarea>
               </td> -->

               <!-- Qty -->
               <td id="td_<?=$rowcount;?>_3">
                  <div class="input-group ">
                     <span class="input-group-btn">
                     <button onclick="decrement_qty(<?=$rowcount;?>)" type="button" class="btn btn-default btn-flat"><i class="fa fa-minus text-danger"></i></button></span>
                     <input typ="text" value="<?=$item_sales_qty;?>" class="form-control no-padding text-center" onkeyup="calculate_tax(<?=$rowcount;?>)" id="td_data_<?=$rowcount;?>_3" name="td_data_<?=$rowcount;?>_3">
                     <span class="input-group-btn">
                     <button onclick="increment_qty(<?=$rowcount;?>)" type="button" class="btn btn-default btn-flat"><i class="fa fa-plus text-success"></i></button></span>
                  </div>
               </td>
               
               <!-- Unit Cost Without Tax-->
               <td id="td_<?=$rowcount;?>_10"><input type="text" name="td_data_<?=$rowcount;?>_10" id="td_data_<?=$rowcount;?>_10" class="form-control text-right no-padding only_currency text-center" onkeyup="calculate_tax(<?=$rowcount;?>)" value="<?=$item_sales_price;?>"></td>

               <!-- Discount -->
               <td id="td_<?=$rowcount;?>_8">
                  <input type="text" name="td_data_<?=$rowcount;?>_8" id="td_data_<?=$rowcount;?>_8" class="form-control text-right no-padding only_currency text-center item_discount" value="<?=$item_discount;?>" onkeyup="calculate_tax(<?=$rowcount;?>)">
               </td>

               <!-- Tax Amount -->
               <td id="td_<?=$rowcount;?>_11">
                  <input type="text" name="td_data_<?=$rowcount;?>_11" id="td_data_<?=$rowcount;?>_11" class="form-control text-right no-padding only_currency text-center" value="<?=$item_tax_amt;?>" readonly>
               </td>

               <!-- Tax Details -->
               <td id="td_<?=$rowcount;?>_12">
                  <label class='form-control ' style='width:100%;padding-left:0px;padding-right:0px;'>
                  <a id="td_data_<?=$rowcount;?>_12" href="javascript:void()" data-toggle="tooltip" title='Click to Change' onclick="show_sales_item_modal(<?=$rowcount;?>)" title=""><?=$item_tax_name ;?></a>
                  	</label>
               </td>

               <!-- Amount -->
               <td id="td_<?=$rowcount;?>_9"><input type="text" name="td_data_<?=$rowcount;?>_9" id="td_data_<?=$rowcount;?>_9" class="form-control text-right no-padding only_currency text-center" style="border-color: #f39c12;" readonly value="<?=$item_amount;?>"></td>
               
               <!-- ADD button -->
               <td id="td_<?=$rowcount;?>_16" style="text-align: center;">
                  <a class=" fa fa-fw fa-minus-square text-red" style="cursor: pointer;font-size: 34px;" onclick="removerow(<?=$rowcount;?>)" title="Delete ?" name="td_data_<?=$rowcount;?>_16" id="td_data_<?=$rowcount;?>_16"></a>
               </td>
               <input type="hidden" id="td_data_<?=$rowcount;?>_4" name="td_data_<?=$rowcount;?>_4" value="<?=$item_sales_price;?>">
               <input type="hidden" id="td_data_<?=$rowcount;?>_15" name="td_data_<?=$rowcount;?>_15" value="<?=$item_tax_id;?>">
               <input type="hidden" id="td_data_<?=$rowcount;?>_5" name="td_data_<?=$rowcount;?>_5" value="<?=$item_tax_amt;?>">
               <input type="hidden" id="tr_available_qty_<?=$rowcount;?>_13" value="<?=$item_available_qty;?>">
               <input type="hidden" id="tr_item_id_<?=$rowcount;?>" name="tr_item_id_<?=$rowcount;?>" value="<?=$item_id;?>">
               <input type="hidden" id="tr_tax_type_<?=$rowcount;?>" name="tr_tax_type_<?=$rowcount;?>" value="<?=$item_tax_type;?>">
               <input type="hidden" id="tr_tax_id_<?=$rowcount;?>" name="tr_tax_id_<?=$rowcount;?>" value="<?=$item_tax_id;?>">
               <input type="hidden" id="tr_tax_value_<?=$rowcount;?>" name="tr_tax_value_<?=$rowcount;?>" value="<?=$item_tax;?>">
               <input type="hidden" id="description_<?=$rowcount;?>" name="description_<?=$rowcount;?>" value="<?=$description;?>">
            </tr>
		<?php

	}
	public function delete_payment($payment_id){
        $this->db->trans_begin();
		$sales_id = $this->db->query("select booking_id from db_bookingpayments where id=$payment_id")->row()->booking_id;

		$customer_id = $this->db->query("select customer_id from db_booking where id=$sales_id")->row()->customer_id;

		$q1=$this->db->query("delete from db_bookingpayments where id='$payment_id'");
		$q2=$this->update_sales_payment_status($sales_id,$customer_id);
		if($q1!=1 || $q2!=1)
		{
			$this->db->trans_rollback();
		    return "failed";
		}
		else{
			$this->db->trans_commit();
		        return "success";
		}
	}

	public function show_pay_now_modal($sales_id){
		$q1=$this->db->query("select * from db_booking where id=$sales_id");
		$res1=$q1->row();
		$customer_id = $res1->customer_id;
		$q2=$this->db->query("select * from db_customers where id=$customer_id");
		$res2=$q2->row();

		$customer_name=$res2->customer_name;
	    $customer_mobile=$res2->mobile;
	    $customer_phone=$res2->phone;
	    $customer_email=$res2->email;
	    $customer_country=$res2->country_id;
	    $customer_state=$res2->state_id;
	    $customer_address=$res2->address;
	    $customer_postcode=$res2->postcode;
	    $customer_gst_no=$res2->gstin;
	    $customer_tax_number=$res2->tax_number;
	    $customer_opening_balance=$res2->opening_balance;

	    $booked_date=$res1->booked_date;
	    $reference_no=$res1->reference_no;
	    $booking_code=$res1->booking_code;
	    $sales_note=$res1->sales_note;
	    $grand_total=$res1->grand_total;
	    $paid_amount=$res1->paid_amount;
	    $due_amount =$grand_total - $paid_amount;

	    if(!empty($customer_country)){
	      $customer_country = $this->db->query("select country from db_country where id='$customer_country'")->row()->country;  
	    }
	    if(!empty($customer_state)){
	      $customer_state = $this->db->query("select state from db_states where id='$customer_state'")->row()->state;  
	    }

		?>
		<div class="modal fade" id="pay_now">
		  <div class="modal-dialog ">
		    <div class="modal-content">
		      <div class="modal-header header-custom">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title text-center">Payments</h4>
		      </div>
		      <div class="modal-body">
		        
		    <div class="row">
		      <div class="col-md-12">
		      	<div class="row invoice-info">
			        <div class="col-sm-4 invoice-col">
			          Customer Information
			          <address>
			            <strong><?php echo  $customer_name; ?></strong><br>
			            <?php echo (!empty(trim($customer_mobile))) ? $this->lang->line('mobile').": ".$customer_mobile."<br>" : '';?>
			            <?php echo (!empty(trim($customer_phone))) ? $this->lang->line('phone').": ".$customer_phone."<br>" : '';?>
			            <?php echo (!empty(trim($customer_email))) ? $this->lang->line('email').": ".$customer_email."<br>" : '';?>
			            <?php echo (!empty(trim($customer_gst_no))) ? $this->lang->line('gst_number').": ".$customer_gst_no."<br>" : '';?>
			            <?php echo (!empty(trim($customer_tax_number))) ? $this->lang->line('tax_number').": ".$customer_tax_number."<br>" : '';?>
			            
			          </address>
			        </div>
			        <!-- /.col -->
			        <div class="col-sm-4 invoice-col">
			          Sales Information:
			          <address>
			            <b>Invoice #<?php echo  $booking_code; ?></b><br>
			            <b>Date :<?= show_date($booked_date); ?></b><br>
			            <b>Grand Total :<?php echo $grand_total; ?></b><br>
			          </address>
			        </div>
			        <!-- /.col -->
			        <div class="col-sm-4 invoice-col">
			          <b>Paid Amount :<span><?php echo number_format($paid_amount,2,'.',''); ?></span></b><br>
			          <b>Due Amount :<span id='due_amount_temp'><?php echo number_format($due_amount,2,'.',''); ?></span></b><br>
			         
			        </div>
			        <!-- /.col -->
			      </div>
			      <!-- /.row -->
		      </div>
		      <div class="col-md-12">
		        <div>
		        <input type="hidden" name="payment_row_count" id='payment_row_count' value="1">
		        <div class="col-md-12  payments_div">
		          <div class="box box-solid bg-gray">
		            <div class="box-body">
		              <div class="row">
		         		<div class="col-md-4">
		                  <div class="">
		                  <label for="payment_date">Date</label>
		                    <div class="input-group date">
			                      <div class="input-group-addon">
			                      <i class="fa fa-calendar"></i>
			                      </div>
			                      <input type="text" class="form-control pull-right datepicker" value="<?= show_date(date("d-m-Y")); ?>" id="payment_date" name="payment_date" readonly>
			                    </div>
		                      <span id="payment_date_msg" style="display:none" class="text-danger"></span>
		                </div>
		               </div>
		                <div class="col-md-4">
		                  <div class="">
		                  <label for="amount">Amount</label>
		                    <input type="text" class="form-control text-right paid_amt" id="amount" name="amount" placeholder="" value="<?=$due_amount;?>" onkeyup="calculate_payments()">
		                      <span id="amount_msg" style="display:none" class="text-danger"></span>
		                </div>
		               </div>
		                <div class="col-md-4">
		                  <div class="">
		                    <label for="payment_type">Payment Type</label>
		                    <select class="form-control" id='payment_type' name="payment_type">
		                      <?php
		                        $q1=$this->db->query("select * from db_paymenttypes where status=1");
		                         if($q1->num_rows()>0){
		                             foreach($q1->result() as $res1){
		                             echo "<option value='".$res1->payment_type."'>".$res1->payment_type ."</option>";
		                           }
		                         }
		                         else{
		                            echo "No Records Found";
		                         }
		                        ?>
		                    </select>
		                    <span id="payment_type_msg" style="display:none" class="text-danger"></span>
		                  </div>
		                </div>
		            <div class="clearfix"></div>
		        </div>  
		        <div class="row">
		               <div class="col-md-12">
		                  <div class="">
		                    <label for="payment_note">Payment Note</label>
		                    <textarea type="text" class="form-control" id="payment_note" name="payment_note" placeholder="" ></textarea>
		                    <span id="payment_note_msg" style="display:none" class="text-danger"></span>
		                  </div>
		               </div>
		                
		            <div class="clearfix"></div>
		        </div>   
		        </div>
		        </div>
		      </div><!-- col-md-12 -->
		    </div>
		      </div><!-- col-md-9 -->
		      <!-- RIGHT HAND -->
		    </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
		        <button type="button" onclick="save_payment2(<?=$sales_id;?>)" class="btn bg-green btn-lg place_order btn-lg payment_save">Save<i class="fa  fa-check "></i></button>
		      </div>
		    </div>
		    <!-- /.modal-content -->
		  </div>
		  <!-- /.modal-dialog -->
		</div>
		<?php
	}


	public function show_pay_now_modal2($sales_id){
		$q1=$this->db->query("select * from db_booking where id=$sales_id");
		$res1=$q1->row();
		$customer_id = $res1->customer_id;
		$q2=$this->db->query("select * from db_customers where id=$customer_id");
		$res2=$q2->row();

		$customer_name=$res2->customer_name;
	    $customer_mobile=$res2->mobile;
	    $customer_phone=$res2->phone;
	    $customer_email=$res2->email;
	    $customer_country=$res2->country_id;
	    $customer_state=$res2->state_id;
	    $customer_address=$res2->address;
	    $customer_postcode=$res2->postcode;
	    $customer_gst_no=$res2->gstin;
	    $customer_tax_number=$res2->tax_number;
	    $customer_opening_balance=$res2->opening_balance;

	    $booked_date=$res1->booked_date;
	    $reference_no=$res1->reference_no;
	    $booking_code=$res1->booking_code;
	    $sales_note=$res1->sales_note;
	    $grand_total=$res1->grand_total;
	    $paid_amount=$res1->paid_amount;
	    $due_amount =$grand_total - $paid_amount;

	    if(!empty($customer_country)){
	      $customer_country = $this->db->query("select country from db_country where id='$customer_country'")->row()->country;  
	    }
	    if(!empty($customer_state)){
	      $customer_state = $this->db->query("select state from db_states where id='$customer_state'")->row()->state;  
	    }

		?>
		<div class="modal fade" id="pay_now2">
		  <div class="modal-dialog ">
		    <div class="modal-content">
		      <div class="modal-header header-custom">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title text-center">Payments</h4>
		      </div>
		      <div class="modal-body">
		        
		    <div class="row">
		      <div class="col-md-12">
		      	<div class="row invoice-info">
			        <div class="col-sm-4 invoice-col">
			          Customer Information
			          <address>
			            <strong><?php echo  $customer_name; ?></strong><br>
			            <?php echo (!empty(trim($customer_mobile))) ? $this->lang->line('mobile').": ".$customer_mobile."<br>" : '';?>
			            <?php echo (!empty(trim($customer_phone))) ? $this->lang->line('phone').": ".$customer_phone."<br>" : '';?>
			            <?php echo (!empty(trim($customer_email))) ? $this->lang->line('email').": ".$customer_email."<br>" : '';?>
			            <?php echo (!empty(trim($customer_gst_no))) ? $this->lang->line('gst_number').": ".$customer_gst_no."<br>" : '';?>
			            <?php echo (!empty(trim($customer_tax_number))) ? $this->lang->line('tax_number').": ".$customer_tax_number."<br>" : '';?>
			            
			          </address>
			        </div>
			        <!-- /.col -->
			        <div class="col-sm-4 invoice-col">
			          Sales Information:
			          <address>
			            <b>Invoice #<?php echo  $booking_code; ?></b><br>
			            <b>Date :<?= show_date($booked_date); ?></b><br>
			            <b>Grand Total :<?php echo $grand_total; ?></b><br>
			          </address>
			        </div>
			        <!-- /.col -->
			        <div class="col-sm-4 invoice-col">
			          <b>Paid Amount :<span><?php echo number_format($paid_amount,2,'.',''); ?></span></b><br>
			          <b>Due Amount :<span id='due_amount_temp'><?php echo number_format($due_amount,2,'.',''); ?></span></b><br>
			         
			        </div>
			        <!-- /.col -->
			      </div>
			      <!-- /.row -->
		      </div>
		      <div class="col-md-12">
		        <div>
		        <input type="hidden" name="payment_row_count" id='payment_row_count' value="1">
		        <div class="col-md-12  payments_div">
		          <div class="box box-solid bg-gray">
		            <div class="box-body">
		              <div class="row">
		         		<div class="col-md-4">
		                  <div class="">
		                  <label for="payment_date">Date</label>
		                    <div class="input-group date">
			                      <div class="input-group-addon">
			                      <i class="fa fa-calendar"></i>
			                      </div>
			                      <input type="text" class="form-control pull-right datepicker" value="<?= show_date(date("d-m-Y")); ?>" id="payment_date" name="payment_date" readonly>
			                    </div>
		                      <span id="payment_date_msg" style="display:none" class="text-danger"></span>
		                </div>
		               </div>
		                <div class="col-md-4">
		                  <div class="">
		                  <label for="amount">Amount</label>
		                    <input type="text" class="form-control text-right paid_amt" id="amount" name="amount" placeholder="" value="<?=$due_amount;?>" onkeyup="calculate_payments()">
		                      <span id="amount_msg" style="display:none" class="text-danger"></span>
		                </div>
		               </div>
		                <div class="col-md-4">
		                  <div class="">
		                    <label for="payment_type">Payment Type</label>
		                    <select class="form-control" id='payment_type' name="payment_type">
		                      <?php
		                        $q1=$this->db->query("select * from db_paymenttypes where status=1");
		                         if($q1->num_rows()>0){
		                             foreach($q1->result() as $res1){
		                             echo "<option value='".$res1->payment_type."'>".$res1->payment_type ."</option>";
		                           }
		                         }
		                         else{
		                            echo "No Records Found";
		                         }
		                        ?>
		                    </select>
		                    <span id="payment_type_msg" style="display:none" class="text-danger"></span>
		                  </div>
		                </div>
		            <div class="clearfix"></div>
		        </div>  
		        <div class="row">
		               <div class="col-md-12">
		                  <div class="">
		                    <label for="payment_note">Payment Note</label>
		                    <textarea type="text" class="form-control" id="payment_note" name="payment_note" placeholder="" ></textarea>
		                    <span id="payment_note_msg" style="display:none" class="text-danger"></span>
		                  </div>
		               </div>
		                
		            <div class="clearfix"></div>
		        </div>   
		        </div>
		        </div>
		      </div><!-- col-md-12 -->
		    </div>
		      </div><!-- col-md-9 -->
		      <!-- RIGHT HAND -->
		    </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
		        <button type="button" onclick="save_payment(<?=$sales_id;?>)" class="btn bg-green btn-lg place_order btn-lg payment_save">Save<i class="fa  fa-check "></i></button>
		      </div>
		    </div>
		    <!-- /.modal-content -->
		  </div>
		  <!-- /.modal-dialog -->
		</div>
		<?php
	}

	public function save_payment(){
		extract($this->xss_html_filter(array_merge($this->data,$_POST,$_GET)));
		
		$letters = '';
			$numbers = ''; 
			foreach (range('A', 'Z') as $char) {
				$letters .= $char; 
			}
			for($i = 0; $i < 10; $i++){
				$numbers .= $i;
			}
		$payment_code = substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 3);
			

    	if($amount=='' || $amount==0){$amount=null;}
		if($amount>0 && !empty($payment_type)){
			$bookingpayments_entry = array(
					'booking_id' 		=> $sales_id, 
					'payment_code' 		=> $payment_code, 
					'payment_date'		=> date("Y-m-d",strtotime($payment_date)),//Current Payment with sales entry
					'payment_type' 		=> $payment_type,
					'payment' 			=> $amount,
					'payment_note' 		=> $payment_note,
					'created_date' 		=> $CUR_DATE,
    				'created_time' 		=> $CUR_TIME,
    				'created_by' 		=> $CUR_USERNAME,
    				'system_ip' 		=> $SYSTEM_IP, 
    				'system_name' 		=> $SYSTEM_NAME,
    				'status' 			=> 1,
				);
 
			$q3 = $this->db->insert('db_bookingpayments', $bookingpayments_entry);
			if($q3){
				$q4=$this->db->query("UPDATE db_booking SET new_amt_paid = '$amount',payment_code= '$payment_code' WHERE id='$sales_id'");
				// $this->simple_query($q4);
			}
		} 
		else{
			return "Please Enter Valid Amount!";
		}
		
		$customer_id = $this->db->query("select customer_id from db_booking where id=$sales_id")->row()->customer_id;
		$q10=$this->update_sales_payment_status($sales_id,$customer_id);
		if($q10!=1){
			return "failed";
		}
		return "success";

	}
	
	public function view_payments_modal($sales_id){
		$q1=$this->db->query("select * from db_booking where id=$sales_id");
		$res1=$q1->row();
		$customer_id = $res1->customer_id;
		$q2=$this->db->query("select * from db_customers where id=$customer_id");
		$res2=$q2->row();

		$customer_name=$res2->customer_name;
	    $customer_mobile=$res2->mobile;
	    $customer_phone=$res2->phone;
	    $customer_email=$res2->email;
	    $customer_country=$res2->country_id;
	    $customer_state=$res2->state_id;
	    $customer_address=$res2->address;
	    $customer_postcode=$res2->postcode;
	    $customer_gst_no=$res2->gstin;
	    $customer_tax_number=$res2->tax_number;
	    $customer_opening_balance=$res2->opening_balance;

		$booked_date=$res1->booked_date;
	    $booking_code=$res1->booking_code;
	    $sales_note=$res1->sales_note;
	    $grand_total=$res1->grand_total;
	    $paid_amount=$res1->paid_amount;
	    $due_amount =$grand_total - $paid_amount;

	    if(!empty($customer_country)){
	      $customer_country = $this->db->query("select country from db_country where id='$customer_country'")->row()->country;  
	    }
	    if(!empty($customer_state)){
	      $customer_state = $this->db->query("select state from db_states where id='$customer_state'")->row()->state;  
	    }

		?>
		<div class="modal fade" id="view_payments_modal">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      <div class="modal-header header-custom">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title text-center">Payments</h4>
		      </div>
		      <div class="modal-body">
		        
		    <div class="row">
		      <div class="col-md-12">
		      	<div class="row invoice-info">
			        <div class="col-sm-4 invoice-col"> 
			          customer Information
			          <address>
			            <strong><?php echo  $customer_name; ?></strong><br>
			            <?php echo (!empty(trim($customer_mobile))) ? $this->lang->line('mobile').": ".$customer_mobile."<br>" : '';?>
			            <?php echo (!empty(trim($customer_phone))) ? $this->lang->line('phone').": ".$customer_phone."<br>" : '';?>
			            <?php echo (!empty(trim($customer_email))) ? $this->lang->line('email').": ".$customer_email."<br>" : '';?>
			            <?php echo (!empty(trim($customer_gst_no))) ? $this->lang->line('gst_number').": ".$customer_gst_no."<br>" : '';?>
			            <?php echo (!empty(trim($customer_tax_number))) ? $this->lang->line('tax_number').": ".$customer_tax_number."<br>" : '';?>
			          </address>
			        </div>
			        <!-- /.col -->
			        <div class="col-sm-4 invoice-col">
			          sales Information:
			          <address>
			            <b>Invoice #<?php echo  $booking_code; ?></b><br>
			            <b>Date :<?php echo show_date($booked_date); ?></b><br>
			            <b>Grand Total :<?php echo $grand_total; ?></b><br>
			          </address>
			        </div>
			        <!-- /.col -->
			        <div class="col-sm-4 invoice-col">
			          <b>Paid Amount :<span><?php echo number_format($paid_amount,2,'.',''); ?></span></b><br>
			          <b>Due Amount :<span id='due_amount_temp'><?php echo number_format($due_amount,2,'.',''); ?></span></b><br>
			         
			        </div>
			        <!-- /.col -->
			      </div>
			      <!-- /.row -->
		      </div>
		      <div class="col-md-12">
		       
		     
		              <div class="row">
		         		<div class="col-md-12">
		                  
		                      <table class="table table-bordered">
                                  <thead>
                                  <tr class="bg-primary">
                                    <th>#</th>
                                    <th>Payment Date</th>
                                    <th>Payment</th>
                                    <th>Payment Type</th>
                                    <th>Payment Note</th>
                                    <th>Created by</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$q1=$this->db->query("select * from db_bookingpayments where booking_id=$sales_id and payment>0");
									$i=1;
									$str = '';
									if($q1->num_rows()>0){
										foreach ($q1->result() as $res1) {
											echo "<tr>";
											echo "<td>".$i++."</td>";
											echo "<td>".show_date($res1->payment_date)."</td>";
											echo "<td>".$res1->payment."</td>";
											echo "<td>".$res1->payment_type."</td>";
											echo "<td>".$res1->payment_note."</td>";
											echo "<td>".ucfirst($res1->created_by)."</td>";
										
											echo "<td><a onclick='delete_sales_payment(".$res1->id.")' class='pointer btn  btn-danger' ><i class='fa fa-trash'></i></</td>";	
											echo "</tr>";
										}
									}
									else{
										echo "<tr><td colspan='7' class='text-danger text-center'>No Records Found</td></tr>";
									}
									?>
                                </tbody>
                            </table>
		               
		               </div>
		            <div class="clearfix"></div>
		        </div>    
		       
		     
		   
		      </div><!-- col-md-9 -->
		      <!-- RIGHT HAND -->
		    </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
		        
		      </div>
		    </div>
		    <!-- /.modal-content -->
		  </div>
		  <!-- /.modal-dialog -->
		</div>
		<?php
	}



// new supply list
public function get_new_supply_list_details(){
	$data=$this->data;
	extract($data);
	extract($_POST);
	  $i=0; 
	  $str='';
	  if(!empty($id)){ 
		  $str="and a.category_id=$id";
	  }
	  $table=''; 
	 
	  $q2=$this->db->query("SELECT a.id,a.reference_no, a.customer_id,a.item_id,a.sales_id,a.sales_qty,a.delivery_date,a.order_id,b.customer_name,c.item_name, d.payment_status From db_bookeditems AS a, db_customers AS b, db_items AS c, db_booking AS d WHERE b.id=a.customer_id AND  c.id=a.item_id AND d.id = a.sales_id AND d.payment_status ='paid' AND a.sales_qty >0");
	  
	  if($q2->num_rows()>0){
		foreach($q2->result() as $res2){
			$customer_name = $res2->customer_name;
			$item_name = $res2->item_name;
			$sales_qty = $res2->sales_qty;
			$reference_no = $res2->reference_no;
			$customer_id = $res2->customer_id;
			$item_id = $res2->item_id;
			$sales_id = $res2->sales_id;
			$delivery_date = $res2->delivery_date;
			// $order_qty = $res2->order_qty;
			// $total_brol = $res2->total_brol;
			// $total_lay = $res2->total_lay;
			// $total_eggs = $res2->total_eggs;
			// $order_id = $res2->order_id;
		

			if($res2->sales_qty <1){
				$str="zero_stock()";
				$disabled='';
				$bg_color="background-color:#c8c8c8";
			}
			else{
				$str="addrow($res2->id)";
				$disabled="disabled=disabled";
				$bg_color="background-color: #0c18d0;";
			}

			$img_src = (!empty($res2->item_image) && file_exists($res2->item_image)) ? base_url(return_item_image_thumb($res2->item_image)) : base_url('theme/images/no_image.png');

			$table .= '<div class="col-md-3 col-xs-6 " id="item_parent_'.$i.'" '.$disabled.' data-toggle="tooltip" title="'.$res2->item_name.'">
		  <div class="box box-default item_box" id="div_'.$res2->id.'" onclick="'.$str.'"
						  data-item-id="'.$res2->id.'"
						  data-customer-name="'.$customer_name.'"
						  data-item-name="'.$res2->item_name.'"
		 				  data-item-available-qty="'.$res2->sales_qty.'"
						  data-sales-qty="'.$sales_qty.'"
						  data-item-reference_no="'.$reference_no.'"
						  data-item-customer_id="'.$customer_id.'"
						  data-item-booking_id="'.$item_id.'"
						  data-item-sales_id="'.$sales_id.'"
						   style="cursor: pointer;'.$bg_color.'">
			   <span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="'.$res2->sales_qty.' Quantity booked">'.$res2->sales_qty.'</span>
			<div class="box-body box-profile" style="background: #000 !important;">
			
			  <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;color:#fff" id="item_'.$i.'">'.substr($res2->customer_name,0,25).'</label>
			</div>
		  </div>
		</div>';
		  $i++;
		  }//for end
		  return $table;
	  }//if num_rows() end
	 
}

	
	//Save Sales
	public function pos_save_update(){//Save or update sales
		$this->db->trans_begin();
		extract($this->xss_html_filter(array_merge($this->data,$_POST,$_GET)));
		//print_r($this->xss_html_filter(array_merge($this->data,$_POST,$_GET)));exit();

		//check payment method
		if(isset($by_cash) && $by_cash==true){ //by cash payment
			$by_cash=true;
			$payment_row_count=1;
		}else{ //by multiple payments
			$by_cash=false;
		}
		//end 

		$rowcount 			=$hidden_rowcount;
		$sales_date 		=date("Y-m-d",strtotime($CUR_DATE));
		//$points 			= (empty($points_use)) ? 'NULL' : $points_use;
		
		

		//FIND CUSTOMER INFORMATION BY ITS ID
		$q1=$this->db->query("select supplier_name,mobile from db_suppliers where id=$supplier_id");
		$supplier_name 	= $q1->row()->supplier_name;
		$mobile 		= $q1->row()->mobile;

		
		if($command=='save'){
			
			//GET SALES INITIAL
			$q5=$this->db->query("select sales_init from db_company where id=1");
			$init=$q5->row()->sales_init;	
			

			//ORDER SALES CREATION
			$maxid=$this->db->query("SELECT COALESCE(MAX(id),0)+1 AS maxid FROM db_bookingsupply")->row()->maxid;
			$tran_code=$init.str_pad($maxid, 4, '0', STR_PAD_LEFT);

			$booking_entry = array(
							'tran_code' 				=> $tran_code,
		    				'supplier_id' 				=> $supplier_id,
		    				'delivered_date' 			=> $delivered_date ,
		    				/*System Info*/
		    				'created_date' 				=> $CUR_DATE,
		    				'created_time' 				=> $CUR_TIME,
		    				'created_by' 				=> $CUR_USERNAME,
		    				'system_ip' 				=> $SYSTEM_IP,
		    				'system_name' 				=> $SYSTEM_NAME,
		    				'pos' 						=> 1,
		    			);

			$q3 = $this->db->insert('db_bookingsupply ', $booking_entry);
			$trans_id = $this->db->insert_id();

			if($trans_id){
				
				$q13 = $this->db->query("SELECT delivered_date,supplier_id FROM db_bookingsupply WHERE id=$trans_id");
			
				$delivered_date = $q13->row()->delivered_date;
				$supplier_id = $q13->row()->supplier_id;
			}
		}
		//Import post data from form
		$letters = 'BK';
				$numbers = 1; 
				
				for($i = 0; $i < 10; $i++){
					$numbers .= $i;
				}
				$reference_no = $letters.substr(str_shuffle($numbers), 0, 4);
		for($i=0;$i<$rowcount;$i++){
		
			if(isset($_REQUEST['tr_item_id_'.$i]) && trim($_REQUEST['tr_item_id_'.$i])!=''){
			
				//RECEIVE VALUES FROM FORM 
				$item_id 	=$this->xss_html_filter(trim($_REQUEST['tr_item_id_'.$i]));
				$sales_qty 	=$this->xss_html_filter(trim($_REQUEST['sales_qty_'.$i]));
				// $reference_no =$this->xss_html_filter(trim($_REQUEST['reference_no_'.$i]));
				$customer_id =$this->xss_html_filter(trim($_REQUEST['customer_id_'.$i]));
				$order_id =$this->xss_html_filter(trim($_REQUEST['order_id_'.$i]));
				$sales_id =$this->xss_html_filter(trim($_REQUEST['sales_id_'.$i]));
				$booking_id =$this->xss_html_filter(trim($_REQUEST['booking_id_'.$i]));
				$qty_left =$this->xss_html_filter(trim($_REQUEST['td_data_'.$i.'_4']));
				$item_name =$this->xss_html_filter(trim($_REQUEST['td_data_'.$i.'_0']));
				$qty_taken 	=$this->xss_html_filter(trim($_REQUEST['item_qty_'.$item_id]));
				// $tot_ord_qty_left 	=$this->xss_html_filter(trim($_REQUEST['tot_ord_qty_left_'.$i]));

				
				if($customer_id=='' || $customer_id==0){$customer_id=null;}
				if($booking_id=='' || $booking_id==0){$booking_id=null;}
				if($sales_id=='' || $sales_id==0){$sales_id=null;}
				if($sales_qty=='' || $sales_qty==0){$sales_qty=null;}
				
				/* ******************************** */
				// $q21 = $this->db->query("SELECT reference_no from db_bookingtransactions where delivered_date = '$delivered_date'")->row()->reference_no;
				// if($q21){
				// 	$reference_no = $q21;
				// }else{
					
				
				
				$deliveryitems_entry = array(
							'sales_item_id'		=> $trans_id, 
		    				'customer_id'		=> $customer_id, 
							'item_id' 			=> $item_id, 
							'supplier_id' 		=> $supplier_id,
							'item_name' 		=> $item_name,
							'delivered_date' 	=> $delivered_date,
							'qty_taken ' 		=> $qty_taken, 
		    				'qty_left' 			=> $qty_left,
		    				'reference_no' 		=> $reference_no,
		    			);
				$q4 = $this->db->insert('db_bookingtransactions', $deliveryitems_entry);
				// $q11=$this->db->query("UPDATE db_booking_orders set total_brol ='$tot_layers_left', order_qty ='$tot_layers_left' where id='$order_id'");

				if($q4){
					
					$q8=$this->db->query("update db_bookeditems set sales_qty ='$qty_left' where id='$item_id'");
					if($q8){
						$q9=$this->db->query("select sales_id from db_bookeditems where id='$item_id'")->row()->sales_id;
						if($q9){
							$q10=$this->db->query("update db_booking set qty_booked ='$qty_left' where id='$q9'");

						}
					}
					// if ($q9->sales_qty < 1) {
					// 	$q7=$this->db->query("update db_booking set delivery_status='delivered' where reference_no ='$reference_no'");
					// }
					
				}else{
					return "fail";
				}
				
				

			}
		
		}//for end

		//UPDATE CUSTMER MULTPLE PAYMENTS
		for($i=1;$i<=$payment_row_count;$i++){
		
			if((isset($_REQUEST['amount_'.$i]) && trim($_REQUEST['amount_'.$i])!='') || ($by_cash==true)){

				if($by_cash==true){
					//RECEIVE VALUES FROM FORM
					$amount 		=$tot_grand;
					$payment_type 	='Cash';
					$payment_note 	='Paid By Cash';
				}
				else{
					//RECEIVE VALUES FROM FORM
					$amount 		=$this->xss_html_filter(trim($_REQUEST['amount_'.$i]));
					$payment_type 	=$this->xss_html_filter(trim($_REQUEST['payment_type_'.$i]));
					$payment_note 	=$this->xss_html_filter(trim($_REQUEST['payment_note_'.$i]));
				}

				//If amount is greater than paid amount
				$change_return=0;
				if($amount>$tot_grand){
					$change_return =$amount-$tot_grand;
					$amount =$tot_grand;
				}
				//end
				
				$salespayments_entry = array(
					'sales_id' 		=> $sales_id, 
					'payment_date'		=> $sales_date,//Current Payment with sales entry
					'payment_type' 		=> $payment_type,
					'payment' 			=> $amount,
					'payment_note' 		=> $payment_note,
					'created_date' 		=> $CUR_DATE,
    				'created_time' 		=> $CUR_TIME,
    				'created_by' 		=> $CUR_USERNAME,
    				'system_ip' 		=> $SYSTEM_IP,
    				'system_name' 		=> $SYSTEM_NAME,
    				'change_return' 	=> $change_return,
    				'status' 			=> 1,
				);

			  $q7 = $this->db->insert('db_salespayments', $salespayments_entry);

			    if(!$q7)
				{
					echo "q7\n";	
					return "failed";
				}
				
			}//if()
		
		}//for end

	
		//UPDATE itemS QUANTITY IN itemS TABLE
		$this->load->model('sales_model');				
		$q6=$this->sales_model->update_sales_payment_status($sales_id,$customer_id);
		if(!$q6){
			return "failed";
		}

		if(isset($hidden_invoice_id) && !empty($hidden_invoice_id)){
			$q13=$this->hold_invoice_delete($hidden_invoice_id);
			if(!$q13){
				return "failed";
			}
		}
		//COMMIT RECORD
		$this->db->trans_commit();
		
		$sms_info='';
		if(isset($send_sms) && $customer_id!=1){
			if(send_sms_using_template($sales_id,1)==true){
				$sms_info = 'SMS Has been Sent!';
			}else{
				$sms_info = 'Failed to Send SMS';
			}
		}

		$this->session->set_flashdata('success', 'Success!! Sales Created Successfully!'.$sms_info);
        return "success<<<###>>>$sales_id";


	}
	public function hold_invoice_list(){
		$data=$this->data;
		extract($data);
		extract($_POST);
		  $i=0;
		  $str ='';
	      $q2=$this->db->query("select * from temp_holdinvoice where status=1 group by invoice_id order by id desc");
	      if($q2->num_rows()>0){
	        foreach($q2->result() as $res2){
	     
                  $str =$str."<tr>";
                  $str =$str."<td>".$res2->id."</td>";
                  $str =$str."<td>".show_date($res2->invoice_date)."</td>";
                  $str =$str."<td>".$res2->reference_id."</td>";
                  $str =$str."<td>";
                  	$str =$str.'<a class="fa fa-fw fa-trash-o text-red" style="cursor: pointer;font-size: 20px;" onclick="hold_invoice_delete('.$res2->invoice_id.')" title="Delete Invoive?"></a>';
                  	$str =$str.'<a class="fa fa-fw fa-edit text-success" style="cursor: pointer;font-size: 20px;" onclick="hold_invoice_edit('.$res2->invoice_id.')" title="Edit Invoive?"></a>';
                  $str =$str."</td>";
                $str =$str."</tr>";
	     
	          $i++;
	          }//for end
	      }//if num_rows() end
	      else{
	      	
	      	$str =$str."<tr>";
	      		$str =$str.'<td colspan="4" class="text-danger text-center">No Records Found</td>';
	      	$str =$str.'</tr>';
	      	
	      }
		return $str;
	}
	public function hold_invoice_delete($invoice_id){
		$this->db->trans_begin();
		$q1=$this->db->query("DELETE from temp_holdinvoice where invoice_id='$invoice_id'");
		if(!$q1){
			return "failed";
		}
		//COMMIT RECORD
		$this->db->trans_commit();
        return "success";

	}
	public function hold_invoice_edit(){
		extract($this->xss_html_filter(array_merge($this->data,$_POST,$_GET)));
		$display_json = array();
		$sql =$this->db->query("SELECT * from temp_holdinvoice where invoice_id='$invoice_id'");	
		foreach ($sql->result() as $res) {
		     $json_arr["id"] = $res->id;
			 $json_arr["item_id"] = $res->item_id;
		  	 $json_arr['item_qty']=$res->item_qty;
			 $json_arr['item_price']=$res->item_price;
			 $json_arr['item_tax']=$res->tax;
			 array_push($display_json, $json_arr);
		}
		return json_encode($display_json);
	}

	public function edit_pos($id){
		$data=$this->data;
		extract($data);
	     $q2=$this->db->query("select * from db_bookingsupply where id='$id'");
	    if($q2->num_rows()>0){
	      $res2=$q2->row();
	      $sales_date=show_date($res2->delivered_date);
	    //   $customer_id=$res2->customer_id;
	    //   $discount_input=$res2->discount_to_all_input;
	    //   $discount_type=$res2->discount_to_all_type;
	    //   $grand_total=$res2->grand_total;
	      

	      $q3=$this->db->query("SELECT * FROM db_bookingtransactions WHERE sales_item_id='$id'");
		  $rows=$q3->num_rows();
		  if($rows>0){
		  	$i=0;
		  	
		  	foreach ($q3->result() as $res3) { 
				$q5=$this->db->query("SELECT *, a.item_name,b.customer_name,c.supplier_name from db_bookingtransactions a, db_customers b, db_suppliers c where b.id = a.customer_id and c.id=a.supplier_id and a.sales_item_id=".$id);
		  		
		  		// $price_per_unit = $res3->price_per_unit;
		  		$customer_name = $res3->customer_name;
		  		$item_name = $res3->item_name;
		  		// $item_name = $res3->item_name;
		  		// $stock = $res3->qty_booked;
		  		$stock=$res3->qty_left + $res3->qty_taken;
		  		$qty_taken=$res3->qty_taken;
		  		$qty_left=$res3->qty_left;
		  		

		$quantity        ='<div class="input-group input-group-sm"><span class="input-group-btn"><button onclick="decrement_qty('.$res3->item_id.','.$i.')" type="button" class="btn btn-default btn-flat"><i class="fa fa-minus text-danger"></i></button></span>';
        $quantity       .='<input typ="text" value="'.$res3->qty_taken.'" class="form-control no-padding text-center" onkeyup="item_qty_input('.$res3->item_id.','.$i.')" id="item_qty_'.$res3->item_id.'" name="item_qty_'.$res3->item_id.'">';
        $quantity       .='<span class="input-group-btn"><button onclick="increment_qty('.$res3->item_id.','.$i.')" type="button" class="btn btn-default btn-flat"><i class="fa fa-plus text-success"></i></button></span></div>';
       
    	$remove_btn      ='<a class="fa fa-fw fa-trash-o text-red" style="cursor: pointer;font-size: 20px;" onclick="removerow('.$i.')" title="Delete Item?"></a>';
   
		echo '<tr id="row_'.$i.'" data-row="0" data-item-id="'.$res3->item_id.'" >'; /*item id */
		echo '<td id="td_'.$i.'_0">
		<a data-toggle="tooltip" title="Click to Change Tax" class="pointer" id="td_data_'.$i.'_0" onclick="show_sales_item_modal('.$i.')">'.$q5->row()->item_name.'<i onclick="" class="fa fa-edit pointer"></i></a>
		</td>';  /*td_0_0 item name*/
    	echo  '<td id="td_'.$i.'_0"><a data-toggle="tooltip" class="pointer" id="td_data_'.$i.'_1" >'.$res3->customer_name.'</a> </td>';/* td_0_0 item name*/ 
        echo '<input reaonly type="hidden" name="td_data_'.$i.'_0" class="pointer" id="td_data_'.$i.'_0" value="'.$item_name.'">';
        echo '<td id="td_'.$i.'_1">'.$stock.'</td>';
        echo '<td id="td_'.$i.'_2">'.$quantity.'</td>';
        echo '<input type="hidden" id="sales_qty_'.$i.'" name="sales_qty_'.$i.'" value="'.$qty_taken.'">';
        // $qty_left       =(parseFloat(1)*parseFloat($qty_taken)).toFixed(2);//Initial
        // tot_layers       =(parseFloat(1)*parseFloat(tot_layers)).toFixed(2)//Initial
        echo '<td id="td_'.$i.'_4" class="text-right"><input data-toggle="tooltip" title="Qty Left" id="td_data_'.$i.'_4" name="td_data_'.$i.'_4" type="text" class="form-control no-padding pointer" readonly value="'.$qty_left.'"></td>';/* td_0_4 item sub_total */
        echo '<td id="td_'.$i.'_5">'.$remove_btn.'</td>';/* td_0_5 item gst_amt */
        echo '<input type="hidden" name="tr_item_id_'.$i.'" id="tr_item_id_'.$i.'" value="'.$item_id.'">';
        echo '<input type="hidden" id="tr_sales_price_'.$i.'" name="tr_sales_price_'.$i.'" value="'.$sales_price_temp.'">';
        echo '<input type="hidden" id="tr_tax_type_'.$i.'" name="tr_tax_type_'.$i.'" value="'.$tax_type.'">';
       
        echo '<input type="hidden" id="tr_tax_id_'.$i.'" name="tr_tax_id_'.$i.'" value="'.$tax_id.'">';
        echo '<input type="hidden" id="tr_tax_value_'.$i.'" name="tr_tax_value_'.$i.'" value="'.$tax_value.'">';
        echo'<input type="hidden" id="description_'.$i.'" name="description_'.$i.'" value="">';
        echo '<input type="hidden" id="tot_ord_qty_left_'.$i.'" name="tot_ord_qty_left_'.$i.'" value="'.$qty_left.'">';
        echo '<input type="hidden" id="reference_no_'.$i.'" name="reference_no_'.$i.'" value="'.$reference_no.'">';
        echo '<input type="hidden" id="customer_id_'.$i.'" name="customer_id_'.$i.'" value="'.$customer_id.'">';
        echo '<input type="hidden" id="order_id_'.$i.'" name="order_id_'.$i.'" value="'.$order_id.'">';
        echo '<input type="hidden" id="sales_id_'.$i.'" name="sales_id_'.$i.'" value="'.$sales_id.'">';
        echo '<input type="hidden" id="booking_id_'.$i.'" name="booking_id_'.$i.'" value="'.$booking_id.'">';
        // echo '<input type="hidden" id="total_lay_'.$i.'" name="total_lay_'.$i.'" value="'+tot_layers+'">';
        // echo '<input type="hidden" id="total_brol_'.$i.'" name="total_brol_'.$i.'" value="'+tot_browler+'">';
        // echo '<input type="hidden" id="total_eggs_'.$i.'" name="total_eggs_'.$i.'" value="'+tot_eggs+'">';
        
		echo '<input type="hidden" id="total_qty_pending'.$i.'" name="total_qty_pending'.$i.'" value="">';


		  		$i++;
		  	}//foreach() end

		  	echo "<<<###>>>".$discount_input."<<<###>>>".$discount_type."<<<###>>>".$customer_id;

		  }//if ()
		 
	    }
	    else{
	      print "Record Not Available";
	    }
	     
	}//edit_pos()
}
