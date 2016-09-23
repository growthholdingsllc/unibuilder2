<?php //echo '<pre>';print_r($response_data);?>
<div class="row">
   <ol class="breadcrumb">
   </ol>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">  
		<div class="pull-right">
		<?php 
		if(isset($response_data['status']) && $response_data['status'] == 'Released')
		{
			if(isset($this->user_role_access['survey'][strtolower('edit')]) && $this->user_role_access['survey'][strtolower('edit')] == 1)
			{
		?>
         <button type="button" class="btn btn-blue" id="close_survey"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="New Template" class="uni_cancel_new" /> Close this Survey</button>   
		<?php 
			}
		}	
		else if(isset($response_data['status']) && $response_data['status'] == 'Closed')
		{
		?>
		<span class="text-danger">Status :<?php echo $response_data['status']; ?></span>
		<?php
		}
		?>		
		 <a href="<?php echo base_url().$this->crypt->encrypt('survey/index/').'#Response'; ?>">
         <button type="button" class="btn btn-blue"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="New Template" class="uni_save_and_back" /> Back</button>
		</a>         
      </div>
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
	  <h4>RESPONSE DETAILS</h4>
      <div class="box-content panel-content">
			<div class="row five-col">
				<div class="col-xs-3">
					<label>Survey Name:</label> 
					<input type="text"  id="name" value="<?php echo isset($response_data['name'])?$response_data['name']:'' ?>" class="form-control" readonly />
				</div>   
				<div class="col-xs-3">
					<label>Project Name:</label> 
					<input type="text"  id="project_name" value="<?php echo isset($response_data['project_name'])?$response_data['project_name']:'' ?>" class="form-control" readonly />
				</div>
				<div class="col-xs-3">
					<label>Released By:</label> 
					<input type="text"  id="first_name" value="<?php echo isset($response_data['first_name'])?$response_data['first_name']:'' ?>" class="form-control" readonly />
				</div>
				<div class="col-xs-3">
					<label>Released to:</label> 
					<input type="text"  id="first_name" value="<?php echo isset($response_data['first_name'])?$response_data['first_name']:'' ?>" class="form-control" readonly />
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<label>Survey Description:</label> 
					<textarea class="form-control" name="description" id="description"><?php echo isset($response_data['description'])?$response_data['description']:'' ?></textarea>
				</div>				
			</div>
			<div class="row">
				<div class="col-xs-12">
					<label>Responses</label> 
					<table class="table table-bordered datatable" id="survey_response_table" width="100%">
					<input type="hidden" name="ub_survey_id" id="ub_survey_id" value="<?php echo (isset($response_data['ub_survey_id']) && $response_data['ub_survey_id'] > 0)? $response_data['ub_survey_id']:0 ?>" />
					</table>					
				</div>				
			</div>
	  </div>
   </div>
</div>
<div class="modal fade confirmModal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Close Survey       
      </h4>
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
            <div class="modal-con">              
              <div class="row col-xs-12"> 
				<p>Closing the survey would restrict user from filling this survey and the URL would be deactivated. Please confirm you still want to close this survey.</p>			  
				<button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="cancel_icon"/> CANCEL</button>  
				<button class="btn btn-blue m-left-1 pull-right" type="button" id="delete_confirm"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_dick"/> Confirm</button>				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div> 
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'survey_response.js';?>"></script>