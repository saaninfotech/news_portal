<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the Core Saan Model for the Application.
 *
 * @author: Saurabh Sinha
 * @created on: 12/30/12 12:46 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class SaanModel
{
    private $__instance; # class instance
    protected $__file_name; # model file
    protected $db; # global db object

    /**
     * @purpose: This is the constructor for the Model Class. This gets the db and the model file name to be executed.
     * @author: Saurabh Sinha
     *
     * @param $db
     * @param $name
     */
    function __construct($db, $name)
    {
        $this->db = $db;
        $this->__file_name = $name;
    }

    /**
     * @purpose: This function runs the specified Model for the Specific Controller.
     * @author: Saurabh Sinha
     *
     * @param $name
     * @param array $__modelFuncArgs
     *
     * @return bool
     * @throws Exception
     */
    public function run($name, $__modelFuncArgs = array())
    {
        $path = __MODEL_PATH . $this->__file_name . 'Model.php';

        //Check if the Model file Exists or not.
        if (file_exists($path) == FALSE) {
            throw new Exception('Model not found in ' . $path);

            return FALSE;
        }

        //Require the Model File to be executed.
        require_once ($path);

        //Create the Instance of the Model file and then return the instance for the model to be executed.
        $__class = $this->__file_name . 'Model';
        $this->__instance = new $__class($this->db, $this->__file_name);
        $__value = $this->__instance->$name($__modelFuncArgs);

        //Return the Instance for the Model
        return $__value;
    }
}
