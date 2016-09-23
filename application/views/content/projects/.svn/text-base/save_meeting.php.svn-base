<div class="row">
  <ol class="breadcrumb">
    <?php //$this->load->view('common/breadcrumbs'); ?> 
    <!--<li class="active">New Meeting</li>-->
  </ol>
</div>
<form id="add_new_mom" class="form-horizontal" method="post" name="add_new_mom">
<div class="row">
  <div class="col-xs-12">
    <div class="top-search pull-right">
      <div class="pull-right col-xs-12"> 
		<a href="<?php echo base_url();?>cHJvamVjdHMvbWVldgxf1luZy8-"><button type="button" class="btn btn-gray pull-right m-left-1"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</button></a>
		<?php if(!empty($mom_data['ub_mom_id'])) 
		{
			if(isset($this->project_status_check) && $this->project_status_check == 1)
			{
		?>
		<button class="btn btn-blue pull-right m-left-1" type="button" id="<?php if(isset($mom_data['ub_mom_id'])) echo $mom_data['ub_mom_id']; ?>" onclick="delete_meeting(this.id)"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_delete"/> Delete</button>
		<?php 
			} 
		}
		?>
		<?php 
		if(isset($this->project_status_check) && $this->project_status_check == 1)
		{
		?>
		<button type="submit" class="btn btn-blue pull-right m-left-1" id="add_mom_new_back" name="add_mom_new_back" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back </button>		
		<button type="submit" class="btn btn-blue pull-right m-left-1" id="add_mom_new" name="add_mom_new" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/>  Save &amp; New</button>        
		<button type="submit" class="btn btn-blue pull-right m-left-1" name="add_mom_new_stay" id="add_mom_new_stay"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button> 
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
<div class="row m-top">
  <div class="col-xs-12">
    <div class="panel panel-default logs-wrapper">
      <div class="panel-heading" role="tab" id="filter">
        <h4 class="panel-title">Minutes of Meeting</h4>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-xs-3">
            <div class="<?php if($this->project_id == '' && !isset($mom_data['project_id'])){ echo 'no_project_selected'; } ?>">
			<?php 
			   /* $project_selected = '';
			   if(isset($mom_data['project_id']))
			   {
					$project_name = explode(',' , $project_list[$mom_data['project_id']]);
					echo form_dropdown('project_id', $project_name, '', "class='selectpicker form-control' id='project' data-live-search='true'"); 
					//echo $project_list[$mom_data['project_id']];
					echo '<input type="hidden" name="project_id" id="project" value="'.$mom_data['project_id'].'" />';
			   }
			   else
			   {
					echo '<label>Select Project</label>';
					echo form_dropdown('project_id', $project_list, $project_selected, "class='selectpicker form-control' id='project' data-live-search='true'"); 
			   } */
			   if(!empty($this->project_id) && !isset($mom_data['project_id']))
			   {
			   // echo '<label>Project Name</label> : '.$this->project_name;			  
			   echo '<input type="hidden" name="project_id" id="project" value="'.$this->project_id.'" />';
			   }
			   else if(isset($mom_data['project_id']))
			   {
			   // echo '<label>Project Name</label> : '.$project_list[$mom_data['project_id']];			  
			   echo '<input type="hidden" name="project_id" id="project" value="'.$mom_data['project_id'].'" />';
			   }
			 ?>
			 </div>			
          </div>
        </div>
        <hr/>
        <div class="row">
          <div class="pull-right col-xs-12 two-box">
            <div class="col-xs-6">
              <div class="row">
                <div class="col-xs-10">
                  <label>Meeting Title</label>
				  <div class="col-xs-12">
					  <div class="form-group">
					  <input type="text" id="title" name="title" maxlength="72" class="form-control" value="<?php echo isset($mom_data['title'])?$mom_data['title']:'' ?>"/>
					  </div>
				  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10">
                  <label>Agenda</label>
                  <textarea class="form-control" id="agenda" name="agenda" ><?php echo isset($mom_data['agenda'])?$mom_data['agenda']:'' ?></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-5">
                  <label>Date Held</label>
					<div class="col-xs-12">
					<div class="form-group">
					  <div id="datetimepicker5" class="input-group date">
						<input type="text" class="form-control" id="datetime" name="datetime" value="<?php echo isset($mom_data['mom_date'])? date("m/d/Y", strtotime($mom_data['mom_date'])):'' ?>">
						<span class="input-group-addon"> <span class="glyphicon-calendar glyphicon"></span> </span> 
					  </div>
					</div>
					</div>
                </div>
                <div class="col-xs-5">
                  <label>Time</label>
                  <div id="datetimepicker9" class="input-group time date">
                    <input type="text" class="form-control" id="mom_time" name="mom_time" value="<?php echo isset($mom_data['mom_time'])? date("g:i A", strtotime($mom_data['mom_time'])):'' ?>">
                    <span class="input-group-addon"> <span class="glyphicon-time glyphicon"></span> </span> </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-5">
                  <label>Meeting Type</label>
                  <div class="col-xs">
                    <?php 
				   $type_selected = '';
				   if(isset($mom_data['type']))
				   {
						$type_selected = explode(",",$mom_data['type']);
				   }
				   echo form_dropdown('type[]', $mom_type, $type_selected, "class='selectpicker form-control2' id='meetingType' data-live-search='true' multiple"); 
				   ?>
                    <span class="right-group input-group-addon"><a href="javascript:void(0);" data-target="#MeetingAddModal" data-toggle="modal"> <img alt="plus" src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>" border="0"/></a> <a href="javascript:void(0);" class="MeetingEditModal"><img alt="plus" src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>" border="0"/></a></span> </div>
                </div>
                <div class="col-xs-5">
                  <label>Tags</label>
                  <div class="col-xs">
                   <?php 
				   $tag_selected = '';
				   if(isset($mom_data['tags']))
				   {
						$tag_selected = explode(",",$mom_data['tags']);
				   }
				   echo form_dropdown('tags[]', $mom_tags, $tag_selected, "class='selectpicker form-control2' id='tagType' data-live-search='true' multiple"); 
				   ?>
                    <span class="right-group input-group-addon"><a href="javascript:void(0);" data-target="#TagAddModal" data-toggle="modal"> <img alt="plus" src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>" border="0"/></a> <a href="javascript:void(0);" class="TagEditModal"><img alt="plus" src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>" border="0"/></a></span> </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-5">
                  <label>Attendees</label>
				  <div class="col-xs-12">
					  <div class="form-group">
						  <?php 
						   $attendees_selected = '';
						   if(isset($mom_data['attendees']))
						   {
								$attendees_selected = explode(",",$mom_data['attendees']);
						   }
						   echo form_dropdown('attendees[]', $all_type_users, $attendees_selected, "class='selectpicker form-control' id='attendees' data-live-search='true' multiple"); 
						   ?> 
					   </div>
				   </div>
                </div>
                <div class="col-xs-5">
                  <label>Conducted By</label>
				  <div class="col-xs-12">
					  <div class="form-group">
                      <?php 
					   $conducted_by_selected = '';
					   if(isset($mom_data['conducted_by']))
					   {
							$conducted_by_selected = $mom_data['conducted_by'];
					   }
					   array_unshift($all_type_users,"Nothing Selected");
					   echo form_dropdown('conducted_by', $all_type_users, $conducted_by_selected, "class='selectpicker form-control' id='conducted_by' data-live-search='true'"); 
					   ?> 
                </div>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-5">
                  <label>Location</label>
                  <div class="col-xs">
                    <?php 
					   $location_selected = '';
					   if(isset($mom_data['location']))
					   {
							$location_selected = explode(",",$mom_data['location']);
					   }
					   echo form_dropdown('location[]', $mom_location, $location_selected, "class='selectpicker form-control2' id='location' data-live-search='true' multiple"); 
				    ?>
                    <span class="right-group input-group-addon"><a href="javascript:void(0);" data-target="#locationAddModal" data-toggle="modal"> <img alt="plus" src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>" border="0"/></a> <a href="javascript:void(0);" class="locationEditModal" ><img alt="plus" src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>" border="0"/></a></span> </div>
                </div>
                <div class="col-xs-5">
                  <label>Status / Outcome</label>                 
                    <?php 
				   $status_selected = '';
				   if(isset($mom_data['status']))
				   {
						$status_selected = $mom_data['status'];
				   }
				   echo form_dropdown('status', $mom_status, $status_selected, "class='selectpicker form-control' id='status' data-live-search='true'"); 
				   ?>                  
                </div>
              </div>
            </div>
			
            <div class="col-xs-6">
              <div class="row meeting-editor">
                <div class="col-xs-12">
                  <label>Minutes</label>
                  <textarea class="ckeditor" name="editor1" id="editor1"><?php echo isset($mom_data['description'])?$mom_data['description']:'' ?></textarea>
                </div>
				
              </div>
              <div class="row">
                <div class="col-xs-12">
					<p class="text-primary"><a href="javascript:void(0);" class="text-primary" data-target="#docs_upload_Modal" data-toggle="modal"><u>Click Here</u></a>  to Choose from Unibuilder docs</p>
                  <label>Photo(s)</label>
                  <?php $this->load->view('common/upload.php');?>
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
<input type="hidden" name="ub_mom_id" id="ub_mom_id" value="<?php echo (isset($mom_data['ub_mom_id']) && $mom_data['ub_mom_id'] > 0)?$this->ci_object->ci_encrypt($mom_data['ub_mom_id'], $this->encrypt_key):0 ?>" />
</form>
<!-- Type Meeting Modal -->
<div class="modal fade" id="MeetingAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>New Meeting Type
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
                                 <td><input type="text" id="meeting_group" class="form-control" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" id="save_meeting" class="btn btn-default btn-secondary pull-right">Save</button></td>
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
<div class="modal fade" id="MeetingEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                 <td><input type="text" id="edit_meeting_group" class="form-control" /><input type="hidden" id="selected_meeting" class="form-control"  /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2">
                                    <button type="button" id="meeting_group_delete" class="btn btn-default btn-secondary pull-right">Delete</button>					 
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
<!-- /Type Meeting Modal -->

<!-- Type Tag Modal -->
<div class="modal fade" id="TagAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                 <td><input type="text" id="tag_group" class="form-control" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" id="save_type_tag" class="btn btn-default btn-secondary pull-right">Save</button></td>
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
<div class="modal fade" id="TagEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                 <td><input type="text" id="edit_tag_group" class="form-control" /><input type="hidden" id="selected_tag" class="form-control"  /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2">
								 <button type="button" id="tag_group_delete" class="btn btn-default btn-secondary pull-right">Delete</button>
                                    <!--<button type="button" id="Delete_project" class="btn btn-default btn-secondary pull-right">Delete</button>					 
                                    <button type="button" id="edit_tag_delete" class="btn btn-default btn-secondary pull-right" >Save</button> -->
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
<!-- /Type Tag Modal -->

<!-- Type Status Modal -->
<div class="modal fade" id="locationAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>New Location
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
                                 <td><input type="text" id="location_group" class="form-control" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" id="save_location" class="btn btn-default btn-secondary pull-right">Save</button></td>
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
<div class="modal fade" id="locationEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                 <td><input type="text" id="edit_location_group" class="form-control" /><input type="hidden" id="selected_location" class="form-control"  /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2">
                                    <button type="button" id="location_group_delete" class="btn btn-default btn-secondary pull-right">Delete</button>					 
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
<!-- /Type Status Modal -->
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
					<button class="btn btn-success" type="button" onclick="copy_file_to_temp()">Upload</button>
				</div>
			</div>
		</div>
      </div>
   </div>
</div>
<link rel="stylesheet" href="<?php echo CSSSRC.'file-tree.min.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo JSSRC.'moment.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/ckeditor.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/adapters/jquery.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.mjs.nestedSortable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'file-tree.min.js';?>"></script>
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.jscrollpane.css';?>">	
<script type="text/javascript" src="<?php echo JSSRC.'enscroll-0.6.0.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'save_mom.js';?>"></script>
<script data-sample="1">
CKEDITOR.replace( 'editor1', {
  toolbar: [    
   { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] }
    ]
	
});
</script>