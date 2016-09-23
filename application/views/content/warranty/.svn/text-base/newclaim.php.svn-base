<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?> 
      <!--<li class="active">Warranty</li>-->
   </ol>
</div>
<form id="add_new_claim" class="form-horizontal" method="post" name="add_new_claim">
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
         <div class="pull-right ">
            <div class="action-btn">
               <a href="javascript:void(0);"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_stay" id="uni_save_stay"/></a>
               <a href="javascript:void(0);"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_New" id="uni_save_new"/></a>
               <a href="javascript:void(0);"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_back" id="uni_save_back"/></a>
               <a href="javascript:void(0);"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel" id="uni_cancel"/></a>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="tab-con pull-left">
         <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist" id="warrantyinfotab">
               <li role="presentation" class="active">
                  <a href="#Basic-Info" aria-controls="Basic-Info" data-toggle="tab" class="warranty-tab">Basic Info</a>
               </li>
               <li role="presentation">
                  <a href="#Assigned-Info" aria-controls="Assigned-Info" data-toggle="tab" class="warranty-tab">Assigned Info</a>
               </li>
               <li role="presentation">
                  <a href="#Appointments" aria-controls="Appointments" data-toggle="tab">Appointments</a>
               </li>
               <li role="presentation">
                  <a href="#Files-Pictures" aria-controls="Files-Pictures" data-toggle="tab">Files &amp; Pictures</a>
               </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane active" id="Basic-Info">
                  <div class="row">
                     <div class="col-xs-3">
                        <label>Project</label>
						<?php 
                  $project_selected = '';
               
                  echo form_dropdown('project_id', $project_list, $project_selected, "class='selectpicker form-control' id='project_id' data-live-search='true'"); 
               
                  ?>
                     </div>
					 <div class="col-xs-3">
					 <p>&nbsp;</p>
                        <label>Added By:</label> <span>Owner</span>
                     </div>
                  </div>
                  <div class="row m-top">
                     <div class="col-xs-4">
                        <label>Title</label>
                        <input type="text" class="form-control" />
                     </div>
                     <div class="col-xs-4">
                        <label>Category</label>
                        <div class="input-group right-group">
                           <select class="selectpicker form-control" id="pro-group" data-live-search="true" multiple>
                              <option>Option1</option>
                           </select>
                           <span class="input-group-addon">
                           <a href="javascript:void(0);" data-target="#TypeAddModal" data-toggle="modal">
                           <img alt="plus" src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>" border="0"/>
                           </a> 
                           <a href="javascript:void(0);" class="TypeEditModal">
                           <img alt="minus" src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>" border="0"/>
                           </a>
                           </span> 
                        </div>
                     </div>
                     <div class="col-xs-4">
                        <label>Priority</label>
                        <select class="form-control selectpicker">
                           <option>Low</option>
                        </select>
                     </div>
                  </div>
                  <div class="row m-top">
                     <div class="col-xs-12">
                        <label>Description of Problem</label>
                        <textarea class="form-control"></textarea>
                     </div>
                  </div>
                  <div class="row m-top">
                     <div class="col-xs-12">
                        <label>Internal Comments</label>
                        <textarea class="form-control"></textarea>
                     </div>
                  </div>
               </div>
               <div class="tab-pane" id="Assigned-Info">
                  <div class="row">
                     <div class="col-xs-3">
                        <!-- Service Coordinator -->
                        <div id="load_service_coordinator_div">
							   <?php $this->load->view('content/warranty/builder_user_dropdown'); ?>
						      </div>
                     </div>
                     <div class="col-xs-3">
                        <label>Classification</label>
                        <select class="form-control selectpicker">
                           <option>Nothing selected</option>
                        </select>
                     </div>
                     <div class="col-xs-3">
                        <!-- Orig. Item/User -->
                        <div id="load_service_coordinator_div">
                        <?php $this->load->view('content/warranty/subcontractor_dropdown'); ?>
                        </div>
                     </div>
                     <div class="col-xs-3">
                        <p>&nbsp;</p>
                        <p>Show Owner? <input type="checkbox" /></p>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xs-3">
                        <label>Added Cost</label>
                        <div class="input-group"> 
                           <span class="input-group-addon"> <i class="glyphicon dollar"></i> </span>
                           <input type="text" class="form-control" />
                        </div>
                     </div>
                     <div class="col-xs-3">
                        <label>Follow-Up Date</label>
                        <div id="datetimepicker5" class="input-group date">
                           <input type="text" class="form-control" value="" id="projected_start_date" name="projected_start_date">
                           <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane" id="Appointments">
                  <div class="row">
                     <div class="col-xs-12">
                        <div class="pull-left">
                           <div class="action-btn">
                              <a href="javascript:void(0);" id="schedule_service" class="sprite">
                              <img class="schedule-add" src="<?php echo IMAGESRC.'strip.gif'; ?>">
                              Schedule Service Appoinment
                              </a>
                              <a href="javascript:void(0);" class="schedule_save"><img src="<?php echo IMAGESRC.'save.png'; ?>" class="uni_send"/></a>
                              <a href="javascript:void(0);"  class="schedule_cancel"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel"/></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row m-top">
                     <div class="col-xs-12 service-con">
                        <div class="curve-box">
                           <div class="row">
                              <div class="col-xs-12">
                                 <div class="col-xs-4">
                                    <label>Servicing Sub</label>
                                    <select class="form-control selectpicker">
                                       <option value="">Nothing selected</option>
                                    </select>
                                 </div>
                                 <div class="col-xs-4">
                                    <label>Servicing on</label>
									<div id="datetimepicker6" class="input-group date">
										<input type="text" class="form-control" value="" id="projected_start_date" name="projected_start_date">
										<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
									</div>
                                 </div>
                                 <div class="col-xs-4">
                                   <div class="col-xs-6">
								    <label>From</label>
                                    <div id="task-time" class="input-group date">
									   <input type="text" class="form-control" value="" id="projected_start_date" name="projected_start_date">
									   <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span> 
									</div>
								   </div>								   
                                   <div class="col-xs-6">						
								    <label>To</label>
                                   <div id="schedule-time" class="input-group date">
									   <input type="text" class="form-control" value="" id="projected_start_date" name="projected_start_date">
									   <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span> 
									</div>	
								   </div>								   
                                 </div>
                              </div>
                           </div>
                           <div class="row m-top">
                              <div class="col-xs-12">
                                 <div class="col-xs-4">
                                    <label>Notes to Sub</label>
                                    <textarea class="form-control"></textarea>
                                 </div>
                                 <div class="col-xs-4">
                                    <label>Internal Appointment Notes</label>
                                    <textarea class="form-control"></textarea>
                                 </div>
                                 <div class="col-xs-4 request-accept">
                                    <p>&nbsp;</p>
                                    <p><input type="checkbox" /> Request Sub to Accept Appoinment</p>
                                    <p><input type="checkbox" /> Request Owner to Accept Appoinment</p>
                                 </div>
                                 <div class="col-xs-4 save-request-accept">
                                    <p>&nbsp;</p>
                                    <p><img src="<?php echo IMAGESRC.'sub.png'; ?>"/> Accepted</p>
                                    <p><img src="<?php echo IMAGESRC.'owner.png'; ?>"/> <span class="text-danger">Not Accepted</span></p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-12 save-service-con">
                        <div class="curve-box">
                           <div class="row">
                              <div class="col-xs-12">
                                 <div class="col-xs-6">
                                    <h4>Final Work Approval</h4>
                                 </div>
                              </div>
                              <div class="col-xs-12">
                                 <div class="col-xs-4">
                                    <label>Feedback</label>
                                    <select class="form-control selectpicker">
                                       <option value="">Nothing selected</option>
                                    </select>
                                 </div>
                                 <div class="col-xs-4">
                                    <p>&nbsp;</p>
                                    <p><input type="checkbox"/> Override Feedback</p>
                                 </div>
                                 <div class="col-xs-4">
                                    <label>Approval Comments</label>
                                    <textarea class="form-control"></textarea>
                                 </div>
                              </div>
                              <div class="col-xs-12">
                                 <div class="col-xs-4">
                                    <label>Completion Date</label>
                                    <div id="datetimepicker12" class="input-group date">
									   <input type="text" class="form-control" value="" id="projected_start_date" name="projected_start_date">
									   <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
									</div>
                                 </div>
                                 <div class="col-xs-4">
                                    <label>Feedback Left On</label>
                                    <p>15/04/2015 11:00 am</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xs-6">
                        <p><span class="pull-right"><a href="#" class="comment-image"><img alt="home" src="<?php echo IMAGESRC.'comment-add.png'; ?>" border="0"/></a></span></p>
                        <label>Discussions</label>
                        <div class="jumbotron">
                           <div class="inner-jumbotron">
                              <div class="alert alert-info" role="alert">
                                 <div class="row">
                                    <div class="col-xs-11">
                                       <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                       <p class="text-muted">- Gibson on 28-01-2015</p>
                                    </div>
                                    <div class="col-xs-1">
                                       <p><a href="#"> <img src="<?php echo IMAGESRC.'sub.png'; ?>"></a></p>
                                       <p><a href="#"> <img src="<?php echo IMAGESRC.'owner.png'; ?>"></a></p>
                                       <p><a href="#"> <img src="<?php echo IMAGESRC.'delete.png'; ?>"></a></p>
                                    </div>
                                 </div>
                              </div>
                              <div class="alert alert-warning" role="alert">
                                 <div class="row">
                                    <div class="col-xs-11">
                                       <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                       <p class="text-muted">- Gibson on 28-01-2015</p>
                                    </div>
                                    <div class="col-xs-1">
                                       <p><a href="#"> <img src="<?php echo IMAGESRC.'sub.png'; ?>"></a></p>
                                       <p><a href="#"> <img src="<?php echo IMAGESRC.'owner.png'; ?>"></a></p>
                                       <p><a href="#"> <img src="<?php echo IMAGESRC.'delete.png'; ?>"></a></p>
                                    </div>
                                 </div>
                              </div>
                              <div class="alert alert-success" role="alert">
                                 <div class="row">
                                    <div class="col-xs-11">
                                       <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                       <p class="text-muted">- Gibson on 28-01-2015</p>
                                    </div>
                                    <div class="col-xs-1">
                                       <p><a href="#"> <img src="<?php echo IMAGESRC.'sub.png'; ?>"></a></p>
                                       <p><a href="#"> <img src="<?php echo IMAGESRC.'owner.png'; ?>"></a></p>
                                       <p><a href="#"> <img src="<?php echo IMAGESRC.'delete.png'; ?>"></a></p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <p class="text-center">
                              <button class="btn btn-default btn-success" type="button" data-toggle="modal" data-target="#commentModal">Add Comment</button>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane" id="Files-Pictures">
                  <div class="row">
                     <div class="col-xs-8">
                        <table class="table table-bordered datatable" id="new_claim_files"></table>
                     </div>
                     <div class="col-xs-4">
                        <div class="row">
                           <div class="col-xs-12">
                              <p class="text-primary"><a href="javascript:void(0);" class="text-primary" data-target="#docs_upload_Modal" data-toggle="modal"><u>Click Here</u></a>  to Choose from Unibuilder docs</p>
                              <div id="actions"> <span class="fileinput-button"></span> </div>
                           </div>
                           <div class="col-xs-12 m-top files" id="previews">
                              <div id="template" class="file-row">
                                 <ul>
                                    <li>
                                       <div class="preview"><img data-dz-thumbnail /></div>
                                       <div class="name" data-dz-name></div>
                                       <div class="close-btn"> <img alt="close" class="delete" data-dz-remove src="<?php echo IMAGESRC.'upload_close.png'; ?>" border="0"/> </div>
                                       <strong class="error text-danger" data-dz-errormessage></strong>
                                       <div class="size" data-dz-size></div>
                                       <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                       </div>
                                       <div class="button">
                                          <button class="btn btn-success start"> <i class="glyphicon glyphicon-upload"></i> <span>Upload</span> </button>
                                          <button data-dz-remove class="btn btn-warning cancel"> <i class="glyphicon glyphicon-ban-circle"></i> <span>Cancel</span> </button>
                                       </div>
                                    </li>
                                 </ul>
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
</div>
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
              <textarea class="form-control"></textarea>
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
                  <td><input type="checkbox" name="checkbox" id="owner">
                    <label for="checkbox"></label></td>
                  <td class="owner-child"><input type="checkbox" name="checkbox" id="owner-child"></td>
                </tr>
                <tr>
                  <td height="30" align="right"><strong>Sub : </strong></td>
                  <td>&nbsp;</td>
                  <td><input type="checkbox" name="checkbox2" id="sub"></td>
                  <td class="sub-child"><input type="checkbox" name="checkbox" id="sub-child"></td>
                </tr>
              </table>
              <div class="row text-center">
                <button type="button" class="btn btn-default btn-primary">POST COMMENT</button>
                <button type="button" class="btn btn-default btn-primary" data-dismiss="modal">CANCEL</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
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
                                 <td><input type="text" id="project_group" class="form-control" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" id="save" class="btn btn-default btn-secondary pull-right">Save</button></td>
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
                                 <td><input type="text" id="Edit_project_group" class="form-control" /><input type="hidden" id="selected" class="form-control"  /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2">
                                    <button type="button" id="Delete_project" class="btn btn-default btn-secondary pull-right">Delete</button>					 
                                    <button type="button" id="Edit_project" class="btn btn-default btn-secondary pull-right" >Save</button>
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
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.mCustomScrollbar.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'file-tree.min.css';?>">
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'icheck.min.js';?>"></script>
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.mCustomScrollbar.concat.min.js';?>"></script>
<script src="<?php echo JSSRC.'Multi_Upload.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'upload.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.mjs.nestedSortable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'file-tree.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'new_warranty.js';?>"></script>