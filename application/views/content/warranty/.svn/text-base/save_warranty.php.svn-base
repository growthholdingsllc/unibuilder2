<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?> 
      <!--<li class="active">Warranty</li>-->
   </ol>
</div>
<form id="add_new_warranty" class="form-horizontal" method="post" name="add_new_warranty">
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
         <div class="pull-right ">
            <div class="action-btn">
				<button class="btn btn-gray pull-right m-left-1" type="button" id="uni_cancel"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</button>
				<!--checking role access // by satheesh kumar -->
				<?php
				if(isset($this->user_role_access[strtolower('warranty')][strtolower('delete')]) && $this->user_role_access[strtolower('warranty')][strtolower('delete')] == 1)
				{
				if(isset($warranty_data['ub_warranty_claim_id']))
					{
						if(isset($this->project_status) && $this->project_status != 'Closed' && $this->project_status != 'Disabled')
						{
					?>
					<button type="button" class="btn btn-blue pull-right m-left-1" id="<?php if(isset($warranty_data['ub_warranty_claim_id'])) echo $warranty_data['ub_warranty_claim_id']; ?>" onclick="delete_warranty(this.id)">
					<img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Delete" class="uni_delete">
					Delete</button>
				<?php
						}
					}
				?>
        <?php 
         if(isset($warranty_data['ub_warranty_claim_id']))
         {
        ?>
				<a href="<?php echo base_url().$this->crypt->encrypt('prints/warranty_print/'.$warranty_data['ub_warranty_claim_id'].'/'.$warranty_data['project_id']);?>" target="_blank"><button type="button" class="btn btn-blue pull-right m-left-1"><img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Print" class="uni_print">	Print</button></a>
				<?php
				} }
				if(isset($this->user_role_access[strtolower('warranty')][strtolower('edit')]) && $this->user_role_access[strtolower('warranty')][strtolower('edit')] == 1 && $this->first_argument > 0)
				{
					if(isset($this->project_status) && $this->project_status != 'Closed' && $this->project_status != 'Disabled')
					{
						/* Below condition was added by chandru */
						if(TRUE == $warranty_max_claims_period && $this->user_account_type != OWNER)
						{
				?>
			    <button class="btn btn-blue pull-right m-left-1" type="submit" id="uni_save_and_back"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back</button>			   
			    <button class="btn btn-blue pull-right m-left-1" type="submit" id="uni_save_and_new"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/>  Save &amp; New</button>                
			   <button class="btn btn-blue pull-right m-left-1" type="submit" id="uni_save_and_stay"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>               
			   <?php
					}}
				}
				else if((isset($this->user_role_access[strtolower('warranty')][strtolower('add')]) && $this->user_role_access[strtolower('warranty')][strtolower('add')] == 1) && $this->first_argument == 0)
				{ 
				/* Below condition was added by chandru */
				if(TRUE == $warranty_max_claims_period)
				{
				?>
				<button class="btn btn-blue pull-right m-left-1" type="submit" id="uni_save_and_back"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back</button>			   
			    <button class="btn btn-blue pull-right m-left-1" type="submit" id="uni_save_and_new"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/>  Save &amp; New</button>                
			   <button class="btn btn-blue pull-right m-left-1" type="submit" id="uni_save_and_stay"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>    
				<?php
				}}
				?>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="row m-top">
  <div class="col-xs-12 error-message uni_message">
     <div class="alerts alert-danger"></div>
   </div>
</div>

