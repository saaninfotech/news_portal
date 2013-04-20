<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Project P3
 * @purpose: This is the Model Class for the Index Controller
 *
 * @author: Rishabh Dev Bansal
 * @created on: 02/15/13 3:17 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class indexModel extends SaanModel
{
    public function getBannerPhoto()
    {
        $query = "SELECT * FROM banner_photo_details WHERE banner_photo_status = 'active'";
        return $this->db->fetch_rows($query);
    }
}
