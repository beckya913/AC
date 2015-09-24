<?php include("session.php"); //Check login or not ?>
<html>
<head>
	<title>瀏覽序號記錄 - 借出</title>
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
	<script type="text/javascript"> // Launch serch function
		$(document).ready(function(){
			$('#search').keyup(function(){
				searchTable($(this).val());
			});
		});
		function searchTable(inputVal){
			var table = $('#sn_list');
			table.find('tr').each(function(index, row){
				var allCells = $(row).find('td');
				if(allCells.length > 0){
					var found = false;
					allCells.each(function(index, td){
						var regExp = new RegExp(inputVal, 'i');
						if(regExp.test($(td).text())){
							found = true;
							return false;
						}
					});
					if(found == true)$(row).show();else $(row).hide();
				}
			});
		}
	</script>
	
</head>
<body>
<?php include("header.php"); //表頭 ?>
<div id="main" class="uk-grid">
	<div class="uk-width-2-10">
		<?php include("navigation.php"); //左側導覽列 ?>
	</div>
	<div class="uk-width-8-10 form_margin">
		<table class="uk-float-right uk-width-1-1">
			<tr>
				<td colspan="4">
					<p class="uk-text-primary uk-text-bold">分類檢視：
						<a href="<?php echo base_url(); ?>sys_sn/view_lend">未歸還</a> ｜ 
						<a href="<?php echo base_url(); ?>sys_sn/view_lend_returned">已歸還</a>
					</p>
				</td>
			</tr>
			<tr>
				<td valign="top"><p class="uk-text-primary uk-text-bold">關鍵字搜尋</p></td>
				<td>
					<form class="uk-form">
						<input class="uk-form-small" type="text" id="search">
					</form>
				</td>
				<td valign="top"><p class="uk-text-primary uk-text-bold">日期搜尋</p></td>
				<td>
					<form id="date_serch" action="view_filter" method="POST" class="uk-form">
						<input type="text" class="datepicker" name="startdate" value=""/> 至
						<input type="text" class="datepicker" name="enddate" value=""/>
						<input type="submit" name="submit" value="確定" class="uk-button" />
						<input type="button" class="uk-button uk-button-success" onclick="location.href='<?php echo base_url(); ?>sys_sn/view';" value="重置"> 
					</form>
				</td>
				<!--<td><a class="uk-button uk-button-success" href="<?php echo base_url(); ?>sys_sn/view">重置</a></td>-->
			</tr>
			
		</table>
		<?php 
			if (isset($startdate)) {
				echo "您查詢的區間：".$startdate. "至" .$enddate;
			}
		?>
			<h2 class="uk-text-primary">序號記錄列表 - 借出</h2>
		<hr>
		<table id="sn_list" class="uk-table uk-table-striped">
			<thead>
				<tr><th>客戶</th><th>產品</th><th>序號</th><th>借出日期</th><th>歸還日期</th><th></th></tr>
			</thead>
			<tbody>
				<?php foreach($results as $row){ ?>
				<tr>
					<td width="100"><?php echo $row->client; ?></td>
					<td width="100"><?php echo $row->item; ?></td>
					<td width="150"><?php echo $row->serial_num; ?></td>
					<td width="150"><?php echo $row->l_date; ?></td>
					<td width="150"><?php echo $row->l_return_date; ?></td>
					<td><a href="<?php echo site_url("sys_sn/update_sn/".$row->id); ?>" class="uk-button">檢視/更新</a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php include("footer.php"); //表尾 ?>
</body>
</html>