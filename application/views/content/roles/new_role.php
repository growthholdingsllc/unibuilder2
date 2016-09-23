<div class="row">
   <ol class="breadcrumb">
      <?php $this->load->view('common/breadcrumbs'); ?> 
      <li class="active">New Log</li>
   </ol>
</div>
<form id="add_new_role" class="form-horizontal" method="post" name="add_new_role">
<div class="row">
   <div class="col-xs-12">      
	  <div class="top-search pull-right">
      <div class="pull-right ">                       
        <a href="<?php echo base_url(); ?>cm9sZXMvaW5kZXgv"><button class="btn btn-default btn-primary pull-right m-left-1" type="button">Cancel</button></a>        		
        <button class="btn btn-default btn-secondary pull-right m-left-1" type="submit" id="add_role_back">Save &amp; Back</button>		
        <button class="btn btn-default btn-secondary pull-right m-left-1" type="submit" id="add_role_new">Save &amp; New</button>		
        <button class="btn btn-default btn-success pull-right m-left-1" type="submit" id="add_role">Save &amp; Stay</button>
       </div>
	</div>
   </div>
</div>
<div class="row error-box">
	<div class="col-xs-12">
		<div class="error-message">
            <div class="alert alert-danger"></div>
        </div>
	</div>
</div>
<div class="row m-top">
   <div class="col-xs-12">
      <div class="panel panel-default">
         <div class="panel-heading" role="tab" id="filter">
            <h4 class="panel-title">Add Role</h4>
         </div>
         <div class="panel-body">
            <div class="row">                
				<div class="col-xs-12">
						<div class="row">
                        <div class="col-xs-3">
                           <label>Role Name</label>                           
                            <input type="text" class="form-control" name="role_name"/>                                                         
                        </div> 
						</div>
						<div class="row m-top">
                        <div class="col-xs-3">
                           <label>Status</label>
                           <select class="selectpicker form-control" name="role_active" title="-- Select Status --">                              
							  <option value="" data-hidden="true"></option>
                              <option value="yes" selected>Yes</option>
                              <option value="no">No</option>
                           </select>
                        </div>
						</div>                    
                     </div>
					 <input type="hidden" name="save_type" id="save_type" value="" />					             
            </div>
         </div>
      </div>
   </div>
</div>
</form>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/css/bootstrapvalidator.min.css">      
<script type="text/javascript" src="http://formvalidation.io/vendor/formvalidation/js/formValidation.min.js"></script>
<script type="text/javascript" src="http://formvalidation.io/vendor/formvalidation/js/framework/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo JSSRC.'roles.js';?>"></script>