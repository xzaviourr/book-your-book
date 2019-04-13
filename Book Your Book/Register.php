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
$name=err($_POST["name"]);
$yr=err($_POST["yr"]);
$batch=err($_POST["batch"]);
$rollno=err($_POST["rollno"]);
$institute=err($_POST["institute"]);
$pass=rand();
$email=strtolower($batch) . "_" . $yr . $rollno . "@iiitm.ac.in";
$sql="INSERT INTO users (Name,Yr,Batch,RollNo,Points,Password,Institute)  VALUES ('$name','$yr','$batch',$rollno,5,SHA('$pass'),'$institute')";
  $query="SELECT * FROM users WHERE Yr = '$yr' AND Batch = '$batch' AND RollNo = '$rollno'";
  $result=mysqli_query($conn,$query);
  $num_rows = mysqli_num_rows($result);
  if($num_rows==0)
  { if(!mysqli_query($conn,$sql))
       echo "<script>window.alert('insertion failed');</script>";
     else
      { 
         $_SESSION['email']=$email;
         echo "<script>window.location.href='sendmail.php?email=" . $email . "&amp;pass=" . $pass . "';</script>"; 
         echo "<script>window.location.href='ProfilePage.php';</script>"; 
      }
  }
  else
  {
      echo "<script>window.alert('You are already registered. SignIn to continue');</script>";
      $flag=1;
      /*echo "<script>window.location.href='HomePage.html';</script>";*/      
  }  
         
}      


 mysqli_close($conn); 
?>



<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Jua|Luckiest+Guy" rel="stylesheet">
</head>
<body>


<!-- Nav bar -->

<nav class="navbar navbar-light bg-light" style="padding: 1.5vw; padding-bottom: 0.5vw;">
  <a class="navbar-brand" style="font-family: 'Monoton', cursive; letter-spacing: 0.1vw; font-size: 2vw;">
    <img src="images/logo.png" width="50" height="50" class="d-inline-block align-top" alt="">
   Book Your Book</a>
    
    <form class="form-inline">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login" style="margin-right: 1vw;background-color: #AA4E39; border-color: #5D2A1E;font-size: 1.5vw;">
      Login
    </button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#register" style="background-color: #AA4E39; border-color: #5D2A1E;font-size: 1.5vw;">
      Register
    </button>
    </form>
  </nav>

    <!-- Login -->
  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #AA4E39;" >
          <h5 class="modal-title" id="exampleModalCenterTitle" style="color: white;">Sign In</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="Login.php" method="post">
              <label for="exampleInputPassword1">Roll No.</label>
                    <div class="form-inline">
                          <input type="text" class="form-control" id="yr" placeholder=" " style="width: 30%;" name="yr" required=""> -
                          <input type="text" class="form-control" id="batch" placeholder=" " style="width: 30%;" name="batch" required=""> -
                          <input type="text" class="form-control" id="rollno" placeholder=" " style="width: 30%;" name="rollno" required="">
                          <small id="emailHelp" class="form-text text-muted">Enter in format: 20XX-XXX-000</small>

              </div><br>
              <div class="form-group">
                    <label for="Password">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass" required="">
              </div>
              <div class="modal-footer">
                     <button type="submit" class="btn btn-secondary"  name="submit" style="background-color: #AA4E39;">Login</button>
              </div>
              <a href="forgotpass.php" style="color: #AA4E39;">Forgot Password?</a>
          </form>
       </div>
     </div>
     </div>
  </div>

  <!-- Register -->
  <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #AA4E39;" >
          <h5 class="modal-title" id="exampleModalCenterTitle" style="color: white;">Register</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="Register.php" method="post">
              <div class="form-group">
                    <label for="Name">Name</label>
                          <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Name" name="name" required="">
              </div>
                    <label for="exampleInputPassword1">Roll No.</label>
                    <div class="form-inline">
                          <input type="text" class="form-control" id="yr" placeholder=" " style="width: 30%;" name="yr" required=""> -
                          <input type="text" class="form-control" id="batch" placeholder=" " style="width: 30%;" name="batch" required=""> -
                          <input type="text" class="form-control" id="rollno" placeholder=" " style="width: 30%;" name="rollno" required="">
                          <small id="emailHelp" class="form-text text-muted">Enter in format: 20XX-XXX-000</small>

              </div><br>
              <div class="form-group">
                    <label for="Name">Institute Name</label>
                          <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Institute Name" name="institute" required="">
              </div>
              <!-- <div class="form-group">
                    <label for="Password">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass" required="">
              </div>
              <div class="form-group">
                    <label for="Password">Confirm Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass2" required="">
              </div> -->
              <div class="modal-footer">
                     <button type="submit" class="btn btn-secondary" name="submit" style="background-color: #AA4E39;">Register</button>
              </div>
          </form>
       </div>
     </div>
     </div>
  </div>

