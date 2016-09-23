function ubdatatable(dbobject)
{
	
   dbobject.tableName.dataTable().fnDestroy();
	var table =  dbobject.tableName.dataTable({
			"aLengthMenu": [
				[pagination_length_one, pagination_length_two, pagination_length_three, pagination_length_four],
				[pagination_length_one, pagination_length_two, pagination_length_three, pagination_length_four]
			],

			// retrieve: true,		
			"bPaginate": true,
			"bJQueryUI" : true,
			"displayStart": displayStart,
			"iDisplayLength": default_pagination_length,
			"bServerSide": true,
			"bProcessing": true,
			"sServerMethod": "POST",
			sAjaxSource: base_url + dbobject.ajax_encoded_url,
			"aoColumnDefs": typeof dbobject.column_defs !== 'undefined' ? dbobject.column_defs : '[{}]',
			"fnServerData": function ( sSource, aoData, fnCallback ) {								
				var result = $.parseJSON(dbobject.post_data);
				$.each(result, function(k, v) {
					 // alert(k + ' = ' +v)
					aoData.push( { "name": k, "value": v } );	
					setTimeout(checkbox, 3000);
										
				});
				$.ajax( {
					"dataType": 'json',
					"type": "POST",
					"url": sSource,
					"data": aoData,
					"success": fnCallback                  
				});
				
			 },	
				
			 // destroy: true,
			"fnRowCallback": function(nRow, data, iDisplayIndex, iDisplayIndexFull, status) {
				// Edit Data
				$('.uni_wrapper').removeClass('loadingDiv');	
				var table_name = typeof dbobject.this_table !== 'undefined' ? dbobject.this_table.table_name : 'notable';				
				if( table_name == 'lead_activity_view')
				{
					var encoded_string_edit_role = Base64.encode( dbobject.edit_data.url + data[dbobject.parent_id] + '/' + data[dbobject.id]);	
					//alert("hiii");
				}else
				{
					var encoded_string_edit_role = Base64.encode( dbobject.edit_data.url + data[dbobject.id]);		
				}
				var encoded_edit_val = encoded_string_edit_role.strtr(encode_chars_obj);
				if ( table_name == 'lead_activity') 
				{
					$('td:eq('+dbobject.edit_data.index+')', nRow).html('<a class="edit-role" href="javascript:void(0);" onclick="get_activity_form('+ data[dbobject.id] +')">'+data[dbobject.name]+'</a>');
				}
				else if(table_name == 'selection_choices')
				{
					
							$('td:eq('+dbobject.edit_data.index+')', nRow).html('<a class="edit-role" href="javascript:void(0);" onclick="get_selection_choices_form('+ data[dbobject.id] +','+ choice_dir_id +')">'+data[dbobject.name]+'</a>');
						
				}
				else
				{
					$('td:eq('+dbobject.edit_data.index+')', nRow).html('<a class="edit-role activity_tab_act" href="'+base_url + encoded_edit_val + '">'+data[dbobject.name]+'</a>');
				}
				//Selection code was added by chandru
				// Delete Data
				if ( table_name == 'lead_activity') 
				{
					if ( data[dbobject.mark_status] == 'Yes') 
					{
						$('td:eq('+dbobject.update_data.index+')', nRow).html('<input type="checkbox" value="'+ data[dbobject.id] +'" id="'+ data[dbobject.id] +'" class="chk activity_status" checked="checked"/>');
					}	
					else
					{
						$('td:eq('+dbobject.update_data.index+')', nRow).html('<input type="checkbox" value="'+ data[dbobject.id] +'" id="'+ data[dbobject.id] +'" class="chk activity_status"/>');
					}
				}
				else
				{
					$('td:eq('+dbobject.delete_data.index+')', nRow).html('<input type="checkbox" value="'+ data[dbobject.id] +'" class="chk" />');	
				}
				

				if( table_name == 'Projects_List')
				{
					if(!data[dbobject.lat_long])
					{
					}
					else
					{
						// Map Data
						var img_src = base_url + 'assets/images/marker.png';
						$('td:eq('+dbobject.map_data.index+')', nRow).html('<img src="'+ img_src +'" />');	
					}	
				}
				
				/* Used only for log list page */
				if( table_name == 'Logs_List')
				{
					if(data[dbobject.lengthe] > 75)
					{
						$('td:eq('+dbobject.length_val.index+')', nRow).append('<strong> ......</strong>');
					}
					if(!data[dbobject.viewable_by])
					{
					}
					else
					{
						$('td:eq('+dbobject.privated.index+')', nRow).html('');
						if(data[dbobject.privates] == 'Yes')
						{	
							var img_src_private = base_url + 'assets/images/strip.gif';
							$('td:eq('+dbobject.privated.index+')', nRow).append('<img src="'+ img_src_private +'" class="uni_builder" title="Private" />'+' ');
						}
						if(data[dbobject.show_subs] == 'Yes')
						{
							var img_src_subs = base_url + 'assets/images/strip.gif';
							$('td:eq('+dbobject.sub.index+')', nRow).append('<img src="'+ img_src_subs +'" class="uni_sub" title="Subs" />'+' ');
						}
						if(data[dbobject.show_owner] == 'Yes')
						{
							var img_src_owner = base_url + 'assets/images/strip.gif';
							$('td:eq('+dbobject.owner.index+')', nRow).append('<img src="'+ img_src_owner +'" class="uni_owner" title="Owners" />');
						}	
					}	
				}

				/* Used only for warranty list page */
				if( table_name == 'Warranty_List')
				{
					
						$('td:eq('+dbobject.status.index+')', nRow).html('');
						if(data[dbobject.status_val] == 'New')
						{	
							var img_src = base_url + 'assets/images/strip.gif';
							$('td:eq('+dbobject.status.index+')', nRow).append('<img src="'+ img_src +'" class="uni_new" />'+' '+data[dbobject.status_val]);
						}
						if(data[dbobject.status_val] == 'Open')
						{	
							var img_src = base_url + 'assets/images/strip.gif';
							$('td:eq('+dbobject.status.index+')', nRow).append('<img src="'+ img_src +'" class="uni_approval_pending" />'+' '+data[dbobject.status_val]);
						}
						if(data[dbobject.status_val] == 'Reschedule Appt.')
						{	
							var img_src = base_url + 'assets/images/strip.gif';
							$('td:eq('+dbobject.status.index+')', nRow).append('<img src="'+ img_src +'" class="uni_status_pending" />'+' '+data[dbobject.status_val]);
						}
						if(data[dbobject.status_val] == 'Needs Rework')
						{	
							var img_src = base_url + 'assets/images/strip.gif';
							$('td:eq('+dbobject.status.index+')', nRow).append('<img src="'+ img_src +'" class="uni_pending" />'+' '+data[dbobject.status_val]);
						}
						if(data[dbobject.status_val] == 'Closed')
						{	
							var img_src = base_url + 'assets/images/strip.gif';
							$('td:eq('+dbobject.status.index+')', nRow).append('<img src="'+ img_src +'" class="uni_approve" />'+' '+data[dbobject.status_val]);
						}
						
					
				}

				/* Used only for warranty list page */
				if( table_name == 'po_payment_list')
				{
						if(data[dbobject.payment_request_status] != 'Paid' && data[dbobject.payment_request_status] != 'Partial payment done')
						{
						  $('td:eq('+dbobject.modified_on.index+')', nRow).html('');
						  $('td:eq('+dbobject.pay_to.index+')', nRow).html('');
					    }
						
						
					
				}
				//Budget PO Co module
				
				if( table_name == 'po_vocher_payment_list')
				{
				
					$('td:eq('+dbobject.enter_amount.index+')', nRow).html('-');
					
					/*$('td:eq('+dbobject.enter_amount.index+')', nRow).on( 'click', function (e) {
					$('td:eq('+dbobject.enter_amount.index+')', nRow).html('<input type="text" class="form-control" />');	
					});	*/		
				}

				//comments div for message module
				if( table_name == 'comments_list')
				{
					var imgLink = base_url + 'assets/images/';
					$('td:eq('+dbobject.owner_coloumn.index+')', nRow).html('');
					$('td:eq('+dbobject.builder_coloumn.index+')', nRow).html('');
					$('td:eq('+dbobject.sub_coloumn.index+')', nRow).html('');
					var owner_con = '';
					var builder_users_con = '';
					var subs_con = '';

					$.each(data, function(i, item) {
						//alert(item);
						  	if(i=='owner'){
						  		$.each(data[i], function(j, items) {
								    //alert(items['comments'].toSource());
								    var module_name = items['module_name'];
								    var module_pk_id = items['module_pk_id'];
								    var project_id = items['project_id'];
								    var id = module_name + ',' + module_pk_id +',' + project_id; 
								    //alert(module_name);
								    if(items['length'].length > 250)
								    {
								    	
								    	items['comments'] = items['comments'] + '....';
								    }
								    owner_con = '<div class="text-left owner_over_flow alert alert-info">'+ items['comments'] +'<p><p>Added By: '+ items['first_name'] +'</p></p><div class="m-top pull-right"><a href="javascript:void(0);" data-toggle="modal" data-target="#commentModal"><button type="button" class="btn btn-blue " id="'+id+'" onclick="reply(this.id)"><img src="'+imgLink+'strip.gif" class="mail-reply" /> Reply</button></a></div></div>';
								    $('td:eq('+dbobject.owner_coloumn.index+')', nRow).append(owner_con);
								});
							}
						});
					$.each(data, function(i, item) {
							if(i=='builder'){
						  		$.each(data[i], function(j, items) {
								    //alert(items['comments'].toSource());
								    var module_name = items['module_name'];
								    var module_pk_id = items['module_pk_id'];
								    var project_id = items['project_id'];
								    var id = module_name + ',' + module_pk_id +',' + project_id;
								    //alert(items['length'].length); 
								    if(items['length'].length > 250)
								    {
								    	
								    	items['comments'] = items['comments'] + '....';
								    }
								    //alert(items['comments'].length);
								    builder_users_con = '<div class="text-left builder_over_flow alert alert-warning">'+ items['comments'] +'<p><p>Added By: '+ items['first_name'] +'</p></p><div class="m-top pull-right"><a href="javascript:void(0);" data-toggle="modal" data-target="#commentModal"><button type="button" class="btn btn-blue" id="'+id+'" onclick="reply(this.id)"><img src="'+imgLink+'strip.gif" class="mail-reply" /> Reply</button></a></div></div>';
								     $('td:eq('+dbobject.builder_coloumn.index+')', nRow).append(builder_users_con);
								});
								
							}
						});
					$.each(data, function(i, item) {
							if(i=='sub'){
						  		$.each(data[i], function(j, items) {
								    //alert(items['comments'].toSource());
								    var module_name = items['module_name'];
								    var module_pk_id = items['module_pk_id'];
								    var project_id = items['project_id'];
								    var id = module_name + ',' + module_pk_id +',' + project_id; 
								    if(items['length'].length > 250)
								    {
								    	
								    	items['comments'] = items['comments'] + '....';
								    }
								    subs_con = '<div class="text-left sub_over_flow alert alert-success">'+ items['comments'] +'<p><p>Added By: '+ items['first_name'] +'</p></p><div class="m-top pull-right"><a href="javascript:void(0);" data-toggle="modal" data-target="#commentModal"><button type="button" class="btn btn-blue " id="'+id+'" onclick="reply(this.id)"><img src="'+imgLink+'strip.gif" class="mail-reply" /> Reply</button></a></div></div>';
								    $('td:eq('+dbobject.sub_coloumn.index+')', nRow).append(subs_con);
								});
							}
						});
					
				}
				/* Used only for schedules module listview  */
				if( table_name == 'schedule_list')
				{
				  var currentdate = new Date().getTime();
				  var startdate = new Date(data[dbobject.start_date]).getTime() ; 
				  var enddate = new Date(data[dbobject.end_date]).getTime() ;
				  
					//alert(currentdate);
				   if ( data[dbobject.is_completed] == 'Yes') 
					{
					
					  $('td:eq('+dbobject.status.index+')', nRow).html('Completed');
					
					}
				   else if(startdate >= currentdate )
				   {
				      $('td:eq('+dbobject.status.index+')', nRow).html('Upcoming');
				   }
				   else if(startdate <= currentdate)
				   {
				      $('td:eq('+dbobject.status.index+')', nRow).html('Inprogress');
				   }
				 
				}
				/* Used only for schedules module workdays  */
				if( table_name == 'workdays_exception')
				{
				  if( data[dbobject.exception_type] == -1)
				  {
				  $('td:eq('+dbobject.type.index+')', nRow).html('Non Workday');
				  }
				  else {
					$('td:eq('+dbobject.type.index+')', nRow).html('Extra Workday');
				  }
				  if(data[dbobject.totaldays] > 0)
				  {
				   $('td:eq('+dbobject.days.index+')', nRow).html(data[dbobject.totaldays]);
				  }
				  else{
				   var total_day = data[dbobject.totaldays] * -1 ;
				   $('td:eq('+dbobject.days.index+')', nRow).html(total_day);
				  }
				}
				
				/* Used only for schedules module baselineview  */
				if( table_name == 'Calendar_Baselineview')
				{		  
				   if ( data[dbobject.is_completed] == 'Yes') 
					{
					  $('td:eq('+dbobject.status.index+')', nRow).html('Completed');
					}
				   else if ( data[dbobject.is_completed] == 'No') 
					{
					  $('td:eq('+dbobject.status.index+')', nRow).html('In Progress');
					}
					if( !data[dbobject.baseline_start_date])
					{
						data[dbobject.baseline_start_date] = 'NA';
					}
					if( !data[dbobject.baseline_end_date])
					{
						data[dbobject.baseline_end_date] = 'NA';
					}
					if( !data[dbobject.basedays])
					{
						data[dbobject.basedays] = 'NA';
					}
					$('td:eq('+dbobject.actual_start_date.index+')', nRow).append(' ('+data[dbobject.baseline_start_date]+')');
					$('td:eq('+dbobject.actual_end_date.index+')', nRow).append(' ('+data[dbobject.baseline_end_date]+')');
					$('td:eq('+dbobject.no_of_days.index+')', nRow).append(' ('+data[dbobject.basedays]+')');	
				}
				
				/* Used only for budget_jobs_list  */
				
				if( table_name == 'budget_jobs_list' )
				{
					$('td:eq('+dbobject.edit_data.index+')', nRow).html('<a class="edit-role activity_tab_act" href="#" onclick="edit_estimate('+data[dbobject.id]+');">'+data[dbobject.name]+'</a>');
				}
				/* Used only for budget_jobs_list  */
				
				if( table_name == 'budget_pay_app_list')
				{
					$('td:eq('+dbobject.edit_data.index+')', nRow).html('<a class="edit-role activity_tab_act" href="#" title="Click to edit payapp" onclick="edit_payapp('+data[dbobject.id]+');">'+data[dbobject.name]+'</a>');
					var statusstr = "'"+data[dbobject.status]+"'";
					var from = 'data_table';
					var imgLink = base_url + 'assets/images/';
					var certificate = '<img class="uni_certificate" src="'+imgLink+'strip.gif" />';
					$('td:eq('+dbobject.edit_data1.index+')', nRow).html('<a class="edit-role activity_tab_act pay_app_name" href="javascript:void(0);" onclick="get_payapp_status('+data[dbobject.id]+','+statusstr+','+from+');" title="Click to view payapp certificate" >'+certificate+'</a>');
					
				}
				if( table_name == 'uni_project_details')
				{
					
					$('td:eq('+dbobject.edit_data.index+')', nRow).html('');
					var ub_project_id = data[dbobject.id];
					//alert(ub_project_id);
					if(data[dbobject.status_val] == 'Open')
					{
						var status = 'Disabled';
						var id = ub_project_id + ',' + status; 
						$('td:eq('+dbobject.edit_data.index+')', nRow).html('<a href="javascript:void(0);" id="'+id+'" onclick="update_project_status(this.id)"><button class="btn btn-secondary">Disable</button></a>');
				    }
				    else
				    {
				    	var status = 'Open';
						var id = ub_project_id + ',' + status;

				    	$('td:eq('+dbobject.edit_data.index+')', nRow).html('<a href="javascript:void(0);" id="'+id+'" onclick="update_project_status(this.id)"><button class="btn btn-success">Enable</button></a>');
				    }
				    //alert(data[dbobject.projected_start_date]);
				    if((data[dbobject.projected_start_date] == '0/0/0000')){

				    	$('td:eq('+dbobject.projected_start_date_index.index+')', nRow).html('---');

				    }
				    if((data[dbobject.actual_completion] == '0/0/0000')){

				    	$('td:eq('+dbobject.actual_completion_index.index+')', nRow).html('---');

				    }
					
				}
				if( table_name == 'po_payment_list')
				{
					$('td:eq('+dbobject.edit_data.index+')', nRow).html('<a class="edit-role activity_tab_act" href="#" data-toggle="modal" data-target="#create_payment" onclick="open_payment_modal('+data[dbobject.id]+');">'+data[dbobject.name]+'</a>');
				}
				if( table_name == 'budget_po_list')
				{
					if((data[dbobject.status] == 'Accepted by Builder' || data[dbobject.status] == 'Accepted by Sub')){
					$('td:eq('+dbobject.po_data.index+')', nRow).html('<a class="edit-role" href="javascript:void(0);" onclick="add_co('+data[dbobject.id]+');">Create A CO</a>');
					}
					else
					{
						$('td:eq('+dbobject.po_data.index+')', nRow).html('');
					}

				}
				if( table_name == 'builder_payments')
				{	
					$('td:eq('+dbobject.payment_date.index+')', nRow).html(data['payment_date']+'  -  '+data['billing_date']);
					var certificate = '<img src="'+base_url+'assets/images/pdf.png" />';
					// $('td:eq(7)', nRow).html('<div class="text-center"><a href="javascript:void(0);"><img src="'+base_url+'assets/images/pdf.png"/></a></div>'); 

					if(data[dbobject.ub_invoice_id] <= 0)
					{
						$('td:eq('+dbobject.edit_data1.index+')', nRow).html('<div class="text-center">--</div>');
					}
					else
					{
						$('td:eq('+dbobject.edit_data1.index+')', nRow).html('<div class="text-center"><a href="javascript:void(0);" onclick="invoice_download('+data[dbobject.ub_invoice_id]+','+data[dbobject.name]+');" title="Click to download invoice" >'+certificate+'</a></div>');
					}
				}
				
				return nRow;
			},	
			 "fnDrawCallback": function (oSettings) {
				 $('.uni_wrapper').removeClass('loadingDiv');
					/* var pgr = $(oSettings.nTableWrapper).find('.dataTables_paginate');				 
					var fgr = $(oSettings.nTableWrapper).find('.dataTables_length');	
					$(document).on('change','.select-filter', function() {
							var pgr = $(oSettings.nTableWrapper).find('.dataTables_paginate');				 
							var fgr = $(oSettings.nTableWrapper).find('.dataTables_length');
							pgr.show();
							fgr.show();						
							
					});			  
				  if (oSettings._iDisplayLength > oSettings.fnRecordsDisplay()) { 				  
					pgr.hide();
					fgr.hide();
				  } 				
				  if(oSettings._iDisplayLength < oSettings.fnRecordsDisplay()){									   
					pgr.show();
					fgr.show();
				  }
					var no_record = $('.dataTables_wrapper .dataTables_empty').text();
					if (no_record === 'No matching records found')
					{						
						pgr.hide();
						fgr.hide();
						 
					} */			
					/* if (Math.ceil((this.fnSettings().fnRecordsDisplay()) / this.fnSettings()._iDisplayLength) > 1)  {
						$('.dataTables_paginate').css("display", "block"); 
						$('.dataTables_filter').css("display", "block");                       
					} else {
						$('.dataTables_paginate').css("display", "none");
						$('.dataTables_filter').css("display", "none");
					}
					if (this.fnSettings().fnRecordsDisplay() > 6)  {
						$('.dataTables_length').css("display", "block");
					} else {
						$('.dataTables_length').css("display", "none");
					} */
					  var wrapper = this.parent().parent().parent();
					  var rowsPerPage = this.fnSettings()._iDisplayLength;
					  var rowsToShow = this.fnSettings().fnRecordsDisplay();
					  var minRowsPerPage = this.fnSettings().aLengthMenu[0][0];
					  var no_record = $('.dataTables_wrapper .dataTables_empty').text();
					  $('.dataTables_empty').parent().parent().parent().parent().parent().next('.row').addClass('hide');					  
					  if ( rowsToShow <= rowsPerPage || rowsPerPage == -1 ) {
						$('.dataTables_paginate', wrapper).css('visibility', 'hidden');						
					  }
					  else {
						$('.dataTables_paginate', wrapper).css('visibility', 'visible');
					  }
					  if ( rowsToShow <= minRowsPerPage ) {
						$('.dataTables_length', wrapper).css('visibility', 'hidden');
					  }
					  else {
						$('.dataTables_length', wrapper).css('visibility', 'visible');
					  }
			},
			"fnPreDrawCallback":function(){
				$('.uni_wrapper').addClass('loadingDiv');
			},
			"fnInitComplete":function(){
				$('.uni_wrapper').removeClass('loadingDiv');				
			},
			 "columns": dbobject.display_columns,
			"order":  dbobject.default_order_by

	});
	
}	
// Function to get the passed data table row count
function datatable_getrowcount(tableid)
{
	var datatable_obj = $(tableid).dataTable();
	var datatable_row_count = datatable_obj.fnSettings().fnRecordsTotal();
	return datatable_row_count;
}


