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
    <?php include"modals/modal_sales_item.php"; ?>
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
              <form class="form-horizontal" id="department-form" onkeypress="return event.keyCode != 13;">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
              <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
              <div class="box-body" stylt="width: 68%;margin-left: 161px;">
				


			<div class="form-group">
			      <label for="department" class="col-sm-3 control-label"><?= $this->lang->line('departmant_name'); ?><label class="text-danger">*</label></label>
           <div class="col-sm-8">
             <input type="text" class="form-control input-sm" id="department" name="department" placeholder="" onkeyup="shift_cursor(event,'department')" value="<?php print $department_name; ?>" autofocus >
			<span id="department_msg" style="display:none" class="text-danger"></span>
            </div>
      </div>


				<div class="form-group">
                  <label for="description" class="col-sm-3 control-label"><?= $this->lang->line('description'); ?></label>
                  <div class="col-sm-8">
                    <textarea type="text" class="form-control" id="description" name="description" placeholder=""><?php print $description; ?></textarea>
					<span id="description_msg" style="display:none" class="text-danger"></span>
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

<script src="<?php echo $theme_link; ?>js/departments.js"></script>
<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
</body>
</html>