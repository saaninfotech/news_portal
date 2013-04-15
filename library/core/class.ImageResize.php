<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This class is used for the Image resize functionalitites
 *
 * @author: Saurabh Sinha
 * @created on: 1/7/13 11:45 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class ImageResize
{
    var $image;
    var $image_type;

    public function __construct()
    {

    }

    /**
     * @purpose: Loads an image from the image path
     * @author: Saurabh Sinha
     *
     * @param $filename Path of the Image including the name
     */
    public function load($filename)
    {

        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if ($this->image_type == IMAGETYPE_JPEG) {

            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {

            $this->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {

            $this->image = imagecreatefrompng($filename);
        }
    }

    /**
     * @purpose: Saves the manipulated image to the filesystem.
     * @author: Saurabh Sinha
     *
     * @param $filename
     * @param int $image_type
     * @param int $compression
     * @param null $permissions
     */
    public function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = NULL)
    {

        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
        } elseif ($image_type == IMAGETYPE_GIF) {

            imagegif($this->image, $filename);
        } elseif ($image_type == IMAGETYPE_PNG) {

            imagepng($this->image, $filename);
        }
        if ($permissions != NULL) {

            chmod($filename, $permissions);
        }
    }

    /**
     * @purpose: Outputs an image in the desired extention
     * @author: Saurabh Sinha
     *
     * @param int $image_type
     */
    public function output($image_type = IMAGETYPE_JPEG)
    {

        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image);
        } elseif ($image_type == IMAGETYPE_GIF) {

            imagegif($this->image);
        } elseif ($image_type == IMAGETYPE_PNG) {

            imagepng($this->image);
        }
    }

    /**
     * @purpose: Returns the Width of the image
     * @author: Saurabh Sinha
     * @return int
     */
    public function getWidth()
    {
        return imagesx($this->image);
    }

    /**
     * @purpose: Returns the Height of the image
     * @author: Saurabh Sinha
     * @return int
     */
    public function getHeight()
    {
        return imagesy($this->image);
    }

    /**
     * @purpose: Resizes the image to the desired height
     * @author: Saurabh Sinha
     *
     * @param $height
     */
    public function resizeToHeight($height)
    {

        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }

    /**
     * @purpose: Resizes the image to the desired Width
     * @author: Saurabh Sinha
     *
     * @param $width
     */
    public function resizeToWidth($width)
    {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width, $height);
    }

    /**
     * @purpose: Scales the image according to the scale provided
     * @author: Saurabh Sinha
     *
     * @param $scale
     */
    public function scale($scale)
    {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getheight() * $scale / 100;
        $this->resize($width, $height);
    }

    /**
     * @purpose: Resizes the image according to the height and the width provided
     * @author: Saurabh Sinha
     *
     * @param $width
     * @param $height
     */
    public function resize($width, $height)
    {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }
}
