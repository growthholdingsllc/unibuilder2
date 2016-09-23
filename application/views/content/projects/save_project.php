<div class="row">
   <ol class="breadcrumb">
       <?php //$this->load->view('common/breadcrumbs'); ?>
      <!--<li class="active">Project Details</li>-->
   </ol>
</div>
<?php 
if(isset($this->user_account_type) && BUILDERADMIN == $this->user_account_type)
{
?>
<form id="save_project" class="form-horizontal" method="post" name="save_project">
<?php }?>
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
         <div class="pull-right ">
			<a href="<?php echo base_url();?>cHJvamVjdHMvaW5kZXgv">
			<button type="button" class="btn btn-gray pull-right m-left-1">
				<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel
			</button>
			</a>
            <?php
			if(isset($this->user_role_access[strtolower('projects')][strtolower('delete')]) && $this->user_role_access[strtolower('projects')][strtolower('delete')] == 1)
			{ 
				if (isset($result_data['ub_project_id']) && !empty($result_data['ub_project_id'])) {?>
				<button type="button" class="btn btn-blue pull-right m-left-1" id="<?php if(isset($result_data['ub_project_id'])) echo $result_data['ub_project_id']; ?>" onclick="delete_project(this.id)">
					<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_delete"/> Delete
				</button>
            <?php   
				}
			}
			if(isset($this->user_role_access[strtolower('projects')][strtolower('edit')]) && $this->user_role_access[strtolower('projects')][strtolower('edit')] == 1 && $this->first_argument > 0)
			{
            ?>
				<button type="submit" name="add_project_new_back" id="add_project_new_back" class="btn btn-blue pull-right m-left-1">
					<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back
				</button>
				<button type="submit" class="btn btn-blue pull-right m-left-1" name="add_project_new_stay" id="add_project_new_stay"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
				<button type="submit" name="add_project_new" id="add_project_new" class="btn btn-blue pull-right m-left-1">
					<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/>  Save &amp; New
				</button>
				<a href="javascript:void(0);" data-target="#create_template_modal" data-toggle="modal">
				<button type="button" name="add_template_new" id="add_template_new" class="btn btn-blue pull-right m-left-1"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_export_template"/>  Export as Template</button>
				</a>
			<?php
			}
			else if((isset($this->user_role_access[strtolower('projects')][strtolower('add')]) && $this->user_role_access[strtolower('projects')][strtolower('add')] == 1) && $this->first_argument == 0)
			{ 
			?>
				<button type="submit" name="add_project_new_back" id="add_project_new_back" class="btn btn-blue pull-right m-left-1"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back</button>
				<button type="submit" class="btn btn-blue pull-right m-left-1" name="add_project_new_stay" id="add_project_new_stay"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
				<button type="submit" name="add_project_new" id="add_project_new" class="btn btn-blue pull-right m-left-1"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/>  Save &amp; New</button>
			<?php
			}
			?>
            <!--</a> -->
         </div>
      </div>
	  <input type="hidden" name="save_type" id="save_type" value="" />
	  <input type="hidden" value="<?php echo isset($result_data['project_assigned_users'])?$result_data['project_assigned_users']:'' ?>" name="project_assigned_users"  id="project_assigned_users" />
	  <input type="hidden" value="<?php echo isset($result_data['builder_users_permitted'])?$result_data['builder_users_permitted']:'' ?>" name="builder_users_permitted"  id="builder_users_permitted" />
	  <input type="hidden" value="<?php echo isset($result_data['builder_users_roleid'])?$result_data['builder_users_roleid']:'' ?>" name="builder_users_roleid"  id="builder_users_roleid" />
	   <input type="hidden" name="info" id="info" value="<?php echo isset($result_data['info'])?$result_data['info']:'' ?>" />
	  <input type="hidden" name="ub_project_id" id="ub_project_id" 
	  value="<?php echo isset($result_data['ub_project_id'])?$result_data['ub_project_id']:'' ?>" />
	  <input type="hidden" name="owner_id" id="owner_id" 
	  value="<?php echo isset($result_data['owner_id'])?$result_data['owner_id']:'' ?>" />
   </div>
</div>
<div class="row m-top">
	<div class="col-xs-12 error-message uni_message">
		<div class="alerts alert-danger"></div>
	</div>
