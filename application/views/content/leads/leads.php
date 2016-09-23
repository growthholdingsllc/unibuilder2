<?php 
$current_view_data =  (isset($grid_settings_popup['grid_current_view_data']))?$grid_settings_popup['grid_current_view_data']:'';
$datatable_grid_settings_id = (isset($grid_settings_popup['datatable_grid_settings_id']))?$grid_settings_popup['datatable_grid_settings_id']:'';
$datatable_column = (isset($grid_settings_popup['datatable_column']))?$grid_settings_popup['datatable_column']:'';
?>
<script>   
   this.data_table   = '<?php echo $data_table; ?>';
   this.fullcalendar = '<?php echo $fullcalendar; ?>';     
   this.listview     = '<?php echo $listview; ?>';     
   this.activityview = '<?php echo $activityview; ?>';     
   this.Activity_Calendar = '<?php echo $Activity_Calendar; ?>';     
</script>
<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?>
      <!--<li class="active">Leads</li>-->
   </ol>
</div>
<?php
if(isset($this->user_role_access[strtolower('leads')][strtolower('add')]) && $this->user_role_access[strtolower('leads')][strtolower('add')] == 1)
{ 
?>
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">                  
         <a href="<?php echo base_url(); ?>bgxf1VhZHMvc2F2ZV9sZWFkLw--">
		 <button type="button" class="btn btn-blue  pull-right"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="New Lead" class="uni_new" /> New Lead</button>
		 </a>
      </div>
	</div>
</div>
<?php 
}
?>
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
                     FILTER ALL YOUR ACTIONS &nbsp;&nbsp; <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span>
                     </a>
                  </h4>
               </div>
               <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
                  <form id="Search_Result" name="Search_Result" method="post" class="form-horizontal">
                     <div class="panel-body col-xs-12">
                        <div class="row five-col">
                           <div class="col-xs-3">
                              <label>Status</label> 
								<div class="col-xs-12">
									<div class="form-group">
									<?php 
									$status_selected = '';
									if(isset($search_session_array['status']))
									{
									$status_selected = $search_session_array['status'];
									}
									echo form_dropdown('status', $lead_status,$status_selected, "class='selectpicker form-control' id='lead_status' data-live-search='true'"); 
									?>                                   
									</div>
								</div>
                           </div>
                           <div class="col-xs-3">
                              <label>Sales Person</label>
							  <div class="col-xs-12">
									<div class="form-group">
                              <?php 
                                 $sales_person_selected = '';
                                    if(isset($search_session_array['sales_person']))
                                    {
                                 		$sales_person_selected = $search_session_array['sales_person'];
                                    }
                                 	echo form_dropdown('sales_person', $sales_person,$sales_person_selected, "class='selectpicker form-control' id='lead_sales_person' data-live-search='true'"); 
                                 ?>
									</div>
								</div>
                           </div>
                           <div class="col-xs-3">
                              <label>Age</label>
							  <div class="col-xs-12">
									<div class="form-group">
                              <?php 
                                 $age_selected = '';
                                  if(isset($search_session_array['age']))
                                  {
                                 $age_selected = $search_session_array['age'];
                                  }
                                 echo form_dropdown('age', $lead_age,$age_selected, "class='selectpicker form-control' id='lead_age' data-live-search='true'"); 
                                 ?>
									</div>
								</div>
                           </div>
                           <div class="col-xs-3">
                              <label>Tags</label>
							  <div class="col-xs-12">
									<div class="form-group">
                              <?php 
                                 $tag_selected = '';
                                 if(isset($search_session_array['tags']))
                                 {
                                 $tag_selected = explode(",",$search_session_array['tags']);
                                 }
                                 echo form_dropdown('tags', $lead_tags,$tag_selected, "class='selectpicker form-control' id='lead_tags' data-live-search='true' multiple"); 
                                 ?>
									</div>
								</div>
                           </div>
                           <div class="col-xs-3">
						   <div class="col-xs-12">
									<div class="form-group">
                              <label>Source</label>
                              <?php 
                                 $source_selected = '';
                                  if(isset($search_session_array['source']))
                                  {
                                 $source_selected = explode(",",$search_session_array['source']);
                                  }
                                 echo form_dropdown('source', $lead_source,$source_selected, "class='selectpicker form-control' id='lead_source' data-live-search='true' multiple"); 
                                 ?>
									</div>
								</div>
                           </div>
                        </div>
                        <div class="row five-col">
                           <div class="col-xs-3">
                              <label>Project Type</label>
							  <div class="col-xs-12">
									<div class="form-group">
                              <?php 
                                 $type_selected = '';
                                 if(isset($search_session_array['project_type']))
                                 {
                                 $type_selected = explode(",",$search_session_array['project_type']);
                                 }
                                 echo form_dropdown('project_type', $lead_project_type,$type_selected, "class='selectpicker form-control' id='lead_project_type' data-live-search='true' multiple"); 
                                 ?>
									</div>
								</div>
                           </div>
                           <div class="col-xs-3">
                              <label>Lead Name</label>
							<div class="col-xs-12">
								<div class="val-man col-xs-12">
									<div class="form-group">
										 <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($search_session_array['name'])?$search_session_array['name']:''; ?>" />
									</div>
								</div>
							</div>
                           </div>
                        </div>
                        <div class="row text-center">     
                           <button type="submit" class="btn btn-blue" id="update_result" name="update_result">Update Results</button>
                           <button type="submit" class="btn btn-gray" id="lead_search_reset" name="lead_search_reset" >Reset</button>							 
                           <button type="submit" class="btn btn-gray" id="save_filter" name="save_filter">Save Filter</button>	
                           <?php if($apply_filter == TRUE){ ?>
                           <button type="submit" class="btn btn-gray" id="apply_save_filter" name="apply_save_filter">Apply Saved Filter</button>
                           <?php } else{ ?>
                           <a href="javascript:void(0);"><button type="submit" class="btn btn-gray" id="apply_save_filter"name="apply_save_filter" style="display:none;" >Apply Saved Filter</button></a>
                           <?php } ?>
                        </div>
                        <input type="hidden" value="export" id="fetch_type" name="fetch_type" />
                     </div>
					 <input type="hidden" id="datatable_grid_id" name="datatable_grid_id" value="<?php if(isset($datatable_grid_settings_id)){echo $datatable_grid_settings_id;}?>">
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="tab-con pull-left">
         <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
               <li role="presentation" class="active">
                  <a href="#List-View" aria-controls="List-View" data-toggle="tab">List View</a>
               </li>
               <li role="presentation">
                  <a href="#Activity-View" class="activity_view" aria-controls="Activity-View" data-toggle="tab">Activity View</a>
               </li>
               <li role="presentation">
                  <a href="#Activity-Calendar" class="Activity-Calendar" aria-controls="Activity-Calendar" data-toggle="tab">Activity Calendar</a>
               </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane active" id="List-View">
                  <div class="row datatable-bor">
                     <div class="add-function">
						<?php 
						if(isset($this->user_role_access[strtolower('leads')][strtolower('delete')]) && $this->user_role_access[strtolower('leads')][strtolower('delete')] == 1)
						{
						?>
                        <div class="col-xs-3 pull-left">
                           <select class="selectpicker form-control" onchange="delete_all_checked_leads(this.value)" title="Check_list Actions">
                              <option value="">Bulk Actions</option>
                              <option value="delete_multi_leads">Delete Checked Leads</option>
                           </select>
                        </div>
						<?php 
						}
						?>
                        <div class="col-xs-3 pull-right">
						<?php 
						if(isset($this->user_role_access[strtolower('leads')][strtolower('export excel')]) && $this->user_role_access[strtolower('leads')][strtolower('export excel')] == 1)
						{
						?>
						<a href="javascript:void(0);"><img id="export_file" class="uni_excel" name="export_file" src="<?php echo IMAGESRC.'strip.gif'; ?>"></a>
						<?php 
						}
						?>
						<a data-target="#lead_grid_modal" data-toggle="modal" href="javascript:void(0);"><img class="uni_settings" src="<?php echo IMAGESRC.'strip.gif'; ?>"></a></div>
                     </div>
                  </div>
                  <table class="table table-bordered datatable" id="Lead_list">
                     <thead>
					 <tr>
					 <th><input type="checkbox" id="selectall" name="all"/></th>
					 <?php 
					 	foreach($datatable_headers as $key => $column)
						{
							echo "<th>".$column['display_column_name']."</th>";
						} 
					   ?>
					     </tr>
                           <!--
                           <th>Name</th>
                           <th>Status</th>
                           <th>Age</th>
                           <th>Confidence</th>
                           <th>Est.Revenue</th>
                           <th>Last Contacted</th>
                           <th>Sales Person</th>
                           <th>Lead Source</th>
                           <th>Project Type</th>-->
                      
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>
               <div class="tab-pane" id="Activity-View">
                  <div class="row datatable-bor">
                  </div>
                  <table class="table table-bordered datatable" id="lead_activity_view" width="100%">
                     <thead>
                        <tr>
                           <th><input type="checkbox" id="selectall" name="all"/></th>
                           <th>Activity Type</th>
                           <th>Sales Person</th>
                           <th>Lead</th>
                           <th>Due By</th>
                           <th>Follow Up</th>
                           <th>Update</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>
               <div class="tab-pane" id="Activity-Calendar">
                  <div id='calendar'></div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /List Modal -->
