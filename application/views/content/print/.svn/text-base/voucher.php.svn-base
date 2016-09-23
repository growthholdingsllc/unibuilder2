<html>
<head>
	<title>Unibuilder</title>			
	<link rel="stylesheet" href="<?php echo CSSSRC.'red.min.css'; ?>">
	<script type="text/javascript" src="<?php echo JSSRC.'jquery.min.js';?>"></script>
	<script type="text/javascript" src="<?php echo JSSRC.'icheck.min.js';?>"></script>
	<script type="text/javascript">
		$(function(){		  
			window.print();
			 $('input[type=checkbox]').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event) {}).iCheck({
				checkboxClass: 'icheckbox_square-red',
				radioClass: 'iradio_square-red',
				increaseArea: '20%'
			});
	
		});
	</script>
<style type="text/css">
	html,body{
		color: #000;
		font-size: 12px;
		font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
	}
	.tab_budget.table tr td, .tab_budget.table tr th{border:0px;}
	.text-left{
		text-align: left;
	}
	.in_bud_tab{
		border:1px solid #000 !important;
		border-collapse:collapse;
	}
	.in_bud_tab tr td, .in_bud_tab tr th{
		border:1px solid #000 !important;
		border-collapse:collapse;
		padding:5px;
	}
	.under_line{
		height:25px;
		width:100%;
		border-bottom:1px solid #000 !important;
	}
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
		line-height: 1.42857;
		padding: 8px;
		vertical-align: top;
	}
