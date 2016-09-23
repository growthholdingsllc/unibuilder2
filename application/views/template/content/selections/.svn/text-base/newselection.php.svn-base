<?php //echo '<pre>';print_r($result_data['ub_template_selection_choice_id']);exit;?>
<?php //echo $choice_folder_id."<br>"; ?>
<?php //echo $selection_dir_id."<br>"; ?> 
<?php //echo $selection_folder_id; ?>
<div class="row">
   <ol class="breadcrumb">
      <?php $this->load->view('template/common/breadcrumbs'); ?>
      <li class="active">New Selections</li>
   </ol>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
		<div class="pull-right ">
			<button class="btn btn-gray pull-right m-left-1" type="button" id="btncancel">
				<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel
			</button>
			<button type="button" class="btn btn-blue pull-right m-left-1" id="<?php if(isset($result_data['ub_template_selection_id'])) echo $result_data['ub_template_selection_id']; ?>" onclick="delete_selection(this.id)">
					<img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Delete" class="uni_delete">
					Delete</button> 
            <!--<button class="btn btn-gray pull-right m-left-1" type="button" id="Pending" onclick="update_selection_status(this.id)">
			<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_reset_status_pending"/> Reset to pending
			</button>-->
            <!--<button class="btn btn-default btn-primary pull-right m-left-1" type="button">Save as New</button>-->
            <a href="#"><button class="btn btn-blue pull-right m-left-1" type="submit" id="add_selection_new_back_to_list" name="add_selection_new_back_to_list">
				<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save and Back
			</button></a>
            <a href="#"><button class="btn btn-blue pull-right m-left-1" type="submit" id="add_selection_new_button" name="add_selection_new_button"> <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save and New</button></a>
            <a href="#"><button class="btn btn-blue pull-right m-left-1" type="submit" id="add_selection_new_back" name="add_selection_new_back"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/>Save and stay</button></a>   
		 </div>	
      </div>
   </div>
</div>
<div class="row m-top">
   <div class="col-xs-12 error-message uni_message">
      <div class="alerts alert-danger"></div>
   </div>
