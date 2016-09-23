<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| Application file paths defined below
|--------------------------------------------------------------------------
|
| These are used in file paths
|
*/
if(php_sapi_name() == 'cli')
{
	$actualRootName = 'http://unibuilder.getfriday.com/';
}
else
{
	$proto = "http" . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "s" : "") . "://";
	$userurl=explode('/',$_SERVER["REQUEST_URI"]);
	if($_SERVER['SERVER_NAME']=='10.0.0.149' || $_SERVER['SERVER_NAME']=='10.0.0.151')
	{
		$actualRootName=$proto.$_SERVER['SERVER_NAME'].'/'.$userurl[1].'/'.$userurl[2].'/';
	}
	elseif($_SERVER['SERVER_NAME'] == 'localhost')
	{
		$actualRootName=$proto.$_SERVER['SERVER_NAME'].'/'.$userurl[1].'/';
	}
	else
	{
		$actualRootName=$proto.$_SERVER['SERVER_NAME'].'/';
	}
}
define('BASEURL', $actualRootName);
/* Below variables hold the external path for the IMAGE, JS and CSS - If its empty takes the base url $config['base_url'] */
$css_src = '';
$js_src = '';
$image_src = '';
$log_src = '';

define('IMAGESRC', (isset($image_src) && $image_src != "")?$image_src:BASEURL.'assets/images/');
define('CSSSRC',(isset($css_src) && $css_src != "")?$css_src:BASEURL.'assets/css/');
define('JSSRC', (isset($js_src) && $js_src != "")?$js_src:BASEURL.'assets/js/');
define('ACJI', (isset($js_src) && $js_src != "")?$js_src:BASEURL.'assets/admin/');
define('LOGSRC', (isset($log_src) && $log_src != "")?$log_src:BASEURL.APPPATH.'logs/');
define('TEMPSRC', (isset($js_src) && $js_src != "")?$js_src:BASEURL.'assets/js/template/');

/* Current date and time */
define("TODAY", gmdate("Y-m-d H:i:s"));
define('CURRENT_DATE', date("Y-m-d", strtotime(gmdate("Y-m-d H:i:s") . "+330 minutes")));
define("DEFAULT_USER_TIME_ZONE", "-8:00");
define("DEFAULT_DATE_FORMAT", "%e/%c/%Y %H:%i:%s");

/* Sets user input / agent verification as TRUE or FALSE */
define("CHECK_USER_IP", FALSE); // used in UNI_Controller->verify_input method() 
define("CHECK_USER_AGENT", FALSE);// used in UNI_Controller->verify_input method() 

