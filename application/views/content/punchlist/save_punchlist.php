<?php 
if(!empty($result_data['mark_complete_status']))
{
//echo $result_data['mark_complete_status'];
}
$count_cn = 1;
if(!empty($result_data['tags']))
{
	$multiple_tag = $result_data['tags'];
	$array_value = explode(",",$multiple_tag);
}
else
{
	$array_value =false;
}
if(!empty($result_data['priority']))
{
	$result_data['priority'] = $result_data['priority'];
}
else
{
	$result_data['priority'] =false;
}

if(!empty($result_data['description']))
{
	$description = explode(",",$result_data['description']);
	$count_cn = count($description);
}
//checkbox clone
if(!empty($result_data['description_checkbox']))
{
	$description_checkbox = explode(",",$result_data['description_checkbox']);
}
if(!empty($result_data['check_list_id']))
{
	$check_list_id = explode(",",$result_data['check_list_id']);
}
if(!empty($result_data['punch_list_id']))
{
	$punch_list_id = explode(",",$result_data['punch_list_id']);
}
?>
<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?> 
      <!--<li class="active"><?php if(isset($result_data['ub_punch_list_id'])) echo "Edit Punch list"; else echo "Add Punch list";?></li>-->
   </ol>
</div>
<form id="add_new_task" class="form-horizontal" method="post" name="add_new_task">
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
         <div class="pull-right ">
            <!--<button class="btn btn-default btn-primary pull-right m-left-1 glyphicon glyphicon-print"></button>-->
            <a href="<?php echo base_url().$this->crypt->encrypt('punchlist/index/'); ?>">
			<button type="button" class="btn btn-gray  pull-right m-left-1">
			<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/>
			Cancel</button></a>
			<?php 
			if(isset($this->user_role_access[strtolower('punchlist')][strtolower('delete')]) && $this->user_role_access[strtolower('punchlist')][strtolower('delete')] == 1)
			{ 
				if(!empty($result_data['ub_punch_list_id'])) 
				{ 
					if(isset($this->project_status_check) && $this->project_status_check == 1)
					{
			?>
			<button class="btn btn-blue  pull-right m-left-1" type="button" id="<?php if(isset($result_data['ub_punch_list_id'])) echo $result_data['ub_punch_list_id']; ?>" onclick="delete_punchlist(this.id)"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_delete"/>Delete</button>
			<?php 
					}
				}
			}
			?>
			<?php 
			if(isset($this->user_role_access[strtolower('punchlist')][strtolower('edit')]) && $this->user_role_access[strtolower('punchlist')][strtolower('edit')] == 1 && $this->first_argument > 0)
			{ 
				if(isset($this->project_status_check) && $this->project_status_check == 1)
				{
			?>
			<button type="submit" class="btn btn-blue  pull-right m-left-1" id="add_task_new_back" name="add_task_new_back" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back </button>
			<button type="submit" class="btn btn-blue  pull-right m-left-1" id="add_task_new" name="add_task_new" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save &amp; New</button>
			<button type="submit" class="btn btn-blue pull-right m-left-1" name="add_task_new_stay" id="add_task_new_stay"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
			<?php 
				}
			}
			else if((isset($this->user_role_access[strtolower('punchlist')][strtolower('add')]) && $this->user_role_access[strtolower('punchlist')][strtolower('add')] == 1) && $this->first_argument == 0)
			{
			?>
			<button type="submit" class="btn btn-blue  pull-right m-left-1" id="add_task_new_back" name="add_task_new_back" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back </button>
			<button type="submit" class="btn btn-blue  pull-right m-left-1" id="add_task_new" name="add_task_new" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save &amp; New</button>
			<button type="submit" class="btn btn-blue pull-right m-left-1" name="add_task_new_stay" id="add_task_new_stay"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
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
<div class="row m-top">
   <div class="col-xs-12">
      <div class="panel panel-default">
         <div class="panel-heading" role="tab" id="filter">
            <h4 class="panel-title"><?php if(isset($result_data['ub_punch_list_id'])) echo "Edit Punch List Details"; else echo "New Punch List Details";?></h4>
         </div>
         <div class="panel-body">
            <div class="row panel-content two-box">			
               <div class="col-xs-6">
			   <input type="hidden" name="ub_punch_list_id" id="ub_punch_list_id" value="<?php if(isset($result_data['ub_punch_list_id'])) echo $result_data['ub_punch_list_id'];?>">	
				<input type="hidden" name="created_on" id="created_on" value="<?php if(isset($result_data['created_on'])) echo $result_data['created_on'];?>">
				<div class="<?php if($this->project_id == '' && !isset($result_data['project_id'])){ echo 'no_project_selected'; } ?>">
			<?php 			  
			 /*   if(!empty($this->project_id))
			   {			   
			   echo '<label>Project Name</label> : '.$this->project_name;			  
			   echo '<input type="hidden" name="project_name" id="project_name" value="'.$this->project_id.'" />';
			   } */
			   
			   if(!empty($this->project_id) && !isset($result_data['project_id']))
			   {
			   //echo '<label>Project Name</label> : '.$this->project_name;			  
			   echo '<input type="hidden" name="project_name" id="project_name" value="'.$this->project_id.'" />';
			   echo '<input type="hidden" name="project_id" id="project_id" value="'.$this->project_id.'" />';
			   }
			   else if(isset($result_data['project_id']))
			   {
			   // echo '<label>Project Name</label> : '.$project_list[$result_data['project_id']];			  
			   echo '<input type="hidden" name="project_name" id="project_name" value="'.$result_data['project_id'].'" />';
			   echo '<input type="hidden" name="project_id" id="project_id" value="'.$result_data['project_id'].'" />';
			   }
			 ?>
			 </div>
			 <div class="col-xs-12">
				<div class="row">
				<label>Title</label>

					<div class="col-xs-12">
						<div class="form-group">
						<input type="text" class="form-control" placeholder="Title" id ="title" name ="title" maxlength="128" value="<?php if(isset($result_data['title'])) echo $result_data['title'];?>">
						</div>
					</div>
				</div>
			</div>
                  <textarea class="form-control m-top" placeholder="Type Note" id="task_note" name="task_note" maxlength="2000"><?php if(isset($result_data['note'])) echo $result_data['note'];?></textarea>
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
				  
                  <div class="row">                    
					<div>  
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
						<?php if(!empty($result_data['ub_punch_list_id'])) { ?>
                     <input type="hidden" id="marked-list" name="marked-list" value="<?php if(isset($result_data['mark_complete_status']) && $result_data['mark_complete_status']==='Yes') echo  $result_data['mark_complete_status']; ?>"  />
                  <?php }else{ ?>
				  <input type="hidden" id="marked-list" name="marked-list" value="No" />
				  <?php } ?>
				  </div>
                  <div class="row">
                     <div class="col-xs-5">
                        <label>Priority</label>
						<?php 
						echo form_dropdown('priority', $punchlist_priority,$result_data['priority'], "class='selectpicker form-control' id='priority' data-live-search='true'"); 
						?>
                     </div>
                  </div>
				  
                  <div class="row">
                     <div class="col-xs-5">
                        <label>Tags</label>
                        <div class="col-xs">
							<?php 
							echo form_dropdown('tags[]', $punchlist_tags, $array_value, "class='selectpicker form-control2' id='tags' data-live-search='true' multiple"); 
							?>
							<?php 
							if($this->user_account_type == BUILDERADMIN) 
							{
								if(isset($this->user_role_access) && $this->user_role_access[strtolower('punchlist')][strtolower('add')] == 1)
								{
							?>	
							<span class="right-group input-group-addon"><a href="javascript:void(0);" data-target="#TypeAddModal" data-toggle="modal"><img alt="plus" src="<?php echo IMAGESRC.'icon_plus1_1.png'?>" border="0"/></a>
							<a href="javascript:void(0);" class="TypeEditModal"><img alt="minus" src="<?php echo IMAGESRC.'icon_minus1_1.png'?>" border="0"/></a></span>
							<?php 
								}
							}
							?>
                        </div>
                     </div>
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
         <h4>New Punchlist Tag
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
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.jscrollpane.css';?>">	
<script type="text/javascript" src="<?php echo JSSRC.'enscroll-0.6.0.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'save_punchlist.js';?>"></script>