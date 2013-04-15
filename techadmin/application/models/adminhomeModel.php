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
class adminhomeModel extends SaanModel
{
    /**
     * @purpose: This function returns the paginated array of all the Email Templates
     * @author: Saurabh Sinha
     * @param $args
     * @return mixed
     */
    public function getAllTemplateList($args)
    {
        $start = 0;
        if (is_array($args) && isset($args['start_page'])) {
            $start = $args['start_page'];
            $start = $start * RECORDS_PER_PAGE;
        }
        $query = "SELECT * FROM email_template_details ORDER BY email_template_id DESC ";

        return $this->db->paginateQuery($query, $start);
    }

    /**
     * @param $templateId
     * @return mixed
     */
    public function getTemplateByTemplateId($templateId)
    {
        if ($templateId != '') {
            $query = "SELECT * FROM email_template_details WHERE email_template_id = '$templateId'";
            return $this->db->fetch_rows($query);
        }
    }

    /**
     * @param $emailArray
     * @return mixed
     */
    public function updateEmailTemplateById($emailArray)
    {
        if (is_array($emailArray)) {
            $templateSubject = $emailArray['template_subject'];
            $templateDescription = $emailArray['template_description'];
            $templateContent = $emailArray['template_content'];
            $templateStatus = $emailArray['template_status'];
            $query = "UPDATE email_template_details SET
email_template_subject = '$templateSubject',
email_template_description = '$templateDescription',
email_template_content = '$templateContent',
email_template_status = '$templateStatus'
WHERE email_template_id = '" . $emailArray['email_template_id'] . "'";
            return $this->db->query($query);
        }
    }
}

