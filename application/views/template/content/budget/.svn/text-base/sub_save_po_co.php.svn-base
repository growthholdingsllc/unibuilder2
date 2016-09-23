<?php
$count_cn = 1;
if(!empty($cost_code_data['cost_code_id']))
{
  $cost_code_id = explode(",",$cost_code_data['cost_code_id']);
  $count_cn = count($cost_code_id);
}
if(!empty($cost_code_data['ub_po_co_cost_code_id']))
{
  $ub_po_co_cost_code_id = explode(",",$cost_code_data['ub_po_co_cost_code_id']);
}
if(!empty($cost_code_data['quantity']))
{
  $quantity = explode(",",$cost_code_data['quantity']);
}
if(!empty($cost_code_data['unit_cost']))
{
  $unit_cost = explode(",",$cost_code_data['unit_cost']);
}
if(!empty($cost_code_data['total']))
{
  $total = explode(",",$cost_code_data['total']);
}

?>
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
          
			<?php 
			if(isset($this->project_status) && $this->project_status != 'Closed' && $this->project_status != 'Disabled')
			{
				if(($budget_po_data['po_status'] == 'Accepted by Sub' && $budget_po_data['po_status'] != 'Rejected by Sub') || ($budget_po_data['po_status'] == 'Accepted by Builder' && $budget_po_data['po_status'] != 'Rejected by Builder'))
				{
			?>
			<button id="po_co_work_completed" class="btn btn-blue  pull-right m-left-1" type="submit"> <img border="0" class="save_replay" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Work Completed </button> 
			<?php 
				} 
			}
			?>           
            <button id="back" class="btn btn-blue  pull-right m-left-1" type="submit">
            <img border="0" class="go_back" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Back
            </button>             
          
            <?php
			if(isset($this->project_status) && $this->project_status != 'Closed' && $this->project_status != 'Disabled')
			{
				if($budget_po_data['po_status'] == 'Released')
				{
			?>
            <button type="button" class="btn btn-blue pull-right m-left-1" id="po_co_reject">
            <img class="delete_icon" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Reject
            </button>

			<button id="po_co_accept" class="btn btn-blue  pull-right m-left-1" type="submit">
            <img border="0" class="savestay" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Accept
            </button>	
            <?php
				} 
			}
			?>		
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

                              <input type="hidden" name="created_by" id="created_by" value="<?php if(isset($budget_po_data['created_by'])) echo $budget_po_data['created_by'];?>">

                              <input type="hidden" name="ub_po_co_number" id="ub_po_co_number" value="<?php if(isset($budget_po_data['ub_po_co_number'])) echo $budget_po_data['ub_po_co_number'];?>">

							  <input type="hidden" name="project_id" id="project_id" value="<?php if(isset($this->project_id)) echo $this->project_id;?>">
								
                        <?php if(isset($budget_po_data['ub_po_co_number'])){ ?>
								 <p><strong><?php if($type == 'PO'){ echo 'Po#:'; } else echo 'Co#:'; ?></strong> <span class="text-move-left"><?php if(isset($budget_po_data['ub_po_co_number'])) echo $budget_po_data['ub_po_co_number'];?></span></p>
                         <?php } ?>
                              </div>
                              <div class="col-xs-3">

                                <input type="hidden" name="title" id="title" value="<?php if(isset($budget_po_data['title'])) echo $budget_po_data['title'];?>">                                 
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
                                     <!-- <input type="hidden" name="assigned_to" id="assigned_to" value="<?php if(isset($budget_po_data['assigned_to'])) echo $budget_po_data['assigned_to'];?>"> -->
                                     
                                     <input type="hidden" name="assigned_to" id="assigned_to" value="<?php if(isset($budget_po_data['assigned_to'])) echo $budget_po_data['assigned_to'];?>">
                                    </span></p>
                              </div>
                              <div class="col-xs-3">                                
                                 <p><input type="checkbox" <?php if(isset($budget_po_data['materials_only']) && $budget_po_data['materials_only']==='Yes') echo  "checked='checked'";?> /> Materials only?</p>
                              </div>
                              <div class="col-xs-3">  

                               <input type="hidden" name="due_date" id="due_date" value="<?php if(isset($budget_po_data['due_date'])) echo $budget_po_data['due_date'];?>">                              
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
               <!-- hidden fields for cost codes -->
               <?php 
                  for($i=0; $i < $count_cn; $i++)
                  {
                  ?>           
                  <div class="content">
                  <div class="row">
                  <div class="col-xs-2">                             
                  <p>
                  
                  </div>
                  <div class="col-xs-2">    
                  <input type="hidden" name="ub_po_co_cost_code_id[]" id="ub_po_co_cost_code_id" value="<?php if(isset($ub_po_co_cost_code_id[$i])) echo $ub_po_co_cost_code_id[$i] ?>" />
                 

                  <input type="hidden" class="form-control varian" name="cost_code_id[]" id="cost_code_id" value="<?php if(isset($cost_code_id[$i])) echo $cost_code_id[$i] ?>" >
                  </div>
                  <div class="col-xs-2">                             
                  <input type="hidden" class="form-control varian" placeholder="Quantity" name="quantity[]" id="quantity" value="<?php if(isset($quantity[$i])) echo $quantity[$i] ?>" />
                  </div>    
                  <div class="col-xs-2">                             
                  <input type="hidden" class="form-control varian" placeholder="Unit Cost($)" name="unit_cost[]" id="unit_cost" value="<?php if(isset($unit_cost[$i])) echo $unit_cost[$i] ?>" />
                  </div>  
                  <div class="col-xs-2">                             
                  <input type="hidden" class="form-control total" placeholder="Total($)" name="total[]" id="total" value="<?php if(isset($total[$i])) echo $total[$i] ?>"/>
                  </div>                          
                  </div>
                  </div>  
               <?php } ?>  
               <!-- End -->
               <div class="tab-pane" id="scope_work">
                  <div class="row">
                     <div class="col-xs-6">
						<label>Scope of Work</label>
						<textarea class="form-control" readonly ><?php if(isset($budget_po_data['scope_of_work'])) echo strip_tags($budget_po_data['scope_of_work']);?></textarea>
					 </div>
                     <div class="col-xs-6">
					 <label>Attached Files</label>	
					<input type="hidden" name="folder_id" id="folder_id" value="<?php echo isset($folder_id)?$folder_id:'' ?>" />
					<?php $this->load->view('common/uploaded_content.php');?>
					 <!--<table class="table table-bordered datatable" id="po_scope_list"></table>-->
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
							   <th>Paid Amount</th>
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
                     <?php
					 if(isset($this->project_status) && $this->project_status != 'Closed' && $this->project_status != 'Disabled')
							{
                     if(isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] == 'Accepted by Sub' || $budget_po_data['po_status'] == 'Accepted by Builder' || $budget_po_data['po_status'] == 'Work Completed')) { 
                     ?>
							<button class="btn btn-blue pull-right m-left-1" type="button" onclick="get_payment();">
							<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="savenew" />  Create a Payment
							</button> 
                     <?php } }?>						   
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
</form>
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
<script type="text/javascript" src="<?php echo JSSRC.'sub_save_po_co.js';?>"></script>