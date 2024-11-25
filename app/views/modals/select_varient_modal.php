
                        <div id="product_variants_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <input type="hidden" class="product_id" name="" value="101846">
                                      <h4 class="modal-title">Select Variant for <span class="product_name">FISH </span></h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row  el-element-overlay"><div class="col-12"><h3 class="box-title">Golden</h3><p><small>Available Stock: 0</small></p></div><div class="col-lg-4 col-md-6 select_units" data-units="Bag"><div class="card"><div class="el-card-item"><div class="el-card-content" style="text-align:center;"><h3 class="box-title">Bag</h3><p><small>1 Bag= 50 KG</small></p><p><input type="number" data-variant-id="6070" data-variant-name="Golden" name="secondary_unit_Bag" value="1" data-qty-before="0" data-primary-unit-qty="50" class="variant_secondary_unit form-control"></p></div></div></div></div><div class="col-lg-4 col-md-6 select_units" data-units="KG"><div class="card"><div class="el-card-item"><div class="el-card-content" style="text-align:center;"><h3 class="box-title">KG</h3><p><small>1 KG= 1 KG</small></p><p><input type="number" name="secondary_unit_KG" value="0" data-variant-id="6070" data-variant-name="Golden" data-qty-before="0" data-primary-unit-qty="1" class="variant_secondary_unit form-control"></p></div></div></div></div></div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" id="update_variants_with_secondary" class="btn btn-success waves-effect waves-light pull-right submit_variants_btn">Submit</button>
                                  </div>
                              </div>
                          </div>
                        </div>

                        <div id="expense_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <form class="" action="" method="post" name="expense_form">

                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Expense to Activity</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">

                                    <div class="row p-t-20">
                                      <div class="col-sm-6">
                                        <lable for="expense_type">Expense Type</lable>
                                      </div>
                                      <div class="col-sm-6">
                                        <select class="form-control" name="expense_type" id="expense_type">
                                                                                    <option value="Rent">Rent</option>
                                                                                    <option value="Travel">Travel</option>
                                                                                    <option value="Salery">Salery</option>
                                                                                    <option value="Utility Bills">Utility Bills</option>
                                                                                    <option value="Drinks/Food">Drinks/Food</option>
                                                                                    <option value="Storage">Storage</option>
                                                                                    <option value="Transport">Transport</option>
                                                                                    <option value="Bad-Debt">Bad-Debt</option>
                                                                                    <option value="Inventory-Damage">Inventory-Damage</option>
                                                                                     <option value="Others">Others</option>
                                        </select>
                                        <br>
                                      </div>

                                    </div>

                                    <div class="row p-t-20">
                                      <div class="col-sm-6">
                                        <label for="amount">Amount</label>
                                      </div>
                                      <div class="col-sm-6">
                                        <input type="number" required="" class="form-control" name="amount" id="amount" value="">
                                      </div>
                                    </div>

                                    <div class="row p-t-20">
                                      <div class="col-sm-6">
                                        <label for="payment_method">Payment Method</label>
                                      </div>
                                      <div class="col-sm-6">
                                          <select class="form-control" name="payment_method" id="payment_method">
                                            <optgroup label="Cash and Banks">
                                                                                             <option value="202405">Cash</option>
                                                                                                <option value="202416">SCB</option>
                                                                                          </optgroup>
                                             <optgroup label="Suppliers, customers and employees">
                                                                                          <option value="+0000">Walk-in Customer / Supplier (+0000)</option>
                                                                                          <option value="+237-650175609">SAIDOU ALIM (+237-650175609)</option>
                                                                                           </optgroup>
                                            </select>
                                      </div>
                                    </div>

                                    <div class="row p-t-20">
                                      <div class="col-sm-6">
                                        <label for="description">Description</label>
                                      </div>
                                      <div class="col-sm-6">
                                        <input type="text" class="form-control" name="description" id="description" placeholder="paid x amount for ...">
                                      </div>
                                    </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success waves-effect waves-light" id="submit_expense_btn">Submit</button>
                                    </div>
                                  </form>
                                  </div>
                                </div>
                              </div>

                        <div id="product_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Products to Bill</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">

                                      <div class="row">
                                        <div class="col-sm-4">
                                          <label for="product_search_box">Search Products</label>
                                        </div>
                                        <div class="col-sm-4">
                                          <input type="text" id="product_search_box" class="form-control" name="" value="" placeholder="Search Product">
                                        </div>
                                      </div>

                                      <div id="" class="m-t-20">
                                          <div class="row">
                                            <div class="col-sm-12">
                                              <div class="row el-element-overlay">

                                                
                                                <div class="col-lg-3 col-md-6 add_item_to_cart" id="item_101842_BELLALUNA _10000_10_9500_Bag" rel="bellaluna  25% red bag" data-item-id="101842" data-item-name="BELLALUNA " data-item-cost="9500" data-item-unit="Bag" data-variants-json="" data-variants="" data-unit="Bag" data-variant_count="0" data-secondary_units_count="1" data-secondary-units-json="[{&quot;secondary_unit&quot;:&quot;KG&quot;,&quot;primary_unit_qty&quot;:&quot;50&quot;}]" data-tax-rate="0">
                                                  <div class="card">
                                                    <div class="el-card-item">
                                                      <div class="el-card-content">
                                                        <h3 class="box-title">BELLALUNA </h3>
                                                        <p><small>Available Stock: 10</small></p>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            
                                                <div class="col-lg-3 col-md-6 add_item_to_cart" id="item_101888_Finisher_22000_3960_20000_KG" rel="finisher nnj" data-item-id="101888" data-item-name="Finisher" data-item-cost="20000" data-item-unit="KG" data-variants-json="" data-variants="" data-unit="KG" data-variant_count="0" data-secondary_units_count="1" data-secondary-units-json="[{&quot;secondary_unit&quot;:&quot;Bag&quot;,&quot;primary_unit_qty&quot;:&quot;50&quot;}]" data-tax-rate="0">
                                                  <div class="card">
                                                    <div class="el-card-item">
                                                      <div class="el-card-content">
                                                        <h3 class="box-title">Finisher</h3>
                                                        <p><small>Available Stock: 3960</small></p>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            
                                                <div class="col-lg-3 col-md-6 add_item_to_cart" id="item_102371_FINISHER1_22000_489_21000_KG" rel="finisher1 " data-item-id="102371" data-item-name="FINISHER1" data-item-cost="21000" data-item-unit="KG" data-variants-json="" data-variants="" data-unit="KG" data-variant_count="0" data-secondary_units_count="1" data-secondary-units-json="[{&quot;secondary_unit&quot;:&quot;Bag&quot;,&quot;primary_unit_qty&quot;:&quot;50&quot;}]" data-tax-rate="0">
                                                  <div class="card">
                                                    <div class="el-card-item">
                                                      <div class="el-card-content">
                                                        <h3 class="box-title">FINISHER1</h3>
                                                        <p><small>Available Stock: 489</small></p>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            
                                                <div class="col-lg-3 col-md-6 add_item_to_cart" id="item_101846_FISH _12000_385_9500_KG" rel="fish  ,," data-item-id="101846" data-item-name="FISH " data-item-cost="9500" data-item-unit="KG" data-variants-json="Golden--:--0--:--6070" data-variants="Golden" data-unit="KG" data-variant_count="1" data-secondary_units_count="1" data-secondary-units-json="[{&quot;secondary_unit&quot;:&quot;Bag&quot;,&quot;primary_unit_qty&quot;:&quot;50&quot;}]" data-tax-rate="0">
                                                  <div class="card">
                                                    <div class="el-card-item">
                                                      <div class="el-card-content">
                                                        <h3 class="box-title">FISH </h3>
                                                        <p><small>Available Stock: 385</small></p>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            
                                                <div class="col-lg-3 col-md-6 add_item_to_cart" id="item_101847_FISH _12000_10_9500_KG" rel="fish  " data-item-id="101847" data-item-name="FISH " data-item-cost="9500" data-item-unit="KG" data-variants-json="Golden--:--0--:--6071" data-variants="Golden" data-unit="KG" data-variant_count="1" data-secondary_units_count="1" data-secondary-units-json="[{&quot;secondary_unit&quot;:&quot;Bag&quot;,&quot;primary_unit_qty&quot;:&quot;50&quot;}]" data-tax-rate="0">
                                                  <div class="card">
                                                    <div class="el-card-item">
                                                      <div class="el-card-content">
                                                        <h3 class="box-title">FISH </h3>
                                                        <p><small>Available Stock: 10</small></p>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            
                                                <div class="col-lg-3 col-md-6 add_item_to_cart" id="item_101815_GROWER_22000_-72_19000_Bag" rel="grower ,complete feed, from day 31," data-item-id="101815" data-item-name="GROWER" data-item-cost="19000" data-item-unit="Bag" data-variants-json="" data-variants="" data-unit="Bag" data-variant_count="0" data-secondary_units_count="2" data-secondary-units-json="[{&quot;secondary_unit&quot;:&quot;KG&quot;,&quot;primary_unit_qty&quot;:&quot;1&quot;},{&quot;secondary_unit&quot;:&quot;Bag&quot;,&quot;primary_unit_qty&quot;:&quot;50&quot;}]" data-tax-rate="0">
                                                  <div class="card">
                                                    <div class="el-card-item">
                                                      <div class="el-card-content">
                                                        <h3 class="box-title">GROWER</h3>
                                                        <p><small>Available Stock: -72</small></p>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            
                                                <div class="col-lg-3 col-md-6 add_item_to_cart" id="item_102135_Hendrix_1350_495_1100_KG" rel="hendrix " data-item-id="102135" data-item-name="Hendrix" data-item-cost="1100" data-item-unit="KG" data-variants-json="" data-variants="" data-unit="KG" data-variant_count="0" data-secondary_units_count="1" data-secondary-units-json="[{&quot;secondary_unit&quot;:&quot;Bag&quot;,&quot;primary_unit_qty&quot;:&quot;50&quot;}]" data-tax-rate="0">
                                                  <div class="card">
                                                    <div class="el-card-item">
                                                      <div class="el-card-content">
                                                        <h3 class="box-title">Hendrix</h3>
                                                        <p><small>Available Stock: 495</small></p>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            
                                                <div class="col-lg-3 col-md-6 add_item_to_cart" id="item_101843_STARTER_22500_-41_20000_KG" rel="starter ,25% red bag," data-item-id="101843" data-item-name="STARTER" data-item-cost="20000" data-item-unit="KG" data-variants-json="" data-variants="" data-unit="KG" data-variant_count="0" data-secondary_units_count="1" data-secondary-units-json="[{&quot;secondary_unit&quot;:&quot;KG&quot;,&quot;primary_unit_qty&quot;:&quot;50&quot;}]" data-tax-rate="0">
                                                  <div class="card">
                                                    <div class="el-card-item">
                                                      <div class="el-card-content">
                                                        <h3 class="box-title">STARTER</h3>
                                                        <p><small>Available Stock: -41</small></p>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                                                      </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success waves-effect waves-light">Save changes</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          </div>