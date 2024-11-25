<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('booking_model','booking');
	} 
    
	public function index()       
	{
		$this->permission_check('booking_view');
		$data=$this->data;
		$data['page_title']=$this->lang->line('booking_list');
		$this->load->view('booking-view',$data); 
	}  
	public function add()   
	{
		$this->permission_check('booking_add');
		$data=$this->data;
		$data['page_title']=$this->lang->line('booking');
		$this->load->view('booking',$data);
	}
	public function unfiltered_booking_list() 
	{
		$this->permission_check('booking_view');
		$data=$this->data;
		$data['page_title']=$this->lang->line('full_bookiing_list');
		$this->load->view('unfiltered_booking_list',$data);
	}
	// new supply list
	public function new_supply() 
	{
		$this->permission_check('booking_view');
		$data=$this->data;
		$data['page_title']=$this->lang->line('new_supply');
		$this->load->view('new-supply',$data);
	}
	// supply list grouped by deilery date
	public function supply_list() 
	{
		$this->permission_check('booking_view');
		$data=$this->data;
		$data['page_title']=$this->lang->line('supply_list');
		$this->load->view('supply-list',$data);
	}

	

	public function sales_save_and_update(){
		$this->form_validation->set_rules('booked_date', 'Booking Date', 'trim|required');
		$this->form_validation->set_rules('customer_id', 'Customer Name', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {
	    	$result = $this->booking->verify_save_and_update();
	    	echo $result;
		} else {
			echo "Please Fill Compulsory(* marked) Fields.";
		}
	}
	
	
	public function update($id){
		$this->permission_check('booking_edit');
		$data=$this->data;
		$data=array_merge($data,array('sales_id'=>$id));
		$data['page_title']=$this->lang->line('booking');
		$this->load->view('booking', $data);
	}

	public function transaction_details($delivered_date)
	{	
		if(!$this->permissions('booking_view')){
			$this->show_access_denied_page();
		}
		$data=$this->data;
		$data=array_merge($data,array('delivered_date'=>$delivered_date));
		$data['page_title']=$this->lang->line('customer_profile');
		$this->load->view('transaction_details',$data);
	}
	public function edit($id){
		$this->permission_check('sales_edit');
	    $data=$this->data;
	    $data['sales_id']=$id;
	    $data['page_title']='Supply List Update';
	    // $data['result'] = $this->get_hold_invoice_list();
		// $data['tot_count'] = $this->get_hold_invoice_count();
		$this->load->view('new-supply',$data);
	}
	public function fetch_sales($id){
	    $result=$this->booking->edit_pos($id);
	}
// display filtered booking list
	public function ajax_list() 
	{
		$list = $this->booking->get_datatables();
		
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $booking) {
			
			$no++;
			$row = array();
			$row[] = '<input type="checkbox" name="checkbox[]" value='.$booking->id.' class="checkbox column_checkbox" >';
			$row[] = $booking->item_name;
			$row[] = $booking->booked_date;
			$row[] = $booking->delivery_date;

			$info = (!empty($booking->return_bit)) ? "\n<span class='label label-danger' style='cursor:pointer'><i class='fa fa-fw fa-undo'></i>Return Raised</span>" : '';
			$row[] = $booking->reference_no;

			// $row[] = $booking->delivery_status.$info;
			$row[] = $booking->customer_name;
			$row[] = $booking->mobile;
			$row[] = app_number_format($booking->qty_booked);
			$row[] = app_number_format($booking->grand_total);
			$row[] = app_number_format($booking->paid_amount);
			$row[] = app_number_format($booking->sales_due);
					$str='';
					if($booking->payment_status=='Unpaid')
			          $str= "<span class='label label-danger' style='cursor:pointer'>Unpaid </span>";
			        if($booking->payment_status=='Partial')
			          $str="<span class='label label-warning' style='cursor:pointer'> Partial </span>";
			        if($booking->payment_status=='Paid')
			          $str="<span class='label label-success' style='cursor:pointer'><i class='fa fa-check'></i> Complete </span>";

			$row[] = $str;
			$row[] = ucfirst($booking->created_by);

					 if($booking->pos ==1):
					 	$str1='pos/edit/';
					 else:
					 	$str1='update/';
					 endif;

					$str2 = '<div class="btn-group" title="View Account">
										<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
											Action <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-light pull-right">';
											if($this->permissions('booking_view'))
											$str2.='<li>
												<a title="View Invoice" href="booking/invoice/'.$booking->id.'" >
													<i class="fa fa-fw fa-eye text-blue"></i>View bookings
												</a>
											</li>';
											if($this->permissions('customers_view'))
											$str2.='<li>
												<a title="View Profile" href="booking/customer_profile/'.$booking->reference_no.'" >
													<i class="fa fa-fw fa-eye text-blue"></i>customer Profile
												</a>
											</li>';
											
											if($this->permissions('booking_edit'))
											$str2.='<li> 
												<a title="Update Record ?" href="booking/'.$str1.$booking->id.'">
													<i class="fa fa-fw fa-edit text-blue"></i>Edit
												</a>
											</li>';

											if($this->permissions('booking_payment_view'))
											$str2.='<li>
												<a title="Pay" class="pointer" onclick="view_payments('.$booking->id.')" >
													<i class="fa fa-fw fa-money text-blue"></i>View Payments
												</a>
											</li>';

											if($this->permissions('booking_payment_add'))
											$str2.='<li>
												<a title="Pay" class="pointer" onclick="pay_now2('.$booking->id.')" >
													<i class="fa fa-fw fa-hourglass-half text-blue"></i>Pay Now
												</a>
											</li>';

											if($this->permissions('booking_view') || $this->permissions('booking_edit'))
											$str2.='<li>
												<a title="Update Record ?" target="_blank" href="booking/print_invoice/'.$booking->id.'">
													<i class="fa fa-fw fa-print text-blue"></i>Print
												</a>
											</li>

											<li>
												<a title="Update Record ?" target="_blank" href="booking/booking_list_pdf/'.$booking->id.'">
													<i class="fa fa-fw fa-file-pdf-o text-blue"></i>PDF
												</a>
											</li>';
											

											if($this->permissions('booking_delete'))
											$str2.='<li>
												<a style="cursor:pointer" title="Delete Record ?" onclick="delete_sales(\''.$booking->id.'\')">
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
						"recordsTotal" => $this->booking->count_all(),
						"recordsFiltered" => $this->booking->count_filtered(),
						"data" => $data
				);
		//output to json format
		echo json_encode($output);
	}
	
	// full booking list
	public function full_ajax_list()
	{
		$list = $this->booking->get_datatables2();
		
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $booking) {
			
			$no++;
			$row = array();
			$row[] = '<input type="checkbox" name="checkbox[]" value='.$booking->id.' class="checkbox column_checkbox" >';
			$row[] = show_date($booking->booked_date);

			$info = (!empty($booking->return_bit)) ? "\n<span class='label label-danger' style='cursor:pointer'><i class='fa fa-fw fa-undo'></i>Return Raised</span>" : '';
			$row[] = $booking->reference_no;

			$row[] = $booking->booking_code.$info;
			// $row[] = $booking->booking_status;
			$row[] = $booking->customer_name;
			$row[] = $booking->delivery_date;
			//$row[] = $booking->warehouse_name;
			$row[] = app_number_format($booking->qty_booked);
			$row[] = app_number_format($booking->grand_total);
			$row[] = app_number_format($booking->paid_amount);
			$row[] = app_number_format($booking->sales_due);
					$str='';
					if($booking->payment_status=='Unpaid')
			          $str= "<span class='label label-danger' style='cursor:pointer'>Unpaid </span>";
			        if($booking->payment_status=='Partial')
			          $str="<span class='label label-warning' style='cursor:pointer'> Partial </span>";
			        if($booking->payment_status=='Paid')
			          $str="<span class='label label-success' style='cursor:pointer'> Complete </span>";

			$row[] = $str;
			$row[] = ucfirst($booking->created_by);

					 if($booking->pos ==1):
					 	$str1='pos/edit/';
					 else:
					 	$str1='update/';
					 endif;

					 $str2 = '<div class="btn-group" title="View Account">
					 <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
						 Action <span class="caret"></span>
					 </a>
					 <ul role="menu" class="dropdown-menu dropdown-light pull-right">';
						 if($this->permissions('booking_view'))
						 $str2.='<li>
							 <a title="View Invoice" href="booking/invoice/'.$booking->id.'" >
								 <i class="fa fa-fw fa-eye text-blue"></i>View bookings
							 </a>
						 </li>';
						 if($this->permissions('profile_view'))
							$str2.='<li>
								<a title="View Profile" href="booking/customer_profile/'.$booking->reference_no.'" >
									<i class="fa fa-fw fa-eye text-blue"></i>customer Profile
								</a>
							</li>';
						 if($this->permissions('booking_edit'))
						 $str2.='<li>
							 <a title="Update Record ?" href="'.$str1.$booking->id.'">
								 <i class="fa fa-fw fa-shopping-cart  text-blue"></i>Deliver Birds
							 </a>
						 </li>';
						 if($this->permissions('booking_edit'))
						 $str2.='<li>
							 <a title="Update Record ?" href="'.$str1.$booking->id.'">
								 <i class="fa fa-fw fa-edit text-blue"></i>Edit
							 </a>
						 </li>';

						 if($this->permissions('booking_payment_view'))
						 $str2.='<li>
							 <a title="Pay" class="pointer" onclick="view_payments('.$booking->id.')" >
								 <i class="fa fa-fw fa-money text-blue"></i>View Payments
							 </a>
						 </li>';

						 if($this->permissions('booking_payment_add'))
						 $str2.='<li>
							 <a title="Pay" class="pointer" onclick="pay_now('.$booking->id.')" >
								 <i class="fa fa-fw fa-hourglass-half text-blue"></i>Pay Now
							 </a>
						 </li>';

						 if($this->permissions('booking_view') || $this->permissions('booking_edit'))
						 $str2.='<li>
							 <a title="Update Record ?" target="_blank" href="booking/print_invoice/'.$booking->id.'">
								 <i class="fa fa-fw fa-print text-blue"></i>Print
							 </a>
						 </li>

						 <li>
							 <a title="Update Record ?" target="_blank" href="booking/booking_list_pdf/'.$booking->id.'">
								 <i class="fa fa-fw fa-file-pdf-o text-blue"></i>PDF
							 </a>
						 </li>
						 <li>
							 <a style="cursor:pointer" title="Print POS Invoice ?" onclick="print_invoice('.$booking->id.')">
								 <i class="fa fa-fw fa-file-text text-blue"></i>POS Invoice
							 </a>
						 </li>';

						 

						 if($this->permissions('booking_delete'))
						 $str2.='<li>
							 <a style="cursor:pointer" title="Delete Record ?" onclick="delete_sales(\''.$booking->id.'\')">
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
						"recordsTotal" => $this->booking->count_all(),
						"recordsFiltered" => $this->booking->count_filtered2(),
						"data" => $data
				);
		//output to json format
		echo json_encode($output);
	}
	
