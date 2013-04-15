<?php require_once('header.php'); ?>
<?php require_once('header_content.php'); ?>
<!-- /header -->
<hr class="noscreen"/>

<!-- Columns -->
<div id="cols" class="box">
    <!-- Aside (Left Column) -->
    <div id="aside" class="box">
        <div class="padding box">
            <!-- Logo (Max. width = 200px) -->
            <p id="logo"><a href="#"><img src="<?php echo __TEMPLATE_URL; ?>images/logo.jpg" alt="Our logo"
                                          title="Visit Site"/></a>
            </p>

            <!-- Search -->
            <?php require_once('advanced_search.php'); ?>

            <!-- Create a new project -->
            <p id="btn-create" class="box">
                <a href="#">
                    <span>Create a new project</span>
                </a>
            </p>
        </div>
        <!-- /padding -->

        <?php require_once('left_menu.php'); ?>
    </div>
    <!-- /aside -->
    <hr class="noscreen"/>

</div>
<!-- /cols -->

<hr class="noscreen"/>

<!-- Footer -->
<div id="footer" class="box">

    <p class="f-left">&copy; 2011 <a href="#"><?php echo "Project P3"; ?></a>, All Rights Reserved &reg;</p>

    <p class="f-right">Developed &amp; Maintained by <a
            href="<?php echo DEVELOPER_SITE; ?>"><?php echo "SAAN INFOTECH"; ?></a></p>

</div> <!-- /footer -->

</div> <!-- /main -->

</body>
</html>