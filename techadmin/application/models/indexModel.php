<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the Index Model for the Admin Section of the SAAN Index Controller
 *
 * @author: Rishabh Dev Bansal
 * @created on: 02/15/13 12:25 AM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class indexModel extends SaanModel
{
    public function checkAdminByIdnPass($adminArgs)
    {
        $query = "SELECT *
                    FROM admin_details
                    WHERE admin_name = '" . $adminArgs['txtUsername'] . "'
                        AND admin_password = '" . md5($adminArgs['txtPassword']) . "'
                        AND admin_status = 'active'";

        return $this->db->num_rows($query);
    }
}
