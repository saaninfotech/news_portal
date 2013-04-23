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

    static function cacheBannerPhoto()
    {
        $bannerPhotoArray = appModel::getBannerPhoto();
        CacheHandler::cache_content('banner_photo_array', $bannerPhotoArray, 10000);
    }

    static function cacheNewsCategoryCache()
    {
        $newsCategoryArray = appModel::getAllCategory();
        CacheHandler::cache_content('news_category_array', $newsCategoryArray, 10000);

    }

    static function cacheTopStories()
    {
        $topStoryArray = appModel::getTopStories();
        CacheHandler::cache_content('top_stories_array', $topStoryArray, 10000);
    }

    static function cacheNews()
    {
        $newsArray = appModel::getAllNews();
        $finalNewsArray = array();
        foreach($newsArray as $newsKey=>$newsValue)
        {
            $finalNewsArray[strtolower($newsValue['news_category_name'])][] = $newsValue['news_id'] . '--^--' . ucwords($newsValue['news_subject']) . '--^--' . ucfirst($newsValue['news_description']);
        }
        CacheHandler::cache_content('news_array', $finalNewsArray, 10000);
    }

    static function cachePhotos()
    {
        $allPhotoArray = appModel::getAllPhotos();
        CacheHandler::cache_content('photo_array', $allPhotoArray, 10000);
    }

    static function cacheVideos()
    {
        $allVideoArray = appModel::getAllVideos();
        CacheHandler::cache_content('video_array', $allVideoArray, 10000);
    }

    static function cacheNewsCount()
    {
        $catNewsCountArray = appModel::getAllNewsCountByCat();
        CacheHandler::cache_content('cat_news_array_count', $catNewsCountArray, 10000);
    }
}
