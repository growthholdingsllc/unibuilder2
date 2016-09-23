<div class="container-fluid top-header">
  <div class="row">
    <div class="logo col-xs-6"> <a href="<?php echo base_url().$this->crypt->encrypt('owner_dashboard/index/');?>"> <img alt="Logo" src="<?php echo IMAGESRC.'logo.png'; ?>" border="0"/> </a> </div>
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
		<li class="<?php if(isset($page_id)=='dashboard'){echo($page_id == "dashboard" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('owner_dashboard/index/'); ?>">Dashboard</a></li>
		<li class="<?php if(isset($page_id)=='projects'){echo($page_id == "projects" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('projects/index/'); ?>">Projects</a></li>
		<li class="<?php if(isset($page_id)=='logs'){echo($page_id == "logs" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('logs/index/'); ?>">Logs</a></li>
		<!--<li class="<?php if(isset($page_id)=='roles'){echo($page_id == "roles" ? "active" : "");}?>"><a href="<?php echo base_url(); ?>cm9sZXMvaW5kZXgv">Roles</a></li>-->
		<li class="<?php if(isset($page_id)=='task'){echo($page_id == "task" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('task/index/'); ?>">Tasks</a></li>
		<li class="<?php if(isset($page_id)=='schedules'){echo($page_id == "schedules" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('schedules/index/'); ?>">Schedules</a></li>
		<li class="<?php if(isset($page_id)=='docs'){echo($page_id == "docs" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('docs/index/');?>">Docs</a></li>
		<li class="<?php if(isset($page_id)=='photos'){echo($page_id == "photos" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('photos/index/');?>">Photos</a></li>
		<li class="<?php if(isset($page_id)=='messages'){echo($page_id == "messages" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('messages/index/'); ?>">Messages</a></li>
		<li class="<?php if(isset($page_id)=='selections'){echo($page_id == "selections" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('selections/index/'); ?>">Selections</a></li>
		<li class="<?php if(isset($page_id)=='warranty'){echo($page_id == "warranty" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('warranty/index/'); ?>">Warranty</a></li>
		<!--<li class="<?php if(isset($page_id)=='payments'){echo($page_id == "payments" ? "active" : "");}?>"><a href="#">Payments</a></li>-->
		<li class="<?php if(isset($page_id)=='po'){echo($page_id == "co" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('budget/project_budget/').'#owner_po'; ?>">Client PO</a></li>
		<li class="<?php if(isset($page_id)=='co'){echo($page_id == "co" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('budget/project_budget/').'#owner_co'; ?>">Client CO</a></li>
		<li class="<?php if(isset($page_id)=='payapp'){echo($page_id == "payapp" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('budget/project_budget/').'#pay_app'; ?>">Pay App</a></li>
		<li class="<?php if(isset($page_id)=='survey'){echo($page_id == "survey" ? "active" : "");}?>"><a href="<?php echo base_url().$this->crypt->encrypt('survey/index/').'#Survey'; ?>">Survey</a></li>
    </ul>
  </div>
  <!-- /.navbar-collapse --> 
</nav>
