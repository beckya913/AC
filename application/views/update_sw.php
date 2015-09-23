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
<?php foreach($results_all as $row){
			
			$id= $row->id;
			$client= $row->client;
			$spts= $row->spts;
			$support_date_s= $row->support_date_s;
			$support_date_e= $row->support_date_e;
			$fee= $row->fee;
			$remark= $row->remark;
			$creator= $row->creator;
	
		} ?>
<body>
<?php include("header.php"); //表頭 ?>
<div id="main" class="uk-grid">
	<div class="uk-width-2-10">
		<?php include("navigation.php"); //左側導覽列 ?>
	</div>
	<div class="uk-width-8-10 form_margin">
		<h2 class="uk-text-primary">更新軟體記錄</h2>
		<hr>
		<?php $attributes = array('class' => 'uk-form', 'id' => 'form_update');
			  echo form_open('sys_sw/action_update', $attributes);  ?>
			<table class="uk-table">
				<tbody>
					<tr>
						<td width="100">客戶名稱</td>
						<td colspan="2"><input name="client" value="<?php echo $client; ?>" readonly></td>
					</tr>
					<tr>
						<td>SPTS</td>
						<td colspan="2"><input name="spts" value="<?php echo $spts; ?>" readonly></td>
					</tr>
					<tr>
						<td>免費支援期間</td>
						<td width="100"><input name="support_date_s" value="<?php echo $support_date_s; ?>" class="datepicker"></td>
						<td>至 <input name="support_date_e" value="<?php echo $support_date_e; ?>" class="datepicker"></td>
					</tr>
					<tr>
						<td>費用</td>
						<td colspan="2"><input name="fee" value="<?php echo $fee; ?>"></td>
					</tr>
					<tr>
						<td>備註</td>
						<td colspan="2"><textarea rows="5" cols="70" name="remark" value=""><?php echo $remark; ?></textarea></td>
					</tr>
				</tbody>
			</table>
			<input type="submit" name="submit" class="uk-button" value="更新">
			<input type="button" value="取消/返回列表" class="uk-button" onclick="location.href='<?php echo base_url(); ?>sys_sw/view';" />
			<input type="hidden" name="creator" value="<?php echo $creator; ?>">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
		<?php echo form_close(); ?>
	</div>
</div>
<?php include("footer.php"); //表尾 ?>
</body>
</html>