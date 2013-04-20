<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the bootstrap.php file. This file consists the initial level configuration for the application
 *
 * @author: Saurabh Sinha
 * @created on: 12/30/12 11:34 AM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/

//This initializes the session
@session_start();

//This is for the Error Reporting Handling
error_reporting(0);

//This is the setting for the Local Mode
define("LOCAL_MODE", TRUE);

//This is to set the Execution time for the server
@ini_set("session.gc_maxlifetime", "1440");

//This includes the System configuration file for the bootstraping of the application.
require_once("config/sys_config.php");

/* ********************* Start: Fix for the Register Global configuration for PHP ***************************** */

if (ini_get('register_globals')) {
    @ini_set('session.use_cookies', '1');
    @ini_set('session.use_trans_sid', '0');

    @session_set_cookie_params(0, '/');


    $globals = array($_REQUEST, $_SESSION, $_SERVER, $_FILES);

    foreach ($globals as $global) {
        foreach (array_keys($global) as $key) {
            unset($$key);
        }
    }

    ini_set('register_globals', 'Off');
}

/* ********************* End: Fix for the Register Global configuration for PHP ***************************** */

/* ******************** Start: This is the Fix for the Magic quote Configuration for the PHP ***************** */

if (ini_get('magic_quotes_gpc')) {
    /**
     * @purpose: This function cleans the value for slashes from the POST, GET and COOKIE values.
     * @author: Saurabh Sinha
     *
     * @param $data This is the data values to be cleaned. This can be an arrya or a normal value.
     *
     * @return array|string This is either an array or any string after cleaning the value.
     */
    function clean($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = clean($value);
            }
        } else {
            $data = stripslashes($data);
        }

        return $data;
    }

    $_GET = clean($_GET);
    $_POST = clean($_POST);
    $_COOKIE = clean($_COOKIE);

    ini_set('magic_quotes_gpc', 'Off');
}

/* ******************** End: This is the Fix for the Magic quote Configuration for the PHP ***************** */

//This includes the Application Configuration File for bootstraping the application.
require_once("config/app_config.php");

/** *****************Start: Settings for Paypal Payment Gateway ************************** */
/*
if (PAYPAL_USE_SANDBOX === TRUE) {
    define('PAYPAL_API_ENDPOINT', 'https://api-3t.sandbox.paypal.com/nvp');
    define('PAYPAL_URL', "https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=");
} else {
    define('PAYPAL_API_ENDPOINT', "https://api-3t.paypal.com/nvp");
    define('PAYPAL_URL', "https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=");
}*/

//This includes the Paypal Payment Gateway.
require_once __HELPER_PATH . 'class.PaypalPayment.php';

/** *****************Start: Settings for Paypal Payment Gateway ************************** */

//This includes the Paging Helper Class for the application.
require_once __HELPER_PATH . 'class.Paging.php';

//This includes the Captcha Helper Class for the application.
require __HELPER_PATH . 'class.Captcha.php';

//This includes the Breadcrumbs Helper Class for the application.
require __HELPER_PATH . 'class.BreadCrumbs.php';

//This is the Cache Class
require __HELPER_PATH . 'class.CacheHandler.php';

/* ************************* Start: This is to manage the Template for the Application ******************** */

define ('__TEMPLATE_NAME', $__template_name);
define ('__TEMPLATE_PATH', __VIEW_PATH . 'theme/' . __TEMPLATE_NAME . '/');
define ('__TEMPLATE_URL', __VIEW_URL . 'theme/' . __TEMPLATE_NAME . '/');

/* ************************* End: This is to manage the Template for the Application ******************** */

/* ************************ Start: Include the Mailer Component *************************** */

require_once __EXTERNAL_PATH . "/Swift/lib/swift_required.php";
$transport = Swift_SmtpTransport::newInstance($__smtpServer, $__portNo, $__useSSL)
    ->setUsername($__smtpUser)
    ->setPassword($__smtpPassword);

/* ************************ End: Include the Mailer Component *************************** */

/* ************************ Start: This section includes the Core Library ***************************** */

require __CORE_PATH . 'class.SaanController.php';
require __CORE_PATH . 'class.Registry.php';
require __CORE_PATH . 'class.Router.php';
require __CORE_PATH . 'class.Template.php';
require __CORE_PATH . 'class.SaanModel.php';
require __CORE_PATH . 'class.Database.php';
require __CORE_PATH . 'class.Validation.php';
require __CORE_PATH . 'class.General.php';
require __CORE_PATH . 'class.Security.php';
require __CORE_PATH . 'class.ImageResize.php';


//This is done to provide the common controller and model apart from the SAAN Controller and SAAN Model.
require_once __MODEL_PATH . "appModel.php";
require_once __CONTROLLER_PATH . "appController.php";

/* ************************ End: This section includes the Core Library ***************************** */