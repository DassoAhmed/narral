<div class="modal fade" id="multiple-payments-modal">
  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header header-custom">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Payments</h4>
      </div>
      <div class="modal-body">
        
    <div class="row">
      <!-- LEFT HAND -->
      <div class="col-md-2">
        <div>

        <?php 
          $atleast_one_payments = 'true';
          if(isset($sales_id) && $sales_id!='') { //For Save Operation or for new entry

          $q22=$this->db->query("select payment,payment_type,payment_note from db_salespayments where sales_id='$sales_id'");
       if($q22->num_rows()>0){
        $atleast_one_payments = 'false';
        $i=0;
        foreach ($q22->result() as $res22) {
          $i++;
      ?>   
            <div class="col-md-12  payments_div">
            <div class="box box-solid bg-gray">
              <div class="box-body">
              
                
              <div class="clearfix"></div>
          </div>  
          <div class="row">
                
                  
              <div class="clearfix"></div>
          </div>   
          </div>
          </div>
        </div><!-- col-md-12 -->
        <?php } //foreach() ?>

         <input type="hidden" data-var='inside_forech' name="payment_row_count" id='payment_row_count' value="<?= $i;?>">
         
      <?php } //num_rows if() 
            else{
              $atleast_one_payments ='true';
            }
      ?>
         
    <?php 
     } 
     if($atleast_one_payments=='true'){ ?>
        <input type="hidden" data-var='inside_else' name="payment_row_count" id='payment_row_count' value="1">
        <div class="col-md-12  payments_div">
          
      </div><!-- col-md-12 -->
    <?php } ?>

    </div>
      


      <div class="row">
              <div class="col-md-12">
              <div class="col-md-12">
              <div class="col-md-12">
                <button type="button" class="btn btn-primary btn-block" id="add_payment_row">Add Payment Row</button>
              </div>
              </div>
            </div>
            </div>
      </div><!-- col-md-9 -->


      <!-- RIGHT HAND -->
      <div class="col-md-6">

        
        

        <div class="col-md-12">

          <div class="box box-solid bg-blue">
              <div class="box-body">
                <div class="row ">
                  <div class="col-md-12 border-custom-bottom">
                    <span class="col-md-6 text-right text-bold ">Total Chicks Selected:</span>
                    <span class="col-md-6 text-right text-bold  custom-font-size sales_div_tot_qty">0.00</span>
                  </div>
                </div>

                <!--  -->
                <div class="row ">
                  <div class="col-md-12 border-custom-bottom">
                    <span class="col-md-6 text-right text-bold ">Qty Pending:</span>
                    <span class="col-md-6 text-right text-bold  custom-font-size sales_div_tot_balance">0.00</span>
                  </div>
                </div>
              
                                      
              </div>
                    <!-- /.box-body -->
                  </div>
        </div>
      </div>
    </div>
        
      </div>
      <div class="modal-foote">
        <button type="button" class="btn btn-default btn-lg"style="margin:6px 20px ;" data-dismiss="modal">Close</button>
        <button type="button" class="btn bg-maroon btn-lg make_sale btn-lg "style="float:right;margin:1px 10px ;" onclick="save()"><i class="fa  fa-save "></i> Click to create List</button>

      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>