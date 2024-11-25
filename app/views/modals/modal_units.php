
<style>
   .showForm{
      /* display:none; */
   }
</style>
<?php
	if(!isset($unit_name)){
      $unit_name=$short_name= $base_unit =$operator = $operator_value="";
	}
 ?>
<div class="modal fade " id="units_modal"aria-modal="true" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h4 class="modal-title">Create Unit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
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
                  
                    <input type="text" class="form-control" id="short_name" name="short_name" placeholder=""><?php print $description; ?>
					<span id="short_name_msg" style="display:none" class="text-danger"></span>
                  </div>
                </div>
                <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
			            <label for="unit_name" class="control-label"><?= $this->lang->line('base_unit'); ?><label class="text-danger">*</label></label>
                     <select class="form-control select2" id="base_unit" name="base_unit"  style="width: 100%;" >
                  <?php
                      $query1="select * from db_units where status=1";
                      $q1=$this->db->query($query1);
                      if($q1->num_rows($q1)>0)
                      {
                        echo '<option value="">-Select-</option>'; 
                          foreach($q1->result() as $res1)
                        {
                          $selected = ($res1->id==$unit_id)? 'selected' : '';
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

              <select class="form-control  select2" id="operator" name="operator"  style="width: 100%;" onkeyup="shift_cursor(event,'operator')">
                        <?php 
                              $received_select = ($sales_status=='*') ? 'selected' : ''; 
                              $pending_select = ($sales_status=='/') ? 'selected' : '';
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
             
              <input type="text" class="form-control " id="operator_value" name="operator_value" placeholder=""><?php print $description; ?>
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
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 <script>
   $(document).ready(function(){
     $("#base_unit").on('change', function(){
      $(".showFor").hide();
      $("#"+$(this).val()).fadeIn()
     }).change();
    
   });
 </script>