/* Table name as constant */
define('UB_GENERAL_DEFINITION', 'ub_general_definition');
define('UB_GENERAL_VALUE', 'ub_general_value');
define('UB_MASTER_MAIL_TEMPLATE', 'ub_master_mail_template');
define('UB_BUILDER_MAIL_TEMPLATE', 'ub_builder_mail_template');
define('UB_USER', 'ub_user');
define('UB_USER_ACCESS_LOG', 'ub_user_access_log');
define('UB_SESSION', 'ub_session');
define('UB_ROLE', 'ub_role');
define('UB_MENU', 'ub_menu');
define('UB_ACCESS_LEVEL', 'ub_access_level');
define('UB_ACCESS_LEVEL_DETAILS', 'ub_access_level_details');
define('UB_BUILDER', 'ub_builder');
define('UB_PROJECT', 'ub_project');
define('UB_PROJECT_ASSIGNED_USERS', 'ub_project_assigned_users');
define('UB_LEAD', 'ub_lead');
define('UB_LEAD_ACTIVITY', 'ub_lead_activity'); 
define('UB_LEAD_ACTIVITY_THREAD', 'ub_lead_activity_thread');
define('UB_DAILY_LOG_COMMENTS', 'ub_daily_log_comments');
define('UB_DAILY_LOG', 'ub_daily_log');
define('UB_TASK', 'ub_task');
define('UB_TASK_ASSIGNED_USERS', 'ub_task_assigned_users');
define('UB_TASK_CHECKLIST', 'ub_task_checklist');
define('UB_TASK_COMMENTS', 'ub_task_comments');
define('UB_SAVED_SEARCH', 'ub_saved_search');
define('UB_GRID_SETTINGS', 'ub_grid_settings');
define('UB_SUBCONTRACTOR', 'ub_subcontractor');
define('UB_SUBCONTRACTOR_ADDITION_INFO', 'ub_subcontractor_addition_info');
define('UB_CUSTOM_FIELD', 'ub_custom_field');
define('UB_CUSTOM_FIELD_VALUES', 'ub_custom_field_values');
define('UB_MOM', 'ub_mom');
define('UB_MOM_ASSIGNED_USERS', 'ub_mom_assigned_users');
define('UB_MESSAGE', 'ub_message');
define('UB_MESSAGE_FOLDER', 'ub_message_folder');
define('UB_MESSAGE_CONTENT', 'ub_message_content');
define('UB_PLAN', 'ub_plan');
define('UB_USER_PLAN', 'ub_user_plan');
define('UB_PAYMENT', 'ub_payment');
define('UB_INVOICE', 'ub_invoice');
define('UB_WARRANTY_CLAIM', 'ub_warranty_claim');
define('UB_WARRANTY_CLAIM_APPOINTMENT', 'ub_warranty_claim_appointments');
define('UB_WARRANTY_CLAIM_COMMENTS', 'ub_warranty_claim_comments');
define('UB_COMMENTS', 'ub_comments');
define('UB_CHECKLIST', 'ub_checklist');
define('UB_BID', 'ub_bid');
define('UB_COST_CODE', 'ub_cost_variance_code');
define('UB_SUB_COST_CODE', 'ub_bid_sub_cost_code');
define('UB_BID_COST_CODE', 'ub_bid_cost_code');
define('UB_SCHEDULE', 'ub_schedule');
define('UB_BID_RFI_VE', 'ub_bid_rfi_ve');
define('UB_BID_REQUEST', 'ub_bid_request');
define('UB_BID_SUB_COST_CODE', 'ub_bid_sub_cost_code');
define('UB_SELECTION_CHOICE', 'ub_selection_choice');
define('UB_SELECTION', 'ub_selection');
define('UB_SCHEDULE_ASSIGNED_USERS', 'ub_schedule_assigned_users');
define('UB_SCHEDULE_PREDECESSOR_INFO', 'ub_schedule_predecessor_info');
define('UB_SCHEDULE_VIEWABLE_USERS', 'ub_schedule_viewable_users');
define('UB_WORKDAY_EXCEPTION', 'ub_workday_exception');
define('UB_REMINDER', 'ub_reminder');
define('UB_NOTIFICATION', 'ub_notification');
define('UB_ESTIMATE', 'ub_estimate');
define('UB_PO_CO', 'ub_po_co');
define('UB_PO_CO_ACTIVITY', 'ub_po_co_activity');
define('UB_PO_CO_COST_CODE', 'ub_po_co_cost_code');
define('UB_PO_CO_PAYMENT_REQUEST', 'ub_po_co_payment_request');
define('UB_PO_CO_PAYMENT_REQUEST_DETAILS', 'ub_po_co_payment_request_details');
define('UB_PO_CO_PAYMENT_TRANSACTION', 'ub_po_co_payment_transaction');
define('UB_COST_CODE_CATEGORY', 'ub_cost_code_category');
define('UB_PAYAPP', 'ub_payapp');
define('UB_SETUP', 'ub_setup');
define('UB_DOC_FOLDER', 'ub_doc_folder');
define('UB_DOC_FILE', 'ub_doc_file');
define('UB_SETUP_BUDGET_DOCUMENTS', 'ub_setup_budget_documents');
define('UB_PAYAPP_REQUEST_SUMMARY', 'ub_payapp_request_summary');
define('UB_PAYAPP_REQUEST_SUMMARY_TRANSACTIONS', 'ub_payapp_request_summary_transactions');
define('UB_PAYAPP_CERTIFICATE', 'ub_payapp_certificate');
define('UB_PAYAPP_CERTIFICATE_DETAILS', 'ub_payapp_certificate_details');
define('UB_VOUCHER', 'ub_voucher');
define('UB_VOUCHER_TRANSACTION', 'ub_voucher_transaction');
define('UB_PO_CO_PAYMENT_REQUEST_DOCUMENTS', 'ub_po_co_payment_request_documents');
define('UB_TEMPLATE', 'ub_template');
define('UB_TEMPLATE_SCHEDULE', 'ub_template_schedule');
define('UB_TEMPLATE_SCHEDULE_PREDECESSOR_INFO', 'ub_template_schedule_predecessor_info');
define('UB_TEMPLATE_WORKDAY_EXCEPTION', 'ub_template_workday_exception');
define('UB_TEMPLATE_BID', 'ub_template_bid');
define('UB_TEMPLATE_BID_COST_CODE', 'ub_template_bid_cost_code');
define('UB_TEMPLATE_CHECKLIST', 'ub_template_checklist');
define('UB_TEMPLATE_PO_CO', 'ub_template_po_co');
define('UB_TEMPLATE_PO_CO_COST_CODE', 'ub_template_po_co_cost_code');
define('UB_TEMPLATE_SELECTION', 'ub_template_selection');
define('UB_TEMPLATE_SELECTION_CHOICE', 'ub_template_selection_choice');
define('UB_TEMPLATE_ESTIMATE', 'ub_template_estimate');
define('UB_TEMPLATE_TASK', 'ub_template_task');
define('UB_TEMPLATE_TASK_CHECKLIST', 'ub_template_task_checklist');
define('UB_PUNCH_LIST', 'ub_punch_list');
define('UB_PUNCH_LIST_CHECKLIST', 'ub_punch_list_checklist');
define('UB_SIGNOFF_DOCUMENTS_INFO', 'ub_signoff_documents_info');
define('UB_BUILDER_CONTRACT', 'ub_builder_contract');
define('UB_LINK_TO_SCHEDULE', 'ub_link_to_schedule');
define('UB_SURVEY_TEMPLATE', 'ub_survey_template');
define('UB_SURVEY', 'ub_survey');
define('UB_SURVEY_TEMPLATE_QUESTIONS','ub_survey_template_questions');
define('UB_SURVEY_QUESTIONS','ub_survey_questions');
define('UB_SURVEY_QUESTION_ANSWERS','ub_survey_question_answers');

