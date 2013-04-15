<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the Template Class for the Framework.
 *
 * @author: Saurabh Sinha
 * @created on: 12/30/12 2:23 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class Template
{
    private $template_name;

    private $registry;

    //This is globally accessed Vars
    private $vars = array();

    /**
     * @purpose: This is the Constructor for the Template Class.
     * @author: Saurabh Sinha
     *
     * @param $registry
     */
    function __construct($registry)
    {
        $this->registry = $registry;
    }

    /**
     * @purpose: This is the Set function for the Template class.
     * @author: Saurabh Sinha
     *
     * @param $index
     * @param $value
     */
    public function __set($index, $value)
    {
        $this->vars[$index] = $value;
    }

    /**
     * @purpose: This function manages the Rendering of the View.
     * @author: Saurabh Sinha
     *
     * @param $name
     *
     * @return bool
     * @throws Exception
     */
    function show($name)
    {
        //This sets the path for the Template.
        $path = __TEMPLATE_PATH . $name . '.php';

        if (file_exists($path) == FALSE) {
            throw new Exception('Template not found in ' . $path);

            return FALSE;
        }

        //This access the Global Vars and extract to the view to be displayed.
        extract($this->vars);

        ob_start();

        //Include the Template File
        include ($path);

        return ob_end_flush();

    }
}
