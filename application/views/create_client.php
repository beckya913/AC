<?php include("session_with_permission.php"); //Check login or not ?>
<html>
<head>
	<title>新增客戶</title>
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
		<?php $attributes = array('class' => 'uk-form', 'id' => 'create_client');
		echo form_open('sys_sn/action_create_client', $attributes);
		?>
		<h2 class="uk-text-primary">新增客戶</h2>
		<hr>
		<table class="uk-table" cellpadding="0" cellspacing="0" border="0" width="200">
			<tbody>
				<tr>
					<td width="70">客戶名稱</td><td width="100"><?php echo form_input('name', ''); ?></td>
					<td><?php 
		    $data = array('type'=> 'submit','class'=> 'uk-button','value'=> '建立'); 
		    echo form_input($data); ?></td>
				</tr>
			</tbody>
		</table>
		<hr>
		<h3>已建立客戶：</h3>
		<table class="uk-table" cellpadding="0" cellspacing="0" border="0" width="200">
			<?php ////取得客戶列表
				$query = $this->db->get('global_client');
				foreach ($query->result() as $row)
			{ ?> 				
			<tr>
				<td width="70"><?php echo $row->name; ?></td>
				<td><a href="<?php echo site_url("sys_sn/update_client/".$row->id); ?>" class="uk-button">修改名稱</a></td>
			</tr>
			<?php } ?>
		</table>
		<?php 
		    $query = $this->db->get_where('global_user', array('username'=>$_SESSION['username']));
			foreach ($query->result() as $row2){ $creator = $row2->name; }
			echo form_hidden('creator', $creator);
			form_close();
		?>
	</div>
</div>
<div id="footer">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td><p>Copyright@Global Instrument Technology INC.</p></td>
				<td><p>Matained by Becky Tsai</p></td>
			</tr>
		</tbody>
	</table>
</div>
</body>
</html>