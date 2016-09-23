<?php 
$all_data = $this->session->all_userdata(); 
// echo '<pre>';print_r($all_data);
$type=$all_data['ACCOUNT_TYPE'];
$commom_templates = isset($all_data['ACCOUNT'][$type]['TEMPLATE_LIST']['COLLAPSE_TEMPLATE_LIST'])?$all_data['ACCOUNT'][$type]['TEMPLATE_LIST']['COLLAPSE_TEMPLATE_LIST']:array();
$commom_templates = $this->users_template_list;
?>
<div class="pull-left">
	<div class="side-menu">
		<a href="javascript:void(0);" class="arrow-left">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<p>Viewing&nbsp;Templates</p>
		</a>
		<div class="col-xs-12 jobs-menu">			
				 <div class="jobs-menu-details pull-left">
				 <div class="col-xs-12">
				 <?php
					echo form_dropdown('display_type[]', array('template_view'=>'Template View', 'project_view'=>'Project View'), 'Template View', "class='selectpicker form-control' id='display_type' data-live-search='true'");
				 ?>
				  </div>
				 <?php
					if(count($commom_templates) > 0 && isset($commom_templates) && !empty($commom_templates))
					{
					?>
					<div class="col-xs-12" >
						<div class="right-inner-addon">        
						<i class="glyphicon glyphicon-search"></i>
						<input type="search" class="form-control" id="Search_filter" placeholder="Search" />
						</div>
					</div>
					<div class="col-xs-12">
						<ul class="filter">
						
							<li class="<?php if(empty($this->template_id)&&($this->template_id == '')) echo "selected";?>"><a class="text-filter" href="javascript:void(0);" id="all_template" onclick="template_click(this.id)">All Templates</a></li>
						<?php
						foreach($commom_templates as $key=>$val)
						{
						?>
							<li class="<?php if(!empty($this->template_id)&&($this->template_id == $key)) echo "selected";?>"><a class="text-filter" href="javascript:void(0);" id="<?php echo $key; ?>" title="<?php echo $val; ?>" onclick="template_click(this.id,this.title)"><?php echo $val; ?> </a> <a href='<?php echo base_url().$this->crypt->encrypt('template/projects/save_templates/'.$key); ?>'><span class="glyphicon glyphicon-pencil pull-right" aria-hidden="true"></span></a></li>
						<?php
						}
						
						?>
							
						</ul>						
					</div>	
					<?php 
					}
					else
					{ 
					?>
					<p align="center">No Template Found for this Builder.
					<a href='<?php echo base_url().$this->crypt->encrypt('template/projects/save_templates'); ?>'> Please Create a Template</a></p>
					<?php
					} 
					?>		
				 </div>
		 </div>
	</div>
</div>
<script type="text/javascript">
//left_collapse function
function template_click(template_id,template_name)
{ 
	//alert(template_id); return false;
	var encoded_destroy_session = Base64.encode('template/template_dashboard/set_template_details_in_session/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);

	var redirect_url = document.URL;	
	var ajaxUrl = base_url + find_users_basedon_project;
	jQuery.ajax({
		type:'POST',
		url:ajaxUrl,
		dataType:"json",
		data:'template_id='+template_id+'&template_name='+template_name+'&redirect_url='+redirect_url,
		success:function(res) {
			if(res.status == true){	
				window.location.href= res.redirect_url;
				location.reload(true);
			}
			/* if($('.filter li').hasClass("budget_enable")){
				var encoded_urls = Base64.encode('budget/project_budget/');
				var ajax_encoded_urls = encoded_urls.strtr(encode_chars_obj);
				window.location.href= base_url + ajax_encoded_urls;
			} */
		}
	});
}
</script>