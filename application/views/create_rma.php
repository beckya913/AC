<?php include("session.php"); //Check login or not ?>
<?php 
$query = $this->db->get_where('global_user', array('username'=>$_SESSION['username']));
foreach ($query->result() as $row2){ $creator = $row2->name; }
?>
<!DOCTYPE html>
<html>
<head>
	<title>RMA:::新增申請表</title>
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
	<!-- Add/Remove rows dynamiclly -->
	<script type="text/javascript">
    $(document).ready(function() {

        $("#add").click(function() {
          $('#items tbody>tr:last').clone(true).insertAfter('#items tbody>tr:last');
          $('#items tbody>tr:last').find("input:text").val('');
          return false;
        });

        $("#remove").click(function() {
        	if ($('#items tbody>tr').size()>2) {
        		$('#items tbody>tr:last').remove();
        	} else { alert('表格至少要有一列');
        	};
        });

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
    		<h2 class="uk-text-primary">新增RMA記錄</h2>
    		<hr>	
			<?php 

				//查詢當日已有的筆數(即可得知最後一筆編號)
				$this->db->where('submit_date',date('Ymd'));
				$this->db->from('rma_detail');
				$record= $this->db->count_all_results();

			?>
			<form action="action_create" method="POST" enctype="multipart/form-data" class="uk-form">
				<!-- 基本資料 -->
				<fieldset data-uk-margin>
					<legend>新增基本資料 ( * 為必填欄位)</legend>
					<table width="700">
						<tbody>
							<tr>
								<td>日期</td>
								<td>
									<input size="" type="text" name="" value="<?php echo date('Y-m-d'); ?>" readonly>
								</td>
								
								<td>申請人</td>
								<td><input size="" type="text" name="applicant" value="<?php echo $creator; ?>" readonly></td></td>
							</tr>
							<tr>
								<td>客戶名稱</td>
								<td>
									<select name="client" value="">
										<?php ////取得客戶列表
										$query = $this->db->get('global_client');
										foreach ($query->result() as $row)
										{ ?>
											<option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>  
										<?php } ?>
									</select>
								</td>
								<td>客戶負責人</td>
								<td><input size="" type="text" name="contact_winodw" value=""></td>
							</tr>
							<tr>
								<td>地區</td>
								<td>
									<select name="area" value="">
										<?php 
											//取得地區列表
											$query = $this->db->get('rma_area');
											foreach ($query->result() as $row)
											{ ?>
											<option value="<?php echo $row->area; ?>"><?php echo $row->area; ?></option>  
											<?php } ?>
									</select>
								</td>
								<td>Email*</td>
								<td><input size="" type="text" name="email" value="<?php echo set_value('email'); ?>" placeholder="必填" ></td>
							</tr>
							<tr>
								<td>NI訂單號碼 </td>
								<td>
									<input size="" type="text" name="ni_po_num" value="">
								</td>
								<td>客戶訂單號碼</td>
								<td><input size="" type="text" name="client_po_num" value=""></td></td>
							</tr>
							<tr>
								<td>崑山辦公室收到</td>
								<td><input size="" type="text" name="receive_date_ks" value="" class="datepicker" ></td>
								<td>預估交期</td>
								<td><input size="" type="text" name="demand_date" value="" class="datepicker" ></td>
							</tr>
							<tr>
								<td>台灣辦公室收到</td>
								<td><input size="" type="text" name="receive_date_tw" value="" class="datepicker" ></td>
								<td>客戶收到</td>
								<td><input size="" type="text" name="receive_date_client" value="" class="datepicker" ></td>
							</tr>
							<tr>
								
								<td>附件</td>
								<td><input type="file" name="attachment" value="" /></td>
							</tr>
							<tr><td colspan="4">(附件請注意：上限15mb，檔名不得含中文字，壓縮檔使用zip)</td></tr>
							<tr>
								<td>備註</td>
								<td colspan="3"><textarea name="remark" rows="5" cols="70"></textarea></td>
							</tr>
						</tbody>
					</table>
				</fieldset>
				<br><br>
				<!-- 故障品敘述 -->
				<fieldset data-uk-margin>
				<legend>新增故障品敘述 ( * 為必填欄位)</legend>
				<input id="add" value="新增一列" type="button" class="uk-button">
				<input id="remove" value="移除最後一列" type="button" class="uk-button">
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
					    <tr>
					          
					          <td>
					          	<select name="category[]" value="">
										<?php 
											//取得類別
											$query = $this->db->get('rma_category');
											foreach ($query->result() as $row)
											{ ?>
											<option value="<?php echo $row->category; ?>"><?php echo $row->category; ?></option>  
											<?php } ?>
								</select>
					          </td>
					          <td>
					          	<select name="item[]" value="">
										<?php 
											//取得類別
											$query = $this->db->get('global_item');
											foreach ($query->result() as $row)
											{ ?>
											<option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>  
											<?php } ?>
								</select>
					          </td>
					          <td><input type="text" name="problem[]" value="" class="uk-form-small"></td>
					          <td><input type="text" name="problem_date[]" value="" class="uk-form-small"></td>
					          <td><input type="text" id="ship_date_git" name="ship_date_git[]" value="" class="uk-form-small"></td>
					          <td><input type="text" name="product_date_ni[]" value="" class="uk-form-small"></td>
					          <td><input type="text" name="status[]" value="" class="uk-form-small"></td>
					          <td><input type="text" name="sn_before[]" value="" class="uk-form-small"></td>
					          <td><input type="text" name="sn_after[]" value="" class="uk-form-small"></td>
					          <td><input type="text" name="result[]" value="" class="uk-form-small"></td>
					          <td><input type="text" name="solution[]" value="" class="uk-form-small" ></td>
					          <td><input type="text" name="fee[]" value="" class="uk-form-small" ></td>
					    </tr>
					</tbody>
				</table>
		  		</fieldset>
		  		<hr>
		  		<input type="submit" name="submit" value="送出表單" class="uk-button" />
		  		<!-- Hidden fields -->
				<input type="hidden" name="submit_date" value="<?php echo date('Ymd'); ?>">
				<input type="hidden" name="post_num" value="<?php if ($record ==0) { 
									echo "001"; //如果沒有001的紀錄，就填入001
								} else { echo sprintf("%03d",$record+1); } // 不然就填入最後一筆流水號＋1} ?>">
				<input type="hidden" name="serial_num" 
									value="GIR<?php echo date('Ymd'); ?><?php if ($record ==0) { 
										echo "001"; //如果沒有001的紀錄，就填入001
									} else { echo sprintf("%03d",$record+1); } // 不然就填入最後一筆流水號＋1} ?>">
						
		</form>
	</div>
</div>
<?php include("footer.php"); //表尾 ?>
</body>
</html>