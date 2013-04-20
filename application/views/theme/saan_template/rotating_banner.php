<div class="box_left">
    <div class="slider_content box_content">
        <div id="jslidernews2" class="lof-slidecontent" style="width:100%; height:300px;">
            <div class="preload">
                <div></div>
            </div>
            <div class="button-previous">Previous</div>
            <!-- MAIN CONTENT -->
            <div class="main-slider-content" style="width:684px; height:300px;">
                <ul class="sliders-wrap-inner">
                    <?php
                    $BannerPhotoArray = appController::getBannerPhoto();
                    if(is_array($BannerPhotoArray) && count($BannerPhotoArray) > 0)
                    {
                        foreach($BannerPhotoArray as $bannerKey=>$bannerArray)
                        {
                            ?>
                            <li><img src="<?=__ADMIN_UPLOAD_URL?>banner_photos/<?=$bannerArray['banner_photo_id']?>.jpg" title="<?=$bannerArray['banner_photo_tagline']?>" width="100%"
                                     height="340">

                                <div class="slider-description">
                                    <div class="slider-meta"><a target="_parent" title="<?=$bannerArray['banner_photo_tagline']?>"
                                                                href="<?=__SITE_URL?>pages/view_banner_photo/banner_photo_id:<?=$this->registry->security->encryptData($bannerArray['banner_photo_id'])?>">/ <?=$bannerArray['banner_photo_tagline']?> /</a> <i> —
                                        <?=date("d M Y H:i A")?></i></div>
                                    <h4><?=ucwords($bannerArray['banner_photo_tagline'])?></h4>

                                    <p><?=$bannerArray['banner_photo_description']?>... <a class="readmore"
                                                                                                          href="<?=__SITE_URL?>pages/view_banner_photo/banner_photo_id:<?=$this->registry->security->encryptData($bannerArray['banner_photo_id'])?>">Read
                                            more </a></p>
                                </div>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <!-- END MAIN CONTENT -->
            <!-- NAVIGATOR -->
            <div class="navigator-content">
                <div class="navigator-wrapper">
                    <ul class="navigator-wrap-inner">
                        <?php
                        if(is_array($BannerPhotoArray) && count($BannerPhotoArray) > 0)
                        {
                            foreach($BannerPhotoArray as $bannerKey=>$bannerArray)
                            {
                            ?>
                                <li>
                                    <div><img src="<?=__ADMIN_UPLOAD_URL?>banner_photos/<?=$bannerArray['banner_photo_id']?>.jpg" width="200" height="100"/>

                                        <h3></h3>
                                        <span></span>
                                    </div>
                                </li>
                            <?php
                            }
                        }
                        ?>

                    </ul>
                </div>
            </div>
            <!----------------- END OF NAVIGATOR --------------------->
            <div class="button-next">Next</div>
            <!-- END OF BUTTON PLAY-STOP -->
        </div>
    </div>
</div>
<div class="clear"></div>