</div>
<div class="row m-top">
   <div class="col-xs-12">
      <div class="tab-con pull-left">
         <div role="tabpanel">
		 <input id="current_tab" type="hidden" value="">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist" id="<?php if($this->user_account_type == BUILDERADMIN && isset($this->user_role_access[strtolower('projects')][strtolower('edit')]) && $this->user_role_access[strtolower('projects')][strtolower('edit')] == 1){echo 'projectinfotab';}else{ echo ''; }?>">
               <li role="presentation" class="active"> <a href="#jobinfo" aria-controls="General-View" data-toggle="tab">Project Info</a> </li>
				<?php 
				if(isset($this->user_account_type) && (BUILDERADMIN == $this->user_account_type || OWNER == $this->user_account_type))
				{
				?>
					<li role="presentation"> <a href="#ownerinfo" aria-controls="Activities" data-toggle="tab">Owner Info</a> </li>
				<?php if((OWNER == $this->user_account_type) && (TRUE == $owner_sign_offs_tab)) { ?>
					<li role="presentation"> <a href="#signoff" aria-controls="Signoff" data-toggle="tab">Signoff</a> </li>
				<?php } ?>
				<?php 
				}
			   ?>
				<?php 
				if(isset($this->user_account_type) && BUILDERADMIN == $this->user_account_type)
				{
			    ?>
               <li role="presentation"> <a href="#viewingaccess" aria-controls="Activities" data-toggle="tab">Viewing Access</a> </li>
               <li role="presentation"> <a href="#options" aria-controls="Activities" data-toggle="tab">Options</a> </li>
               <li role="presentation"> <a href="#signoff" aria-controls="Signoff" data-toggle="tab">Signoff</a> </li>
			   <?php 
			   }
			   ?>			   
            </ul>
            <!-- Tab panes -->
            <div class="tab-content ">
               <div class="tab-pane active" id="jobinfo">
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Projectsite Information</h4>
                     </div>
                     <div class="panel-body">
                        <div class="row panel-content five-col">
                           <div class="col-xs-3">
                           <div class="col-xs-12">
							   <div class="form-group">
								  <label>Project Number</label>
								  <input name="project_no" readonly type="text" 
								  value="<?php echo isset($result_data['project_no'])?$result_data['project_no']:'' ?>"
								   class="form-control"/>
							   </div>
                           </div>
                           </div>
						   <div class="col-xs-3">
                           <div class="col-xs-12">
							   <div class="form-group">
								  <label>Project Name</label>
								  <input name="project_name" id="project_name" type="text" 
								  value="<?php echo isset($result_data['project_name'])?$result_data['project_name']:'' ?>"
								   class="form-control"/>
							   </div>
                           </div>
                           </div>
                           <div class="col-xs-3">                             
                                 <label>Status</label>
								 <div class="col-xs-12">
									 <div class="form-group">
									 
									 <?php 
										$status_selected = '';
									   if(isset($result_data['project_status']))
									   {
											$status_selected = $result_data['project_status'];
									   }
										echo form_dropdown('project_status', $project_status_array,$status_selected, "class='selectpicker form-control' id='project_status' data-live-search='true'");
									  ?>
									  </div>
								  </div>
                           </div>                           
                           <div class="col-xs-3">
                              <label>Project Group</label>
                              <div class="col-xs-12">
								  <div class="form-group">
									  <div class="col-xs">
										<?php 
											$group_selected = '';
										   if(isset($result_data['project_group']))
										   {
												// $group_selected = $result_data['project_group'];
												$group_selected = explode(",",$result_data['project_group']);
										   }
											echo form_dropdown('project_group[]', $project_group_array,$group_selected, "class='selectpicker form-control2' id='project_group' data-live-search='true' multiple");
										?>                          
										 <span class="right-group input-group-addon"><a href="javascript:void(0);" data-target="#TypeAddModal" data-toggle="modal"><img alt="plus" src="<?php echo IMAGESRC.'icon_plus1_1.png'?>" border="0"/></a> <a href="javascript:void(0);" class="TypeEditModal"><img alt="minus" src="<?php echo IMAGESRC.'icon_minus1_1.png'?>" border="0"/></a></span> 
									  </div>
								  </div>
                              </div>
                           </div>
                           <div class="col-xs-3">
                              <label>Project Manager(s)</label>
							  <div class="col-xs-12">
								  <div class="form-group">
							   <?php
									$manager_selected = '';
								   if(isset($result_data['project_managers']))
								   {
										$manager_selected = $result_data['project_managers'];
								   }
									echo form_dropdown('project_managers', $project_manager_array,$manager_selected, "class='selectpicker form-control' id='project_managers' data-live-search='true'");
								?>
									</div>
							   </div>
                           </div>
                        </div>
                        <div class="row panel-content five-col">
							<div class="col-xs-3">
                              <label>Address</label>
                              <div class="input-group right-group">
                                 <input name="address" type="text" class="form-control" placeholder="Address" id="address" value="<?php echo isset($result_data['address'])?$result_data['address']:'' ?>" />
                                 <span class="input-group-addon"> <a href="javascript:void(0);" data-target="#mapModal" data-toggle="modal"><i class="glyphicon glyphicon-map-marker"></i></a> </span> 
                              </div>
                           </div>
						   
						   <input name="latitude" type="hidden" id="latitude" value="38.00" />
						   <input name="longitude" type="hidden" id="longitude" value="-97.00" />
						   
                           <div class="col-xs-3">
                              <label>City</label>
                              <input name="city" type="text" class="form-control" id="city" value="<?php echo isset($result_data['city'])?$result_data['city']:'' ?>"  />
                           </div>
                           <div class="col-xs-3">
                              <label>State</label>
                              <input name="province" type="text" class="form-control" id="province" value="<?php echo isset($result_data['province'])?$result_data['province']:'' ?>" />
                           </div>
                           <div class="col-xs-3">
                              <label>Zip/Postal</label>
                              <input name="postal" type="text" class="form-control" value="<?php echo isset($result_data['postal'])?$result_data['postal']:'' ?>" id="postal" />
                           </div>
                           <div class="col-xs-3">
                              <label>Country</label>
                              <input name="country" type="text" class="form-control" value="<?php echo isset($result_data['country'])?$result_data['country']:'' ?>" id="country"/>
                           </div>
                        </div>
                        <div class="row panel-content five-col">
							<div class="col-xs-3">
                              <label>Lot Info</label>
							  <div class="col-xs-12">
								  <div class="form-group">
								  <input name="lot_info" id="lot_info" type="text"
								  value="<?php echo isset($result_data['lot_info'])?$result_data['lot_info']:'' ?>" class="form-control"/>
								  </div>
							  </div>
                           </div>
                           <div class="col-xs-3">
                              <label>Permit #</label>
                              <input name="permit_no" id="permit_no" value="<?php echo isset($result_data['permit_no'])?$result_data['permit_no']:'' ?>" type="text" class="form-control"/>
                           </div>
                           <div class="col-xs-3">
                              <label>Contract Price</label>
                              <div class="input-group"> <span class="input-group-addon"> <i class="glyphicon dollar"></i> </span>
                                 <input name="contract_price" id="contract_price" value="<?php echo isset($result_data['contract_price'])?$result_data['contract_price']:'' ?>" type="text"  placeholder="Not Assigned" class="form-control">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Project Notes</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="row">
                              <div class="col-xs-12">
                                 <div class="tab-con pull-left">
                                    <div role="tabpanel">
                                       <!-- Nav tabs -->
                                       <ul class="nav nav-tabs" role="tablist">
                                          <li role="presentation" class="active"> <a href="#InternalNotes" aria-controls="General-View" data-toggle="tab">Internal Notes</a> </li>
                                          <li role="presentation"> <a href="#SubNotes" aria-controls="Activities" data-toggle="tab">Sub Notes</a> </li>
                                       </ul>
                                       <div class="tab-content ">
                                          <div class="tab-pane active" name="internal_note" id="InternalNotes">
                                             <textarea name="internal_note" id="internal_note" class="form-control"><?php echo isset($result_data['internal_note'])?$result_data['internal_note']:'' ?></textarea>
                                          </div>
                                          <div class="tab-pane" id="SubNotes">
                                             <textarea name="sub_note" id="sub_note" class="form-control"><?php echo isset($result_data['sub_note'])?$result_data['sub_note']:'' ?></textarea>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Project Schedule Information</h4>
                     </div>
                     <div class="panel-body date_space">
                        <div class="panel-content">
                           <div class="row five-col">
                              <div class="col-xs-3">
                                 <label>Projected Start</label>
                                 <div class='input-group date' id='datetimepicker5'>
                                    <input name="projected_start_date" id="projected_start_date" type='text' value="<?php if(isset($result_data['projected_start_date']) && $result_data['projected_start_date']!='0000-00-00') echo date("m/d/Y", strtotime($result_data['projected_start_date']));?>" class="form-control" />
                                    <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                                 </div>
                              </div>
                              <div class="col-xs-3">
                                 <label>Actual Start</label>									
                                 <div class="input-group date" id="datetimepicker6">
                                    <input name="actual_start_date" id="actual_start_date" type='text' value="<?php if(isset($result_data['actual_start_date']) && $result_data['actual_start_date']!='0000-00-00') echo date("m/d/Y", strtotime($result_data['actual_start_date']));?>" class="form-control" readonly />																
									<span class="input-group-addon">  																			
										<span class="glyphicon glyphicon-calendar"></span> 
									</span>									
									
                                 </div>
								  
                              </div>
                              <div class="col-xs-3">
                                 <label>Projected Completion</label>
                                 <div class='input-group date' id='datetimepicker7'>
                                    <input name="projected_completion" id="projected_completion" type='text' value="<?php if(isset($result_data['projected_completion']) && $result_data['projected_completion']!='0000-00-00') echo date("m/d/Y", strtotime($result_data['projected_completion']));?>" class="form-control" />
                                    <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                                 </div>
                              </div>
                              <div class="col-xs-3">
                                 <label>Actual Completion</label>
                                 <div class='input-group date' id='datetimepicker8'>
                                    <input name="actual_completion" id="actual_completion" type='text' value="<?php if(isset($result_data['actual_completion'])  && $result_data['actual_completion']!='0000-00-00') echo date("m/d/Y", strtotime($result_data['actual_completion']));?>" class="form-control" />
                                    <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                                 </div>
                              </div>
                              <div class="col-xs-3">
                                 <label>Show Owner Calendar</label>
                                 <?php 
									$limit_owner_calendar_selected = '';
								   if(isset($result_data['limit_owner_calendar']))
								   {
										$limit_owner_calendar_selected = $result_data['limit_owner_calendar'];
								   }
									echo form_dropdown('limit_owner_calendar', $limit_owner_calendar_array,$limit_owner_calendar_selected, "class='selectpicker form-control' id='limit_owner_calendar' data-live-search='true'");
								  ?>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-xs-7 checklist">
                                 <label>Work Days</label>
								 <?php
								 if(isset($result_data['work_days']))
								 { ?>
                                 <div> 
									<span>Mon
                                    <input name="work_days[]" value="0" type="checkbox" <?php if(isset($result_data['work_days']) && strstr($result_data['work_days'], '0')) echo  "checked='checked'";?>/>
                                    </span> <span>Tue
                                    <input name="work_days[]" value="1" type="checkbox" <?php if(isset($result_data['work_days']) && strstr($result_data['work_days'], '1')) echo  "checked='checked'";?>/>
                                    </span> <span>Wed
                                    <input name="work_days[]" value="2" type="checkbox" <?php if(isset($result_data['work_days']) && strstr($result_data['work_days'], '2')) echo  "checked='checked'";?>/>
                                    </span> <span>Thu
                                    <input name="work_days[]" value="3" type="checkbox" <?php if(isset($result_data['work_days']) && strstr($result_data['work_days'], '3')) echo  "checked='checked'";?>/>
                                    </span> <span>Fri
                                    <input name="work_days[]" value="4" type="checkbox" <?php if(isset($result_data['work_days']) && strstr($result_data['work_days'], '4')) echo  "checked='checked'";?>/>
                                    </span> <span>Sat
                                    <input name="work_days[]" value="5" type="checkbox" <?php if(isset($result_data['work_days']) && strstr($result_data['work_days'], '5')) echo  "checked='checked'";?>/>
                                    </span>
									<span>Sun
                                    <input name="work_days[]" value="6" type="checkbox" <?php if(isset($result_data['work_days']) && strstr($result_data['work_days'], '6')) echo  "checked='checked'";?>/>
                                    </span> 
                                 </div>
								<?php
								}
								else
								{
								?>
								<div> 
									<span>Mon
                                    <input name="work_days[]" value="0" type="checkbox" checked />
                                    </span> <span>Tue
                                    <input name="work_days[]" value="1" type="checkbox" checked />
                                    </span> <span>Wed
                                    <input name="work_days[]" value="2" type="checkbox" checked />
                                    </span> <span>Thu
                                    <input name="work_days[]" value="3" type="checkbox" checked />
                                    </span> <span>Fri
                                    <input name="work_days[]" value="4" type="checkbox" checked />
                                    </span> <span>Sat
                                   <input name="work_days[]" value="5" type="checkbox" checked />
                                    </span>
									<span>Sun
                                    <input name="work_days[]" value="6" type="checkbox" checked />
                                    </span> 
                                 </div>
								<?php 
								} ?> 
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
				   <?php 
				  //code added by satheesh kumar
				  if (isset($custom_field_data) && !empty($custom_field_data)) 
				  { 
				  ?>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">My Fields</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <?php $this->load->view('common/custom_field.php'); ?>
                        </div>
                     </div>
                  </div>
				  <?php 
				  }
				  ?>
               </div>
			   <?php 
				if(isset($this->user_account_type) && (BUILDERADMIN == $this->user_account_type || OWNER == $this->user_account_type))
				{
				?>
               <div class="tab-pane" id="ownerinfo">
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Owner Information</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="row">
                              <div class="col-xs-12">
                                 <div class="col-xs-2">
                                    <?php $this->load->view('common/thumbnail_upload.php');?>
                                 </div>
                                 <div class="col-xs-10">
                                    <div class="row">
                                       <div class="col-xs-12">
                                          <div class="col-xs-3">
                                             <label>First Name</label>
                                             <input name="first_name" id="first_name" type="text" value="<?php echo isset($result_data['first_name'])?$result_data['first_name']:'' ?>" class="form-control"/>
                                          </div>
                                          <div class="col-xs-3">
                                             <label>Last Name</label>
                                             <input name="last_name" id="last_name" type="text" value="<?php echo isset($result_data['last_name'])?$result_data['last_name']:'' ?>" class="form-control"/>
                                          </div>
                                          <div class="col-xs-3">
                                             <label>Home Phone</label>
                                             <input name="desk_phone" id="desk_phone" value="<?php echo isset($result_data['desk_phone'])?$result_data['desk_phone']:'' ?>" type="text" class="form-control"/>
                                          </div>
                                          <div class="col-xs-3">
                                             <label>Cell Phone</label>
                                             <input name="mobile_phone" id="mobile_phone" value="<?php echo isset($result_data['mobile_phone'])?$result_data['mobile_phone']:'' ?>" type="text" class="form-control"/>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-xs-12">
                                          <div class="col-xs-3">
                                             <label>Primary Email</label>
											 <div class="col-xs-12">
												 <div class="form-group">
													<input name="primary_email" id="primary_email" value="<?php echo isset($result_data['primary_email'])?$result_data['primary_email']:'' ?>" type="text" class="form-control mail"/>
													<span class="text-danger error_mail"></span>
												 </div>
											 </div>
                                          </div>
                                          <div class="col-xs-6">
                                             <label>Alternative Email</label>
                                             <input type="text" name="alternative_email" value="<?php echo isset($result_data['alternative_email'])?$result_data['alternative_email']:'' ?>" class="form-control mail" id="alternative_email" data-role="tagsinput" />
                                          </div>
                                          <div class="col-xs-3">
                                             <p>&nbsp;</p>
                                             <input type="checkbox" id="project_Address"/>
                                             Same as Project Address 
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row panel-content five-col">
                              <div class="col-xs-3">
                                 <label>Current Address</label>
                                 <input type="text" class="form-control" id="owner_address" value="<?php echo isset($result_data['owner_address'])?$result_data['owner_address']:'' ?>" name="owner_address"/>
                              </div>
                              <div class="col-xs-3">
                                 <label>City</label>
                                 <input type="text" class="form-control" id="owner_city" value="<?php echo isset($result_data['owner_city'])?$result_data['owner_city']:'' ?>" name="owner_city"/>
                              </div>
                              <div class="col-xs-3">
                                 <label>State</label>
                                 <input type="text" class="form-control" id="owner_province" value="<?php echo isset($result_data['owner_province'])?$result_data['owner_province']:'' ?>" name="owner_province"/>
                              </div>
                              <div class="col-xs-3">
                                 <label>Zip/Postal</label>
                                 <input type="text" class="form-control" id="owner_postal" value="<?php echo isset($result_data['owner_postal'])?$result_data['owner_postal']:'' ?>" name="owner_postal"/>
                              </div>
                              <div class="col-xs-3">
                                 <label>Country</label>
                                 <input type="text" class="form-control" id="owner_country" value="<?php echo isset($result_data['owner_country'])?$result_data['owner_country']:'' ?>" name="owner_country"/>
                              </div>
                           </div>
						   <?php 
							if(isset($this->user_account_type) && BUILDERADMIN == $this->user_account_type)
							{
							?>
                           <div class="row panel-content five-col">
                              <div class="col-xs-3">
                                 <p>&nbsp;</p>
                                 <input type="checkbox" name="login_enabled" id="login-enabled" 
								 <?php if(isset($result_data['login_enabled']) && $result_data['login_enabled']==='Yes') echo  "checked='checked'";?>
								  />
                                 Login Enabled
                              </div>
                              <div class="col-xs-3 log-disable access-log">
                                 <label>Access Method</label>
                                 <div class="input-group right-group">
                                    <select class="selectpicker form-control" id="access_method" name="access_method">
                                       <option value="none">Nothing selected</option>
                                       <option value="emailinvite">Email Invite</option>
                                       <option value="configure">Configure Manually</option>
                                    </select>
                                    <span class="input-group-addon">  </span> 
                                 </div>
                              </div>
                              <div class="col-xs-3 log-disable drop-down-show-hide configure">
                                 <label>User Name</label>
                                 <input name="username" id="username" type="text" value="<?php echo isset($result_data['username'])?$result_data['username']:'' ?>" class="form-control disabled_input"/>
                              </div>
                              <div class="col-xs-3 log-disable drop-down-show-hide configure">
                                 <label>New Password</label>
                                 <input name="password" id="password" type="password" value="<?php echo isset($result_data['password'])?$result_data['password']:'' ?>" class="form-control disabled_input"/>
                              </div>
                              <div class="col-xs-3 log-disable drop-down-show-hide drop emailinvite">
                                 <p>&nbsp;</p>
                                 <button type="submit" class="btn btn-blue disabled_prop" id="owneremailinvitation">
								 <img border="0" class="uni_send_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Send
								 </button>
                              </div>
							  <!-- temporarily below button is commented -->
							  <!--
                              <div class="col-xs-3 log-disable drop access-log">
                                 <p>&nbsp;</p>
                                 <button type="button" class="btn btn-blue disabled_prop" >View Owner Site</button>
                              </div>
							  -->
                           </div>
						   <?php 
						   }
						   ?>
                        </div>
                     </div>
                  </div>
				   <?php 
				  //code added by satheesh kumar
					if (isset($owner_custom_field_data) && !empty($owner_custom_field_data)) 
					{  
				  ?>
				  <div class="panel panel-default">
                     <div id="filter" role="tab" class="panel-heading">
                        <h4 class="panel-title">My Fields</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <?php $this->load->view('common/owner_custom_field.php'); ?>
                        </div>
                     </div>
                  </div>
				  <?php 
					}
				  ?>
			   </div>
			   <?php 
			    }
			   ?>
			   <?php 
				if(isset($this->user_account_type) && BUILDERADMIN == $this->user_account_type)
				{
				?>
               <div class="tab-pane" id="viewingaccess">
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Viewing Access</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="col-xs-12">
                              <table width="100%">
                                 <tr>
                                    <td width="45%" height="40">SUBS</td>
                                    <td width="10%" height="40">&nbsp;</td>
                                    <td width="45%" height="40">SUBS PERMITTED </td>
                                 </tr>
                                 <tr class="selector-access-con">
                                    <td colspan="3" width="100%">
                                       <table width="100%">
                                          <tr>
                                             <td width="45%">
                                                <div class="right-inner-addon"> <i class="glyphicon glyphicon-search"></i>
                                                   <input type="search" id="subs_left" placeholder="Search" class="form-control">
                                                </div>
                                             </td>
                                             <td width="10%" align="center">&nbsp;</td>
                                             <td width="45%">
                                                <div class="right-inner-addon"> <i class="glyphicon glyphicon-search"></i>
                                                   <input type="search" id="subs_right" placeholder="Search" class="form-control">
                                                </div>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td width="45%">
                                                <ul class='sub_list1 drag-ele'>
												<?php 
												if(isset($subcontractor_list))
												{
												for($i=0;$i<count($subcontractor_list);$i++)
												{ ?>
                                                   <li value="<?php echo $subcontractor_list[$i]['ub_user_id'];?>"><?php echo $subcontractor_list[$i]['full_name'];?></li>
                                                <?php 
												} 
												}
												?>  
                                                </ul>
												
												<input type="hidden" value="<?php echo isset($result_data['project_assigned_users'])?$result_data['project_assigned_users']:'' ?>"  id="test_ids" />
                                             </td>
                                             <td width="10%" align="center"><span id='sub_move_left' class="btn btn-blue glyphicon glyphicon-backward" aria-hidden="true"></span> <span id='sub_move_right' class="btn btn-blue glyphicon glyphicon-forward" aria-hidden="true"></span></td>
                                             <td width="45%">
                                                <ul class='sub_list2 drag-ele'>
                                                  <?php 
												  if(isset($assigned_subcontractor_list))
												{
												  for($i=0;$i<count($assigned_subcontractor_list);$i++)
												 { 
												 ?>
                                                   <li value="<?php echo $assigned_subcontractor_list[$i]['ub_user_id'];?>"><?php echo $assigned_subcontractor_list[$i]['full_name'];?></li>
                                                 <?php 
												 } 
												 }
												?>  
                                                </ul>
                                             </td>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                              </table>
                           </div>
                           <div class="col-xs-12 m-top">
                              <table width="100%">
                                 <tr>
									<td width="45%" height="40">BUILDER USERS</td>
                                    <td width="10%" height="40">&nbsp;</td>
                                    <td width="45%" height="40">BUILDER USERS PERMITTED </td>
                                 </tr>
                                 <tr class="selector-access-con">
                                    <td colspan="3" width="100%">
                                       <table width="100%">
                                          <tr>
                                             <td width="45%">
                                                <div class="right-inner-addon"> <i class="glyphicon glyphicon-search"></i>
                                                   <input type="search" id="build_left" placeholder="Search" class="form-control">
                                                </div>
                                             </td>
                                             <td width="10%" align="center">&nbsp;</td>
                                             <td width="45%">
                                                <div class="right-inner-addon"> <i class="glyphicon glyphicon-search"></i>
                                                   <input type="search" id="build_right" placeholder="Search" class="form-control">
                                                </div>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td width="45%">
                                                <ul class='build_list1 drag-ele'>
												 <?php 
												if(isset($builder_users_list))
												{
												 for($i=0;$i<count($builder_users_list);$i++)
												 { ?>
                                                   <li value="<?php echo $builder_users_list[$i]['ub_user_id'];?>"><?php echo $builder_users_list[$i]['full_name'];?>
												   <span class="pull-right">
												 <?php
													//Below code commented because we are temporarily removing role drop down
													//echo form_dropdown('ub_role_id', $roles_list_array,'', "class='form-control' id='ub_role_id'");
												 ?>
                                                      </span>
												   </li>
                                                 <?php 
												 } 
												}
												?>
                                                </ul>
                                             </td>
											 <input type="hidden" value="<?php echo isset($result_data['builder_users_roleid'])?$result_data['builder_users_roleid']:'' ?>"  id="test_roleid" />
											 <input type="hidden" value="<?php echo isset($result_data['builder_users_permitted'])?$result_data['builder_users_permitted']:'' ?>"  id="test_userid" />
                                             <td width="10%" align="center"><span id='build_move_left' class="btn btn-blue glyphicon glyphicon-backward" aria-hidden="true"></span> <span id='build_move_right' class="btn btn-blue glyphicon glyphicon-forward" aria-hidden="true"></span></td>
                                             <td width="45%">
                                                <ul class='build_list2 drag-ele'>
												 <?php 
												 if(isset($assigned_builderuser_list))
												 {
												 for($i=0;$i<count($assigned_builderuser_list);$i++)
												 { ?>
                                                   <li value="<?php echo $assigned_builderuser_list[$i]['ub_user_id'];?>"><?php echo $assigned_builderuser_list[$i]['full_name'];?>
												   <span class="pull-right">
												    <?php
													//Below code commented because we are temporarily removing role drop down
													/*$role_selected = '';
												   if(isset($project_assign_roleids[$i]['ub_role_id']))
												   {
														$role_selected = $project_assign_roleids[$i]['ub_role_id'];
												   }
													echo form_dropdown('ub_role_id', $roles_list_array,$role_selected, "class='form-control' id='ub_role_id'");
												   */?>                                                       
                                                      </span>
												   </li>
                                                 <?php
												  } 
												 }
												  ?>
                                                </ul>
                                             </td>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane" id="options">
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Other Projectsite Options</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="row panel-content five-col">
                              <!--<div class="col-xs-6">
                                 <p>&nbsp;</p>
                                 <span>Show Project Cost Summary & Running Total to Owner?</span>
                                 <input type="checkbox" id="view_cost_summary_running_total" name="view_cost_summary_running_total" <?php if(isset($result_data['view_cost_summary_running_total']) && $result_data['view_cost_summary_running_total']==='Yes') echo  "checked='checked'";?> />                               
                              </div>-->
                              <div class="col-xs-3">
                                 <label>Projectsite Prefix</label>                                 
                                    <input type="text" class="form-control" placeholder=""  id="project_prefix" value="<?php echo isset($result_data['project_prefix'])?$result_data['project_prefix']:'' ?>" name="project_prefix"/>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">PO Options</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="row panel-content five-col">
                              <div class="col-xs-3">
                                 <label>Individual PO limit</label>
                                 <div class="input-group"> <span class="input-group-addon"> <i class="glyphicon dollar"></i> </span>
                                    <input name="individual_po_limit" value="<?php echo isset($result_data['individual_po_limit'])?$result_data['individual_po_limit']:'' ?>" id="individual_po_limit" type="text" class="form-control" placeholder="Unlimited"/>
                                 </div>
                              </div>
                              <div class="col-xs-3">
                                 <label>Overall Projectsite PO limit</label>
                                 <div class="input-group"> <span class="input-group-addon"> <i class="glyphicon dollar"></i> </span>
                                    <input name="overall_po_limit" id="overall_po_limit" value="<?php echo isset($result_data['overall_po_limit'])?$result_data['overall_po_limit']:'' ?>" type="text" class="form-control" placeholder="Unlimited"/>
                                 </div>
                              </div>
                              <!--<div class="col-xs-6">
                                 <p>&nbsp;</p>
                                 <span>Show Budget and Purchase Orders to Owner</span>
                                 <input type="checkbox" name="view_budget_po" id="view_budget_po" <?php if(isset($result_data['view_budget_po']) && $result_data['view_budget_po']==='Yes') echo  "checked='checked'";?> />                                 
                              </div>-->
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Warranty Options</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="row panel-content">
                              <div class="col-xs-12"> <span>Allow Owner to Add Claims?</span>
                                 <input type="checkbox" name="owner_add_claims" id="owner_add_claims" <?php if(isset($result_data['owner_add_claims']) && $result_data['owner_add_claims']==='Yes') echo  "checked='checked'";?> />
                              </div>
							   <div class="col-xs-12 warranty_signoff"> 
									<span class="warr-claims">Allow warranty Claims to be raised </span>
									<div class="input-group">
										<input name="warranty_claims_period_signoff" id="warranty_claims_period_signoff" type="text" class="Duration" value="<?php echo isset($result_data['warranty_claims_period'])?$result_data['warranty_claims_period']:'0'; ?>">										
									</div>
									<span class="warr-sign">months after Project signoff</span>
							   </div>
                           </div>
                        </div>
                     </div>
                  </div>                  
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Selection Options</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="row panel-content">
                              <div class="col-xs-6"> <span>Include Allowances</span>
                                 <input type="checkbox" id="include_allowances" name="include_allowances" <?php if(isset($result_data['include_allowances']) && $result_data['include_allowances']==='Yes') echo  "checked='checked'";?> />
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Owner Payment Options</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="row panel-content">
                              <div class="col-xs-6"> <span>Allow Home Owner to See Payments Tab</span>
                                 <input type="checkbox" id="view_payment" name="view_payment" <?php if(isset($result_data['view_payment']) && $result_data['view_payment']==='Yes') echo  "checked='checked'";?> />
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
			   <?php 
			    }
				if(isset($this->user_account_type) && (BUILDERADMIN == $this->user_account_type || OWNER == $this->user_account_type))
				{
				?>
			   <div class="tab-pane" id="signoff">
				
				<?php 
				if(isset($this->user_account_type) && BUILDERADMIN == $this->user_account_type)
				{
				?>
					<div class="row sign_off_con">
						<div class="col-xs-12 text-center">
							<button type="button" class="btn btn-blue" id="signoff_project" data-toggle="modal" data-target="#signoff_project_modal">Sign Off This Project</button>
						</div>
						<div class="col-xs-12 text-center m-top">
							<p>By Signing off the project, you will not be able to make any actions in task, logs, bid request, schedule item, whereas you/owner(if allowed) can create warranty claims until specified time, receive payments from Owner for open Payapps and make pending payments to Subs.</p>
						</div>
					</div>
					<div class="row sign_off_documents">
					<?php
							// echo '<pre>';print_r($result_data['ub_signoff_documents_info_id']);exit;
								if(!empty($result_data['ub_signoff_documents_info_id']))
									{
										$ub_signoff_documents_info_id = explode(",",$result_data['ub_signoff_documents_info_id']);
										$total_document_count = count($ub_signoff_documents_info_id);
									}else{
										$total_document_count = 0;
									}
									// echo '<pre>';print_r($total_document_count);exit;
								if(!empty($result_data['document_name']))
									{
										$sign_off_document_name = explode(",",$result_data['document_name']);
									}
								if(!empty($result_data['comments']))
									{
										$sign_off_comments = explode(",",$result_data['comments']);
									}
								if(!empty($result_data['doc_file_id']))
									{
										$sign_off_doc_file_id = explode(",",$result_data['doc_file_id']);
									}else{
										$sign_off_doc_file_id = array(0);
									}
								if(is_array($file_array) && isset($file_array) && !empty($file_array))
								{
									// $total_file_count = count($file_array);
									if(isset($file_array[0]['messagestatus']))
									{
										$total_file_count = 0;
									}else{
									$total_file_count = count($file_array);
									}
								}else{
									$total_file_count = 0;
								}
							?>
						<div class="col-xs-12">
							<div class="pull-right">
								<button class="btn btn-blue m-left-1" type="button" onclick="add_project_signoff();" id="save_sign_off" name="save_sign_off"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_new"/> Save</button>
								<?php
								if($total_document_count != 0)
								{ 
								?>
								<button class="btn btn-blue m-left-1" type="button" onclick="change_project_signoff_status(this.id);" name="sign_off_status" id="<?php echo isset($result_data['ub_project_id'])?$result_data['ub_project_id']:'' ?>">Release for Owner Acceptance</button>
								<?php } ?>
								<button class="btn btn-gray m-left-1" type="button" id="sign_off_cancel"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</button>
							</div>
						</div>
						<div class="col-xs-12">
							<h4>Sign Off Documents</h4>
							<div class="row">
								<div class="col-xs-3"><label>Name Of Document</label></div>
								<div class="col-xs-1">&nbsp;</div>
								<div class="col-xs-3"><label>Comments</label></div>
								<div class="col-xs-3">&nbsp;</div>
							</div>
							
							
							<div class="cointainer">
							<?php
							// echo '<pre>';print_r($total_document_count);exit;
							if($total_document_count == 0)
							{
							?>
								
							<div class="content">
								<div class="row">
								<input type="hidden" name="ub_signoff_documents_info_id[]" id="ub_signoff_documents_info_id" value="<?php if(isset($ub_signoff_documents_info_id[$i])) echo $ub_signoff_documents_info_id[$i]; ?>"/>
									<div class="col-xs-3"><input type="text" name="documentname[]" id="documentname" class="form-control" /></div>
									<div class="col-xs-1">
											<div class="preview_file">
											<div class="imagePreview"></div>
											<div class="close_file"><a href="javascript:void(0);" class="close-file"><img src="<?php echo IMAGESRC.'file_close.png'; ?>"/></a></div>
											</div>
											<div class="file_name"></div>

											<div class="btn btn-blue btn-file browse"> <img border="0" class="uni_attchment_second" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Browse
											<input type="file" name="attachments[]" class="file_up"  />
											</div>
									</div>
									<div class="col-xs-3">
										<input type="text" name="comments[]" id="comments" class="form-control" />
									</div>
									<div class="col-xs-3">
										<button class="removeBtn btn btn-gray hide" type="button"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Remove</button>
									</div>
								</div>																	
							</div>
								<button class="addBtn btn btn-blue" type="button"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_new"/> Add</button>		
							
							<?php }else{ $browse_count = 1;for($i=0; $i < $total_document_count; $i++)
							 {?>
							 
									
							<div class="content">
								<div class="row"><input type="hidden" name="ub_signoff_documents_info_id[]" id="ub_signoff_documents_info_id" value="<?php if(isset($ub_signoff_documents_info_id[$i])) echo $ub_signoff_documents_info_id[$i]; ?>"/>
									<div class="col-xs-3"><input type="text" name="documentname[]" id="documentname" value="<?php if(isset($sign_off_document_name[$i])) echo $sign_off_document_name[$i]; ?>" class="form-control" /></div>
									<div class="col-xs-1">
											
											
											<?php 
											if($total_file_count != 0)
											{
											for($j=0; $j < $total_file_count; $j++)
											{ 
												$ext = pathinfo($file_array[$j]['system_file_name'], PATHINFO_EXTENSION);
												$actualdata = json_decode(DEFAULT_THUMB_IMAGE_ARRAY, true);
												if ($ext == 'tif' || $ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'tiff') 
												{
													$thumb_icon = DOC_URL.$file_array[$j]['system_file_name'];
												}
												else
												{
													if (!empty($ext)) 
													{
													$thumb_icon = $actualdata[$ext]['40'];
													}
												}
											/* if($file_array[$j]['ub_doc_file_id'] == $sign_off_doc_file_id[$i])
											{ */
											?>
											<!--<input type="text" value="klk787"> -->
												<div class="preview_file <?php if(isset($sign_off_doc_file_id[$i]) && $sign_off_doc_file_id[$i] == $file_array[$j]['ub_doc_file_id'] && isset($file_array[$j]['ui_file_name']) && !empty($file_array[$j]['ui_file_name'])) { ?>show <?php } else{ ?>hide<?php }?>">
												
												<div class="imagePreview">
												<img src="<?php if(isset($sign_off_doc_file_id[$i]) && $sign_off_doc_file_id[$i] == $file_array[$j]['ub_doc_file_id'] && isset($file_array[$j]['ui_file_name']) && !empty($file_array[$j]['ui_file_name'])) { echo $thumb_icon; } ?>" /></div>
												
												<div class="close_file"><a href="javascript:void(0);" onclick="delete_signoff_pic(<?php echo $sign_off_doc_file_id[$i]; ?>)" class="close-file"><img src="<?php echo IMAGESRC.'file_close.png'; ?>"/></a></div>
												
												<div class="file_name <?php if(isset($sign_off_doc_file_id[$i]) && $sign_off_doc_file_id[$i] == $file_array[$j]['ub_doc_file_id']) { ?>show <?php } else{ ?>hide<?php } ?>"><?php if(isset($sign_off_doc_file_id[$i]) && $sign_off_doc_file_id[$i] == $file_array[$j]['ub_doc_file_id']) { echo $file_array[$j]['ui_file_name']; } ?></div>
												<!--<input type="file" name="attachments[]" class="file_up"  />-->
												<!--<div class="btn btn-blue btn-file browse hide"> <img border="0" class="uni_attchment_second" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Browse
												<input type="file" name="attachments[]" class="file_up"  />
												</div>-->
												
											</div>
											
											<!--<?php //}else{ if($sign_off_doc_file_id[$i] == 0 && $total_file_count != 0 && (($total_file_count == 2 && $browse_count == 1) || ($total_file_count == 1 && ($browse_count == 2 || $browse_count == 1)))) { ?> -->
											<?php if(($total_file_count == 1) || ($total_file_count == 2 && $browse_count != 4))
											{?>
											<div class="btn btn-blue btn-file browse <?php if($sign_off_doc_file_id[$i] == 0 && $total_file_count != 0 && (($total_file_count == 2 && ($browse_count == 3 || $browse_count == 5)) || ($total_file_count == 1 && ($browse_count == 1 || $browse_count == 2 || $browse_count == 3)))) { ?> show <?php } else{ ?>hide<?php }?>"> 
											<img border="0" class="uni_attchment_second" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Browse
											<input type="file" name="attachments[]" class="file_up"  />
											</div>
											<?php //echo $browse_count;echo $total_file_count; ?>
											<?php $browse_count++;/* }} */ } } } ?>
											<?php if($total_file_count == 0) { ?>
											<div class="btn btn-blue btn-file browse"> <img border="0" class="uni_attchment_second" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Browse
											<input type="file" name="attachments[]" class="file_up"  />
											</div>
											<div class="preview_file">
											<div class="imagePreview"></div>
											<div class="close_file"><a href="javascript:void(0);" class="close-file"><img src="<?php echo IMAGESRC.'file_close.png'; ?>"/></a></div>
											</div>
											<div class="file_name"></div>
											<?php } ?>
											
											
									</div>
									<div class="col-xs-3">
										<input type="text" name="comments[]" id="comments" value="<?php if(isset($sign_off_comments[$i])) echo $sign_off_comments[$i]; ?>"  class="form-control" />
									</div>
									<div class="col-xs-3">
										<button class="removeBtn btn btn-gray<?php if($total_document_count > 0){ ?>show<?php }else{?> hide<?php }?>" type="button"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Remove</button>
									</div>
								</div>																	
							</div>		
							
							<?php }?>
							<?php if($total_document_count < 3) { ?>
							<button class="addBtn btn btn-blue" type="button"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_approved"/> Add</button>
							<?php
							} } ?>
							</div>
							
						</div>
					</div>
					<div class="row save_sign_off_list">
						<div class="col-xs-12">
							<h4>Sign Off Documents <a href="javascript:void(0);" id="sign_off_edit"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_edit"/></a></h4>
							<table class="table table-stribbed">								
								<thead>
									<tr>
										<th>Document Name</th>
										<th>Comments</th>
									</tr>
								</thead>	
								<?php 
								if($total_document_count != 0)
								{
								for($i=0; $i < $total_document_count; $i++)
								{
								?>								
								<tbody>
									<tr>
										<td><?php if(isset($sign_off_document_name[$i])) echo $sign_off_document_name[$i]; ?></td>
										<td><?php if(isset($sign_off_comments[$i])) echo $sign_off_comments[$i]; ?></td>
									</tr>
								</tbody>
								<?php } }?>
							</table>
						</div>
						<div class="col-xs-12">
							<div class="row">
								<div class="col-xs-4">
									<label>Owner Approval: <?php if(isset($result_data['signoff_status'])) {echo $result_data['signoff_status'];} else{ echo 'Not released for owner acceptance'; } ?></label>
								</div>
								<?php if(!isset($result_data['signoff_status']) && $result_data['signoff_status'] != 'sign_off_approve_by_builder' && $result_data['signoff_status'] != 'owner_approved')
								{
								?>
								<div class="col-xs-3">
									<button class="btn btn-blue" type="button" id="<?php echo isset($result_data['ub_project_id'])?$result_data['ub_project_id']:'' ?>" name="sign_off_approve_by_builder" onclick="sign_off_approve_by_builders(this.id);">Override and Signoff</button>
								</div>
								<?php } ?>
								<div class="col-xs-3">
									<button class="btn btn-blue" type="button" id="sign_off_cancel" name="sign_off_cancel" onclick="sign_off_cancels();">cancel</button>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<label>Owner Signature: </label>
								</div>
							</div>
						</div>
					</div>
			   <?php 
			    }
				if(isset($this->user_account_type) && OWNER == $this->user_account_type)
				{
				?>
					<form method="post" id="signoff_owner" name="signoff_owner" class="signoff_owner">
					<div class="row owner_sign_off_list">
					<?php
							// echo '<pre>';print_r($result_data['ub_signoff_documents_info_id']);exit;
								if(!empty($result_data['ub_signoff_documents_info_id']))
									{
										$ub_signoff_documents_info_id = explode(",",$result_data['ub_signoff_documents_info_id']);
										$total_document_count = count($ub_signoff_documents_info_id);
									}else{
										$total_document_count = 0;
									}
								if(!empty($result_data['document_name']))
									{
										$sign_off_document_name = explode(",",$result_data['document_name']);
									}
								if(!empty($result_data['comments']))
									{
										$sign_off_comments = explode(",",$result_data['comments']);
									}
								if(!empty($result_data['doc_file_id']))
									{
										$sign_off_doc_file_id = explode(",",$result_data['doc_file_id']);
									}else{
										$sign_off_doc_file_id = array(0);
									}
								if(is_array($file_array) && isset($file_array) && !empty($file_array))
								{
									// $total_file_count = count($file_array);
									if(isset($file_array[0]['messagestatus']))
									{
										$total_file_count = 0;
									}else{
									$total_file_count = count($file_array);
									}
								}else{
									$total_file_count = 0;
								}
							?>
						<div class="col-xs-12">
							<h4>Sign Off Documents</h4>
							<input type="hidden" id="sign_off_ub_project_id" name="sign_off_ub_project_id" value="<?php if(isset($result_data['ub_project_id'])) echo $result_data['ub_project_id']; ?>" ?>
							<table class="table table-stribbed">	
								<?php
									/*  echo '<pre>';print_r($sign_off_doc_file_id);
									  echo '<pre>';print_r($file_array); */
									   if(isset($result_data['signature_file_id']) && !empty($result_data['signature_file_id']) && $result_data['signature_file_id'] != 0)
									   {
											$trade_file_id = array_column($file_array, 'ub_doc_file_id'); 
										    while ($match_value = current($trade_file_id)) {
											if ($match_value == $result_data['signature_file_id']) {
												$file_key = key($trade_file_id);
											}
											next($trade_file_id);
											}
										
										$ext = pathinfo($file_array[$file_key]['ui_file_name'], PATHINFO_EXTENSION);
										$actualdata = json_decode(DEFAULT_THUMB_IMAGE_ARRAY, true);
										if ($ext == 'tif' || $ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'tiff') 
										{
											$thumb_icon = DOC_URL.$file_array[$file_key]['ui_file_name'];
										}
										else
										{
											if (!empty($ext)) 
											{
											$thumb_icon = $actualdata[$ext]['40'];
											}
										}
										}else{
											$file_key ='';
										}
									   ?>
								<thead>
									<tr>
										<th>Document Name</th>
										<th>Comments</th>
									</tr>
								</thead>
								<?php 
								if($total_document_count != 0)
								{
								for($i=0; $i < $total_document_count; $i++)
								{
							 ?>
								<tbody>
									<tr>
										<td><?php if(isset($sign_off_document_name[$i])) echo $sign_off_document_name[$i]; ?> </td>
										<td><?php if(isset($sign_off_comments[$i])) echo $sign_off_comments[$i]; ?></td>
									</tr>
								</tbody>
								<?php } }?>
							</table>
						</div>
						<div class="col-xs-12">						
							<p><input type="checkbox" name="signoff"/> I read all the above documents and accept the terms and conditions</p>
						</div>
						<div class="col-xs-12">
							<div class="row">
								<div class="col-xs-4">
									<label>Owner Approval: <?php echo $result_data['signoff_status']; ?></label>
								</div>								
							</div>
							<div class="row">
								<div class="col-xs-4">
																			
										<div class="sigPad">
										<div class="sig sigWrapper">
											<div class="typed"></div>
											<canvas class="pad" width="300" height="200"></canvas>
											<input type="hidden" name="output" class="output" value='<?php if(isset($result_data['signature_content'])) echo $result_data['signature_content'];?>'>
										</div>
										<ul class="sigNav">											
											<li class="clearButton"><a href="#clear" class="btn btn-gray"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Clear</a></li>
										</ul>
										<?php if((isset($result_data['signoff_status']) && $result_data['signoff_status'] != 'owner_approved' && $result_data['signoff_status'] != 'sign_off_approve_by_builder') || (!isset($result_data['signoff_status'])))
										{
										?>
										<button class="btn btn-blue pull-right appr_sign" type="button" id="owner_sign_off_approve" name="owner_sign_off_approve" onclick="owner_sign_off_approval();"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_approved"/> Approve</button>
										<?php } ?>
										
										<div class="row appr_browse">
										
										<div class="preview_file <?php if(isset($file_array[$file_key]['ui_file_name']) && !empty($file_array[$file_key]['ui_file_name']))
										{ ?>show <?php } else{ ?>hide<?php } ?>">
											<div class="imagePreview">
											<img src="<?php if(isset($file_array[$file_key]['ui_file_name']) && !empty($file_array[$file_key]['ui_file_name'])) { echo $thumb_icon; } ?>" />
											</div>
											<?php if(isset($result_data['signoff_status']) && $result_data['signoff_status'] != 'owner_approved')
											{
											?>
											<div class="close_file <?php if(isset($file_array[$file_key]['ui_file_name']) && !empty($file_array[$file_key]['ui_file_name']))
										{ ?>show <?php } else{ ?>hide<?php } ?>"><a href="javascript:void(0);" class="close-file"><img src="<?php echo IMAGESRC.'file_close.png'; ?>"/></a></div>
										<?php } ?>
											</div>
											<div class="file_name"><?php if(isset($file_array[$file_key]['ui_file_name']) && !empty($file_array[$file_key]['ui_file_name']) && $result_data['signature_file_id'] != 0) { echo $file_array[$file_key]['ui_file_name']; }
										 ?></div>
										<div class="btn btn-blue btn-file browse <?php if(isset($file_array[$file_key]['ui_file_name']) && !empty($file_array[$file_key]['ui_file_name']))
										{ ?>hide <?php } else{ ?>show<?php } ?>"> <img border="0" class="uni_attchment_second" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Browse
											<input type="file" name="attachments[]" class="file_up"  />
											</div>
										</div>
										
										</div>
								</div>
							</div>
						</div>
					</div>
					</form>
				
				 <?php 
			    }
			   ?>
			   </div>
			   <?php 
			    }
			   ?>
            </div>
         </div>
      </div>
   </div>
