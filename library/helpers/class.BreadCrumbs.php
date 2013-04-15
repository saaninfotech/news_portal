<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the BreadCrumb Class
 *
 * @author: Saurabh Sinha
 * @created on: 12/30/12 2:31 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class BreadCrumbs
{
    public $breadcrumbs;

    //This sets the default pointer for the BreadCrumb
    private $pointer = '&raquo;';
    private $url;
    private $parts;

    /**
     * @purpose: This is the constructor for the BreadCrumb class.
     * @author: Saurabh Sinha
     */
    public function __construct()
    {
        $this->setParts();
        $this->breadcrumbs = '<a href="' . $this->url . '">Home</a>';
    }

    /**
     * @purpose: This functions sets as custom pointer for the BreadCrumb if required.
     * @author: Saurabh Sinha
     *
     * @param $pointer
     */
    public function setPointer($pointer)
    {
        $this->pointer = $pointer;
    }

    /**
     * @purpose: This sets the different parts for the url to get the present file name.
     * @author: Saurabh Sinha
     */
    private function setParts()
    {
        $parts = explode('/', $_GET["route"], 1);
        $this->parts = $parts;
    }

    /**
     * @purpose: This function is responsible to render the crumbs to be displayed.
     * @author: Saurabh Sinha
     */
    public function crumbs()
    {
        foreach ($this->parts as $part) {
            if ($part != '') {
                if (strpos($_GET["route"], "/")) {
                    $part = substr($part, 0, strrpos($part, "/"));
                }

                $this->url .= "index.php?route=$part";
                $this->breadcrumbs .= " $this->pointer " . '<a href="' . $this->url . '">' . ucfirst($part) . '</a>';
            }
        }
    }
}
