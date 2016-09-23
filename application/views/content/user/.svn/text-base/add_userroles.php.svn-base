<div class="row">
  <ol class="breadcrumb">
    <?php //$this->load->view('common/breadcrumbs'); ?> 
    <!--<li class="active">Add User Roles</li>-->
  </ol>
</div>
<form id="save_role" class="form-horizontal" method="post" name="save_role">
<div class="row">
  <div class="col-xs-12">
    <div class="top-search pull-right">
      <div class="pull-right ">
		 <a href="<?php echo base_url();?>dXNlci91c2VyX3Jvbgxf1VzLw--"><button type="button" class="btn btn-gray pull-right m-left-1"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</button></a>
		<?php
		if(isset($this->user_role_access[strtolower('user roles')][strtolower('edit')]) && $this->user_role_access[strtolower('user roles')][strtolower('edit')] == 1 && $this->first_argument > 0)
		{ 
		?>   
		<button type="submit" name="add_role_new" id="add_role_new" class="btn btn-blue pull-right m-left-1"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save &amp; New</button>
		<button type="submit" name="add_role_new_back" id="add_role_new_back" class="btn btn-blue pull-right m-left-1"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back</button>
		<button type="submit" class="btn btn-blue pull-right m-left-1" name="add_role_new_stay" id="add_role_new_stay"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
		<?php 
		}
		else if((isset($this->user_role_access[strtolower('user roles')][strtolower('add')]) && $this->user_role_access[strtolower('user roles')][strtolower('add')] == 1) && $this->first_argument == 0)
		{ 
		?>
		<button type="submit" name="add_role_new" id="add_role_new" class="btn btn-blue pull-right m-left-1"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save &amp; New</button>
		<button type="submit" name="add_role_new_back" id="add_role_new_back" class="btn btn-blue pull-right m-left-1"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back</button>
		<button type="submit" class="btn btn-blue pull-right m-left-1" name="add_role_new_stay" id="add_role_new_stay"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
		<?php 
		}
		?>
      </div>
    </div>
	<input type="hidden" name="save_type" id="save_type" value="" />
	 <input type="hidden" name="ub_role_id" id="ub_role_id" 
	  value="<?php echo isset($result_data['ub_role_id'])?$result_data['ub_role_id']:'' ?>" />
  </div>
</div>
<div class="row m-top">
	  <div class="col-xs-12 error-message uni_message">
		 <div class="alerts alert-danger"></div>
	   </div>
</div>
<div class="row m-top">
  <div class="col-xs-12">
    <h4>USER ROLES  </h4>
    <div class="box-content panel-content">
      <div class="row five-col">
        <div class="col-xs-4">
          <label>Role Name</label>
		  <div class="col-xs-12">
		  <div class="form-group">
          <input type="text" class="form-control" placeholder="Role Name" name="role_name" id="role_name" value="<?php echo isset($result_data['role_name'])?$result_data['role_name']:'';?>" <?php if(isset($result_data['role_name']) && $result_data['role_name'] == 'Project Manager') { echo "readonly='readonly'"; } ?> />
        </div>
        </div>
        </div>
		<div class="col-xs-4">
			<label>Role Active</label>
			<div class="input-group right-group">
			   <input type="checkbox" id="role_active" name="role_active" <?php if(isset($result_data['role_active']) && $result_data['role_active']==='Yes') echo  "checked='checked'";?> <?php if(isset($result_data['role_name']) && $result_data['role_name'] == 'Project Manager') { echo "disabled='disabled'"; } ?> />
			</div>
	    </div>
		 <div class="col-xs-4">
		     <label>Role Description</label>
             <textarea class="form-control" name="description" id="description"><?php echo isset($result_data['description'])?$result_data['description']:'' ?></textarea>
		 </div>
       </div>
     </div>
  </div>
