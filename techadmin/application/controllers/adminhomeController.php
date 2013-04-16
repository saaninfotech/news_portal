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
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function activateCategory($args)
    {
        $categoryId = $this->registry->security->decryptData($args['news_category_id']);
        $this->registry->model->run('activateCategory', $categoryId);
        $_SESSION['success'] = "News Category Successfully";
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function deactivateCategory($args)
    {
        $categoryId = $this->registry->security->decryptData($args['news_category_id']);
        $this->registry->model->run('deactivateCategory', $categoryId);
        $_SESSION['success'] = "News Category Deactivated Successfully";
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function add_news_category()
    {
        $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  Edit News Category";
        $this->registry->template->show("add_news_category");

    }

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

            } else {

                $this->registry->template->PostRetain = $postArray;
            }
        }
        $this->registry->template->show("add_news_category");

    }






    /* ******************* End: Functions for the News Category ************************** */

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
