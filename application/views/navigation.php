<div class="uk-panel uk-panel-box" id="navi">
	<ul class="uk-nav uk-nav-side">
		<li><a href="">目前帳號： <?php echo $_SESSION['username']; ?></a></li>
		<li class="uk-nav-header">基本資料</li>
		<li><a href="<?php echo base_url(); ?>sys_sn/create_client">新增客戶</a></li>
		<li><a href="<?php echo base_url(); ?>sys_sn/create_item">新增產品</a></li>
		<li><a href="<?php echo base_url(); ?>sys_sw/create_spts">新增SPTS</a></li>
		<li class="uk-nav-divider"></li>
		<li class="uk-nav-header">序號管理</li>
		<li><a href="<?php echo base_url(); ?>sys_sn/create_sn">新增記錄</a></li>
		<li><a href="<?php echo base_url(); ?>sys_sn/view">檢視/更新售出記錄</a></li>
		<li><a href="<?php echo base_url(); ?>sys_sn/view_lend">檢視/更新借出記錄</a></li>
		<li><a href="<?php echo base_url(); ?>sys_sn/view_borrow">檢視/更新借入記錄</a></li>
		<li class="uk-nav-divider"></li>
		<li class="uk-nav-header">RMA 管理</li>
		<li><a href="<?php echo base_url(); ?>sys_rma/create">新增記錄</a></li>
		<li><a href="<?php echo base_url(); ?>sys_rma/view">檢視/更新記錄</a></li>
		<li class="uk-nav-divider"></li>
		<li class="uk-nav-header">軟體管理</li>
		<li><a href="<?php echo base_url(); ?>sys_sw/create">新增記錄</a></li>
		<li><a href="<?php echo base_url(); ?>sys_sw/view">檢視/更新記錄</a></li>
		<li class="uk-nav-divider"></li>
		<li class="uk-nav-header">其他功能</li>
		<li><a href="<?php echo base_url(); ?>portal/view">搜尋</a></li>
		<li><a href="<?php echo base_url(); ?>portal/logout">登出</a></li>
	</ul>
</div>