</div>
<?php if(isset($result_data['ub_template_selection_id'])) { ?>
<div class="text-right m-top">
   <p>&nbsp;</p>
   <div class="status_box">Status  <img src="<?php echo IMAGESRC.'approved_owner.png'; ?>"/>
      <span class="text-danger"> <?php echo $result_data['status']; ?> (or) on <?php echo date("m/d/Y",strtotime($result_data['created_on'])); ?> By <?php echo $result_data['first_name']; ?></span>
   </div>
</div>
<?php } ?>
<div class="row m-top">
   <div class="col-xs-12">
      <div class="tab-con pull-left">
         <div role="tabpanel" id="<?php if($this->user_account_type == BUILDERADMIN && isset($this->user_role_access[strtolower('selections')][strtolower('edit')]) && $this->user_role_access[strtolower('selections')][strtolower('edit')] == 1){if(isset($this->project_status_check) && $this->project_status_check == 1){echo 'selectioninfotab';}}else{ echo ''; }?>">
            <!-- Nav tabs -->
            <form id="add_new_selections" class="form-horizontal" method="post" name="add_new_selections">
               <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"> <a href="#General" aria-controls="Detailed_Permissions" data-toggle="tab">General</a> </li>
                  <li role="presentation"> <a href="#Description" aria-controls="Description" data-toggle="tab">Description</a> </li>
               </ul>
               <!-- Tab panes -->
               <div class="tab-content">
                  <div class="tab-pane active" id="General">
                     <div class="row five-col">
                        <input type="hidden" name="ub_selection_id" id="ub_selection_id" value="<?php if(isset($result_data['ub_template_selection_id'])) echo $result_data['ub_template_selection_id'];?>">
                        <div class="col-xs-3 <?php if($this->template_id == '' && !isset($result_data['template_id'])){ echo 'no_project_selected'; } ?>">
					    <?php                          
						if(!empty($this->template_id) && !isset($result_data['template_id']))
						{
							echo '<label>Template Name</label> : '.$this->template_name;			  
							echo '<input type="hidden" name="template_id" id="template_id" value="'.$this->template_id.'" />';
						}
						else if(isset($result_data['template_id']))
						{
							echo '<label>Template Name</label> : '.$template_list[$result_data['template_id']];			  
							echo '<input type="hidden" name="template_id" id="template_id" value="'.$result_data['template_id'].'" />';
						}
						?>
                        </div>
                        <div class="col-xs-3">
                           <label>Title</label>
                           <div class="col-xs-12">
                              <div class="form-group">
                                 <input type="text" class="form-control" maxlength="128" id="title" name="title" value="<?php echo isset($result_data['title'])?$result_data['title']:'' ?>" />
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-3">
                           <label>Category</label>
                           <div class="input-group right-group">
								<?php 
								$category_selected = '';
								if(isset($result_data['category']))
								{
									$category_selected = explode(",",$result_data['category']);
								}
								//array_unshift($category_array, "Nothing selected");
								//print_r($category_array);
								echo form_dropdown('category[]', $category_array, $category_selected, "class='selectpicker form-control' id='category' data-live-search='true'");
								?>
								<?php 
								if($this->user_account_type == BUILDERADMIN) {
								?>					
								<span class="input-group-addon">
									<a data-toggle="modal" data-target="#TypeAddModal" href="javascript:void(0);">
										<img border="0" src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>" alt="plus">
									</a> 
									<a class="TypeEditModal" href="javascript:void(0);">
										<img border="0" src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>" alt="minus">
									</a>
								</span> 
								<?php 
								}
								?>
                           </div>
                        </div>
                        <div class="col-xs-3">
                           <label>Location</label>
                           <div class="input-group right-group">
                              <?php 
                                 $locations_selected = '';
                                 if(isset($result_data['location']))
                                 {
                                 $locations_selected = explode(",",$result_data['location']);
                                 }
                                                 //array_unshift($locations_array, "Nothing selected");
                                                   echo form_dropdown('locations[]', $locations_array, $locations_selected, "class='selectpicker form-control' id='locations' data-live-search='true'");
                                                ?>
								<?php 
								if($this->user_account_type == BUILDERADMIN) {
								?>					
									<span class="input-group-addon">
										<a data-toggle="modal" data-target="#TypeAddModals" href="javascript:void(0);">
											<img border="0" src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>" alt="plus">
										</a> 
										<a class="TypeEditModals" href="javascript:void(0);">
											<img border="0" src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>" alt="minus">
										</a>
									</span> 
								<?php 
								}
								?>
                           </div>
                        </div>
						<?php if($allowance_data == TRUE) { ?>
                        <div class="col-xs-3">
                           <label>Allowance</label>
                           <div class="input-group"> <span class="input-group-addon"> <i class="glyphicon dollar"></i> </span>
                              <input type="text" class="form-control"  id="allowance" name="allowance" value="<?php echo isset($result_data['allowance'])?$result_data['allowance']:'' ?>" />
                           </div>
                        </div>
						<?php } ?>
						
                     </div>
                     <div class="row five-col">
                        <div class="col-xs-3">
                           <label>Deadline</label>
                           <div><input data-toggle="toggle" data-on="Link To" data-off="Due Date" type="checkbox" id="toggle-event"></div>
                        </div>
                        <div class="col-xs-3 due-date">
                           <label>&nbsp;</label>
                           <div class='input-group date' id='datetimepicker5'>
                              <input type="text" class="form-control" id="duedate_date" name="duedate_date" value="<?php echo (isset($result_data['due_date']) && $result_data['due_date'] != 0000-00-00)?date("m/d/Y", strtotime($result_data['due_date'])):'' ?>">
                              <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                           </div>
                        </div>
                        <div class="col-xs-3 due-date">
                           <label>&nbsp;</label>
                           <div class="form-group">
                              <div class='input-group date' id='task-time'>
                                 <input type='text' class="form-control" placeholder="No Time" id="duedate_time" name="duedate_time" value="<?php echo isset($result_data['due_time'])?$result_data['due_time']:'' ?>" />
                                 <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span> 
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-2 due-date">
                           <label>&nbsp;</label>
                           <p>Required? <input type="checkbox" id="owner_required" name="owner_required" <?php if(isset($result_data['deadline_required']) && $result_data['deadline_required']==='Yes') echo  "checked='checked'"; ?> /> </p>
                        </div>
                        <div class="col-xs-3 link-to">
                           <div class="col-xs-3">
                              <label>&nbsp;</label>
                              <input name="days" id="days" type="text" class="form-control" value="1" style="width:40px;" /> 
                           </div>
                           <div class="col-xs-3">
                              <p>&nbsp;</p>
                              <label>day(s)</label>
                           </div>
                           <div class="col-xs-6">
                              <label>&nbsp;</label>
                              <select class="selectpicker form-control">
                                 <option value="">Nothing selected</option>
                                 <option>After</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-xs-3 link-to">
                           <label>&nbsp;</label>
                           <select class="selectpicker form-control" data-live-search="true" multiple>
                              <option>Item1</option>
                           </select>
                        </div>
                        <div class="col-xs-4 link-to">
                           <label>&nbsp;</label>
                           <p>Required? <input type="checkbox"/> </p>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="Description">
                     <div class="row">
                        <div class="col-xs-12">
                           <label>Public Instructions</label>
                           <textarea class="form-control" id="public_instructions" name="public_instructions"><?php echo isset($result_data['description'])?$result_data['description']:'' ?></textarea>
                        </div>
                        <div class="col-xs-12 m-top">
                           <label>Internal Notes</label>
                           <textarea class="form-control" id="internal_notes" name="internal_notes"><?php echo isset($result_data['builderuser_notes'])?$result_data['builderuser_notes']:'' ?></textarea>
                        </div>
                     </div>
                  </div>
               </div>
               <input type="hidden" name="save_type" id="save_type" value="" />
            </form>
         </div>
         <!-- Choice new code  -->
         <form name="choice_form" method="post" class="form-horizontal" id="choice_form">
            <?php if(!empty($result_data['ub_template_selection_id']) && isset($result_data['ub_template_selection_id'])) {              
               ?>
            <div class="row m-top">
               <?php if($approved_count_data['total_count'] == 0) { ?>
               <div class="col-xs-12">
                  <div class="pull-left">
                     <div class="action-btn">
                        <a class="sprite" id="add_choice" href="javascript:void(0);">
                        <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_new">
                        Add Choice
                        </a>                             
                     </div>
                  </div>
               </div>
               <?php } ?>
               <div class="col-xs-12 choice-con">
                  <!-- tabs left -->
                  <div class="tabbable tabs-left m-top">
                     <ul class="nav nav-tabs">
                        <li class="active"><a href="#general" data-toggle="tab">General</a></li>
                        <li><a href="#description" data-toggle="tab">Description</a></li>
                     </ul>
                     <div class="tab-content" id="selection_choice_block">
                        <div class="tab-pane active panel-content" id="general">
                           <div class="row">
                              <div class="col-xs-12">
                                 <div class="pull-right">
                                    <div class="action-btn">
                                       <a href="javascript:void(0);" class="btn btn-blue" id="add_new_choices" name="add_new_choices" onclick="add_new_choices();"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_new"/> Save</a>
                                       <a href="javascript:void(0);" class="btn btn-gray"  onclick="add_new_choices_cancel();"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row five-col m-top">
                              <div class="col-xs-3">
                                 <input type="hidden" name="ub_selection_choice_id" id="ub_selection_choice_id" value="<?php if(isset($result_data['ub_template_selection_choice_id'])) echo $result_data['ub_template_selection_choice_id'];?>">
                                 <label>Title</label>
                                 <input type="text" maxlength="75" class="form-control" name="choice_title" id="choice_title" />
                              </div>
                              <div class="col-xs-3">
                                 <label>Associate Selection</label>
                                 <p>New Selection</p>
                              </div>
                              <div class="col-xs-3">
                                 <label>Added On</label>
                                 <p>
                                    <!--<img src="<?php echo IMAGESRC.'sub.png'; ?>"/>--> <input type="text" class="form-control" name="added_on" id="added_on" />
                                 </p>
                              </div>
                              <div class="col-xs-3">
                                 <label>Standard Choice?</label>
                                 <p><input type="checkbox" name="choice_standard_choice" id="choice_standard_choice" class="check_box_value" />
                                    <input type="hidden" name="choice_standard_choice_hidden" id="choice_standard_choice_hidden" value="No" />
                                 </p>
                              </div>
                              <div class="col-xs-3">
                                 <label>Product URL</label>
                                 <input type="text" maxlength="500" class="form-control" id="choice_product_url" name="choice_product_url" />
                              </div>
                           </div>
                           <!--<div class="row five-col m-top">
                              <!--checking role access // by satheesh kumar
                              <?php 
                                 if(isset($this->user_account_type) && $this->user_account_type != SUBCONTRACTOR)
                                 {
                                 ?>
                              <div class="col-xs-3">
                                 <label>Owner Price(or)TBD <input type="checkbox" id="choice_owner_price" name="choice_owner_price" class="check_box_value" />
                                 <input type="hidden" name="choice_owner_price_hidden" id="choice_owner_price_hidden" value="No" />
                                 </label>
                                 <div class="input-group"> <span class="input-group-addon"> <i class="glyphicon dollar"></i> </span>
                                    <input type="text" class="form-control" id="choice_owner_price_tbd" name="choice_owner_price_tbd" >
                                 </div>
                              </div>
                              <?php 
                                 }
                                 if(isset($this->user_account_type) && $this->user_account_type != OWNER)
                                 {
                                 ?>
                              <div class="col-xs-3">
                                 <label>Builder Cost(or)request from Vendor <input type="checkbox" id="choice_builder_cost" name="choice_builder_cost" class="check_box_value" />
                                 <input type="hidden" name="choice_builder_cost_hidden" id="choice_builder_cost_hidden" value="No" />
                                 </label>
                                 <div class="input-group"> <span class="input-group-addon"> <i class="glyphicon dollar"></i> </span>
                                    <input type="text" class="form-control" id="choice_builder_cost_price" name="choice_builder_cost_price" >
                                 </div>
                              </div>
                              <div class="col-xs-6">
                                 <label>Sub Pricing Comments</label>
                                 <textarea class="form-control" id="choice_sub_pricing_comments" name="choice_sub_pricing_comments"></textarea>
                              </div>
                              <?php 
                                 }
                                 ?>
                           </div>-->
                        </div>
                        <div class="tab-pane" id="description">
                           <div class="row">
                              <div class="col-xs-12">
                                 <div class="pull-right">
                                    <div class="action-btn">
                                       <!-- <a href="javascript:void(0);"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_stay"/></a>
                                          <a href="javascript:void(0);"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_New"/></a> -->
                                       <!--checking role access // by satheesh kumar  -->
                                       <?php 
                                          if($this->user_account_type == BUILDERADMIN || (isset($result_data['owner_selection_access']) && ($result_data['owner_selection_access'] == 'Add/Edit & Approve Choice Only')) || (isset($result_data['vendor_selection_access']) && ($result_data['vendor_selection_access'] == 'Add/Edit Choices')))
                                           {
                                           ?>
                                       <a href="javascript:void(0);" class="btn btn-blue" id="add_new_choices2" name="add_new_choices2" onclick="add_new_choices();"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_new"/> Save</a>
                                       <?php 
                                          }
                                          ?>
                                       <a href="javascript:void(0);" class="btn btn-gray"  ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-xs-12">
                                 <label>Description</label>
                                 <textarea class="form-control" id="choice_description" name="choice_description"></textarea>
                              </div>
                              <div class="col-xs-6 pull-right">
                                 <p>&nbsp;</p>
                                 <!--<div class="status_box">
                                    <div class="pull-left status-icon">Status <img src="<?php echo IMAGESRC.'pending.png'; ?>"/> Pending </div>
                                    <div class="pull-left">
                                       <div class="action-btn">
                                          <a class="sprite" href="javascript:void(0);">
                                          <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="approval">
                                          Approved
                                          </a>
                                          <a class="sprite" href="javascript:void(0);">
                                          <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="decline">
                                          Decline
                                          </a>                         
                                       </div>
                                    </div>
                                    </div>-->
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /tabs --> 
               </div>
               <div class="col-xs-12 m-top selection_choice">
                  <table id="selection_choices" class="table table-bordered datatable dataTable" width="100%">
                     <thead>
                        <tr>
                           <th><input type="checkbox" id="selectall" name="all"/></th>
                           <th>Choice</th>
                           <th>Added By</th>
                           <th>Details</th>
                           <th>Status/Alerts</th>
                           <th>Price</th>
                        </tr>
                     </thead>
					 <tbody>
					 </tbody>
                  </table>
               </div>
            </div>
            <?php } ?>
         </form>
      </div>
   </div>
