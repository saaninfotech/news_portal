<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: HiiFan News
 * @purpose: This is the Pages controller for the Framework
 *
 * @author: Rishabh Dev Bansal
 * @created on: 02/15/13 3:21 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class pagesController extends SaanController
{

    public function index()
    {
        return true;
    }

    public function view_banner_photo($args)
    {
        $this->registry->template->Title = "SAAN Infotech :: Home Page";
        if(is_array($args) && count($args) > 0)
        {
            $bannerPhotoId = $this->registry->security->decryptData($args['banner_photo_id']);
            if($bannerPhotoId != '')
            {
                $bannerPhotoArray = $this->registry->model->run('getBannerPhotoByBannerPhotoId', $bannerPhotoId);
            }
            $this->registry->template->BannerPhotoArray = $bannerPhotoArray;
        }
        $this->registry->template->show("view_banner_photo");
    }

    public function readnews($args)
    {
        $this->registry->template->Title = "SAAN Infotech :: Home Page";
        if(is_array($args) && count($args) > 0)
        {
            $newsId = $this->registry->security->decryptData($args['news_id']);
            if($newsId != '')
            {
                $newsArray = $this->registry->model->run('getNewsByNewsId', $newsId);
            }
            $this->registry->template->NewsArray = $newsArray;
        }
        $this->registry->template->show("readnews");
    }

    public function viewphoto($args)
    {
        $this->registry->template->Title = "SAAN Infotech :: Home Page";
        if(is_array($args) && count($args) > 0)
        {
            $photoId = $this->registry->security->decryptData($args['photo_id']);
            if($photoId != '')
            {
                $photoArray = $this->registry->model->run('getPhotoByPhotoId', $photoId);
            }
            $this->registry->template->PhotoArray = $photoArray;
        }
        $this->registry->template->show("view_photo");
    }

    public function view_news($args)
    {
        $this->registry->template->Title = "SAAN Infotech :: Home Page";
        if(is_array($args) && count($args) > 0)
        {
            $newsCategoryName = $args['news_cat'];
            if($newsCategoryName != '')
            {
                $newsCatArray = $this->registry->model->run('getNewsListByCatName', $newsCategoryName);
            }
            $this->registry->template->CatNewsArray = $newsCatArray;
        }
        $this->registry->template->show("view_news");
    }

    public function viewvideo($args)
    {
        $this->registry->template->Title = "SAAN Infotech :: Home Page";
        if(is_array($args) && count($args) > 0)
        {
            $videoId = $this->registry->security->decryptData($args['video_id']);
            if($videoId != '')
            {
                $videoArray = $this->registry->model->run('getVideoByVideoId', $videoId);
            }
            $this->registry->template->VideoArray = $videoArray;
        }
        $this->registry->template->show("view_video");
    }
}
