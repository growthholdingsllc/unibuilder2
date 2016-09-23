<?php //echo '<pre>';print_r($result_data);exit; ?>
<div class="row">
  <ol class="breadcrumb">
    <?php //$this->load->view('common/breadcrumbs'); ?> 
    <!--<li class="active"><?php if(isset($result_data['ub_checklist_id'])) echo "Edit Checklist"; else echo "Add Checklist";?></li>-->
  </ol>
</div>
<form id="add_new_check_list" class="form-horizontal" method="post" name="add_new_check_list">
<div class="row">
  <div class="col-xs-12">
    <div class="top-search pull-right">
      <div class="pull-right col-xs-12"> <a href="<?php echo base_url();?>Y2hlY2tsaXN0L2luZgxf1V4Lw--">
		<button class="btn btn-gray pull-right m-left-1" type="button"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</button></a> 
		
		<?php 
		if(isset($this->user_role_access[strtolower('checklist')][strtolower('delete')]) && $this->user_role_access[strtolower('checklist')][strtolower('delete')] == 1)
		{
			if(isset($this->project_status_check) && $this->project_status_check == 1)
			{
				if(!empty($result_data['ub_checklist_id'])) { ?>
		<button class="btn btn-blue pull-right m-left-1" type="button" id="<?php if(isset($result_data['ub_checklist_id'])) echo $result_data['ub_checklist_id']; ?>" onclick="deletechecklists(this.id)"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_delete"/> Delete</button>
		<?php
				}
			}
		} 
		if(isset($this->user_role_access[strtolower('checklist')][strtolower('edit')]) && $this->user_role_access[strtolower('checklist')][strtolower('edit')] == 1 && $this->first_argument > 0)
		{ 
			if(isset($this->project_status_check) && $this->project_status_check == 1)
			{
        ?> 
			<button type="submit" class="btn btn-blue pull-right m-left-1" id="add_check_list_new_back" name="add_check_list_new_back" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back </button>
			<button class="btn btn-blue pull-right m-left-1" type="submit" id="add_check_list_new_new" name="add_check_list_new_new" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save &amp; New</button>	
			<button type="submit" class="btn btn-blue pull-right m-left-1" id="add_check_list_new_stay" name="add_check_list_new_stay" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save & Stay </button>
		<?php
			}
		}
		else if((isset($this->user_role_access[strtolower('checklist')][strtolower('add')]) && $this->user_role_access[strtolower('checklist')][strtolower('add')] == 1) && $this->first_argument == 0)
		{ 
		?>
			<button type="submit" class="btn btn-blue pull-right m-left-1" id="add_check_list_new_back" name="add_check_list_new_back" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back </button>
			<button class="btn btn-blue pull-right m-left-1" type="submit" id="add_check_list_new_new" name="add_check_list_new_new" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save &amp; New</button>
			<button type="submit" class="btn btn-blue pull-right m-left-1" id="add_check_list_new_stay" name="add_check_list_new_stay" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save & Stay </button>
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
    <div class="panel panel-default logs-wrapper">
      <div class="panel-heading" role="tab" id="filter">
        <h4 class="panel-title">Checklist</h4>
      </div>
      <div class="panel-body">
      <input type="hidden" name="bid" id="bid" value="<?php echo isset($bid)?$bid:'' ?>" />
      <input type="hidden" name="ub_bid_id" id="ub_bid_id" value="<?php echo $ub_bid_id?>" />
	  
	  <input type="hidden" name="ub_checklist_id" id="ub_checklist_id" value="<?php echo (isset($result_data['ub_checklist_id']) && $result_data['ub_checklist_id'] > 0)?$this->ci_object->ci_encrypt($result_data['ub_checklist_id'], $this->encrypt_key):0?>">
        <div class="row">
          <div class="col-xs-3 <?php if($this->project_id == '' && !isset($result_data['project_id'])){ echo 'no_project_selected'; } ?>">
			<?php 			  
			  if(!empty($this->project_id) && !isset($result_data['project_id']))
			   {
			   echo '<label>Project Name</label> : '.$this->project_name;			  
			   echo '<input type="hidden" name="project_name" id="project_name" value="'.$this->project_id.'" />';
			   echo '<input type="hidden" name="project_id" id="project_id" value="'.$this->project_id.'" />';
			   }
			   else if(isset($result_data['project_id']))
			   {
			   echo '<label>Project Name</label> : '.$project_list[$result_data['project_id']];			  
			   echo '<input type="hidden" name="project_name" id="project_name" value="'.$result_data['project_id'].'" />';
			   echo '<input type="hidden" name="project_id" id="project_id" value="'.$result_data['project_id'].'" />';
			   }
			 ?>
			 </div>
        </div>
        <hr/>
        <div class="row">
          <div class="pull-right col-xs-12 two-box">
            <div class="col-xs-6">
              <div class="row">
                <div class="col-xs-9">
                  <label>Checklist Title</label>
				 <div class="col-xs-12">
				 <div class="form-group">
                  <input type="text" class="form-control" maxlength="128" id="title" name="title" value="<?php echo isset($result_data['title'])?$result_data['title']:'' ?>"/>
				 </div>
				 </div>
				</div>
              </div>
			  
			  
              <div class="row">
                <div class="col-xs-10">
                  <label>Tags</label>
                  <div class="col-xs">
                    <?php 
				   $tag_selected = '';
				   if(isset($result_data['tags']))
				   {
						$tag_selected = explode(",",$result_data['tags']);
				   }
				   echo form_dropdown('tags[]', $check_list_tags, $tag_selected, "class='selectpicker form-control2' id='tagType' data-live-search='true' multiple"); 
				   ?>
                    <span class="right-group input-group-addon"><a href="javascript:void(0);" data-target="#TypeAddModal" data-toggle="modal"> 
					<img src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>"></a> 
					
					
					<a href="javascript:void(0);"  class="TypeEditModal" > 
					<img src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>"></a>
					</span> </div>
                </div>
              </div>
			  
			  
              <div class="row">
                <div class="col-xs-10">
                  <label>Category</label>
                  <div class="col-xs">
                    <?php 
				   $category_selected = '';
				   if(isset($result_data['category']))
				   {
						$category_selected = explode(",",$result_data['category']);
				   }
				   echo form_dropdown('category[]', $category_tags, $category_selected, "class='selectpicker form-control2' id='categoryType' data-live-search='true' multiple"); 
				   ?>
                    <span class="right-group input-group-addon">
					<a href="javascript:void(0);" data-target="#categoryAddModal" data-toggle="modal"> 
					<img src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>"></a> 
					
					<a href="javascript:void(0);" class="categoryEditModal"> 
					<img src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>"></a>
					</span> </div>
                </div>
                <div class="col-xs-10">
                  <label>Attachments</label>                  
                  <!--<p>or <a href="#">click here</a> to choose from UNIBUILDER Docs</p>-->
				  <p class="text-primary col-xs-12"><a href="javascript:void(0);" class="text-primary" data-target="#docs_upload_Modal" data-toggle="modal">or <u>Click Here</u></a>  to Choose from Unibuilder docs</p>
				  <div class="row">
					<?php $this->load->view('common/upload.php');?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="row meeting-editor">
                <div class="col-xs-12">
                  <label>&nbsp;</label>
                  <textarea class="ckeditor" name="editor1" id="editor1"><?php echo isset($result_data['description'])?$result_data['description']:'' ?></textarea>
                </div>
              </div>
              <div class="row"> </div>
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
      <h4>Add Tag
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
                      <td height="20" colspan="2"><button type="button" id="tags_save" class="btn btn-default btn-secondary pull-right">Save</button></td>
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
<!-- Edit/delete tag -->
<div class="modal fade" id="TypeEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Edit / Delete Tag
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
<!-- category Add Modal -->
<div class="modal fade" id="categoryAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Add Category
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
                      <td><input type="text" class="form-control" name="add_category" id="add_category" /></td>
                    </tr>
                    <tr>
                      <td height="20" colspan="2"><button type="button" id="category_save" class="btn btn-default btn-secondary pull-right">Save</button></td>
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
<!-- Edit/delete category -->
<div class="modal fade" id="categoryEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Edit / Delete Category
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
                                 <td><input type="text" id="edit_project_groups" class="form-control" /><input type="hidden" id="selected" class="form-control"  /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2">
								 <button type="button" id="project_group_deletes" class="btn btn-default btn-secondary pull-right">Delete</button>
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
<link rel="stylesheet" href="<?php echo CSSSRC.'file-tree.min.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'dropzone.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'dropzone.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/ckeditor.js';?>"></script>
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.jscrollpane.css';?>">	
<script type="text/javascript" src="<?php echo JSSRC.'enscroll-0.6.0.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'save_checklist.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'file-tree.min.js';?>"></script>
