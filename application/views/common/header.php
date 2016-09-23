<div class="container-fluid top-header">
<div class="row">
   <div class="logo col-xs-6">
      <a href="<?php echo base_url(); ?>home"> <img alt="Logo" src="<?php echo IMAGESRC.'logo.png'; ?>" border="0"/> </a>
   </div>
   <div class="log-details col-xs-6">
      <ul class="pull-right">
         <li>Welcome</li>
         <li class="secondary-color bold"><?php echo $this->user_session['first_name']." ".$this->user_session['last_name']; ?></li>
         <li class="secondary-color">|</li>
          <li class="secondary-color"><a href="<?php echo base_url().$this->crypt->encrypt('login/logout/'); ?>">Logout</a></li>
         <li><a href="<?php echo base_url(); ?>home"> <img alt="home" src="<?php echo IMAGESRC.'home.png'; ?>" border="0"/> </a></li>
         <li><a href="javascript:void(0);"> <img alt="settings" src="<?php echo IMAGESRC.'settings-icon.png'; ?>" border="0"/> </a>
         </li>
      </ul>
   </div>
</div>
</div>
<nav class="navbar navbar-default">
   <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav" id="horizontal">
         <li class="<?php if(isset($page_id)=='Home'){echo($page_id == "Home" ? "active" : "");}?>"><a href="<?php echo base_url(); ?>home">Leads</a></li>
		<li class="dropdown <?php if(isset($page_id)=='jobs'){echo($page_id == "jobs" ? "active" : "");}?>" >
		<a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Jobs <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li class="disabled"><a href="#">Job Info</a></li>
				<li><a href="<?php echo base_url(); ?>jobs">Job List</a></li>
				<li>
					<a class="trigger right-caret">New Job</a>
					<ul class="dropdown-menu sub-menu">
						<li><a href="<?php echo base_url(); ?>jobs/jobsdetails">From Scratch</a></li>			
						<li><a href="<?php echo base_url(); ?>jobs/newjobtemplate">From Template</a></li>
					</ul>
				</li>
				
			</ul>
		</li>
         <li class="<?php if(isset($page_id)=='logs'){echo($page_id == "logs" ? "active" : "");}?>"><a href="<?php echo base_url(); ?>logs">Logs</a></li>
         <li class="<?php if(isset($page_id)=='todo'){echo($page_id == "todo" ? "active" : "");}?>"><a href="<?php echo base_url(); ?>To-Do">To Do</a></li>
         <li class="<?php if(isset($page_id)=='bids'){echo($page_id == "bids" ? "active" : "");}?>"><a href="<?php echo base_url(); ?>bids">Bids</a></li>
         <li class="<?php if(isset($page_id)=='budget'){echo($page_id == "budget" ? "active" : "");}?>"><a href="<?php echo base_url(); ?>budget">Budget</a></li>
         <li class="<?php if(isset($page_id)=='calendar'){echo($page_id == "calendar" ? "active" : "");}?>"><a href="<?php echo base_url(); ?>calendar">Calendar</a></li>
         <li class="<?php if(isset($page_id)=='photos_docs'){echo($page_id == "photos_docs" ? "active" : "");}?>"><a href="<?php echo base_url();?>Photos-Docs">Photos&amp;Docs</a></li>
         <li class="<?php if(isset($page_id)=='messages'){echo($page_id == "messages" ? "active" : "");}?>"><a href="<?php echo base_url(); ?>messages">Messages</a></li>
         <li><a href="#">Change Order</a></li>
         <li class="<?php if(isset($page_id)=='selections'){echo($page_id == "selections" ? "active" : "");}?>"><a href="<?php echo base_url(); ?>selections">Selections</a></li>
         <li class="<?php if(isset($page_id)=='warranty'){echo($page_id == "warranty" ? "active" : "");}?>"><a href="<?php echo base_url(); ?>warranty">Warranty</a></li>
		 <li class="dropdown <?php if(isset($page_id)=='user'){echo($page_id == "user" ? "active" : "");}?>" >
		<a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Users <span class="caret"></span></a>
			<ul class="dropdown-menu">				
				<li><a href="<?php echo base_url(); ?>user#Internal-Users" id="internal" class="open-tab">Internal Users</a></li>				
				<li><a href="<?php echo base_url(); ?>user#Sub-Vendors" id="Vendors" class="open-tab">Subs/Vendors</a></li>				
			</ul>
		</li>
      </ul>
   </div>
   <!-- /.navbar-collapse -->	  
</nav>