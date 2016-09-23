<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?>
      <!--<li class="active">Warranty</li>-->
   </ol>
</div>
<div class="row">
   <div class="col-xs-12">
		<?php
		if(isset($this->user_role_access[strtolower('warranty')][strtolower('add')]) && $this->user_role_access[strtolower('warranty')][strtolower('add')] == 1)
		{
			if(isset($this->project_status) && $this->project_status != 'Closed' && $this->project_status != 'Disabled')
			{
		?>
		<!-- Below condition was added by chandru 09-07-2015 -->
		<?php if(($this->user_account_type == OWNER && $owner_add_claims == TRUE && $warranty_max_claims_period == TRUE) || $this->user_account_type == BUILDERADMIN && $warranty_max_claims_period == TRUE)
				{
		?>
      <div class="top-search pull-right">      
         <a href="<?php echo base_url(); ?>d2FycmFudHkvc2F2ZV93YXJyYW50eS8-" class="btn btn-blue pull-right m-left-1"><img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_new"> New Claim</a>
      </div>
	  <?php 
				}
			}
	    }
	  ?>
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
							   <?php
								  $status_selected = '';
								  if(isset($search_session_array['status']))
								  {
								  $status_selected = explode(",",$search_session_array['status']);
								  }
								  echo form_dropdown('status[]',$status_array,$status_selected, "class='selectpicker form-control' id='status' data-live-search='true'"); 
								  ?>
								</div>
							</div>
                        </div>
                        <div class="col-xs-3">
                           <label>Classification</label>
						   <div class="col-xs-12">
							   <div class="form-group">
                           <?php 
                              $classification_selected = '';
                              if(isset($search_session_array['classification']))
                              {
                              $classification_selected = explode(",",$search_session_array['classification']);
                              }
                              // echo "<pre>";print_r($classification_array);exit;
                              echo form_dropdown('classification[]',$classification_array,$classification_selected, "class='selectpicker form-control' id='classification' data-live-search='true'"); 
                              ?>
								</div>
							</div>
                        </div>
                        <div class="col-xs-3">
                           <label>Categories</label>
						   <div class="col-xs-12">
							   <div class="form-group">
                           <?php 
                              $category_selected = '';
                              if(isset($search_session_array['category']))
                              {
                              $category_selected = explode(",",$search_session_array['category']);
                              }
                              echo form_dropdown('category[]',$category_array,$category_selected, "class='selectpicker form-control' id='category' data-live-search='true' multiple"); 
                              ?>
								</div>
							</div>
                        </div>
                        <div class="col-xs-3">
                          <label>Priorities</label>
						   <div class="col-xs-12">
							   <div class="form-group">
                           <?php 
                              $priority_selected = '';
                              if(isset($search_session_array['priority']))
                              {
                              $category_selected = explode(",",$search_session_array['priority']);
                              }
                              echo form_dropdown('priority[]',$priority_array,$category_selected, "class='selectpicker form-control' id='priority' data-live-search='true'"); 
                              ?>
								</div>
							</div>
                        </div>
                        <div class="col-xs-3">
                           <label>Coordinators</label>
						   <div class="col-xs-12">
							   <div class="form-group">
                           <?php 
                              $user_selected = '';
                               if(isset($search_session_array['coordinators']))
                               {
                              $user_selected = $search_session_array['coordinators'];
                               }
                               echo form_dropdown('user_id', $user_list, $user_selected, "class='selectpicker form-control' id='coordinators' data-live-search='true'"); 
                              ?>
								</div>
							</div>
                        </div>
                     </div>
                     <div class="row five-col">
                        <div class="col-xs-3">
                           <label>Servicing Sub</label>
						   <div class="col-xs-12">
							   <div class="form-group">
                           <?php 
                              $subcontractor_selected = '';
                               if(isset($search_session_array['servicingsub']))
                               {
                              $subcontractor_selected = $search_session_array['servicingsub'];
                               }
                                   array_unshift($subcontractor_list,"Nothing Selected");
                               echo form_dropdown('subcontractor_id', $subcontractor_list, $subcontractor_selected, "class='selectpicker form-control' id='servicingsub' data-live-search='true'"); 
                              ?>
								</div>
							</div>
                        </div>
                        <div class="col-xs-3">
                           <label>Orig. Sub</label>
						   <div class="col-xs-12">
							   <div class="form-group">
                           <?php 
                              $subcontractor_selected = '';
                               if(isset($search_session_array['subcontractor']))
                               {
                              $subcontractor_selected = $search_session_array['subcontractor'];
                               }
                               echo form_dropdown('subcontractor', $subcontractor_list, $subcontractor_selected, "class='selectpicker form-control' id='subcontractor' data-live-search='true'"); 
                              ?>
								</div>
							</div>
                        </div>
                        <div class="col-xs-3">
                           <label>Date Range</label>
                           <div class="input-prepend input-group">
                              <input type="text" name="daterange" id="daterange" class="form-control" value="<?php echo isset($search_session_array['daterange'])?$search_session_array['daterange']:''; ?>" readonly />
                              <span class="input-group-addon"> <span class="glyphicon-calendar glyphicon daterange"></span></span> 
                           </div>
                        </div>
                     </div>
                     <div class="row text-center">
                        <div class="col-xs-12">
                           <div>
                              <button type="submit" class="btn btn-blue" id="update_result" name="update_result">Update Results</button>
                              <button type="submit" class="btn btn-gray" id="warranty_search_reset">Reset</button>
                              <button type="submit" class="btn btn-gray" id="save_filter">Save Filter</button>
                              <?php if($apply_filter == TRUE){ ?>
                              <button class="btn btn-default btn-gray" type="button" id="apply_save_filter">Apply Saved Filter</button>
                              <?php }else { ?>
                              <button class="btn btn-default btn-gray" type="button" id="apply_save_filter" style="display:none;">Apply Saved Filter</button>
                              <?php } ?>
                              <input type="hidden" value="export" id="fetch_type" name="fetch_type" />
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
</form>
<div class="row">
<div class="col-xs-12 pull-left">
<div class="row datatable-bor">
   <div class="add-function">
        <!--checking role access // by satheesh kumar -->
		<?php
		if(isset($this->user_role_access[strtolower('warranty')][strtolower('delete')]) && $this->user_role_access[strtolower('warranty')][strtolower('delete')] == 1)
		{ 
		?>
      <div class="col-xs-3 pull-left">
         <select class="selectpicker form-control" onchange="delete_all_checked_warranty(this.value)" title="Task Actions">
            <option value="">Bulk Actions</option>
            <option value="delete_multi_warranty">Delete Checked Warranty</option>
         </select>
      </div>
	  <?php 
	  }
	  ?>
   </div>
</div>
</div>
</div>
<div class="row roles m-top">
   <div class="col-xs-12 pull-left">
      <table class="table table-bordered datatable" id="Warranty_List" width="100%">
         <thead>
            <tr>
               <th><input type="checkbox" name="selectall" id="selectall"/></th>
               <th>Title</th>
               <th>Priority</th>
               <th>Category</th>
               <th>Added</th>
               <th>Follow Up</th>
               <th>Class</th>
               <th>Scheduling</th>
               <th>Feedback</th>
            </tr>
         </thead>
         <tbody>
         </tbody>
      </table>
   </div>
</div>
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
                                 <input type="hidden" value="export" id="fetch_type" name="fetch_type" />
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
<input type="hidden" id="warranty_index" value="" />
<!-- /Check List Modal -->
<link rel="stylesheet" href="<?php echo CSSSRC.'daterangepicker-bs3.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'icheck.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'date_moment.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'daterangepicker.js';?>"></script> 
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
<script type="text/javascript" src="<?php echo JSSRC.'daterangepicker.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'warranty.js';?>"></script>