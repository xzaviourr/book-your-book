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
$genre=err($_POST['genre']);
  $info=err($_POST['info']);
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
  $row1=mysqli_fetch_array($result1);
  $bookid=$row1['bookid'];
  $query="INSERT INTO `borrower`(`yr`, `batch`, `rollno`, `bookid`) VALUES ('$yr','$batch','$rollno','$bookid')";        
  $result=mysqli_query($conn,$query);
}
else
{
    $query1="SELECT * FROM borrower WHERE name = '$name'";
    $result1=mysqli_query($conn,$query1);
    $num_rows1 = mysqli_num_rows($result1);
    $query="SELECT * FROM books WHERE name = '$name'";
    $result=mysqli_query($conn,$query);
    $row1=mysqli_fetch_array($result1);
    $bookid=$row1['bookid'];

    $query2="SELECT * FROM lender WHERE bookid = '$bookid'";
    $result2=mysqli_query($conn,$query2);
    $num_rows2 = mysqli_num_rows($result2);
    if($num_rows2==0)
    {
        $query3="INSERT INTO `borrower`(`yr`, `batch`, `rollno`, `bookid`) VALUES ('$yr','$batch','$rollno','$bookid')";
    }   
    else
    {
        echo "<script>window.alert('This book is already available. Kindly send a borrow request.');</script>";
    } 
}}
echo "<script>window.location.href='dashboard.php';</script>";
?>