// Payment related constant
define('PENDING_PAYMENT', 'Pending payment');
define('NO_PAYMENT', 'No Status');
define('SUCCESS_PAYMENT', 'Success');
define('FAILD_PAYMENT', 'Failed');
define('NO_CONTRACT', 'No Status');
define('ACTIVE_CONTRACT', 'Active');
define('INACTIVE_CONTRACT', 'Inactive');
define('CANCELLED_CONTRACT', 'Cancelled');

// Unique Email length
define('UNIQUE_EMAIL_LENGTH', 64);

/* Filter Messages Constants */
define('SUCCESS_RESET_MESSAGE', 'Filter has been reset');
define('SUCCESS_SAVE_FILTER_MESSAGE', 'Filter Saved');
define('Failure_SAVE_FILTER_MESSAGE', 'Please fill atleast one feild to save filter');
define('SUCCESS_APPLY_SAVE_FILTER_MESSAGE', 'Saved Filter Applied');


/* Pagination Constants */
define('DEFAULT_PAGINATION_LENGTH', 5);
define('PAGINATION_LENGTH_ONE', 5);
define('PAGINATION_LENGTH_TWO', 25);
define('PAGINATION_LENGTH_THREE', 50);
define('PAGINATION_LENGTH_FOUR', 100);

/* Account type Constants */
define('BUILDERADMIN', 100);
define('OWNER', 200);
define('SUBCONTRACTOR', 300);
define('SUBUSER', 400);
define('UNIADMIN', 500);

/* SMTP settings Constants - Constant value checking with 'int04' filed - In ub_general_value table*/
define('DEFAULT_SMTP', 1000);

