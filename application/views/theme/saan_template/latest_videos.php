<div class="tabbed_area">
    <div class="heading_tag">Latest Videos</div>
    <table width="100%" border="0">
        <?php
        $AllVideoArray = appController::getAllVideos();
        if(is_array($AllVideoArray) && count($AllVideoArray) > 0)
        {
        ?>
            <tr>
                <td align="left" valign="top"><img name="" src="<?=__ADMIN_UPLOAD_URL?>videos/video.png" width="132"
                                                   height="112" alt=""/></td>
                <td align="left" valign="top"><img name="" src="<?=__ADMIN_UPLOAD_URL?>videos/video.png" width="132"
                                                   height="112" alt=""/></td>
            </tr>
            <tr>
                <td align="left" valign="top"><a href="<?=__SITE_URL?>pages/viewvideo/video_id:<?=$this->registry->security->encryptData($AllVideoArray[0]['video_id'])?>"><?=ucwords($AllVideoArray[0]['video_tagline'])?></a></td>
                <td align="left" valign="top"><a href="<?=__SITE_URL?>pages/viewvideo/video_id:<?=$this->registry->security->encryptData($AllVideoArray[1]['video_id'])?>"><?=ucwords($AllVideoArray[1]['video_tagline'])?></a></td>
            </tr>
            <tr>
                <td align="left" valign="top"><img name="" src="<?=__ADMIN_UPLOAD_URL?>videos/video.png" width="132"
                                                   height="112" alt=""/></td>
                <td align="left" valign="top"><img name="" src="<?=__ADMIN_UPLOAD_URL?>videos/<?php //$AllVideoArray[3]['video_id']?>video.png" width="132"
                                                   height="112" alt=""/></td>
            </tr>
            <tr>
                <td align="left" valign="top"><a href="<?=__SITE_URL?>pages/viewvideo/video_id:<?=$this->registry->security->encryptData($AllVideoArray[2]['video_id'])?>"><?=ucwords($AllVideoArray[2]['video_tagline'])?></a></td>
                <td align="left" valign="top"><a href="<?=__SITE_URL?>pages/viewvideo/video_id:<?=$this->registry->security->encryptData($AllVideoArray[3]['video_id'])?>"><?=ucwords($AllVideoArray[3]['video_tagline'])?></a></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>