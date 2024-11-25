<!DOCTYPE html>
<html>

<head>
<!-- TABLES CSS CODE -->
<?php include"comman/code_css_form.php"; ?>
<!-- </copy> -->  


<style>
.box-hidden{
  /* display:none; */
}

</style>
</head>
 
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

 <?php include"sidebar.php"; ?>
 <?php
	if(!isset($unit_name)){
    $unit_name=$short_name= $base_unit =$operator =$unit_id= $sales_status= $operator_value="";
	}
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $this->lang->line('unit'); ?>
        <small>Add/Update Unit</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $base_url; ?>units"><?= $this->lang->line('view_units'); ?></a></li>
        <li class="active"><?= $this->lang->line('unit'); ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- ********** ALERT MESSAGE START******* -->
        <?php include"comman/code_flashdata.php"; ?>
        <!-- ********** ALERT MESSAGE END******* -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info ">
            
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="units-form" onkeypress="return event.keyCode != 13;">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
              <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
              <div class="box-body">


              <div class="form-group">
         <div class="col-sm-2"></div>
         <div class="col-sm-8">
			      <label for="unit_name" class="control-label"><?= $this->lang->line('unit_name'); ?><label class="text-danger">*</label></label>
           
             <input type="text" class="form-control input-sm" id="unit_name" name="unit_name" placeholder="" onkeyup="shift_cursor(event,'description')" value="<?php print $unit_name; ?>" autofocus >
				      <span id="unit_name_msg" style="display:none" class="text-danger"></span>
            </div>
      </div>


				<div class="form-group">
               <div class="col-sm-2"></div>
            <div class="col-sm-8">
                  <label for="short name" class="control-label"><?= $this->lang->line('short_name'); ?><label class="text-danger">*</label></label>
                  
                    <input type="text" class="form-control" id="short_name" name="short_name" placeholder="" value="<?php print $short_name; ?>" >
					<span id="short_name_msg" style="display:none" class="text-danger"></span>
                  </div>
                </div>
                <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
			            <label for="unit_name" class="control-label"><?= $this->lang->line('base_unit'); ?><label class="text-danger">*</label></label>
                     <select class="form-control select2" id="base_unit" name="base_unit" value="<?php print $base_unit; ?>"   style="width: 100%;" >
                  <?php
                      $query1="select * from db_units where status=1";
                      $q1=$this->db->query($query1);
                      if($q1->num_rows($q1)>0)
                      { 
                        echo '<option value="">-Select-</option>'; 
                          foreach($q1->result() as $res1)
                        {
                          $selected = ($base_unit==$res1->id)? 'selected' : '';
                          echo "<option $selected value='".$res1->id."'>".$res1->unit_name."</option>";
                        }
                      }
                      else 
                      {
                          ?>
                  <option value="">No Records Found</option>
                  <?php
                      }
                      ?>
                </select>
                 
                </div>
              </div>
              <div class="showForm">
              <div class="form-group">
              <div class="col-sm-2"></div>
              <div class="col-sm-8" >
              <label for="unit_name" class="control-label"><?= $this->lang->line('operator'); ?><label class="text-danger">*</label></label>

              <select class="form-control  select2" id="operator" name="operator"  style="width: 100%;" onkeyup="shift_cursor(event,'operator')"value="<?php print $operator; ?>" >
                        <?php 
                              $received_select = ($operator=='*') ? 'selected' : ''; 
                              $pending_select = ($operator=='/') ? 'selected' : '';
                        ?>
                         <option <?= $received_select; ?> value="">-Select -</option>
                          <option <?= $received_select; ?> value="*">Multiple(*)</option>
                          <option <?= $pending_select; ?> value="/">Devide(/)</option>
                      </select>
                  <span id="unit_name_msg" style="display:none" class="text-danger"></span>
              </div>
              </div>
              
              <div class="form-group">
              <div class="col-sm-2"></div>
              <div class="col-sm-8">
              <label for="operator_value" class="control-label"><?= $this->lang->line('operator_value'); ?><label class="text-danger">*</label></label>
             
              <input type="text" class="form-control " id="operator_value" name="operator_value" placeholder="" value="<?php print $operator_value; ?>">
				    	<span id="operator_value_msg" style="display:none" class="text-danger"></span>
              </div>
              </div>
              </div>
            </div>

            </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                   <!-- <div class="col-sm-4"></div> -->
                   <?php
                      if($unit_name!=""){
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
                      <div class="row col-sm-12">          
                   <div class="col-md-6">
                      <button type="button" style="padding: 6px 12px;font-size: 17px;color:#fff;" id="<?php echo $btn_id;?>" class=" btn btn-block btn-success" title="Save Data"><?php echo $btn_name;?></button>
                   </div>
                   <div class="col-sm-6">
                    <a href="<?=base_url('units');?>">
                      <button type="button"style="padding: 6px 12px;font-size: 17px;background:red;color:#fff;" class="btn btn-block btn-warning close_btn" title="Go Dashboard">Close</button>
                    </a>
                   </div>
                   </div> 
                </div>
             </div>
              
             <!-- /.box-footer -->
            </form>
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

<script src="<?php echo $theme_link; ?>js/units.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("input[type='checkbox']").click(function(){
    var inputValue = $(this).attr("value");
    $("." + inputValue).toggle();
    alert(inputValue)
  });
});

</script>
<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
</body>
</html>