/* System specific role IDs defined below */
define('BUILDER_ADMIN_ROLE_ID', 1);
define('SUB_CONTRACTOR_ROLE_ID', 2);
define('OWNER_ROLE_ID', 3);
define('PROJECT_MANAGER_ROLE_ID', 4);
define('SUB_USER_ROLE_ID', 5);
define('UNI_ADMIN_ROLE_ID', 6);

/* System specific message folders/directories */
define('INBOX', 1);
define('SENT', 2);
define('DRAFT', 3);
define('OUTBOX', 4);
define('TRASH', 5);
define('DELETE', 6);

/* Reminder constant added by chandru */
define('REMINDER_DURATION', '+15 minutes');


/* Google Map specific constants are defined here */



define('GOOGLE_MAP_CENTER_PORT_LAT',38.428575704548756);
define('GOOGLE_MAP_CENTER_PORT_LNG',-98.690716796875);



/* Email functionality constants */
define('EMAIL_SEPERATOR_LEVEL1', '@$@');
define('EMAIL_SEPERATOR_LEVEL2', ':::');

/* File upload constants */
define('MAXIMUM_NO_OF_FILES_TO_UPLOAD', 10);
define('FILE_UPLOAD_MAX_SIZE', 10);
if(php_sapi_name() == 'cli')
{
	define('DOC_URL', 'http://ubdocuments.getfriday.com/');
	define('DOC_PATH', '/var/www/ub_documents/');
	define('DOC_TEMP_PATH', '/var/www/ub_documents/tmp/');
}
else
{
	if($_SERVER['SERVER_NAME']=='10.0.0.149' || $_SERVER['SERVER_NAME']=='10.0.0.151')
	{
		define('DOC_URL', 'http://10.0.0.149/gopakumar.k/ub_documents/');
		define('DOC_PATH', '/var/www/html/gopakumar.k/ub_documents/');
		define('DOC_TEMP_PATH', '/var/www/html/gopakumar.k/ub_documents/tmp/');
	}
	elseif($_SERVER['SERVER_NAME'] == 'unibuilder.getfriday.com')
	{
		define('DOC_URL', 'http://ubdocuments.getfriday.com/');
		define('DOC_PATH', '/var/www/ub_documents/');
		define('DOC_TEMP_PATH', '/var/www/ub_documents/tmp/');
	}
	else
	{
		define('DOC_URL', 'http://ubdocuments.unibuilder.net/');
		define('DOC_PATH', '/var/www/ub_documents/');
		define('DOC_TEMP_PATH', '/var/www/ub_documents/tmp/');
	}
}
define('DISCARDED_EXTENSION', 'apk,app,bat,com,exe,jar,php,vb');

