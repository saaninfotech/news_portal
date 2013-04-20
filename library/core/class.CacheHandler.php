<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the class to handle the Cache.
 *
 * @author: Saurabh Sinha
 * @created on: 12/30/12 12:56 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/

class CacheHandler {

    private $required_variables = array('caching_path','priority_required');

    private $caching_path = "";
    private $priority_required = 0;

    /**
     * @purpose: Class constructor - automatically called when initiating an instance of the CacheHandler class. Retrieve configuration variables to correctly setup the caching environment.
     * @param $config_path
     */
    function CacheHandler($config_path) {

        // Parameter is an array which already contains variables we need
        if(is_array($config_path))
            $config = $config_path;
        else {

            // We need to pull our config data from a configuration file.
            // Variables in this file will have to use the following structure:
            // $config['cache']['caching_path'] = ...
            // $config['cache']['priority_required'] = ...
            if(file_exists($config_path)) {
                include($config_path);

                if(!isset($config['cache'])) {
                    echo "File $config_path can be reached but there is no variable called ".'$config["cache"].';
                    exit(-1);

                } else if(!is_array($config['cache'])) {
                    echo "File $config_path can be reached but the variable ";
                    exit(-1);

                } else {
                    $config = $config['cache'];
                }

            } else {
                // config file doesn't exist
                echo "$config_path doesn't point to a valid PHP configuration file.";
                exit(-1);
            }
        }

        // At this point, we're sure we have been able to gather some configuration data
        // Checking if all the required data have been given.
        foreach($this->required_variables as $var) {

            if(!isset($config['cache'][$var])) {
                echo "Error: $var is missing in either your config file or the config array you used.";
                exit(-1);
            } else {
                // Finally: the variable exists.
                $this->{$var} = $config['cache'][$var];
            }
        }
    }

    /**
     *	@purpose: Save a variable with its cache ending date in a text file (cache file).
     *	@param string $name Name of the caching file. Has to be unique since you'll pull your data from the cache engine with this variable.
     *	@param mixed $content Can be any type of variable that you want to cache.
     *	@param int $duration Time you want to keep the content cached (in SECONDS). If $duration = 0, we'll keep the file cached for ever.
     *	@return bool Simply returns true if the process has been successful.
     */
    function cache_content($name,$content,$duration = 0) {

        $filename = $this->caching_path . $this->_encrypt_name($name);

        $content = array(
            'duration' => $duration,
            'creation' => time(),
            'content' => $content
        );
        $content = serialize($content);

        $rh = fopen($filename,'w+');
        fwrite($rh,$content);
        fclose($rh);

        return true;
    }

    /**
     *	@purpose: Return the content previously cached with cache_content().
     *	@param string $name Has to be the same as used when calling cache_content()
     * 	@param int $priority Integer between 0 and 100 to know whether we cache the content or not.
     * 	@return bool False if the cache has expired or doesn't exist (or priority is too  low).
     */
    function retrieve_cache($name,$priority = 0) {

        $filename = $this->caching_path . $this->_encrypt_name($name);

        if($priority < $this->priority_required)
            return false;

        if(!file_exists($filename))
            return false;

        $content = file_get_contents($filename);
        $content = unserialize($content);

        if($content['duration'] == 0)
            return $content;
        else if(time() > $content['creation']+$content['duration'])
            return false;
        else
            return $content['content'];
    }

    private $has_buffer_started = false;
    private $buffer_content = "";
    /**
     *	Start the caching buffer
     */
    function start_buffer() {
        // we don't need to handle multiple buffers for simple content caching
        if(!$this->has_buffer_started){
            ob_start();
            $this->has_buffer_started = true;
        }
    }

    /**
     *	Stop the caching buffer
     */
    function stop_buffer() {
        if($this->has_buffer_started){
            $content = ob_get_clean();
            $this->buffer_content = $content;
            $this->has_buffer_started = false;
        }
    }

    /**
     *	Cache the content (buffered with start_buffer() and stop_buffer())
     *	@param string $name Name of the caching file. Has to be unique since you'll pull your data from the cache engine with this variable.
     *	@param int $duration Time you want to keep the content cached. If $duration = 0, we'll keep the file cached for ever.
     *	@return bool True if the process has been successful
     */
    function cache_buffer($name,$duration = 0) {
        // buffer has already been opened and closed
        if(!$this->has_buffer_started) {
            // simply use the method we already written earlier.
            $this->cache_content($name,$this->buffer_content,$duration);
        }
    }

    /**
     *	Delete a cache file. Usually not used unless you create a cache file with $duration = 0 and want to regenerate the cache.
     *	@param string $name Name of the caching file.
     *	@return bool False if file doesn't exist, true if the process has been successful.
     */
    function delete_cache($name) {
        $filename = $this->caching_path . $this->_encrypt_name($name);
        if(!file_exists($filename))
            return false;
        else
            unlink($filename);
        return true;
    }

    /**
     * @purpose: Encrypt the name of a given variable to avoid malformed files.
     * @param $name
     * @return string
     */
    function _encrypt_name($name) {
        return md5($name);
    }

}

/* End of file */