</style>	
</head>
<body>
<table id="tab_customers" class="tab_budget table" <?php if(isset($payment_status['override']) && $payment_status['override']!='No'){?>style="width:900px;background-image: url(<?php echo IMAGESRC.'Voucherwithoverridde.png'; ?>);background-position:50% 50%; background-repeat: no-repeat;background-size: 500px 600px;margin:0px auto; font-size: 12px;font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;"<?php } ?> > 
		<tr>
                <td align="center" colspan="2">
                    <img src="<?php if(isset($this->builder_logo_url) && !empty($this->builder_logo_url))
                        {echo $this->builder_logo_url;} 
                        else{echo IMAGESRC.'print_image/logo.png';}
                        ?>"  alt="logo" width="460" height="124" />
                </td>
        </tr>  
		<tr>
			<td height="40">
				<p style="font-size:18px;color:#727272;text-align:left"><?php echo ucwords($builder_address).' '; ?> </p>
			</td>
			<td>
				<p style="font-size:18px;color:#727272;text-align:right">
				<?php if(!empty($builder_phone)){?><img src="<?php echo IMAGESRC.'print_image/phone.png'; ?>"> Phone : <?php echo $builder_phone; }?>
                </p>
			</td>
			
		</tr>
		<tr>
			<td colspan="2"><hr/></td>
		</tr>
        <tr>
			<td width="50%" class="text-left">
				<table width="100%" style="font-size: 12px;font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;">
					<tr>
						<th height="40" class="text-left">VOUCHER #</th>
						<th class="text-left"><u><?php if(isset($voucher_list['voucher_no']))echo $voucher_list['voucher_no'];?></u></th>
					</tr>
					<tr>
						<th colspan="2"  height="40" class="text-left"><?php if(isset($voucher_list['company']))echo ucwords($voucher_list['company']);?></th>
					</tr>
					<!--<tr>
						<td height="30">LAS VEGAS OFFICE</td><td>RENO OFFICE</td>
					</tr>-->
					<tr>
						<td height="30" class="text-left"><?php if(isset($voucher_list['address']))echo ucwords($voucher_list['address']);?></td><td>&nbsp;</td>
					</tr>
					<tr>
						<td height="30"  class="text-left"><?php if(isset($voucher_list['city']))echo ucwords($voucher_list['city'].', '.$voucher_list['province'].' '.$voucher_list['postal']);?></td><td>&nbsp;</td>
					</tr>
					<tr>
						<td height="30"  class="text-left"><?php if(isset($voucher_list['desk_phone']))echo $voucher_list['desk_phone'];?></td><td><?php if(isset($voucher_list['mobile_phone']))echo $voucher_list['mobile_phone'];?></td>
					</tr>
					<tr>
						<td height="30" class="text-left"><?php if(isset($voucher_list['fax']))echo $voucher_list['fax'];?></td>
					</tr>
				</table>
			</td>
			<td width="50%" class="text-left">
				<table width="100%" style="font-size: 12px;font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;">
					<tr>
						<th width="40%" class="text-left">Date:</th>
						<td class="under_line text-left" width="60%"><?php echo date("F j, Y")?></td>
					</tr>
					<tr>
						<th height="40" class="text-left">Project #:</th>
						<td class="under_line text-left"><?php if(isset($voucher_list['project_no']))echo $voucher_list['project_no'];?></td>
					</tr>
					<tr>
						<th height="30" class="text-left">Project Name:</th>
						<td class="under_line text-left"><?php if(isset($voucher_list['project_name']))echo $voucher_list['project_name'];?></td>
					</tr>
					<tr>
						<th height="30" class="text-left">Project Address:</th>
						<td class="under_line text-left"><?php if(isset($voucher_list['project_address']))echo $voucher_list['project_address'];?></td>
					</tr>
					<tr>
						<th height="30" class="text-left">&nbsp;</th>
						<td class="under_line text-left"><?php if(isset($voucher_list['project_address']))echo ucwords($voucher_list['project_city'].', '.$voucher_list['project_province'].' '.$voucher_list['project_postal']);?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th colspan="2" height="40"><u>A TRUE COPY OF THE INVOICE, SATISFACTORY LABOR AND/OR MATERIAL RELEASES, APPLICABLE LIEN RELEASE, W-9 AND SUBCONTRACT IF APPLICABLE MUST BE PRESENTED WITH THIS ORDER.</u></th>
		</tr>
		<tr>
			<td colspan="2"><strong>PAYMENT VOUCHER</strong> <u><i>(Non- Negotiable)</i></u> </td>
		</tr>
		<tr>
			<td colspan="2">Pay to the Order of <u><strong><?php if(isset($voucher_list['company']))echo ucwords($voucher_list['company']);?></strong></u></td>
		</tr>
		<tr>
			<td colspan="2"><u><?php if(isset($voucher_list['address']))echo ucwords($voucher_list['address'].', '.$voucher_list['city'].', '.$voucher_list['province'].' '.$voucher_list['postal']);?></u></td>
		</tr>
		<tr>
			<td colspan="2">The sum of <u>
				<?php 
					$gross_amount_total = 0;
					$retention_amount_total = 0;
					$net_amount_total = 0;
					if(isset($voucher_transaction)){
					foreach($voucher_transaction as $key => $val)
					{
					$gross_amount_total = $gross_amount_total + $val['gross_amount'];
					$retention_amount_total = $retention_amount_total + $val['retention_amount'];
					$net_amount_total = $net_amount_total + $val['net_amount'];
					}
					}
					echo $net_amount_total;
				?></u></td>
		</tr>
		<tr>
			<td colspan="2"><strong>In payment for labor and/or materials described as follows:</strong> <u>Grading Prior to Construction</u></td>
		</tr>
		<tr>
			<td>Charge Cost Breakdown Item(s):</td>
			<td>e-mail:<u><?php if(isset($voucher_list['email']))echo $voucher_list['email'];?></u> fax:<u><?php if(isset($voucher_list['fax']))echo $voucher_list['fax'];?></u></td>
		</tr>
		<tr>
			<td width="50%">
				<table width="100%" class="in_bud_tab" style="font-size: 12px;font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;">
					<tr>
						<th>Line#</th>
						<th>Gross Amount</th>
						<th>Retention</th>
						<th>Net Amount</th>
					</tr>
					<?php 
					if(isset($voucher_transaction)){
					foreach($voucher_transaction as $key => $val)
					{
					?>
					<tr>
						<td><?php echo $key+1;?></td>
						<td><?php echo round($val['gross_amount']);?></td>
						<td><?php echo round($val['retention_amount']);?></td>
						<td><?php echo round($val['net_amount']);?></td>
					</tr>
					<?php 
					}
					}
					?>
					<tr>
						<th>Total:</th>
						<th><?php echo $gross_amount_total;?></th>
						<th><?php echo $retention_amount_total;?></th>
						<th><?php echo $net_amount_total;?></th>
					</tr>
				</table>
			</td>
			<!--<td width="50%">
				<table width="100%" class="in_bud_tab">
					<tr>
						<th>Line#</th>
						<th>Gross Amount</th>
						<th>Retention</th>
						<th>Net Amount</th>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>Total:</td>
						<td><?php echo $gross_amount_total;?></td>
						<td><?php echo $retention_amount_total;?></td>
						<td><?php echo $net_amount_total;?></td>
					</tr>
				</table>
			</td>-->
		</tr>
       <tr>
		<td colspan="2">
		<p class="text-left">FOR THE PURPOSE OF INDUCING NEVADA CONSTRUCTION SERVICES TO MAKE PAYMENT FOR LABOR, SERVICES AND/OR MATERIALS FURNISHED IN CONNECTION WITH THE CONSTRUCTION OF CERTAIN BUILDINGS AND WORK IMPROVEMENT ON THE ABOVE DESCRIBED PROPERTY, THE UNDERSIGNED REPRESENTS, CERTIFIES AND AGREES</p>
		<p class="text-left">(1) THAT UPON THE ISSUANCE OF YOUR CHECK FOR THE ABOVE AMOUNT, THE UNDERSIGNED HEREBY WAIVES ANY AND ALL LIEN RIGHTS WHICH HE MAY HAVE OR MAY HAVE HAD ON ACCOUNT OF OR ARISING OUT OF THE CONSTRUCTION OF SAID BUILDINGS AND WORK OF IMPROVEMENT TO THE EXTENT OF SUCH PAYMENT WITH RESPECT TO THE WORK HEREINABOVE DESCRIBED.</p>
		<p class="text-left">(2) FOR THE PURPOSE OF OBTAINING PAYMENT, THE UNDERSIGNED CERTIFIES THAT THE LABOR AND/OR MATERIALS HAVE ACTUALLY PERFORMED AND/OR DELIVERED BY THE PERSON'S AND/OR FIRMS AND/OR CORPORATIONS NAMED HEREIN AS UNDERSIGNED, AND THAT ALL CLAIMS, BILLS AND LIABILITIES WHETHER FOR LABOR PERFORMED OR MATERIALS FURNISHED HAVE BEEN PAID IN FULL AND RECEIPTS THEREFORE, SIGNED BY THE PERSONS ENTITLED TO RECEIVE PAYMENT, HAVE BEEN OBTAINED BY THE UNDERSIGNED.</p>
		<p class="text-left">(3) that such statements herein made are made for the purpose of obtaining funds and that the amount hereinabove set forth in this voucher represents the full sum owed an amount not greater than the fair market value for materials or a reasonable value for labor with respect to the furnishing of materials and/or labor upon the above described property to the extent of the work described in this voucher.</p>
		<p class="text-left">(4) THE UNDERSIGNED DECLARES UNDER PENALTY OF PERJURY THAT NO PARTY TO THE ABOVE-DESCRIBED PROJECT OR THIS TRANSACTION HAS RECEIVED OR WILL RECEIVE DIRECTLY OR INDIRECTLY ANY REBATE(KICK-BACK) FROM THE AMOUNT OF THIS VOUCHER.</p>
		<p class="text-left">(5) THE UNDERSIGNED DECLARE UNDER PENALTY OF PERJURY. GENERAL CONTRACTOR AND/OR OWNER AND/OR SUBCONTRACTOR AND/OR MATERIAL SUPPLIERS: THAT THE AMOUNTS SHOWN ON THIS VOUCHER ARE TRUE AND CORRECT.</p>
		</td>
	   </tr>
	   <tr>
		<td colspan="2">
			<strong>Document lists</strong>
		</td>
	   </tr>
	   <tr>
		<td colspan="2">
			<table width="100%" class="in_bud_tab" style="font-size: 12px;font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;">
			<?php 
			if(isset($voucher_documents)){
			foreach($voucher_documents as $key => $val)
			{
			?>
				<tr><td><?php echo $val['name'];?></td></tr>
			<?php 
			}
			}
			else
			{
			?>
				<tr><td><?php echo "No Documents Available" ?></td></tr>
			<?php 
			}
			?>
			</table>
		</td>
	   </tr>
	   <tr>
		<td colspan="2">
			<table width="100%" style="font-size: 12px;font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;">
				<tr>
					<td><span><input type="checkbox" /></span> <strong>Mail Check</strong></td>
					<td><span><input type="checkbox" /></span> <strong>Pick-up Check</strong></td>
					<td><span><input type="checkbox" /></span> <strong>General Contractor Pickup</strong></td>
				</tr>				
			</table>
		</td>
	   </tr>
	   <tr>
		<td>
			<p class="under_line"></p>
			<div class="pull-left"><?php echo ucwords($builder_name); ?></div>
			<div class="pull-right">(Date)</div>
		</td>
		<td>
			<p class="under_line">SUBCONTRACTOR OR MATERIAL SUPPLIER ND concrete</p>
		</td>
	   </tr>
	   <tr>
		<td>
			<p class="under_line"></p>
			<div class="pull-left">Progressive Construction dba <?php echo $builder_name; ?></div>
			<div class="pull-right">(Date)</div>
		</td>
		<td>
			<p class="under_line">By:</p>
			<div class="pull-right">(Date)</div>
		</td>
	   </tr>
	   <tr>
		<td colspan="2">
		<p class="text-center"><i><strong>If we've pleased you... tell your friends. If not... tell us.</strong></i></p>
		<p class="text-center">proprietary &amp; Confidential  for ncs use only</p>
		</td>
	   </tr>
    </table>
</body>
</html>