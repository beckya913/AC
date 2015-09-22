<?php

if(!isset($_SESSION)) 
{ 
session_start(); 
}  

if(!isset($_SESSION['username'])){
header("location:login");
}

$query = $this->db->get_where('global_user', array('username'=>$_SESSION['username']));
foreach ($query->result() as $row2){ $level = $row2->level; }
if ($level == 2) {
	echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
				alert('您無權使用此功能！');
				window.location.href='../portal/dashboard';
			  </script></body></html>";
}
?>