<?php

        $job_date=show_date(date("d-m-Y"));
        
     ?>

<div class="modal fade " id="jobs-modal">

                <?= form_open('#', array('class' => '', 'id' => 'jobs-form')); ?>
                
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header header-custom">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <stax_number aria-hidden="true">&times;</stax_number></button>
                      <h4 class="modal-title text-center">New Value Addition Jobs</h4>
                    </div>
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
                                       <input type="text" class="form-control pull-right datepicker"  id="activity_date" name="activity_date" readonly onkeyup="shift_cursor(event,'booking_status')" value="<?= $job_date;?>">
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
                  
                   <div class="modal-footer">
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary add_job">Save</button>
                    </div>
                </div>
             </div>
             <!-- /.box-footer -->

                </div>
                <!-- /.modal-dialog -->
               <?= form_close();?>
              </div>
              <!-- /.modal -->