define('ALLOWED_EXTENSION', 'dsg,pdf,wps,doc,one,docx,docm,rtf,xls,xlsx,xltx,xlm,xlsm,pps,ppt,pptx,mdb,zip,rar,skp,csv,txt,html,htm,bmp,gif,png,jpg,jpeg,tif,tiff,pub,wav,dwg,dwf,dwfx,dxf,bak,est,wmv,avi,mp4,mov,xps,odt,3gp,3gpp,dat,numbers,pages,3d,2d,tcp,layout,plan,rvt,jp2,eps,ppsx,mpp,gsheet,msg');
/* Below constant was added by chadnru for photoes */
define('ALLOWED_EXTENSION_FOR_PHOTOES', 'tif,png,jpg,jpeg,tiff,jp2,gif');
define('DEFAULT_THUMB_IMAGE_ARRAY', json_encode(array('xls' => array('16' => IMAGESRC.'attachment_default_thumb/excel.png',
																	  '40' => IMAGESRC.'list_default_thumb/excel.png',
																	  '80' => IMAGESRC.'default_thumb/excel.png'),
													  'xlsx' => array('16' => IMAGESRC.'attachment_default_thumb/excel.png',
																	  '40' => IMAGESRC.'list_default_thumb/excel.png',
																	  '80' => IMAGESRC.'default_thumb/excel.png'),
													  'csv' => array('16' => IMAGESRC.'attachment_default_thumb/excel.png',
																	  '40' => IMAGESRC.'list_default_thumb/excel.png',
																	  '80' => IMAGESRC.'default_thumb/excel.png'),
													  'audio' => array('16' => IMAGESRC.'attachment_default_thumb/audio.png',
																	  '40' => IMAGESRC.'list_default_thumb/audio.png',
																	  '80' => IMAGESRC.'default_thumb/audio.png'),
													  'wav' => array('16' => IMAGESRC.'attachment_default_thumb/audio.png',
																	  '40' => IMAGESRC.'list_default_thumb/audio.png',
																	  '80' => IMAGESRC.'default_thumb/audio.png'),
													  'common' => array('16' => IMAGESRC.'attachment_default_thumb/common.png',
																	  '40' => IMAGESRC.'list_default_thumb/common.png',
																	  '80' => IMAGESRC.'default_thumb/common.png'),
													  'doc' => array('16' => IMAGESRC.'attachment_default_thumb/doc.png',
																	  '40' => IMAGESRC.'list_default_thumb/doc.png',
																	  '80' => IMAGESRC.'default_thumb/doc.png'),
													  'one' => array('16' => IMAGESRC.'attachment_default_thumb/doc.png',
																	  '40' => IMAGESRC.'list_default_thumb/doc.png',
																	  '80' => IMAGESRC.'default_thumb/doc.png'),
													  'docx' => array('16' => IMAGESRC.'attachment_default_thumb/doc.png',
																	  '40' => IMAGESRC.'list_default_thumb/doc.png',
																	  '80' => IMAGESRC.'default_thumb/doc.png'),
													  'docm' => array('16' => IMAGESRC.'attachment_default_thumb/doc.png',
																	  '40' => IMAGESRC.'list_default_thumb/doc.png',
																	  '80' => IMAGESRC.'default_thumb/doc.png'),
													  'txt' => array('16' => IMAGESRC.'attachment_default_thumb/doc.png',
																	  '40' => IMAGESRC.'list_default_thumb/doc.png',
																	  '80' => IMAGESRC.'default_thumb/doc.png'),
													  'odt' => array('16' => IMAGESRC.'attachment_default_thumb/doc.png',
																	  '40' => IMAGESRC.'list_default_thumb/doc.png',
																	  '80' => IMAGESRC.'default_thumb/doc.png'),
													  'folder' => array('16' => IMAGESRC.'attachment_default_thumb/folder.png',
																	  '40' => IMAGESRC.'list_default_thumb/folder.png',
																	  '80' => IMAGESRC.'default_thumb/folder.png'),
													  'tif' => array('16' => IMAGESRC.'attachment_default_thumb/img.png',
																	  '40' => IMAGESRC.'list_default_thumb/img.png',
																	  '80' => IMAGESRC.'default_thumb/img.png'),
													  'gif' => array('16' => IMAGESRC.'attachment_default_thumb/img.png',
																	  '40' => IMAGESRC.'list_default_thumb/img.png',
																	  '80' => IMAGESRC.'default_thumb/img.png'),
													  'png' => array('16' => IMAGESRC.'attachment_default_thumb/img.png',
																	  '40' => IMAGESRC.'list_default_thumb/img.png',
																	  '80' => IMAGESRC.'default_thumb/img.png'),
													  'jpg' => array('16' => IMAGESRC.'attachment_default_thumb/img.png',
																	  '40' => IMAGESRC.'list_default_thumb/img.png',
																	  '80' => IMAGESRC.'default_thumb/img.png'),
													  'jpeg' => array('16' => IMAGESRC.'attachment_default_thumb/img.png',
																	  '40' => IMAGESRC.'list_default_thumb/img.png',
																	  '80' => IMAGESRC.'default_thumb/img.png'),
													  'tiff' => array('16' => IMAGESRC.'attachment_default_thumb/img.png',
																	  '40' => IMAGESRC.'list_default_thumb/img.png',
																	  '80' => IMAGESRC.'default_thumb/img.png'),
													  'pdf' => array('16' => IMAGESRC.'attachment_default_thumb/pdf.png',
																	  '40' => IMAGESRC.'list_default_thumb/pdf.png',
																	  '80' => IMAGESRC.'default_thumb/pdf.png'),
													  'avi' => array('16' => IMAGESRC.'attachment_default_thumb/video.png',
																	  '40' => IMAGESRC.'list_default_thumb/video.png',
																	  '80' => IMAGESRC.'default_thumb/video.png'),
													  'mp4' => array('16' => IMAGESRC.'attachment_default_thumb/video.png',
																	  '40' => IMAGESRC.'list_default_thumb/video.png',
																	  '80' => IMAGESRC.'default_thumb/video.png'),
													  'mov' => array('16' => IMAGESRC.'attachment_default_thumb/video.png',
																	  '40' => IMAGESRC.'list_default_thumb/video.png',
																	  '80' => IMAGESRC.'default_thumb/video.png'),
													  'xps' => array('16' => IMAGESRC.'attachment_default_thumb/video.png',
																	  '40' => IMAGESRC.'list_default_thumb/video.png',
																	  '80' => IMAGESRC.'default_thumb/video.png'),
													  '3gp' => array('16' => IMAGESRC.'attachment_default_thumb/video.png',
																	  '40' => IMAGESRC.'list_default_thumb/video.png',
																	  '80' => IMAGESRC.'default_thumb/video.png'),
													  '3gpp' => array('16' => IMAGESRC.'attachment_default_thumb/video.png',
																	  '40' => IMAGESRC.'list_default_thumb/video.png',
																	  '80' => IMAGESRC.'default_thumb/video.png'),
													  'dat' => array('16' => IMAGESRC.'attachment_default_thumb/video.png',
																	  '40' => IMAGESRC.'list_default_thumb/video.png',
																	  '80' => IMAGESRC.'default_thumb/video.png'),
													  'zip' => array('16' => IMAGESRC.'attachment_default_thumb/zip.png',
																	  '40' => IMAGESRC.'list_default_thumb/zip.png',
																	  '80' => IMAGESRC.'default_thumb/zip.png'),
													  'rar' => array('16' => IMAGESRC.'attachment_default_thumb/zip.png',
																	  '40' => IMAGESRC.'list_default_thumb/zip.png',
																	  '80' => IMAGESRC.'default_thumb/zip.png'))));

