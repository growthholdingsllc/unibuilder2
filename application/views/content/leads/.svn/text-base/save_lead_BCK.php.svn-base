<?php 
   /*echo $result_data['ub_lead_id'];
   echo $result_data['ub_lead_activity_id'];*/
   
   ?>
<script>   
   this.drop_upload = '<?php echo $drop_upload; ?>';     
</script>
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
            <button class="btn btn-default btn-primary pull-right m-left-1" type="button">Cancel</button>
            </a>
            <?php if(!empty($result_data['ub_lead_id'])) { ?>
            <button class="btn btn-default btn-primary pull-right m-left-1" type="button" id="<?php if(isset($result_data['ub_lead_id'])) echo $result_data['ub_lead_id']; ?>" onclick="deletelead(this.id)">Delete</button>
            <?php } ?>
            <button class="btn btn-default btn-secondary pull-right m-left-1" type="submit" id="add_lead_new_new" name="add_lead_new_new" >Save &amp; New</button>
            <button type="submit" class="btn btn-default btn-secondary pull-right m-left-1" id="add_lead_new_stay" name="add_lead_new_stay" > Save & Stay </button>
            <button type="submit" class="btn btn-default btn-secondary pull-right m-left-1" id="add_lead_new_back" name="add_lead_new_back" > Save &amp; Back </button>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-xs-12">
      <?php if(!empty($result_data['ub_lead_id'])) { ?>
      <input type="hidden" name="ub_lead_id" id="ub_lead_id" value="<?php if(isset($result_data['ub_lead_id'])) echo $result_data['ub_lead_id'];?>">
      <?php } 
         if(!empty($result_data['ub_lead_activity_id'])) { ?>
      <input type="hidden" name="ub_lead_activity_id" id="ub_lead_activity_id" value="<?php if(isset($result_data['ub_lead_activity_id'])) echo $result_data['ub_lead_activity_id'];?>">
      <?php }
         ?>
      <h4>PRIMARY INFO</h4>
      <div class="box-content panel-content">
         <div class="row five-col">
            <div class="col-xs-3">
               <label>Name</label>
               <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($result_data['name'])?$result_data['name']:'' ?>">
            </div>
            <div class="col-xs-3">
               <label>Phone</label>
               <input type="text" name="desk_phone" id="desk_phone" class="form-control" value="<?php echo isset($result_data['desk_phone'])?$result_data['desk_phone']:'' ?>">
            </div>
            <div class="col-xs-3">
               <label>Cell</label>
               <input type="text" name="mobile_phone" id="mobile_phone" class="form-control" value="<?php echo isset($result_data['mobile_phone'])?$result_data['mobile_phone']:'' ?>">
            </div>
            <div class="col-xs-3">
               <label>Confidence %</label>
               <br/>
               <input type="text" name="confidence_level" class="span2" value="<?php echo isset($result_data['confidence_level'])?$result_data['confidence_level']:'0' ?>" id="sl1">
            </div>
            <div class="col-xs-3">
               <label>Projected sales date</label>
               <div class='input-group date' id='datetimepicker5'>
                  <input type='text' name="projected_sales_date" id="projected_sales_date" class="form-control" value="<?php if(isset($result_data['projected_sales_date'])) echo date("m/d/Y", strtotime($result_data['projected_sales_date']));?>"/>
                  <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="tab-con pull-left">
         <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist" id="leadinfotab">
               <li role="presentation" <?php if (isset($result_data['ub_lead_activity_id']) && !empty($result_data['ub_lead_activity_id'])) { echo ''; }else{ echo 'class="active"'; }?>> 
                  <a href="#General-View" aria-controls="General-View" data-toggle="tab"<?php if (isset($result_data['ub_lead_activity_id']) && !empty($result_data['ub_lead_activity_id'])) {echo 'aria-expanded="false"';}else{ echo 'aria-expanded="true"'; }?>>General</a> 
               </li>
               <li role="presentation" <?php if (isset($result_data['ub_lead_activity_id']) && !empty($result_data['ub_lead_activity_id'])) {echo 'class="active"';}?>> 
                  <a href="#Activities" aria-controls="Activities" data-toggle="tab"<?php if (isset($result_data['ub_lead_activity_id']) && !empty($result_data['ub_lead_activity_id'])) {echo 'aria-expanded="true"';}?>>Activities</a> 
               </li>
               <li role="presentation"> <a href="#Files" aria-controls="Files" data-toggle="tab">Files</a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane active panel-content" id="General-View">
                  <form id="add_new_lead" class="form-horizontal" method="post" name="add_new_lead">
                     <div class="row five-col">
                        <div class="col-xs-3">
                           <label>Primary Email</label>
                           <input type="text" name="primary_email" id="primary_email" class="form-control" value="<?php echo isset($result_data['primary_email'])?$result_data['primary_email']:'' ?>"/>
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
                           <div class="input-group right-group">
                              <?php 
                                 $type_selected = '';
                                 if(isset($result_data['project_type']))
                                 {
                                   $type_selected = explode(",",$result_data['project_type']);
                                 }
                                 echo form_dropdown('project_type[]', $lead_project_type,$type_selected, "class='selectpicker form-control' id='lead_project_type' data-live-search='true' multiple"); 
                                 ?>
                              <span class="input-group-addon"> <a data-toggle="modal" data-target="#AddProjectType" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>" alt="plus"> </a> <a class="EditProjectType" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>" alt="minus"> </a> </span> 
                           </div>
                        </div>
                        <div class="col-xs-3">
                           <label>Tags</label>
                           <div class="input-group right-group">
                              <?php 
                                 $tag_selected = '';
                                 if(isset($result_data['tags']))
                                 {
                                    $tag_selected = explode(",",$result_data['tags']);
                                 }
                                 echo form_dropdown('tags[]', $lead_tags,$tag_selected, "class='selectpicker form-control' id='lead_tags' data-live-search='true' multiple"); 
                                 ?>
                              <span class="input-group-addon"> <a data-toggle="modal" data-target="#AddNewTag" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>" alt="plus"> </a> <a class="EditNewTag" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>" alt="minus"> </a> </span> 
                           </div>
                        </div>
                        <div class="col-xs-3">
                           <label>Source</label>
                           <div class="input-group right-group">
                              <?php 
                                 $source_selected = '';
                                 if(isset($result_data['source']))
                                 {
                                    $source_selected = explode(",",$result_data['source']);
                                 }
                                 echo form_dropdown('source[]', $lead_source,$source_selected, "class='selectpicker form-control' id='lead_source' data-live-search='true' multiple"); 
                                 ?>
                              <span class="input-group-addon"> <a data-toggle="modal" data-target="#AddSource" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>" alt="plus"> </a> <a class="EditSource" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>" alt="minus"> </a> </span> 
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
                              <input type="text" class="form-control" name="estimated_revenue_min" value="<?php echo isset($result_data['estimated_revenue_min'])?$result_data['estimated_revenue_min']:'' ?>"/>
                           </div>
                        </div>
                        <div class="col-xs-3">
                           <label>To</label>
                           <div class="input-group"> <span class="input-group-addon"> <i class="glyphicon dollar"></i> </span>
                              <input type="text" class="form-control" name="estimated_revenue_max" value="<?php echo isset($result_data['estimated_revenue_max'])?$result_data['estimated_revenue_max']:'' ?>"/>
                           </div>
                        </div>
                        <div class="col-xs-12">
                           <label>Notes</label>
                           <textarea class="form-control" name="note"><?php echo isset($result_data['note'])?$result_data['note']:'' ?></textarea>
                        </div>
                     </div>
                     <input type="hidden" name="save_type" id="save_type" value="" />
                  </form>
               </div>
               <div class="tab-pane" id="Activities">
                  <div class="row">
                     <div class="col-xs-12">
                        <div class="pull-left"> <a href="javascript:void(0);" id="schedule_activity">
                           <button type="button" class="btn btn-default btn-primary pull-right m-left-1">Schedule New Activity</button>
                           </a> <a href="javascript:void(0);" id="log-complete-activity">
                           <button type="button" class="btn btn-default btn-primary pull-right m-left-1">Log Completed Activity</button>
                           </a> 
                        </div>
                     </div>
                  </div>
                  <div class="row log_complete">
                     <div class="col-xs-12">
                        <!-- tabs left -->
                        <div class="tabbable tabs-left m-top">
                           <ul class="nav nav-tabs">
                              <li class="active"><a href="#general" data-toggle="tab">General</a></li>
                              <li><a href="#sendmail" id="add_new_activity_new_stay" data-toggle="tab">Send Email</a></li>
                           </ul>
                           <div class="tab-content">
                              <div class="tab-pane active panel-content" id="general">
                                 <form id="update_completed_activity" class="form-horizontal" method="post" name="update_completed_activity">
                                    <input type="hidden" id="lead_activity_id" name="ub_lead_activity_id" value="<?php if(isset($result_data['ub_lead_activity_id'])) echo $result_data['ub_lead_activity_id'];?>" />
                                    <div class="row">
                                       <div class="col-xs-12">
                                          <div class="pull-right">
                                             <div class="action-btn general-btn-all"> <a href="javascript:void(0);" id="update_completed_activity_new" name="update_completed_activity_new"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save"/></a> <a href="javascript:void(0);"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel"/></a> </div>
                                          </div>
                                       </div>
                                    </div>
                                    <?php if(!empty($result_data['ub_lead_id'])) { ?>
                                    <input type="hidden" name="lead_id" value="<?php if(isset($result_data['ub_lead_id'])) echo $result_data['ub_lead_id'];?>">
                                    <?php } ?>
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
                                          <div class="mark-com "> <span class="pull-left"><strong>Marked Complete</strong> </span> <a class="lead_checked_marked" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'box-1.png'; ?>" alt="check"> </a> <a class="lead_unchecked_marked" href="javascript:void(0);" > <img border="0" src="<?php echo IMAGESRC.'green_tickbox.png'; ?>" alt="tick"> </a>
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
                                             echo form_dropdown('sales_person', $sales_person,$sales_person_selected, "class='selectpicker form-control' id='lead_sales_person' data-live-search='true'"); 
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
                                 </form>
                              </div>
                              <div class="tab-pane" id="sendmail">
                                 <div class="row">
                                    <div class="col-xs-12">
                                       <div class="pull-right">
                                          <div class="action-btn email-btn-all"> <a href="javascript:void(0);" id="completed_compose_email" name="completed_compose_email"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_send"/></a> <a href="javascript:void(0);"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel"/></a> </div>
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
                                    <div class="col-xs-8 ">
                                       <div id="composedmail">
                                          <form id="compose_completed_email" class="form-horizontal" method="post" name="compose_completed_email">
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
                                                <div class="col-xs-12">
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
                                          </form>
                                       </div>
                                       <div  id="mail-thread">
                                          <?php $this->load->view('content/leads/email_thread'); ?>
                                       </div>
                                    </div>
                                    <div class="col-xs-4">
                                       <div class="row col-xs-12 m-top">
                                          <div class="col-xs-12">
                                             <div class="row">
                                                <div class="col-xs-12">
                                                   <label>CLICK HERE to Choose from unibuilder docs</label>
                                                   <div id="actions"> <span class="fileinput-button"></span> </div>
                                                </div>
                                                <div class="col-xs-12 m-top files" id="previews">
                                                   <div id="template" class="file-row">
                                                      <ul>
                                                         <li>
                                                            <div class="preview"><img data-dz-thumbnail /></div>
                                                            <div class="name" data-dz-name></div>
                                                            <div class="close-btn"> <img alt="close" class="delete" data-dz-remove src="<?php echo IMAGESRC.'upload_close.png'; ?>" border="0"/> </div>
                                                            <strong class="error text-danger" data-dz-errormessage></strong>
                                                            <div class="size" data-dz-size></div>
                                                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                               <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                                            </div>
                                                            <div class="button">
                                                               <button class="btn btn-success start"> <i class="glyphicon glyphicon-upload"></i> <span>Upload</span> </button>
                                                               <button data-dz-remove class="btn btn-warning cancel"> <i class="glyphicon glyphicon-ban-circle"></i> <span>Cancel</span> </button>
                                                            </div>
                                                         </li>
                                                      </ul>
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
                        <!-- /tabs --> 
                     </div>
                  </div>
                  <!-- log Completed Activity -->
                  <div class="row Schedule_complete">
                     <div class="col-xs-12">
                        <!-- tabs left -->
                        <div class="tabbable tabs-left m-top">
                           <ul class="nav nav-tabs">
                              <li class="active"><a href="#s_general" data-toggle="tab">General</a></li>
                              <li><a href="#s_sendmail" data-toggle="tab">Send Email</a></li>
                           </ul>
                           <div class="tab-content">
                              <div class="tab-pane active panel-content" id="s_general">
                                 <form id="add_new_activity" class="form-horizontal" method="post" name="add_new_activity">
                                    <div class="row">
                                       <div class="col-xs-12">
                                          <div class="pull-right">
                                             <div class="action-btn s_general-btn-all"> <a href="javascript:void(0);" id="add_new_activity_new" name="add_new_activity_new"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save"/></a> <a href="javascript:void(0);"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel"/></a> </div>
                                          </div>
                                       </div>
                                    </div>
                                    <?php if(!empty($result_data['ub_lead_id'])) { ?>
                                    <input type="hidden" name="lead_id" value="<?php if(isset($result_data['ub_lead_id'])) echo $result_data['ub_lead_id'];?>">
                                    <?php } ?>
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
                                                echo form_dropdown('activity_type', $lead_activity_type,$lead_activity_type_selected, "class='selectpicker form-control' id='s_lead_activity_type' data-live-search='true'"); 
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
                                          <div class="mark-com "> <span class="pull-left"><strong>Marked Complete</strong> </span> <a class="s_lead_checked_marked" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'box-1.png'; ?>" alt="check"> </a> <a class="s_lead_unchecked_marked" href="javascript:void(0);" > <img border="0" src="<?php echo IMAGESRC.'green_tickbox.png'; ?>" alt="tick"> </a>
                                             <input type="hidden" id="s_lead_marked-list" value="No" name="mark_completed_status">
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
                                             echo form_dropdown('sales_person', $sales_person,$sales_person_selected, "class='selectpicker form-control' id='s_lead_sales_person' data-live-search='true'"); 
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
                                             echo form_dropdown('initiated_by', $initiated_bys,$initiated_by, "class='selectpicker form-control' id='s_initiated_by'");
                                             ?>
                                       </div>
                                       <div class="col-xs-3">
                                          <label>Schedule followup</label>
                                          <div class='input-group date' id='s_datetimepicker10' >
                                             <input type="text" class="form-control" name="schedule_followup">
                                             <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                                          </div>
                                       </div>
                                       <div class="col-xs-2">
                                          <label>Time</label>
                                          <div class="form-group">
                                             <div class='input-group date' id='s_schedule-time'>
                                                <input type='text' class="form-control" id="s_followup_time" name="followup_time" placeholder="No Time"/>
                                                <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span> 
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-xs-3">
                                          <label>Activity date</label>
                                          <div class='input-group date' id='s_datetimepicker11'>
                                             <input type="text" class="form-control" id="s_activity_date" name="activity_date">
                                             <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                                          </div>
                                       </div>
                                       <div class="col-xs-3">
                                          <label>Time</label>
                                          <div class="form-group">
                                             <div class='input-group date' id='s_task-time'>
                                                <input type='text' class="form-control" id="s_activity_time" name="time" placeholder="No Time" />
                                                <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span> 
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-3" id="s_reminder">
                                          <label>Reminder</label>
                                          <?php 
                                             $reminder_selected = '';
                                             if(isset($result_data['activity_reminder']))
                                             {
                                               $reminder_selected = explode(",",$result_data['activity_reminder']);
                                             }
                                             echo form_dropdown('reminder_id', $activity_reminder,$reminder_selected, "class='selectpicker form-control' id='s_reminder_id' data-live-search='true'"); 
                                             ?>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-xs-12">
                                          <label>Notes</label>
                                          <textarea class="form-control" name="description"></textarea>
                                       </div>
                                    </div>
                                    <input type="hidden" name="save_type" id="save_type" value="" />
                                 </form>
                              </div>
                              <div class="tab-pane" id="s_sendmail">
                                 <div class="row">
                                    <div class="col-xs-12">
                                       <div class="pull-right">
                                          <div class="action-btn s_email-btn-all"> <a href="javascript:void(0);"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_send"/></a> <a href="javascript:void(0);"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel"/></a> </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row m-top">
                                    <div class="col-xs-8">
                                       <div class="col-xs-3">
                                          <input type="radio"  name="mail" id="s_nomail" value="notmail"/>
                                          Not an Email
                                       </div>
                                       <div class="col-xs-3">
                                          <input type="radio"  name="mail" id="s_compose" value="composedmail"/>
                                          Email Composed Online
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row composedmail ">
                                    <form id="add_new_activity_email" class="form-horizontal" method="post" name="add_new_activity_email">
                                       <input type="hidden" id="module_pk_id_new" name="module_pk_id" value=""/>
                                       <input type="hidden" name="name" id="lead_name_new" class="form-control" value="<?php if(isset($result_data['name'])) echo $result_data['name'];?>"/>
                                       <div class="col-xs-8 ">
                                          <div class="row col-xs-12 m-top">
                                             <div class="col-xs-3">
                                                <input type="checkbox" name="primary_email"/>
                                                Primary email
                                             </div>
                                             <div class="col-xs-3">
                                                <input type="checkbox" name="alter-email"/>
                                                Alternate email
                                             </div>
                                          </div>
                                          <div class="row col-xs-12 m-top">
                                             <div class="col-xs-12">
                                                <label>To</label>
                                             </div>
                                             <div class="col-xs-12">
                                                <input type="text" name="alt_email_to" class="form-control"/>
                                             </div>
                                          </div>
                                          <div class="row col-xs-12 m-top">
                                             <div class="col-xs-12">
                                                <label>Cc</label>
                                             </div>
                                             <div class="col-xs-12">
                                                <input type="text" name="alt_email_cc" class="form-control"/>
                                             </div>
                                          </div>
                                          <div class="row col-xs-12 m-top">
                                             <div class="col-xs-12">
                                                <label>Bcc</label>
                                             </div>
                                             <div class="col-xs-12">
                                                <input type="text" name="alt_email_bcc" class="form-control"/>
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
                                                <textarea class="ckeditor" name="editor12"></textarea>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-4">
                                          <div class="row col-xs-12 m-top">
                                             <div class="col-xs-12">
                                                <div class="row">
                                                   <div class="col-xs-12">
                                                      <label>CLICK HERE to Choose from unibuilder docs</label>
                                                      <div id="actions"> <span class="fileinput-button"></span> </div>
                                                   </div>
                                                   <div class="col-xs-12 m-top files" id="previews1">
                                                      <div id="template1" class="file-row">
                                                         <ul>
                                                            <li>
                                                               <div class="preview"><img data-dz-thumbnail /></div>
                                                               <div class="name" data-dz-name></div>
                                                               <div class="close-btn"> <img alt="close" class="delete" data-dz-remove src="<?php echo IMAGESRC.'upload_close.png'; ?>" border="0"/> </div>
                                                               <strong class="error text-danger" data-dz-errormessage></strong>
                                                               <div class="size" data-dz-size></div>
                                                               <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                                  <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                                               </div>
                                                               <div class="button">
                                                                  <button class="btn btn-success start"> <i class="glyphicon glyphicon-upload"></i> <span>Upload</span> </button>
                                                                  <button data-dz-remove class="btn btn-warning cancel"> <i class="glyphicon glyphicon-ban-circle"></i> <span>Cancel</span> </button>
                                                               </div>
                                                               <input type="hidden" name="save_type" id="save_type" value="" />
                                                            </li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- /tabs --> 
                     </div>
                  </div>
                  <!-- Schedule New Activity -->
                  <div class="row m-top lead_act">
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
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="tab-pane" id="Files">
         <div class="row">
            <div class="col-xs-12">
               <form action="<?=base_url()?>home/testupload" class="dropzone" id="my-awesome-dropzone">
               </form>
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
<script type="text/javascript">        
   this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>';     
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.list_page   = 'yes';     
</script> 
<!-- /Check List Modal -->
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<link rel="stylesheet" href="http://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />
<script type="text/javascript" src="<?php echo JSSRC.'icheck.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-tagsinput.js';?>"></script> 
<script src="<?php echo JSSRC.'Multi_Upload.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'upload.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'upload_files.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/ckeditor.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/adapters/jquery.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'save_lead.js';?>"></script>
