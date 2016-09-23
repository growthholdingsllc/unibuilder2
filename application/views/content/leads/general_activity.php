<script>
   this.date_all = '<?php echo $date_all; ?>';   
   this.ckeditor = '<?php echo $ckeditor; ?>';   
   this.drop_upload = '<?php echo $drop_upload; ?>';   
</script>
<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?> 
      <!--<li class="active">Lead Details</li>-->
   </ol>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">         
         <div class="pull-right ">		             
            <button type="button" class="btn btn-default btn-secondary pull-right m-left-1">Save Schedule New Activity</button>
			<a href="<?php echo base_url();?>home/editlead"><button type="button" class="btn btn-default btn-secondary pull-right m-left-1">Save</button></a>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="tab-con pull-left">
         <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
               <li role="presentation" class="active">
                  <a href="#General" aria-controls="General-View" data-toggle="tab">General</a>
               </li>
               <li role="presentation">
                  <a href="#AttachEmail" aria-controls="Activities" data-toggle="tab">Attach an Email</a>
               </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane active" id="General">  
				   <div class="row">
                     <div class="col-xs-12">
						<table width="100%" class="table border-none">
							<tr>
								<td colspan="3" height="30">Type</td>								
							</tr>
							<tr>
								<td>
									<select class="selectpicker form-control">
										<option>Phone Call</option>                              
									</select>			   
								</td>
								<td><a href="javascript:void(0);" data-target="#TypeAddModal" data-toggle="modal"><img border="0" src="<?=$this->config->item("image_url");?>icon_plus1_1.png" alt="home"></a>&nbsp;<img border="0" src="<?=$this->config->item("image_url");?>icon_minus1_1.png" alt="home"></td>
								<td><input type="checkbox" /> Mark Complete</td>
							</tr>
							<tr>
								<td>Phone: 9663821255</td>
								<td colspan="2">Cell: 9663821255</td>								
							</tr>
							<tr>
								<td height="30">Employee</td>								
								<td height="30">Initiated by</td>								
								<td height="30">Schedule Follow up</td>								
							</tr>
							<tr>
								<td>
									<select class="selectpicker form-control">
										<option>John</option>                              
									</select>
								</td>								
								<td>
									<select class="selectpicker form-control">
										<option>Sales person</option>                              
									</select>
								</td>								
								<td>
								<div class='input-group date' id='datetimepicker5'>
									<input type='text' class="form-control" />
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
								</td>									
							</tr>
							<tr>
								<td height="30">Activate Date</td>
								<td>Remainder</td>
							</tr>
							<tr>
								<td height="30">
									<div class='input-group date' id='datetimepicker6'>
										<input type='text' class="form-control" />
										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</td>
								<td>
									<select class="selectpicker form-control">
										<option>None</option>                              
									</select>
								</td>
								<td><img border="0" src="<?=$this->config->item("image_url");?>icon_help1_1.png" alt="help"></td>
							</tr>
							<tr>
								<td colspan="3">
									<textarea class="ckeditor" name="editor"></textarea>
								</td>
							</tr>
						</table>
                     </div>
                   </div>
               </div>
               <div class="tab-pane" id="AttachEmail">
                  <div class="row">
                     <div class="col-xs-12">
						<table width="100%" class="table border-none">
							<tr>
								<td class="col-xs-3"><input type="radio"  name="name" value="notmail"/> Not an Email</td>
								<td class="col-xs-3"><input type="radio" name="name" value="mailoutlook"/> Email Using Outlook or Other</td>
								<td class="col-xs-3"><input type="radio"  name="name" value="composedmail"/> Email Composed Online</td>
							</tr>														
						</table>
                     </div>
					 
                   </div>
				   <div class="row mail-outlook-con">
					   <div class="col-xs-12">
					   <table width="100%" class="table border-none">
						<tr >
						<td colspan="3">Email & Log Activity &nbsp; <button class="btn btn-default btn-primary" type="button">Compose New Activity</button>&nbsp;<img border="0" src="<?=$this->config->item("image_url");?>icon_help1_1.png" alt="help"></td>
						</tr>
						</table>
					   </div>
				   </div>
				   <div class="row composedmail ">											
					<div class="col-xs-12 m-top">
						<div class="col-xs-2">Attachments</div>	
						<div class="col-xs-10">						
							<form action="<?=base_url()?>home/testupload" class="dropzone" id="my-awesome-dropzone"></form>						
						</div>									
					</div>																
					<div class="col-xs-12 m-top">
						<div class="col-xs-2">Subject</div>	
						<div class="col-xs-10"><input type="text" class="form-control"/></div>									
					</div>																
					<div class="col-xs-12 m-top">
						<div class="col-xs-2">body</div>	
						<div class="col-xs-10"><textarea class="ckeditor" name="editor" ></textarea></div>									
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
         <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="row">
               <div class="col-xs-12">
                  <h4>New Lead Acyivity Type</h4>
                  <div class="box-content panel-content">
                      <div class="row">                       
						 <div class="col-xs-12">                       
							<table width="100%" class="table border-none">
							<tr>
								<td height="30">Title</td>								
								<td>
									<input type="text" class="form-control" />
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