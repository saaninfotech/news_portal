<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is Core Validation Class for the Application.
 *
 * @author: Saurabh Sinha
 * @created on: 1/7/13 8:47 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class Validation
{

    /**
     * @purpose: This function validates the Email Address
     * @author: Saurabh Sinha
     *
     * @param $e
     * @param $v
     *
     * @return bool
     */
    public function validateEmail($e, $v = -1)
    {
        global $verbose;
        if ($v == -1) {
            $v = $verbose;
        }
        if (!preg_match("/^[a-z0-9.+-_]+@([a-z0-9-]+(.[a-z0-9-]+)+)$/i", $e, $grab)) {
            return FALSE;
        }

        return TRUE;
    }

    /**
     * @purpose: This function validates the Phone Number
     * @author: Saurabh Sinha
     *
     * @param $phone
     *
     * @return bool
     */
    public function validatePhone($phone)
    {
        if (is_numeric($phone) === TRUE) {
            if (strlen($phone) >= 10 && strlen($phone) <= 11) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        return FALSE;
    }

    /**
     * @purpose: This function matches the Two Parameters including the datatype and the value
     * @author: Saurabh Sinha
     *
     * @param $pass1
     * @param $pass2
     *
     * @return bool
     */
    public function isEqualValue($pass1, $pass2)
    {
        if (!empty($pass1) and !empty($pass2)) {
            if ($pass1 === $pass2) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    /**
     * @purpose: This function checks the variable for null or empty value
     * @author: Saurabh Sinha
     *
     * @param $stringValue
     *
     * @return bool
     */
    public function isEmpty($stringValue)
    {
        if (empty($stringValue)) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * @purpose: This function checks the date for validity
     * @author: Saurabh Sinha
     *
     * @param $date
     *
     * @return bool
     */
    public function checkDateFormat($date)
    {
        $date = explode("/", $date);
        $yearLength = strlen($date[0]);
        $monthLength = strlen($date[1]);
        $dayLength = strlen($date[2]);
        if ($yearLength == 4 && ($monthLength == 1 || $monthLength == 2) && ($dayLength == 1 || $dayLength == 2)) {
            //match the format of the date

            if (checkdate($date[1], $date[2], $date[0])) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
}