<div class="row m-top">
   <div class="col-xs-12 <?php if($this->project_id == '' && !isset($warranty_data['project_id'])){ echo 'no_project_selected'; } ?>">
      <div class="tab-con pull-left">
         <div role="tabpanel">
            <!-- Nav tabs -->
            <input type="hidden" id="current_tab" value="" />
            <ul class="nav nav-tabs" role="tablist" id="<?php if($this->user_account_type == BUILDERADMIN && isset($this->user_role_access[strtolower('warranty')][strtolower('edit')]) && $this->user_role_access[strtolower('warranty')][strtolower('edit')] == 1){ if(isset($this->project_status) && $this->project_status != 'Closed' && $this->project_status != 'Disabled'){echo 'warrantyinfotab';}}else{ echo ''; }?>">
               <li role="presentation" class="active">
                  <a href="#Basic-Info" aria-controls="Basic-Info" data-toggle="tab" class="warranty-tab" id="Basic-tab">Basic Info</a>
               </li>

               <input type="hidden" name="sub_accept" id="sub_accept" value="<?php echo (isset($appoinment_data['sub_accept_appoinment'])?$appoinment_data['sub_accept_appoinment']:'') ?>">
                                 

               <input type="hidden" name="owner_accept" id="owner_accept" value="<?php echo (isset($appoinment_data['owner_accept_appoinment'])?$appoinment_data['owner_accept_appoinment']:'') ?>">
			   <!--checking role access // by satheesh kumar -->
			   <?php 
			   if((isset($warranty_data['show_owner']) && $warranty_data['show_owner'] != 'No')||$this->user_account_type != OWNER)
			   {
			   ?>
               <li role="presentation">
                  <a href="#Assigned-Info" aria-controls="Assigned-Info" data-toggle="tab" id="Assigned-tab" class="warranty-tab">Assigned Info</a>
               </li>
			    <!--checking role access // by satheesh kumar -->
			   <?php 
			   }
			   if($this->user_account_type == OWNER || (isset($appoinment_data['sub_accept_appoinment']) && ($appoinment_data['sub_accept_appoinment']==='Acceptance Pending' || $appoinment_data['sub_accept_appoinment']==='Reschedule' || $appoinment_data['sub_accept_appoinment']==='Accepted') && $this->user_account_type == SUBCONTRACTOR) || $this->user_account_type == BUILDERADMIN)
			   {
			   ?>
               <li role="presentation">
                  <a href="#Appointments" aria-controls="Appointments" data-toggle="tab" id="Appointments-tab">Appointments</a>
               </li>
			   <?php 
			   }
			   ?>
               <li role="presentation">
                  <a href="#Files-Pictures" aria-controls="Files-Pictures" data-toggle="tab" id="Files-Pictures-tab">Files &amp; Pictures</a>
               </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane active" id="Basic-Info">
                  <div class="row">
                     <div class="col-xs-3">
                       <!--  <label>Project</label> -->
                        <input type="hidden" name="ub_warranty_claim_id" id="ub_warranty_claim_id" value="<?php echo (isset($warranty_data['ub_warranty_claim_id']) && $warranty_data['ub_warranty_claim_id'] > 0)?$this->ci_object->ci_encrypt($warranty_data['ub_warranty_claim_id'], $this->encrypt_key):0 ?>" />
						
                        <input type="hidden" name="warranty_claim_id" id="warranty_claim_id" value="<?php echo (isset($warranty_data['ub_warranty_claim_id']) && $warranty_data['ub_warranty_claim_id'] > 0)?$warranty_data['ub_warranty_claim_id']:0 ?>" />
						  <p>&nbsp;</p>
						   <?php 
                           if(!empty($this->project_id) && !isset($warranty_data['project_id']))
                           {
                             echo '<label>Project Name</label> : '.$this->project_name;       
                             echo '<input type="hidden" name="project_id" id="project_id" value="'.$this->project_id.'" />';
                           }
                           else if(isset($warranty_data['project_id']))
                           {
                             echo '<label>Project Name</label> : '.$project_list[$warranty_data['project_id']];        
                             echo '<input type="hidden" name="project_id" id="project_id" value="'.$warranty_data['project_id'].'" />';
                           }
                         ?>
                     </div>
					 <?php if(isset($warranty_data['ub_warranty_claim_id'])){ ?>
              				 <div class="col-xs-3">
              				 <p>&nbsp;</p>
                        <label>Added By:</label><?php if(isset($warranty_data['account_type']) && $warranty_data['account_type'] == OWNER){ ?> <span> Owner</span><?php } else if(isset($warranty_data['account_type']) && $warranty_data['account_type'] == BUILDERADMIN){ ?><span> Builder</span><?php } ?>
                            </div>
					<?php } ?>
                  </div>
                  <div class="row m-top">
                     <div class="col-xs-4">
                        <label>Title</label>
						<div class="col-xs-12">
							<div class="form-group">
							<input type="text" class="form-control" name="title" value="<?php if(isset($warranty_data['title'])) echo $warranty_data['title'];?>" id="title" />
							</div>
						</div>
                     </div>
                     <div class="col-xs-4">
                        <label>Category</label>
                        <div class="col-xs">
                           <?php 
                            if(isset($warranty_data['category']))
                            {
                              $selected_category = $warranty_data['category'];
                              $selected_category = explode(",",$warranty_data['category']);
                              echo form_dropdown('category[]', $category_array, $selected_category, "class='selectpicker form-control2' id='category' data-live-search='true' multiple"); 
                            }
                            else
                            {
                             echo form_dropdown('category[]', $category_array, '', "class='selectpicker form-control2' id='category' data-live-search='true' multiple");
                            }
                          ?>

                          <?php if($this->user_account_type != SUBCONTRACTOR && $this->user_account_type != OWNER){ ?>
                           <span class="right-group input-group-addon">

                           <a href="javascript:void(0);" data-target="#TypeAddModal" data-toggle="modal">
                           <img alt="plus" src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>" border="0"/>
                           </a> 
                           <a href="javascript:void(0);" class="TypeEditModal">
                           <img alt="minus" src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>" border="0"/>
                           </a>
                           </span> 
                           <?php } ?>

                        </div>
                     </div>
                     <div class="col-xs-4">
                        <label>Priority</label>
                        <?php 
                         $priority_selected = '';
                            if(isset($warranty_data['priority']))
                            {
                              $selected_priority = $warranty_data['priority'];
                              echo form_dropdown('priority', $priority_array, $selected_priority, "class='selectpicker form-control' id='priority' data-live-search='true'"); 
                            }
                            else
                            {
                             echo form_dropdown('priority', $priority_array, $priority_selected, "class='selectpicker form-control' id='priority' data-live-search='true'");
                            }
                          ?>
                     </div>
                  </div>
                  <div class="row m-top">
                     <div class="col-xs-12">
                        <label>Description of Problem</label>
                        <textarea class="form-control" name="problem_description"><?php if(isset($warranty_data['problem_description'])) echo $warranty_data['problem_description'];?></textarea>
                     </div>
                  </div>
					<?php 
					if(isset($this->user_account_type) && $this->user_account_type != OWNER && $this->user_account_type != SUBCONTRACTOR)
					{
					?>
                  <div class="row m-top">
                     <div class="col-xs-12">
                        <label>Internal Comments</label>
                        <textarea class="form-control" name="internal_comments"><?php if(isset($warranty_data['internal_comments'])) echo $warranty_data['internal_comments'];?></textarea>
                     </div>
                  </div>
				  <?php 
				  }
				  ?>
				   <?php 
				  //code added by satheesh kumar
				  if (isset($custom_field_data) && !empty($custom_field_data)) 
				  { 
				  ?>
				  <div class="panel panel-default m-top">
                     <div id="filter" role="tab" class="panel-heading">
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
			   <!--checking role access // by satheesh kumar -->
			    <?php 
			    if((isset($warranty_data['show_owner']) && $warranty_data['show_owner'] != 'No')||$this->user_account_type != OWNER)
				{
			   ?>
               <div class="tab-pane" id="Assigned-Info">
                  <div class="row">
                     <div class="col-xs-3">
                        <!-- Service Coordinator -->
                        <div id="load_service_coordinator_div">
							            <?php $this->load->view('content/warranty/builder_user_dropdown'); ?>
						            </div>
                     </div>
                     <div class="col-xs-3">
                        <label>Classification</label>
                         <?php 
                            if(isset($warranty_data['classification']))
                            {
                              $selected_classification =$warranty_data['classification'];
                              echo form_dropdown('classification', $classification_array, $selected_classification, "class='selectpicker form-control' id='tags' data-live-search='true'"); 
                            }
                            else
                            {
                             echo form_dropdown('classification', $classification_array, '', "class='selectpicker form-control' id='classification' data-live-search='true'");
                            }
                          ?>
                     </div>
                     <div class="col-xs-3">
                        <!-- Orig. Item/User -->
                        <div id="load_service_coordinator_div">
                        <?php $this->load->view('content/warranty/subcontractor_dropdown'); ?>
                        </div>
                     </div>
                     <div class="col-xs-3">
                        <p>&nbsp;</p>
                        <p>Show Owner? <input type="checkbox" name="show_owner" <?php if(isset($warranty_data['show_owner']) && $warranty_data['show_owner']==='Yes') echo  "checked='checked'";?> /></p>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xs-3">
                        <label>Added Cost</label>
                        <div class="input-group"> 
                           <span class="input-group-addon"> <i class="glyphicon dollar"></i> </span>
                           <input type="text" class="form-control" id="added_cost" name="added_cost" value="<?php if(isset($warranty_data['added_cost'])) echo $warranty_data['added_cost'];?>" />
                        </div>
                     </div>
                     <div class="col-xs-3">
                        <label>Follow-Up Date</label>
                        <div id="datetimepicker5" class="input-group date">
                           <input type="text" class="form-control"  id="projected_start_date" name="follow_up_date" value="<?php if(isset($warranty_data['follow_up_date'])) echo date("m/d/Y", strtotime($warranty_data['follow_up_date']));?>">
                           <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                        </div>
                     </div>
                  </div>
               </div>
			   <?php 
			   }
			   ?>
			   <!--checking role access // by satheesh kumar -->
			   <?php 
			   if($this->user_account_type == OWNER || (isset($appoinment_data['sub_accept_appoinment']) && ($appoinment_data['sub_accept_appoinment']=='Acceptance Pending' || $appoinment_data['sub_accept_appoinment']=='Reschedule' || $appoinment_data['sub_accept_appoinment']=='Accepted') && $this->user_account_type == SUBCONTRACTOR) || $this->user_account_type == BUILDERADMIN)
			   {
			   ?>
               <div class="tab-pane" id="Appointments">
                  <div class="row">
                     <div class="col-xs-12">
                        <div class="pull-left">
                           <div class="action-btn">
                            <?php if($this->user_account_type == BUILDERADMIN){ ?>
                              <a href="javascript:void(0);" id="schedule_service" class="sprite">
                              <img class="uni_new" src="<?php echo IMAGESRC.'strip.gif'; ?>">
                              Schedule Service Appoinment
                              </a>
                              <?php } ?>
							  <?php 
							  if(isset($this->user_account_type) && $this->user_account_type != SUBCONTRACTOR)
							  {
							  ?>     
								<!-- <button id="appoinment_cancel" class="btn btn-gray pull-right m-left-1 schedule_cancel" type="button">
								<img class="uni_cancel_new" src="<?php echo IMAGESRC.'strip.gif'; ?>">	Cancel</button>  -->
								<?php 
								if(isset($this->project_status) && $this->project_status != 'Closed' && $this->project_status != 'Disabled')
								{
								?>
                <?php if($this->user_account_type == BUILDERADMIN){ ?>
								<button id="appoinment_save" class="btn btn-blue pull-right m-left-1 schedule_save" name="save_details" type="submit">
								<img class="uni_save_new" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Save</button>
                <?php }else{ ?>
                <?php if($this->user_account_type == OWNER && isset($appoinment_data['owner_accept_appoinment']) && $appoinment_data['owner_accept_appoinment']==='Accepted'){ ?>
                <?php //if(isset($appoinment_data['owner_accept_appoinment']) && $appoinment_data['owner_accept_appoinment']!='Acceptance Pending'){ ?>

                  <button id="appoinment_save" class="btn btn-blue pull-right m-left-1 schedule_save" name="save_details" type="submit">
                <img class="uni_save_new" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Save</button>

                <?php //} ?>
                <?php } ?>
                <?php } ?>
								<?php 
								}
								?>
							  <?php 
							  }
							  ?>                
                           </div>
                        </div>
                     </div>
                  </div>
                  <input type="hidden" name="ub_warranty_claim_appointments_id" id="ub_warranty_claim_appointments_id" value="<?php if(isset($warranty_data['ub_warranty_claim_appointments_id']) && $warranty_data['ub_warranty_claim_appointments_id'] > 0) echo $warranty_data['ub_warranty_claim_appointments_id']; ?>"/>
				  <?php if(isset($this->user_account_type) && ($this->user_account_type == SUBCONTRACTOR || $this->user_account_type == OWNER)){ 
				  ?>
					<div class="row m-top">
						<div class="col-xs-12 service-con">
							<div class="curve-box">
								<div class="row">
									<div class="col-xs-12">
										<div class="col-xs-3">
											<p><strong>Servicing Sub:</strong> <span class="move-left"><?php echo isset($appoinment_data['subcontractor_name'])?$appoinment_data['subcontractor_name']:'' ?></span></p>
										</div>
										<div class="col-xs-3">
                      <?php
                      $from_time = '';
                      $to_time = '';
                      $to = '';
                      ?>
                      <?php if(isset($appoinment_data['service_from_time']))
                      {
                        $from_time = $appoinment_data['service_from_time'];
                      }?>
                      <?php if(isset($appoinment_data['service_to_time']))
                      {
                        $to_time = $appoinment_data['service_to_time'];
                        $to = 'to';
                      }?>
											<p><strong>Servicing on:</strong> <span class="move-left"><?php 
											echo isset($appoinment_data['service_date'])? date("d/m/Y", strtotime($appoinment_data['service_date'])).' '.$from_time.' '.$to.' '.$to_time:''; 
											?></span></p>
										</div>
									</div>
								</div>
								<div class="row m-top">
									<div class="col-xs-12">
										<div class="col-xs-12">
											<h4>Appointment Confirmation</h4>
										</div>
										<?php 
										if((isset($appoinment_data['owner_accept_appoinment']) && $this->user_account_type == OWNER && $appoinment_data['owner_accept_appoinment'] != 'Accepted' && $appoinment_data['owner_accept_appoinment'] != 'Reschedule'  && $appoinment_data['owner_accept_appoinment'] == 'Acceptance Pending') || (isset($appoinment_data['sub_accept_appoinment']) && ($appoinment_data['sub_accept_appoinment']!='Reschedule' && $appoinment_data['sub_accept_appoinment']!='Accepted' && $appoinment_data['sub_accept_appoinment']=='Acceptance Pending') && $this->user_account_type == SUBCONTRACTOR))
										{
										?>
										<div class="col-xs-3">
											<p>&nbsp;</p>
											<input type="hidden" name="appoinment_status" id="appoinment_status">

											<button type="submit" id="appoinment_confirm" class="btn btn-blue pull-left m-left-1"> Confirm</button>
											<button type="submit" id="appoinment_reschedule" class="btn btn-blue pull-left m-left-1"> Request to Reschedule</button>

										</div>
										<div class="col-xs-3">
											<p>Prefered</p>
											<div class="col-xs-12">
											<div class="form-group">
											<div id="datetimepicker6" class="input-group date">
											<input type="text" class="form-control" id="prefered_date" name="prefered_date" value="">
											<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
											</div>
											</div>
											</div>
										</div>
										<div class="col-xs-3">
										<p>&nbsp;</p>
										    <div class="col-xs-12">
											<div class="form-group">
											<div id="schedule-time" class="input-group date">
											<input type="text" class="form-control" id="prefered_time" name="prefered_time" value="">
											<span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span> 
											</div>
											</div>
											</div>
										</div>
										<?php 
										}
										else if($this->user_account_type == OWNER && isset($appoinment_data['owner_accept_appoinment']) && $appoinment_data['owner_accept_appoinment'] != 'Not Required')
										{
											if(isset($appoinment_data['owner_accept_appoinment']) && $appoinment_data['owner_accept_appoinment'] == 'Accepted')
											{
										?>
										<div class="col-xs-6">
											<p>Appointment was confirmed <?php if(isset($appoinment_data['owner_preferred_datetime'])){ echo 'at'; }?> <?php echo $appoinment_data['owner_preferred_datetime'];?></p>
										</div>	
										<?php 
											}
											else
											{
											?>
										<div class="col-xs-6">
											<p>Reschedule Request has been made at <?php echo $appoinment_data['owner_preferred_datetime'];?></p>
										</div>		
										<?php	
											}
										}
										else if($this->user_account_type == SUBCONTRACTOR && isset($appoinment_data['sub_accept_appoinment']) && $appoinment_data['sub_accept_appoinment'] != 'Not Required')
										{
											if(isset($appoinment_data['sub_accept_appoinment']) && $appoinment_data['sub_accept_appoinment'] == 'Accepted')
											{
										?>
										<div class="col-xs-6">
											<p>Appointment was confirmed <?php if(isset($appoinment_data['sub_preferred_datetime'])){ echo 'at'; }?> <?php echo $appoinment_data['sub_preferred_datetime'];?></p>
										</div>	
										<?php 
											}
											else
											{
											?>
										<div class="col-xs-6">
											<p>Reschedule Request has been made at <?php echo $appoinment_data['sub_preferred_datetime'];?></p>
										</div>		
										<?php	
											}
										}
										?>
									</div>
								</div>
							</div>
						</div>
						<?php if(isset($appoinment_data['owner_accept_appoinment']) && $this->user_account_type == OWNER && $appoinment_data['owner_accept_appoinment']==='Accepted'){ 
						?>
						<div class="col-xs-12 service-con ">
                        <div class="curve-box">
                           <div class="row">
                              <div class="col-xs-12">
                                 <div class="col-xs-6">
                                    <h4>Final Work Approval</h4>
                                 </div>
                              </div>
                              <div class="col-xs-12">
                                 <div class="col-xs-4">
                                    <label>Feedback</label>
                                    <?php 
                                     $feedback_selected = '';
                                    if(isset($appoinment_data['status']))
                                      {
                                        $selected_status = $appoinment_data['status'];
                                        echo form_dropdown('status', $feedback_array, $selected_status, "class='selectpicker form-control' id='feedback' data-live-search='true'"); 
                                    }
                                    else
                                    {
                                      echo form_dropdown('status', $feedback_array, $feedback_selected, "class='selectpicker form-control' id='feedback' data-live-search='true'");
                                    }
                                    ?>
                                 </div>                                 
                                 <div class="col-xs-4">
                                    <label>Approval Comments</label>
                                    <textarea class="form-control" name="approval_comments"><?php if(isset($appoinment_data['approval_comments'])) echo $appoinment_data['approval_comments'];?></textarea>
                                 </div>
                              </div>
                              <div class="col-xs-12">
                                 <div class="col-xs-4">
                                    <label>Completion Date</label>
                                    <div id="datetimepicker12" class="input-group date">
									   <input type="text" class="form-control" id="projected_start_date" name="completion_date" value="<?php if(isset($appoinment_data['completion_date'])) echo date("m/d/Y", strtotime($appoinment_data['completion_date']));?>">
									   <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
									</div>
                                 </div>
                                 <div class="col-xs-4">
                                    <label>Feedback Left On</label>
                                    <p><?php if(isset($appoinment_data['completion_date'])) echo date("m/d/Y", strtotime($appoinment_data['completion_date']));?></p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
					 <?php 
					 }
					 ?>
					</div>
				  <?php } else {?>
                  <div class="row m-top">
                     <div class="col-xs-12 service-con">
                        <div class="curve-box">
                           <div class="row">
                              <div class="col-xs-12">
                                 <div class="col-xs-4">
                                   <div id="load_service_coordinator_div">                                     
									<?php //$this->load->view('content/warranty/servicing_sub_dropdown'); ?>
                                      <label>Servicing Sub</label>
                                         <div class="col-xs-12">
                                           <div class="form-group">
                                             <?php 
                                              if(!empty($servicing_sub_list))
                                              {
                                               $users_selected = '';
                                               if(isset($appoinment_data['subcontractor_id']))
                                               {
                                                $users_selected = $appoinment_data['subcontractor_id'];
                                               }
                                               //array_unshift($servicing_sub_list, "Nothing selected");
                                               if(isset($servicing_sub_list['status']))
                                               {
                                                 unset($servicing_sub_list['status']);
                                               }
                                               echo form_dropdown('subcontractor_id', $servicing_sub_list, $users_selected, "class='selectpicker form-control' id='subcontractor_user' data-live-search='true'"); 
                                                }else
                                                {
                                                echo form_dropdown('subcontractor_id', array(), '', "class='selectpicker form-control' id='subcontractor_user' data-live-search='true'");
                                                }              
                                                ?>
                                            </div>
                                         </div>	
										
                                   </div>
                                 </div>
                                 <div class="col-xs-4">
                                    <label>Servicing on</label>
									<div class="col-xs-12">
									<div class="form-group">
									<div id="datetimepicker6" class="input-group date">
										<input type="text" class="form-control" id="projected_start_date" name="service_date" value="<?php if(isset($appoinment_data['service_date'])) echo date("m/d/Y", strtotime($appoinment_data['service_date']));?>">
										<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
									</div>
									</div>
									</div>
                                 </div>
                                 <div class="col-xs-4">
                                   <div class="col-xs-6">
                                   <div class="col-xs-12">
                                   <div class="form-group">
								    <label>From</label>
                                    <div id="task-time" class="input-group date">
									   <input type="text" class="form-control" id="projected_start_date" name="service_from_time" value="<?php if(isset($appoinment_data['service_from_time'])) echo date("g:i a", strtotime($appoinment_data['service_from_time']));?>">
									   <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span> 
									</div>
								   </div>								   
								   </div>								   
								   </div>								   
                                   <div class="col-xs-6">
                                   <div class="col-xs-12">
									<div class="form-group">								   
								    <label>To</label>
                                   <div id="schedule-time" class="input-group date">
									   <input type="text" class="form-control" id="projected_start_date" name="service_to_time" value="<?php if(isset($appoinment_data['service_to_time'])) echo date("g:i a", strtotime($appoinment_data['service_to_time']));?>">
									   <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span> 
									</div>	
								   </div>								   
								   </div>								   
                                 </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row m-top">
                              <div class="col-xs-12">
                                 <div class="col-xs-4">
                                    <label>Notes to Sub</label>
                                    <textarea class="form-control" name="subcontractor_notes"><?php if(isset($appoinment_data['subcontractor_notes'])) echo $appoinment_data['subcontractor_notes'];?></textarea>
                                 </div>
                                 <div class="col-xs-4">
                                    <label>Internal Appointment Notes</label>
                                    <textarea class="form-control" name="builder_user_notes"><?php if(isset($appoinment_data['builder_user_notes'])) echo $appoinment_data['builder_user_notes'];?></textarea>
                                 </div>
                              
                                     
                                 
                                 <div class="col-xs-4 request-accept">

                                  <input type="hidden" id="account_type"  value="<?php if(isset($appoinment_data['account_type'])) echo  $appoinment_data['account_type'];?>" />

                                    <p>&nbsp;</p>
                                    <p><input type="checkbox" id="sub_accept_appoinment" name="sub_accept_appoinment" <?php if(isset($appoinment_data['sub_accept_appoinment']) && ($appoinment_data['sub_accept_appoinment']==='Acceptance Pending' || $appoinment_data['sub_accept_appoinment']==='Accepted' || $appoinment_data['sub_accept_appoinment']==='Reschedule')) echo  "checked='checked'";?> /> Request Sub to Accept Appoinment</p>
                                    <p><input type="checkbox" name="owner_accept_appoinment" <?php if(isset($appoinment_data['owner_accept_appoinment']) && ($appoinment_data['owner_accept_appoinment']==='Acceptance Pending' || $appoinment_data['owner_accept_appoinment']==='Accepted' || $appoinment_data['owner_accept_appoinment']==='Reschedule')) echo  "checked='checked'";?>/> Request Owner to Accept Appoinment</p>
                                 </div>
                                

                                <?php if(isset($appoinment_data['sub_accept_appoinment']) && isset($appoinment_data['sub_accept_appoinment'])){?>
                                 <div class="col-xs-4 save-request-accept">
                                    <p>&nbsp;</p>
                                    <p><img src="<?php echo IMAGESRC.'sub.png'; ?>" title="Subcontractor"/>
									<?php if(isset($appoinment_data['sub_accept_appoinment']) && $appoinment_data['sub_accept_appoinment']==='Accepted'){ 
									?>
									<span class="text-success"> Accepted</span>
									<?php 
									}else if(isset($appoinment_data['sub_accept_appoinment']) && $appoinment_data['sub_accept_appoinment']==='Reschedule'){
									?>
									<span class="text-success"> Request to Reschedule <?php if(isset($appoinment_data['sub_preferred_datetime'])){ echo '('; }?> <?php echo $appoinment_data['sub_preferred_datetime']; echo ')';?></span>
									<?php
									}else{
									?>
									<span class="text-danger"> Not <?php if($appoinment_data['sub_accept_appoinment']==='Acceptance Pending'){ ?>Accepted<?php }else{?>Requested<?php } ?></span>
									<?php } ?>
									</p>
                                    <p><img src="<?php echo IMAGESRC.'owner.png'; ?>" title="Owner"/><?php if(isset($appoinment_data['owner_accept_appoinment']) && $appoinment_data['owner_accept_appoinment']==='Accepted'){ ?><span class="text-success"> Accepted </span>
									<?php 
									}else if(isset($appoinment_data['owner_accept_appoinment']) && $appoinment_data['owner_accept_appoinment']==='Reschedule'){
									?>
									<span class="text-success"> Request to Reschedule <?php if(isset($appoinment_data['owner_preferred_datetime'])){ echo '('; }?> <?php echo $appoinment_data['owner_preferred_datetime']; echo ')';?>
                  </span><?php } else{?><span class="text-danger"> Not <?php if($appoinment_data['owner_accept_appoinment']==='Acceptance Pending'){ ?>Accepted<?php }else{?>Requested<?php } ?><?php } ?></span></p>
                                 </div>
                                 <?php } ?>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-12 save-service-con">
                        <div class="curve-box">
                           <div class="row">
                              <div class="col-xs-12">
                                 <div class="col-xs-6">
                                    <h4>Final Work Approval</h4>
                                 </div>
                              </div>
                              <div class="col-xs-12">

                                
                                <div class="col-xs-4" id="override_feedback">
                                  <label>Feedback</label>
                                  <?php echo $appoinment_data['status'];  ?>
                                </div>
                               
                                 <div class="col-xs-4" id="feedback_drop">
                                    <label>Feedback</label>
                                    <?php 
                                     $feedback_selected = '';
                                    if(isset($appoinment_data['status']))
                                      {
                                        $selected_status = $appoinment_data['status'];
                                        echo form_dropdown('status', $feedback_array, $selected_status, "class='selectpicker form-control' id='feedback' data-live-search='true'"); 
                                    }
                                    else
                                    {
                                      echo form_dropdown('status', $feedback_array, $feedback_selected, "class='selectpicker form-control' id='feedback' data-live-search='true'");
                                    }
                                    ?>
                                 </div>
                                 <!--  <?php if(isset($appoinment_data['override_by_builder']) && $appoinment_data['override_by_builder']==='No') { ?>
                                  <div id="override_feedback">
                                    <label>Feedback</label>
                                    <?php echo $appoinment_data['status'];  ?>
                                  </div>
                                  <?php } ?> -->
                                 <div class="col-xs-4">
                                    <p>&nbsp;</p>
                                    <p><input type="checkbox" name="override_by_builder" id="override_by_builder" <?php if(isset($appoinment_data['override_by_builder']) && $appoinment_data['override_by_builder']==='Yes') echo  "checked='checked'";?>/> Override Feedback</p>
                                 </div>
                                 <div class="col-xs-4" id="app_comment">
                                    <label>Approval Comments</label>
                                    <textarea id="approval_comments" class="form-control" name="approval_comments" readonly="readonly"><?php if(isset($appoinment_data['approval_comments'])) echo $appoinment_data['approval_comments'];?></textarea>
                                 </div>
                              </div>
                              <div class="col-xs-12">
                                 <div class="col-xs-4" id="com_date">
                                    <label>Completion Date</label>
                                    <div id="datetimepicker12" class="input-group date">
									   <input type="text" class="form-control" id="projected_start_date" name="completion_date" value="<?php if(isset($appoinment_data['completion_date'])) echo date("m/d/Y", strtotime($appoinment_data['completion_date']));?>">
									   <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
									</div>
                                 </div>
                                 <div class="col-xs-4">
                                    <label>Feedback Left On</label>
                                    <?php //echo $appoinment_data['completion_date'];?>
                                    <p><?php if(isset($appoinment_data['completion_date'])) echo date("m/d/Y", strtotime($appoinment_data['completion_date']));?></p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
				  <?php } ?>
                  <div class="row">
                     <div class="col-xs-6">
                        <div id="comments_area">
                         <?php if(isset($warranty_data['ub_warranty_claim_id'])) { ?>
							<?php $this->load->view('content/warranty/comment'); ?>
                         <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
			   <?php 
			   }
			   ?>
               <div class="tab-pane" id="Files-Pictures">
                  <div class="row">
                     <!--<div class="col-xs-8">
                        <table class="table table-bordered datatable" id="new_claim_files"></table>
                     </div>-->
                     <div class="col-xs-6">
                        <div class="row">
							<?php 
							if($this->user_account_type == BUILDERADMIN) {
							?>
                           <div class="col-xs-12">
                              <p class="text-primary col-xs-12"><a href="javascript:void(0);" class="text-primary" data-target="#docs_upload_Modal" data-toggle="modal"><u>Click Here</u></a>  to Choose from Unibuilder docs</p>                              
                           </div>
						   <?php 
						   }
						   ?>
                           <div class="col-xs-12 m-top">
                              <?php if($this->user_account_type == BUILDERADMIN) $this->load->view('common/upload.php');?>
                              <?php if($this->user_account_type == OWNER || $this->user_account_type == SUBCONTRACTOR) $this->load->view('common/uploaded_content.php'); ?>
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

<!-- Type Add Modal -->
<div class="modal fade" id="TypeAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>New Category Group
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
<div class="modal fade" id="TypeEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Edit / Delete Category
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
                                    <!-- <button type="button" id="Delete_project" class="btn btn-default btn-secondary pull-right">Delete</button>					 
                                    <button type="button" id="Edit_project" class="btn btn-default btn-secondary pull-right" >Save</button> -->
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
<input type="hidden" name="save_type" id="save_type" value="" />
</form>
<div class="modal fade" id="docs_upload_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Choose a file from Unibuilder Docs
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row m-top">
               <div class="col-xs-12 upload_error-message uni_message">
                  <div class="upload_alerts alert-danger"></div>
               </div>
            </div>
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">						
                           		<div id="fixed-tree"></div>			   
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
    		 <div class="modal-footer">
    			<div class="row">
                   <div class="col-xs-12">
    					<button class="btn btn-light-grey" data-dismiss="modal" type="button">Cancel</button>					
    					<button class="btn btn-success" type="submit" onclick="copy_file_to_temp()">Upload</button>
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
<!-- Delete Comment -->
<div class="modal fade confirmModal" id="confirm_comment_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Are you sure you want to delete?       
      </h4>
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
            <div class="modal-con">              
              <div class="row col-xs-12">                				
				<button class="btn btn-gray m-left-1 pull-right" type="button" id="cancel_comment_confirm" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="cancel_icon"/> CANCEL</button>  
				<button class="btn btn-blue m-left-1 pull-right" type="button" id="delete_comment_confirm"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_dick"/> OK</button>				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
<!-- /Delete Comment -->
<!-- Comment Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Post Your Comment
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </h4>
      <div class="modal-body">
	  <form name="post_comment_form" method="post" class="form-horizontal" id="post_comment_form">
        <div class="row m-top">
          <div class="col-xs-12">
            <div class="modal-con">
			<div class="col-xs-12">
				<div class="form-group">
					<textarea class="form-control" id="comments" name="comments"></textarea>
				</div>
			</div>
			<p><span name="commentcountchars" id="commentcountchars"></span> Characters Remaining. <span name="commentpercent" id="commentpercent"></span></p>
             <!--<p class="text-right">4000 Character Counter.</p>-->
			  <?php if($this->user_account_type == BUILDERADMIN){ ?>
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
                <tr>
                  <td width="33%" height="30">&nbsp;</td>
                  <td width="10">&nbsp;</td>
                  <td width="33%"><strong>Show?</strong></td>
                  <td width="33%"><strong>Notify?</strong></td>
                </tr>
                <?php if($this->user_account_type != OWNER)
                      { ?>
                <tr>
                  <td height="30" align="right"><strong>Owner : </strong></td>
                  <td>&nbsp;</td>
                  <td><input type="checkbox"  id="owner">
                      <input type="hidden"  id="owner_val" value="No">
                    <label for="checkbox"></label></td>
                  <td class="owner-child"><input type="checkbox"  id="owner-child"></td>
                  <input type="hidden"  id="owner_notify" value="No">
                </tr>
                <?php } ?>
                <?php if(isset($appoinment_data['sub_accept_appoinment']) && $appoinment_data['sub_accept_appoinment']!='Not Required' && $this->user_account_type != SUBCONTRACTOR){?>
                <tr>
                  <td height="30" align="right"><strong>Sub : </strong></td>
                  <td>&nbsp;</td>
                  <td><input type="checkbox"  id="sub"></td>
                  <input type="hidden"  id="sub_val" value="No">
                  <td class="sub-child"><input type="checkbox"  id="sub-child"></td>
                  <input type="hidden"  id="sub_notify" value="No">
                </tr>
                <?php } ?>
              </table>
			  <?php } ?>
              <div class="row text-center">
                <button type="submit" class="btn btn-gray" id="post_comment">POST COMMENT</button>
                <button type="button" class="btn btn-gray" data-dismiss="modal">CANCEL</button>
              </div>
            </div>
          </div>
        </div>
		</form>
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="save_appointment" value="" />
<script type="text/javascript">        
   this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>';
   this.displayStart   = '<?php echo 0 ?>';     
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.list_page   = 'yes';     
   this.file_upload_list_page_user   = '<?php echo $this->user_account_type; ?>';     
</script>
<link rel="stylesheet" href="<?php echo CSSSRC.'file-tree.min.css';?>">
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.mjs.nestedSortable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'file-tree.min.js';?>"></script>
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.jscrollpane.css';?>">	
<script type="text/javascript" src="<?php echo JSSRC.'enscroll-0.6.0.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'new_warranty.js';?>"></script>