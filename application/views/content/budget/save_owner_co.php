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
                         <?php if(isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] != 'Accepted by Builder' && $budget_po_data['po_status'] != 'Accepted by Client'))
                         {   ?>
                         <button class="btn btn-blue pull-right m-left-1" type="button" id="<?php if(isset($budget_po_data['ub_po_co_id'])) echo $budget_po_data['ub_po_co_id']; ?>" onclick="delete_po_co(this.id)">
                        <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="delete_icon"/> Delete
                        </button>
                        <?php } ?> 

                    <?php if($type == 'PO') { ?>
                    <!-- <a href="<?php echo base_url().$this->crypt->encrypt('prints/purchase_order/'.$budget_po_data['ub_po_co_id']); ?>" target="_blank"><button class="btn btn-blue  pull-right m-left-1" type="button" id="" name="print_bid"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_print"/>Print</button></a> -->
                    <?php } else {?>
                    <!-- <a href="<?php echo base_url().$this->crypt->encrypt('prints/change_order/'.$budget_po_data['ub_po_co_id'].'/'.$budget_po_data['project_id']); ?>" target="_blank"><button class="btn btn-blue  pull-right m-left-1" type="button" id="" name="print_bid"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_print"/>Print</button></a> -->
                    <?php }?>
                    <?php 
                        } 
                        }
                        ?>
                    <?php 
                        if(isset($this->project_status_check) && $this->project_status_check == 1)
                        {
                        ?>
                    <?php
                        if(isset($budget_po_data['ub_po_co_id']) && ($budget_po_data['po_status'] != 'Release to Client' && $budget_po_data['po_status'] != 'Accepted by Client' && $budget_po_data['po_status'] != 'Accepted by Builder' && $budget_po_data['po_status'] != 'Rejected by Client' && $budget_po_data['po_status'] != 'Rejected by Builder'  && isset($budget_po_data['ub_po_co_id'])) && $this->user_account_type == BUILDERADMIN) { 
                        ?>
                    <button type="submit" class="btn btn-blue  pull-right m-left-1"  id="save_release"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="save_replay">Release to Owner</button>
                    <?php }else if(isset($budget_po_data['ub_po_co_id']) && $budget_po_data['po_status'] == 'Release to Client'  && ($budget_po_data['po_status'] != 'Accepted by Builder' && $budget_po_data['po_status'] != 'Accepted by Client' && $budget_po_data['po_status'] != 'Rejected by Builder' && $budget_po_data['po_status'] != 'Rejected by Client')){
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
                         if(isset($budget_po_data['ub_po_co_id']) && isset($budget_po_data['created_by']) && $budget_po_data['created_by'] == $this->user_session['ub_user_id'] && $budget_po_data['po_status'] != 'Release to Client' && $budget_po_data['po_status'] != 'Accepted by Builder' && $budget_po_data['po_status'] != 'Accepted by Client' && $budget_po_data['po_status'] != 'Rejected by Builder' && $budget_po_data['po_status'] != 'Rejected by Client')
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
                    <?php if($this->user_account_type == BUILDERADMIN){ ?>
                    <!-- <a href="javascript:void(0);" id="release_owner" ><button type="button" class="btn btn-blue  pull-right m-left-1">
                        <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="save_replay"> Release to Owner
                        </button></a>
                        <a href="javascript:void(0);" id="assign_to_vendor" ><button type="button" class="btn btn-blue  pull-right m-left-1">
                        <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="save_new"> Assign to Vendor
                        </button></a> -->
                    <?php } ?>
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
                    <?php if($type == 'OWNER CO'){ ?>
                    <?php if($this->user_account_type == OWNER){?>
                    <input type="hidden" name="status" id="status" value="<?php echo (isset($budget_po_data['po_status'])?$budget_po_data['po_status']:'Client CO Request') ?>" />
                    <input type="hidden" name="status_val" id="status_val" value="<?php echo (isset($budget_po_data['po_status'])?$budget_po_data['po_status']:'Client CO Request') ?>" />
                    <?php } ?>
                    <?php if($this->user_account_type == BUILDERADMIN){?>
                    <input type="hidden" name="status" id="status" value="<?php echo (isset($budget_po_data['po_status'])?$budget_po_data['po_status']:'Client CO Request by Builder') ?>" />
                    <input type="hidden" name="status_val" id="status_val" value="<?php echo (isset($budget_po_data['po_status'])?$budget_po_data['po_status']:'Client CO Request by Builder') ?>" />
                    <?php } }else{ ?>
                    <?php if($this->user_account_type == OWNER){?>
                    <input type="hidden" name="status" id="status" value="<?php echo (isset($budget_po_data['po_status'])?$budget_po_data['po_status']:'Client PO Request') ?>" />
                    <input type="hidden" name="status_val" id="status_val" value="<?php echo (isset($budget_po_data['po_status'])?$budget_po_data['po_status']:'Client PO Request') ?>" />
                    <?php } ?>
                    <?php if($this->user_account_type == BUILDERADMIN){?>
                    <input type="hidden" name="status" id="status" value="<?php echo (isset($budget_po_data['po_status'])?$budget_po_data['po_status']:'Client PO Request by Builder') ?>" />
                    <input type="hidden" name="status_val" id="status_val" value="<?php echo (isset($budget_po_data['po_status'])?$budget_po_data['po_status']:'Client PO Request by Builder') ?>" />
                    <?php } }?>
                    <ul class="nav nav-tabs" role="tablist" id="budget_po_tab">
                        <li role="presentation" class="active"> <a href="#general" aria-controls="general" data-toggle="tab" id="general_tab">General</a> </li>
                        <li role="presentation"> <a href="#scope_work" aria-controls="scope_work" data-toggle="tab" id="scope_of_work_tab">Scope of Work</a> </li>
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
                                            <?php if($type == 'OWNER CO' && isset($po_result['title'])){ ?>
                                            <div class="col-xs-3">
                                                <label>CLIENT PO</label>
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
                                                <label><?php echo $type ?>#</label>
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
                                            <?php if($type == 'OWNER CO' && $bid_po_id == 0 && $this->user_account_type == BUILDERADMIN && !isset($cost_code_data['cost_code_id']) && !empty($owner_po_list)){ ?>
                                            <div class="col-xs-3">
                                                <label>Select CLIENT PO</label>
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <?php echo form_dropdown('po_id', $owner_po_list, '', "class='selectpicker form-control2' id='po_id' data-live-search='true'"); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="col-xs-3">
                                                <label>Title</label>
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="title"  id="title" value="<?php if(isset($budget_po_data['title'])) echo $budget_po_data['title'];?>" <?php if(isset($budget_po_data['ub_po_co_id']) && ($budget_po_data['po_status'] != 'Client CO Request' && $budget_po_data['po_status'] != 'Client CO Request by Builder' && $budget_po_data['po_status'] != 'Client PO Request by Builder' && $budget_po_data['po_status'] != 'Client PO Request' || isset($budget_po_data['created_by']) && $budget_po_data['created_by'] != $this->user_session['ub_user_id'])) { echo "readonly='readonly'"; } ?> />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Assigned to</label>
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <?php 
                                                            $users_selected = '';
                                                            if(isset($budget_po_data['assigned_to']))
                                                            {
                                                              $users_selected = $budget_po_data['assigned_to'];
                                                            }
                                                            if($this->user_account_type == BUILDERADMIN)
                                                            {
                                                              // if(!isset($budget_po_data['ub_po_co_id'])){
                                                                unset($owner['Builder user']);
                                                              // }
                                                              //unset($owner['Builder user']);
                                                              unset($owner['Sub contractor']);
                                                            }
                                                            if($this->user_account_type == OWNER)
                                                            {
                                                              // if(!isset($budget_po_data['ub_po_co_id'])){
                                                              unset($owner['Owner']);
                                                             // }
                                                             unset($owner['Sub contractor']);
                                                            }
                                                            if(!isset($budget_po_data['ub_po_co_id']) || isset($budget_po_data['created_by']) && $budget_po_data['created_by'] == $this->user_session['ub_user_id'] && ($budget_po_data['po_status'] != 'Release to Client' && $budget_po_data['po_status'] != 'Accepted by Builder' && $budget_po_data['po_status'] != 'Accepted by Client' && $budget_po_data['po_status'] != 'Rejected by Builder' && $budget_po_data['po_status'] != 'Rejected by Client')){

                                                               if($this->user_account_type == BUILDERADMIN && isset($owner['Owner']) && !isset($budget_po_data['ub_po_co_id']))
                                                               {
                                                                 //print_r($owner['Owner']);
                                                                $users_selected = $owner_name['owner_id'];
                                                               }
                                                               if($this->user_account_type == OWNER){
                                                                 echo form_dropdown('assigned_to', $owner, $users_selected, "class='selectpicker form-control' id='assigned_to' data-live-search='true'");
                                                               } else{ ?>

                                                               <input type="hidden" class="form-control varian" name="assigned_to" id="assigned_to" value="<?php if(isset($owner_name['owner_id'])) echo $owner_name['owner_id'] ?>"/>
                                                              <label><?php if(isset($owner_name['owner_id']) && $owner_name['owner_id'] > 0){ echo $owner_name['first_name']; }else{ echo "Owner"; } ?></label>
                                                               <?php
                                                             } }
                                                             else
                                                             {
                                                            ?>
                                                        <input type="hidden" class="form-control varian" name="assigned_to" id="assigned_to" value="<?php if(isset($budget_po_data['assigned_to'])) echo $budget_po_data['assigned_to'] ?>"/>
                                                        <label><?php if(isset($budget_po_data['first_name']) && $budget_po_data['assigned_to'] > 0){ echo $budget_po_data['first_name']; }else{ if($this->user_account_type == OWNER){echo "No Assignee";}else{echo "Owner";} } ?></label>
                                                        <?php 
                                                            }
                                                            
                                                            ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-3">
                                                <p>&nbsp;</p>
                                                <?php if(isset($budget_po_data['ub_po_co_id'])){ ?>
                                                <?php 
                                                 if(!isset($budget_po_data['ub_po_co_id']) || isset($budget_po_data['created_by']) && $budget_po_data['created_by'] == $this->user_session['ub_user_id'] && ($budget_po_data['po_status'] != 'Release to Client' && $budget_po_data['po_status'] != 'Accepted by Builder' && $budget_po_data['po_status'] != 'Accepted by Client' && $budget_po_data['po_status'] != 'Rejected by Builder' && $budget_po_data['po_status'] != 'Rejected by Client')){ ?>
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
                                                <?php if(!isset($budget_po_data['ub_po_co_id']) || isset($budget_po_data['created_by']) && $budget_po_data['created_by'] == $this->user_session['ub_user_id'] && ($budget_po_data['po_status'] != 'Release to Client' && $budget_po_data['po_status'] != 'Accepted by Builder' && $budget_po_data['po_status'] != 'Accepted by Client' && $budget_po_data['po_status'] != 'Rejected by Builder' && $budget_po_data['po_status'] != 'Rejected by Client')){?>
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
                                        <div class="cointainer " id="cost_code_view">
                                            <?php 
                                                for($i=0; $i < $count_cn; $i++)
                                                {
                                                ?>           
                                            <div class="content">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <!-- <p>
                                                            <a class="removeBtn" href="javascript:void(0);"><img alt="delete" src="<?php echo IMAGESRC . 'delete.png'; ?>" border="0"/></a>
                                                        </p> -->
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <div class="col-xs-12">
                                                            <div class="form-group">    
                                                                <input type="hidden" name="ub_po_co_cost_code_id[]" id="ub_po_co_cost_code_id" value="<?php if(isset($ub_po_co_cost_code_id[$i])) echo $ub_po_co_cost_code_id[$i] ?>" />
                                                                <?php
                                                                    if(isset($cost_code_id[$i])){ $cost_code_selected = $cost_code_id[$i]; }else{$cost_code_selected = '';}
                                                                    //echo form_dropdown('cost_code_id[]', $cost_code_options, $cost_code_selected, "class='form-control cost_code_select selectpicker' id='cost_code_id' data-live-search='true'"); ?>
                                                                    <input type="hidden" class="form-control varian"  name="cost_code_id[]" id="cost_code_id" value="<?php if(isset($cost_code_id[$i])) echo $cost_code_id[$i] ?>"/>
                                                                    <label><?php if(isset($cost_variance_code[$i])) echo $cost_variance_code[$i] ?></label>
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
                                            <?php if($type=='OWNER PO'){?>  
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <a href="javascript:void(0);" class="sprite addBtn">
                                                    <img border="0" src="<?php echo IMAGESRC . 'strip.gif'; ?>" alt="Add" class="plus">
                                                    Add</a>   
                                                </div>
                                            </div>
                                            <?php } ?>
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
                                        <div class="cointainer " id="cost_code_view">
                                            <?php 
                                                for($i=0; $i < $count_cn; $i++)
                                                {
                                                ?>           
                                            <div class="content">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <!-- <p>
                                                            <a class="removeBtn" href="javascript:void(0);"><img alt="delete" src="<?php echo IMAGESRC . 'delete.png'; ?>" border="0"/></a>
                                                        </p> -->
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <div class="col-xs-12">
                                                            <div class="form-group">    
                                                                <input type="hidden" name="ub_po_co_cost_code_id[]" id="ub_po_co_cost_code_id" value="<?php if(isset($ub_po_co_cost_code_id[$i])) echo $ub_po_co_cost_code_id[$i] ?>" />
                                                                <?php
                                                                    if(isset($cost_code_id[$i])){ $cost_code_selected = $cost_code_id[$i]; }else{$cost_code_selected = '';}
                                                                    //echo form_dropdown('cost_code_id[]', $cost_code_options, $cost_code_selected, "class='form-control cost_code_select selectpicker' id='cost_code_id' data-live-search='true'"); ?>
                                                                    <input type="hidden" class="form-control varian"  name="cost_code_id[]" id="cost_code_id" value="<?php if(isset($cost_code_id[$i])) echo $cost_code_id[$i] ?>"/>
                                                                    <label><?php if(isset($cost_variance_code[$i])) echo $cost_variance_code[$i] ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <div class="col-xs-12">
                                                            <div class="form-group">                      
                                                                <input type="text" class="form-control varian quantity" placeholder="Quantity" name="quantity[]" id="quantity" value="<?php if(isset($quantity[$i])) echo intval($quantity[$i]) ?>" <?php if(isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] == 'Release to Client' || $budget_po_data['po_status'] == 'Accepted by Builder' || $budget_po_data['po_status'] == 'Accepted by Client' || $budget_po_data['po_status'] == 'Rejected by Builder' || $budget_po_data['po_status'] == 'Rejected by Client')) { echo "readonly='readonly'"; }?> />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <div class="col-xs-12">
                                                            <div class="form-group">                      
                                                                <input type="text" class="form-control varian uni_cost" placeholder="Unit Cost($)" name="unit_cost[]" id="unit_cost" value="<?php if(isset($unit_cost[$i])) echo $unit_cost[$i] ?>" <?php if(isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] == 'Release to Client' || $budget_po_data['po_status'] == 'Accepted by Builder' || $budget_po_data['po_status'] == 'Accepted by Client' || $budget_po_data['po_status'] == 'Rejected by Builder' || $budget_po_data['po_status'] == 'Rejected by Client')) { echo "readonly='readonly'"; }?> />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-2">                             
                                                        <input type="text" class="form-control total" placeholder="Total($)" name="total[]" id="total" value="<?php if(isset($total[$i])) echo $total[$i] ?>" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <?php if($type=='OWNER PO'){?>  
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <a href="javascript:void(0);" class="sprite addBtn">
                                                    <img border="0" src="<?php echo IMAGESRC . 'strip.gif'; ?>" alt="Add" class="plus">
                                                    Add</a>   
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php }else if($this->user_account_type == BUILDERADMIN || (isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] == 'Release to Client' || $budget_po_data['po_status'] == 'Accepted by Builder' || $budget_po_data['po_status'] == 'Accepted by Client' || $budget_po_data['po_status'] == 'Rejected by Builder' || $budget_po_data['po_status'] == 'Rejected by Client'))) { ?>
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
                                                            if(isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] == 'Client CO Request' || $budget_po_data['po_status'] == 'Client CO Request by Builder' || $budget_po_data['po_status'] == 'Client PO Request by Builder' || $budget_po_data['po_status'] == 'Client PO Request')) { 
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
                                                                    if(!isset($budget_po_data['po_status']) || $budget_po_data['po_status'] == 'Client CO Request' || $budget_po_data['po_status'] == 'Client CO Request by Builder' || $budget_po_data['po_status'] == 'Client PO Request by Builder' || $budget_po_data['po_status'] == 'Client PO Request'){ 
                                                                    
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
                                                                <input type="text" class="form-control varian quantity" placeholder="Quantity" name="quantity[]" id="quantity" value="<?php if(isset($quantity[$i])) echo $quantity[$i] ?>" <?php if(isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] == 'Release to Client' || $budget_po_data['po_status'] == 'Accepted by Builder' || $budget_po_data['po_status'] == 'Accepted by Client' || $budget_po_data['po_status'] == 'Rejected by Builder' || $budget_po_data['po_status'] == 'Rejected by Client')) { echo "readonly='readonly'"; }?>/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <div class="col-xs-12">
                                                            <div class="form-group"> 					  
                                                                <input type="text" class="form-control varian uni_cost" placeholder="Unit Cost($)" name="unit_cost[]" id="unit_cost" value="<?php if(isset($unit_cost[$i])) echo $unit_cost[$i] ?>" <?php if(isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] == 'Release to Client' || $budget_po_data['po_status'] == 'Accepted by Builder' || $budget_po_data['po_status'] == 'Accepted by Client' || $budget_po_data['po_status'] == 'Rejected by Builder' || $budget_po_data['po_status'] == 'Rejected by Client')) { echo "readonly='readonly'"; }?>/>
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
                                                        if(isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] == 'Client CO Request' || $budget_po_data['po_status'] == 'Client CO Request by Builder' || $budget_po_data['po_status'] == 'Client PO Request by Builder' || $budget_po_data['po_status'] == 'Client PO Request')) { 
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
                            <?php if(($this->user_account_type == OWNER && (isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] == 'Release to Client' || $budget_po_data['po_status'] == 'Accepted by Builder' || $budget_po_data['po_status'] == 'Accepted by Client' && $budget_po_data['signature_content'] !=''))) || (isset($budget_po_data['signature_content']) && $budget_po_data['signature_content']!='' && $this->user_account_type == BUILDERADMIN)) {?>
                              
                            <div class="row m-top signature_wrapper">
                                <div class="col-xs-12">
                                    <?php if($budget_po_data['signature_content'] ==''){ ?>
                                    <label>Sign / Upload Signature</label>
                                    <?php } ?>
                                    <!-- <label>Status:Owner Approval: Pending</label> -->
                                </div>
                                <div class="col-xs-4 m-top">
                                    <div class="sigPad">
                                        <div class="sig sigWrapper">
                                            <div class="typed"></div>
                                            <canvas class="pad" width="300" height="200" name="signature"></canvas>
                                            <input type="hidden" id="signature_content" name="output" class="output" value='<?php if(isset($budget_po_data['signature_content'])) echo $budget_po_data['signature_content'];?>'>
                                        </div>
                                        <?php if($this->user_account_type == OWNER && (isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] != 'Accepted by Builder' && $budget_po_data['po_status'] != 'Accepted by Client'))){ ?>
                                        <ul class="sigNav">
                                            <li class="clearButton"><a href="#clear" class="btn btn-gray"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Clear</a></li>
                                        </ul>
                                        <?php } ?>
                                        <!-- <a href="javascript:void(0);" id="approve_sign"><button class="btn btn-blue pull-right appr_sign" type="button"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_approved"/> Approve</button></a> -->
                                    </div>
                                </div>
                            </div>
                            <?php }  ?>
