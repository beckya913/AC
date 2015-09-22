<?php include("session.php"); //Check login or not ?>
<!DOCTYPE html>
<html>
<head>
	<title>更新客戶名稱</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/uikit.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/custom.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/uikit.min.js"></script>
    <!-- Finish installation -->
    <script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
</head>
<?php foreach($results_all as $row){
			
			$id= $row->id;
			$name= $row->name;
			$creator= $row->creator;
		} ?>
<body>
<?php include("header.php"); //表頭 ?>
<div id="main" class="uk-grid">
	<div class="uk-width-2-10">
		<?php include("navigation.php"); //左側導覽列 ?>
	</div>
	<div class="uk-width-8-10 form_margin">
		<h2 class="uk-text-primary">更新客戶名稱</h2>
		<hr>
		<?php $attributes = array('class' => 'uk-form', 'id' => 'form_update');
			  echo form_open('sys_sn/action_update_client', $attributes);  ?>
			<table class="uk-table">
				<tbody>
					<tr>
						<td width="100">客戶名稱</td>
						<td colspan="2"><input name="name" value="<?php echo $name; ?>"></td>
					</tr>
				</tbody>
			</table>
			<input type="submit" name="submit" class="uk-button" value="更新">
			<input type="button" value="取消/返回列表" class="uk-button" onclick="location.href='<?php echo base_url(); ?>sys_sn/create_client';" />
			<input type="hidden" name="creator" value="<?php echo $creator; ?>">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
		<?php echo form_close(); ?>
	</div>
</div>
<?php include("footer.php"); //表尾 ?>
</body>
</html>