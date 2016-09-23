<div class="row">
  <ol class="breadcrumb">
    <?php //$this->load->view('common/breadcrumbs'); ?> 
    <!--<li class="active">Check List</li>-->
  </ol>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="top-search pull-right">
		<?php
		if(isset($this->user_role_access[strtolower('checklist')][strtolower('add')]) && $this->user_role_access[strtolower('checklist')][strtolower('add')] == 1)
		{ 
			if(isset($this->project_status_check) && $this->project_status_check == 1)
			{
		?>
		<div class="pull-right ">
			<a href="<?php echo base_url(); ?>Y2hlY2tsaXN0L3NhdmVfY2hlY2tsaXN0Lw--" class="btn btn-blue pull-right"><img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_new"> New</a> 
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
		  <form id="Search_Result" class="form-horizontal" method="post" name="Search_Result">
          <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
            <div class="panel-body col-xs-12">
              <div class="row five-col">
                <div class="col-xs-3">
                  <label>Select Project</label>
				  <div class="col-xs-12">
						<div class="form-group">
						<?php 
						$project_selected = '';
						if(isset($search_session_array['project_id']))
						{
						$project_selected = explode(",",$search_session_array['project_id']);
						}
						echo form_dropdown('project_id', $project_list, $project_selected, "class='selectpicker form-control' id='project' data-live-search='true'"); 
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
				   echo form_dropdown('tags[]', $check_list_tags, $tag_selected, "class='selectpicker form-control' id='tagType' data-live-search='true' multiple"); 
				   ?>
						</div>
					</div>
                </div>
                <div class="col-xs-3">
                  <label>Category</label>
				   <div class="col-xs-12">
						<div class="form-group">
                  <?php 
				   $category_selected = '';
				   if(isset($search_session_array['category']))
				   {
						$category_selected = explode(",",$search_session_array['category']);
				   }
				   echo form_dropdown('category[]', $category_tags, $category_selected, "class='selectpicker form-control' id='categoryType' data-live-search='true' multiple"); 
				   ?>
						</div>
					</div>
                </div>
              </div>
              <div class="row row text-center">
                <button type="submit" class="btn btn-blue" id="update_result" name="update_result">Update Results</button>
                <button type="submit" class="btn btn-gray" id="check_list_search_reset" name="check_list_search_reset" >Reset</button>
                <button type="submit" class="btn btn-gray" id="save_filter" name="save_filter" >Save Filter</button>
				<?php if($apply_filter == TRUE){ ?>
                <button type="button" class="btn btn-gray" id="apply_save_filter" name="apply_save_filter">Apply Saved Filter</button>
				<?php } else{ ?>
				<a href="javascript:void(0);"><button type="button" class="btn btn-gray" id="apply_save_filter"name="apply_save_filter" style="display:none;" >Apply Saved Filter</button></a>
				<?php } ?>
				
              </div>
			  <input type="hidden" value="export" id="fetch_type" name="fetch_type" />
            </div>
          </div>
		  </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 pull-left">
  <div class="row datatable-bor">
   <div class="add-function">
		<?php 
		if(isset($this->user_role_access[strtolower('checklist')][strtolower('delete')]) && $this->user_role_access[strtolower('checklist')][strtolower('delete')] == 1)
		{
		?>
		<div class="col-xs-3 pull-left">
			<select class="selectpicker form-control" onchange="delete_all_checked_checklist(this.value)" title="Check_list Actions">
				<option value="">Bulk Actions</option>
				<option value="delete_multi_check_list">Delete Checked Checklists</option>
			</select>        
		</div>  
		<?php 
		}
		?>		
		<div class="col-xs-3 pull-right">
		<?php 
		if(isset($this->user_role_access[strtolower('checklist')][strtolower('export excel')]) && $this->user_role_access[strtolower('checklist')][strtolower('export excel')] == 1)
		{
		?>
		<a href="javascript:void(0);"><img id="export_file" class="uni_excel" name="export_file" src="<?php echo IMAGESRC.'strip.gif'; ?>"></a>
		<?php 
		}
		?>
		
		<!--<a data-target="#ChecklistModal" data-toggle="modal" href="javascript:void(0);"><img src="<?php echo IMAGESRC.'icon_settings1_1.png'; ?>"></a>--></div>
   </div>
</div>    
  </div>
  <div class="col-xs-12 pull-left">
    <table class="table table-bordered datatable" id="Check_List_table" name="Check_List_table" width="100%">
      <thead>
        <tr>
          <th><input type="checkbox" id="selectall" name="all"/></th>
          <th>Checklist</th>
          <th>Project</th>
          <th>Tags</th>
          <th>Category</th>
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
      <h4 class="modal-title" id="myModalLabel">Import Task From Template
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </h4>
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
                <button type="button" class="btn btn-primary">Import Tasks</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
	   <h4>Grid Settings <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h4>
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
									<td>
									<input type='text' class="form-control" placeholder="Standard View234" />
									</td>
								</tr>
								<tr>
									<td>Is Default</td>
									<td><input type="checkbox" /> Is Default</td>
								</tr>
								<tr>
									<td class="text-center" colspan="2"><button class="btn btn-default btn-primary" type="button">APPLY VIEW</button> <button class="btn btn-default btn-primary" type="button">SAVE AS VIEW</button> <button class="btn btn-default btn-primary" type="button">UPDATE SELECTED</button></td>
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
<input type="hidden" id="checklist_index" value=""/>
<form id="Search_Result_export" class="form-horizontal hide" method="post" name="Search_Result_export">
  <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
	<div class="panel-body col-xs-12">
	  <div class="row five-col">
		<div class="col-xs-3">
		  <label>Select Project</label>
		  <div class="col-xs-12">
				<div class="form-group">
				<?php 
				$project_selected = '';
				if(isset($search_session_array['project_id']))
				{
				$project_selected = explode(",",$search_session_array['project_id']);
				}
				echo form_dropdown('project_id', $project_list, $project_selected, "class='selectpicker form-control' id='project' data-live-search='true'"); 
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
		   echo form_dropdown('tags[]', $check_list_tags, $tag_selected, "class='selectpicker form-control' id='tagType' data-live-search='true' multiple"); 
		   ?>
				</div>
			</div>
		</div>
		<div class="col-xs-3">
		  <label>Category</label>
		   <div class="col-xs-12">
				<div class="form-group">
		  <?php 
		   $category_selected = '';
		   if(isset($search_session_array['category']))
		   {
				$category_selected = explode(",",$search_session_array['category']);
		   }
		   echo form_dropdown('category[]', $category_tags, $category_selected, "class='selectpicker form-control' id='categoryType' data-live-search='true' multiple"); 
		   ?>
				</div>
			</div>
		</div>
	  </div>
	  <div class="row row text-center">
		<button type="submit" class="btn  btn-secondary" id="update_result" name="update_result">Update Results</button>
		<button type="submit" class="btn btn-default btn-primary" id="check_list_search_reset" name="check_list_search_reset" >Reset</button>
		<button type="submit" class="btn btn-default btn-primary" id="save_filter" name="save_filter" >Save Filter</button>
		<?php if($apply_filter == TRUE){ ?>
		<button type="button" class="btn btn-default btn-primary" id="apply_save_filter" name="apply_save_filter">Apply Saved Filter</button>
		<?php } else{ ?>
		<a href="javascript:void(0);"><button type="button" class="btn btn-default btn-primary" id="apply_save_filter"name="apply_save_filter" style="display:none;" >Apply Saved Filter</button></a>
		<?php } ?>
		
	  </div>
	  <input type="hidden" value="export" id="fetch_type" name="fetch_type" />
	</div>
  </div>
</form>
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
   this.list_page   = 'yes';     
</script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'checklist.js';?>"></script>
