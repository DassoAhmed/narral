<div id="expense_modal" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <form class="form-horizontal" id="expense-form">
                                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                    <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Expense to Activity</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">

                                    <div class="row ">
                                      <div class="col-sm-5">
                                        <lable for="expense_type">Expense Type</lable>
                                      </div>
                                      <div class="col-sm-6">
                                        <select class="form-control " id="category_id" name="category_id">
                                        <?php
                                        $query1="select * from db_expense_category where status=1";
                                        $q1=$this->db->query($query1);
                                        if($q1->num_rows($q1)>0)
                                        {  echo '<option value="">-Select-</option>'; 
                                            foreach($q1->result() as $res1)
                                        { 
                                            $selected = ($category_id==$res1->id)? 'selected' : '';
                                            echo "<option $selected value='".$res1->id."'>".$res1->category_name."</option>";
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

                                    <div class="row ">
                                      <div class="col-sm-5">
                                        <label for="amount">Amount</label>
                                      </div>
                                      <div class="col-sm-6">
                                        <input type="number" required="" class="form-control" name="amount" id="amount" value="">
                                      </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                      <div class="col-sm-5">
                                        <label for="payment_method">Payment Method</label>
                                      </div>
                                      <div class="col-sm-6">
                                          <select class="form-control" name="payment_method" id="payment_method">
                                          <?php
                                            $q1=$this->db->query("select * from db_paymenttypes where status=1");
                                                if($q1->num_rows()>0){
                                                echo "<option value=''>-Select-</option>";
                                                    foreach($q1->result() as $res1){
                                                    echo "<option value='".$res1->payment_type."'>".$res1->payment_type ."</option>";
                                                }
                                                }
                                                else{
                                                echo "<option>None</option>";
                                                }
                                            ?>
                                             
                                            </select>
                                      </div>
                                    </div>
                                    <br>
                                    <div class="row ">
                                      <div class="col-sm-5">
                                        <label for="description">Description</label>
                                      </div>
                                      <div class="col-sm-6">
                                        <input type="text" class="form-control" name="description" id="description" placeholder="paid $ amount for ...">
                                      </div>
                                    </div>
                                   
                                    </div>
                                    <?php
                                    if($q_id!=""){
                                    $btn_name="Save Activity";
                                    $btn_id="save_activity";
                                    ?>
                                    <input type="hidden" name="q_id" id="q_id" value="<?php echo $q_id;?>"/>
                                    <?php
                                    }
                                     ?>
                                    <div class="modal-footer">
                                        <button type="button"  class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success waves-effect waves-light" id="<?php echo $btn_id;?>"><?php echo $btn_name;?></button>
                                    </div>
                                  </form>
                                  </div>
                                </div>
                              </div>