</div>
<?php 
if(isset($this->user_account_type) && BUILDERADMIN == $this->user_account_type)
{
?>
</form>
<?php }?>
<!-- Type Add Modal -->
<div class="modal fade" id="TypeAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>New Project Group
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
                                 <td><input type="text" id="new_project_group" class="form-control" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" id="project_group_save" class="btn btn-default btn-secondary pull-right">Save</button></td>
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
         <h4>Edit / Delete
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
                                    <!--<button type="button" id="Edit_project" class="btn btn-default btn-secondary pull-right" >Save</button>-->
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
<!-- Type Map Modal -->
<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Find a Location
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <div id="mapCanvas"></div>
                           <div id="infoPanel" class="hide">
                              <div id="markerStatus"><i>Click and drag the marker.</i></div>
                              <div id="info"></div>
                           </div>
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
				<button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> CANCEL</button>  
				<button class="btn btn-blue m-left-1 pull-right" type="button" id="delete_confirm"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_approved"/> OK</button>				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
<div class="modal fade" id="create_template_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form id="save_project_template" class="form-horizontal" method="post" name="save_project_template">
   <input type="hidden" name="project_id" id="project_id" 
     value="<?php echo isset($result_data['ub_project_id'])?$result_data['ub_project_id']:'' ?>" />
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Create a template with this project information
      </h4>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <div class="modal-con col-xs-12"> 
			<div class="row m-top">
			  <div class="col-xs-12 error-message1 uni_message">
				 <div class="alerts alert-danger"></div>
			   </div>
			</div>			
              <div class="col-xs-12">
				<div class="row m-top">
				<div class="col-xs-3">Template Name</div> 
				<div class="col-xs-6">
					<div class="col-xs-12">
						<div class="form-group">
							<input type="text" name="template_name" id="template_name" class="form-control"/>
						</div>		
					</div>		
				</div>		
				</div>
					<table width="100%" class="row col-xs-12">

						<tr>
							<td colspan="2" class="col-xs-12" height="40"><p class="m-top">Select this Information to be copied</p></td>
						</tr>
                  <?php foreach($template_modules_array as $key=>$module_name) { ?>
                   <tr>
                     <td class="col-xs-1" height="40"><input type="checkbox" name="<?php echo $module_name['varchar01'] ?>" id="" /></td>
                     <td class="col-xs-10"><?php echo $module_name['varchar01'] ?></td>
                   </tr>
                  <?php } ?>
						
					</table>
			  </div>
              <div class="row col-xs-12 m-top">			  
				<button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> CANCEL</button>  
				<button class="btn btn-blue m-left-1 pull-right" type="submit" id="create_template"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_create_template"/> Create Template</button>				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
