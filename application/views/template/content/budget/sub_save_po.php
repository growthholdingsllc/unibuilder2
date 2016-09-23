<div class="row">
   <ol class="breadcrumb">
      <?php $this->load->view('template/common/breadcrumbs'); ?>
      <li>Budget</li>
      <li class="active">Select Project</li>
   </ol>
</div>
<form id="add_new_budget_po" class="form-horizontal" method="post" name="add_new_budget_po">
<input type="hidden" name="status" id="status" value="<?php echo (isset($budget_po_data['po_status'])?$budget_po_data['po_status']:'Not Released') ?>" />
<input type="hidden" name="save_type" id="save_type" value="" />
<input type="hidden" name="type" id="type" value="<?php echo $type ?>" />
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
         <div class="pull-right">
			<?php if($budget_po_data['po_status'] == 'Accepted by Sub' && $budget_po_data['po_status'] != 'Rejected by Sub'){?>
			<button id="po_co_work_completed" class="btn btn-blue  pull-right m-left-1" type="submit"> <img border="0" class="save_replay" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Work Completed </button> <?php } ?>           
            <button id="back" class="btn btn-blue  pull-right m-left-1" type="submit">
            <img border="0" class="go_back" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Back
            </button>             
          
            <?php
            if($budget_po_data['po_status'] != 'Work Completed' && $budget_po_data['po_status'] != 'Accepted by Sub' && $budget_po_data['po_status'] != 'Rejected by Sub' && $budget_po_data['po_status'] != 'Accepted by Builder' && $budget_po_data['po_status'] != 'Rejected by Builder'){?>
            <button type="button" class="btn btn-blue pull-right m-left-1" id="po_co_reject">
            <img class="delete_icon" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Reject
            </button>

			<button id="po_co_accept" class="btn btn-blue  pull-right m-left-1" type="submit">
            <img border="0" class="savestay" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Accept
            </button>	
            <?php } ?>		
         </div>
      </div>
   </div>
</div>
<div class="row m-top">
   <div class="col-xs-12">
      <div class="tab-con pull-left">
         <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
               <li role="presentation" class="active"> <a href="#general" aria-controls="general" data-toggle="tab">General</a> </li>
               <li role="presentation"> <a href="#scope_work" aria-controls="scope_work" data-toggle="tab">Scope of Work</a> </li>               
               <li role="presentation"> <a href="#payments" aria-controls="payments" data-toggle="tab">Payments</a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane active" id="general">
                  <div class="row">
                     <div class="col-xs-12">
                        <div class="box-content">
                           <div class="row five-col">
                              <div class="col-xs-12">
                                 <h5><label>General Information</label></h5>
                              </div>
                              <div class="col-xs-3"> 
                              <input type="hidden" name="ub_po_co_id" id="ub_po_co_id" value="<?php if(isset($budget_po_data['ub_po_co_id'])) echo $budget_po_data['ub_po_co_id'];?>">                               
								 <p><strong>Po#:</strong> <span class="text-move-left"><?php if(isset($budget_po_data['ub_po_co_number'])) echo $budget_po_data['ub_po_co_number'];?></span></p>
                              </div>
                              <div class="col-xs-3">
                              <input type="hidden" class="form-control" name="title"  id="title" value="<?php if(isset($budget_po_data['title'])) echo $budget_po_data['title'];?>" />                                 
								 <p><strong>Title:</strong> <span class="text-move-left"><?php if(isset($budget_po_data['title'])) echo $budget_po_data['title'];?></span></p>
                              </div>
                              <div class="col-xs-3">                                 
                                  <p><strong>Assigned to:</strong> <span class="text-move-left">
                                    <?php
                                    if(isset($budget_po_data['assigned_to']) && $budget_po_data['assigned_to'] > '')
                                    {
                                      $users_selected = $budget_po_data['first_name'];
                                    }
                                    echo $users_selected;
                                    ?>
                                    </span></p>
                              </div>
                              <div class="col-xs-3">                                
                                 <p><input type="checkbox" <?php if(isset($budget_po_data['materials_only']) && $budget_po_data['materials_only']==='Yes') echo  "checked='checked'";?> /> Materials only?</p>
                              </div>
                              <div class="col-xs-3">                                
                                 <p><strong>Scheduled Completion:</strong> <span class="text-move-left"><?php if(isset($budget_po_data['due_date'])) echo date("m/d/Y", strtotime($budget_po_data['due_date']));?></span></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row m-top">
                     <div class="col-xs-12">
                        <div class="box-content">
                           <div class="row">
                              <div class="col-xs-12">
                                 <h5><label>Cost</label></h5>
								  <table class="table table-bordered datatable" id="po_cost_list">
                           <thead>
                          <tr>
                           <th>Cost Code</th>
                           <th>Unit Cost</th>
                           <th>Quantity</th>
                           <th>Total</th>                           
                          </tr>
                         </thead>
									<tfoot>
									<th colspan="3" class="text-right">Total</th>
									<th><span id="totalSalary"><?php if(isset($budget_po_data['total'])) echo $budget_po_data['total'];?></span></th>
									</tfoot>
								  </table>
                              </div>
                           </div>                                                      
                        </div>
                     </div>
                  </div>                  
               </div>
               <div class="tab-pane" id="scope_work">
                  <div class="row">
                     <div class="col-xs-6">
						<label>Scope of Work</label>
						<textarea class="form-control" id="scope_of_work" readonly ><?php if(isset($budget_po_data['scope_of_work'])) echo $budget_po_data['scope_of_work'];?></textarea>
					 </div>
                     <div class="col-xs-6">
					 <label>Attached Files</label>					 
					 <table class="table table-bordered datatable" id="po_scope_list"></table>
					 </div>
                  </div>                  
               </div>
               <div class="tab-pane" id="payments">
                  <div class="row">
                     <div class="col-xs-12">
                        <table class="table table-bordered datatable" id="po_payment_list">
							<thead>
							<tr>
							   <th>Payment Title</th>
							   <th>Amount</th>
							   <th>Status</th>
							   <th>Date Paid</th>			
							   <th>Paid By</th>								
							</tr>
						   </thead>
                      </table>
                     </div>
                  </div>
                  <div class="row m-top">
                     <div class="col-xs-12">
                        <div class="pull-left">
                           <a href="javascript:void(0);" data-toggle="modal" data-target="#create_payment">
							<button class="btn btn-blue pull-right m-left-1" type="button">
							<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="savenew" />  Create a Payment
							</button> 						   
							</a>
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
<div id="payment-popup">
	<?php $this->load->view('content/budget/save_sub_po_co_payment_popup'); ?>
</div>
<div class="modal fade" id="docs_upload_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Choose a file from Unibuilder Docs
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <div id="fixed-tree"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <div class="row">
               <div class="col-xs-12">
                  <button class="btn btn-light-grey" data-dismiss="modal" type="button">Cancel</button>					
                  <button class="btn btn-success" type="submit">Upload</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">        
   this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>'; this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.list_page   = 'yes';     
</script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-template-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'sub_save_po.js';?>"></script>