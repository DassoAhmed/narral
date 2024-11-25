<div class="add_postion_modal">
   <div class="modal fade in" id="add_employee_position">
      <div class="modal-dialog ">
         <div class="modal-content">
            <div class="modal-header header-custom">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span></button>
               <h4 class="modal-title text-center">Add Employee Working Role</h4>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                           <b>Employee Role : </b> <span id='popup_item_name'><span>
                        </div>
                        <!-- /.col -->
                     </div>
                     <!-- /.row -->
                  </div>
                  <div class="col-md-12">
                     <div>
                     <?= form_open('#', array('class' => '', 'id' => 'position-form')); ?>
                        <div class="col-md-12 ">
                           <div class="box box-solid bg-gray">
                              <div class="box-body">
                                 <div class="row">
                                    
                                    <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="position" class=" control-label"><?= $this->lang->line('position'); ?></label>
                                    
                                        <input type="text" class="form-control" id="position" name="position" placeholder="My Position here...">
                            <span id="email_msg" style="display:none" class="text-danger"></span>
                                
                                    </div>
                                   
                                    </div>

                                    <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="salary" class="control-label"><?= $this->lang->line('salary'); ?></label>
                                    
                                        <input type="text" class="form-control" id="salary" name="salary" placeholder="$0.00">
                            <span id="salary_msg" style="display:none" class="text-danger"></span>
                                
                                    </div>
                                   
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="popup_tax_type">Description</label>
                                         <textarea type="text" class="form-control" id="popup_description" placeholder=""></textarea>
                                        </div>
                                   
                                    </div>

                                    <!-- <div class="col-md-6">
                                       <div class="">
                                          <label for="popup_tax_amt">Tax Amount</label>
                                          <input type="text" class="form-control text-right paid_amt" id="popup_tax_amt" name="popup_tax_amt" readonly>
                                          <span id="popup_tax_amt_msg"  style="display:none" class="text-danger"></span>
                                       </div>
                                    </div> -->

                                    <div class="clearfix"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- col-md-12 -->
                     </div>
                  </div>
                  <!-- col-md-9 -->
                  <!-- RIGHT HAND -->
               </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" id="popup_row_id">
               <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
               <button type="button" class="btn bg-green btn-lg place_order btn-lg">Submit<i class="fa  fa-check "></i></button>
            </div>
         </div>
         <?= form_close();?>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
</div>