</div>
<!-- Type Add Modal -->
<div class="modal fade" id="TypeAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>New Selection Category
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <table width="100%" class="table border-none">
                              <tr>
                                 <td height="20">Title</td>
                                 <td><input type="text" id="category_add" class="form-control" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" id="category_save" class="btn btn-default btn-secondary pull-right">Save</button></td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="TypeAddModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>New Selection Locations
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <table width="100%" class="table border-none">
                              <tr>
                                 <td height="20">Title</td>
                                 <td><input type="text" id="locations_add" class="form-control" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" class="btn btn-default btn-secondary pull-right" id="locations_save">Save</button></td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="TypeEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Edit / Delete category
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <table width="100%" class="table border-none">
                              <tr>
                                 <td height="20">Title</td>
                                 <td><input type="text" id="edit_project_group" class="form-control" /><input type="hidden" id="selected" class="form-control"  /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2">
                                    <button type="button" id="project_group_delete" class="btn btn-default btn-secondary pull-right">Delete</button>
                                 </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="TypeEditModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Edit / Delete Locations
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <table width="100%" class="table border-none">
                              <tr>
                                 <td height="20">Title</td>
                                 <td><input type="text" id="edit_project_groups" class="form-control" /><input type="hidden" id="selected" class="form-control"  /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2">
                                    <button type="button" id="project_group_deletes" class="btn btn-default btn-secondary pull-right">Delete</button>
                                 </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade confirmModal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Are you sure you want to delete?       
      </h4>
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
            <div class="modal-con">              
              <div class="row col-xs-12">                				
				<button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="cancel_icon"/> CANCEL</button>  
				<button class="btn btn-blue m-left-1 pull-right" type="button" id="delete_confirm"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_dick"/> OK</button>				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
<script type="text/javascript">    
   this.choice_dir_id   = '2'; 
   this.choice_folder_id   = '<?php if (isset($choice_folder_id)) {echo $choice_folder_id;} else{} ?>';  
   this.selection_dir_id   = '<?php if (isset($selection_dir_id)) {echo $selection_dir_id;} else{} ?>'; 
   this.selection_folder_id   = '<?php if (isset($selection_folder_id)) {echo $selection_folder_id;} else{} ?>'; 
   this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>'; 
   this.displayStart   = '<?php echo 0 ?>';    
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.list_page   = 'yes';     
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script> 
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-toggle.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.mjs.nestedSortable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-template-datatable.js';?>"></script>
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.jscrollpane.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'enscroll-0.6.0.min.js';?>"></script>
<script type="text/javascript" src="<?php echo TEMPSRC.'new_selection.js';?>"></script>