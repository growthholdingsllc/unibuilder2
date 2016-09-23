<div class="container-fluid top-header">
  <div class="row">
    <div class="logo col-xs-6"> <a href="<?php echo base_url().$this->crypt->encrypt('builder_dashboard/index/');?>"> 
	<?php if(isset($this->builder_logo_url) && !empty($this->builder_logo_url)){ ?>
		<img alt="Logo" src="<?php  echo $this->builder_logo_url; ?>" width="162px" height="21px"  border="0"/> 
	<?php }else { ?>
		<img alt="Logo" src="<?php echo IMAGESRC.'logo.png'; ?>" border="0"/> 
	<?php } ?>
	</a> </div>
    <div class="log-details col-xs-6">
      <ul class="nav navbar-nav navbar-right">
        <li>Welcome</li>
        <li class="secondary-color bold"><?php echo $this->user_session['first_name']." ".$this->user_session['last_name']; ?></li>
        <li><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <img alt="settings" src="<?php echo IMAGESRC.'settings-icon.png'; ?>" border="0"/> </a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo base_url().$this->crypt->encrypt('preferences/index/'); ?>">My Profile</a></li>
            <li><a href="<?php echo base_url().$this->crypt->encrypt('user/changepassword/');?>">Change Password</a></li>
			<li><a href="<?php echo base_url().$this->crypt->encrypt('login/logout/'); ?>">Logout</a></li>  
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
<nav class="navbar navbar-default">
  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav uni_header" id="horizontal">
	<li class="<?php if(isset($page_id)=='dashboard'){echo($page_id == "dashboard" ? "active" : "");}?>"><a href="<?php echo base_url(); ?>YnVpbgxf1Rlcl9kYXNoYm9hcmQvaW5kZXgv">Dashboard</a></li>
      <li class="<?php if(isset($page_id)=='Leads'){echo($page_id == "Leads" ? "active" : "");}?>"><a href="<?php echo base_url(); ?>bgxf1VhZHMvaW5kZXgv">Leads</a></li>
      <li class="dropdown <?php if(isset($page_id)=='projects'){echo($page_id == "projects" ? "active" : "");}?>" > <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Projects <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url().$this->crypt->encrypt('projects/index/');?>">Project List</a></li>
          <li> <a class="trigger right-caret">New Project</a>
            <ul class="dropdown-menu sub-menu">
              <li><a href="<?php echo base_url().$this->crypt->encrypt('projects/save_project/'); ?>">From Scratch</a></li>              
			  <li><a href="<?php echo base_url().$this->crypt->encrypt('projects/from_template/'); ?>">From Template</a></li> 
            </ul>
          </li>
          <li class=""><a href="<?php echo base_url().$this->crypt->encrypt('projects/meeting/'); ?>">Minutes of Meeting</a></li>
        </ul>
      </li>
      <li class="<?php if(isset($page_id)=='logs'){echo($page_id == "logs" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('logs/index/'); ?>">Logs</a></li>
      <!--<li class="<?php if(isset($page_id)=='roles'){echo($page_id == "roles" ? "active" : "");}?>"><a href="<?php echo base_url(); ?>cm9sZXMvaW5kZXgv">Roles</a></li>-->
      
	  <li class="dropdown <?php if(isset($page_id)=='task'){echo($page_id == "task" ? "active" : "");}?>" > <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Tasks <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url().$this->crypt->encrypt('task/index/'); ?>">Task List</a></li>
          <li><a href="<?php echo base_url().$this->crypt->encrypt('punchlist/index/'); ?>">Punch List</a></li>
        </ul>
      </li>
	  
      <li class="<?php if(isset($page_id)=='bids'){echo($page_id == "bids" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('bids/index/'); ?>">Bids</a></li>
	  <li class="<?php if(isset($page_id)=='budget'){echo($page_id == "budget" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('budget/project_budget/');if(!empty($this->project_id)){echo '#jobs'; } else{echo '#summary'; } ?>">Budget</a></li>
      <!--<li class="dropdown <?php if(isset($page_id)=='budget'){echo($page_id == "budget" ? "active" : "");}?>" > <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Budget <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url().$this->crypt->encrypt('budget/budget_summary/'); ?>">All Projects</a></li>
          <li><a href="javascript:void(0);" id="budget_select_project">Select Project</a></li>
        </ul>
      </li>-->
      <li class="<?php if(isset($page_id)=='schedules'){echo($page_id == "schedules" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('schedules/index/'); ?>">Schedules</a></li>
      <li class="<?php if(isset($page_id)=='docs'){echo($page_id == "docs" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('docs/index/');?>">Docs</a></li>
      <li class="<?php if(isset($page_id)=='photos'){echo($page_id == "photos" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('photos/index/');?>">Photos</a></li>
      <li class="<?php if(isset($page_id)=='messages'){echo($page_id == "messages" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('messages/index/'); ?>">Messages</a></li>
      <li class="<?php if(isset($page_id)=='selections'){echo($page_id == "selections" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('selections/index/'); ?>">Selections</a></li>
      <li class="<?php if(isset($page_id)=='Checklist'){echo($page_id == "Checklist" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('checklist/index/'); ?>">Checklist</a></li>
      <li class="<?php if(isset($page_id)=='warranty'){echo($page_id == "warranty" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('warranty/index/'); ?>">Warranty</a></li>
	   <li class="<?php if(isset($page_id)=='survey'){echo($page_id == "survey" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('survey/index/'); ?>">Survey</a></li>
      <li class="dropdown <?php if(isset($page_id)=='user'){echo($page_id == "user" ? "active" : "");}?>" > <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Users <span class="caret"></span></a>
        <ul class="dropdown-menu last_drop_down">         
          <li><a href="<?php echo base_url().$this->crypt->encrypt('user/builder_users/'); ?>"  class="open-tab">Builder Users</a></li>
          <li><a href="<?php echo base_url().$this->crypt->encrypt('subcontractor/user_subcontractor/'); ?>" id="Vendors" class="open-tab">Subcontractor</a></li>
          <!--<li><a href="<?php echo base_url().$this->crypt->encrypt('user/user_subuser/'); ?>" id="subuser" class="open-tab">Subuser</a></li>-->
          <li class="divider"></li>
          <li><a href="<?php echo base_url().$this->crypt->encrypt('user/user_roles/'); ?>" id="subuser" class="open-tab">User Roles</a></li>
        </ul>
      </li>
	  <li  class="<?php if(isset($page_id)=='setup'){echo($page_id == "setup" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('setup/index/'); ?>">Setup</a></li>
    </ul>
  </div>
  <!-- /.navbar-collapse --> 
</nav>