define('ALLOWED_FILE_SIZE', 20971520); //20*1024*1024 - 20MB
/* Builder registration constants */
define('USERNAME_LENGTH', 20);

/* Number generation */
define('VOUCHER_NUMBER_LENGTH', 10);
define('PO_NUMBER_LENGTH', 10);
define('CO_NUMBER_LENGTH', 10);
define('PAYAPP_NUMBER_LENGTH', 10);
define('BUILDER_MEMBERSHIP_NUMBER_LENGTH', 10);
define('BUILDER_CONTRACT_NUMBER_LENGTH', 7);
define('PAYAPP_NAME_FORMAT', 'PAYAPP');
define('VOUCHER_NAME_FORMAT', 'VOU');
define('PAYMENT_NAME_FORMAT', 'PAY');
define('INVOICE_NAME_FORMAT', 'INV');
define('PAYMENT_NUMBER_LENGTH', 10);
define('INVOICE_NUMBER_LENGTH', 10);
define('PROJ_NUM_LEN', 10);
define('REFID_NUMBER_LENGTH', 9);

/* Clasification for custom field */
define('WARRANTY_CUSTOM_FIELDS', 'warranty_custom_fields');
define('TASK_CUSTOM_FIELDS', 'task_custom_fields');
define('OWNER_INFO_CUSTOM_FIELDS', 'owner_info_custom_fields');
define('PROJECT_INFO_CUSTOM_FIELDS', 'project_info_custom_fields');
define('LEAD_CUSTOM_FIELDS', 'lead_custom_fields');

define('FIELD_ACTIVE', 'Active');
define('FIELD_DELETE', 'Delete');

