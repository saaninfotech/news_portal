<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the Error controller.
 *
 * @author: Saurabh Sinha
 * @created on: 02/15/13 3:09 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/

class errorController extends SaanController
{
    /**
     * @purpose: This action manages the Controller 404 Error
     * @return mixed|void
     */
    public function index()
    {
        $this->registry->template->title = '404 Error - Controller Not Found !';
        $this->registry->template->errorHeading = '404 Error - Controller Not Found !';
        $this->registry->template->errorMessage = '404 Error - Controller Not Found !';
        $this->registry->template->show('error/error404');
    }

    /**
     * @purpose: This function manages the Action 404 Error
     */
    public function error404()
    {
        $this->registry->template->title = '404 Error - Action Not Found !';
        $this->registry->template->errorHeading = '404 Error - Action Not Found !';
        $this->registry->template->errorMessage = '404 Error - Action Not Found !';
        $this->registry->template->show('error/error404');
    }
}
