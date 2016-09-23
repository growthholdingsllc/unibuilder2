<?php 
if(!empty($result_data['aaData'][0]['mark_complete_status']))
{
//echo $result_data['aaData'][0]['mark_complete_status'];
}
$count_cn = 1;
if(!empty($result_data['aaData'][0]['tags']))
{
$multiple_tag = $result_data['aaData'][0]['tags'];
					$array_value = explode(",",$multiple_tag);
}else{
$array_value =false;
}
					//echo '<pre>';print_r($array_value);exit; 
if(!empty($result_data['aaData'][0]['priority']))
{
$result_data['aaData'][0]['priority'] = $result_data['aaData'][0]['priority'];
}else{
$result_data['aaData'][0]['priority'] =false;
}
//echo $result_data['aaData'][0]['assigned_to'];exit;
if(!empty($result_data['aaData'][0]['assigned_to']))
{
$result_data['aaData'][0]['assigned_to'] = $result_data['aaData'][0]['assigned_to'];
}else{
$result_data['aaData'][0]['assigned_to'] =false;
}

//$result_data['aaData'][0]['reminder_id']
if(!empty($result_data['aaData'][0]['reminder_id']))
{
$result_data['aaData'][0]['reminder_id'] = $result_data['aaData'][0]['reminder_id'];
}else{
$result_data['aaData'][0]['reminder_id'] =false;
}
//echo $result_data['aaData'][0]['time_chosen'];exit;

// echo 'hai';exit;


if(!empty($result_data['aaData'][0]['due_time']) && $result_data['aaData'][0]['due_time'] != '00:00:00')
{
$old = $result_data['aaData'][0]['due_time'];
//$time = date('g:i p',$old);
$time = date("g:i a", strtotime($old));
}else{
// $result_data['aaData'][0]['time_chosen'] =false;
$time =false;
}
// echo '<pre>';print_r($time);exit;
//echo $result_data['aaData'][0]['title'];
if(!empty($result_data['aaData'][0]['description']))
{
	$description = explode(",",$result_data['aaData'][0]['description']);
	//echo '<pre>';print_r($description);exit;
$count_cn = count($description);
//echo $count_cn;
}
//checkbox clone
if(!empty($result_data['aaData'][0]['description_checkbox']))
{
	$description_checkbox = explode(",",$result_data['aaData'][0]['description_checkbox']);
}
if(!empty($result_data['aaData'][0]['check_list_id']))
{
	$check_list_id = explode(",",$result_data['aaData'][0]['check_list_id']);
}
if(!empty($result_data['aaData'][0]['task_id']))
{
	$task_id = explode(",",$result_data['aaData'][0]['task_id']);
}
?>
<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?> 
      <!--<li class="active"><?php if(isset($result_data['aaData'][0]['ub_task_id'])) echo "Edit Task"; else echo "Add Task";?></li>-->
   </ol>
