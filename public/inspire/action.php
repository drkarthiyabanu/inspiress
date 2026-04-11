<?php

$err = array();
if(empty($_POST['name'])){
	$err['name1'] = "required";
}else if (strlen($_POST['name']) < 2){
	$err['name1'] = "minimum 2 characters";
}
if(empty($_POST['email'])){
	$err['email1'] = "required";
}else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	$err['email1'] = "enter a valid email id";
}
if(empty($_POST['mobile'])){
	$err['mobile1'] = "required";
}else if (!preg_match('/^[0-9]*$/', $_POST['mobile'])) {
	$err['mobile1'] = "only numbers";
}else if (strlen($_POST['mobile']) < 10){
	$err['mobile1'] = "minimum 10 characters";
}else if (strlen($_POST['mobile']) > 13){
	$err['mobile1'] = "maximum 13 characters";
}

if(count($err) == 0){
	
if(isset($_REQUEST)){

$name=$_REQUEST['name'];
$email=$_REQUEST['email'];
$mobile=$_REQUEST['mobile'];
$message=$_REQUEST['message'];

$meesage="
<html>
<body>

<div style='width:600px; border:5px solid #0086b2; margin:0px auto;'>

<p style='text-align:center;font-family:Arial, Helvetica, sans-serif;font-size:13px;'>Dear Inspire Team,</p>
<p style='text-align:center;font-family:Arial, Helvetica, sans-serif;font-size:13px;'>Online Enquiry from the following person:</p>

<div style='border-bottom:1px solid #ccc;margin-bottom:15px;'></div>

<table width='570' align='center' border='0' cellpadding='0' cellspacing='0'>

<tr>
<td style='padding:10px;ont-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #ccc;'>Name</td>
<td style='padding:10px;ont-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #ccc;'>$name</td>
</tr>

<tr>
<td style='padding:10px;ont-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #ccc;border-top:0px;'>Email Id</td>
<td style='padding:10px;ont-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #ccc;border-top:0px;'>$email</td>
</tr>

<tr>
<td style='padding:10px;ont-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #ccc;border-top:0px;'>Mobile Number</td>
<td style='padding:10px;ont-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #ccc;border-top:0px;'>$mobile</td>
</tr>

<tr>
<td style='padding:10px;ont-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #ccc;border-top:0px;'>Message</td>
<td style='padding:10px;ont-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #ccc;border-top:0px;'>$message</td>
</tr>

<tr>
<td><a style='display:inline-block;text-decoration:none;background:#0086b2;margin-top:15px;font-family:Arial, Helvetica, sans-serif;font-size:13px;padding:10px;text-align:center;color:#FFFFFF;font-weight:bold;' href='http://www.inspiress.in'>
www.inspiress.in</a></td>
</tr>

</table>
</div>

</body>
</html>
";

$subject="For inspiress Online Enquiry : $name / $mobile\n";
$headers  = "From: $name\r\n"; 
$headers .= "Content-type: text/html\r\n";
$success = mail("karthiya@inspiress.in", $subject, $meesage, $headers);
if($success){
	echo ("success");
}else{
	echo ("Error");
} 
header('location:index.html');
}
	
}

?>