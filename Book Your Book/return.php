<?php
session_start();
$conn=mysqli_connect("localhost","root","","dbslab")
        or die('Error connecting to MySQL server.'); 
        function err($n)
        {
          $n=trim($n);//remove extra tab spaces
          $n=stripslashes($n);//remove blackslashes from input to avoid xss attack
          $n=htmlspecialchars($n);//convert html to plain text
          return $n;
        }
$bookid=$_GET['id'];
$yr=$_SESSION['yr'];
$batch=$_SESSION['batch'];
$rollno=$_SESSION['rollno'];
$query="SELECT user.Points,transactions.status FROM users,transactions WHERE transactions.lyr='$yr' AND transactions.lbatch='$batch' AND transactions.lrollno='$rollno' AND transactions.bookid='$bookid' transactions.status=0";
$result=mysqli_query($conn,$query);
  $row1=mysqli_fetch_array($result);
  $row1['user.Points']++;
  $row1['transactions.status']=1;
  echo "<script>window.alert('Book Returned!');</script>";
  echo "<script>window.location.href='profile.php';</script>";
?>