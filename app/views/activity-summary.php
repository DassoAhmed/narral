<!DOCTYPE html>
<html>

<head>
<!-- TABLES CSS CODE -->
<?php include"comman/code_css_datatable.php"; ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Left side column. contains the logo and sidebar -->
  
  <?php include"sidebar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <?php

if(!isset($q_id)){
$total_qty=$actitvty_code=$description='';
} 
else{
    $q2 = $this->db->query("SELECT * from db_jobfinisfedgoods where job_id=$q_id");
    $total_qty=$q2->row()->qty;
    $actitvty_code=$q2->row()->actitvty_code;
    $fin_item_id=$q2->row()->fin_item_id;
    $db_jobfinisfedgoods_id=$q2->row()->id;
    $created_date=$q2->row()->created_date;
    $activity_status=$q2->row()->activity_status;
    $q9 = $this->db->query("SELECT item_name from db_items where id=".$q2->row()->fin_item_id);
    $item_name=$q9->row()->item_name;
}
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $this->lang->line('activity'); ?>
        <small>View/Search Job Activity</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= $this->lang->line('manufacturing_list'); ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <?= form_open('#', array('class' => '', 'id' => 'jobs-update-form')); ?>
    <input type="hidden" id='base_url' value="<?=$base_url;?>">
    <section class="content">
      <div class="row">
        <!-- ********** ALERT MESSAGE START******* -->
          <?php include"comman/code_flashdata.php"; ?>
          <?php include"modals/jobs_modal.php"; ?>
            <!-- ********** ALERT MESSAGE END******* -->

<div class="row">
<?php 
 if(isset($q_id)){
    
    $CI =& get_instance();
    $q1=$this->db->query("select * from db_company where id=1 and status=1");
    $res1=$q1->row();
    $company_name=$res1->company_name;
    $company_mobile=$res1->mobile;
    $company_phone=$res1->phone;
    $company_email=$res1->email;
    $company_country=$res1->country;
    $company_state=$res1->state;
    $company_city=$res1->city;
    $company_address=$res1->address;
    $company_gst_no=$res1->gst_no;
    $company_vat_no=$res1->vat_no;
    $company_pan_no=$res1->pan_no;
 }
 $logo=$this->db->query("select logo from db_sitesettings")->row()->logo;
 
 ?>
<div class="col-md-3">

<div class="box box-primary">
<div class="box-body box-profile">
<img class="profile-user-img img-responsive img-circle" src="<?php echo $base_url; ?>uploads/<?= $logo;?>" alt="User profile picture">
<h3 class="profile-username text-center"> <strong><?php echo  $company_name; ?></strong><br> </h3>
<ul class="list-group list-group-unbordered">
<li class="list-group-item">
<b style="color:magenta"><?= $this->lang->line('address'); ?>:</b> <a class="pull-right"> <?php echo  $company_address; ?></a>
</li>
<li class="list-group-item">
<b style="color:magenta"><?= $this->lang->line('city'); ?>:</b> <a class="pull-right"><?php echo  $company_city; ?></a>
</li>
<li class="list-group-item">
<b style="color:magenta"><?= $this->lang->line('phone'); ?>:</b> <a class="pull-right"><?php echo  $company_phone; ?></a>
</li>
<li class="list-group-item">
<b style="color:magenta"> <?= $this->lang->line('mobile'); ?>:</b> <a class="pull-right"><?php echo  $company_mobile; ?></a>
</li>
<li class="list-group-item">
<b style="color:magenta"> <?= $this->lang->line('email'); ?>:</b> <a class="pull-right"><?php echo (!empty(trim($company_email))) ? $this->lang->line('email').": ".$company_email."<br>" : '';?></a>
</li>
</ul>
<!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
</div>

</div>

</div>
 



