<div class="modal fade" id="create_payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Create a New Payment
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
			<div class="row grid_settings">
			   <div class="col-xs-12">
				  <div class="modal-con">
					 <div class="row">
						<div class="col-xs-12">
						   <table width="100%" class="border-none">
							  <tr>
								<td height="30" colspan="2">
								<div class="col-xs-12 error-message uni_message">
									<div class="alerts alert-danger"></div>
								</div>
								</td>
							  </tr>
						   </table>
						</div>
					 </div>
				  </div>
			   </div>
			</div>
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-3">
                           <label><?php echo $title; ?> Title</label>
                           <p><label id="po_titles"></label></p>
                        </div>
                        <div class="col-xs-4">						
                           <label>Payment Title</label>
                            <input type="hidden" name="ub_po_co_payment_id" id="ub_po_co_payment_id" value="" >
                           <input type="text" class="form-control" name="payment_title" id="payment_title" />
                        </div>
                        <div class="col-xs-5 status_block">
                           <div class="status_box">Status :  <!-- <img src="<?php echo IMAGESRC.'approved_owner.png'; ?>"> -->
                              <span class="text-danger"> <label id="status_vals"></label></span>
                           </div>
                        </div>
                     </div>
                      <div class="row m-top" id="sta">
                       <div class="col-xs-4 pull-right">
                         <input type="checkbox" name="payment_status" id="payment_request_status" /> Ready for Payment
                       </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-12">
                           <label>Comments</label>
                           <textarea class="form-control" name="comments" id="comments"></textarea>
                        </div>
                     </div>
                      <!-- File Upload block -->
                     <div class="file_upload">
                       <?php  //$this->load->view('content/budget/file_upload_block'); ?>
                     </div>

                     

                     <!-- End File Upload Block -->
                     <?php if($this->user_account_type == BUILDERADMIN ){ ?>
                     <div class="row m-top">
                      
                        
                        <div class="col-xs-6" id="btns">
                           <input type="hidden" name="status_val" id="status_val" value="" >
                           <button type="submit" class="btn  btn-blue app" id="approve">Approve Document</button>
                           <button type="submit" class="btn  btn-gray" id="reject">Reject</button>
                           <button type="submit" class="btn  btn-blue" id="override">Override</button>
                        </div>
                     </div>
                     <?php } ?>
                     
                     <div class="row m-top">
                        <div class="col-xs-12">
                           <input type="hidden" id="voucher_id" name="voucher_id">
                        <button type="button" class="btn  btn-blue" id="generate_voucher" onclick="get_voucher()">Generate Voucher for this payment</button>
                        </div>
                     </div>
					 <div class="po_co_transaction">
                  <div class="row m-top">
                     <div class="col-xs-12">
						<?php  //$this->load->view('content/budget/save_po_co_payment_transaction'); ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        <!--  <div class="modal-footer">
            <div class="row">
               <div class="col-xs-12">
                  <button class="btn btn-light-grey" data-dismiss="modal" type="button">Cancel</button>					
                  <button class="btn btn-success" type="submit">Upload</button>
               </div>
            </div>
         </div> -->
      </div>
   </div>
</div>
</div>
</div>