/*###############################################################
// code for Schedule,Selection&Bids listing - start from here(Gayathri)
#################################################################*/

// Function to draw tree data table
function ubdatatable_tree(dbobject)
{
	dbobject.tableName.dataTable().fnDestroy();
	var table =  dbobject.tableName.dataTable({
		"aLengthMenu": [
			[pagination_length_one, pagination_length_two, pagination_length_three, pagination_length_four],
			[pagination_length_one, pagination_length_two, pagination_length_three, pagination_length_four]
		],
		// retrieve: true,		
		"bPaginate": true,
		"bJQueryUI" : true,
		"displayStart": displayStart,
		"iDisplayLength": default_pagination_length,
		"bServerSide": true,
		"bProcessing": true,
		"sServerMethod": "POST",
		"sScrollX": "100%",
		"sScrollXInner": "110%",
		"bScrollCollapse": true,		
		"drawCallback": function ( oSettings ) {
			$('.uni_wrapper').removeClass('loadingDiv');	
			/*  var pgr = $(oSettings.nTableWrapper).find('.dataTables_paginate');				 
			  var fgr = $(oSettings.nTableWrapper).find('.dataTables_length');	
					$(document).on('change','.select-filter', function() {
							var pgr = $(oSettings.nTableWrapper).find('.dataTables_paginate');				 
							var fgr = $(oSettings.nTableWrapper).find('.dataTables_length');
							pgr.show();
							fgr.show();						
							
					});			  
				  if (oSettings._iDisplayLength > oSettings.fnRecordsDisplay()) { 				  
					pgr.hide();
					fgr.hide();
				  } 				
				  if(oSettings._iDisplayLength < oSettings.fnRecordsDisplay()){									   
					pgr.show();
					fgr.show();
				  }
					var no_record = $('.dataTables_wrapper .dataTables_empty').text();
					if (no_record === 'No matching records found')
					{						
						$('.dataTables_paginate').hide();
						$('.dataTables_length').hide();
						 
					} */				
					 var wrapper = this.parent().parent().parent();
					  var rowsPerPage = this.fnSettings()._iDisplayLength;
					  var rowsToShow = this.fnSettings().fnRecordsDisplay();
					  var minRowsPerPage = this.fnSettings().aLengthMenu[0][0];
					  var no_record = $('.dataTables_wrapper .dataTables_empty').text();						
					  $('.dataTables_empty').parent().parent().parent().parent().parent().next('.row').addClass('hide');					  
						/* alert(this.fnGetData().length);						
						alert(rowsToShow+rowsPerPage);	 */					
					  if ( rowsToShow <= rowsPerPage || rowsPerPage == -1 ) {
						$('.dataTables_paginate', wrapper).css('visibility', 'hidden');						
					  }
					  else {
						$('.dataTables_paginate', wrapper).css('visibility', 'visible');
					  }
					  if ( rowsToShow <= minRowsPerPage ) {
						$('.dataTables_length', wrapper).css('visibility', 'hidden');
					  }
					  else {
						$('.dataTables_length', wrapper).css('visibility', 'visible');
					  } 
			if(dbobject.id != "ub_bid_id" && dbobject.id != "ub_schedule_id")
			{
				var api = this.api();
				var rows = api.rows( {page:'current'} ).nodes();
				var last=null;
				api.column(3, {page:'current'} ).data().each( function ( group, i ) {
					
					if ( last !== group ) {
						$(rows).eq( i ).before(
							'<tr class="group"><td class="details-control1" colspan="9">'+group+'</td></tr>'
						);
						last = group;
						
					}
				} );
			}
		},		
		
		sAjaxSource: base_url + dbobject.ajax_encoded_url,
		"aoColumnDefs": [{
			// "bSortable": false,
			// "aTargets": [3,-1] // <-- gets last column and turns off sorting
		}],
		"fnServerData": function ( sSource, aoData, fnCallback ) {
			var result = $.parseJSON(dbobject.post_data);
			$.each(result, function(k, v) {
				aoData.push( { "name": k, "value": v } );
				setTimeout(checkbox, 3000);
			});
			$.ajax({
				"dataType": 'json',
				"type": "POST",
				"url": sSource,
				"data": aoData,
				"success": fnCallback                  
			});
		 },	
		 // destroy: true,
		"fnRowCallback": function(nRow, data, iDisplayIndex, iDisplayIndexFull, status) {
			$('.uni_wrapper').removeClass('loadingDiv');	
			if(dbobject.id == "ub_bid_id" )
			{
				var encoded_string_edit_role = Base64.encode( dbobject.edit_data.url + data[dbobject.id]);	
				var encoded_edit_val = encoded_string_edit_role.strtr(encode_chars_obj);
				$('td:eq(1)', nRow).html('<a href="'+base_url + encoded_edit_val + '">' + data[dbobject.group_by_name] + '</a>');
		
			} 
			else
			{
				if(dbobject.id == "ub_schedule_id")
				{
					$('td:eq(1)', nRow).html(data[dbobject.group_by_name]);
				}
				else
				{
				   var encoded_string_edit_role = Base64.encode( dbobject.edit_data.url + data[dbobject.id]);
				   var encoded_edit_val = encoded_string_edit_role.strtr(encode_chars_obj);
					$('td:eq(1)', nRow).html('<a href="'+base_url + encoded_edit_val +'">' + data[dbobject.group_by_name] + '</a>');
					$(nRow).addClass('children');
				}
				//alert("hi");
				//$(nRow).addClass('children');
			}
			return nRow;

		},
		
		"columns": dbobject.display_columns,
		"order":  dbobject.default_order_by
	});
}
/*###############################################################
// code for Schedule,Selection&Bids listing - end here(Gayathri)
#################################################################*/
// Function to draw view data table without pagination and search filter
function ubdatatable_just_view(dbobject)
{
	var pagination_enabled = false;
	if(dbobject.request_from == 'schedule_shifts_history')
	{
		if(true === dbobject.table_check)
		{
			dbobject.tableName.dataTable().fnDestroy();
		}
		//pagination_enabled = true;
	}
	
	var table =  dbobject.tableName.dataTable({
			// retrieve: true,		
			"aLengthMenu": [
				[pagination_length_one, pagination_length_two, pagination_length_three, pagination_length_four],
				[pagination_length_one, pagination_length_two, pagination_length_three, pagination_length_four]
			],
			"bPaginate": pagination_enabled,
			"bJQueryUI" : true,
			"displayStart": displayStart,
			"iDisplayLength": default_pagination_length,
			"bServerSide": true,
			"bProcessing": true,
			"sServerMethod": "POST",
			"sScrollX": "100%",
			"sScrollXInner": "110%",
			"bScrollCollapse": true,
			sAjaxSource: base_url + dbobject.ajax_encoded_url,
			"aoColumnDefs": [{
				// "bSortable": false,
				// "aTargets": [3,-1] // <-- gets last column and turns off sorting
			}],
			"fnServerData": function ( sSource, aoData, fnCallback ) {
				var result = $.parseJSON(dbobject.post_data);
				$.each(result, function(k, v) {
					 // alert(k + ' = ' +v)
					aoData.push( { "name": k, "value": v } );
					setTimeout(checkbox, 3000);
				});
				$.ajax( {
					"dataType": 'json',
					"type": "POST",
					"url": sSource,
					"data": aoData,
					"success": fnCallback                  
				} );
			 },		
			"fnDrawCallback": function (oSettings) {
				 $('.uni_wrapper').removeClass('loadingDiv');
			/*  var pgr = $(oSettings.nTableWrapper).find('.dataTables_paginate');				 
			  var fgr = $(oSettings.nTableWrapper).find('.dataTables_length');	
					$(document).on('change','.select-filter', function() {
							var pgr = $(oSettings.nTableWrapper).find('.dataTables_paginate');				 
							var fgr = $(oSettings.nTableWrapper).find('.dataTables_length');
							pgr.show();
							fgr.show();						
							
					});			  
				  if (oSettings._iDisplayLength > oSettings.fnRecordsDisplay()) { 				  
					pgr.hide();
					fgr.hide();
				  } 				
				  if(oSettings._iDisplayLength < oSettings.fnRecordsDisplay()){									   
					pgr.show();
					fgr.show();
				  }
					var no_record = $('.dataTables_wrapper .dataTables_empty').text();
					if (no_record === 'No matching records found')
					{						
						$('.dataTables_paginate').hide();
						$('.dataTables_length').hide();
						 
					} */
					var wrapper = this.parent().parent().parent();
					  var rowsPerPage = this.fnSettings()._iDisplayLength;
					  var rowsToShow = this.fnSettings().fnRecordsDisplay();
					  var minRowsPerPage = this.fnSettings().aLengthMenu[0][0];
					  var no_record = $('.dataTables_wrapper .dataTables_empty').text();
					  $('.dataTables_empty').parent().parent().parent().parent().parent().next('.row').addClass('hide');					  
					  if ( rowsToShow <= rowsPerPage || rowsPerPage == -1 ) {
						$('.dataTables_paginate', wrapper).css('visibility', 'hidden');						
					  }
					  else {
						$('.dataTables_paginate', wrapper).css('visibility', 'visible');
					  }
					  if ( rowsToShow <= minRowsPerPage ) {
						$('.dataTables_length', wrapper).css('visibility', 'hidden');
					  }
					  else {
						$('.dataTables_length', wrapper).css('visibility', 'visible');
					  }
					
			},
			"fnPreDrawCallback":function(){
				$('.uni_wrapper').addClass('loadingDiv');
			},
			"fnInitComplete":function(){
				$('.uni_wrapper').removeClass('loadingDiv');				
			},			 
		"columns": dbobject.display_columns,
		"order":  dbobject.default_order_by
		});

}
/*###############################################################
// code for docs listing - start from here(Devansh)
#################################################################*/
// Function to docs data table
function ubdatatable_docs(dbobject)
{
	
	dbobject.tableName.dataTable().fnDestroy();
	var table_name = typeof dbobject.this_table !== 'undefined' ? dbobject.this_table.table_name : 'notable';
	var pagination = true;
	if(table_name == 'uploaded_doc_content')
	{
		pagination = false;
	}
	var table =  dbobject.tableName.dataTable({
		"aLengthMenu": [
			[pagination_length_one, pagination_length_two, pagination_length_three, pagination_length_four],
			[pagination_length_one, pagination_length_two, pagination_length_three, pagination_length_four]
		],
		// retrieve: true,		
		"bPaginate": pagination,
		"bJQueryUI" : true,
		"displayStart": displayStart,
		"iDisplayLength": default_pagination_length,
		"bServerSide": true,
		"bProcessing": true,
		"sServerMethod": "POST",
		"dom": '<"clear">',
		sAjaxSource: base_url + dbobject.ajax_encoded_url,
		"aoColumnDefs": [{
			// "bSortable": false,
			// "aTargets": [3,-1] // <-- gets last column and turns off sorting
		}],
		"fnServerData": function ( sSource, aoData, fnCallback ) {
			var result = $.parseJSON(dbobject.post_data);
			$.each(result, function(k, v) {
				aoData.push( { "name": k, "value": v } );
				setTimeout(checkbox, 3000);
			});
			$.ajax({
				"dataType": 'json',
				"type": "POST",
				"url": sSource,
				"data": aoData,
				"success": fnCallback                  
			});
		 },	
		 // destroy: true,
		 
		"fnRowCallback": function(nRow, data, iDisplayIndex, iDisplayIndexFull, status) 
		{
			$('.uni_wrapper').removeClass('loadingDiv');
			var imgLink = base_url + 'assets/images/';
			if( table_name == 'Docs_List')
			{
			
				var func_url = 'docs/index';
				var encoded_url = Base64.encode(func_url + '/' + data[dbobject.folder_id] + '/' + data[dbobject.project_id]);
				var encoded_url = encoded_url.strtr(encode_chars_obj);
				if (typeof DEFAULT_THUMB_IMAGE_ARRAY[data.Name[0].icon] !='undefined') 
				{ 
				    var thumbnail = DEFAULT_THUMB_IMAGE_ARRAY[data.Name[0].icon]['40'];
				}
				else 
				{ 
					var thumbnail = DEFAULT_THUMB_IMAGE_ARRAY.common['40'];
				}
				var download_url = 'docs/download_file';
				var encoded_download_url = Base64.encode(download_url + '/' + folder_id + '/' + data.Name[0].sys_file_name);
				var encoded_download_url = encoded_download_url.strtr(encode_chars_obj);

				var file_name = '<div class="text-left"><img src="' + thumbnail + '"/><span class="doc_name"  title="'+ data.Name[0].title +'"> '+ data.Name[0].title + '</span></div>';
				var folder_name = '<div class="text-left"><img src="' + imgLink + 'new_doc.png"/><a href="'+ base_url + encoded_url +'" class="doc_name" name="'+ data.Name[0].title +'"> '+ data.Name[0].title + '</a></div>';
				if (data.Name[0].owner_access == 'Yes') 
				{
					var owner_access = '<a href="javascript:void(0);"><img class="uni_owner" src="' + imgLink +'strip.gif"/></a>';
				}
				else 
				{
					var owner_access = '-';
				}
				if (data.Name[0].sub_access == 'Yes') 
				{
					var sub_access = '<a href="javascript:void(0);"><img class="uni_sub" src="' + imgLink + 'strip.gif"/></a>';
				}
				else 
				{
					var sub_access = '-';
				}
				var view_by = '<div class="text-center">'+ owner_access +'&nbsp;&nbsp;'+ sub_access +'</div>';
				var view_by_sub_owner = '<div class="text-center">-</div>';				

				var actions = '<div class="text-center"><a href="javascript:void(0);" class="edit_move_docs" data-target="#Edit_Move_Docs" data-toggle="modal"><img class="uni_edit" src="' + imgLink +'strip.gif"/></a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="docs_delete(' + data[dbobject.folder_id] + ')"><img class="uni_delete" src="' + imgLink +'strip.gif"/></a><input type="hidden" class="folder_id" value="' + data[dbobject.folder_id] + '"></div>';	

				var actions_download = '<div class="text-center"><a href="javascript:void(0);" class="edit_move_docs" data-target="#Edit_Move_Docs" data-toggle="modal"><img class="uni_edit" src="' + imgLink +'strip.gif"/></a>&nbsp;&nbsp;<a href="'+ base_url + encoded_download_url +'"><img class="uni_download" src="' + imgLink +'strip.gif"/></a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delete_file(' + data[dbobject.folder_id] + ')"><img class="uni_delete" src="' + imgLink +'strip.gif"/></a><input type="hidden" class="file_id" value="' + data[dbobject.folder_id] + '"></div>';					
				var actions_download_non_project = '<div class="text-center"><a href="'+ base_url + encoded_download_url +'"><img class="uni_download" src="' + imgLink +'strip.gif"/></a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delete_file(' + data[dbobject.folder_id] + ')"><img class="uni_delete" src="' + imgLink +'strip.gif"/></a><input type="hidden" class="file_id" value="' + data[dbobject.folder_id] + '"></div>';					
				
				var doc_folder_contain = '<div class="text-center"><a href="javascript:void(0);"><img src="' + imgLink +'new_doc_small.png"/></a> ('+ data.Contains[0].doc_dir_con +')&nbsp;&nbsp;<a href="javascript:void(0);"><img src="' + imgLink +'document.png"/></a> ('+ data.Contains[0].doc_fol_con +')</div>';
				var doc_folder_contain_sub_owner = '<div class="text-center"><a href="javascript:void(0);"><img src="' + imgLink +'document.png"/></a> ('+ data.Contains[0].doc_fol_con +')</div>';
				
				var actions_non_project = '<div class="text-center"><a href="javascript:void(0);" onclick="docs_delete(' + data[dbobject.folder_id] + ')"><img class="uni_delete" src="' + imgLink +'strip.gif"/></a><input type="hidden" class="folder_id" value="' + data[dbobject.folder_id] + '"></div>';

				var actions_sub_owner = '<div class="text-center">--</div>';	

				var actions_download_sub_owner = '<div class="text-center"><a href="'+ base_url + encoded_download_url +'"><img class="uni_download" src="' + imgLink +'strip.gif"/></a></div>';			
				
				var doc_folder_contain_none = '<div class="text-center"><img src="' + imgLink +'hyphen.png"/></div>';				
				if (account_type == 100)
				{
					/*if (data.project_id > 0) 
					{
						$('td:eq(0)', nRow).html(file_name);                                
						$('td:eq(1)', nRow).html(view_by);                                
						$('td:eq(2)', nRow).html(doc_folder_contain_none);                                
						$('td:eq(3)', nRow).html(actions_download);
					}
					else
					{
						$('td:eq(0)', nRow).html(file_name);                                
						$('td:eq(1)', nRow).html(view_by);                                
						$('td:eq(2)', nRow).html(doc_folder_contain_none);                                
						$('td:eq(3)', nRow).html(actions_download_non_project);
					}*/
					$('td:eq(0)', nRow).html(file_name);                                
					$('td:eq(1)', nRow).html(view_by);                                
					$('td:eq(2)', nRow).html(doc_folder_contain_none);                                
					$('td:eq(3)', nRow).html(actions_download);
					if(data.Name[0].folder === "1")
					{
						if (data.project_id > 0) 
						{
							$('td:eq(0)', nRow).html(folder_name);
							$('td:eq(2)', nRow).html(doc_folder_contain); 					
							$('td:eq(3)', nRow).html(actions);
						}
						else
						{
							$('td:eq(0)', nRow).html(folder_name);
							$('td:eq(2)', nRow).html(doc_folder_contain); 					
							$('td:eq(3)', nRow).html(actions_non_project);
						}
					}
				}
				else
				{
					$('td:eq(0)', nRow).html(file_name);                                
					$('td:eq(1)', nRow).html(view_by_sub_owner);                                
					$('td:eq(2)', nRow).html(doc_folder_contain_none);                                
					$('td:eq(3)', nRow).html(actions_download_sub_owner);
					if(data.Name[0].folder === "1")
					{
						$('td:eq(0)', nRow).html(folder_name);
						$('td:eq(2)', nRow).html(doc_folder_contain_sub_owner); 					
						$('td:eq(3)', nRow).html(actions_sub_owner);
					}
				}
				
			}
			else
			{
				if (table_name == 'uploaded_doc_content') 
				{
					var download_url = module_name + '/download_file';
					var encoded_download_url = Base64.encode(download_url + '/' + folder_id + '/' + data.sys_file_name);
					var encoded_download_url = encoded_download_url.strtr(encode_chars_obj);
					$('td:eq(2)', nRow).html('<a href="'+ base_url + encoded_download_url +'"><img class="uni_download" src="' + imgLink +'strip.gif"/></a>');
				}
				else
				{
					var func_url = 'photos/index';
					var encoded_url = Base64.encode(func_url + '/' + data[dbobject.folder_id] + '/' + data[dbobject.project_id]);
					var encoded_url = encoded_url.strtr(encode_chars_obj);

					if(data['file_type'] === "folder")
					{
						var album = '<img src="' + imgLink + 'album_folder.png" />&nbsp;&nbsp;<a href="'+ base_url + encoded_url +'" class="doc_name" name="'+ data['Name'] +'">'+ data['Name'] +'</a>';
						if (data['owner_access'] == 'Yes') 
						{
							var owner_access = '<a href="javascript:void(0);"><img class="uni_owner" src="' + imgLink +'strip.gif"/></a>';
						}
						else 
						{
							var owner_access = '-';
						}
						if (data['sub_access'] == 'Yes') 
						{
							var sub_access = '<a href="javascript:void(0);"><img class="uni_sub" src="' + imgLink + 'strip.gif"/></a>';
						}
						else 
						{
							var sub_access = '-';
						}
						var viewby = '<div class="text-center">'+ owner_access +'&nbsp;&nbsp;'+ sub_access +'</div>';		
						var viewby_sub_owner = '<div class="text-center">-</div>';
						//var viewby = '<a href="javascript:void(0);"><img class="uni_owner" src="' + imgLink +'strip.gif"/></a>'+'&nbsp;&nbsp;'+'<a href="javascript:void(0);"><img class="uni_sub" src="' + imgLink + 'strip.gif"/></a>';
						var action = '<a href="javascript:void(0);" class="edit_album_modal" data-target="#Edit_Album_Modal" data-toggle="modal"><img class="uni_edit" src="' + imgLink +'strip.gif"/></a>'+'&nbsp;&nbsp;'+'<a href="javascript:void(0);" onclick="album_delete(' + data[dbobject.folder_id] + ')"><img class="uni_delete" src="' + imgLink +'strip.gif"/></a><input type="hidden" class="folder_id" value="' + data[dbobject.folder_id] + '">';
						var action_no_project = '<a href="javascript:void(0);" onclick="album_delete(' + data[dbobject.folder_id] + ')"><img class="uni_delete" src="' + imgLink +'strip.gif"/></a><input type="hidden" class="folder_id" value="' + data[dbobject.folder_id] + '">';
						var action_sub_owner = '-';
						if (account_type == 100)
						{
							if (data[dbobject.project_id] > 0) 
							{
								$('td:eq(0)', nRow).html(album); 
								$('td:eq(1)', nRow).html(viewby); 
								$('td:eq(3)', nRow).html(action);
							}
							else
							{
								$('td:eq(0)', nRow).html(album); 
								$('td:eq(1)', nRow).html(viewby); 
								$('td:eq(3)', nRow).html(action_no_project);
							}
						}
						else
						{
							$('td:eq(0)', nRow).html(album); 
							$('td:eq(1)', nRow).html(viewby_sub_owner); 
							$('td:eq(3)', nRow).html(action_sub_owner);
						}
					}
					else
					{
						var download_url = 'photos/download_file';
						var encoded_download_url = Base64.encode(download_url + '/' + folder_id + '/' + data.Name[0].sys_file_name);
						var encoded_download_url = encoded_download_url.strtr(encode_chars_obj);

						var album_file = '<a href="javascript:void(0);" class="album_image" data-toggle="modal" data-target="#albumModal"><img src="' + imgLink + data.Name[0].albumimg +'" /></a>&nbsp;&nbsp;<span class="doc_name" title="'+ data.Name[0].albumname +'">'+ data.Name[0].albumname +'</span><input type="hidden" value="' + data.Name[0].path + '" class="file_path">';

						if (data.Name[0].owner_access == 'Yes') 
						{
							var owner_access = '<a href="javascript:void(0);"><img class="uni_owner" src="' + imgLink +'strip.gif"/></a>';
						}
						else 
						{
							var owner_access = '-';
						}
						if (data.Name[0].sub_access == 'Yes') 
						{
							var sub_access = '<a href="javascript:void(0);"><img class="uni_sub" src="' + imgLink + 'strip.gif"/></a>';
						}
						else 
						{
							var sub_access = '-';
						}
						var viewby = '<div class="text-center">'+ owner_access +'&nbsp;&nbsp;'+ sub_access +'</div>';		
						var viewby_sub_owner = '<div class="text-center">-</div>';
						//var viewby = '<a href="javascript:void(0);"><img class="uni_owner" src="' + imgLink +'strip.gif"/></a>'+'&nbsp;&nbsp;'+'<a href="javascript:void(0);"><img class="uni_sub" src="' + imgLink + 'strip.gif"/></a>';
						
						var action_file = '<a href="javascript:void(0);" class="edit_album_modal" data-target="#Edit_Album_Modal" data-toggle="modal"><img class="uni_edit" src="' + imgLink +'strip.gif"/></a>'+'&nbsp;&nbsp;&nbsp;'+'<a href="'+ base_url + encoded_download_url +'"><img class="uni_download" src="' + imgLink +'strip.gif"/></a>'+'&nbsp;&nbsp;&nbsp;'+'<a href="javascript:void(0);" onclick="delete_file(' + data[dbobject.folder_id] + ')"><img class="uni_delete" src="' + imgLink +'strip.gif"/></a><input type="hidden" class="file_id" value="' + data[dbobject.folder_id] + '">';
						
						var action_file_sub_owner = '<a href="'+ base_url + encoded_download_url +'"><img class="uni_download" src="' + imgLink +'strip.gif"/></a>';
						if (account_type == 100)
						{
							$('td:eq(0)', nRow).html(album_file); 
							$('td:eq(1)', nRow).html(viewby); 
							$('td:eq(3)', nRow).html(action_file);
						}
						else
						{
							$('td:eq(0)', nRow).html(album_file); 
							$('td:eq(1)', nRow).html(viewby_sub_owner); 
							$('td:eq(3)', nRow).html(action_file_sub_owner);
						}

					}
				}
			}					
			return nRow;
		},	
		"fnDrawCallback": function (oSettings) {
				 $('.uni_wrapper').removeClass('loadingDiv');
			 /* var pgr = $(oSettings.nTableWrapper).find('.dataTables_paginate');				 
			  var fgr = $(oSettings.nTableWrapper).find('.dataTables_length');	
					$(document).on('change','.select-filter', function() {
							var pgr = $(oSettings.nTableWrapper).find('.dataTables_paginate');				 
							var fgr = $(oSettings.nTableWrapper).find('.dataTables_length');
							pgr.show();
							fgr.show();						
							
					});			  
				  if (oSettings._iDisplayLength > oSettings.fnRecordsDisplay()) { 				  
					pgr.hide();
					fgr.hide();
				  } 				
				  if(oSettings._iDisplayLength < oSettings.fnRecordsDisplay()){									   
					pgr.show();
					fgr.show();
				  }
				 var no_record = $('.dataTables_wrapper .dataTables_empty').text();
				 if (no_record === 'No matching records found')
					{						
						$('.dataTables_paginate').hide();
						$('.dataTables_length').hide();
						 
					} */
					var wrapper = this.parent().parent().parent();
					  var rowsPerPage = this.fnSettings()._iDisplayLength;
					  var rowsToShow = this.fnSettings().fnRecordsDisplay();
					  var minRowsPerPage = this.fnSettings().aLengthMenu[0][0];
					  var no_record = $('.dataTables_wrapper .dataTables_empty').text();
					   $('.dataTables_empty').parent().parent().parent().parent().parent().next('.row').addClass('hide');				  
					  if ( rowsToShow <= rowsPerPage || rowsPerPage == -1 ) {
						$('.dataTables_paginate', wrapper).css('visibility', 'hidden');						
					  }
					  else {
						$('.dataTables_paginate', wrapper).css('visibility', 'visible');
					  }
					  if ( rowsToShow <= minRowsPerPage ) {
						$('.dataTables_length', wrapper).css('visibility', 'hidden');
					  }
					  else {
						$('.dataTables_length', wrapper).css('visibility', 'visible');
					  }
					
			},
			"fnPreDrawCallback":function(){
				$('.uni_wrapper').addClass('loadingDiv');
			},
			"fnInitComplete":function(){
				$('.uni_wrapper').removeClass('loadingDiv');				
			},		
		"columns": dbobject.display_columns,
		"order":  dbobject.default_order_by
	});
}
/*###############################################################
// code for docs listing - end here(Devansh)
#################################################################*/

