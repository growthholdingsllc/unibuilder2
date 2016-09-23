<style>
.current {
    width: 104% !important;
}

</style>


<div class="row">
  <ol class="breadcrumb">
    <li class="active">Dashboard</li>
  </ol>
</div>
<div class="row">
  <div class="col-xs-12 dashboard-body">
    <div class="col-xs-12">
      <div class="col-xs-4">
        <div class="panel panel-primary">
          <div class="panel-heading"><a href="javascript:void(0);" id="owner_activity_refresh" class="glyphicon glyphicon-refresh pull-right" aria-hidden="true"></a> <strong>OWNER ACTIVITY</strong> </div>
          <div class="panel-body">
			<!-- owner activity list -->
				<div id="load_owner_activity_to_div" class="scroll-pane">
					<?php $this->load->view('content/dashboard/dashboard_sections/owner_activity'); ?>
				</div>
          </div>
        </div>
        <div class="panel panel-primary">
          <div class="panel-heading"><a href="javascript:void(0);" class="glyphicon glyphicon-refresh pull-right" id="log_refresh" aria-hidden="true"></a> <strong>DAILY LOG</strong> </div>
          <div class="panel-body">
				<!-- log list -->
				<div id="load_log_to_div" class="scroll-pane">
					<?php $this->load->view('content/dashboard/dashboard_sections/daily_log'); ?>
				</div>
          </div>
        </div>
        <div class="panel panel-primary" id="weather-disable">
		<!--<a href="<?php echo base_url() ?>bWFpbF9mZXRjaC9pbmRleC8-">Mail Fetch</a>-->
         <div class="panel-heading"><a href="javascript:void(0);" id="weather_refresh" class="glyphicon glyphicon-refresh pull-right" aria-hidden="true"></a> <strong>CURRENT WEATHER</strong></div>
          <!-- <div class="panel-body weather-report"> <a href="http://www.accuweather.com/en/us/las-vegas-nv/89101/weather-forecast/329506" class="aw-widget-legal"> </a>
            <div id="awcc1429773945016" class="aw-widget-current"  data-locationkey="" data-unit="f" data-language="en-us" data-useip="true" data-uid="awcc1429773945016"></div>
          </div>-->
			<div id="load_weather_to_div">
				<?php $this->load->view('content/dashboard/dashboard_sections/current_weather'); ?>
			</div>
        </div>
      </div>
      <div class="col-xs-4">
        <div class="panel panel-primary project-cost">
          <div class="panel-heading "><strong>WARRANTY ALERT'S</strong><a href="javascript:void(0);" id="warranty_refresh" class="glyphicon glyphicon-refresh pull-right" aria-hidden="true"></a> </div>
          <div class="panel-body">
            <!-- warranty alert list -->
				<div id="load_warranty_to_div" class="scroll-pane">
					<?php $this->load->view('content/dashboard/dashboard_sections/warranty_alerts'); ?>
				</div>
          </div>
        </div>
       <!-- <div class="panel panel-primary">
          <div class="panel-heading"><strong>CURRENT REMINDER'S </strong><a href="javascript:void(0);" id="reminder_refresh"class="glyphicon glyphicon-refresh pull-right" aria-hidden="true"></a> </div>
          <div class="panel-body">
				<div id="load_reminder_to_div">
					<?php //$this->load->view('content/dashboard/dashboard_sections/current_reminders'); ?>
				</div>
          </div>
        </div>-->
		<?php 
		if(!empty($this->project_id))
		{
		?>
        <div class="panel panel-primary">
          <div class="panel-heading"><strong>PROJECT COST SUMMARY </strong><a href="javascript:void(0);" id="project_cost_summary_refresh"class="glyphicon glyphicon-refresh pull-right" aria-hidden="true"></a> </div>
		  <div class="panel-body project-cost">
			<!-- warranty alert list -->
				<div id="load_project_cost_summary_to_div" >
					<?php $this->load->view('content/dashboard/dashboard_sections/project_budget_summary'); ?>
				</div>
		 </div>
          <div class="dashboard-more text-right"><a href="<?php echo base_url().$this->crypt->encrypt('budget/project_budget/').'#jobs'; ?>">Go to Budget >></a></div>
        </div>
		<?php 
		}
		?>
      </div>
      <div class="col-xs-4">
        <div class="panel panel-primary">
			<div class="panel-heading"><a href="javascript:void(0);" class="glyphicon glyphicon-refresh pull-right" id="task_refresh" aria-hidden="true"></a> <strong>TASK'S</strong></div>
				<div class="panel-body">
					<div class="panel panel-default">
					<!-- tasks list -->
						<div id="load_task_to_div" class="scroll-pane">
							<?php $this->load->view('content/dashboard/dashboard_sections/tasks'); ?>
						</div>
					</div>
				</div>
        </div>
        <div class="panel panel-primary">
          <div class="panel-heading"><a href="javascript:void(0);" id="schedule_refresh" class="glyphicon glyphicon-refresh pull-right" aria-hidden="true"></a><strong>TODAY SCHEDULE</strong> </div>
          <div class="panel-body">
		  <!-- today schedule list -->
				<div id="load_schedule_to_div" class="scroll-pane">
					<?php $this->load->view('content/dashboard/dashboard_sections/today_schedule'); ?>
				</div>
          </div>
        </div>
        <div class="panel panel-primary">
		<div class="panel-heading"><a href="javascript:void(0);" id="comment_refresh" class="glyphicon glyphicon-refresh pull-right" aria-hidden="true"></a> <strong>RECENT COMMENTS</strong></div>
		<div class="panel-body">
		<!-- comments list -->
			<div id="load_comment_to_div" class="scroll-pane">
				<?php $this->load->view('content/dashboard/dashboard_sections/recent_comments'); ?>
			</div>
        </div>
		</div>
        <div class="panel panel-primary">
          <div class="panel-heading"><a href="javascript:void(0);" id="mail_notification_refresh" class="glyphicon glyphicon-refresh pull-right" aria-hidden="true"></a> <strong>MAIL NOTIFICATION</strong></div>
          <div class="panel-body">
            <!-- mail notifications list -->
			<div id="load_mail_notification_to_div" class="scroll-pane">
				<?php $this->load->view('content/dashboard/dashboard_sections/mail_notification'); ?>
			</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">           
   this.dashboard_page = 'yes';    
</script>
<!--<script type="text/javascript" src="http://oap.accuweather.com/launch.js"></script> -->
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.jscrollpane.css';?>">	
<script type="text/javascript" src="<?php echo JSSRC.'enscroll-0.6.0.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dashboard.js';?>"></script>