// show new booking supply list info
public function new_ajax_booking_list() 
	{
		$list = $this->booking->get_datatables3();
		
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $booking) {
			
			$no++;
			$row = array();
			$row[] = '<input type="checkbox" name="checkbox[]" value='.$booking->id.' class="checkbox column_checkbox" >';
			$row[] = show_date($booking->booked_date);
			$row[] = show_date($booking->delivery_date);

			$info = (!empty($booking->return_bit)) ? "\n<span class='label label-danger' style='cursor:pointer'><i class='fa fa-fw fa-undo'></i>Return Raised</span>" : '';
			$row[] = $booking->reference_no;

			$row[] = $booking->delivery_status.$info;
			// $row[] = $booking->booking_status;
			$row[] = $booking->customer_name;
			//$row[] = $booking->warehouse_name;
			$row[] = app_number_format($booking->qty_booked);
			$row[] = app_number_format($booking->grand_total);
			$row[] = app_number_format($booking->paid_amount);
			$row[] = app_number_format($booking->sales_due);
					$str='';
					if($booking->payment_status=='Unpaid')
			          $str= "<span class='label label-danger' style='cursor:pointer'>Unpaid </span>";
			        if($booking->payment_status=='Partial')
			          $str="<span class='label label-warning' style='cursor:pointer'> Partial </span>";
			        if($booking->payment_status=='Paid')
			          $str="<span class='label label-success' style='cursor:pointer'> Paid </span>";

			$row[] = $str;
			$row[] = ucfirst($booking->created_by);

					 if($booking->pos ==1):
					 	$str1='pos/edit/';
					 else:
					 	$str1='update/';
					 endif;

					$str2 = '<div class="btn-group" title="View Account">
										<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
											Action <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-light pull-right">';
										
											
											if($this->permissions('booking_delete'))
											$str2.='<li>
												<a title="Deliver Record ?" onclick="deliver_booking(\''.$booking->id.'\')">
													<i class="fa fa-fw fa-shopping-cart  text-blue"></i>Deliver Birds
												</a>
											</li>';
												

											if($this->permissions('booking_payment_add'))
											$str2.='<li>
												<a title="Pay" class="pointer" onclick="pay_now('.$booking->id.')" >
													<i class="fa fa-fw fa-hourglass-half text-blue"></i>Pay Now
												</a>
											</li>';

																	

											if($this->permissions('booking_delete'))
											$str2.='<li>
												<a style="cursor:pointer" title="Delete Record ?" onclick="delete_sales(\''.$booking->id.'\')">
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
						"recordsTotal" => $this->booking->count_all(),
						"recordsFiltered" => $this->booking->count_filtered(),
						"data" => $data
				);
		//output to json format
		echo json_encode($output);
	}

	// show booking supply list info
