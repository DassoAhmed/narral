
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_model extends CI_Model {
	//Datatable start 
	var $table = 'db_employees as a';
	var $column_order = array('a.id','a.employee_id', 'a.position_id', 'a.employee_name', 'a.phone', 'a.email', 'a.gender', 'a.id_card', 'a.country_id', 'a.state_id', 'a.city', 'a.address'); //set column field database for datatable orderable
	var $column_search = array('a.id','a.employee_id', 'a.position_id', 'a.employee_name', 'a.phone', 'a.email', 'a.gender', 'a.id_card', 'a.country_id', 'a.state_id', 'a.city', 'a.address'); //set column field database for datatable searchable 
	var $order = array('a.id' => 'desc'); // default order 
public function __construct()
	{
		parent::__construct();
	}  

		//Save Employee
		public function verify_and_save(){
			//Filtering XSS and html escape from user inputs 
			extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST))));
	
			$state = (!empty($state)) ? $state : 'NULL';
	
			//Validate This Employee already exist or not
			$query=$this->db->query("select * from db_customers where upper(customer_name)=upper('$customer_name')");
			if($query->num_rows()>0){
				return "Sorry! This Employee Name already Exist.";
			}
			$query2=$this->db->query("select * from db_customers where mobile='$mobile'");
			if($query2->num_rows()>0 && !empty($mobile)){
				return "Sorry!This Mobile Number already Exist.";;
			}
			
			$qs5="select customer_init from db_company";
			$q5=$this->db->query($qs5);
			$customer_init=$q5->row()->customer_init;
	
			//Create Employee unique Number
			$qs4="select coalesce(max(id),0)+1 as maxid from db_customers";
			$q1=$this->db->query($qs4);
			$maxid=$q1->row()->maxid;
			$customer_code=$customer_init.str_pad($maxid, 4, '0', STR_PAD_LEFT);
			//end
	 
			$query1="insert into db_customers(customer_code,customer_name,mobile,phone,email,
												country_id,state_id,city,postcode,address,opening_balance,
												system_ip,system_name,
												created_date,created_time,created_by,status,gstin,tax_number)
												values('$customer_code','$customer_name','$mobile','$phone','$email',
												'$country',$state,'$city','$postcode','$address','$opening_balance',
												'$SYSTEM_IP','$SYSTEM_NAME',
												'$CUR_DATE','$CUR_TIME','$CUR_USERNAME',1,'$gstin','$tax_number')";
	
			if ($this->db->simple_query($query1)){
					$this->session->set_flashdata('success', 'Success!! New Customer Added Successfully!');
					return "success";
			}
			else{
					return "failed";
			}
			
		}

	

} 