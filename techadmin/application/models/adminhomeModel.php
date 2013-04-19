<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the Index Model for the Admin Section of the SAAN Index Controller
 *
 * @author: Rishabh Dev Bansal
 * @created on: 02/15/13 12:25 AM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class adminhomeModel extends SaanModel
{
    /**
     * @purpose: This function returns the paginated array of all the Email Templates
     * @author: Saurabh Sinha
     * @param $args
     * @return mixed
     */
    public function getAllTemplateList($args)
    {
        $start = 0;
        if (is_array($args) && isset($args['start_page'])) {
            $start = $args['start_page'];
            $start = $start * RECORDS_PER_PAGE;
        }
        $query = "SELECT * FROM email_template_details ORDER BY email_template_id DESC ";

        return $this->db->paginateQuery($query, $start);
    }

    /**
     * @param $templateId
     * @return mixed
     */
    public function getTemplateByTemplateId($templateId)
    {
        if ($templateId != '') {
            $query = "SELECT * FROM email_template_details WHERE email_template_id = '$templateId'";
            return $this->db->fetch_rows($query);
        }
    }

    /**
     * @param $emailArray
     * @return mixed
     */
    public function updateEmailTemplateById($emailArray)
    {
        if (is_array($emailArray)) {
            $templateSubject = $emailArray['template_subject'];
            $templateDescription = $emailArray['template_description'];
            $templateContent = $emailArray['template_content'];
            $templateStatus = $emailArray['template_status'];
            $query = "UPDATE email_template_details SET
                    email_template_subject = '$templateSubject',
                    email_template_description = '$templateDescription',
                    email_template_content = '$templateContent',
                    email_template_status = '$templateStatus'
                    WHERE email_template_id = '" . $emailArray['email_template_id'] . "'";
            return $this->db->query($query);
        }
    }

    /**
     * @purpose: This function returns the paginated array of all the Email Templates
     * @author: Saurabh Sinha
     * @param $args
     * @return mixed
     */
    public function getAllCategoryList($args)
    {
        $start = 0;
        if (is_array($args) && isset($args['start_page'])) {
            $start = $args['start_page'];
            $start = $start * RECORDS_PER_PAGE;
        }
        $query = "SELECT * FROM news_category_details ORDER BY news_category_id DESC ";

        return $this->db->paginateQuery($query, $start);
    }

    public function getCategoryList()
    {
        $query = "SELECT * FROM news_category_details ORDER BY news_category_id ASC ";

        return $this->db->fetch_rows($query);
    }

    /**
     * @param $categoryArray
     * @return mixed
     */
    public function updateNewsCategoryById($categoryArray)
    {
        if (is_array($categoryArray)) {
            $categoryName = $categoryArray['news_category_name'];
            $categoryDescription = $categoryArray['news_category_description'];
            $categoryStatus = $categoryArray['news_category_status'];
            $query = "UPDATE news_category_details SET
                news_category_name = '$categoryName',
                news_category_description = '$categoryDescription',
                news_category_status = '$categoryStatus'
                WHERE news_category_id = '" . $categoryArray['news_category_id'] . "'";
            return $this->db->query($query);
        }
    }

    /**
     * @param $categoryId
     * @return mixed
     */
    public function getCategoryByCategoryId($categoryId)
    {
        if ($categoryId != '') {
            $query = "SELECT * FROM news_category_details WHERE news_category_id = '$categoryId'";
            return $this->db->fetch_rows($query);
        }
    }

    /**
     * @param $postArray
     * @return mixed
     */
    public function addCategory($postArray)
    {
        return $this->db->query_insert('news_category_details', $postArray);
    }

    /**
     * @param $categoryId
     * @return mixed
     */
    public function deleteCategory($categoryId)
    {
        $query = "DELETE FROM news_category_details WHERE news_category_id = '$categoryId'";
        return $this->db->query($query);
    }

    /**
     * @param $categoryId
     * @return mixed
     */
    public function activateCategory($categoryId)
    {
        $query = "UPDATE news_category_details SET news_category_status = 'active' WHERE news_category_id = '$categoryId'";
        return $this->db->query($query);
    }

    /**
     * @param $categoryId
     * @return mixed
     */
    public function deactivateCategory($categoryId)
    {
        $query = "UPDATE news_category_details SET news_category_status = 'inactive' WHERE news_category_id = '$categoryId'";
        return $this->db->query($query);
    }

    public function addNews($postArray)
    {
        return $this->db->query_insert('news_details', $postArray);
    }

    public function getAllNews($args)
    {
        $start = 0;
        if (is_array($args) && isset($args['start_page'])) {
            $start = $args['start_page'];
            $start = $start * RECORDS_PER_PAGE;
        }
        $query = "SELECT N.*, CN.news_category_name
                        FROM news_details N
                            INNER JOIN news_category_details CN
                                ON N.news_category_id = CN.news_category_id
                        ORDER BY news_id DESC ";

        return $this->db->paginateQuery($query, $start);
    }

    /**
     * @param $newsId
     * @return mixed
     */
    public function deleteNews($newsId)
    {
        $query = "DELETE FROM news_details WHERE news_id = '$newsId'";
        return $this->db->query($query);
    }

    /**
     * @param $newsId
     * @return mixed
     */
    public function activateNews($newsId)
    {
        $query = "UPDATE news_details SET
                        news_status = 'active' WHERE news_id = '$newsId'";
        return $this->db->query($query);
    }

    /**
     * @param $newsId
     * @return mixed
     */
    public function deactivateNews($newsId)
    {
        $query = "UPDATE news_details SET
                        news_status = 'inactive' WHERE news_id = '$newsId'";
        return $this->db->query($query);
    }

    public function getNewsByNewsId($newsId)
    {
        $query = "SELECT * FROM news_details WHERE news_id = '$newsId'";
        return $this->db->fetch_rows($query);
    }

    public function updateNewsById($newsArray)
    {
        if(is_array($newsArray) && count($newsArray) > 0)
        {
            $newsId = $newsArray['news_id'];
            $newsCategoryId = $newsArray['news_category_id'];
            $newsContentType = $newsArray['news_content_type'];
            $newsSubject = $newsArray['news_subject'];
            $newsDescription = $newsArray['news_description'];
            $newsMetaTitle = $newsArray['news_meta_title'];
            $newsMetaDescription = $newsArray['news_meta_description'];
            $newsMetaKeyword = $newsArray['news_meta_keyword'];
            $isSocialAllowed = $newsArray['is_social_allowed'];

            $query = "UPDATE news_details SET
                            news_category_id = '$newsCategoryId',
                            news_content_type = '$newsContentType',
                            news_subject = '$newsSubject',
                            news_description = '$newsDescription',
                            news_meta_title = '$newsMetaTitle',
                            news_meta_description = '$newsMetaDescription',
                            news_meta_keyword = '$newsMetaKeyword',
                            is_social_allowed = '$isSocialAllowed'
                      WHERE news_id = '$newsId'";
            return $this->db->query($query);
        }
        else{
            return false;
        }
    }

    public function getAllPhotoList($args)
    {
        $start = 0;
        if (is_array($args) && isset($args['start_page'])) {
            $start = $args['start_page'];
            $start = $start * RECORDS_PER_PAGE;
        }
        $query = "SELECT * FROM photo_details ORDER BY photo_id DESC ";

        return $this->db->paginateQuery($query, $start);
    }

    public function addPhotos($dataArray)
    {
        return $this->db->query_insert('photo_details', $dataArray);
    }

    public function deletePhoto($photoId)
    {
        $query = "DELETE FROM photo_details WHERE photo_id = '$photoId'";
        return $this->db->query($query);
    }


    public function activatePhoto($photoId)
    {
        $query = "UPDATE photo_details SET
                        photo_status = 'active' WHERE photo_id = '$photoId'";
        return $this->db->query($query);
    }

    public function deactivatePhoto($photoId)
    {
        $query = "UPDATE photo_details SET
                        photo_status = 'inactive' WHERE photo_id = '$photoId'";
        return $this->db->query($query);
    }

    public function getPhotoByPhotoId($photoId)
    {
        if(isset($photoId))
        {
            $query = "SELECT * FROM photo_details WHERE photo_id = '$photoId'";
            return $this->db->fetch_rows($query);
        }
    }

    public function updatePhotoByPhotoId($args)
    {
        if(is_array($args) && count($args) > 0)
        {
            $taglineValue = $args['photo_tagline'];
            $photoId = $args['photo_id'];
            $query = "UPDATE photo_details SET photo_tagline = '$taglineValue' WHERE photo_id = '$photoId'";
            return $this->db->query($query);
        }
    }

    /** ****************** Start: Video Queries ***************************** */

    public function getAllVideoList($args)
    {
        $start = 0;
        if (is_array($args) && isset($args['start_page'])) {
            $start = $args['start_page'];
            $start = $start * RECORDS_PER_PAGE;
        }
        $query = "SELECT * FROM video_details ORDER BY video_id DESC ";

        return $this->db->paginateQuery($query, $start);
    }

    public function addVideos($dataArray)
    {
        return $this->db->query_insert('video_details', $dataArray);
    }

    public function deleteVideo($videoId)
    {
        $query = "DELETE FROM video_details WHERE video_id = '$videoId'";
        return $this->db->query($query);
    }


    public function activateVideo($videoId)
    {
        $query = "UPDATE video_details SET
                        video_status = 'active' WHERE video_id = '$videoId'";
        return $this->db->query($query);
    }

    public function deactivateVideo($videoId)
    {
        $query = "UPDATE video_details SET
                        video_status = 'inactive' WHERE video_id = '$videoId'";
        return $this->db->query($query);
    }

    public function getVideoByVideoId($videoId)
    {
        if(isset($videoId))
        {
            $query = "SELECT * FROM video_details WHERE video_id = '$videoId'";
            return $this->db->fetch_rows($query);
        }
    }

    public function updateVideoByVideoId($args)
    {
        if(is_array($args) && count($args) > 0)
        {
            $taglineValue = $args['video_tagline'];
            $videoId = $args['video_id'];
            $query = "UPDATE video_details SET video_tagline = '$taglineValue' WHERE video_id = '$videoId'";
            return $this->db->query($query);
        }
    }

    /** *********************** End: Video Queries ********************** */



    /** ****************** Start: Banner Photos Queries ***************************** */

    public function getAllBannerPhotoList($args)
    {
        $start = 0;
        if (is_array($args) && isset($args['start_page'])) {
            $start = $args['start_page'];
            $start = $start * RECORDS_PER_PAGE;
        }
        $query = "SELECT * FROM banner_photo_details ORDER BY banner_photo_id DESC ";

        return $this->db->paginateQuery($query, $start);
    }

    public function addBannerPhotos($dataArray)
    {
        return $this->db->query_insert('banner_photo_details', $dataArray);
    }

    public function deleteBannerPhoto($bannerPhotoId)
    {
        $query = "DELETE FROM banner_photo_details WHERE banner_photo_id = '$bannerPhotoId'";
        return $this->db->query($query);
    }


    public function activateBannerPhoto($bannerPhotoId)
    {
        $query = "UPDATE banner_Photo_details SET
                        banner_photo_status = 'active' WHERE banner_photo_id = '$bannerPhotoId'";
        return $this->db->query($query);
    }

    public function deactivateBannerPhoto($bannerPhotoId)
    {
        $query = "UPDATE banner_photo_details SET
                        banner_photo_status = 'inactive' WHERE banner_photo_id = '$bannerPhotoId'";
        return $this->db->query($query);
    }

    public function getBannerPhotoByBannerPhotoId($bannerPhotoId)
    {
        if(isset($bannerPhotoId))
        {
            $query = "SELECT * FROM banner_photo_details WHERE banner_photo_id = '$bannerPhotoId'";
            return $this->db->fetch_rows($query);
        }
    }

    public function updateBannerPhotoByBannerPhotoId($args)
    {
        if(is_array($args) && count($args) > 0)
        {
            $taglineValue = $args['banner_photo_tagline'];
            $descriptionValue = $args['banner_photo_description'];
            $bannerPhotoId = $args['bannerPhoto_id'];
            $query = "UPDATE banner_photo_details SET banner_photo_tagline = '$taglineValue', banner_photo_description = '$descriptionValue' WHERE banner_photo_id = '$bannerPhotoId'";
            return $this->db->query($query);
        }
    }

    /** *********************** End: Banner Photos Queries ********************** */
}

