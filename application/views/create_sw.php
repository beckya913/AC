<?php include("session.php"); //Check login or not ?>
<!DOCTYPE html>
<html>
<head>
	<title>NI儀器管理系統 ::: 新增軟體記錄</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/uikit.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/custom.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/uikit.min.js"></script>
    <!-- Finish installation -->
    <script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
    <script type="text/javascript">// Enable date picker
		 $(function() {
		    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
		  });	
	</script>
</head>
<body>
<?php include("header.php"); //表頭 ?>
<div id="main" class="uk-grid">
	<div class="uk-width-2-10">
		<?php include("navigation.php"); //左側導覽列 ?>
	</div>
	<div class="uk-width-8-10 form_margin">
		<h2 class="uk-text-primary">新增軟體記錄</h2>
		<hr>
		<form action="action_create_sw" method="POST" enctype="multipart/form-data" class="uk-form">
			<table class="uk-table">
				<tbody>
					<tr>
						<td width="100">客戶名稱</td>
						<td colspan="2">
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
						<td>SPTS</td>
						<td colspan="2">
							<select name="spts" value="">
							<?php ////取得客戶列表
							$query = $this->db->get('sw_spts');
							foreach ($query->result() as $row)
							{ ?>
								<option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>  
							<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>免費支援期間</td>
						<td width="100"><input name="support_date_s" value="" class="datepicker"></td>
						<td>至 <input name="support_date_e" value="" class="datepicker"></td>
					</tr>
					<tr>
						<td>費用</td>
						<td colspan="2"><input name="fee" value=""></td>
					</tr>
					<tr>
						<td>備註</td>
						<td colspan="2"><textarea rows="5" cols="70" name="remark" value=""></textarea></td>
					</tr>
				</tbody>
			</table>
			<?php 
				$query = $this->db->get_where('global_user', array('username'=>$_SESSION['username']));
				foreach ($query->result() as $row){ ?>
				<input type="hidden" name="creator" value="<?php echo $row->name; ?>">
			<?php } ?>
			<input type="submit" name="submit" class="uk-button" value="建立">
		</form>
	</div>
</div>
<?php include("footer.php"); //表尾 ?>
</body>
</html>