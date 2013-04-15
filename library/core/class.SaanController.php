<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the Core Saan Controller for the Application. This class is needed to be abstract because the class
 * should not be instantiated and only should be inherited.
 *
 * @author: Saurabh Sinha
 * @created on: 12/30/12 12:37 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
abstract class SaanController
{
    protected $registry;

    /**
     * @purpose: This is the constructor for the Controller which initiates the Registry.
     * @author: Saurabh Sinha
     *
     * @param $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
    }

    /**
     * @purpose: This is an abstract function just because every controller needs to define an index function
     * @author: Saurabh Sinha
     * @return mixed
     */
    abstract function index();

    /**
     * @purpose: This function will check the POST Back
     * @author: Saurabh Sinha
     * @return bool
     */
    public function isPostBack()
    {
        if (count($_POST) > 0) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * @purpose: This function will check if we have any query string value
     * @author: Saurabh Sinha
     * @return bool
     */
    public function isGetBack()
    {
        if (count($_GET) > 0) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * @purpose: This function will return back the POST array in key value pair.
     * @return array|bool
     */
    public function requestPost()
    {
        if ($this->isPostBack()) {
            $postArray = array();
            foreach ($_POST as $key => $value) {
                $postArray[$key] = $value;
            }

            return $postArray;
        }

        return FALSE;
    }


    /**
     * @purpose: This function will return back the GET array in key value pair.
     * @return array
     */
    public function requestGet()
    {
        $getArray = array();
        foreach ($_GET as $key => $value) {
            $getArray[$key] = addslashes($value);
        }

        return $getArray;

    }

    public function randomString($length = 8)
    {
        $random = "";
        srand((double)microtime() * 1000000);
        $char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $char_list .= "abcdefghijklmnopqrstuvwxyz";
        $char_list .= "1234567890";
        // Add the special characters to $char_list if needed

        for ($i = 0; $i < $length; $i++) {
            $random .= substr($char_list, (rand() % (strlen($char_list))), 1);
        }
        return $random;
    }
}