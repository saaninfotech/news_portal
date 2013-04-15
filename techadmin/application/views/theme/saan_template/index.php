<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?=$Title?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo __TEMPLATE_URL; ?>styles/style.css"/>
    <script language="JavaScript" type="text/javascript"
            src="<?php echo __TEMPLATE_URL; ?>scripts/jquery-1.4.2.min.js"></script>
    <script src="<?php echo __TEMPLATE_URL; ?>scripts/jqueryLogin.js" type="text/javascript"></script>

    <style type="text/css">
        <!--
        .style2 {
            font-size: 24px;
            font-weight: bold;
            font-family: Verdana, Arial, Helvetica, sans-serif;
        }

        .style3 {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        .style4 {
            font-size: 10px;
            font-family: Verdana, Arial, Helvetica, sans-serif;
        }

        -->
    </style>
</head>

<body class="adminBody">
<div class="containerDiv">
    <center>
        <div class="loginDiv">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <th scope="row">&nbsp;</th>
                </tr>
                <tr>
                    <th height="75" scope="row"><span class="style2"><u>Administrator Login Section</u></span></th>
                </tr>
                <tr>
                    <th align="center" scope="row">
                        <form id="formLogin" name="formLogin" method="post" action="<?=__SITE_URL?>index/login">
                            <table width="60%" border="0" cellspacing="1" cellpadding="0" align="center">
                                <tr>
                                    <th align="left" scope="row"><span class="style3">Username:</span></th>
                                </tr>
                                <tr>
                                    <th align="left" scope="row"><input type="text" name="txtUsername" id="txtUsername"
                                                                        class="textboxStyle"/>

                                        <div id="errorUsername" class="errorMsg"></div>
                                    </th>
                                </tr>
                                <tr>
                                    <th align="left" class="style3" scope="row">Password:</th>
                                </tr>
                                <tr>
                                    <th align="left" scope="row"><input type="password" name="txtPassword"
                                                                        id="txtPassword" class="textboxStyle"/>

                                        <div id="errorPassword" class="errorMsg"></div>
                                        <br/>

                                        <div class="forgotPassword"><a href="#">Problem? Can I Assist You?</a></div>
                                    </th>
                                </tr>
                                <tr>
                                    <th align="left" scope="row">&nbsp;</th>
                                </tr>
                                <tr>
                                    <th align="left" scope="row">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <th width="27%" align="left" scope="row"><input type="button"
                                                                                                name="btnSubmit"
                                                                                                id="btnSubmit" value=" "
                                                                                                class="loginButton"/>
                                                </th>
                                                <th width="73%" align="left">&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><br/>

                                                    <div id="errorLogin" class="errorMsg" <?=$ErrorLogin?>>
                                                        Invalid Login Credentials
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </th>
                                </tr>
                                <tr>
                                    <th align="left" scope="row">
                                        <div class="poweredText">Powered By:Saan Infotech</div>
                                    </th>
                                </tr>
                            </table>
                        </form>
                    </th>
                </tr>
            </table>
        </div>
    </center>
</div>
</body>
</html>