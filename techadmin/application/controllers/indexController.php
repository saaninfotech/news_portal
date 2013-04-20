<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the Index controller for the Admin Seciton
 *
 * @author: Saurabh Sinha
 * @created on: 02/15/13 3:21 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class indexController extends SaanController
{
    public function index()
    {
        $this->registry->template->Title = "Project P3 :: Admin Login Page";
        $this->registry->template->ErrorLogin = "style=\"display:none;\"";
        $this->registry->template->show("index");
    }

    public function login()
    {
        if ($this->isPostBack()) {
            $postArray = $this->requestPost();
        }

        if (($this->registry->model->run('checkAdminByIdnPass', $postArray)) > 0) {
            $_SESSION['adminLogin'] = $postArray['txtUsername'];
            header("Location: " . __SITE_URL . "adminhome");
            exit;
        } else {
            $this->registry->template->ErrorLogin = "style=\"display:block;\"";
        }
        $this->registry->template->show("index");
    }
}
