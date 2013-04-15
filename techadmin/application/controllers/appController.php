<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose:
 *
 * @author: Saurabh Sinha
 * @created on: 02/14/13 8:55 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class appController
{
    static function getTemplateByName($templateName)
    {
        return appModel::getTemplateByName($templateName);
    }

    static function getAppSettingBySettingName($settingName)
    {
        $appSettingArray = appModel::getAppSettingBySettingName($settingName);
        return $appSettingArray[0]['app_setting_value'];
    }
}
