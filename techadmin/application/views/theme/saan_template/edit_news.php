<?php require_once('header.php'); ?>
<script language="javascript" type="text/javascript"
        src="<?php echo __EXTERNAL_URL; ?>tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
    tinyMCE.init({
        theme:"advanced",
        mode:"exact",
        elements:"news_description",
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
    <h1>Welcome Administrator...<span style="float:right">Edit News category Page</span></h1>
    <!-- Headings -->
    <div>
      <?=General::getMessage()?>
    </div>
    <form name="form1" method="post" action="<?=__SITE_URL?>adminhome/edit_news">
      <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="margin-left:60px;">
        <tr>
          <td><div class="help_text" style="color:#FF3300;"></div></td>
        </tr>
        <tr>
          <td>News Category:</td>
        </tr>
        <tr>
          <td>
          <?php
		  ?><select name="news_category_id" id="news_category_id">
              <option value="">Select News Category</option>
              <?php
			  if(is_array($CategoryListArray) && count($CategoryListArray) > 0)
			  {
			  	foreach($CategoryListArray as $catKey=>$catValue)
				{
				?>
                	<option value="<?php echo $catValue['news_category_id']; ?>" <?php echo ($PostRetain['news_category_id'] == $catValue['news_category_id'])?"selected":"" ?>><?php echo $catValue['news_category_name']; ?></option>
                <?php	
				}
			  }
			  ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>News Content Type:</td>
        </tr>
        <tr>
          <td><select name="news_content_type" id="news_content_type">
              <option value="">Select Content Type</option>
              <option value="video" <?php echo ($PostRetain['news_content_type'] == "video")?"selected":"" ?>>Video</option>
              <option value="photo" <?php echo ($PostRetain['news_content_type'] == "photo")?"selected":"" ?>>Photo</option>
              <option value="both" <?php echo ($PostRetain['news_content_type'] == "both")?"selected":"" ?>>Both</option>
              <option value="none" <?php echo ($PostRetain['news_content_type'] == "none")?"selected":"" ?>>None</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>News Subject:</td>
        </tr>
        <tr>
          <td><textarea name="news_subject" id="news_subject"><?=$PostRetain['news_subject']?>
</textarea></td>
        </tr>
        <tr>
          <td>News Description:</td>
        </tr>
        <tr>
          <td><textarea name="news_description" id="news_description"><?=$PostRetain['news_description']?>
</textarea></td>
        </tr>
        <tr>
          <td>News Meta Title:</td>
        </tr>
        <tr>
          <td><textarea name="news_meta_title" id="news_meta_title"><?=$PostRetain['news_meta_title']?>
</textarea></td>
        </tr>
        <tr>
          <td>News Meta Description:</td>
        </tr>
        <tr>
          <td><textarea name="news_meta_description" id="news_meta_description"><?=$PostRetain['news_meta_description']?>
</textarea></td>
        </tr>
        <tr>
          <td>News Meta Keywords:</td>
        </tr>
        <tr>
          <td><textarea name="news_meta_keyword" id="news_meta_keyword"><?=$PostRetain['news_meta_keyword']?>
</textarea></td>
        </tr>
        <tr>
          <td>Allow Social Sharing:</td>
        </tr>
        <tr>
          <td>
          	<select name="is_social_allowed" id="is_social_allowed">
            	<option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
          </td>
        </tr>
        
        <tr>
          <td><input type="submit" name="btnSubmit" id="btnSubmit" value="Save Changes">
          <input type="hidden" name="news_id" id="news_id" value="<?=$NewsIdValue?>">
          </td>
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
</div>
<!-- /main -->
</body>
</html>