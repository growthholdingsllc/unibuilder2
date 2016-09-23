<!-- Cost Code editor -->
<input type="hidden" name="check_costcode" id="check_costcode" value="<?php echo implode(',', $cost_code_options);?>"/>
<div class="modal fade" id="CostCodeEditor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Cost Code Editor
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <div class="col-xs-4">
                              <!--<label>Active:</label>
                              <input type="checkbox" name="costcode_status" id="costcode_status" class="form-control"/>-->
                           </div>
                           <div class="col-xs-8 text-right">
						   <button type="button" class="btn  btn-blue pull-right" name="insert_costcode" id="insert_costcode">Save</button>
						    <button type="button" class="btn  btn-gray delete_costcode" name="delete_costcode" id="delete_costcode">Delete</button>
						   </div>						   
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <h4>Add CostCode</h4>
                        </div>
                        <div class="col-xs-12">
                           <div class="row ">
                              <div class="col-xs-6">
                                 <label>Title:</label>
                                 <input type="text" class="form-control" name="cost_variance_code" id="cost_variance_code" placeholder="001 interior Design consulting"/>
								 <input type="hidden" name="update_costcode_id" id="update_costcode_id" value=""/>
                              </div>
							  <!-- Temporary hiding category as per Girish
                              <div class="col-xs-6">
                                 <label>Cost Code Category:</label>
                                 <?php				   
									/*$category_code_selected = '';
									$category_options = isset($category_options)?$category_options:'';
									echo form_dropdown('code_category', $category_options,$category_code_selected, "class='selectpicker form-control' id='code_category' data-live-search='true'");*/
									?>
                              </div>
							  -->
                           </div>
                        </div>
                        <div class="col-xs-12 m-top deatails_cost">
                           <label>Details:</label>
                           <textarea class="form-control" id="cost_description" name="cost_description"></textarea>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>