<div class="modal fade" id="lead_grid_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" id="grid_settings_popup">
		<?php $this->load->view('common/dynamic/grid_settings'); ?>	
      </div>
   </div>
</div>

<!-- /List Modal -->
<!-- Calendar Modal -->
<div id="event-management" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Event Management <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con1">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /Calendar Modal -->
<input type="hidden" id="lead_index" value="" />
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

<div id="pagination_area">


   <input type="hidden" value="<?php echo isset($search_session_array['activity_iDisplayLength'])?$search_session_array['activity_iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>" id="activity_iDisplayLength" />
   <input type="hidden" value="<?php echo isset($search_session_array['activity_iDisplayStart'])?$search_session_array['activity_iDisplayStart']:0; ?>" id="activity_iDisplayStart" />

   <input type="hidden" value="<?php echo isset($search_session_array['list_iDisplayLength'])?$search_session_array['list_iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>" id="list_iDisplayLength" />
   <input type="hidden" value="<?php echo isset($search_session_array['list_iDisplayStart'])?$search_session_array['list_iDisplayStart']:0; ?>" id="list_iDisplayStart" />


   
</div>

<script type="text/javascript">        
   this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>';
   this.displayStart   = '<?php echo 0; ?>';         
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>'; 
	this.controller = '<?php echo $this->module; ?>';   
	this.current_view_data = <?php if(isset($current_view_data)){ echo json_encode($current_view_data);} ?>; 
	this.datatable_column = <?php if(isset($datatable_column)){ echo json_encode($datatable_column);} ?>;  	
   
   this.list_page   = 'yes';     
</script>
<link rel="stylesheet" href="<?php echo CSSSRC.'fullcalendar.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'fullcalendar.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'fullcalendar_script.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'icheck.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'leads.js';?>"></script>