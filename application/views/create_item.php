<?php include("session_with_permission.php"); //Check login or not ?>
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
	
		<?php 

			$attributes = array('class' => 'uk-form', 'id' => 'create_item');
			echo form_open('sys_sn/action_create_item', $attributes);
		?>
		<h2 class="uk-text-primary">新增產品項目</h2>
		<hr>
		<table cellpadding="0" cellspacing="10" border="0" width="300">
			<tbody>
				<tr>
					<td>項目名稱</td><td><?php echo form_input('name', ''); ?></td>
				</tr>
				<tr>
					<td>敘述</td><td><?php echo form_input('detail', ''); ?></td>
				</tr>
				<tr>
					<td>P/N</td><td><?php echo form_input('product_num', ''); ?></td>
				</tr>
				<tr>
					<td>牌價</td><td><?php echo form_input('price', ''); ?></td>
				</tr>
				<tr><td colspan="2"><center><?php $data = array('type'=> 'submit','class'=> 'uk-button','value'=> '建立'); 
		    echo form_input($data);?></center></td></tr>
			</tbody>
		</table>
		<hr>
		<h3>已建立產品：</h3>
		<table class="uk-table" cellpadding="0" cellspacing="0" border="0" width="200">
			<?php ////取得客戶列表
				$query = $this->db->get('global_item');
				foreach ($query->result() as $row)
			{ ?> 				
			<tr>
				<td width="70"><?php echo $row->name; ?></td>
				<td><a href="<?php echo site_url("sys_sn/update_item/".$row->id); ?>" class="uk-button">修改</a></td>
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