define('MULTI_SELECT_DROP_DOWN', 'multi_select_drop_down');
define('SINGLE_SELECT_DROP_DOWN', 'single_select_drop_down');
define('CURRENY', 'curreny');
define('DATE_PICKER', 'date_picker');
define('LIST_OF_BU_SUB_OWNER', 'list_of_bu_sub_owner');
define('LIST_OF_SUB', 'list_of_sub');
define('LIST_OF_BU', 'list_of_bu');
define('WHOLE_NUMBER', 'whole_number');
define('CHECKBOX', 'checkbox');
define('TEXTAREA', 'textarea');
define('TEXTBOX', 'textbox');
define('LOGO_MIN_WIDTH', '60');
define('LOGO_MAX_WIDTH', '200');
define('LOGO_MIN_HEIGHT', '60');
define('LOGO_MAX_HEIGHT', '200');
define('PAYMENT_DURATION', '30');
define('PAYMENT_ERROR_CODE_ARRAY', json_encode(array('E00001' => 'An unexpected system error occurred while processing this request.',
					'E00002' =>  'The only supported content-types are text/xml and application/xml.',
					'E00003' =>  'This is the result of an XML parser error.',
					'E00004' =>  'The name of the root node of the XML request is the API method being called. It is not valid.',
					'E00005' =>  'Merchant authentication requires a valid value for transaction key.',
					'E00006' =>  'Merchant authentication requires a valid value for name.',
					'E00007' =>  'The name/and or transaction key is invalid.',
					'E00008' =>  'The payment gateway or user account is not currently active.',
					'E00009' =>  'The requested API method cannot be executed while the payment gateway account is in Test Mode.',
					'E00010' =>  'The user does not have permission to call the API.',
					'E00011' =>  'The user does not have permission to call the API method.',
					'E00012' =>  'A duplicate of the subscription was already submitted. The duplicate check looks at several fields including payment information, billing information and, specifically for subscriptions, Start Date, Interval and Unit.',
					'E00013' =>  'One of the field values is not valid.',
					'E00014' =>  'One of the required fields was not present.',
					'E00015' =>  'One of the fields has an invalid length.',
					'E00016' =>  'The field type is not valid.',
					'E00017' =>  'The subscription start date cannot occur before the subscription submission date. (Note: validation is performed against local server date, which is Mountain Time.)',
					'E00018' =>  'The credit card is not valid as of the start date of the subscription.',
					'E00019' =>  'The customer tax ID or driver’s license information (driver’s license number, driver’s license state, driver’s license DOB) is required for the subscription.',
					'E00020' =>  'This payment gateway account is not set up to process eCheck.Net subscriptions.',
					'E00021' =>  'This payment gateway account is not set up to process credit card subscriptions.',
					'E00022' =>  'The interval length must be 7 to 365 days or 1 to 12 months.',
					'E00024' =>  'The number of trial occurrences cannot be zero if a valid trial amount is submitted.',
					'E00025' =>  'The payment gateway account is not enabled for Automated Recurring Billing.',
					'E00026' =>  'If either a trial amount or number of trial occurrences is specified then values for both must be submitted.',
					'E00027' =>  'An approval was not returned for the test transaction.',
					'E00028' =>  'The number of trial occurrences specified must be less than the number of total occurrences specified.',
					'E00029' =>  'Payment information is required when creating a subscription.',
					'E00030' =>  'A payment schedule is required when creating a subscription.',
					'E00031' =>  'The subscription amount is required when creating a subscription.',
					'E00032' =>  'The subscription start date is required to create a subscription.',
					'E00033' =>  'Once a subscription is created the Start Date cannot be changed.',
					'E00034' =>  'Once a subscription is created the subscription interval cannot be changed.',
					'E00035' =>  'The subscription ID for this request is not valid for this merchant.',
					'E00036' =>  'Changing the subscription payment type between credit card and eCheck.Net is not currently supported.',
					'E00037' =>  'Subscriptions that are expired, canceled or terminated cannot be updated.',
					'E00038' =>  'Subscriptions that are expired or terminated cannot be canceled.',
					'E00045' =>  'An error exists in the XML namespace. This error is similar to E00003.')));

define('CURRENCY_SYMBOL', '');
define('CURRENCY_FORMAT_TEXT', 'de_US');					
/* End of file constants.php */
/* Location: ./application/config/constants.php */
