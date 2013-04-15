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
        <h1>Welcome Administrator...<span style="float:right">View Email Templates Page</span></h1>
        <!-- Headings -->
        <div><?=General::getMessage()?></div>
        <table width="100%">
            <?php
            if (count($TemplateListArray['result_set']) > 0) {
                ?>
                <tr>
                    <td align="right"><!--<a href="<?=__SITE_URL?>adminhome/add_category">Add New Expert</a> --></td>
                </tr>
                <tr>
                    <td align="center">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <th width="3%">S</th>
                                <th width="5%">Sl No.</th>
                                <th width="15%">Template Name</th>
                                <th width="22%">Subject</th>
                                <th width="37%">Description</th>
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
                            foreach ($TemplateListArray['result_set'] as $templateArray) {
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="template_id[]"
                                               value="<?=$templateArray['email_template_id']?>"
                                               style="width:20px;"></td>
                                    <td><?=$i?></td>
                                    <td><?=$templateArray['email_template_name']?></td>
                                    <td><?=$templateArray['email_template_subject']?></td>
                                    <td><?=$templateArray['email_template_description']?></td>
                                    <td><?=$templateArray['email_template_status']?></td>
                                    <td>
                                        <a title="Delete Template"
                                           href="<?=__SITE_URL?>adminhome/deleteTemplate/template_id:<?=$this->registry->security->encryptData($templateArray['email_template_id'])?>"
                                           onClick="return confirm('Do You really Want To Delete This?');">
                                            <img src="<?=__TEMPLATE_URL . "images/del.png"?>">
                                        </a>
                                        <?php
                                        if ($templateArray['email_template_status'] == 'active') {
                                            ?>
                                            <a title="Deactivate Template"
                                               onClick="return confirm('Do you want to change the status');"
                                               href="<?=__SITE_URL?>adminhome/deactivateTemplate/template_id:<?=$this->registry->security->encryptData($templateArray['email_template_id'])?>">
                                                <img src="<?=__TEMPLATE_URL . "images/ico-done.gif" ?>">
                                            </a>
                                            <?php
                                        } else {
                                            ?>
                                            <a title="Activate Template"
                                               onClick="return confirm('Do you want to change the status');"
                                               href="<?=__SITE_URL?>adminhome/activateTemplate/template_id:<?=$this->registry->security->encryptData($templateArray['email_template_id'])?>">
                                                <img src="<?=__TEMPLATE_URL . "images/ico-warning.gif" ?>">
                                            </a>
                                            <?php
                                        }
                                        ?>
                                        <a title="Edit Template"
                                           href="<?=__SITE_URL?>adminhome/editTemplate/template_id:<?=$this->registry->security->encryptData($templateArray['email_template_id'])?>">
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
                        $paginationContent = General::getFullNavigation($TemplateListArray['total_rows'], $TemplateListArray['total_pages'], $PresentPage, "adminhome/view_templates");
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