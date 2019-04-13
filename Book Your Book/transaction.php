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
        $query="SELECT * FROM books WHERE bookid='$bookid'";
 $result=mysqli_query($conn,$query);
  $row1=mysqli_fetch_array($result);
if(!isset($_SESSION['yr']))
	{echo "<script>window.alert('You need to log in to borrow a book');</script>";
	echo "<script>window.location.href='book.php?name=" . $row1['name'] . "';</script>";}
	else{

$query="SELECT * FROM lender WHERE bookid='$bookid'";
 $result=mysqli_query($conn,$query);
  $row1=mysqli_fetch_array($result);
  $yr=$_SESSION['yr'];
  $batch=$_SESSION['batch'];
  $rollno=$_SESSION['rollno'];
  $lyr=$row1['yr'];
  $lbatch=$row1['batch'];
  $lrollno=$row1['rollno'];
    date_default_timezone_set('Asia/Kolkata');
  $date=date("Y-m-d");
  $time=date("h:i:s");
  $entry=$date . " " . $time;
 $sql="INSERT INTO `transactions`(`byr`, `bbatch`, `brollno`, `lyr`, `lbatch`, `lrollno`, `bookid`, `entry`, `status`) VALUES ('$yr','$batch','$rollno','$lyr','$lbatch','$lrollno','$bookid','$entry',0)";
  $result=mysqli_query($conn,$sql);
  $sql="DELETE FROM lender WHERE yr='$lyr' and batch='$lbatch' and rollno='$lrollno' and bookid='$bookid'";
    $result=mysqli_query($conn,$sql);
      $sql="DELETE FROM borrower WHERE yr='$yr' and batch='$batch' and rollno='$rollno' and bookid='$bookid'";
    $result=mysqli_query($conn,$sql);
    $sql="UPDATE TABLE users SET Points=Points+1 WHERE yr='$lyr' and batch='$lbatch' and rollno='$lrollno' ";
        $result=mysqli_query($conn,$sql);


	echo "<script>window.location.href='profile.php';</script>";}



?>