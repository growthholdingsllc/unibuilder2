<script>    
   this.date_all     = '<?php echo $date_all; ?>';     
</script>
<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?> 
      <!--<li class="active">TO DO LIST</li>-->
   </ol>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
         <div class="pull-right ">        
            <button type="button" class="btn btn-default btn-primary pull-right m-left-1">Save &amp; New</button>
            <a href="<?php echo base_url();?>To-Do"><button type="button" class="btn btn-default btn-primary pull-right m-left-1">Save</button></a>
         </div>
      </div>
   </div>
</div>
<div class="row m-top">
   <div class="col-xs-12">
      <div class="panel panel-default">
         <div class="panel-heading" role="tab" id="filter">
            <h4 class="panel-title">New To-Do Details</h4>
         </div>
         <div class="panel-body">
            <div class="row panel-content">
               <div class="col-xs-6">
                  <input type="text" class="form-control" placeholder="Tag">
                  <textarea class="form-control m-top" placeholder="Type Note"></textarea>
                  <p class="pull-right">2500 charactor count</p>
                  <div class="row">
                     <div class="col-xs-12"> Remove checklist </div>
                  </div>
                  <div class="row">
                     <div class="col-xs-1">
                        <input type="checkbox" name="checkbox" id="checkbox"/>
                     </div>
                     <div class="col-xs-11">
                        <input type="text" class="form-control">
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xs-1">
                        <input type="checkbox" name="checkbox" id="checkbox"/>
                     </div>
                     <div class="col-xs-11">
                        <input type="text" class="form-control">
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xs-1">
                        <input type="checkbox" name="checkbox" id="checkbox"/>
                     </div>
                     <div class="col-xs-11">
                        <input type="text" class="form-control">
                     </div>
                  </div>
                  <div class="row">
                     <h4>Photos</h4>
                     <div class="col-xs-6 bor-upload">
                        <div class="btn btn-success btn-file"> <i class="glyphicon glyphicon-paperclip"></i> Choose File
                           <input type="file" name="attachment">
                        </div>
                     </div>
                     <div class="col-xs-6 bor-upload">
                        <div class="btn btn-success btn-file"> <i class="glyphicon glyphicon-paperclip"></i> Choose File
                           <input type="file" name="attachment">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xs-6">
                  <div class="row">
                     <div class="col-xs-12">
                        <label>Marked complete&nbsp;&nbsp;</label>
                        <input type="checkbox" name="checkbox" id="checkbox" checked />
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xs-4">
                        <label>Assigned To</label>
                        <select class="selectpicker form-control">
                           <option>-- All Assigned Users --</option>
                           <optgroup label="Internal Users">
                              <option>John</option>
                           </optgroup>
                           <optgroup label="Owners">
                              <option>Owner</option>
                           </optgroup>
                           <optgroup label="Subs">
                              <option>Metal Work</option>
                           </optgroup>
                        </select>
                     </div>
                     <div class="col-xs-4">
                        <label>Due Date</label>
                        <div class='input-group date' id='datetimepicker5'>
                           <input type="text" class="form-control">
                           <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
                        </div>
                     </div>
                     <div class="col-xs-4">
                        <label>&nbsp;</label>
                        <select class="selectpicker form-control">
                           <optgroup label="Internal Users">
                              <option>John</option>
                           </optgroup>
                           <optgroup label="Owners">
                              <option>Owner</option>
                           </optgroup>
                           <optgroup label="Subs">
                              <option>Metal Work</option>
                           </optgroup>
                        </select>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xs-4">
                        <label>Priority</label>
                        <select class="selectpicker form-control">
                           <option>None</option>
                           <option>Low</option>
                           <option>High</option>
                           <option>Highest</option>
                        </select>
                     </div>
                     <div class="col-xs-4">
                        <label>Tags</label>
                        <div class="input-group right-group">
                           <select class="selectpicker form-control" multiple >
                              <option>Bedroom</option>
                              <option>Kitchen</option>
                           </select>
                           <span  class="input-group-addon">
                           <a href="javascript:void(0);" data-target="#TypeAddModal" data-toggle="modal"><img alt="plus" src="<?=$this->config->item('image_url').'icon_plus1_1.png'?>" border="0"/></a> <img alt="minus" src="<?=$this->config->item('image_url').'icon_minus1_1.png'?>" border="0"/>
                           </span>
                        </div>
                     </div>
                     <div class="col-xs-4">
                        <label>Reminder</label>
                        <div class="input-group right-group">
                           <select class="selectpicker form-control" >
                              <option>None</option>
                              <option>1 hours</option>
                           </select>
                           <span class="input-group-addon">
                           <a href="javascript:void(0);" data-toggle="tooltip" title="The Reminder, when selected, will alert the assigned user prior to the due date/time of this item. Alerts will be sent to users via email (and text message if setup). Reminders are sent at 8am unless an hourly reminder is selected."><i class="glyphicon glyphicon-question-sign"></i></a>
                           </span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
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
         <h4>New Job Group <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <table width="100%" class="table border-none">
                              <tr>
                                 <td height="20">Title</td>
                                 <td>
                                    <input type="text" class="form-control" />
                                 </td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" class="btn btn-default btn-secondary pull-right">Save</button></td>
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