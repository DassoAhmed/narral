<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('Jobactivities_model','jobactivities');
	}
 
    public function add_activity(){
        $this->permission_check('activity_add');
		$data=$this->data;
		$data['page_title']=$this->lang->line('activities');
		$this->load->view('job-new-activity',$data);
    }





	public function return_row_with_data($rowcount,$item_id){
		echo $this->jobactivities->get_items_info($rowcount,$item_id);
	}
}
