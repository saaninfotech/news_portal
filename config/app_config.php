<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the Application Config file to manage the simple application level configuration
 *           including the database credentials
 *
 * @author: Saurabh Sinha
 * @created on: 12/30/12 12:13 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/

//This is the configuration for the Template used for the System
$__template_name = "saan_template";

/* ****************** Start: This is the Configuration for Database Credentials for the Application */

if (LOCAL_MODE === TRUE) {
    $__host = "localhost";
    $__user = "root";
    $__password = "";
    $__database = "hiifan_news_db";
} else {
    $__host = "saaninfotechcom.ipagemysql.com";
    $__user = "hiifan_user123";
    $__password = "hiifan_pass@123";
    $__database = "hiifan_news_db";
}

/* ****************** End: This is the Configuration for Database Credentials for the Application */

/* *********************** Start: the credentials for the Mailer Component ********************* */


$__smtpServer = "smtp.gmail.com";
$__portNo = "465";
$__useSSL = "ssl";
$__smtpUser = "hiifannews@gmail.com";
$__smtpPassword = "HiiFan@123";

define('FROM_EMAIL', "hiifannews@gmail.com");
define('FROM_NAME', "HiiFan News");

define('FAILED_EMAIL', "hiifannews@gmail.com");
define('FAILED_NAME', "HiiFan News");

/* *********************** Start: the credentials for the Mailer Component ********************* */
define('RECORDS_PER_PAGE', 10);

/** **************************** Start: This is the CAche Configuration **************** */
define('PRIORITY_REQUIRED', 50);
define('CACHING_PATH', __CACHE_PATH . "/");