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

    static function getBannerPhoto()
    {
        $bannerPhotoArray = CacheHandler::retrieve_cache('banner_photo_array',75);
        if($bannerPhotoArray == "")
        {
            $bannerPhotoArray = appModel::getBannerPhoto();
            CacheHandler::cache_content('banner_photo_array', $bannerPhotoArray, 10000);
        }
        return $bannerPhotoArray;
    }

    static function getAllCategory()
    {
        $newsCategoryArray = CacheHandler::retrieve_cache('news_category_array',75);
        if($newsCategoryArray == "")
        {
            $newsCategoryArray = appModel::getAllCategory();
            CacheHandler::cache_content('news_category_array', $newsCategoryArray, 10000);
        }
        return $newsCategoryArray;
    }
}
