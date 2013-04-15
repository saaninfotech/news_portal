<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This class will have all the common functionalities stored
 *
 * @author: Saurabh Sinha
 * @created on: 1/7/13 9:46 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class General
{
    /**
     * @purpose: This is the function to get the Error/Success message.
     * @author: Saurabh Sinha
     */
    static public function getMessage()
    {
        if (isset($_SESSION['error']) || isset($_SESSION['success'])) {
            $divValue = '';
            if (isset($_SESSION['error']) && is_array($_SESSION['error'])) {
                $errorText = "<ul style='margin-left: 20px;'>";

                foreach ($_SESSION['error'] as $errorKey => $errorValue) {
                    $errorText .= "<li>$errorValue</li>";
                }
                $errorText .= "</ul>";
                $divValue .= "<table style='border:2px solid pink; border-radius:5px; padding:10px;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FF3300;' width='100%'><tr><td valign='top' width='28'><img src=\"" . __TEMPLATE_URL . "images/error_image.png\" width=\"20\" height=\"20\" /></td><td>" .
                    "<strong>Following Error(s) has occurred:</strong>" . $errorText
                    . "</td></tr></table>";
                echo $divValue;
            } elseif (isset($_SESSION['success'])) {
                $divValue = "<table style='border:1px solid green; border-radius:5px; padding:10px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#009900;' width='100%'><tr><td width='28' valign='top'><img src=\"" . __TEMPLATE_URL . "images/success_image.png\" width=\"20\" height=\"20\" /></td><td>" . $_SESSION['success'] . "</td></tr></table>";
                echo $divValue;
            }
            unset($_SESSION['error']);
            unset($_SESSION['success']);
        }
    }

    /**
     * @purpose: This function gets the date in the custom requried format from any timestamp value.
     * @author: Saurabh Sinha
     *
     * @param $timestampValue
     * @param string $formatType
     *
     * @return string
     */
    static public function getFormatedDate($timestampValue, $formatType = "datetime")
    {
        if (isset($timestampValue) && $timestampValue != '') {
            if ($formatType == "datetime") {
                return date("M d Y, h:i:s A", $timestampValue);
            }

            if ($formatType == "dd/mm/yyyy") {
                return date("d/m/Y", $timestampValue);
            }

            if ($formatType == "yyyy/mm/dd") {
                return date("Y/m/d", $timestampValue);
            }

            if ($formatType == "yyyy-mm-dd") {
                return date("Y-m-d", $timestampValue);
            }

            if ($formatType == "dd-mm-yyyy") {
                return date("d-m-Y", $timestampValue);
            }
        } else {
            return $timestampValue;
        }

    }

    /**
     * @purpose: This is the redirect function to page the page redirections for the application.
     * @author: Saurabh Sinha
     *
     * @param $url
     */
    static function redirect($url)
    {
        header('LOCATION: ' . html_entity_decode($url));
        exit();
    }

    /**
     * @purpose: This function will redirect the page with javascrit redirect function
     * @author: Saurabh Sinha
     *
     * @param $path
     */
    static function  jsRedirect($path)
    {
        echo "<script type=\"text/javascript\">location.replace('" . $path . "');</script>";
    }

    /**
     * @purpose: This function will show a javascript alert
     * @author: Saurabh Sinha
     *
     * @param $msg
     */
    static function  jsAlert($msg)
    {
        echo "<script type=\"text/javascript\">alert('" . $msg . "');</script>";
    }

    /**
     * @purpose: This function will check the validity of the Session and redirect to specified url.
     * @author: Saurabh Sinha
     *
     * @param $sessionValue
     * @param $pageRedirect
     * @param string $authType
     */
    static function validateSession($sessionValue, $pageRedirect, $authType = '')
    {
        $sesValue = $_SESSION["$sessionValue"];
        if ($sesValue == '') {
            self::redirect($pageRedirect);
        }
    }

    static function getFullNavigation($totalRecords, $totalPages, $presentPage, $presentLink)
    {
        $navArray = array();
        $navHTML = "";
        if ($totalRecords > RECORDS_PER_PAGE && $totalPages > 1) {
            for ($i = 0; $i < $totalPages; $i++) {
                $linkValue = $i + 1;
                $current = "";
                if ($i == $presentPage) {
                    $current = "current";
                }
                $navHTML .= "<a class='" . $current . "' href='" . __SITE_URL . "$presentLink/start_page:" . ($i) . "'>$linkValue</a>";
            }

        } else {
            $navHTML = "<a class='current' href='" . __SITE_URL . "$presentLink'>1</a>";
        }

        $finalHTML = '<table width="100%" class="pagination">
                        <tr>
                            <td align="left" width="90%">
                                ' . $navHTML . '
                            </td>
                            <td align="right">
                                <div class="page_info">' . "Page " . ($presentPage + 1) . " of " . $totalPages . '</div>
                            </td>
                        </tr>
                    </table>';
        return $finalHTML;
    }

}
