<?php require_once('header.php'); ?>
</head>
<body>
<?php require_once('header_content.php'); ?>
<!-- /header -->
<hr class="noscreen"/>

<!-- Columns -->
<div id="cols" class="box">
    <!-- Aside (Left Column) -->
    <div id="aside" class="box">
        <div class="padding box">
            <!-- Logo (Max. width = 200px) -->
            <p id="logo"><a href="#"><img src="<?=__TEMPLATE_URL?>images/logo.png" alt="Our logo"
                                          title="Visit Site"/></a></p>

            <!-- Search -->
            <?php //require_once('advanced_search.php'); ?>

            <!-- Create a new project -->

        </div>
        <!-- /padding -->

        <?php require_once('left_menu.php'); ?>
    </div>
    <!-- /aside -->
    <hr class="noscreen"/>
    <!-- Content (Right Column) -->
    <div id="content" class="box">
        <h1>Welcome Administrator...<span style="float:right">View Banner Photos Page</span></h1>
        <!-- Headings -->
        <div><?=General::getMessage()?></div>
        <table width="100%">
        		<tr>
                    <td align="right"><a href="<?=__SITE_URL?>adminhome/add_banner_photos">Add Banner Photos</a> </td>
                </tr>
            <?php

            if (count($BannerPhotoListArray['result_set']) > 0) {
                ?>
                
                <tr>
                    <td align="center">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <th width="5%">Sl No.</th>
                                <th width="15%">Banner Photo</th>
                                <th width="30%">Tagline</th>
								<th width="30%">Description</th>
                                <th width="9%">Status</th>
                                <th width="9%" align="center">Actions</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
								<td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <?php
                            $i = 1;
                            foreach ($BannerPhotoListArray['result_set'] as $bannerPhotoArray) {
                                ?>
                                <tr>
                                    <td align="left" valign="top"><?=$i?></td>
                                    <td align="left" valign="top"><img src="<?=__ADMIN_UPLOAD_URL . 'banner_photos/' . $bannerPhotoArray['banner_photo_id'] . '.jpg'?>" width="50" height="50"> </td>
                                    <td align="left" valign="top"><?=$bannerPhotoArray['banner_photo_tagline']?></td>
									<td align="left" valign="top"><?=$bannerPhotoArray['banner_photo_description']?></td>
                                    <td align="left" valign="top"><?=$bannerPhotoArray['banner_photo_status']?></td>
                                    <td align="left" valign="top">
                                        <a title="Delete Banner Photo"
                                           href="<?=__SITE_URL?>adminhome/deleteBannerPhoto/banner_photo_id:<?=$this->registry->security->encryptData($bannerPhotoArray['banner_photo_id'])?>"
                                           onClick="return confirm('Do You really Want To Delete This?');">
                                            <img src="<?=__TEMPLATE_URL . "images/del.png"?>">
                                        </a>
                                        <?php
                                        if ($bannerPhotoArray['banner_photo_status'] == 'active') {
                                            ?>
                                            <a title="Deactivate Banner Photo"
                                               onClick="return confirm('Do you want to change the status');"
                                               href="<?=__SITE_URL?>adminhome/deactivateBannerPhoto/banner_photo_id:<?=$this->registry->security->encryptData($bannerPhotoArray['banner_photo_id'])?>">
                                                <img src="<?=__TEMPLATE_URL . "images/ico-done.gif" ?>">
                                            </a>
                                            <?php
                                        } else {
                                            ?>
                                            <a title="Activate Banner Photo"
                                               onClick="return confirm('Do you want to change the status');"
                                               href="<?=__SITE_URL?>adminhome/activateBannerPhoto/banner_photo_id:<?=$this->registry->security->encryptData($bannerPhotoArray['banner_photo_id'])?>">
                                                <img src="<?=__TEMPLATE_URL . "images/ico-warning.gif" ?>">
                                            </a>
                                            <?php
                                        }
                                        ?>
                                        <a title="Edit Banner Photo"
                                           href="<?=__SITE_URL?>adminhome/edit_banner_photos/banner_photo_id:<?=$this->registry->security->encryptData($bannerPhotoArray['banner_photo_id'])?>">
                                            <img src="<?=__TEMPLATE_URL . "images/edit.png"?>">
                                        </a>
                                    </td>
                                </tr>
                                    <tr>
                                        <td colspan="6"><hr></td>
                                    </tr>
                                <? $i++;
                            }?>

                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        $paginationContent = General::getFullNavigation($BannerPhotoListArray['total_rows'], $BannerPhotoListArray['total_pages'], $PresentPage, "adminhome/view_banner_photos");
                        echo $paginationContent;
                        ?>
                    </td>
                </tr>
                <?php
            } else {
                echo "<div class='no_records'>No Records Available</div>";
            }
            ?>

        </table>
    </div>
</div>
<!-- /content -->
</div>
<!-- /cols -->

<hr class="noscreen"/>

<!-- Footer -->
<?php require_once("footer.php"); ?>
<!-- /footer -->

</div> <!-- /main -->

</body>
</html>