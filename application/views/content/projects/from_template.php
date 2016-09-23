<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?>
      <!--<li class="active">New Project Template</li>-->
   </ol>
</div>
<form id="add_project_template" class="form-horizontal" method="post" name="add_project_template">
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
         <div class="pull-right ">                        
			
			<button type="submit" name="template_cancel" id="template_cancel" class="btn btn-gray pull-right m-left-1">
					<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel
			</button>			            			 
			
			<button type="submit" name="template_save_back" id="template_save_back" class="btn btn-blue pull-right m-left-1">
					<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back
			</button>					
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
            <h4 class="panel-title">New Projectsite Information</h4>
         </div>
         <div class="panel-body">
            <div class="row panel-content five-col">
              <div class="col-xs-3">
                <label>Project Group</label>
                  <div class="col-xs-12">
                    <div class="form-group">
                      <div class="col-xs">
                        <?php 
                           
                           echo form_dropdown('project_group[]', $project_group_array,'', "class='selectpicker form-control2' id='project_group' data-live-search='true' multiple");
                         ?>                          
                        <span class="right-group input-group-addon"><a href="javascript:void(0);" data-target="#TypeAddModal" data-toggle="modal"><img alt="plus" src="<?php echo IMAGESRC.'icon_plus1_1.png'?>" border="0"/></a> <a href="javascript:void(0);" class="TypeEditModal"><img alt="minus" src="<?php echo IMAGESRC.'icon_minus1_1.png'?>" border="0"/></a></span> 
                      </div>
                     </div>
                    </div>
                  </div>
               <div class="col-xs-3">
                  <label>New Project Name</label>
                    <div class="col-xs-12">
                      <div class="form-group">
                        <input type="text" class="form-control" name="project_name" id="project_name"/>
                     </div>
                    </div>
               </div>
               <div class="col-xs-3">
                  <label>Source Template</label>
                     <div class="col-xs-12">
                            <div class="form-group">
                     <?php 
                     if(isset($template_list)){

                           echo form_dropdown('template_id', $template_list, '', "class='selectpicker form-control' id='template_id' data-live-search='true'");
                        }
                        else
                        {
                           $template_list = array();
                           echo form_dropdown('template_id', $template_list, '', "class='selectpicker form-control' id='template_id' data-live-search='true'");
                        }
                         ?>
                      </div>
                   </div>
               </div>
               <div class="col-xs-3">
                  <label>New Start Date</label>
				  <div class="col-xs-12">
					  <div class="form-group">
						  <div class='input-group date' id='datetimepicker8'>
							 <input type='text' class="form-control" name="projected_start_date" id="projected_start_date" />
							 <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
						  </div>
					  </div>
                  </div>
               </div>
               <div class="col-xs-3">
                  <p>&nbsp;</p>
                  <label>Turn Calendar Online?
                  <input type="checkbox" />
                  </label>                 
               </div>
            </div>
            <div class="row panel-content five-col">
               <div class="col-xs-9 checklist">
                  <label>Work Days</label>
                  <div>
                     <span>Mon
                        <input name="work_days[]" value="0" type="checkbox" checked/>
                     </span>
                      <span>Tue
                        <input name="work_days[]" value="1" type="checkbox" checked/>
                     </span>
                      <span>Wed
                        <input name="work_days[]" value="2" type="checkbox" checked/>
                     </span>
                      <span>Thu
                        <input name="work_days[]" value="3" type="checkbox" checked/>
                     </span>
                      <span>Fri
                        <input name="work_days[]" value="4" type="checkbox" checked/>
                     </span>
                      <span>Sat
                        <input name="work_days[]" value="5" type="checkbox" checked/>
                     </span>
                      <span>Sun
                        <input name="work_days[]" value="6" type="checkbox" checked/>
                     </span>   
                  </div>
               </div>
            </div>
            <div class="row panel-content">
               <div class="col-xs-9 checklist">
                  <label>What to Copy?</label>
                  <div>
                     <?php foreach($template_modules_array as $key=>$module_name) { ?>
                      <span><input type="checkbox" name="<?php echo $module_name['varchar01'] ?>" id="" /> <?php echo $module_name['varchar01'] ?></span>
                     <?php } ?>
                     
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
                                 <td><input type="text" id="new_project_group" class="form-control" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" id="project_group_save" class="btn btn-default btn-secondary pull-right">Save</button></td>
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
                                 <td><input type="text" id="edit_project_group" class="form-control" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2">
                                    <button type="button" id="project_group_delete" class="btn btn-default btn-secondary pull-right">Delete</button>					 
                                    <!-- <button type="button" id="Edit_project" class="btn btn-default btn-secondary pull-right">Save</button> -->
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
</form>
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'from_template.js';?>"></script> 