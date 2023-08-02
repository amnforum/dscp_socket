<?php 
$data = json_decode(file_get_contents('php://input'), true);
$ipaddress = $_SERVER['REMOTE_ADDR'];
$port = $_SERVER['SERVER_PORT'];
if(!empty($data)){
	$messageData = !empty($data['message']) ? $data['message'] : '';
	
	$request = http_build_query($data);
	$size = intval($_SERVER['CONTENT_LENGTH']);
	$dhcpCode = !empty($data['dhcp_code']) ? $data['dhcp_code'] : 'no_code';
	$dhcpCodeValue = !empty($data['dhcp_code_value']) ? $data['dhcp_code_value'] : 0;
	$messageSize = strlen($messageData);
	
	echo json_encode([
		'ip_address'=>$ipaddress,
		'port'=>$port,
		'success_message' => 'Message sent successfully',
		'messageData' => $messageData,
		$dhcpCode => $dhcpCodeValue,
		'request_packet_size'=> $size,
		'message_size' => $messageSize,
		'dhcp_code' => $dhcpCode,
		'dhcp_code_value' => $dhcpCodeValue
	]);
	
}
if(isset($_POST) && !empty($_POST)){
	$dhcpCode = !empty($_POST['dhcp_code']) ? $_POST['dhcp_code'] : 'no_code';
	$dhcpCodeValue = !empty($_POST['dhcp_code_value']) ? $_POST['dhcp_code_value'] : 0;
	$messageData = !empty($_POST['message']) ? $_POST['message'] : '';
	$messageSize = strlen($messageData);
	$request = http_build_query($_POST);
	$size = intval($_SERVER['CONTENT_LENGTH']);
	echo json_encode([
		'ip_address'=>$ipaddress,
		'port'=>$port,
		'success_message' => 'Message sent successfully',
		'messageData' => $messageData,
		$dhcpCode => $dhcpCodeValue,
		'request_packet_size'=> $size,
		'message_size' => $messageSize,
		'dhcp_code' => $dhcpCode,
		'dhcp_code_value' => $dhcpCodeValue
	]);
}


?>