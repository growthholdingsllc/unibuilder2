<!-- top header -->

<header class="header header-fixed navbar">
  <div class="brand"> 
    <!-- toggle offscreen menu --> 
    <a href="javascript:;" class="ti-menu navbar-toggle off-left visible-xs" data-toggle="collapse" data-target="#hor-menu"></a> 
    <!-- /toggle offscreen menu --> 
    <!-- logo --> 
    <a href="<?php echo base_url(); ?>YWRtaW4vZgxf1Fzagxf1JvYXJkL2luZgxf1V4" class="navbar-brand"> <img src="<?php echo ACJI.'images/logo.png'; ?>" alt=""> <span class="heading-font"> &nbsp; </span> </a> 
    <!-- /logo --> 
  </div>
  <div class="collapse navbar-collapse pull-left" id="hor-menu">
    <ul class="nav navbar-nav">
      <li class="active"> <a href="<?php echo base_url(); ?>YWRtaW4vZgxf1Fzagxf1JvYXJkL2luZgxf1V4"> <span>Dashboard</span> </a></li>
      <li> <a href="<?php echo base_url(); ?>YWRtaW4vYnVpbgxf1Rlci9pbmRleA--"> <span>Builders</span> </a></li>
      <li> <a href="<?php echo base_url(); ?>YWRtaW4vcgxf1xhbnMvaW5kZXg-"> <span>Plans</span> </a></li>
      <li> <a href="<?php echo base_url(); ?>YWRtaW4vcgxf1F5bWVudC9pbmRleA--"> <span>Payments</span> </a></li>
      <li> <a href="<?php echo base_url(); ?>YWRtaW4vdXNlci9pbmRleA--"> <span>Users</span> </a></li>
    </ul>
  </div>
  <ul class="nav navbar-nav navbar-right">
    <li class="off-right"> <a href="javascript:;" data-toggle="dropdown"> <span class="hidden-xs ml10"><?php echo $this->user_session['first_name'].' '.$this->user_session['last_name'];?></span> <i class="ti-angle-down ti-caret hidden-xs"></i> </a>
      <ul class="dropdown-menu animated fadeInRight">
        <li> <a href="YWRtaW4vdXNlci9jagxf1FuZ2VwYXNzd29yZA--">Change Password</a> </li>
        <li> <a href="<?php echo base_url(); ?>YWRtaW4vbgxf19naW4vbgxf19nb3V0">Logout</a> </li>
      </ul>
    </li>
  </ul>
</header>
<!-- /top header --> 
