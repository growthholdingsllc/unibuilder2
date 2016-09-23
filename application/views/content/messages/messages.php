<div class="row">
   <ol class="breadcrumb">
	  <?php //$this->load->view('common/breadcrumbs'); ?>
      <!--<li class="active">Messages</li>-->
   </ol>
</div>
<div class="row m-top">
	  <div class="col-xs-12 error-message uni_message">
		 <div class="alerts alert-danger"></div>
	   </div>
</div>
<form id="ub_messages" class="form-horizontal" method="post" name="ub_messages">
   <input type="hidden" name="current_folder_id" id="current_folder_id" value="<?php echo INBOX;?>" />
   <input type="hidden" name="current_page_id" id="current_page_id" value=0 />
   <input type="hidden" name="ub_message_id" id="ub_message_id" value=0 />
   <input type="hidden" name="msg_is_read" id="msg_is_read" value="" />
   <input type="hidden" name="compose_id" id="compose_id" value=0 />
   <input type="hidden" name="saveas_draft" id="saveas_draft" value=0 />
   <input type="hidden" name="message_action" id="message_action" value="" />
   <div class="row <?php if($this->project_id == ''){ echo 'no_project_selected'; } ?>">
      <div class="col-xs-12">
         <div class="panel-content pull-left">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
               <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="filter">
                     <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> FILTER ALL YOUR ACTIONS &nbsp;&nbsp; <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span> </a> </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
                     <div class="panel-body col-xs-12">
                        <div class="row five-col">
                           <div class="col-xs-3 comments_filt">
                              <label>Filter By</label>
                              <?php
                                 $module_name_selected = '';
                                 if(isset($search_session_array['module_name']))
                                 {
                                    $module_name_selected = explode(",",$search_session_array['module_name']);
                                 }
                                 echo form_dropdown('module_names', $module_name_dropdown, $module_name_selected, "class='selectpicker form-control' id='module_names' data-live-search='true'"); 
                                 ?>
                           </div>
                           <!-- <div class="col-xs-3 comments_filt">
                              <label>Project</label>
                              <select class="selectpicker form-control">
                                 <option>Project 1</option>
                                 <option>Project 2</option>
                                 <option>Project 3</option>
                              </select>
                              </div> -->
						<div class="col-xs-3 notify_filt">
						<label>Notification sent to</label>
						<input type="text" class="form-control" id='primary_email' value="<?php echo isset($search_session_array['primary_email'])?$search_session_array['primary_email']:''; ?>" />
						</div>
                           <div class="col-xs-3 date_filt">
                              <label>Date Range</label>
								 <div class="input-prepend input-group">
									 <input type="text" name="daterange" id="daterange" class="form-control" value="<?php echo isset($search_session_array['daterange'])?$search_session_array['daterange']:''; ?>" readonly />
									 <span class="input-group-addon"> <span class="glyphicon-calendar glyphicon daterange"></span></span> 
								  </div>
								</div>
					
                           <div class="col-xs-3 notify_filt">
                              <label>Type</label>
                         <?php 
						$type_selected = '';
						if(isset($search_session_array['type']))
						{
						$type_selected = $search_session_array['type'];
						}
						echo form_dropdown('type[]', $type_list, $type_selected, "class='selectpicker form-control' id='type' data-live-search='true' multiple"); 
						?>
						 <!--	search code from line 74 to 82 added by Gayathri.-->  	
                           </div>
						 <div class="col-xs-3 mes-filt">
							<label>Name</label>
							<input type="text" class="form-control" name="user_name_filter" id='user_name_filter' value="" />
						</div> 
						<div class="col-xs-3 mes-filt">
							<label>E-mail Address</label>
							<input type="text" class="form-control" name="email_address_filter" id='email_address_filter' value="" />
						</div>	 
						   
                        </div>
                        <div class="row text-center update-result">
                           <button type="submit" class="btn btn-blue mess_act" id="message_filter">Update Results</button>
                           <button type="button" class="btn btn-gray mess_act" id="message_reset">Reset</button>
                           <button type="button" class="btn btn-gray mess_act_none" id="save_filter">Save Filter</button>
                           <?php if($apply_filter == TRUE){ ?>
                           <button type="button" class="btn btn-gray mess_act_none" id="apply_save_filter" name="apply_save_filter">Apply Saved Filter</button>
                           <?php } else{ ?>
                           <a href="javascript:void(0);"><button type="button" class="btn btn-gray mess_act_none" id="apply_save_filter" name="apply_save_filter" style="display:none;" >Apply Saved Filter</button></a>
                           <?php } ?>
                           <!-- <button type="button" class="btn btn-default btn-primary mess_act_none">Save Filter</button>
                              <button type="button" class="btn btn-default btn-primary mess_act_none">Apply Saved Filter</button>  -->                      
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="tab-con col-xs-12 pull-left">
         <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
               <li role="presentation" class="active"> <a href="#messages" aria-controls="messages" data-toggle="tab">Messages</a> </li>
               <li role="presentation"> <a href="#comments"  aria-controls="comments" data-toggle="tab">Comments</a> </li>
				<?php 
				if(isset($this->user_account_type) && $this->user_account_type == BUILDERADMIN)
				{
				?>
               <li role="presentation"> <a href="#notfication" aria-controls="notfication" data-toggle="tab">Notfication History</a> </li>
				<?php 
				}
				?>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <!-- MAIL LIST BOX BEGIN -->
               <div class="tab-pane active message_display" id="messages">
               </div>
               <!-- MAIL LIST BOX END -->
               <div class="tab-pane" id="comments">
                  <div class="row">
                     <div class="col-xs-12">
                        <table class="table table-bordered datatable" id="comments_list">
                           <thead>
                              <tr>
                                 <th>Date</th>
                                 <th>Owner</th>
                                 <th>Builder</th>
                                 <th>Subs</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
			   <?php 
				if(isset($this->user_account_type) && $this->user_account_type == BUILDERADMIN)
				{
				?>
               <div class="tab-pane" id="notfication">
                  <table class="table table-bordered datatable" id="Notfication_List">
                     <thead>
                        <tr>
                           <th>To</th>
                           <th>Type</th>
                           <th>Subject</th>
                           <th>Project</th>
                           <th>Date</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>
               <!--checking role access  // by satheesh -->
				<?php 
				}
				?>
            </div>
         </div>
      </div>
   </div>
