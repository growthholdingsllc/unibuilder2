-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 12, 2015 at 10:32 AM
-- Server version: 5.5.40
-- PHP Version: 5.6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `unibuilder`
--

-- --------------------------------------------------------

--
-- Table structure for table `ub_allowances`
--

CREATE TABLE IF NOT EXISTS `ub_allowances` (
  `allowance_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `selection_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_selection table selection_id',
  `allowance_amount` double DEFAULT NULL,
  `note` varchar(2000) DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`allowance_id`),
  KEY `selection_id` (`selection_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Allowance table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_bids`
--

CREATE TABLE IF NOT EXISTS `ub_bids` (
  `bid_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bid_package_id` bigint(20) unsigned NOT NULL,
  `assigned_to` bigint(20) unsigned NOT NULL COMMENT 'Reference ot ub_user user_Id (sub contractor)',
  `viewed_date` datetime DEFAULT NULL,
  `will_bid` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table value',
  `bid_submit_on` datetime DEFAULT NULL,
  `po_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_purchase_order in po_id',
  `bid_status` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table value',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`bid_id`),
  KEY `bid_package_id` (`bid_package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='A bid package is assigned to multiple sub contrators, those informaitons would get store in this table		' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_bid_comments`
--

CREATE TABLE IF NOT EXISTS `ub_bid_comments` (
  `comment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bid_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_bid table bid_id',
  `comments` varchar(4000) DEFAULT NULL,
  `status` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table value',
  `show_sub` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `show_owner` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `notify_sub` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `notify_owner` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`comment_id`),
  KEY `bid_id` (`bid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='all bids comments get stored in this table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_bid_items`
--

CREATE TABLE IF NOT EXISTS `ub_bid_items` (
  `item_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bid_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_bid_package table bid_id',
  `cost_code_id` bigint(20) unsigned NOT NULL COMMENT 'Reference ot ub_cost_codes code_id',
  `cost_code` varchar(128) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `unit_amount` double NOT NULL DEFAULT '0',
  `quantity` int(10) unsigned NOT NULL,
  `line_total` double DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`item_id`),
  KEY `bid_id` (`bid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_bid_package`
--

CREATE TABLE IF NOT EXISTS `ub_bid_package` (
  `bid_package_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_job table job_id',
  `package_title` varchar(128) NOT NULL,
  `multiple_accepted_bid` enum('1','0') NOT NULL DEFAULT '0',
  `number_days` int(10) unsigned NOT NULL,
  `on_or_before` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table value',
  `schedule_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Reference to ub_schedule table scheduel_id',
  `due_date` date DEFAULT NULL,
  `time_chosen` time DEFAULT NULL,
  `remainder_before_deadline` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Number of days before the reminder has to go',
  `internal_notes` varchar(2000) DEFAULT NULL,
  `package_type` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settiings_value table (flat fee / line item)',
  `package_amount` double DEFAULT NULL,
  `package_description` text,
  `bid_invitation_text` text,
  `status` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`bid_package_id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_bid_package_items`
--

CREATE TABLE IF NOT EXISTS `ub_bid_package_items` (
  `item_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bid_package_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_bid_package table bid_package_id',
  `cost_code_id` bigint(20) NOT NULL COMMENT 'Reference ot ub_cost_codes cost_code_id',
  `cost_code` varchar(128) NOT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`item_id`),
  KEY `bid_package_id` (`bid_package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_bid_package_rfi`
--

CREATE TABLE IF NOT EXISTS `ub_bid_package_rfi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bid_package_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_bid_package table bid_package_id',
  `question` varchar(2000) NOT NULL,
  `answer` varchar(2000) DEFAULT NULL,
  `answer_by` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table user_id',
  `answer_by_date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `assigned_to` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table user_id',
  `sub_view` enum('1','0') DEFAULT '0',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`id`),
  KEY `bid_package_id` (`bid_package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Sub vendor can as questions , builder have to answer for it. RFI is right for information' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_change_order`
--

CREATE TABLE IF NOT EXISTS `ub_change_order` (
  `co_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL,
  `co_title` varchar(128) NOT NULL,
  `co_no` varchar(128) NOT NULL,
  `customer_price` double DEFAULT NULL,
  `builder_cost` double DEFAULT NULL,
  `amount_paid` double DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `owner_last_viewed` date DEFAULT NULL,
  `view_owner` enum('1','0') NOT NULL DEFAULT '1',
  `view_sub` enum('1','0') NOT NULL DEFAULT '1',
  `internal_notes` varchar(2000) DEFAULT NULL,
  `sub_notes` varchar(2000) DEFAULT NULL,
  `owner_notes` varchar(2000) DEFAULT NULL,
  `co_description` text,
  `co_status` bigint(20) unsigned NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`co_id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_choices`
--

CREATE TABLE IF NOT EXISTS `ub_choices` (
  `choice_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `selection_id` bigint(20) unsigned NOT NULL,
  `owner_price` double DEFAULT NULL,
  `to_be_decided` enum('1','0') DEFAULT '0',
  `builder_cost` double DEFAULT NULL,
  `request_from_vendor` enum('1','0') DEFAULT '0',
  `sub_pricing_comments` varchar(2000) DEFAULT NULL,
  `vendor_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table user_id',
  `installer_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table user_id',
  `product_link` varchar(500) DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`choice_id`),
  KEY `selection_id` (`selection_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Choices for selection can be added in this table		' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_cost_code`
--

CREATE TABLE IF NOT EXISTS `ub_cost_code` (
  `cost_code_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cc_title` varchar(128) NOT NULL,
  `cc_category_id` int(10) unsigned NOT NULL COMMENT 'Refernece to ub_cost_code_category table cc_category_id',
  `cc_parent_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_cost_code table cost_code_id',
  `cc_details` varchar(2000) DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`cost_code_id`),
  KEY `cc_category_id` (`cc_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='All cost codes' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_cost_code_category`
--

CREATE TABLE IF NOT EXISTS `ub_cost_code_category` (
  `cc_category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cc_category_title` varchar(128) NOT NULL,
  `cc_category_details` varchar(2000) NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`cc_category_id`),
  UNIQUE KEY `cc_category_title_UNIQUE` (`cc_category_title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Cost code main category' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_co_assigned_users`
--

CREATE TABLE IF NOT EXISTS `ub_co_assigned_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `co_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_change_order table co_id',
  `assigned_to` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table. To whom which the schedule is assigned to.',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`id`),
  KEY `co_id` (`co_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_custom_field`
--

CREATE TABLE IF NOT EXISTS `ub_custom_field` (
  `cust_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cust_type` enum('full','partial') NOT NULL DEFAULT 'partial' COMMENT ' From setup we can create custom fileds those custom type called Full, eg for a tag drop down we can add values, those type os called Partial custom fields',
  `display_name` varchar(128) NOT NULL,
  `field_name` varchar(128) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `data_type` varchar(128) NOT NULL COMMENT 'Html Field type',
  `tooltip` varchar(1000) DEFAULT NULL COMMENT 'Description for custom field that would get displayed in tooltip',
  `mandatory` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `include_in_filter` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `sub_access` enum('1','0') NOT NULL DEFAULT '0' COMMENT 'Cutom field access giving to sub contractor. 1 yes and 0 no',
  `status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1 active and 0 is inactive',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='All custom fileds / dynamic fileds names and types informations	' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_custom_field_details`
--

CREATE TABLE IF NOT EXISTS `ub_custom_field_details` (
  `cust_details_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cust_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to custom_field table cust_id',
  `display_name` varchar(128) NOT NULL COMMENT 'Display name / label',
  `display_order` smallint(6) NOT NULL COMMENT 'Displaying order',
  `can_delete` enum('1','0') NOT NULL DEFAULT '1' COMMENT 'Some of the custom details value can be deleted \n1 yes and 0 no',
  `status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1 active and 0 inactive',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`cust_details_id`),
  KEY `cust_id` (`cust_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table contain the field values' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_custom_filed_master`
--

CREATE TABLE IF NOT EXISTS `ub_custom_filed_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `display_name` varchar(128) NOT NULL COMMENT 'Display name  / label',
  `filed_name` varchar(128) NOT NULL COMMENT 'filed name which is unique, used for database interaction',
  `status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1 is active and 0 is inactive',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`id`),
  UNIQUE KEY `display_name_UNIQUE` (`display_name`),
  UNIQUE KEY `filed_name_UNIQUE` (`filed_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='For which menu we can create custom fileds those information would get stored in this table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_daily_log`
--

CREATE TABLE IF NOT EXISTS `ub_daily_log` (
  `log_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL,
  `log_date` date NOT NULL,
  `log_notes` varchar(4000) NOT NULL,
  `tags` varchar(128) DEFAULT NULL,
  `private` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `show_subs` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `show_owner` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `notify_subs` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `notify_owner` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `notify_internal` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `weather_notes` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `weather_description` varchar(4000) DEFAULT NULL,
  `status` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table value',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`log_id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_daily_log_comments`
--

CREATE TABLE IF NOT EXISTS `ub_daily_log_comments` (
  `comment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_daily_log table log_id',
  `comments` varchar(4000) DEFAULT NULL,
  `show_sub` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `show_owner` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `notify_sub` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `notify_owner` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `status` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table value',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`comment_id`),
  KEY `log_id` (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Daily log comments' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_document`
--

CREATE TABLE IF NOT EXISTS `ub_document` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_job table job_id\n',
  `type` enum('file','directory') NOT NULL DEFAULT 'file',
  `name` varchar(500) DEFAULT NULL COMMENT 'Name of the file / Directory',
  `left` int(10) unsigned NOT NULL COMMENT 'Pre order tree   left value current node',
  `right` int(10) unsigned NOT NULL COMMENT 'Pre order tree right value of the current node',
  `show_owner` enum('1','0') NOT NULL DEFAULT '1',
  `show_sub` enum('1','0') NOT NULL DEFAULT '1',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_estimates`
--

CREATE TABLE IF NOT EXISTS `ub_estimates` (
  `estimate_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_job table job_id',
  `cost_code_id` bigint(20) unsigned NOT NULL COMMENT 'Reference ot ub_cost_codes cost-code_id',
  `cost_code` varchar(128) DEFAULT NULL,
  `notes` varchar(2000) DEFAULT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `unit_price` double DEFAULT NULL,
  `line_total` double DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`estimate_id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_file`
--

CREATE TABLE IF NOT EXISTS `ub_file` (
  `file_id` bigint(20) unsigned NOT NULL,
  `classification` bigint(20) unsigned NOT NULL COMMENT 'Classifying the file eg: profile image/ lead upload etc.\n Reference to ub_settings_value table setting_name "FILE_CLASSIFICATION" and value ',
  `reference_id` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id for profilie image, ub_todo table todo_id for todo file etc.',
  `user_id` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `file_type` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_settings_value table setting_name "FILE_TYPE" and value eg: email attachment / manual upload',
  `file_path` varchar(500) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT 'Email attachment cannot be deleted, only manually uploaded file can be deleted',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='All file information would get stored in this table';

-- --------------------------------------------------------

--
-- Table structure for table `ub_grid_settings_master`
--

CREATE TABLE IF NOT EXISTS `ub_grid_settings_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `display_page` varchar(128) NOT NULL COMMENT 'Which page, we are showing the grid settings',
  `label_name` varchar(128) NOT NULL COMMENT 'Columns Human Readable name',
  `field_name` varchar(128) NOT NULL COMMENT 'Column database field name',
  `is_editable` enum('1','0') DEFAULT '1' COMMENT 'If yes, it can be checked / un checked, other wise by default checked.',
  `is_checked` enum('1','0') DEFAULT '1' COMMENT 'By default columns checked',
  `is_sortable` enum('1','0') DEFAULT '1' COMMENT 'is the field is sorable /  not',
  `ub_grid_settings_mastercol` varchar(45) DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`id`),
  UNIQUE KEY `display_page_UNIQUE` (`display_page`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Grid settings master table holds the coloumns to display  for lead list / job list etc.' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_group`
--

CREATE TABLE IF NOT EXISTS `ub_group` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(128) NOT NULL,
  `link_to` int(10) unsigned NOT NULL COMMENT 'Reference to ub_group table group_id',
  `group_email` varchar(128) NOT NULL,
  `inherited_from` varchar(1000) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1 active and 0 inactive',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_job`
--

CREATE TABLE IF NOT EXISTS `ub_job` (
  `job_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_name` varchar(128) NOT NULL,
  `owner_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table user_id',
  `job_address` varchar(500) DEFAULT NULL,
  `job_city` varchar(128) DEFAULT NULL,
  `job_prov` varchar(3) DEFAULT NULL,
  `job_postal_code` varchar(10) DEFAULT NULL,
  `job_lot_info` varchar(128) DEFAULT NULL,
  `job_permit_no` varchar(128) DEFAULT NULL,
  `job_contract_price` double DEFAULT NULL,
  `job_interal_note` varchar(2000) DEFAULT NULL COMMENT 'Internal user notes',
  `job_sub_note` varchar(2000) DEFAULT NULL COMMENT 'Sub contractor notes',
  `job_projected_start` date DEFAULT NULL,
  `job_projected_completion` date DEFAULT NULL,
  `job_actual_start` date DEFAULT NULL,
  `job_actual_completion` date DEFAULT NULL,
  `limit_owner_calendar` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table value',
  `job_color_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_custom_filed_details cust_detail_id',
  `job_work_days` varchar(20) DEFAULT NULL COMMENT 'Days values are stored as comma separated',
  `cost_summery_to_owner` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 to show and 0 not to show',
  `jobsite_prefix` varchar(20) DEFAULT NULL,
  `individual_po_limit` double DEFAULT NULL,
  `jobsite_po_limit` double DEFAULT NULL,
  `show_budget_and_po` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `add_clime` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `include_allowances` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `view_payment_by_owner` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `job_status` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table value',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='All  jobs information get stored in this table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_job_assigned_users`
--

CREATE TABLE IF NOT EXISTS `ub_job_assigned_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_job table job_id',
  `assigned_to` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table user_id',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`id`),
  KEY `job_id` (`job_id`),
  KEY `assigned_to` (`assigned_to`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_job_details`
--

CREATE TABLE IF NOT EXISTS `ub_job_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_job table job_id',
  `cust_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_custom_filed table cust_id',
  `cust_details_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_custom_filed_details table cust_details_id',
  `value` varchar(128) NOT NULL COMMENT 'value',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  PRIMARY KEY (`id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Detailed information of a job' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_lead`
--

CREATE TABLE IF NOT EXISTS `ub_lead` (
  `lead_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `cell` varchar(15) DEFAULT NULL,
  `confidence_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Confidence level percentage of converting the lead in to job',
  `projected_sales_date` date NOT NULL COMMENT 'Projected lead to job conversion date',
  `address` varchar(128) DEFAULT NULL,
  `city` varchar(128) DEFAULT NULL,
  `prov` varchar(3) DEFAULT NULL COMMENT 'State',
  `postal_code` varchar(10) DEFAULT NULL,
  `sales_person` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table user_id',
  `note` varchar(1000) DEFAULT NULL,
  `status` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table value',
  `estimated_revenue_min` double DEFAULT NULL COMMENT 'Estimated min revenue',
  `estimated_revenue_max` double DEFAULT NULL COMMENT 'Estimated max revenue',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`lead_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='All lead infomation get stored in this table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_lead_activities`
--

CREATE TABLE IF NOT EXISTS `ub_lead_activities` (
  `activity_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lead_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_lead table lead_id',
  `assign_to` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table user_id',
  `initiated_by` bigint(20) unsigned NOT NULL COMMENT 'Sales person / Lead / Other, Reference to ub_settings_value table value',
  `activity_date` date NOT NULL COMMENT 'Date in which the activity to be one',
  `activity_time` time DEFAULT NULL COMMENT 'Time in which the activity to be one',
  `mark_status` enum('1','0') NOT NULL DEFAULT '0' COMMENT 'Activity marked as completed / not\n1 is completed and 0 is not completed',
  `follow_up_date` date DEFAULT NULL COMMENT 'Next follow update date',
  `follow_up_time` time DEFAULT NULL COMMENT 'Next follow update time',
  `reminder` tinyint(4) NOT NULL COMMENT 'Reminder setting for the activity',
  `description` text,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`activity_id`),
  KEY `lead_id` (`lead_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_lead_activity_details`
--

CREATE TABLE IF NOT EXISTS `ub_lead_activity_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_lead_activities table activity_id',
  `cust_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_custom_filed table cust_id',
  `cust_details_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_custom_filed_details table cust_details_id',
  `value` varchar(128) NOT NULL COMMENT 'value',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Activity details ' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_lead_activity_emails`
--

CREATE TABLE IF NOT EXISTS `ub_lead_activity_emails` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_lead_activities table activity_id',
  `generated_email_id` varchar(500) NOT NULL COMMENT 'Reference to ub_custom_filed table cust_id',
  `subject` varchar(500) NOT NULL,
  `message` text,
  `status` bigint(20) unsigned NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_lead_client_emails`
--

CREATE TABLE IF NOT EXISTS `ub_lead_client_emails` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lead_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_lead table lead_id',
  `label` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`id`),
  KEY `lead_id` (`lead_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Clients emails for a lead' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_lead_details`
--

CREATE TABLE IF NOT EXISTS `ub_lead_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lead_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_lead table lead_id',
  `cust_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_custom_filed table cust_id',
  `cust_details_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_custom_filed_details table cust_details_id',
  `value` varchar(128) NOT NULL COMMENT 'value',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`id`),
  KEY `lead_id` (`lead_id`),
  KEY `cust_id` (`cust_id`),
  KEY `cust_details_id` (`cust_details_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='All lead details of a lead' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_po_activity`
--

CREATE TABLE IF NOT EXISTS `ub_po_activity` (
  `activity_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `po_id` bigint(20) unsigned NOT NULL,
  `activity_status` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table',
  `comment` varchar(2000) DEFAULT NULL,
  `comment_by` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table user_id',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`activity_id`),
  KEY `po_id` (`po_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tracks all the activities of PO' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_po_comments`
--

CREATE TABLE IF NOT EXISTS `ub_po_comments` (
  `comment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `po_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_po table po_id',
  `comments` varchar(4000) DEFAULT NULL,
  `show_sub` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `show_owner` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `notify_sub` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `notify_owner` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `status` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table value',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`comment_id`),
  KEY `po_id` (`po_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_po_items`
--

CREATE TABLE IF NOT EXISTS `ub_po_items` (
  `po_item_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `po_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_purchase_order table po_id',
  `cost_code_id` bigint(20) unsigned NOT NULL,
  `cost_code` varchar(128) DEFAULT NULL,
  `unit_amount` double DEFAULT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `line_total` double DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`po_item_id`),
  KEY `po_id` (`po_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='PO items stored in this table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_po_payments`
--

CREATE TABLE IF NOT EXISTS `ub_po_payments` (
  `payment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `po_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_purchase_order table po_id',
  `payment_title` varchar(128) NOT NULL,
  `invoice_date` date NOT NULL,
  `ready_for_payment` enum('1','0') NOT NULL DEFAULT '0',
  `comments` varchar(2000) DEFAULT NULL,
  `pay_to` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table user_id',
  `number_days` int(10) unsigned NOT NULL,
  `on_or_before` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value ',
  `schedule_id` bigint(20) unsigned NOT NULL COMMENT 'Reference ub_schedule table',
  `reminder_date` date DEFAULT NULL,
  `payment_status` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table',
  `payment_type` bigint(20) DEFAULT NULL COMMENT 'Reference to ub_settings_value table (partial / void etc)',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`payment_id`),
  KEY `po_id` (`po_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Payment for PO tracks in this table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_po_payments_transactions`
--

CREATE TABLE IF NOT EXISTS `ub_po_payments_transactions` (
  `transaction_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payment_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to  ub_po_payment table payment_id',
  `po_item_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_po_items table po_item_id',
  `po_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_purchase_order table po_id',
  `pay_amount` double DEFAULT NULL,
  `payment_type` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`transaction_id`),
  KEY `payment_id` (`payment_id`),
  KEY `po_id` (`po_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='All payment transaction stored in this table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_purchase_order`
--

CREATE TABLE IF NOT EXISTS `ub_purchase_order` (
  `po_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `po_no` varchar(128) NOT NULL,
  `job_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_job table job_id',
  `po_title` varchar(128) DEFAULT NULL,
  `assigned_to` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table user_id',
  `materials_only` enum('1','0') NOT NULL DEFAULT '0',
  `scheduled_item_check` enum('1','0') NOT NULL DEFAULT '0',
  `schedule_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_schedule table schedule_id',
  `completion_date` date DEFAULT NULL,
  `variance_po` enum('1','0') NOT NULL DEFAULT '0',
  `variance_code` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_cost_code table',
  `po_link_to` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_purchase_order table po_id',
  `internal_notes` varchar(2000) DEFAULT NULL,
  `sub_view` enum('1','0') NOT NULL DEFAULT '0',
  `scope` text,
  `amended_text` text,
  `po_status` bigint(20) unsigned NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`po_id`),
  UNIQUE KEY `po_no_UNIQUE` (`po_no`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Purchase order table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_schedule`
--

CREATE TABLE IF NOT EXISTS `ub_schedule` (
  `schedule_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned zerofill NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `display_color` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `reminder_id` int(10) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table',
  `phases` int(10) unsigned NOT NULL,
  `show_gantt` enum('1','0') NOT NULL DEFAULT '1',
  `show_owner` enum('1','0') DEFAULT '1',
  `all_notes` varchar(2000) DEFAULT NULL,
  `internal_notes` varchar(2000) DEFAULT NULL,
  `sub_notes` varchar(2000) DEFAULT NULL,
  `owner_notes` varchar(2000) DEFAULT NULL,
  `schedule_status` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`schedule_id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_schedule_assigned_users`
--

CREATE TABLE IF NOT EXISTS `ub_schedule_assigned_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `schedule_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_schedule table schedule_id',
  `view_user_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table.  View access giving to the particular schedule',
  `assigned_user_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table. To whom which the schedule is assigned to',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`id`),
  KEY `schedule_id` (`schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_schedule_linkto`
--

CREATE TABLE IF NOT EXISTS `ub_schedule_linkto` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `schedule_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_schedule table schedule_id',
  `link_to_type` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table table.  ',
  `link_to_id` bigint(20) unsigned NOT NULL COMMENT 'Based on the type of link to (to-do, job, bid) etc. The id will get inserted in this table.',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`id`),
  KEY `schedule_id` (`schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_schedule_predecessor`
--

CREATE TABLE IF NOT EXISTS `ub_schedule_predecessor` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `schedule_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_schedule table schedule_id',
  `predecessor_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_schedule table.  ',
  `start_type` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table',
  `lab` int(10) unsigned NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`id`),
  KEY `schedule_id` (`schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_selection`
--

CREATE TABLE IF NOT EXISTS `ub_selection` (
  `selection_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_job table job_id',
  `title` varchar(128) NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_custom_detail table',
  `category` varchar(128) DEFAULT NULL,
  `location_id` bigint(20) unsigned NOT NULL,
  `location_name` varchar(128) DEFAULT NULL,
  `allowance_type` bigint(20) unsigned NOT NULL,
  `allowance_id` bigint(20) DEFAULT NULL,
  `allowance_amount` double DEFAULT NULL,
  `link_to` enum('1','0') NOT NULL,
  `number_of_days` int(10) unsigned NOT NULL,
  `after_before` bigint(20) unsigned NOT NULL,
  `schedule_id` varchar(45) DEFAULT NULL COMMENT 'Reference to shedule table',
  `required` enum('1','0') NOT NULL DEFAULT '0',
  `allow_multiple_user` enum('1','0') NOT NULL DEFAULT '0',
  `choice_ordering` bigint(20) DEFAULT NULL COMMENT 'Reference to ttk_settings_value table',
  `public_instruction` varchar(2000) DEFAULT NULL,
  `internal_notes` varchar(2000) DEFAULT NULL,
  `owner_fileview` enum('1','0') DEFAULT '0',
  `sub_fileview` enum('1','0') DEFAULT '0',
  `fileview_notify_owner` enum('1','0') DEFAULT '0',
  `fileview_notify_sub` enum('1','0') DEFAULT '0',
  `owner_participation` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'Reference to ub_settings_value',
  `vendor_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table user_id',
  `vendors_participation` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value',
  `installer_id` bigint(20) unsigned NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`selection_id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_settings`
--

CREATE TABLE IF NOT EXISTS `ub_settings` (
  `settings_name` varchar(128) NOT NULL COMMENT 'Pre defined values name eg: USER_TYPE, USER_STATUS, JOB_STATUS etc.',
  `settings_type` varchar(128) NOT NULL COMMENT 'HTML Filed type',
  `settings_status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1 is active and 0 is inactive',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`settings_name`),
  UNIQUE KEY `settings_name_UNIQUE` (`settings_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='All Predefined master values store in this table';

-- --------------------------------------------------------

--
-- Table structure for table `ub_settings_value`
--

CREATE TABLE IF NOT EXISTS `ub_settings_value` (
  `settings_value_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `settings_name` varchar(128) NOT NULL COMMENT 'Pre defined values name eg: USER_TYPE, USER_STATUS, JOB_STATUS etc. Reference to ub_settings table settings_name',
  `display_name` varchar(128) NOT NULL DEFAULT '1' COMMENT 'Hold label',
  `value` varchar(50) NOT NULL COMMENT 'Hold value',
  `display_order` smallint(6) NOT NULL DEFAULT '0',
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`settings_value_id`),
  KEY `settings_name` (`settings_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Pre define master table sub values	' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_todo`
--

CREATE TABLE IF NOT EXISTS `ub_todo` (
  `todo_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL COMMENT 'Refecne to ub_job table job_id',
  `todo_title` varchar(128) NOT NULL,
  `todo_note` varchar(2000) DEFAULT NULL,
  `mark_complete_status` enum('1','0') NOT NULL DEFAULT '0',
  `number_days` int(10) unsigned NOT NULL,
  `on_or_before` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table value',
  `schedule_id` bigint(20) unsigned NOT NULL,
  `due_date` date DEFAULT NULL,
  `time_chosen` time DEFAULT NULL,
  `priority` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table value',
  `tags` varchar(128) DEFAULT NULL,
  `reminder__id` int(10) unsigned NOT NULL,
  `status` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table value',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`todo_id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='All todos would get stored in this table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_todo_assigned_users`
--

CREATE TABLE IF NOT EXISTS `ub_todo_assigned_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `todo_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_todo table todo_id',
  `assigned_to` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table user_id',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`id`),
  KEY `todo_id` (`todo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_todo_checklist`
--

CREATE TABLE IF NOT EXISTS `ub_todo_checklist` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `todo_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_todo table todo_id',
  `Description` varchar(2000) DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`id`),
  KEY `todo_id` (`todo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='check list of each todo get stored in this table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_todo_comments`
--

CREATE TABLE IF NOT EXISTS `ub_todo_comments` (
  `comment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `todo_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_todo table todo_id',
  `comments` varchar(4000) DEFAULT NULL,
  `status` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table value',
  `show_sub` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `show_owner` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `notify_sub` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `notify_owner` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`comment_id`),
  KEY `todo_id` (`todo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Comments on each todo stored in this table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_user`
--

CREATE TABLE IF NOT EXISTS `ub_user` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL COMMENT 'Which group the user belongs to. Reference to ub_group table',
  `user_type` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_settings_value table setting_name "USER_TYPE" and value',
  `first_name` varchar(128) NOT NULL,
  `middle_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) NOT NULL,
  `home_phone` varchar(15) DEFAULT NULL,
  `cell_phone` varchar(15) DEFAULT NULL,
  `cell_email` varchar(128) DEFAULT NULL COMMENT 'The Cell Text Messaging allows you to send text message alerts to homebuyer',
  `email` varchar(128) NOT NULL COMMENT 'Registration email id',
  `communication_email` varchar(128) NOT NULL COMMENT 'All communication will be send to this email id',
  `company_name` varchar(128) DEFAULT NULL,
  `username` varchar(128) NOT NULL COMMENT 'user name for login',
  `password` varchar(128) NOT NULL COMMENT 'MD5 encryption used to store the password',
  `email_verify` enum('1','0') NOT NULL DEFAULT '0' COMMENT 'Email verification status',
  `phone_verify` enum('1','0') NOT NULL DEFAULT '0' COMMENT 'Phone verification status',
  `user_status` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table setting_name "USER_STATUS" and value',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`user_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='All type of users information would get stored in this table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_warranty`
--

CREATE TABLE IF NOT EXISTS `ub_warranty` (
  `warranty_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_job table job_id',
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table user_id',
  `title` varchar(128) NOT NULL,
  `priority` bigint(20) DEFAULT NULL COMMENT 'Reference to ub_settings_value value',
  `description` varchar(2000) DEFAULT NULL,
  `internal_comments` varchar(2000) DEFAULT NULL,
  `status` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value',
  `service_coordinator` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table user_id',
  `show_owner` enum('1','0') DEFAULT '0',
  `classification` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value value',
  `origin_item` bigint(20) DEFAULT NULL COMMENT 'Reference to Schedule',
  `added_cost` double DEFAULT NULL,
  `followup_date` date DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`warranty_id`),
  KEY `job_id` (`job_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_warranty_details`
--

CREATE TABLE IF NOT EXISTS `ub_warranty_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `warranty_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_warranty_details warranty_id',
  `cust_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_custom_filed table cust_id',
  `cust_details_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_custom_filed_details table cust_details_id',
  `value` varchar(128) NOT NULL COMMENT 'value',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`id`),
  KEY `warranty_id` (`warranty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_warranty_schedule`
--

CREATE TABLE IF NOT EXISTS `ub_warranty_schedule` (
  `sa_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `warranty_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_warranty table warranty_id',
  `servicing_sub` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_user table user_id',
  `service_on` datetime DEFAULT NULL,
  `from_time` time DEFAULT NULL,
  `to_time` time DEFAULT NULL,
  `note_to_sub` text,
  `internal_note` text,
  `submit_to_sub` enum('1','0') DEFAULT '0',
  `submit_to_owner` enum('1','0') DEFAULT '0',
  `feedback` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table',
  `completion_date` datetime DEFAULT NULL,
  `sa_acceptanace_status` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table',
  `approval_comment` text,
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`sa_id`),
  KEY `warranty_id` (`warranty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ub_warranty_schedule_comments`
--

CREATE TABLE IF NOT EXISTS `ub_warranty_schedule_comments` (
  `comment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sa_id` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_warranty_schedule table sa_id',
  `comments` varchar(4000) DEFAULT NULL,
  `show_owner` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `show_sub` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `notify_owner` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `notify_sub` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 yes and 0 no',
  `status` bigint(20) unsigned NOT NULL COMMENT 'Reference to ub_settings_value table value',
  `created_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `created_on` datetime NOT NULL COMMENT 'Record created date and time',
  `modified_by` bigint(20) unsigned NOT NULL COMMENT ' Reference to ub_user table user_id',
  `modified_on` datetime NOT NULL COMMENT 'Last updated on time',
  PRIMARY KEY (`comment_id`),
  KEY `sa_id` (`sa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ub_allowances`
--
ALTER TABLE `ub_allowances`
  ADD CONSTRAINT `ub_allowances_ibfk_1` FOREIGN KEY (`selection_id`) REFERENCES `ub_selection` (`selection_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_bids`
--
ALTER TABLE `ub_bids`
  ADD CONSTRAINT `ub_bids_ibfk_1` FOREIGN KEY (`bid_package_id`) REFERENCES `ub_bid_package` (`bid_package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_bid_comments`
--
ALTER TABLE `ub_bid_comments`
  ADD CONSTRAINT `ub_bid_comments_ibfk_1` FOREIGN KEY (`bid_id`) REFERENCES `ub_bids` (`bid_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_bid_items`
--
ALTER TABLE `ub_bid_items`
  ADD CONSTRAINT `ub_bid_items_ibfk_1` FOREIGN KEY (`bid_id`) REFERENCES `ub_bids` (`bid_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_bid_package`
--
ALTER TABLE `ub_bid_package`
  ADD CONSTRAINT `ub_bid_package_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `ub_job` (`job_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_bid_package_items`
--
ALTER TABLE `ub_bid_package_items`
  ADD CONSTRAINT `ub_bid_package_items_ibfk_1` FOREIGN KEY (`bid_package_id`) REFERENCES `ub_bid_package` (`bid_package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_bid_package_rfi`
--
ALTER TABLE `ub_bid_package_rfi`
  ADD CONSTRAINT `ub_bid_package_rfi_ibfk_1` FOREIGN KEY (`bid_package_id`) REFERENCES `ub_bid_package` (`bid_package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_change_order`
--
ALTER TABLE `ub_change_order`
  ADD CONSTRAINT `ub_change_order_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `ub_job` (`job_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_choices`
--
ALTER TABLE `ub_choices`
  ADD CONSTRAINT `ub_choices_ibfk_1` FOREIGN KEY (`selection_id`) REFERENCES `ub_selection` (`selection_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_cost_code`
--
ALTER TABLE `ub_cost_code`
  ADD CONSTRAINT `ub_cost_code_ibfk_1` FOREIGN KEY (`cc_category_id`) REFERENCES `ub_cost_code_category` (`cc_category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_co_assigned_users`
--
ALTER TABLE `ub_co_assigned_users`
  ADD CONSTRAINT `ub_co_assigned_users_ibfk_1` FOREIGN KEY (`co_id`) REFERENCES `ub_change_order` (`co_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_custom_field_details`
--
ALTER TABLE `ub_custom_field_details`
  ADD CONSTRAINT `ub_custom_field_details_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `ub_custom_field` (`cust_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_daily_log`
--
ALTER TABLE `ub_daily_log`
  ADD CONSTRAINT `ub_daily_log_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `ub_job` (`job_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_daily_log_comments`
--
ALTER TABLE `ub_daily_log_comments`
  ADD CONSTRAINT `ub_daily_log_comments_ibfk_1` FOREIGN KEY (`log_id`) REFERENCES `ub_daily_log` (`log_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_document`
--
ALTER TABLE `ub_document`
  ADD CONSTRAINT `ub_document_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `ub_job` (`job_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_estimates`
--
ALTER TABLE `ub_estimates`
  ADD CONSTRAINT `ub_estimates_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `ub_job` (`job_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_job_assigned_users`
--
ALTER TABLE `ub_job_assigned_users`
  ADD CONSTRAINT `ub_job_assigned_users_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `ub_job` (`job_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ub_job_assigned_users_ibfk_2` FOREIGN KEY (`assigned_to`) REFERENCES `ub_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_job_details`
--
ALTER TABLE `ub_job_details`
  ADD CONSTRAINT `ub_job_details_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `ub_job` (`job_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_lead_activities`
--
ALTER TABLE `ub_lead_activities`
  ADD CONSTRAINT `ub_lead_activities_ibfk_1` FOREIGN KEY (`lead_id`) REFERENCES `ub_lead` (`lead_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_lead_activity_details`
--
ALTER TABLE `ub_lead_activity_details`
  ADD CONSTRAINT `ub_lead_activity_details_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `ub_lead_activities` (`activity_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_lead_activity_emails`
--
ALTER TABLE `ub_lead_activity_emails`
  ADD CONSTRAINT `ub_lead_activity_emails_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `ub_lead_activities` (`activity_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_lead_client_emails`
--
ALTER TABLE `ub_lead_client_emails`
  ADD CONSTRAINT `ub_lead_client_emails_ibfk_1` FOREIGN KEY (`lead_id`) REFERENCES `ub_lead` (`lead_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_lead_details`
--
ALTER TABLE `ub_lead_details`
  ADD CONSTRAINT `ub_lead_details_ibfk_1` FOREIGN KEY (`lead_id`) REFERENCES `ub_lead` (`lead_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ub_lead_details_ibfk_2` FOREIGN KEY (`cust_id`) REFERENCES `ub_custom_field` (`cust_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ub_lead_details_ibfk_3` FOREIGN KEY (`cust_details_id`) REFERENCES `ub_custom_field_details` (`cust_details_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_po_activity`
--
ALTER TABLE `ub_po_activity`
  ADD CONSTRAINT `ub_po_activity_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `ub_purchase_order` (`po_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_po_comments`
--
ALTER TABLE `ub_po_comments`
  ADD CONSTRAINT `ub_po_comments_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `ub_purchase_order` (`po_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_po_items`
--
ALTER TABLE `ub_po_items`
  ADD CONSTRAINT `ub_po_items_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `ub_purchase_order` (`po_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_po_payments`
--
ALTER TABLE `ub_po_payments`
  ADD CONSTRAINT `ub_po_payments_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `ub_purchase_order` (`po_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_po_payments_transactions`
--
ALTER TABLE `ub_po_payments_transactions`
  ADD CONSTRAINT `ub_po_payments_transactions_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `ub_po_payments` (`payment_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ub_po_payments_transactions_ibfk_2` FOREIGN KEY (`po_id`) REFERENCES `ub_purchase_order` (`po_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_purchase_order`
--
ALTER TABLE `ub_purchase_order`
  ADD CONSTRAINT `ub_purchase_order_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `ub_job` (`job_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_schedule`
--
ALTER TABLE `ub_schedule`
  ADD CONSTRAINT `ub_schedule_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `ub_job` (`job_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_schedule_assigned_users`
--
ALTER TABLE `ub_schedule_assigned_users`
  ADD CONSTRAINT `ub_schedule_assigned_users_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `ub_schedule` (`schedule_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_schedule_linkto`
--
ALTER TABLE `ub_schedule_linkto`
  ADD CONSTRAINT `ub_schedule_linkto_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `ub_schedule` (`schedule_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_schedule_predecessor`
--
ALTER TABLE `ub_schedule_predecessor`
  ADD CONSTRAINT `ub_schedule_predecessor_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `ub_schedule` (`schedule_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_selection`
--
ALTER TABLE `ub_selection`
  ADD CONSTRAINT `ub_selection_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `ub_job` (`job_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_settings_value`
--
ALTER TABLE `ub_settings_value`
  ADD CONSTRAINT `ub_settings_value_ibfk_1` FOREIGN KEY (`settings_name`) REFERENCES `ub_settings` (`settings_name`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_todo`
--
ALTER TABLE `ub_todo`
  ADD CONSTRAINT `ub_todo_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `ub_job` (`job_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_todo_assigned_users`
--
ALTER TABLE `ub_todo_assigned_users`
  ADD CONSTRAINT `ub_todo_assigned_users_ibfk_1` FOREIGN KEY (`todo_id`) REFERENCES `ub_todo` (`todo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_todo_checklist`
--
ALTER TABLE `ub_todo_checklist`
  ADD CONSTRAINT `ub_todo_checklist_ibfk_1` FOREIGN KEY (`todo_id`) REFERENCES `ub_todo` (`todo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_todo_comments`
--
ALTER TABLE `ub_todo_comments`
  ADD CONSTRAINT `ub_todo_comments_ibfk_1` FOREIGN KEY (`todo_id`) REFERENCES `ub_todo` (`todo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_user`
--
ALTER TABLE `ub_user`
  ADD CONSTRAINT `ub_user_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `ub_group` (`group_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_warranty`
--
ALTER TABLE `ub_warranty`
  ADD CONSTRAINT `ub_warranty_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `ub_job` (`job_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ub_warranty_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `ub_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_warranty_details`
--
ALTER TABLE `ub_warranty_details`
  ADD CONSTRAINT `ub_warranty_details_ibfk_1` FOREIGN KEY (`warranty_id`) REFERENCES `ub_warranty` (`warranty_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_warranty_schedule`
--
ALTER TABLE `ub_warranty_schedule`
  ADD CONSTRAINT `ub_warranty_schedule_ibfk_1` FOREIGN KEY (`warranty_id`) REFERENCES `ub_warranty` (`warranty_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ub_warranty_schedule_comments`
--
ALTER TABLE `ub_warranty_schedule_comments`
  ADD CONSTRAINT `ub_warranty_schedule_comments_ibfk_1` FOREIGN KEY (`sa_id`) REFERENCES `ub_warranty_schedule` (`sa_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
