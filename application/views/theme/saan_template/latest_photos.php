<div class="tabbed_area">
    <div class="heading_tag">Latest Photos</div>
    <table width="100%" border="0">
        <tr>
            <?php
            $LatestPhotoArray = appController::getAllPhotos();
            if(is_array($LatestPhotoArray) && count($LatestPhotoArray) > 0)
            {
                $counter = 1;
                foreach($LatestPhotoArray as $photoKey=>$photoValue)
                {
                    if($counter <= 5)
                    {
                ?>
                    <td align="center" valign="top"><img name="" src="<?=__ADMIN_UPLOAD_URL?>photos/<?=$photoValue['photo_id']?>.jpg" width="132"
                                                         height="112" alt=""/><br>
                    <a href="<?=__SITE_URL?>pages/viewphoto/photo_id:<?=$this->registry->security->encryptData($photoValue['photo_id'])?>"><?=ucwords($photoValue['photo_tagline'])?></a>
                    </td>

                    <?php
                    }
                    $counter++;
                }
            }
            ?>
    </table>
</div>