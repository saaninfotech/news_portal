<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Project P3
 * @purpose: This is the Index controller for the Framework
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
class indexController extends SaanController
{
    /**
     * @purpose: This action manages the Home page
     * @return mixed|void
     */
    public function index()
    {
        $this->registry->template->Title = "SAAN Infotech :: Home Page";
        $this->registry->template->show("index");
    }
}
