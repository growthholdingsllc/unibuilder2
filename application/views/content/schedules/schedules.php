<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?>
      <!--<li class="active">Schedules</li>-->
   </ol>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
         <div class="btn-group pull-right">
			<?php
			if(isset($this->user_role_access[strtolower('schedules')][strtolower('add')]) && ($this->user_role_access[strtolower('schedules')][strtolower('add')] == 1 || $this->user_role_access[strtolower('schedules')][strtolower('Add Exception')] == 1))
			{
				if(isset($this->project_status_check) && $this->project_status_check == 1)
				{	
			?>
            <button type="button" class="btn btn-blue dropdown-toggle" data-toggle="dropdown"><img class="uni_new" src="<?php echo IMAGESRC.'strip.gif'; ?>"> New <span class="caret"></span> </button>
            <ul class="dropdown-menu" role="menu">
				<?php
				if(isset($this->user_role_access[strtolower('schedules')][strtolower('add')]) && $this->user_role_access[strtolower('schedules')][strtolower('add')] == 1)
				{ 
				?>
               <li><a href="<?php echo base_url(); ?>c2NoZWR1bgxf1VzL3NhdmVfc2NoZWR1bgxf1Uv">Schedule Item</a></li>
			   <?php 
			   }
			   ?>
				<?php
				if(isset($this->user_role_access[strtolower('schedules')][strtolower('Add Exception')]) && $this->user_role_access[strtolower('schedules')][strtolower('Add Exception')] == 1)
				{ 
				?>
				<li class="divider"></li>
				<li><a href="<?php echo base_url(); ?>c2NoZWR1bgxf1VzL3NhdmVfd29ya19kYXlfZXhjZXB0aW9uLw--">Workday Exception</a></li>
				<?php 
				}
				?>
            </ul>
			<?php 
				}
			}
			?>
         </div>
		<?php 
			if($this->user_account_type == BUILDERADMIN) 
			{ 
				if(isset($this->project_status_check) && $this->project_status_check == 1)
				{
					$this->load->view('common/import_template'); 
				}
			} 
		?>
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
      <div class="panel-content pull-left">
         <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
               <div class="panel-heading" role="tab" id="filter">
                  <h4 class="panel-title">
                     <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     FILTER ALL YOUR RESULTS &nbsp;&nbsp; <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span>
                     </a>
                  </h4>
               </div>
               <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
                  <form name="Search_Result" method="post" class="form-horizontal" id="Search_Result">
                     <div class="panel-body col-xs-12">
                        <div class="row five-col primary_filt">
                           <div class="col-xs-3">
                              <label>Assigned to</label>
							 <div class="col-xs-12">
								 <div class="form-group">
										<?php 
										$assigned_selected = '';
										if(isset($search_session_array['assigned_users']))
										{
										$assigned_selected = explode(",",$search_session_array['assigned_users']);
										}
										echo form_dropdown('assigned_users[]', $user_name_drop_down, $assigned_selected, "class='selectpicker form-control' id='assigned_users' data-live-search='true' multiple"); 
										?>
								 </div>
							 </div>
                           </div>
                           <div class="col-xs-3">
                              <label>Status</label>
                              <!--  <select class="selectpicker form-control" name="status" id="status">
                                 <option value="">Nothing selected</option>
                                 <option>Upcoming Items</option>
                                 <option>Completed Items</option>
                                 <option>In progress Items</option>
                                 </select> -->
                              <?php 
                                 $status_selected = '';
                                   if(isset($search_session_array['status']))
                                   {
                                 	$status_selected = explode(",",$search_session_array['status']);
                                   }
                                 echo form_dropdown('status', $schedules_status,$status_selected, "class='selectpicker form-control' id='status'"); 
                                 ?>
                           </div>
                           <div class="col-xs-3">
                              <label>Tags</label>
                              <!-- <select class="selectpicker form-control" data-live-search="true" multiple>                              
                                 <option>option1</option>
                                 <option>option2</option>
                                 </select> -->
                              <?php 
                                 $tag_selected = '';
                                 if(isset($search_session_array['tags']))
                                 	{
                                 	 $tag_selected = explode(",",$search_session_array['tags']);
                                 	}
                                                   echo form_dropdown('tags[]', $schedules_tags_array, $tag_selected, "class='selectpicker form-control' id='tags' data-live-search='true' multiple"); 
                                           ?>
                           </div>
                           <div class="col-xs-3 phase_filt">
                              <label>Phase</label>
                              <!-- <select class="selectpicker form-control">
                                 <option value="">Nothing selected</option>
                                 <option>Painting</option>
                                 </select> -->
                              <?php 
                                 $phase_selected = '';
                                 if(isset($search_session_array['phase']))
                                 	{
                                 	 $phase_selected = explode(",",$search_session_array['phase']);
                                 	}
                                                   echo form_dropdown('phase[]', $schedules_phase_array, $phase_selected, "class='selectpicker form-control' id='phase' data-live-search='true' multiple"); 
                                           ?>
                           </div>
                           <div class="col-xs-3 date_range_filt">
                              <label>Date Range</label>
                              <div class="input-prepend input-group">                      
                                 <input type="text" name="daterange"  class="form-control" id="list_date_range" value="<?php echo isset($search_session_array['daterange'])?$search_session_array['daterange']:''; ?>" readonly  /> 					    
                                 <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar daterange"></span></span>
                              </div>
                           </div>
                        </div>
                        <div class="row five-col event_filter">
                           <div class="col-xs-3">
                              <label>Event Name</label>
                              <input type="text" id="event" name="event" class="form-control" value="<?php echo isset($search_session_array['event'])?$search_session_array['event']:''; ?>" />
                           </div>
                        </div>
                        <div class="row five-col workdays_filter">
                           <div class="col-xs-3">
                              <label>Type</label>
                              <!-- <select class="selectpicker form-control" id="workdays_type" name="workdays_type">     
                                 <option value="">Nothing selected</option>
                                                    <option>Non Workday</option>
                                                    <option>Extra Workday</option>
                                                 </select> -->
								<div class="col-xs-12">
									<div class="form-group">
									<?php 
									$type_selected = '';
									if(isset($search_session_array['exception_type']))
									{
									$type_selected = explode(",",$search_session_array['exception_type']);
									}
									echo form_dropdown('exception_type', $exception_type,$type_selected, "class='selectpicker form-control' 
									id='exception_type'"); 
									?>
									</div>
								</div>
                           </div>
                           <div class="col-xs-3">
                              <label>Categories</label>
                              <input type="text" id="workdays_category" name="category"
                                 value="<?php echo isset($search_session_array['category'])?$search_session_array['category']:''; ?>" class="form-control" />
                           </div>
                        </div>
                        <div class="row text-center">
                           <button type="submit" id="update_result" class="btn btn-blue">Update Results</button>
                           <button type="button" id="schedules_search_reset" class="btn btn-gray">Reset</button>							 
                           <button type="submit" id="save_filter" class="btn btn-gray">Save Filter</button>	
                           <?php if(TRUE === $apply_filter){ ?>
                           <button type="button" class="btn btn-gray" id="apply_filter" name="apply_filter">Apply Saved Filter</button> 
                           <?php } ?>						
                        </div>
                     </div>
               </div>
            </div>
         </div>
         </form>
      </div>
      <div class="tab-con pull-left">
         <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
				<?php 
				if((isset($owner_calender_access) && $this->user_account_type == OWNER && $owner_calender_access == 'Yes') || ($this->user_account_type == BUILDERADMIN) || ($this->user_account_type == SUBCONTRACTOR))
				{
				?>
               <li role="presentation" class="active">
                  <a href="#Full_Calendar" aria-controls="Calendar" data-toggle="tab">Calendar</a>
               </li>
			   <?php 
			    }
				if(isset($this->user_account_type) && $this->user_account_type == BUILDERADMIN)
				{
				?>
               <li role="presentation">
                  <a href="#listview" aria-controls="listview" data-toggle="tab">List View</a>
               </li>
			   <?php 
			   }
			   ?>
                <li role="presentation" class="<?php if((isset($owner_calender_access) && $this->user_account_type == OWNER &&$owner_calender_access == 'No')){echo 'active';}?>">
                  <a href="#Gantt" aria-controls="Gantt" data-toggle="tab">Gantt</a>
               </li>
			    <?php 
				if(isset($this->user_account_type) && $this->user_account_type == BUILDERADMIN)
				{
				?>
               <li role="presentation">
                  <a href="#baselineview" aria-controls="baselineview" data-toggle="tab">Baseline View</a>
               </li>
               <li role="presentation">
                  <a href="#workdays" aria-controls="workdays" data-toggle="tab">Work Days</a>
               </li>
               <li role="presentation">
                  <a href="#phaselist" aria-controls="phaselist" data-toggle="tab">Phase List</a>
               </li>
			   <?php 
			   }
			   ?>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
				<?php 
				if((isset($owner_calender_access) && $this->user_account_type == OWNER && $owner_calender_access == 'Yes') || ($this->user_account_type == BUILDERADMIN) || ($this->user_account_type == SUBCONTRACTOR))
				{
				?>
               <div class="tab-pane active" id="Full_Calendar">
                  <div id="calendar"></div>
               </div>
			   <?php 
			   }
			   ?>
               <div class="tab-pane" id="listview">
				    <div class="row datatable-bor">
						 <div class="add-function">
							 <div class="col-xs-3 pull-left">
							   <select id="schedule_bulk_action" name="schedule_bulk_action" class="selectpicker form-control" onchange="return publish_schedules(this.value);">
								  <option value="">Bulk Actions</option>
								  <option value="publish_all">Start Creating Baseline For All</option>
							   </select>
							</div>
						 </div>
					</div>
                  <table class="table table-bordered datatable" id="schedule_list" width="100%">
                     <thead>
                        <tr>
                           <th>Schedule Item Name</th>
                           <th>Status</th>
                           <th>Phase</th>
                           <th>Start</th>
                           <th>Finish</th>
                           <th>Assignees</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>
               <div class="tab-pane <?php if((isset($owner_calender_access) && $this->user_account_type == OWNER && $owner_calender_access == 'No')){echo 'active';}?>" id="Gantt">
                  <!--<div class="gantt"></div>-->
                  <div id="gantt_here" style="width:100%;height:100%;"></div>
               </div>
               <div class="tab-pane" id="baselineview">
                  <table class="table table-bordered datatable" id="Calendar_Baselineview" width="100%">
					<thead>
                        <tr>
                           <th>Schedule Item Name</th>
                           <th>Status</th>
                           <th>Duration (Base Duration)</th>
                           <th>Start Date (Base Start Date)</th>
                           <th>End Date (Base End Date)</th>
                           <th>Direct Shifts</th>
                           <th>Duration Change</th>
                           <th>Overall Slip</th>
                           <th>Assigned To</th>
                        </tr>
                     </thead>
					 <tbody>
                     </tbody>	
				  </table>
               </div>
               <div class="tab-pane" id="workdays">
                  <table class="table table-bordered datatable" id="workdays_exception" width="100%">
                     <thead>
                        <tr>
                           <th>Title</th>
                           <th>StartDate</th>
                           <th>EndDate</th>
                           <th>Days</th>
                           <th>Type</th>
                           <th>Category</th>
                           <th>Same Every Year</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>
               <div class="tab-pane" id="phaselist">
                  <table class="table table-bordered datatable" id="calendar_phaselist" width="100%">
                  <thead>
                     <tr>
                        <th><input type="checkbox" id="selectlist" name="all"/></th>
                        <th>Phase Title</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>No of Associated Items</th>
                        <th>Completed Items</th>
                        <th>Phase Status</th>
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
				  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade confirmModal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Are you sure you want to publish all schedule?       
      </h4>
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
            <div class="modal-con">              
              <div class="row col-xs-12">                				
				<button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="cancel_icon"/> CANCEL</button>  
				<button class="btn btn-blue m-left-1 pull-right" type="button" id="publish_confirm"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_dick"/> OK</button>				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>

<input type="hidden" id="schedule_index" value="" />
<input type="hidden" id="current_tab" name="current_tab" value="<?php if(isset($owner_calender_access) && $this->user_account_type == OWNER && $owner_calender_access == 'No'){echo 'Gantt';}else{echo 'Full_Calendar';}?>" />
<input type="hidden" id="previous_tab" name="previous_tab" value="" />
<script type="text/javascript">        
   this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>';
   this.displayStart   = '<?php echo 0 ?>';
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.list_page   = 'yes';     
   this.user_account_type   = '<?php echo $this->user_account_type; ?>';     //code added by satheesh
</script>
<!--<link rel="stylesheet" href="<?php /** echo CSSSRC.'gantt.css'; */ ?>"  > -->
<link rel="stylesheet" href="<?php echo CSSSRC.'dhtmlxgantt.css';  ?>" />
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'fullcalendar.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-colorselector.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'icheck.min.js';?>"></script>
<!--<script type="text/javascript" src="<?php /** echo JSSRC.'jquery.fn.gantt.js'; */ ?>"></script> -->
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script> 
<script src="<?php echo JSSRC.'fullcalendar.js';?>"></script>
<script src="<?php echo JSSRC.'fullcalendar_schedule.js';?>"></script>
<link rel="stylesheet" href="<?php echo CSSSRC.'daterangepicker-bs3.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'date_moment.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'daterangepicker.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dhtmlxgantt.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dhtmlxgantt_tooltip.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'schedules.js';?>"></script>