</form> 
</div>
<div class="modal fade" id="create_template_modal_success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">      
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
            <div class="modal-con col-xs-12">              
              <div class="row col-xs-12 text-center">                				
				<h5>Template has been created</h5>
				<button class="btn btn-blue" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_approved"/> OK</button>				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
<div class="modal fade" id="signoff_project_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">      
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
            <div class="modal-con col-xs-12">              
              <div class="row col-xs-12 text-center">                				
				<p class="text-left">By Signing off the project, you will not be able to make any actions in task, logs, bid request, schedule item, whereas you/owner(if allowed) can create warranty claims until specified time, receive payments from Owner for open Payapps and make pending payments to Subs. Are you sure to proceed signing off with this project.</p>

				<p class="text-left">You have <?php echo $punch_list_data; ?> Punch list(s) Open.</p>
				<button class="btn btn-blue" type="button" id="Signoff_approved"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_approved"/> Signoff</button>	
				<button class="btn btn-gray" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</button>				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
<script type="text/javascript">        
   this.signature_text   = '<?php echo isset($result_data["signature_content"])?$result_data["signature_content"]:""; ?>';      
</script>
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.signaturepad.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'jquery.signaturepad.js';?>"></script> 

<script type="text/javascript" src="<?php echo JSSRC.'custom_map.js';?>"></script> 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<link rel="stylesheet" href="http://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-tagsinput.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script> 
 
<script type="text/javascript" src="<?php echo JSSRC.'save_project.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'json2.min.js';?>"></script>