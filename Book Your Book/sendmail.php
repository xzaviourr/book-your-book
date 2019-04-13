<?php
session_start();
$conn=mysqli_connect("localhost","root","","webkriti")
or die('Error connecting to MySQL server.'); 
use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'Exception.php';
	require 'PHPMailer.php';
	require 'SMTP.php';
function err($n)
{
$n=trim($n);//remove extra tab spaces
$n=stripslashes($n);//remove blackslashes from input to avoid xss attack
$n=htmlspecialchars($n);//convert html to plain text
return $n;
}
$email= $_GET['email'];
if(isset($_GET['amp;pass']))
$pass=$_GET['amp;pass'];
if(isset($_GET['pass']))
$pass=$_GET['pass'];
if(isset($_GET['amp;_pass']))
$pass=$_GET['amp;_pass'];

 $subject="Welcome to Book Your Book";
$body="Hey There! 
Welcome to Book Your Book. Your current password is " . $pass . ". You can change it anytime from your profile page. 
Thank you for joining us! :)";


	

$mail = new PHPMailer(true);

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'fandom360mail@gmail.com';          // SMTP username
$mail->Password = 'fandom@360!'; // SMTP password
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                          // TCP port to connect to

$mail->setFrom('fandom360mail@gmail.com', 'Fandom360');
$mail->addReplyTo('fandom360mail@gmail.com', 'Fandom360');
$mail->addAddress($email);   // Add a recipient

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = '<p>' . $body . '</p>';
$mail->Subject = $subject;
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
echo "<script>window.alert('You're now registered);</script>";
echo "<script>window.location.href='Register.php';</script>";
}
?>
