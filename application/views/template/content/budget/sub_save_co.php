<div class="row">
   <ol class="breadcrumb">
      <?php $this->load->view('template/common/breadcrumbs'); ?>
      <li>Budget</li>
      <li class="active">Select Project</li>
   </ol>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
         <div class="pull-right">
            <!--<button id="po_cancel" class="btn btn-gray  pull-right m-left-1" type="submit">
            <img border="0" class="cancel_icon" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Cancel 
            </button>
            <button type="button" class="btn btn-blue pull-right m-left-1">
            <img class="delete_icon" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Delete
            </button>-->
			<button id="save_release" class="btn btn-blue  pull-right m-left-1" type="submit"> <img border="0" class="save_replay" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Work Completed </button>            
            <button id="save_back" class="btn btn-blue  pull-right m-left-1" type="submit">
            <img border="0" class="go_back" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Back
            </button>             
            <button id="save_stay" class="btn btn-blue  pull-right m-left-1" type="submit">
            <img border="0" class="savestay" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Approve
            </button>		
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
								 <p><strong>Co#:</strong> <span class="text-move-left">CO-06052015-0000129999</span></p>
                              </div>
                              <div class="col-xs-3">                                 
								 <p><strong>Title:</strong> <span class="text-move-left">CO 1</span></p>
                              </div>
                              <div class="col-xs-3">                                 
                                  <p><strong>Assigned to:</strong> <span class="text-move-left">Kalyani</span></p>
                              </div>
                              <div class="col-xs-3">                                
                                 <p><input type="checkbox" checked /> Materials only?</p>
                              </div>
                              <div class="col-xs-3">                                
                                 <p><strong>Scheduled Completion:</strong> <span class="text-move-left">06/05/2015</span></p>
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
									<tfoot>
									<th colspan="3" class="text-right">Total</th>
									<th><span id="totalSalary"></span></th>
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
						<textarea class="form-control" readonly >Scope of work</textarea>
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
<div id="payment-popup">
	<?php $this->load->view('content/budget/save_po_co_payment_popup'); ?>
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