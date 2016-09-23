<?php 
$current_view_data =  (isset($grid_settings_popup['grid_current_view_data']))?$grid_settings_popup['grid_current_view_data']:'';
$datatable_grid_settings_id = (isset($grid_settings_popup['datatable_grid_settings_id']))?$grid_settings_popup['datatable_grid_settings_id']:'';
$datatable_column = (isset($grid_settings_popup['datatable_column']))?$grid_settings_popup['datatable_column']:'';
$performance_timing_index = (isset($grid_settings_popup['performance_timing_index']))?$grid_settings_popup['performance_timing_index']:'';
?>
<div class="row">
  <ol class="breadcrumb">
    <?php //$this->load->view('common/breadcrumbs'); ?> 
    <!--<li class="active">Task</li>-->
  </ol>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="top-search pull-right">
		<!--checking role access  // by satheesh -->
		<?php
		if(isset($this->user_role_access[strtolower('task')][strtolower('add')]) && $this->user_role_access[strtolower('task')][strtolower('add')] == 1)
		{ 
		?>
		<?php if($this->project_status_check == 1)
		{
		?>
		<div class="pull-right ">
        <!--<button type="button" href="#" class="btn btn-default btn-primary pull-right m-left-1 " data-toggle="modal" data-target="#myModal">Import Tasks</button>-->
        <a href="<?php echo base_url(); ?>dgxf1Fzay9zYXZlX3Rhc2sv" class="btn btn-blue  pull-right">
			<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_new"/> New Task
		</a>
		</div>
		<?php } ?>
		<?php if($this->user_account_type == BUILDERADMIN) { ?>
		<?php $this->load->view('common/import_template'); ?>
		<?php } ?>
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
  <div class="col-xs-12 pull-left">
    <div class="panel-content pull-left">
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="filter">
            <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> FILTER ALL YOUR ACTIONS &nbsp;&nbsp; <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span> </a> </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
            <div class="panel-body col-xs-12">
			<form id="Search_Result" class="form-horizontal" method="post" name="Search_Result">
              <div class="row five-col">
			  <?php 
			  if(isset($this->user_account_type) && OWNER!=$this->user_account_type && SUBCONTRACTOR!=$this->user_account_type)
			  {
			  ?>
                <div class="col-xs-3">
                  <label>Assigned To</label>
					<?php 
					$related_to_me_dropdown = '';
					if(isset($search_session_array['related_to_me']))
					{
					$related_to_me_dropdown = explode(",",$search_session_array['related_to_me']);
					}
					echo form_dropdown('related_to_me[]', $related_to_me_dropdowns,$related_to_me_dropdown, "class='selectpicker form-control' id='related_to_me' multiple"); 
					?>
                </div>
                <div class="col-xs-3">
                  <label>User</label>
                  <?php 
				   $users_selected = '';
				   if(isset($search_session_array['assigned_to']))
				   {
						$users_selected = explode(",",$search_session_array['assigned_to']);
				   }
				   array_unshift($get_all_users,"Nothing Selected");
				   echo form_dropdown('assigned_to', $get_all_users, $users_selected, "class='selectpicker form-control' id='assigned_to' data-live-search='true'"); 
				   ?>
                </div>
				<?php 
				}
				?>
                <div class="col-xs-3">
                  <label>Status</label>
				  <div class="col-xs-12">
					  <div class="form-group">
					  <select class="selectpicker form-control" id="status" name="status">
						<option value="">Nothing selected</option>
						<option value="Completed" <?php if(isset($search_session_array['status'])&& $search_session_array['status'] == 'Completed'){ ?> selected <?php } ?>>Completed</option>
						<option value="Not completed" <?php if(isset($search_session_array['status'])&& $search_session_array['status'] == 'Not completed'){ ?> selected <?php } ?>>Not Complete</option>
						
					  </select>
					</div>
                </div>
                </div>
				<?php 
				if(isset($this->user_account_type) && OWNER!=$this->user_account_type && SUBCONTRACTOR!=$this->user_account_type)
				{
				?>
                <div class="col-xs-3">
                  <label>Priority</label>
                  <?php 
						$priority_selected = '';
					   if(isset($search_session_array['priority']))
					   {
							$priority_selected = explode(",",$search_session_array['priority']);
					   }
						echo form_dropdown('priority', $task_priority,$priority_selected, "class='selectpicker form-control' id='priority' data-live-search='true'"); 
				  ?>
                </div>
                <div class="col-xs-3">
                  <label>Tags</label>
				  <?php 
						$tags_selected = '';
					   if(isset($search_session_array['tags']))
					   {
							$tags_selected = explode(",",$search_session_array['tags']);
					   }
						echo form_dropdown('tags[]', $task_tags, $tags_selected, "class='selectpicker form-control' id='tags' data-live-search='true' multiple"); 
				  ?>
                </div>
              </div>
              <div class="row five-col">
			   <div class="col-xs-3">
                  <label>Date Range</label> 
					<div class="col-xs-12">				  
					<div class="form-group">				  
					<div class="input-prepend input-group">                      
					   <input type="text" name="daterange"  class="form-control" value="<?php echo isset($search_session_array['daterange'])?$search_session_array['daterange']:''; ?>" id="daterange" readonly /> 					    
						<span class="input-group-addon"> <span class="glyphicon-calendar glyphicon daterange"></span></span>
                     </div>
					 
                </div>
                </div>
                </div>
				<?php 
				}
				?>
                <div class="col-xs-6">
                  <label>&nbsp;</label>
                  <div >
                    <button type="submit" class="btn  btn-blue" id="update_result" name="update_result">Update Results</button>
                    <button type="submit" class="btn btn-gray" id="task_search_reset" name="task_search_reset" >Reset</button>
                    <button type="submit" class="btn btn-gray" id="save_filter" name="save_filter" >Save Filter</button>
					<?php if($apply_filter == TRUE){ ?>
					<a href="javascript:void(0);"><button type="button" class="btn btn-gray" id="apply_save_filter" name="apply_save_filter" >Apply Saved Filter</button></a>
					<?php } else{ ?>
					<a href="javascript:void(0);"><button type="button" class="btn btn-gray" id="apply_save_filter" name="apply_save_filter" style="display:none;" >Apply Saved Filter</button></a>
					<?php } ?>
					<input type="hidden" value="export" id="fetch_type" name="fetch_type" />
                  </div>
                </div>
              </div>
			  <input type="hidden" id="datatable_grid_id" name="datatable_grid_id" value="<?php if(isset($datatable_grid_settings_id)){echo $datatable_grid_settings_id;}?>">
			  </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
 <div class="add-function">
					<!--checking role access  // by satheesh -->
					<?php 
					if(isset($this->user_role_access[strtolower('task')][strtolower('delete')]) && $this->user_role_access[strtolower('task')][strtolower('delete')] == 1)
					{
					?>
                     <div class="col-xs-3 pull-left">
                        <select class="selectpicker form-control" onchange="delete_all_checked_tasks(this.value)" title="Task Actions"><option value="">Bulk Actions</option>
						<option value="delete_multi_tasks">Delete Checked Tasks</select>
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
						<a data-target="#JobslistModal" data-toggle="modal" href="javascript:void(0);"><img class="uni_settings" src="<?php echo IMAGESRC.'strip.gif'; ?>"></a>
						<!--checking role access  // by satheesh -->
						<?php 
						}
						if(isset($this->user_role_access[strtolower('task')][strtolower('export excel')]) && $this->user_role_access[strtolower('task')][strtolower('export excel')] == 1)
						{
						?>
						<a href="javascript:void(0);"><img id="export_file" name="export_file" class="uni_excel" src="<?php echo IMAGESRC.'strip.gif'; ?>"></a>
						<?php 
						}
						?>
						
					 </div>
					 </div>
                  </div>

  <div class="col-xs-12 pull-left">
    <table class="table table-bordered datatable" id="Task_List" width="100%">
      <thead>
        <tr>
          <th><input type="checkbox" id="selectall" name="all"/></th>
		 <?php 
			foreach($datatable_headers as $key => $column)
			{
				echo "<th>".$column['display_column_name']."</th>";
			}
		   ?>

          <!--<th>Title</th>
          <th>Priority</th>
          <th>Assigned to</th>
          <th>Due</th>
          <th>Created by</th>
          <th>Tag</th>-->
        </tr>
      </thead>
      <tbody>
      </tbody>
     
    </table>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4 class="modal-title" id="myModalLabel">Import To Do From Template <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h4>
      <div class="modal-body">
	  <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
        <label>Source Template</label>
        <p>
          <select class="selectpicker form-control">
            <option>Choose from template</option>
          </select>
        </p>
		 <div class="text-right">
        <button type="button" class="btn btn-primary">Import To Dos</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
      </div>
      </div>
      </div>
      </div>
     
    </div>
  </div>
</div>
<div class="modal fade" id="JobslistModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" id="grid_settings_popup">
		<?php $this->load->view('common/dynamic/grid_settings'); ?>	
      </div>
   </div>
</div>
<input type="hidden" id="task_index" value="" />
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
   this.default_pagination_length   = '<?php echo isset($search_session_array['iDisplayLength'])?$search_session_array['iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>';
   this.displayStart   = '<?php echo isset($search_session_array['iDisplayStart'])?$search_session_array['iDisplayStart']:0; ?>';     
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';  
	this.controller = '<?php echo $this->module; ?>';   
	this.current_view_data = <?php if(isset($current_view_data)){ echo json_encode($current_view_data);} ?>; 
	this.datatable_column = <?php if(isset($datatable_column)){ echo json_encode($datatable_column);} ?>;  	
	this.datatable_performance_timing_index = '<?php echo $performance_timing_index; ?>';
   this.list_page   = 'yes';     
</script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<link rel="stylesheet" href="<?php echo CSSSRC.'daterangepicker-bs3.css'; ?>">
<script type="text/javascript" src="<?php echo JSSRC.'date_moment.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'daterangepicker.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'task.js';?>"></script>