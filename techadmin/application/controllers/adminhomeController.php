<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the Index controller for the Admin Seciton
 *
 * @author: Rishabh Dev Bansal
 * @created on: 02/16/13 3:21 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class adminhomeController extends SaanController
{
    /**
     * @purpose: This is for the displaying the admin home page
     * @author: Rishabh Dev Bansal
     */
    public function index()
    {
        $this->registry->template->Title = "HiiFan News :: Admin Home Page - Welcome Administrator";
        $this->registry->template->show("adminhome");
    }

    /* ******************** Start: Functions for Templates ********************************* */

    /**
     * @param $args
     */
    public function view_templates($args)
    {
        $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  View Email Templates";
        $templateListArray = $this->registry->model->run("getAllTemplateList", $args);
        $this->registry->template->PresentPage = $args['start_page'];
        $this->registry->template->TemplateListArray = $templateListArray;
        $this->registry->template->show("view_templates");
    }

    /**
     * @param $args
     */
    public function editTemplate($args)
    {
        if (is_array($args) && $args['template_id'] != '') {
            $templateId = $this->registry->security->decryptData($args['template_id']);
            $this->registry->template->Title = "HiiFan News Portal: EditEmail Templates";
            $templateArray = $this->registry->model->run("getTemplateByTemplateId", $templateId);
            if ($this->isPostBack()) {
                $postArray = $this->requestPost();
                foreach ($postArray as $postKey => $postValue) {
                    if ($this->registry->validation->isEmpty($postValue)) {
                        $controlName = ucwords(str_replace("_", " ", $postKey));
                        $_SESSION['error'][] = "$controlName cannot be left blank";
                    }
                }
                if (count($_SESSION['error']) == 0) {
                    $postArray['email_template_id'] = $templateId;
                    $this->registry->model->run('updateEmailTemplateById', $postArray);
                    $_SESSION['success'] = "Email Template updated successfully";
                    General::redirect($_SERVER['HTTP_REFERER']);
                    exit;
                }
            }

            foreach ($templateArray as $templateKey => $templateValue) {
                $this->registry->template->TemplateArray = $templateValue;
            }
            $this->registry->template->show("edit_template");
        }
    }

    /* ******************** End: Functions for Templates ********************************* */

    /* ******************* Start: Functions for the News Category ************************** */

    /**
     * @param $args
     */
    public function view_news_category($args)
    {
        $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  View News Category";
        $categoryListArray = $this->registry->model->run("getAllCategoryList", $args);
        $this->registry->template->PresentPage = $args['start_page'];
        $this->registry->template->CategoryListArray = $categoryListArray;
        $this->registry->template->show("view_news_category");
    }

    /**
     * @param $args
     */
    public function editCategory($args)
    {
        if (is_array($args) && $args['news_category_id'] != '') {
            $categoryId = $this->registry->security->decryptData($args['news_category_id']);
            $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  Edit News Category";
            $categoryArray = $this->registry->model->run("getCategoryByCategoryId", $categoryId);
            if ($this->isPostBack()) {
                $postArray = $this->requestPost();
                foreach ($postArray as $postKey => $postValue) {
                    if ($this->registry->validation->isEmpty($postValue)) {
                        $controlName = ucwords(str_replace("_", " ", $postKey));
                        $_SESSION['error'][] = "$controlName cannot be left blank";
                    }
                }
                if (count($_SESSION['error']) == 0) {
                    $postArray['news_category_id'] = $categoryId;
                    $this->registry->model->run('updateNewsCategoryById', $postArray);
                    $_SESSION['success'] = "News Category Updated successfully";
                    appController::cacheNewsCategoryCache();
                    appController::cacheNewsCount();
                    General::redirect($_SERVER['HTTP_REFERER']);
                    exit;
                }
            }

            foreach ($categoryArray as $categoryKey => $categoryValue) {
                $this->registry->template->CategoryArray = $categoryValue;
            }
            $this->registry->template->show("edit_news_category");
        }
    }

    public function deleteCategory($args)
    {
        $categoryId = $this->registry->security->decryptData($args['news_category_id']);
        $this->registry->model->run('deleteCategory', $categoryId);
        $_SESSION['success'] = "News Category Deleted Successfully";
        appController::cacheNewsCategoryCache();
        appController::cacheNewsCount();
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function activateCategory($args)
    {
        $categoryId = $this->registry->security->decryptData($args['news_category_id']);
        $this->registry->model->run('activateCategory', $categoryId);
        $_SESSION['success'] = "News Category Successfully";
        appController::cacheNewsCategoryCache();
        appController::cacheNewsCount();
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function deactivateCategory($args)
    {
        $categoryId = $this->registry->security->decryptData($args['news_category_id']);
        $this->registry->model->run('deactivateCategory', $categoryId);
        $_SESSION['success'] = "News Category Deactivated Successfully";
        appController::cacheNewsCategoryCache();
        appController::cacheNewsCount();
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    /**
     *
     */
    public function add_news_category()
    {
        $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  Edit News Category";
        $this->registry->template->show("add_news_category");

    }

    /**
     *
     */
    public function addCategory()
    {
        $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  Edit News Category";
        if ($this->isPostBack()) {

            $postArray = $this->requestPost();

            /* *********************** Start: Validation of the Data from Post *********************** */

            if ($this->registry->validation->isEmpty($postArray['news_category_name'])) {
                $_SESSION['error'][] = "Please Enter Category Name.";

            }

            if ($this->registry->validation->isEmpty($postArray['news_category_description'])) {
                $_SESSION['error'][] = "Please Enter Category Description.";

            }


            if (count($_SESSION['error']) == 0) {
                /* *********************** Start: Formation of the POST Array for Submission *********************** */
                $postData = array('news_category_name' => ucwords($postArray['news_category_name']),
                    'news_category_description' => ucwords($postArray['news_category_description']),
                    'news_category_status' => "active"
                );

                /* *********************** End: Formation of the POST Array for Submission *********************** */
                $this->registry->model->run(addCategory, $postData);
                $_SESSION['success'] = "Category Added Successfully";
                appController::cacheNewsCategoryCache();
                appController::cacheNewsCount();
                General::redirect($_SERVER['HTTP_REFERER']);
                exit;

            } else {

                $this->registry->template->PostRetain = $postArray;
            }
        }
        $this->registry->template->show("add_news_category");

    }

    /* ******************* End: Functions for the News Category ************************** */


    /* ******************* Start: Functions for the News Details ************************** */

    /**
     *
     */
    public function add_news()
    {
        $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  Add News";
        $categoryListArray = $this->registry->model->run("getCategoryList");
        $this->registry->template->CategoryListArray = $categoryListArray;

        if ($this->isPostBack()) {

            $postArray = $this->requestPost();

            /* *********************** Start: Validation of the Data from Post *********************** */

            foreach($postArray as $key=>$value)
            {
                if($key != "btnSubmit")
                {
                    if($this->registry->validation->isEmpty($postArray[$key]))
                    {
                        $_SESSION['error'][] = ucwords(str_replace("_", " ", $key)) . " cannot be left blank";
                    }
                }
            }


            if (count($_SESSION['error']) == 0) {
                $dateTimeValue = time();
                /* *********************** Start: Formation of the POST Array for Submission *********************** */
                $postData = array('news_category_id' => ucwords($postArray['news_category']),
                    'news_content_type' => ucwords($postArray['news_content_type']),
                    'news_subject' => ucwords($postArray['news_subject']),
                    'news_description' => ucwords($postArray['news_description']),
                    'news_content_type' => ucwords($postArray['news_content_type']),
                    'news_meta_title' => ucwords($postArray['news_meta_title']),
                    'news_meta_description' => ucwords($postArray['news_meta_description']),
                    'news_meta_keyword' => ucwords($postArray['news_meta_keyword']),
                    'news_date' => ucwords($dateTimeValue),
                    'news_added_by' => ucwords($postArray['news_meta_keyword']),
                    'is_social_allowed' => ucwords($postArray['is_social_allowed']),
                    'news_status' => "active"
                );

                /* *********************** End: Formation of the POST Array for Submission *********************** */
                $this->registry->model->run(addNews, $postData);
                $_SESSION['success'] = "News Added Successfully";
                appController::cacheTopStories();
                appController::cacheNews();
                appController::cacheNewsCount();
                General::redirect($_SERVER['HTTP_REFERER']);
                exit;

            } else {

                $this->registry->template->PostRetain = $postArray;
            }
        }

        $this->registry->template->show("add_news");

    }

    /**
     * @param $args
     */
    public function view_news($args)
    {
        $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  View News";
        $newsArray = $this->registry->model->run("getAllNews", $args);
        $this->registry->template->PresentPage = $args['start_page'];
        $this->registry->template->NewsListArray = $newsArray;
        $this->registry->template->show("view_news");
    }


    public function deleteNews($args)
    {
        $newsId = $this->registry->security->decryptData($args['news_id']);
        $this->registry->model->run('deleteNews', $newsId);
        $_SESSION['success'] = "News Deleted Successfully";
        appController::cacheTopStories();
        appController::cacheNews();
        appController::cacheNewsCount();
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function activateNews($args)
    {
        $newsId = $this->registry->security->decryptData($args['news_id']);
        $this->registry->model->run('activateNews', $newsId);
        $_SESSION['success'] = "News Activated Successfully";
        appController::cacheTopStories();
        appController::cacheNews();
        appController::cacheNewsCount();
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function deactivateNews($args)
    {
        $newsId = $this->registry->security->decryptData($args['news_id']);
        $this->registry->model->run('deactivateNews', $newsId);
        $_SESSION['success'] = "News Deactivated Successfully";
        appController::cacheTopStories();
        appController::cacheNews();
        appController::cacheNewsCount();
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function edit_news($args)
    {
        $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  Edit News";
        $categoryListArray = $this->registry->model->run("getCategoryList");
        $this->registry->template->CategoryListArray = $categoryListArray;
        if(is_array($args))
        {
            $newsIdValue = $this->registry->security->decryptData($args['news_id']);
            $this->registry->template->NewsIdValue = $newsIdValue;
            $newsArray = $this->registry->model->run("getNewsByNewsId", $newsIdValue);
        }
        if ($this->isPostBack()) {

            $postArray = $this->requestPost();

            /* *********************** Start: Validation of the Data from Post *********************** */

            foreach($postArray as $key=>$value)
            {
                if($key != "btnSubmit")
                {
                    if($this->registry->validation->isEmpty($postArray[$key]))
                    {
                        $_SESSION['error'][] = ucwords(str_replace("_", " ", $key)) . " cannot be left blank";
                    }
                }
            }


            if (count($_SESSION['error']) == 0) {
                $dateTimeValue = time();

                $this->registry->model->run('updateNewsById', $postArray);
                $_SESSION['success'] = "News Edited Successfully";
                appController::cacheTopStories();
                appController::cacheNews();
                appController::cacheNewsCount();
                General::redirect($_SERVER['HTTP_REFERER']);
                exit;

            } else {

                $this->registry->template->PostRetain = $postArray;
            }
        }
        else{
            $this->registry->template->PostRetain = $newsArray[0];
        }

        $this->registry->template->show("edit_news");

    }



    /* ******************* End: Functions for the News Details ************************** */

    /** ************************* Start: Photo Upload Section **************************** */

    public function view_photos($args)
    {
        $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  View Photos";
        $photoListArray = $this->registry->model->run("getAllPhotoList", $args);
        $this->registry->template->PresentPage = $args['start_page'];
        $this->registry->template->PhotoListArray = $photoListArray;
        $this->registry->template->show("view_photos");
    }

    public function add_photos()
    {
        $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  Add Photos";
        if($this->isPostBack())
        {
            $allowedExts = array("gif", "jpeg", "jpg", "png");

            $extensionArray = explode(".", $_FILES["file"]["name"]);
            $extension = $extensionArray[(count($extensionArray)-1)];
            if ((($_FILES["file"]["type"] == "image/gif")
                || ($_FILES["file"]["type"] == "image/jpeg")
                || ($_FILES["file"]["type"] == "image/jpg")
                || ($_FILES["file"]["type"] == "image/png"))
                && ($_FILES["file"]["size"] < 2000000)
                && in_array($extension, $allowedExts))
            {
                if ($_FILES["file"]["error"] > 0)
                {
                    $_SESSION['error'][] = $_FILES["file"]["error"];
                }
                $postArray = $this->requestPost();
                if($postArray['photo_tagline'] == '')
                {
                    $_SESSION['error'][] = "Please Enter Tagline";
                }
                if(count($_SESSION['error']) == 0)
                {

                    $dataArray = array('photo_tagline' => $postArray['photo_tagline']);

                    $lastInsertedId = $this->registry->model->run('addPhotos', $dataArray);

                    $photoName = $lastInsertedId . ".jpg";
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                        __ADMIN_UPLOAD_PATH . "photos/" . $photoName);

                        $_SESSION['success'] = "Photo Added Successfully";
                        appController::cachePhotos();
                        General::redirect($_SERVER['HTTP_REFERER']);
                        exit;

                }
            }
            else
            {
                $_SESSION['error'][] = "Invalid File";
            }
        }
        $this->registry->template->show("add_photos");
    }

    public function deletePhoto($args)
    {
        $photoId = $this->registry->security->decryptData($args['photo_id']);
        if($this->registry->model->run('deletePhoto', $photoId))
        {
            unlink( __ADMIN_UPLOAD_PATH . "photos/" . $photoId . ".jpg");
        }
        $_SESSION['success'] = "Photo Deleted Successfully";
        appController::cachePhotos();
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function activatePhoto($args)
    {
        $photoId = $this->registry->security->decryptData($args['photo_id']);
        $this->registry->model->run('activatePhoto', $photoId);
        $_SESSION['success'] = "Photo Activated Successfully";
        appController::cachePhotos();
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function deactivatePhoto($args)
    {
        $photoId = $this->registry->security->decryptData($args['photo_id']);
        $this->registry->model->run('deactivatePhoto', $photoId);
        $_SESSION['success'] = "Photo Deactivated Successfully";
        appController::cachePhotos();
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function edit_photos($args)
    {
        $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  Edit Photos";
        if(is_array($args) && isset($args['photo_id']))
        {
            $photoId = $this->registry->security->decryptData($args['photo_id']);
        }

        $photoArray = $this->registry->model->run('getPhotoByPhotoId', $photoId);
        if(is_array($photoArray))
        {
            $this->registry->template->PhotoArray = $photoArray;
        }
        if($this->isPostBack())
        {
            if($_FILES['file']['name'] != '')
            {
                $allowedExts = array("gif", "jpeg", "jpg", "png");

                $extensionArray = explode(".", $_FILES["file"]["name"]);
                $extension = $extensionArray[(count($extensionArray)-1)];
                if ((($_FILES["file"]["type"] == "image/gif")
                    || ($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "image/jpg")
                    || ($_FILES["file"]["type"] == "image/png"))
                    && ($_FILES["file"]["size"] < 2000000)
                    && in_array($extension, $allowedExts))
                {
                    if ($_FILES["file"]["error"] > 0)
                    {
                        $_SESSION['error'][] = $_FILES["file"]["error"];
                    }
                    $postArray = $this->requestPost();
                    if($postArray['photo_tagline'] == '')
                    {
                        $_SESSION['error'][] = "Please Enter Tagline";
                    }
                    if(count($_SESSION['error']) == 0)
                    {

                        $dataArray = array('photo_id' => $photoId,
                            'photo_tagline' => $postArray['photo_tagline']);


                        $this->registry->model->run('updatePhotoByPhotoId', $dataArray);

                        $photoName = $photoId . ".jpg";
                        move_uploaded_file($_FILES["file"]["tmp_name"],
                            __ADMIN_UPLOAD_PATH . "photos/" . $photoName);

                        $_SESSION['success'] = "Photo Edited Successfully";
                        appController::cachePhotos();
                        General::redirect($_SERVER['HTTP_REFERER']);
                        exit;

                    }
                }
                else
                {
                    $_SESSION['error'][] = "Invalid File";
                }
            }
            else{
                $postArray = $this->requestPost();
                $dataArray = array('photo_id' => $photoId,
                    'photo_tagline' => $postArray['photo_tagline']);

                $this->registry->model->run('updatePhotoByPhotoId', $dataArray);
                $_SESSION['success'] = "Photo Edited Successfully";
                appController::cachePhotos();
                General::redirect($_SERVER['HTTP_REFERER']);
                exit;
            }

        }
        $this->registry->template->show("edit_photos");
    }

    /** ************************* End: Photo Upload Section ****************************** */


    /** ************************* Start: Video Upload Section **************************** */

    public function view_videos($args)
    {
        $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  View Videos";
        $videoListArray = $this->registry->model->run("getAllVideoList", $args);
        $this->registry->template->PresentPage = $args['start_page'];
        $this->registry->template->VideoListArray = $videoListArray;
        $this->registry->template->show("view_videos");
    }

    public function add_videos()
    {
        $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  Add Videos";
        if($this->isPostBack())
        {
            $allowedExts = array("gif", "jpeg", "jpg", "png");

            $extensionArray = explode(".", $_FILES["file"]["name"]);
            $extension = $extensionArray[(count($extensionArray)-1)];
            if ((($_FILES["file"]["type"] == "image/gif")
                || ($_FILES["file"]["type"] == "image/jpeg")
                || ($_FILES["file"]["type"] == "image/jpg")
                || ($_FILES["file"]["type"] == "image/png"))
                && ($_FILES["file"]["size"] < 2000000)
                && in_array($extension, $allowedExts))
            {
                if ($_FILES["file"]["error"] > 0)
                {
                    $_SESSION['error'][] = $_FILES["file"]["error"];
                }
                $postArray = $this->requestPost();
                if($postArray['video_tagline'] == '')
                {
                    $_SESSION['error'][] = "Please Enter Tagline";
                }
                if(count($_SESSION['error']) == 0)
                {

                    $dataArray = array('video_tagline' => $postArray['video_tagline']);

                    $lastInsertedId = $this->registry->model->run('addVideos', $dataArray);

                    $videoName = $lastInsertedId . ".jpg";
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                        __ADMIN_UPLOAD_PATH . "videos/" . $videoName);

                    $_SESSION['success'] = "Video Added Successfully";
                    appController::cacheVideos();
                    General::redirect($_SERVER['HTTP_REFERER']);
                    exit;

                }
            }
            else
            {
                $_SESSION['error'][] = "Invalid File";
            }
        }
        $this->registry->template->show("add_videos");
    }

    public function deleteVideo($args)
    {
        $videoId = $this->registry->security->decryptData($args['video_id']);
        if($this->registry->model->run('deleteVideo', $videoId))
        {
            unlink( __ADMIN_UPLOAD_PATH . "videos/" . $videoId . ".jpg");
        }
        $_SESSION['success'] = "Video Deleted Successfully";
        appController::cacheVideos();
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function activateVideo($args)
    {
        $videoId = $this->registry->security->decryptData($args['video_id']);
        $this->registry->model->run('activateVideo', $videoId);
        $_SESSION['success'] = "Video Activated Successfully";
        appController::cacheVideos();
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function deactivateVideo($args)
    {
        $videoId = $this->registry->security->decryptData($args['video_id']);
        $this->registry->model->run('deactivateVideo', $videoId);
        $_SESSION['success'] = "Video Deactivated Successfully";
        appController::cacheVideos();
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function edit_videos($args)
    {
        $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  Edit Video";
        if(is_array($args) && isset($args['video_id']))
        {
            $videoId = $this->registry->security->decryptData($args['video_id']);
        }

        $videoArray = $this->registry->model->run('getVideoByVideoId', $videoId);
        if(is_array($videoArray))
        {
            $this->registry->template->PhotoArray = $videoArray;
        }
        if($this->isPostBack())
        {
            if($_FILES['file']['name'] != '')
            {
                $allowedExts = array("gif", "jpeg", "jpg", "png");

                $extensionArray = explode(".", $_FILES["file"]["name"]);
                $extension = $extensionArray[(count($extensionArray)-1)];
                if ((($_FILES["file"]["type"] == "image/gif")
                    || ($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "image/jpg")
                    || ($_FILES["file"]["type"] == "image/png"))
                    && ($_FILES["file"]["size"] < 2000000)
                    && in_array($extension, $allowedExts))
                {
                    if ($_FILES["file"]["error"] > 0)
                    {
                        $_SESSION['error'][] = $_FILES["file"]["error"];
                    }
                    $postArray = $this->requestPost();
                    if($postArray['video_tagline'] == '')
                    {
                        $_SESSION['error'][] = "Please Enter Tagline";
                    }
                    if(count($_SESSION['error']) == 0)
                    {

                        $dataArray = array('video_id' => $videoId,
                            'video_tagline' => $postArray['video_tagline']);


                        $this->registry->model->run('updateVideoByVideoId', $dataArray);

                        $videoName = $videoId . ".jpg";
                        move_uploaded_file($_FILES["file"]["tmp_name"],
                            __ADMIN_UPLOAD_PATH . "videos/" . $videoName);

                        $_SESSION['success'] = "Video Edited Successfully";
                        appController::cacheVideos();
                        General::redirect($_SERVER['HTTP_REFERER']);
                        exit;

                    }
                }
                else
                {
                    $_SESSION['error'][] = "Invalid File";
                }
            }
            else{
                $postArray = $this->requestPost();
                $dataArray = array('video_id' => $videoId,
                    'video_tagline' => $postArray['video_tagline']);

                $this->registry->model->run('updateVideoByVideoId', $dataArray);
                $_SESSION['success'] = "Video Edited Successfully";
                appController::cacheVideos();
                General::redirect($_SERVER['HTTP_REFERER']);
                exit;
            }

        }
        $this->registry->template->show("edit_videos");
    }

    /** ************************* End: Video Upload Section ****************************** */


    /** ************************* Start: Banner Photo Upload Section **************************** */

    public function view_banner_photos($args)
    {
        $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  View Banner Photos";
        $bannerPhotoListArray = $this->registry->model->run("getAllBannerPhotoList", $args);
        $this->registry->template->PresentPage = $args['start_page'];
        $this->registry->template->BannerPhotoListArray = $bannerPhotoListArray;
        $this->registry->template->show("view_banner_photos");
    }

    public function add_banner_photos()
    {
        $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  Add Banner Photos";
        if($this->isPostBack())
        {
            $allowedExts = array("gif", "jpeg", "jpg", "png");

            $extensionArray = explode(".", $_FILES["file"]["name"]);
            $extension = $extensionArray[(count($extensionArray)-1)];
            if ((($_FILES["file"]["type"] == "image/gif")
                || ($_FILES["file"]["type"] == "image/jpeg")
                || ($_FILES["file"]["type"] == "image/jpg")
                || ($_FILES["file"]["type"] == "image/png"))
                && ($_FILES["file"]["size"] < 2000000)
                && in_array($extension, $allowedExts))
            {
                if ($_FILES["file"]["error"] > 0)
                {
                    $_SESSION['error'][] = $_FILES["file"]["error"];
                }
                $postArray = $this->requestPost();
                if($postArray['banner_photo_tagline'] == '')
                {
                    $_SESSION['error'][] = "Please Enter Tagline";
                }
                if($postArray['banner_photo_description'] == '')
                {
                    $_SESSION['error'][] = "Please Enter Description";
                }
                if(count($_SESSION['error']) == 0)
                {

                    $dataArray = array('banner_photo_tagline' => $postArray['banner_photo_tagline'],
                        'banner_photo_description' => $postArray['banner_photo_description']);

                    $lastInsertedId = $this->registry->model->run('addBannerPhotos', $dataArray);

                    $bannerPhotoName = $lastInsertedId . ".jpg";
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                        __ADMIN_UPLOAD_PATH . "banner_photos/" . $bannerPhotoName);

                    $_SESSION['success'] = "Banner Photo Added Successfully";
                    appController::cacheBannerPhoto();
                    General::redirect($_SERVER['HTTP_REFERER']);
                    exit;

                }
            }
            else
            {
                $_SESSION['error'][] = "Invalid File";
            }
        }
        $this->registry->template->show("add_banner_photos");
    }

    public function deleteBannerPhoto($args)
    {
        $bannerPhotoId = $this->registry->security->decryptData($args['banner_photo_id']);
        if($this->registry->model->run('deleteBannerPhoto', $bannerPhotoId))
        {
            unlink( __ADMIN_UPLOAD_PATH . "banner_photos/" . $bannerPhotoId . ".jpg");
        }
        $_SESSION['success'] = "Banner Photo Deleted Successfully";
        appController::cacheBannerPhoto();
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function activateBannerPhoto($args)
    {
        $bannerPhotoId = $this->registry->security->decryptData($args['banner_photo_id']);
        $this->registry->model->run('activateBannerPhoto', $bannerPhotoId);
        $_SESSION['success'] = "Banner Photo Activated Successfully";
        appController::cacheBannerPhoto();
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function deactivateBannerPhoto($args)
    {
        $bannerPhotoId = $this->registry->security->decryptData($args['banner_photo_id']);
        $this->registry->model->run('deactivateBannerPhoto', $bannerPhotoId);
        $_SESSION['success'] = "Banner Photo Deactivated Successfully";
        appController::cacheBannerPhoto();
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function edit_banner_photos($args)
    {
        $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  Edit Banner Photo";
        if(is_array($args) && isset($args['banner_photo_id']))
        {
            $bannerPhotoId = $this->registry->security->decryptData($args['banner_photo_id']);
        }

        $bannerPhotoArray = $this->registry->model->run('getBannerPhotoByBannerPhotoId', $bannerPhotoId);
        if(is_array($bannerPhotoArray))
        {
            $this->registry->template->BannerPhotoArray = $bannerPhotoArray;
        }
        if($this->isPostBack())
        {
            if($_FILES['file']['name'] != '')
            {
                $allowedExts = array("gif", "jpeg", "jpg", "png");

                $extensionArray = explode(".", $_FILES["file"]["name"]);
                $extension = $extensionArray[(count($extensionArray)-1)];
                if ((($_FILES["file"]["type"] == "image/gif")
                    || ($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "image/jpg")
                    || ($_FILES["file"]["type"] == "image/png"))
                    && ($_FILES["file"]["size"] < 2000000)
                    && in_array($extension, $allowedExts))
                {
                    if ($_FILES["file"]["error"] > 0)
                    {
                        $_SESSION['error'][] = $_FILES["file"]["error"];
                    }
                    $postArray = $this->requestPost();
                    if($postArray['banner_photo_tagline'] == '')
                    {
                        $_SESSION['error'][] = "Please Enter Tagline";
                    }
                    if(count($_SESSION['error']) == 0)
                    {

                        $dataArray = array('banner_photo_id' => $bannerPhotoId,
                            'banner_photo_tagline' => $postArray['banner_photo_tagline']);


                        $this->registry->model->run('updateBannerPhotoByBannerPhotoId', $dataArray);

                        $bannerPhotoName = $bannerPhotoId . ".jpg";
                        move_uploaded_file($_FILES["file"]["tmp_name"],
                            __ADMIN_UPLOAD_PATH . "banner_photos/" . $bannerPhotoName);

                        $_SESSION['success'] = "Banner Photo Edited Successfully";
                        appController::cacheBannerPhoto();
                        General::redirect($_SERVER['HTTP_REFERER']);
                        exit;

                    }
                }
                else
                {
                    $_SESSION['error'][] = "Invalid File";
                }
            }
            else{
                $postArray = $this->requestPost();
                $dataArray = array('banner_photo_id' => $bannerPhotoId,
                    'banner_photo_tagline' => $postArray['banner_photo_tagline']);

                $this->registry->model->run('updateBannerPhotoByBannerPhotoId', $dataArray);
                $_SESSION['success'] = "Banner Photo Edited Successfully";
                appController::cacheBannerPhoto();
                General::redirect($_SERVER['HTTP_REFERER']);
                exit;
            }

        }
        $this->registry->template->show("edit_banner_photos");
    }

    /**
     * @purpose: This is the Signout action
     * @author: Rishabh Dev Bansal
     */
    public function signout()
    {
        session_destroy();
        General::redirect(__SITE_URL);
    }
}