public function new_ajax_supply_list() 
{
	$list = $this->booking->get_datatables4();
	
	$data = array();
	$no = $_POST['start'];
	foreach ($list as $booking) {
		
		$no++;
		$row = array();
		$row[] = '<input type="checkbox" name="checkbox[]" value='.$booking->id.' class="checkbox column_checkbox" >';
	
		$row[] = $booking->tran_code;
		$row[] = $booking->supplier_name;
		// $row[] = $booking->qty_taken;
		$row[] = show_date($booking->delivered_date);

		

				$str2 = '<div class="btn-group" title="View Account">
									<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
										Action <span class="caret"></span>
									</a>
									<ul role="menu" class="dropdown-menu dropdown-light pull-right">';
									if($this->permissions('booking_payment_add'))
											$str2.='<li>
												<a title="Pay" class="pointer" href="transaction_details/'.$booking->delivered_date.'" >
													<i class="fa fa-fw fa-hourglass-half text-blue"></i>View Dettail
												</a>
											</li>';
											if($this->permissions('booking_edit'))
											$str2.='<li>
												<a title="Update Record ?" href="edit/'.$str1.$booking->id.'">
													<i class="fa fa-fw fa-edit text-blue"></i>Edit
												</a>
											</li>';
										if($this->permissions('booking_delete'))
										// $str2.='<li>
										// 	<a style="cursor:pointer" title="Delete Record ?" onclick="delete_booking(\''.$booking->id.'\')">
										// 		<i class="fa fa-fw fa-trash text-red"></i>Delete
										// 	</a>
										// </li>
									'	</ul>
								</div>';			

		$row[] = $str2;

		$data[] = $row;
	}

	$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->booking->count_all(),
					"recordsFiltered" => $this->booking->count_filtered(),
					"data" => $data
			);
	//output to json format
	echo json_encode($output);
}


