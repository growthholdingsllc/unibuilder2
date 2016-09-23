<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?>
      <!--<li class="active">Lead Details</li>-->
   </ol>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
         <div class="pull-right ">
            <!--<button type="button" class="btn btn-default btn-secondary pull-right m-left-1">Save &amp; New</button> --> 
            <a href="<?php echo base_url();?>bgxf1VhZHMvaW5kZXgv">
            <button class="btn btn-gray pull-right m-left-1" type="button"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</button>
            </a>
            <?php 
               if(isset($this->user_role_access[strtolower('leads')][strtolower('delete')]) && $this->user_role_access[strtolower('leads')][strtolower('delete')] == 1)
               { 
                  if(!empty($result_data['ub_lead_id'])) 
                  { 
               ?>
            <button class="btn btn-blue pull-right m-left-1" type="button" id="<?php if(isset($result_data['ub_lead_id'])) echo $result_data['ub_lead_id']; ?>" onclick="deletelead(this.id)"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_delete"/> Delete</button>
            <?php 
               }
               }
               if(isset($this->user_role_access[strtolower('leads')][strtolower('edit')]) && $this->user_role_access[strtolower('leads')][strtolower('edit')] == 1 && $this->first_argument > 0)
               { 
               ?>
            <button class="btn btn-blue pull-right m-left-1" type="submit" id="add_lead_new_new" name="add_lead_new_new" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save &amp; New</button>
            <button type="submit" class="btn btn-blue pull-right m-left-1" id="add_lead_new_stay" name="add_lead_new_stay" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save & Stay </button>
            <button type="submit" class="btn btn-blue pull-right m-left-1" id="add_lead_new_back" name="add_lead_new_back" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back </button>
            <?php
               }
               else if((isset($this->user_role_access[strtolower('leads')][strtolower('add')]) && $this->user_role_access[strtolower('leads')][strtolower('add')] == 1) && $this->first_argument == 0)
               { 
               ?>
            <button class="btn btn-blue pull-right m-left-1" type="submit" id="add_lead_new_new" name="add_lead_new_new" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save &amp; New</button>
            <button type="submit" class="btn btn-blue pull-right m-left-1" id="add_lead_new_stay" name="add_lead_new_stay" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save & Stay </button>
            <button type="submit" class="btn btn-blue pull-right m-left-1" id="add_lead_new_back" name="add_lead_new_back" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back </button>
            <?php
               }
               ?>
         </div>
      </div>
   </div>
</div>
<div class="row m-top">
   <div class="col-xs-12 error-message uni_message">
      <div class="alerts alert-danger"></div>
   </div>