<div class="col-md-9">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Activity</a></li>
<li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Details</a></li>
</ul>
<!-- <form class="form-horizontal" id="jobs-update-form"> -->
<div class="tab-content">
<div class="tab-pane active" id="activity">
<?php
if(isset($q_id)){


 $q2=$this->db->query("SELECT c.item_name, b.job_id,
 b.reference_no,b.unit_qty, b.unit_cost, b.total_cost
 FROM 
 db_jobrawmaterials AS b,db_items AS c
 WHERE 
 c.id=b.item_id  AND b.job_id='$q_id'");


}


?>
<?php
$q3=$this->db->query("SELECT * from db_jobfinisfedgoods where job_id='$q_id' ");
$res3=$q3->row();

?>

    <div class="post">
        <div class="row margin-bottom">
            <div class="col-sm-6">
                <div class="row">
                    <div class="tab-content">
                        <div class="tab-pane p-20 active" id="summary" role="tabpanel" aria-expanded="true">
                       
                        <ul class="timeline timeline-inverse">
                        <li>
                        <i class="fa fa-user bg-orange"></i>
                        <div class="timeline-item">
                        <h3 class="timeline-header no-border" ><a href="#"style="color:magenta"><?php echo  $item_name?> Activity </a>
                        </h3>
                        </div>
                        </li>
                        <li>
                        <i class="fa fa-user bg-aqua"></i>
                        <div class="timeline-item">
                        <h3 class="timeline-header no-border"><a href="#">Total input Items Cost : </a>  <?php echo  $res3->total_cost; ?>
                        </h3>
                        </div>
                        </li>
                        <li>
                        <i class="fa fa-user bg-aqua"></i>
                        <div class="timeline-item">
                        <h3 class="timeline-header no-border"><a href="#">Total Expense Cost : </a><?php echo  $res3->expense_total_cost; ?>
                        </h3>
                        </div>
                        </li>
                        <li>
                        <i class="fa fa-user bg-aqua"></i>
                        <div class="timeline-item">
                        <h3 class="timeline-header no-border"><a href="#">Total input Cost Inc Exp : </a><?php echo  $res3->raw_mat_plus_exp; ?>
                        </h3>
                        </div>
                        </li>
                        <li>
                        <i class="fa fa-user bg-aqua"></i>
                        <div class="timeline-item">
                        <div class="row col-sm-12">
                            <div class="col-sm-5">
                        <h3 class="timeline-header no-border" style="font-size:18px"><a href="#">Total Qty : </h3> 
                        </div>
                            <div class="col-sm-7" style="line-height:18px;margin-top:10px">
                            <input type="text" name="total_qty" id="total_qty" class="form-control" readonly value="<?php echo  $total_qty; ?>">
                            <input type="hidden" name="actitvty_code" id="actitvty_code" class="form-control" readonly value="<?php echo  $actitvty_code; ?>">
                            <input type="hidden" name="fin_item_id" id="fin_item_id" class="form-control" readonly value="<?php echo  $fin_item_id; ?>">
                            <input type="hidden" name="db_jobfinisfedgoods_id" id="db_jobfinisfedgoods_id" class="form-control" readonly value="<?php echo  $db_jobfinisfedgoods_id; ?>">
                            <input type="hidden" name="activity_status" id="activity_status" class="form-control" readonly value="finished">
                            </div>
                        </div>
                        </h3>
                        </div>
                        </li>
                        <li>
                        <i class="fa fa-user bg-aqua"></i>
                        <div class="timeline-item">
                            
                        <h3 class="timeline-header no-border"><a href="#">Job Status : </a><?php echo  $res3->activity_status; ?> 
                        </h3>
                        </div>
                        </li>
                        </ul>
                      
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab-pane" id="timeline">

<ul class="timeline timeline-inverse">

<li class="time-label">
<span class="bg-red">
<?php echo $created_date; ?>
</span>
</li>


<li>
<i class="fa fa-envelope bg-blue"></i>
<div class="timeline-item">
<h3 class="timeline-header"><a href="#">Raw Material (Input Items)</a></h3>
<div class="timeline-body">
<table class="table table-hover">
<thead >
<tr style="border:1px solid black">
    <th rowspan='2'>#</th>
    <th rowspan='2'><?= $this->lang->line('item_name'); ?></th>
    <th rowspan='2'><?= $this->lang->line('reference_no'); ?></th>
    <th rowspan='2'><?= $this->lang->line('quantity'); ?></th>
    <th rowspan='2'><?= $this->lang->line('unit_cost'); ?></th>
    <th rowspan='2'><?= $this->lang->line('total_amount'); ?></th>
  </tr>
</thead>
<?php
$i=0;
$tot_qty=0;
$tot_sales_price=0;
$tot_tax_amt=0;
$tot_discount_amt=0;
$tot_unit_total_cost=0;
$tot_total_cost=0;
 foreach ($q2->result() as $res2) {
    echo "<tr>";  
    echo "<td style='border-right: 1px solid;border-top: 1px solid;'>".++$i."</td>";
    echo "<td style='border-right: 1px solid;border-top: 1px solid;'>".$res2->item_name."</td>";
    echo "<td style='border-right: 1px solid;border-top: 1px solid;'>".$res2->reference_no."</td>";
    echo "<td style='border-right: 1px solid;border-top: 1px solid;'>".$res2->unit_qty."</td>";
    echo "<td style='text-align: right;border-right: 1px solid;border-top: 1px solid;'>".$res2->unit_cost ."</td>";
    echo "<td style='text-align: right;border-right: 1px solid;border-top: 1px solid;'>".$res2->total_cost."</td>";
    echo "</tr>";  
    
}

?>
</table>
</div>

</div>
 </li>
<?php
$q4=$this->db->query("SELECT * from db_jobfinisfedgoods where job_id='$q_id'");
$res4=$q3->row();
// foreach ($res4 as $list) {
       
?>
 <li>
 <i class="fa fa-user bg-aqua"></i>
 <div class="timeline-item">
     <div class="row col-sm-12">
     <div class="col-sm-3">
 <h3 class="timeline-header no-border" style="font-size:18px"><a href="#">Raw Material Total cost: </a> 
 </div>
     <div class="col-sm-5" style="line-height:18px;margin-top:10px">
     <input type="text" class="form-control" readonly value="<?php echo  $res4->total_cost; ?>">
     </div>
 </div>
 </h3>
 </div>
 </li>


  <?php
    // }
?>


<li>
<i class="fa fa-user bg-aqua"></i>
<div class="timeline-item">
    <div class="row col-sm-12">
    <div class="col-sm-3">
<h3 class="timeline-header no-border" style="font-size:18px"><a href="#">Expense Total cost: </a> 
</div>
    <div class="col-sm-5" style="line-height:18px;margin-top:10px">
    <input type="text" class="form-control" readonly value="<?php echo  $res4->expense_total_cost; ?>">
    </div>
</div>
</h3>
</div>
</li>
<li>
<div class="timeline-item">
<div class="timeline-footer">


<center>
                                <?php
                                if(isset($q_id)){
                                  $btn_id='update';
                                  $btn_name="Update";
                                  echo '<input type="hidden" name="q_id" id="q_id" value="'.$q_id.'"/>';
                                }
                                else{
                                  $btn_id='save';
                                  $btn_name="Save";
                                }

                                ?>
                                 <div class="col-md-3 col-md-offset-3">
                                    <button type="button" id="<?php echo $btn_id;?>" class="btn bg-maroon btn-block btn-flat  payments_modal btn-xs" title="Save Data"><?php echo $btn_name;?></button>
                                 </div>
                                 <div class="col-sm-3"><a href="<?= base_url()?>dashboard">
                                    <button type="button" class="btn bg-gray btn-block btn-flat btn-xs" title="Go Dashboard">Close</button>
                                  </a>
                                </div>
                              </center>
</div>
</div>
</li>
</ul>
</div>


<!-- </form> -->
</div>

</div>

</div>

</div>





      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <?= form_close();?>
  </div>
  <!-- /.content-wrapper -->
  <?php include"footer.php"; ?>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- SOUND CODE -->
<?php include"comman/code_js_sound.php"; ?>
<!-- TABLES CODE -->
<?php include"comman/code_js_datatable.php"; ?>



<script src="<?php echo $theme_link; ?>js/jobs-summary.js"></script>
<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
		
</body>
</html>
