<div class="row">
   <ol class="breadcrumb">
       <?php $this->load->view('template/common/breadcrumbs'); ?>
      <li class="active">Template Details</li>
   </ol>
</div>
<form id="save_template" class="form-horizontal" method="post" name="save_template">
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
         <div class="pull-right ">
			<a href="<?php echo base_url();?>cHJvamVjdHMvaW5kZXgv">
			<button type="button" class="btn btn-gray pull-right m-left-1" id="btn_cancel">
				<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel
			</button>
			</a>
         
         <?php if(isset($template_data['ub_template_id']))
         { ?>
         <button class="btn btn-blue pull-right m-left-1" type="button" id="<?php if(isset($template_data['ub_template_id'])) echo $template_data['ub_template_id']; ?>" onclick="delete_template(this.id)">
            <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_delete"/> Delete
         </button>
			
			<?php } ?>
				<button type="submit" name="add_template_new_back" id="add_template_new_back" class="btn btn-blue pull-right m-left-1"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back</button>
				<button type="submit" class="btn btn-blue pull-right m-left-1" name="add_template_new_stay" id="add_template_new_stay"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
				<button type="submit" name="add_template_new" id="add_template_new" class="btn btn-blue pull-right m-left-1"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/>  Save &amp; New</button>
			
            <!--</a> -->
         </div>
      </div>
	  <input type="hidden" name="save_type" id="save_type" value="" />
	  
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
            
            <!-- Tab panes -->
             <input type="hidden" name="ub_template_id" id="ub_template_id" value="<?php echo (isset($template_data['ub_template_id']) && $template_data['ub_template_id'] > 0)?$template_data['ub_template_id']:0 ?>" />
            
               <div class="tab-pane active" id="jobinfo">
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Template Information</h4>
                     </div>
                     <div class="panel-body">
                        <div class="row panel-content five-col">
                           
                          <div class="col-xs-3">
                          <label>Project Group</label>
                          <div class="col-xs-12">
                          <div class="form-group">
                          <div class="col-xs">
                          <?php 
                          $selected_tags = '';
                          if(isset($template_data['project_group']))
                          {
                          $selected_tags = explode(",",$template_data['project_group']);
                          }
                          echo form_dropdown('project_group[]', $project_group_array,$selected_tags, "class='selectpicker form-control2' id='project_group' data-live-search='true' multiple");
                          ?>                          
                          <span class="right-group input-group-addon"><a href="javascript:void(0);" data-target="#TypeAddModal" data-toggle="modal"><img alt="plus" src="<?php echo IMAGESRC.'icon_plus1_1.png'?>" border="0"/></a> <a href="javascript:void(0);" class="TypeEditModal"><img alt="minus" src="<?php echo IMAGESRC.'icon_minus1_1.png'?>" border="0"/></a></span> 
                          </div>
                          </div>
                          </div>
                          </div>

                          <div class="col-xs-3">
                                       <div class="col-xs-12">
                             <div class="form-group">
                          	  <label>Template Name</label>
                          	  <input name="template_name" id="template_name" type="text" 
                          	  value="<?php echo isset($template_data['template_name'])?$template_data['template_name']:'' ?>"
                          	   class="form-control"/>
                             </div>
                            </div>
                          </div>

                          
                          
                          <div class="col-xs-3">
                          <label>New Start Date</label>
                          <div class="col-xs-12">
                          <div class="form-group">
                          <div class='input-group date' id='datetimepicker8'>
                          <input type='text' class="form-control" name="projected_start_date" id="projected_start_date"value="<?php if(isset($template_data['projected_start_date'])) echo date("m/d/Y", strtotime($template_data['projected_start_date']));?>" />
                          <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                          </div>
                          </div>
                          </div>
                          </div>
                                                 
                          
                        </div>
                        
                         <div class="row panel-content five-col">
                            <div class="row">
                            <div class="col-xs-7 checklist">
                               <label>Work Days</label>
                            <?php
                            if(isset($template_data['work_days']))
                            { ?>
                               <div> 
                            <span>Mon
                                  <input name="work_days[]" value="0" type="checkbox" <?php if(isset($template_data['work_days']) && strstr($template_data['work_days'], '0')) echo  "checked='checked'";?>/>
                                  </span> <span>Tue
                                  <input name="work_days[]" value="1" type="checkbox" <?php if(isset($template_data['work_days']) && strstr($template_data['work_days'], '1')) echo  "checked='checked'";?>/>
                                  </span> <span>Wed
                                  <input name="work_days[]" value="2" type="checkbox" <?php if(isset($template_data['work_days']) && strstr($template_data['work_days'], '2')) echo  "checked='checked'";?>/>
                                  </span> <span>Thu
                                  <input name="work_days[]" value="3" type="checkbox" <?php if(isset($template_data['work_days']) && strstr($template_data['work_days'], '3')) echo  "checked='checked'";?>/>
                                  </span> <span>Fri
                                  <input name="work_days[]" value="4" type="checkbox" <?php if(isset($template_data['work_days']) && strstr($template_data['work_days'], '4')) echo  "checked='checked'";?>/>
                                  </span> <span>Sat
                                  <input name="work_days[]" value="5" type="checkbox" <?php if(isset($template_data['work_days']) && strstr($template_data['work_days'], '5')) echo  "checked='checked'";?>/>
                                  </span>
                                <span>Sun
                                  <input name="work_days[]" value="6" type="checkbox" <?php if(isset($template_data['work_days']) && strstr($template_data['work_days'], '6')) echo  "checked='checked'";?>/>
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
                 
                  
               </div>
			  
</form>

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

				<p class="text-left">You have (8) Punch lists Open.</p>
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
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.signaturepad.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'jquery.signaturepad.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'custom_map.js';?>"></script> 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<link rel="stylesheet" href="http://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-tagsinput.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script>  
<script type="text/javascript" src="<?php echo TEMPSRC.'save_template.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'json2.min.js';?>"></script>