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
    <script type="text/javascript">// Enable date picker
		 $(function() {
		    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
		  });	
	</script>
	<!--<script type="text/javascript"> // 產品基本資料唯讀
	$(document).ready(function(){
		$('#basic_info input').prop('readonly', true);
		$('#basic_info textarea').prop('readonly', true);
	});
	</script>-->
</head>
<body>
<?php include("header.php"); //表頭 ?>
<div id="main" class="uk-grid">
	<div class="uk-width-2-10">
		<?php include("navigation.php"); //左側導覽列 ?>
	</div>
	<div class="uk-width-8-10 form_margin">
		<?php //依上一頁(create_sn)輸入的項目載入相關內容
			foreach($results as $row_content){
			$detail = $row_content->detail;
			$product_num = $row_content->product_num;
			$price = $row_content->price;
		}?>

		<form action="action_create_sn" method="POST" enctype="" class="uk-form">
			<h2 class="uk-text-primary">新增序號記錄</h2>
			<hr>
			<table class="uk-table">
				<tr><td colspan="3">
					<table id="basic_info"><!--產品基本資料-->
						<tbody>
							<tr><td>客戶名稱</td><td><input name="client" value="<?php echo $client; ?>"></td></tr>
							<tr><td>序號</td><td><input name="serial_num" value="<?php echo $serial_num; ?>"></td></tr>
							<tr><td>項目名稱</td><td><input name="item" value="<?php echo $item; ?>"></td></tr>
							<tr><td>敘述</td><td><textarea name="detail" rows="4" cols="50"><?php echo $detail; ?></textarea></td></tr>
							<tr><td>備註</td><td><textarea name="note" rows="4" cols="50"></textarea></td></tr>
							<tr><td>P/N</td><td><input name="product_num" value="<?php echo $product_num; ?>"></td></tr>
							<tr><td>牌價</td><td><input name="price" value="<?php echo $price; ?>"></td></tr>
						</tbody>
					</table>
					<hr>
				</td></tr>
				<tr><td valign="top" width="306">
					
					<h3 class="uk-text-primary">售出記錄</h3>
					<table>
						<tbody>
							<tr><td>整機代號</td><td><input name="s_id" value=""></td></tr>
							<tr><td>NI 出廠日期</td><td><input name="s_ni_date" value="" class="datepicker"></td></tr>
							<tr><td>GIT 出貨日期</td><td><input name="s_git_date" value="" class="datepicker"></td></tr>
							<tr><td>NI 訂單號碼</td><td><input name="s_ni_po" value=""></td></tr>
							<tr><td>客戶訂單號碼</td><td><input name="s_client_po" value=""></td></tr>
							<tr><td>成交金額</td><td><input name="s_price" value=""></td></tr>
							<tr><td>保固</td><td><input name="s_warranty" value=""></td></tr>
						</tbody>
					</table>
				</td><td valign="top" class="border" >
					<h3 class="uk-text-primary">借出記錄</h3>
					<table>
						<tbody>
							<tr><td>整機代號</td><td><input name="l_id" value=""></td></tr>
							<tr><td>NI 出廠日期</td><td><input name="l_ni_date" value="" class="datepicker"></td></tr>
							<tr><td>NI 訂單號碼</td><td><input name="l_ni_po" value=""></td></tr>
							<tr><td>借出日期</td><td><input name="l_date" value="" class="datepicker"></td></tr>
							<tr><td>歸還日期</td><td><input name="l_return_date" value="" class="datepicker"></td></tr>
							<tr><td>11AC Dongle</td>
								<td>
									<select name="l_dongle" value="">
									<?php ////取得客戶列表
									$query = $this->db->get('sn_dongle');
									foreach ($query->result() as $row)
									{ ?>
										<option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>  
									<?php } ?>
									</select>
								</td>
							</tr>
							<tr><td>螢幕線</td>
								<td>
									<select name="l_cable" value="">
									<?php ////取得客戶列表
									$query = $this->db->get('sn_cable');
									foreach ($query->result() as $row)
									{ ?>
										<option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>  
									<?php } ?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</td><td valign="top" class="border" >
					<h3 class="uk-text-primary">借入記錄</h3>
					<table>
						<tbody>
							<tr><td>整機代號</td><td><input name="b_id" value=""></td></tr>
							<tr><td>NI 出廠日期</td><td><input name="b_ni_date" value="" class="datepicker"></td></tr>
							<tr><td>NI 訂單號碼</td><td><input name="b_ni_po" value=""></td></tr>
							<tr><td>借出日期</td><td><input name="b_date" value="" class="datepicker"></td></tr>
							<tr><td>歸還日期</td><td><input name="b_return_date" value="" class="datepicker"></td></tr>
							<tr><td>11AC Dongle</td>
								<td>
									<select name="b_dongle" value="">
									<?php ////取得客戶列表
									$query = $this->db->get('sn_dongle');
									foreach ($query->result() as $row)
									{ ?>
										<option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>  
									<?php } ?>
									</select>
								</td>
							</tr>
							<tr><td>螢幕線</td>
								<td>
									<select name="b_cable" value="">
									<?php ////取得客戶列表
									$query = $this->db->get('sn_cable');
									foreach ($query->result() as $row)
									{ ?>
										<option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>  
									<?php } ?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</td></tr>
				<tr><td colspan="3">
						<p class="uk-text-left"><input type='submit' name='submit' class="uk-button" value='建立'></p>
						<input type="hidden" name="creator" value="<?php 
		    $query = $this->db->get_where('global_user', array('username'=>$_SESSION['username']));
			foreach ($query->result() as $row2){ $creator = $row2->name; }
			echo $creator; ?>">
				</td></tr>
			</table>
		</form>
	</div>
</div>
<?php include("footer.php"); //表尾 ?>
</body>
</html>