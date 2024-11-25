<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manufacturing_model extends CI_Model {
	//Datatable start
	var $table = 'db_jobs as a';
	var $column_order = array( 'a.id','a.job_name', 'a.job_date', 'a.reference_no', 'a.note','b.job_id', 'b.unit_id', 'b.expense_id', 'b.item_id', 'b.qty', 'b.unit_cost', 'b.total_cost','c.unit_cost', 'c.total_cost', 'c.expense_total_cost', 'c.raw_mat_plus_exp', 'c.expense_description', 'c.status'); //set column field database for datatable orderable
	var $column_search = array( 'a.id','a.job_name', 'a.job_date', 'a.reference_no', 'a.note','b.job_id', 'b.unit_id', 'b.expense_id', 'b.item_id', 'b.qty', 'b.unit_cost', 'b.total_cost','c.unit_cost', 'c.total_cost', 'c.expense_total_cost', 'c.raw_mat_plus_exp', 'c.expense_description', 'c.status'); //set column field database for datatable searchable 
	var $order = array('a.id' => 'desc'); // default order 

    public function __construct()
	{
		parent::__construct();
	}

    private function _get_datatables_query()
	{
		 
		$this->db->from($this->table);
		$this->db->where("job_status ='processing'");
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
    private function _get_datatables_query2()
	{

		
		$this->db->from($this->table);
		$this->db->where("job_status ='finished'");
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
    function get_datatables_finished_jobs()
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

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	//Datatable end

    public function verify_jobs_and_save(){
        //creating bookibg code
$letters = '';
$numbers = ''; 
foreach (range('A', 'Z') as $char) {
    $letters .= $char;
}
for($i = 0; $i < 10; $i++){
    $numbers .= $i;
}
$reference_no = substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 3);
        //Filtering XSS and html escape from user inputs 
        extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST))));

        $state = (!empty($state)) ? $state : 'NULL';
        $query=$this->db->query("select * from db_jobs where upper(job_name)=upper('$job_name')");
		if($query->num_rows()>0){
			return "This Job Name already Exist.";
			
		}else{
        $query1="insert into db_jobs(job_name, job_date, reference_no, note, created_by, created_date, created_time, system_ip, system_name, status)
                values('$job_name','$job_date','$reference_no','$description','$CUR_USERNAME','$CUR_DATE','$CUR_TIME','$SYSTEM_IP','$SYSTEM_NAME','1')";

        if ($this->db->simple_query($query1)){
                $this->session->set_flashdata('success', 'Success!! New Task Added Successfully!');
                return "success";
        }
        else{
                return "failed";
        }
    }

    }
	public function xss_html_filter($input){
		return $this->security->xss_clean(html_escape($input));
	}
	// save activity
	public function verify_save_and_update(){
		//Filtering XSS and html escape from user inputs 
		extract($this->xss_html_filter(array_merge($this->data,$_POST,$_GET)));
		//echo "<pre>";print_r($this->xss_html_filter(array_merge($this->data,$_POST,$_GET)));exit();
		
		$this->db->trans_begin();
		$activity_time=date('Y-m-d',strtotime($activity_date));

		if($other_charges_input=='' || $other_charges_input==0){$other_charges_input=null;}
	    // if($other_charges_tax_id=='' || $other_charges_tax_id==0){$other_charges_tax_id=null;}
	    if($other_charges_amt=='' || $other_charges_amt==0){$other_charges_amt=null;}
	    // if($discount_to_all_input=='' || $discount_to_all_input==0){$discount_to_all_input=null;}
	    // if($tot_discount_to_all_amt=='' || $tot_discount_to_all_amt==0){$tot_discount_to_all_amt=null;}
	    // if($tot_round_off_amt=='' || $tot_round_off_amt==0){$tot_round_off_amt=null;}

	    if($command=='save'){//Create purchase code unique if first time entry
		    $qs5="select job_init from db_company";
			$q5=$this->db->query($qs5);
			$item_init=$q5->row()->job_init;

			$this->db->query("ALTER TABLE db_jobfinisfedgoods AUTO_INCREMENT = 1");
			$q4=$this->db->query("select coalesce(max(id),0)+1 as maxid from db_jobs");
			$maxid=$q4->row()->maxid;
			$activity_code=$item_init.str_pad($maxid, 4, '0', STR_PAD_LEFT);

		    $activity_entry = array(
		    				'actitvty_code' 			=> $activity_code, 
		    				'reference_no' 				=> $reference_no, 
							'job_id'					=>$job_id,
							'fin_item_id'				=>$fin_item_id,
							'qty'						=>$total_quantity, 
							'activity_status'			=>'precessing', 
							'total_cost'				=>$input_items_total,
							'expense_total_cost'		=>$other_charges_amt,
							'raw_mat_plus_exp'			=>$total_input_mat_plus_exp,
							'expense_description'		=>$description,
							'status' 					=> 1,
							'created_date'				=>$activity_date, 
							'created_time'				=>$activity_time
		    				
		    				
		    			);
			
			$q1 = $this->db->insert('db_jobfinisfedgoods', $activity_entry);
			$activity_id = $this->db->insert_id();
			if($activity_id){
			$this->db->query("INSERT INTO `db_expense`(expense_code, category_id, expense_date, expense_for, expense_amt,payment_type,created_by, created_date, created_time, system_ip, system_name, status) 
			VALUES ('$reference_no','$category_id','$activity_time','$description','$other_charges_amt','$payment_type','$CUR_USERNAME','$CUR_DATE','$CUR_TIME','$SYSTEM_IP','$SYSTEM_NAME','1')");
			
		}
	
	}
		else if($command=='update'){	
			$activity_entry = array(
								'actitvty_code' 			=> $activity_code, 
								'reference_no' 				=> $reference_no, 
								'job_id'					=>$job_id,
								'qty'						=>$total_quantity, 
								'activity_status'			=>'precessing', 
								'total_cost'				=>$total_cost,
								'expense_total_cost'		=>$input_total,
								'raw_mat_plus_exp'			=>$raw_mat_plus_exp,
								'expense_description'		=>$description
		    			);
					
			$q1 = $this->db->where('id',$activity_id)->update('db_jobfinisfedgoods', $activity_entry);

			$q11=$this->db->query("delete from db_purchaseitems where purchase_id='$activity_id'");
			if(!$q11){
				return "failed";
			}
		}
		//end

		//Import post data from form
		for($i=1;$i<=$rowcount;$i++){
		
			if(isset($_REQUEST['tr_item_id_'.$i]) && !empty($_REQUEST['tr_item_id_'.$i])){
 
				$item_id 			=$this->xss_html_filter(trim($_REQUEST['tr_item_id_'.$i]));
				$sales_qty		=$this->xss_html_filter(trim($_REQUEST['td_data_'.$i.'_3']));
				$sales_unit_id		=$this->xss_html_filter(trim($_REQUEST['sales_unit_id_'.$i.'_16']));
				$price_per_unit 	=$this->xss_html_filter(trim($_REQUEST['td_data_'.$i.'_4']));
				$unit_total_cost	=$this->xss_html_filter(trim($_REQUEST['td_data_'.$i.'_10']));
				$total_cost			=$this->xss_html_filter(trim($_REQUEST['td_data_'.$i.'_9']));
                $unit_discount_per  =(empty($unit_discount_per)) ? 0 : $unit_discount_per;
                
				if($unit_total_cost=='' || $unit_total_cost==0){$unit_total_cost=null;}
				if($total_cost=='' || $total_cost==0){$total_cost=null;}
				
				$q0=$this->db->query("select * from db_units where id=".$sales_unit_id);
				$q20=$this->db->query("select stock from db_items where id=".$item_id);
				$stock=$q20->row()->stock;
				$operator=$q0->row()->operator;
				$unit_id = $q0->row()->id;
				$new_stock = $stock - $sales_qty;
				$activityitems_entry = array(
					'actitvty_code' 			=> $activity_code, 
					'reference_no' 				=> $reference_no, 
					'job_id'					=>$job_id,
					'unit_id'					=>$sales_unit_id,
					'finished_goods_id '		=>$activity_id,
					'item_id'					=>$item_id,
					'unit_qty'					=>$sales_qty, 
					'unit_cost'					=>$price_per_unit,
					'total_cost '				=>$total_cost,
					'status' 					=> 1
		    			);

				$q2 = $this->db->insert('db_jobrawmaterials', $activityitems_entry);
				
				//UPDATE itemS QUANTITY IN itemS TABLE
			$this->db->where('id',$item_id)->update('db_items',array(
					'stock' => $new_stock
				));
				
				
			// $this->db->where('id',$item_id)->update('db_stockentry',array(
			// 		'qty' => $new_stock
			// 	));

				
			}
		
		}//for end

		

		$this->db->trans_commit();
		$this->session->set_flashdata('success', 'Success!! Record Saved Successfully!');
		return "success<<<###>>>$activity_id";
		
	}//verify_save_and_update() function end


    	//Get job_details
	public function get_details($id,$data){
		//Validate This job already exist or not
		$query=$this->db->query("select * from db_jobs where upper(id)=upper('$id')");
		if($query->num_rows()==0){
			show_404();exit;
		}
		else{
			$query=$query->row();
			$data['q_id']=$query->id;
			$data['job_name']=$query->job_name;			
			$data['job_date ']=show_date($query->job_date );
			$data['reference_no']=$query->reference_no;
			$data['note']=$query->note;
			return $data;
		}
	} 

    public function update_manufacturing(){
		//Filtering XSS and html escape from user inputs 
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST))));
		
		$query1="update db_jobs set job_name='$job_name',job_date='".date("Y-m-d")."',note='$description' where id=$q_id";
		if ($this->db->simple_query($query1)){
				$this->session->set_flashdata('success', 'Success!! Record Updated Successfully!');
		        return "success";
		}
		else{
		        return "failed";
		}
		
	}
    public function update_items(){
		//Filtering XSS and html escape from user inputs 
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST))));
		$q20=$this->db->query("select stock from db_items where id=".$fin_item_id);
		$stock=$q20->row()->stock;
		$new_stock = $stock + $total_qty;

		if($new_stock){
		$query2="UPDATE db_jobfinisfedgoods set `activity_status`='$activity_status' where id=$db_jobfinisfedgoods_id";
		$query1="UPDATE db_items set stock='$new_stock' where id=$fin_item_id";
		$query3="UPDATE db_jobs set job_status='$activity_status' where id=$q_id";
		
		$date_ent = date('Y-m-d');
		$q2000 = "INSERT INTO `db_stockentry`(`entry_date`, `item_id`, `qty`, `status`)
		VALUES ('$date_ent','$fin_item_id','$new_stock',1)";
		
		}else{
			return "failed";
		}
		if ($this->db->simple_query($query1) && $this->db->simple_query($query2) && $this->db->simple_query($query3) && $this->db->simple_query($q2000)){
				$this->session->set_flashdata('success', 'Success!! Record Updated Successfully!');
		        return "success";
		}
		else{
		        return "failed";
		}
		
	}
	public function update_status($id,$status){
		
        $query1="update db_expense set status='$status' where id=$id";
        if ($this->db->simple_query($query1)){
            echo "success";
        }
        else{
            echo "failed";
        }
	}
	public function delete_job($job_id){
        $this->db->trans_begin();
		// $jobs_id = $this->db->query("select job_id from db_purchasepayments where id=$job_id")->row()->job_id;

		$q1=$this->db->query("delete from db_jobrawmaterials where job_id='$job_id'");
		$q2=$this->db->query("delete from db_jobfinisfedgoods where job_id='$job_id'");
		$q3=$this->db->query("delete from db_jobs where id='$job_id'");
	
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
	public function delete_job_from_table($ids){
        $q1=$this->db->query("delete from db_jobrawmaterials where job_id='$ids'");
		$q2=$this->db->query("delete from db_jobfinisfedgoods where job_id='$ids'");
		$q3=$this->db->query("delete from db_jobs where id='$ids'");
        if ($this->db->simple_query($q1) && $this->db->simple_query($q2) && $this->db->simple_query($q3)){
            echo "success";
        }
        else{
            echo "failed";
        }
	}


	public function get_items_info($rowcount,$item_id){
		$q1=$this->db->select('*')->from('db_items')->where("id=$item_id")->get();
		$q3=$this->db->query("select * from db_tax where id=".$q1->row()->tax_id)->row();
		$q4=$this->db->query("select * from db_units where id=".$q1->row()->sales_unit_id)->row();
		

		$info['item_id'] = $q1->row()->id;
		$info['item_name'] = $q1->row()->item_name;
		// if($q4->operator == '/'){
		// 	$info['item_available_qty'] = ($q1->row()->stock * $q4->operator_value). ' ' .$q4->short_name;
		// 	$info['item_price'] = $q1->row()->price / $q4->operator_value;
		// 	$info['item_purchase_price'] = $q1->row()->price / $q4->operator_value;
		// 	$info['item_measurmemt_unit'] = $q4->short_name;
		// }else{
		// 	$info['item_available_qty'] = ($q1->row()->stock / $q4->operator_value);
		// 	$info['item_price'] = $q1->row()->price * $q4->operator_value;
		// 	$info['item_purchase_price'] = $q1->row()->price * $q4->operator_value;
		// 	$info['item_measurmemt_unit'] = $q4->short_name;
		// }
		$info['item_available_qty'] = $q1->row()->stock;
		$info['item_price'] = $q1->row()->price;
		$info['item_purchase_price'] = $q1->row()->price;
		$info['item_tax_id'] = $q1->row()->tax_id;
		$info['sales_unit_id'] = $q1->row()->sales_unit_id;
		$info['item_profit_margin'] = $q1->row()->profit_margin;
		$info['item_sales_price'] = $q1->row()->sales_price; 
		$info['item_purchase_qty'] = 1;
		$info['item_tax'] = $q3->tax;
		$info['item_tax_name'] = $q3->tax_name;
		$info['item_tax_type'] = $q1->row()->tax_type;
		$info['item_discount'] = '';
		$info['item_tax_amt'] = ($q1->row()->tax_type=='Inclusive') ? calculate_inclusive($q1->row()->sales_price,$q3->tax) :calculate_exclusive($q1->row()->sales_price,$q3->tax);
		$this->return_row_with_data($rowcount,$info);
	}
	/* For Purchase Items List Retrieve*/
	public function return_purchase_list($purchase_id){
		$q1=$this->db->select('*')->from('db_purchaseitems')->where("purchase_id=$purchase_id")->get();
		$rowcount =1;
		foreach ($q1->result() as $res1) {
			$q2=$this->db->query("select item_name,stock,tax_type,price from db_items where id=".$res1->item_id);
			$q3=$this->db->query("select * from db_tax where id=".$res1->tax_id)->row();
			$q4=$this->db->query("select * from db_units where id=".$q1->row()->sales_unit_id)->row();

			$info['item_id'] = $res1->item_id;
			$info['item_name'] = $q2->row()->item_name;
			if($q4->operator == '/'){
				$info['item_available_qty'] = ($q1->row()->stock * $q4->operator_value). ' ' .$q4->short_name;
				$info['item_price'] = $q1->row()->price / $q4->operator_value;
				$info['item_purchase_price'] = $q1->row()->price / $q4->operator_value;
				$info['item_measurmemt_unit'] = $q4->short_name;
			}else{
				$info['item_available_qty'] = ($q1->row()->stock / $q4->operator_value);
				$info['item_price'] = $q1->row()->price * $q4->operator_value;
				$info['item_purchase_price'] = $q1->row()->price * $q4->operator_value;
				$info['item_measurmemt_unit'] = $q4->short_name;
			}
		// $info['item_available_qty'] = $q1->row()->stock;
			// $info['item_price'] = $q2->row()->price;
			// $info['item_purchase_price'] = $res1->price_per_unit;
			$info['item_tax_id'] = $res1->tax_id;
			$info['item_profit_margin'] = $res1->profit_margin_per;
			$info['item_sales_price'] = $res1->unit_sales_price;
			$info['item_purchase_qty'] = $res1->purchase_qty;
			$info['item_tax'] = $q3->tax;
			$info['item_tax_name'] = $q3->tax_name;
			$info['item_tax_type'] = $res1->tax_type;
			$info['item_discount'] = $res1->unit_discount_per;
			$info['item_tax_amt'] = $res1->tax_amt;

			$result = $this->return_row_with_data($rowcount++,$info);
		}
		return $result;
	}

	public function return_row_with_data($rowcount,$info){
		extract($info);
		$item_unit_cost = $item_purchase_price+$item_tax_amt;
		$item_amount = $item_unit_cost * $item_purchase_qty;
		?>
             <tr id="row_<?=$rowcount;?>" data-row='<?=$rowcount;?>'>
             <td id="td_<?=$rowcount;?>_1">
                  <label class='form-control' style='height:auto;' data-toggle="tooltip" title='Edit ?' >
                  <a id="td_data_<?=$rowcount;?>_1" href="javascript:void()" onclick="show_sales_item_modal(<?=$rowcount;?>)" title=""><?=$item_name;?></a> 
                  		<i onclick="show_sales_item_modal(<?=$rowcount;?>)" class="fa fa-edit pointer"></i>
                  	</label>
               </td>
               <!-- Qty -->
               <td id="td_<?=$rowcount;?>_3">
                  <div class="input-group ">
                     <span class="input-group-btn">
                     <button onclick="decrement_qty(<?=$rowcount;?>)" type="button" class="btn btn-default btn-flat"><i class="fa fa-minus text-danger"></i></button></span>
                     <input typ="text" value="<?=$item_purchase_qty;?>" class="form-control no-padding text-center" onkeyup="calculate_tax(<?=$rowcount;?>)" id="td_data_<?=$rowcount;?>_3" name="td_data_<?=$rowcount;?>_3">
                     <span class="input-group-btn">
                     <button onclick="increment_qty(<?=$rowcount;?>)" type="button" class="btn btn-default btn-flat"><i class="fa fa-plus text-success"></i></button></span>
                  </div>
               </td>
			   <!-- avalaivle stock in kg -->
			   <td>
               <input type="text" class="form-control no-padding text-center" id="tr_available_qty_<?=$rowcount;?>_13" value="<?=$item_available_qty;?>">
               <input type="hidden" class="form-control no-padding text-center" id="sales_unit_id_<?=$rowcount;?>_16" name="sales_unit_id_<?=$rowcount;?>_16" value="<?=$sales_unit_id;?>">
			   </td>
               <!-- Purchase Price -->
               <td id="td_<?=$rowcount;?>_4"><input type="text" name="td_data_<?=$rowcount;?>_4" id="td_data_<?=$rowcount;?>_4" class="form-control text-right no-padding only_currency text-center" onkeyup="calculate_tax(<?=$rowcount;?>)" value="<?=$item_purchase_price;?>" ></td>

               <!-- TAX -->
               
			   <input type="hidden" id="td_<?=$rowcount;?>_15">
               <!-- Tax Amount -->
               <<input type="hidden" name="td_data_<?=$rowcount;?>_5" id="td_data_<?=$rowcount;?>_5" class="form-control text-right no-padding only_currency text-center" readonly  value="<?=$item_tax_amt;?>">

               <!-- Discount -->
              
                 
               <!-- Unit Cost -->
              <input type="hidden" name="td_data_<?=$rowcount;?>_10" id="td_data_<?=$rowcount;?>_10" class="form-control text-right no-padding only_currency text-center" readonly value="<?=$item_unit_cost;?>">
			   <input type="hidden" name="td_data_<?=$rowcount;?>_8" id="td_data_<?=$rowcount;?>_8" class="form-control text-right no-padding only_currency text-center item_discount" value="<?=$item_discount;?>" onkeyup="calculate_tax(<?=$rowcount;?>)">
              

			

               <!-- Amount -->
               <td id="td_<?=$rowcount;?>_9"><input type="text" name="td_data_<?=$rowcount;?>_9" id="td_data_<?=$rowcount;?>_9" class="form-control text-right no-padding only_currency text-center" style='border-color: #f39c12;' title='Total' readonly value="<?=$item_amount;?>"></td>

             
               <!-- ADD button -->
               <td id="td_<?=$rowcount;?>_16" style="text-align: center;">
                  <a class=" fa fa-fw fa-minus-square text-red" style="cursor: pointer;font-size: 34px;" onclick="removerow(<?=$rowcount;?>)" title="Delete ?" name="td_data_<?=$rowcount;?>_16" id="td_data_<?=$rowcount;?>_16"></a>
               </td>
			   
               <input type="hidden" id="tr_item_id_<?=$rowcount;?>" name="tr_item_id_<?=$rowcount;?>" value="<?=$item_id;?>">

               <input type="hidden" id="tr_tax_type_<?=$rowcount;?>" name="tr_tax_type_<?=$rowcount;?>" value="<?=$item_tax_type;?>">
               <input type="hidden" id="tr_tax_id_<?=$rowcount;?>" name="tr_tax_id_<?=$rowcount;?>" value="<?=$item_tax_id;?>">
               <input type="hidden" id="tr_tax_value_<?=$rowcount;?>" name="tr_tax_value_<?=$rowcount;?>" value="<?=$item_tax;?>">
               
            </tr>
		<?php

	}
}