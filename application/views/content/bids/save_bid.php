<?php 
   $count_cn = 1;
   if(!empty($get_cost_code_result['cost_code_description']))
   {
     $description = explode(",",$get_cost_code_result['cost_code_description']);
     $count_cn = count($description);
   }
   if(!empty($get_cost_code_result['ub_bid_cost_code_id']))
   {
     $cost_code_id = explode(",",$get_cost_code_result['ub_bid_cost_code_id']);
   }
   if(!empty($get_cost_code_result['cost_code_id']))
   {
     $ub_cost_code_id = explode(",",$get_cost_code_result['cost_code_id']);
   }
   if(!empty($get_cost_code_result['cost_code_id']))
   {
     $cost_code_id_dropdown = explode(",",$get_cost_code_result['cost_code_id']);
   }
   if(!empty($get_cost_code_result['cost_variance_code']))
   {
    $cost_variance_code = explode(",",$get_cost_code_result['cost_variance_code']);
   }
   ?>
<script>   
   this.cost_code_options =      '<?php echo json_encode($cost_code_options); ?>';
</script>
<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?>
      <!--<li class="active">Bid Package Detail</li>-->
   </ol>
</div>
<form name="bid_save" id="bid_save" method="post">
   <div class="row">
      <div class="col-xs-12">
         <div class="top-search pull-right <?php if($this->project_id == '' && !isset($bid_data['project_id'])){ echo 'no_project_selected'; } ?>">
            <div class="pull-right ">
               <input type="hidden" name="ub_bid_id" id="ub_bid_id" value="<?php echo (isset($bid_data['ub_bid_id']) && $bid_data['ub_bid_id'] > 0)?$bid_data['ub_bid_id']:0 ?>" >
               <input type="hidden" name="save_type" id="save_type" value="" />
               <input type="hidden" name="status" id="status" value="<?php echo (isset($bid_data['status'])?$bid_data['status']:'In Progress') ?>" />
               <button type="submit" class="btn btn-gray  pull-right m-left-1" id="bid_cancel"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"> Cancel </button>
               <!--checking role access // by satheesh kumar -->
               <?php
				if(isset($this->user_role_access[strtolower('bids')][strtolower('delete')]) && $this->user_role_access[strtolower('bids')][strtolower('delete')] == 1)
				{
                    if(isset($bid_data['ub_bid_id']))
                    {
						if(isset($this->project_status_check) && $this->project_status_check == 1)
						{
                ?>
               <button class="btn btn-blue pull-right m-left-1" type="button" id="<?php if(isset($bid_data['ub_bid_id'])) echo $bid_data['ub_bid_id']; ?>" onclick="delete_bid(this.id)"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_delete"/> Delete</button>
			    <a href="<?php echo base_url().$this->crypt->encrypt('prints/bid_print/'.$bid_data['ub_bid_id'].'/'.$bid_data['project_id']); ?>" target="_blank"><button class="btn btn-blue  pull-right m-left-1" type="button" id="" name="print_bid"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_print"/>Print</button></a>
               <?php
						}
					}
                } 
                  ?>
				  
               <!--checking edit role access for bid // by satheesh kumar -->
                <?php
                  if(isset($bid_data['status']) && $bid_data['status'] == 'Released'){?>
               <button type="submit" class="btn btn-blue  pull-right m-left-1" id="bid_close"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_bidding_closed"> Close Bidding </button>
               <?php } ?>

                <?php
                  if(isset($bid_data['status']) && ($bid_data['status'] == 'Released' || $bid_data['status'] == 'Closed')){?>
               <button type="submit" class="btn btn-blue  pull-right m-left-1" id="bid_reset"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_reset_status_pending"> Reset To Inprogress </button>
               <?php } ?>


               <?php
                  if(isset($this->user_role_access[strtolower('bids')][strtolower('edit')]) && $this->user_role_access[strtolower('bids')][strtolower('edit')] == 1 && $this->first_argument > 0)
                  {
					if(isset($this->project_status_check) && $this->project_status_check == 1)
					{	
						if(isset($bid_data['ub_bid_id']) && $bid_data['status'] == 'In Progress') {
                  ?>
				  
               <button type="submit" class="btn btn-blue  pull-right m-left-1"  id="bid_save_release"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_release"> Save &amp; Release </button>
               
              
               <button type="submit" class="btn btn-blue  pull-right m-left-1" id="bid_save_back" > <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back" > Save &amp; Back </button>     
               <button class="btn btn-blue pull-right m-left-1" type="submit" id="bid_save_new"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/>  Save &amp; New</button>  
               <button type="submit" class="btn btn-blue  pull-right m-left-1" id="bid_save_stay"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"> Save &amp; Stay </button>
               <!--checking Add role access for bid // by satheesh kumar -->
               <?php 
               }
					    }
           }
				else if((isset($this->user_role_access[strtolower('bids')][strtolower('add')]) && $this->user_role_access[strtolower('bids')][strtolower('add')] == 1) && $this->first_argument == 0)
				{ 
                    if(isset($bid_data['ub_bid_id']) && $bid_data['status'] == 'Inprogress') { ?>
               <button type="submit" class="btn btn-blue  pull-right m-left-1"  id="bid_save_release"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_release"> Save &amp; Release </button>
               <?php
                  }
                  ?> 
               <?php
                  if(isset($bid_data['status']) && $bid_data['status'] == 'Released')
                  {
                  ?>
               <button type="submit" class="btn btn-blue  pull-right m-left-1" id="bid_close"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_bidding_closed"> Close Bidding </button>
               <?php } ?>
               <button type="submit" class="btn btn-blue  pull-right m-left-1" id="bid_save_back" > <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back" > Save &amp; Back </button>
               <button class="btn btn-blue pull-right m-left-1" type="submit" id="bid_save_new"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/>  Save &amp; New</button>  
               <button type="submit" class="btn btn-blue  pull-right m-left-1" id="bid_save_stay"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"> Save &amp; Stay </button>
               <?php 
                  }
                  ?>
            </div>
         </div>
      </div>
   </div>
   <div class="row m-top">
      <div class="col-xs-12 error-message uni_message">
         <div class="alerts alert-danger"></div>
      </div>
   </div>
   <!-- <button type="submit" class="btn btn-default btn-secondary pull-right m-left-1" id="bid_save_back" name="update_back"> Save &amp; Back </button> -->
   <div class="row m-top">
      <div class="col-xs-12">
         <div class="tab-con pull-left">
            <div role="tabpanel">
               <!-- Nav tabs -->
               <input type="hidden" id="current_tab" value="" />
               <ul class="nav nav-tabs" role="tablist" id="<?php if($this->user_account_type == BUILDERADMIN && isset($this->user_role_access[strtolower('selections')][strtolower('edit')]) && $this->user_role_access[strtolower('selections')][strtolower('edit')] == 1){if(isset($this->project_status_check) && $this->project_status_check == 1){echo 'bidtab';}}else{ echo ''; }?>">
                  <li role="presentation" class="active"> <a href="#General" aria-controls="General" data-toggle="tab" id="General-tab">General</a> </li>
                  <li role="presentation"> <a href="#Requestes" aria-controls="Requestes" data-toggle="tab" id="Requestes-tab">Request(s)</a> </li>
                  <li role="presentation"> <a href="#Files" aria-controls="Files" data-toggle="tab" id="Files-tab">Files</a> </li>
               </ul>
               <!-- Tab panes -->
               <div class="tab-content">
                  <div class="tab-pane active" id="General">
                     <div class="box-content panel-content">
					 <div class="row">
					  <div class="col-xs-3">
						   <?php
						    if(!empty($this->project_id) && !isset($bid_data['ub_project_id']))
									   {
									   		  
									   echo '<input type="hidden" name="project_name" id="project_name" value="'.$this->project_id.'" />';
									   echo '<input type="hidden" name="project_id" id="project_id" value="'.$this->project_id.'" />';
									   }
									   else if(isset($bid_data['ub_project_id']))
									   {
									   			  
									   echo '<input type="hidden" name="project_name" id="project_name" value="'.$bid_data['ub_project_id'].'" />';
									   echo '<input type="hidden" name="project_id" id="project_id" value="'.$bid_data['ub_project_id'].'" />';
									   }
                                   ?></div>
					 </div>
                        <div class="row five-col">
                           
                           
                           <div class="col-xs-3">
						  
                              <?php
                                 if(isset($bid_data['project_id']))
                                 {
                                         
                                  echo '<input type="hidden" name="project_id" id="project_id" value="'.$bid_data['project_id'].'" />';
                                   echo '<input type="hidden" name="project_name" id="project_name" value="'.$bid_data['project_name'].'" />';
                                 }
                                 ?>
                              <label>Package Title</label>          
                              <div class="form-group">
                                 <input type="text" class="form-control" name="package_title" id="package_title" value="<?php if(isset($bid_data['package_title'])) echo $bid_data['package_title'];?>" <?php if(isset($bid_data['status']) && $bid_data['status'] != 'In Progress') { echo "readonly='readonly'"; }?>/>
                              </div>
                           </div>
                           <div class="col-xs-2">
                              <label>Deadline</label>
                              <p>
                                 <input data-toggle="toggle" data-on="Link To" data-off="Due Date" type="checkbox" id="toggle-event" name="deadline_type"  <?php if(isset($bid_data['link_to']) && $bid_data['link_to']==='Yes') echo  "checked='checked'";?>>
                              </p>
                           </div>
                           <div class="col-xs-3 due-date">
                              <label>&nbsp;</label>
                              <div class='input-group date' id='datetimepicker5'>
                                 <input type="text" class="form-control" name="due_date" placeholder="Due Date" id="due_date" value="<?php if(isset($bid_data['due_date'])) echo date("m/d/Y", strtotime($bid_data['due_date']));?>">
                                 <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                              </div>
                           </div>
                           <div class="col-xs-3 due-date">
                              <label>&nbsp;</label>
                              <div class="form-group">
                                 <div class='input-group date' id='task-time'>
                                    <input name="due_time" id="due_time" type='text' class="form-control" placeholder="Due Time" value="<?php if(isset($bid_data['due_time'])) echo date("g:i a", strtotime($bid_data['due_time']));?>" />
                                    <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span> 
                                 </div>
                              </div>
                           </div>
                           <div class="col-xs-1 link-to">
                              <label>day(s)</label>
                              <input name="number_days" id="number_days" type="text" class="form-control" style="width:40px;" value="<?php if(isset($bid_data['number_days'])) echo $bid_data['number_days'];?>" />

                               <!-- <input name="schedule_due_date" id="schedule_due_date" type="text" class="form-control" value="<?php if(isset($bid_data['due_date_time'])) echo date("m/d/Y", strtotime($bid_data['due_date_time']));?>" /> -->
                           </div>
                      <!--      <div class="col-xs-1 link-to">
                              <p>&nbsp;</p>
                              <label>day(s)</label>
                           </div> -->
                           <div class="col-xs-2 link-to">
                              <label>Before/After</label>
                              <?php 
                                 $before_or_after_dropdown_selected = '';
                                 if(isset($bid_data['before_or_after']))
                                 {
                                   $before_or_after_dropdown_selected = $bid_data['before_or_after'];
                                 }
                                 echo form_dropdown('before_or_after', $before_or_after_dropdown_list, $before_or_after_dropdown_selected, "class='selectpicker form-control' id='before_or_after' data-live-search='true'"); ?>
                           </div>
                           <div class="col-xs-3 link-to">
                              <label>Schedule</label>
                              <?php
                                 $schedule_selected = '';
                                 if(isset($bid_data['schedule_id']))
                                 {
                                   $schedule_selected = $bid_data['schedule_id'];
                                 }
                                 echo form_dropdown('schedule_id', $schedule_options, $schedule_selected, "class='selectpicker form-control' id='schedule_id' data-live-search='true'"); ?> 
                                 
                           </div>

                           <div class="col-xs-2 link-to">
                            <label>Linked Date</label>
                            <input name="schedule_due_date" id="schedule_due_date" type="text" class="form-control" value="<?php if(isset($bid_data['due_date_time'])) echo date("m/d/Y", strtotime($bid_data['due_date_time']));?>" readonly="readonly" />
                           </div>

                        </div>
                        <div class="row">
                           <div class="col-xs-4">
                              <label>Daily sub reminder begin</label>
                              <div class="form-group form-inline">
                                <?php if(isset($dead_line['bid_alert_to_sub_before_deadline'])){$bid_deadline = $dead_line['bid_alert_to_sub_before_deadline'];}else{$bid_deadline=0;} ?>
                                 <input type="text" name="daily_sub_reminder" id="daily_sub_reminder" class="form-control" style="width:40px" value="<?php echo isset($bid_data['daily_sub_reminder'])?$bid_data['daily_sub_reminder']:$bid_deadline?>" >
                                 <label><span class="text-muted">day(s) before deadline</span></label>
                              </div>
                           </div>
                           <div class="col-xs-4">
                              <p>&nbsp;</p>
                              <label>Allow Multiple Accept Bids:
                                <?php if(isset($bid_data['ub_bid_id'])){ ?>
                               <?php if(isset($bid_data['status']) && $bid_data['status'] == 'In Progress') { ?>
                              <input type="checkbox" name="allow_multi_bids" id="allow_multi_bids" <?php if(isset($bid_data['allow_multi_bids']) && $bid_data['allow_multi_bids']==='Yes') echo  "checked='checked'";?>/>
                              <?php }else{ ?>

                              <input type="checkbox" <?php if(isset($bid_data['allow_multi_bids']) && $bid_data['allow_multi_bids']==='Yes') echo  "checked='checked'";?><?php echo "disabled='disabled'"; ?>/>

                               <input type="hidden" name="allow_multi_bids" id="allow_multi_bids" value="<?php echo (isset($bid_data['allow_multi_bids']) && $bid_data['allow_multi_bids']==='Yes')?'Yes':'No';?>">
                              <?php }}else{ ?>
                               <input type="checkbox" name="allow_multi_bids" id="allow_multi_bids" <?php if(isset($bid_data['allow_multi_bids']) && $bid_data['allow_multi_bids']==='Yes') echo  "checked='checked'";?>/>
                              <?php } ?>
                              </label>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-7">
                           <h5>PRICING FORMAT</h5>
                           <div class="box-content panel-content pull-left">
                              <div class="row">
                                 <div class="col-xs-3">
                                    <label>Flat Fee</label>
                                    <input type="radio" name="pricing_format"  value="Flat Fee" id="flat-fee" checked="checked" <?php if(isset($bid_data['status']) && $bid_data['status'] != 'In Progress'){ echo "disabled='disabled'"; }?>/>
                                 </div>
                                 <div class="col-xs-3">
                                    <label>Line Items</label>
                                    <input type="radio" name="pricing_format" value="Line Items" id="line-items" <?php if(isset($bid_data['pricing_format']) && $bid_data['pricing_format']==='Line Items') echo  "checked='checked'";?> <?php if(isset($bid_data['status']) && $bid_data['status'] != 'In Progress'){ echo "disabled='disabled'"; }?>/>
                                 </div>
                              </div>
                              <!-- <div id="flat-fee-view">
                                 <div class="row">
                                    <div class="col-xs-5">
                                       <label>Bid Amount</label>
                                       <input type="text" name="bid_amount" id="bid_amount" class="form-control" placeholder="$" />
                                    </div>
                                 </div>
                              </div> -->
                              <div style="display:none;" id="line-items-view">
                                 <div class="row">
                                    <div class="col-xs-2">
                                       <p>&nbsp;</p>
                                    </div>
                                    <div class="col-xs-5">
                                       <p><label>Cost Code</label></p>
                                    </div>
                                    <div class="col-xs-5">
                                       <p><label>Sub Description</label></p>
                                    </div>
                                 </div>
                                 <div class="cointainer">
                                    <?php 
                                       for($i=0; $i < $count_cn; $i++)
                                       {
                                       ?>         
                                    <div class="content">
                                       <div class="row">
                                          <div class="col-xs-2">
                                             <?php if(isset($bid_data['status']) && $bid_data['status'] == 'In Progress') { ?>
                                             <p><a class="removeBtn" href="javascript:void(0);"><img alt="delete" src="<?php echo IMAGESRC . 'delete.png'; ?>" border="0"/></a></p><?php } else if(!isset($bid_data['status'])){?>
                                              <p><a class="removeBtn" href="javascript:void(0);"><img alt="delete" src="<?php echo IMAGESRC . 'delete.png'; ?>" border="0"/></a></p>
                                             <?php } ?>
                                          </div>
                                          <div class="col-xs-5">    
                                             <input type="hidden" name="code[]" id="code" value="<?php if(isset($cost_code_id[$i])) echo $cost_code_id[$i] ?>" />
                                             <?php
                                             
                                                if(isset($cost_code_id_dropdown[$i])){ $cost_code_selected = $cost_code_id_dropdown[$i]; }else{$cost_code_selected = '';}

                                                if(!isset($bid_data['status']) || $bid_data['status'] == 'In Progress') {
                                                echo form_dropdown('cost_code_id[]', $cost_code_options, $cost_code_selected, "class='form-control selectpicker' id='cost_code_id' data-live-search='true'"); }else{?>

                                                <input type="hidden" class="form-control varian"  name="cost_code_id[]" id="cost_code_id" value="<?php if(isset($cost_code_id_dropdown[$i])) echo $cost_code_id_dropdown[$i] ?>"/>

                                               <label><?php if(isset($cost_variance_code[$i])) echo $cost_variance_code[$i] ?></label><?php } ?>   

                                          </div>
                                          <div class="col-xs-5">  

                                             <input type="text" class="form-control" name="sub_description[]" id="sub_description" value="<?php if(isset($description[$i])) echo $description[$i] ?>" <?php if(isset($bid_data['status']) && $bid_data['status'] != 'In Progress') { echo "readonly='readonly'"; }?>/>
                                          </div>
                                       </div>
                                    </div>
                                    <?php } ?>
                                    <!--checking role access // by satheesh kumar -->
                                    <?php
                                       if(isset($this->user_role_access[strtolower('bids')][strtolower('add')]) && $this->user_role_access[strtolower('bids')][strtolower('add')] == 1)
                                       { 
                                       ?>
                                       <?php if(isset($bid_data['status']) && $bid_data['status'] == 'In Progress') { ?>
                                        <a href="javascript:void(0);" class="sprite addBtn">
                                    <img border="0" src="<?php echo IMAGESRC . 'strip.gif'; ?>" alt="Add" class="uni_new">
                                    Add</a>
                                    <?php }else if(!isset($bid_data['status'])) { ?>
                                    <a href="javascript:void(0);" class="sprite addBtn">
                                    <img border="0" src="<?php echo IMAGESRC . 'strip.gif'; ?>" alt="Add" class="uni_new">
                                    Add</a> <?php } ?>
                                    <?php 
                                       }
                                       ?>           
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-xs-12">
                                 <h5>CHECKLIST</h5>
                                 <div class="box-content panel-content">
                                    <div class="row">
                                       <div class="col-xs-5">
                                          <label>Has a Checklist? </label>
                                          <input type="checkbox" name="has_checklist" id="has_checklist" <?php if(isset($bid_data['has_checklist']) && $bid_data['has_checklist']==='Yes') echo  "checked='checked'";?>/>
                                       </div>
                                    </div>
                                    <div id="checklist-view" style="display:none;">
                                       <div class="row">
                                          <div class="col-xs-5"> <?php
                                             //print_r($checklist_options);
                                             //echo count($checklist_options);
                                             if(!isset($checklist_options[''])){ 
                                             $checklist_selected = '';
                                             if(isset($bid_data['checklist_id']))
                                             {
                                               $checklist_selected = explode(',' ,$bid_data['checklist_id']);
                                             }
                                             echo form_dropdown('checklist_id[]', $checklist_options, $checklist_selected, "class='selectpicker form-control' id='checklist_id' data-live-search='true' multiple"); }else{ if(isset($bid_data['ub_bid_id'])){?> 
                                             <a href="<?php echo base_url().$this->crypt->encrypt('checklist/save_checklist/0/bid/'.$bid_data['ub_bid_id']); ?>" class="text-primary">Create a checklist</a><?php }else{ ?>

                                             <a href="<?php echo base_url().$this->crypt->encrypt('checklist/save_checklist/0/bid'); ?>" class="text-primary">Create a checklist</a><?php } } ?>

                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-xs-12">
                                 <h5>DESCRIPTION</h5>
                                 <textarea class="ckeditor" name="description" id="description"><?php echo isset($bid_data['description'])?$bid_data['description']:'' ?></textarea>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-5">
                           <div id='rfi_view'>
                              <?php if(isset($bid_data['ub_bid_id'])  && $bid_data['status'] != 'In Progress' ) { ?>
                              <?php $this->load->view('content/bids/save_rfi'); ?>  
                           </div>
                           <div id='ve_view'>
                              <?php $this->load->view('content/bids/save_ve'); ?> 
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                  </div>
                     
                  <div class="tab-pane" id="Requestes">
                     <div class="row">
                        <div class="col-xs-12">
                           <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed" id="request_list">
                              <tr>
                                 <td height="30">&nbsp;</td>
                                 <td>Subs Name</td>
                                 <td>Release Date</td>
                                 <td>Sub Viewed</td>
                                 <td>Will Bid?</td>
                                 <td>Submitted</td>
                                 <td>Amount</td>
                                 <td>Status</td>
                                 <td>Create A PO</td>
                              </tr>
                              <input type="hidden" id="request_count" value="<?php echo (isset($request_data)?1:0) ?>" />
                              <?php $total_accept_bid_amount = 0.00; ?>
                              <?php if(isset($request_data)){?>
                              <?php foreach ($request_data as $key => $value) {?>

                              <input type="hidden" class="form-control" name="ub_bid_request_id[]" id="ub_bid_request_id" value="<?php if(isset($ub_bid_request_id[$i])) echo $ub_bid_request_id[$i] ?>"/>

                              <tr>
                                
                                 <td height="30"><a href="javascript:void(0);" class="delete" id="<?php echo $value['ub_bid_request_id'].','.$value['subcontractor_id'] ?>" onclick="delete_request(id)"> <img border="0" src="<?php echo IMAGESRC . 'strip.gif'; ?>" alt="Delete" class="delete_icon "></a></td>
                                 <td><a href="javascript:void(0);" id="<?php echo $value['ub_bid_request_id'] ?>" onclick="accept_bid(id)"><?php echo $value['subcontractor_name'];?></a></td>
                                 <?php if(isset($value['bid_amount'])){ $total_accept_bid_amount += $value['bid_amount']; }?>
                                 <td><?php echo $value['released_date'] ?></td>
                                 <td><?php echo $value['sub_viewed'] ?></td>
                                 <td><?php echo $value['will_bid'] ?></td>
                                 <td><?php if($value['submitted'] == '0000-00-00 00:00:00'){$value['submitted'] = 'Nil';}else{$value['submitted'] = $value['submitted'];} echo $value['submitted']?></td>
                                 <td><?php echo CURRENCY_SYMBOL.number_format($value['bid_amount'],2,'.',',')?></td>
                                 <td><?php echo $value['bid_sub_status']?></td>
                                 <td><?php if($value['bid_sub_status'] == 'Accepted'){ ?>
                                    
                                    <input type="hidden" name="sub_id" id="sub_id" value="<?php echo (isset($value['subcontractor_id']) && $value['subcontractor_id'] > 0)?$value['subcontractor_id']:0 ?>" >

                                    <a href="javascript:void(0);" class="edit-role" id="<?php echo $value['ub_bid_request_id'] ?>" onclick="add_po(id)">Create A PO</a>
                                    <?php }else{ if($value['bid_sub_status'] == 'Declined' || $value['bid_sub_status'] == 'Rejected'){ ?>  bid is rejected. <?php }else{ ?> Yet to accept <?php } } ?>
                                 </td>
                              </tr>
                              <?php  } ?>
                              <tr>
                                 <td height="30" colspan="6" align="right">Total Accepted Bid Amount: </td>
                                 <td><?php echo isset($accepted_amounts['bid_amount'])?CURRENCY_SYMBOL.number_format($accepted_amounts['bid_amount'],2,'.',','):0.00 ?></td>
                                 <td colspan="2">&nbsp;</td>
                                 <?php }else{?>
                                 <td colspan="9" class="text-center">No Records Found</td>
                                 <?php } ?>
                              </tr>
                           </table>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-12">
                           <div  class=" box-content">
                              <div class="row">
                                 <div class="col-xs-3 form-group" id="sub_contractor">
                                    <label>Invite Subs:</label>
                                    <?php
                                    if(!empty($sub_contractor_options))
                                    { 
                                       $sub_contractor_selected = '';
                                       if(isset($bid_data['sub_contractor_id']))
                                       {
                                         $sub_contractor_selected = explode(',' ,$bid_data['sub_contractor_id']);
                                       }
                                       
                                       echo form_dropdown('sub_contractor_id[]', $sub_contractor_options, $sub_contractor_selected, "class='selectpicker form-control' id='sub_contractor_id' data-live-search='true' multiple"); 

                                    }else
                                    {
                                       echo form_dropdown('sub_contractor_id[]', array(), '', "class='selectpicker form-control' id='sub_contractor_id' data-live-search='true' multiple");
                                    }
                                    ?> 
                                 </div>
                                 <div class="col-xs-12 form-group">
                                    <label>Invitation Text</label>
                                    <textarea class="form-control" rows="10" name="invitation_message" id="invitation_message"><?php echo isset($bid_data['invitation_text'])?$bid_data['invitation_text']:''  ?></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="Files">
                     <div class="row">
                        <!--<div class="col-xs-8">
                           <table class="table table-bordered datatable" id="new_claim_files">
                           </table>
                           </div>-->
                        <div class="col-xs-6">
                           <div class="row">
                              <div class="col-xs-12">
                                 <p class="text-primary col-xs-12"> <a href="javascript:void(0);" class="text-primary" data-toggle="modal" data-target="#docs_upload_Modal"><u>Click Here</u></a> to Choose from Unibuilder docs</p>
                              </div>
                              <div class="col-xs-12 m-top">
                                 <?php $this->load->view('common/upload.php');?>
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
      </form>
<div id='bid_request_view'>
   <?php $this->load->view('content/bids/bid_request'); ?>  
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
                        <button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> CANCEL</button>  
                        <button class="btn btn-blue m-left-1 pull-right" type="button" id="delete_confirm"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_approved"/> OK</button>        
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Add RFI Modal -->
<div class="modal fade" id="addrfi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>RFI Details
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <form name="rfi_save" id="rfi_save" method="post">
               <div class="row">
                  <div class="col-xs-12">
                     <div class="modal-con">
                        <div class="row">
                           <div class="col-xs-12 form-group">
                              <div class="col-xs-4 text-right">
                                 <label>Question :</label>
                              </div>
                              <div class="col-xs-8">
                                 <div class="form-group">
                                    <textarea name="question" id="question" cols="" rows="2" class="form-control"><?php if(isset($rfi_data['question'])) echo $rfi_data['question'] ?></textarea> 

                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xs-12 form-group">
                              <div class="col-xs-4 text-right">
                                 <label>Answer :</label>
                              </div>
                              <div class="col-xs-8">
                                 <div class="form-group">
                                 <textarea name="answer" id="answer" cols="" rows="2" class="form-control"><?php if(isset($rfi_data['answer'])) echo $rfi_data['answer'] ?></textarea>
                                 <span class="error-mes text-danger"></span>
                              </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xs-12 form-group">
                              <div class="col-xs-4 text-right">
                                 <label>Deadline :</label>
                              </div>
                              <div class="col-xs-8">
                                <div class="form-group">
                                 <div class='input-group date' id='datetimepicker6'>
                                    <input type='text' name="deadline" id="deadline" class="form-control" value="<?php if(isset($rfi_data['deadline'])) echo date("m/d/Y", strtotime($rfi_data['deadline']));?>" />
                                    <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                                 </div>
                               </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xs-12 form-group">
                              <div class="col-xs-4 text-right">
                                 <label>Assign To :</label>
                              </div>
                              <div class="col-xs-8">
                                <div class="form-group">
                                 <?php
                                    $sub_contractor_selected = '';
                                    if(isset($rfi_data['assign_to_ids']))
                                    {
                                    $sub_contractor_selected = $rfi_data['assign_to_ids'];
                                    }
                                      echo form_dropdown('assign_to_ids', $sub_contractors, '', "class='selectpicker form-control' id='assign_to_ids' data-live-search='true'"); ?>
                                  </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xs-12 form-group">
                              <div class="col-xs-4 text-right">
                                 <label>Visible To All Subs? :</label>
                              </div>
                              <div class="col-xs-8">
                                 <input type="checkbox" name="visible_to_subs" id="visibile_to_subs" <?php if(isset($rfi_data['visible_to_subs']) && $rfi_data['visible_to_subs']==='Yes') echo  "checked='checked'";?>/>
                              </div>
                              <div class="col-xs-12 text-center">
                                 <div class="col-xs-3">&nbsp;</div>
                                 <div class="col-xs-9">
                                    <p>&nbsp;</p>
                                    <button id="save-rfi" name='save-rfi' class="btn btn-blue pull-left" type="submit"> 
                                    <img class="uni_save_new" src="<?php echo IMAGESRC.'strip.gif';?>"> Save RFI</button>
                                    <a class="closing_back" href="javascript:void(0);" id="cancel-rfi"> <img border="0" src="<?php echo IMAGESRC.'strip.gif';?>" alt="cancel_button" class="uni_cancel_new"> Cancel</a> 
                                 </div>
                                 <?php
                                    if(isset($bid_data['project_id']))
                                    {
                                        
                                      echo '<input type="hidden" name="project_id" id="project_id" value="'.$bid_data['project_id'].'" />';
                                      echo '<input type="hidden" name="project_name" id="project_name" value="'.$bid_data['project_name'].'" />';
                                    }
                                    ?>
                                 <input type="hidden" name="ub_bid_rfi_ve_id" id="ub_bid_rfi_ve_id" >
                                 <input type="hidden" name="ub_bid_id" id="ub_bid_id" value="<?php echo (isset($bid_data['ub_bid_id']) && $bid_data['ub_bid_id'] > 0)?$bid_data['ub_bid_id']:0 ?>" >
                                 <input type="hidden" class="form-control" name="package_title" id="package_title" value="<?php if(isset($bid_data['package_title'])) echo $bid_data['package_title'];?>"/>
                                 <input type="hidden" name="question_by" id="question_by" >
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Add VE Modal-->
<div class="modal fade" id="addve" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>VE Details
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <form name="ve_save" id="ve_save" method="post">
               <div class="row">
                  <div class="col-xs-12">
                     <div class="modal-con">
                        <div class="row">
                           <div class="col-xs-12 form-group">
                              <div class="col-xs-4 text-right">
                                 <label>Question :</label>
                              </div>
                              <div class="col-xs-8">
                                 <div class="form-group">
                                    <textarea name="ve_question" id="ve_question" cols="" rows="2" class="form-control"></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xs-12 form-group">
                              <div class="col-xs-4 text-right">
                                 <label>Answer :</label>
                              </div>
                              <div class="col-xs-8">
                                 <div class="form-group">
                                 <textarea name="ve_answer" id="ve_answer" cols="" rows="2" class="form-control"></textarea>
                                 <span class="error-mes text-danger"></span>
                               </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xs-12 form-group">
                              <div class="col-xs-4 text-right">
                                 <label>Assign To :</label>
                              </div>
                              <div class="col-xs-8">
                                <div class="form-group">
                                 <?php
                                    echo form_dropdown('ve_assign_to_ids', $sub_contractors, '', "class='selectpicker form-control' id='ve_assign_to_ids' data-live-search='true'"); ?>
                                </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xs-12 form-group">
                              <div class="col-xs-4 text-right">
                                 <label>Visible To All Subs? :</label>
                              </div>
                              <div class="col-xs-8">
                                 <input type="checkbox" name="ve_visible_to_subs" id="ve_visibile_to_subs"/>
                              </div>
                           </div>
                           <div class="col-xs-12 text-center">
                              <div class="col-xs-3">&nbsp;</div>
                              <div class="col-xs-9">
                                 <p>&nbsp;</p>
                                 <button id="save-ve" name='save-ve' class="btn btn-blue pull-left" type="submit"> <img class="uni_save_new" src="<?php echo IMAGESRC.'strip.gif';?>"> Save VE</button>
                                 <a class="closing_back" href="javascript:void(0);" id="cancel-ve"> <img border="0" src="<?php echo IMAGESRC.'strip.gif';?>" alt="cancel_button" class="uni_cancel_new"> Cancel</a> 
                              </div>
                              <?php
                                 if(isset($bid_data['project_id']))
                                 {
                                     
                                   echo '<input type="hidden" name="project_id" id="project_id" value="'.$bid_data['project_id'].'" />';
                                   echo '<input type="hidden" name="project_name" id="project_name" value="'.$bid_data['project_name'].'" />';
                                 }
                                 ?>
                              <input type="hidden" name="ub_bid_id" id="ub_bid_id" value="<?php echo (isset($bid_data['ub_bid_id']) && $bid_data['ub_bid_id'] > 0)?$bid_data['ub_bid_id']:0 ?>" >
                              <input type="hidden" class="form-control" name="package_title" id="package_title" value="<?php if(isset($bid_data['package_title'])) echo $bid_data['package_title'];?>"/>
                              <input type="hidden" name="rfi_ve_id" id="rfi_ve_id" >
                              <input type="hidden" name="ve_question_by" id="ve_question_by" >
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Delete Comment -->
<div class="modal fade confirmModal" id="confirm_comment_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <button class="btn btn-blue m-left-1 pull-right" type="button" id="delete_comment_confirm"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_dick"/> OK</button>        
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /Delete Comment -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script> 
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-toggle.js';?>"></script> 
<link rel="stylesheet" href="<?php echo CSSSRC.'file-tree.min.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'jquery.mjs.nestedSortable.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'file-tree.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'add_update_rfi_ve.js';?>"></script>  
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/ckeditor.js';?>"></script> 
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.jscrollpane.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'enscroll-0.6.0.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'bids.js';?>"></script>
<script data-sample="1">
   CKEDITOR.replace( 'description', {
     toolbar: [    
      { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] }
    ]
    
   });
</script>
