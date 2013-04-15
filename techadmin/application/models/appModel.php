<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose:
 *
 * @author: Saurabh Sinha
 * @created on: 02/14/13 9:23 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class appModel
{
    static $db;

    static function setDB($db)
    {
        self::$db = $db;
    }


    static function getTemplateByName($templateName)
    {
        $query = "SELECT * FROM email_template_details WHERE email_template_name = '$templateName' and email_template_status = 'active'";

        return self::$db->fetch_rows($query);
    }

    static function getAppSettingBySettingName($settingName)
    {
        $query = "SELECT * FROM app_setting_details WHERE app_setting_name = '$settingName'";
        return self::$db->fetch_rows($query);
    }
}