</form>
<!-- /Check List Modal -->
<!-- Comment Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Post Your Comment
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row m-top">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <form name="posting_comments" id="posting_comments" method="post">
                        <input type="hidden" name="project_name" id="project_name">
                        <input type="hidden" name="module_pk_id" id="module_pk_id">
                        <input type="hidden" name="module_name" id="module_name">
						<div class="col-xs-12">
							<div class="form-group">
								<textarea class="form-control" name="comments" id="comments_txt"></textarea>
							</div>
						</div>
                        <p class="text-right">4000 Character Counter.</p>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
                           <tr>
                              <td width="33%" height="30">&nbsp;</td>
                              <td width="10">&nbsp;</td>
                              <td width="33%"><strong>Show?</strong></td>
                              <td width="33%"><strong>Notify?</strong></td>
                           </tr>
                           <tr>
                              <td height="30" align="right"><strong>Owner : </strong></td>
                              <td>&nbsp;</td>
                              <td><input type="checkbox" name="show_sub" id="owner">
                                 <label for="checkbox"></label>
                              </td>
                              <td class="owner-child"><input type="checkbox" name="owner_notify" id="owner-child"></td>
                           </tr>
                           <tr>
                              <td height="30" align="right"><strong>Sub : </strong></td>
                              <td>&nbsp;</td>
                              <td><input type="checkbox" name="show_owner" id="sub"></td>
                              <td class="sub-child"><input type="checkbox" name="sub_notify" id="sub-child"></td>
                           </tr>
                        </table>
                        <div class="row text-center">
                           <button type="submit" class="btn btn-gray" id="post_comment">POST COMMENT</button>
                           <button type="button" class="btn btn-gray" data-dismiss="modal">CANCEL</button>
                        </div>
                     </form>
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
                  <button onclick="copy_file_to_temp()" type="button" class="btn btn-success">Upload</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<input type="hidden" name="message_index" id="message_index" value="" />
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
   this.list_page   = 'yes';   
</script>
<link rel="stylesheet" href="<?php echo CSSSRC.'daterangepicker-bs3.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-tagsinput.css';?>" />
<link rel="stylesheet" href="<?php echo CSSSRC.'file-tree.min.css';?>">
<script src="<?php echo JSSRC.'jquery-ui-message.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-tagsinput.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'date_moment.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'daterangepicker.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/ckeditor.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/adapters/jquery.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'jquery.mjs.nestedSortable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'file-tree.min.js';?>"></script>
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.jscrollpane.css';?>">	
<script type="text/javascript" src="<?php echo JSSRC.'enscroll-0.6.0.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'messages.js';?>"></script>