</form>
<form id="add_signature" class="form-horizontal" method="post" name="add_signature">
<?php 
    if(isset($signature_file['system_file_name']))
    {
     $ext = pathinfo($signature_file['system_file_name'], PATHINFO_EXTENSION);
     $actualdata = json_decode(DEFAULT_THUMB_IMAGE_ARRAY, true);
     if ($ext == 'tif' || $ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'tiff') 
      {
       $thumb_icon = DOC_URL.$signature_file['system_file_name'];
      }
      else
      {
       if (!empty($ext)) 
      {
        $thumb_icon = $actualdata[$ext]['40'];
      }
     }
    }
    ?>
<div class="row appr_browse">
<div class="preview_file <?php if(isset($signature_file['system_file_name'])){?>show<?php } else{?>hide<?php }?>">
<div class="imagePreview"><img src="<?php if(isset($signature_file['system_file_name'])){ echo $thumb_icon;  }?>" /></div>
<?php if($this->user_account_type == OWNER && (isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] != 'Accepted by Builder' && $budget_po_data['po_status'] != 'Accepted by Client'))){ ?>
<div class="close_file"><a href="javascript:void(0);"  class="close-file"><img src="<?php echo IMAGESRC.'file_close.png'; ?>"/></a></div>
<!-- <input type="hidden" name="delete_val" class="delete_val" value="0"> -->
<?php } ?>
</div>
<div class="file_name <?php if(isset($signature_file['system_file_name'])){?>show<?php } else{?>hide<?php }?>"><?php if(isset($signature_file['system_file_name'])) { echo $signature_file['ui_file_name']; } ?></div>
<?php if($this->user_account_type == OWNER && (isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] != 'Accepted by Builder' && $budget_po_data['po_status'] != 'Accepted by Client'))){ ?>  
<?php if(($this->user_account_type == OWNER && (isset($budget_po_data['po_status']) && ($budget_po_data['po_status'] == 'Release to Client' || $budget_po_data['po_status'] == 'Accepted by Builder' || $budget_po_data['po_status'] == 'Accepted by Client'))) || (isset($budget_po_data['signature_content']) && $budget_po_data['signature_content']!='' && $this->user_account_type == BUILDERADMIN)) {?>
<div class="btn btn-blue btn-file browse <?php if(isset($signature_file['system_file_name'])){?>hide<?php }?>"> <img border="0" class="uni_attchment_second" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Browse
<input type="file" name="attachments" class="file_up"  />
</div>
<?php } ?>
<?php } ?>
</div>
</form>
</div>
<div class="tab-pane" id="scope_work">
<form id="add_new_budget_po_second" class="form-horizontal" method="post" name="add_new_budget_po_second">
<div class="row">
<div class="col-xs-4">
<div class="row">
<div class="col-xs-12">
<label>Scope of Work</label>
<textarea class="ckeditor" name="scope_of_work" id="scope_of_work"><?php if(isset($budget_po_data['scope_of_work'])) echo $budget_po_data['scope_of_work'];?></textarea>
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
</form>
</div>
</div>
</div>
</div>
</div>
</div>
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
    this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>'; 
    this.displayStart   = '<?php echo 0 ?>';
    this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
    this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
    this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
    this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
    this.signature_text   = '<?php echo isset($budget_po_data["signature_content"])?$budget_po_data["signature_content"]:""; ?>';
    this.signature_status   = '<?php echo isset($budget_po_data["po_status"])?$budget_po_data["po_status"]:""; ?>';  
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
<script type="text/javascript" src="<?php echo JSSRC.'save_owner_co.js';?>"></script>
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
