
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Position_model extends CI_Model {
	//Datatable start 
	var $table = 'db_employees as a';
	var $column_order = array('a.id', 'a.position', 'a.salary', 'a.status'); //set column field database for datatable orderable
	var $column_search = array('a.id', 'a.position', 'a.salary', 'a.status'); //set column field database for datatable searchable 
	var $order = array('a.id' => 'desc'); // default order 
public function __construct()
	{
		parent::__construct();
	}
	public function verify_position_and_save(){
			//Filtering XSS and html escape from user inputs 
			extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST))));
	
			$state = (!empty($state)) ? $state : 'NULL';
	
			//Validate This Employee already exist or not
			$query=$this->db->query("select * from db_postions WHERE upper(position)=upper('$position')");
			if($query->num_rows()>0){
				return "Sorry! This Position Name already Exist.";
			}
			$query1="insert into db_positions(position, salary, status)
												values('$position','$salary',1)";
	
			if ($this->db->simple_query($query1)){
					$this->session->set_flashdata('success', 'Success!! New Postion Added Successfully!');
					return "success";
			}
			else{
					return "failed";
			}
        }



    }