// transaction details 
public function new_ajax_transactions_lists() 
{
	$list = $this->booking->get_datatables5();
	
	$data = array();
	$no = $_POST['start'];
	foreach ($list as $booking) {
		
		$no++;
		$row = array();
		$row[] = '<input type="checkbox" name="checkbox[]" value='.$booking->delivered_date.' class="checkbox column_checkbox" >';
		$row[] = $booking->supplier_name;
		$row[] = $booking->item_name;
		$row[] = $booking->customer_name;
		$row[] = $booking->qty_taken;

		

				$str2 = '<div class="btn-group" title="View Account">
									
							
										
								</div>';			

		$row[] = $str2;

		$data[] = $row;
	}

	$output = array(
					"draw" => $_POST['draw'],
					// "recordsTotal" => $this->booking->count_all(),
					"recordsFiltered" => $this->booking->count_filtered(),
					"data" => $data
			);
	//output to json format
	echo json_encode($output);
}

	public function update_status(){
		$this->permission_check('booking_edit');
		$id=$this->input->post('id');
		$status=$this->input->post('status');
		$result=$this->booking->update_status($id,$status);
		return $result;
	}
	public function deliver_booking(){
		$this->permission_check_with_msg('booking_delete');
		$id=$this->input->post('q_id');
		echo $this->booking->deliver_booking($id);
	}
	public function delete_sales(){
		$this->permission_check_with_msg('booking_delete');
		$id=$this->input->post('q_id');
		echo $this->booking->delete_sales($id);
	}

	public function multi_delete(){
		$this->permission_check_with_msg('booking_delete');
		$ids=implode (",",$_POST['checkbox']);
		echo $this->booking->delete_sales($ids);
	}

	// get new booking item
	public function get_new_booking_item(){
		$this->permission_check_with_msg('booking_view');
		$result= $this->booking->get_new_booking_item("getNewBookingItem");
		echo $result;
	}
	

	
	//Table ajax code
	public function search_item(){
		$q=$this->input->get('q');
		$result=$this->booking->search_item($q);
		echo $result;
	}
	public function find_item_details(){
		$id=$this->input->post('id');
		
		$result=$this->booking->find_item_details($id);
		echo $result;
	}
	

	//sales invoice form
	public function invoice($id)
	{	
		if(!$this->permissions('booking_view') && !$this->permissions('booking_edit')){
			$this->show_access_denied_page();
		}
		$data=$this->data;
		$data=array_merge($data,array('sales_id'=>$id));
		$data['page_title']=$this->lang->line('booking_invoice');
		$this->load->view('booking-invoice',$data);
	} 
	public function due_invoice($id)
	{	
		if(!$this->permissions('booking_view') && !$this->permissions('booking_edit')){
			$this->show_access_denied_page();
		}
		$data=$this->data;
		$data=array_merge($data,array('sales_id'=>$id));
		$data['page_title']=$this->lang->line('booking_due_invoice');
		$this->load->view('booking-due-invoice',$data);
	}

	//sales invoice form
	public function customer_profile($reference_no)
	{	
		if(!$this->permissions('booking_view') && !$this->permissions('booking_edit')){
			$this->show_access_denied_page();
		}
		$data=$this->data;
		$data=array_merge($data,array('reference_no'=>$reference_no));
		$data['page_title']=$this->lang->line('customer_profile');
		$this->load->view('customer-profile',$data);
	}
  
	//Print sales invoice 
	public function print_invoice($sales_id)
	{
		if(!$this->permissions('booking_view') && !$this->permissions('booking_edit')){
			$this->show_access_denied_page();
		}
		$data=$this->data; 
		$data=array_merge($data,array('sales_id'=>$sales_id));
		$data['page_title']=$this->lang->line('boking_invoice');
		if(get_invoice_format_id()==3){
			$this->load->view('print_booking_invoice3',$data);
		}
		else if(get_invoice_format_id()==2){
			$this->load->view('print_booking_invoice2',$data);
		}
		else{
			$this->load->view('print_booking_invoice',$data);
		}
	}
