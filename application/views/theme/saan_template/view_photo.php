<?php require_once('header.php'); ?>
</head>
<body>
<!-- -------------------------------- Start: Top Header Section ---------------------------------- -->
<?php require_once('top_header.php'); ?>
<!-- -------------------------------- End: Top Header Section ---------------------------------- -->
<!-- -------------------------------- Start: Top Navigation Section ---------------------------------- -->
<?php require_once('top_navigation.php'); ?>
<!-- -------------------------------- End: Top Navigation Section ---------------------------------- -->
<!-- -------------------------------- Start: Body Section ---------------------------------- -->
<div class="container">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td width="71%" valign="top">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <!-- ---------------------------------- Start: Slider Banner Section ------------------------------------ -->
							<div class="tabbed_area">
                            <table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td><img src="<?=__ADMIN_UPLOAD_URL?>photos/<?=$PhotoArray[0]['photo_id']?>.jpg" width="100%"></td>
								</tr>
								<tr>
									<td><h3><?=ucwords($PhotoArray[0]['photo_tagline'])?></h3></td>
								</tr>
							</table>
							</div>
                            <!-- ---------------------------------- Start: Slider Banner Section ------------------------------------ -->
                        </td>
                    </tr>
                </table>
            </td>
            <td width="1%"></td>
            <td width="28%" valign="top">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <!-- ------------------------------- Start: Weather Section -------------------------------- -->
                            <?php require_once('weather_section.php'); ?>
                            <!-- ------------------------------- End: Weather Section -------------------------------- -->
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- ----------------------- Start: Latest Videos Section ----------------------------- -->
                            <?php require_once('latest_videos.php'); ?>
                            <!-- -------------------------- End: Latest Videos Section ----------------------------- -->

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- ------------------------------- Start: Right Tabbed Section -------------------------------- -->
                            <?php require_once('right_content.php'); ?>
                            <!-- ------------------------------- End: Right Tabbed Section -------------------------------- -->
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<div class="clear_no_image"></div>
<!-- -------------------------- Start: Footer Section --------------------------------- -->
<?php require_once('footer_section.php'); ?>
<!-- -------------------------- End: Footer Section --------------------------------- -->
<!-- -------------------------------- End: Body Section ---------------------------------- -->
</body>
</html>
