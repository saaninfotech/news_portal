<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="content-language" content="en"/>
    <meta name="robots" content="noindex,nofollow"/>
    <link rel="stylesheet" media="screen,projection" type="text/css"
          href="<?php echo __TEMPLATE_URL; ?>styles/reset.css"/>
    <!-- RESET -->
    <link rel="stylesheet" media="screen,projection" type="text/css"
          href="<?php echo __TEMPLATE_URL; ?>styles/main.css"/>
    <!-- MAIN STYLE SHEET -->
    <link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo __TEMPLATE_URL; ?>styles/2col.css"
          title="2col"/>
    <!-- DEFAULT: 2 COLUMNS -->
    <link rel="alternate stylesheet" media="screen,projection" type="text/css"
          href="<?php echo __TEMPLATE_URL; ?>1col.css" title="1col"/>
    <!-- ALTERNATE: 1 COLUMN -->
    <!--[if lte IE 6]>
    <link rel="stylesheet" media="screen,projection" type="text/css"
          href="<?php echo __TEMPLATE_URL; ?>styles/main-ie6.css"/>
    <![endif]--> <!-- MSIE6 -->
    <link rel="stylesheet" media="screen,projection" type="text/css"
          href="<?php echo __TEMPLATE_URL; ?>styles/style.css"/>
    <!-- GRAPHIC THEME -->
    <link rel="stylesheet" media="screen,projection" type="text/css"
          href="<?php echo __TEMPLATE_URL; ?>styles/mystyle.css"/>
    <!-- WRITE YOUR CSS CODE HERE -->
    <script type="text/javascript" src="<?php echo __TEMPLATE_URL; ?>scripts/jquery.js"></script>
    <script type="text/javascript" src="<?php echo __TEMPLATE_URL; ?>scripts/switcher.js"></script>
    <script type="text/javascript" src="<?php echo __TEMPLATE_URL; ?>scripts/toggle.js"></script>
    <script type="text/javascript" src="<?php echo __TEMPLATE_URL; ?>scripts/ui.core.js"></script>
    <script type="text/javascript" src="<?php echo __TEMPLATE_URL; ?>scripts/ui.tabs.js"></script>
    <script src="<?php echo __TEMPLATE_URL; ?>scripts/jquery.uniform.js" type="text/javascript"
            charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".tabs > ul").tabs();
            $("input, textarea, select, button").uniform();
        });
    </script>
    <link rel="stylesheet" href="<?php echo __TEMPLATE_URL; ?>styles/uniform.default.css" type="text/css"
          media="screen">
    <title><?=$Title?>></title>
    <style type="text/css">
        input, textarea, select {
            background: url("<?=__TEMPLATE_URL?>images/bg-input.png") repeat-x scroll 0 0 transparent;
            border-color: #AAAAAA #CCCCCC #CCCCCC #AAAAAA;
            border-radius: 3px 3px 3px 3px;
            border-style: solid;
            border-width: 1px;
            color: #777777;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 12px;
            font-weight: normal;
            outline: 0 none;
            padding: 3px;
            width: 250px;
            font-weight: bold;
            height: auto;
            letter-spacing: 1px;

            padding-left: 2px;
            padding-right: 15px;
            padding-top: 8px;
            text-transform: uppercase;
        }
    </style>