// second receipt
	public function print_due_payment($sales_id)
	{
		if(!$this->permissions('booking_view') && !$this->permissions('booking_edit')){
			$this->show_access_denied_page();
		}
		$data=$this->data;
		$data=array_merge($data,array('sales_id'=>$sales_id));
		$data['page_title']=$this->lang->line('boking_invoice');
		if(get_invoice_format_id()==3){
			$this->load->view('print_booking_invoice3',$data);
		}
		else if(get_invoice_format_id()==2){
			$this->load->view('print_booking_invoice2',$data);
		}
		else{
			$this->load->view('print_due_payment_invoice',$data);
		}
	}

	//Print sales POS invoice 
	public function print_invoice_pos($sales_id)
	{
		if(!$this->permissions('booking_view') && !$this->permissions('booking_edit')){
			$this->show_access_denied_page();
		}
		$data=$this->data;
		$data=array_merge($data,array('sales_id'=>$sales_id));
		$data['page_title']=$this->lang->line('boking_invoice');
		$this->load->view('booking-invoice-pos',$data);
	}
	public function booking_list_pdf($sales_id){
		if(!$this->permissions('booking_view') && !$this->permissions('booking_edit')){
			$this->show_access_denied_page();
		} 
		
		$data=$this->data;
		$data['page_title']=$this->lang->line('boking_invoice');
        $data=array_merge($data,array('sales_id'=>$sales_id));
        if(get_invoice_format_id()==3){
			$this->load->view('print-booking-list-3',$data);
		}
		else if(get_invoice_format_id()==2){
			$this->load->view('print-booking-list-2',$data);
		}
		else{
			$this->load->view('print-booking-list',$data);
		}
       

        // Get output html
        // $html = $this->output->get_output();
        // Load pdf library 
        $this->load->library('pdf');
        $html =$this->load->view('booking-pdf',[],true);
        // Load HTML content
        // $this->dompdf->loadHtml($html);
         
        // (Optional) Setup the paper size and orientation
        // $this->dompdf->setPaper('A4', 'portrait');/*landscape or portrait*/
        
        // Render the HTML as PDF
        // $this->dompdf->render();
        
        // Output the generated PDF (1 = download and 0 = preview)
        // $this->dompdf->stream("Booking_invoice_$sales_id", array("Attachment"=>0));
	}
	public function pdf($delivered_date){
		if(!$this->permissions('booking_view') && !$this->permissions('booking_edit')){
			$this->show_access_denied_page();
		} 
		
		$data=$this->data;
		$data['page_title']=$this->lang->line('boking_invoice');
        $data=array_merge($data,array('delivered_date'=>$delivered_date));
        if(get_invoice_format_id()==3){
			$this->load->view('print-booking-invoice-3',$data);
		}
		else if(get_invoice_format_id()==2){
			$this->load->view('print-booking-invoice-2',$data);
		}
		else{
			$this->load->view('print-booking-invoice',$data);
		}
       

        // Get output html
        // $html = $this->output->get_output();
        // Load pdf library 
        $this->load->library('pdf');
        $html =$this->load->view('booking-pdf',[],true);
        // Load HTML content
        // $this->dompdf->loadHtml($html);
         
        // (Optional) Setup the paper size and orientation
        // $this->dompdf->setPaper('A4', 'portrait');/*landscape or portrait*/
        
        // Render the HTML as PDF
        // $this->dompdf->render();
        
        // Output the generated PDF (1 = download and 0 = preview)
        // $this->dompdf->stream("Booking_invoice_$sales_id", array("Attachment"=>0));
	}
	
	 

	
	/*v1.1*/
	public function return_row_with_data($rowcount,$item_id){
		echo $this->booking->get_items_info($rowcount,$item_id);
	}

	public function return_row_with_customer_data($customer_id){
		echo $this->booking->return_row_with_customer_info($customer_id);
	}


	public function return_sales_list($sales_id){
		echo $this->booking->return_sales_list($sales_id);
	}
	public function delete_payment(){
		$this->permission_check_with_msg('booking_delete');
		$payment_id = $this->input->post('payment_id');
		echo $this->booking->delete_payment($payment_id);
	}
	public function show_pay_now_modal(){
		$this->permission_check_with_msg('booking_view');
		$sales_id=$this->input->post('sales_id');
		echo $this->booking->show_pay_now_modal($sales_id);
	}

	public function show_pay_now_modal2(){
		$this->permission_check_with_msg('booking_view');
		$sales_id=$this->input->post('sales_id');
		echo $this->booking->show_pay_now_modal2($sales_id);
	}

	public function save_payment(){
		$this->permission_check_with_msg('booking_view');
		echo $this->booking->save_payment();
	}
	public function view_payments_modal(){
		$this->permission_check_with_msg('booking_view');
		$sales_id=$this->input->post('sales_id');
		echo $this->booking->view_payments_modal($sales_id);
	}



	// new supply list

	public function get_new_supply_list_details(){
		echo $this->booking->get_new_supply_list_details();
	}
	public function receive_order(){
	    echo $this->booking->receive_order();
	} 
	public function pos_save_update(){
	    $result='';
	    if($this->input->post('command')=='update'){//Update
	    	$result = $this->booking->pos_save_update();
	    }
	    else{//Save
	    	$result = $this->booking->pos_save_update();
		    $result =$result."<<<###>>>".$this->booking->get_new_supply_list_details();
		    $result =$result."<<<###>>>".$this->booking->hold_invoice_list();
		    $q1=$this->db->query("SELECT * FROM temp_holdinvoice WHERE STATUS=1 GROUP BY invoice_id");
			$data['tot_count']=$q1->num_rows();
		    $result =$result."<<<###>>>".$q1->num_rows();
	    }
	    
	    echo $result;exit();
	}
	public function get_json_items_details(){ 
		$data = array();
		$display_json = array();
		//if (!empty($_GET['name'])) {
			$name = strtolower(trim($_GET['name']));
			$sql =$this->db->query("SELECT id,a.reference_no,a.salesqty,b.item_code,b.b.item_name,a.qty_booked, b.custom_barcode FROM db_booking as a,db_items as b where  b.status=1 and  (LOWER(b.item_name) LIKE '%$name%' or LOWER(b.item_code) LIKE '%$name%' or LOWER(b.custom_barcode) LIKE '%$name%')   limit 10");
			
			foreach ($sql->result() as $res) {
			      $json_arr["id"] = $res->id;
				  $json_arr["value"] = $res->item_name;
				  $json_arr["label"] = $res->item_name;
				  $json_arr["item_code"] = $res->item_code;
				  $json_arr["sales_qty"] = $res->sales_qty;
				  array_push($display_json, $json_arr);
				 /* $display_json[] =$res->id;
				  $display_json[] =$res->item_name;
				  $display_json[] =$res->item_code;*/
			}
		//}
		//echo json_encode($data);exit;
		echo json_encode($display_json);exit;
	}
}
