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
        <h1>Welcome Administrator...<span style="float:right">Edit Banner Photos Page</span></h1>
        <!-- Headings -->
        <div><?=General::getMessage()?></div>


        <form action="" method="post" enctype="multipart/form-data" name="form1">
      <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="margin-left:60px;">
                <tr>
                    <td>
                        <div class="help_text" style="color:#FF3300;"></div>                    </td>
                </tr>
                <tr>
                    <td>Choose Photo:</td>
                </tr>
                <tr>
                    <td><input type="file" name="file" id="file">
					<br>Present Photo: <br><img src="<?=__ADMIN_UPLOAD_URL . "banner_photos/" . $BannerPhotoArray[0]['banner_photo_id']?>.jpg" width="60" height="60">
					</td>
                </tr>
                <tr>
                    <td>Banner Photo Tagline:</td>
              </tr>
                <tr>
                    <td><textarea name="banner_photo_tagline" id="banner_photo_tagline"><?=$BannerPhotoArray[0]['banner_photo_tagline']?></textarea></td>
                </tr>
                <tr>
                    <td>Banner Photo Description:</td>
              </tr>
                <tr>
                    <td><textarea name="banner_photo_description" id="banner_photo_description"><?=$BannerPhotoArray[0]['banner_photo_description']?></textarea></td>
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