<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('departments_model','departments');
	}
public function index(){
		$this->permission_check('employees_add');
		$data=$this->data;
		$data['page_title']=$this->lang->line('departments'); 
		$this->load->view('departments',$data);
	}
	public function add_department(){
		$this->permission_check('employees_add');
		$data=$this->data;
		$data['page_title']=$this->lang->line('departments');
		$this->load->view('add_department',$data);
	}

	public function newdepartment(){
		$this->form_validation->set_rules('department', 'Deparment', 'trim|required');
	
 
		if ($this->form_validation->run() == TRUE) { 
			
			$this->load->model('departments');
			$result=$this->departments->verify_and_save();
			echo $result;
		} else {
			echo "Please Enter Department name.";
		}
	}

	public function update($id){
		$this->permission_check('employee_department_edit');
		$data=$this->data;

		$this->load->model('departments');
		$result=$this->departments->get_details($id,$data);
		$data=array_merge($data,$result);
		$data['page_title']=$this->lang->line('departments');
		$this->load->view('departments', $data);
	}
	public function update_department(){
		$this->form_validation->set_rules('department', 'Department', 'trim|required');
		$this->form_validation->set_rules('q_id', '', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			
			$this->load->model('departments');
			$result=$this->departments->update_department();
			echo $result;
		} else {
			echo "Please Enter Department name.";
		}
	}


	public function ajax_list()
	{
		$list = $this->departments->get_datatables();
		
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $departments) {
			$no++;
			$row = array();
			$row[] = '<input type="checkbox" name="checkbox[]" value='.$departments->id.' class="checkbox column_checkbox" >';
			$row[] = $departments->department_code;
			$row[] = $departments->department_name;
			$row[] = $departments->description;

			 		if($departments->status==1){ 
			 			$str= "<span onclick='update_status(".$departments->id.",0)' id='span_".$departments->id."'  class='label label-success' style='cursor:pointer'>Active </span>";}
					else{ 
						$str = "<span onclick='update_status(".$departments->id.",1)' id='span_".$departments->id."'  class='label label-danger' style='cursor:pointer'> Inactive </span>";
					}
			$row[] = $str;			
					$str2 = '<div class="btn-group" title="View Account">
										<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
											Action <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-light pull-right">';

											if($this->permissions('employee_department_edit'))
											$str2.='<li>
												<a title="Edit Record ?" href="update/'.$departments->id.'">
													<i class="fa fa-fw fa-edit text-blue"></i>Edit
												</a>
											</li>';

											if($this->permissions('items_category_delete'))
											$str2.='<li>
												<a style="cursor:pointer" title="Delete Record ?" onclick="delete_department('.$departments->id.')">
													<i class="fa fa-fw fa-trash text-red"></i>Delete
												</a>
											</li>
											
										</ul>
									</div>';			

			$row[] = $str2;
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->departments->count_all(),
						"recordsFiltered" => $this->departments->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function update_status(){
		$this->permission_check_with_msg('employee_department_edit');
		$id=$this->input->post('id');
		$status=$this->input->post('status');

		$this->load->model('departments');
		$result=$this->departments->update_status($id,$status);
		return $result;
	}
	
	public function delete_department(){
		$this->permission_check_with_msg('items_category_delete');
		$id=$this->input->post('q_id');
		return $this->departments->delete_department_from_table($id);
	}
	public function multi_delete(){
		$this->permission_check_with_msg('items_category_delete');
		$ids=implode (",",$_POST['checkbox']);
		return $this->departments->delete_department_from_table($ids);
	}
}