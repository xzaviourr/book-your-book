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
          }?>
<!DOCTYPE html>
<html>
<head>
	<title>book details</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
</head>
<body>


<!-- Nav bar -->

<nav class="navbar navbar-light bg-light" style="padding: 1.5vw; padding-bottom: 0.5vw;">
	<a class="navbar-brand" style="font-family: 'Monoton', cursive; letter-spacing: 0.1vw; font-size: 2vw;">
		<img src="images/logo.png" width="50" height="50" class="d-inline-block align-top" alt="">
	 Book Your Book</a>
    
  <?php
    
  if(isset($_SESSION['yr']))
  { $yr=$_SESSION['yr'];
        $batch=$_SESSION['batch'];
        $rollno=$_SESSION['rollno'];
        $sql= "SELECT * FROM users where Yr='$yr' and Batch='$batch' and RollNo='$rollno'";
        $result1=mysqli_query($conn,$sql);
        $row1=mysqli_fetch_array($result1);
    echo '<div style="font-family: "Playfair Display", serif; font-size: 2vw;">Hello, ' . $row1['Name'] . ' </div></nav>'; }
  else
  {
    echo "<form class='form-inline'>
        <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#login' style='margin-right: 1vw;background-color: #AA4E39; border-color: #5D2A1E;font-size: 1.5vw;z-index: 100;'>
      Login
    </button>
    <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#register' style='background-color: #AA4E39; border-color: #5D2A1E;font-size: 1.5vw;z-index: 100;'>
      Register
    </button>
    </form>
  </nav>";
  }
  ?>

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

<ul class="nav nav-tabs">
  	<li class="nav-item col-lg-2">
    <a class="nav-link" href="dashboard.php" style="color: #5D2A1E; text-align: center;font-size: 1.2vw;">HOME</a>
  	</li>
  	<li class="nav-item col-lg-2">
    <a class="nav-link" href="about.php" style="color: #5D2A1E;text-align: center;font-size: 1.2vw;">ABOUT</a>
  	</li>
  	<li class="nav-item col-lg-2">
    <a class="nav-link active" href="library.php" style="color: #5D2A1E;text-align: center; border-top: 2px solid #AA4E39;font-size: 1.2vw;">LIBRARY</a>
  	</li>
  	<li class="nav-item col-lg-2">
    <a class="nav-link" href="discuss.php" style="color: #5D2A1E;text-align: center;font-size: 1.2vw;">DISCUSS</a>
  	</li>
    <li class="nav-item col-lg-2"></li>
    <li class="nav-item col-lg-1">
      <a class="nav-link" href="profile.php" style="color: #5D2A1E;text-align: right; font-size: 1.2vw;"><?php if(isset($_SESSION['yr'])) echo "PROFILE" ; else echo " ";?></a>
    </li>
    <li class="nav-item col-lg-1">
    <a class="nav-link" href="logout.php" style="color: #5D2A1E;text-align: right;font-size: 1.2vw;"><?php if(isset($_SESSION['yr'])) echo "LOGOUT" ; else echo " ";?></a>
    </li>
</ul>

<?php


if(isset($_GET['name']))
$name=$_GET['name'];
if(isset($_GET['?name']))
$name=$_GET['?name'];

$query="SELECT * FROM books WHERE name = '$name'";
$result=mysqli_query($conn,$query);
$row1=mysqli_fetch_array($result);
?>
<!-- book details -->

<div class="h1" style="padding: 3vw; padding-bottom: 0vw;padding-top: 1vw; font-family: 'Playfair Display', serif; text-align: center;">Book Details</div>

<div class="card mb-3" style="padding-top: 2vw;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src=<?php echo "images/" . $row1['cover']; ?> class="card-img" alt="..." style="padding: 3vw;">
    </div>
    <div class="col-md-8">
      <div class="card-body" style="padding-top: 3vw;">
        <h1 class="card-title" style="font-size: 3vw;color: #5D2A1E"><?php echo $row1['name']; ?> </h1>
        <p class="card-text" style="font-size: 2vw;color: #AA4E39"><?php echo $row1['info']; ?></p>
        <p class="card-text" style="font-size: 1.5vw; color: #AA4E39">Genre : <?php echo $row1['genre']; ?></p>
        <a href="transaction.php?id=<?php echo $row1['bookid']; ?>"><button style="background-color: #AA4E39; color: white; border-color: #5D2A1E; width: 10vw;height: 3vw;">ASK FOR BORROW</button></a>


        <!-- Previous users -->

        <div class="h3" style="padding-bottom: 0vw;padding-top: 1vw; font-family: 'Playfair Display', serif; text-align: left;">Previous Users</div>
        <br>

      <ul class="list-group list-group-flush" style="width: 30vw;">
        <li class="list-group-item">Cras justo odio</li>
        <li class="list-group-item">Dapibus ac facilisis in</li>
        <li class="list-group-item">Morbi leo risus</li>
        <li class="list-group-item">Porta ac consectetur ac</li>
        <li class="list-group-item">Vestibulum at eros</li>
      </ul>

      </div>
    </div>
  </div>
</div>


<!-- Reviews -->

<div class="h1" style="padding: 3vw; padding-bottom: 0vw;padding-top: 1vw;margin-left: 5vw; font-family: 'Playfair Display', serif; text-align: left; color: white; font-weight: bold; background-color: #BA7D6F; width: 90vw;height: 5vw;">Reviews</div>

<hr>

<ul class="list-unstyled" style="padding: 3vw; border-radius: 2%; width: 90vw; margin-left: 5vw;">
  <li class="media">
    <img src="..." class="mr-3" alt="...">
    <div class="media-body">
      <h5 class="mt-0 mb-1" style="font-weight: bold;color: #AA4E39"> TEST USER 1</h5>
      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
    </div>
  </li>

  <hr>

  <li class="media my-4">
    <img src="..." class="mr-3" alt="...">
    <div class="media-body">
      <h5 class="mt-0 mb-1" style="font-weight: bold;color: #AA4E39">TEST USER 2</h5>
      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
    </div>
  </li>

  <hr>

  <li class="media">
    <img src="..." class="mr-3" alt="...">
    <div class="media-body">
      <h5 class="mt-0 mb-1" style="font-weight: bold;color: #AA4E39">TEST USER 3</h5>
      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
    </div>
  </li>

  <hr>

</ul>

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

