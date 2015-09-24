<?php include("session.php"); //Check login or not ?>
<!DOCTYPE html>
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
		<h2 class="uk-text-primary">更新序號記錄</h2>
		<hr>
		<?php foreach($results_all as $row){
			$id = $row->id;
			$client = $row->client;
			$serial_num = $row->serial_num;
			$item = $row->item;
			$detail = $row->detail;
			$note = $row->note;
			$product_num = $row->product_num;
			$price = $row->price;
			$s_id = $row->s_id;
			$s_ni_date = $row->s_ni_date;
			$s_git_date = $row->s_git_date;
			$s_ni_po = $row->s_ni_po;
			$s_client_po = $row->s_client_po;
			$s_price = $row->s_price;
			$s_warranty = $row->s_warranty;
			$l_date = $row->l_date;
			$l_return_date = $row->l_return_date;
			$l_dongle = $row->l_dongle;
			$l_cable = $row->l_cable;
			$b_date = $row->b_date;
			$b_return_date = $row->b_return_date;
			$b_dongle = $row->b_dongle;
			$b_cable = $row->b_cable;
			$creator = $row->creator; 
		}?>
		<?php $attributes = array('class' => 'uk-form', 'id' => 'form_update');
			  echo form_open('sys_sn/action_update_sn', $attributes);  ?>
			<table class="uk-table uk-width-1-1">
				<tr><td colspan="3">
					<table><!--產品基本資料-->
						<tbody>
							<tr><td>客戶名稱</td><td><?php echo form_input('client', $client); ?></td></tr>
							<tr><td>序號</td><td><?php echo form_input('serial_num', $serial_num); ?></td></tr>
							<tr><td>項目名稱</td><td><?php echo form_input('item', $item); ?></td></tr>
							<tr><td>敘述</td><td>
								<?php $data = array(
							      'name'        => 'detail',
							      'value'       => $detail,
							      'rows'        => '5',
							      'cols'        => '70',
							    ); 
							    echo form_textarea($data); ?>
							</td></tr>
							<tr><td>備註</td><td>
								<?php $data = array(
							      'name'        => 'note',
							      'value'       => $note,
							      'rows'        => '5',
							      'cols'        => '70',
							    ); 
							    echo form_textarea($data); ?>
							</td></tr>
							<tr><td>P/N</td><td><?php echo form_input('product_num', $product_num); ?></td></tr>
							<tr><td>牌價</td><td><?php echo form_input('price', $price); ?></td></tr>
						</tbody>
					</table>
					<hr>
				</td></tr>
				<tr><td valign="top" class="uk-width-1-3">
					<h3 class="uk-text-primary">售出記錄</h3>
						<table>
							<tbody>
								<tr><td>整機代號</td><td><?php echo form_input('s_id', $s_id); ?></td></tr>
								<tr><td>NI 出廠日期</td><td><?php $data = array( 'name' => 's_ni_date','value' => $s_ni_date,'class' => 'datepicker');
								echo form_input($data); ?></td></tr>
								<tr><td>GIT 出貨日期</td><td><?php $data = array( 'name' => 's_git_date','value' => $s_git_date,'class' => 'datepicker');
								echo form_input($data); ?></td></tr>
								<tr><td>NI 訂單號碼</td><td><?php echo form_input('s_ni_po', $s_ni_po); ?></td></tr>
								<tr><td>客戶訂單號碼</td><td><?php echo form_input('s_client_po', $s_client_po); ?></td></tr>
								<tr><td>成交金額</td><td><?php echo form_input('s_price', $s_price); ?></td></tr>
								<tr><td>保固</td><td><?php echo form_input('s_warranty', $s_warranty); ?></td></tr>
							</tbody>
						</table>
				</td><td valign="top" class="border uk-width-1-3">
					<h3 class="uk-text-primary">借出記錄</h3>
					<table>
						<tbody>
							<tr><td>借出日期</td><td><?php echo form_input('l_date', $l_date); ?></td></tr>
							<tr><td>歸還日期</td><td><?php echo form_input('l_return_date', $l_return_date); ?></td></tr>
							<tr><td>11AC Dongle</td>
								<td>
									<select name="l_dongle" value="">
									<?php ////取得Dongle列表
									$query = $this->db->get('sn_dongle');
									foreach ($query->result() as $row)
									{ ?>
										<option <?php if ($l_dongle == $row->name ) echo "selected"; ?> value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>  
									<?php } ?>
									</select>
								</td>
							</tr>
							<tr><td>螢幕線</td>
								<td>
									<select name="l_cable" value="">
									<?php ////取得Dongle列表
									$query = $this->db->get('sn_cable');
									foreach ($query->result() as $row)
									{ ?>
										<option <?php if ($l_cable == $row->name ) echo "selected"; ?> value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>  
									<?php } ?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</td><td valign="top" class="border uk-width-1-3" >
					<h3 class="uk-text-primary">借入記錄</h3>
					<table>
						<tbody>
							<tr><td>借出日期</td><td><?php echo form_input('b_date', $b_date); ?></td></tr>
							<tr><td>歸還日期</td><td><?php echo form_input('b_return_date', $b_return_date); ?></td></tr>
							<tr><td>11AC Dongle</td>
								<td>
									<select name="b_dongle" value="">
									<?php ////取得Dongle列表
									$query = $this->db->get('sn_dongle');
									foreach ($query->result() as $row)
									{ ?>
										<option <?php if ($b_dongle == $row->name ) echo "selected"; ?> value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>  
									<?php } ?>
									</select>
								</td>
							</tr>
							<tr><td>螢幕線</td>
								<td>
									<select name="b_cable" value="">
									<?php ////取得Dongle列表
									$query = $this->db->get('sn_cable');
									foreach ($query->result() as $row)
									{ ?>
										<option <?php if ($b_cable == $row->name ) echo "selected"; ?> value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>  
									<?php } ?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</td></tr>
				<tr><td colspan="3">
					<?php $btn= array('type'=> 'submit', 'name' => 'submit', 'class' => 'uk-button', 'value' => '更新','id' => 'btn_update',);
				echo form_submit($btn); ?>
				<input type="button" value="取消/返回列表" class="uk-button" onclick="location.href='<?php echo base_url(); ?>sys_sn/view';" />
				</td></tr>
			</table>
			<?php echo form_hidden('id', $id); ?>
			<?php echo form_hidden('creator', $creator); ?>
			<?php echo form_close(); ?>
		</form>
	</div>
</div>
<?php include("footer.php"); //表尾 ?>
</body>
</html>