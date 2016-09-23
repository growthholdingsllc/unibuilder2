<?php
   //echo $this->project_id;exit;
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
   if(!empty($cost_code_data['cost_variance_code']))
   {
     $cost_variance_code = explode(",",$cost_code_data['cost_variance_code']);
   }
   ?>
<script>   
   this.data_table   						= '<?php echo $data_table; ?>';   
   this.po_scope_list    					= '<?php echo $po_scope_list; ?>'; 
   this.po_status_list    					= '<?php echo $po_status_list; ?>'; 
   this.po_bids_list    					= '<?php echo $po_bids_list; ?>'; 
   this.po_payment_list    					= '<?php echo $po_payment_list; ?>'; 
   this.po_vocher_payment_list    			= '<?php echo $po_vocher_payment_list; ?>'; 
</script>
<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?>
      <!--<li>Budget</li>
      <li class="active">Select Project</li>-->
   </ol>
</div>
<form id="add_new_budget_po" class="form-horizontal" method="post" name="add_new_budget_po">
   <div class="row">
      <div class="col-xs-12">
         <div class="top-search pull-right <?php if($this->project_id == ''  && !isset($budget_po_data['project_id'])){ echo 'no_project_selected'; } ?>">
            <div class="pull-right">
               <?php if($this->user_account_type == BUILDERADMIN){ ?>
               <button type="submit" class="btn btn-gray  pull-right m-left-1" id="po_cancel">
               <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="cancel_icon"> Cancel 
               </button>
               <?php }else{?>

               <button type="submit" class="btn btn-gray  pull-right m-left-1" id="po_sub_cancel">
               <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="cancel_icon"> Cancel 
               </button>

               <?php } ?>
               <?php 
                  if(isset($this->project_status_check) && $this->project_status_check == 1)
                  {
                   if(isset($budget_po_data['ub_po_co_id']) && isset($budget_po_data['created_by']) && $budget_po_data['created_by'] == $this->user_session['ub_user_id'])
                   {
                  ?>
                  <?php if(isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] != 'Accepted by Builder' && $budget_po_data['po_status'] != 'Accepted by Sub' && $budget_po_data['po_status'] != 'Work Completed'))
               {   ?>
               <button class="btn btn-blue pull-right m-left-1" type="button" id="<?php if(isset($budget_po_data['ub_po_co_id'])) echo $budget_po_data['ub_po_co_id']; ?>" onclick="delete_po_co(this.id)">
               <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="delete_icon"/> Delete
               </button>
               <?php } ?>
			    <?php
				if($type == 'PO') 
			    {
					if(isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] == 'Accepted by Builder' || $budget_po_data['po_status'] == 'Accepted by Sub'))
					{			
				?>
			   <a href="<?php echo base_url().$this->crypt->encrypt('prints/purchase_order/'.$budget_po_data['ub_po_co_id'].'/'.$budget_po_data['project_id']); ?>" target="_blank"><button class="btn btn-blue  pull-right m-left-1" type="button" id="" name="print_bid"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_print"/>Print</button></a>
				<?php }} else 
				{
				if(isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] == 'Accepted by Builder' || $budget_po_data['po_status'] == 'Accepted by Sub'))
				{	
					
				?>
				<a href="<?php echo base_url().$this->crypt->encrypt('prints/change_order/'.$budget_po_data['ub_po_co_id'].'/'.$budget_po_data['project_id']); ?>" target="_blank"><button class="btn btn-blue  pull-right m-left-1" type="button" id="" name="print_bid"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_print"/>Print</button></a>
				<?php }}?>
               <?php 
                  } 
                  }
                  ?>
               <?php 
                  if(isset($this->project_status_check) && $this->project_status_check == 1)
                  {
                  ?>
               <?php if(isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] == 'Accepted by Builder' || $budget_po_data['po_status'] == 'Accepted by Sub')){?>
               <button id="po_co_work_completed" class="btn btn-blue  pull-right m-left-1" type="submit"> <img border="0" class="save_replay" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Work Completed </button> <?php } ?>
               <?php
                  if(isset($budget_po_data['ub_po_co_id']) && ($budget_po_data['po_status'] != 'Released' && $budget_po_data['po_status'] != 'Accepted by Sub' && $budget_po_data['po_status'] != 'Accepted by Builder' && $budget_po_data['po_status'] != 'Rejected by Sub' && $budget_po_data['po_status'] != 'Rejected by Builder' && $budget_po_data['po_status'] != 'Work Completed' && isset($budget_po_data['ub_po_co_id'])) && $this->user_account_type == BUILDERADMIN) { 
                  ?>
               <button type="submit" class="btn btn-blue  pull-right m-left-1"  id="save_release"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="save_replay"> Save &amp; Release </button>
               <?php }else if(isset($budget_po_data['ub_po_co_id']) && $budget_po_data['po_status'] == 'Released'  && ($budget_po_data['po_status'] != 'Accepted by Builder' && $budget_po_data['po_status'] != 'Accepted by Sub' && $budget_po_data['po_status'] != 'Rejected by Builder' && $budget_po_data['po_status'] != 'Rejected by Sub' && $budget_po_data['po_status'] != 'Work Completed')){
                  ?>
               <a class="closing_back pull-right" href="javascript:void(0);" id="po_co_reject"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Cancel" class="cancel_button"> Reject </a> 
               <a class="sprite pull-right" href="javascript:void(0);" id="po_co_accept"><img border="0" class="plus" alt="Add RFI" src="<?php echo IMAGESRC.'strip.gif'; ?>">&nbsp;Accept</a> 
               <?php }  ?>
               <?php 
                  }
                  ?>
               <?php 
                  if(isset($this->project_status_check) && $this->project_status_check == 1)
                  {
                   if(isset($budget_po_data['ub_po_co_id']) && isset($budget_po_data['created_by']) && $budget_po_data['created_by'] == $this->user_session['ub_user_id'] && $budget_po_data['po_status'] == 'Not Released')
                  {
                         ?>
               <button type="submit" class="btn btn-blue  pull-right m-left-1" id="save_back">
               <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="go_back"> Save &amp; Back
               </button>
               <button class="btn btn-blue pull-right m-left-1" type="submit" id="save_new">
               <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="savenew"/>  Save &amp; New
               </button>  
               <button type="submit" class="btn btn-blue  pull-right m-left-1" id="save_stay">
               <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="savestay"> Save &amp; Stay
               </button>		
               <?php } else if(!isset($budget_po_data['ub_po_co_id'])){ ?>
               <button type="submit" class="btn btn-blue  pull-right m-left-1" id="save_back">
               <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="go_back"> Save &amp; Back
               </button>
               <button class="btn btn-blue pull-right m-left-1" type="submit" id="save_new">
               <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="savenew"/>  Save &amp; New
               </button>  
               <button type="submit" class="btn btn-blue  pull-right m-left-1" id="save_stay">
               <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="savestay"> Save &amp; Stay
               </button> 
               <?php 
                  } 
                  }
                  ?>
				<!-- <a href="javascript:void(0);" id="release_owner" ><button type="button" class="btn btn-blue  pull-right m-left-1" id="save_back">
               <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="save_replay"> Release to Owner
               </button></a>
			   <a href="javascript:void(0);" id="assign_to_vendor" ><button type="button" class="btn btn-blue  pull-right m-left-1" id="save_back">
               <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="save_new"> Assign to Vendor
               </button></a> -->
            </div>
         </div>
      </div>
   </div>
   <div class="row m-top">
      <div class="col-xs-12 error-message uni_message">
         <div class="alerts alert-danger"></div>
      </div>
   </div>
   <div class="row m-top">
      <div class="col-xs-12">
         <div class="tab-con pull-left">
            <div role="tabpanel">
               <!-- Nav tabs -->
               <input type="hidden" name="ub_po_co_id" id="ub_po_co_id" value="<?php echo (isset($budget_po_data['ub_po_co_id']) && $budget_po_data['ub_po_co_id'] > 0)?$budget_po_data['ub_po_co_id']:0 ?>" />
               <input type="hidden" name="type" id="type" value="<?php echo $type ?>" />
               <input type="hidden" name="bid_project_id" id="bid_project_id" value="<?php echo $projects_id ?>" />
               <input type="hidden" id="current_tab" value="" />
               <input type="hidden" name="save_type" id="save_type" value="" />
               <input type="hidden" name="bid_po_id" id="bid_po_id" value="<?php echo (isset($budget_po_data['bid_po_id']) &&  $budget_po_data['bid_po_id'] > 0)?$budget_po_data['bid_po_id']:$bid_po_id ?>" />
               <input type="hidden" name="user_id" id="user_id" value="<?php echo $this->user_session['ub_user_id'] ?>" />
               <input type="hidden" name="bid_po_user_id" id="bid_po_user_id" value="<?php echo $bid_po_user_id ?>" />
               <input type="hidden" name="status" id="status" value="<?php echo (isset($budget_po_data['po_status'])?$budget_po_data['po_status']:'Not Released') ?>" />
               <input type="hidden" name="status_value" id="status_value" value="<?php echo (isset($budget_po_data['po_status'])?$budget_po_data['po_status']:'Not Released') ?>" />
               <ul class="nav nav-tabs" role="tablist" id="budget_po_tab">
                  <li role="presentation" class="active"> <a href="#general" aria-controls="general" data-toggle="tab" id="general_tab">General</a> </li>
                  <li role="presentation"> <a href="#scope_work" aria-controls="scope_work" data-toggle="tab" id="scope_of_work_tab">Scope of Work</a> </li>
                  
                  <li role="presentation"> <a href="#status_log" aria-controls="status_log" data-toggle="tab" id="status_log_tab">Status Log</a> </li>
                  <?php if($type == 'PO'){ ?>
                  <li role="presentation"> <a href="#bids" aria-controls="bids" data-toggle="tab" id="bids_tab">Bids</a> </li>
                  <?php }?>
                  
                  <li role="presentation"> <a href="#payments" aria-controls="payments" data-toggle="tab" id="payment_tab">Payments</a> </li>
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
                                 <?php if($type == 'CO' && isset($po_result['title'])){ ?>
                                      <div class="col-xs-3">
                                          <label>PO</label>
                                          <div class="col-xs-12">
                                              <div class="form-group">
                                                  <?php echo $po_result['title']; ?>
                                              </div>
                                          </div>
                                      </div>
                                            
                                 <?php } ?>
                                 <input type="hidden" name="created_by" id="created_by" value="<?php if(isset($budget_po_data['created_by'])) echo $budget_po_data['created_by'];?>">
                                 <?php if(isset($budget_po_data['ub_po_co_id']) && isset($budget_po_data['ub_po_co_number'])) { ?>
                                 <div class="col-xs-3">
                                    <label><?php if($type == 'PO'){ echo 'Po#'; } else echo 'Co#'; ?></label>
                                    <input type="text" class="form-control" name="ub_po_co_number" id="ub_po_co_number" value="<?php if(isset($budget_po_data['ub_po_co_number'])) echo $budget_po_data['ub_po_co_number'];?>" readonly/>
                                 </div>
                                 <?php } ?>
                                 <?php
                                    if(isset($budget_po_data['project_id']))
                                    {
                                    
                                     echo '<input type="hidden" name="project_id" id="project_id" value="'.$budget_po_data['project_id'].'" />';
                                     echo '<input type="hidden" name="project_name" id="project_name" value="'.$budget_po_data['project_name'].'" />';
                                    }
                                    ?>
                                    <?php if($type == 'CO' && $bid_po_id == 0 && $this->user_account_type == BUILDERADMIN && !isset($cost_code_data['cost_code_id']) && !empty($po_list)){ ?>
                                    <div class="col-xs-3">
                                    <label>Select PO</label>
                                    <div class="col-xs-12">
                                       <div class="form-group">
                                          <?php echo form_dropdown('po_id', $po_list, '', "class='selectpicker form-control2' id='po_id' data-live-search='true'"); ?>
                                       </div>
                                    </div>
                                 </div>
                                 <?php } ?>

                                 <div class="col-xs-3">
                                    <label>Title</label>
                                    <div class="col-xs-12">
                                       <div class="form-group">
                                          <input type="text" class="form-control" name="title"  id="title" value="<?php if(isset($budget_po_data['title'])) echo $budget_po_data['title'];?>" <?php if(isset($budget_po_data['ub_po_co_id']) && $budget_po_data['po_status'] != 'Not Released' || isset($budget_po_data['created_by']) && $budget_po_data['created_by'] != $this->user_session['ub_user_id']) { echo "readonly='readonly'"; } ?> />
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-xs-3">
                                    <label>Assigned to</label>
                                    <div class="col-xs-12">
                                       <div class="form-group">
                                          <?php if($this->user_account_type == SUBCONTRACTOR)
                                          {
                                          ?>

                                          <input type="hidden" class="form-control varian" name="assigned_to" id="assigned_to" value="<?php echo $this->user_id ?>"/>
                                          <label><?php echo $this->user_session['first_name'].' '.$this->user_session['last_name']; ?></label>

                                          <?php }else{ ?>
                                          <?php 
                                             if(!isset($budget_po_data['ub_po_co_id']) || (isset($budget_po_data['po_status']) && $budget_po_data['po_status'] == 'Not Released'  && isset($budget_po_data['created_by']) && $budget_po_data['created_by'] == $this->user_session['ub_user_id'])){
                                             
                                             if(!empty($assigned_to))
                                             {
                                             $users_selected = '';
                                             if(isset($budget_po_data['assigned_to']))
                                             {
                                             $users_selected = $budget_po_data['assigned_to'];
                                             }
                                             //array_unshift($assigned_to, "Nothing selected");
                                             if(isset($assigned_to['status']))
                                              {
                                                 unset($assigned_to['status']);
                                              }
                                              if($this->user_account_type == OWNER)
                                              {
                                                //print_r($assigned_to);exit;
                                                unset($assigned_to['Sub contractor']);
                                              }
                                             //print_r($assigned_to['Builder user'][$this->user_id]);exit;
                                             //unset($assigned_to['Builder user'][$this->user_id]);
                                             echo form_dropdown('assigned_to', $assigned_to, $users_selected, "class='selectpicker form-control' id='assigned_to' data-live-search='true'");
                                             }else
                                             {
                                             echo form_dropdown('assigned_to', array(), '', "class='selectpicker form-control' id='assigned_to' data-live-search='true'");
                                             }
                                             }
                                             else
                                             {
                                             ?>
                                          <input type="hidden" class="form-control varian" name="assigned_to" id="assigned_to" value="<?php if(isset($budget_po_data['assigned_to'])) echo $budget_po_data['assigned_to'] ?>"/>
                                          <label><?php if(isset($budget_po_data['first_name'])) echo $budget_po_data['first_name'] ?></label>
                                          <?php } }               
                                             ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-xs-3">
                                    <p>&nbsp;</p>
                                    <?php if(isset($budget_po_data['ub_po_co_id'])){ ?>
                                    <?php 
                                       if(!isset($budget_po_data['ub_po_co_id']) || (isset($budget_po_data['po_status']) && $budget_po_data['po_status'] == 'Not Released'  && isset($budget_po_data['created_by']) && $budget_po_data['created_by'] == $this->user_session['ub_user_id'])){ ?>
                                    <p><input type="checkbox" name="materials_only" <?php if(isset($budget_po_data['materials_only']) && $budget_po_data['materials_only']==='Yes') echo  "checked='checked'";?> /> Materials only?</p>
                                    <?php }else{ ?>
                                    <p><input type="checkbox"  <?php if(isset($budget_po_data['materials_only']) && $budget_po_data['materials_only']==='Yes') echo  "checked='checked'";?> <?php echo "disabled='disabled'"; ?> /> Materials only?</p>

                                    <input type="hidden" name="materials_only" id="materials_only" value="<?php echo (isset($budget_po_data['materials_only']) && $budget_po_data['materials_only']==='Yes')?'Yes':'No';?>">

                                    <?php } }else{ ?>
                                       <p><input type="checkbox" name="materials_only" <?php if(isset($budget_po_data['materials_only']) && $budget_po_data['materials_only']==='Yes') echo  "checked='checked'";?> /> Materials only?</p>
                                       
                                    <?php } ?>
                                 </div>
                                 
                              </div>
                              <div class="row">
                              <div class="col-xs-3 pull-left">
                                    <label>Scheduled Completion</label>
                                    <?php if(!isset($budget_po_data['ub_po_co_id']) || (isset($budget_po_data['po_status']) && $budget_po_data['po_status'] == 'Not Released' && isset($budget_po_data['created_by']) && $budget_po_data['created_by'] == $this->user_session['ub_user_id'])){?>
                                    <div class='input-group date' id='datetimepicker5'> 
                                       <input type="text" class="form-control" name="due_date" id="due_date" value="<?php if(isset($budget_po_data['due_date'])) echo date("m/d/Y", strtotime($budget_po_data['due_date']));?>">
                                       <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                                    </div>
                                    <?php } else{?>
                                    <div>
                                    <input type="hidden" class="form-control varian" name="due_date" id="due_date" value="<?php if(isset($budget_po_data['due_date'])) echo $budget_po_data['due_date'] ?>"/>
                                    <label><?php if(isset($budget_po_data['due_date'])){ echo $budget_po_data['scheduled_completion']; }else{ echo "Nil";}?></label>
                                 </div>
                                    <?php }?>
                                 
                                 </div>
                                 </div>
                           </div>
                        </div>
                     </div>
                     <!-- cost code start here -->
                     <?php if($bid_po_id > 0){ ?>
                     <div class="row m-top change_cost_code_list">
                        <div class="col-xs-12">
                           <div class="box-content">
                              <div class="row">
                                 <div class="col-xs-12">
                                    <h5><label>Cost</label></h5>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-xs-2">
                                    <label>&nbsp;</label>
                                 </div>
                                 <div class="col-xs-2">
                                    <label>Cost Code</label>
                                 </div>
                                 <div class="col-xs-2">
                                    <label>Quantity</label>
                                 </div>
                                 <div class="col-xs-2">
                                    <label>Unit Cost</label>
                                 </div>
                                 <div class="col-xs-2">
                                    <label>Total</label>
                                 </div>
                              </div>
                              <div class="cointainer" id="cost_code_view">
                                 <?php 
                                    for($i=0; $i < $count_cn; $i++)
                                    {
                                    ?>           
                                 <div class="content">
                                    <div class="row">
                                       <div class="col-xs-2">
                                          <?php if(!isset($cost_code_id[$i])){ ?>
                                          <p>
                                             <a class="removeBtn" href="javascript:void(0);"><img alt="delete" src="<?php echo IMAGESRC . 'delete.png'; ?>" border="0"/></a>
                                          </p>
                                          <?php } ?>
                                       </div>
                                       <div class="col-xs-2">
                                          <div class="col-xs-12">
                                             <div class="form-group">    
                                                <input type="hidden" name="ub_po_co_cost_code_id[]" id="ub_po_co_cost_code_id" value="<?php if(isset($ub_po_co_cost_code_id[$i])) echo $ub_po_co_cost_code_id[$i] ?>" />
                                                <?php
                                                   if(isset($cost_code_id[$i])){ ?>

                                                      <input type="hidden" class="form-control varian"  name="cost_code_id[]" id="cost_code_id" value="<?php if(isset($cost_code_id[$i])) echo $cost_code_id[$i] ?>"/>
                                                     <label><?php if(isset($cost_variance_code[$i])) echo $cost_variance_code[$i] ?></label>

                                                   <?php } else{ 
                                                   echo form_dropdown('cost_code_id[]', $cost_code_options, '', "class='form-control cost_code_select selectpicker' id='cost_code_id' data-live-search='true'");
                                                   } 
                                                   ?>
                                                  

                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-2">
                                          <div class="col-xs-12">
                                             <div class="form-group"> 					  
                                                <input type="text" class="form-control varian quantity" placeholder="Quantity" name="quantity[]" id="quantity" value="1" />
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-2">
                                          <div class="col-xs-12">
                                             <div class="form-group"> 					  
                                                <input type="text" class="form-control varian uni_cost" placeholder="Unit Cost($)" name="unit_cost[]" id="unit_cost" value="0" />
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-2">                             
                                          <input type="text" class="form-control total" placeholder="Total($)" name="total[]" id="total" value="0" readonly/>
                                       </div>
                                    </div>
                                 </div>
                                 <?php } ?>
                                 <?php if($type=='PO'){?> 
                                 <?php if(empty($cost_code_id)){ ?> 
                                 <div class="row">
                                    <div class="col-xs-12">
                                       <a href="javascript:void(0);" class="sprite addBtn">
                                       <img border="0" src="<?php echo IMAGESRC . 'strip.gif'; ?>" alt="Add" class="plus">
                                       Add</a>   
                                    </div>
                                 </div>
                                 <?php } } ?>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php } else if(isset($budget_po_data['bid_po_id']) && $budget_po_data['bid_po_id'] > 0){ ?>
                       <div class="row m-top change_cost_code_list">
                        <div class="col-xs-12">
                           <div class="box-content">
                              <div class="row">
                                 <div class="col-xs-12">
                                    <h5><label>Cost</label></h5>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-xs-2">
                                    <label>&nbsp;</label>
                                 </div>
                                 <div class="col-xs-2">
                                    <label>Cost Code</label>
                                 </div>
                                 <div class="col-xs-2">
                                    <label>Quantity</label>
                                 </div>
                                 <div class="col-xs-2">
                                    <label>Unit Cost</label>
                                 </div>
                                 <div class="col-xs-2">
                                    <label>Total</label>
                                 </div>
                              </div>
                              <div class="cointainer" id="cost_code_view">
                                 <?php 
                                    for($i=0; $i < $count_cn; $i++)
                                    {
                                    ?>           
                                 <div class="content">
                                    <div class="row">
                                       <div class="col-xs-2">
                                         <!--  <p>
                                             <a class="removeBtn" href="javascript:void(0);"><img alt="delete" src="<?php echo IMAGESRC . 'delete.png'; ?>" border="0"/></a>
                                          </p> -->
                                       </div>
                                       <div class="col-xs-2">
                                          <div class="col-xs-12">
                                             <div class="form-group">    
                                                <input type="hidden" name="ub_po_co_cost_code_id[]" id="ub_po_co_cost_code_id" value="<?php if(isset($ub_po_co_cost_code_id[$i])) echo $ub_po_co_cost_code_id[$i] ?>" />
                                                <?php
                                                   if(isset($cost_code_id[$i])){ $cost_code_selected = $cost_code_id[$i]; }else{$cost_code_selected = '';}
                                                   /*echo form_dropdown('cost_code_id[]', $cost_code_options, $cost_code_selected, "class='form-control cost_code_select selectpicker' id='cost_code_id' data-live-search='true'");*/ 
                                                   ?>
                                                 <input type="hidden" class="form-control varian"  name="cost_code_id[]" id="cost_code_id" value="<?php if(isset($cost_code_id[$i])) echo $cost_code_id[$i] ?>"/>
                                                <label><?php if(isset($cost_variance_code[$i])) echo $cost_variance_code[$i] ?></label>

                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-2">
                                          <div class="col-xs-12">
                                             <div class="form-group">                 
                                                <input type="text" class="form-control varian quantity" placeholder="Quantity" name="quantity[]" id="quantity" value="<?php if(isset($quantity[$i])) echo intval($quantity[$i]) ?>" <?php if(isset($budget_po_data['po_status']) && $budget_po_data['po_status'] != 'Not Released' || isset($budget_po_data['created_by']) && $budget_po_data['created_by'] != $this->user_session['ub_user_id']) { echo "readonly='readonly'"; }?> />
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-2">
                                          <div class="col-xs-12">
                                             <div class="form-group">                 
                                                <input type="text" class="form-control varian uni_cost" placeholder="Unit Cost($)" name="unit_cost[]" id="unit_cost" value="<?php if(isset($unit_cost[$i])) echo $unit_cost[$i] ?>" <?php if(isset($budget_po_data['po_status']) && $budget_po_data['po_status'] != 'Not Released' || isset($budget_po_data['created_by']) && $budget_po_data['created_by'] != $this->user_session['ub_user_id']) { echo "readonly='readonly'"; }?> />
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-2">                             
                                          <input type="text" class="form-control total" placeholder="Total($)" name="total[]" id="total" value="<?php if(isset($total[$i])) echo $total[$i] ?>" readonly/>
                                       </div>
                                    </div>
                                 </div>
                                 <?php } ?>
                                 <?php if($type=='PO'){?>  
                                 <!-- <div class="row">
                                    <div class="col-xs-12">
                                       <a href="javascript:void(0);" class="sprite addBtn">
                                       <img border="0" src="<?php echo IMAGESRC . 'strip.gif'; ?>" alt="Add" class="plus">
                                       Add</a>   
                                    </div>
                                 </div> -->
                                 <?php } ?>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                     <?php }else { ?>
                      <div class="cost_code">
                        <?php // $this->load->view('content/budget/cost_code'); ?>
                      </div>
                     <div class="row m-top change_cost_code_list" id="change_cost_code_list">
                        <div class="col-xs-12">
                           <div class="box-content">
                              <div class="row">
                                 <div class="col-xs-12">
                                    <h5><label>Cost</label></h5>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-xs-2">
                                    <label>&nbsp;</label>
                                 </div>
                                 <div class="col-xs-2">
                                    <label>Cost Code</label>
                                 </div>
                                 <div class="col-xs-2">
                                    <label>Quantity</label>
                                 </div>
                                 <div class="col-xs-2">
                                    <label>Unit Cost</label>
                                 </div>
                                 <div class="col-xs-2">
                                    <label>Total</label>
                                 </div>
                              </div>
                              <div class="cointainer " id="cost_code_view">
                                 <?php 
                                    for($i=0; $i < $count_cn; $i++)
                                    {
                                    ?>           
                                 <div class="content">
                                    <div class="row">
                                       <div class="col-xs-2">
                                          <?php
                                             if(isset($budget_po_data['po_status']) && $budget_po_data['po_status'] == 'Not Released' && isset($budget_po_data['created_by']) && $budget_po_data['created_by'] == $this->user_session['ub_user_id']) { 
                                             ?>
                                          <p><a class="removeBtn" href="javascript:void(0);"><img alt="delete" src="<?php echo IMAGESRC . 'delete.png'; ?>" border="0"/></a></p>
                                          <?php } else if(!isset($budget_po_data['po_status'])){?> 
                                          <p><a class="removeBtn" href="javascript:void(0);"><img alt="delete" src="<?php echo IMAGESRC . 'delete.png'; ?>" border="0"/></a></p>
                                          <?php }  ?>
                                       </div>
                                       <div class="col-xs-2">
                                          <div class="col-xs-12">
                                             <div class="form-group"> 					  
                                                <input type="hidden" name="ub_po_co_cost_code_id[]" id="ub_po_co_cost_code_id" value="<?php if(isset($ub_po_co_cost_code_id[$i])) echo $ub_po_co_cost_code_id[$i] ?>" />
                                                <?php
                                                   if(isset($cost_code_id[$i])){ $cost_code_selected = $cost_code_id[$i]; }else{$cost_code_selected = '';}
                                                   if(!isset($budget_po_data['po_status']) || $budget_po_data['po_status'] == 'Not Released' && isset($budget_po_data['created_by']) && $budget_po_data['created_by'] == $this->user_session['ub_user_id']){ 
                                                   
                                                   echo form_dropdown('cost_code_id[]', $cost_code_options, $cost_code_selected, "class='form-control cost_code_select selectpicker' id='cost_code_id' data-live-search='true'");
                                                   }else{
                                                   ?>
                                                <input type="hidden" class="form-control varian"  name="cost_code_id[]" id="cost_code_id" value="<?php if(isset($cost_code_id[$i])) echo $cost_code_id[$i] ?>"/>
                                                <label><?php if(isset($cost_variance_code[$i])) echo $cost_variance_code[$i] ?></label>
                                                <?php 
                                                   } ?>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-2">
                                          <div class="col-xs-12">
                                             <div class="form-group"> 
                                                <input type="text" class="form-control varian quantity" placeholder="Quantity" name="quantity[]" id="quantity" value="<?php if(isset($quantity[$i])) echo $quantity[$i] ?>" <?php if(isset($budget_po_data['po_status']) && $budget_po_data['po_status'] != 'Not Released' || isset($budget_po_data['created_by']) && $budget_po_data['created_by'] != $this->user_session['ub_user_id']) { echo "readonly='readonly'"; }?>/>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-2">
                                          <div class="col-xs-12">
                                             <div class="form-group"> 					  
                                                <input type="text" class="form-control varian uni_cost" placeholder="Unit Cost($)" name="unit_cost[]" id="unit_cost" value="<?php if(isset($unit_cost[$i])) echo $unit_cost[$i] ?>" <?php if(isset($budget_po_data['po_status']) && $budget_po_data['po_status'] != 'Not Released' || isset($budget_po_data['created_by']) && $budget_po_data['created_by'] != $this->user_session['ub_user_id']) { echo "readonly='readonly'"; }?>/>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-2">                             
                                          <input type="text" class="form-control total" placeholder="Total($)" name="total[]" id="total" value="<?php if(isset($total[$i])) echo $total[$i] ?>" readonly/>
                                       </div>
                                    </div>
                                 </div>
                                 <?php } ?>  
                                 <div class="row">
                                    <div class="col-xs-12">
                                       <?php
                                          if(isset($budget_po_data['po_status']) && $budget_po_data['po_status'] == 'Not Released' && isset($budget_po_data['created_by']) && $budget_po_data['created_by'] == $this->user_session['ub_user_id']) { 
                                          ?>
                                       <a href="javascript:void(0);" class="sprite addBtn">
                                       <img border="0" src="<?php echo IMAGESRC . 'strip.gif'; ?>" alt="Add" class="plus">
                                       Add</a>   
                                       <?php }else if(!isset($budget_po_data['po_status'])){?>
                                       <a href="javascript:void(0);" class="sprite addBtn">
                                       <img border="0" src="<?php echo IMAGESRC . 'strip.gif'; ?>" alt="Add" class="plus">
                                       Add</a>   
                                       <?php }?>                                
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
					 <?php } ?>
					 
                     <div class="row m-top">
                        <div class="col-xs-12">
                           <div class="box-content">
                              <div class="row">
                                 <div class="col-xs-12">
                                    <h5><label>Notes</label></h5>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-xs-12">
                                    <textarea class="form-control" name="notes" id="notes" <?php if(isset($budget_po_data['ub_po_co_id']) && (isset($budget_po_data['po_status']) && $budget_po_data['po_status'] != 'Not Released' || isset($budget_po_data['created_by']) && $budget_po_data['created_by'] != $this->user_session['ub_user_id'])) { echo "readonly='readonly'"; } ?>><?php if(isset($budget_po_data['notes'])) echo $budget_po_data['notes'];?></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
				   				 
				
                  </div>
                  <div class="tab-pane" id="scope_work">
                     <div class="row">
                        <div class="col-xs-4">
                           <div class="row">
                              <div class="col-xs-12">
                                 <label>Scope of Work</label>
                                 <textarea class="ckeditor" name="scope_of_work" id="scope_of_work" <?php if(isset($budget_po_data['ub_po_co_id']) && isset($budget_po_data['created_by']) && $budget_po_data['created_by'] != $this->user_session['ub_user_id']) { echo "readonly='readonly'"; } ?>><?php if(isset($budget_po_data['scope_of_work'])) echo $budget_po_data['scope_of_work'];?></textarea>
                              </div>
                              <div class="col-xs-12">
                                 <p class="text-primary"><a href="javascript:void(0);" class="text-primary" data-toggle="modal" data-target="#docs_upload_Modal"><u>Clik Here</u></a>  to Choose from Unibuilder docs</p>
                              </div>
                              <div class="col-xs-12 m-top">                              
                                 <?php $this->load->view('common/upload.php');?>
                                 <?php //$this->load->view('common/uploaded_content.php');?>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-8">
                           <table class="table table-bordered datatable" id="po_scope_list"></table>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="status_log">
                     <div class="row">
                        <div class="col-xs-12">
                           <table class="table table-bordered datatable" id="po_status_list">
                              <thead>
                                 <tr>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>By</th>
                                    <th>Comments</th>
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="bids">
                     <div class="row">
                        <div class="col-xs-12">
                           <table class="table table-bordered datatable" id="po_bids_list">
                              <thead>
                                 <tr>
                                    <th>Bid Name</th>
                                    <th>Date Copied</th>
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
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
                                                       if(isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] == 'Accepted by Builder' || $budget_po_data['po_status'] == 'Accepted by Sub')) 
                                 { 
                                                      ?>
                              <button class="btn btn-blue pull-right m-left-1" type="button" onclick="get_payment();">
                              <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="savenew" />  Create a Payment
                              </button> 
                              <?php 
                                 }
                                 }  
                                 ?> 							   
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
</form>
<div class="modal fade" id="docs_upload_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Choose a file from Unibuilder Docs
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row m-top">
               <div class="col-xs-12 upload_error-message uni_message">
                  <div class="upload_alerts alert-danger"></div>
               </div>
            </div>
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
                  <button class="btn btn-success" type="submit" onclick="copy_file_to_temp()">Upload</button>
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
<script type="text/javascript">        
    this.default_pagination_length   = '<?php echo isset($search_session_array['iDisplayLength'])?$search_session_array['iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>';
   this.displayStart   = '<?php echo isset($search_session_array['iDisplayStart'])?$search_session_array['iDisplayStart']:0; ?>'; 
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.list_page   = 'yes';     
</script>
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.signaturepad.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'file-tree.min.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'jquery.mjs.nestedSortable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'file-tree.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/ckeditor.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'save_po_co.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.signaturepad.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'json2.min.js';?>"></script>
<script> 
   $(function(){      
   	CKEDITOR.replace( 'scope_of_work', {
   	toolbar : [
   		[ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat']
   	]
   	});
   });
 
</script>
