
<?php
//echo "<pre>"; print_r($result_data); exit;
?>
<div class="row">
  <ol class="breadcrumb">
    <?php //$this->load->view('common/breadcrumbs'); ?>
    <!--<li><a href="<?php echo base_url(); ?>Ymlkcy9pbmRleC8-">Bids</a></li>
    <li class="active">Edit Bid </li>-->
  </ol>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="top-search pull-right">
      <div class="pull-right col-xs-12">
       <a href="<?php echo base_url();?>Ymlkcy9iaWRfcmVxdWVzdF9saXN0">
       <button class="btn btn-gray pull-right m-left-1" type="button"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</button>
      </a>
	  <!--checking role access // by satheesh kumar -->
	  <?php 
	  if(isset($this->user_role_access[strtolower('bids')][strtolower('edit')]) && $this->user_role_access[strtolower('bids')][strtolower('edit')] == 1 && ($result_data['aaData'][0]['submitted'] == '' || $result_data['aaData'][0]['submitted'] == '0000-00-00 00:00:00'))
	  { 
			if(isset($this->project_status_check) && $this->project_status_check == 1)
			{
	  ?>
      <!--<button type="submit" class="btn btn-blue  pull-right m-left-1" id="add_task_new_back" name="add_task_new_back" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/>Save &amp; Back </button>
      <button type="submit" class="btn btn-blue  pull-right m-left-1" id="add_task_new" name="add_task_new" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/>Save &amp; New</button> -->
    
	  <button id="decline_bid" name="decline_bid" class="btn btn-blue pull-right m-left-1" type="button"><img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="save-stay" class="uni_save_and_stay">Declined</button>
	  <button id="add_task_new_stay" name="add_task_new_stay" class="btn btn-blue pull-right m-left-1" type="submit"><img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="save-stay" class="uni_save_and_stay">Submit Bid</button>
	  <?php 
			}
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
<form name="bid_request_save" id="bid_request_save" method="post">
<div class="row m-top">
  <div class="col-xs-12">
    <div class="panel panel-default logs-wrapper">
      <div class="panel-heading" role="tab" id="filter">
        <h4 class="panel-title">Checklist</h4>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-xs-12">
            <div class="col-xs-6">
              <div class="row">
                <div class="col-xs-12">
                  <div class="box-content panel-content">
                    <div class="row">
                      <div class="col-xs-6">
                        <label>Project : </label>

				
             <input type="hidden" name="pricing_format" id="pricing_format" value="<?php echo $result_data['aaData'][0]['pricing_format']?>">
             
					   <input type="hidden" name="project_name" value="<?php echo $result_data['aaData'][0]['project_name']; ?>">
                        <input type="hidden" name="ub_bid_id" id="ub_bid_id" value="<?php echo $result_data['aaData'][0]['ub_bid_id']; ?>"> 
                        <input type="hidden" name="project_id" id="project_id" value="<?php echo $result_data['aaData'][0]['project_id']; ?>" />
						
                       <input type="hidden" name="ub_bid_request_id" id="ub_bid_request_id" value="<?php echo $result_data['aaData'][0]['ub_bid_request_id']; ?>" />
					   <input type="hidden" name="package_name" id="package_name" value="<?php echo $result_data['aaData'][0]['package_title'] ; ?>" />
					   <input type="hidden" name="bid_amount" id="bid_amount" value="" />
					   <input type="hidden" name="save_type" id="save_type" value="" />
                      <span><?php echo $result_data['aaData'][0]['project_name'] ; ?></span> </div>
                      <div class="col-xs-6">
                        <label>Bid Package Name : </label>

						<input type="hidden" value="<?php echo $result_data['aaData'][0]['package_title'] ; ?>" name="package_title">

                        <span><?php echo $result_data['aaData'][0]['package_title'] ; ?></span> </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-6">
                        <label>Date of Request : </label>
                        <span><?php echo $result_data['aaData'][0]['released_date'] ; ?></span> </div>
                      <div class="col-xs-6">
                        <label>Deadline : </label>
                        <?php
                        if($result_data['aaData'][0]['due_date'])
                        {
                        echo $result_data['aaData'][0]['due_date'] ;
                        }
                        else
                        {
                        ?>
                        <span class="text-muted">Not Specified</span>
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <div class="panel-content pull-left">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                          <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Specifications <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span></a> </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <p><strong>Builder Description</strong></p>
                            <?php echo $result_data['aaData'][0]['description'] ; ?>
                            <div class="row">
                              <div class="col-xs-12">
                                <p><strong>Attached Files</strong></p>
								<!-- File upload list page -->
								 <input type="hidden" name="folder_id" id="folder_id" value="<?php echo isset($folder_id)?$folder_id:'' ?>" />
								<?php $this->load->view('common/uploaded_content.php');?>
                                <!--<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                                  <tr>
                                    <th>File Name</th>
                                    <th>Size</th>
                                  </tr>
                                  <tr>
<td>Catalouge.pdf</td>
                                    <td>253 KB</td>
                                  </tr>
                                  <tr>
                                    <td>machine.jpg</td>
                                    <td>5 KB</td>
                                  </tr>
                                </table>-->
<p><strong>Checklist</strong></p>
                                <div class="row">
                                  <div class="col-xs-4">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                                    <!--  <tr>
                                        <td><a href="#" data-toggle="modal" data-target="#Checklist_details">Checklist 1</a></td>
                                      </tr>
                                      <tr>
                                        <td><a href="#" data-toggle="modal" data-target="#Checklist_details">Checklist 2</a></td>
                                      </tr> -->

                                    <?php
                                         $count = count($result_data['checklist']);
									
if(count($result_data['checklist'][0]) >= 1)
                                         {
										 
                                         for($i=0;$i<$count;$i++)
                                           {
                                        ?>
                                <tr>
                                <td>
                                <a href="#" data-toggle="modal" data-target="#Checklist_details_<?php echo $result_data['checklist'][$i][0]['ub_checklist_id'] ; ?>" > <?php echo $result_data['checklist'][$i][0]['title'] ; ?> </a>
                                <div class="modal fade" id="Checklist_details_<?php echo $result_data['checklist'][$i][0]['ub_checklist_id'] ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Bids Checklist
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </h4>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <div class="modal-con">
              <div class="row">
                <div class="col-xs-12">
                  <label>Checklist:</label>
                  <p><?php echo $result_data['checklist'][$i][0]['title'] ; ?></p>
                </div>
                <div class="col-xs-12">
                  <label>Tags:</label>
                  <p><?php echo $result_data['checklist'][$i][0]['tags'] ; ?></p>
                </div>
                <div class="col-xs-12">
                  <label>Category:</label>
                  <p><?php echo $result_data['checklist'][$i][0]['category'] ; ?></p>
                </div>
                <div class="col-xs-12">
                  <label>Description:</label>
                  <?php echo $result_data['checklist'][$i][0]['checklist_desc'] ; ?>
                </div>
                <div class="col-xs-12">
                  <hr />
                </div>
                <div class="col-xs-12 m-top">
                  <label>File attachments:</label>
                  <!-- <p> <a href="#">sample.jpg</a> </p> -->
				  
				  <p> <?php 
				  foreach ($result_data['file'][$i] as $key=>$file)
				  {
            if(isset($file['system_file_name'])){
				  ?>
				  
				  <a href= "<?php echo DOC_URL.$file['system_file_name']?>" target="_blank"> <?php echo $file['ui_file_name'] ; ?> </a> <br/> 
				 <?php  
				  }}
				  ?> </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row m-top">
          <div class="col-xs-12"> <a class="closing_back pull-right" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Cancel" class="cancel_button"  data-dismiss="modal" > Close </a> </div>
        </div>
      </div>
    </div>
  </div>
</div>
                                </td>
                                </tr>
                                        <?php
										
                                        }
										
                                    }
                                        ?>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      
					<?php $this->load->view('content/bids/save_rfi'); ?>	
				  </div>
                 <div id='ve_view'>
					<?php $this->load->view('content/bids/save_ve'); ?>	
          


                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="row">
                <div class="col-xs-12">
                  <div class="box-content panel-content">
                    <p><strong>Are you planning to submit a bid?</strong></p>
					<?php if($result_data['aaData'][0]['will_bid'] == 'Unknown')
					{
					?>
                    <div class="text-right">
                      <button type="button" class="btn btn-blue" id="intrest_yes"><img border="0" class="uni_approve" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Yes</button>
                      <button type="button" class="btn btn-gray" id="intrest_no"><img border="0" class="uni_cancel_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> No</button>
                      <button type="button" class="btn btn-primary" id="intrest_maybe"><img border="0" class="uni_status_pending" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Maybe</button>
                    </div>
              
					<?php
					}
					else {
					?>
					<p class="text-right text -muted text-rfi">Replied <?php echo $result_data['aaData'][0]['will_bid'] . ',' . $result_data['aaData'][0]['viewed_on'] ; ?></p>
					<?php
					}
					?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <div class="panel-content pull-left">
                    <div class="panel-group" id="accordion-1" role="tablist" aria-multiselectable="true">
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                          <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-1" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> My Submission <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span></a> <span class="pull-right"><strong>Status : <?php echo $result_data['aaData'][0]['bid_sub_status'] ; ?> </strong></span> </h4>
						   <input type="hidden" name="ub_bid_sub_status" id="ub_bid_sub_status" value="<?php echo $result_data['aaData'][0]['bid_sub_status']; ?>" />
                        </div>
                        
                        <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <?php if($result_data['aaData'][0]['pricing_format'] == 'Flat Fee'){ ?>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">

                              <tr>
                              <td>Bid Amount</td>

                              <td>  
                              <div class="col-xs-12">
                              <div class="form-group">
                              <input type="text" name="flatt_fee_amount" id="flatt_fee_amount" class="form-control varian" placeholder="$" value="<?php if(isset($result_data['aaData'][0]['bid_amount'])) echo $result_data['aaData'][0]['bid_amount'];?>" > 
                              <span class="help-block"></span>
                              </div>
                              </div>
                              </td>
                              </tr>
                              </table>
                            <?php }else{ ?>
                            <div class="row">
                              <div class="col-xs-12">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                                  <tr>
                                    <th>Cost</th>
                                    <th>Description</th>
                                    <th>Bid Amount</th>
                                  </tr>
                                 <?php
                                $variance_count = count($result_data['variance']);
                                if(count($result_data['variance']) >= 1)
                                {
                                for($i=0;$i<$variance_count;$i++)
                                    {
                                 ?>
                                <tr>
                                <td>
                                <?php echo $result_data['variance'][$i]['cost_variance_code'] ; ?>
                                </td>
                                <td>
                                  <?php echo $result_data['variance'][$i]['cost_code_description'] ; ?>

								<input type="hidden" name="cost_code_description[]"  class="form-control description" placeholder="$" value=" <?php if(isset($result_data['variance'][$i]['cost_code_description'])){ echo $result_data['variance'][$i]['cost_code_description'] ; }?>" >
                               
                                </td>
                                <td class="col-xs-4">
									<div class="form-group">
									<input type="text" name="costcode[<?php echo $result_data['variance'][$i]['cost_code_id'] ; ?>]" id="textfield" class="form-control varian" placeholder="$" value="<?php if(isset($result_data['variance'][$i]['bid_amount'])) echo '$'.$result_data['variance'][$i]['bid_amount'] ; ?>" > 
									<span class="help-block"></span>
									</div>
								</td>
                                </tr>
                                <?php
                                    }
                                 }
                                ?>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>My Total Bid</td>
                                    <td>$<span id="total"> <?php echo $result_data['aaData'][0]['bid_amount'] ; ?></span></td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                            <?php } ?>
                            <div class="row">
                              <div class="col-xs-12">
                                <div class="row form-group">
								<label class="col-xs-12">File(s)</label>
                                  <?php $this->load->view('common/upload.php');?>
                                </div>
                                <!--<p><strong>Attached Files</strong></p>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                                  <tr>
                                    <th>File Name</th>
                                    <th>Size</th>
                                  </tr>
                                  <tr>
									<td>Catalouge.pdf</td>
                                    <td>253 KB</td>
                                  </tr>
                                  <tr>
                                    <td>machine.jpg</td>
                                    <td>5 KB</td>
                                  </tr>
                                </table>-->
                                <p><strong>Bid Details</strong></p>
                                <div class="row">
                                  <div class="col-xs-12">
                                    <textarea class="ckeditor" name="sub_notes" id="sub_notes">
									<?php echo $result_data['aaData'][0]['sub_notes'] ; ?>
									</textarea>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-xs-12">

                                    
                         
                                     <?php $this->load->view('content/bids/comment'); ?>
                         
                                  

                                    
                                   

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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</form>



<!-- Add RFI Modal -->
<div class="modal fade" id="addrfi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>RFI Details
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </h4>
      <div class="modal-body">
        <form name="rfi_save" id="rfi_save" method="post">
          <div class="row">
            <div class="col-xs-12">
              <div class="modal-con">
                <div class="row">
                  <div class="col-xs-12 form-group">
                    <div class="col-xs-4 text-right">
                      <label>Question :</label>
                    </div>
                    <div class="col-xs-8">
                    <div class="form-group">
                      <textarea name="question" id="question" cols="" rows="2" class="form-control"><?php if(isset($rfi_data['question'])) echo $rfi_data['question'] ?></textarea>                    
                    </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 form-group">
                    <div class="col-xs-4 text-right">
                      <label>Answer :</label>
                    </div>
                    <div class="col-xs-8">
                       <div class="form-group">
                      <textarea name="answer" id="answer" cols="" rows="2" class="form-control"><?php if(isset($rfi_data['answer'])) echo $rfi_data['answer'] ?></textarea>
                      <span class="error-mes text-danger"></span>
                     </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 form-group">
                    <div class="col-xs-4 text-right">
                      <label>Deadline :</label>
                    </div>
                    <div class="col-xs-8">
                      <div class='input-group date' id='datetimepicker6'>

                        <input type='text' name="deadline" id="deadline" class="form-control" value="<?php if(isset($rfi_data['deadline'])) echo date("m/d/Y", strtotime($rfi_data['deadline']));?>" />
                        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> </div>
                    </div>
                  </div>
                </div>
              <div class="row assign">
                  <div class="col-xs-12 form-group">
                    <div class="col-xs-4 text-right">
                      <label>Assign To :</label>
                    </div>
                    <div class="col-xs-8">
                      <input type="hidden" name="assign_to_ids" id="assign_to_ids" value="">
                      <input type="text" name="assigne_name" id="assigne_name" value="" readonly='readonly'>
                      
                      
                    </div>
                  </div>
                </div> 
                <div class="row">
                  <div class="col-xs-12 form-group">
                    <div class="col-xs-4 text-right">
                      <label>Visible To All Subs? :</label>
                    </div>
                    <div class="col-xs-8">
                      <input type="checkbox" name="visible_to_subs" id="visibile_to_subs" <?php if(isset($rfi_data['visible_to_subs']) && $rfi_data['visible_to_subs']==='Yes') echo  "checked='checked'";?>/>
                    </div>
                    <div class="col-xs-12 text-center">
                      <div class="col-xs-3">&nbsp;</div>
                      <div class="col-xs-9">
                        <p>&nbsp;</p>                      
						<button id="save-rfi" name='save-rfi' class="btn btn-blue pull-left" type="submit"> <img class="save_icon" src="<?php echo IMAGESRC.'strip.gif';?>"> Save RFI</button>
                        <a class="closing_back" href="javascript:void(0);" id="cancel-rfi"> <img border="0" src="<?php echo IMAGESRC.'strip.gif';?>" alt="cancel_button" class="cancel_button"> Cancel</a> </div>
						
                      <input type="hidden" name="ub_bid_rfi_ve_id" id="ub_bid_rfi_ve_id" >
                      <input type="hidden" name="question_by" id="question_by" >
					  <input type="hidden" name="project_name" value="<?php echo $result_data['aaData'][0]['project_name']; ?>">
                      <input type="hidden" name="ub_bid_id" id="ub_bid_id" value="<?php echo $result_data['aaData'][0]['ub_bid_id']; ?>"> 
                      <input type="hidden" name="project_id" value="<?php echo $result_data['aaData'][0]['project_id']; ?>" />
				      
                      <input type="hidden" name="ub_bid_request_id" id="ub_bid_request_id" value="<?php echo $result_data['aaData'][0]['ub_bid_request_id']; ?>" />
					   <input type="hidden" name="package_name" id="package_name" value="<?php echo $result_data['aaData'][0]['package_title'] ; ?>" />
					   <input type="hidden" class="form-control" name="package_title" id="package_title" value="<?php echo $result_data['aaData'][0]['package_title'];?>"/>
                    </div>
                  </div>
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
<!-- Add VE Modal-->
<div class="modal fade" id="addve" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>VE Details
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </h4>
      <div class="modal-body">
        <form name="ve_save" id="ve_save" method="post">
        <div class="row">
          <div class="col-xs-12">
            <div class="modal-con">
              <div class="row">
                <div class="col-xs-12 form-group">
                  <div class="col-xs-4 text-right">
                    <label>Question :</label>
                  </div>
                  <div class="col-xs-8">
					  <div class="form-group">
						<textarea name="ve_question" id="ve_question" cols="" rows="2" class="form-control"></textarea>
					  </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 form-group">
                  <div class="col-xs-4 text-right">
                    <label>Answer :</label>
                  </div>
                  <div class="col-xs-8">
                     <div class="form-group">
                    <textarea name="ve_answer" id="ve_answer" cols="" rows="2" class="form-control"></textarea>
                    <span class="error-mes text-danger"></span>
                  </div>
                  </div>
                </div>
              </div>
             <!--  <div class="row">
                <div class="col-xs-12 form-group">
                  <div class="col-xs-4 text-right">
                    <label>Deadline :</label>
                  </div>
                  <div class="col-xs-8">
                    <div class='input-group date' id='datetimepicker7'>
                      <input type='text' class="form-control" name="ve_deadline" id="ve_deadline" />
                      <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> </div>
                  </div>
                </div>
              </div> -->
              <div class="row assign">
                <div class="col-xs-12 form-group">
                  <div class="col-xs-4 text-right">
                    <label>Assign To :</label>
                  </div>
                  <div class="col-xs-8">
                    <input type="hidden" name="ve_assign_to_ids" id="ve_assign_to_ids" value="">
                    <input type="text" name="ve_assigne_name" id="ve_assigne_name" value="" readonly='readonly'>
                  </div>
                </div>
              </div> 
              <div class="row">
                <div class="col-xs-12 form-group">
                  <div class="col-xs-4 text-right">
                    <label>Visible To All Subs? :</label>
                  </div>
                  <div class="col-xs-8">
                    <input type="checkbox" name="ve_visible_to_subs" id="ve_visibile_to_subs"/>
                  </div>
                </div>
                <div class="col-xs-12 text-center">
                  <div class="col-xs-3">&nbsp;</div>
                  <div class="col-xs-9">
                    <p>&nbsp;</p>                    
					<button id="save-ve" name='save-ve' class="btn btn-blue pull-left" type="submit"> <img class="save_icon" src="<?php echo IMAGESRC.'strip.gif';?>"> Save VE</button>
                    <a class="closing_back" href="javascript:void(0);" id="cancel-ve"> <img border="0" src="<?php echo IMAGESRC.'strip.gif';?>" alt="cancel_button" class="cancel_button"> Cancel</a> </div>
                    <input type="hidden" name="rfi_ve_id" id="rfi_ve_id" >
                    <input type="hidden" name="ve_question_by" id="ve_question_by" >
					<input type="hidden" name="project_name" value="<?php echo $result_data['aaData'][0]['project_name']; ?>">
                        <input type="hidden" name="ub_bid_id" id="ub_bid_id" value="<?php echo $result_data['aaData'][0]['ub_bid_id']; ?>"> 
                        <input type="hidden" name="project_id" value="<?php echo $result_data['aaData'][0]['project_id']; ?>" />
						
                       <input type="hidden" name="ub_bid_request_id" id="ub_bid_request_id" value="<?php echo $result_data['aaData'][0]['ub_bid_request_id']; ?>" />
					   <input type="hidden" name="package_name" id="package_name" value="<?php echo $result_data['aaData'][0]['package_title'] ; ?>" />
					   <input type="hidden" class="form-control" name="package_title" id="package_title" value="<?php echo $result_data['aaData'][0]['package_title'];?>"/>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
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
	   <form name="form_comment" id="form_comment" method="post">
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
            <div class="modal-con">
			  <div class="col-xs-12">
			  <div class="form-group">
              <textarea class="form-control" id="comments" name="comments"></textarea>
			  </div>
			  </div>
              <p class="text-right">4000 Character Counter.</p>
              <!-- <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
                <tr>
                  <td width="33%" height="30">&nbsp;</td>
                  <td width="10">&nbsp;</td>
                  <td width="33%"><strong>Show?</strong></td>
                  <td width="33%"><strong>Notify?</strong></td>
                </tr>
             
                <tr>
                  <td height="30" align="right"><strong>Sub : </strong></td>
                  <td>&nbsp;</td>
                  <td><input type="checkbox"  id="sub" name="sub"></td>
                  <td class="sub-child"><input type="checkbox"  id="sub-child" name="sub_child"></td>
                  
                </tr>
              </table> -->
              <div class="row text-center">
                <button type="submit" class="btn btn-default btn-primary" id="post_comment">POST COMMENT</button>
                <button type="button" class="btn btn-default btn-primary" data-dismiss="modal">CANCEL</button>
				<input type="hidden" name="project_name" value="<?php echo $result_data['aaData'][0]['project_name']; ?>">
                        <input type="hidden" name="ub_bid_id" id="ub_bid_id" value="<?php echo $result_data['aaData'][0]['ub_bid_id']; ?>"> 
                        <input type="hidden" name="project_id" value="<?php echo $result_data['aaData'][0]['project_id']; ?>" />
						
                       <input type="hidden" name="ub_bid_request_id" id="ub_bid_request_id" value="<?php echo $result_data['aaData'][0]['ub_bid_request_id']; ?>" />
					   <input type="hidden" name="package_name" id="package_name" value="<?php echo $result_data['aaData'][0]['package_title'] ; ?>" />
					   <input type="hidden" class="form-control" name="package_title" id="package_title" value="<?php echo $result_data['aaData'][0]['package_title'];?>"/>
              </div>
            </div>
          </div>
        </div>
      </div>
	  </form>
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
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.jscrollpane.css';?>">	
<script type="text/javascript" src="<?php echo JSSRC.'enscroll-0.6.0.min.js';?>"></script>

<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/ckeditor.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/adapters/jquery.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'add_update_rfi_ve.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'comment.js';?>"></script>  
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'save_bids.js';?>"></script>