</div>
<div class="row">
   <div class="col-xs-12">
      <?php if(!empty($result_data['ub_lead_id'])) { ?>
      <input type="hidden" name="ub_lead_id" id="ub_lead_id" value="<?php if(isset($result_data['ub_lead_id'])) echo $result_data['ub_lead_id'];?>">
      <?php } 
         if(!empty($result_data['ub_lead_activity_id'])) { ?>
      <input type="hidden" id="ub_lead_activity_id" value="<?php if(isset($result_data['ub_lead_activity_id'])) echo $result_data['ub_lead_activity_id'];?>">
      <?php } ?>
      <h4>PRIMARY INFO</h4>
      <div class="box-content panel-content">
            <form id="add_new_lead_prime" class="form-horizontal" method="post" name="add_new_lead_prime">
         <div class="row five-col">
               <div class="col-xs-3">
                  <label>Name</label>
                  <div class="col-xs-12">
                     <div class="val-man col-xs-12">
                        <div class="form-group name-field">
                           <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($result_data['name'])?$result_data['name']:'' ?>">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xs-3">
                  <label>Phone</label>
                  <input type="text" name="desk_phone" id="desk_phone" class="form-control" value="<?php echo isset($result_data['desk_phone'])?$result_data['desk_phone']:'' ?>">
               </div>
               <div class="col-xs-3">
                  <label>Cell</label>
					<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">
							<select class="form-control selectpicker" name="mobile_isd_code" id="mobile_isd_code" >
							<option value="+1">US</option>
							</select>
						</span>
						<input type="text" name="mobile_phone" id="mobile_phone" class="form-control" value="<?php echo isset($result_data['mobile_phone'])?$result_data['mobile_phone']:'' ?>">
					</div>
					</div>
               </div>
               <div class="col-xs-3">
                  <label>Confidence %</label>
                  <br/>
                  <input type="text" name="confidence_level" class="span2" value="<?php echo isset($result_data['confidence_level'])?$result_data['confidence_level']:'0' ?>" id="sl1">
               </div>
               <div class="col-xs-3">
                  <label>Projected sales date</label>
                  <div class='input-group date' id='datetimepicker5'>
                     <input type='text' name="projected_sales_date" id="projected_sales_date" class="form-control" value="<?php if(isset($result_data['projected_sales_date']) && $result_data['projected_sales_date']!='0000-00-00') echo date("m/d/Y", strtotime($result_data['projected_sales_date']));?>"/>
                     <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                  </div>
               </div>
         </div>
            </form>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="tab-con pull-left">
         <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist" id="leadinfotab">
               <li role="presentation" <?php if (isset($result_data['ub_lead_activity_id']) && !empty($result_data['ub_lead_activity_id'])) { echo ''; }else{ echo 'class="active"'; }?>> <a href="#General-View" aria-controls="General-View" data-toggle="tab"<?php if (isset($result_data['ub_lead_activity_id']) && !empty($result_data['ub_lead_activity_id'])) {echo 'aria-expanded="false"';}else{ echo 'aria-expanded="true"'; }?>>General</a> </li>
               <li role="presentation" <?php if (isset($result_data['ub_lead_activity_id']) && !empty($result_data['ub_lead_activity_id'])) {echo 'class="active"';}?>> <a href="#Activities" aria-controls="Activities" data-toggle="tab"<?php if (isset($result_data['ub_lead_activity_id']) && !empty($result_data['ub_lead_activity_id'])) {echo 'aria-expanded="true"';}?>>Activities</a> </li>
               <li role="presentation"> <a href="#Files" class="file_tab" aria-controls="Files" data-toggle="tab">Files</a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane <?php if (isset($result_data['ub_lead_activity_id']) && !empty($result_data['ub_lead_activity_id'])) { echo ''; }else{ echo 'active'; }?> panel-content" id="General-View">
                  <form id="add_new_lead" class="form-horizontal" method="post" name="add_new_lead">
                     <div class="row five-col">
                        <div class="col-xs-3">
                           <label>Primary Email</label>
                           <div class="col-xs-12">
                              <div class="form-group email-field">
                                 <input type="text" name="primary_email" id="primary_email" class="form-control" value="<?php echo isset($result_data['primary_email'])?$result_data['primary_email']:'' ?>"/>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-3">
                           <label>Alternate Email</label>
                           <input type="text" name="alternative_email" id="alternative_email" class="form-control" value="<?php echo isset($result_data['alternative_email'])?$result_data['alternative_email']:'' ?>"/>
                        </div>
                        <div class="col-xs-3">
                           <label>Address</label>
                           <input type="text" name="address" class="form-control" value="<?php echo isset($result_data['address'])?$result_data['address']:'' ?>"/>
                        </div>
                        <div class="col-xs-3">
                           <label>City</label>
                           <input type="text" name="city" class="form-control" value="<?php echo isset($result_data['city'])?$result_data['city']:'' ?>"/>
                        </div>
                        <div class="col-xs-3">
                           <label>State</label>
                           <input type="text" name="province" class="form-control" value="<?php echo isset($result_data['province'])?$result_data['province']:'' ?>"/>
                        </div>
                    </div>
					<div class="row five-col">
						<div class="col-xs-3">
                           <label>Country</label>
                           <input type="text" name="country" class="form-control" value="<?php echo isset($result_data['country'])?$result_data['country']:'' ?>"/>
                        </div>
                        <div class="col-xs-3">
                           <label>Zip</label>
                           <input type="text" name="postal" class="form-control" value="<?php echo isset($result_data['postal'])?$result_data['postal']:'' ?>"/>
                        </div>
                        <div class="col-xs-3">
                           <label>Sales person</label>
                           <?php 
                              $sales_person_selected = '';
                              if(isset($result_data['sales_person']))
                              {
                                 $sales_person_selected = explode(",",$result_data['sales_person']);
                              }
                              echo form_dropdown('sales_person', $sales_person,$sales_person_selected, "class='selectpicker form-control' id='lead_sales_person' data-live-search='true'"); 
                              ?>
                        </div>
                        <div class="col-xs-3">
                           <label>Project type</label>
						     <div class="col-xs">
                              <?php 
                                 $type_selected = '';
                                 if(isset($result_data['project_type']))
                                 {
                                   $type_selected = explode(",",$result_data['project_type']);
                                 }
                                 echo form_dropdown('project_type[]', $lead_project_type,$type_selected, "class='selectpicker form-control2' id='lead_project_type' data-live-search='true' multiple"); 
                                 ?>
                              <span class="right-group input-group-addon"> <a data-toggle="modal" data-target="#AddProjectType" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>" alt="plus"> </a> <a class="EditProjectType" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>" alt="minus"> </a> </span>
                        </div>
                        </div>
                        <div class="col-xs-3">
                           <label>Tags</label>
						   <div class="col-xs">
                              <?php 
                                 $tag_selected = '';
                                 if(isset($result_data['tags']))
                                 {
                                    $tag_selected = explode(",",$result_data['tags']);
                                 }
                                 echo form_dropdown('tags[]', $lead_tags,$tag_selected, "class='selectpicker form-control2' id='lead_tags' data-live-search='true' multiple"); 
                                 ?>
                              <span class="right-group input-group-addon"> <a data-toggle="modal" data-target="#AddNewTag" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>" alt="plus"> </a> <a class="EditNewTag" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>" alt="minus"> </a> </span> 
                           
                        </div>
                        </div>
                    </div> 
					<div class="row five-col">
						<div class="col-xs-3">
                           <label>Source</label>  
							<div class="col-xs">						   
                              <?php 
                                 $source_selected = '';
                                 if(isset($result_data['source']))
                                 {
                                    $source_selected = explode(",",$result_data['source']);
                                 }
                                 echo form_dropdown('source[]', $lead_source,$source_selected, "class='selectpicker form-control2' id='lead_source' data-live-search='true' multiple"); 
                                 ?>
                              <span class="right-group input-group-addon"> <a data-toggle="modal" data-target="#AddSource" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>" alt="plus"> </a> <a class="EditSource" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>" alt="minus"> </a> </span> 
                           
							</div>
                        </div>
                        <div class="col-xs-3">
                           <label>Status</label>
                           <?php 
                              $status_selected = '';
                              if(isset($result_data['status']))
                              {
                                 $status_selected = $result_data['status'];
                              }
                              echo form_dropdown('status', $lead_status,$status_selected, "class='selectpicker form-control' id='lead_status' data-live-search='true'"); 
                              ?>
                        </div>
                        <div class="col-xs-3">
                           <label>Estimated revenue</label>
                           <div class="input-group"> <span class="input-group-addon"> <i class="glyphicon dollar"></i> </span>
                              <input type="text" class="form-control" id="estimated_revenue_min" name="estimated_revenue_min" value="<?php echo isset($result_data['estimated_revenue_min'])?$result_data['estimated_revenue_min']:'' ?>"/>
                           </div>
                        </div>
                        <div class="col-xs-3">
                           <label>To</label>
                           <div class="input-group"> <span class="input-group-addon"> <i class="glyphicon dollar"></i> </span>
                              <input type="text" class="form-control" id="estimated_revenue_max" name="estimated_revenue_max" value="<?php echo isset($result_data['estimated_revenue_max'])?$result_data['estimated_revenue_max']:'' ?>"/>
                           </div>
                        </div>
                    </div> 
					<div class="row five-col">					
						<div class="col-xs-12">
                           <label>Notes</label>
                           <textarea class="form-control" name="note"><?php echo isset($result_data['note'])?$result_data['note']:'' ?></textarea>
                        </div>
                     </div>
                    
                     <input type="hidden" name="save_type" id="save_type" value="" />
                  </form>
               </div>
               <div class="tab-pane <?php if (isset($result_data['ub_lead_activity_id']) && !empty($result_data['ub_lead_activity_id'])) {echo 'active';}?>" id="Activities">
                  <div class="row">
                     <div class="col-xs-12">
                        <div class="pull-left"> <a href="javascript:void(0);" id="schedule_activity">
                           <button type="button" class="btn btn-gray pull-right m-left-1">Schedule New Activity</button>
                           </a> <a href="javascript:void(0);" id="log-complete-activity">
                           <button type="button" class="btn btn-gray pull-right m-left-1">Log Completed Activity</button>
                           </a> 
                        </div>
                     </div>
                  </div>
                  <div class="row log_complete">
                     <div class="col-xs-12">
                        <!-- tabs left -->
                        <div class="tabbable tabs-left m-top">
                           <ul class="nav nav-tabs">
                              <li class="active act-general"><a href="#general" data-toggle="tab">General</a></li>
                              <li class="act-mail"><a href="#sendmail" id="add_new_activity_new_stay" data-toggle="tab">Send Email</a></li>
                           </ul>
                           <div class="tab-content">
                              <div class="tab-pane active panel-content" id="general">
                                 <form id="update_completed_activity" class="form-horizontal" method="post" name="update_completed_activity">
                                    <?php if(!empty($result_data['ub_lead_id'])) { ?>
                                    <input type="hidden" name="lead_id" value="<?php if(isset($result_data['ub_lead_id'])) echo $result_data['ub_lead_id'];?>">
                                    <?php } ?>
                                    <div class="form-new-schedule">
                                       <div class="row">
                                          <div class="col-xs-12">
                                             <div class="pull-right">
                                                <div class="action-btn general-btn-all">
												<a href="javascript:void(0);" id="activity_cancel">
												  <button type="button" class="btn btn-gray pull-right m-left-1">
													<img border="0" class="uni_cancel_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Cancel
												  </button>
												</a>												
												<a href="javascript:void(0);" id="update_completed_activity_new" name="update_completed_activity_new">
													<button class="btn btn-blue pull-right" type="button">
														<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_new"/> Save
													</button>
												</a> 
												
												</div>
                                             </div>
                                          </div>
                                       </div>
                                       <input type="hidden" id="lead_activity_id" name="ub_lead_activity_id" value="<?php if(isset($result_data['ub_lead_activity_id'])) echo $result_data['ub_lead_activity_id'];?>" />
                                       <div class="row">
                                          <div class="col-xs-3">
                                             <label>Type</label>
                                             <div class="input-group right-group">
                                                <?php 
                                                   $lead_activity_type_selected = '';
                                                   if(isset($result_data['lead_activity_type']))
                                                   {
                                                     $lead_activity_type_selected = explode(",",$result_data['lead_activity_type']);
                                                   }
                                                   echo form_dropdown('activity_type', $lead_activity_type,$lead_activity_type_selected, "class='selectpicker form-control' id='lead_activity_type' data-live-search='true'"); 
                                                   ?>
                                                <span class="input-group-addon"> <a data-toggle="modal" data-target="#AddActivityType" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>" alt="plus"> </a> <a class="EditNewActivityType" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>" alt="minus"> </a> </span> 
                                             </div>
                                          </div>
                                          <div class="col-xs-3">
                                             <p>&nbsp;</p>
                                             <label>Phone : <?php echo isset($result_data['desk_phone'])?$result_data['desk_phone']:'' ?></label>
                                          </div>
                                          <div class="col-xs-3">
                                             <p>&nbsp;</p>
                                             <label>Cell : <?php echo isset($result_data['mobile_phone'])?$result_data['mobile_phone']:'' ?></label>
                                          </div>
                                          <div class="col-xs-3">
                                             <p>&nbsp;</p>
                                             <div class="mark-com "> <span class="pull-left"><strong>Marked Complete</strong> </span> <a class="lead_unchecked_marked" href="javascript:void(0);" > <img border="0" src="<?php echo IMAGESRC.'box-1.png'; ?>" alt="tick"> </a> <a class="lead_checked_marked" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'green_tickbox.png'; ?>" alt="check"> </a>
                                                <input type="hidden" id="lead_marked-list" value="Yes" name="mark_completed_status">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-xs-3">
                                             <label>Sales person</label>
                                             <?php 
                                                $sales_person_selected = '';
                                                if(isset($result_data['sales_person']))
                                                {
                                                   $sales_person_selected = explode(",",$result_data['sales_person']);
                                                }
                                                echo form_dropdown('sales_person', $sales_person,$sales_person_selected, "class='selectpicker form-control' id='lead_activity_sales_person' data-live-search='true'"); 
                                                ?>
                                          </div>
                                          <div class="col-xs-3">
                                             <label>Initiated by</label>
                                             <?php
                                                $initiated_by = '';
                                                if(isset($search_session_array['initiated_by']))
                                                   {
                                                       $initiated_by_selected = $result_data['initiated_by'];
                                                   }
                                                echo form_dropdown('initiated_by', $initiated_bys,$initiated_by, "class='selectpicker form-control' id='initiated_by'");
                                                ?>
                                          </div>
                                          <div class="col-xs-3">
                                             <label>Schedule followup</label>
                                             <div class='input-group date' id='datetimepicker10' >
                                                <input type="text" class="form-control" id="schedule_followup" name="schedule_followup">
                                                <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                                             </div>
                                          </div>
                                          <div class="col-xs-2">
                                             <label>Time</label>
                                             <div class="form-group">
                                                <div class='input-group date' id='schedule-time'>
                                                   <input type='text' class="form-control" name="followup_time" id="followup_time" placeholder="No Time"/>
                                                   <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span> 
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-xs-3">
                                             <label>Activity date</label>
                                             <div class='input-group date' id='datetimepicker11'>
                                                <input type="text" class="form-control" id="activity_date" name="activity_date">
                                                <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                                             </div>
                                             <div class='input-group date' id='datetimepicker12'>
                                                <input type="text" class="form-control" id="activity_date_1" name="activity_date">
                                                <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                                             </div>
											 <input type="hidden" id="lead_created_on" value="<?php echo $result_data['created_on']; ?>"> 
                                          </div>
                                          <div class="col-xs-3">
                                             <label>Time</label>
                                             <div class="form-group">
                                                <div class='input-group date' id='task-time'>
                                                   <input type='text' class="form-control" id="activity_time" name= "time" placeholder="No Time" />
                                                   <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span> 
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xs-3">
                                             <label>Reminder</label>
                                             <?php 
                                                $reminder_selected = '';
                                                if(isset($result_data['activity_reminder']))
                                                {
                                                  $reminder_selected = explode(",",$result_data['activity_reminder']);
                                                }
                                                echo form_dropdown('reminder_id', $activity_reminder,$reminder_selected, "class='selectpicker form-control' id='reminder_id' data-live-search='true'"); 
                                                ?>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-xs-12">
                                             <label>Notes</label>
                                             <textarea class="form-control" id="description" name="description"></textarea>
                                          </div>
                                       </div>
                                       <input type="hidden" name="save_type" id="save_type" value="" />
                                    </div>
                                 </form>
                              </div>
                              <div class="tab-pane" id="sendmail">
                                 <div class="row">
                                    <div class="col-xs-12">
                                       <div class="pull-right">
                                          <div class="action-btn mail-action-btn">                             
                                             <button type="button" id="mail_cancel" class="btn btn-gray pull-right m-left-1">
												<img class="uni_cancel_new" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Cancel
											 </button>
                                             <button id="completed_compose_email" name="completed_compose_email" class="btn btn-blue pull-right m-left-1" type="submit">
												<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_send_new"/>Send
											 </button>                               
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row m-top">
                                    <div class="col-xs-8">
                                       <div class="col-xs-3">
                                          <input type="radio" id="nomail" name="name" value="notmail"/>
                                          Not an Email
                                       </div>
                                       <div class="col-xs-3">
                                          <input type="radio" id="compose" name="name" value="composedmail"/>
                                          Email Composed Online
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row composedmail ">
                                    <form id="compose_completed_email" class="form-horizontal" method="post" name="compose_completed_email" enctype="multipart/form-data">
                                       <div class="compose_con">
                                          <div class="col-xs-8 ">
                                             <div id="composedmail">
                                                <input type="hidden" id="module_pk_id" name="module_pk_id" value=""/>
                                                <input type="hidden" name="name" id="lead_name" class="form-control" value="<?php if(isset($result_data['name'])) echo $result_data['name'];?>"/>
                                                <div class="row col-xs-12 m-top">
                                                   <div class="col-xs-3">
                                                      <input type="checkbox" name="primary_email" id="primary-email"/>
                                                      Primary email
                                                   </div>
                                                   <div class="col-xs-3">
                                                      <input type="checkbox" name="alter-email" id="alter-email"/>
                                                      Alternate email
                                                   </div>
                                                </div>
                                                <div class="row col-xs-12 m-top">
                                                   <div class="col-xs-12">
                                                      <label>To</label>
                                                   </div>
                                                   <div class="col-xs-12 alter_email_tag_medium">
                                                      <input type="text" id="alt_email_to" name="alt_email_to" class="form-control"/>
                                                   </div>
                                                </div>
                                                <input type="hidden" id="unique_email_id" name="unique_email_id"/>
                                                <div class="row col-xs-12 m-top">
                                                   <div class="col-xs-12">
                                                      <label>Cc</label>
                                                   </div>
                                                   <div class="col-xs-12">
                                                      <input type="text" id="alt_email_cc" name="alt_email_cc" class="form-control"/>
                                                   </div>
                                                </div>
                                                <div class="row col-xs-12 m-top bcc_email">
                                                   <div class="col-xs-12">
                                                      <label>Bcc</label>
                                                   </div>
                                                   <div class="col-xs-12">
                                                      <input type="text" id="alt-email-bcc" name="alt_email_bcc" class="form-control"/>
                                                   </div>
                                                </div>
                                                <div class="row col-xs-12 m-top">
                                                   <div class="col-xs-12">
                                                      <label>Subject</label>
                                                   </div>
                                                   <div class="col-xs-12">
                                                      <input type="text" id="subject" name="subject" class="form-control"/>
                                                   </div>
                                                </div>
                                                <div class="row col-xs-12 m-top">
                                                   <div class="col-xs-12">
                                                      <textarea class="ckeditor" id="message_body" name="editor"></textarea>
                                                   </div>
                                                </div>
                                                <input type="hidden" name="email_type" id="email_type" value="" />
                                             </div>
                                          </div>
                                          <div class="col-xs-4">
                                             <div class="row col-xs-12 m-top">
                                                <div class="col-xs-12">
                                                   <div class="row">
                                                      <div class="col-xs-12">
                                                         <p class="text-primary"><a href="javascript:void(0);" class="text-primary" data-target="#docs_upload_Modal" data-toggle="modal"><u>Click Here</u></a>  to Choose from Unibuilder docs</p>
                                                      </div>
                                                      <div class="col-xs-12 m-top">
                                                         <?php $this->load->view('common/upload.php'); ?>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row col-xs-12">
                                          <div  id="mail-thread">
                                             <?php $this->load->view('content/leads/email_thread'); ?>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                           <!-- /tabs --> 
                        </div>
                     </div>
                  </div>
                  <!-- log Completed Activity -->
                  <div class="row m-top lead_activity_table">
                     <div class="col-xs-12 pull-left">
                        <table class="table table-bordered datatable" id="lead_activity" width="100%">
                           <thead>
                              <tr>
                                 <th>Activity Type</th>
                                 <th>Sales Person</th>
                                 <th>Lead</th>
                                 <th>Due By</th>
                                 <th>Follow Up</th>
                                 <th>Update</th>
                                 <th>Mark Complete</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="tab-pane" id="Files">
                  <div class="row">
                     <div class="col-xs-12">
                        <p class="text-primary"><a href="javascript:void(0);" class="text-primary" data-target="#docs_upload_Modal" data-toggle="modal"><u>Click Here</u></a>  to Choose from Unibuilder docs</p>
                        <form id="fileupload" method="POST" enctype="multipart/form-data">
                           <div class="col-xs-12">                     
                              <?php $this->load->view('common/upload.php'); ?>                                                          
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
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
<div class="row m-top">
	<div class="col-xs-12">
		<div class="panel panel-default">
		 <div id="filter" role="tab" class="panel-heading">
			<h4 class="panel-title">My Fields</h4>
		 </div>
		 <div class="panel-body">
			<div class="panel-content">
			   <!-- <p>No My Fields. To create one, go to the My Fields tab in the setup area.</p> -->
            <form id="add_custom_field" class="form-horizontal" method="post" name="add_custom_field">
			      <?php $this->load->view('common/custom_field.php'); ?>
            </form>
			</div>
		 </div>
		</div>
	</div>
