<?php

/**
 * Author: Askarali Makanadar
 * Date: 05-11-2018
 */
class Dashboard_model extends CI_Model
{ 
	
	function __construct()
	{ 
		parent::__construct(); 
	}

	public function breadboard_values() 
	{
		///Find total suppliers
		$query1="select coalesce(count(*),0) as tot_sup from db_suppliers where status=1";
		$tot_sup=$this->db->query($query1)->row()->tot_sup;	

		///Find total Products
		$query2="select coalesce(count(*),0) as tot_pro from db_items where status=1";
		$tot_pro=$this->db->query($query2)->row()->tot_pro;	

		//Total Customers
		$query3="select coalesce(count(*),0) as tot_cust from db_customers where status=1 and id<>1";
		$tot_cust=$this->db->query($query3)->row()->tot_cust;	

  		//Total Purchases Active
  		$query4="SELECT COALESCE(COUNT(*),0) AS tot_pur FROM db_purchase where purchase_status='Received'";
		$tot_pur=$this->db->query($query4)->row()->tot_pur;	

  		//Total SAles Active
  		$query5="SELECT COALESCE(COUNT(*),0) AS tot_sal FROM db_sales where `sales_status`= 'Final'";
		$tot_sal=$this->db->query($query5)->row()->tot_sal;

		//Total Sales amount
		$query6="SELECT COALESCE(sum(grand_total),0) AS tot_sal_grand_total FROM db_sales where `sales_status`= 'Final'";
		$tot_sal_grand_total=$this->db->query($query6)->row()->tot_sal_grand_total;

		//Total expense amount
  		$query7="SELECT COALESCE(sum(expense_amt),0) AS tot_exp FROM db_expense ";
		$tot_exp=$this->db->query($query7)->row()->tot_exp;

		//Total Sales Due
		$query8="SELECT (COALESCE(sum(sales_due),0)-COALESCE(sum(sales_return_due),0)) as sales_due FROM db_customers where `status`= 1";
		$sales_due=$this->db->query($query8)->row()->sales_due;

		//Total Purchase  Due
		$query9="SELECT (COALESCE(sum(grand_total),0)-COALESCE(sum(paid_amount),0)) as purchase_due FROM db_purchase where purchase_status='Received'";
		$purchase_due=$this->db->query($query9)->row()->purchase_due;
		// Total Purchase
		$query10="SELECT COALESCE(sum(grand_total),0) as total_purchase FROM db_purchase where purchase_status='Received'";
		$total_purchase=$this->db->query($query10)->row()->total_purchase;
		// Total Booking Order
		$query11="SELECT COALESCE(sum(grand_total),0) as total_order FROM db_booking_orders where order_status='Received'";
		$total_order=$this->db->query($query11)->row()->total_order;
		//Total Order  Due
		$query12="SELECT (COALESCE(sum(grand_total),0)-COALESCE(sum(paid_amount),0)) as order_due FROM db_booking_orders where order_status='Received'";
		$order_due=$this->db->query($query12)->row()->order_due;
		//Total Booking amount
		$query13="SELECT COALESCE(sum(grand_total),0) AS tot_bking_grand_total FROM db_booking where `booking_status`= 'Final'";
		$tot_bking_grand_total=$this->db->query($query13)->row()->tot_bking_grand_total;
		//Total booking amount
		$query14="SELECT (COALESCE(sum(grand_total),0)-COALESCE(sum(paid_amount),0)) as booking_due FROM db_booking where `booking_status`= 'Final'";
		$booking_due=$this->db->query($query14)->row()->booking_due;

		//Total Active Items
		$query15="SELECT COALESCE(count(*),0) AS tot_items FROM db_items where `status`= 1";
		$tot_items=$this->db->query($query15)->row()->tot_items;
		//Total Active Items
		$query16="SELECT COALESCE(sum(qty_booked),0) AS qty_booked FROM db_booking where `status`= 1";
		$qty_booked=$this->db->query($query16)->row()->qty_booked;


		$q14=$this->db->query("SELECT COALESCE(SUM(tot_discount_to_all_amt),0) AS tot_discount_to_all_amt FROM db_sales where sales_status='Final'");
        $sales_discount_amt=$q14->row()->tot_discount_to_all_amt;
		  // other booking charges
		  $qg=$this->db->query("SELECT COALESCE(SUM(other_charges_amt),0) AS other_charges_amt FROM db_booking");
		  $booking_other_charges_amt=$qg->row()->other_charges_amt;
		 // total booking amt
		 $qg=$this->db->query("SELECT COALESCE(SUM(subtotal),0) AS grand_total FROM db_booking");
		 $booking_grand_total=$qg->row()->grand_total;

		 $qor2=$this->db->query("SELECT COALESCE(SUM(other_charges_amt),0) AS other_charges_amt FROM db_booking_orders");
        $booking_order_other_charges_amt=$qor2->row()->other_charges_amt;

		  // discount_to_all_input
		  $qdb=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_payments FROM db_bookingpayments");
		  $total_payments=$qdb->row()->total_payments;

		  $qor3=$this->db->query("SELECT COALESCE(SUM(payment),0) AS total_payments FROM db_booking_orderpayments");
        $total_booking_order_payments=$qor3->row()->total_payments;

		$qor2=$this->db->query("SELECT COALESCE(SUM(other_charges_amt),0) AS other_charges_amt FROM db_booking_orders");
        $booking_order_other_charges_amt=$qor2->row()->other_charges_amt;

		// total discount amt
        $qds=$this->db->query("SELECT COALESCE(SUM(tot_discount_to_all_amt),0) AS tot_discount_to_all_amt FROM db_booking_orders");
        $booking_order_discount_to_all_amt=$qds->row()->tot_discount_to_all_amt;

		$q3=$this->db->query("SELECT COALESCE(SUM(expense_amt),0) AS exp_total FROM db_expense");
      $exp_total=$q3->row()->exp_total;

		   // booking due
		   $grand_booking_total = $booking_grand_total + $booking_other_charges_amt;
		   $booking_due = $grand_booking_total - $total_payments;

		    // booking profit
			$booking_profit = ($grand_booking_total + $booking_order_other_charges_amt)-($total_booking_order_payments + $booking_order_discount_to_all_amt);

			$q1=$this->db->query("
			SELECT b.tax_amt,b.item_id,a.item_name,COALESCE(sum(b.sales_qty),0) as sales_qty,a.purchase_price,
			  COALESCE(SUM(c.tot_discount_to_all_amt),0) as tot_discount_amt,
				COALESCE(SUM(total_cost),0) as total_cost
			FROM db_items as a, db_salesitems as b, db_sales as c
			WHERE 
			c.id=b.sales_id
			and 
			a.id=b.item_id 
			and
			c.sales_status='Final'
			
			GROUP BY item_id
		  ");
		
		if($q1->num_rows()>0){
		  $i=0;
		  $tot_purchase_price=0;
		  $tot_sales_cost=0;
		  $gross_profit=0;
		  $tot_purchase_return_price=0;
		  $tot_sales_return_price=0;
		  $tot_sales_qty=0;
		  $tot_purchase_return_qty=0;
		  $tot_sales_return_qty=0;
		  $grand_profit=0;
		  $tot_net_profit=0;
		  foreach ($q1->result() as $res1) {
			/*Purchase Return Quantity*/
			$purchase_return_qty=$this->db->query("
				SELECT COALESCE(sum(return_qty),0) as return_qty
				FROM db_purchaseitemsreturn
				WHERE 
				item_id =".$res1->item_id)->row()->return_qty;
	
			/*Sales Return Quantity*/
			$q3=$this->db->query("
				SELECT COALESCE(sum(total_cost),0) as total_cost,COALESCE(sum(return_qty),0) as return_qty
				FROM db_salesitemsreturn
				WHERE 
				item_id =".$res1->item_id);
			$sales_return_total_cost=$q3->row()->total_cost;
			$sales_return_qty=$q3->row()->return_qty;
			
			$qty = $res1->sales_qty-$sales_return_qty;
			$purchase_price = $res1->purchase_price * $qty;
	
			$total_cost = ($res1->total_cost - $sales_return_total_cost);
			//$purchase_return_price = $res1->purchase_price*$purchase_return_qty;
			$profit = $total_cost - $purchase_price;
	
			// $tax_amt = $res1->tax_amt/$res1->sales_qty;
	
			  //$net_profit =$profit-($tax_amt*$qty);
			  $net_profit =$profit;//Correct way updated 
	
			$gross_profit+=$profit;
			$tot_net_profit+=$net_profit;
		  }       
		  $gross_profit -= $sales_discount_amt;
		  $tot_net_profit -= $sales_discount_amt;
		}
		else{
		  $gross_profit=0;
		  $tot_net_profit=0;
		}
		$tot_net_profit -=$exp_total;//Correct way updated
	
		$net_profit= $booking_profit + $tot_net_profit;

		$data['tot_sup']=$tot_sup;
		$data['tot_pro']=$tot_pro; 
		$data['tot_cust']=$tot_cust;
		$data['tot_pur']=$tot_pur;
		$data['tot_sal']=$tot_sal;
		$data['tot_sal_grand_total']=$tot_sal_grand_total;
		$data['tot_exp']=$tot_exp;
		$data['sales_due']=$sales_due;
		$data['purchase_due']=$purchase_due;
		$data['total_purchase']=$total_purchase;
		$data['total_order']=$total_order;
		$data['order_due']=$order_due;
		$data['tot_bking_grand_total']=$tot_bking_grand_total;
		$data['booking_due']=$booking_due;
		$data['tot_items']=$tot_items;
		$data['qty_booked']=$qty_booked;
		$data['net_profit']=$net_profit;

		return $data;
	}
}