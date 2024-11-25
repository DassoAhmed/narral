<!DOCTYPE html>
<html>

<head>
<!-- FORM CSS CODE -->
<?php include"comman/code_css_form.php"; ?>
<!-- </copy> -->  
</head> 


<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
 
 
 <?php include"sidebar.php"; ?> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- **********************MODALS***************** -->
    <?php include"modals/modal_booking.php"; ?>
    <!-- **********************MODALS END***************** -->
    <!-- Content Header (Page header) -->
    <?php
	if(!isset($department_name)){
      $category_code=$department_name=$description="";
	}
 ?> 
    <section class="content-header">
         <h1>
            <?=$page_title;?>
            <small>Add/Update Category</small>
         </h1>
         <ol class="breadcrumb">
            <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo $base_url; ?>employees/departments"><?= $this->lang->line('add_department'); ?></a></li>
            <li><a href="<?php echo $base_url; ?>employees/add_department">Ceate Department</a></li>
            <li class="active"><?=$page_title;?></li>
         </ol>
      </section>
      <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-10">
            <!-- general form elements -->
            <div class="card card-primary"> 
              <div class="card-header">
                <h4 class="card-title">Please Enter Valid Data</h4>
              </div>
              <div class="box box-info "style="padding: 27px; border-radius:24px;margin-top: 30px;">
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" id="jobs-form" onkeypress="return event.keyCode != 13;">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
              <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
              <div class="box-body" stylt="width: 68%;margin-left: 161px;">
				


              <div class="modal-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="customer_name">Job Name*</label>
                                <stax_number id="job_name_msg" class="text-danger text-right pull-right"></stax_number>
                                <input type="text" class="form-control" id="job_name" name="job_name" placeholder="" >
                              </div>
                            </div>
                          </div>
                      
                          <div class="col-sm-6">
                          <div class="box-body">
                                 <label for="booked_date" class="control-label"><?= $this->lang->line('activity_date'); ?> <label class="text-danger">*</label></label>
                                 <div class="input-group date">
                                       <div class="input-group-addon"> 
                                          <i class="fa fa-calendar"></i>
                                       </div>
                                       <input type="text" class="form-control pull-right datepicker"  id="activity_date" name="activity_date" readonly onkeyup="shift_cursor(event,'booking_status')" value="<?= $booked_date;?>">
                                    </div>
                                    <span id="booked_date_msg" style="display:none" class="text-danger"></span>
                                 </div>
                              </div>
                          <div class="col-md-12">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="address">Note</label>
                                <stax_number id="address_msg" class="text-danger text-right pull-right"></stax_number>
                                <textarea type="text" class="form-control" id="description" name="description" placeholder="" ></textarea>
                              </div>
                            </div>
                          </div>

                        </div>

              </div>
              <!-- /.box-footer -->
              <div class="box-footer">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                   <!-- <div class="col-sm-4"></div> -->
                   <?php
                      if($category_code!=""){
                           $btn_name="Update";
                           $btn_id="update";
                          ?>
                            <input type="hidden" name="q_id" id="q_id" value="<?php echo $q_id;?>"/>
                            <?php
                      }
                                else{
                                    $btn_name="Save";
                                    $btn_id="save";
                                }
                      
                                ?>
                                 
                   <div class="col-md-5">
                      <button style="padding: 12px 12px;font-size: 17px;color:#fff;"  type="button" id="<?php echo $btn_id;?>" class=" btn btn-block btn-success" title="Save Data"><?php echo $btn_name;?></button>
                   </div>
                   <div class="col-sm-5">
                    <a href="<?=base_url('dashboard');?>">
                      <button style="padding: 12px 12px;font-size: 17px;background:red;color:#fff;"  type="button" class=" btn btn-block close_btn" title="Go Dashboard">Close</button>
                    </a>
                   </div>
                </div>
             </div>
             <!-- /.box-footer -->
            </form>
            </div>
            <!-- /.card -->

        
      
            </div>
          <!-- /.box -->

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
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
<?php include"comman/code_js_form.php"; ?>

<script src="<?php echo $theme_link; ?>js/jobs.js"></script>
<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
</body>
</html>