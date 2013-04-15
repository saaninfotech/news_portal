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

    public function view_templates($args)
    {
        $this->registry->template->Title = "HiiFan News Portal :: Admin Home Page :  View Email Templates";
        $templateListArray = $this->registry->model->run("getAllTemplateList", $args);
        $this->registry->template->PresentPage = $args['start_page'];
        $this->registry->template->TemplateListArray = $templateListArray;
        $this->registry->template->show("view_templates");
    }

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

    /* ************************** Start: Functions Related to Category ****************************** */

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
