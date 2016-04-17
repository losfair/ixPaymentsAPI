<?php
session_start();
if($_SESSION['donate_pay_id']) {
	$id=$_SESSION['donate_pay_id'];
	$_SESSION['donate_pay_id']=0;
	$status=file_get_contents('https://ifapi.sinaapp.com/PaymentProcessor/get_payment_status.php?id='.$id);
	if($status==1) echo 'Thanks!';
	exit(0);
}
if(!$_GET['price']) exit(0);
$id=file_get_contents('https://ifapi.sinaapp.com/PaymentProcessor/create_payment.php?price='.(string)($_GET['price']*100));
if(!$id) exit(0);
$_SESSION['donate_pay_id']=$id;
echo '<script>window.location="https://ifapi.sinaapp.com/PaymentProcessor/pay.php?price='.(string)($_GET['price']*100).'&title='.$id.'&callback='.urlencode('https://www.ifxor.com/donate.php').'";</script>';
?>
