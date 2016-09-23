<div class="row">
 <div class="col-xs-12">
	<table width="100%">
	   <tr>
		  <td width="100%" height="40" colspan="3" >SUBS PERMITTED </td>
	   </tr>
	   <tr class="selector-access-con">
		  <td colspan="3" width="100%">
			 <table width="100%">
				<tr>
				   <td width="45%">
					  <div class="right-inner-addon"> <i class="glyphicon glyphicon-search"></i>
						 <input type="search" id="subs_left" placeholder="Search" class="form-control">
					  </div>
				   </td>
				   <td width="10%" align="center">&nbsp;</td>
				   <td width="45%">
					  <div class="right-inner-addon"> <i class="glyphicon glyphicon-search"></i>
						 <input type="search" id="subs_right" placeholder="Search" class="form-control">
					  </div>
				   </td>
				</tr>
				<tr>
				   <td width="45%">
					  <ul class='sub_list1 drag-ele'>
						 <?php 
						  if(isset($get_sub_contractor_array_list_details) && count($get_sub_contractor_array_list_details)>0)
							{
								for($i=0;$i<count($get_sub_contractor_array_list_details);$i++)
								{ ?>
								   <li value="<?php echo $get_sub_contractor_array_list_details[$i]['ub_user_id'];?>"><?php echo $get_sub_contractor_array_list_details[$i]['fullname'];?></li>
								<?php 
								} 
							}  
							 
							?>  
					  </ul>
				   </td>
				   <td width="10%" align="center"><span id='sub_move_left' class="btn btn-primary glyphicon glyphicon-backward" aria-hidden="true"></span> <span id='sub_move_right' class="btn btn-primary glyphicon glyphicon-forward" aria-hidden="true"></span></td>
				   <td width="45%">
					  <ul class='sub_list2 drag-ele'>
						 <?php 
						  if(isset($get_sub_contractor_selected_details) && count($get_sub_contractor_selected_details)>0)
							{
								$view_access_userids = '';
								for($i=0;$i<count($get_sub_contractor_selected_details);$i++)
								{ 
									$view_access_userids = $view_access_userids.$get_sub_contractor_selected_details[$i]['ub_user_id'].',';
								?>
								   <li value="<?php echo $get_sub_contractor_selected_details[$i]['ub_user_id'];?>"><?php echo $get_sub_contractor_selected_details[$i]['fullname'];?></li>
								<?php 
								} 
							}  
							 
							?>  
						 
					  </ul>
				   </td>
				</tr>
			 </table>
		  </td>
	   </tr>
	</table>
	<!-- Below code was added by chadnru 11-05-2014 -->
	<input type="hidden" value="<?php echo isset($view_access_userids)?','.$view_access_userids:''; ?>"  id="project_view_access" name="project_view_access" />
	<input type="hidden" value="<?php echo isset($view_access_userids)?','.$view_access_userids:''; ?>"  id="hide_project_view_access" name="hide_project_view_access" />
	
	<!-- chandru code ends here -->
 </div>
</div>
