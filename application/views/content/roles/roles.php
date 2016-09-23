<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?> 
      <!--<li class="active">Roles</li>-->
   </ol>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">        
            <button class="btn btn-default btn-primary pull-right m-left-1 glyphicon glyphicon-print" type="button"></button>
            <a class="btn btn-default btn-secondary pull-right m-left-1" href="<?php echo base_url(); ?>cm9sZXMvbmV3X3Jvbgxf1Uv">New Role</a>
			<div class="col-xs-3  pull-right">
				<select class="selectpicker form-control" onchange="delete_all(this.value)">
				<option value="">Role Actions</option>				
				<option value="delete_roles">Delete Checked Roles</option>
				</select>
			</div>                    
      </div>
      <div class="panel-content pull-left">
         <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
               <div class="panel-heading" role="tab" id="filter">
                  <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> FILTER ALL YOUR RESULTS &nbsp;&nbsp; <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span> </a> </h4>
               </div>
               <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
                  <div class="panel-body col-xs-12">
                     <form id="Search_Result" class="form-horizontal" method="post" name="Search_Result">
                        <div class="row">
						 <?php 
						   $users_selected = '';
						   if(isset($sess_assigned_to))
						   {
								$users_selected = explode(",",$sess_assigned_to);
						   }
						   echo form_dropdown('assigned_to', $all_type_users, $users_selected, "class='selectpicker form-control' id='assigned_to' data-live-search='true' "); 
						   ?>
                           <div class="col-xs-3">
                              <label>Role Name</label>                           
                              <input type="text" class="form-control" name="role_name" id="role_name" value="<?php echo $sess_role_name; ?>"/>
                           </div>
                           <div class="col-xs-3">
                              <label>Status</label>
                              <select class="selectpicker form-control" name="role_active" id="role_active">
                                 <option value="">-- No Tags Selected --</option>
                                 <option value="Yes" <?php if($sess_role_active == 'Yes'){ ?> selected <?php } ?>>Yes</option>
                                 <option value="No" <?php if($sess_role_active == 'No'){ ?> selected <?php } ?> >No</option>
                              </select>
                           </div>
                        </div>
                        <div class="row text-center">
                           <button type="submit" class="btn  btn-secondary" id="update_result">Update Results</button>
                           <a href="javascript:void(0);"><button type="button" class="btn btn-default btn-primary" id="role_search_reset" >Reset</button></a>
                           <button type="button" class="btn btn-default btn-primary">Save Filter</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row roles">
   <div class="col-xs-12 pull-left">
      <table class="table table-bordered datatable" id="Roles_List" width="100%">
         <thead>
            <tr>
               <th><input type="checkbox" name="selectall" id="selectall"/></th>
               <th>Role name</th>
               <th>Status</th>
               <th>Created On</th>
               <th>Modified On</th>
            </tr>
         </thead>
         <tbody>
         </tbody>
      </table>
   </div>
</div>
<script type="text/javascript">        
   this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>';
   this.displayStart   = '<?php echo 0 ?>';     
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.list_page   = 'yes';     
</script>
<script type="text/javascript" src="<?php echo JSSRC.'icheck.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'roles.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
