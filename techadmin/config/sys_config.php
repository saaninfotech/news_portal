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
$sitePathArray = explode("/", $__site_path);


$siteArrayCount = count($sitePathArray);
$__front_path_array = array();
foreach($sitePathArray as $siteKey=>$siteValue)
{
    if($siteKey < ($siteArrayCount-1))
    {
        $__front_path_array[] = $siteValue;
    }
}
$__front_path = implode("/", $__front_path_array) . "/";

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

$siteURLArray = explode("/", __SITE_URL);
$siteURLCount = count($siteURLArray);
$__front_url_array = array();
foreach($siteURLArray as $urlKey=>$urlValue)
{
    if($urlKey < ($siteURLCount - 2))
    {
        $__front_url_array[] = $urlValue;
    }
}

$__front_url = implode("/", $__front_url_array) . "/";

define("__SITE_PATH", $__site_path);
define("__FRONT_PATH", $__front_path);
define("__FRONT_URL", $__front_url);
/******************************* End: Base System Path ****************************** */

/******************************* Start: Library Path ****************************** */

define("__LIBRARY_PATH", __FRONT_PATH . "library/");

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

define('__EXTERNAL_PATH', __FRONT_PATH . "externals/");

define('__EXTERNAL_URL', __FRONT_URL . "externals/");

define('__EXTRA_PATH', __FRONT_PATH . "extras/");

define('__CACHE_PATH', __EXTRA_PATH . "cache");

define('__FRONT_UPLOAD_PATH', __FRONT_PATH . "application/views/uploads/");

define('__FRONT_UPLOAD_URL', __FRONT_URL . "application/views/uploads/");

define('__ADMIN_UPLOAD_PATH', __SITE_PATH . "/application/views/uploads/");

define('__ADMIN_UPLOAD_URL', __SITE_URL . "application/views/uploads/");

/******************************* End: Application Path ******************************** */

/* *************************** End: All the System Path for the Application ******************************* */