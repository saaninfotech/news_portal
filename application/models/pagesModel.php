<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Project P3
 * @purpose: This is the Model Class for the Pages Controller
 *
 * @author: Rishabh Dev Bansal
 * @created on: 02/15/13 3:17 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */


class pagesModel extends SaanModel
{
    public function getBannerPhotoByBannerPhotoId($bannerPhotoId)
    {
        if($bannerPhotoId != '')
        {
            $query = "SELECT * FROM banner_photo_details WHERE banner_photo_id = '$bannerPhotoId'";
            return $this->db->fetch_rows($query);
        }

    }

    public function getNewsByNewsId($newsId)
    {
        if($newsId != '')
        {
            $query = "SELECT * FROM news_details WHERE news_id = '$newsId'";
            return $this->db->fetch_rows($query);
        }

    }

    public function getPhotoByPhotoId($photoId)
    {
        if($photoId != '')
        {
            $query = "SELECT * FROM photo_details WHERE photo_id = '$photoId'";
            return $this->db->fetch_rows($query);
        }

    }

    public function getNewsListByCatName($catName)
    {
        if($catName != '')
        {
            $query = "SELECT
                            N.*,
                            NC.news_category_name
                        FROM news_details N
                            INNER JOIN news_category_details NC
                                ON N.news_category_id = NC.news_category_id
                            WHERE NC.news_category_name = '$catName'";
            return $this->db->fetch_rows($query);
        }
    }
}
