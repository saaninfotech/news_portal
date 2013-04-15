<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the router and the dispatcher class for the application. This manages the dispatching of any controller,
 * action and parameters passed into the url.
 *
 * @author: Saurabh Sinha
 * @created on: 12/30/12 2:11 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class Router
{
    private $registry;
    private $path;
    private $args = array();
    public $__file;
    public $__controller;
    public $__action;

    /**
     * @purpose: This is the constructor for router class. It takes the global vars registry as parameter.
     * @author: Saurabh Sinha
     *
     * @param $registry
     */
    function __construct($registry)
    {
        $this->registry = $registry;
    }

    /**
     * @purpose: This function get the File to be loaded.
     * @author: Saurabh sinha
     * @return bool
     */
    public function getFile()
    {
        $this->getController();

        return ($this->__controller) ? $this->__controller : FALSE;
    }


    /**
     * @purpose: This function is reponsible to dispatche the required controller and load it ready to be executed.
     */
    public function dispatch()
    {
        //This sets the Path for the controller.
        $this->path = __CONTROLLER_PATH;

        //This checks for the required controller.
        $this->getController();

        //If the Controller is not found
        if (is_readable($this->__file) == FALSE) {
            $this->__file = $this->path . 'errorController.php';
            $this->__controller = 'error';
        }

        //This includes the Controller file.
        require $this->__file;

        //This creates the instance of the Controller Class loaded
        $class = $this->__controller . 'Controller';
        $__controller = new $class($this->registry);

        //This checks for the callable action of the loaded controller
        if (is_callable(array($__controller, $this->__action)) == FALSE) {

            /** ********* Start: This section sets the controller to the Error Controller and Error404 Action if the
             * action specified is not present.
             * */

            $this->__file = $this->path . 'errorController.php';
            $this->__controller = 'error';
            require $this->__file;
            $class = $this->__controller . 'Controller';
            $__controller = new $class($this->registry);
            $__action = 'error404';

            /** ********* End: This section sets the controller to the Error Controller and Error404 Action if the
             * action specified is not present.
             * */
        } else {
            //This loads the custom action specified.
            $__action = $this->__action;
        }

        $__requestURI = $_SERVER['REQUEST_URI'];

        $__directoryName = dirname($_SERVER['PHP_SELF']);

        /**
         *    The variable $__directoryName will have value '/' is the system is present in the root directory. So in that case the
         *    replacement of the directory should not be done.
         */
        if ($__directoryName != '/') {
            $__urlParameter = str_replace($__directoryName, '', $__requestURI);
        } else {
            $__urlParameter = $__requestURI;
        }
        $__urlArray = explode("/", $__urlParameter);

        $__parameterArray = array_slice($__urlArray, 2);

        $__argumentCount = count($__urlArray);

        $__argumentArray = array();

        if ($__argumentCount > 3) {
            foreach ($__urlArray as $__argumentKey => $__argumentValue) {
                if ($__argumentKey > 2) {
                    $__pairArray = array();
                    $__pairArray = explode(":", $__argumentValue);
                    $__argumentArray[$__pairArray[0]] = $__pairArray[1];
                }
            }
        }
        //This is to check the slashes and manage the url accordingly.
        $__action = preg_replace("/[^a-zA-Z0-9_]+/", "", $__action);

        //This executes the specified action for the controller.
        $__controller->$__action($__argumentArray);
    }

    /**
     * @purpose: This function gets the specified controller.
     * @author: Saurabh Sinha
     */
    private function getController()
    {
        //This check the query string value for variable route.
        $route = (empty($_GET['route'])) ? '' : $_GET['route'];

        if (empty($route)) {
            //This defines the default action.
            $route = 'index';
        } else {
            //This manages the Parameters
            $parts = explode('/', $route);
            $this->__controller = $parts[0];

            if (isset($parts[1])) {
                $this->__action = $parts[1];
            }
        }

        if (empty($this->__controller)) {
            //This sets the default controller.
            $this->__controller = 'index';
        }

        $this->__file_name = $this->__controller;


        if (empty($this->__action)) {
            $this->__action = 'index';
        }

        $this->__controller = preg_replace("/[^a-zA-Z0-9_]+/", "", $this->__controller);

        $this->__file = $this->path . '/' . $this->__controller . 'Controller.php';
    }
}
