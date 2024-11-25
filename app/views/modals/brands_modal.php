
<div class="modal fade " id="brands-modal">

                <?= form_open('#', array('class' => '', 'id' => 'brands-form')); ?>
                
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header header-custom">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <stax_number aria-hidden="true">&times;</stax_number></button>
                      <h4 class="modal-title text-center">New Brand</h4>
                    </div>
                    <div class="modal-body">
              
              <div class="box-body"stylt="width: 68%;margin-left: 161px;">

			<div class="form-group">
			      <label for="brand" class="col-sm-4 control-label"><?= $this->lang->line('brand_name'); ?><label class="text-danger">*</label></label>
           <div class="col-sm-6">
             <input type="text" class="form-control input-sm" id="brand" name="brand" placeholder="" autofocus >
				      <span id="brand_msg" style="display:none" class="text-danger"></span>
            </div>
      </div><br><br>


				<div class="form-group">
                  <label for="description" class="col-sm-4 control-label"><?= $this->lang->line('description'); ?></label>
                  <div class="col-sm-6">
                    <textarea type="text" class="form-control" id="description" name="description" placeholder=""></textarea>
					          <span id="description_msg" style="display:none" class="text-danger"></span>
                  </div>
                </div>

              </div>
                 
                       
                    </div>
                  
                   <div class="modal-footer">
                 
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary add_brand" title="Save Data">Save</button>
                    </div>
                </div>
             </div>
             <!-- /.box-footer -->

                </div>
                <!-- /.modal-dialog -->
               <?= form_close();?>
              </div>
              <!-- /.modal -->