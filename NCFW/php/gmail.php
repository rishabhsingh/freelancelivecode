<?
require("class.phpmailer.gmail.php");


	//form validation vars
	$formok = true;
	$errors = array();
	
	//sumbission data
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	$date = date('d/m/Y');
	$time = date('H:i:s');
	
	//form data
	$name = $_POST['name'];	
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];


$mail = new PHPMailer();

$mail->IsSMTP();                                 				 // send via SMTP
$mail->Host     = "smtp.gmail.com"; 							 // SMTP server for Gmail
$mail->SMTPAuth = true;    	
$mail->SMTPSecure = 'tls';								
$mail->Username = "contactforncfw@gmail.com"; 				 // Your Mailer Gmail Address
$mail->Password = "sheila4varshney";								 		 // Password
$mail->Port = 587;	
$mail->From     = "contactforncfw@gmail.com";				 // Your Mailer Gmail Address (Same With Username)
$mail->AddAddress("contact@nocountryforwomen.org");			  		 // Your Adress
$mail->Subject  =  "New mail from NCFW!";
$mail->IsHTML(true);  
$mail->CharSet = 'UTF-8';
$mail->Body     =  "<p>You have recieved a new message from the enquiries form on your website.</p>
					  <p><strong>Name: </strong> {$name} </p>
					  <p><strong>Email Address: </strong> {$email} </p>
					  <p><strong>Subject: </strong> {$subject} </p>
					  <p><strong>Message: </strong> {$message} </p>
					  <p>This message was sent from the IP Address: {$ipaddress} on {$date} at {$time}</p>";

if(!$mail->Send())
{
   echo "Mail Not Sent <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

echo "Mail Sent";


?>
