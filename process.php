<?php


$con = new mysqli("localhost", "root", "", "tb_test");


$sql = "SELECT * FROM customers ";
if(!empty($_POST["cus_id"])){
	$sql.= " WHERE cus_id LIKE '%".$_POST["cus_id"]."%' ";
}else{
	$sql.= " WHERE cus_id = '' ";
}

$result = mysqli_query($con,$sql);

$rows = array();
while($row = mysqli_fetch_assoc($result)){
	$rows[] = $row;
}

	$data = array();
if(!empty($rows)){
	$data = array(
		"data" => $rows
	);
}

echo json_encode($data);





?>