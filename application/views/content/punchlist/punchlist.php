<div class="row">
  <ol class="breadcrumb">
    <?php //$this->load->view('common/breadcrumbs'); ?> 
    <!--<li class="active">Punch list</li>-->
  </ol>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="top-search pull-right">
		<?php
		if(isset($this->user_role_access[strtolower('punchlist')][strtolower('add')]) && $this->user_role_access[strtolower('punchlist')][strtolower('add')] == 1)
		{
			if(isset($this->project_status_check) && $this->project_status_check == 1)
			{
		?>
		<div class="pull-right ">
        <!--<button type="button" href="#" class="btn btn-default btn-primary pull-right m-left-1 " data-toggle="modal" data-target="#myModal">Import Tasks</button>-->
        <a href="<?php echo base_url().$this->crypt->encrypt('punchlist/save_punchlist/'); ?>" class="btn btn-blue  pull-right">
			<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_new"/> New Punch List
		</a>
		</div>
		<?php 
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
                <div class="col-xs-3">
                  <label>Status</label>
				  <div class="col-xs-12">
					  <div class="form-group">
					  <select class="selectpicker form-control" id="status" name="status">
						<option value="">Nothing selected</option>
						<option value="completed" <?php if(isset($search_session_array['status'])&& $search_session_array['status'] == 'completed'){ ?> selected <?php } ?>>Completed</option>
						<option value="notcompleted" <?php if(isset($search_session_array['status'])&& $search_session_array['status'] == 'notcompleted'){ ?> selected <?php } ?>>Not Complete</option>
						
					  </select>
					</div>
                </div>
                </div>
                <div class="col-xs-3">
                  <label>Priority</label>
                  <?php 
						$priority_selected = '';
					   if(isset($search_session_array['priority']))
					   {
							$priority_selected = explode(",",$search_session_array['priority']);
					   }
						echo form_dropdown('priority', $punchlist_priority,$priority_selected, "class='selectpicker form-control' id='priority' data-live-search='true'"); 
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
						echo form_dropdown('tags[]', $punchlist_tags, $tags_selected, "class='selectpicker form-control' id='tags' data-live-search='true' multiple"); 
				  ?>
                </div>
              </div>
              <div class="row five-col">
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
					if(isset($this->user_role_access[strtolower('punchlist')][strtolower('delete')]) && $this->user_role_access[strtolower('punchlist')][strtolower('delete')] == 1)
					{
					?>
                     <div class="col-xs-3 pull-left">
                        <select class="selectpicker form-control" onchange="delete_all_checked_punchlists(this.value)" title="Task Actions"><option value="">Bulk Actions</option>
						<option value="delete_multi_tasks">Delete Checked Punch List</select>
                     </div>
					<?php 
					}
					?>
                  </div>

  <div class="col-xs-12 pull-left">
    <table class="table table-bordered datatable" id="Punch_list" width="100%">
      <thead>
        <tr>
          <th><input type="checkbox" id="selectall" name="all"/></th>
		  <th>Title</th>
          <th>Priority</th>
          <th>Created by</th>
          <th>Tags</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
     
    </table>
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
   this.list_page   = 'yes';    
</script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'date_moment.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'punchlist.js';?>"></script>