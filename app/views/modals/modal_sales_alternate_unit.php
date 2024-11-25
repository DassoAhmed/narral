<div class="sales_item_modal">
   <div class="modal fade in" id="sales_unit">
      <div class="modal-dialog ">
         <div class="modal-content">
            <div class="modal-header header-custom">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span></button>
               <h4 class="modal-title text-center">Alternate Sales Units</h4>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                           <b>Item Name : </b> <span id='popup_item_name_al'><span>
                        </div>
                        <!-- /.col -->
                     </div>
                     <!-- /.row --> 
                  </div>
                  <div class="col-md-12">
                     <div>
                        
                        <div class="col-md-12 ">
                           <div class="box box-solid bg-gray">
                              <div class="box-body">
                                 <div class="row">
                                    
                                    <div class="col-md-8">
                                        <div class="form-group">
                                          <label for="popup_block_qty">Quantity of Bags</label>
                                          <input type="text" class="form-control" id="popup_block_qty"placeholder="Exp = 1 Bag" style="width: 100%;">
                                          <input type="hidden" class="form-control" id="popup_operator_value"placeholder="Exp = 1 Bag" style="width: 100%;">
                                        </div>
                                   
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                          <input type="hidden" class="form-control" id="popup_retail_qty"placeholder="Exp = 10 KG" style="width: 100%;">
                                        </div>
                                        
                                   
                                    </div>


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
               <button type="button" onclick="set_alt_info()" class="btn bg-green btn-lg place_order btn-lg">Set<i class="fa  fa-check "></i></button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
</div>
