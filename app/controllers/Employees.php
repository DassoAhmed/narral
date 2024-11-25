<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('employees_model','employees');
	}
    public function index()
	{ 
		$this->permission_check('employees_view');
		$data=$this->data;
		$data['page_title']=$this->lang->line('employees_list');
		$this->load->view('employees-view');
	}
    public function add()
	{
		$this->permission_check('employees_add');
		$data=$this->data;
		$data['page_title']=$this->lang->line('employees');
		$this->load->view('employees',$data);
	}
	public function newemployee(){
		$this->form_validation->set_rules('full_name', 'Employee Name', 'trim|required');
		$this->form_validation->set_rules('id_num', 'Valid ID Card No', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('position_id', 'Position ID', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {
			$result=$this->employees->verify_and_save();
			echo $result;
		} else {
			echo "Please Fill Compulsory(* marked) Fields.";
		}
	}
	

} 