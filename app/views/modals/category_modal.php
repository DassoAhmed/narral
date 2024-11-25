
<div class="modal fade " id="categories-modal">

                <?= form_open('#', array('class' => '', 'id' => 'category-form')); ?>
                
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header header-custom">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <stax_number aria-hidden="true">&times;</stax_number></button>
                      <h4 class="modal-title text-center">New Category</h4>
                    </div>
                    <div class="modal-body">
              
              <div class="box-body"stylt="width: 68%;margin-left: 161px;">
              <div class="form-group">
			      <label for="category" class="col-sm-3 control-label"><?= $this->lang->line('category_name'); ?><label class="text-danger">*</label></label>
           <div class="col-sm-7">
             <input type="text" class="form-control input-sm" id="category" name="category" placeholder="" onkeyup="shift_cursor(event,'description')" value="<?php print $category_name; ?>" autofocus >
				      <span id="category_msg" style="display:none" class="text-danger"></span>
            </div>
     
<br><br>

				<div class="form-group">
                  <label for="description" class="col-sm-3 control-label"><?= $this->lang->line('description'); ?></label>
                  <div class="col-sm-7">
                    <textarea type="text" class="form-control" id="description" name="description" placeholder=""><?php print $description; ?></textarea>
					<span id="description_msg" style="display:none" class="text-danger"></span>
                  </div>
                </div>

              </div>
                 
                       
                    </div>
                  
                   <div class="modal-footer">
                 
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary add_category" title="Save Data">Save</button>
                    </div>
                </div>
             </div>
             <!-- /.box-footer -->

                </div>
                <!-- /.modal-dialog -->
               <?= form_close();?>
              </div>
              <!-- /.modal -->