<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose:
 *
 * @author: Saurabh Sinha
 * @created on: 1/7/13 9:06 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class Security
{
    /**
     * @purpose: This function will encrypt the value provided as parameter.
     * @author: Saurabh Sinha
     *
     * @param $value
     *
     * @return string
     */
    static public function encryptData($value)
    {
        $randValue = rand(100000, 999999);

        return base64_encode($randValue . $value);
    }

    /**
     * @purpose: This function will decrypt the value provided as parameter.
     * @author: Saurabh Sinha
     *
     * @param $encodedValue
     *
     * @return string
     */
    static public function decryptData($encodedValue)
    {
        $decodedValue = base64_decode($encodedValue);

        return substr($decodedValue, 6);
    }

    /**
     * @purpose: This function will sanitize the value of the variable provided as parameter.
     * @author: Saurabh Sinha
     *
     * @param $value
     *
     * @return string
     */
    static public function sanitize($value)
    {
        return addslashes($value);
    }
}