</div>
<form id="add_new_task" class="form-horizontal" method="post" name="add_new_task">
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
         <div class="pull-right ">
            <!--<button class="btn btn-default btn-primary pull-right m-left-1 glyphicon glyphicon-print"></button>-->
            <a href="<?php echo base_url();?>dgxf1Fzay9pbmRleC8-">
			<button type="button" class="btn btn-gray  pull-right m-left-1">
			<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/>
			Cancel</button></a>
			
			<?php if($project_list != false){ ?>
			
			<?php 
			if(isset($this->user_role_access[strtolower('task')][strtolower('delete')]) && $this->user_role_access[strtolower('task')][strtolower('delete')] == 1)
			{ 
				if(!empty($result_data['aaData'][0]['ub_task_id'])) 
				{ 
			?>
			<?php if($this->project_status_check == 1)
			{
			?>
				<button class="btn btn-blue  pull-right m-left-1" type="button" id="<?php if(isset($result_data['aaData'][0]['ub_task_id'])) echo $result_data['aaData'][0]['ub_task_id']; ?>" name="delete_task" onclick="deletetasks(this.id)"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_delete"/>Delete</button>
			<?php } ?>
			<?php } 
			}
			if(isset($this->user_role_access[strtolower('task')][strtolower('edit')]) && $this->user_role_access[strtolower('task')][strtolower('edit')] == 1 && $this->first_argument > 0)
			{ 
			?>
			<a href="<?php echo base_url().$this->crypt->encrypt('prints/task_print/'.$result_data['aaData'][0]['ub_task_id']); ?>" target="_blank"><button class="btn btn-blue  pull-right m-left-1" type="button" id="<?php if(isset($result_data['aaData'][0]['ub_task_id'])) echo $result_data['aaData'][0]['ub_task_id']; ?>" name="print_task"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_print"/>Print</button></a>
			<?php if($this->project_status_check == 1)
			{
			?>
				<button type="submit" class="btn btn-blue  pull-right m-left-1" id="add_task_new_back" name="add_task_new_back" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back </button>
				<button type="submit" class="btn btn-blue  pull-right m-left-1" id="add_task_new" name="add_task_new" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save &amp; New</button>
				<button type="submit" class="btn btn-blue pull-right m-left-1" name="add_task_new_stay" id="add_task_new_stay"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
				<?php } ?>
			<?php 
			}
			else if((isset($this->user_role_access[strtolower('task')][strtolower('add')]) && $this->user_role_access[strtolower('task')][strtolower('add')] == 1) && $this->first_argument == 0)
			{
			?>
				<button type="submit" class="btn btn-blue  pull-right m-left-1" id="add_task_new_back" name="add_task_new_back" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back </button>
				<button type="submit" class="btn btn-blue  pull-right m-left-1" id="add_task_new" name="add_task_new" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save &amp; New</button>
				<button type="submit" class="btn btn-blue pull-right m-left-1" name="add_task_new_stay" id="add_task_new_stay"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
			<?php 
			}
			}else{ ?>
			<h1>You can not add task.</h1>
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
      <div class="panel panel-default">
         <div class="panel-heading" role="tab" id="filter">
            <h4 class="panel-title"><?php if(isset($result_data['aaData'][0]['ub_task_id'])) echo "Edit Task Details"; else echo "New Task Details";?></h4>
         </div>
         <div class="panel-body">
            <div class="row panel-content two-box">			
               <div class="col-xs-6">
			   <input type="hidden" name="ub_task_id" id="ub_task_id" value="<?php if(isset($result_data['aaData'][0]['ub_task_id'])) echo $result_data['aaData'][0]['ub_task_id'];?>">	
				<input type="hidden" name="created_on" id="created_on" value="<?php if(isset($result_data['aaData'][0]['created_on'])) echo $result_data['aaData'][0]['created_on'];?>">
				<div class="<?php if($this->project_id == '' && !isset($result_data['aaData'][0]['project_id'])){ echo 'no_project_selected'; } ?>">
			<?php 			  
			 /*   if(!empty($this->project_id))
			   {			   
			   echo '<label>Project Name</label> : '.$this->project_name;			  
			   echo '<input type="hidden" name="project_name" id="project_name" value="'.$this->project_id.'" />';
			   } */
			   
			   if(!empty($this->project_id) && !isset($result_data['aaData'][0]['project_id']))
			   {
			   //echo '<label>Project Name</label> : '.$this->project_name;			  
			   echo '<input type="hidden" name="project_name" id="project_name" value="'.$this->project_id.'" />';
			   echo '<input type="hidden" name="project_id" id="project_id" value="'.$this->project_id.'" />';
			   }
			   else if(isset($result_data['aaData'][0]['project_id']))
			   {
			   //echo '<label>Project Name</label> : '.$project_list[$result_data['aaData'][0]['project_id']];			  
			   echo '<input type="hidden" name="project_name" id="project_name" value="'.$result_data['aaData'][0]['project_id'].'" />';
			   echo '<input type="hidden" name="project_id" id="project_id" value="'.$result_data['aaData'][0]['project_id'].'" />';
			   }
			 ?>
			 </div>
			 <div class="col-xs-12">
				<div class="row">
				<label>Title</label>

					<div class="col-xs-12">
						<div class="form-group">
						<input type="text" class="form-control" placeholder="Title" id ="title" name ="title" maxlength="128" value="<?php if(isset($result_data['aaData'][0]['title'])) echo $result_data['aaData'][0]['title'];?>">
						</div>
					</div>
				</div>
			</div>
                  <textarea class="form-control m-top" placeholder="Type Note" id="task_note" name="task_note" maxlength="2000"><?php if(isset($result_data['aaData'][0]['note'])) echo $result_data['aaData'][0]['note'];?></textarea>
                   <p><span name="countchars" id="countchars"></span> Characters Remaining. <span name="percent" id="percent"></span></p>
				  <div class="row">
				 
                     <div class="col-xs-12">
                        <p>
                           <a href="javascript:void(0);" class="add-checklist add_clone"><img alt="home" src="<?php echo IMAGESRC.'addchecklist.png'?>" border="0"/></a>
                           <a href="javascript:void(0);" class="remove-checklist"><img alt="home" src="<?php echo IMAGESRC.'removechecklist.png'?>" border="0"/></a>
                        </p>
								
                       <div class="new-add-checklist">
					   	 <?php 
							 for($i=0; $i < $count_cn; $i++)
							 {
							 ?>	
							<div class="clon">
							<div class="row">
							<div class="col-xs-1"><a href="javascript:void(0);" class="remove_field"><img alt="home" src="<?php echo IMAGESRC.'icon_minus1_1.png'?>"/></a></div>
							<input type="hidden" name="checklist_description_id[]" id="checklist_description_id" value="<?php if(isset($check_list_id[$i])) echo $check_list_id[$i] ?>" />
							<div class="col-xs-10"><input type="text" class="form-control" name="checklist_description[]" value="<?php if(isset($description[$i])) echo $description[$i] ?>" /></div>
							<div class="col-xs-1"><input name="checklist_mark[]" type="checkbox" class="check-list-box" <?php if(isset($description_checkbox[$i]) && !empty($description_checkbox[$i]) && $description_checkbox[$i] === 'Yes') echo  "checked='checked'";?> />
							<input name="checklist_mark_hidden[]" type="hidden" class="check-list-box-hidden" value="<?php if(isset($description_checkbox[$i]) && !empty($description_checkbox[$i]) && $description_checkbox[$i] === 'Yes'){echo 'Yes';}else{ echo 'No';} ?>" />
							</div>
							</div>
							</div>
							<?php } ?>
                        </div>					
						
                        <div class="row add_checklist_div">
                           <div class="col-xs-12">
                              <a href="javascript:void(0);" class="add_checklist_clone add_clone"><img alt="home" src="<?php echo IMAGESRC.'icon_plus1_1.png'?>" border="0"/></a>
                           </div>
                        </div>
						
						
                     </div>
					 
                  </div>
				  <?php 
				  //code added by satheesh kumar
				  if (isset($custom_field_data) && !empty($custom_field_data)) 
				  { 
				  ?>
				  <div class="row">
					  <div class="col-xs-12">
						  <div class="panel panel-default">
							 <div id="filter" role="tab" class="panel-heading">
								<h4 class="panel-title">My Fields</h4>
							 </div>
							 <div class="panel-body">
								<div class="panel-content">
								    <?php $this->load->view('common/custom_field.php'); ?>
								</div>
							 </div>
						  </div>
					  </div>
				  </div>
				  <?php 
				  }
				  ?>
                  <div class="row">                    
					<div class="col-xs-12">  
						<?php 
						if($this->user_account_type == BUILDERADMIN) {
						?>
                        <p class="text-primary col-xs-12"><a href="javascript:void(0);" class="text-primary" data-target="#docs_upload_Modal" data-toggle="modal"><u>Click Here</u></a>  to Choose from Unibuilder docs</p>
                        <label class="col-xs-12">Photo(s)</label>                        
						<?php 
						}
						?>
                        <?php if($this->user_account_type == BUILDERADMIN) $this->load->view('common/upload')?>
                        <?php if($this->user_account_type == OWNER || $this->user_account_type == SUBCONTRACTOR)  $this->load->view('common/uploaded_content.php'); ?>
					</div>                  
                 </div>                  
               </div>
              
               <div class="col-xs-6">
                  <div role="alert" class="alert alert-warning marked-complete">
                     <h4 class="pull-left"><strong>Marked Complete</strong> </h4>
                     <a href="javascript:void(0);" class="unchecked_marked"><img alt="home" src="<?php echo IMAGESRC.'box-1.png'?>" border="0"/></a>	
						
                     <a href="javascript:void(0);" class="checked_marked"><img alt="home" src="<?php echo IMAGESRC.'green_tickbox.png'?>" border="0"/></a>	
						<?php if(!empty($result_data['aaData'][0]['ub_task_id'])) { ?>
                     <input type="hidden" id="marked-list" name="marked-list" value="<?php if(isset($result_data['aaData'][0]['mark_complete_status']) && $result_data['aaData'][0]['mark_complete_status']==='Yes') { echo  $result_data['aaData'][0]['mark_complete_status']; }else{ echo 'No';  } ?>"  />
                  <?php }else{ ?>
				  <input type="hidden" id="marked-list" name="marked-list" value="No" />
				  <?php } ?>
				  <?php if(!empty($result_data['aaData'][0]['ub_task_id'])) { ?>
				  <?php if(isset($date_result_data) && !empty($date_result_data)) { ?>
					<div class="row m-top">
				<!--<div><label>Date Difference: </label><?php if(isset($date_result_data['time'])) echo $date_result_data['time'];?></div>-->
				<?php //echo '<pre>';print_r($date_result_data);exit;?>
				<?php if(isset($date_result_data['status']) && (($date_result_data['status'] == "Before due date task was completed") || ($date_result_data['status'] == "Not Over Dued")))
				{
				?>
				<div class="col-xs-12">
				<p><label>Performance Timing: </label>&nbsp;&nbsp;<font color="green"><?php if(isset($date_result_data['time'])) echo $date_result_data['time'];?></font></p></div>	
				<?php }elseif(isset($date_result_data['status']) && ($date_result_data['status'] == "Due date exceeded." || $date_result_data['status'] == "Delayed")) { ?>
					<div><label>Performance Timing: </label>&nbsp;&nbsp;<font color="red"><?php if(isset($date_result_data['time']) && $date_result_data['status'] != "Delayed") { echo $date_result_data['time']; } else{ echo 'Delayed('.$date_result_data['time'].')'; }?></font></div>
					<?php }else{ ?>
					<div><label>Performance Timing: </label>&nbsp;&nbsp;<?php if(isset($date_result_data['time'])) echo $date_result_data['time'];?></div>
					<?php } ?>
					</div>
					<?php } } ?>
				  
				  </div>
				  
				  <div class="col-xs-12">
				
				</div>
				
				  <!-- Assigned to -->
					<div id="load_assigned_to_div">
						<?php $this->load->view('content/task/assigned_to'); ?>
					</div>
                  <div class="row">
                     <div class="col-xs-3">
                        <div><label>Due Date</label></div>                   
                        <input data-toggle="toggle" data-on="Link To" data-off="Due Date" type="checkbox" id="toggle-event" name="deadline_type" <?php if(isset($result_data['aaData'][0]['link_to']) && $result_data['aaData'][0]['link_to']==='Yes') echo  "checked='checked'";?>>                     
                     </div>
					 
                     <div class="col-xs-4 due-date">
                        <label>&nbsp;</label>
                        <div class='input-group date' id='datetimepicker5'>
                           <input type="text" class="form-control" id="due_date" name="due_date" value="<?php if(isset($result_data['aaData'][0]['due_date']) && $result_data['aaData'][0]['due_date'] != 0000-00-00) echo date("m/d/Y", strtotime($result_data['aaData'][0]['due_date']))?>">
                           <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                        </div>
                     </div>
					 
                     <div class="col-xs-4 due-date">
                        <label>&nbsp;</label>                
                        <div class="form-group">
                           <div class='input-group date' id='task-time'>
                              <input type='text' class="form-control" placeholder="No Time" id="due_date_time" name="due_date_time" value="<?php if(isset($time)) echo $time;?>" />
                              <span class="input-group-addon">
                              <span class="glyphicon glyphicon-time"></span>
                              </span>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-1 link-to">
                        <label>&nbsp;</label>
                        <input name="number_days" id="number_days" type="text" class="form-control" style="width:40px;" value="<?php if(isset($result_data['aaData'][0]['number_days'])) echo $result_data['aaData'][0]['number_days'];?>" />
                        <!-- <input name="schedule_due_date" id="schedule_due_date" type="hidden" class="form-control" value="<?php if(isset($result_data['aaData'][0]['due_date_time'])) echo date("m/d/Y", strtotime($result_data['aaData'][0]['due_date_time']));?>" /> -->
                     </div>
                     <div class="col-xs-1 link-to">
                        <p>&nbsp;</p>
                        <label>&nbsp;day(s)</label>                
                     </div>
                     <div class="col-xs-3 link-to">
                        <label>&nbsp;</label>
                        <!-- <select class="selectpicker form-control">
                           <option value="">Nothing selected</option>
                           <option>After</option>
                        </select> -->
                        <?php 
	                         $before_or_after_dropdown_selected = '';
	                         if(isset($result_data['aaData'][0]['before_or_after']))
	                         {
	                           $before_or_after_dropdown_selected = $result_data['aaData'][0]['before_or_after'];
	                         }
	                         echo form_dropdown('before_or_after', $before_or_after_dropdown_list, $before_or_after_dropdown_selected, "class='selectpicker form-control' id='before_or_after' data-live-search='true'"); 
                          ?>
                     </div>
                     <div class="col-xs-4 link-to">
                        <label>&nbsp;</label>
                       <!--  <select class="selectpicker form-control" data-live-search="true" multiple>                           
                           <option>Item1</option>
                        </select> -->
                        <?php
							$schedule_selected = '';
							if(isset($result_data['aaData'][0]['schedule_id']))
							{
							$schedule_selected = $result_data['aaData'][0]['schedule_id'];
							}
							echo form_dropdown('schedule_id', $schedule_options, $schedule_selected, "class='selectpicker form-control' id='schedule_id' data-live-search='true'"); 
                         ?>
                     </div>
                     <div class="col-xs-3 link-to">
                            <label>Linked Date</label>
                            <input name="schedule_due_date" id="schedule_due_date" type="text" class="form-control" value="<?php if(isset($bid_data['due_date_time'])) echo date("m/d/Y", strtotime($bid_data['due_date_time']));?>" readonly="readonly" />
                           </div>
                  </div>
                  <div class="row">
                     <div class="col-xs-5">
                        <label>Priority</label>
						<?php 
						echo form_dropdown('priority', $task_priority,$result_data['aaData'][0]['priority'], "class='selectpicker form-control' id='priority' data-live-search='true'"); 
				  ?>
                     </div>
                  </div>
				  
				  
                  <div class="row">
                     <div class="col-xs-5">
                        <label>Tags</label>
                        <div class="col-xs">
							<?php 
							echo form_dropdown('tags[]', $task_tags, $array_value, "class='selectpicker form-control2' id='tags' data-live-search='true' multiple"); 
							?>
							<?php 
							if($this->user_account_type == BUILDERADMIN) {
							?>	
							<span class="right-group input-group-addon"><a href="javascript:void(0);" data-target="#TypeAddModal" data-toggle="modal"><img alt="plus" src="<?php echo IMAGESRC.'icon_plus1_1.png'?>" border="0"/></a>
							<a href="javascript:void(0);" class="TypeEditModal"><img alt="minus" src="<?php echo IMAGESRC.'icon_minus1_1.png'?>" border="0"/></a></span>
							<?php 
							}
							?>
                        </div>
                     </div>
                  </div>
				  
				  
                  <div class="row">
                     <div class="col-xs-5">
                        <label>Reminder</label>
                        <a class="glyphicon glyphicon-question-sign" href="#" data-original-title="" title=""></a>
                        
                           <?php 
						echo form_dropdown('reminder', $task_reminder, $result_data['aaData'][0]['reminder_id'], "class='selectpicker form-control' id='reminder' data-live-search='true'"); 
				  ?>
                        
                     </div>
                  </div>
				 <div id="comments_area">
              <?php if(isset($result_data['aaData'][0]['ub_task_id'])) { ?>
              <p>&nbsp;</p>
              <?php if($comments_list != false){?><p> <span class="pull-right"><a href='javascript:void(0);' class="comment-image" data-toggle="modal" data-target="#commentModal">
				<img border="0" class="uni_new_comment" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>">				
			  </a></span> </p><?php } ?>
              <label>Discussions</label>
              <div class="jumbotron">
                <div id="comment_block">
                <?php 
                if($comments_list != false){?>
                <div class="inner-jumbotron" id="list_comments_div">
                  <?php
                  $count = 1;
                  $class = "";
                  foreach ($comments_list as $key => $value) 
                  {
					if($value['account_type'] == '100')
					{
					 $class = 'alert alert-info';
					 $added_by = 'Added By Builder';
					}
					if($value['account_type'] == '300')
					{
					 $class = 'alert alert-warning';
					 $added_by = 'Added By Sub';
					}
					if($value['account_type'] == '200')
					{
					 $class = 'alert alert-success';
					 $added_by = 'Added By Owner';
					}
                  ?>
                  <div class="<?php echo $class;?>" role="alert">
                  <div class="row">
                  <div class="col-xs-11">
                  <p><?php echo $value['comments'] ?>.</p>
                  <p class="text-muted">- <?php echo $value['first_name'] ?> on <?php echo $value['comment_created_on'] ?><p><?php echo $added_by; ?></p></p>
                  </div>
                  <div class="col-xs-1">
                  <?php if($value['show_owner'] == 'Yes') { ?><p><img border="0" class="uni_owner" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>" title="Owner"></p><?php } ?>
                  <?php if($value['show_sub'] == 'Yes') { ?><p> <img border="0" class="uni_sub" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>" title="Subcontractor"></p><?php } ?>
                  <?php if($value['created_by'] == $this->user_id){ ?>
                  <p><a href='javascript:void(0);' id="<?php if(isset($value['ub_comments_id'])) echo $value['ub_comments_id']; ?>" onclick="delete_comment(this.id)"><img border="0" class="uni_delete" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"></a></p>
                  <?php } ?>
                  </div>
                  </div>
                  </div>
                  <?php 
                  $count++;
                  }
                
                ?>        
                </div>
                <?php } ?>
                <div>
               
              </div>
              </div>
              <p class="text-center">
              <?php if($comments_list != true){ ?><button class="btn btn-blue" type="button" data-toggle="modal" data-target="#commentModal">
			  <img border="0" class="uni_new_comment" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Add Comment</button><?php } ?>
              </p>
            </div>
            <?php } ?>
            </div>
				  
				  
				  
               </div>
            </div>
			<input type="hidden" name="save_type" id="save_type" value="" />
         </div>
      </div>
   </div>
</div>
</form>
<!-- Type Add Modal -->
<div class="modal fade" id="TypeAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>New Project Group
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <table width="100%" class="table border-none">
                              <tr>
                                 <td height="20">Title</td>
                                 <td><input type="text" class="form-control" name="tags_add" id="tags_add" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="submit" class="btn btn-default btn-secondary pull-right" id="tags_save">Save</button></td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="TypeEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Edit / Delete
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">						
                           <table width="100%" class="table border-none">
                              <tr>
                                 <td height="20">Title</td>
                                 <td><input type="text" id="edit_project_group" class="form-control" /><input type="hidden" id="selected" class="form-control"  /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2">
								 <button type="button" id="project_group_delete" class="btn btn-default btn-secondary pull-right">Delete</button>
                                    <!--<button type="button" id="Delete_project" class="btn btn-default btn-secondary pull-right">Delete</button>					 
                                    <button type="button" id="Edit_project" class="btn btn-default btn-secondary pull-right" >Save</button>-->
                                 </td>
                              </tr>
                           </table>						   
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Comment Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Post Your Comment
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
		 <form id="post_your_comment" class="form-horizontal" method="post" name="post_your_comment">
            <div class="row m-top">
               <div class="col-xs-12">
                  <div class="modal-con">
					<div class="col-xs-12">
						<div class="form-group">
							<textarea class="form-control" id="comment" name="comment" maxlength="4000" ></textarea>
						</div>
					</div>
					 <p><span name="commentcountchars" id="commentcountchars"></span> Characters Remaining. <span name="commentpercent" id="commentpercent"></span></p>
                     <!--<p class="text-right">4000 Character Counter.</p>-->
                     <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
                        <tr>
                           <td width="33%" height="30">&nbsp;</td>
                           <td width="10">&nbsp;</td>
                           <td width="33%"><strong>Show?</strong></td>
                           <td width="33%"><strong>Notify?</strong></td>
                        </tr>
                        <?php if($this->user_account_type != OWNER)
                        { ?>
                        <tr>
                           <td height="30" align="right"><strong>Owner : </strong></td>
                           <td>&nbsp;</td>
                           <td>
						   <input type="hidden" name="owner_show_val" id="owner_show_val" value="No">
						   
						   <input type="checkbox" name="checkbox" id="owner_show_checkbox">
                              <label for="checkbox"></label>
                           </td>
                           <td class="owner-child">
						   <input type="hidden" name="owner_notify_val" id="owner_notify_val" value="No">
						   
						   <input type="checkbox" name="checkbox2" id="owner_notify_checkbox"></td>
                        </tr>
                        <?php } ?>
                        <?php if($this->user_account_type != SUBCONTRACTOR)
                         { ?>
                        <tr>
                           <td height="30" align="right"><strong>Sub : </strong></td>
                           <td>&nbsp;</td>
                           <td>
						   <input type="hidden" name="sub_show_val" id="sub_show_val" value="No">
						   
						   <input type="checkbox" name="checkbox3" id="sub_show_checkbox"></td>
                           <td class="sub-child">
						   <input type="hidden" name="sub_notify_val" id="sub_notify_val" value="No">
						   
						   <input type="checkbox" name="checkbox4" id="sub_notify_checkbox"></td>
                        </tr>
                        <?php } ?>
                     </table>
                     <div class="row text-center">
                        <button type="submit" class="btn btn-gray" id="post_comment">POST COMMENT</button>
                        <button type="button" class="btn btn-gray" data-dismiss="modal">CANCEL</button>
                     </div>
                  </div>
               </div>
            </div>
			</form>
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
				<button class="btn btn-gray m-left-1 pull-right" id="cancel_comment_confirm" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> CANCEL</button>  
				<button class="btn btn-blue m-left-1 pull-right" type="button" id="delete_comment_confirm"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_approved"/> OK</button>				
              </div>
            </div>
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
					<button class="btn btn-success" type="button" onclick="copy_file_to_temp()">Upload</button>
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
   this.list_page   = 'yes';     
   this.file_upload_list_page_user   = '<?php echo $this->user_account_type; ?>'; 
</script>
<link rel="stylesheet" href="<?php echo CSSSRC.'file-tree.min.css';?>">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-toggle.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'file-tree.min.js';?>"></script>
<script src="<?php echo JSSRC.'fileupload/task_main.js' ?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.jscrollpane.css';?>">	
<script type="text/javascript" src="<?php echo JSSRC.'enscroll-0.6.0.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'save_task.js';?>"></script>