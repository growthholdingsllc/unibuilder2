<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/
$active_group = 'default';
$active_record = TRUE;
//Live
// Default
$db['default']['hostname'] = "localhost";
$db['default']['username'] = "root";
$db['default']['password'] = "Sfr70gSCZ6V30ts";
$db['default']['database'] = "ublive";
$db['default']['dbdriver'] = "mysqli";
$db['default']['dbprefix'] = "";
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = FALSE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = "";
$db['default']['char_set'] = "utf8";
$db['default']['dbcollat'] = "utf8_general_ci";
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;
//Read database
$db['readdb']['hostname'] = "localhost";
$db['readdb']['username'] = "root";
$db['readdb']['password'] = "Sfr70gSCZ6V30ts";
$db['readdb']['database'] = "ublive";
$db['readdb']['dbdriver'] = "mysqli";
$db['readdb']['dbprefix'] = "";
$db['readdb']['pconnect'] = TRUE;
$db['readdb']['db_debug'] = FALSE;
$db['readdb']['cache_on'] = FALSE;
$db['readdb']['cachedir'] = "";
$db['readdb']['char_set'] = "utf8";
$db['readdb']['dbcollat'] = "utf8_general_ci";
$db['readdb']['swap_pre'] = '';
$db['readdb']['autoinit'] = TRUE;
$db['readdb']['stricton'] = FALSE;
//Write database
$db['writedb']['hostname'] = "localhost";
$db['writedb']['username'] = "root";
$db['writedb']['password'] = "Sfr70gSCZ6V30ts";
$db['writedb']['database'] = "ublive";
$db['writedb']['dbdriver'] = "mysqli";
$db['writedb']['dbprefix'] = "";
$db['writedb']['pconnect'] = TRUE;
$db['writedb']['db_debug'] = FALSE;
$db['writedb']['cache_on'] = FALSE;
$db['writedb']['cachedir'] = "";
$db['writedb']['char_set'] = "utf8";
$db['writedb']['dbcollat'] = "utf8_general_ci";
$db['writedb']['swap_pre'] = '';
$db['writedb']['autoinit'] = TRUE;
$db['writedb']['stricton'] = FALSE;
// Session database
$db['sessiondb']['hostname'] = "localhost";
$db['sessiondb']['username'] = "root";
$db['sessiondb']['password'] = "Sfr70gSCZ6V30ts";
$db['sessiondb']['database'] = "ublive";
$db['sessiondb']['dbdriver'] = "mysqli";
$db['sessiondb']['dbprefix'] = "";
$db['sessiondb']['pconnect'] = TRUE;
$db['sessiondb']['db_debug'] = FALSE;
$db['sessiondb']['cache_on'] = FALSE;
$db['sessiondb']['cachedir'] = "";
$db['sessiondb']['char_set'] = "utf8";
$db['sessiondb']['dbcollat'] = "utf8_general_ci";
$db['sessiondb']['swap_pre'] = '';
$db['sessiondb']['autoinit'] = TRUE;
$db['sessiondb']['stricton'] = FALSE;
/* End of file database.php */
/* Location: ./application/config/database.php */
