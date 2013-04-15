<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the Registry class for the Framework. This manages to maintain a Vars as Global throughout the
 * application.
 *
 * @author: Saurabh Sinha
 * @created on: 12/30/12 2:07 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class Registry
{
    //This initializes the Vars that will be available globally.
    private $vars = array();

    /**
     * @purpose: This function sets the values to the globally accessed Vars.
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
     * @purpose: This function gets the values for the Globally accessed Vars.
     * @author: Saurabh Sinha
     *
     * @param $index
     *
     * @return mixed
     */
    public function __get($index)
    {
        return $this->vars[$index];
    }
}
