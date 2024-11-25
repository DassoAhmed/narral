<?php

class Categories extends MY_Controller{

    public function __construct(){
        parent::__construct();
		$this->load_global();
		$this->load->model('categories_model','categories');
    }

    public function add(){
        $this->permission_check('add_category');
		$data=$this->data;
		$data['page_title']=$this->lang->line('new_category');
		$this->load->view('categories',$data);
    }
}


?>