</div>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table table-bordered">
  <tr>
    <td height="60">PERMISSIONS</td>
  </tr>
  <tr>
    <td height="30" valign="top">
	    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
		<tr>
			<td>		
				<table border="0" cellspacing="10" cellpadding="15" class="parent_table">
					<td height="40"  class="menu-head"><strong>Check All</strong></td>
					<td align="left">Add &nbsp;<input type="checkbox" value=""  id="add_check"/> </td>
					<td align="left">Edit &nbsp;<input type="checkbox" value="" id="edit_check" /></td>
					<td align="left">Delete &nbsp;<input type="checkbox" value="" id="delete_check" /></td>
					<td align="left">View All &nbsp;<input type="checkbox" value="" id="view_all_check" /></td>
				</table>			
			</td>
        </tr>
		<input type="hidden" id="total_modules" value="<?php echo count($menu_list); ?>">
		<?php
		if(isset($menu_access_list))
		{
			for($i=0;$i<count($menu_list);$i++)
			{
				$access_names=array();
				$access_names=$menu_list[$i]['access_name'];
				$menu_name=$menu_list[$i]['menu_name'];
				$menu_id = $menu_list[$i]['ub_menu_id'];
				$flag = 0;
				for($k=0;$k<count($menu_access_list);$k++)
				{
					if($menu_id === $menu_access_list[$k]['menu_id'])
					{
						$flag = 1;
						$access_right=$menu_access_list[$k]['access_rights'];
					?>
						<tr>
						<td>
						<div>
								<table border="0" cellspacing="10" cellpadding="15" class="parent_table">
							  <td height="40"  class="menu-head"><strong><?php echo $menu_name;?></strong></td>
							  <?php
							  for($j=0;$j<count($access_names);$j++)
							  { ?>
							  <td align="left" class="menu_name"><?php echo $access_names[$j];?>&nbsp;
							  <input type="checkbox" name="<?php echo $menu_name."[]";?>" value="No" <?php if($access_right[$j] === '1') echo "checked='checked'";?> class="user_role_check user_role_<?php echo $j;?>" />
							  <input type="hidden" name="<?php echo $menu_name."_hidden[]";?>" class="project_hidden" value="<?php if($access_right[$j] === '1'){echo 1;}else{ echo 0;} ?>"/> 
							  </td>						
						  <?php
						  } 
						  ?>
						  </table>
						  </div>
						  </td>
							</tr>
						  <?php
					}
				}
				if($flag === 0)
				{ ?>
					<tr>
					<td>
						<div>
								<table border="0" cellspacing="10" cellpadding="15" class="parent_table">
									<td height="40"  class="menu-head"><strong><?php echo $menu_name;?></strong></td>
									  <?php
									  for($j=0;$j<count($access_names);$j++)
									  { ?>
									<td align="left" class="menu_name"><?php echo $access_names[$j];?>&nbsp;
									<input type="checkbox" name="<?php echo $menu_name."[]";?>" value="No" class="user_role_check user_role_<?php echo $j;?>" />
									<input type="hidden" name="<?php echo $menu_name."_hidden[]";?>" class="project_hidden" value="0"/> 
									</td>							   
								  <?php
								  } ?>
							    </table>
						</div>
					  </td>
					</tr>
					<?php
				}
			}
		}
		else
		{
			for($i=0;$i<count($menu_list);$i++)
			{
				$access_names=array();
				$access_names=$menu_list[$i]['access_name'];
				$menu_name=$menu_list[$i]['menu_name'];
				$menu_id = $menu_list[$i]['ub_menu_id'];
				?>
				<tr>
					<td>
						<div>
							 <table border="0" cellspacing="10" cellpadding="15" class="parent_table">
								  <td height="40"  align="left" class="menu-head"><strong><?php echo $menu_name;?></strong></td>
								  <?php
								  for($j=0;$j<count($access_names);$j++)
								  { 
								  //echo '<pre>';print_r($access_names);exit;
								  ?>
								  <td align="left" class="menu_name">
									  <?php echo $access_names[$j];?>&nbsp;
									  <input type="checkbox" name="<?php echo $menu_name."[]";?>" value="No" class="user_role_check user_role_<?php echo $j;?>" />
									  <input type="hidden" name="<?php echo $menu_name."_hidden[]";?>" class="project_hidden" value="0"/> 
								  </td>
								  <?php
								  } ?>
								  
							</table>
						</div>
					</td>
				</tr>
				<?php
			}
			
		}
		?>
      </table>
	</td>
  </tr>
</table>
</form>
<div class="modal fade" id="TypeAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Add User Roles
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
<script type="text/javascript" src="<?php echo JSSRC.'add_user_roles.js';?>"></script>