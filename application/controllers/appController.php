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

    static function getTopStories()
    {
        $topStoryArray = CacheHandler::retrieve_cache('top_stories_array',75);
        if($topStoryArray == "")
        {
            $topStoryArray = appModel::getTopStories();
            CacheHandler::cache_content('top_stories_array', $topStoryArray, 10000);
        }
        return $topStoryArray;
    }

    static function getAllNews()
    {
        $newsArray = CacheHandler::retrieve_cache('news_array',75);
        if($newsArray == "")
        {
            $newsArray = appModel::getAllNews();
            $finalNewsArray = array();
            foreach($newsArray as $newsKey=>$newsValue)
            {
                $finalNewsArray[strtolower($newsValue['news_category_name'])][] = $newsValue['news_key'] . '--^--' . ucwords($newsValue['news_subject']) . '--^--' . ucfirst($newsValue['news_description']);
            }
            CacheHandler::cache_content('news_array', $finalNewsArray, 10000);
        }
        $finalNewsArray = $newsArray;
        return $finalNewsArray;
    }
}
