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
        <h1>Welcome Administrator...<span style="float:right">View News Details Page</span></h1>
        <!-- Headings -->
        <div><?=General::getMessage()?></div>
        <table width="100%">
            
                <tr>
                    <td align="right"><a href="<?=__SITE_URL?>adminhome/add_news">Add News</a> </td>
                </tr>
                <?php

            if (count($NewsListArray['result_set']) > 0) {
                ?>
                <tr>
                    <td align="center">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <th width="5%">Sl No.</th>
                                <th width="12%">Category Name</th>
                                <th width="10%">Content Type</th>
                                <!-- <th width="12%">Upload Content</th> -->
                                <th width="40%">News Title</th>
                                <th width="10%">News Status</th>
                                <th width="" align="center">Actions</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <!-- <td></td> -->
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <?php
                            $i = 1;
                            foreach ($NewsListArray['result_set'] as $newsArray) {
                                ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=$newsArray['news_category_name']?></td>
                                    <td><?=$newsArray['news_content_type']?></td>
                                    <!-- <td>
                                    	<a href="<?=__SITE_URL?>adminhome/upload_video/news_id:<?=$this->registry->security->encryptData($newsArray['news_id'])?>">Upload Video</a>
                                        <a href="<?=__SITE_URL?>adminhome/upload_photo/news_id:<?=$this->registry->security->encryptData($newsArray['news_id'])?>">Upload Photo</a>
                                    </td> -->
                                    <td><?=$newsArray['news_subject']?></td>
                                    <td><?=$newsArray['news_status']?></td>
                                    <td>
                                        <a title="Delete News"
                                           href="<?=__SITE_URL?>adminhome/deleteNews/news_id:<?=$this->registry->security->encryptData($newsArray['news_id'])?>"
                                           onClick="return confirm('Do You really Want To Delete This?');">
                                            <img src="<?=__TEMPLATE_URL . "images/del.png"?>">
                                        </a>
                                        <?php
                                        if ($newsArray['news_status'] == 'active') {
                                            ?>
                                            <a title="Deactivate News"
                                               onClick="return confirm('Do you want to change the status');"
                                               href="<?=__SITE_URL?>adminhome/deactivateNews/news_id:<?=$this->registry->security->encryptData($newsArray['news_id'])?>">
                                                <img src="<?=__TEMPLATE_URL . "images/ico-done.gif" ?>">
                                            </a>
                                            <?php
                                        } else {
                                            ?>
                                            <a title="Activate News"
                                               onClick="return confirm('Do you want to change the status');"
                                               href="<?=__SITE_URL?>adminhome/activateNews/news_id:<?=$this->registry->security->encryptData($newsArray['news_id'])?>">
                                                <img src="<?=__TEMPLATE_URL . "images/ico-warning.gif" ?>">
                                            </a>
                                            <?php
                                        }
                                        ?>
                                        <a title="Edit News"
                                           href="<?=__SITE_URL?>adminhome/edit_news/news_id:<?=$this->registry->security->encryptData($newsArray['news_id'])?>">
                                            <img src="<?=__TEMPLATE_URL . "images/edit.png"?>">
                                        </a>
                                    </td>
                                </tr>
                                <? $i++;
                            }?>

                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        $paginationContent = General::getFullNavigation($NewsArrayList['total_rows'], $NewsArrayList['total_pages'], $PresentPage, "adminhome/view_news");
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