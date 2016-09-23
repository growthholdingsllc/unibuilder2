<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?> 
      <!--<li class="active">Edit Log</li>-->
   </ol>
</div>
 <form id="edit_role" class="form-horizontal" method="post" name="edit_role">
<div class="row">
   <div class="col-xs-12">      
	  <div class="top-search pull-right">
      <div class="pull-right ">        
        <button class="btn btn-default btn-primary pull-right m-left-1" type="button" id="<?php echo $result_data['aaData'][0]['ub_role_id']; ?>" onclick="delete_role({'ub_role_id':{this.id:this.id}})">Delete</button>        
        <a href="<?php echo base_url(); ?>cm9sZXMvaW5kZXgv"><button class="btn btn-default btn-primary pull-right m-left-1" type="button">Cancel</button></a>        		
        <button class="btn btn-default btn-secondary pull-right m-left-1" type="submit" id="editrole-back">Save &amp; Back</button>		     
        <button class="btn btn-default btn-success pull-right m-left-1" type="submit" id="editrole"  >Save &amp; Stay</button>
        </div>
	</div>
   </div>
</div>

<div class="row m-top">
   <div class="col-xs-12">
      <div class="panel panel-default">
         <div class="panel-heading" role="tab" id="filter">
            <h4 class="panel-title">Edit Roles Details</h4>
         </div>
         <div class="panel-body">
            <div class="row ">               
						<div class="col-xs-12">
							<div class="row">
							<div class="col-xs-3">
							   <label>Role Name</label>                           
								<input type="text" class="form-control" id="role-name" name="role_name" value="<?php echo $result_data['aaData'][0]['role_name'];?>"/>                                                         
							</div> 
							</div>
							<div class="row m-top">
							<div class="col-xs-3">
							   <label>Status</label>
							   <select class="selectpicker form-control" name="role_active">
								  <option value="">-- Select Status --</option>
								  <option value="Yes" <?php if($result_data['aaData'][0]['role_active'] == 'Yes'){ ?> selected <?php } ?> >Yes</option>
								  <option value="No" <?php if($result_data['aaData'][0]['role_active'] == 'No'){ ?> selected <?php } ?>>No</option>
							   </select>
							</div>
							</div>						 
						 </div>
					<input type="hidden" name="ub_role_id" id="ub_role_id" value="<?php echo $result_data['aaData'][0]['ub_role_id'] ?>" />
					<input type="hidden" name="save_type" id="save_type" value="" />
				</form>            
            </div>
         </div>
         </div>
      </div>
   </div>
</div>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/css/bootstrapvalidator.min.css">      
<script type="text/javascript" src="http://formvalidation.io/vendor/formvalidation/js/formValidation.min.js"></script>
<script type="text/javascript" src="http://formvalidation.io/vendor/formvalidation/js/framework/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'roles.js';?>"></script>