</div>
<?php 
}
?>
<!-- Type Add Modal -->
<div class="modal fade" id="TypeAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>New Lead Group
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
                                 <td><input type="text" id="project_group" class="form-control" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" id="save" class="btn btn-default btn-secondary pull-right">Save</button></td>
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
                                 <td><input type="text" id="Edit_project_group" class="form-control" />
                                    <input type="hidden" id="selected" class="form-control"  />
                                 </td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" id="Delete_project" class="btn btn-default btn-secondary pull-right">Delete</button>
                                    <button type="button" id="Edit_project" class="btn btn-default btn-secondary pull-right" >Save</button>
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
<!-- Type Add Modal for project type -->
<div class="modal fade" id="AddProjectType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>New Project Type
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
                                 <td><input type="text" id="new_project_type" class="form-control" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" id="save_project_type" class="btn btn-default btn-secondary pull-right">Save</button></td>
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
<div class="modal fade" id="EditProjectType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                 <td><input type="text" id="Edit_new_project_type" class="form-control" />
                                    <input type="hidden" id="selected" class="form-control"  />
                                 </td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" id="delete_project_type" class="btn btn-default btn-secondary pull-right">Delete</button></td>
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
<!-- Type Add Modal for Source-->
<div class="modal fade" id="AddSource" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>New Source
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
                                 <td><input type="text" id="new_source" class="form-control" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" id="save_source" class="btn btn-default btn-secondary pull-right">Save</button></td>
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
<div class="modal fade" id="EditSource" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                 <td><input type="text" id="Edit_new_source" class="form-control" />
                                    <input type="hidden" id="selected" class="form-control"  />
                                 </td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" id="delete_source" class="btn btn-default btn-secondary pull-right">Delete</button></td>
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
<!-- Type Add Modal for tags-->
<div class="modal fade" id="AddNewTag" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>New Tag
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
                                 <td><input type="text" id="new_tag" class="form-control" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" id="save_tag" class="btn btn-default btn-secondary pull-right">Save</button></td>
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
<div class="modal fade" id="EditNewTag" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                 <td><input type="text" id="Edit_new_tag" class="form-control" />
                                    <input type="hidden" id="selected" class="form-control"  />
                                 </td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" id="delete_tag" class="btn btn-default btn-secondary pull-right">Delete</button></td>
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
<!-- Type Add Modal for tags-->
<div class="modal fade" id="AddActivityType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>New Activity Type
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
                                 <td><input type="text" id="new_activity_type" class="form-control" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" id="save_activity_type" class="btn btn-default btn-secondary pull-right">Save</button></td>
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
<div class="modal fade" id="EditNewActivityType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                 <td><input type="text" id="Edit_new_activity_type" class="form-control" />
                                    <input type="hidden" id="selected" class="form-control"  />
                                 </td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" id="delete_activity_type" class="btn btn-default btn-secondary pull-right">Delete</button></td>
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
<!-- Type Add Modal -->
<div class="modal fade" id="ImportActivityModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Import Activity From Template
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
                                 <td height="30">Source Template</td>
                                 <td>1st Activity Start Date</td>
                              </tr>
                              <tr>
                                 <td height="30">
                                    <select class="selectpicker form-control">
                                       <option>Choose a Template</option>
                                    </select>
                                 </td>
                                 <td height="30">
                                    <div class='input-group date' id='datetimepicker6'>
                                       <input type='text' class="form-control" />
                                       <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                                    </div>
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
<!-- /Check List Modal -->
<div class="modal fade" id="ChecklistModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Grid Settings
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <table width="100%" class="border-none">
                              <tr>
                                 <td height="30">Saved Views</td>
                                 <td>
                                    <select class="selectpicker form-control">
                                       <option>Standard View</option>
                                    </select>
                                 </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row m-top">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <h4>Current View</h4>
                           <table width="100%" class="table border-none">
                              <tr>
                                 <td height="30">Column</td>
                                 <td>
                                    <select class="selectpicker form-control">
                                       <option>All Items Selected</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td height="30">View Name</td>
                                 <td><input type='text' class="form-control" placeholder="Standard View234" /></td>
                              </tr>
                              <tr>
                                 <td>Is Default</td>
                                 <td><input type="checkbox" />
                                    Is Default 
                                 </td>
                              </tr>
                              <tr>
                                 <td class="text-center" colspan="2"><button class="btn btn-default btn-primary" type="button">APPLY VIEW</button>
                                    <button class="btn btn-default btn-primary" type="button">SAVE AS VIEW</button>
                                    <button class="btn btn-default btn-primary" type="button">UPDATE SELECTED</button>
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
                  <button class="btn btn-success" type="submit" onclick="copy_file_to_temp(<?php echo $lead_temprory_dir_id; ?>)">Upload</button>
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
<script type="text/javascript">  
   this.lead_folder_id   = '<?php echo $lead_folder_id; ?>'; 
   this.activity_folder_id   = '<?php echo $activity_folder_id; ?>';
   this.lead_temprory_dir_id   = '<?php echo $lead_temprory_dir_id; ?>';
   this.activity_temprory_dir_id   = '<?php echo $activity_temprory_dir_id; ?>';
   this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>';
   this.displayStart   = '<?php echo 0 ?>';     
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.cur_date   = '<?php echo CURRENT_DATE; ?>';     
   this.list_page   = 'yes'; 
   
</script> 
<!-- /Check List Modal -->
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<link rel="stylesheet" href="http://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />
<link rel="stylesheet" href="<?php echo CSSSRC.'file-tree.min.css';?>">
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.mjs.nestedSortable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'file-tree.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-tagsinput.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/ckeditor.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/adapters/jquery.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script> 
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.jscrollpane.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'enscroll-0.6.0.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'save_lead.js';?>"></script>
<script data-sample="1">
   CKEDITOR.replace( 'editor', {
     toolbar: [    
      { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] }
       ]
      
   });
</script>

