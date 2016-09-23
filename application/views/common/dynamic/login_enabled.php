<div class="row ">
	<div class="col-xs-3">
	   <p>&nbsp;</p>
	   <input type="checkbox" name="login_enabled" id="login-enabled" <?php if(isset($user_data['login_enabled']) && $user_data['login_enabled']==='Yes') echo  "checked='checked'";?> />
	   Login Enabled 
	</div>
	<div class="col-xs-3 log-disable access-log">
		  <label>Access Method</label>	  
		  <select class="selectpicker form-control" id="accessmethod" name="accessmethod">
			 <option value="none">Nothing selected</option>
			 <option value="emailinvite">Email Invite</option>
			 <option value="configure" <?php if(!empty($user_data['username'])) echo "selected='select'";?>>Configure Manually</option>
		  </select>		
	</div>
	<div class="col-xs-3 log-disable drop-down-show-hide configure">
	   <label>User Name</label>
	   <input type="text" class="form-control disabled_input" id="user_name" name="username" value="<?php if(isset($user_data['username'])) echo $user_data['username'];?>"/>
	</div>
	<div class="col-xs-3 log-disable drop-down-show-hide configure">
	   <label>New Password</label>
	   <input type="password" class="form-control disabled_input" id="password" name="password" value="<?php if(isset($user_data['password'])) echo $user_data['password'];?>"/>
	</div>
	<div class="col-xs-3 log-disable drop-down-show-hide drop emailinvite">
	   <p>&nbsp;</p>
	   <button type="submit" class="btn btn-blue disabled_prop" id="builderuseremailinvitation">
	   <img border="0" class="uni_send_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Send
	   </button>
	</div>
            
 </div>