<?php 
if(isset($this->user_account_type) && $this->user_account_type == OWNER)
{
	
}
?>
<div class="row">
   <ol class="breadcrumb">
      <?php $this->load->view('template/common/breadcrumbs'); ?>
      <li>Budget</li>
      <li class="active">Pay App</li>
   </ol>
</div>
<div class="row pay_app_filter">
   <div class="col-xs-12">
      <div class="panel-content pull-left">
         <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
               <div class="panel-heading" role="tab" id="filter">
                  <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> FILTER ALL YOUR RESULTS &nbsp;&nbsp; <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span> </a> </h4>
               </div>
               <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
                  <div class="panel-body col-xs-12">
                     <div class="row five-col">
                        <div class="col-xs-3">
                           <label>Date</label>
                           <div class='input-group date' id='datetimepicker3'>
                              <input type="text" class="form-control" id="due_date" name="due_date" value="">
                              <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                           </div>
                        </div>
                        <div class="col-xs-3">
                           <label>Pay App Name</label>
                           <input type="text" id="pay_app_name" class="form-control" />
                        </div>
                     </div>                  
                     <div class="row five-col">
                        <div class="col-xs-6">
                           <label>&nbsp;</label>
                           <div>
							  <button type="button" class="btn  btn-secondary" id="update_result" name="update_result">Update Results</button>
                              <button type="button" class="btn btn-default btn-primary">Reset</button>
                              <button type="button" class="btn btn-default btn-primary">Save Filter</button>
                              <button type="button" class="btn btn-default btn-primary">Apply Saved Filter</button>
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
<div class="row m-top">
   <div class="col-xs-12">
	  <div class="row budget_pay_app_list">
			<?php $this->load->view('content/budget/payapp_list'); ?>
	  </div>
	  <div class="row pay-app-list-content">
			<?php //$this->load->view('content/budget/payapp_certificate'); ?>
	  </div>
	  <div class="row budget_pay_app_list_details">
			<?php $this->load->view('content/budget/payapp_request_summary'); ?>
	  </div>
   </div>
</div>
<?php //$this->load->view('content/budget/save_cost_code_popup'); ?>
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script> 
<script type="text/javascript">        
   this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>'; this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.list_page   = 'yes';     
</script>


