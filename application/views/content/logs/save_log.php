<div class="row">
  <ol class="breadcrumb">
    <?php //$this->load->view('common/breadcrumbs'); ?> 
    <!--<li class="active"><?php if(isset($log_data['ub_daily_log_id'])) echo "Edit Log"; else echo "New Log";?></li>-->
  </ol>
</div>
<form id="add_new_log" class="form-horizontal" method="post" name="add_new_log">
<div class="row">
  <div class="col-xs-12">
    <div class="top-search pull-right">
        <div class="pull-right ">                       
        <button class="btn btn-gray pull-right m-left-1" type="button" id="btncancel">
			<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel
		</button>
        <?php
		if(isset($this->user_role_access[strtolower('logs')][strtolower('delete')]) && $this->user_role_access[strtolower('logs')][strtolower('delete')] == 1)
		{ 
			if(isset($log_data['ub_daily_log_id']))
			{
				if(isset($this->project_status_check) && $this->project_status_check == 1)
				{
        ?>
			<button class="btn btn-blue pull-right m-left-1" type="button" id="<?php if(isset($log_data['ub_daily_log_id'])) echo $log_data['ub_daily_log_id']; ?>" onclick="delete_log(this.id)">
				<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_delete"/> Delete
			</button>
        <?php
				}
			}
		}
		if(isset($this->user_role_access[strtolower('logs')][strtolower('edit')]) && $this->user_role_access[strtolower('logs')][strtolower('edit')] == 1 && $this->first_argument > 0)
		{ 
			if(isset($this->project_status_check) && $this->project_status_check == 1)
			{
        ?>           
			<button class="btn btn-blue pull-right m-left-1" type="submit" id="add_log_back"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back</button>   
			<button class="btn btn-blue pull-right m-left-1" type="submit" id="add_log_new"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/>  Save &amp; New</button>   
			<button class="btn btn-blue pull-right m-left-1" type="submit" id="add_log"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
		<?php
			}
		}
		else if((isset($this->user_role_access[strtolower('logs')][strtolower('add')]) && $this->user_role_access[strtolower('logs')][strtolower('add')] == 1) && $this->first_argument == 0)
		{ 
		?>
			<button class="btn btn-blue pull-right m-left-1" type="submit" id="add_log_back"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back</button>   
			<button class="btn btn-blue pull-right m-left-1" type="submit" id="add_log_new"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/>  Save &amp; New</button>   
			<button class="btn btn-blue pull-right m-left-1" type="submit" id="add_log"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
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
        <h4 class="panel-title">Daily Log Details</h4>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-xs-12 <?php if($this->project_id == '' && !isset($log_data['project_id'])){ echo 'no_project_selected'; } ?>">            
            <div class="col-xs-3">
				<div class="val-man col-xs-12">
					<div class="form-group">
					  <input type="hidden" name="ub_daily_log_id" id="ub_daily_log_id" value="<?php echo (isset($log_data['ub_daily_log_id']) && $log_data['ub_daily_log_id'] > 0)?$this->ci_object->ci_encrypt($log_data['ub_daily_log_id'], $this->encrypt_key):0 ?>" />
					  
					  <input type="hidden" id="log_id" value="<?php echo (isset($log_data['ub_daily_log_id']) && $log_data['ub_daily_log_id'] > 0)?$log_data['ub_daily_log_id']:0 ?>" />
					  <?php 
					   
             if(!empty($this->project_id) && !isset($log_data['project_id']))
             {
              //echo '<label>Project Name</label> : '.$this->project_name;       
               echo '<input type="hidden" name="project_id" id="project_id" value="'.$this->project_id.'" />';
             }
            else if(isset($log_data['project_id']))
            {
             //echo '<label>Project Name</label> : '.$project_list[$log_data['project_id']];        
             echo '<input type="hidden" name="project_id" id="project_id" value="'.$log_data['project_id'].'" />';
            }
					  ?>
					</div>
				</div>
            </div>
          </div>
        </div>
        <hr/>
        <div class="row">
          <div class="pull-right col-xs-12">
            <div class="col-xs-7">
              <div class="row">
                <div class="col-xs-5">
                  <label>Date</label>
				  <div class="val-man col-xs-12">
					<div class="form-group">
					  <div id="datetimepicker5" class="input-group date">
						<input type="text" class="form-control" name="log_date" id="log_date" value="<?php if(isset($log_data['log_date'])) echo date("m/d/Y", strtotime($log_data['log_date']));?>" readonly />
						<span class="input-group-addon"> <span class="glyphicon-calendar glyphicon"></span> </span> 
					 </div>
					</div>
                </div>
                </div>
                <div class="col-xs-5">
					<label>Tags</label>
					<div class="col-xs">
						<?php 
						if(isset($log_data['tags']))
						{
						$selected_tags = $log_data['tags'];
						$selected_tags = explode(",",$log_data['tags']);
						echo form_dropdown('tags[]', $log_tags_array, $selected_tags, "class='selectpicker form-control2' id='tags' data-live-search='true' multiple"); 
						}
						else
						{
						echo form_dropdown('tags[]', $log_tags_array, '', "class='selectpicker form-control2' id='tags' data-live-search='true' multiple");
						}
						?>
						<?php 
						if($this->user_account_type == BUILDERADMIN) {
						?>	
						<span class="right-group input-group-addon"><a href="javascript:void(0);" data-target="#TypeAddModal" data-toggle="modal"> <img alt="plus" src="<?php echo IMAGESRC.'icon_plus1_1.png'?>" border="0"/></a> <a href="javascript:void(0);" class="TypeEditModal"><img alt="minus" src="<?php echo IMAGESRC.'icon_minus1_1.png'?>" border="0"/></a></span> 
						<?php 
						}
						?>
					</div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10">
                <div class="val-man col-xs-12">
                <div class="form-group">
                  <label>Notes</label>
                  <textarea class="form-control" name="log_notes" id="log_notes"><?php if(isset($log_data['log_notes'])) echo $log_data['log_notes'];?></textarea>
				  <p><span name="countchars" id="countchars"></span> Characters Remaining. <span name="percent" id="percent"></span></p>
                </div>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-5">
                  <label>Permissions</label>
                  <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="40" height="30"><a href="#"> <img border="0" class="uni_builder" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"></a></td>
                      <td>Private</td>
                      <?php
                      if((isset($log_data['private'])) && $log_data['private'] == "Yes")
                      {
                      ?>
                      <td width="40" align="center"><input type="checkbox" id="private_checkbox" checked/></td>
                      <input type="hidden" name="private" id="private" value="Yes">
                      <?php
                      }
                      else
                      {
                      ?>
                      <td width="40" align="center"><input type="checkbox" id="private_checkbox" /></td>
                      <input type="hidden" name="private" id="private" value="No">
                      <?php
                      }
                      ?>
                    </tr>
                    <tr>
                      <td height="30"><a href="#"> <img border="0" class="uni_sub" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"></a></td>
                      <td>Show Subs</td>
                      <?php
                      if((isset($log_data['show_subs'])) && $log_data['show_subs'] == "Yes")
                      {
                      ?>
                      <td width="40" align="center"><input type="checkbox" id="show_subs_checkbox" checked/></td>
                      <input type="hidden" name="show_subs" id="show_subs" value="Yes">
                      <?php
                      }
                      else
                      {
                      ?>
                      <td align="center"><input type="checkbox" id="show_subs_checkbox"/></td>
                      <input type="hidden" name="show_subs" id="show_subs" value="No">
                      <?php
                      }
                      ?>
                    </tr>
                    <tr>
                      <td height="30"><a href="#"> <img border="0" class="uni_owner" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"></a></td>
                      <td>Show Owner</td>
                      <?php
                      if((isset($log_data['show_owner'])) && $log_data['show_owner'] == "Yes")
                      {
                      ?>
                      <td width="40" align="center"><input type="checkbox" id="show_owner_checkbox" checked/></td>
                      <input type="hidden" name="show_owner" id="show_owner" value="Yes">
                      <?php
                      }
                      else
                      {
                      ?>
                      <td align="center"><input type="checkbox" id="show_owner_checkbox"/></td>
                      <input type="hidden" name="show_owner" id="show_owner" value="No">
                      <?php
                      }
                      ?>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10">
                  <label>Weather Notes</label>
                    <?php
                      if((isset($log_data['weather_notes'])) && $log_data['weather_notes'] == "Yes")
                      {
                      ?>
                      <input type="checkbox" id="weather_notes" checked/>
                      <input type="hidden" name="weather_notes" id="weather" value="Yes">
                      <?php
                      }
                      else
                      {
                      ?>
                    <input type="checkbox" id="weather_notes"/>
                    <input type="hidden" name="weather_notes" id="weather" value="No">
                    <?php
                      }
                    ?>
                    <div class="val-man col-xs-12">
                       <div class="form-group">
                          <textarea class="form-control notes-area m-top" name="weather_description"><?php if(isset($log_data['weather_description'])) echo $log_data['weather_description'];?></textarea>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-xs-5">
			<?php 
			if($this->user_account_type == BUILDERADMIN)
			{
			?>
			<p class="text-primary"><a href="javascript:void(0);" class="text-primary" data-target="#docs_upload_Modal" data-toggle="modal"><u>Click Here</u></a>  to Choose from Unibuilder docs</p>
             <?php 
			 }
			 ?>
              <div class="row">
                <div  class="col-xs-12">	
				<label>File(s)</label>
				<?php 
				if($this->user_account_type == BUILDERADMIN) {
				?>					
                  <?php $this->load->view('common/upload.php'); } ?>
                  <?php if($this->user_account_type == OWNER || $this->user_account_type == SUBCONTRACTOR) $this->load->view('common/uploaded_content.php'); ?>
                </div>
              </div>
              <div id="comments_area">
                <?php if(isset($log_data['ub_daily_log_id'])) {
                if((isset($log_data['private'])) && $log_data['private'] != "Yes"){ ?>
                <?php $this->load->view('content/logs/comment'); ?>
                <?php } } ?>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<input type="hidden" name="save_type" id="save_type" value="" />
</form>
<!-- Type Add Modal -->
<div class="modal fade" id="TypeAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>New Tag Group
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
                                 <td><input type="text" id="tags_add" class="form-control" /></td>
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
                                    <!-- <button type="button" id="Delete_project" class="btn btn-default btn-secondary pull-right">Delete</button>          
                                    <button type="button" id="Edit_project" class="btn btn-default btn-secondary pull-right" >Save</button> -->
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
<form id="post_your_comment" class="form-horizontal" method="post" name="post_your_comment">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Post Your Comment
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </h4>
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
            <div class="modal-con">
			  <div class="col-xs-12">
				  <div class="val-man col-xs-12">
					  <div class="form-group">
						<textarea class="form-control"  id="comments" name="comments"></textarea>
					  </div>
				  </div>
			  </div>
			  <p><span name="commentcountchars" id="commentcountchars"></span> Characters Remaining. <span name="commentpercent" id="commentpercent"></span></p>
              <!--<p class="text-right">4000 Character Counter.</p>-->
              <?php if((isset($log_data['private'])) && $log_data['private'] != "Yes")
                      { ?>
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
                <?php if($log_data['show_subs'] == "Yes" || $log_data['show_owner'] == "Yes")
                      { ?>
                <tr>
                  <td width="33%" height="30">&nbsp;</td>
                  <td width="10">&nbsp;</td>
                  <td width="33%"><strong>Show?</strong></td>
                  <td width="33%"><strong>Notify?</strong></td>
                </tr>
                <?php }  ?>
                <?php if((isset($log_data['show_owner'])) && $log_data['show_owner'] == "Yes" && $this->user_account_type != OWNER)
                      { ?>
                <tr>
                  <td height="30" align="right"><strong>Owner : </strong></td>
                  <td>&nbsp;</td>
                  <td><input type="checkbox"  id="owner">
                      <input type="hidden"  id="owner_val" value="No">
                    <label for="checkbox"></label></td>
                  <td class="owner-child"><input type="checkbox"  id="owner-child"></td>
                  <input type="hidden"  id="owner_notify" value="No">
                </tr>
                <?php } ?>
                <?php if((isset($log_data['show_subs'])) && $log_data['show_subs'] == "Yes" && $this->user_account_type != SUBCONTRACTOR)
                      { ?>
                <tr>
                  <td height="30" align="right"><strong>Sub : </strong></td>
                  <td>&nbsp;</td>
                  <td><input type="checkbox"  id="sub"></td>
                  <input type="hidden"  id="sub_val" value="No">
                  <td class="sub-child"><input type="checkbox"  id="sub-child"></td>
                  <input type="hidden"  id="sub_notify" value="No">
                </tr>
                <?php } ?>
              </table>
              <?php } ?>
              <div class="row text-center">
                <button type="submit" class="btn btn-gray" id="post_comment">POST COMMENT</button>
                <button type="button" class="btn btn-gray" data-dismiss="modal">CANCEL</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
</form>  
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
				<button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal">
					<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> CANCEL
				</button>  
				<button class="btn btn-blue m-left-1 pull-right" type="button" id="delete_confirm">
					<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_approved"/> OK
				</button>				
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
					<button class="btn btn-success" type="submit" onclick="copy_file_to_temp()">Upload</button>
				</div>
			</div>
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
				<button class="btn btn-gray m-left-1 pull-right" type="button" id="cancel_comment_confirm" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> CANCEL</button>  
				<button class="btn btn-blue m-left-1 pull-right" type="button" id="delete_comment_confirm"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_approved"/> OK</button>				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
<!-- /Delete Comment -->
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
<link rel="stylesheet" href="<?php echo CSSSRC.'dropzone.css';?>">
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'jquery.mjs.nestedSortable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'file-tree.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.jscrollpane.css';?>">	
<script type="text/javascript" src="<?php echo JSSRC.'enscroll-0.6.0.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'save_log.js';?>"></script>
<script>
function divFunction(){       
  $(this).parent().parent('ul.in').remove();    
}
</script>