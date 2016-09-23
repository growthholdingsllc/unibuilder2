<div class="mailbox row">
  <div class="col-xs-12">
	 <div class="box-solid">
		<div class="box-body">
		   <div class="row <?php if($this->project_id == ''){ echo 'no_project_selected'; } ?>">
			  <div class="col-xs-2" id="message_folder_list">
				 <?php $this->load->view('content/messages/message_folder'); ?>
			  </div>
			  <!-- /.col (LEFT) -->
			  <div class="col-xs-10">
				<div class="mail-con-div">
					<div class="message_inbox_con">
						<div class="row">
						   <div class="col-xs-12 mailbox-header">
							  <!-- Action button -->
							  <div class="btn-group checkbox_label">
								 <div class="sorting_mail">
									<div class="checkbox_con pull-left">
									   <label>
									   <input type="checkbox" id="sorting_mail" />
									   </label>
									</div>
									<button type="button" class="dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu">
									   <li><a href="javascript:void(0);" id="all_sorting">All</a></li>
									   <li><a href="javascript:void(0);" id="all_none">None</a></li>
									   <li><a href="javascript:void(0);" id="all_read">Read</a></li>
									   <li><a href="javascript:void(0);" id="delete">Delete</a></li>
									</ul>
								 </div>
							  </div>
						   </div>
						</div>
						<!-- /.row -->
						<div class="row">
						   <div class="col-xs-12">
							  <table class="table table-mailbox" id="message_inbox" width="100%">
							  <?php
							  $messages = isset($msg_data['messages_data'])?$msg_data['messages_data']:'';
							if(count($messages) > 0)
							{
								  for($i=0;$i< count($messages);$i++)
								  { ?>
									<tr class="row" id="<?php echo$messages[$i]['ub_message_id'].'-'.$messages[$i]['is_read'];?>" <?php if("No" == $messages[$i]['is_read']) {?> style="font-weight:bold;<?php }?>">
										<td width="20" align="left" class="small-col">
										<input type="checkbox" name="message_ids[]" value="<?php echo$messages[$i]['ub_message_id'];?>"/>
										</td><td class="name"><?php echo$messages[$i]['first_name'];?></td>
										<td class="subject"><?php echo$messages[$i]['subject'];?></td>
										<td width="100" align="right" class="time"><?php echo$messages[$i]['message_date'];?></td>
									</tr>
								 <?php
								 } 
							}
							else
							{?>
								<tr class="row" >
									<td width="20" align="left" class="small-col" colspan="3">No records found</td>
								</tr>
							<?php
							} ?>
							  </table>
							  <div class="col-xs-12">
								 <div class="col-xs-12 mail-pagination">
									<div class="pull-right">
									   <ul class="pagination">
										<?php
										$total_pages = $msg_data['total_records'];
										if((round($total_pages['total_records'] / DEFAULT_PAGINATION_LENGTH)) > 1)
										{ ?>
										  <li>
											 <a href="javascript:void(0);" aria-label="Previous" class="paginate" id="<?php 
											 echo $msg_data['prev_page_id'];?>">
											 <span class="glyphicon-arrow-left1"></span>
											 </a>
										  </li>
										  <?php
										  }
										  for($i=0;$i < round($total_pages['total_records'] / DEFAULT_PAGINATION_LENGTH);$i++)
										  { ?>
										  <li><a href="javascript:void(0);" class="paginate" id="<?php echo $i;?>"><?php echo $i+1; ?></a></li>
										  <?php
										  } 
										 if((round($total_pages['total_records'] / DEFAULT_PAGINATION_LENGTH)) > 1)
										{?>
										  <li>
											 <a href="javascript:void(0);" aria-label="Next" class="paginate" id="<?php 
											 echo $msg_data['next_page_id'];?>">
											 <span class="glyphicon-arrow-right1"></span>
											 </a>
										  </li>
										<?php } ?>
									   </ul>
									</div>
								 </div>
							  </div>
						   </div>
						</div>
					</div><!-- Inbox -->
				</div>
				 <!-- /.col (RIGHT) --> 
			  </div>
			  <!-- /.row --> 
		   </div>
		   <!-- /.box-body -->                        
		</div>
		<!-- /.box --> 
	 </div>
	 <!-- /.col (MAIN) --> 
  </div>
</div>