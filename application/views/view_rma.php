<?php include("session.php"); //Check login or not ?>
<html>
<head>
	<title>瀏覽RMA記錄</title>
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
			var table = $('#rma_list');
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
		<table>
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
						<input type="text" class="datepicker uk-form-small" name="startdate" value=""/> 至
						<input type="text" class="datepicker uk-form-small" name="enddate" value=""/>
						<input type="submit" name="submit" value="確定" class="uk-button" />
						<input type="button" class="uk-button uk-button-success" onclick="location.href='<?php echo base_url(); ?>sys_rma/view';" value="重置">
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
		<h2 class="uk-text-primary">RMA記錄列表</h2>
		<hr>
		<table id="rma_list" class="uk-table uk-table-striped">
			<thead>
				<tr><th>客戶</th><th>維修單號</th><th>維修品資訊</th><th>建立日期</th><th></th></tr>
			</thead>
			<tbody>
				<?php foreach($results_rma as $row2){ ?>
				<tr>
					<td width="100"><?php echo $row2->client; ?></td>
					<td width="150"><?php echo $row2->form_num; ?></td>
					<td width="250" valign="top">
						<?php 
							$query = $this->db->where('form_num =', $row2->form_num)->get('rma_item');
							$result = $query->result();
						    foreach ($result as $row3) { ?>
						<ul class="uk-list">
							<li>產品 : <?php echo $row3->item; ?></li>
							<li>原序號 : <?php echo $row3->sn_before; ?></li>
							<li>更換後序號 : <?php echo $row3->sn_after; ?></li>
							<li>目前狀態 : <?php echo $row3->status; ?></li>
						</ul>
						<?php }?>
					</td>
					<td width="100"><?php echo date("Y-m-d",strtotime($row2->time)); ?></td>
					<td><a href="<?php echo site_url("sys_rma/update/".$row2->id); ?>" class="uk-button">檢視/更新</a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php include("footer.php"); //表尾 ?>
</body>
</html>