<?php require_once('header.php'); ?>
<script language="javascript" type="text/javascript"
        src="<?php echo __EXTERNAL_URL; ?>tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
    tinyMCE.init({
        theme:"advanced",
        mode:"exact",
        elements:"template_content",
        height:"450px",
        width:"700px"
    });

</script>
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
        <h1>Welcome Administrator...<span style="float:right">Edit Template Page</span></h1>
        <!-- Headings -->
        <div><?=General::getMessage()?></div>


        <form name="form1" method="post" action="">
            <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="margin-left:60px;">
                <tr>
                    <td>
                        <div class="help_text" style="color:#FF3300;">* Note: Dont Change anything inside {}. For Eg:-
                            {EXPERT_NAME}.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Template Name:</td>
                </tr>
                <tr>
                    <td><input name="template_name" type="text" id="template_name" size="50"
                               value="<?=$TemplateArray['email_template_name']?>" readonly></td>
                </tr>
                <tr>
                    <td>Template Subject:</td>
                </tr>
                <tr>
                    <td><input name="template_subject" type="text" id="template_subject" size="50"
                               value="<?=$TemplateArray['email_template_subject']?>"></td>
                </tr>
                <tr>
                    <td>Template Description:</td>
                </tr>
                <tr>
                    <td><textarea name="template_description" id="template_description" cols="45"
                                  rows="5"><?=$TemplateArray['email_template_description']?></textarea></td>
                </tr>
                <tr>
                    <td>Template Status:</td>
                </tr>
                <tr>
                    <td><select name="template_status" id="template_status">
                        <option value="active" <?=($TemplateArray['email_template_status'] == "active") ? "selected" : ""?>>
                            Active
                        </option>
                        <option value="inactive" <?=($TemplateArray['email_template_status'] == "inactive") ? "selected" : ""?>>
                            Inactive
                        </option>
                    </select></td>
                </tr>
                <tr>
                    <td>Template Content:</td>
                </tr>
                <tr>
                    <td><textarea id="template_content"
                                  name="template_content"><?=stripslashes($TemplateArray['email_template_content'])?></textarea>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" name="btnSubmit" id="btnSubmit" value="Save Changes"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </form>
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