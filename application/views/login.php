<!DOCTYPE html>
<html>
<head>
	<title>NI 儀器管理系統:::登入</title>
	<!-- install UIKit powered by Yootheme -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/uikit.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/custom.css" />
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/uikit.min.js"></script>
    <!-- Finish installation -->
</head>
<body>
    <body class="uk-height-1-1">
        <div id="top">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td><img src="<?php echo base_url(); ?>images/logo-tw_black.png" width="250" height="48" /></td>
                        <td><h1>NI 儀器管理系統</h1></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="uk-vertical-align uk-text-center uk-height-1-1" id="login">
            <div class="uk-vertical-align-middle" style="width: 250px;">
                <?php
        $attributes = array('class' => 'uk-panel uk-panel-box uk-form', 'id' => 'form_login');
        echo form_open('portal/checklogin', $attributes);  ?>
                    <div class="uk-form-row">
                        <?php $data = array('name'=> 'username','placeholder'=> '帳號','type'=> 'text','class'=> 'uk-width-1-1 uk-form-large'); 
                        echo form_input($data); ?>
                    </div>
                    <div class="uk-form-row">
                        <?php $data = array('name'=> 'password','placeholder'=> '密碼','type'=> 'password','class'=> 'uk-width-1-1 uk-form-large'); 
                        echo form_input($data); ?>
                    </div>
                    <div class="uk-form-row">
                        <?php $data = array('type'=> 'submit','class'=> 'uk-width-1-1 uk-button uk-button-primary uk-button-large','value'=> '登入'); 
                        echo form_input($data); ?>
                    </div> 
                <?php echo form_close(); ?>

            </div>
        </div>
</body>
</html>