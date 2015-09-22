<?php include("session.php"); //Check login or not ?>
<?php 
$query = $this->db->get_where('global_user', array('username'=>$_SESSION['username']));
foreach ($query->result() as $row2){ $creator = $row2->name; }
foreach($results_all as $row){
			$id= $row->id;
			$submit_date= $row->submit_date;
			$applicant= $row->applicant;
			$post_num= $row->post_num;
			$form_num= $row->form_num;
			$contact_winodw= $row->contact_winodw;
			$email= $row->email;
			$client= $row->client;
			$area= $row->area;
			$remark= nl2br($row->remark);
			$attachment= $row->attachment;
			$demand_date= $row->demand_date;
			$ni_po_num= $row->ni_po_num;
			$client_po_num= $row->client_po_num;
			$receive_date_tw= $row->receive_date_tw;
			$receive_date_client= $row->receive_date_client;
			$receive_date_ks= $row->receive_date_ks;
			$time= $row->time;}
?>
<!DOCTYPE html>
<html>
<head>
	<title>更新RMA記錄</title>
	<!-- install UIKit powered by Yootheme -->
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
    		<h2 class="uk-text-primary">更新RMA記錄: <?php echo $form_num; ?></h2>	
			<?php $attributes = array('class' => 'uk-form', 'id' => 'form_update','enctype'=>'multipart/form-data');
	  echo form_open('sys_rma/action_update', $attributes);  ?>
				<!-- 基本資料 -->
				<fieldset data-uk-margin>
					<legend>基本資料</legend>
					<table width="700">
						<tbody>
							<tr>
								<td>日期</td>
								<td>
									<input size="" type="text" name="submit_date" value="<?php echo $submit_date; ?>" readonly>
								</td>
								
								<td>申請人</td>
								<td><input size="" type="text" name="applicant" value="<?php echo $creator; ?>" readonly></td></td>
							</tr>
							<tr>
								<td>客戶名稱</td>
								<td><input name="client" value="<?php echo $client; ?>" readonly></td>
								<td>客戶負責人</td>
								<td><input size="" type="text" name="contact_winodw" value="<?php echo $contact_winodw; ?>" readonly></td>
							</tr>
							<tr>
								<td>地區</td>
								<td><input name="area" value="<?php echo $area; ?>" readonly></td>
								<td>Email*</td>
								<td><input type="text" name="email" value="<?php echo $email; ?>" readonly></td>
							</tr>
							<tr>
								<td>NI訂單號碼 </td>
								<td><input size="" type="text" name="ni_po_num" value="<?php echo $ni_po_num; ?>"></td>
								<td>客戶訂單號碼</td>
								<td><input size="" type="text" name="client_po_num" value="<?php echo $client_po_num; ?>"></td></td>
							</tr>
							<tr>
								<td>崑山辦公室收到</td>
								<td><input type="text" name="receive_date_ks" value="<?php echo $receive_date_ks; ?>" class="datepicker" ></td>
								<td>預估交期</td>
								<td><input type="text" name="demand_date" value="<?php echo $demand_date; ?>" class="datepicker" ></td>
							</tr>
							<tr>
								<td>台灣辦公室收到</td>
								<td><input size="" type="text" name="receive_date_tw" value="<?php echo $receive_date_tw; ?>" class="datepicker" ></td>
								<td>客戶收到</td>
								<td><input size="" type="text" name="receive_date_client" value="<?php echo $receive_date_client; ?>" class="datepicker" ></td>
							</tr>
							<tr>
								<td>目前附件</td>
								<td><a href="<?php echo base_url(); ?>uploads/<?php echo $attachment; ?>" target="_blank"><?php echo $attachment; ?></a></td>
								<td>更新附件</td>
								<td><input type="file" name="attachment" value="" /></td>
							</tr>
							<tr>
								<td>備註</td>
								<td colspan="3"><textarea name="remark" rows="5" cols="70"><?php echo $remark; ?></textarea></td>
							</tr>
						</tbody>
					</table>
				</fieldset>
				<br><br>
				<!-- 故障品敘述 -->
				<fieldset data-uk-margin>
				<legend>故障品敘述</legend>
				<table id="items" class="uk-table" border="0" cellspacing="0" cellpadding="0">
					<tbody>
					    <tr> 
					          <th>申請類別</th>
					          <th>項目</th>
					          <th>問題</th>
					          <th>狀況日</th>
					          <th>GIT出貨日期</th>
					          <th>NI出廠日期</th>
					          <th>目前狀態</th>
					          <th>原來序號</th>
					          <th>更換後序號</th>
					          <th>初步檢測結果</th>
					          <th>處理方式</th>
					          <th>費用</th>
					    </tr>
					    <?php 
							//取得退回品清單
							$query = $this->db->get_where('rma_item',array('form_num'=>$form_num));
							foreach ($query->result() as $row3)
							{ ?>
					    <tr>
					    	  <input type="hidden" name="id_item[]" value="<?php echo $row3->id; ?>">
					    	  <input type="hidden" name="form_num_item[]" value="<?php echo $row3->form_num; ?>">
					          <td><input type="text" name="category[]" value="<?php echo $row3->category; ?>" class="uk-form-small" readonly></td>
					          <td><input type="text" name="item[]" value="<?php echo $row3->item; ?>" class="uk-form-small" readonly></td>
					          <td><input type="text" name="problem[]" value="<?php echo $row3->problem; ?>" class="uk-form-small" readonly></td>
					          <td><input type="text" name="problem_date[]" value="<?php echo $row3->problem_date; ?>" class="uk-form-small"></td>
					          <td><input type="text" name="ship_date_git[]" value="<?php echo $row3->ship_date_git; ?>" class="uk-form-small"></td>
					          <td><input type="text" name="product_date_ni[]" value="<?php echo $row3->product_date_ni; ?>" class="uk-form-small"></td>
					          <td><input type="text" name="status[]" value="<?php echo $row3->status; ?>" class="uk-form-small"></td>
					          <td><input type="text" name="sn_before[]" value="<?php echo $row3->sn_before; ?>" class="uk-form-small"></td>
					          <td><input type="text" name="sn_after[]" value="<?php echo $row3->sn_after; ?>" class="uk-form-small"></td>
					          <td><input type="text" name="result[]" value="<?php echo $row3->result; ?>" class="uk-form-small"></td>
					          <td><input type="text" name="solution[]" value="<?php echo $row3->solution; ?>" class="uk-form-small" ></td>
					          <td><input type="text" name="fee[]" value="<?php echo $row3->fee; ?>" class="uk-form-small"></td>
					    </tr>
					    <?php } ?>
					</tbody>
				</table>
		  		</fieldset>
		  		<hr>
		  		<input type="submit" name="submit" value="更新" class="uk-button" />
		  		<input type="button" value="取消/返回列表" class="uk-button" onclick="location.href='<?php echo base_url(); ?>sys_rma/view';" />
		  		<!-- Hidden fields -->
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<input type="hidden" name="post_num" value="<?php echo $post_num; ?>">
				<input type="hidden" name="form_num" value="<?php echo $form_num; ?>">

			<?php echo form_close(); ?>
	</div>
</div>
<?php include("footer.php"); //表尾 ?>
</body>
</html>