/*###############################################################
// Adding grid setting related JS code - start from here(Thiyagu)
#################################################################*/
$("body").on("change", "#grid_saved_view", function(event){

//$('#grid_saved_view').on('change', function() {
	
	//var current_view_data = $('#current_view_json').val();
	if($("#grid_saved_view option[value='"+this.value+"']").text()=='Nothing selected')
	{
		// Set selected columns
		$('.selectpicker').selectpicker('refresh');
		$('#grid_settings_columns option:selected').each(function(){
			$("#grid_settings_columns option[value='" + this.value + "']").prop("selected", false);
		});	
		$('.selectpicker').selectpicker('refresh');
		$('#current_view_grid_settings_id').val('');
		$('#list_view_name').val('');
		$('#is_default').iCheck('uncheck');
		$('#is_default').parent('.icheckbox_square-red').removeClass('checked'); // Unchecks it
		
		return false;
	}
	else
	{
		var cols = current_view_data[this.value].list_view.cols;
		var is_default = current_view_data[this.value].list_view["is_default"];
		// Set selected columns
		$('.selectpicker').selectpicker('refresh');
		$('#grid_settings_columns option:selected').each(function(){
			$("#grid_settings_columns option[value='" + this.value + "']").prop("selected", false);
		});	
		$.each(cols, function(colID,colNAME) {                    
			$('.selectpicker').selectpicker('refresh');
			$("#grid_settings_columns option[value='" + colID + "']").prop("selected", true);
			$('.selectpicker').selectpicker('refresh');
		});
		
		// Set current list view id
		$('#current_view_grid_settings_id').val(this.value);
		
		// Set current list view name
		$('#list_view_name').val($("#grid_saved_view option[value='"+this.value+"']").text());
		// Set is_default field
		if(is_default == 'Yes'){
			$('#is_default').iCheck('check');
			$('#is_default').parent('.icheckbox_square-red').addClass('checked'); 
			// Checks it
		}
		else if(is_default == 'No')
		{
			$('#is_default').iCheck('uncheck');
			$('#is_default').parent('.icheckbox_square-red').removeClass('checked'); // Unchecks it
			
		}
	}
	
});

