<?php include("session.php"); //Check login or not ?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/uikit.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/custom.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/uikit.min.js"></script>
    <!-- Finish installation -->
    <script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
</head>
<body>
<?php include("header.php"); //表頭 ?>
<div id="main" class="uk-grid">
	<div class="uk-width-2-10">
		<?php include("navigation.php"); //左側導覽列 ?>
	</div>
	<div class="uk-width-8-10 form_margin">
		<form action="create_sn_2" method="POST" enctype="" class="uk-form">
			<h2 class="uk-text-primary">新增序號記錄</h2>
			<hr>
			<table class="uk-table" cellpadding="0" cellspacing="0" border="0" width="200">
				<tbody>
					<tr>
						<td width="70">客戶名稱</td>
						<td width="100">
							<select name="client" value="">
							<?php ////取得客戶列表
							$query = $this->db->get('global_client');
							foreach ($query->result() as $row)
							{ ?>
								<option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>  
							<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>序號</td><td><input name='serial_num' value=''></td>
					</tr>
					<tr>
						<td>項目名稱</td>
						<td>
							<select name="item" value="">
							<?php ////取得客戶列表
							$query = $this->db->get('global_item');
							foreach ($query->result() as $row)
							{ ?>
								<option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>  
							<?php } ?>
							</select>
						</td>
					</tr>
					<tr><td colspan="2"><input type="submit" name="submit" class="uk-button" value="下一步"></td></tr>
				</tbody>
			</table>
		</form>
	</div>
</div>
<?php include("footer.php"); //表尾 ?>
</body>
</html>