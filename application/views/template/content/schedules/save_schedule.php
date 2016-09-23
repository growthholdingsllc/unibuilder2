<div class="row">
   <ol class="breadcrumb">
      <?php $this->load->view('template/common/breadcrumbs'); ?>
      <li class="active">Schedule Item</li>
   </ol>
</div>
<form id="save_schedule" class="form-horizontal" method="post" name="save_schedule">
   <div class="row">
      <div class="col-xs-12">
         <div class="top-search pull-right">
            <div class="pull-right">
				<!--<a href="javascript:void(0);" data-toggle="modal" data-target="#schedule_modal" >
               <button type="button" class="btn btn-gray  pull-right m-left-1" name="cancel"> <img src="<?php //echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> popup</button>
               </a> -->			
               <a href="#">
               <button type="button" class="btn btn-gray  pull-right m-left-1" id="cancel" name="cancel"> <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</button>
               </a> 
				<!--checking role access // by satheesh kumar  -->
				<?php
				if(isset($this->user_role_access[strtolower('schedules')][strtolower('edit')]) && $this->user_role_access[strtolower('schedules')][strtolower('edit')] == 1 && $this->first_argument > 0)
				{ 
					if(isset($this->project_status_check) && $this->project_status_check == 1)
					{
				?>  
			   <a href="#">
               <button type="submit" class="btn btn-blue  pull-right m-left-1" id="save_and_back" name="save_and_back" value="save_and_back" > <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back </button>
               </a> <a href="#">
               <button type="submit" class="btn btn-blue pull-right m-left-1" name="save_and_stay" id="save_and_stay"> <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
               </a> <a href="#">
               <button type="submit" class="btn btn-blue  pull-right m-left-1" id="save_and_new" name="save_and_new" > <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save &amp; New</button>
               </a> 
				<!--checking role access // by satheesh kumar  -->
				<?php
					}
				}
				else if((isset($this->user_role_access[strtolower('schedules')][strtolower('add')]) && $this->user_role_access[strtolower('schedules')][strtolower('add')] == 1) && $this->first_argument == 0)
				{ 
				?>
			   <a href="#">
               <button type="submit" class="btn btn-blue  pull-right m-left-1" id="save_and_back" name="save_and_back" value="save_and_back" > <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back </button>
               </a> <a href="#">
               <button type="submit" class="btn btn-blue pull-right m-left-1" name="save_and_stay" id="save_and_stay"> <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
               </a> <a href="#">
               <button type="submit" class="btn btn-blue  pull-right m-left-1" id="save_and_new" name="save_and_new" > <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save &amp; New</button>
               </a>  
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
   <!-- Marked Complete field was modified by chandru 09-05-2014 -->
   <div class="row m-top five-col">
      <div class="col-xs-3 <?php if($this->template_id == '' || $this->template_id == 0){ echo 'no_project_selected'; } ?>">
         <?php 
            if( ! empty($this->template_id))
            {
            echo '<label>Template Name</label> : '.$this->template_name;			  
            echo '<input type="hidden" name="project_id" id="project_id" value="'.$this->template_id.'" readonly />';
            }
            ?>
      </div>
      <div class="col-xs-3 pull-right">
         <h4 class="pull-left"><strong>Marked Complete</strong> </h4>
         <span>&nbsp;&nbsp;</span>
         <a href="javascript:void(0);" class="unchecked_marked">
         <img alt="home" src="<?php echo IMAGESRC.'box-1.png'; ?>" border="0"/></a>
         <a href="javascript:void(0);" class="checked_marked">
         <img alt="home" src="<?php echo IMAGESRC.'green_tickbox.png'; ?>" border="0"/></a>
         <input type="hidden" id="is_completed" name="is_completed" value="<?php echo isset($schedule_details['is_completed'])?$schedule_details['is_completed']:'';?>" />
         <input type="hidden" id="hide_is_completed" name="hide_is_completed" value="<?php echo isset($schedule_details['is_completed'])?$schedule_details['is_completed']:'';?>" />
		 
      </div>
   </div>
   <!-- chandru modified code ends here -->
   <div class="row m-top five-col">
      <div class="col-xs-3">
         <label>Title</label>
		 <div class="col-xs-12">
			 <div class="form-group">
			 <input name="title" id="title" type="text" class="form-control" value="<?php echo isset($schedule_details['title'])?$schedule_details['title']:'';?>" />
			 </div>
		 </div>
      </div>
	  <?php 
	  if(isset($this->user_account_type) && BUILDERADMIN==$this->user_account_type)
	  {
	  ?>
      <div class="col-xs-3">
         <label>Phase</label>
         <div class="input-group right-group">
            <?php 
               $phase_selected = '';
               if(isset($schedule_details['phase']) && $schedule_details['phase'] != '')
               {
               	$phase_selected = $schedule_details['phase'];
               }
               echo form_dropdown('phase', $phase_list_dropdown,$phase_selected, "class='selectpicker form-control' id='phase' data-live-search='true'");
               ?>  
			<?php 
			if($this->user_account_type == BUILDERADMIN) {
			?>	
            <span class="input-group-addon"><a href="javascript:void(0);" data-target="#TypeAddModal" data-toggle="modal">
            <img alt="plus" src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>" border="0"/></a>
            <a href="javascript:void(0);" class="TypeEditModal">
            <img alt="minus" src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>" border="0"/></a></span> 
			<?php 
			}
			?>
         </div>
      </div>
	  <?php 
	  }
	  ?>
      <div class="col-xs-3">
         <label>Color Picker</label>         
         <select name="colour" id="colorselector_1" class="form-control">
         <?php 
            $colour_selected = '';
            if(isset($schedule_details['colour']) && $schedule_details['colour'] != '')
            {
            	$colour_selected = $schedule_details['colour'];
            }
            foreach($colour_dropdown as $key => $value)
            {
            	if($key!='')
            	{
            		echo '<option value="'.$key.'" data-color="'.$key.'">'.$value.'</option>';
            	}
            	if($key == $colour_selected)
            	{
            		echo '<option SELECTED value="'.$key.'" data-color="'.$key.'">'.$value.'</option>';
            	}
            }
            ?>
         </select>
      </div>
      <div class="col-xs-3">
         <label>Start Date</label>
		 <div class="col-xs-12">
			<div class="form-group">
				<div class='input-group date' id='datetimepicker3'>
					<input name='start_date' id='start_date' type='text' class="form-control" value="<?php echo isset($schedule_details['start_date'])?$schedule_details['start_date']:''; ?>" readonly  />
					<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
				</div>
			</div>
         </div>
      </div>
      <div class="col-xs-3">
         <label>Duration</label>
		<div class="col-xs-12">
			<div class="form-group">
				<div class="input-group spinner">
					<input name="no_of_days" id="no_of_days" type="text" maxlength="4" class="form-control Duration" value="<?php echo isset($schedule_details['no_of_days'])?$schedule_details['no_of_days']:'1'; ?>" />
					<!--<div class="input-group-btn-vertical">
						<button type="button" class="btn btn-default dur"><i class="glyphicon glyphicon-chevron-up"></i></button>
						<button type="button" class="btn btn-default dur"><i class="glyphicon glyphicon-chevron-down"></i></button>
					</div>-->
				</div>
			</div>
		</div>
      </div>
   </div>
   <div class="row m-top five-col">
      <div class="col-xs-3">
         <label>End Date</label>
		<div class="col-xs-12">
			<div class="form-group">
				<div class='input-group date' id='datetimepicker4' >
					<input name="end_date" id="end_date" type='text' class="form-control" value="<?php echo isset($schedule_details['end_date'])?$schedule_details['end_date']:''; ?>" readonly />
					<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
				</div>
			</div>
		</div>
      </div>
	  <?php 
	  if(isset($this->user_account_type) && BUILDERADMIN == $this->user_account_type)
	  {
	  ?>
      <!--<div class="col-xs-3">
         <div id="load_assigned_to_div">
            <?php //$this->load->view('content/schedules/assigned_to'); ?>
         </div>
      </div>-->
      <div class="col-xs-3">
         <label>Tags</label>
         <div class="col-xs">
            <?php
               $tags_selected = '';
               if(isset($schedule_details['selected_tags']))
               {
               	$tags_selected = $schedule_details['selected_tags'];
               }
               echo form_dropdown('tags[]', $schedule_tags_dropdown , $tags_selected, "class='selectpicker form-control2' id='tags' data-live-search='true' multiple");
               ?>
			<?php 
			if($this->user_account_type == BUILDERADMIN) {
			?>			
            <span class="right-group input-group-addon"><a href="javascript:void(0);" data-target="#TagAddModal" data-toggle="modal">
            <img alt="plus" src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>" border="0"/></a>
            <a href="javascript:void(0);" class="TagsEditModal">
            <img alt="minus" src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>" border="0"/></a></span>
			<?php 
			}
			?>
         </div>
      </div>
	  <?php
		if(isset($schedule_details['ub_template_schedule_id']) && $schedule_details['ub_template_schedule_id']>0)
		{
	  ?>
      <div class="col-xs-3">
         <label>Publish Status</label>
         <p>
            <input type="checkbox" id="publish_status" name="publish_status" value="<?php echo isset($schedule_details['publish_status'])?$schedule_details['publish_status']:'No';?>" <?php if(isset($schedule_details['publish_status']) && $schedule_details['publish_status'] == 'Yes'){ echo 'CHECKED';}?>/>
         </p>
      </div>
	  <?php 
	  }
	  }
	  ?>
   </div>
   <div class="row m-top">
      <div class="col-xs-12">
         <div class="tab-con pull-left">
            <div class="tabpanel">
               <!-- Nav tabs -->
               <ul class="nav nav-tabs" role="tablist">
                  <li role="predecessor" class="active"> <a href="#predecessor" data-toggle="tab">Predecessor</a> </li>
                  <!--<li role="view_access"> <a href="#view_access" data-toggle="tab">View Access</a> </li>-->
                  <li role="notes"> <a href="#notes" data-toggle="tab">Notes</a> </li>
                  <!--<li role="shifts"> <a href="#shifts" data-toggle="tab">Shifts</a> </li>-->
                  <!--<li role="files"> <a href="#files" data-toggle="tab">Files</a> </li>-->
               </ul>
               <!-- Tab panes -->
               <div class="tab-content">
                  <div class="tab-pane active" id="predecessor">
                     <?php $this->load->view('content/schedules/predecessor_tab_content'); ?>
                  </div>
                  <div class="tab-pane" id="notes">
                     <?php $this->load->view('content/schedules/notes_tab_content'); ?>   
                  </div>
				  <?php 
				   /*  if(isset($schedule_details['publish_status']) && $schedule_details['publish_status'] == 'Yes')
					{ 
					  ?>
					  <div class="tab-pane" id="shifts">
						 <?php $this->load->view('content/schedules/shifts_tab_content'); ?>
					  </div>
					  <?php
					} */	
				  ?>
               </div>
            </div>
         </div>
      </div>
   </div>
   <input type="hidden" id="schedule_id" name="schedule_id" value="<?php echo isset($schedule_details['ub_template_schedule_id'])?$schedule_details['ub_template_schedule_id']:'';?>"/>
   <input type="hidden" id="project_id" name="project_id" value="<?php echo isset($this->template_id)?$this->template_id:0;?>"/>
   <input type="hidden" id="save_type" name="save_type" value=""/>
   <input type="hidden" id="hide_db_start_date" name="hide_db_start_date" value="<?php echo isset($schedule_details['start_date'])?$schedule_details['start_date']:'';?>"/>
   <input type="hidden" id="hide_db_end_date" name="hide_db_end_date" value="<?php echo  isset($schedule_details['end_date'])?$schedule_details['end_date']:'';?>"/>
   <input type="hidden" id="hide_db_duration" name="hide_db_duration" value="<?php echo isset($schedule_details['no_of_days'])?$schedule_details['no_of_days']:'';?>"/>
   <input type="hidden" id="hide_db_predecessor_count" name="hide_db_predecessor_count" value="<?php echo (isset($assigned_predecessors) && count($assigned_predecessors)>0)?count($assigned_predecessors):0;?>"/>
   <input type="hidden" id="hide_predecessor_count" name="hide_predecessor_count" value="<?php echo (isset($assigned_predecessors) && count($assigned_predecessors)>0)?count($assigned_predecessors):0;?>"/>
   <input type="hidden" id="assigned_to_selected" name="assigned_to_selected" value="<?php echo isset($assigned_to_selected)?$assigned_to_selected:'';?>"/>
   <input type="hidden" id="pred_manipulated_output" name="pred_manipulated_output" value=""/> 
   <input type="hidden" id="hide_schedule_reason" name="hide_schedule_reason" value=""/>
   <input type="hidden" id="hide_publish_status" name="hide_publish_status" value=""/>
</form>
<!-- Type Add Modal -->
<div class="modal fade" id="TypeAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>New Phase Group
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
                                 <td><input type="text" id="phase_add" class="form-control" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2">
                                    <a class="sprite pull-right" href="javascript:void(0);" id="phase_save">
                                    <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt=" Save" class="save">
                                    Save
                                    </a> 
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
                                 <td><input type="text" id="Edit_phase_group" class="form-control" /><input type="hidden" id="selected" class="form-control"  /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2">
                                    <button type="button" id="Delete_phase" class="btn btn-default btn-secondary pull-right">Delete</button>					 
                                    <button type="button" id="Edit_phase" class="btn btn-default btn-secondary pull-right" >Save</button>
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
<!-- /Type Add Modal -->
<!-- Type Tag Modal -->
<div class="modal fade" id="TagAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>New Tag Group
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
                                 <td><input type="text" name="tags_add" id="tags_add"  class="form-control" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2">
                                    <a class="sprite pull-right" href="javascript:void(0);" id="tags_save">
                                    <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt=" Save" class="save">
                                    Save
                                    </a> 
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
<div class="modal fade" id="TagsEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Edit / Delete Tag
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
                                 <td><input type="text" id="Edit_tag_group" class="form-control" /><input type="hidden" id="selected" class="form-control"  /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2">
                                    <button type="button" id="Delete_tag" class="btn btn-default btn-secondary pull-right">Delete</button>					 
                                    <button type="button" id="Edit_tag" class="btn btn-default btn-secondary pull-right" >Save</button>
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
<div class="modal fade" id="schedule_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Baseline shift reason
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
                                 <td height="20" colspan="2">Comments</td>                                 
                              </tr>
							  <tr>
								<td colspan="2">
									<textarea id="shift_reason" name="shift_reason" class="form-control"></textarea>
								</td>
							  </tr>
                              <tr>
                                 <td height="20" colspan="2">
                                    <a class="sprite pull-right" href="javascript:void(0);" id="btn_shift_reason">
                                    <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt=" Save" class="save">
                                    Save
                                    </a>
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
   this.displayStart   = '<?php echo 0 ?>';
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   var schedule_id = '<?php echo isset($schedule_details['ub_template_schedule_id'])?$schedule_details['ub_template_schedule_id']:0;?>';
   this.file_upload_list_page_user   = '<?php echo $this->user_account_type; ?>'; 
</script>
<!-- /Type Tag Modal -->
<link rel="stylesheet" href="<?php echo CSSSRC.'file-tree.min.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-colorselector.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script> 
<script src="<?php echo JSSRC.'bootstrap-colorselector.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-template-datatable.js';?>"></script>
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.jscrollpane.css';?>">	
<!--<script type="text/javascript" src="<?php echo JSSRC.'file-tree.min.js';?>"></script>-->
<script type="text/javascript" src="<?php echo JSSRC.'enscroll-0.6.0.min.js';?>"></script>
<script type="text/javascript" src="<?php echo TEMPSRC.'save_schedule.js';?>"></script>