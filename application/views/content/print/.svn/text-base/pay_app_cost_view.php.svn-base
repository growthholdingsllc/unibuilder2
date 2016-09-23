<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php  //echo "<pre>"; print_r($sum_pay_app_summary_args);exit; ?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Unibuilder</title>
        <style type="text/css">
			/* .first_column
			{
				-webkit-column-width: 22% !important;
				-moz-column-width: 17% !important;
				border-right:1px solid #ccc;
			} */
			@-moz-document url-prefix() {
			.first_column
				{
					width:17%;
				}
			}
			@page { size: landscape; } 
            body table tr td blockquote blockquote {
            }
            blockquote {
            text-align: left;
            }
            td {
            font-family: Arial, Helvetica, sans-serif;
            text-align: justify;
            }
            strong {
            font-size: 10px;
            }
            body table tr td table tr td {
            font-weight: bold;
            font-size: 10px;
            text-align: center;
            }
            p {
            font-size: 10px;
            font-weight: normal;
			margin:0px 0px;			
            }
			.inner-tab p{
				height:25px;
			}
            body table tr td {
            text-align: right;
            }
            body table tr td table tr td {
            text-align: left;
            font-weight: bold;
            font-size: 10px;
            }
            td {
            text-align: left;
            }
            div {
            text-align: left;
            }
            .pay {
            text-align: left;
            }
            .pay p {
            text-align: justify;
            }
            body table tr td table tr th {
            font-size: 10px;
            }
			.print_tit_bg{
				background-color: #999999;				
				-webkit-print-color-adjust: exact
			}	
			.table_loop_0{
				margin-top:20px;
			}
			.table_loop_16, .table_loop_32, .table_loop_48, .table_loop_64, .table_loop_80, .table_loop_96, .table_loop_112, .table_loop_128, .table_loop_144,.table_loop_160, .table_loop_176, .table_loop_192, .table_loop_208, .table_loop_224, .table_loop_240, .table_loop_256, .table_loop_272, .table_loop_288, .table_loop_304{
				margin-top:45px;
			}
			
        </style>
        <script type="text/javascript" src="<?php echo JSSRC.'jquery.min.js';?>"></script>
        <script type="text/javascript">
            $(function(){		  
            window.print();
            });
        </script>	
    </head>
    <body>
        <table width="100%" border="0" style="color:#333333">
            <tr>
                <td>
                    <table width="100%" border="0" style="margin:0;padding:0">
                        <tr>
                            <td width="826" align="right" style="margin:0;padding:0">
                                <blockquote>
                                    <blockquote>
                                        <p>&nbsp;</p>
                                        <p><img src="<?php if(isset($this->builder_logo_url) && !empty($this->builder_logo_url))
                                            {echo $this->builder_logo_url;} 
                                            else{echo IMAGESRC.'print_image/logo.png';}
                                            ?><?php //echo IMAGESRC.'print_image/footer-logo.png'; ?>" width="200" height="54" /></p>
                                        <p> <?php echo ucwords($builder_details['builder_address']).' '; ?> </p>
                                    </blockquote>
                                </blockquote>
                            </td>
                            <td width="263" align="left" valign="bottom" style="margin:0;padding:0">
                                <h5><strong>CONTINIUATION STEET</strong></h5>
                                <p>Project Name: <?php echo $builder_details['project_address']['project_name']; ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="margin:0;padding:0">
                    <hr/>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%" border="0">
                        <tr>
                            <td width="76%">&nbsp;</td>
                            <td width="24%" align="right" valign="top" style="margin:0;padding:0;" height="40px">
                                <p style="margin:0;padding:0">Pay App#: <?php echo isset($builder_details['payapp_info_data']['payapp_number'])?$builder_details['payapp_info_data']['payapp_number']:''; ?></p>
                                <p>Release Date: <?php echo isset($builder_details['payapp_info_data']['modified_on'])?$builder_details['payapp_info_data']['modified_on']:''; ?></p>
                                <p>Period To: <?php echo isset($builder_details['payapp_info_data']['payapp_period_to'])?$builder_details['payapp_info_data']['payapp_period_to']:''; ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="" class="inner-tab">
                    <table width="100%" border="0" style="border:1px solid #ccc;" cellspacing="0" cellpadding="5" >
                        <tr>
                            <td width="22%" align="center" style="border-right:1px solid #ccc;">Cost Code</td>
                            <th width="8%" align="center" style="border-right:1px solid #ccc;">Budgeted Value</th>
                            <td width="8%" style="border-right:1px solid #ccc;">Scheduled Value</td>
                            <td width="8%" style="border-right:1px solid #ccc;">From Prev App</td>
                            <td width="8%" style="border-right:1px solid #ccc;">This Period</td>
                            <td width="8%" style="border-right: 1px solid #ccc; font-weight: bold;">Value of Materials Stored<br/>
                                (Not in work completed)
                            </td>
                            <td width="10%" style="border-right:1px solid #ccc;">Total Completed and stored till date</td>
                            <td width="7%" style="border-right:1px solid #ccc;">% of work done</td>
                            <td width="7%" style="border-right:1px solid #ccc;">Balance to be finished</td>
                            <td width="7%" style="border-right:1px solid #ccc;">Retainage %</td>
                            <td width="7%" >Retainage amount</td>
                        </tr>
                        <tr style="border:1px solid #ccc;">
                            <td colspan="11" bgcolor="#999" class="print_tit_bg">Estimate</td>
                        </tr>
                        <?php foreach($pay_app_summary_args as $key=>$val){?>
                        <tr>
                            <td width="22%" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['cost_code_name']; ?></p>
                            </td>
                            <td width="8%" align="right" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['budgeted_value']; ?></p>
                            </td>
                            <td width="8%" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['scheduled_value']; ?></p>
                            </td>
                            <td width="8%" align="right" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['from_prev_app']; ?></p>
                            </td>
                            <td width="8%" align="right" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['this_period']; ?></p>
                            </td>
                            <td width="8%" align="right" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['value_of_material_stored']; ?></p>
                            </td>
                            <td width="10%" align="right" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['total_completed_and_stored_till_date']; ?></p>
                            </td>
                            <td width="7%" align="right" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['percentage_of_work_done']; ?></p>
                            </td>
                            <td width="7%" align="right" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['balance_to_be_finished']; ?></p>
                            </td>
                            <td width="7%" align="right" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['retainage']; ?></p>
                            </td>
                            <td width="7%" align="right" valign="top" style="border-right:0px solid #ccc;">
                                <p><?php echo $val['retainage_amount']; ?></p>
                            </td>
                        </tr>
                        <?php } ?>
						</table>
						<?php if(isset($pay_app_reminning_page_array) && !empty($pay_app_reminning_page_array)) {
							$loop_array = array_chunk($pay_app_reminning_page_array, 16);
							$j = 0;
							foreach($loop_array as $key=>$value){ 
							
							?>
							
								<table width="100%" border="0" style="border:1px solid #ccc;" cellspacing="0" cellpadding="5" class="table_loop_<?php echo $j;?>">
									<tr>
										<td width="22%" align="center" style="border-right:1px solid #ccc;">Cost Code</td>
										<th width="8%" align="center" style="border-right:1px solid #ccc;">Budgeted Value</th>
										<td width="8%" style="border-right:1px solid #ccc;">Scheduled Value</td>
										<td width="8%" style="border-right:1px solid #ccc;">From Prev App</td>
										<td width="8%" style="border-right:1px solid #ccc;">This Period</td>
										<td width="8%" style="border-right: 1px solid #ccc; font-weight: bold;">Value of Materials Stored<br/>
											(Not in work completed)
										</td>
										<td width="10%" style="border-right:1px solid #ccc;">Total Completed and stored till date</td>
										<td width="7%" style="border-right:1px solid #ccc;">% of work done</td>
										<td width="7%" style="border-right:1px solid #ccc;">Balance to be finished</td>
										<td width="7%" style="border-right:1px solid #ccc;">Retainage %</td>
										<td width="7%" >Retainage amount</td>
									</tr>
									<tr style="border:1px solid #ccc;">
										<td colspan="11" width="100%" bgcolor="#999" class="print_tit_bg">Estimate</td>
									</tr>
									<?php foreach($value as $key=>$val){ ?>
									<!-- table content -->
									<tr>
										<td width="22%" valign="top" style="border-right:1px solid #ccc;">
											<p><?php echo $val['cost_code_name']; ?></p>
										</td>
										<td width="8%" align="right" valign="top" style="border-right:1px solid #ccc;">
											<p><?php echo $val['budgeted_value']; ?></p>
										</td>
										<td width="8%" valign="top" style="border-right:1px solid #ccc;">
											<p><?php echo $val['scheduled_value']; ?></p>
										</td>
										<td width="8%" align="right" valign="top" style="border-right:1px solid #ccc;">
											<p><?php echo $val['from_prev_app']; ?></p>
										</td>
										<td width="8%" align="right" valign="top" style="border-right:1px solid #ccc;">
											<p><?php echo $val['this_period']; ?></p>
										</td>
										<td width="8%" align="right" valign="top" style="border-right:1px solid #ccc;">
											<p><?php echo $val['value_of_material_stored']; ?></p>
										</td>
										<td width="10%" align="right" valign="top" style="border-right:1px solid #ccc;">
											<p><?php echo $val['total_completed_and_stored_till_date']; ?></p>
										</td>
										<td width="7%" align="right" valign="top" style="border-right:1px solid #ccc;">
											<p><?php echo $val['percentage_of_work_done']; ?></p>
										</td>
										<td width="7%" align="right" valign="top" style="border-right:1px solid #ccc;">
											<p><?php echo $val['balance_to_be_finished']; ?></p>
										</td>
										<td width="7%" align="right" valign="top" style="border-right:1px solid #ccc;">
											<p><?php echo $val['retainage']; ?></p>
										</td>
										<td width="7%" align="right" valign="top" style="border-right:0px solid #ccc;">
											<p><?php echo $val['retainage_amount']; ?></p>
										</td>
									</tr>
									
									
							<?php $j++;} ?>
						</table><?php  } 
						
						 } ?>
						 <br />
						<table width="100%" border="0" style="border:1px solid #ccc;" cellspacing="0" cellpadding="5">
                        <?php foreach($total_pay_app_summary_args as $key=>$val){?>
						
                        <tr>
                            <td width="22%" class="first_column" style="border-right:1px solid #ccc;border-top:0px solid #ccc;">Total</td>
                            <td width="8%" style="border-right:1px solid #ccc;border-top:0px solid #ccc;"><strong><?php echo $val['total_budgeted_value']; ?></strong></td>
                            <td width="8%" align="right" style="border-right:1px  solid #ccc;border-top:0px solid #ccc;"><strong><?php echo $val['total_scheduled_value']; ?></strong></td>
                            <td width="8%" align="right" style="border-right:1px  solid #ccc;border-top:0px solid #ccc;"><strong><?php echo $val['total_from_prev_app']; ?></strong></td>
                            <td width="8%" align="right" style="border-right:1px  solid #ccc;border-top:0px solid #ccc;"><strong><?php echo $val['total_this_period']; ?></strong></td>
                            <td width="8%" align="right" style="border-right:1px  solid #ccc;border-top:0px solid #ccc;"><strong><?php echo $val['total_value_of_material_stored']; ?></strong></td>
                            <td width="10%" align="right" style="border-right:1px  solid #ccc;border-top:0px solid #ccc;"><strong><?php echo $val['completed_and_stored_till_date']; ?></strong></td>
                            <td width="7%" align="right" style="border-right:1px  solid #ccc;border-top:0px solid #ccc;"><strong><?php echo $val['total_percentage_of_work_done']; ?></strong></td>
                            <td width="7%" align="right" style="border-right:1px solid #ccc;border-top:0px solid #ccc;"><strong><?php echo $val['total_balance_to_be_finished']; ?></strong></td>
                            <td width="7%" align="right" style="border-right:1px solid #ccc;border-top:0px solid #ccc;"><strong><?php echo $val['total_retainage']; ?></strong></td>
                            <td width="7%" align="right" style="border-right:0px solid #ccc;border-top:0px solid #ccc;"><strong><?php echo $val['total_retainage_amount']; ?></strong></td>
                        </tr>
                        <?php } ?>
						</table>
						<br />
						<table width="100%" border="0" style="border:1px solid #ccc;" cellspacing="0" cellpadding="5">
                        <tr>
                            <td colspan="11" width="100%" bgcolor="#999" align="left" class="print_tit_bg">Change Order</td>
                        </tr>
						
                        <?php foreach($total_pay_app_co_summary_args as $key=>$val){?>
                        <tr>
                            <td width="22%" align="right" valign="top" class="first_column" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['cost_code_name']; ?></p>
                            </td>
                            <td width="8%" align="right" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['budgeted_value']; ?></p>
                            </td>
                            <td width="8%" align="right" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['scheduled_value']; ?></p>
                            </td>
                            <td width="8%" align="right" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['from_prev_app']; ?></p>
                            </td>
                            <td width="8%" align="right" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['this_period']; ?></p>
                            </td>
                            <td width="8%" align="right" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['value_of_material_stored']; ?></p>
                            </td>
                            <td width="10%" align="right" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['total_completed_and_stored_till_date']; ?></p>
                            </td>
                            <td width="7%" align="right" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['percentage_of_work_done']; ?></p>
                            </td>
                            <td width="7%" align="right" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['balance_to_be_finished']; ?></p>
                            </td>
                            <td width="7%" align="right" valign="top" style="border-right:1px solid #ccc;">
                                <p><?php echo $val['retainage']; ?></p>
                            </td>
                            <td width="7%" align="right" valign="top" style="border-right:0px solid #ccc;">
                                <p><?php echo $val['retainage_amount']; ?></p>
                            </td>
                        </tr>
                        <?php } ?>
						 </table>
						 <br />
						 <table width="100%" border="0" style="border:1px solid #ccc;" cellspacing="0" cellpadding="5">
                        <?php foreach($sum_pay_app_summary_args as $key=>$val){?>
						
                        <tr>
                            <td width="22%" class="first_column" style="border-right:1px solid #ccc;">Total</td>
                            <td width="8%" align="right" style="border-right:1px solid #ccc;"><?php echo $val['total_budgeted_value']; ?></td>
                            <td width="8%" align="right" style="border-right:1px solid #ccc;"><?php echo $val['total_scheduled_value']; ?></td>
                            <td width="8%" align="right" style="border-right:1px solid #ccc;"><?php echo $val['total_from_prev_app']; ?></td>
                            <td width="8%" align="right" style="border-right:1px solid #ccc;"><?php echo $val['total_this_period']; ?></td>
                            <td width="8%" align="right" style="border-right:1px solid #ccc;"><?php echo $val['total_value_of_material_stored']; ?></td>
                            <td width="10%" align="right" style="border-right:1px solid #ccc;"><?php echo $val['completed_and_stored_till_date']; ?></td>
                            <td width="7%" align="right" style="border-right:1px solid #ccc;"><?php echo $val['total_percentage_of_work_done']; ?></td>
                            <td width="7%" align="right" style="border-right:1px solid #ccc;"><?php echo $val['total_balance_to_be_finished']; ?></td>
                            <td width="7%" align="right" style="border-right:1px solid #ccc;"><?php echo $val['total_retainage']; ?></td>
                            <td width="7%" align="right" style="border-right:0px solid #ccc;"><?php echo $val['total_retainage_amount']; ?></td>
                        </tr>
                        <?php } ?>
						</table>
                   
                </td>
            </tr>
            <!--<tr>
                <td>&nbsp;</td>
            </tr>-->
        </table>
        <p>&nbsp;</p>
    </body>
</html>