<ul class="nav nav-tabs" style="padding: 0.5vw;padding-top: 0vw;">
    <li class="nav-item col-lg-2">
    <a class="nav-link active" href="<?php if(isset($_SESSION['yr'])) echo 'dashboard.php'; else echo 'index.php';?>" style="color: #5D2A1E; text-align: center; border-top: 2px solid #AA4E39; font-size: 1.2vw;">HOME</a>
    </li>
    <li class="nav-item col-lg-2">
    <a class="nav-link" href="about.php" style="color: #5D2A1E;text-align: center;font-size: 1.2vw;">ABOUT</a>
    </li>
    <li class="nav-item col-lg-2">
    <a class="nav-link" href="library.php" style="color: #5D2A1E;text-align: center;font-size: 1.2vw;">LIBRARY</a>
    </li>
    <li class="nav-item col-lg-2">
    <a class="nav-link" href="discuss.php" style="color: #5D2A1E;text-align: center;font-size: 1.2vw;">DISCUSS</a>
    </li>
</ul>



<!-- Slider -->

<div class="bd-example">
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/1.jpg" class="d-block w-100" alt="..." style="max-height: 35vw;">
        <div class="carousel-caption d-none d-md-block">
          <h1>Largest Collection of Books</h1>
          <p></p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/2.jpg" class="d-block w-100" alt="..." style="max-height: 35vw;">
        <div class="carousel-caption d-none d-md-block">
          <h1>Your own personalized library</h1>
          <p></p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/3.jpg" class="d-block w-100" alt="..." style="max-height: 35vw;">
        <div class="carousel-caption d-none d-md-block">
          <h1>LEND and BORROW</h1>
          <p></p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>


<!-- cards -->

<div class="card mb-6" style="padding: 2vw;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="images/12.jpg" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h1 class="card-title" style="font-family: 'Luckiest Guy', cursive; color: #AA4E39;text-align: center;font-size: 5em;padding-top: 3vw;">Give N Take</h1>
        <p class="card-text" style="font-size: 1.5vw;font-family: 'Jua', sans-serif;text-align: center;">Knowledge grows by sharing. Share not only your knowledge but books to earn more.</p>
      </div>
    </div>
  </div>
</div>

<div class="card mb-6" style="padding: 2vw;">
  <div class="row no-gutters">
    <div class="col-md-8">
      <div class="card-body">
        <h1 class="card-title" style="font-family: 'Luckiest Guy', cursive; color: #AA4E39;text-align: center;font-size: 5em;padding-top: 3vw;">Play With Points</h1>
        <p class="card-text" style="font-size: 1.5vw;font-family: 'Jua', sans-serif;text-align: center;">The more you help, the more you earn. Disrespect a book, suffer some loss.</p>
      </div>
    </div>
    <div class="col-md-4">
      <img src="images/8.png" class="card-img" alt="...">
    </div>
  </div>
</div>

<div class="card mb-6" style="padding: 2vw;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="images/13.png" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h1 class="card-title" style="font-family: 'Luckiest Guy', cursive; color: #AA4E39;text-align: center;font-size: 5em;padding-top: 3vw;">Any Doubts?</h1>
        <p class="card-text" style="font-size: 1.5vw;font-family: 'Jua', sans-serif;text-align: center;">Have a doubt in the book you're reading? Here you can even talk to people who have been in your shoes before.</p>
      </div>
    </div>
  </div>
</div>


<!-- Footer -->
<footer class="page-footer font-small unique-color-dark" style="background-color: #AA4E39; color: white;padding-top: 0.1vw;">

    <!-- Footer Links -->
    <div class="container text-center text-md-left mt-5">

      <!-- Grid row -->
      <div class="row mt-3">

        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

          <!-- Content -->
          <h6 class="text-uppercase font-weight-bold">Book Your Book</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>Open source book sharing community, for free and efficient exchange of books between peers.</p>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

          <!-- Links -->
          <h6 class="text-uppercase font-weight-bold">Our Members</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>
            <a href="#!" style="color: white;">ABV-IIITM Gwalior</a>
          </p>
          <p>
            <a href="#!" style="color: white;">RJIT Gwalior</a>
          </p>
          <p>
            <a href="#!" style="color: white;">MITS Gwalior</a>
          </p>
          <p>
            <a href="#!" style="color: white;">ITM UNiversity</a>
          </p>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

          <!-- Links -->
          <h6 class="text-uppercase font-weight-bold">Useful links</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>
            <a href="#!" style="color: white; font-weight: bold;">HOME</a>
          </p>
          <p>
            <a href="#!" style="color: white; font-weight: bold;">ABOUT</a>
          </p>
          <p>
            <a href="#!" style="color: white; font-weight: bold;">LIBRARY</a>
          </p>
          <p>
            <a href="#!" style="color: white;font-weight: bold;">CONTACT</a>
          </p>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

          <!-- Links -->
          <h6 class="text-uppercase font-weight-bold">Contact</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>
            <i class="fas fa-home mr-3"></i> Gwalior , India</p>
          <p>
            <i class="fas fa-envelope mr-3"></i>bookyourbook@gmail.com</p>
          <p>
            <i class="fas fa-phone mr-3"></i> +91 989 989 9899</p>
          <p>
            <i class="fas fa-print mr-3"></i> +91 686 686 6866</p>

        </div>
        <!-- Grid column -->

      </div>
      <!-- Grid row -->

    </div>
    <!-- Footer Links -->

  </footer>
  <!-- Footer -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>