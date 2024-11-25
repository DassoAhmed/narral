<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Positions extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('position_model','position');
    }

    public function index()  
	{
		$this->permission_check('positions');
		$data=$this->data;
		$data['page_title']=$this->lang->line('positions');
		$this->load->view('positions',$data);
	} 

    public function addPosition(){
		$this->form_validation->set_rules('position', 'Position', 'trim|required');
		$this->form_validation->set_rules('salary', 'Employee Salary', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {
			$result=$this->position->verify_position_and_save();
			echo $result;
		} else {
			echo "Please Fill Compulsory(* marked) Fields.";
		}
    
    
    }
}
