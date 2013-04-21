<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the System Level Configuration whcih defines all the path level configuration for the system.
 *
 * @author: Saurabh Sinha
 * @created on: 12/30/12 12:06 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/

/* *************************** Start: All the System Path for the Application ******************************* */

$__serverValue = $_SERVER['HTTP_HOST'];
$__directory = substr(dirname($_SERVER['PHP_SELF']), 1);
$__site_path = $_SERVER['DOCUMENT_ROOT'] . "/" . $__directory;

/******************************* Start: Base System Path ****************************** */

/*
* This is done to maintain the relativity with the subfolders in the Local mode and the Live Mode. If the system is
* present in any subfolder the path should be taken automatically.
*/
if ($__directory != '') {
    define("__SITE_URL", "http://" . $__serverValue . "/" . $__directory . "/");
} else {
    define("__SITE_URL", "http://" . $__serverValue . "/");
}


define("__SITE_PATH", $__site_path);

/******************************* End: Base System Path ****************************** */

/******************************* Start: Library Path ****************************** */

define("__LIBRARY_PATH", $__site_path . "/library/");

define("__CORE_PATH", __LIBRARY_PATH . "core/");

define("__HELPER_PATH", __LIBRARY_PATH . "helpers/");

/******************************* End: Library Path ****************************** */

/******************************* Start: Application Path ****************************** */

define("__APPLICATION_PATH", __SITE_PATH . "/application");

define("__CONTROLLER_PATH", __APPLICATION_PATH . "/controllers/");

define('__APPLICATION_URL', __SITE_URL . 'application');

define("__MODEL_PATH", __APPLICATION_PATH . "/models/");

define("__VIEW_PATH", __APPLICATION_PATH . "/views/");

define('__VIEW_URL', __APPLICATION_URL . "/views/");

define('__EXTERNAL_PATH', __SITE_PATH . "/externals");

define('__EXTERNAL_URL', __SITE_URL . "externals/");

define('__EXTRA_PATH', __SITE_PATH . "/extras");

define('__CACHE_PATH', __EXTRA_PATH . "/cache");

define('__UPLOAD_PATH', __VIEW_PATH . "uploads/");

define('__UPLOAD_URL', __VIEW_URL . "uploads/");

define('__ADMIN_URL', __SITE_URL . "techadmin/");

define('__ADMIN_PATH', __SITE_PATH . "/techadmin/");

define('__ADMIN_UPLOAD_URL', __ADMIN_URL . "application/views/uploads/");

define('__ADMIN_UPLOAD_PATH', __ADMIN_PATH . "/application/views/uploads");

/******************************* End: Application Path ******************************** */

/* *************************** End: All the System Path for the Application ******************************* */