$("body").on("click", "#save_grid_view", function(event){
	ajax_grid_view_action('save');
});	
$("body").on("click", "#update_grid_view", function(event){
	ajax_grid_view_action('update');	
});	
$("body").on("click", "#apply_grid_view", function(event){
	ajax_grid_view_action('apply');
});	
// Identify the grid view action 
function ajax_grid_view_action(actiontype)
{
	var grid_settings_columns = $('#grid_settings_columns').val();
	var list_view_name = $('#list_view_name').val();
	var is_default = 'No';
	var encoded_url = Base64.encode(controller+'/uni_set_grid_settings/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var current_view_grid_settings_id = '';
	var data = '';
	
	// Fetch default value
	if($('#is_default').prop("checked") == true)
	{
		is_default = 'Yes';
	}
	else if($('#is_default').prop("checked") == false)
	{
		is_default = 'No';
	}
	data = 'grid_settings_columns='+grid_settings_columns+'&list_view_name='+list_view_name+'&is_default='+is_default;
	// Empty field validation
	if($('#grid_settings_columns').val() == '' || $('#list_view_name').val() == '')
	{
		alert('Please select a column / view name');
		return false;
	}
	if(actiontype == 'save')
	{
		if($('#current_view_grid_settings_id').val()>0)
		{
			alert('Grid view is already in the database!');
			return false;
		}
	}
	if(actiontype == 'update')
	{
		if($('#current_view_grid_settings_id').val()>0)
		{
			current_view_grid_settings_id = $('#current_view_grid_settings_id').val();
		}
		else
		{
			alert('There are no previous saved views! Please try to save it newly');
			return false;
		}
	}
	switch(actiontype)
	{
		case 'save':
		{
			encoded_url = Base64.encode(controller+'/uni_set_grid_settings/');
			ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
			$.ajax({
				url: base_url + ajax_encoded_url,
				type: "post",
				data: data,			
				success: function(response) {	
					if(response == '')
					{
						alert('update was not successful!');
					}
					else
					{
						$('#grid_settings_popup').html(response);
						$('.selectpicker').selectpicker('refresh');
						checkbox();
					}
				}
			});	
			break;
		}
		case 'update':
		{
			data = data+'&grid_settings_id='+current_view_grid_settings_id;
			encoded_url = Base64.encode(controller+'/uni_set_grid_settings/');
			ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
			$.ajax({
				url: base_url + ajax_encoded_url,
				type: "post",
				data: data,			
				success: function(response) {		
					if(response == ''){
						alert('update was not successful!');
					}
					else
					{
						$('#grid_settings_popup').html(response);
						$('.selectpicker').selectpicker('refresh');
						checkbox();
					}
				}
			});
			break;
		}
		case 'apply':
		{
			var project_index = Base64.encode(controller+'/index/');
			var project_index_url = project_index.strtr(encode_chars_obj);
			window.location.href = project_index_url;
			break;
		}
	}	
}	
/*###############################################################
// Adding grid setting related JS code - ends here(Thiyagu)
#################################################################*/

// Function to draw view data table for Budget - payapp summary list page
function ubdatatable_inline_edit_grouping(dbobject)
{
	dbobject.tableName.dataTable().fnDestroy();
	var pagination_enabled = false;
	var table =  dbobject.tableName.dataTable({
		"bPaginate": pagination_enabled,
		"bJQueryUI" : true,
		"bServerSide": true,
		"bProcessing": true,
		"sServerMethod": "POST",
		"sScrollX": "100%",
		"sScrollXInner": "110%",
		"bScrollCollapse": true,
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [0] // <-- gets last column and turns off sorting
		}],			
		"sAjaxSource": base_url + dbobject.ajax_encoded_url,
		"drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
			var last1=null;
            var colonne = 12;
            var totale = new Array();
            totale['Totale']= new Array();
            var groupid = -1;
            var subtotale = new Array();
			var value = 0;
            var total_text = '';
			var group_name = '';
			api.column(0, {page:'current'} ).data().each( function ( group, i ) {     
				if ( last !== group ) {
						groupid++;
						if(groupid==0)
						{
							total_text = 'Estimate count:';
							group_name = 'Estimate';
						}
						else
						{
							total_text = 'CO count:';
							group_name = 'Change Order';
						}
						$(rows).eq(i).before(
							'<tr class="group"><td colspan="12">'+group_name+'</td></tr><tr class="total pointer_none"><td>'+total_text+'</td><td><b>Total Sum:</b></td></tr>'
						);
						last = group;
				}
				val = api.row(api.row($(rows).eq( i )).index()).data();
				//alert(groupid);
				//alert(val.toSource());
				//current order index
				$.each(val,function(index2,val2){
					if(index2 != 'ub_payapp_request_summary_id' && index2 != 'type' && index2 != 'cost_code_id' && index2 != 'cost_code_name')
					{
						if (typeof subtotale[groupid] =='undefined'){
							subtotale[groupid] = new Array();
						}
						if (typeof subtotale[groupid][index2] =='undefined'){
							subtotale[groupid][index2] = 0;
						}
						value = Number(val2.replace('.00',""));
						subtotale[groupid][index2] += value;
						//alert(subtotale[groupid][index2]);		
					}
				});
            }); 
			$('tbody').find('.total').each(function (i,v) {
                var rowCount = $(this).nextUntil('.group').length;
        		$(this).find('td:first').append($('<span />', { 'class': 'rowCount-grid' }).append($('<b />', { 'text': ' ('+rowCount+')' })));
                    var subtd = '';
					var per_work_done = 0.00;
					var per_retainage = 0.00;
					if(subtotale[i]['total_completed_and_stored_till_date'] != 0.00 && subtotale[i]['scheduled_value'] != 0.00)
					{
						per_work_done = addCommas(((subtotale[i]['total_completed_and_stored_till_date'].toFixed(2)/subtotale[i]['scheduled_value'].toFixed(2))*100).toFixed(2));
					}
					if(subtotale[i]['retainage_amount'] != 0.00 && subtotale[i]['total_completed_and_stored_till_date'] != 0.00)
					{
						per_retainage = addCommas(((subtotale[i]['retainage_amount'].toFixed(2)/subtotale[i]['total_completed_and_stored_till_date'].toFixed(2))*100).toFixed(2));
					}
					
					subtd = '<td>$'+addCommas(subtotale[i]['budgeted_value'].toFixed(2))+'</td><td>$'+addCommas(subtotale[i]['scheduled_value'].toFixed(2))+'</td><td>$'+addCommas(subtotale[i]['from_prev_app'].toFixed(2))+'</td><td>$'+addCommas(subtotale[i]['this_period'].toFixed(2))+'</td><td>$'+addCommas(subtotale[i]['value_of_material_stored'].toFixed(2))+'</td><td>$'+addCommas(subtotale[i]['total_completed_and_stored_till_date'].toFixed(2))+'</td><td>%'+addCommas(per_work_done)+'</td><td>$'+addCommas(subtotale[i]['balance_to_be_finished'].toFixed(2))+'</td><td>%'+addCommas(per_retainage)+'</td><td>$'+addCommas(subtotale[i]['retainage_amount'].toFixed(2))+'</td>';
/* 					for (var a=0;a<colonne;a++)
					{ 
						subtd += '<td>'+subtotale[i][a]+'</td>';
					}
 */					$(this).append(subtd);
            }); 
			
			
			
/* 			var api = this.api();
			var rows = api.rows( {page:'current'} ).nodes();
			var last=null;           			
			api.column(0, {page:'current'} ).data().each( function ( group, i ) {
				if ( last !== group ) {
					$(rows).eq( i ).before(
						'<tr class="group"><td class="" colspan="12">'+group+'</td></tr>'
					); 					
					last = group;
				}				
			});			
			api.column(0, {page:'current'} ).data().each( function ( group, i ) {	
				if (last !== group) {
					 var new_add =  '<tr class="gro-tot"><td colspan="2" class="text-right">Total</td><td>Total Val</td><td>Total Val</td><td>Total Val</td><td>&nbsp;</td><td>Total Val</td><td>Total Val</td><td>Total Val</td><td>Total Val</td><td>Total Val</td><td>Total Val</td></tr>';			   
					$(rows).eq(i).nextUntil('.group').last().after(new_add);		
					last = group;
				}				
			});			

 */			var status = $('#hide_payapp_status').val();
					if(status == 'Released'){						
						$('.d_t_inline_edit').css('display','none');						
						$('.d-t-cursor').css('color','#000');						
					}
					if(status == 'Paid'){						
						$('.d-t-cursor').css('color','#000');						
					}
		},
		"fnServerData": function ( sSource, aoData, fnCallback ) {
			var result = $.parseJSON(dbobject.post_data);
			$.each(result, function(k, v) {
				aoData.push( { "name": k, "value": v } );
			});
			$.ajax( {
				"dataType": 'json',
				"type": "POST",
				"url": sSource,
				"data": aoData,
				"success": fnCallback                  
			});
		},			
		"columns": dbobject.display_columns,
		"order":  dbobject.default_order_by,
		"tableTools": {
            sRowSelect: "os",
            sRowSelector: 'td:first-child'
        }
	});

}

function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}