<?php include("session.php"); //Check login or not ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>NI儀器管理系統 ::: 首頁</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/uikit.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/custom.css" />
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/uikit.min.js"></script>
</head>
<body>
	<?php include("header_home.php"); //表頭 ?>
	 <div id="main_dashboard" class="uk-grid">
    	<div class="uk-width-1-1">
			<br><br>
			<center><table id="dashboard" class="uk-table">
				<tbody>
					<tr>
						<td><img src="<?php echo base_url(); ?>images/icon_global_info.png"></td>
						<td><img src="<?php echo base_url(); ?>images/icon_sn.png"></td>
						<td><img src="<?php echo base_url(); ?>images/icon_rma.png"></td>
						<td><img src="<?php echo base_url(); ?>images/icon_sw.png"></td>
						<td><img src="<?php echo base_url(); ?>images/icon_search.png"></td>
						<td><img src="<?php echo base_url(); ?>images/icon_logout.png"></td>
					</tr>
					<tr>
						<td>
							<h3>基本資料</a></h3>
							<ul class="uk-list uk-list-line">
								<li><a href="<?php echo base_url(); ?>sys_sn/create_client" >新增客戶</a></li>
								<li><a href="<?php echo base_url(); ?>sys_sn/create_item" >新增產品</a></li>
								<li><a href="<?php echo base_url(); ?>sys_sw/create_spts" >新增SPTS</a></li>
							</ul>
						</td>
						<td>
							<h3>序號管理</a></h3>
							<ul class="uk-list uk-list-line">
								<li><a href="<?php echo base_url(); ?>sys_sn/create_sn" >新增記錄</a></li>
								<li><a href="<?php echo base_url(); ?>sys_sn/view" >檢視售出記錄</a></li>
								<li><a href="<?php echo base_url(); ?>sys_sn/view" >檢視借出記錄</a></li>
								<li><a href="<?php echo base_url(); ?>sys_sn/view" >檢視借入記錄</a></li>
							</ul>
						</td>
						<td>
							<h3>RMA 管理</h3>
							<ul class="uk-list uk-list-line">
								<li><a href="<?php echo base_url(); ?>sys_rma/create" >新增記錄</a></li>
								<li><a href="<?php echo base_url(); ?>sys_rma/view" >更新記錄</a></li>
							</ul>
						</td>
						<td>
							<h3>軟體管理</h3>
							<ul class="uk-list uk-list-line">
								<li><a href="<?php echo base_url(); ?>sys_sw/create" >新增記錄</a></li>
								<li><a href="<?php echo base_url(); ?>sys_sw/view" >更新記錄</a></li>
							</ul>
						</td>
						<td><a href="<?php echo base_url(); ?>portal/view">搜尋</a></td>
						<td><a href="<?php echo base_url(); ?>portal/logout">登出</a></td>
					</tr>
				</tbody>
			</table></center>
		</div>
	</div>	
	<hr>
	<table width="100%" border="0" cellpadding="0" cellspacing="10">
		<tbody>
			<tr>
				<td class="uk-text-center">
					<p>Copyright@Global Instrument Technology INC. | Version:1.0 | Released on 2015.08 | Created by Becky Tsai </p>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>