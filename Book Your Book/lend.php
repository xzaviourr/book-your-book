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

if(isset($_POST["submit"]))
{
  $name=err($_POST['name']);
  $info=err($_POST['info']);
$genre=err($_POST['genre']);
$cover=err($_POST['cover']);
$yr=$_SESSION['yr'];
$batch=$_SESSION['batch'];
$rollno=$_SESSION['rollno'];

$query="SELECT * FROM books WHERE name = '$name'";
$result=mysqli_query($conn,$query);
$num_rows = mysqli_num_rows($result);
if($num_rows==0)
{
  $sql="INSERT INTO `books`(`name`, `info`, `cover`, `genre`) VALUES ('$name','$info','$cover','$genre')";
  $result=mysqli_query($conn,$sql);
  $query="SELECT * FROM books WHERE name = '$name'";
  $result=mysqli_query($conn,$query);
  $row1=mysqli_fetch_array($result);
  $bookid=$row1['bookid'];
  date_default_timezone_set('Asia/Kolkata');
  $date=date("Y-m-d");
  $time=date("h:i:s");
  $entry=$date . " " . $time;
  $query="INSERT INTO `lender`(`yr`, `batch`, `rollno`, `bookid`, `entry`) VALUES ('$yr','$batch','$rollno','$bookid','$entry')";        
  $result=mysqli_query($conn,$query);

}
else
{
  $query1="SELECT * FROM borrower WHERE name = '$name'";
  $result1=mysqli_query($conn,$query1);
  $num_rows1 = mysqli_num_rows($result1);
  $query="SELECT * FROM books WHERE name = '$name'";
  $result=mysqli_query($conn,$query);
  $row1=mysqli_fetch_array($result);
  $bookid=$row1['bookid'];
  date_default_timezone_set('Asia/Kolkata');
  $date=date("Y-m-d");
  $time=date("h:i:s");
  $entry=$date . " " . $time;
  $query="INSERT INTO `lender`(`yr`, `batch`, `rollno`, `bookid`, `entry`) VALUES ('$yr','$batch','$rollno','$bookid','$entry')";        
  $result=mysqli_query($conn,$query);
  if($num_rows1!=0)
  {
    while($row1=mysqli_fetch_array($result1))
    {
      $year=$row1['yr'];
      $batch1=$row1['batch'];
      $rollno1=$row1['rollno'];
      $query2="INSERT INTO `notification`(`byr`, `bbatch`, `brollno`, `lyr`, `lbatch`, `lrollno`, `bookid`, `type`, `status`) VALUES ('$year','$batch1','$rollno1','$yr','$batch','$rollno','$bookid',5,0)";
      $result2=mysqli_query($conn,$query2);
    }
  }
}}

// $query="SELECT * FROM books WHERE name = '$name'";
// $result=mysqli_query($conn,$query);
// $num_rows = mysqli_num_rows($result);
// if($num_rows==0)
// {
//         $sql="INSERT INTO `books`(`name`, `info`, `cover`, `genre`) VALUES ($name,$info,$cover,$genre)";
//         $result=mysqli_query($conn,$sql);
//         $query="SELECT * FROM books WHERE name = '$name'";
//         $result=mysqli_query($conn,$query);
//         $row1=mysqli_fetch_array($result1);
//         $bookid=$row1['bookid'];
//         date_default_timezone_set('Asia/Kolkata');
//         $date=date("Y-m-d");
//         $time=date("h:i");
//         $entry=$date . " " . $time;
//         $query="INSERT INTO `lender`(`yr`, `batch`, `rollno`, `bookid`, `entry`) VALUES ('$yr','$batch','$rollno','$bookid','$entry')";        
//         $result=mysqli_query($conn,$query);

// }
// else
// {

// $query="SELECT * FROM books WHERE name = '$name'";
//         $result=mysqli_query($conn,$query);
//         $row1=mysqli_fetch_array($result1);
//         $bookid=$row1['bookid'];
//         date_default_timezone_set('Asia/Kolkata');
//         $date=date("Y-m-d");
//         $time=date("h:i:s");
//         $entry=$date . " " . $time;
//         $query="INSERT INTO `lender`(`yr`, `batch`, `rollno`, `bookid`, `entry`) VALUES ('$yr','$batch','$rollno','$bookid','$entry')";        
//         $result=mysqli_query($conn,$query);

// }}
echo "<script>window.alert('Your book has been shared for lending. Thank You! :)');</script>";
echo "<script>window.location.href='dashboard.php';</script>";
?>