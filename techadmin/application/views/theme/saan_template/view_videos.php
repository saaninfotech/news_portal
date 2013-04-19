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
        <h1>Welcome Administrator...<span style="float:right">View Videos Page</span></h1>
        <!-- Headings -->
        <div><?=General::getMessage()?></div>
        <table width="100%">
        		<tr>
                    <td align="right"><a href="<?=__SITE_URL?>adminhome/add_videos">Add Videos</a> </td>
                </tr>
            <?php

            if (count($VideoListArray['result_set']) > 0) {
                ?>
                
                <tr>
                    <td align="center">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <th width="5%">Sl No.</th>
                                <th width="15%">Video</th>
                                <th width="37%">Tagline</th>
                                <th width="9%">Status</th>
                                <th width="9%" align="center">Actions</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <?php
                            $i = 1;
                            foreach ($VideoListArray['result_set'] as $videoArray) {
                                ?>
                                <tr>
                                    <td align="left" valign="top"><?=$i?></td>
                                    <td align="left" valign="top"><img src="<?=__ADMIN_UPLOAD_URL . 'videos/' . $videoArray['video_id'] . '.jpg'?>" width="50" height="50"> </td>
                                    <td align="left" valign="top"><?=$videoArray['video_tagline']?></td>
                                    <td align="left" valign="top"><?=$videoArray['video_status']?></td>
                                    <td align="left" valign="top">
                                        <a title="Delete Video"
                                           href="<?=__SITE_URL?>adminhome/deleteVideo/video_id:<?=$this->registry->security->encryptData($videoArray['video_id'])?>"
                                           onClick="return confirm('Do You really Want To Delete This?');">
                                            <img src="<?=__TEMPLATE_URL . "images/del.png"?>">
                                        </a>
                                        <?php
                                        if ($videoArray['video_status'] == 'active') {
                                            ?>
                                            <a title="Deactivate Video"
                                               onClick="return confirm('Do you want to change the status');"
                                               href="<?=__SITE_URL?>adminhome/deactivateVideo/video_id:<?=$this->registry->security->encryptData($videoArray['video_id'])?>">
                                                <img src="<?=__TEMPLATE_URL . "images/ico-done.gif" ?>">
                                            </a>
                                            <?php
                                        } else {
                                            ?>
                                            <a title="Activate Video"
                                               onClick="return confirm('Do you want to change the status');"
                                               href="<?=__SITE_URL?>adminhome/activateVideo/video_id:<?=$this->registry->security->encryptData($videoArray['video_id'])?>">
                                                <img src="<?=__TEMPLATE_URL . "images/ico-warning.gif" ?>">
                                            </a>
                                            <?php
                                        }
                                        ?>
                                        <a title="Edit Video"
                                           href="<?=__SITE_URL?>adminhome/edit_videos/video_id:<?=$this->registry->security->encryptData($videoArray['video_id'])?>">
                                            <img src="<?=__TEMPLATE_URL . "images/edit.png"?>">
                                        </a>
                                    </td>
                                </tr>
                                    <tr>
                                        <td colspan="5"><hr></td>
                                    </tr>
                                <? $i++;
                            }?>

                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        $paginationContent = General::getFullNavigation($VideoListArray['total_rows'], $VideoListArray['total_pages'], $PresentPage, "adminhome/view_videos");
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