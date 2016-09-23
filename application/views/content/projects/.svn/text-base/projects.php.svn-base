<?php
$current_view_data =  (isset($grid_settings_popup['grid_current_view_data']))?$grid_settings_popup['grid_current_view_data']:'';
$datatable_grid_settings_id = (isset($grid_settings_popup['datatable_grid_settings_id']))?$grid_settings_popup['datatable_grid_settings_id']:'';
$mapped_status_index = (isset($grid_settings_popup['mapped_status_index']))?$grid_settings_popup['mapped_status_index']:'';
$contract_price_index = (isset($grid_settings_popup['contract_price_index']))?$grid_settings_popup['contract_price_index']:'';
$datatable_column = (isset($grid_settings_popup['datatable_column']))?$grid_settings_popup['datatable_column']:'';
//echo "<pre>";print_r($datatable_column);
?>
<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?>
      <!--<li class="active">Projects List</li>-->
   </ol>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
		<?php
		if(isset($this->user_role_access[strtolower('projects')][strtolower('add')]) && $this->user_role_access[strtolower('projects')][strtolower('add')] == 1 && $show_add_button == TRUE)
		{ 
		?>
         <div class="btn-group pull-right">
			<button class="btn btn-blue pull-right dropdown-toggle" data-toggle="dropdown" type="button">
				<img border="0" class="uni_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> New Project <span class="caret"></span>
			</button>
            <ul class="dropdown-menu" role="menu">
               <li><a href="<?php echo base_url().$save_project_url; ?>">From Scratch</a></li>               
               <li><a href="<?php echo base_url().$this->crypt->encrypt('projects/from_template/'); ?>">From Template</a></li>               
            </ul>
         </div>
		 <?php 
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
                     FILTER YOUR RESULTS &nbsp;&nbsp; <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span>
                     </a>
                  </h4>
               </div>
               <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
                  <div class="panel-body col-xs-12 ">
                     <form id="Search_Result" class="form-horizontal" method="post" name="Search_Result">
                        <div class="row five-col">
                           <div class="col-xs-3">
                              <label>Project Group</label>
							  <?php 
								 $project_group_selected = '';
								   if(isset($search_session_array['project_group']))
								   {
										$project_group_selected = explode(",",$search_session_array['project_group']);
								   }
								 echo form_dropdown('project_group', $project_group,$project_group_selected, "class='selectpicker form-control' id='project_group' data-live-search='true' multiple"); 
							  ?>
                           </div>
                           <div class="col-xs-3">
                              <label>Project Manager</label>
							  <?php 
								 $project_managers_selected = '';
								   if(isset($search_session_array['project_managers']))
								   {
										$project_managers_selected = explode(",",$search_session_array['project_managers']);
								   }
								 echo form_dropdown('project_managers', $project_managers,$project_managers_selected, "class='selectpicker form-control' id='project_managers' data-live-search='true' multiple"); 
							  ?>
                           </div>
                           <div class="col-xs-3">
                              <label>Project Status</label>
							  <div class="col-xs-12">
							  <div class="form-group">
							  <?php 
								 $project_status_selected = '';
								   if(isset($search_session_array['project_status']))
								   {
										$project_status_selected = explode(",",$search_session_array['project_status']);
								   }
								 echo form_dropdown('project_status', $project_status,$project_status_selected, "class='selectpicker form-control' id='project_status'"); 
							  ?>
							  </div>
							  </div>
                           </div>
                           <div class="col-xs-3" id="mapped_status_div">
                              <label>Mapped Status</label>
							  <?php 
								 $mapped_projects_selected = '';
								   if(isset($search_session_array['mapped_projects']))
								   {
										$mapped_projects_selected = explode(",",$search_session_array['mapped_projects']);
								   }
								 echo form_dropdown('mapped_projects', $mapped_projects,$mapped_projects_selected, "class='selectpicker form-control' id='mapped_projects'"); 
							  ?>
                           </div>
                        </div>
                        <div class="row text-center">
                           <button type="submit" class="btn btn-blue" id="update_result">Update Results</button>
                           <a href="javascript:void(0);"><button type="submit" class="btn btn-gray" id="project_search_reset" >Reset</button></a>
						   <a href="javascript:void(0);">						 
                           <button type="submit" class="btn btn-gray" id="save_filter" name="save_filter">Save Filter</button></a>
						   <?php if(TRUE === $apply_filter){ ?>
						   <a href="javascript:void(0);">						 
                           <button type="button" class="btn btn-gray" id="apply_filter" name="apply_filter">Apply Saved Filter</button></a>
						   <?php } ?>
                        </div>
						<input type="hidden" value="export" id="fetch_type" name="fetch_type" />
						<input type="hidden" id="datatable_grid_id" name="datatable_grid_id" value="<?php if(isset($datatable_grid_settings_id)){echo $datatable_grid_settings_id;}?>">

                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="tab-con pull-left">
         <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
               <li role="presentation" class="active pro_list">
                  <a href="#Project_list" aria-controls="Project_list" data-toggle="tab">List</a>
               </li>
               <li class="map_list" role="presentation">
                  <a href="#Project_map" aria-controls="Project_map" data-toggle="tab">Map</a>
               </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane active" id="Project_list">
                  <div class="row">
                  <div class="add-function">
					<?php 
					if(isset($this->user_role_access[strtolower('projects')][strtolower('delete')]) && $this->user_role_access[strtolower('projects')][strtolower('delete')] == 1)
					{
					?>
                     <div class="col-xs-3 pull-left">
                        <select class="selectpicker form-control" onchange="delete_all(this.value);" title="Project Actions">
                           <option value="">Bulk Actions</option>
                           <option value="delete_projects">Delete checked projects</option>
                        </select>
                     </div>
					<?php 
					}
					?>
                     <div class="col-xs-3 pull-right">
                     <div class="pull-right">
						<?php 
						if(isset($this->user_account_type) && $this->user_account_type == BUILDERADMIN)
						{
						?>
						<a data-target="#JobslistModal" data-toggle="modal" href="javascript:void(0);">
						<img title="Grid settings" class="uni_settings" src="<?php echo IMAGESRC.'strip.gif'; ?>">
						</a>
						<?php 
						}
						if(isset($this->user_role_access[strtolower('projects')][strtolower('export excel')]) && $this->user_role_access[strtolower('projects')][strtolower('export excel')] == 1)
						{
						?>
						 <a href="javascript:void(0);" ><img title="Export to excel" class="uni_excel" id="export_file" name="export_file" src="<?php echo IMAGESRC.'strip.gif'; ?>"></a>
						<?php 
						}
						?>
					 </div>
					 </div>
                  </div>
                  </div>
                  <table class="table table-bordered datatable pull-left" id="Projects_List">
                     <thead>
                        <tr>
                           <th><input type="checkbox" id="selectall" name="all"/></th>
                           <?php 
							foreach($datatable_headers as $key => $column)
							{
								echo "<th>".$column['display_column_name']."</th>";
							}
						   ?>
						   
						   
						   <!--<th>Project Name</th>
                           <th>Address</th>
                           <th>City</th>
                           <th>State</th>
                           <th>Zip</th>
                           <th>Project Manager</th>
                           <th>Owner</th>
                           <th>Phone</th>
                           <th>Cell Phone</th>
                           <th>Project Status</th>
                           <th>Map</th>-->
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>
               <div class="tab-pane" id="Project_map">
                  <div id="Project_map_div">
                  </div>
               </div>
			   <input type="hidden" id="last_searched_map" name="last_searched_map" value="">
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /Job List Modal -->
<div class="modal fade" id="JobslistModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" id="grid_settings_popup">
		<?php $this->load->view('common/dynamic/grid_settings'); ?>	
		 
      </div>
   </div>
</div>
<input type="hidden" id="project_index" value="" />
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
var datatable_column = ''      
this.default_pagination_length   = '<?php echo isset($search_session_array['iDisplayLength'])?$search_session_array['iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>';
   this.displayStart   = '<?php echo isset($search_session_array['iDisplayStart'])?$search_session_array['iDisplayStart']:0; ?>';         
this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
this.list_page   = 'yes';   
this.google_map_data = ''; 	
this.center_port_lat = <?php echo GOOGLE_MAP_CENTER_PORT_LAT; ?>; 
this.center_port_lng = <?php echo GOOGLE_MAP_CENTER_PORT_LNG; ?> ;  
this.current_view_data = <?php if(isset($current_view_data)){ echo json_encode($current_view_data);} ?>;   
this.datatable_column = <?php if(isset($datatable_column)){ echo json_encode($datatable_column);} ?>;   

this.controller = '<?php echo $this->module; ?>';
this.datatable_map_column_index = '<?php echo $mapped_status_index; ?>';
this.datatable_contract_price_column_index = '<?php echo $contract_price_index; ?>';
$(function() {
    $('.tabs').bind('change', function (e) {
        // e.target is the new active tab according to docs
        // so save the reference in case it's needed later on
        window.activeTab = e.target;
        // display the alert
        alert("hello");
        // Load data etc
    });
});   
</script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php echo JSSRC.'map-location.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'icheck.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'projects.js';?>"></script>
<!-- /Job List Modal -->