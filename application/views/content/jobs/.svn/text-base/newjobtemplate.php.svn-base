<script>  
   this.date_all = '<?php echo $date_all; ?>';   
</script>
<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?> 
      <!--<li class="active">New Job Template</li>-->
   </ol>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
         <div class="pull-right ">		                         
            <a href="<?php echo base_url();?>jobs"><button type="button" class="btn btn-default btn-secondary pull-right m-left-1">Save</button></a>
         </div>
      </div>
   </div>
</div>
<div class="row m-top">
   <div class="col-xs-12">
      <div class="panel panel-default">
         <div class="panel-heading" role="tab" id="filter">
            <h4 class="panel-title">New Jobsite Information</h4>
         </div>
         <div class="panel-body">
            <div class="row panel-content five-col">
               <div class="col-xs-3">
                  <label>Job Group</label>
				  <div class="input-group right-group">
                  <select class="selectpicker form-control" multiple>
                     <option>Apartment Type</option>
                  </select>
				  <span class="input-group-addon">
				  <a href="javascript:void(0);" data-target="#TypeAddModal" data-toggle="modal"><img alt="plus" src="<?=$this->config->item('image_url').'icon_plus1_1.png'?>" border="0"/></a> <img alt="minus" src="<?=$this->config->item('image_url').'icon_minus1_1.png'?>" border="0"/>
				  </span>
				  </div>
               </div>
               <div class="col-xs-3">
                  <label>New Job Name</label>
                  <input type="text" class="form-control"/>
               </div>
               <div class="col-xs-3">
                  <label>Source Template</label>
                  <select class="selectpicker form-control">
                     <option>John Working</option>
                     <option>Sample Job</option>
                  </select>
               </div>
               <div class="col-xs-3">
                  <label>New Start Date</label>
                  <div class='input-group date' id='datetimepicker8'>
                     <input type='text' class="form-control" />
                     <span class="input-group-addon">
                     <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                  </div>
               </div>
			   <div class="col-xs-3">
                  <p>&nbsp;</p>
                  <label>Turn Calendar Online? <input type="checkbox" /></label>
                  <span>
                  <a href="javascript:void(0);" data-toggle="tooltip" title="The Turn Calendar Online checkbox allows you to begin the job with the calendar already online. Notifications and reminders will be ACTIVE Scheduled Items & Tasks will be VISABLE to Subs and Owners if permitted"><i class="glyphicon glyphicon-question-sign"></i></a>
                  </span>
               </div>
            </div>
            <div class="row panel-content five-col">
               
               <div class="col-xs-9 checklist">
                  <p>Work Days</p>
                  <span>Sun <input type="checkbox"/></span>
                  <span>Mon <input type="checkbox" checked /></span>
                  <span>Tue <input type="checkbox" checked /></span>
                  <span>Wed <input type="checkbox" checked /></span>
                  <span>Thu <input type="checkbox" checked /></span>
                  <span>Fri <input type="checkbox" checked /></span>
                  <span>Sat <input type="checkbox"/></span>
                  <span>Document Folders (0) <input type="checkbox" checked /></span>
                  <span>Photo Albums (0) <input type="checkbox" checked /></span>
                  <span>To-Do (0) <input type="checkbox" checked /></span>
                  <span>Selections (0) <input type="checkbox" checked /></span>
               </div>
            </div>
            <div class="row panel-content">
               <div class="col-xs-9 checklist">
                  <p>What to Copy?</p>
                  <span>POs (0) <input type="checkbox" checked /></span>
                  <span>Include Scheduled Payments (0) <input type="checkbox" checked /></span>
                  <span>Estimates (0) <input type="checkbox" checked /></span>
                  <span>Bid Packages (0) <input type="checkbox" checked /></span>
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