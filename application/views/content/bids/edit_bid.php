<?php //print_r($bid_request_data);exit; ?>
<div class="row">
  <ol class="breadcrumb">
    <?php //$this->load->view('common/breadcrumbs'); ?>
    <!--<li><a href="<?php echo base_url(); ?>Ymlkcy9pbmRleC8-">Bids</a></li>
    <li class="active">Edit Bid </li>-->
  </ol>
</div>
<form id="edit_bid" class="form-horizontal" method="post" name="edit_bid">
<div class="row">
  <div class="col-xs-12">
    <div class="top-search pull-right">
      <div class="pull-right col-xs-12"> 
	  <button class="btn btn-gray pull-right m-left-1" type="submit" id="btncancel">
		<img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel
	  </button>
    <?php if($bid_request_data['bid_sub_status'] != 'Declined' && $bid_request_data['bid_sub_status'] != 'Submitted' && $bid_request_data['bid_sub_status'] != 'Accepted' && $bid_request_data['bid_sub_status'] != 'Rejected' && $bid_request_data['status'] == 'Released'){ ?>
    <button id="add_task_new_stay" name="add_task_new_stay" class="btn btn-blue pull-right m-left-1" type="submit"><img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="save-stay" class="uni_save_and_stay">Submit Bid</button>
    <?php }  ?>
	   <?php 
     if($multiple_bids['allow_multi_bids'] == 'Yes' || $number_of_accepted_bid['ub_bid_request_id'] == 0) {
		if(isset($this->project_status_check) && $this->project_status_check == 1)
		{
      if($bid_request_data['bid_sub_status'] == 'Submitted'){
	   ?>
		<a class="closing_back pull-right" href="javascript:void(0);" id="bid_reject"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Cancel" class="uni_cancel_new"> Reject </a>	  
		<a class="sprite pull-right" href="javascript:void(0);" id="bid_accept"><img border="0" class="uni_approved" alt="Add RFI" src="<?php echo IMAGESRC.'strip.gif'; ?>">&nbsp;Accept</a> 
	  <?php 
		}}}
    if($bid_request_data['bid_sub_status'] == 'Accepted' && (!isset($po_status_result['po_status']) || (isset($po_status_result['po_status']) && $po_status_result['po_status'] == 'Not Released')))
    {
    ?>
      <a class="closing_back pull-right" href="javascript:void(0);" id="bid_reject"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Cancel" class="uni_cancel_new"> Reject </a>
      
    <?php }
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
    <div class="row">
          <div class="col-xs-12">
            <div class="col-xs-6">              
              <div class="row">
                <div class="col-xs-12">
                  <input type="hidden" value="<?php echo $bid_request_data['sub_contractor_id'] ?>" name="sub_contractor_id" id="sub_contractor_id">
                  <input type="hidden" value="<?php echo $ub_bid_id ?>" name="ub_bid_id" id="ub_bid_id">
                  <input type="hidden" value="<?php echo $bid_request_data['ub_bid_id'] ?>" name="bid_id" id="bid_id">
                  <input type="hidden" value="<?php echo $bid_request_data['project_name'] ?>" name="project_name">
                  <input type="hidden" value="<?php echo $bid_request_data['package_title'] ?>" name="package_name">
                  <input type="hidden" value="<?php echo $bid_request_data['ub_bid_request_id'] ?>" name="ub_bid_request_id" id="ub_bid_request_id">
                  <input type="hidden" value="<?php echo $bid_request_data['bid_amount'] ?>" name="bid_amount" id="bid_amount">
                   <input type="hidden" value="<?php echo $bid_request_data['description'] ?>" name="bid_description" id="bid_description">
                  <input type="hidden" name="project_id" id="project_id" value="<?php echo $bid_request_data['project_id']?>">
                  <input type="hidden" value="" name="bid_sub_status" id="bid_sub_status">
                  <input type="hidden" name="save_type" id="save_type" value="" />

                  <input type="hidden" name="pricing_format" id="pricing_format" value="<?php echo $bid_request_data['pricing_format']?>">
					<p><strong>Sub Contractor Details</strong></p>
					<div class="box-content panel-content">						
						<div class="row">
                <div class="col-xs-6">
                  <div class="row form-group">
                    <div class="col-xs-5 text-right">
                      <label>Title : </label>
                    </div>
                    <div class="col-xs-7"><?php echo $bid_request_data['package_title'] ?></div>
                  </div>
                  <div class="row form-group">
                    <div class="col-xs-5 text-right">
                      <label>Project Name : </label>
                    </div>
                    <div class="col-xs-7"><?php echo $bid_request_data['project_name'] ?></div>
                  </div>
                  <div class="row form-group">
                    <div class="col-xs-5 text-right">
                      <label>Will Bid? : </label>
                    </div>
                    <div class="col-xs-7"><?php echo $bid_request_data['will_bid'] ?></div>
                  </div>
                  <!-- <div class="row form-group">
                    <div class="col-xs-5 text-right">
                      <label>Related PO : </label>
                    </div>
                    <div class="col-xs-7">-</div>
                  </div> -->
                </div>
                <div class="col-xs-6">
                  <div class="row form-group">
                    <div class="col-xs-5 text-right">
                      <label>Released : </label>
                    </div>
                    <div class="col-xs-7"><?php if(isset($bid_request_data['released_date'])) { echo $bid_request_data['released_date']; }?></div>
                  </div>
                  <div class="row form-group">
                    <div class="col-xs-5 text-right">
                      <label>Viewed : </label>
                    </div>
                    <div class="col-xs-7"><?php if(isset($bid_request_data['viewed_on'])){ if($bid_request_data['viewed_on'] == '0/0/0000'){echo 'not viewed';}else{ echo $bid_request_data['viewed_on']; }}?>  </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-xs-5 text-right">
                      <label>Submitted : </label>
                    </div>
                    <div class="col-xs-7"><?php if(isset($bid_request_data['submitted'])){ if($bid_request_data['submitted'] == '0/0/0000'){echo 'not submitted';}else{ echo $bid_request_data['submitted']; }}?></div>
                  </div>
                </div>
              </div>
                  </div>
                </div>
              </div>
			  <div class="row m-top">
                <div class="col-xs-12">
					<p><strong>Details</strong></p>
					<div class="box-content panel-content">												
					<p><strong>Builder Description</strong></p>
					<p><?php if(isset($bid_request_data['description'])){ echo $bid_request_data['description']; }?></p>                            
                  </div>
                </div>
              </div>
				         <div class="row m-top">
                    <div class="col-xs-12">
                         
                         
                         <?php $this->load->view('content/bids/comment'); ?>
                         
                                 
                    </div>
                </div>
			</div>
            <div class="col-xs-6">
              <div class="row">
                <div class="col-xs-12">
				 <p><strong>Bid Status</strong></p>
                  <div class="box-content panel-content">                   
                    <div class="text-left">
                      <label>Status<label>: <?php echo $bid_request_data['bid_sub_status']; ?>                   
                    </div>                    
                  </div>
                </div>
              </div>

			  <div class="row m-top">
                <div class="col-xs-12">
				 <p><strong>Cost Price</strong></p>
            <div class="box-content panel-content">
              <?php if($bid_request_data['pricing_format'] == 'Flat Fee'){ ?>

                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                 
                <tr>
                  <td>Bid Amount</td>

                <td>  
                <div class="col-xs-12">
                  <div class="form-group">
                <input type="text" name="flatt_fee_amount" id="flatt_fee_amount" class="form-control varian" placeholder="$" value="<?php if(isset($bid_request_data['bid_amount'])) echo $bid_request_data['bid_amount'];?>" <?php if($bid_request_data['bid_sub_status'] == 'Submitted' || $bid_request_data['bid_sub_status'] == 'Accepted') { echo "readonly='readonly'"; } ?> > 
                <span class="help-block"></span>
                </div>
                </div>
              </td>
            </tr>
          </table>
              <?php }else{ ?>
            <?php if($bid_request_data['bid_sub_status'] != 'Declined' && $bid_request_data['bid_sub_status'] != 'Submitted' && $bid_request_data['bid_sub_status'] != 'Rejected' && $bid_request_data['bid_sub_status'] != 'Accepted'){  ?> 
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                      <tr>
                        <th>Cost</th>
                        <th>Description</th>
                        <th>Bid Amount</th>
                      </tr>
                     <?php
                    $variance_count = count($results_data['variance']);
                    if(count($results_data['variance']) >= 1)
                    {
                    for($i=0;$i<$variance_count;$i++)
                        {
                     ?>
                    <tr>
                    <td>
                    <?php echo $results_data['variance'][$i]['cost_variance_code'] ; ?>
                    </td>
                    <td>
                      <?php echo $results_data['variance'][$i]['cost_code_description'] ; ?>

                <input type="hidden" name="cost_code_description[]"  class="form-control description" placeholder="$" value=" <?php if(isset($results_data['variance'][$i]['cost_code_description'])){ echo $results_data['variance'][$i]['cost_code_description'] ; }?>" >
                   
                    </td>
                    <td class="col-xs-4">
                <div class="col-xs-12">
                  <div class="form-group">
                <input type="text" name="costcode[<?php echo $results_data['variance'][$i]['cost_code_id'] ; ?>]" id="textfield" class="form-control varian" placeholder="$" value="<?php if(isset($results_data['variance'][$i]['bid_amount'])) echo '$'.$results_data['variance'][$i]['bid_amount'] ; ?>" > 
                <span class="help-block"></span>
                </div>
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
                        <td>$<span id="total"> <?php if(isset($bid_request_data['bid_amount'])) echo $bid_request_data['bid_amount'];?></span></td>
                      </tr>
                    </table> 
            <?php }else{ ?>             
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
						<thead>
							<tr>
							<th>Cost</th>
			        <th>Description</th>
							<th>Bid Amount</th>
							</tr>
						</thead>
						<tbody>
             <?php
              if(isset($variance))
              {
                foreach ($variance as $key => $value) {
                  ?>
                  <tr>
              <td><?php echo $value['cost_variance_code']; ?></td>
              <td><?php echo $value['cost_code_description']; ?></td>
              <td><?php echo CURRENCY_SYMBOL.''.number_format($value['bid_amount'],2,'.',','); ?></td>
              </tr>
                <?php } 
              }
              ?>
              <tr>
              
              <td>&nbsp;</td>
              <td>My Total Bid</td>
              <td><?php if(isset($bid_request_data['bid_amount'])) echo CURRENCY_SYMBOL.''.number_format($bid_request_data['bid_amount'],2,'.',','); ?>
              </td>
              </tr> 
							
						</tbody>
					</table>  
          <?php } } ?>                                           
                  </div>
                </div>
              </div>

                 <p><strong>Bid Details</strong></p>
                                <div class="row">
                                  <div class="col-xs-12">
                                    <textarea class="ckeditor" name="sub_notes" id="sub_notes">
                  <?php echo isset($bid_request_data['sub_notes'])?$bid_request_data['sub_notes']:'' ; ?>
                  </textarea>

			  <div class="row m-top">
                <div class="col-xs-12">
				 <p><strong>Attached Files</strong></p>
                  <div class="box-content panel-content"> 
					<input type="hidden" name="folder_id" id="folder_id" value="<?php echo isset($folder_id)?$folder_id:'' ?>" />
					<?php $this->load->view('common/uploaded_content.php');?>                                      
                  </div>
                </div>
              </div>
              </div>
          </div>
     </div>
  </div>
</div>

</form>
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
                <button type="submit" class="btn btn-gray" id="post_comment">POST COMMENT</button>
                <button type="button" class="btn btn-gray" data-dismiss="modal">CANCEL</button>
				<input type="hidden" value="<?php echo $bid_request_data['project_id'] ?>" name="project_id" id="project_id">
				 <input type="hidden" value="<?php echo $bid_request_data['sub_contractor_id'] ?>" name="sub_contractor_id" id="sub_contractor_id">
                  <input type="hidden" value="<?php echo $bid_request_data['ub_bid_id'] ?>" name="bid_id" id="bid_id">
                  <input type="hidden" value="<?php echo $bid_request_data['project_name'] ?>" name="project_name">
                  <input type="hidden" value="<?php echo $bid_request_data['package_title'] ?>" name="package_name">
                  <input type="hidden" value="<?php echo $bid_request_data['ub_bid_request_id'] ?>" name="ub_bid_request_id" id="ub_bid_request_id">
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
</script>
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.jscrollpane.css';?>">	
<script type="text/javascript" src="<?php echo JSSRC.'enscroll-0.6.0.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/ckeditor.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/adapters/jquery.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'bid_accept.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'comment.js';?>"></script>