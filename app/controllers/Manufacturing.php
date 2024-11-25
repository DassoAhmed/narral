<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// BDC 
class Manufacturing extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('Manufacturing_model','manufacturing');
	}
    public function index(){ 
        $this->permission_check('manufacturing_view');
		$data=$this->data;
		$data['page_title']=$this->lang->line('manufacturing_list');
		$this->load->view('manufacturing-list',$data);
    }
    public function job_list(){
        $this->permission_check('manufacturing_view');
		$data=$this->data;
		$data['page_title']=$this->lang->line('job_list');
		$this->load->view('job-list',$data);

    }
    public function add()
	{
		$this->permission_check('manufacturing_add');
		$data=$this->data;
		$data['page_title']=$this->lang->line('job_add');
		$this->load->view('manufacturing',$data);
	}
    public function newjob(){
		$this->form_validation->set_rules('job_name', 'Job name', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {
			$result=$this->manufacturing->verify_jobs_and_save();
			echo $result;
		} else {
			echo "Please Fill Compulsory(* marked) Fields.";
		}
    }
    public function update($id){
		$this->permission_check('manufacturing_edit');
		$data=$this->data; 
		$result=$this->manufacturing->get_details($id,$data);
		$data=array_merge($data,$result);
		$this->load->view('manufacturing', $data);
	}
	public function update_manufacturing(){
		$this->form_validation->set_rules('job_name', 'Job Name', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$result=$this->manufacturing->update_manufacturing();
			echo $result;
		} else {
			echo "Please Fill Compulsory(* marked) Fields.";
		}
	}
	public function update_items(){
		$this->form_validation->set_rules('total_qty', 'Item Qty', 'trim|required');
		$this->form_validation->set_rules('actitvty_code', 'Actitvty Code', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$result=$this->manufacturing->update_items();
			echo $result;
		} else {
			echo "Please Fill Compulsory(* marked) Fields.";
		}
	}

	public function add_activity($id){
        $this->permission_check('manufacturing_add');
		$data=$this->data;
		$result=$this->manufacturing->get_details($id,$data);
		$data=array_merge($data,$result);
		$data['page_title']=$this->lang->line('activities');
		$this->load->view('job-new-activity',$data);
    }
	public function summary($id){
        $this->permission_check('job_add'); 
		$data=$this->data;
		$result=$this->manufacturing->get_details($id,$data);
		$data=array_merge($data,$result);
		$data['page_title']=$this->lang->line('activities');
		$this->load->view('activity-summary',$data);
    }
	public function summary_finished($id){
        $this->permission_check('manufacturing_add'); 
		$data=$this->data;
		$result=$this->manufacturing->get_details($id,$data);
		$data=array_merge($data,$result);
		$data['page_title']=$this->lang->line('activities');
		$this->load->view('finished-job-summary',$data);
    }
	public function activity_save_and_update(){
		$this->form_validation->set_rules('activity_date', 'Activity Date', 'trim|required');
		$this->form_validation->set_rules('activity_name', 'Activity Name', 'trim|required');
		$this->form_validation->set_rules('fin_item_id', 'Product Name', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {
	    	$result = $this->manufacturing->verify_save_and_update();
	    	echo $result;
		} else {
			echo "Please Fill Compulsory(* marked) Fields.";
		}
	}

    public function ajax_list()
	{

		$list = $this->manufacturing->get_datatables();
		
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $jobs) {
			$no++;
			$row = array();
			$row[] = '<input type="checkbox" name="checkbox[]" value='.$jobs->id.' class="checkbox column_checkbox" >';
			$row[] = show_date($jobs->job_date);
			$row[] = $jobs->job_name;
			$row[] = $jobs->reference_no;
			$row[] = $jobs->note;			
			$row[] = ucfirst($jobs->created_by);			
				     $str2 = '<div class="btn-group" title="View Account">
										<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
											Action <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-light pull-right">';

											if($this->permissions('job_add'))
											$str2.='<li>
												<a title="Add Activity ?" href="manufacturing/add_activity/'.$jobs->id.'">
													<i class="fa fa-plus-square-o text-orange"></i>Add Activity
												</a>
											</li>';
											if($this->permissions('manufacturing_view'))
											$str2.='<li>
												<a title="View Summary ?" href="manufacturing/summary/'.$jobs->id.'">
													<i class="fa fa-folder-open text-green"></i>Summary
												</a>
											</li>';
											if($this->permissions('manufacturing_edit'))
											$str2.='<li>
												<a title="Edit Record ?" href="manufacturing/update/'.$jobs->id.'">
													<i class="fa fa-fw fa-edit text-blue"></i>Edit
												</a>
											</li>';

											
											
										'</ul>
									</div>';			
			$row[] = $str2;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->manufacturing->count_all(),
						"recordsFiltered" => $this->manufacturing->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
    public function ajax_job_list()
	{


		$list = $this->manufacturing->get_datatables_finished_jobs();
		
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $jobs) {
			$no++;
			$row = array();
			$row[] = '<input type="checkbox" name="checkbox[]" value='.$jobs->id.' class="checkbox column_checkbox" >';
			$row[] = show_date($jobs->job_date);
			$row[] = $jobs->job_name;
			$row[] = $jobs->reference_no;
			$row[] = $jobs->note;			
			$row[] = ucfirst($jobs->created_by);			
				     $str2 = '<div class="btn-group" title="View Account">
										<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
											Action <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-light pull-right">';

											if($this->permissions('manufacturing_edit'))
											$str2.='<li>
												<a title="View Summary ?" href="summary_finished/'.$jobs->id.'">
													<i class="fa fa-folder-open text-green"></i>Summary
												</a>
											</li>';
											if($this->permissions('delete_job'))
											$str2.='<li>
											<a style="cursor:pointer" title="Delete Record ?" onclick="delete_job(\''.$jobs->id.'\')">
											<i class="fa fa-fw fa-trash text-red"></i>Delete
										</a>
											</li>';

											
											
										'</ul>
									</div>';			
			$row[] = $str2;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->manufacturing->count_all(),
						"recordsFiltered" => $this->manufacturing->count_filtered2(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

    public function manufacturing_update($id){
		$this->permission_check_with_msg('manufacturing_edit');
		$data=$this->data;		
		$result=$this->manufacturing->get_details($id,$data);
		$data=array_merge($data,$result);
		$data['page_title']=$this->lang->line('manufacturing_update');
		$this->load->view('manufacturing-update', $data);
	}

	public function return_row_with_data($rowcount,$item_id){
		echo $this->manufacturing->get_items_info($rowcount,$item_id);
	}


	//Table ajax code
	public function search_item(){
		$q=$this->input->get('q');
		$result=$this->manufacturing->search_item($q);
		echo $result;
	}
	public function find_item_details(){
		$id=$this->input->post('id');
		
		$result=$this->manufacturing->find_item_details($id);
		echo $result;
	}

	public function delete_job(){
		$this->permission_check_with_msg('delete_job');
		$id=$this->input->post('q_id');
		echo $this->manufacturing->delete_job($id);
	}
	public function multi_delete_jobs(){
		$this->permission_check_with_msg('delete_job');
		$ids=implode (",",$_POST['checkbox']);
		return $this->manufacturing->delete_job_from_table($ids);
	}

}