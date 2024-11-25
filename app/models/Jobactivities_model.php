 
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobactivities_model extends CI_Model {
	//Datatable start 
	var $table = 'db_jobactivities as a';
	var $column_order = array('a.id', 'a.position', 'a.salary', 'a.status'); //set column field database for datatable orderable
	var $column_search = array('a.id', 'a.position', 'a.salary', 'a.status'); //set column field database for datatable searchable 
	var $order = array('a.id' => 'desc'); // default order 
public function __construct()
	{
		parent::__construct(); 
	}
 

	

}